@extends('layouts.app')

@section('content')
<div class="container-fluid">
  <form action="{{ route('sites.posts.store', $site) }}" method="POST" class="row">
    @csrf
    <monaco-editor
      style="min-height: 87vh"
      class="col-md-7 col-lg-8 bg-dark"
      value="{{ old('content', $post->content) }}"
      format="{{ old('format', $post->format) }}"
      name="content">
    </monaco-editor>
    <div class="col-md-5 col-lg-4 py-3 d-flex flex-column border">
      <div class="flex-grow-1">
        @include('sites.posts._form', [$post, $categories])
      </div>
      <div class="d-flex justify-content-between">
        <div>
          <div class="form-floating mb-3">
            <button type="submit" class="btn btn-primary">
              <i class="mdi mdi-content-save"></i>
              Guardar
            </button>
          </div>
        </div>
      </div>
    </div>
  </form>
</div>
@endsection
