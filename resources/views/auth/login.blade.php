@extends('layouts.blank')

@section('content')
<div class="container py-5">
  <div class="row">
    <div class="col-md-4 mx-auto">
      <div class="card">
        <div class="card-body">
          <h5>Bienvenido a Drodmin</h5>
          <p>
            Drodmin es una aplicación web que te permite gestionar sitios web y sus contenidos de manera sencilla.
          </p>
          <a href="{{ route('auth.redirect', 'google') }}" class="btn btn-primary">Login</a>
        </div>
      </div>
    </div>
</div>
@endsection
