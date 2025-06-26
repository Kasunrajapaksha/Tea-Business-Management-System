<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notifiable;

class OrderItem extends Model
{
    use HasFactory, Notifiable;
    protected $guarded = [];

    public function order(){
        return $this->belongsTo(Order::class);
    }

    public function tea(){
        return $this->belongsTo(Tea::class);
    }
}
