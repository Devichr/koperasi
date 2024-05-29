<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Payment extends Model
{
    use HasFactory;

    protected $fillable = [
        'loan_id', 'amount', 'member_id', 'noted_by', 'payment_date'
    ];

    public function loan()
    {
        return $this->belongsTo(Loan::class);
    }

    public function member()
    {
        return $this->belongsTo(User::class, 'member_id');
    }

    public function noter()
    {
        return $this->belongsTo(User::class, 'noted_by');
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
