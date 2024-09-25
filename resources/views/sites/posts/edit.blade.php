@extends('layouts.app')

@section('content')
<div class="container-fluid">
  <form action="{{ route('sites.posts.update', [$site, $post]) }}" method="POST" class="row">
    @csrf
    @method('PUT')
    <textarea name="content" id="content" class="col-md-7 col-lg-8 bg-dark border-0 text-white">{{ old('content', $post->content) }}</textarea>
    <div class="col-md-5 col-lg-4 py-3">
      @include('sites.posts._form', $post)
    </div>
  </form>
</div>
@endsection
