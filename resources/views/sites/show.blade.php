@extends('layouts.app')

@section('content')
<div class="container">
  <div class="border-bottom py-3">
    <h1>{{ $site->name }}</h1>
  </div>
  <div class="row my-3">
    <div class="col-md-4">
      <h4>Últimos posts</h4>
      <ul class="list-group mb-3">
        @foreach($lastPosts as $post)
          <li class="list-group-item">
            <strong>
              <a href="{{ route('sites.posts.edit', [$site, $post]) }}">
                {{ $post->name }}
              </a>
            </strong>
            <p class="text-muted m-0">
              <small>
                {{ $post->updated_at->diffForHumans() }}
              </small><br>
              {{ $post->description }}
            </p>
          </li>
        @endforeach
      </ul>
    </div>
    <div class="col-md-8">
      <h4>Últimos comentarios</h4>
      <ul class="list-group">
        @foreach($lastComments as $comment)
          <li class="list-group-item">
            <p class="m-0">
              <small class="text-muted">
                {{ $comment->updated_at->diffForHumans() }} por
                {{ $comment->user->name }} en
                {{ $comment->commentable->name }}
              </small><br>
              {{ $comment->content }}
            </p>
          </li>
        @endforeach
      </ul>
    </div>
  </div>
</div>
@endsection
