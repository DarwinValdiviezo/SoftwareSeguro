<!DOCTYPE html>
<html lang="es">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>@yield('titulo') – Mi App Laravel</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
  <nav class="navbar navbar-expand-lg navbar-light bg-light mb-4">
    <div class="container">
      <a class="navbar-brand" href="{{ route('home') }}">Mi App</a>
      <div class="collapse navbar-collapse">
        <ul class="navbar-nav ms-auto">
          @guest
            <li class="nav-item"><a class="nav-link" href="{{ route('login.form') }}">Login</a></li>
            <li class="nav-item"><a class="nav-link" href="{{ route('register.form') }}">Registro</a></li>
          @else
            <li class="nav-item"><a class="nav-link" href="{{ route('news.index') }}">Noticias</a></li>
            <li class="nav-item">
              <form action="{{ route('logout') }}" method="POST">@csrf
                <button class="btn btn-link nav-link">Cerrar sesión</button>
              </form>
            </li>
          @endguest
        </ul>
      </div>
    </div>
  </nav>

  <div class="container">
    @yield('contenido')
  </div>

  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
