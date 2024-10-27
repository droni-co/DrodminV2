@extends('layouts.app')

@section('content')
  <div class="container">
    <div class="border-bottom py-3 d-flex">
      <h1>Multimedia</h1>
      <div class="flex-grow-1 text-end pt-1 d-flex justify-content-end">
        <form action="" method="GET" class="px-3">
          <input type="search" name="search" class="form-control rounded-pill" placeholder="Buscar...">
        </form>
        <form action="{{ route('sites.attachments.store', $site) }}" method="POST" enctype="multipart/form-data">
          @csrf
          <input type="file" name="file" id="file" class="d-none" onchange="this.form.submit()">
          <label for="file" class="btn btn-outline-primary">
            <i class="mdi mdi-upload"></i>
            Subir archivo
          </label>
        </form>
      </div>
    </div>
    <div class="row my-3">
      @foreach($attachments as $attachment)
        <div class="col-md-3">
          <div class="card shadow">
            <a href="{{ Storage::disk('digitalocean')->url($attachment->path) }}" target="_blank">
              @if(Str::startsWith($attachment->mime_type, 'image'))
                <img src="{{ Storage::disk('digitalocean')->url($attachment->path) }}" class="card-img-top" alt="{{ $attachment->name }}">
              @else
                <img src="/img/docFile.png" class="card-img-top" alt="{{ $attachment->name }}">
              @endif
            </a>
            <div class="card-body d-flex">
              <div class="flex-grow-1">
                <h5 class="m-0">{{ $attachment->name }}</h5>
                <small class="text-secondary">
                  <i class="mdi mdi-calendar"></i> {{ $attachment->created_at->diffForHumans() }}<br>
                  <i class="mdi mdi-sd"></i> {{ Number::fileSize($attachment->size) }}<br>
                </small>
              </div>
              <form action="{{ route('sites.attachments.destroy', [$site, $attachment]) }}" method="POST">
                @csrf
                @method('DELETE')
                <button type="submit" class="btn btn-sm btn-outline-danger">
                  <i class="mdi mdi-delete"></i>
                </button>
              </form>
            </div>
          </div>
        </div>
      @endforeach
      {{ $attachments->links() }}
      <hr>
      <!-- import form -->
      <form action="{{ route('sites.attachments.import', $site) }}" method="POST" enctype="multipart/form-data">
        @csrf
        <div class="input-group mb-3">
          <input type="file" name="file" class="form-control" id="file" required>
          <button type="submit" class="btn btn-outline-primary">Importar</button>
        </div>
      </form>

  </div>
@endsection
