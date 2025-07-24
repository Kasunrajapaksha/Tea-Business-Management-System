<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notifiable;

class CommercialInvoice extends Model
{
    use HasFactory, Notifiable;
    protected $guarded = [];

    public function order(){
        return $this->belongsToMany(Order::class,'commercial_invoice_order');
    }

    public function user(){
        return $this->belongsTo(User::class);
    }

    public function shippingDocument(){
        return $this->hasOne(ShippingDocument::class);
    }

}
