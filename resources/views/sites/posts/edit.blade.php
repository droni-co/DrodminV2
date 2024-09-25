@extends('layouts.app')

@section('content')
<div class="container-fluid">
  <form action="{{ route('sites.posts.update', [$site, $post]) }}" method="POST" class="row">
    @csrf
    @method('PUT')
    <textarea name="content" id="content" class="col-md-7 col-lg-8 bg-dark border-0 text-white">{{ old('content', $post->content) }}</textarea>
    <div class="col-md-5 col-lg-4 py-3">
      @include('sites.posts._form', $post)

      <div class="input-group mb-3">
        <input type="text" form="delete" class="form-control is-invalid" name="validator" placeholder="Escribe '{{ $post->slug }}' para borrar">
        <button type="submit" form="delete" class="btn btn-sm btn-outline-danger">
          <i class="mdi mdi-delete"></i>
          Eliminar
        </button>
      </div>
    </div>
  </form>
  <form id="delete" action="{{ route('sites.posts.destroy', [$site, $post]) }}" method="POST" class="d-none">
    @csrf
    @method('DELETE')
  </form>
</div>
@endsection
