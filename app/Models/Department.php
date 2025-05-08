<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Department extends Model{
    use HasFactory;
    protected $guarded = [];

    public function user(){
        return $this->hasMany(User::class);
    }

    public function role(){
        return $this->hasMany(Role::class);
    }

    protected static function booted()
    {
        static::updating(function ($department) {
            if ($department->status == 0) {
                $department->user()->update(['status' => 0]);
                $department->role()->update(['status' => 0]);
            }
        });
    }
}
