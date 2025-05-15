@extends('layouts.app')

@section('titulo', $news->title)

@section('contenido')
  <h2>{{ $news->title }}</h2>

  {{-- Botón para alternar modo XSS --}}
  <form method="POST" action="{{ route('news.toggleXss') }}" class="mb-3">
    @csrf
    <button type="submit"
      class="btn {{ session('modo_xss_news') === 'inseguro' ? 'btn-danger' : 'btn-primary' }}">
      Modo {{ session('modo_xss_news') === 'inseguro' ? 'Inseguro (XSS ON)' : 'Seguro (XSS OFF)' }}
    </button>
  </form>

  {{-- Contenido: crudo en inseguro, escapado en seguro --}}
  @if(session('modo_xss_news') === 'inseguro')
    {!! $news->content !!}
  @else
    {{ $news->content }}
  @endif

  <p>
    <small>
      Creada por {{ $news->user->name }}
      el {{ $news->created_at->format('d/m/Y H:i') }}
    </small>
  </p>

  @can('manage news')
    <a href="{{ route('news.edit', $news) }}" class="btn btn-warning">Editar</a>
    <form action="{{ route('news.destroy', $news) }}" method="POST" style="display:inline">
      @csrf @method('DELETE')
      <button class="btn btn-danger">Eliminar</button>
    </form>
  @endcan

  <a href="{{ route('news.index') }}" class="btn btn-link mt-3">← Volver al listado</a>
@endsection
