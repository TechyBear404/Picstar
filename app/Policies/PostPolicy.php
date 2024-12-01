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

    /**
     * Vérifie si l'utilisateur peut voir la liste de tous les posts
     * Autorise si l'utilisateur est connecté
     */
    public function viewAny(User $user): Response
    {
        return $user !== null
            ? Response::allow()
            : Response::deny('Vous devez être connecté pour voir les posts.');
    }

    /**
     * Vérifie si l'utilisateur peut voir un post spécifique
     * Autorise si l'utilisateur est connecté
     */
    public function view(User $user): Response
    {
        // return true if user is authenticated
        return $user !== null
            ? Response::allow()
            : Response::deny('Vous devez être connecté pour voir un post.');
    }

    /**
     * Vérifie si l'utilisateur peut créer un nouveau post
     * Autorise si l'utilisateur est connecté
     */
    public function create(User $user): Response
    {
        return $user !== null
            ? Response::allow()
            : Response::deny('Vous devez être connecté pour créer un post.');
    }

    /**
     * Vérifie si l'utilisateur peut modifier un post
     * Autorise uniquement si l'utilisateur est le propriétaire du post
     */
    public function update(User $user, Post $post): Response
    {
        return $user->id === $post->userId
            ? Response::allow()
            : Response::deny('Vous n\'êtes pas autorisé à modifier ce post.');
    }

    /**
     * Vérifie si l'utilisateur peut supprimer un post
     * Autorise uniquement si l'utilisateur est le propriétaire du post
     */
    public function delete(User $user, Post $post): Response
    {
        return $user->id === $post->userId
            ? Response::allow()
            : Response::deny('Vous n\'êtes pas autorisé à supprimer ce post.');
    }
}
