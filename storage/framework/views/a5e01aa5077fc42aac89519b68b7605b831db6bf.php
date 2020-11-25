  <?php $__env->startSection('title', ''); ?>

  <?php $__env->startSection('content'); ?>
    @parent
    <style>
    .progress-bar.active, .progress.active .progress-bar {
    -webkit-animation: progress-bar-stripes 2s linear infinite;
    -o-animation: progress-bar-stripes 2s linear infinite;
    animation: progress-bar-stripes 2s linear infinite;
}
.progress.sm, .progress-sm, .progress.sm .progress-bar, .progress-sm .progress-bar {
    border-radius: 1px;
}
.progress, .progress>.progress-bar, .progress .progress-bar, .progress>.progress-bar .progress-bar {
    border-radius: 1px;
}
.progress, .progress>.progress-bar {
    -webkit-box-shadow: none;
    box-shadow: none;
}
.progress-bar-green, .progress-bar-success {
    background-color: #00a65a;
}
.progress-bar-success {
    background-color: #5cb85c;
}
.progress-bar-striped, .progress-striped .progress-bar {
    background-image: -webkit-linear-gradient(45deg,rgba(255,255,255,.15) 25%,transparent 25%,transparent 50%,rgba(255,255,255,.15) 50%,rgba(255,255,255,.15) 75%,transparent 75%,transparent);
    background-image: -o-linear-gradient(45deg,rgba(255,255,255,.15) 25%,transparent 25%,transparent 50%,rgba(255,255,255,.15) 50%,rgba(255,255,255,.15) 75%,transparent 75%,transparent);
    background-image: linear-gradient(45deg,rgba(255,255,255,.15) 25%,transparent 25%,transparent 50%,rgba(255,255,255,.15) 50%,rgba(255,255,255,.15) 75%,transparent 75%,transparent);
    -webkit-background-size: 40px 40px;
    background-size: 40px 40px;
}
.progress-bar {
    float: left;
    width: 0;
    height: 100%;
    font-size: 12px;
    line-height: 20px;
    color: #fff;
    text-align: center;
    background-color: #337ab7;
    -webkit-box-shadow: inset 0 -1px 0 rgba(0,0,0,.15);
    box-shadow: inset 0 -1px 0 rgba(0,0,0,.15);
    -webkit-transition: width .6s ease;
    -o-transition: width .6s ease;
    transition: width .6s ease;
}

  .titleLabel{
    font-size:15px;font-weight:bold;
  }

   .titleLabelsmall{
    font-size:12px;
  }

  . {
    visibility:hidden;
    height:0px;
  }

  .alertaDeTipo{
    padding-bottom:  10px;
    width: 100%;
    font-size: 15px;
    font-weight: bold;
    color:white;
  }

  .error{
    border: red solid 1.5px;

  }

  .like{
    border: #2cd62c solid 1.5px;

  }
  .mensaje{
font-size: 10px;
color:red;
  }
    </style>
    <div class="">
      <div class="page-title">
        <div class="title_left">
          <h3>Generar Examen de Admision</h3>
        </div>

      </div>

      <div class="clearfix"></div>
<?php $estado='0';?>
      <?php $__currentLoopData = $evaluacion; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $evaluacionEstado): $__env->incrementLoopIndices(); $loop = $__env->getFirstLoop(); ?>
<?php $estado= $evaluacionEstado->estado;?>
      <?php endforeach; $__env->popLoop(); $loop = $__env->getFirstLoop(); ?>
<input   id="estado" type="hidden"  value="<?php  echo $estado; ?>">


