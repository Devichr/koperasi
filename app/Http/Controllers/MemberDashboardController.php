<?php

// App\Http\Controllers\MemberDashboardController.php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Loan;
// use App\Models\Saving;

class MemberDashboardController extends Controller
{
    public function index()
    {
        $user = auth()->user();
        // $savings = Saving::where('user_id', $user->id)->sum('amount');
        $loans = Loan::where('memberId', $user->id)->sum('amount');
        
        return view('member.dashboard', compact('loans'));
    }
}

