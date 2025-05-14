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

    public function supplier(){
        return $this->HasMany(Supplier::class);
    }

    public function tea(){
        return $this->HasMany(tea::class);
    }

    public function material(){
        return $this->HasMany(Material::class);
    }

    public function payment_request(){
        return $this->HasMany(PaymentRequest::class);
    }

    public function tea_perchese(){
        return $this->HasMany(TeaPurchase::class);
    }

    public function supplier_payment(){
        return $this->HasMany(SupplierPayment::class);
    }



    protected function casts(): array
    {
        return [
            'email_verified_at' => 'datetime',
            'password' => 'hashed',
        ];
    }
}