<input   id="orden" type="hidden"  value="0" class="form-control" />
<div class="progress progress-sm active">
                <div class="progress-bar progress-bar-success progress-bar-striped"  id="progressbar" aria-valuenow="20" aria-valuemin="0" aria-valuemax="100" style="width: 0%">
                  <span  id="ordenLoading"  class="">0% complete</span>
                </div>
              </div>
      <?php if($estado=='1'): ?>
      <input  id="estadoNext" type="hidden"  value="2"/>

      <div class="row">

        <div class="col-md-12 col-sm-12 col-xs-12">
          <div id="verificar" class="x_panel">

            <div id="principal"  class="x_content">
              <div class="row">

                                  <input  name="_token"   id="_token" type="hidden" value="<?= csrf_token(); ?>">

           <h1  style="font-weight:bold;">PREGUNTAS REPETITIVAS<h1/>
             <?php $__currentLoopData = $evaluacion; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $evaluacion): $__env->incrementLoopIndices(); $loop = $__env->getFirstLoop(); ?>
<input hidden id="sumaTotalDificultad"/>
           <h3>(se repetiran en todas las evaluaciones)<h3/> <h4> preguntas:<label class="red" id="sumaTotal">0 </label><label >/</label><label ><?php echo e($evaluacion->nropreguntasrep); ?> </label> - Materias: <label class="red" id="sumaTotalMaterias">0 </label><label> </label>/ <?php echo e($evaluacion->nromateriasrep); ?></h4>
             <div class="col-sm-12">



                      <div class="table-responsive">
                        <input  id="nromaterias"   type="hidden"   value="<?php echo e($evaluacion->nromateriasrep); ?>" />
                        <input id="nropreguntasrep"  type="hidden"  value="<?php echo e($evaluacion->nropreguntasrep); ?>"  />
                        <input  id="tokenEvaluacion"   type="hidden"  value="<?php echo e($evaluacion->token); ?>">

                        <input  id="idevaluacion"   type="hidden"   value="<?php echo e($evaluacion->id); ?>" class="form-control" />
                      	  <?php endforeach; $__env->popLoop(); $loop = $__env->getFirstLoop(); ?>
                      <table id="tablaone" class="table table-striped">
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

              <a type="button"    id="grabarone" class="btn btn-success" >CONTINUAR</a>




                    </div>






              </div>


            </div>
          </div>
        </div>
      </div>

      <?php elseif($estado=='2'): ?>

      <div  class="row" >


        <div class="col-md-12 col-sm-12 col-xs-12">

          <div style="" id="verificar2" class="x_panel  ">

            <div id="principal"  class="x_content  ">

      <input  id="estadoNext" type="hidden" value="3"/>

      <div class="row" >



                          <input    name="_token" id="_token" type="hidden" value="<?= csrf_token(); ?>">
                          <?php $__currentLoopData = $evaluacion; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $evaluacion): $__env->incrementLoopIndices(); $loop = $__env->getFirstLoop(); ?>

      <h1  style="font-weight:bold;">PREGUNTAS ALEATORIAS<h1/>
        <input hidden id="sumaTotalDificultad2"/>

        <h3>(se repetiran en todas las evaluaciones)<h3/> <h4> preguntas:<label class="red" id="sumaTotal2">0 </label><label >/</label><label ><?php echo e($evaluacion->nropreguntas); ?> </label> - Materias: <label class="red" id="sumaTotalMaterias2">0 </label><label> </label>/ <?php echo e($evaluacion->nromaterias); ?></h4>


      <div class="col-sm-12">


              <div class="table-responsive">
                <input  id="nromaterias"  type="hidden"  value="<?php echo e($evaluacion->nromaterias); ?>" class="form-control" />
                <input id="nropreguntas"   type="hidden"   value="<?php echo e($evaluacion->nropreguntas); ?>" class="form-control" />
                <input  id="tokenEvaluacion"   type="hidden"   value="<?php echo e($evaluacion->token); ?>">

                <input  id="idevaluacion"  type="hidden"     value="<?php echo e($evaluacion->id); ?>" class="form-control" />
                <input  id="ideval"    type="hidden"   value="<?php echo e($evaluacion->id); ?>" class="form-control" />
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


      <a id="grabar" type="button"    class="btn btn-success" >FINALIZAR</a>


            </div>






      </div>


            <?php else: ?>


            <div  class="row" >


              <div class="col-md-12 col-sm-12 col-xs-12">

                <div style="" id="verificar" class="x_panel  ">

                  <div id="principal"  class="x_content  ">
                    <div class="row">
            <input  id="estado" value="1"  type="hidden"   class="form-control" />


                                        <input    name="_token" id="_token" type="hidden" value="<?= csrf_token(); ?>">






               <h1  style="font-weight:bold;">NUEVA EVALUACIN<h1/>



                 <input   id="mitokensave" type="hidden" name="" value="">



               <center><label><h1  style="font-weight:bold;">PROCESO </h1></label>


               <label>
                <?php $__currentLoopData = $proceso; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $proces): $__env->incrementLoopIndices(); $loop = $__env->getFirstLoop(); ?>

               <input   id="txtidproceso" type="hidden"  value="<?php echo e($proces->id); ?>"/>
               <h1 style="font-weight:bold;" id="procesoActual"><?php echo e($proces->descripcion); ?> </h1>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getFirstLoop(); ?>
                  </label></center>
                  <div class="col-sm-12">
                  <div class="col-sm-12">

                  <div  class="col-sm-1">

                    <label style="font-size:14px;"class="titleLabel ">TIPO DE EXAMEN:</label>

                  </div>
                    <div class="col-sm-2">

