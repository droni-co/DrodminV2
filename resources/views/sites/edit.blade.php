@extends('layouts.app')

@section('content')
<div class="container">
  <div class="border-bottom py-3">
    <h1>{{ $site->name }}</h1>
  </div>
  <div class="row my-3">
    <div class="col-md-8">
      <form action="{{ route('sites.update', $site) }}" method="POST">
        @csrf
        @method('PUT')
        <div class="form-floating mb-3">
          <input type="text" class="form-control" id="name" name="name" placeholder="Nombre del sitio" required value="{{ old('name', $site->name) }}">
          <label for="name">Nombre del sitio</label>
        </div>
        <div class="form-floating mb-3">
          <textarea class="form-control" placeholder="Descripción" id="description" name="description" style="height: 100px;">{{ old('description', $site->description) }}</textarea>
          <label for="floatingTextarea">Descripción</label>
        </div>
        <div class="mb-3">
          <label for="picture">Imagen</label>
          <attachment-input site-id="{{ $site->id }}" name="picture" accept="" value="{{ old('picture', $site->picture) }}"></attachment-input>
        </div>
        <div class="form-floating mb-3">
          <button type="submit" class="btn btn-primary">
            <i class="mdi mdi-content-save"></i>
            Guardar
          </button>
        </div>
      </form>
    </div>
    <div class="col-md-4">
      <attrs-component
        :site="{{ $site->toJson() }}"
        :attrs="{{ $site->attrs->toJson() }}"
        :attributable="{id: null}"
        attributable-type="App\Models\Site"
        >
      </attrs-component>
    </div>
  </div>
</div>
@endsection
