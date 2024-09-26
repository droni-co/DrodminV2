@extends('layouts.app')

@section('content')
  <div class="container">
    <div class="border-bottom py-3 d-flex">
      <h1>Categorías</h1>
      <div class="flex-grow-1 text-end pt-1">
        <a href="{{ route('sites.categories.create', $site) }}" class="btn btn-outline-primary">
          <i class="mdi mdi-plus"></i>
          Crear nueva
        </a>
      </div>
    </div>
    <table class="table table-striped table-hover">
      <thead>
        <tr>
          <th>Categoría</th>
          <th>Descripción</th>
          <th>Imagen</th>
          <th>Posts</th>
          <th>TimeStamps</th>
        </tr>
      </thead>
      <tbody>
        @foreach ($categories as $category)
        <tr>
          <td>
            <a href="{{ route('sites.categories.edit', [$site, $category]) }}">
              <strong>{{ $category->name }}</strong>
            </a>
            <small class="d-block text-muted">/{{ $category->slug }}</small>
          </td>
          <td>
            <p>{{ $category->description }}</p>
          </td>
          <td>
            @if($category->picture)
              <img src="{{ $category->picture }}" alt="{{ $category->name }}" class="img-thumbnail" style="width: 100px;">
            @endif
          </td>
          <td>
            {{ $category->posts->count() }}
          <td>
            <small>
              <i class="mdi mdi-calendar"></i> {{ $category->created_at }}<br>
              <i class="mdi mdi-update"></i> {{ $category->updated_at }}
            </small>
          </td>
        </tr>
        @endforeach
      </tbody>
    </table>
    {{ $categories->links() }}
  </div>
@endsection
