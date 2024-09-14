@extends('layouts.app')

@section('content')
<v-container>
  <v-row>
    <v-col cols="6">
      @foreach ($enrollments as $enrollment)
      <v-card>
        <v-card-title>{{ $enrollment->site->name }}</v-card-title>
        <v-card-subtitle>
          Dominio: {{ $enrollment->site->domain }} |
          Rol: {{ $enrollment->role }}
        </v-card-subtitle>
        <v-card-text>
          <p>{{ $enrollment->site->description }}</p>
        </v-card-text>
        <v-card-actions>
          <v-btn
            href="//{{ $enrollment->site->domain }}"
            target="_blank"
            color="secondary"
            append-icon="mdi-open-in-new">
            Ir al sitio
          </v-btn>
        </v-card-actions>
      </v-card>
      @endforeach
    </v-col>
  </v-row>
</v-container>
@endsection
