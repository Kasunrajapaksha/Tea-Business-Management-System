<?php

namespace App\Http\Controllers\Shipping;

use App\Http\Controllers\Controller;
use App\Models\Order;
use App\Models\Port;
use App\Models\ShippingProvider;
use App\Models\ShippingSchedule;
use App\Models\User;
use App\Models\Vessel;
use App\Notifications\OrderDeliveredNotification;
use App\Notifications\ReadyToShipNotification;
use App\Notifications\ShippedToCustomerNotification;
use App\Notifications\UpdateShippingScheduleNotification;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
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
        $vessels = Vessel::all();
        $ports = Port::all();
        $departurePorts = Port::where('port_name','LIKE','%Sri Lanka%')->get();
        $providers = ShippingProvider::all();
        return view('shipping.schedule.create', compact('order',['providers','ports','vessels','departurePorts']));
    }


    public function store(){
        Gate::authorize('create', ShippingSchedule::class);

        $validateData = request()->validate([
            'departure_date' => ['required','date_format:Y-m-d','after_or_equal:today'],
            'shipping_provider_id' => ['exists:shipping_providers,id'],
            'arrival_date' => ['required','date_format:Y-m-d','after:departure_date'],
            'vessel_id' => ['required', 'exists:vessels,id'],
            'departure_port' => ['required', 'exists:ports,port_name'],
            'arrival_port' => ['required', 'exists:ports,port_name'],
            'user_id' => ['exists:users,id'],
            'order_id' => ['exists:orders,id'],
        ]);

        $order = Order::findOrFail($validateData['order_id']);
        $order->update([
            'status' => 13  // Shipping Scheduled
        ]);

        ShippingSchedule::create($validateData);

        $users = User::whereHas('department', function($query){
        $query->whereIn('department_name',['Admin','Management','Marketing']);
        })->get();
        foreach ($users as $key => $user) {
            $user->notify(new UpdateShippingScheduleNotification($order));
            $user->notifications()->where('created_at', '<', now()->subDays(7))->delete();
        }

        return redirect()->route('order.show', $validateData['order_id'])->with('success','Shipping schedule updated successfully!');

    }


    public function show(ShippingSchedule $schedule){
        Gate::authorize('view', ShippingSchedule::class);
        return view('shipping.schedule.show',compact('schedule'));
    }


    public function edit(ShippingSchedule $schedule){
        Gate::authorize('update', $schedule);

        $vessels = Vessel::all();
        $ports = Port::all();
        $departurePorts = Port::where('port_name','LIKE','%Sri Lanka%')->get();
        $providers = ShippingProvider::all();

        return view('shipping.schedule.edit',compact('schedule',['providers','ports','vessels','departurePorts']));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(ShippingSchedule $schedule){
        Gate::authorize('update', $schedule);
        $validateData = request()->validate([
            'departure_date' => ['required','date_format:Y-m-d','after_or_equal:today'],
            'shipping_provider_id' => ['exists:shipping_providers,id'],
            'arrival_date' => ['required','date_format:Y-m-d','after:departure_date'],
            'vessel_id' => ['required', 'exists:vessels,id'],
            'departure_port' => ['required', 'exists:ports,port_name'],
            'arrival_port' => ['required', 'exists:ports,port_name'],
            'user_id' => ['exists:users,id'],
            'order_id' => ['exists:orders,id'],

            'shipping_cost' => ['nullable','numeric', 'min:0'],
            'shipping_note' => ['nullable','string'],
            'tracking_number' => ['nullable','string'],

        ]);

        $schedule->fill($validateData);

        if ($schedule->isDirty()) {
            $schedule->save();
            return redirect()->route('shipping.schedule.show', $schedule)->with('success','Shipping schedule updated successfully!');
        }

        return redirect()->route('shipping.schedule.edit', $schedule);

    }

    public function updateStatus(ShippingSchedule $schedule){
        Gate::authorize('update', $schedule);

        $order = Order::findOrFail($schedule->order->id);

        if($schedule->order->status == 17){
            $order->update([
                'status' => 18 //Shipped to Customer
            ]);

            $users = User::whereHas('department', function($query){
                $query->whereIn('department_name',['Admin','Management','Marketing']);
            })->get();
            foreach ($users as $key => $user) {
                $user->notify(new ReadyToShipNotification($schedule));
                $user->notifications()->where('created_at', '<', now()->subDays(7))->delete();
            }

        } elseif ($schedule->order->status == 18){

            $order->update([
                'status' => 19 //Shipped to Customer
            ]);

            $schedule->update([
                'actual_departure_date' => now()->format('Y-m-d'),
                'user_id' => Auth::user()->id,
            ]);

            $users = User::whereHas('department', function($query){
                $query->whereIn('department_name',['Admin','Management','Marketing']);
            })->get();
            foreach ($users as $key => $user) {
                $user->notify(new ShippedToCustomerNotification($schedule));
                $user->notifications()->where('created_at', '<', now()->subDays(7))->delete();
            }

        } elseif($schedule->order->status == 19){
            $order->update([
                'status' => 20 //Order Delivered
            ]);

            $schedule->update([
                'actual_arrival_date' => now()->format('Y-m-d'),
                'user_id' => Auth::user()->id,
            ]);

            $users = User::whereHas('department', function($query){
                $query->whereIn('department_name',['Admin','Management','Marketing']);
            })->get();
            foreach ($users as $key => $user) {
                $user->notify(new OrderDeliveredNotification($schedule));
                $user->notifications()->where('created_at', '<', now()->subDays(7))->delete();
            }

        }

        return redirect()->route('shipping.schedule.show', $schedule)->with('success','Shipping schedule updated successfully!');
    }

public function getPortsByVessel(Request $request)
{
    // Validate the vessel_id to ensure it's provided
    $validated = $request->validate([
        'vessel_id' => 'required|exists:vessels,id'  // Validate the vessel_id
    ]);

    // Find the vessel by ID
    $vessel = Vessel::findOrFail($validated['vessel_id']); // If no vessel found, will throw 404

    // Get associated ports for the vessel
    $ports = $vessel->port->map(function ($port) {
        return [
            'id' => $port->id,
            'port_name' => $port->port_name,
        ];
    });

    // Return the data as JSON
    return response()->json($ports);
}




}
