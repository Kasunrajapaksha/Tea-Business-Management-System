<?php

namespace App\Http\Controllers\Warehouse;

use App\Http\Controllers\Controller;
use App\Models\InventoryTransaction;
use Illuminate\Http\Request;

class WarehouseController extends Controller{

    public function index(){
        return view('warehouse.dashboard');
    }
}
