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
        'username', 'password', 'role'
    ];

    protected $hidden = [
        'password', 'remember_token',
    ];

    public function loans()
    {
        return $this->hasMany(Loan::class, 'member_id');
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
        return $this->hasMany(Payment::class, 'member_id');
    }

    public function notedPayments()
    {
        return $this->hasMany(Payment::class, 'noted_by');
    }
}
