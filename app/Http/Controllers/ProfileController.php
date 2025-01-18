<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\View\View;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Redirect;
use App\Http\Requests\ProfileUpdateRequest;

class ProfileController extends Controller
{
    /**
     * Display the user's profile form.
     */
    public function edit(Request $request): View
    {
        return view('profile.edit', [
            'user' => $request->user(),
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

    
    // Afficher le formulaire de modification du numéro de téléphone
public function editPhone(User $user)
{
    return view('profile.edit-phone', compact('user')); // Assurez-vous de créer cette vue
}

// Traiter la demande de modification du numéro de téléphone
public function updatePhone(Request $request)
{
    $request->validate([
        'telephone' => ['required', 'integer', 'min:9'],
    ]);

    $user = auth()->user();
    $user->telephone = $request->input('telephone');
    $user->save();

    return redirect()->route('profile.phone.edit', compact('user'))->with('status', 'Numéro de téléphone mis à jour.');
}
}
