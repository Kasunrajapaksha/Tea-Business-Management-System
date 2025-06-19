<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notifiable;

class MaterialPurchase extends Model
{
    use HasFactory, Notifiable;
    protected $guarded = [];


    public function supplier(){
        return $this->belongsTo(Supplier::class);
    }

    public function material(){
        return $this->belongsTo(Material::class);
    }

    public function payment_request(){
        return $this->belongsTo(PaymentRequest::class);
    }

    public function user(){
        return $this->belongsTo(User::class);
    }

    public function inventory_transaction(){
        return $this->hasMany(InventoryTransaction::class);
    }
}
