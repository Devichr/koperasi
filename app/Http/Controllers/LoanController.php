<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Loan;
use Illuminate\Support\Facades\Auth;

class LoanController extends Controller
{
    public function create()
    {
        $user = Auth::user();
        
        // Cek apakah profil pengguna lengkap jika tidak lengkap maka akan diarahkan ke halaman profile edit
        if (empty($user->address) || empty($user->phone_number)) {
            return redirect()->route('profile.edit')->with('error', 'Please complete your profile before applying for a loan.');
        }

        return view('loans.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'amount' => 'required|numeric|min:0.01',
        ]);

        Loan::create([
            'memberId' => Auth::id(),
            'amount' => $request->amount,
            'status' => 'pending',
        ]);

        return redirect()->route('loans.create')->with('success', 'Loan request created successfully.');
    }
}
