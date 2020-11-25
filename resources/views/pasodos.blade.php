  @extends('layouts.master')

@section('title', '')

@section('content')
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
    
                              @foreach($evaluacion as $evaluacion)
 
                    <div class="table-responsive">
                    <input type="hidden" id="nromaterias" value="{{$evaluacion->nromaterias}}" class="form-control" />
           
                    <input type="hidden" id="idevaluacion" value="{{$evaluacion->id_proceso}}" class="form-control" />
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
            
  
         <a id="grabar" type="button"    id="grabar" class="btn btn-success" >FINALIZAR</a>


                  </div>
                  
                  




            </div>
            
            
          </div>
        </div>
      </div>
    </div>
  </div>
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
        type: 'POST',
        dataType: 'json',
        
          success: function(response) {            
              $.each(response, function (index, object)   {                             
                var nrow=document.getElementById("tabla").rows.length;
                 for (var i = 0; i < nrow; i++) {              
                 $("select[id='dificultad"+i+"']").append("<option value='"+object['id']+"'>"+object['nombre']+"</option>");
                }})}})
              }
    </script>
 <script>


     
              
        $('#grabar').click(function() {

var nrow=document.getElementById("tabla").rows.length;
                       for (var i = 1; i < nrow; i++) { 
                            var cantidad = $('#cantPregunta'+i).val();
                            var materia  = $('#materia'+i).val();
                            var dificultad  = $('#dificultad'+i).val();
                            mezclar(materia,dificultad,cantidad);
                    }
 });

                function mezclar(materia,dificultad,cantidad) {
              var _token =  $('#_token').val();
                      var nro=document.getElementById("tabla").rows.length;
                       this.materia= materia;
                       this.dificultad= dificultad;
                     
                           $.ajax({
        url: "obtenerPregunta",
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
                    seleccionar(cantidad, cursos);                       
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
            console.log(lote[i]["id"]);
            idpregunta=lote[i]["id"];
            grabarDetalle(idpregunta);
             }                                                 
        };

  
  function grabarDetalle(idpregunta) {
  console.log(idpregunta);
              var _token =  $('#_token').val();
                var  idevaluacion=$('#idevaluacion').val();     
                this.idpregunta=idpregunta;

        $.ajax({
        url: "grabarDetalle",
        type: 'POST',
        dataType: 'json',
         data: {
                p_idevaluacion: idevaluacion,
    p_idpregunta: idpregunta,
                p_token: _token

        }             
                })                
        };
        
        
        
 </script>
@endsection
