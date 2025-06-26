<?php

namespace App\Http\Controllers\Order;

use App\Http\Controllers\Controller;
use App\Models\Customer;
use App\Models\InventoryTransaction;
use App\Models\Order;
use App\Models\OrderItem;
use App\Models\Tea;
use App\Models\User;
use App\Notifications\AddNewOrderNotification;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Gate;
use Illuminate\Validation\ValidationException;

class OrderController extends Controller
{
    public function index(){
        Gate::authorize('view', Order::class);
        $orders = Order::latest()->paginate(8);
        return view('order.index', compact('orders'));
    }

    public function create(Customer $customer){
        Gate::authorize('create', Order::class);
        $teas = Tea::all();
        return view('order.create', compact('customer','teas'));
    }

    public function store(){
        //authorize
        Gate::authorize('update', Order::class);

        //validate
        $validateData = request()->validate([
            'user_id' => ['exists:users,id'],
            'customer_id' => ['exists:customers,id'],
            'order_item' => ['exists:teas,id'],
            'quantity' => ['required','numeric',],
        ]);
        $tea = Tea::findOrFail($validateData['order_item']);
        if($tea->stock_level < $validateData['quantity']){
            throw ValidationException::withMessages(
                ['quantity'=>'Sorry, there is insufficient stock to create the order.']);
        }

        //create order , order item & tea stock
        $order = Order::create([
            'user_id' => $validateData['user_id'],
            'customer_id' => $validateData['customer_id'],
            'total_amount' => $validateData['quantity'] * $tea->price_per_Kg,
            'order_date' => now()->format('Y-m-d'),
        ]);
        $orderItem = OrderItem::create([
            'order_id' => $order->id,
            'tea_id' => $validateData['order_item'],
            'quantity' => $validateData['quantity'],
        ]);
        $order->update([
            "order_no"=> 'ORD'.
            str_pad($order->user_id,2,'0', STR_PAD_LEFT)  .
            str_pad($order->id,2,'0', STR_PAD_LEFT) .
            str_pad($orderItem->id,4,'0', STR_PAD_LEFT),
        ]);
        $tea->update([
            'stock_level' => $tea->stock_level - $validateData['quantity'],
        ]);

        //create inventory transaction


        //send notification
        $users = User::whereHas('department', function($query){
            $query->whereIn('department_name',['Admin','Management','Shipping','Finance','Production','Tea']);
        })->get();
        foreach ($users as $key => $user) {
            $user->notify(new AddNewOrderNotification($order));
            $user->notifications()->where('created_at', '<', now()->subDays(30))->delete();
        }

        //redirect
        return redirect()->route('order.index')->with('success','Order created successfully!');
    }

        public function show(Order $order){
            Gate::authorize('view', Order::class);

            return view('order.show', compact('order'));
        }
}
