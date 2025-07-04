<?php

namespace App\Http\Controllers\Warehouse;

use App\Http\Controllers\Controller;
use App\Models\InventoryTransaction;
use App\Models\Material;
use App\Models\MaterialPurchase;
use App\Models\PaymentRequest;
use App\Models\Tea;
use App\Models\TeaPurchase;
use App\Models\User;
use App\Notifications\UpdateStockReceivedNotification;
use App\Policies\PaymentRequestPolicy;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Gate;

class InventoryTransactionsController extends Controller
{
    public function index(){
        Gate::authorize('view',InventoryTransaction::class);

        $transactions = InventoryTransaction::all();

        return view('warehouse.inventroy.index', compact('transactions'));
    }

    public function show($transactionId){
        Gate::authorize('view',InventoryTransaction::class);

        $transaction = InventoryTransaction::findOrFail($transactionId);
        return view('warehouse.inventroy.show', compact('transaction'));
    }

    public function update($transactionId){
        $transaction = InventoryTransaction::findOrFail($transactionId);

        Gate::authorize('update',$transaction);

        //updateing inventroy transaction
        $transaction->update([
            'user_id' => Auth::user()->id,
            'status' => 6, //received
        ]);

        //updating

        //updateing stock & purchase
        if($transaction->transaction_type === 1){ // check add
            if($transaction->item_type === 1){ // check tea
                $tea = Tea::findOrFail($transaction->tea_id);
                $payment_request = PaymentRequest::findOrFail($transaction->tea_purchase->payment_request->id);

                $payment_request->update([
                    'status' => 6, //received
                ]);
                $tea->update([
                    'stock_level' => $tea->stock_level + $transaction->tea_purchase->quantity,
                ]);

                //notify users
                $users = User::whereHas('department', function($query){
                    $query->whereIn('department_name',['Admin','Management','Tea','Finance']);
                })->get();
                foreach ($users as $key => $user) {
                    $user->notify(new UpdateStockReceivedNotification($transaction));
                    $user->notifications()->where('created_at', '<', now()->subDays(7))->delete();
                }


            } elseif ($transaction->item_type === 2){ // check material
                $material = Material::findOrFail($transaction->material_id);
                $payment_request = PaymentRequest::findOrFail($transaction->material_purchase->payment_request->id);

                $payment_request->update([
                    'status' => 6, //received
                ]);
                $material->update([
                    'stock_level' => $material->stock_level + $transaction->material_purchase->units,
                ]);

                 //notify users
                $users = User::whereHas('department', function($query){
                    $query->whereIn('department_name',['Admin','Management','Production','Finance']);
                })->get();
                foreach ($users as $key => $user) {
                    $user->notify(new UpdateStockReceivedNotification($transaction));
                    $user->notifications()->where('created_at', '<', now()->subDays(7))->delete();
                }
            }
        }




        return redirect()->route('warehouse.inventory.index')->with('success','Order status updated successfuly!');

    }
}
