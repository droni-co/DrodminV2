@extends('layouts.app')

@section('content')
<div class="container">
  <h1>Posts</h1>

  <table>
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
    <tr>
      <td>Example Title</td>
      <td>Example Content</td>
      <td>Example Author</td>
      <td>Example Created At</td>
      <td>Example Updated At</td>
    </tr>

  </tbody>
  </table>
</div>
@endsection
