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
                'user_id' => Auth::id(),
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
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Post $post)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Post $post)
    {
        //
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
}
