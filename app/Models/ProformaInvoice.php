<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notifiable;

class ProformaInvoice extends Model
{
    use HasFactory, Notifiable;
    protected $guarded = [];

    public function order(){
    return $this->belongsToMany(Order::class, 'order_proforma_invoice');
    }

    public function user(){
        return $this->belongsTo(User::class);
    }

    public function customerPayment(){
        return $this->hasOne(CustomerPayment::class);
    }
}
