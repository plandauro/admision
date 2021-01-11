<?php $__env->startSection('title', ''); ?>

<?php $__env->startSection('content'); ?>
  @parent
  <?php if($tarifa==17): ?>
  <div class="">
   

    <div class="clearfix"></div>

    <div class="row">
      <div class="col-md-12 col-sm-12 col-xs-12">
        <div class="jumbotron">
          <div class="row">
            <div style="margin-bottom: 10px; margin-left: -15px" class="col-md-12">
              <h1 style="margin-top:-20px;font-size: 35px;"">
                <strong>!Felicitaciones!</strong> 
              </h1>
              <br>
              <h1 style="margin-top:-20px;font-size: 35px;"">
                <strong>Haz generado con exito tu FICHA DE INSCRICIÓN</strong> 
              </h1>
              <table style="margin: 0px 20px 0px 20px;">
                <tr>
                  <td>
                  <a href="<?php echo e(url('/pdf/ficha_inscripcion')); ?>" target="_blank">
                    <span class="fa fa-file-pdf-o"></span> 1. Ficha de Inscripción
                  </a><br><br>
                  
                  </td>
                  <td>
                    <img style="width: 150px; margin-left: 170px;     font-weight: bold; " src="<?php echo e(asset('images/logo.png')); ?>" alt="">
                    
                  </td>
                </tr>
                <br>
                
              </table>
              <br>
            </div>
        
          </div>
          
        </div>
      </div>
    </div>
  </div>
  <?php else: ?>
  <div class="">
   

    <div class="clearfix"></div>

    <div class="row">
      <div class="col-md-12 col-sm-12 col-xs-12">
        <div class="jumbotron">
          <div class="row">
            <div style="margin-bottom: 10px; margin-left: -15px" class="col-md-12">
              <h1 style="margin-top:-20px;font-size: 35px;"">
                <strong>!Felicitaciones tu postulación ha sido completada!</strong> 
              </h1>
              <p style="font-size: 16px;margin-bottom: 15px;">
              Ahora imprime tu identificación de postulación y dirigete a rendir tu examen el día y lugar indicado. No olvides llevar tu DNI o documento de identificación:)</p>
              <table style="margin: 0px 20px 0px 20px;">
                <tr>
                  <td>
                    <a href="<?php echo e(url('/pdf/carne_inscripcion')); ?>" target="_blank">
                    <span class="fa fa-file-pdf-o"></span> 1. Carné de Postulación
                  </a><br><br>
                  <a href="<?php echo e(url('/pdf/ficha_inscripcion')); ?>" target="_blank">
                    <span class="fa fa-file-pdf-o"></span> 2. Ficha de Inscripción
                  </a><br><br>
                  <?php if($postulante->edad >= 18): ?>
                  <a href="<?php echo e(url('/pdf/jdantecedentes_inscripcion')); ?>" target="_blank">
                    <span class="fa fa-file-pdf-o"> </span>   3. Declaración Jurada de Antecedentes Penales
                  </a>
                  <br><br>
                  <?php endif; ?>
                  <!--a href="<?php echo e(url('/pdf/PROSPECTO_2019_II_FINAL.pdf')); ?>" target="_blank">
                    <span class="fa fa-file-pdf-o"> </span>   4. Prospecto de Admisión
                  </a--> 
                  </td>
                  <td>
                    <img style="width: 150px; margin-left: 170px;     font-weight: bold; " src="<?php echo e(asset('images/logo.png')); ?>" alt="">
                    
                  </td>
                </tr>
                <br>
                
              </table>
              <br>
                <p style="font-size: 16px;margin-bottom: 15px; font-weight: bold;">              
              (Aviso importante: Para validar el Carnet de postulante, deberá acercarse a la Oficina de Admisión ubicada en Jr. Gálvez N° 557 – Barranca, con sus respectivos
               			documentos impresos por duplicado (Ficha de inscripción, Declaración jurada de Antecedentes Penales y 2 copias del Boucher del Pago) para
               			 		posteriormente recibir el sello de conformidad. En caso contrario, el carnet no tendrá ninguna validez.)</p>
            </div>
        
          </div>
          
        </div>
      </div>
    </div>
  </div>
  <?php endif; ?>
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