<?php

namespace App\Http\Controllers;

use App\Models\Follow;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class FollowController extends Controller
{

    /**
     * Créer une nouvelle relation de suivi
     */
    public function store(Request $request, User $user)
    {
        Follow::create([
            'followerId' => Auth::id(),
            'followingId' => $user->id
        ]);
        return back()->with('success', 'Vous suivez maintenant cet utilisateur');
    }

    /**
     * Supprimer une relation de suivi
     */
    public function destroy(User $user)
    {
        Follow::where('followerId', Auth::id())
            ->where('followingId', $user->id)
            ->delete();
        return back()->with('success', 'Vous ne suivez plus cet utilisateur');
    }

    /**
     * Affiche la liste des abonnés de l'utilisateur
     */
    public function followers()
    {
        $followers = Auth::user()->followers()->with('user')->get();
        return view('follows.followers', compact('followers'));
    }

    /**
     * Affiche la liste des abonnements de l'utilisateur
     */
    public function following()
    {
        $following = Auth::user()->following()->with('user')->get();
        return view('follows.following', compact('following'));
    }
}
