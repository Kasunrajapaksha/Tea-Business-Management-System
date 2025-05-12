<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Contracts\Auth\CanResetPassword;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable implements CanResetPassword {
    use HasFactory, Notifiable;
    protected $guarded = [];
    protected $hidden = [
        'password',
        'remember_token',
    ];

    public function department(){
        return $this->belongsTo(Department::class);
    }

    public function role(){
        return $this->belongsTo(Role::class);
    }

    public function customer(){
        return $this->HasMany(Customer::class);
    }



    protected function casts(): array
    {
        return [
            'email_verified_at' => 'datetime',
            'password' => 'hashed',
        ];
    }
}
