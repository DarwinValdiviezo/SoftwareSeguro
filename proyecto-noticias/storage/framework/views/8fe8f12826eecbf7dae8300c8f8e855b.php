<?php $__env->startSection('titulo','Inicio'); ?>

<?php $__env->startSection('contenido'); ?>
  <div class="text-center py-5">
    <h1>Bienvenido a Mi App de Noticias</h1>
    <p class="lead">Prueba la experiencia de login, registro y CRUD de noticias.</p>
    <a href="<?php echo e(route('login.form')); ?>" class="btn btn-primary">Iniciar sesión</a>
  </div>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.app', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH C:\xampp\htdocs\proyecto-noticias\resources\views/welcome.blade.php ENDPATH**/ ?>