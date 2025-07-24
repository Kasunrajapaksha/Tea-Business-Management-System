<?php

namespace App\Http\Controllers\Shipping;

use App\Http\Controllers\Controller;
use App\Models\CommercialInvoice;
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

use function Ramsey\Uuid\v1;

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
        $departurePorts = Port::where('port_name','LIKE','%Sri Lanka%')->get();
        $providers = ShippingProvider::all();
        return view('shipping.schedule.create', compact(['order','departurePorts']));
    }


    public function store(){
        Gate::authorize('create', ShippingSchedule::class);

        $validateData = request()->validate([
            'departure_date' => ['required','date_format:Y-m-d','after_or_equal:today'],
            'arrival_date' => ['required','date_format:Y-m-d','after:departure_date'],
            'departure_port' => ['required', 'exists:ports,port_name'],
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
        $departurePorts = Port::where('port_name','LIKE','%Sri Lanka%')->get();
        $providers = ShippingProvider::all();

        return view('shipping.schedule.edit',compact(['schedule','departurePorts']));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(ShippingSchedule $schedule){
        Gate::authorize('update', $schedule);
        $validateData = request()->validate([
            'departure_date' => ['required','date_format:Y-m-d','after_or_equal:today'],
            'arrival_date' => ['required','date_format:Y-m-d','after:departure_date'],
            'departure_port' => ['required', 'exists:ports,port_name'],
            'user_id' => ['exists:users,id'],
        ]);

        $schedule->fill($validateData);

        if ($schedule->isDirty()) {
            $schedule->save();
            return redirect()->route('shipping.schedule.show', $schedule)->with('success','Shipping schedule updated successfully!');
        }

        return redirect()->route('shipping.schedule.edit', $schedule);

    }

    public function getPortsByVessel(Request $request){
        $validated = $request->validate([
            'vessel_id' => 'required|exists:vessels,id'
        ]);
        $vessel = Vessel::findOrFail($validated['vessel_id']);
        $ports = $vessel->port->map(function ($port) {
            return [
                'id' => $port->id,
                'port_name' => $port->port_name,
            ];
        });

        return response()->json($ports);
    }




}
