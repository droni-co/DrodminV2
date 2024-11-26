@extends('layouts.app')

@section('content')
  <div class="container">
    <div class="border-bottom py-3 d-flex">
      <h1>Usuarios</h1>
      <div class="flex-grow-1 text-end pt-1 d-flex justify-content-end">
        <form action="{{ route('sites.enrollments.store', $site) }}" method="POST" class="px-3 d-flex">
          @csrf
          <input type="email" name="email" class="form-control rounded-end-0" placeholder="Email" required>
          <select name="role" class="form-select rounded-0">
            <option value="member">Miembro</option>
            <option value="admin">Administrador</option>
          </select>
          <button type="submit" class="btn btn-outline-primary rounded-start-0">
            <i class="mdi mdi-account-plus"></i>
          </button>
        </form>
      </div>
    </div>
    <table class="table table-striped">
      <thead>
        <tr>
          <th>Nombre</th>
          <th>Correo</th>
          <th>Rol</th>
          <th>TimeStamps</th>
        </tr>
      </thead>
      <tbody>
        @foreach ($enrollments as $enrollment)
          <tr>
            <td>{{ $enrollment->user->name }}</td>
            <td>{{ $enrollment->user->email }}</td>
            <td>{{ $enrollment->role }}</td>
            <td>
              <small>
                <i class="mdi mdi-calendar"></i> {{ $enrollment->created_at }}<br>
                <i class="mdi mdi-update"></i> {{ $enrollment->updated_at }}
              </small>
            </td>
          </tr>
        @endforeach
      </tbody>
    </table>
    {{ $enrollments->links() }}
  </div>
@endsection
