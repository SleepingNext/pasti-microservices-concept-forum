@extends('layouts.app')

@section('title', 'Threads')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-4">
            <div class="card">
                <div class="card-header">Threads</div>

                <div class="card-body">
                    <a class="btn btn-outline-success" href="/addThread">Add Thread</a>
                    <br><br>
                    @foreach($threads as $thread)
                    <?php
                        $client = new \GuzzleHttp\Client();

                        $request = $client->get('localhost:8240/api/getUser/' . $thread['author']);
                        $response = $request->getBody();
                        $user = json_decode($response, true);

                        $request = $client->get('localhost:8080/api/getPost/' . $thread['id']);
                        $response = $request->getBody();
                        $post = json_decode($response, true);
                    ?>
                    <div class="card bg-light">
                        <div class="card-header">Author: {{$user['name']}}</div>

                        <div class="card-body">
                            <a class="h5" href="/view/{{$thread['id']}}"><b>{{$thread['title']}}</b></a>

                            @if(count($post) > 0)
                            <hr class="bg-dark">

                            Latest Post: {{$post['body']}}
                            @endif
                        </div>

                        @if($thread['author'] == Auth::user()->id)
                            <div class="card-footer text-right">
                                <a class="btn btn-outline-primary" href="/updateThread/{{$thread['id']}}">Update</a>
                                <a class="btn btn-outline-danger" href="/deleteThread/{{$thread['id']}}">Delete</a>
                            </div>
                        @endif
                    </div>
                    <br>
                    @endforeach
                </div>
            </div>
        </div>
    </div>
</div>
@endsection