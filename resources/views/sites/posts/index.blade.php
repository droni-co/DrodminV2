@extends('layouts.app')

@section('content')
<div class="container py-5">
  <a href="{{ route('sites.posts.create', $site) }}" class="btn btn-primary mb-3 float-end">
    <i class="mdi mdi-plus"></i>
    Crear Post
  </a>
  <h1>Posts</h1>
  <table class="table table-striped shadow">
  <thead>
    <tr>
      <th scope="col">Title</th>
      <th scope="col">Content</th>
      <th scope="col">Author</th>
      <th scope="col">Created At</th>
      <th scope="col">Updated At</th>
    </tr>
  </thead>
  <tbody>
    @foreach($posts as $post)
      <tr>
        <td>{{ $post->title }}</td>
        <td>{{ $post->content }}</td>
        <td>{{ $post->user->name }}</td>
        <td>{{ $post->created_at }}</td>
        <td>{{ $post->updated_at }}</td>
      </tr>
    @endforeach
  </tbody>
  </table>

  <div class="d-flex justify-content-center">
    {{ $posts->links() }}
  </div>
</div>
@endsection
