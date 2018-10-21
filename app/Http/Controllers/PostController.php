<?php

namespace App\Http\Controllers;

use App\Post;
use Illuminate\Http\Request;
use App\Events\PostCreated;

class PostController extends Controller
{
    public function store(Request $request)
    {
        \Log::debug($request);
        $post = Post::create($request->all());
        event(new PostCreated($post));
        return $post;
        return response()->json([
            'hash' => $board->hash
        ]);
    }
}
