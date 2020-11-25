@extends('layouts.master')

  @section('title', '')

  @section('content')
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
      @foreach($evaluacion as $evaluacionEstado)
<?php $estado= $evaluacionEstado->estado;?>
      @endforeach
<input   id="estado" type="hidden"  value="<?php  echo $estado; ?>">


<input   id="orden" type="hidden"  value="0" class="form-control" />
<div class="progress progress-sm active">
                <div class="progress-bar progress-bar-success progress-bar-striped"  id="progressbar" aria-valuenow="20" aria-valuemin="0" aria-valuemax="100" style="width: 0%">
                  <span  id="ordenLoading"  class="">0% complete</span>
                </div>
              </div>
      @if($estado=='1')
      <input  id="estadoNext" type="hidden"  value="2"/>

      <div class="row">

        <div class="col-md-12 col-sm-12 col-xs-12">
          <div id="verificar" class="x_panel">

            <div id="principal"  class="x_content">
              <div class="row">

                                  <input  name="_token"   id="_token" type="hidden" value="<?= csrf_token(); ?>">

           <h1  style="font-weight:bold;">PREGUNTAS REPETITIVAS<h1/>
             @foreach($evaluacion as $evaluacion)
<input hidden id="sumaTotalDificultad"/>
           <h3>(se repetiran en todas las evaluaciones)<h3/> <h4> preguntas:<label class="red" id="sumaTotal">0 </label><label >/</label><label >{{$evaluacion->nropreguntasrep}} </label> - Materias: <label class="red" id="sumaTotalMaterias">0 </label><label> </label>/ {{$evaluacion->nromateriasrep}}</h4>
             <div class="col-sm-12">



                      <div class="table-responsive">
                        <input  id="nromaterias"   type="hidden"   value="{{$evaluacion->nromateriasrep}}" />
                        <input id="nropreguntasrep"  type="hidden"  value="{{$evaluacion->nropreguntasrep}}"  />
                        <input  id="tokenEvaluacion"   type="hidden"  value="{{$evaluacion->token}}">

                        <input  id="idevaluacion"   type="hidden"   value="{{$evaluacion->id}}" class="form-control" />
                      	  @endforeach
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

      @elseif($estado=='2')

      <div  class="row" >


        <div class="col-md-12 col-sm-12 col-xs-12">

          <div style="" id="verificar2" class="x_panel  ">

            <div id="principal"  class="x_content  ">

      <input  id="estadoNext" type="hidden" value="3"/>

      <div class="row" >



                          <input    name="_token" id="_token" type="hidden" value="<?= csrf_token(); ?>">
                          @foreach($evaluacion as $evaluacion)

      <h1  style="font-weight:bold;">PREGUNTAS ALEATORIAS<h1/>
        <input hidden id="sumaTotalDificultad2"/>

        <h3>(se repetiran en todas las evaluaciones)<h3/> <h4> preguntas:<label class="red" id="sumaTotal2">0 </label><label >/</label><label >{{$evaluacion->nropreguntas}} </label> - Materias: <label class="red" id="sumaTotalMaterias2">0 </label><label> </label>/ {{$evaluacion->nromaterias}}</h4>


      <div class="col-sm-12">


              <div class="table-responsive">
                <input  id="nromaterias"  type="hidden"  value="{{$evaluacion->nromaterias}}" class="form-control" />
                <input id="nropreguntas"   type="hidden"   value="{{$evaluacion->nropreguntas}}" class="form-control" />
                <input  id="tokenEvaluacion"   type="hidden"   value="{{$evaluacion->token}}">

                <input  id="idevaluacion"  type="hidden"     value="{{$evaluacion->id}}" class="form-control" />
                <input  id="ideval"    type="hidden"   value="{{$evaluacion->id}}" class="form-control" />
                  @endforeach
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


            @else


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
                @foreach($proceso as $proces )

               <input   id="txtidproceso" type="hidden"  value="{{$proces->id}}"/>
               <h1 style="font-weight:bold;" id="procesoActual">{{$proces->descripcion}} </h1>
                    @endforeach
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

                                    @if($areas == "")
                                          disabled >
                                          <option value="0">(Selecciona)</option>
                                        </select>
                                    @else
                                    >
                                    <option value="0">(Selecciona)</option>

                                    @foreach($areas as $area)

                                  <option value="{{$area->idarea }}"

                                              @if($area->descripcion == Auth::user()->isoarea)
                                                selected @endif>

                                            {{$area->descripcion}}
                                          </option>

                                          @endforeach

                                        </select>
                                    @endif


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

      @endif
  @endsection

  @section('css')

  @endsection

  @section('js')
  <!-- PNotify -->
    <script src="{{ asset('js/pnotify.js') }}"></script>
    <script src="{{ asset('js/pnotify.buttons.js') }}"></script>
    <script src="{{ asset('js/pnotify.nonblock.js') }}"></script>

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
                            var estadoNext =  $('#estadoNext').val();


                            actualizarEstado(estadoNext);
                          }
                          })
                           };

                  function seleccionartwo(cantidad, cursos) {
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
                      console.log(lote[i]["id"]);
                      idpregunta=lote[i]["id"];
                      grabarDetalletwo(idpregunta);
                       }
                  };


            function grabarDetalletwo(idpregunta) {
                        var _token =  $('#_token').val();
                          var  idevaluacion=$('#idevaluacion').val();
                          this.idpregunta=idpregunta;
                          urlbase = $("body").attr('urlbase');
                          url=urlbase+"/grabarDetalle";
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
                    $('#grabar').attr('disabled', true);

           orden=$('#orden').val();
           $('#orden').val(parseInt(orden)+1);

            nropre=$('#nropreguntas').val();
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
          window.location.replace($urlbase+ '/generarexa/lista');

        }


           }

                          })
                  };
                  $('#continuar').click(function() {

                    var tipo =  $('#tipo').val();
                    if(tipo=='1'){ var estado =1; }
                     if(tipo=='2'){ var estado =2; }
                    if(tipo=='3'){ var estado =3; }
                    if(tipo=='4'){ var estado =2; }

                                var _token =  $('#_token').val();
                                var idproceso=  $('#txtidproceso').val();
                                var idarea=  $('#slcArea').val();
                                var nromateria=  $('#txtnromateria').val();
                                var nropregunta=  $('#txtnropregunta').val();
                                var nropreguntarep=  $('#txtnropreguntarep').val();
                                var nromateriarep=  $('#txtnromateriarep').val();
                                var hora=  $('#txthora').val();
                                var minuto=  $('#txtminuto').val();
                                var duracion= hora+"h"+minuto+"min"
                                var notamaxima=  $('#txtnotamaxima').val();
                                var notaminima=  $('#txtnotaminima').val();
                                var fechaevaluacion=  $('#fechaEvaluacion').val();
                                var observacion=  $('#txtobservacion').val();
                                var mitoken=  $('#mitokensave').val();

                                urlbase = $("body").attr('urlbase');
                                url=urlbase+"/grabarEvaluacion";
estadovalida=validar();
if(estadovalida){

 console.log(estadovalida);

}else{

console.log('grabo');
                $.ajax({
                url: url,
                type: 'POST',
                dataType: 'json',
                 data: {
                        p_idproceso: idproceso,
                p_idarea: idarea,
                p_nromateria: nromateria,
                p_nropregunta: nropregunta,
                p_nromateriarep: nromateriarep,
                p_nropreguntarep: nropreguntarep,
                p_duracion: duracion,
                p_notamaxima: notamaxima,
                p_notaminima: notaminima,
                p_fechaevaluacion: fechaevaluacion,
                p_observacion: observacion,
                p_estado: estado,
                p_tipo: tipo,
                p_mitoken: mitoken,
                        p_token: _token

                      },
                      complete: function() {
if (tipo=='3') {
  window.location.replace($urlbase+ '/generarexa/lista/');

}else{
  window.location.replace($urlbase+ '/generarexa/index/'+mitoken);
}
                      }
                        })


}


                     })



