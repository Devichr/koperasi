<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Loan;
use Illuminate\Support\Facades\Auth;

class LoanController extends Controller
{
    public function create()
    {
        return view('loans.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'amount' => 'required|numeric|min:0.01',
        ]);

        Loan::create([
            'user_id' => Auth::id(),
            'amount' => $request->amount,
            'status' => 'pending',
        ]);

        return redirect()->route('loans.create')->with('success', 'Loan request created successfully.');
    }
}
