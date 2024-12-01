<?php

namespace App\Http\Controllers;

use App\Http\Requests\ProfileUpdateRequest;
use App\Models\User;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Redirect;
use Illuminate\View\View;

class ProfileController extends Controller
{
    /**
     * Affiche le formulaire d'édition du profil utilisateur
     */
    public function edit(Request $request): View
    {
        return view('profile.edit', [
            'user' => $request->user(),
        ]);
    }

    /**
     * Affiche le profil public d'un utilisateur avec ses posts
     */
    public function show(User $user): View
    {
        $posts = $user->posts()
            ->latest()
            ->paginate(12);

        return view('profile.show', [
            'user' => $user,
            'posts' => $posts
        ]);
    }

    /**
     * Met à jour les informations du profil utilisateur et gère l'upload d'avatar
     */
    public function update(ProfileUpdateRequest $request): RedirectResponse
    {
        $request->user()->fill($request->validated());

        if ($request->user()->isDirty('email')) {
            $request->user()->email_verified_at = null;
        }

        if ($request->hasFile('avatar')) {
            $avatarPath = $request->file('avatar')->store("users/" . Auth::id() . "/avatars", 'public');
            $request->user()->avatar = $avatarPath;
        }

        $request->user()->save();

        return Redirect::route('profile.edit')->with('success', 'Profil mis à jour avec succès.');
    }

    /**
     * Supprime le compte utilisateur après vérification du mot de passe
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