$('#selectTipo').change(function() {
  tiposelect=$('#selectTipo').val();
$('#tipo').val(tiposelect);
if(tiposelect==1){
  $('#txtnropregunta').prop('readonly', false);
  $('#txtnromateria').prop('readonly', false);
  $('#txtnropreguntarep').prop('readonly', false);
  $('#txtnromateriarep').prop('readonly', false);
  $('#txtnropregunta').val('');
  $('#txtnromateria').val('');
  $('#txtnropreguntarep').val('');
  $('#txtnromateriarep').val('');
  $('#prepe').prop('hidden', false);
  $('#pp').prop('hidden', false);

  $('.alertaDeTipo').text(' Este tipo de examen utilizara preguntas repetitivas y aleatorias.');
}
if(tiposelect==2){
  $('#txtnropregunta').prop('readonly', false);
  $('#txtnromateria').prop('readonly', false);
  $('#txtnropreguntarep').prop('readonly', true);
  $('#txtnromateriarep').prop('readonly', true);

  $('#pp').prop('hidden', false);
  $('#prepe').prop('hidden', true);


  $('#txtnropregunta').val('');
  $('#txtnromateria').val('');
  $('#txtnropreguntarep').val(0);
  $('#txtnromateriarep').val(0);

  $('.alertaDeTipo').text('  Este tipo de examen utilizara preguntas repetitivas ya insertadas y aleatorias que se insertaran.');
}
if(tiposelect==3){
  $('#txtnropregunta').prop('readonly', true);
  $('#txtnromateria').prop('readonly', true);
  $('#txtnropreguntarep').prop('readonly', true);
  $('#txtnromateriarep').prop('readonly', true);
  $('#txtnropregunta').val(0);
  $('#txtnromateria').val(0);
  $('#txtnropreguntarep').val(0);
  $('#txtnromateriarep').val(0);
  $('#pp').prop('hidden', true);

  $('#prepe').prop('hidden', true);

  $('.alertaDeTipo').text('  Este tipo de examen solo utilizara preguntas repetitivas ya insertadas .');
}

if(tiposelect==4){
  $('#txtnropregunta').prop('readonly', false);
  $('#txtnromateria').prop('readonly', false);
  $('#txtnropreguntarep').prop('readonly', true);
  $('#txtnromateriarep').prop('readonly', true);
  $('#txtnropregunta').val('');
  $('#txtnromateria').val('');
  $('#txtnropreguntarep').val(0);
  $('#txtnromateriarep').val(0);
  $('#pp').prop('hidden', false);
  $('#prepe').prop('hidden', true);

  $('.alertaDeTipo').text('  Este tipo de examen utilizara solo preguntas aleatorias .');
}

if(tiposelect==0){
  $('#txtnropregunta').prop('readonly', false);
  $('#txtnromateria').prop('readonly', false);
  $('#txtnropreguntarep').prop('readonly', true);
  $('#txtnromateriarep').prop('readonly', true);
  $('#txtnropregunta').val('');
  $('#txtnromateria').val('');
  $('#txtnropreguntarep').val(0);
  $('#txtnromateriarep').val(0);
  $('#prepe').prop('hidden', true);
  $('#pp').prop('hidden', true);

  $('.alertaDeTipo').text('  Este tipo de examen utilizara solo preguntas aleatorias .');
}
console.log(  $('#selectTipo').val());
})

