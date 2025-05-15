@extends('layouts.app')
@section('titulo','Editar Noticia')
@section('contenido')
  <h2>Editar Noticia</h2>
  <form method="POST" action="{{ route('news.update',$news) }}">
    @csrf @method('PUT')
    <div class="mb-3">
      <label class="form-label">Título</label>
      <input name="title" value="{{ old('title',$news->title) }}" class="form-control" required>
      @error('title') <div class="text-danger">{{ $message }}</div> @enderror
    </div>
    <div class="mb-3">
      <label class="form-label">Contenido</label>
      <textarea name="content" rows="6" class="form-control" required>{{ old('content',$news->content) }}</textarea>
      @error('content') <div class="text-danger">{{ $message }}</div> @enderror
    </div>
    <button class="btn btn-primary">Actualizar</button>
  </form>
@endsection
