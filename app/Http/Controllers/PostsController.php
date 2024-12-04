<?php

namespace App\Http\Controllers;

use App\Models\Post;
use App\Models\PostModel;
use App\Models\Tag;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Gate;

class PostsController extends Controller
{
    /**
     * Affiche la liste de tous les posts avec leurs commentaires associés
     */
    public function index()
    {

        Gate::authorize('viewAny', Post::class);

        $posts = Post::with(['comments' => function ($query) {
            $query->with('user', 'replies.user')
                ->whereNull('parentId')
                ->latest();
        }])->latest()->get();

        return view('posts.index', compact('posts'));
    }

    /**
     * Affiche le formulaire de création d'un post
     */
    public function create()
    {
        Gate::authorize('create', Post::class);

        return view('posts.create');
    }

    /**
     * Enregistre un nouveau post avec ses tags et collaborateurs
     */
    public function store(Request $request)
    {
        Gate::authorize('create', Post::class);

        $validated = $request->validate([
            'image' => 'required|image|mimes:jpeg,png,jpg,gif|max:2048',
            'description' => 'required|string|max:1000',
            'colabs' => 'nullable|string|max:255',
            'tags' => 'nullable|string|max:255',
        ]);

        if ($request->hasFile('image')) {
            $imagePath = $request->file('image')->store('posts', 'public');

            $post = Post::create([
                'userId' => Auth::id(),
                'image' => $imagePath,
                'content' => $validated['description'],
            ]);

            // Traitement des collaborateurs
            // Split et nettoyage des noms de collaborateurs entrés avec @
            $colabs = $request->input('colabs');

            $colabs = array_filter(explode('@', $colabs), function ($value) {
                return !empty(trim($value));
            });
            $colabs = array_map(function ($value) {
                return strtolower(trim($value, " @,"));
            }, $colabs);

            $colabs = collect($colabs)->map(function ($colab) {
                return User::where('name', $colab)->exists()
                    ? User::where('name', $colab)->first()->id
                    : null;
            })->filter();

            foreach ($colabs as $colab) {
                if ($colab) {
                    $post->colabs()->create([
                        'userId' => $colab,
                        'postId' => $post->id
                    ]);
                }
            }

            // Traitement des tags
            // Split et nettoyage des tags entrés avec #
            $tags = $request->input('tags');

            $tags = array_filter(explode('#', $tags), function ($value) {
                return !empty(trim($value));
            });
            $tags = array_map(function ($value) {
                return strtolower(trim($value, " #,"));
            }, $tags);

            $tags = collect($tags)->map(function ($tag) {
                return Tag::firstOrCreate(['name' => $tag])->id;
            })->filter();

            $post->tags()->attach($tags);

            return redirect()->route('posts.index')
                ->with('success', 'Post créé avec succès!');
        }

        return back()->with('error', 'Erreur lors du téléchargement de l\'image.');
    }

    /**
     * Affiche un post spécifique avec ses commentaires
     */
    public function show(Post $post)
    {

        Gate::authorize('view', $post);

        $post->load(['comments' => function ($query) {
            $query->with('user', 'replies.user')
                ->whereNull('parentId')
                ->latest();
        }]);

        return view('posts.show', compact('post'));
    }

    /**
     * Affiche le formulaire d'édition d'un post
     */
    public function edit(Post $post)
    {
        Gate::authorize('update', $post);

        return view('posts.update', compact('post'));
    }

    /**
     * Met à jour un post existant avec ses tags et collaborateurs
     */
    public function update(Request $request, Post $post)
    {
        Gate::authorize('update', $post);

        $validated = $request->validate([
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
            'description' => 'required|string|max:1000',
            'colabs' => 'nullable|string|max:255',
            'tags' => 'nullable|string|max:255',
        ]);

        if ($request->hasFile('image')) {
            $imagePath = $request->file('image')->store('posts', 'public');
            $post->image = $imagePath;
        }

        $post->content = $validated['description'];
        $post->save();

        // Même logique que store pour les collaborateurs et les tags
        $colabs = $request->input('colabs');

        $colabs = array_filter(explode('@', $colabs), function ($value) {
            return !empty(trim($value));
        });
        $colabs = array_map(function ($value) {
            return strtolower(trim($value, " @,"));
        }, $colabs);

        $colabs = collect($colabs)->map(function ($colab) {
            return User::where('name', $colab)->exists()
                ? User::where('name', $colab)->first()->id
                : null;
        })->filter();

        $post->colabs()->delete();
        foreach ($colabs as $colab) {
            if ($colab) {
                $post->colabs()->create([
                    'userId' => $colab,
                    'postId' => $post->id
                ]);
            }
        }

        $tags = $request->input('tags');

        $tags = array_filter(explode('#', $tags), function ($value) {
            return !empty(trim($value));
        });
        $tags = array_map(function ($value) {
            return strtolower(trim($value, " #,"));
        }, $tags);

        $tags = collect($tags)->map(function ($tag) {
            return Tag::firstOrCreate(['name' => $tag])->id;
        })->filter();

        $post->tags()->sync($tags);

        return redirect()->back()
            ->with('success', 'Post mis à jour avec succès!');
    }

