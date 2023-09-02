@extends('layouts.app')

@section('title', "$post->title")

@section('content')  
<div class="container">
    <article class="blog-post">
        <h2 class="blog-post-title mb-1">{{ $post->title }}</h2>
        <p class="blog-post-meta">{{ date('d M Y H:i'), strtotime($post->created_at) }} by</p>

        <p>{{ $post->content }}</p>

        {{-- <small class="text-muted">{{ count($comments) }} Komentar</small> --}}
        <small class="text-muted">{{ $count }} Komentar</small>

        @foreach ($comments as $comment)
            <div class="card mb-3">
                <div class="card-body">
                    <p style="font-size: 8pt">{{ $comment->comment }}</p>
                </div>
            </div> 
        @endforeach
    </article>
    <a href="{{ url("posts") }}">Kembali</a>
</div>
@endsection