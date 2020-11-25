<?php $__env->startSection('title', ''); ?>

<?php $__env->startSection('content'); ?>
  @parent
  <div class="">
   

    <div class="clearfix"></div>

    <center>
    <div class="row">
      <div class="col-md-12 col-sm-12 col-xs-12">
        <div class="jumbotron">
          <div class="row">
            <div style="margin-bottom: 10px; margin-left: -15px" class="col-md-12">
              <h1 style="margin-top:-20px;font-size: 35px;"">
                <strong>INFORMACIÓN DE PAGOS SEGÚN MODALIDAD</strong> 
              </h1>
              <p style="font-size: 16px;margin-bottom: 15px;">Escoja su modalidad a postular para calcular el pago que debe realizar en el banco:</p>
              <br>
            </div>
            <div style="padding-right: 100px;margin-top: 0px;" class="col-xs-12 col-md-12">
              <p style="margin:0px 0px 10px -15px; font-size: 16px; font-weight: bold"><span ></span>Realiza los siguientes depósitos: </p>
              <table id="tblpagos" class="table table-hover">
                <thead>
                  <tr>
                    <th>Descripción</th>
                    <th style="width: 100px">Importe (S/.) </th>
                  </tr>
                </thead>
                <tbody>
                  <tr id="costocarpetatotalX">
                    <td >Carpeta del Postulante</td>
                    <td  id="costocarpeta">S/. <input id="costocarpetatotal" style="background: none;border: none; position: absolute;" value=" <?php echo e($costocarpeta); ?>" /></td>
                  </tr>
                  <tr id="costoprospectoatotalX">
                    <td >Prospecto de admisión</td>
                    <td id="costoprospecto">S/. <input id="costoprospectoatotal" style="background: none;border: none; position: absolute;" value=" <?php echo e($costoprospecto); ?>" /></td>
                  </tr>
                  <tr>
                    <td>                    
                      <select style="width: 450px" class="form-control" name="tarifa" id="tarifa" >
                        <option value="0.00">(Seleccionar la modalidad a postular)</option>
                          <?php $__currentLoopData = $tarifas; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $tarifa): $__env->incrementLoopIndices(); $loop = $__env->getFirstLoop(); ?>
                          <option value="<?php echo e($tarifa->costotarifa); ?>">
                          <?php echo e($tarifa->descripcion); ?></option>
                          <?php endforeach; $__env->popLoop(); $loop = $__env->getFirstLoop(); ?>
                      </select>                    
                    </td>
                    <td id="costopostulacion">S/. <label id="idlabel" name="idlabel"></label>                     
                    </td>
                  </tr>
                </tbody>
                <thead>
                  <tr>
                    <th>Total a depositar</th>
                    <th id="costototal">S/.  <input id="costototalinput" style="background: none;border: none; position: absolute;" value=" 0" /></th>
                  </tr>
                </thead>
              </table>
              <p style="font-size: 14px"><strong>Nota: </strong>Puedes realizar el pago en cualquier  AGENTE INTERBANK a nivel nacional con el siguiente código: 
              <br><br>
              <p style="font-weight:bold; aling:center;">       DEPÓSITOS/PAGOS</p> 
                      <div class="prueba2">   <p style="font-weight:bold; aling:center;   width: 600px;   font-size: 15px; ">      AGENTE: 25-122-01-<?php echo e($dni); ?> (PAGO PREFERENCIAL)</p>    
     
             </div>
                   
                    <div class="prueba2">   <p style="font-weight:bold; aling:center;">      VENTANILLA : 05-122-01-<?php echo e($dni); ?></p>       
                
             </div>
           
               
             
             
              </p>
            </div>
            
              
            <div class="col-md-12">
              
              
            </div>
    