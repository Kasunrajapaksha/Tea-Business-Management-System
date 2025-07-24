<?php

namespace App\Http\Controllers\Shipping;

use App\Http\Controllers\Controller;
use App\Models\Country;
use App\Models\Port;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;

class ShippingPortsController extends Controller
{
    public function index(){
        $ports = Port::latest()->paginate(20);
        return view('shipping.port.index', compact('ports'));
    }

    public function create(){
        $counties = Country::all();
        return view('shipping.port.create',compact('counties'));
    }

    public function show(Port $port){
        return view('shipping.port.show',compact('port'));
    }

    public function edit(Port $port){
        $counties = Country::all();
        return view('shipping.port.edit',compact('port','counties'));
    }

    public function store(){
        $validateData = request()->validate([
            'port_name' => ['required', 'string', 'unique:ports,port_name'],
            'country_id' => ['exists:countries,id'],
        ]);

        $port = Port::create($validateData);

        return redirect()->route('shipping.port.show',$port)->with('success','Port added!');
    }

    public function update(Port $port){
        $validateData = request()->validate([
            'port_name' => ['required', 'string', Rule::unique('ports', 'port_name')->ignore($port->id)],
            'country_id' => ['exists:countries,id'],
        ]);

        $port->update($validateData);

        return redirect()->route('shipping.port.show',$port)->with('success','Port updated!');
    }

}
