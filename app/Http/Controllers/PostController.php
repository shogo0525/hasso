<?php

namespace App\Http\Controllers;

use App\Post;
use Illuminate\Http\Request;
use App\Events\PostCreated;
use App\Events\PostLiked;
use App\Events\PostDeleted;

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

    public function like(Post $post)
    {
        $post->like_count += 1;
        $post->save();
        event(new PostLiked($post->board_id, $post));
        return 'post is liked';
    }

    public function destroy(Post $post)
    {
        $post_id = $post->id;
        $board_id = $post->board->id;
        $post->delete();
        event(new PostDeleted($board_id, $post_id));
        return 'post is deleted';
    }
}
