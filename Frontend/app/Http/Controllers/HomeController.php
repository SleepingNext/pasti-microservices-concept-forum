<?php

namespace App\Http\Controllers;

use GuzzleHttp\Client;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        return view('home');
    }

    public function threads() {
        $client = new Client();

        $request = $client->get('localhost:8000/api/index');
        $response = $request->getBody();
        $threads = json_decode($response, true);

        return view('threads', ['threads' => $threads]);
    }

    public function view($id) {
        $client = new Client();

        $request = $client->get('localhost:8000/api/view/' . $id);
        $response = $request->getBody();
        $thread = json_decode($response);

        $request = $client->get('localhost:8080/api/index/' . $id);
        $response = $request->getBody();
        $posts = json_decode($response);

        return view('view', ['thread' => $thread, 'posts' => $posts]);
    }

    public function addThread() {
        return view('addThread');
    }

    public function addThreadProcess(Request $request) {
        $client = new Client();
        $data['title'] = $request->title;
        $data['body'] = $request->body;
        $data['author'] = Auth::user()->id;
        $client->post('localhost:8000/api/add/',
            ['form_params' => $data]);
        return redirect('/threads');
    }

    public function updateThread($id) {
        $client = new Client();

        $request = $client->get('localhost:8000/api/view/' . $id);
        $response = $request->getBody();
        $thread = json_decode($response);

        return view('updateThread', ['thread' => $thread]);
    }

    public function updateThreadProcess(Request $request, $id) {
        $client = new Client();
        $data['title'] = $request->title;
        $data['body'] = $request->body;
        $client->put('localhost:8000/api/update/' . $id,
            ['form_params' => $data]);
        return redirect('/threads');
    }

    public function deleteThread($id) {
        $client = new Client();
        $client->delete('localhost:8000/api/delete/' . $id);

        return redirect()->back();
    }

    public function addPost(Request $request, $thread) {
        $client = new Client();
        $data['body'] = $request->body;
        $data['thread'] = $thread;
        $data['author'] = Auth::user()->id;
        $client->post('localhost:8080/api/create/',
            ['form_params' => $data]);
        return redirect()->back();
    }

    public function updatePost($id, $thread) {
        $client = new Client();
        $request = $client->get('localhost:8080/api/findPost/' . $id);
        $response = $request->getBody();
        $post = json_decode($response, true);

        return view('updatePost', ['post' => $post, 'thread' => $thread]);
    }

    public function updatePostProcess(Request $request, $id, $thread) {
        $client = new Client();
        $data['body'] = $request->body;
        $client->put('localhost:8080/api/update/' . $id,
            ['form_params' => $data]);
        return redirect('/view/' . $thread);
    }

    public function deletePost($id) {
        $client = new Client();
        $client->delete('localhost:8080/api/delete/' . $id);

        return redirect()->back();
    }
}
