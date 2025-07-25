<?php

namespace App\Http\Controllers\Marketing;

use App\Http\Controllers\Controller;
use App\Models\Country;
use App\Models\Customer;
use App\Models\User;
use App\Notifications\AddNewCustomerNotification;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Gate;
use Illuminate\Validation\Rule;

class CustomerController extends Controller {
    public function index(){
        Gate::authorize('view', Customer::class);
        $customers = Customer::latest()->paginate(5);
        return view('marketing.customer.index', compact('customers'));
    }

    public function create(){
        Gate::authorize('create', Customer::class);
        $counties = Country::all();
        return view('marketing.customer.create',compact('counties'));
    }

    public function show(Customer $customer){
        Gate::authorize('view', Customer::class);
        return view('marketing.customer.show', compact('customer'));
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
            'email' => ['required', 'email', 'lowercase', 'unique:customers,email'],
            'number' => ['required', 'numeric', 'digits:10', 'unique:customers,number'],
            'address' => ['required', 'string', 'min:10', 'max:255', 'regex:#^[a-zA-Z0-9\s,.\-\/]+$#'],
            'country_id' => ['required','exists:countries,id'],
        ],
        [
            'country_id.required' => 'Please select a valid country.',
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
            $user->notify(new AddNewCustomerNotification($notifyCustomer));
            $user->notifications()->where('created_at', '<', now()->subDays(7))->delete();
        }

        //return view
        return redirect()->route('marketing.customer.index')->with('success','Customer created successfully!');
    }

    public function edit(Customer $customer){
        // authorization
        Gate::authorize("update", $customer);
        $counties = Country::all();
        //return view
        return view('marketing.customer.edit', compact('customer','counties'));
    }

    public function update(Customer $customer){
        // authorization
        Gate::authorize("update", $customer);

        //capitalize
        request()->merge([
            'first_name' => ucfirst(strtolower(request()->input('first_name'))),
            'last_name' => ucfirst(strtolower(request()->input('last_name'))),
        ]);

        //validation
        $validateData = request()->validate([
            'first_name' => ['required','string','max:255'],
            'last_name' => ['required','string','max:255'],
            'email' => ['required','email','lowercase',Rule::unique('customers', 'email')->ignore($customer->id)],
            'number' => ['required','numeric','digits:10',Rule::unique('customers', 'number')->ignore($customer->id)],
            'address' => ['required', 'string', 'min:10', 'max:255', 'regex:#^[a-zA-Z0-9\s,.\-\/]+$#'],
            'country_id' => ['required','exists:countries,id'],
        ],[
            'country_id.required' => 'Please select a valid country.',
            ]);

        //update user
        $customer->fill($validateData);
        if ($customer->isDirty()) {
            $customer->save();
            return redirect()->route('marketing.customer.show', $customer)->with('success','Customer updated successfully!');
        }

        //return view
        return redirect()->back();

    }

    public function destroy(Customer $customer){
        Gate::authorize("update", $customer);

        if($customer->status == 'active'){
            $customer->update([
                'status' => 'inactive'
            ]);
        } elseif($customer->status == 'inactive'){
            $customer->update([
                'status' => 'active'
            ]);
        }

        return redirect()->route('marketing.customer.index')->with('success','Customer status updated!');
    }


}
