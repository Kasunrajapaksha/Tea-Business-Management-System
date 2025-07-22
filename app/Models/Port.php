<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notifiable;

class Port extends Model
{
    use HasFactory, Notifiable;
    protected $guarded = [];

    public function vessel(){
        return $this->belongsToMany(Vessel::class, 'vessel_ports');
    }
}
