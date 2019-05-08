@extends('layouts.app')

@section('title', 'Update Post')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-4">
                <div class="card bg-light">
                    <div class="card-header">Update Your Post</div>

                    <div class="card-body">
                        <form action="/updatePostProcess/{{$post['id']}}/{{$thread}}" method="post">
                            {{method_field('PUT')}}
                            {{csrf_field()}}
                            <div class="form-group">
                                <textarea class="form-control" name="body" required>{{$post['body']}}</textarea>
                            </div>
                            <input class="btn btn-outline-primary" type="submit" value="Update It!">
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
