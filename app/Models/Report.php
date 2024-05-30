<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Report extends Model
{
    use HasFactory;

    protected $fillable = [
        'loan_id', 'payment_id', 'memberId', 'report_date'
    ];

    public function loan()
    {
        return $this->belongsTo(Loan::class);
    }

    public function payment()
    {
        return $this->belongsTo(Payment::class);
    }

    public function member()
    {
        return $this->belongsTo(User::class, 'memberId');
    }
}
