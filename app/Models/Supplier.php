<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notifiable;

class Supplier extends Model
{
    use HasFactory, Notifiable;
    protected $guarded = [];

    public function user(){
        return $this->belongsTo(User::class);
    }

    public function payment_request(){
        return $this->hasMany(PaymentRequest::class);
    }

    public function tea_perchese(){
        return $this->hasMany(TeaPurchase::class);
    }

    public function material_perchese(){
        return $this->hasMany(MaterialPurchase::class);
    }

    public function supplier_payment(){
        return $this->hasMany(SupplierPayment::class);
    }
}
