<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Loan;

class HistoryController extends Controller
{
    public function index(Request $request)
    {
        $user = auth()->user();
        $query = Loan::query();

        if ($user->role === 'anggota') {
            $query->where('memberId', $user->id);
            
        }

        if ($request->has('status') && $request->status !== 'all') {
            $query->where('status', $request->status);
        }

        $loans = $query->with('member')->get();

        if ($user->role === 'anggota') {
            return view('loans.history', ['user' => $user, 'layout' => 'layouts.member'], compact('loans'));
        } elseif ($user->role === 'bendahara') {
            return view('loans.history', ['user' => $user, 'layout' => 'layouts.treasurer'], compact('loans'));
        } elseif ($user->role === 'ketua') {
            return view('loans.history', ['user' => $user, 'layout' => 'layouts.chair'], compact('loans'));
        }
    }

}