<select style="font-size:10px; height:40px; font-weight:bold; position:absolute;" class="error" id="selectTipo" name="">
  <option style="font-size:15px; font-weight:bold;" value="0">seleccione</option>
  <option style="font-size:15px; font-weight:bold;" value="1">REPETITIVAS+ALEATORIAS</option>
  <option style="font-size:15px; font-weight:bold;" value="2">INSERTAR ALEATORIAS</option>
  <option style="font-size:15px; font-weight:bold;" value="3">SOLO REPETITIVAS</option>
  <option style="font-size:15px; font-weight:bold;" value="4">SOLO ALEATORIAS</option>
</select>
</div>

<div class="col-md-9" style="background: #5A738E;"><center><span class="alertaDeTipo"></span></center></div></div>

<input id="tipo"  type="hidden"  value="0" placeholder="tipo">
              <div class="col-md-3">



                <label class="titleLabel">rea:</label>


                             <select  required="required" id="slcArea" name="isoarea" class="form-control"

                                    <?php if($areas == ""): ?>
                                          disabled >
                                          <option value="0">(Selecciona)</option>
                                        </select>
                                    <?php else: ?>
                                    >
                                    <option value="0">(Selecciona)</option>

                                    <?php $__currentLoopData = $areas; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $area): $__env->incrementLoopIndices(); $loop = $__env->getFirstLoop(); ?>

                                  <option value="<?php echo e($area->idarea); ?>"

                                              <?php if($area->descripcion == Auth::user()->isoarea): ?>
                                                selected <?php endif; ?>>

                                            <?php echo e($area->descripcion); ?>

                                          </option>

                                          <?php endforeach; $__env->popLoop(); $loop = $__env->getFirstLoop(); ?>

                                        </select>
                                    <?php endif; ?>


                   <label class="titleLabel">Durac:</label>

              <div class="input-group">
                  <input name="remitosucursal"  id="txthora"  type="number" required class="form-control numero"  placeholder="Horas">
                  <span class="input-group-addon">H</span>
                  <input name="remitonumero" id="txtminuto" value="00"   type="number" required class="form-control numero" placeholder="Minutos">
                  <span class="input-group-addon">Min</span>

                </div>

                </div>
                  <div class="col-md-2" hidden="true" id="prepe">
              <label class="titleLabelsmall"># Preguntas repetitivias:</label>
              <input class="form-control numero"  type="number" placeholder="# prg. repetitivas"  id="txtnropreguntarep"/>

              <label class="titleLabelsmall"># Materias repetitivias:</label>
              <input class="form-control numero"  type="number"  placeholder="# prg. repetitivas"  id="txtnromateriarep"/>


                </div>

                      <div class="col-md-2" hidden="true" id="pp">
              <label class="titleLabelsmall"># Preguntas aleatorias:</label>
              <input class="form-control numero"  type="number" placeholder="# prg. aleatorias"  id="txtnropregunta"/>

              <label class="titleLabelsmall"># Materias aleatorias:</label>
              <input class="form-control numero"  type="number"  placeholder="# prg. aleatorias"  id="txtnromateria"/>


                </div>








                <div class="col-md-2">

                  <label class="titleLabel">Nota Maxima:</label>
              <input class="form-control numero"  type="number"  placeholder="nota max" id="txtnotamaxima"/>

              <label class="titleLabel">Nota Minima:</label>
              <input class="form-control numero"  type="number" placeholder="nota min"  id="txtnotaminima"/>

                </div>


                <div class="col-md-3">

                <label class="titleLabel">Fecha de evaluacin:</label>
              <input type="date"  class="form-control numero" id="fechaEvaluacion"/>

              <label class="titleLabel">Observacion:</label>
               <textarea class="form-control" placeholder="observaciones"  id="txtobservacion" rows="1"></textarea>

                </div>

                <div class="col-md-12">
                <div class="col-md-3">
                </div>

