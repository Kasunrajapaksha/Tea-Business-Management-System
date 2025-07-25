<?php

namespace App\Http\Controllers\Supply;

use App\Http\Controllers\Controller;
use App\Models\Bank;
use App\Models\Supplier;
use App\Models\User;
use App\Notifications\AddNewSupplierNotification;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Gate;
use Illuminate\Validation\Rule;
use Illuminate\Validation\ValidationException;

class SupplierController extends Controller
{
    public function index(){
        Gate::authorize('view', Supplier::class);

        $user = Auth::user();
         if(in_array($user->department->department_name, ['Admin','Management'])){
            $suppliers = Supplier::where('status','active')->latest()->paginate(8);
         } elseif($user->department->department_name == 'Tea'){
            $suppliers = Supplier::where('type',01)->latest()->paginate(8);
         } elseif($user->department->department_name == 'Production'){
            $suppliers = Supplier::where('type',02)->latest()->paginate(8);
         }

        return view('supply.index',compact('suppliers'));
    }

    public function create() {
        Gate::authorize('create', Supplier::class);
        $banks = Bank::all();
        return view('supply.create',compact('banks'));
    }

    public function show(Supplier $supplier){
        Gate::authorize('view', Supplier::class);

        return view('supply.show',compact('supplier'));
    }

    public function store() {
        Gate::authorize('create', Supplier::class);

        request()->merge([
            'name' => ucwords(strtolower(request()->input('name'))),
        ]);

        $validateData = request()->validate([
            'user_id' => ['exists:users,id'],
            'name' => ['required','string','max:255'],
            'type' => ['required','numeric','digits:2'],
            'email' => ['required', 'email', 'lowercase', 'unique:suppliers,email'],
            'number' => ['required', 'numeric', 'digits:10', 'unique:suppliers,number'],
            'address' => ['required', 'string', 'min:10', 'max:255', 'regex:#^[a-zA-Z0-9\s,.\-\/]+$#'],
            'bank_id' => ['exists:banks,id'],
            'bank_details' => ['required', 'numeric'],
        ], [
            'bank_id.exists' => 'The selected bank is invalid.',
            'bank_details.required' => 'The bank account number is required.',
        ]);

        $bank = Bank::findOrFail($validateData['bank_id']);
        if($bank->length != strlen($validateData['bank_details'])){
            throw ValidationException::withMessages(
                ['bank_details'=>'The account number is not matching for the selected bank.']);
        }


        $supplier = Supplier::create($validateData);

        $supplier->update([
            "supplier_no"=> 'SUP'.
            str_pad($supplier->user_id,2,'0', STR_PAD_LEFT)  .
            str_pad($supplier->type,2,'0', STR_PAD_LEFT) .
            str_pad($supplier->id,4,'0', STR_PAD_LEFT),
        ]);


        $notifySupplier = Supplier::findOrFail($supplier->id);
        $users = User::whereHas('department', function($query){
            $query->whereIn('department_name',['Admin','Management']);
        })->get();
        foreach ($users as $key => $user) {
            $user->notify(new AddNewSupplierNotification($notifySupplier));
            $user->notifications()->where('created_at', '<', now()->subDays(7))->delete();
        }


        return redirect()->route('supplier.index')->with('success','Supplier created successfully!');
    }

    public function edit(Supplier $supplier) {
        Gate::authorize('update', $supplier);
        $banks = Bank::all();
        return view('supply.edit', compact('supplier','banks'));
    }

    public function update(Supplier $supplier){
        Gate::authorize('update', $supplier);

        request()->merge([
            'name' => ucwords(strtolower(request()->input('name'))),
        ]);

        $validateData = request()->validate([
            'name' => ['required','string','max:255'],
            'email' => ['required','email','lowercase',Rule::unique('suppliers', 'email')->ignore($supplier->id)],
            'number' => ['required','numeric','digits:10',Rule::unique('suppliers', 'number')->ignore($supplier->id)],
            'address' => ['required', 'string', 'min:10', 'max:255', 'regex:#^[a-zA-Z0-9\s,.\-\/]+$#'],
            'bank_id' => ['exists:banks,id'],
            'bank_details' => ['required', 'numeric'],
        ], [
            'bank_id.exists' => 'The selected bank is invalid.',
            'bank_details.required' => 'The bank account number is required.',
        ]);

        $bank = Bank::findOrFail($validateData['bank_id']);
        if($bank->length != strlen($validateData['bank_details'])){
            throw ValidationException::withMessages(
                ['bank_details'=>'The account number is not matching for the selected bank.']);
        }

        $supplier->fill($validateData);

        if ($supplier->isDirty()) {
            $supplier->save();
            return redirect()->route('supplier.show',$supplier)->with('success','Supplier updated successfully!');
        }

        return redirect()->back();
    }

    public function destroy(Supplier $supplier){
        Gate::authorize('update',$supplier);

        if($supplier->status == 'active'){
            $supplier->update([
                'status' => 'inactive'
            ]);
        } elseif($supplier->status == 'inactive'){
            $supplier->update([
                'status' => 'active'
            ]);
        }

        return redirect()->route('supplier.index')->with('success', 'Supplier status updated!');
    }






    public function getBanks(){
        $banks = Bank::all(['id', 'bank_code', 'bank_name']);
        return response()->json($banks);
    }
}
