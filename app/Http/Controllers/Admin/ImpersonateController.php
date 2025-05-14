<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ImpersonateController extends Controller
{
    /**
     * Start impersonatie als een andere gebruiker.
     */
    public function loginAs(User $user)
    {
        $currentUser = Auth::user();

        // Alleen super admins mogen dit
        if (!$currentUser || !$currentUser->hasRole('super-admin')) {
            abort(403, 'Geen toestemming om gebruikers te impersonaten.');
        }

        // Al in impersonatie-modus? Voorkom stacking.
        if (session()->has('impersonator_id')) {
            return redirect()->back()->with([
                'flash' => [
                    'type' => 'warning',
                    'message' => 'Je bent al ingelogd als iemand anders',
                    'duration' => 2000,
                ]
            ]);
        }

        // Sla het ID van de impersonator op in de sessie
        session(['impersonator_id' => $currentUser->id]);

        Auth::login($user);

        return redirect(route('home'))->with([
            'flash' => [
                'type' => 'success',
                'message' => 'Je bent ingelogd als: '. $user->fullname,
                'duration' => 2000,
            ]
        ]);
    }

    /**
     * Stop impersonatie en login terug als originele gebruiker.
     */
    public function logoutAs()
    {
        if (!session()->has('impersonator_id')) {
            abort(403, 'Je bent niet in impersonatie-modus.');
        }

        $impersonatorId = session()->pull('impersonator_id');
        $impersonator = User::find($impersonatorId);

        if (!$impersonator) {
            abort(403, 'Oorspronkelijke gebruiker niet gevonden.');
        }

        Auth::login($impersonator);

        return redirect(route('home'))->with([
            'flash' => [
                'type' => 'success',
                'message' => 'Je bent teruggekeerd naar je eigen account.',
                'duration' => 2000,
            ]
        ]);
    }

}
