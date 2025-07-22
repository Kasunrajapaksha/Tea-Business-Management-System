<?php

namespace App\Http\Controllers\Production;

use App\Http\Controllers\Controller;
use App\Models\InventoryTransaction;
use App\Models\Material;
use App\Models\Order;
use App\Models\ProductionMaterial;
use App\Models\ProductionPlan;
use App\Models\User;
use App\Notifications\EndProductionNotification;
use App\Notifications\RequestOutgingMaterialNotification;
use App\Notifications\RequestOutgoingItemsNotification;
use App\Notifications\UpdateProductionPlanNotification;
use App\Notifications\UpdateProductionStartedNotification;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Gate;
use Illuminate\Validation\ValidationException;

use function Laravel\Prompts\error;

class ProductionPlanController extends Controller
{

    public function index(){
        Gate::authorize('view', ProductionPlan::class);
        $plans = ProductionPlan::latest()->paginate(8);

        return view('production.plan.index', compact('plans'));
    }

    public function create(Order $order){
        Gate::authorize('create', ProductionPlan::class);

        if($order->status != 11 ){
            abort(404);
        }

        $materials = Material::all();

        return view('production.plan.create', compact('order','materials'));
    }

    public function store(){
        Gate::authorize('create', ProductionPlan::class);
        $validateData = request()->validate([
            'user_id' => ['exists:users,id'],
            'order_id' => ['exists:orders,id'],
            'production_start' => ['required','date_format:Y-m-d','after_or_equal:today'],
            'production_end' => ['required','date_format:Y-m-d','after_or_equal:production_start'],

        ]);

        ProductionPlan::create($validateData);

        $order = Order::findOrFail($validateData['order_id']);
        $order->update([
            'status' => 12  //Production Plan Created
        ]);

        $users = User::whereHas('department', function($query){
        $query->whereIn('department_name',['Admin','Management','Shipping','Marketing']);
        })->get();
        foreach ($users as $key => $user) {
            $user->notify(new UpdateProductionPlanNotification($order));
            $user->notifications()->where('created_at', '<', now()->subDays(7))->delete();
        }


        return redirect()->route('order.show', $validateData['order_id'])->with('success','Production plan updated successfully!');
    }


    public function show(ProductionPlan $plan){
        Gate::authorize('view', ProductionPlan::class);
        $order = Order::findOrFail($plan->order_id);
        return view('production.plan.show', compact('plan','order'));
    }


    public function edit(ProductionPlan $plan){
        Gate::authorize('update', $plan);
        if($plan->order->status != 12 ){
            abort(404);
        }
        $order = Order::findOrFail($plan->order_id);
        $materials = Material::all();
        return view('production.plan.edit', compact(['plan','order','materials']));
    }


    public function update(ProductionPlan $plan){
        Gate::authorize('update', $plan);
        $validateProductionPlaneData = request()->validate([
            'user_id' => ['exists:users,id'],
            'production_start' => ['required','date_format:Y-m-d','after_or_equal:today'],
            'production_end' => ['required','date_format:Y-m-d','after_or_equal:production_start'],
        ]);

        $plan->fill($validateProductionPlaneData);
        if ($plan->isDirty()) {
            $plan->save();
            return redirect()->route('production.plan.show', $plan)->with('success', 'Production plan updated successfully!');
        }
        return redirect()->route('production.plan.edit', $plan);
    }

    public function planDates(ProductionPlan $plan){
        Gate::authorize('update', $plan);
        $order = Order::findOrFail($plan->order->id);

        if($order->status == 15){ //payment verified
            $plan->update([
                'actual_aproduction_start' => now()->format('Y-m-d')
            ]);
            $order->update([
                'status' => 16 //Production Started
            ]);

            InventoryTransaction::create([
                'transaction_type' => 2, //reduce
                'item_type' => 1, //tea
                'status' => 0, //pending
                'units' => $order->orderItem->quantity,
                'tea_id' => $order->orderItem->tea->id,
                'production_plan_id' => $plan->id,
            ]);

            $users = User::whereHas('department', function($query){
                $query->whereIn('department_name',['Admin','Management','Warehouse']);
            })->get();
            foreach ($users as $key => $user) {
                $user->notify(new RequestOutgoingItemsNotification($plan));
                $user->notifications()->where('created_at', '<', now()->subDays(7))->delete();
            }

            $users = User::whereHas('department', function($query){
            $query->whereIn('department_name',['Admin','Management','Marketing']);
            })->get();
            foreach ($users as $key => $user) {
                $user->notify(new UpdateProductionStartedNotification($order));
                $user->notifications()->where('created_at', '<', now()->subDays(7))->delete();
            }

        } elseif($order->status == 16) {

            $plan->update([
                'actual_production_end' => now()->format('Y-m-d')
            ]);
            $order->update([
                'status' => 17 //Production Completed
            ]);

            $plan->update([
                'production_cost' => $plan->order->productionMaterial->sum('cost')
            ]);

            $users = User::whereHas('department', function($query){
                $query->whereIn('department_name',['Admin','Management','Shipping','Marketing']);
            })->get();
            foreach ($users as $key => $user) {
                $user->notify(new EndProductionNotification($plan));
                $user->notifications()->where('created_at', '<', now()->subDays(7))->delete();
            }

        }



        return redirect()->route('production.plan.show', $plan)->with('success','Production plan updated successfully!');
    }

}
