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
        'name', 'username', 'email', 'password', 'nik', 'no_rekening', 'pekerjaan', 'gaji_perbulan', 'role','golongan', 'ktp', 'kk', 'slip_gaji'
        ];

    protected $hidden = [
        'password', 'remember_token',
    ];

     /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
        'gaji_perbulan' => 'decimal:2',
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