<div class="col-md-3">
  <center> <button type="button"  id="continuar" style="border-radius:60px; font-weight:bold; font-size:20px; padding:15px;" class="btn-success" >CONTINUAR</button></center>

</div>
<div class="col-md-3">
  <center> <button type="button"  style="border-radius:60px; font-weight:bold; font-size:20px; padding:15px;" class="btn-danger cancelar" >CANCELAR</button></center>

</div>
<div class="col-md-3">
</div>
</div>

                 <br><br> <br><br> <br><br>






                    </div>


                  </div>
                </div>
              </div>


            </div>
          </div>

      <?php endif; ?>
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

token=token();
//$('#txtnropregunta').val(token());


 $('#mitokensave').val(token);


     $('#txtnropregunta').prop('readonly', true);
     $('#txtnromateria').prop('readonly', true);
     $('#txtnropreguntarep').prop('readonly', true);
     $('#txtnromateriarep').prop('readonly', true);

     sinr=$('#sinrepetitiva').is(':checked');
     sinal=$('#sinaleatorias').is(':checked');

estado=$('#estado').val();
if(estado=='1'){
  generarFilasone();
    llenarComboMateriaone();
    llenarComboDificultadone();




        $(".numeropasone").keyup(function () {
          nromaterias=$('#nromaterias').val();

          cantidad=0;
    cantidadPre=0;
                     for(var i=1;i<=nromaterias;i++){

                       if($('#cantPregunta'+i).val()==""||$('#cantPregunta'+i).val()=="0"){
                         $('#cantPregunta'+i).removeClass('error');
                         $('#cantPregunta'+i).removeClass('like');
                         $('#cantPregunta'+i).addClass('error');
                       }else{
                         inicio=1;
                         cantidadPre ++;
                         $('#cantPregunta'+i).removeClass('error');
                         $('#cantPregunta'+i).removeClass('like');
                         $('#cantPregunta'+i).addClass('like');
                       }

                        cantidad += Number($('#cantPregunta'+i).val());

         }
         $('#sumaTotal').text(cantidad);
         prepe=$('#nropreguntasrep').val();

        if (cantidad==prepe) {
          $('#sumaTotal').removeClass('green');

          $('#sumaTotal').removeClass('red');
             $('#sumaTotal').addClass('green');

        }else{
          $('#sumaTotal').removeClass('green');

                $('#sumaTotal').removeClass('red');
                   $('#sumaTotal').addClass('red');

    }


         });




    ////////////////sdsd7777777


         $(".comboDifi").change(function () {
           nromaterias=$('#nromaterias').val();

           cantidad=0;
     cantidadPre=0;
                      for(var i=1;i<=nromaterias;i++){

                        if($('#dificultad'+i).val()==""||$('#dificultad'+i).val()=="0"){
                          $('#dificultad'+i).removeClass('error');
                          $('#dificultad'+i).removeClass('like');
                          $('#dificultad'+i).addClass('error');
                        }else{
                          inicio=1;
                          cantidadPre ++;
                          $('#dificultad'+i).removeClass('error');
                          $('#dificultad'+i).removeClass('like');
                          $('#dificultad'+i).addClass('like');
                        }

                         cantidad += Number($('#dificultad'+i).val());

          }

          $('#sumaTotalDificultad').val(cantidadPre);

          });



               $(".comboMateria").change(function () {
                 nromaterias=$('#nromaterias').val();

                 cantidad=0;
           cantidadPre=0;
                            for(var i=1;i<=nromaterias;i++){

                              if($('#materia'+i).val()==""||$('#materia'+i).val()=="0"){
                                $('#materia'+i).removeClass('error');
                                $('#materia'+i).removeClass('like');
                                $('#materia'+i).addClass('error');
                              }else{
                                inicio=1;
                                cantidadPre ++;
                                $('#materia'+i).removeClass('error');
                                $('#materia'+i).removeClass('like');
                                $('#materia'+i).addClass('like');
                              }

                               cantidad += Number($('#materia'+i).val());

                }
                nrmaterep=$('#nromaterias').val();
           $('#sumaTotalMaterias').text(cantidadPre);


           if (cantidadPre==nrmaterep) {
             $('#sumaTotalMaterias').removeClass('red');
                $('#sumaTotalMaterias').addClass('green');

           }else{
             $('#sumaTotalMaterias').removeClass('green');

                   $('#sumaTotalMaterias').removeClass('red');
                      $('#sumaTotalMaterias').addClass('red');

           }
                });




}
if(estado=='2'){
    generarFilas();
      llenarComboMateria();
      llenarComboDificultad();



          $(".numeropasone").keyup(function () {
            nromaterias=$('#nromaterias').val();

            cantidad=0;
      cantidadPre=0;
                       for(var i=1;i<=nromaterias;i++){

                         if($('#cantPregunta'+i).val()==""||$('#cantPregunta'+i).val()=="0"){
                           $('#cantPregunta'+i).removeClass('error');
                           $('#cantPregunta'+i).removeClass('like');
                           $('#cantPregunta'+i).addClass('error');
                         }else{
                           inicio=1;
                           cantidadPre ++;
                           $('#cantPregunta'+i).removeClass('error');
                           $('#cantPregunta'+i).removeClass('like');
                           $('#cantPregunta'+i).addClass('like');
                         }

                          cantidad += Number($('#cantPregunta'+i).val());

           }
           $('#sumaTotal2').text(cantidad);
           prepe=$('#nropreguntas').val();

          if (cantidad==prepe) {
           $('#sumaTotal2').removeClass('green');

           $('#sumaTotal2').removeClass('red');
               $('#sumaTotal2').addClass('green');

          }else{
            $('#sumaTotal2').removeClass('green');

                  $('#sumaTotal2').removeClass('red');
                     $('#sumaTotal2').addClass('red');

      }


           });




      ////////////////sdsd7777777


           $(".comboDifi").change(function () {
             nromaterias=$('#nromaterias').val();

             cantidad=0;
       cantidadPre=0;
                        for(var i=1;i<=nromaterias;i++){

                          if($('#dificultad'+i).val()==""||$('#dificultad'+i).val()=="0"){
                            $('#dificultad'+i).removeClass('error');
                            $('#dificultad'+i).removeClass('like');
                            $('#dificultad'+i).addClass('error');
                          }else{
                            inicio=1;
                            cantidadPre ++;
                            $('#dificultad'+i).removeClass('error');
                            $('#dificultad'+i).removeClass('like');
                            $('#dificultad'+i).addClass('like');
                          }

                           cantidad += Number($('#dificultad'+i).val());

            }

            $('#sumaTotalDificultad2').val(cantidadPre);

            });



                 $(".comboMateria").change(function () {
                   nromaterias=$('#nromaterias').val();

                   cantidad=0;
             cantidadPre=0;
                              for(var i=1;i<=nromaterias;i++){

                                if($('#materia'+i).val()==""||$('#materia'+i).val()=="0"){
                                  $('#materia'+i).removeClass('error');
                                  $('#materia'+i).removeClass('like');
                                  $('#materia'+i).addClass('error');
                                }else{
                                  inicio=1;
                                  cantidadPre ++;
                                  $('#materia'+i).removeClass('error');
                                  $('#materia'+i).removeClass('like');
                                  $('#materia'+i).addClass('like');
                                }

                                 cantidad += Number($('#materia'+i).val());

                  }
                  nrmaterep=$('#nromaterias').val();
             $('#sumaTotalMaterias2').text(cantidadPre);


             if (cantidadPre==nrmaterep) {
               $('#sumaTotalMaterias2').removeClass('red');
                  $('#sumaTotalMaterias2').addClass('green');

             }else{
               $('#sumaTotalMaterias2').removeClass('green');

                     $('#sumaTotalMaterias2').removeClass('red');
                        $('#sumaTotalMaterias2').addClass('red');

             }
                  });





}




  });

  function random() {
 return Math.random().toString(36).substr(2); // Eliminar `0.`
};

