<?php

namespace App\Http\Controllers\Supply;

use App\Http\Controllers\Controller;
use App\Models\Supplier;
use App\Models\User;
use App\Notifications\AddNewSupplierNotification;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Gate;

class SupplierController extends Controller
{
    public function index(){
        Gate::authorize('view', Supplier::class);

        $user = Auth::user();
         if(in_array($user->department->department_name, ['Admin','Management'])){
            $suppliers = Supplier::all();
         } elseif($user->department->department_name == 'Tea'){
            $suppliers = Supplier::where('type',01)->where('status','active')->latest()->paginate(8);
         } elseif($user->department->department_name == 'Production'){
            $suppliers = Supplier::where('type',02)->where('status','active')->latest()->paginate(8);
         }

        return view('supply.index',compact('suppliers'));
    }

    public function create() {
        Gate::authorize('create', Supplier::class);

        return view('supply.create');
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
            'email' => ['required','email','lowercase'],
            'number' => ['required','numeric','digits:10'],
            'address' => ['required', 'string', 'min:10', 'max:255', 'regex:/^[a-zA-Z0-9\s,.-]+$/'],
            'bank_details' => ['required', 'string', 'min:10', 'max:255'],
        ]);

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

        return view('supply.edit', compact('supplier'));
    }

    public function update(Supplier $supplier){
        Gate::authorize('update', $supplier);

        request()->merge([
            'name' => ucwords(strtolower(request()->input('name'))),
        ]);

        $validateData = request()->validate([
            'name' => ['required','string','max:255'],
            'email' => ['required','email','lowercase'],
            'number' => ['required','numeric','digits:10'],
            'address' => ['required', 'string', 'min:10', 'max:255', 'regex:/^[a-zA-Z0-9\s,.-]+$/'],
            'bank_details' => ['required', 'string', 'min:10', 'max:255'],
        ]);

        $supplier->update($validateData);

        return redirect()->route('supplier.show',$supplier)->with('success','Supplier updated successfully!');
    }

    public function destroy(Supplier $supplier){
        Gate::authorize('delete',$supplier);

        $supplier->update([
            'status' => 'inactive'
        ]);

        return redirect()->route('supplier.index')->with('success', 'Supplier deleted!');
    }
}
