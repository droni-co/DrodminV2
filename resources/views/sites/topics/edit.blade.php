@extends('layouts.app')

@section('content')
<div class="container">
  <div class="border-bottom py-3">
    <h1>Editar tema: {{ $topic->name }}</h1>
  </div>
  <div class="row my-3">
    <div class="col-md-8">
      {{ $topic->content }}
      <hr>
      <h3>Respuestas</h3>
      @foreach ($topic->comments as $comment)
        @include('sites.comments._card', ['comment' => $comment])
      @endforeach
    </div>
    <div class="col-md-4">
      <form action="{{ route('sites.topics.update',[$site, $topic]) }}" method="POST">
        @csrf
        @method('PUT')
        <p>
          <i class="mdi mdi-account"></i> {{ $topic->user->name }}<br>
          <i class="mdi mdi-reply-all-outline"></i> {{ $topic->comments->count() }}<br>
          <i class="mdi mdi-folder-outline"></i> {{ $topic->group }}<br>
          <small class="d-block text-muted">
            {{ $topic->group }}/{{ $topic->slug }}
          </small><br>

          <small>
            <i class="mdi mdi-calendar"></i> {{ $topic->created_at }}<br>
            <i class="mdi mdi-update"></i> {{ $topic->updated_at }}
          </small>
        </p>
        <div class="form-check form-switch mb-3">
          <input class="form-check-input" type="checkbox" id="approved_at" name="approved_at" value="1" {{ old('approved_at', $topic->approved_at) ? 'checked' : '' }}>
          <label class="form-check-label" for="approved_at">¿Está activo? {{ $topic->approved_at }}</label>
        </div>
        <div class="form-floating mb-3">
          <button type="submit" class="btn btn-primary">
            <i class="mdi mdi-content-save"></i>
            Guardar
          </button>
        </div>
      </form>
    </div>
  </div>
</div>
@endsection
