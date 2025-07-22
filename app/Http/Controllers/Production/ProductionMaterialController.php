<?php

namespace App\Http\Controllers\Production;

use App\Http\Controllers\Controller;
use App\Models\InventoryTransaction;
use App\Models\Material;
use App\Models\Order;
use App\Models\ProductionMaterial;
use App\Models\ProductionPlan;
use App\Models\User;
use App\Notifications\LowMaterialStockNotification;
use App\Notifications\RequestOutgingMaterialNotification;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Gate;
use Illuminate\Validation\ValidationException;

class ProductionMaterialController extends Controller{


    public function index(Order $order, ProductionPlan $plan){
        Gate::authorize('view', ProductionMaterial::class);
        $production_materials = ProductionMaterial::where('order_id',$order->id)->latest()->paginate(5);
        return view('production.order-material.index', compact(['order','production_materials','plan']));
    }

    public function create(Order $order){
        Gate::authorize('create', ProductionMaterial::class);;
        $materials = Material::all();
        return view('production.order-material.create', compact(['order','materials']));
    }

    public function show(ProductionMaterial $production_material){
        Gate::authorize('view', ProductionMaterial::class);
        return view('production.order-material.show', compact(['production_material']));
    }

    public function edit(ProductionMaterial $production_material){
        Gate::authorize('update', $production_material);
        return view('production.order-material.edit', compact(['production_material']));
    }

    public function store(Order $order){
        Gate::authorize('create', ProductionMaterial::class);

        $validateData = request()->validate([
            'user_id' => ['exists:users,id'],
            'order_id' => ['exists:orders,id'],
            'units' => 'required|array',
            'units.*' => 'nullable|integer|min:1',
        ]);

        $errors = [];
        $hasValidUnits = false;

        foreach ($validateData['units'] as $materialId => $unit) {
            if (empty($unit) || $unit <= 0) {
                continue;
            }

            $hasValidUnits = true;

            $material = Material::find($materialId);

            if ($material->stock_level < $unit) {
                $errors["units.$materialId"] = "Insufficient stock. Available: {$material->stock_level} units.";
            }
        }

        if (!$hasValidUnits) {
            return back()->with('danger', 'No units were entered for any material.');
        }

        if (!empty($errors)) {
            throw ValidationException::withMessages($errors);
        }


        foreach ($validateData['units'] as $materialId => $unit) {

            $material = Material::find($materialId);

            if (empty($unit) || $unit <= 0) {
                continue;
            }

            $production_material = ProductionMaterial::create([
                'order_id' => $validateData['order_id'],
                'material_id' => $materialId,
                'units' => $unit,
                'cost' => $material->unit_price * $unit,
                'user_id' => $validateData['user_id'],
            ]);

            $transaction = InventoryTransaction::create([
                'transaction_type' => 2, // reduce
                'item_type' => 2,        // material
                'status' => 0,           // pending
                'units' => $unit,
                'material_id' => $materialId,
                'production_material_id' => $production_material->id,
                'production_plan_id' => $order->productionPlan->id,
            ]);

            $material->update([
                'stock_level' => $material->stock_level - $transaction->units,
            ]);

            if($material->stock_level < 100 ){
                $users = User::whereHas('department', function($query){
                $query->whereIn('department_name',['Admin','Management','Production',]);
                })->get();
                foreach ($users as $key => $user) {
                    $user->notify(new LowMaterialStockNotification($material));
                    $user->notifications()->where('created_at', '<', now()->subDays(7))->delete();
                }
            }

            $users = User::whereHas('department', function($query){
            $query->whereIn('department_name',['Admin','Management','Warehouse']);
            })->get();
            foreach ($users as $key => $user) {
                $user->notify(new RequestOutgingMaterialNotification($order, $transaction));
                $user->notifications()->where('created_at', '<', now()->subDays(7))->delete();
            }

        }

        return redirect()->route('production.order.material.index', [$order,$order->productionPlan])->with('success','Production Material added successfully!');
    }

    public function update(ProductionMaterial $production_material){
        Gate::authorize('update', $production_material);
        $validateData = request()->validate([
            'user_id' => ['exists:users,id'],
            'units' => 'required|integer|min:1',
        ]);

        $material = Material::find($production_material->material_id);
        if ($material->stock_level < $validateData['units']) {
            throw ValidationException::withMessages(
            ['units'=> "Insufficient stock. Available: {$material->stock_level} units."]);
        }

        $material->update([
            'stock_level' => $material->stock_level + $production_material->units,
        ]);

        $material->update([
            'stock_level' => $material->stock_level - $validateData['units'],
        ]);

        if($material->stock_level < 100 ){
            $users = User::whereHas('department', function($query){
            $query->whereIn('department_name',['Admin','Management','Production',]);
            })->get();
            foreach ($users as $key => $user) {
                $user->notify(new LowMaterialStockNotification($material));
                $user->notifications()->where('created_at', '<', now()->subDays(7))->delete();
            }
        }

        $transaction = InventoryTransaction::findOrFail($production_material->inventory_transaction->first()->id);

        $transaction->update([
            'units' => $validateData['units'],
        ]);

        $production_material->fill($validateData);
        if ($production_material->isDirty()) {
            $production_material->save();
            return redirect()->route( 'production.order.material.show', $production_material)->with('success','Production Material updated successfully!');
        }

        return redirect()->route( 'production.order.material.edit', $production_material);
    }

    public function destroy(ProductionMaterial $production_material){
        Gate::authorize('delete',$production_material);
        $transaction = InventoryTransaction::findOrFail($production_material->inventory_transaction->first()->id);
        Gate::authorize('delete', $transaction);

        $material = Material::find($production_material->material_id);

        try {

            $material->update([
                'stock_level' => $material->stock_level + $production_material->units,
            ]);

            $production_material->delete();
            $transaction->delete();


            return redirect()->route( 'production.order.material.index', [$production_material->order_id, $production_material->order->productionPlan])->with('success','Production material deleted!');
        } catch (\Exception $e) {
            return redirect()->route('production.order.material.show', $production_material)->with('danger', 'Faild to delete material.');
        }
    }
}
