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

    public function user(){
        return $this->belongsTo(User::class);
    }
}
