<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable
{
    use HasFactory, Notifiable;

    protected $fillable = [
        'name','username', 'email', 'phone_number', 'password', 'role', 'address'   ];

    protected $hidden = [
        'password', 'remember_token',
    ];

    public function loans()
    {
        return $this->hasMany(Loan::class, 'memberId');
    }

    public function verifiedLoans()
    {
        return $this->hasMany(Loan::class, 'verified_by');
    }

    public function approvedLoans()
    {
        return $this->hasMany(Loan::class, 'approved_by');
    }

    public function payments()
    {
        return $this->hasMany(Payment::class, 'memberId');
    }

    public function notedPayments()
    {
        return $this->hasMany(Payment::class, 'noted_by');
    }

    public function setPasswordAttribute($value)
    {
        $this->attributes['password'] = bcrypt($value);
    }
}
