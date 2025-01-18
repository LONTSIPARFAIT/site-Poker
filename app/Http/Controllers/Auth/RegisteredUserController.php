<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Auth\Events\Registered;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rules;
use Illuminate\View\View;

class RegisteredUserController extends Controller
{
    /**
     * Display the registration view.
     */
    public function create(Request $request): View
    {
        $referredBy = null;

        // Vérifier si un user_id est passé dans l'URL
        if (request('user_id')) {
            $referredBy = User::find(request('user_id'));
        }

        return view('auth.register',compact('referredBy'));
    }

    /**
     * Handle an incoming registration request.
     *
     * @throws \Illuminate\Validation\ValidationException
     */
    public function store(Request $request): RedirectResponse
    {
        $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'telephone' => ['required', 'digits_between:9,15'],  // Le numéro doit avoir entre 9 et 15 chiffres
            'password' => ['required', 'confirmed', Rules\Password::defaults()],
        ]);

        $user = User::create([
            'name' => $request->name,
            'telephone' => $request->telephone,
            'password' => \Hash::make($request->password),
            'creatd_at'=> now()
        ]);
        // dd($request);

        // Vérifier si un lien d'affiliation est présent
        if ($request->has('code')) {
            $parrain = User::find($request->get('user_id'));
// die;
            if ($parrain) {
                // Associer le nouvel utilisateur à l'utilisateur qui l'a référé
                $user->parrain_id = $parrain->id;
                $user->save();
            }
        }

        // Génération du lien d'affiliation unique
        $user->generateReferralLink();

        event(new Registered($user));

        Auth::login($user);

        if (auth()->user()->isAdmin()) {
            return redirect()->route('admin.users');
        }
        return redirect(route('produits.index', absolute: false));
    }
    public function destroy($id)
    {
        $user = User::findOrFail($id);
        $user->delete();

        return redirect()->route('admin.users')->with('success', 'Utilisateur supprimé avec succès.');
    }


}
