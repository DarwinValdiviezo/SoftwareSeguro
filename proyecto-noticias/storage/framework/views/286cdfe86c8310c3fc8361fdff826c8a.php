


<?php $__env->startSection('titulo', 'Iniciar sesión'); ?>

<?php $__env->startSection('contenido'); ?>
  <h2 class="mb-4">Login de Usuario</h2>

  <?php if(session('status')): ?>
    <div class="alert alert-success"><?php echo e(session('status')); ?></div>
  <?php endif; ?>

  <?php $__errorArgs = ['login'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
    <div class="alert alert-danger"><?php echo e($message); ?></div>
  <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>

  <form method="POST" action="<?php echo e(route('login')); ?>">
    <?php echo csrf_field(); ?>

    <div class="mb-3">
      <label for="email" class="form-label">Email</label>
      <input
        id="email"
        type="email"
        name="email"
        value="<?php echo e(old('email')); ?>"
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
        <?php echo e(old('seguro', true) ? 'checked' : ''); ?>

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

  <a href="<?php echo e(route('social.redirect')); ?>" class="btn btn-danger w-100 mb-4">
    Iniciar con Google
  </a>

  <p class="text-center">
    ¿No tienes cuenta?
    <a href="<?php echo e(route('register.form')); ?>">Regístrate aquí</a>
  </p>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.app', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH C:\xampp\htdocs\proyecto-noticias\resources\views/auth/login.blade.php ENDPATH**/ ?>