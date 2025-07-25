<?php

namespace App\Http\Controllers\Shipping;

use App\Http\Controllers\Controller;
use App\Models\ShippingProvider;
use App\Models\User;
use App\Notifications\AddNewShippingProviderNotification;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Gate;
use Illuminate\Validation\Rule;

class ShippingProviderController extends Controller
{

    public function index(){
        Gate::authorize('view',ShippingProvider::class);
        $providers = ShippingProvider::latest()->paginate(8);
        return view('shipping.provider.index',compact('providers'));
    }

    public function create(){
        Gate::authorize('create',ShippingProvider::class);
        return view('shipping.provider.create');
    }

    public function store(){
        Gate::authorize('create',ShippingProvider::class);
        $validatedata = request()->validate([
            'user_id' => ['exists:users,id'],
            'provider_name' => ['required','string','max:255','unique:shipping_providers,provider_name'],
            'tracking_number' => ['required','string','max:255','unique:shipping_providers,tracking_number'],
            'email' => ['required','email','lowercase','unique:shipping_providers,email'],
            'number' => ['required','numeric','digits:10','unique:shipping_providers,number'],
        ]);

        $provider = ShippingProvider::create($validatedata);

        $provider->update([
            "provider_no"=> 'CUS'.
            str_pad($provider->user_id,2,'0', STR_PAD_LEFT)  .
            str_pad($provider->user->role->id,2,'0', STR_PAD_LEFT) .
            str_pad($provider->id,4,'0', STR_PAD_LEFT),
        ]);

        $notifyProvider = ShippingProvider::findOrFail($provider->id);
        $users = User::whereHas('department', function($query){
            $query->whereIn('department_name',['Admin','Management']);
        })->get();
        foreach ($users as $key => $user) {
            $user->notify(new AddNewShippingProviderNotification($notifyProvider));
            $user->notifications()->where('created_at', '<', now()->subDays(7))->delete();
        }

        return redirect()->route('shipping.provider.index')->with('success','A Shipping Provider added successfully!');
    }

    public function show(ShippingProvider $provider){
        Gate::authorize('view',ShippingProvider::class);
        return view('shipping.provider.show', compact('provider'));
    }

    public function edit(ShippingProvider $provider){
        Gate::authorize('update',ShippingProvider::class);
        return view('shipping.provider.edit', compact('provider'));
    }

    public function update(ShippingProvider $provider){
        Gate::authorize('update',ShippingProvider::class);
        $validatedata = request()->validate([
            'provider_name' => ['required','string','max:255', Rule::unique('shipping_providers')->ignore($provider->id )],
            'tracking_number' => ['required','string','max:255', Rule::unique('shipping_providers')->ignore($provider->id )],
            'email' => ['required','email','lowercase', Rule::unique('shipping_providers')->ignore($provider->id )],
            'number' => ['required','numeric','digits:10', Rule::unique('shipping_providers')->ignore($provider->id )],
        ]);


        $provider->fill($validatedata);
        if ($provider->isDirty()) {
            $provider->save();
            return redirect()->route('shipping.provider.show', $provider)->with('success', 'Shipping provider updated successfully!');
        }

        return redirect()->back();
    }


    public function destroy(ShippingProvider $provider){
        Gate::authorize('update',$provider);

        if($provider->status == 'active'){
            $provider->update([
                'status' => 'inactive'
            ]);
        } elseif($provider->status == 'inactive'){
            $provider->update([
                'status' => 'active'
            ]);
        }

        return redirect()->route('shipping.provider.index')->with('success', 'Shipping provider status updated!');
    }
}
