@extends('layouts.app')

@section('content')
  <div class="container">
    <div class="border-bottom py-3 d-flex">
      <h1>Leads</h1>
    </div>
    <table class="table table-striped table-hover">
      <thead>
        <tr>
          <th>Lead</th>
          <th>Mensaje</th>
          <th>Info</th>
          <th>Comentarios</th>
          <th>TimeStamps</th>
        </tr>
      </thead>
      <tbody>
        @foreach ($leads as $lead)
        <tr>
          <td>
            <a href="{{ route('sites.leads.edit', [$site, $lead]) }}">
              <strong>{{ $lead->name }}</strong>
            </a>
            <small class="d-block text-muted">
              <i class="mdi mdi-email"></i> {{ $lead->email }} |
              <i class="mdi mdi-phone"></i> {{ $lead->phone }} |
              <i class="mdi mdi-map-marker"></i> {{ $lead->location }}
            </small>
          </td>
          <td>
            <strong>{{ $lead->subject }}</strong>
            <p>{{ $lead->message }}</p>
            <small class="d-block text-muted">
              {{ $lead->referrer }}
            </small>
          </td>
          <td>
            {{ $lead->info }}
          </td>
          <td>
            {{ $lead->comments }}
          <td>
            <small>
              <i class="mdi mdi-calendar"></i> {{ $lead->created_at }}<br>
              <i class="mdi mdi-update"></i> {{ $lead->updated_at }}
            </small>
          </td>
        </tr>
        @endforeach
      </tbody>
    </table>
    {{ $leads->links() }}
  </div>
@endsection
