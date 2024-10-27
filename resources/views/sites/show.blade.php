@extends('layouts.app')

@section('content')
<div class="container">
  <div class="border-bottom py-3">
    <h1>{{ $site->name }}</h1>
  </div>
  <div class="row my-3">
    <div class="col-md-4">
      <h4>Dashboard de {{ $site->name }}</h4>
      
    </div>
  </div>
</div>
@endsection
