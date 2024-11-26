<?php

namespace App\Http\Controllers;

use App\Models\Post;
use App\Models\PostModel;
use App\Models\Tag;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class PostsController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $posts = Post::with(['comments' => function ($query) {
            $query->with('user', 'replies.user')
                ->whereNull('parentId')
                ->latest();
        }])->latest()->get();

        return view('posts.index', compact('posts'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('posts.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
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

            $colabs = $request->input('colabs');
            // Split by @ and filter out empty values, trim spaces, and remove leading @
            $colabs = array_filter(explode('@', $colabs), function ($value) {
                return !empty(trim($value));
            });
            $colabs = array_map(function ($value) {
                return strtolower(trim($value, " @,"));
            }, $colabs);

            // map colabs get userId by colab name
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

            $tags = $request->input('tags');
            // Split by # and filter out empty values, trim spaces
            $tags = array_filter(explode('#', $tags), function ($value) {
                return !empty(trim($value));
            });
            $tags = array_map(function ($value) {
                return strtolower(trim($value, " #,"));
            }, $tags);

            // Create or get existing tags and collect their IDs
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
     * Display the specified resource.
     */
    public function show(Post $post)
    {
        $post->load(['comments' => function ($query) {
            $query->with('user', 'replies.user')
                ->whereNull('parentId')
                ->latest();
        }]);

        return view('posts.show', compact('post'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Post $post)
    {
        return view('posts.update', compact('post'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Post $post)
    {
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

        $colabs = $request->input('colabs');
        // Split by @ and filter out empty values, trim spaces, and remove leading @
        $colabs = array_filter(explode('@', $colabs), function ($value) {
            return !empty(trim($value));
        });
        $colabs = array_map(function ($value) {
            return strtolower(trim($value, " @,"));
        }, $colabs);

        // map colabs get userId by colab name
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
        // Split by # and filter out empty values, trim spaces
        $tags = array_filter(explode('#', $tags), function ($value) {
            return !empty(trim($value));
        });
        $tags = array_map(function ($value) {
            return strtolower(trim($value, " #,"));
        }, $tags);

        // Create or get existing tags and collect their IDs
        $tags = collect($tags)->map(function ($tag) {
            return Tag::firstOrCreate(['name' => $tag])->id;
        })->filter();

        $post->tags()->sync($tags);

        return redirect()->route('posts.index')
            ->with('success', 'Post mis à jour avec succès!');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Post $post)
    {
        $post->colabs()->delete();
        $post->tags()->detach();
        $post->delete();

        return redirect()->route('posts.index')
            ->with('success', 'Post supprimé avec succès!');
    }

    /**
     * Toggle like status for the post.
     */
    public function like(Post $post)
    {
        $like = $post->postLikes()->where('userId', Auth::id())->first();

        if ($like) {
            $like->delete();
        } else {
            $post->postLikes()->create(['userId' => Auth::id()]);
        }

        return back();
    }

    public function myPosts()
    {
        $posts = Post::where('userId', Auth::id())->with(['comments' => function ($query) {
            $query->with('user', 'replies.user')
                ->whereNull('parentId')
                ->latest();
        }])->latest()->get();
        // dump($posts);
        return view('posts.index', compact('posts'));
    }

    public function userPosts($user)
    {
        // need to find users where name is like $user
        $users = User::where('name', 'like', '%' . $user . '%')->get();
        $posts = Post::whereIn('userId', $users->pluck('id'))->get();
        // $posts = Post::where('userId', $user->id)->latest()->get();
        return view('posts.index', compact('posts'));
    }

    public function postsByTag($tag)
    {
        $tag = Tag::where('name', strtolower($tag))->firstOrFail();

        $posts = Post::whereHas('tags', function ($query) use ($tag) {
            $query->where('tagId', $tag->id);
        })
            ->latest()
            ->get();

        return view('posts.index', compact('posts'));
    }

    public function search(Request $request)
    {
        $query = Post::query();

        if ($users = $request->input('users')) {
            $userIds = User::whereIn('name', explode(',', $users))
                ->pluck('id');
            $query->whereIn('userId', $userIds);
        }

        if ($tags = $request->input('tags')) {
            $tagNames = explode(',', $tags);
            $query->whereHas('tags', function ($q) use ($tagNames) {
                $q->whereIn('name', $tagNames);
            });
        }

        if ($content = $request->input('content')) {
            $query->where('content', 'like', '%' . $content . '%');
        }

        $posts = $query->with(['comments' => function ($query) {
            $query->with('user', 'replies.user')
                ->whereNull('parentId')
                ->latest();
        }])->latest()->get();

        return view('posts.index', compact('posts'));
    }
}
