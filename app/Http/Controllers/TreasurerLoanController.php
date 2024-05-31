<?php

namespace App\Http\Controllers;

use App\Models\Loan;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class TreasurerLoanController extends Controller
{
    public function index()
    {
        $loans = Loan::with('member')->where('status', 'pending')->get();
        return view('treasurer.loans.index', compact('loans'));
    }

    public function submitToChair(Loan $loan)
    {
        $loan->update([
            'status' => 'submitted',
            'verifiedBy'=> Auth::id(),
    ]);
        return redirect()->route('treasurer.loans.index')->with('success', 'Loan submitted to chair.');
    }
    
    public function reject(Loan $loan)
    {
        $loan->update(['status' => 'rejected']);
        return redirect()->route('treasurer.loans.index')->with('success', 'Loan rejected.');
    }
}
