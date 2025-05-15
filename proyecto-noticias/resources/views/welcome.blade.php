@extends('layouts.app')

@section('titulo','Inicio')

@section('contenido')
  <div class="text-center py-5">
    <h1>Bienvenido a Mi App de Noticias</h1>
    <p class="lead">Prueba la experiencia de login, registro y CRUD de noticias.</p>
    <a href="{{ route('login.form') }}" class="btn btn-primary">Iniciar sesión</a>
  </div>
@endsection
