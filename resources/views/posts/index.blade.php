@extends('layouts.app')

@section('content')
    <a href="#" class="btn btn">Go back</a>
    <h1>Posts</h1>
    @if(count($posts) > 0)
        @foreach($posts as $post)
            <div class="card">
                <div class="row">
                    <div class="col-md-4 col-sm-4">
                        <img class="img-fluid" src="/storage/cover_images/{{$post->cover_image}}">
                    </div>
                    <div class="col-md-8 col-sm-8" style="position: relative">
                        <h3><a href="/posts/{{$post->id}}">{{$post->title}}</a></h3>
                        <small>Written on {{$post->created_at}} by {{$post->user['name']}}</small>
                    </div>
                </div>
            </div>
        @endforeach
        {{$posts->links()}}
    @else
        <p>NOT FOUND</p>
    @endif
@endsection