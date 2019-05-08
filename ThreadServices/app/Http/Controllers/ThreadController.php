<?php

namespace App\Http\Controllers;

use App\Thread;
use Illuminate\Http\Request;

class ThreadController extends Controller
{
    public function index() {
        $threads = Thread::orderBy('id', 'desc')->get();
        return response()->json($threads);
    }

    public function view($id) {
        $threads = Thread::find($id);
        return response()->json($threads);
    }

    public function add(Request $request) {
        $thread = new Thread();

        $thread->title = $request->title;
        $thread->body = $request->body;
        $thread->author = $request->author;

        $thread->save();
    }

    public function update(Request $request, $id) {
        $thread = Thread::find($id);

        $thread->title = $request->title;
        $thread->body = $request->body;

        $thread->save();
    }

    public function delete($id) {
        $thread = Thread::find($id);

        $thread->delete();
    }
}
