
<?php $__env->startSection('titulo','Registro'); ?>
<?php $__env->startSection('contenido'); ?>
<h2>Registro de Usuario</h2>
<?php if(session('status')): ?>
  <div class="alert alert-success"><?php echo e(session('status')); ?></div>
<?php endif; ?>
<form method="POST" action="<?php echo e(route('register')); ?>">
  <?php echo csrf_field(); ?>
  <div class="mb-3">
    <label class="form-label">Nombre</label>
    <input name="name" class="form-control" required>
  </div>
  <div class="mb-3">
    <label class="form-label">Email</label>
    <input name="email" type="email" class="form-control" required>
  </div>
  <div class="mb-3">
    <label class="form-label">Contraseña</label>
    <input name="password" type="password" class="form-control" required>
  </div>
  <div class="mb-3">
    <label class="form-label">Confirmar Contraseña</label>
    <input name="password_confirmation" type="password" class="form-control" required>
  </div>
  <button class="btn btn-primary">Registrar</button>
</form>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.app', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH C:\xampp\htdocs\proyecto-noticias\resources\views/auth/register.blade.php ENDPATH**/ ?>