    /**
     * Supprime un post et ses relations associées
     */
    public function destroy(Post $post)
    {
        Gate::authorize('delete', $post);

        $post->colabs()->delete();
        $post->tags()->detach();
        $post->delete();

        return redirect()->route('posts.index')
            ->with('success', 'Post supprimé avec succès!');
    }

    /**
     * Bascule l'état "like" d'un post pour l'utilisateur courant
     */
    public function like(Post $post)
    {
        $like = $post->postLikes()->where('userId', Auth::id())->first();

        if ($like) {
            $like->delete();
        } else {
            $post->postLikes()->create(['userId' => Auth::id()]);
        }

        return redirect()->back();
    }

    /**
     * Affiche le fil d'actualité avec les posts des utilisateurs suivis et les posts tendances
     */
    public function home()
    {
        Gate::authorize('viewAny', Post::class);
        // Récupère les 10 derniers posts des utilisateurs suivis
        $followedPosts = Post::whereIn('userId', Auth::user()->following->pluck('followingId'))
            ->with(['comments' => function ($query) {
                $query->with('user', 'replies.user')
                    ->whereNull('parentId')
                    ->latest();
            }])
            ->with('user', 'tags', 'postLikes')
            ->latest()
            ->take(10)
            ->get();

        // Récupère les posts les plus likés
        $trendingPosts = Post::withCount('postLikes')
            ->with(['comments' => function ($query) {
                $query->with('user', 'replies.user')
                    ->whereNull('parentId')
                    ->latest();
            }])
            ->with('user', 'tags', 'postLikes')
            ->orderByDesc('post_likes_count')
            ->get();

        return view('posts.home', compact('followedPosts', 'trendingPosts'));
    }

    /**
     * Affiche les posts de l'utilisateur connecté
     */
    public function myPosts()
    {
        Gate::authorize('viewAny', Post::class);

        $posts = Post::where('userId', Auth::id())->with(['comments' => function ($query) {
            $query->with('user', 'replies.user')
                ->whereNull('parentId')
                ->latest();
        }])->latest()->get();

        return view('posts.index', compact('posts'));
    }

    /**
     * Affiche les posts d'un utilisateur spécifique
     */
    public function userPosts($user)
    {
        Gate::authorize('viewAny', Post::class);

        $users = User::where('name', 'like', '%' . $user . '%')->get();
        $posts = Post::whereIn('userId', $users->pluck('id'))->get();

        return view('posts.index', compact('posts'));
    }

    /**
     * Affiche les posts associés à un tag spécifique
     */
    public function postsByTag($tag)
    {
        Gate::authorize('viewAny', Post::class);

        $tag = Tag::where('name', strtolower($tag))->firstOrFail();

        $posts = Post::whereHas('tags', function ($query) use ($tag) {
            $query->where('tagId', $tag->id);
        })
            ->latest()
            ->get();

        return view('posts.index', compact('posts'));
    }

    /**
     * Recherche des posts selon différents critères (utilisateurs, tags, contenu)
     */
    public function search(Request $request)
    {
        Gate::authorize('viewAny', Post::class);

        $query = Post::query();

        $users = $request->input('users');
        $tags = $request->input('tags');
        $content = $request->input('content');

        if ($users) {
            $query->whereHas('user', function ($q) use ($users) {
                $q->whereIn('name', $users);
            });
        }

        if ($tags) {
            $query->whereHas('tags', function ($q) use ($tags) {
                $q->whereIn('name', $tags);
            });
        }

        if ($content) {
            $query->where('content', 'like', '%' . $content . '%');
        }

        $posts = $query->with(['comments' => function ($query) {
            $query->with('user', 'replies.user')
                ->whereNull('parentId')
                ->latest();
        }])->latest()->get();

        // Redirection vers le profil si recherche d'un seul utilisateur
        // Sinon affiche les résultats de recherche
        if (!$posts->isEmpty() && $users && count($users) === 1 && !$tags && !$content) {
            return redirect()->route('profile.show', ['user' => $posts->first()->user]);
        } else {
            return view('posts.index', compact('posts'));
        }
    }
}
