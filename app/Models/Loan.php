<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Loan extends Model
{
    use HasFactory;

    protected $fillable = [
        'amount', 'status', 'member_id', 'verified_by', 'approved_by'
    ];

    public function member()
    {
        return $this->belongsTo(User::class, 'member_id');
    }

    public function verifier()
    {
        return $this->belongsTo(User::class, 'verified_by');
    }

    public function approver()
    {
        return $this->belongsTo(User::class, 'approved_by');
    }

    public function payments()
    {
        return $this->hasMany(Payment::class);
    }

    public function archive()
    {
        return $this->hasOne(Archive::class);
    }

    public function report()
    {
        return $this->hasOne(Report::class);
    }
}
