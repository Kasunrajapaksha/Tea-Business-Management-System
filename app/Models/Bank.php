<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notifiable;

class Bank extends Model
{
    use HasFactory, Notifiable;
    protected $guarded = [];

    public function supplier(){
        return $this->hasMany(Supplier::class);
    }
}
