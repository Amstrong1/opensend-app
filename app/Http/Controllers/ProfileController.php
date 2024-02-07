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
        $pays = [
            'Africa' => [
                'Benin' => 'Benin',
                'Burkina Faso' => 'Burkina Faso',
                'Cape Verde' => 'Cape Verde',
                'Côte d\'Ivoire' => 'Côte d\'Ivoire',
                'Gambia' => 'Gambia',
                'Ghana' => 'Ghana',
                'Guinea' => 'Guinea',
                'Guinea-Bissau' => 'Guinea-Bissau',
                'Liberia' => 'Liberia',
                'Mali' => 'Mali',
                'Mauritania' => 'Mauritania',
                'Niger' => 'Niger',
                'Nigeria' => 'Nigeria',
                'Senegal' => 'Senegal',
                'Sierra Leone' => 'Sierra Leone',
                'Togo' => 'Togo',
            ],

            'Europe' => [
                'Austria' => 'Austria',
                'Belgium' => 'Belgium',
                'France' => 'France',
                'Germany' => 'Germany',
                'Ireland' => 'Ireland',
                'Luxembourg' => 'Luxembourg',
                'Netherlands' => 'Netherlands',
                'Switzerland' => 'Switzerland',
                'United Kingdom' => 'United Kingdom',
            ],

            'America' => [
                'United States' => 'United States',
                'Canada' => 'Canada',
            ],

        ];
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
