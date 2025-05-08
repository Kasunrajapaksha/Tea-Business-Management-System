<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Role extends Model{
    use HasFactory;
    protected $guarded = [];

    public function user(){
        return $this->hasMany(User::class);
    }

    public function department(){
        return $this->belongsTo(Department::class);
    }

    public function permissions(){
        return $this->belongsToMany(Permission::class, 'role_permissions');
    }

    protected static function booted()
    {
        static::updating(function($role){
            if($role->status == 0){
                $role->user()->update(['status' => 0]);
            }
        });
    }

}
