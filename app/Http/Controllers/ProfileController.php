<?php

namespace App\Http\Controllers;


use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\User;

class ProfileController extends Controller
{
    public function edit()
    {
        $user = Auth::user();

        if ($user->role === 'anggota') {
            return view('profile.edit', ['user' => $user, 'layout' => 'layouts.member']);
        } elseif ($user->role === 'bendahara') {
            return view('profile.edit', ['user' => $user, 'layout' => 'layouts.treasurer']);
        } elseif ($user->role === 'ketua') {
            return view('profile.edit', ['user' => $user, 'layout' => 'layouts.chair']);
        }

        abort(403, 'Unauthorized access');
    }

    public function update(Request $request)
    {
        $request->validate([
            'address' => 'required|string|max:255',
            'phone_number' => 'required|string|max:15',
        ]);

        $user = Auth::user();
        $user->address = $request->address;
        $user->phone_number = $request->phone_number;
        /** @var \App\Models\User $user **/
        $user->save();

        if ($user->role==='anggota') {
            return redirect()->route('loans.create')->with('success', 'Profile updated successfully.');
        } elseif ($user->role==='bendahara'){
            return redirect()->route('treasurer.loans.index')->with('success', 'Profile updated successfully.');
        } else {
            return redirect()->route('chair.loans.index')->with('success', 'Profile updated successfully.');
        }
    }
}
