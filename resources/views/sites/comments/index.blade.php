@extends('layouts.app')

@section('content')
  <div class="container">
    <div class="border-bottom py-3 d-flex">
      <h1>Comentarios</h1>
    </div>
    <table class="table table-striped table-hover">
      <thead>
        <tr>
          <th>Info</th>
          <th>Comentario</th>
          <th>TimeStamps</th>
        </tr>
      </thead>
      <tbody>
        @foreach ($comments as $comment)
        <tr>
          <td>
            <a href="{{ route('sites.posts.edit', [$site, $comment]) }}">
              Post: <strong>{{ $comment->post->name }}</strong>
            </a><br>
            Usuario: <strong>{{ $comment->user->name }}</strong>

            <form action="{{ route('sites.comments.destroy', [$site, $comment]) }}" method="POST">
              @csrf
              @method('DELETE')
              <button type="submit" class="btn btn-sm btn-danger">Eliminar</button>
            </form>
          </td>
          <td>
            <pre>{{ $comment->content }}</pre>
            @if(!$comment->approved_at)
            <form action="{{ route('sites.comments.update', [$site, $comment]) }}" method="POST">
              @csrf
              @method('PATCH')
              <input type="hidden" name="approved_at" value="{{ $comment->approved }}">
              <button type="submit" class="btn btn-sm btn-{{ $comment->approved_at ? 'danger' : 'success' }}">
                {{ $comment->approved_at ? 'Desaprobar' : 'Aprobar' }}
              </button>
            </form>
            @endif
          </td>
          <td class="{{ !$comment->approved_at ? 'bg-danger text-white' : '' }}">
            <small>
              <i class="mdi mdi-calendar"></i> {{ $comment->created_at }}<br>
              <i class="mdi mdi-update"></i> {{ $comment->updated_at }}
            </small>
          </td>
        </tr>
        @endforeach
      </tbody>
    </table>
    {{ $comments->links() }}
  </div>
@endsection
