@extends('layouts.app')

@section('content')
  <div class="container">
    <div class="border-bottom py-3 d-flex">
      <h1>Multimedia</h1>
      <div class="flex-grow-1 text-end pt-1">
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
    <div class="row">
      @foreach ($attachments as $attachment)
        <div class="col-md-2">
          <div class="card">
            <img src="{{ Storage::disk('digitalocean')->url($attachment->path) }}" class="card-img-top" alt="{{ $attachment->name }}">
            <form action="{{ route('sites.attachments.destroy', [$site, $attachment]) }}" method="POST">
              @csrf
              @method('DELETE')
              <button type="submit" class="btn btn-danger">
                <i class="mdi mdi-delete"></i>
              </button>
            </form>
          </div>
        </div>
      @endforeach

  </div>
@endsection
