<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notifiable;

class Vessel extends Model
{
    use HasFactory, Notifiable;
    protected $guarded = [];

    public function port(){
        return $this->belongsToMany(Port::class,'vessel_ports');
    }

    public function shippingSchadule(){
        return $this->hasMany(ShippingSchedule::class,'vessel_ports');
    }
}