$('.cancelar').click(function() {
  urlbase = $("body").attr('urlbase');

  window.location.replace($urlbase+ '/generarexa/lista/');

})



$('.numero').keyup(function() {
value=$('.numero').val();
if(value.length==0){
 $(this).removeClass('error');
 $(this).removeClass('like');

 $(this).addClass('error');

}else{
 $(this).removeClass('error');
 $(this).removeClass('like');
 $(this).addClass('like');
}

})

 $('#slcArea').click(function() {
value=$('#slcArea').val();
if(value==0){
  $(this).removeClass('like');

  $(this).addClass('error');

}else{
  $(this).removeClass('error');

  $(this).addClass('like');
}

 })


 $('#selectTipo').click(function() {
value=$('#selectTipo').val();
if(value==0){
  $(this).removeClass('like');

  $(this).addClass('error');

}else{
  $(this).removeClass('error');

  $(this).addClass('like');
}

 })

function validar(){


                                  var selectTipo=  $('#selectTipo').val();
                                  var idarea=  $('#slcArea').val();
                                  var nromateria=  $('#txtnromateria').val();
                                  var nropregunta=  $('#txtnropregunta').val();
                                  var nropreguntarep=  $('#txtnropreguntarep').val();
                                  var nromateriarep=  $('#txtnromateriarep').val();
                                  var hora=  $('#txthora').val();
                                  var minuto=  $('#txtminuto').val();
                                  var notamaxima=  $('#txtnotamaxima').val();
                                  var notaminima=  $('#txtnotaminima').val();
                                  var fechaevaluacion=  $('#fechaEvaluacion').val();
                                  var observacion=  $('#txtobservacion').val();
                                  var mitoken=  $('#mitokensave').val();
                                  var tipo=  $('#tipo').val();



                                  if(nromateria==""){ input="#txtnromateria"; state="error"; e1=1; pintar(input,state); }else{e1=0;}
                                  if(nropregunta==""){ input="#txtnropregunta"; state="error"; e2=1; pintar(input,state); }else{e2=0;}
                                  if(nropreguntarep==""){ input="#txtnropreguntarep"; state="error"; e3=1; pintar(input,state); }else{e3=0;}
                                  if(minuto==""){ input="#txtminuto"; state="error"; e4=1; pintar(input,state); }else{e4=0;}
                                  if(hora==""){ input="#txthora"; state="error"; e5=1; pintar(input,state); }else{e5=0;}
                                  if(nromateriarep==""){ input="#txtnromateriarep"; state="error"; e6=1; pintar(input,state); }else{e6=0;}
                                  if(notamaxima==""){ input="#txtnotamaxima"; state="error"; e7=1; pintar(input,state); }else{e7=0;}
                                  if(notaminima==""){ input="#txtnotaminima"; state="error"; e8=1; pintar(input,state); }else{e8=0;}
                                  if(idarea=="0"){ input="#slcArea"; state="error"; e9=1; pintar(input,state); }else{e9=0;}
                                  if(fechaevaluacion==""){ input="#fechaEvaluacion"; state="error"; e10=1; pintar(input,state); }else{e10=0;}
                                  if(observacion==""){ input="#txtobservacion";  e11=1;  }else{e11=0;}
                                  if(selectTipo=="0"){ input="#selectTipo"; state="error"; e12=1; pintar(input,state); }else{e12=0;}



                                  estado=e1+e2+e3+e4+e5+e6+e7+e8+e9+e10+e12;
if(estado!==0){
  console.log('no pasa');
}else{
  console.log(' pasa');

}
return estado;
}

function pintar(input,state){
  this.input=input;
  $(input).removeClass('like');
  $(input).removeClass('error');
 $(input).addClass(state);
}

function validarPreguntas(){
  var nrow=document.getElementById("tablaone").rows.length;
                         for (var i = 1; i < nrow; i++) {
                              var cantidad = $('#cantPregunta'+i).val();
                              if(cantidad==""){
                                input="#cantPregunta"+i; state="error"; pintar(input,state); e=1;
console.log(cacntidad);

                              }else{
                                console.log(cacntidad);

e=0;                                 input="#cantPregunta"+i; state="like"; pintar(input,state); e=1;

                              }



                      }
                      estate=e;
                      return estate;
}


   </script>
  @endsection
