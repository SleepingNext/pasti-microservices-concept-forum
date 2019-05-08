<?php

namespace App\Http\Controllers;

use App\Post;
use Illuminate\Http\Request;

class PostController extends Controller
{
    public function index($thread) {
        $posts = Post::where('thread', $thread)->get();

        return response()->json($posts);
    }

    public function getPost($thread) {
        $post = Post::where('thread', $thread)->get()->last();

        return response()->json($post);
    }

    public function findPost($id) {
        $post = Post::find($id);

        return response()->json($post);
    }

    public function create(Request $request) {
        $post = new Post();

        $post->body = $request->body;
        $post->thread = $request->thread;
        $post->author = $request->author;

        $post->save();
    }

    public function update(Request $request, $id) {
        $post = Post::find($id);

        $post->body = $request->body;

        $post->save();
    }

    public function delete($id) {
        $post = Post::find($id);

        $post->delete();
    }
}
