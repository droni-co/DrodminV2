@extends('layouts.app')

@section('content')
<div class="container-fluid">
  <form action="{{ route('sites.posts.store', $site) }}" method="POST" class="row">
    <textarea name="content" id="content" class="col-md-7 col-lg-8 bg-dark border-0 text-white">
      Editor
    </textarea>
    <div class="col-md-5 col-lg-4 py-3">
      @csrf
      @include('sites.posts._form', $post)
    </div>
  </form>
</div>
@endsection
