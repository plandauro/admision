  

<?php $__env->startSection('title', ''); ?>

<?php $__env->startSection('content'); ?>
  @parent
  <style>
.titleLabel{
  font-size:15px;font-weight:bold;
}
  </style>
  <div class="">
    <div class="page-title">
      <div class="title_left">
        <h3>Generar Examen de Admisi&#243n</h3>
      </div>

    </div>

    <div class="clearfix"></div>

    <div class="row"> 


      <div class="col-md-12 col-sm-12 col-xs-12">
        <div id="verificar" class="x_panel">
          
          <div id="principal"  class="x_content">
            <div class="row">


                  
                                <input  name="_token" id="_token" type="hidden" value="<?= csrf_token(); ?>"> 
        
         <h1  style="font-weight:bold;">PASO # 2<h1/>
         <h3>(nueva evaluaci&#243n)<h3/>
                  
   
    
    <div class="col-sm-12">
    
                              <?php $__currentLoopData = $evaluacion; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $evaluacion): $__env->incrementLoopIndices(); $loop = $__env->getFirstLoop(); ?>
 
                    <div class="table-responsive">
                    <input type="hidden" id="nromaterias" value="<?php echo e($evaluacion->nromaterias); ?>" class="form-control" />
           
                    <input type="hidden" id="idevaluacion" value="<?php echo e($evaluacion->id_proceso); ?>" class="form-control" />
                    	  <?php endforeach; $__env->popLoop(); $loop = $__env->getFirstLoop(); ?>
                    <table id="tabla" class="table table-striped">
            <thead>
              <tr>
                <th>Materia</th>
                <th>Dificultad</th>
                <th># Preguntas</th>
              </tr>
            </thead>
            <tbody>
               
            </tbody>
          </table>
    
    
    
    
    </div>
            
  
         <a id="grabar" type="button"    id="grabar" class="btn btn-success" >FINALIZAR</a>


                  </div>
                  
                  




            </div>
            
            
          </div>
        </div>
      </div>
    </div>
  </div>
<?php $__env->stopSection(); ?>

<?php $__env->startSection('css'); ?>
 
<?php $__env->stopSection(); ?>

<?php $__env->startSection('js'); ?>
<!-- PNotify -->
  <script src="<?php echo e(asset('js/pnotify.js')); ?>"></script>
  <script src="<?php echo e(asset('js/pnotify.buttons.js')); ?>"></script>
  <script src="<?php echo e(asset('js/pnotify.nonblock.js')); ?>"></script>
  
  <script>
 $(document).ready(function() {
 

generarFilas();
  llenarComboMateria();
  llenarComboDificultad();


});
 </script>
 
   <script> 
 function generarFilas(){
 var iCnt = 0;
 nromaterias=$('#nromaterias').val();


            for(var i=0;i<nromaterias;i++){
            iCnt = iCnt + 1;
              
            var nuevaFila="<tr>";
                // añadimos las columnas
                nuevaFila+="<td><select  id='materia"+iCnt+"' class='form-control'><option>Seleccione</option></select></td><td><select  id='dificultad"+iCnt+"' class='form-control'><option>Seleccione</option></select></td><td><input  id='cantPregunta"+iCnt+"' class='form-control' /></td>";
                    nuevaFila+="<td>";
            nuevaFila+="</tr>";
            $("#tabla").append(nuevaFila);

        }} 
          </script>
        
        <script>
        function llenarComboMateria(){
    $.ajax({
        url: "comboMateria",
        //type: 'text',
        type: 'POST',
        dataType: 'json',
        
        success: function(response) {            
            $.each(response, function (index, object)   {                             
                var nrow=document.getElementById("tabla").rows.length;
                 for (var i = 0; i < nrow; i++) {              
                 $("select[id='materia"+i+"']").append("<option value='"+object['id']+"'>"+object['nombre']+"</option>");
                }})}})
              }
  
        function llenarComboDificultad(){
    $.ajax({
        url: "comboDificultad",
        type: 'POST