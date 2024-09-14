@extends('layouts.blank')

@section('content')
<v-container>
  <v-row justify="center">
    <v-col cols="4">
      <v-card>
        <v-card-title>Login</v-card-title>
        <v-card-text>
          <v-btn
            href="{{ route('auth.redirect', 'google') }}"
            append-icon="mdi-google">
            Login with google
          </v-btn>
        </v-card-text>
      </v-card>
    </v-col>
  </v-row>
</v-container>

@endsection

