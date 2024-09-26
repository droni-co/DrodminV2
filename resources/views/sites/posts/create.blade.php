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
    <div class="col-md-5 col-lg-4 py-3">
      @include('sites.posts._form', $post)
    </div>
  </form>
</div>
@endsection
