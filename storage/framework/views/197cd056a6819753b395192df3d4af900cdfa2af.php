<?php

use App\Proceso;
use App\Pagos;
use App\Postulacion;

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
              <img style="width: 65px;height: 65px;" src="<?php if(Auth::user()->foto== ''): ?> 
                          <?php echo e(asset('images/user.png')); ?> 
                      <?php else: ?> <?php echo e(asset(Auth::user()->foto)); ?>  
                      <?php endif; ?>" class="img-circle profile_img">
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
                <!-- <li>
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
                </li> -->

                <?php if(Proceso::abierto()): ?>

                <?php if(Auth::user()->isAdmin() || Auth::user()->isCoordinador() || Auth::user()->isAsistente()): ?>
                <?php else: ?>
                <?php if(Pagos::buscarPago(Auth::user()->id)==null): ?>
                <li>
                  <a href="<?php echo e(url('/cargar-informacion')); ?>" onclick='alert("NOTA: LOS PAGOS SE ACTUALIZAN DESPUÉS DE CADA HORA DE LA TRANSACCIÓN Y LOS PAGOS REALIZADOS EL DÍA SÁBADO SE REGISTRARÁN AUTOMÁTICAMENTE.")'>
                    <i class="fa fa-check-square-o"></i> Postular
                  </a>
                </li>
                <?php else: ?>
                <?php if(Pagos::buscarPago(Auth::user()->id)=="ms1"): ?>
                <li>
                  <a href="<?php echo e(url('/cargar-informacion')); ?>" onclick='alert("NO REALIZO LO PAGOS COMPLETOS")'>
                    <i class="fa fa-check-square-o"></i> Postular
                  </a>
                </li>
                <?php else: ?>
                <?php if(Pagos::buscarPago(Auth::user()->id)=="ms2"): ?>
                <li>
                  <a href="<?php echo e(url('/cargar-informacion')); ?>" onclick='alert("SOLO HA PAGADO COSTO DE CARPETA POR FAVOR COMPLETAR EL PAGO DE PROSPECTO Y LA MODALIDAD")'>
                    <i class="fa fa-check-square-o"></i> Postular
                  </a>
                </li>
                <?php else: ?>
                <?php if(Pagos::buscarPago(Auth::user()->id)=="ms3"): ?>
                <li>
                  <a href="<?php echo e(url('/cargar-informacion')); ?>" onclick='alert("SOLO HA PAGADO EL PROSPECTO POR FAVOR COMPLETAR EL PAGO DE CARPETA Y LA MODALIDAD")'>
                    <i class="fa fa-check-square-o"></i> Postular
                  </a>
                </li>
                <?php else: ?>
                <?php if(Pagos::buscarPago(Auth::user()->id)=="ms4"): ?>
                <li>
                  <a href="<?php echo e(url('/cargar-informacion')); ?>" onclick='alert("SOLO HA PAGADO COSTO DE CARPETA + EL PROSPECTO POR FAVOR COMPLETAR EL PAGO MODALIDAD")'>
                    <i class="fa fa-check-square-o"></i> Postular
                  </a>
                </li>
                <?php else: ?>
                <?php if(Postulacion::buscarPostulacion(Auth::user()->id)==1): ?>
                <li>
                  <a href="<?php echo e(url('/cargar-informacion')); ?>" onclick='alert("YA REALIZO UNA POSTULACION EN ESTE PROCESO DE ADMISION")'>
                    <i class="fa fa-check-square-o"></i> Postular
                  </a>
                </li>
                <?php else: ?>
                <li>
                  <a href="<?php echo e(url('/postular')); ?>">
                    <i class="fa fa-check-square-o"></i> Postular
                  </a>
                </li>
                <?php endif; ?>
                <?php endif; ?>
                <?php endif; ?>
                <?php endif; ?>

                <?php endif; ?>
                <?php endif; ?>
                <?php endif; ?>

                <li>
                  <a href="<?php echo e(url('/cargar-informacion')); ?>">
                    <i class="fa fa-check-square-o"></i> Informacion de Pagos
                  </a>
                </li>
                <li>
                  <a target="blank" href="<?php echo e(url('pdf/MANUAL-DE-USUARIO-UNAB-ADMISION-2021.pdf')); ?>">
                    <i class="fa fa-file-pdf-o"></i> Instrucciones
                  </a>
                </li>
                <!-- <li>
                  <a target="blank" href="<?php echo e(url('pdf/flujograma.pdf')); ?>">
                    <i class="fa fa-file-pdf-o"></i> Flujograma
                  </a>
                </li> -->
                <?php endif; ?>

                <?php if(Auth::user()->isAsistente() || Auth::user()->isCoordinador()): ?>
                <?php if(Proceso::abierto()): ?>
                <!-- <li>
                  <a href="<?php echo e(url('/verificarpostulacion')); ?>">
                    <i class="fa fa-check-square-o"></i> Verificar Postulación
                  </a>
                </li> -->
                <?php if( Auth::user()->isCoordinador()): ?>
                <li>
                  <a href="<?php echo e(url('/cargar-resultados')); ?>">
                    <i class="fa fa-cloud-upload"></i> Cargar Resultados
                  </a>
                </li>
                <?php endif; ?>
                <?php if( Auth::user()->isCoordinador()): ?>
                <li>
                  <a href="<?php echo e(url('/cargar-pagos')); ?>">
                    <i class="fa fa-credit-card"></i> Cargar Pagos
                  </a>
                </li>
                <?php endif; ?>
                <?php if( Auth::user()->isCoordinador()): ?>
                <li>
                  <a href="<?php echo e(url('/cargar-preguntas')); ?>">
                    <i class="fa fa-database"></i> Cargar Banco de Preguntas
                  </a>
                </li>
                <?php endif; ?>
                <?php endif; ?>
                
                <!-- MODULO REPORTES -->
                <li>
                  <a>
                    <i class="fa fa-file-text"></i> Reportes <span class="fa fa-chevron-down"></span>
                  </a>
                  <ul class="nav child_menu">
                    <li>
                      <a href="<?php echo e(url('/rep-listaIngresantes')); ?>">Lista de Ingresantes</a>
                    </li>
                    <li>
                      <a href="<?php echo e(url('/rep-postulantes')); ?>">Lista de Postulantes</a>
                    </li>
                    <li>
                      <a href="<?php echo e(url('/rep-postulantesvalidosnovalidos')); ?>">Lista de Postulantes Validos / No Validos</a>
                    </li>
                    <li>
                      <a>
                        <i></i>Estadísticos<span class="fa fa-chevron-down"></span>
                      </a>
                      <ul class="nav child_menu">
                        <li>
                          <a href="<?php echo e(url('/rep-estadisticas')); ?>">Ubicacion - Ingresantes</a>
                        </li>
                        <li>
                          <a href="<?php echo e(url('/rep-estadisticas-post-edad')); ?>">Edad - Postulantes</a>
                        </li>
                        <li>
                          <a href="<?php echo e(url('/rep-estadisticas-ing-edad')); ?>">Edad - Ingresantes</a>
                        </li>
                      </ul>
                    </li>
                    <li>
                      <a href="<?php echo e(url('/rep-constancias')); ?>">Constancias de Ingreso</a>
                    </li>
                    <li>
                      <a href="<?php echo e(url('/rep-pagos')); ?>">Pagos</a>
                    </li>
                    <li>
                      <a href="<?php echo e(url('/rep-pagossubidos')); ?>">Pagos Subidos</a>
                    </li>
                    <li>
                      <a href="<?php echo e(url('/rep-padron')); ?>">Padron de Ingresantes</a>
                    </li>
                    <li>
                      <a href="<?php echo e(url('/rep-padron-postulantes')); ?>">Padron de Postulantes</a>
                    </li>
                  </ul>
                </li>
                <!-- FIN MODULO REPORTES -->

                <?php if( Auth::user()->isCoordinador()): ?>
                <!-- MODULO MANTENIMIENTO -->
                <li>
                  <a>
                    <i class="fa fa-pencil"></i> Mantenimiento <span class="fa fa-chevron-down"></span>
                  </a>
                  <ul class="nav child_menu">
                    <li>
                      <a href="<?php echo e(url('/mantenimiento/proceso')); ?>">Proceso de Postulación</a>
                    </li>
                    <li>
                      <a href="<?php echo e(url('/mantenimiento/aulasPorExamen')); ?>">Gestion de Aulas</a>
                    </li>
                    <li>
                      <a href="<?php echo e(url('/mantenimiento/usuarios')); ?>">Gestion de Usuarios</a>
                    </li>
                    <li>
                      <a href="<?php echo e(url('/mantenimiento/tarifa')); ?>">Tarifa</a>
                    </li>
                    <!-- <li>
                      <a href="<?php echo e(url('/mantenimiento/materia')); ?>">Gestion de Materia</a>
                    </li>
                    <li>
                      <a>
                        <i></i>Gestion de Preguntas<span class="fa fa-chevron-down"></span>
                      </a>
                      <ul class="nav child_menu">
                        <li>
                          <a href="<?php echo e(url('/mantenimiento/preguntas')); ?>">Preguntas No Usadas</a>
                        </li>
                        <li>
                          <a href="<?php echo e(url('/mantenimiento/preguntas-usadas')); ?>">Preguntas Usadas</a>
                        </li>
                      </ul>
                    </li> -->
                    <li>
                      <a href="<?php echo e(url('/configuracion/postulanteSimulacro')); ?>">Postulantes Simulacro</a>
                    </li>
                </li>
                <!-- FIN MODULO MANTENIMIENTO -->
              </ul>
              <!-- aca iba un li demas -->
              <?php endif; ?>
              <?php if( Auth::user()->isCoordinador()): ?>

              <!-- MODULO GENERACION EXAMEN -->
              <!-- <li>
                <a>
                  <i class="fa fa-pencil"></i> Generación de Examen <span class="fa fa-chevron-down"></span>
                </a>
                <ul class="nav child_menu">
                  <li>
                    <a href="<?php echo e(url('/generarexa/lista')); ?>">Proceso</a>
                  </li>
                  <li>
                    <a>Matenimiento</a>
                  </li>
                </ul>
              </li> -->
              <!-- FIN GENERACION EXAMEN -->

              <!-- MODULO DE CALIFICACION -->
              <li>
                <a>
                  <i class="fa fa-pencil"></i> Calificación <span class="fa fa-chevron-down"></span>
                </a>
                <ul class="nav child_menu">
                  
                  <li>
                    <a>
                      <i></i>Ingeniería Agrónoma <span class="fa fa-chevron-down"></span>
                    </a>
                    <ul class="nav child_menu">
                      <li>
                        <a href="<?php echo e(url('/cargar-txt-2020-2-IA')); ?>">Subir Resultados DLM</a> <!-- CARGAR DLM 2020-2 -->
                      </li>
                      <li>
                        <a href="<?php echo e(url('/rep-calificacion-duplicados-2020-2-IA')); ?>">Verificar Duplicados</a> <!-- REPORTE DUPLICADOS 2020-2 -->
                      </li>
                      <li class="duplicados_report">
                        <!-- class="duplicados_report" -->
                        <a href="<?php echo e(url('/rep-calificacion-2020-2-IA')); ?>">Reporte de calificacion</a> <!-- REPORTE CALIFICACION CANAL A2020-2 -->
                      </li>
                      
                      <!-- <li>
                        <a href="<?php echo e(url('/rep-calificacion-canales-HI-2020-2')); ?>">Admsion HI - Canal</a>
                      </li>
                      <li>
                        <a href="<?php echo e(url('/rep-calificacion-canales-HR-2020-2')); ?>">Admision HR - Canal</a>
                      </li> -->
                      
                    </ul>
                  </li>
                  

                  
                  <li>
                    <a>
                      <i></i>Ingeniería en Industrias Alimentarias <span class="fa fa-chevron-down"></span>
                    </a>
                    <ul class="nav child_menu">
                      <li>
                        <a href="<?php echo e(url('/cargar-txt-2020-2-IIA')); ?>">Subir Resultados DLM</a> <!-- CARGAR DLM 2020-2 -->
                      </li>
                      <li>
                        <a href="<?php echo e(url('/rep-calificacion-duplicados-2020-2-IIA')); ?>">Verificar Duplicados</a> <!-- REPORTE DUPLICADOS 2020-2 -->
                      </li>
                      <li class="duplicados_report">
                        <!-- class="duplicados_report" -->
                        <a href="<?php echo e(url('/rep-calificacion-2020-2-IIA')); ?>">Reporte de calificacion</a> <!-- REPORTE CALIFICACION CANAL A2020-2 -->
                      </li>
                      
                      <!-- <li>
                        <a href="<?php echo e(url('/rep-calificacion-canales-HI-2020-2')); ?>">Admsion HI - Canal</a>
                      </li>
                      <li>
                        <a href="<?php echo e(url('/rep-calificacion-canales-HR-2020-2')); ?>">Admision HR - Canal</a>
                      </li> -->
                      
                    </ul>
                  </li>
                  

                  
                  <li>
                    <a>
                      <i></i>Ingeniería Civil Mañana<span class="fa fa-chevron-down"></span>
                    </a>
                    <ul class="nav child_menu">
                      <li>
                        <a href="<?php echo e(url('/cargar-txt-2020-2-ICM')); ?>">Subir Resultados DLM</a> <!-- CARGAR DLM 2020-2 -->
                      </li>
                      <li>
                        <a href="<?php echo e(url('/rep-calificacion-duplicados-2020-2-ICM')); ?>">Verificar Duplicados</a> <!-- REPORTE DUPLICADOS 2020-2 -->
                      </li>
                      <li class="duplicados_report">
                        <!-- class="duplicados_report" -->
                        <a href="<?php echo e(url('/rep-calificacion-2020-2-ICM')); ?>">Reporte de calificacion</a> <!-- REPORTE CALIFICACION CANAL A2020-2 -->
                      </li>
                      
                      <!-- <li>
                        <a href="<?php echo e(url('/rep-calificacion-canales-HI-2020-2')); ?>">Admsion HI - Canal</a>
                      </li>
                      <li>
                        <a href="<?php echo e(url('/rep-calificacion-canales-HR-2020-2')); ?>">Admision HR - Canal</a>
                      </li> -->
                      
                    </ul>
                  </li>
                  
                  
                  
                  <li>
                    <a>
                      <i></i>Ingeniería Civil Tarde<span class="fa fa-chevron-down"></span>
                    </a>
                    <ul class="nav child_menu">
                      <li>
                        <a href="<?php echo e(url('/cargar-txt-2020-2-ICT')); ?>">Subir Resultados DLM</a> <!-- CARGAR DLM 2020-2 -->
                      </li>
                      <li>
                        <a href="<?php echo e(url('/rep-calificacion-duplicados-2020-2-ICT')); ?>">Verificar Duplicados</a> <!-- REPORTE DUPLICADOS 2020-2 -->
                      </li>
                      <li class="duplicados_report">
                        <!-- class="duplicados_report" -->
                        <a href="<?php echo e(url('/rep-calificacion-2020-2-ICT')); ?>">Reporte de calificacion</a> <!-- REPORTE CALIFICACION CANAL A2020-2 -->
                      </li>
                      
                      <!-- <li>
                        <a href="<?php echo e(url('/rep-calificacion-canales-HI-2020-2')); ?>">Admsion HI - Canal</a>
                      </li>
                      <li>
                        <a href="<?php echo e(url('/rep-calificacion-canales-HR-2020-2')); ?>">Admision HR - Canal</a>
                      </li> -->
                      
                    </ul>
                  </li>
                  

                  
                  <li>
                    <a>
                      <i></i>Derecho y Ciencia Política Mañana<span class="fa fa-chevron-down"></span>
                    </a>
                    <ul class="nav child_menu">
                      <li>
                        <a href="<?php echo e(url('/cargar-txt-2020-2-DCM')); ?>">Subir Resultados DLM</a> <!-- CARGAR DLM 2020-2 -->
                      </li>
                      <li>
                        <a href="<?php echo e(url('/rep-calificacion-duplicados-2020-2-DCM')); ?>">Verificar Duplicados</a> <!-- REPORTE DUPLICADOS 2020-2 -->
                      </li>
                      <li class="duplicados_report">
                        <!-- class="duplicados_report" -->
                        <a href="<?php echo e(url('/rep-calificacion-2020-2-DCM')); ?>">Reporte de calificacion</a> <!-- REPORTE CALIFICACION CANAL A2020-2 -->
                      </li>
                      
                      <!-- <li>
                        <a href="<?php echo e(url('/rep-calificacion-canales-HI-2020-2')); ?>">Admsion HI - Canal</a>
                      </li>
                      <li>
                        <a href="<?php echo e(url('/rep-calificacion-canales-HR-2020-2')); ?>">Admision HR - Canal</a>
                      </li> -->
                      
                    </ul>
                  </li>
                  

                  
                  <li>
                    <a>
                      <i></i>Derecho y Ciencia Política Tarde<span class="fa fa-chevron-down"></span>
                    </a>
                    <ul class="nav child_menu">
                      <li>
                        <a href="<?php echo e(url('/cargar-txt-2020-2-DCT')); ?>">Subir Resultados DLM</a> <!-- CARGAR DLM 2020-2 -->
                      </li>
                      <li>
                        <a href="<?php echo e(url('/rep-calificacion-duplicados-2020-2-DCT')); ?>">Verificar Duplicados</a> <!-- REPORTE DUPLICADOS 2020-2 -->
                      </li>
                      <li class="duplicados_report">
                        <!-- class="duplicados_report" -->
                        <a href="<?php echo e(url('/rep-calificacion-2020-2-DCT')); ?>">Reporte de calificacion</a> <!-- REPORTE CALIFICACION CANAL A2020-2 -->
                      </li>
                      
                      <!-- <li>
                        <a href="<?php echo e(url('/rep-calificacion-canales-HI-2020-2')); ?>">Admsion HI - Canal</a>
                      </li>
                      <li>
                        <a href="<?php echo e(url('/rep-calificacion-canales-HR-2020-2')); ?>">Admision HR - Canal</a>
                      </li> -->
                      
                    </ul>
                  </li>
                  

                  
                  <li>
                    <a>
                      <i></i>Contabilidad y Finanzas Mañana<span class="fa fa-chevron-down"></span>
                    </a>
                    <ul class="nav child_menu">
                      <li>
                        <a href="<?php echo e(url('/cargar-txt-2020-2-CFM')); ?>">Subir Resultados DLM</a> <!-- CARGAR DLM 2020-2 -->
                      </li>
                      <li>
                        <a href="<?php echo e(url('/rep-calificacion-duplicados-2020-2-CFM')); ?>">Verificar Duplicados</a> <!-- REPORTE DUPLICADOS 2020-2 -->
                      </li>
                      <li class="duplicados_report">
                        <!-- class="duplicados_report" -->
                        <a href="<?php echo e(url('/rep-calificacion-2020-2-CFM')); ?>">Reporte de calificacion</a> <!-- REPORTE CALIFICACION CANAL A2020-2 -->
                      </li>
                      
                      <!-- <li>
                        <a href="<?php echo e(url('/rep-calificacion-canales-HI-2020-2')); ?>">Admsion HI - Canal</a>
                      </li>
                      <li>
                        <a href="<?php echo e(url('/rep-calificacion-canales-HR-2020-2')); ?>">Admision HR - Canal</a>
                      </li> -->
                      
                    </ul>
                  </li>
                  

                  
                  <li>
                    <a>
                      <i></i>Contabilidad y Finanzas <p>Tarde<span class="fa fa-chevron-down"></span></p>
                    </a>
                    <ul class="nav child_menu">
                      <li>
                        <a href="<?php echo e(url('/cargar-txt-2020-2-CFT')); ?>">Subir Resultados DLM</a> <!-- CARGAR DLM 2020-2 -->
                      </li>
                      <li>
                        <a href="<?php echo e(url('/rep-calificacion-duplicados-2020-2-CFT')); ?>">Verificar Duplicados</a> <!-- REPORTE DUPLICADOS 2020-2 -->
                      </li>
                      <li class="duplicados_report">
                        <!-- class="duplicados_report" -->
                        <a href="<?php echo e(url('/rep-calificacion-2020-2-CFT')); ?>">Reporte de calificacion</a> <!-- REPORTE CALIFICACION CANAL A2020-2 -->
                      </li>
                      
                      <!-- <li>
                        <a href="<?php echo e(url('/rep-calificacion-canales-HI-2020-2')); ?>">Admsion HI - Canal</a>
                      </li>
                      <li>
                        <a href="<?php echo e(url('/rep-calificacion-canales-HR-2020-2')); ?>">Admision HR - Canal</a>
                      </li> -->
                      
                    </ul>
                  </li>
                  

                  
                  <li>
                    <a>
                      <i></i>Enfermería<span class="fa fa-chevron-down"></span>
                    </a>
                    <ul class="nav child_menu">
                      <li>
                        <a href="<?php echo e(url('/cargar-txt-2020-2-ENFM')); ?>">Subir Resultados DLM</a> <!-- CARGAR DLM 2020-2 -->
                      </li>
                      <li>
                        <a href="<?php echo e(url('/rep-calificacion-duplicados-2020-2-ENFM')); ?>">Verificar Duplicados</a> <!-- REPORTE DUPLICADOS 2020-2 -->
                      </li>
                      <li class="duplicados_report">
                        <!-- class="duplicados_report" -->
                        <a href="<?php echo e(url('/rep-calificacion-2020-2-ENFM')); ?>">Reporte de calificacion</a> <!-- REPORTE CALIFICACION CANAL A2020-2 -->
                      </li>
                      
                      <!-- <li>
                        <a href="<?php echo e(url('/rep-calificacion-canales-HI-2020-2')); ?>">Admsion HI - Canal</a>
                      </li>
                      <li>
                        <a href="<?php echo e(url('/rep-calificacion-canales-HR-2020-2')); ?>">Admision HR - Canal</a>
                      </li> -->
                      
                    </ul>
                  </li>
                  

                  
                  <li>
                    <a>
                      <i></i>Obstetricia<span class="fa fa-chevron-down"></span>
                    </a>
                    <ul class="nav child_menu">
                      <li>
                        <a href="<?php echo e(url('/cargar-txt-2020-2-OBST')); ?>">Subir Resultados DLM</a> <!-- CARGAR DLM 2020-2 -->
                      </li>
                      <li>
                        <a href="<?php echo e(url('/rep-calificacion-duplicados-2020-2-OBST')); ?>">Verificar Duplicados</a> <!-- REPORTE DUPLICADOS 2020-2 -->
                      </li>
                      <li class="duplicados_report">
                        <!-- class="duplicados_report" -->
                        <a href="<?php echo e(url('/rep-calificacion-2020-2-OBST')); ?>">Reporte de calificacion</a> <!-- REPORTE CALIFICACION CANAL A2020-2 -->
                      </li>
                      
                      <!-- <li>
                        <a href="<?php echo e(url('/rep-calificacion-canales-HI-2020-2')); ?>">Admsion HI - Canal</a>
                      </li>
                      <li>
                        <a href="<?php echo e(url('/rep-calificacion-canales-HR-2020-2')); ?>">Admision HR - Canal</a>
                      </li> -->
                      
                    </ul>
                  </li>
                  

                  
                  <li>
                    <a>
                      <i></i> Proceso del Examen de Admisión 2020-2 <span class="fa fa-chevron-down"></span>
                    </a>
                    <ul class="nav child_menu">
                      <li>
                        <a href="<?php echo e(url('/cargar-txt-2020-2')); ?>">Subir Resultados DLM</a> <!-- CARGAR DLM 2020-2 -->
                      </li>
                      <li>
                        <a href="<?php echo e(url('/rep-calificacion-duplicados-2020-2')); ?>">Verificar Duplicados</a> <!-- REPORTE DUPLICADOS 2020-2 -->
                      </li>
                      <li class="duplicados_report">
                        <!-- class="duplicados_report" -->
                        <a href="<?php echo e(url('/rep-calificacion-2020-2_canal_A')); ?>">Reporte de calificacion canal A</a> <!-- REPORTE CALIFICACION CANAL A2020-2 -->
                      </li>
                      <li class="duplicados_report">
                        <!-- class="duplicados_report" -->
                        <a href="<?php echo e(url('/rep-calificacion-2020-2_canal_B')); ?>">Reporte de calificacion canal B</a> <!-- REPORTE CALIFICACION CANAL B 2020-2 -->
                      </li>
                      <li class="duplicados_report">
                        <!-- class="duplicados_report" -->
                        <a href="<?php echo e(url('/rep-calificacion-2020-2_canal_C')); ?>">Reporte de calificacion canal C</a> <!-- REPORTE CALIFICACION CANAL C 2020-2 -->
                      </li>
                      <li class="duplicados_report">
                        <!-- class="duplicados_report" -->
                        <a href="<?php echo e(url('/rep-calificacion-2020-2_canal_D')); ?>">Reporte de calificacion canal D</a> <!-- REPORTE CALIFICACION CANAL D 2020-2 -->
                      </li>

                      <li class="duplicados_report">
                        <!-- class="duplicados_report" -->
                        <a href="<?php echo e(url('/rep-calificacion-2020-2')); ?>">Reporte de calificacion Total</a> <!-- REPORTE CALIFICACION 2020-2 -->
                      </li>
                      <!-- <li>
                        <a href="<?php echo e(url('/rep-calificacion-canales-HI-2020-2')); ?>">Admsion HI - Canal</a>
                      </li>
                      <li>
                        <a href="<?php echo e(url('/rep-calificacion-canales-HR-2020-2')); ?>">Admision HR - Canal</a>
                      </li> -->
                      <li>
                        <a href="<?php echo e(url('/rep-calificacion-por-postulante-2020-2')); ?>">Reporte de Calificacion Por Alumno</a>
                      </li>
                    </ul>
                  </li>
                  

                  
                  <li>
                    <a>
                      <i></i> Proceso del Examen Especial 2020-2<span class="fa fa-chevron-down"></span>
                    </a>
                    <ul class="nav child_menu">
                      <li>
                        <a href="<?php echo e(url('/cargar-txt-2020-2-E')); ?>">Subir Resultados DLM</a> <!-- CARGAR DLM 2020-2 -->
                      </li>
                      <li>
                        <a href="<?php echo e(url('/rep-calificacion-duplicados-2020-2-E')); ?>">Verificar Duplicados</a> <!-- REPORTE DUPLICADOS 2020-2 -->
                      </li>
                      <li class="duplicados_report">
                        <!-- class="duplicados_report" -->
                        <a href="<?php echo e(url('/rep-calificacion-2020-2-especial')); ?>">Reporte de Calificación Examen Especial</a>
                      </li>
                      <!--li>
                                <a href="<?php echo e(url('/rep-calificacion-canales-HI-2020-2')); ?>" >Admsion HI - Canal</a>
                              </li>
                              <li>
                                <a href="<?php echo e(url('/rep-calificacion-canales-HR-2020-2')); ?>" >Admision HR - Canal</a>
                              </li>
                              <li>
                                <a href="<?php echo e(url('/rep-calificacion-por-postulante-2020-2')); ?>" >Reporte de Calificacion Por Alumno</a>
                              </li-->
                    </ul>
                  </li>
                  
                  <!-- inicio examen ceprep -->
                  <!-- <li>
                    <a>
                      <i></i> Proceso del Examen de CEPRE<span class="fa fa-chevron-down"></span>
                    </a>
                    <ul class="nav child_menu">
                      <li>
                        <a>
                          <i></i>1ER Calificación<span class="fa fa-chevron-down"></span>
                        </a>
                        <ul class="nav child_menu">
                          <li>
                            <a href="<?php echo e(url('/cargar-txt-cepre')); ?>">Subir Resultados DLM</a>
                          </li>
                          <li>
                            <a href="<?php echo e(url('/rep-calificacion-cepre')); ?>">Reporte de calificacion</a>
                          </li>
                          <li>
                            <a href="<?php echo e(url('/rep-calificacion-cepre-duplicados')); ?>">Duplicados</a>
                          </li>
                          <li>
                            <a href="<?php echo e(url('/rep-calificacion-cepre-canales')); ?>">Cepre Canal</a>
                          </li>
                          <li>
                            <a href="<?php echo e(url('/rep-calificacion-cepre-canales-HI')); ?>">Cepre HI - Canal</a>
                          </li>
                          <li>
                            <a href="<?php echo e(url('/rep-calificacion-cepre-canales-HR')); ?>">Cepre HR - Canal</a>
                          </li>
                          <li>
                            <a href="<?php echo e(url('/rep-calificacion-por-postulante-cepre')); ?>">Reporte de Calificacion Por Alumno</a>
                          </li>
                        </ul>
                      </li>
                      <li>
                        <a>
                          <i></i>2DA Calificación<span class="fa fa-chevron-down"></span>
                        </a>
                        <ul class="nav child_menu">
                          <li>
                            <a href="<?php echo e(url('/cargar-txt-cepre-2')); ?>">Subir Resultados DLM</a>
                          </li>
                          <li>
                            <a href="<?php echo e(url('/rep-calificacion-cepre-II')); ?>">Reporte de calificacion</a>
                          </li>
                          <li>
                            <a href="<?php echo e(url('/rep-calificacion-cepre-duplicados-II')); ?>">Duplicados</a>
                          </li>
                          <li>
                            <a href="<?php echo e(url('/rep-calificacion-cepre-canales-II')); ?>">Cepre Canal</a>
                          </li>
                          <li>
                            <a href="<?php echo e(url('/rep-calificacion-cepre-canales-HI-2')); ?>">Cepre HI - Canal</a>
                          </li>
                          <li>
                            <a href="<?php echo e(url('/rep-calificacion-cepre-canales-HR-2')); ?>">Cepre HR - Canal</a>
                          </li>
                          <li>
                            <a href="<?php echo e(url('/rep-calificacion-por-postulante-cepre-2')); ?>">Reporte de Calificacion Por Alumno</a>
                          </li>
                        </ul>
                      </li>
                      <li>
                        <a href="<?php echo e(url('/rep-calificacion-cepre-final')); ?>">Reporte de calificacion - Final</a>
                      </li>
                    </ul>
                  </li>

                  <li>
                    <a>
                      <i></i> Proceso del Examen de Simulacro<span class="fa fa-chevron-down"></span>
                    </a>
                    <ul class="nav child_menu">
                      <li>
                        <a href="<?php echo e(url('/cargar-txt-simulacro')); ?>">Subir Resultados DLM</a>
                      </li>
                      <li>
                        <a href="<?php echo e(url('/rep-calificacion-simulacro')); ?>">Reporte de calificacion</a>
                      </li>
                      <li>
                        <a href="<?php echo e(url('/rep-calificacion-simulacro-duplicados')); ?>">Duplicados</a>
                      </li>
                      <li>
                        <a href="<?php echo e(url('/rep-calificacion-simulacro-canales')); ?>">Simulacro Canal</a>
                      </li>
                      <li>
                        <a href="<?php echo e(url('/rep-calificacion-simulacro-canales-HI')); ?>">Simulacro HI - Canal</a>
                      </li>
                      <li>
                        <a href="<?php echo e(url('/rep-calificacion-simulacro-canales-HR')); ?>">Simulacro HR - Canal</a>
                      </li>
                    </ul>
                  </li> -->
                  <!-- fin examen cepre -->

                </ul>
              </li>
              <!-- FIN MODULO CALIFICACION -->
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
                  <img style="width: 30px;height: 30px;" src="<?php if(Auth::user()->foto== ''): ?> 
                          <?php echo e(asset('images/user.png')); ?> 
                          <?php else: ?> <?php echo e(asset(Auth::user()->foto)); ?>  
                          <?php endif; ?>" alt=""><?php echo e(Auth::user()->nombre); ?>

                  <span class=" fa fa-angle-down"></span>
                </a>
                <ul class="dropdown-menu dropdown-usermenu pull-right">
                  <li><a href="javascript:;"> Perfil</a></li>
                  <li><a id="btnCPassword"> Cambiar Contraseña</a></li>
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
      <div id="myModal1" class="modal" tabindex="-1" role="dialog" aria-hidden="true">
        <div class="modal-dialog modal-sm">
          <div class="modal-content" style="width: 300px;">

            <div class="modal-header">
              <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">×</span>
              </button>
              <h4 class="modal-title" id="myModalLabelPassworrd">Cambiar contraseña</h4>
            </div>
            <form id="formchangepassword" class="form-horizontal form-label-left">
              <div class="modal-body">
                <div class="box-body">

                  <div class="form-group">

                    <label>
                      <span class="label label-danger">
                        Antigua clave
                      </span>
                    </label>

                    <input type="hidden" class="form-control input-sm" name="iduser" value="<?php echo e(Auth::user()->id); ?>" placeholder="Antigua Clave" type="text" maxlength="16">
                    <input type="hidden" class="form-control input-sm" name="oldpassword1" placeholder="Antigua Clave" type="text" maxlength="16" value="<?php echo e(Auth::user()->password); ?>">
                    <span class="help-block"></span>
                    <input class="form-control input-sm" name="oldpassword" placeholder="Antigua Clave" type="text" maxlength="16">
                    <span class="help-block"></span>

                  </div>
                  <div class="form-group">
                    <label>
                      <span class="label label-warning">
                        Nueva clave
                      </span>
                    </label>
                    <input class="form-control input-sm" name="newpassword" placeholder="Nueva Clave" type="text" maxlength="16">
                    <span class="help-block"></span>

                  </div>
                  <div class="form-group">
                    <label>
                      <span class="label label-success">
                        Repita nueva clave
                      </span>
                    </label>
                    <input class="form-control input-sm" name="passwordrepeat" placeholder="Repirta Nueva Clave" type="text" maxlength="16">
                    <span class="help-block"></span>
                    <div id="alert" style="display: none;" class="alert   alert-dismissible fade in" role="alert">
                      <p id="message"></p>
                    </div>
                  </div>

                </div>
              </div>
              <div class="modal-footer">
                <button type="button" class="btn btn-default" data-dismiss="modal">Cancelar</button>
                <button type="submit" class="btn btn-primary">Guardar</button>
              </div>
            </form>

          </div>
        </div>
      </div>
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


  <script src="<?php echo e(asset('js/pnotify.js')); ?>"></script>

  <!-- jQuery -->
  <script src="<?php echo e(asset('js/jquery.min.js')); ?>"></script>
  <!-- Bootstrap -->
  <script src="<?php echo e(asset('js/bootstrap.min.js')); ?>"></script>
  <!-- Custom Theme Scripts -->
  <script src="<?php echo e(asset('js/custom.min.js')); ?>"></script>

  <script>
    $(document).ready(function() {
      $urlbase = $("body").attr('urlbase');
      //VALIDAR DUPLICADOS
      // $.ajax({
      //   url: 'rep-constancias-cali-duplicados-2020-2',
      //   method: 'POST',
      //   data: {
      //     tipo: $tipo.val(),
      //     dato: $dato.val(),
      //     idproceso: $idproceso.val()
      //   }
      // }).done(function(response) {
      //   console.log(response.postulaciones);

      //   if (response.postulaciones != "") {
      //     console.log("lleno")
      //     $(".duplicados_report").hide()
      //   } else {
      //     console.log("vacio")
      //     $(".duplicados_report").show()
      //   }

      //   //$.each(response, function(index, value) {
      //   //});
      // }).fail(function(error) {
      //   console.log(error);
      // });
      //FIN VALIDACION      
    });

    $.ajaxSetup({
      headers: {
        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
      }
    });

    $('#btnCPassword').click(function() {
      //      $("#txtRazonSocial").prop('disabled', false);
      $('#myModal1').modal('show');
    });

    $("#formchangepassword").submit(function(event) {
      event.preventDefault();
      $.ajax({
        url: '/user/changepassword',
        method: 'POST',
        data: $(this).serialize(),
        success: function(data) {


          if (data.success == true) {
            $("#alert").show(0).delay(5000).hide(0).addClass('alert-success');

            $("#message").text("GRABO CORRECTAMENTE");


            setTimeout(function() {
              $('#myModal1').modal('toggle');
            }, 1000);
            $("#formchangepassword")[0].reset();

          } else {
            if (data.success == false) {
              $("#alert").show(0).delay(5000).hide(0).addClass('alert-danger');

              $("#message").text("CONTRASEÑA ANTERIOR INCORRECTA");

              //$("#myModal1").modal('toggle');
              //$("#formchangepassword")[0].reset();

            } else {
              $("#alert").show(0).delay(5000).hide(0).addClass('alert-warning');

              $("#message").text("LAS CONTRASEÑAS INGRESADAS NO COINCIDEN");
            }

          }

        },
        error: function(data) {

        }
      });
    });

    function mensaje(msg, color) {
      $tipo = "error";
      $title = "Mensaje:";
      if (color == "red") {
        $tipo = "error";
        $title = "Error:";
      }
      if (color == "green") {
        $tipo = "success";
        $title = "Guardado:";
      }

    }
  </script>

  <!-- <script>
      //VALIDAR DUPLICADOS
    $(document).ready(function() {
      // $urlbase = $("body").attr('urlbase');
      function A: $(document).ready(function())
      $.ajax({
        url: 'rep-constancias-cali-duplicados-2020-2',
        method: 'POST',
        data: {
          tipo: $tipo.val(),
          dato: $dato.val(),
          idproceso: $idproceso.val()
        }
      }).done(function(response) {
        console.log(response.postulaciones);

        if(response.postulaciones != ""){
          console.log("lleno")
          $(".duplicados_report").hide()
        }else{
          console.log("vacio")
          $(".duplicados_report").show()
        }

        //$.each(response, function(index, value) {
        //});
      }).fail(function(error) {
        console.log(error);
      });
    });
  </script> -->

  <?php echo $__env->yieldContent('js'); ?>

</body>

</html>