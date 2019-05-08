@extends('layouts.app')

@section('title', 'Update Post')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-4">
                <div class="card bg-light">
                    <div class="card-header">Add Your Thread</div>

                    <div class="card-body">
                        <form action="/addThreadProcess" method="post">
                            {{csrf_field()}}
                            <div class="form-group">
                                <input class="form-control" name="title" placeholder="Title" required>
                            </div>
                            <div class="form-group">
                                <textarea class="form-control" name="body" placeholder="Body" required></textarea>
                            </div>
                            <input class="btn btn-outline-success" type="submit" value="Add It!">
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
