@extends('layouts.app')

@section('titulo','Listado de Noticias')

@section('contenido')
  <h2>Noticias</h2>

  {{-- Botón para alternar modo XSS --}}
  <form method="POST" action="{{ route('news.toggleXss') }}" class="mb-3">
    @csrf
    <button type="submit"
      class="btn {{ session('modo_xss_news') === 'inseguro' ? 'btn-danger' : 'btn-primary' }}">
      Modo {{ session('modo_xss_news') === 'inseguro' ? 'Inseguro (XSS ON)' : 'Seguro (XSS OFF)' }}
    </button>
  </form>

  @can('manage news')
    <a href="{{ route('news.create') }}" class="btn btn-success mb-3">Nueva Noticia</a>
  @endcan

  @foreach($news as $item)
    <div class="card mb-3">
      <div class="card-body">
        <h5 class="card-title">{{ $item->title }}</h5>
        @if(session('modo_xss_news') === 'inseguro')
          <p class="card-text">{!! \Illuminate\Support\Str::limit($item->content, 100) !!}</p>
        @else
          <p class="card-text">{{ \Illuminate\Support\Str::limit($item->content, 100) }}</p>
        @endif
        <a href="{{ route('news.show', $item) }}" class="btn btn-primary">Ver más</a>
      </div>
    </div>
  @endforeach

  {{ $news->links() }}
@endsection
