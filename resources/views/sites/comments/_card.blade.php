<div class="card mb-2">
  <div class="p-2">
    <div class="d-flex">
      <div class="flex-grow-1">
        <small class="{{ $comment->approved_at ? '' : 'text-danger' }}">
          {{ $comment->approved_at ? '' : 'Pendiente' }}
          <i class="mdi mdi-account"></i>
          {{ $comment->user->name }}
          <i class="mdi mdi-pencil-box-multiple-outline"></i>
          {{ $comment->commentable->name ?? 'falla' }}
          <i class="mdi mdi-calendar"></i>
          {{ $comment->created_at }}
        </small>
      </div>
      <div class="dropdown">
        <button class="btn dropdown-toggle" type="button" data-bs-toggle="dropdown" aria-expanded="false">
          <i class="mdi mdi-cog-outline"></i>
        </button>
        <ul class="dropdown-menu dropdown-menu-lg-end">
          @if(!$comment->approved_at)
          <li>
            <form action="{{ route('sites.comments.update', [$site, $comment]) }}" method="POST">
              @csrf
              @method('PATCH')
              <input type="hidden" name="approved_at" value="{{ $comment->approved }}">
              <button type="submit" class="dropdown-item">Aprobar</button>
            </form>
          </li>
          @endif
          <li>
            <form action="{{ route('sites.comments.destroy', [$site, $comment]) }}" method="POST">
              @csrf
              @method('DELETE')
              <button type="submit" class="dropdown-item text-danger">Eliminar</button>
            </form>
          </li>
        </ul>
      </div>
    </div>
    <small>{{ $comment->content }}</small>
    @foreach ($comment->children as $child)
      @include('sites.comments._card', ['comment' => $child])
    @endforeach
  </div>
</div>
