<?php

namespace App\Http\Controllers\Shipping;

use App\Http\Controllers\Controller;
use App\Models\Port;
use App\Models\ShippingProvider;
use App\Models\Vessel;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;

class ShippingVesselController extends Controller
{
    public function index(){
        $vessels = Vessel::paginate(5);

        return view('shipping.vessel.index',compact(['vessels']));
    }

    public function create(){
        $providers = ShippingProvider::where('status','active')->get();
        $ports = Port::all();
        return view('shipping.vessel.create', compact(['providers','ports']));
    }

    public function show(Vessel $vessel){
        $ports = Port::all();
        return view('shipping.vessel.show',compact(['vessel','ports']));
    }

    public function edit(Vessel $vessel){
        $ports = Port::all();
        return view('shipping.vessel.edit',compact(['vessel','ports']));
    }

    public function store(){
        $validated = request()->validate([
            'vessel_name' => 'required|string|max:255|unique:vessels,vessel_name',
            'tracking_number' => 'required|string|regex:/^IMO \d{7}$/',
            'ports' => 'required|array|min:1',
            'ports.*' => 'exists:ports,id'
        ]);

        $vessel = Vessel::create([
            'vessel_name' => $validated['vessel_name'],
            'tracking_number' => $validated['tracking_number'],
        ]);

        $vessel->port()->sync($validated['ports']);

        return redirect()->route('shipping.vessel.show', $vessel)->with('success','Vessel added!');
    }


    public function update(Vessel $vessel){
        $validated = request()->validate([
            'vessel_name' => ['required','string','max:255', Rule::unique('vessels', 'vessel_name')->ignore($vessel->id)],
            'tracking_number' => 'required|string|regex:/^IMO \d{7}$/',
            'ports' => 'required|array|min:1',
            'ports.*' => 'exists:ports,id'
        ]);

        $vessel->update([
            'vessel_name' => $validated['vessel_name'],
            'tracking_number' => $validated['tracking_number'],
        ]);

        $vessel->port()->sync($validated['ports']);

        return redirect()->route('shipping.vessel.show',$vessel)->with('success','Vessel updated!');
    }


}
