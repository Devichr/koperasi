<?php

namespace App\Http\Controllers;

use App\Models\Loan;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
class ChairLoanController extends Controller
{
    public function index()
    {
        $loans = Loan::where('status', 'submitted')->get();
        return view('chair.loans.index', compact('loans'));
    }

    public function approve(Loan $loan)
    {
        $loan->update(['status' => 'approved',
        'verifiedBy'=> Auth::id(),
    ]);
        return redirect()->route('chair.loans.index')->with('success', 'Loan approved.');
    }
}
