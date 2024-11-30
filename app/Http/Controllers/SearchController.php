<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class SearchController extends Controller
{
    public function index(Request $request)
    {
        $query = $request->input('q');
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
