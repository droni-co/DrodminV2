@extends('layouts.app')

@section('content')
<div class="container">
  <div class="border-bottom py-3 d-flex mb-3">
    <h1>Categorías | Editar</h1>
  </div>
  <form action="{{ route('sites.categories.update', [$site, $category]) }}" method="POST">
    @csrf
    @method('PUT')
    @include('sites.categories._form', $category)

    <div class="input-group mb-3">
      <input type="text" form="delete" class="form-control is-invalid" name="validator" placeholder="Escribe '{{ $category->slug }}' para borrar">
      <button type="submit" form="delete" class="btn btn-sm btn-outline-danger">
        <i class="mdi mdi-delete"></i>
        Eliminar
      </button>
    </div>
  </form>
  <form id="delete" action="{{ route('sites.categories.destroy', [$site, $category]) }}" method="POST" class="d-none">
    @csrf
    @method('DELETE')
  </form>
</div>
@endsection
