<?php

namespace App\Http\Controllers\Order;

use App\Http\Controllers\Controller;
use App\Models\Customer;
use App\Models\InventoryTransaction;
use App\Models\Material;
use App\Models\Order;
use App\Models\OrderItem;
use App\Models\ProductionMaterial;
use App\Models\ProductionPlan;
use App\Models\Tea;
use App\Models\User;
use App\Notifications\AddNewOrderNotification;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Gate;
use Illuminate\Validation\ValidationException;

class OrderController extends Controller
{
    public function index(Request $request){
        Gate::authorize('view', Order::class);

        $orders = Order::latest()->paginate(8);
        return view('order.index', compact('orders'));
    }

    public function create(Customer $customer){
        Gate::authorize('create', Order::class);
        $teas = Tea::all();
        return view('order.create', compact('customer','teas'));
    }

    public function store(){
        //authorize
        Gate::authorize('create', Order::class);

        //validate
        $validateData = request()->validate([
            'user_id' => ['exists:users,id'],
            'customer_id' => ['exists:customers,id'],
            'tea_id' => ['exists:teas,id'],
            'quantity' => ['required','numeric',],
            'packing_instractions' => ['required'],
        ]);

        $tea = Tea::findOrFail($validateData['tea_id']);
        if($tea->stock_level < $validateData['quantity']){
            throw ValidationException::withMessages(
                ['quantity'=>'Sorry, there is insufficient stock to create the order.']);
        }

        //create order , order item & tea stock
        $order = Order::create([
            'user_id' => $validateData['user_id'],
            'customer_id' => $validateData['customer_id'],
            'total_amount' => $validateData['quantity'] * $tea->price_per_Kg,
            'order_date' => now()->format('Y-m-d'),
            'packing_instractions' => $validateData['packing_instractions'],
            'status' => 11, //Order Placed
        ]);

        $orderItem = OrderItem::create([
            'order_id' => $order->id,
            'tea_id' => $validateData['tea_id'],
            'quantity' => $validateData['quantity'],
        ]);

        $order->update([
            "order_no"=> 'ORD'.
            str_pad($order->user_id,2,'0', STR_PAD_LEFT)  .
            str_pad($order->id,2,'0', STR_PAD_LEFT) .
            str_pad($orderItem->id,4,'0', STR_PAD_LEFT),
        ]);
        $tea->update([
            'stock_level' => $tea->stock_level - $validateData['quantity'],
        ]);

        //send notification
        $users = User::whereHas('department', function($query){
            $query->whereIn('department_name',['Admin','Management','Shipping','Finance','Production','Tea']);
        })->get();
        foreach ($users as $key => $user) {
            $user->notify(new AddNewOrderNotification($order));
            $user->notifications()->where('created_at', '<', now()->subDays(30))->delete();
        }

        //redirect
        return redirect()->route('order.index')->with('success','Order created successfully!');
    }

    public function show(Order $order){
        Gate::authorize('view', Order::class);
        
        $productionMaterials = ProductionMaterial::all();

        return view('order.show', compact(['order']));
    }

    public function edit(Order $order){
        Gate::authorize('update', $order);
        $teas = Tea::all();
        return view('order.edit', compact('order','teas'));
    }

    public function update(Order $order){
        Gate::authorize('update', $order);

        $validateData = request()->validate([
            'user_id' => ['exists:users,id'],
            'tea_id' => ['exists:teas,id'],
            'order_item' => ['exists:order_items,id'],
            'quantity' => ['required','numeric',],
            'packing_instractions' => ['required'],
        ]);

        $tea = Tea::findOrFail($validateData['tea_id']);
        if($tea->stock_level < $validateData['quantity']){
            throw ValidationException::withMessages(
            ['quantity'=>'Sorry, there is insufficient stock to create the order.']);
        }

        $order->update([
            'total_amount' => $validateData['quantity'] * $tea->price_per_Kg,
            'order_date' => now()->format('Y-m-d'),
            'packing_instractions' => $validateData['packing_instractions'],
        ]);


        $orderItem = OrderItem::findOrFail($validateData['order_item']);
        $orderItem->update([
            'tea_id' => $validateData['tea_id'],
            'quantity' => $validateData['quantity'],
        ]);

        return redirect()->route('order.show', $order)->with('success','Order updated successfully!');
    }

    public function updateStatus(Order $order, $status){
        Gate::authorize('update', $order);
        $order->update([
            'status' => (int)$status
        ]);

        return redirect()->route('order.show', $order)->with('success','Order updated successfully!');
    }


}
