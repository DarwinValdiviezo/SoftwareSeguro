<!DOCTYPE html>
<html lang="es">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title><?php echo $__env->yieldContent('titulo'); ?> – Mi App Laravel</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
  <nav class="navbar navbar-expand-lg navbar-light bg-light mb-4">
    <div class="container">
      <a class="navbar-brand" href="<?php echo e(route('home')); ?>">Mi App</a>
      <div class="collapse navbar-collapse">
        <ul class="navbar-nav ms-auto">
          <?php if(auth()->guard()->guest()): ?>
            <li class="nav-item"><a class="nav-link" href="<?php echo e(route('login.form')); ?>">Login</a></li>
            <li class="nav-item"><a class="nav-link" href="<?php echo e(route('register.form')); ?>">Registro</a></li>
          <?php else: ?>
            <li class="nav-item"><a class="nav-link" href="<?php echo e(route('news.index')); ?>">Noticias</a></li>
            <li class="nav-item">
              <form action="<?php echo e(route('logout')); ?>" method="POST"><?php echo csrf_field(); ?>
                <button class="btn btn-link nav-link">Cerrar sesión</button>
              </form>
            </li>
          <?php endif; ?>
        </ul>
      </div>
    </div>
  </nav>

  <div class="container">
    <?php echo $__env->yieldContent('contenido'); ?>
  </div>

  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
<?php /**PATH C:\xampp\htdocs\proyecto-noticias\resources\views/layouts/app.blade.php ENDPATH**/ ?>