<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notifiable;

class Tea extends Model
{
    use HasFactory, Notifiable;
    protected $guarded = [];

    public function user(){
        return $this->belongsTo(User::class);
    }

    public function tea_perchese(){
        return $this->hasMany(TeaPurchase::class);
    }

    public function inventory_transaction(){
        return $this->hasMany(InventoryTransaction::class);
    }

    public function orderItem(){
        return $this->hasOne(OrderItem::class);
    }


}
