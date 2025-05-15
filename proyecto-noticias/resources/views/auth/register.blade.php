@extends('layouts.app')
@section('titulo','Registro')
@section('contenido')
<h2>Registro de Usuario</h2>
@if(session('status'))
  <div class="alert alert-success">{{ session('status') }}</div>
@endif
<form method="POST" action="{{ route('register') }}">
  @csrf
  <div class="mb-3">
    <label class="form-label">Nombre</label>
    <input name="name" class="form-control" required>
  </div>
  <div class="mb-3">
    <label class="form-label">Email</label>
    <input name="email" type="email" class="form-control" required>
  </div>
  <div class="mb-3">
    <label class="form-label">Contraseña</label>
    <input name="password" type="password" class="form-control" required>
  </div>
  <div class="mb-3">
    <label class="form-label">Confirmar Contraseña</label>
    <input name="password_confirmation" type="password" class="form-control" required>
  </div>
  <button class="btn btn-primary">Registrar</button>
</form>
@endsection
