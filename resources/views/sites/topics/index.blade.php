@extends('layouts.app')

@section('content')
  <div class="container">
    <div class="border-bottom py-3 d-flex">
      <h1>Temas en foros</h1>
      <div class="flex-grow-1 text-end pt-1 d-flex justify-content-end">
        <form action="" method="GET" class="px-3 d-flex">
          <select name="category" class="form-select rounded-start-pill">
            <option value="">Todas las categorías</option>
          </select>
          <input type="search" name="search" class="form-control rounded-0" placeholder="Buscar..." value="{{ request('search') }}">
          <button type="submit" class="btn btn-outline-primary rounded-end-pill pe-3">
            <i class="mdi mdi-magnify"></i>
          </button>
        </form>
      </div>
    </div>
    <table class="table table-striped table-hover">
      <thead>
        <tr>
          <th>Info</th>
          <th>Tema</th>
          <th>TimeStamps</th>
        </tr>
      </thead>
      <tbody>
        @foreach ($topics as $topic)
        <tr>
          <td>
            <i class="mdi mdi-account"></i> {{ $topic->user->name }}<br>
            <i class="mdi mdi-reply-all-outline"></i> {{ $topic->comments->count() }}<br>
            <i class="mdi mdi-folder-outline"></i> {{ $topic->group }}<br>
          </td>
          <td>
            <a href="{{ route('sites.topics.edit', [$site, $topic]) }}">
              <strong>{{ $topic->name }}</strong>
            </a>
            <small class="d-block text-muted">
              {{ $topic->group }}/{{ $topic->slug }}
            </small>
            <small>{{ str()->words($topic->content, 30) }}</small>
          </td>
          <td class="{{ !$topic->approved_at ? 'bg-danger text-white' : '' }}">
            <small>
              <i class="mdi mdi-calendar"></i> {{ $topic->created_at }}<br>
              <i class="mdi mdi-update"></i> {{ $topic->updated_at }}
            </small>
          </td>
        </tr>
        @endforeach
      </tbody>
    </table>
    {{ $topics->links() }}
  </div>
@endsection
