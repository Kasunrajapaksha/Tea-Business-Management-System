<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notifiable;

class PaymentRequest extends Model
{
    use HasFactory, Notifiable;
    protected $guarded = [];


    public function supplier(){
        return $this->belongsTo(Supplier::class);
    }

    public function tea_perchese(){
        return $this->hasOne(TeaPurchase::class);
    }

    public function material_perchese(){
        return $this->hasOne(MaterialPurchase::class);
    }

    public function requester(){
        return $this->belongsTo(User::class,'requester_id');
    }

    public function handler(){
        return $this->belongsTo(User::class,'handler_id');
    }

    public function supplier_payment(){
        return $this->hasOne(SupplierPayment::class);
    }
}
