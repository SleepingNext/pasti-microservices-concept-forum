@extends('layouts.app')

@section('title', 'View Thread')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-4">
                <?php
                $client = new \GuzzleHttp\Client();

                $request = $client->get('localhost:8240/api/getUser/' . $thread->author);
                $response = $request->getBody();
                $user = json_decode($response, true);

                $request = $client->get('localhost:8080/api/getPost/' . $thread->id);
                $response = $request->getBody();
                $post = json_decode($response, true);
                ?>
                <div class="card">
                    <div class="card-header">Author: {{$user['name']}}</div>

                    <div class="card-body">
                        <h5><b>{{$thread->title}}</b></h5>
                        <hr class="bg-dark">
                        <p>{{$thread->body}}</p>
                        @foreach($posts as $post)
                        <?php
                            $request = $client->get('localhost:8240/api/getUser/' . $post->author);
                            $response = $request->getBody();
                            $user = json_decode($response, true);
                        ?>
                        <div class="card bg-light">
                            <div class="card-header">Author: {{$user['name']}}</div>

                            <div class="card-body">
                                {{$post->body}}
                            </div>

                            @if($post->author == Auth::user()->id)
                                <div class="card-footer text-right">
                                    <a class="btn btn-outline-primary" href="/updatePost/{{$post->id}}/{{$thread->id}}">Update</a>
                                    <a class="btn btn-outline-danger" href="/deletePost/{{$post->id}}">Delete</a>
                                </div>
                            @endif
                        </div>
                        <br>
                        @endforeach
                        <div class="card bg-light">
                            <div class="card-header">Add Your Post</div>

                            <div class="card-body">
                                <form action="/addPost/{{$thread->id}}" method="post">
                                    {{csrf_field()}}
                                    <div class="form-group">
                                        <textarea class="form-control" name="body" placeholder="Write your post here" required></textarea>
                                    </div>
                                    <input class="btn btn-outline-success" type="submit" value="Post It!">
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
                <br>
            </div>
        </div>
    </div>
@endsection