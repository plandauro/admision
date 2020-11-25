<?php 
use App\Proceso;
?>
<!DOCTYPE html>
<html lang="es">
  <head>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
    <!-- Meta, title, CSS, favicons, etc. -->
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>UNAB | <?php echo $__env->yieldContent('title'); ?></title>

    <!-- Bootstrap -->
    <link href="<?php echo e(asset('css/bootstrap.min.css')); ?>" rel="stylesheet">
    <!-- Font Awesome -->
    <link href="<?php echo e(asset('css/font-awesome.min.css')); ?>" rel="stylesheet">
    <!-- Custom Theme Style -->
    <link href="<?php echo e(asset('css/custom.min.css')); ?>" rel="stylesheet">
    <meta id="csrf-token" name="csrf-token" content="<?php echo e(csrf_token()); ?>">
    <?php echo $__env->yieldContent('css'); ?>
  </head>

  <body class="nav-md" urlbase="<?php echo e(url('/')); ?>">
    <div class="container body">
      <div class="main_container">
        <div class="col-md-3 left_col">
          <div class="left_col scroll-view">
            <div class="navbar nav_title" style="border: 0;">
              <a href="<?php echo e(url('/')); ?>" class="site_title"><img width="40px" src="<?php echo e(asset('images/logochico.png')); ?>" alt=""> <span>Admisión UNAB</span></a>
            </div>

            <div class="clearfix"></div>

            <!-- menu profile quick info -->
            <div class="profile clearfix">
              <div class="profile_pic" style="width: 80px;height: 80px;">
                <img 
                  style="width: 65px;height: 65px;"
                  src="<?php if(Auth::user()->foto== ''): ?> 
                          <?php echo e(asset('images/user.png')); ?> 
                      <?php else: ?> <?php echo e(asset(Auth::user()->foto)); ?>  
                      <?php endif; ?>" 
                  class="img-circle profile_img">
              </div>
              <div class="profile_info">
                <span>Bienvenido,</span>
                <h2><?php echo e(Auth::user()->nombre); ?></h2>
              </div>
            </div>
            <!-- /menu profile quick info -->

            <!-- sidebar menu -->
            <div id="sidebar-menu" class="main_menu_side hidden-print main_menu">
              <div class="menu_section">
                <ul class="nav side-menu">

                  <li>
                    <a href="<?php echo e(url('/')); ?>">
                      <i class="fa fa-home"></i> Inicio  
                    </a>
                  </li>
                  <!--  
                  <li>
                    <a>
                      <0i class="fa fa-user"></i> Mis Datos <span class="fa fa-chevron-down"></span>
                    </a>
                    <ul class="nav child_menu">
                      <li>
                        <a href="<?php echo e(url('/perfil')); ?>">Mi perfil</a>
                      </li>
                     <li>
                        <a href="<?php echo e(url('/sisfoh')); ?>">Ficha Socioeconómica Única</a>
                      </li>
                    </ul> 
                  </li>
                  -->
                  <?php if(Proceso::abierto()): ?>
                    <?php if(Auth::user()->isAdmin() || Auth::user()->isCoordinador() || Auth::user()->isAsistente()): ?>
                    <?php else: ?>
                      <li>
                        <a href="<?php echo e(url('/postular')); ?>">
                          <i class="fa fa-check-square-o"></i> Postular    
                        </a>
                      </li>
                    <?php endif; ?>
                    <li>
                      <a target="blank" href="<?php echo e(url('pdf/instrucciones.pdf')); ?>">
                        <i class="fa fa-file-pdf-o"></i> Instrucciones    
                      </a>
                    </li>
                    <li>
                      <a target="blank" href="<?php echo e(url('pdf/flujograma.pdf')); ?>">
                        <i class="fa fa-file-pdf-o"></i> Flujograma    
                      </a>
                    </li>
                  <?php endif; ?>

                  <?php if(Auth::user()->isAsistente() || Auth::user()->isCoordinador()): ?>
                    <?php if(Proceso::abierto()): ?>
                      <li>
                        <a href="<?php echo e(url('/verificarpostulacion')); ?>">
                          <i class="fa fa-check-square-o"></i> Verificar Postulación
                        </a>
                      </li>
                      <?php if( Auth::user()->isCoordinador()): ?>
                      <li>
                        <a href="<?php echo e(url('/cargar-resultados')); ?>">
                          <i class="fa fa-cloud-upload"></i> Cargar Resultados
                        </a>
                      </li>
                      <?php endif; ?>
                    <?php endif; ?>

                  <li>
                    <a>
                      <i class="fa fa-file-text"></i> Reportes <span class="fa fa-chevron-down"></span>
                    </a>
                    <ul class="nav child_menu">
                      <li>
                        <a href="<?php echo e(url('/rep-postulantes')); ?>">Lista de Postulantes</a>
                      </li>
                      <li>
                        <a href="<?php echo e(url('/rep-estadisticas')); ?>">Estadísticos</a>
                      </li>
                      <li>
                        <a href="<?php echo e(url('/rep-constancias')); ?>">Constancias de Ingreso</a>
                      </li>
                      <li>
                        <a href="<?php echo e(url('/rep-pagos')); ?>">Pagos</a>
                      </li>
                    </ul> 
                  </li>
                    <?php if( Auth::user()->isCoordinador()): ?>
                      <li>
                        <a>
                          <i class="fa fa-pencil"></i> Mantenimiento <span class="fa fa-chevron-down"></span>
                        </a>
                        <ul class="nav child_menu">
                          <li>
                            <a href="<?php echo e(url('/mantenimiento/proceso')); ?>">Proceso de Postulación</a>
                          </li>
                        </ul> 
                      </li>
                    <?php endif; ?>
                  <?php endif; ?>
                  

                </ul>
              </div>

            </div>
            <!-- /sidebar menu -->

            <!-- /menu footer buttons -->
            <!-- <div class="sidebar-footer hidden-small">
              <a data-toggle="tooltip" data-placement="top" title="Settings">
                <span class="glyphicon glyphicon-cog" aria-hidden="true"></span>
              </a>
              <a data-toggle="tooltip" data-placement="top" title="FullScreen">
                <span class="glyphicon glyphicon-fullscreen" aria-hidden="true"></span>
              </a>
              <a data-toggle="tooltip" data-placement="top" title="Lock">
                <span class="glyphicon glyphicon-eye-close" aria-hidden="true"></span>
              </a>
              <a data-toggle="tooltip" data-placement="top" title="Logout" href="<?php echo e(url('/logout')); ?>" onclick="event.preventDefault();
                      document.getElementById('logout-form').submit();">
                <span class="glyphicon glyphicon-off" aria-hidden="true"></span>
              </a>
            </div> -->
            <!-- /menu footer buttons -->
          </div>
        </div>

        <!-- top navigation -->
        <div class="top_nav">
          <div class="nav_menu">
            <nav>
              <div class="nav toggle">
                <a id="menu_toggle"><i class="fa fa-bars"></i></a>
              </div>

              <ul class="nav navbar-nav navbar-right">
                <li class="">
                  <a href="javascript:;" class="user-profile dropdown-toggle" data-toggle="dropdown" aria-expanded="false">
                    <img style="width: 30px;height: 30px;"
                      src="<?php if(Auth::user()->foto== ''): ?> 
                          <?php echo e(asset('images/user.png')); ?> 
                          <?php else: ?> <?php echo e(asset(Auth::user()->foto)); ?>  
                          <?php endif; ?>" alt=""><?php echo e(Auth::user()->nombre); ?>

                    <span class=" fa fa-angle-down"></span>
                  </a>
                  <ul class="dropdown-menu dropdown-usermenu pull-right">
                    <li><a href="javascript:;"> Perfil</a></li>
                    <li><a href="<?php echo e(url('/logout')); ?>" onclick="event.preventDefault();
                      document.getElementById('logout-form').submit();"><i class="fa fa-sign-out pull-right"></i> Salir</a></li>
                  </ul>
                </li>
                <form id="logout-form" action="<?php echo e(url('/logout')); ?>" method="POST" style="display: none;">
                    <?php echo e(csrf_field()); ?>

                </form>

              </ul>
            </nav>
          </div>
        </div>
        <!-- /top navigation -->

        <!-- page content -->
        <div class="right_col" role="main">
          
          <?php echo $__env->yieldContent('content'); ?>

        </div>
        <!-- /page content -->

        <!-- footer content -->
        <footer>
          <div class="pull-right">
            <a href="https://www.unab.edu.pe" target="blank">Universidad Nacional de Barranca</a> 
          </div>
          <div class="clearfix"></div>
        </footer>
        <!-- /footer content -->
      </div>
    </div>

    <!-- jQuery -->
    <script src="<?php echo e(asset('js/jquery.min.js')); ?>"></script>
    <!-- Bootstrap -->
    <script src="<?php echo e(asset('js/bootstrap.min.js')); ?>"></script> 
    <!-- Custom Theme Scripts -->
    <script src="<?php echo e(asset('js/custom.min.js')); ?>"></script>
    
    <script>
    $(document).ready(function() {
      $urlbase = $("body").attr('urlbase');
    });
    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });
      
    </script>

    <?php echo $__env->yieldContent('js'); ?>
  
  </body>
</html>
