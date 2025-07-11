<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notifiable;

class ProductionMaterial extends Model
{
    use HasFactory, Notifiable;
    protected $guarded = [];

    public function order(){
        return $this->belongsTo(Order::class);
    }

    public function material(){
        return $this->belongsTo(Material::class);
    }

    public function user(){
        return $this->belongsTo(User::class);
    }
}
