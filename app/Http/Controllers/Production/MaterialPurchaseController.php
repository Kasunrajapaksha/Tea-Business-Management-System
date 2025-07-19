<?php

namespace App\Http\Controllers\Production;

use App\Http\Controllers\Controller;
use App\Models\Material;
use App\Models\MaterialPurchase;
use App\Models\PaymentRequest;
use App\Models\Supplier;
use App\Models\User;
use App\Notifications\MaterialPurchaseRequestNotification;
use Illuminate\Support\Facades\Gate;

class MaterialPurchaseController extends Controller
{
    public function index(){
        Gate::authorize('view', MaterialPurchase::class);

        $purchases = MaterialPurchase::latest()->paginate(8);

        return view('production.material-purchase.index',compact('purchases'));
    }

    public function create(){
        Gate::authorize('create', MaterialPurchase::class);

        $materials = Material::where('status','active')->get();
        $suppliers = Supplier::where('type',02)->where('status','active')->get();

        return view('production.material-purchase.create', compact(['materials','suppliers']));
    }

    public function show(MaterialPurchase $purchase){
        Gate::authorize('view', MaterialPurchase::class);

        return view('production.material-purchase.show', compact(['purchase']));
    }

    public function store(){
        //authorization
        Gate::authorize('create', MaterialPurchase::class);
        Gate::authorize('create', PaymentRequest::class);

        //validation
        $validateData = request()->validate([
            'user_id' => ['exists:users,id'],
            'material_id' => ['exists:materials,id'],
            'supplier_id' => ['exists:suppliers,id'],
            'units' => ['required','numeric',],
            'unit_price' => ['required','numeric',],
        ]);

        //create tea purchase
        $purchase = MaterialPurchase::create($validateData);

        //update tea purchase no
        $purchase->update([
            "material_purchase_no"=> 'MPC'.
            str_pad($purchase->user_id,2,'0', STR_PAD_LEFT)  .
            str_pad($purchase->material->id,2,'0', STR_PAD_LEFT) .
            str_pad($purchase->id,4,'0', STR_PAD_LEFT),
        ]);

        //create payment request
        $request = PaymentRequest::create([
            'amount' => $purchase->units * $purchase->unit_price,
            'supplier_id' => $purchase->supplier_id,
            'requester_id' => $purchase->user_id,
        ]);

        //set tea perchase foreign kay with payment request
        $purchase->update([
            'payment_request_id' => $request->id,
        ]);

        //update payament request no
        $request->update([
            "request_no"=> 'REQ'.
            str_pad($request->requester_id,2,'0', STR_PAD_LEFT)  .
            str_pad($request->supplier->id,2,'0', STR_PAD_LEFT) .
            str_pad($request->id,4,'0', STR_PAD_LEFT),
        ]);

        //notify users
        $notifyPaymentRequest = PaymentRequest::findOrFail($request->id);
        $users = User::whereHas('department', function($query){
            $query->whereIn('department_name',['Admin','Management','Finance']);
        })->get();
        foreach ($users as $key => $user) {
            $user->notify(new MaterialPurchaseRequestNotification($notifyPaymentRequest));
            $user->notifications()->where('created_at', '<', now()->subDays(7))->delete();
        }

        //return view
        return redirect()->route('production.material.purchase.index')->with('success','Sent material purchase request successfully!');
    }

    public function edit(MaterialPurchase $purchase){
        Gate::authorize('update', $purchase);

        $materials = Material::where('status','active')->get();
        $suppliers = Supplier::where('type',02)->get();

        return view('production.material-purchase.edit', compact(['purchase','materials','suppliers']));
    }

    public function update(MaterialPurchase $purchase){
        Gate::authorize('update', $purchase);
        $request = PaymentRequest::findOrFail($purchase->payment_request_id);
        Gate::authorize('update', $request);

        $validateData = request()->validate([
            'user_id' => ['exists:users,id'],
            'material_id' => ['exists:materials,id'],
            'supplier_id' => ['exists:suppliers,id'],
            'units' => ['required','numeric',],
            'unit_price' => ['required','numeric',],
        ]);

        $purchase->update($validateData);


        $request->update([
            'amount' => $purchase->units * $purchase->unit_price,
            'supplier_id' => $purchase->supplier_id,
            'requester_id' => $purchase->user_id,
        ]);

        return redirect()->route('production.material.purchase.show', $purchase)->with('success','Material purchase details updated successfully!');
    }

    public function destroy(MaterialPurchase $purchase){
        Gate::authorize('delete',$purchase);
        $request = PaymentRequest::findOrFail($purchase->payment_request_id);
        Gate::authorize('delete', $request);

        try {
            $purchase->delete();
            $request->delete();
            return redirect()->route('production.material.purchase.index')->with('success', 'Material purchase canceled!');
        } catch (\Exception $e) {
            return redirect()->route('shipping.provider.show', $purchase)->with('danger', 'Faild to cancel material purchase.');
        }
    }
}
