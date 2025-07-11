<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notifiable;

class Material extends Model
{
    use HasFactory, Notifiable;
    protected $guarded = [];

    public function user(){
        return $this->belongsTo(User::class);
    }

    public function material_perchese(){
        return $this->hasMany(MaterialPurchase::class);
    }

    public function inventory_transaction(){
        return $this->hasMany(InventoryTransaction::class);
    }

    public function productionMaterial(){
        return $this->hasMany(ProductionMaterial::class);
    }
}
