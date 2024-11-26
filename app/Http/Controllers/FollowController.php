<?php

namespace App\Http\Controllers;

use App\Models\Follow;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class FollowController extends Controller
{
    public function index()
    {
        // $following = Auth::user()->following;
        // return view('follows.index', compact('following'));
    }

    public function store(Request $request, User $user)
    {
        Follow::create([
            'followerId' => Auth::id(),
            'followingId' => $user->id
        ]);
        return back()->with('success', 'Vous suivez maintenant cet utilisateur');
    }

    public function destroy(User $user)
    {
        Follow::where('followerId', Auth::id())
            ->where('followingId', $user->id)
            ->delete();
        return back()->with('success', 'Vous ne suivez plus cet utilisateur');
    }

    public function followers()
    {
        $followers = Auth::user()->followers()->get();
        return view('follows.followers', compact('followers'));
    }

    public function following()
    {
        $following = Auth::user()->following()->get();
        return view('follows.following', compact('following'));
    }
}
