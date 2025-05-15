<?php
// app/Http/Controllers/NewsController.php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\News;
use Illuminate\Http\Request;
// Importa las clases FQCN de los middlewares de Spatie
use Spatie\Permission\Middleware\PermissionMiddleware;
use Spatie\Permission\Middleware\RoleMiddleware;

class NewsController extends Controller
{
    public function __construct()
    {
        // 1) Todos deben estar autenticados
        $this->middleware('auth');

        // 2) Usuarios con permiso “view news” pueden listar y ver
        $this->middleware(PermissionMiddleware::class . ':view news')
             ->only(['index', 'show']);

        // 3) Solo usuarios con rol “admin” pueden crear, editar o borrar
        $this->middleware(RoleMiddleware::class . ':admin')
             ->except(['index', 'show']);
    }

    /**
     * Listado de noticias (permiso view news).
     */
    public function index()
    {
        $news = News::latest()->paginate(10);
        return view('news.index', compact('news'));
    }

    /**
     * Detalle de una noticia (permiso view news).
     */
    public function show(News $news)
    {
        return view('news.show', compact('news'));
    }

    /**
     * Formulario de creación de noticia (rol admin).
     */
    public function create()
    {
        return view('news.create');
    }

    /**
     * Almacena una nueva noticia (rol admin).
     */
    public function store(Request $request)
    {
        $request->validate([
            'title'   => 'required|string|max:255',
            'content' => 'required',
        ]);

        auth()->user()->news()->create($request->only('title', 'content'));

        return redirect()
            ->route('news.index')
            ->with('status', 'Noticia creada correctamente.');
    }

    /**
     * Formulario de edición (rol admin).
     */
    public function edit(News $news)
    {
        return view('news.edit', compact('news'));
    }

    /**
     * Actualiza la noticia (rol admin).
     */
    public function update(Request $request, News $news)
    {
        $request->validate([
            'title'   => 'required|string|max:255',
            'content' => 'required',
        ]);

        $news->update($request->only('title', 'content'));

        return redirect()
            ->route('news.index')
            ->with('status', 'Noticia actualizada correctamente.');
    }

    /**
     * Elimina la noticia (rol admin).
     */
    public function destroy(News $news)
    {
        $news->delete();

        return redirect()
            ->route('news.index')
            ->with('status', 'Noticia eliminada correctamente.');
    }
}
