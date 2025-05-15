
<?php $__env->startSection('titulo','Editar Noticia'); ?>
<?php $__env->startSection('contenido'); ?>
  <h2>Editar Noticia</h2>
  <form method="POST" action="<?php echo e(route('news.update',$news)); ?>">
    <?php echo csrf_field(); ?> <?php echo method_field('PUT'); ?>
    <div class="mb-3">
      <label class="form-label">Título</label>
      <input name="title" value="<?php echo e(old('title',$news->title)); ?>" class="form-control" required>
      <?php $__errorArgs = ['title'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> <div class="text-danger"><?php echo e($message); ?></div> <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
    </div>
    <div class="mb-3">
      <label class="form-label">Contenido</label>
      <textarea name="content" rows="6" class="form-control" required><?php echo e(old('content',$news->content)); ?></textarea>
      <?php $__errorArgs = ['content'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> <div class="text-danger"><?php echo e($message); ?></div> <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
    </div>
    <button class="btn btn-primary">Actualizar</button>
  </form>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.app', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH C:\xampp\htdocs\proyecto-noticias\resources\views/news/edit.blade.php ENDPATH**/ ?>