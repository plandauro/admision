<!DOCTYPE html>
<html lang="en">
  <head>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
    <!-- Meta, title, CSS, favicons, etc. -->
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>UNAB | Acceso </title>

    <!-- Bootstrap -->
    <link href="<?php echo e(asset('css/bootstrap.min.css')); ?>" rel="stylesheet">
    <!-- Font Awesome -->
    <link href="<?php echo e(asset('css/font-awesome.min.css')); ?>" rel="stylesheet">
    <!-- NProgress -->
    <link href="<?php echo e(asset('css/nprogress.css')); ?>" rel="stylesheet">
    <!-- Animate.css -->
    <link href="<?php echo e(asset('css/animate.min.css')); ?>" rel="stylesheet">

    <!-- Custom Theme Style -->
    <link href="<?php echo e(asset('css/custom.min.css')); ?>" rel="stylesheet">
    <style type="text/css">
        .login{

        }
    </style>
  </head>

  <body class="login">
    <div>
      <a class="hiddenanchor" id="signup"></a>
      <a class="hiddenanchor" id="signin"></a>

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
                  <a href="#signup" class="to_register"> ¿Olvidaste tu contraseña? </a>
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

        <div id="register" class="animate form registration_form">
          <section class="login_content">
            <img src="<?php echo e(asset('images/logo.png')); ?>" alt="">
            <form>
              <h1>Recuperación <br>de Contraseña</h1>
              <div>
                <input type="email" class="form-control" placeholder="Email" required="" />
              </div>
              <div>
                <a class="btn btn-default submit" href="index.html">Enviar</a>
              </div>

              <div class="clearfix"></div>

              <div class="separator">
                <p class="change_link">
                  <a href="#signin" class="to_register">Inicio de Sesión</a>
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
  </body>
</html>
