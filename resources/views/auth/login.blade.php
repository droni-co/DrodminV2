@extends('layouts.blank')

@section('content')
<a href="{{ route('auth.redirect', 'google') }}">Login with google</a>
@endsection

