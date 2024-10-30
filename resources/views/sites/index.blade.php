@extends('layouts.app')

@section('content')
<div class="container">
  <div class="border-bottom py-3">
    <h1>Dashboard</h1>
  </div>
  <div class="row my-3">
    @foreach (Auth::user()->enrollments as $enrollment)
      <div class="col-md-4">
        @include('sites._card', ['site' => $enrollment->site])
      </div>
    @endforeach
  </div>
</div>
@endsection
