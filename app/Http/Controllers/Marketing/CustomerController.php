<?php

namespace App\Http\Controllers\Marketing;

use App\Http\Controllers\Controller;
use App\Models\Customer;
use App\Models\User;
use App\Notifications\CreateNewCustomerNotification;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Gate;

class CustomerController extends Controller {
    public function index(){

        Gate::authorize('view', Customer::class);

        $user = Auth::user();
        $customers = ($user->role->role_name == 'Admin')
            ? Customer::all()
            : Customer::where('user_id', $user->id)->get();

        return view('marketing.customer.index', [
            'customers' => $customers,
        ]);
    }

    public function create(){
        Gate::authorize('create', Customer::class);

        return view('marketing.customer.create');

    }

    public function store(){
        // authorization
        Gate::authorize("create", Customer::class);

        //capitalize
        request()->merge([
            'first_name' => ucfirst(strtolower(request()->input('first_name'))),
            'last_name' => ucfirst(strtolower(request()->input('last_name'))),
        ]);

        //validation
        $validateData = request()->validate([
            'user_id' => ['exists:users,id'],
            'first_name' => ['required','string','max:255'],
            'last_name' => ['required','string','max:255'],
            'email' => ['required','email','lowercase'],
            'number' => ['required','numeric','digits:10'],
            'address' => ['required','string'],
        ]);

        //create user
        $customer = Customer::create($validateData);

        //update customer_no
        $customer->update([
            "customer_no"=> 'CUS'.
            str_pad($customer->user_id,2,'0', STR_PAD_LEFT)  .
            str_pad($customer->user->role->id,2,'0', STR_PAD_LEFT) .
            str_pad($customer->id,4,'0', STR_PAD_LEFT),
        ]);

        //notification
        $notifyCustomer = Customer::findOrFail($customer->id);
        $users = User::whereHas('department', function($query){
            $query->whereIn('department_name',['Admin','Management']);
        })->get();
        foreach ($users as $key => $user) {
            $user->notify(new CreateNewCustomerNotification($notifyCustomer));
            $user->notifications()->where('created_at', '<', now()->subDays(30))->delete();
        }

        //return view
        return redirect()->route('marketing.customer.index')->with('success','Customer created successfully!');
    }

    public function edit(Customer $customer){
        // authorization
        Gate::authorize("update", Customer::class);

        //return view
        return view('marketing.customer.edit', [
            'customer' => $customer,
        ]);
    }

    public function update(Customer $customer){
        // authorization
        Gate::authorize("update", Customer::class);

        //capitalize
        request()->merge([
            'first_name' => ucfirst(strtolower(request()->input('first_name'))),
            'last_name' => ucfirst(strtolower(request()->input('last_name'))),
        ]);

        //validation
        $validateData = request()->validate([
            'first_name' => ['required','string','max:255'],
            'last_name' => ['required','string','max:255'],
            'email' => ['required','email','lowercase'],
            'number' => ['required','numeric','digits:10'],
            'address' => ['required','string'],
        ]);

        //update user
        $customer->update($validateData);

        //return view
        return redirect()->route('marketing.customer.index')->with('success','Customer updated successfully!');

    }


}
