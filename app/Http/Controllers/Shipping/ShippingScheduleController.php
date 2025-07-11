<?php

namespace App\Http\Controllers\Shipping;

use App\Http\Controllers\Controller;
use App\Models\Order;
use App\Models\ShippingProvider;
use App\Models\ShippingSchedule;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Gate;

class ShippingScheduleController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(){
        Gate::authorize('view', ShippingSchedule::class);
        $schedules = ShippingSchedule::latest()->paginate(8);
        return view('shipping.schedule.index', compact('schedules'));
    }


    public function create(Order $order){
        Gate::authorize('create', ShippingSchedule::class);

        if($order->status != 12 ){
            abort(404);
        }

        $providers = ShippingProvider::all();
        return view('shipping.schedule.create', compact('order','providers'));
    }


    public function store(){
        Gate::authorize('create', ShippingSchedule::class);

        $validateData = request()->validate([
            'departure_date' => ['required','date_format:Y-m-d'],
            'shipping_provider_id' => ['exists:shipping_providers,id'],
            'arrival_date' => ['required','date_format:Y-m-d'],
            'vessel_name' => ['required'],
            'departure_port' => ['required'],
            'arrival_port' => ['required'],
            'user_id' => ['exists:users,id'],
            'order_id' => ['exists:orders,id'],
        ]);

        $order = Order::findOrFail($validateData['order_id']);
        $order->update([
            'status' => 13  // Shipping Scheduled
        ]);

        ShippingSchedule::create($validateData);

        return redirect()->route('order.show', $validateData['order_id'])->with('success','Shipping schedule updated successfully!');

    }


    public function show(ShippingSchedule $schedule){
        Gate::authorize('view', ShippingSchedule::class);
        return view('shipping.schedule.show',compact('schedule'));
    }


    public function edit(ShippingSchedule $schedule){
        Gate::authorize('update', $schedule);
        $providers = ShippingProvider::all();
        return view('shipping.schedule.edit',compact('schedule','providers'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(ShippingSchedule $schedule){
        Gate::authorize('update', $schedule);
        $validateData = request()->validate([
            'departure_date' => ['required','date_format:Y-m-d'],
            'shipping_provider_id' => ['exists:shipping_providers,id'],
            'arrival_date' => ['required','date_format:Y-m-d'],
            'vessel_name' => ['required'],
            'departure_port' => ['required'],
            'arrival_port' => ['required'],
            'user_id' => ['exists:users,id'],
            'shipping_cost' => ['required','numeric'],
            'shipping_note' => ['required'],
        ]);

        $schedule->update($validateData);

        return redirect()->route('shipping.schedule.show', $schedule)->with('success','Shipping schedule updated successfully!');

    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(ShippingSchedule $shippingSchedule)
    {
        //
    }
}
