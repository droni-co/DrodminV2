@extends('layouts.app')

@section('content')
<div class="container py-5">
  <div class="row">
    <div class="col col-md-6">
      @foreach ($enrollments as $enrollment)
      <div class="card shadow">
        <div class="card-header">
          <h4 class="mb-0">
            {{ $enrollment->site->name }}
          </h4>
          <small>
            Dominio: {{ $enrollment->site->domain }} |
            Rol: {{ $enrollment->role }}
          </small>
        </div>
        <div class="card-body">
          <p>{{ $enrollment->site->description }}</p>
        </div>
        <div class="card-footer">
          <a
            href="//{{ $enrollment->site->domain }}"
            target="_blank"
            class="btn">
            <i class="mdi mdi-open-in-new"></i>
            Ir al sitio
          </a>
          <a
            href="{{ route('sites.posts.index', $enrollment->site) }}"
            class="btn">
            <i class="mdi mdi-post-outline"></i>
            Posts
          </a>
        </div>
      </div>
      @endforeach
    </div>
  </div>
</div>
@endsection
