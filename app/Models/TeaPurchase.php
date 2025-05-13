<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notifiable;

class TeaPurchase extends Model
{
    use HasFactory, Notifiable;
    protected $guarded = [];


    public function supplier(){
        return $this->belongsTo(Supplier::class);
    }

    public function tea(){
        return $this->belongsTo(Tea::class);
    }

    public function payment_request(){
        return $this->belongsTo(PaymentRequest::class);
    }

    public function user(){
        return $this->belongsTo(User::class);
    }


}
