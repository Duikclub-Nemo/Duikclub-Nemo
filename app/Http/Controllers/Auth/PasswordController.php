<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rules\Password;

class PasswordController extends Controller
{
    /**
     * Update the user's password.
     */
    public function update(Request $request): RedirectResponse
    {
        $validated = $request->validate([
            'current_password' => ['required', 'current_password'],
            'password' => ['required', Password::defaults(), 'confirmed'],
        ], [
            'current_password.*' => 'Vul jouw huidige wachtwoord in.',
            'password.required' => 'Vul een nieuw wachtwoord in.',
            'password.confirmed' => 'Bevestig jouw nieuwe wachtwoord.',
            'password.*' => 'Het wachtwoord dient minimaal 8 karakters te bevatten.',
        ]);

        $request->user()->update([
            'password' => Hash::make($validated['password']),
        ]);

        return back();
    }

}
