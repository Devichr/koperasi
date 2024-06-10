<?php

namespace App\Http\Controllers;

use App\Models\Loan;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
class ChairLoanController extends Controller
{
    public function index()
    {
        $loans = Loan::with('member')->where('status', 'submitted')->get();
        return view('chair.loans.index', compact('loans'));
    }

    public function approve(Loan $loan)
    {
        $loan->update(['status' => 'approved',
        'verifiedBy'=> Auth::id(),
    ]);
        return redirect()->route('chair.loans.index')->with('success', 'Pinjaman berhasil diterima.');
    }
    public function reject(Loan $loan)
    {
        $loan->update(['status' => 'rejected']);
        return redirect()->route('chair.loans.index')->with('success', 'Pinjaman ditolak.');
    }
}
