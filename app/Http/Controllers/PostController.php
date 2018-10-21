<?php

namespace App\Http\Controllers;

use App\Post;
use Illuminate\Http\Request;

class PostController extends Controller
{
    public function store(Request $request)
    {
        \Log::debug($request);
        $post = Post::create($request->all());
        return $post;
        return response()->json([
            'hash' => $board->hash
        ]);
    }
}
