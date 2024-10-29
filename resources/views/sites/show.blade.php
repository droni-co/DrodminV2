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

        @foreach($lastComments as $comment)
          @include('sites.comments._card', ['comment' => $comment])
        @endforeach
    </div>
  </div>
</div>
@endsection
