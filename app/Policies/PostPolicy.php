<?php

namespace App\Policies;

use App\Models\Post;
use App\Models\Posts;
use App\Models\User;
use Illuminate\Auth\Access\Response;
use Illuminate\Support\Facades\Auth;
use Illuminate\Auth\Access\HandlesAuthorization;

class PostPolicy
{
    use HandlesAuthorization;

    // /**
    //  * Determine whether the user can view any models.
    //  */
    public function viewAny(User $user): Response
    {
        return $user !== null
            ? Response::allow()
            : Response::deny('Vous devez être connecté pour voir les posts.');
    }

    /**
     * Determine whether the user can view the model.
     */
    public function view(User $user): Response
    {
        // return true if user is authenticated
        return $user !== null
            ? Response::allow()
            : Response::deny('Vous devez être connecté pour voir un post.');
    }

    /**
     * Determine whether the user can create models.
     */
    public function create(User $user): Response
    {
        return $user !== null
            ? Response::allow()
            : Response::deny('Vous devez être connecté pour créer un post.');
    }

    /**
     * Determine whether the user can update the model.
     */
    public function update(User $user, Post $post): Response
    {
        return $user->id === $post->userId
            ? Response::allow()
            : Response::deny('Vous n\'êtes pas autorisé à modifier ce post.');
    }

    /**
     * Determine whether the user can delete the model.
     */
    public function delete(User $user, Post $post): Response
    {
        return $user->id === $post->userId
            ? Response::allow()
            : Response::deny('Vous n\'êtes pas autorisé à supprimer ce post.');
    }

    // /**
    //  * Determine whether the user can restore the model.
    //  */
    // public function restore(User $user, Posts $posts): bool
    // {
    //     //
    // }

    // /**
    //  * Determine whether the user can permanently delete the model.
    //  */
    // public function forceDelete(User $user, Posts $posts): bool
    // {
    //     //
    // }
}
