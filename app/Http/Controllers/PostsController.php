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
        $posts = Post::all();
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
            'description' => 'required|string|max:1000', // Changed from 'publication' to match form field name
            'colabs' => 'nullable|string|max:255',
            'tags' => 'nullable|string|max:255',
        ]);

        if ($request->hasFile('image')) {
            $imagePath = $request->file('image')->store('posts', 'public');

            $post = Post::create([
                'user_id' => Auth::id(), // Changed from userId to user_id
                'image' => $imagePath,
                'content' => $validated['description'],
            ]);

            $colabs = $request->input('colabs');
            $colabs = explode('@', $colabs);
            foreach ($colabs as $key => $value) {
                $colabs[$key] = trim($value, " ,");
            }
            // map colabs get userId by colab name need to return an array of object parameter userId,
            $colabs = collect($colabs)->map(function ($colab) {
                // return only if user exists
                if (User::where('name', $colab)->exists()) {
                    return User::where('name', $colab)->first()->id;
                }
            });


            $post->colabs()->attach($colabs);

            $tags = $request->input('tags');
            $tags = explode('#', $tags);
            foreach ($tags as $key => $value) {
                $tags[$key] = strtolower(trim($value, " ,"));
            }
            // check if tag exists, if not create it
            $tags = collect($tags)->map(function ($tag) {
                return Tag::firstOrCreate(['name' => $tag])->id;
            });

            $post->tags()->attach($tags);

            return redirect()->route('posts.index')
                ->with('success', 'Post créé avec succès!');
        }

        return redirect()->back()->with('error', 'Erreur lors du téléchargement de l\'image.');
    }

    /**
     * Display the specified resource.
     */
    public function show(Post $post)
    {
        //
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
}
