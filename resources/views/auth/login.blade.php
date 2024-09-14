@extends('layouts.blank')

@section('content')
<v-container>
  <v-row justify="center">
    <v-col cols="4">
      <v-img src="/img/brand.png" class="my-4"></v-img>
      <v-card>
        <v-card-title>Bienvenido a Drodmin</v-card-title>
        <v-card-text>
          <p>Drodmin es una plataforma open source para administrar proyectos de software basados en Apis de manera eficiente.</p>
        </v-card-text>
        <v-card-actions>
          <v-btn
            href="{{ route('auth.redirect', 'google') }}"
            color="primary"
            append-icon="mdi-google">
            Iniciar sesión con Google
          </v-btn>
        </v-card-actions>
      </v-card>
    </v-col>
  </v-row>
</v-container>

@endsection

