<?php

namespace App\Http\Controllers\Shipping;

use App\Http\Controllers\Controller;
use App\Models\Port;
use Illuminate\Http\Request;

class ShippingPortsController extends Controller
{
    public function index(){
        $ports = Port::latest()->paginate(5);
        return view('shipping.port.index', compact('ports'));
    }

    public function create(){
        return view('shipping.port.create');
    }

    public function show(Port $port){
        return view('shipping.port.show',compact('port'));
    }

    public function edit(Port $port){
        return view('shipping.port.edit',compact('port'));
    }

    public function store(){
        $validateData = request()->validate([
            'port_name' => ['required', 'string', 'unique:ports,port_name'],
        ]);

        $port = Port::create($validateData);

        return redirect()->route('shipping.port.show',$port)->with('success','Port added!');
    }

    public function update(Port $port){
        $validateData = request()->validate([
            'port_name' => ['required', 'string', 'unique:ports,port_name'],
        ]);

        $port->update($validateData);

        return redirect()->route('shipping.port.show',$port)->with('success','Port updated!');
    }

}
