

<?php $__env->startSection('titulo', $news->title); ?>

<?php $__env->startSection('contenido'); ?>
  <h2><?php echo e($news->title); ?></h2>

  
  <form method="POST" action="<?php echo e(route('news.toggleXss')); ?>" class="mb-3">
    <?php echo csrf_field(); ?>
    <button type="submit"
      class="btn <?php echo e(session('modo_xss_news') === 'inseguro' ? 'btn-danger' : 'btn-primary'); ?>">
      Modo <?php echo e(session('modo_xss_news') === 'inseguro' ? 'Inseguro (XSS ON)' : 'Seguro (XSS OFF)'); ?>

    </button>
  </form>

  
  <?php if(session('modo_xss_news') === 'inseguro'): ?>
    <?php echo $news->content; ?>

  <?php else: ?>
    <?php echo e($news->content); ?>

  <?php endif; ?>

  <p>
    <small>
      Creada por <?php echo e($news->user->name); ?>

      el <?php echo e($news->created_at->format('d/m/Y H:i')); ?>

    </small>
  </p>

  <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('manage news')): ?>
    <a href="<?php echo e(route('news.edit', $news)); ?>" class="btn btn-warning">Editar</a>
    <form action="<?php echo e(route('news.destroy', $news)); ?>" method="POST" style="display:inline">
      <?php echo csrf_field(); ?> <?php echo method_field('DELETE'); ?>
      <button class="btn btn-danger">Eliminar</button>
    </form>
  <?php endif; ?>

  <a href="<?php echo e(route('news.index')); ?>" class="btn btn-link mt-3">← Volver al listado</a>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.app', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH C:\xampp\htdocs\proyecto-noticias\resources\views/news/show.blade.php ENDPATH**/ ?>