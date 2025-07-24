<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notifiable;

class ShippingDocument extends Model
{
    use HasFactory, Notifiable;
    protected $guarded = [];
    

    public function commercialInvoice(){
        return $this->belongsTo(CommercialInvoice::class);
    }

    public function user(){
        return $this->belongsTo(User::class);
    }
}
