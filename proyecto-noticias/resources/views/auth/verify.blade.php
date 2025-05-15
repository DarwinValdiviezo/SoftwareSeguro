@extends('layouts.app')
@section('titulo','Verificación de Código')
@section('contenido')
  <h2 class="mb-4">Verificación de Dos Pasos</h2>

  <p>Hemos enviado un código de 6 dígitos a tu correo.</p>

  <form method="POST" action="{{ route('verify.post') }}">
    @csrf

    <div class="mb-3">
      <input
        name="code"
        type="text"
        class="form-control"
        placeholder="Código de 6 dígitos"
        required
      >
      @error('code')
        <div class="text-danger mt-1">{{ $message }}</div>
      @enderror
    </div>

    <button class="btn btn-primary">Verificar</button>
  </form>
@endsection
