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
use App\Notifications\DispatchItemsNotification;
use App\Notifications\LowMaterialStockNotification;
use App\Notifications\UpdateStockReceivedNotification;
use App\Policies\PaymentRequestPolicy;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Gate;

class InventoryTransactionsController extends Controller
{
    public function index(){
        Gate::authorize('view',InventoryTransaction::class);

        $transactions = InventoryTransaction::where('transaction_type', '=', 1)->latest()->paginate(8);
        return view('warehouse.inventroy.index', compact([
            'transactions',
        ]));
    }

    public function indexOutgoing(){
        Gate::authorize('view',InventoryTransaction::class);
        $outgoingTransactions = InventoryTransaction::where('transaction_type', '=', 2)->latest()->paginate(8);
        return view('warehouse.inventroy.index-outgoing', compact([
            'outgoingTransactions'
        ]));
    }

    public function show(InventoryTransaction $transaction){
        Gate::authorize('view',InventoryTransaction::class);

        return view('warehouse.inventroy.show', compact('transaction'));
    }

    public function showOutgoing(InventoryTransaction $transaction){
        Gate::authorize('view',InventoryTransaction::class);

        return view('warehouse.inventroy.show-outgoing', compact('transaction'));
    }

    public function update(InventoryTransaction $transaction){
        Gate::authorize('update',$transaction);

        //updateing stock & purchase
        if($transaction->transaction_type === 1){ // check add
            //updateing inventroy transaction
            $transaction->update([
                'user_id' => Auth::user()->id,
                'status' => 6, //received
            ]);

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

        } elseif($transaction->transaction_type === 2){ //check reduce

            $transaction->update([
                'user_id' => Auth::user()->id,
                'status' => 9, //Dispatched
            ]);

            $users = User::whereHas('department', function($query){
                $query->whereIn('department_name',['Admin','Management','Production',]);
            })->get();
            foreach ($users as $key => $user) {
                $user->notify(new DispatchItemsNotification($transaction));
                $user->notifications()->where('created_at', '<', now()->subDays(7))->delete();
            }

            return redirect()->route('warehouse.inventory.show.outgoing' ,$transaction)->with('success','Order status updated successfuly!');
        }

        return redirect()->route('warehouse.inventory.index')->with('success','Order status updated successfuly!');

    }
}
