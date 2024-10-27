@extends('layouts.app')

@section('content')
<div class="container">
  <h4 class="mt-2">Resultados para "{{ request('q') }}"</h4>
  <ul class="list-group">
    @forelse ($results as $result)
      @if ($result instanceof App\Models\Category)
      <li class="list-group-item d-flex justify-content-between align-items-center">
        <div>
          <strong>
            <a href="{{ route('sites.categories.edit', [$site, $result]) }}">
              {{ $result->name }}
            </a>
          </strong>
          <p class="m-0">{{ $result->description }}</p>
        </div>
        <div class="text-end">
          <span class="badge text-bg-light">Categoría</span><br>
          <small>{{ $result->updated_at->diffForHumans() }}</small>
        </div>
      </li>
      @elseif ($result instanceof App\Models\Post)
      <li class="list-group-item d-flex justify-content-between align-items-center">
        <div>
          <strong>
            <a href="{{ route('sites.posts.edit', [$site, $result]) }}">
              {{ $result->name }}
            </a>
          </strong>
          <p class="m-0">{{ $result->description }}</p>
        </div>
        <div class="text-end">
          <span class="badge text-bg-light">Post</span><br>
          <small>{{ $result->updated_at->diffForHumans() }}</small>
        </div>
      </li>
      @endif
    @empty
    <li class="list-group-item">No hay resultados</li>
    @endforelse
  </ul>
</div>
@endsection
