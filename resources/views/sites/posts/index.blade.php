@extends('layouts.app')

@section('content')
  <div class="container">
    <div class="border-bottom py-3 d-flex">
      <h1>Posts</h1>
      <div class="flex-grow-1 text-end pt-1">
        <a href="{{ route('sites.posts.create', $site) }}" class="btn btn-outline-primary">
          <i class="mdi mdi-plus"></i>
          Crear nuevo
        </a>
      </div>
    </div>
    <table class="table table-striped">
      <thead>
        <tr>
          <th>Title</th>
          <th>Site</th>
          <th>Author</th>
          <th>Created At</th>
          <th>Updated At</th>
        </tr>
      </thead>
      <tbody>
        @foreach ($posts as $post)
        <tr>
          <td>{{ $post->title }}</td>
          <td>{{ $post->site->name }}</td>
          <td>{{ $post->user->name }}</td>
          <td>{{ $post->created_at }}</td>
          <td>{{ $post->updated_at }}</td>
        </tr>
        @endforeach
      </tbody>
    </table>
  </div>
@endsection
