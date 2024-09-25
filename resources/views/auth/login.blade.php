@extends('layouts.blank')

@section('content')
<div class="container py-5">
  <div class="row">
    <div class="col-md-4 mx-auto">
      <div class="card mb-4">
        <div class="card-body">
          <h5>Bienvenido a Drodmin</h5>
          <p>
            Drodmin es una aplicación web que te permite gestionar sitios web y sus contenidos de manera sencilla.
          </p>
          <a href="{{ route('auth.redirect', 'google') }}" class="btn btn-primary">Login</a>
        </div>
      </div>
      <p class="text-center">
        &copy; 2024. Construido con trabajo duro y mucho café por el equipo de
        <a href="//droni.co" target="_blank" title="Droni.co | Desarrollo inteligente">
          Droni.co
        </a>
      </p>
    </div>
</div>
@endsection
