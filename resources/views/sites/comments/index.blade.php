@extends('layouts.app')

@section('content')
  <div class="container">
    <div class="border-bottom py-3 d-flex">
      <h1>Comentarios</h1>
    </div>
    @foreach ($comments as $comment)
      @include('sites.comments._card', ['comment' => $comment])
    @endforeach
    {{ $comments->links() }}
  </div>
@endsection
