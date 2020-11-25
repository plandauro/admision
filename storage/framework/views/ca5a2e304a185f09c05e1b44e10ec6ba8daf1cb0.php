<?php $__env->startSection('title', 'Registro'); ?>

<?php $__env->startSection('content'); ?>
  @parent
    <div>
      <div class="login_wrapper">
      
        <div id="register" class="animate form login_form">
          <section class="login_content">
            <img src="<?php echo e(asset('images/logo.png')); ?>" alt="">
            <form role="form" method="POST" role="form" action="<?php echo e(url('/register')); ?>">
              <?php echo e(csrf_field()); ?>

              <h1>Registrate</h1>
              <div style="margin-bottom: 10px;">
                <input type="text" style="margin-bottom: 1px;" class="form-control" placeholder="Apellidos Paterno" name="apepaterno" value="<?php echo e(old('apepaterno')); ?>" required autofocus/>
                <?php if($errors->has('apepaterno')): ?>
                    <span style="color: #f44"><?php echo e($errors->first('apepaterno')); ?></span>
                <?php endif; ?>
              </div>
              <div style="margin-bottom: 10px;">
                <input type="text" style="margin-bottom: 1px;" class="form-control"  value="<?php echo e(old('apematerno')); ?>" placeholder="Apellido Materno" name="apematerno" required="" />
                <?php if($errors->has('apematerno')): ?>
                    <span style="color: #f44"><?php echo e($errors->first('apematerno')); ?></span>
                <?php endif; ?>
              </div>
              <div style="margin-bottom: 10px;">
                <input type="text" style="margin-bottom: 1px;" class="form-control"  value="<?php echo e(old('nombre')); ?>" placeholder="Nombres" name="nombre" required="" />
                <?php if($errors->has('nombre')): ?>
                    <span style="color: #f44"><?php echo e($errors->first('nombre')); ?></span>
                <?php endif; ?>
              </div>
              <div style="margin-bottom: 10px;">
                <select name="tipodocumento" id="tipodocumento" class="form-control" style="color: #888"
                  onchange="if($(this).val() != '') $('#dni').prop('disabled', false); else $('#dni').prop('disabled', true);">
                  <option value="" <?php echo e((old('tipodocumento') == '' ? 'selected':'')); ?>>(Tipo Documento)</option>
                  <option value="1" <?php echo e((old('tipodocumento') == 1 ? 'selected':'')); ?>>DNI</option>
                  <option value="2" <?php echo e((old('tipodocumento') == 2 ? 'selected':'')); ?>>Libreta Militar</option>
                  <option value="3" <?php echo e((old('tipodocumento') == 3 ? 'selected':'')); ?>>Part. Nacimiento - CUI</option>
                  <option value="4" <?php echo e((old('tipodocumento') == 4 ? 'selected':'')); ?>>Carnet de Extranjería </option>
                  <option value="5" <?php echo e((old('tipodocumento') == 5 ? 'selected':'')); ?>>Otro </option>
                </select>
                <?php if($errors->has('dni')): ?>
                    <span style="color: #f44"><?php echo e($errors->first('dni')); ?></span>
                <?php endif; ?>
              </div>
              <div style="margin-bottom: 10px;">
                <input type="text" style="margin-bottom: 1px;" disabled class="form-control"  value="<?php echo e(old('dni')); ?>" placeholder="N° Documento" name="dni" id="dni" required="" />
                <?php if($errors->has('dni')): ?>
                    <span style="color: #f44"><?php echo e($errors->first('dni')); ?></span>
                <?php endif; ?>
              </div>
              
              <div style="margin-bottom: 10px;">
                <input type="email" style="margin-bottom: 1px;" class="form-control"  value="<?php echo e(old('email')); ?>" placeholder="Email" name="email" required="" />
                <?php if($errors->has('email')): ?>
                    <span style="color: #f44"><?php echo e($errors->first('email')); ?></span>
                <?php endif; ?>
              </div>
              <div style="margin-bottom: 10px;">
                
       