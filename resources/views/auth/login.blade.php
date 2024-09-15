@extends('layouts.blank')

@section('content')
<div class="container">
  <div class="row py-5">
    <div class="col-md-6 mx-auto">
      <img src="/img/brand.png" alt="Drodmin" class="img-fluid my-4 px-5">
      <div class="card shadow">
        <div class="card-header">
          Bienvenido a Drodmin
        </div>
        <div class="card-body">
          <p>Drodmin es una plataforma open source para administrar proyectos de software basados en Apis de manera eficiente.</p>
          <a href="{{ route('auth.redirect', 'google') }}" class="btn btn-primary">
            <i class="mdi mdi-google"></i>
            Iniciar sesión con Google
          </a>
        </div>
      </div>
    </div>
  </div>
</div>

@endsection