function token() {
 return random() + random()+ random()+ random()+ random()+ random(); // Para hacer el token más largo
};


   function generarFilasone(){
   var iCnt = 0;
   nromaterias=$('#nromaterias').val();


              for(var i=0;i<nromaterias;i++){
              iCnt = iCnt + 1;

              var nuevaFila="<tr>";
              nuevaFila+="<td><select  id='materia"+iCnt+"' class='form-control comboMateria'><option value='0'>Seleccione</option></select></td><td><select   id='dificultad"+iCnt+"' class='form-control comboDifi'><option value='0'>Seleccione</option></select></td><td><input  value='0' id='cantPregunta"+iCnt+"' type='number' class='form-control numeropasone' /></td>";
                  // a単adimos las columnas
                      nuevaFila+="<td>";
              nuevaFila+="</tr>";
              $("#tablaone").append(nuevaFila);

          }}

          function llenarComboMateriaone(){

            urlbase = $("body").attr('urlbase');
url=urlbase+"/comboMateria";
console.log(url);
      $.ajax({
          url: url,
          //type: 'text',
          type: 'POST',
          dataType: 'json',

          success: function(response) {
              $.each(response, function (index, object)   {
                  var nrow=document.getElementById("tablaone").rows.length;
                   for (var i = 0; i < nrow; i++) {
                   $("select[id='materia"+i+"']").append("<option value='"+object['id']+"'>"+object['nombre']+"</option>");
                  }})}})
                }

          function llenarComboDificultadone(){
            urlbase = $("body").attr('urlbase');
url=urlbase+"/comboDificultad";
      $.ajax({
          url: url,
          type: 'POST',
          dataType: 'json',

            success: function(response) {
                $.each(response, function (index, object)   {
                  var nrow=document.getElementById("tablaone").rows.length;
                   for (var i = 0; i < nrow; i++) {
                   $("select[id='dificultad"+i+"']").append("<option value='"+object['id']+"'>"+object['nombre']+"</option>");
                  }})}})
                }



          $('#grabarone').click(function() {

            nrprerep=$('#nropreguntasrep').val();
            nrmaterep=$('#nromaterias').val();
            cantidadPre=$('#sumaTotal').text();
            cantidadMaterias=$('#sumaTotalMaterias').text();
            sumaTotalDificultad=$('#sumaTotalDificultad').val();

            if (cantidadPre==nrprerep&&cantidadMaterias==nrmaterep&&sumaTotalDificultad==nrmaterep) {
              $('#verificar').removeClass('error');
              $('#verificar').removeClass('like');
              $('#verificar').addClass('like');
  ReadyFunctions();
            }else{

              $('#verificar').removeClass('error');
              $('#verificar').removeClass('like');
              $('#verificar').addClass('error');

            }











   });


   function ReadyFunctions(){

       var nrow=document.getElementById("tablaone").rows.length;
                              for (var i = 1; i < nrow; i++) {
                                   var cantidad = $('#cantPregunta'+i).val();
                                   var materia  = $('#materia'+i).val();
                                   var dificultad  = $('#dificultad'+i).val();
       mezclar(materia,dificultad,cantidad,i);

                           }
   }

                  function mezclar(materia,dificultad,cantidad,i) {
                var _token =  $('#_token').val();
                        var nro=document.getElementById("tablaone").rows.length;
                         this.materia= materia;
                         this.dificultad= dificultad;

                         urlbase = $("body").attr('urlbase');
                         url=urlbase+"/obtenerPregunta";
                             $.ajax({
          url: url,
          type: 'POST',
          dataType: 'json',
           data: {
              p_materia: materia,
              p_dificultad: dificultad,
              p_token: _token
          },
          success: function(response) {
                   var cursos = response;

                         var nrow=document.getElementById("tablaone").rows.length;
                     this.cantidad = cantidad;


                     if(!cantidad){

                       console.log('no hya');
                     }else{
                       seleccionar(cantidad, cursos);

                     }





                  },complete: function(){
                    var estadoNext =  $('#estadoNext').val();


                                         if(!cantidad){
                                           console.log('no hya no actualiza el estado');
                                         }else{
                                           actualizarEstado(estadoNext);


                                         }

                  }
                  })
                   };

                       function actualizarEstado(estado) {
                                   var _token =  $('#_token').val();
                                   var  tokenEvaluacion=$('#tokenEvaluacion').val();
                                   this.estado = estado;

                                   urlbase = $("body").attr('urlbase');
                                   url=urlbase+"/actualizarEstado";
                             $.ajax({
                             url: url,
                             type: 'POST',
                             dataType: 'json',
                              data: {
                                p_tokenEvaluacion: tokenEvaluacion,
                                p_estado: estado,
                                     p_token: _token

                             },

                             complete: function() {

                    console.log('actualizo el estado');

                      }
                                     })
                             };
          function seleccionar(cantidad, cursos) {
              this.cantidad = cantidad;
              this.cursos = cursos;

              var tamano = cursos.length;
              var lote = new Array();

              var indice = 0;
              do {
                  var aleatorio = cursos[parseInt(Math.random() * tamano)];
                  if (lote.indexOf(aleatorio) != -1) {
                      continue;
                  } else {
                      lote[indice] = aleatorio;
                      indice++;
                  }
              } while (lote.length < cantidad);
                 for (var i = 0; i < lote.length; i++) {
              idpregunta=lote[i]["id"];
              grabarDetalle(idpregunta,cantidad);
               }
          };


    function grabarDetalle(idpregunta,cantidad) {
                var _token =  $('#_token').val();
                var  idevaluacion=$('#idevaluacion').val();
                  this.idpregunta=idpregunta;
                  urlbase = $("body").attr('urlbase');
                  url=urlbase+"/grabarDetallerep";
          $.ajax({
          url: url,
          type: 'POST',
          dataType: 'json',
           data: {
                  p_idevaluacion: idevaluacion,
      p_idpregunta: idpregunta,
                  p_token: _token

          },

          complete: function() {
            $('#grabarone').attr('disabled', true);

   orden=$('#orden').val();
   $('#orden').val(parseInt(orden)+1);

    nropre=$('#nropreguntasrep').val();
    loading="Grabando pregunta: "+orden+"/ "+nropre;
    $('#ordenLoading').text(loading);
    ordenfin=$('#orden').val();
    decimal=(parseInt(ordenfin)/nropre);
    widthI=decimal*100;
    widthIs=widthI+"%";
    $('#progressbar').css({
     width: widthIs
    });

  //  console.log(decimal);

if(ordenfin==nropre){
 location.reload(true);
}


   }
                  })
          };


           function generarFilas(){
           var iCnt = 0;
           nromaterias=$('#nromaterias').val();


                      for(var i=0;i<nromaterias;i++){
                      iCnt = iCnt + 1;

                      var nuevaFila="<tr>";
                          // añadimos las columnas
                          nuevaFila+="<td><select  id='materia"+iCnt+"' class='form-control comboMateria'><option value='0'>Seleccione</option></select></td><td><select  id='dificultad"+iCnt+"' class='form-control comboDifi'><option value='0'>Seleccione</option></select></td><td><input  id='cantPregunta"+iCnt+"' class='form-control numeropasone' /></td>";
                              nuevaFila+="<td>";
                      nuevaFila+="</tr>";
                      $("#tabla").append(nuevaFila);

                  }}

                  function llenarComboMateria(){

                      urlbase = $("body").attr('urlbase');
          url=urlbase+"/comboMateria";
              $.ajax({
                  url: url,
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

                      urlbase = $("body").attr('urlbase');
          url=urlbase+"/comboDificultad";
              $.ajax({
                  url: url,
                  type: 'POST',
                  dataType: 'json',

                    success: function(response) {
                        $.each(response, function (index, object)   {
                          var nrow=document.getElementById("tabla").rows.length;
                           for (var i = 0; i < nrow; i++) {
                           $("select[id='dificultad"+i+"']").append("<option value='"+object['id']+"'>"+object['nombre']+"</option>");
                          }})}})
                        }




                  $('#grabar').click(function() {




                                nrprerep=$('#nropreguntas').val();
                                nrmaterep=$('#nromaterias').val();
                                cantidadPre=$('#sumaTotal2').text();
                                cantidadMaterias=$('#sumaTotalMaterias2').text();
                                sumaTotalDificultad=$('#sumaTotalDificultad2').val();

                                if (cantidadPre==nrprerep&&cantidadMaterias==nrmaterep&&sumaTotalDificultad==nrmaterep) {
                                  $('#verificar2').removeClass('error');
                                  $('#verificar2').addClass('like');
                                  console.log('liek');
                                  ReadyFunctionsTwo();
                                }else{

                                  $('#verificar2').removeClass('error');
                                  $('#verificar2').removeClass('like');
                                  $('#verificar2').addClass('error');
                                  console.log('error');

                                }










           });

function ReadyFunctionsTwo(){
  var nrow=document.getElementById("tabla").rows.length;
                         for (var i = 1; i < nrow; i++) {
                              var cantidad = $('#cantPregunta'+i).val();
                              var materia  = $('#materia'+i).val();
                              var dificultad  = $('#dificultad'+i).val();
                              mezclartwo(materia,dificultad,cantidad);
                      }

}

                          function mezclartwo(materia,dificultad,cantidad) {
                        var _token =  $('#_token').val();
                                var nro=document.getElementById("tabla").rows.length;
                                 this.materia= materia;
                                 this.dificultad= dificultad;
                                 urlbase = $("body").attr('urlbase');
                               url=urlbase+"/obtenerPregunta";
                                     $.ajax({
                  url: url,
                  type: 'POST',
                  dataType: 'json',
                   data: {
                      p_materia: materia,
                      p_dificultad: dificultad,
                      p_token: _token
                  },
                  success: function(response) {

                           var cursos = response;

                                 var nrow=document.getElementById("tabla").rows.length;
                             this.cantidad = cantidad;
                              seleccionartwo(cantidad, cursos);
                          },complete: function(){
                 