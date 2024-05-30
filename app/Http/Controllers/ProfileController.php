<?php

namespace App\Http\Controllers;


use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\User;

class ProfileController extends Controller
{
    public function edit()
    {
        return view('profile.edit', ['User' => Auth::user()]);
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

        return redirect()->route('profile.edit')->with('success', 'Profile updated successfully.');
    }
}
