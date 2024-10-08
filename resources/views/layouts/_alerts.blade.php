@include('flash::message')
@if ($errors->any())
  <div class="alert alert-danger m-0 rounded-0">
    <ul class="mb-0">
      @foreach ($errors->all() as $error)
        <li>{{ $error }}</li>
      @endforeach
    </ul>
  </div>
@endif
