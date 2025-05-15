
<?php $__env->startSection('titulo','Verificación de Código'); ?>
<?php $__env->startSection('contenido'); ?>
  <h2 class="mb-4">Verificación de Dos Pasos</h2>

  <p>Hemos enviado un código de 6 dígitos a tu correo.</p>

  <form method="POST" action="<?php echo e(route('verify.post')); ?>">
    <?php echo csrf_field(); ?>

    <div class="mb-3">
      <input
        name="code"
        type="text"
        class="form-control"
        placeholder="Código de 6 dígitos"
        required
      >
      <?php $__errorArgs = ['code'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
        <div class="text-danger mt-1"><?php echo e($message); ?></div>
      <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
    </div>

    <button class="btn btn-primary">Verificar</button>
  </form>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.app', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH C:\xampp\htdocs\proyecto-noticias\resources\views/auth/verify.blade.php ENDPATH**/ ?>