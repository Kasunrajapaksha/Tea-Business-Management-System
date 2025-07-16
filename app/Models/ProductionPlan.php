<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notifiable;

class ProductionPlan extends Model
{
    use HasFactory, Notifiable;
    protected $guarded = [];

    public function order(){
        return $this->belongsTo(Order::class);
    }

    public function user(){
        return $this->belongsTo(User::class);
    }

    public function inventory_transaction(){
        return $this->hasMany(InventoryTransaction::class);
    }
}
