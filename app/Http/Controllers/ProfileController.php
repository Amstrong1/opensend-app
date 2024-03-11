<?php

namespace App\Http\Controllers;

use App\Http\Requests\ProfileUpdateRequest;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Redirect;
use Illuminate\View\View;

class ProfileController extends Controller
{
    /**
     * Display the user's profile form.
     */
    public function edit(Request $request): View
    {
        if (app()->getLocale() == 'fr') {
            $pays = [
                // 'Africa' => [
                //     'Benin' => 'Benin',
                //     'Burkina Faso' => 'Burkina Faso',
                //     'Cape Verde' => 'Cape Verde',
                //     'Côte d\'Ivoire' => 'Côte d\'Ivoire',
                //     'Gambia' => 'Gambia',
                //     'Ghana' => 'Ghana',
                //     'Guinea' => 'Guinea',
                //     'Guinea-Bissau' => 'Guinea-Bissau',
                //     'Liberia' => 'Liberia',
                //     'Mali' => 'Mali',
                //     'Mauritania' => 'Mauritania',
                //     'Niger' => 'Niger',
                //     'Nigeria' => 'Nigeria',
                //     'Senegal' => 'Senegal',
                //     'Sierra Leone' => 'Sierra Leone',
                //     'Togo' => 'Togo',
                // ],

                'Amérique' => [
                    'Canada' => 'Canada',
                    'États-Unis d\'Amérique' => 'États-Unis d\'Amérique',
                    'Haïti' => 'Haïti',
                    'Mexique' => 'Mexique',
                ],

                'Europe' => [
                    'Allemagne' => 'Allemagne',
                    'Autriche' => 'Autriche',
                    'Belgique' => 'Belgique',
                    'Chypre' => 'Chypre',
                    'Espagne' => 'Espagne',
                    'France' => 'France',
                    'Grèce' => 'Grèce',
                    'Norvège' => 'Norvège',
                    'Pologne' => 'Pologne',
                    'Portugal' => 'Portugal',
                    'Royaume-Uni' => 'Royaume-Uni',
                    'Russie' => 'Russie',
                    'Suède' => 'Suède',
                    'Suisse' => 'Suisse',
                    'Turquie' => 'Turquie',
                ],

            ];
        } else {
            $pays = [
                "America" => [
                    "Canada" => "Canada",
                    "United States of America" => "United States of America",
                    "Haiti" => "Haiti",
                    "Mexico" => "Mexico"
                ],
                "Europe" => [
                    "Germany" => "Germany",
                    "Austria" => "Austria",
                    "Belgium" => "Belgium",
                    "Cyprus" => "Cyprus",
                    "Spain" => "Spain",
                    "France" => "France",
                    "Greece" => "Greece",
                    "Norway" => "Norway",
                    "Poland" => "Poland",
                    "Portugal" => "Portugal",
                    "United Kingdom" => "United Kingdom",
                    "Russia" => "Russia",
                    "Sweden" => "Sweden",
                    "Switzerland" => "Switzerland",
                    "Turkey" => "Turkey"
                ]
            ];
        }
        return view('profile.edit', [
            'user' => $request->user(),
            'pays' => $pays
        ]);
    }

    /**
     * Update the user's profile information.
     */
    public function update(ProfileUpdateRequest $request): RedirectResponse
    {
        $request->user()->fill($request->validated());

        if ($request->user()->isDirty('email')) {
            $request->user()->email_verified_at = null;
        }

        dd($request->user());

        $request->user()->save();

        return Redirect::route('profile.edit')->with('status', 'profile-updated');
    }

    /**
     * Delete the user's account.
     */
    public function destroy(Request $request): RedirectResponse
    {
        $request->validateWithBag('userDeletion', [
            'password' => ['required', 'current_password'],
        ]);

        $user = $request->user();

        Auth::logout();

        $user->delete();

        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return Redirect::to('/');
    }
}
