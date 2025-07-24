<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notifiable;

class Country extends Model
{
    use HasFactory, Notifiable;
    protected $guarded = [];

    public function customer(){
        return $this->hasMany(Customer::class);
    }

    public function port(){
        return $this->hasMany(Port::class);
    }
}
