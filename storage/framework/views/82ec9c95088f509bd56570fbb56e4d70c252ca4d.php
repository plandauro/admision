<?php $__env->startSection('title', 'Inicio'); ?>

<?php $__env->startSection('content'); ?>
  @parent
  <div id="indexpage" class="">
    
    <img id="idlogo1" src="<?php echo e(asset('images/logo.png')); ?>" alt="">
    <h1>BIENVENIDOS AL PROCESO DE ADMISIÓN <?php echo e($descripcion); ?></h1>

  </div>
<?php $__env->stopSection(); ?>

<?php $__env->startSection('css'); ?>
<style type="text/css">
  #indexpage{
    text-align: center;
    padding-top: 200px;
  }

  #idlogo1{
    width: 300px;
  }
</style>

<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.master', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>