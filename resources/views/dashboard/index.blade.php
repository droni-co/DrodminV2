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
      <div class="card shadow mb-3">
        <div class="card-body">
          <h5>{{ $enrollment->site->name }}</h5>
          <p>
            <small>
              <i class="mdi mdi-shield-crown-outline"></i> {{ $enrollment->role }}<br>
              <i class="mdi mdi-update"></i> {{ $enrollment->site->updated_at }}<br>
            </small>
            {{ $enrollment->site->description }}
          </p>
        </div>
      </div>
      @endforeach
    </div>
  </div>
</div>
@endsection
