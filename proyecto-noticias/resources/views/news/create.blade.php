@extends('layouts.app')
@section('titulo','Crear Noticia')
@section('contenido')
  <h2>Nueva Noticia</h2>
  <form method="POST" action="{{ route('news.store') }}">
    @csrf
    <div class="mb-3">
      <label class="form-label">Título</label>
      <input name="title" class="form-control" required>
      @error('title') <div class="text-danger">{{ $message }}</div> @enderror
    </div>
    <div class="mb-3">
      <label class="form-label">Contenido</label>
      <textarea name="content" rows="6" class="form-control" required></textarea>
      @error('content') <div class="text-danger">{{ $message }}</div> @enderror
    </div>
    <button class="btn btn-success">Guardar</button>
  </form>
@endsection
