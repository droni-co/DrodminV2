<div class="card shadow mb-3">
  <div class="card-body">
    <div class="d-flex">
      <div class="flex-grow-1">
        <a href="{{ route('sites.show', $enrollment->site)}}" title="{{ $enrollment->site->name }}">
          <h5>{{ $enrollment->site->name }}</h5>
        </a>
      </div>
      <div>
        <a href="{{ route('sites.edit', $enrollment->site) }}" class="btn btn-sm btn-outline-secondary">
          <i class="mdi mdi-pencil"></i>
        </a>
      </div>
    </div>
    <p>
      <small>
        <i class="mdi mdi-shield-crown-outline"></i> {{ $enrollment->role }}<br>
        <i class="mdi mdi-update"></i> {{ $enrollment->site->updated_at }}<br>
      </small>
      {{ $enrollment->site->description }}
    </p>
  </div>
</div>
