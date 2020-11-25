<?php $__env->startSection('title', 'Acceso'); ?>

<?php $__env->startSection('content'); ?>
  @parent

    <div>

      <div class="login_wrapper">
        <div class="animate form login_form">
          <section class="login_content">
            <img src="<?php echo e(asset('images/logo.png')); ?>" alt="">
            <form role="form" method="POST" action="<?php echo e(url('/login')); ?>">
                <?php echo e(csrf_field()); ?>

              <h1>Inicio de Sesión</h1>
              <div style="margin-bottom: 10px;">
                <input style="margin-bottom: 1px;" id="email" type="email" class="form-control"  name="email" value="<?php echo e(old('email')); ?>" placeholder="E-mail" required autofocus />
                <?php if($errors->has('email')): ?>
                    <span style="color: #f44"><?php echo e($errors->first('email')); ?></span>
                <?php endif; ?>
              </div>
              <div>
                <input style="margin-bottom: 1px;" id="password" type="password" class="form-control" placeholder="Contraseña" name="password" required />
                <?php if($errors->has('password')): ?>
                    <span style="color: #f44"><?php echo e($errors->first('password')); ?></span>
                <?php endif; ?>
              </div>
              <div style="margin-top: 15px">
                <button type="submit" class="submit btn btn-default">
                    Ingresar
                </button>
              </div>

              <div class="clearfix"></div>

              <div class="separator">
                <p class="change_link">
                  <a style="font-size: 15px;" href="<?php echo e(url('register')); ?>"> Registrarse </a>
                  <a style="font-size: 15px;" href="<?php echo e(url('/password/reset')); ?>"> ¿Olvidaste tu contraseña? </a>
                </p>

                <div class="clearfix"></div>
                <br />

                <div>
                  <p>UNAB ©<?php echo e(date("Y")); ?> All Rights Reserved</p>
                </div>
              </div>
            </form>
          </section>
        </div>

      </div>
    </div>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.master_auth', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>