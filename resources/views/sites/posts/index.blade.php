@extends('layouts.app')

@section('content')
  <div class="container">
    <div class="border-bottom py-3 d-flex">
      <h1>Posts</h1>
      <div class="flex-grow-1 text-end pt-1">
        <a href="{{ route('sites.posts.create', $site) }}" class="btn btn-outline-primary">
          <i class="mdi mdi-plus"></i>
          Crear nuevo
        </a>
      </div>
    </div>
    <table class="table table-striped table-hover">
      <thead>
        <tr>
          <th>Título</th>
          <th>Info</th>
          <th>Formato</th>
          <th>Imagen</th>
          <th>TimeStamps</th>
        </tr>
      </thead>
      <tbody>
        @foreach ($posts as $post)
        <tr>
          <td>
            <a href="{{ route('sites.posts.edit', [$site, $post]) }}">
              <strong>{{ $post->name }}</strong>
            </a>
            <small class="d-block text-muted">/{{ $post->slug }}</small>
          </td>
          <td>
            <i class="mdi mdi-account"></i> {{ $post->user->name }}<br>
            <i class="mdi mdi-folder-multiple-outline"></i> {{ $post->categories->count() }}<br>
          </td>
          <td>{{ $post->format }}</td>
          <td>
            @if($post->picture)
            <a href="{{ $post->picture }}" class="btn btn-sm btn-outline-info" target="_blank">
              Imagen
              <i class="mdi mdi-open-in-new"></i>
            </a>
            @endif
          </td>
          <td class="{{ !$post->active ? 'bg-danger text-white' : '' }}">
            <small>
              <i class="mdi mdi-calendar"></i> {{ $post->created_at }}<br>
              <i class="mdi mdi-update"></i> {{ $post->updated_at }}
            </small>
          </td>
        </tr>
        @endforeach
      </tbody>
    </table>
    {{ $posts->links() }}
  </div>
@endsection
