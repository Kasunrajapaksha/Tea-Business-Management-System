<?php

namespace App\Http\Controllers\Production;

use App\Http\Controllers\Controller;
use App\Models\Material;
use App\Models\Order;
use App\Models\ProductionMaterial;
use App\Models\ProductionPlan;
use Illuminate\Http\Request;
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
        $validateProductionPlaneData = request()->validate([
            'user_id' => ['exists:users,id'],
            'order_id' => ['exists:orders,id'],
            'production_start' => ['required','date_format:Y-m-d'],
            'production_end' => ['required','date_format:Y-m-d'],

        ]);

        $validateProductionMaterialData = request()->validate([
            'user_id' => ['exists:users,id'],
            'order_id' => ['exists:orders,id'],
            'material_id' => ['required','exists:materials,id'],
            'units' => ['required','numeric'],
            'unit_price' => ['required','numeric'],
        ]);

        $material = Material::findOrFail($validateProductionMaterialData['material_id']);
        if($material->stock_level < $validateProductionMaterialData['units']){
            throw ValidationException::withMessages(
                ['quantity'=>'Sorry, there is insufficient stock to create the order.']);
        }

        $order = Order::findOrFail($validateProductionPlaneData['order_id']);
        $order->update([
            'status' => 12  //Production Plan Created
        ]);

        ProductionPlan::create($validateProductionPlaneData);
        ProductionMaterial::create($validateProductionMaterialData);

        return redirect()->route('order.show', $validateProductionPlaneData['order_id'])->with('success','Production plan updated successfully!');
    }


    public function show(ProductionPlan $plan){
        Gate::authorize('view', ProductionPlan::class);
        $order = Order::findOrFail($plan->order_id);
        return view('production.plan.show', compact('plan','order'));
    }


    public function edit(ProductionPlan $plan){
        Gate::authorize('update', $plan);
        $order = Order::findOrFail($plan->order_id);
        $materials = Material::all();
        return view('production.plan.edit', compact(['plan','order','materials']));
    }


    public function update(ProductionPlan $plan){
        Gate::authorize('update', $plan);
        $validateProductionPlaneData = request()->validate([
            'user_id' => ['exists:users,id'],
            'production_start' => ['required','date_format:Y-m-d'],
            'production_end' => ['required','date_format:Y-m-d'],
        ]);

        $validateProductionMaterialData = request()->validate([
            'id' => ['exists:production_materials,id'],
            'user_id' => ['exists:users,id'],
            'material_id' => ['required','exists:materials,id'],
            'units' => ['required','numeric'],
            'unit_price' => ['required','numeric'],
        ]);

        $material = Material::findOrFail($validateProductionMaterialData['material_id']);
        if($material->stock_level < $validateProductionMaterialData['units']){
            throw ValidationException::withMessages(
                ['units'=>'Sorry, there is insufficient stock to create the order.']);
        }

        $production_materials = ProductionMaterial::findOrFail($validateProductionMaterialData['id']);

        $plan->update($validateProductionPlaneData);
        $production_materials->update($validateProductionMaterialData);

        return redirect()->route('production.plan.show', $plan)->with('success','Production plan updated successfully!');
    }

    public function destroy(ProductionPlan $productionPlan)
    {
        //
    }
}
