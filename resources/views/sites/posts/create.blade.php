@extends('layouts.app')

@section('content')
<div class="container py-5">
  <h1>Crear nuevo post</h1>
  <form action="{{ route('sites.posts.store', $site) }}" method="POST">
    @csrf
    <div class="form-group">
      <label for="title">Título</label>
      <input type="text" class="form-control" id="title" name="title" required>
    </div>
    <div class="form-group">
      <label for="content">Contenido</label>
      <textarea class="form-control" id="content" name="content" rows="3" required></textarea>
    </div>
    <button type="submit" class="btn btn-primary">Crear</button>
</div>
@endsection
