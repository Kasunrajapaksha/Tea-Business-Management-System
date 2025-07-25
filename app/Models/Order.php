<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notifiable;

class Order extends Model
{
    use HasFactory, Notifiable;
    protected $guarded = [];

    protected $casts = [
        'order_date' => 'datetime',
    ];

    public function customer(){
        return $this->belongsTo(Customer::class);
    }

    public function user(){
        return $this->belongsTo(User::class);
    }

    public function orderItem(){
        return $this->hasOne(OrderItem::class);
    }

    public function productionPlan(){
        return $this->hasOne(ProductionPlan::class);
    }

    public function productionMaterial(){
        return $this->hasMany(ProductionMaterial::class);
    }

    public function shippingSchedule(){
        return $this->hasOne(ShippingSchedule::class);
    }

    public function proformaInvoice(){
    return $this->belongsToMany(ProformaInvoice::class, 'order_proforma_invoice');
    }

    public function commercialInvoice(){
        return $this->belongsToMany(CommercialInvoice::class,'commercial_invoice_order');
    }
}
