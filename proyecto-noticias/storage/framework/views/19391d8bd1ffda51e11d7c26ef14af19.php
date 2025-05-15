

<?php $__env->startSection('titulo','Listado de Noticias'); ?>

<?php $__env->startSection('contenido'); ?>
  <h2>Noticias</h2>

  
  <form method="POST" action="<?php echo e(route('news.toggleXss')); ?>" class="mb-3">
    <?php echo csrf_field(); ?>
    <button type="submit"
      class="btn <?php echo e(session('modo_xss_news') === 'inseguro' ? 'btn-danger' : 'btn-primary'); ?>">
      Modo <?php echo e(session('modo_xss_news') === 'inseguro' ? 'Inseguro (XSS ON)' : 'Seguro (XSS OFF)'); ?>

    </button>
  </form>

  <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('manage news')): ?>
    <a href="<?php echo e(route('news.create')); ?>" class="btn btn-success mb-3">Nueva Noticia</a>
  <?php endif; ?>

  <?php $__currentLoopData = $news; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $item): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
    <div class="card mb-3">
      <div class="card-body">
        <h5 class="card-title"><?php echo e($item->title); ?></h5>
        <?php if(session('modo_xss_news') === 'inseguro'): ?>
          <p class="card-text"><?php echo \Illuminate\Support\Str::limit($item->content, 100); ?></p>
        <?php else: ?>
          <p class="card-text"><?php echo e(\Illuminate\Support\Str::limit($item->content, 100)); ?></p>
        <?php endif; ?>
        <a href="<?php echo e(route('news.show', $item)); ?>" class="btn btn-primary">Ver más</a>
      </div>
    </div>
  <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>

  <?php echo e($news->links()); ?>

<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.app', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH C:\xampp\htdocs\proyecto-noticias\resources\views/news/index.blade.php ENDPATH**/ ?>