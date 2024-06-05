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
        $loans = Loan::where('memberId', $user->id)->where('status','approved')->sum('amount');

        
        return view('member.dashboard', compact('loans'));
    }
}

