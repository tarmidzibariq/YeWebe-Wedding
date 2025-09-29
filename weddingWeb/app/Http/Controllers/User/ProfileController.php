<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rule;

class ProfileController extends Controller
{
    public function __construct()
    {
        $this->middleware(['auth', 'checkrole:user']);
    }

    /**
     * Show the form for editing the profile.
     */
    public function edit()
    {
        $user = Auth::user();
        return view('user.profile.edit', compact('user'));
    }

    /**
     * Update the profile.
     */
    public function update(Request $request)
    {
        $user = Auth::user();

        $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255', Rule::unique('users')->ignore($user->id)],
            'no_telp' => ['nullable', 'string', 'regex:/^(?:\+62|62|0)8[1-9][0-9]{6,11}$/'],
            'current_password' => ['nullable', 'string'],
            'password' => ['nullable', 'string', 'min:8', 'confirmed'],
        ], [
            'no_telp.regex' => 'Nomor telepon harus diawali 08/62 dan 9–14 digit setelahnya.',
        ]);

        try {
            $user->name = $request->name;
            $user->email = $request->email;
            $user->no_telp = $request->no_telp;

            if ($request->filled('password')) {
                if (!Hash::check($request->current_password, $user->password)) {
                    return back()->withErrors(['current_password' => 'Current password is incorrect.']);
                }
                $user->password = Hash::make($request->password);
            }

            Auth::user()->update([
                'name' => $user->name,
                'email' => $user->email,
                'password' => $user->password,
                'no_telp' => $user->no_telp,
            ]);

            return back()->with('success', 'Profile updated successfully.');
        } catch (\Throwable $e) {
            return back()->withErrors(['error' => 'Failed to update profile: ']);
        }
    }
}
