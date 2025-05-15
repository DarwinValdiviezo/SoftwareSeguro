{{-- resources/views/auth/login.blade.php --}}
@extends('layouts.app')

@section('titulo', 'Iniciar sesión')

@section('contenido')
  <h2 class="mb-4">Login de Usuario</h2>

  @if(session('status'))
    <div class="alert alert-success">{{ session('status') }}</div>
  @endif

  @error('login')
    <div class="alert alert-danger">{{ $message }}</div>
  @enderror

  <form method="POST" action="{{ route('login') }}">
    @csrf

    <div class="mb-3">
      <label for="email" class="form-label">Email</label>
      <input
        id="email"
        type="email"
        name="email"
        value="{{ old('email') }}"
        class="form-control"
        required
        autofocus
      >
    </div>

    <div class="mb-3">
      <label for="password" class="form-label">Contraseña</label>
      <input
        id="password"
        type="password"
        name="password"
        class="form-control"
        required
      >
    </div>

    <div class="form-check mb-4">
      <input
        id="seguro"
        class="form-check-input"
        type="checkbox"
        name="seguro"
        {{ old('seguro', true) ? 'checked' : '' }}
      >
      <label for="seguro" class="form-check-label">
        Modo seguro (protección contra SQLi)
      </label>
    </div>

    <button type="submit" class="btn btn-primary w-100 mb-3">
      Iniciar sesión
    </button>
  </form>

  <div class="text-center mb-3">— o —</div>

  <a href="{{ route('social.redirect') }}" class="btn btn-danger w-100 mb-4">
    Iniciar con Google
  </a>

  <p class="text-center">
    ¿No tienes cuenta?
    <a href="{{ route('register.form') }}">Regístrate aquí</a>
  </p>
@endsection
