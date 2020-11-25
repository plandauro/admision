<?php $__env->startSection('title', ''); ?>

<?php $__env->startSection('content'); ?>
  @parent
  <div class="">
   

    <div class="clearfix"></div>

    <div class="row">
      <div class="col-md-12 col-sm-12 col-xs-12">
        <div class="jumbotron">
          <div class="row">
            <div style="margin-bottom: 10px; margin-left: -15px" class="col-md-12">
              <h1 style="margin-top:-20px;font-size: 35px;"">
                <strong>!Felicitaciones!</strong> 
                <span style="font-size: 18px" >Has realizado tu pre postulación.</span>
              </h1>
              <p style="font-size: 16px;margin-bottom: 15px;">Ahora realiza los siguientes procedimientos:</p>
              <br>
            </div>
            <div style="padding-right: 100px;margin-top: 0px;" class="col-xs-12 col-md-6">
              <p style="margin:0px 0px 10px -15px; font-size: 16px; font-weight: bold"><span >1: </span>Realiza los siguientes depósitos: </p>
              <table id="tblpagos" class="table table-hover">
                <thead>
                  <tr>
                    <th>Descripción</th>
                    <th style="width: 100px">Importe (S/.) </th>
                  </tr>
                </thead>
                <tbody>
                  <tr>
                    <td>Carpeta del Postulante</td>
                    <td  id="costocarpeta">S/. <?php echo e($costocarpeta); ?></td>
                  </tr>
                  <tr>
                    <td>Prospecto de admisión</td>
                    <td id="costoprospecto">S/. <?php echo e($costoprospecto); ?></td>
                  </tr>
                  <tr>
                    <td><?php echo e($postulacion->tarifa->descripcion); ?></td>
                    <td id="costopostulacion">S/. <?php echo e($postulacion->tarifa->costotarifa); ?></td>
                  </tr>
                </tbody>
                <thead>
                  <tr>
                    <th>Total a depositar</th>
                    <th id="costototal">S/. <?php echo e(number_format(($costocarpeta+$costoprospecto+$postulacion->tarifa->costotarifa),2)); ?></th>
                  </tr>
                </thead>
              </table>
              <p style="font-size: 14px"><strong>Nota: </strong>Puedes realizar el pago en cualquier  AGENTE INTERBANK a nivel nacional con el siguiente código: 
              <br><br>
                <strong style="font-size: 16px; 
                              margin-left: 50px; 
                              border: 2.5px solid #999; 
                              background-color: #004c99;
                              color: #fff; 
                              padding: 10px;
                              border-radius: 15px;
                              cursor: pointer;">
                    05-122-01-<?php echo e($postulante->dni); ?>

                </strong>
              </p>
            </div>
            <div class="col-xs-12 col-md-6" style="padding: 0px 0px 0px 10px;" >
              <p style="margin:0px 0px 10px -15px; font-size: 16px; font-weight: bold"><span >2: </span>Imprime y dirígete a la Oficina de Admisión: </p>
              <p style="font-size: 15px; ">Imprime el/los siguientes formatos, revísalos y coloca tu firma y huella digital en los lugares que lo indique.</p>

              <ul id="lista-link">
                <li>
                  <a href="<?php echo e(url('/pdf/ficha_inscripcion')); ?>" target="_blank">
                    <span class="fa fa-file-pdf-o"></span> 1. Ficha de Inscripción
                  </a>
                </li>
                <?php if($postulante->edad >= 18): ?>
                <li>
                  <a href="<?php echo e(url('/pdf/jdantecedentes_inscripcion')); ?>" target="_blank">
                    <span class="fa fa-file-pdf-o"></span> 2. Declaración Jurada de Antecedentes Penales
                  </a>
                </li>
                <?php endif; ?>

              </ul>
              <br>
              <p style="font-size: 15px; ">Ahora dirígete a la oficina de <strong>ADMISIÓN</strong> de la Universidad Nacional de Barranca,  ubicada en el Jr. Gálvez N° 557 - Barranca, llevando los formatos impresos por duplicado, el boucher de pago (original y dos copias) para <strong> VALIDAR </strong>su postulación.</p>
              <p style="margin:0px 0px 10px -15px; font-size: 16px; font-weight: bold"><span >3: </span>Descarga e imprime el Carné de Postulante. </p><p style="font-size: 15px; ">Validada tu inscripción en la Oficina de Admisión podrás descargar e imprimir el Carné de Postulante, el cual presentarás el día del examen.</p>
            </div>
              
            <div class="col-md-12">
              
              
            </div>
          </div>
          
        </div>
      </div>
    </div>
  </div>
<?php $__env->stopSection(); ?>


<?php $__env->startSection('css'); ?>
<style type="text/css">
  #lista-link li{
    list-style:none;
    margin:5px 0px 0px 0px;
    font-size: 14px;
    font-weight: bold;
  }
  #lista-link li:hover{
    text-decoration: underline;
  }

</style>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.master', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>