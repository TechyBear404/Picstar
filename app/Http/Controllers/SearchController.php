<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class SearchController extends Controller
{
    /**
     * Parse la requête de recherche et sépare les termes (@users, #tags, contenu)
     * Redirige vers la recherche de posts avec les paramètres filtrés
     */
    public function index(Request $request)
    {
        $validatedData = $request->validate([
            'q' => 'required|string|max:255'
        ]);
        $query = $validatedData['q'];
        $terms = preg_split('/\s+/', trim($query));

        $users = [];
        $tags = [];
        $content = [];

        foreach ($terms as $term) {
            if (str_starts_with($term, '@')) {
                $users[] = ltrim($term, '@');
            } elseif (str_starts_with($term, '#')) {
                $tags[] = ltrim($term, '#');
            } else {
                $content[] = $term;
            }
        }

        return redirect()->route('posts.search', compact('users', 'tags', 'content'));
    }
}
