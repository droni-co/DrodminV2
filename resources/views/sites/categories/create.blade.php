@extends('layouts.app')

@section('content')
<div class="container">
  <div class="border-bottom py-3 d-flex mb-3">
    <h1>Categorías | Crear nueva</h1>
  </div>
  <form action="{{ route('sites.categories.store', $site) }}" method="POST">
    @csrf
    @include('sites.categories._form', $category)
  </form>
</div>
@endsection
