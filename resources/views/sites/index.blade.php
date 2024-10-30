@extends('layouts.app')

@section('content')
<div class="container">
  <div class="border-bottom py-3">
    <h1>Dashboard</h1>
  </div>
  <div class="row my-3">
    <div class="col-md-4">
      <h4>Sitios</h4>
      @foreach (Auth::user()->enrollments as $enrollment)
        @include('sites._card', ['site' => $enrollment->site])
      @endforeach
    </div>
  </div>
</div>
@endsection
