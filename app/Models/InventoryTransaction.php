<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notifiable;

class InventoryTransaction extends Model
{
    use HasFactory, Notifiable;
    protected $guarded = [];
    public function user(){
        return $this->belongsTo(User::class);
    }

    public function tea(){
        return $this->belongsTo(Tea::class);
    }

    public function material(){
        return $this->belongsTo(Material::class);
    }

    public function tea_purchase(){
        return $this->belongsTo(TeaPurchase::class);
    }

    public function material_purchase(){
        return $this->belongsTo(MaterialPurchase::class);
    }

    public function supplier(){
        return $this->belongsTo(Supplier::class);
    }
}
