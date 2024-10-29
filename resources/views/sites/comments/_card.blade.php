<div class="card">
  <div class="p-2">
    <small>
      <i class="mdi mdi-account"></i>
      {{ $comment->user->name }}
      <i class="mdi mdi-pencil-box-multiple-outline"></i>
      {{ $comment->commentable->name }}
      <i class="mdi mdi-calendar"></i>
      {{ $comment->created_at }}
    </small>
    @if($comment->parent)
    <div class="text-secondary">
      <strong>Respuesta a:</strong>
      <pre>{{ $comment->parent->content }}</pre>
    </div>
    @endif
    <pre>{{ $comment->content }}</pre>

    <form action="{{ route('sites.comments.destroy', [$site, $comment]) }}" method="POST">
      @csrf
      @method('DELETE')
      <button type="submit" class="btn btn-sm btn-danger">Eliminar</button>
    </form>

    
    
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
    <div class="dropdown">
      <button class="btn btn-secondary dropdown-toggle" type="button" data-bs-toggle="dropdown" aria-expanded="false">
        Dropdown button
      </button>
      <ul class="dropdown-menu">
        <li><a class="dropdown-item" href="#">Action</a></li>
        <li><a class="dropdown-item" href="#">Another action</a></li>
        <li><a class="dropdown-item" href="#">Something else here</a></li>
      </ul>
    </div>
  </div>
</div>
