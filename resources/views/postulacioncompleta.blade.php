@extends('layouts.master')

@section('title', '')

@section('content')
  @parent
  @if($tarifa==17)
  <div class="">
   
 
    <div class="clearfix"></div>

    <div class="row">
      <div class="col-md-12 col-sm-12 col-xs-12">
        <div class="jumbotron">
          <div class="row">
            <div style="margin-bottom: 10px; margin-left: -15px" class="col-md-12">
              <h1 style="margin-top:-20px;font-size: 35px;"">
                <strong>!Felicitaciones ingresante por CEPRE-UNAB!</strong> 
              </h1>
              <p style="font-size: 16px;margin-bottom: 15px;font-weight: bold;"><span>Has realizado tu ficha de inscripción.</span></p>
              <p style="font-size: 16px;margin-bottom: 15px;">Ahora realiza los siguientes procedimientos:</p>
              
            </div>            
            <div class="col-xs-12 col-md-12" style="padding: 0px 0px 0px 10px;" >
              <p style="margin:0px 0px 10px -15px; font-size: 16px; font-weight: bold"><span >2: </span>Imprime y dirígete a la Oficina de Admisión: </p>
              <p style="font-size: 15px; ">Imprime el/los siguientes formatos, revísalos y coloca tu firma y huella digital en los lugares que lo indique.</p>

              <ul id="lista-link">
             
                
              <li>
                  <a id="link" href="{{url('/pdf/ficha_inscripcion')}}" target="_blank">
                    <span class="fa fa-file-pdf-o"></span> 1. Ficha de Inscripción
                  </a>
              </li>
              </ul>
              <br>
              <p style="font-size: 15px; ">Ahora dirígete a la oficina de <strong>ADMISIÓN</strong> de la Universidad Nacional de Barranca,  ubicada en el Jr. Gálvez N° 557 - Barranca, llevando los formatos impresos por duplicado, el boucher de pago (original y dos copias) para <strong> VALIDAR </strong>tu<strong> FICHA DE INSCRIPCION.</strong></p>
              <br>       
            </div>           
          </div>
          
        </div>
      </div>
    </div>
  </div>
  @else
  <div class="">
   
 
    <div class="clearfix"></div>

    <div class="row">
      <div class="col-md-12 col-sm-12 col-xs-12">
        <div class="jumbotron">
          <div class="row">
            <div style="margin-bottom: 10px; margin-left: -15px" class="col-md-12">
              <h1 style="margin-top:-20px;font-size: 35px;"">
                <strong>!Felicitaciones!</strong> 
                <span style="font-size: 18px" >Has realizado tu postulación.</span>
              </h1>
              <p style="font-size: 16px;margin-bottom: 15px;">Para terminar con el procedimiento solo da click al botón "Finalizar postulación".</p>
              <br>
            </div>
            
            <!-- <div class="col-xs-12 col-md-12" style="padding: 0px 0px 0px 10px;" >
              <p style="margin:0px 0px 10px -15px; font-size: 16px; font-weight: bold"><span >2: </span>Imprime y dirígete a la Oficina de Admisión: </p>
              <p style="font-size: 15px; ">Imprime el/los siguientes formatos, revísalos y coloca tu firma y huella digital en los lugares que lo indique.</p>

              <ul id="lista-link">
             
                
              <li>
                  <a id="link" href="{{url('/pdf/ficha_inscripcion')}}" target="_blank">
                    <span class="fa fa-file-pdf-o"></span> 1. Ficha de Inscripción
                  </a>
                </li>
                @if($postulante->edad >= 18)
                <li>
                  <a id="link2"  href="{{url('/pdf/jdantecedentes_inscripcion')}}" target="_blank">
                    <span class="fa fa-file-pdf-o"></span> 2. Declaración Jurada de Antecedentes Penales
                  </a>
                </li>
                @endif 
              </ul>
              <br>
              <p style="font-size: 15px; ">Ahora dirígete a la oficina de <strong>ADMISIÓN</strong> de la Universidad Nacional de Barranca,  ubicada en el Jr. Gálvez N° 557 - Barranca, llevando los formatos impresos por duplicado, el boucher de pago (original y dos copias) para <strong> VALIDAR </strong>su postulación.</p>
              <p style="margin:0px 0px 10px -15px; font-size: 16px; font-weight: bold"><span >3: </span>Descarga e imprime el Carné de Postulante. </p><p style="font-size: 15px; ">Validada tu inscripción en la Oficina de Admisión podrás descargar e imprimir el Carné de Postulante, el cual presentarás el día del examen.</p>
              <br> -->
          
    <center>
              <a id="idfinalizar2" style="font-size: 16px; 
                              margin-left: 0px; 
                              border: 2.5px solid #999; 
                              background-color: #004c99;
                              color: #fff; 
                              padding: 10px;
                              border-radius: 15px;
                              cursor: pointer;" href="{{ url('/finalizar') }}">Finalizar Postulación</a>
              </center> 
     
        
            </div>           
          </div>
          
        </div>
      </div>
    </div>
  </div>
  @endif
@endsection


@section('css')
<style type="text/css">
.inputModificado {
    margin: 10px 0px 10px 50px;
    clear: both;
}

.inputImagen {
left: 50px;
position:absolute;
    background: none;
    opacity: 0.5;
    box-shadow: 0px 0px 5px black, inset 0 0px 5px 2px black;
    padding: 5px;
    border-radius: 4px;
    color: black;
    font-weight: bold;
    margin-top:  -2px;
}

.botonInputFileModificado {
      width: 100px;
    height: 100px;
    border-radius: 50%;
    background-color: white;
    display: block;
    padding: 20px;
    margin: 0 auto 10px;

     border: 5px solid #2a3f54; 
  
}

.botonInputFileModificado:hover {   
    border: 2px solid #fff;  
    background-color: rgba(42,63,84,0.4);
    color: #fff;
}

.botonInputFileModificado .inputImagenOculto {
    opacity: 0;
    position: absolute;
    margin-left: -125px;
    width: 225px;
}

.botonInputFileModificado .boton {
    text-align: center;
}


.dis {   
   pointer-events: none;
       background-color: red;
}

.diso {   

       background-color: #2a3f54;
}
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
@endsection

@section('js')
<script type="text/javascript">



function fileValidation(){
    var fileInput = document.getElementById('archivo1');
    var filePath = fileInput.value;
    var allowedExtensions = /(.pdf)$/i;
    
    
    if(filePath=="Enviar Ficha de Inscripción"){
    $("#archivo1").val("Enviar Ficha de Inscripción");
       $("#alert").show(0).delay(15000).hide(0);
       $("#message").text("El archivo esta vacio");  
      	
    }else{
    	if(!allowedExtensions.exec(filePath)){
       $("#archivo1").val("Enviar Ficha de Inscripción");
       $("#alert").show(0).delay(15000).hide(0);
       $("#message").text("Error...Debe ser un archivo PDF");  

        return false;
        }
    }
    
       
}

function fileValidation1(){
    var fileInput = document.getElementById('archivo2');
    var filePath = fileInput.value;
    var allowedExtensions = /(.pdf)$/i;
    if(filePath=="Enviar Antecedentes Penales"){
        $("#archivo2").val("Enviar Antecedentes Penales");
       $("#alert1").show(0).delay(15000).hide(0);
       $("#message1").text("El archivo esta vacio");  
    }else{
        if(!allowedExtensions.exec(filePath)){
       $("#alert1").show(0).delay(15000).hide(0);
       $("#archivo2").val("Enviar Antecedentes Penales")
       $("#message1").text("Error...Debe ser un archivo PDF");  

        return false;
        }
    }  
    
    if(!allowedExtensions.exec(filePath)){
       $("#alert1").show(0).delay(15000).hide(0);
       $("#archivo2").val("Enviar Antecedentes Penales")
       $("#message1").text("Error...Debe ser un archivo PDF");  

        return false;
        } 
}

function fileValidation2(){
    var fileInput = document.getElementById('archivo3');
    var filePath = fileInput.value;
    var allowedExtensions = /(.pdf)$/i;
    
    if(filePath=="Enviar DNI"){
        $("#alert2").show(0).delay(15000).hide(0);
       $("#archivo3").val("Enviar DNI");
       $("#message2").text("El archivo esta vacio");
    }else{
        if(!allowedExtensions.exec(filePath)){
       $("#alert2").show(0).delay(15000).hide(0);
       $("#archivo3").val("Enviar DNI");
       $("#message2").text("Error...Debe ser un archivo PDF"); 

        return false;
        }
    }
    
}

function fileValidation3(){
    var fileInput = document.getElementById('archivo4');
    var filePath = fileInput.value;
    var allowedExtensions = /(.pdf)$/i;
    if(filePath=="Enviar Baucher de pago"){
        $("#alert3").show(0).delay(15000).hide(0);
       $("#archivo4").val("Enviar Baucher de pago");
       $("#message3").text("El archivo esta vacio"); 
    }else{
        if(!allowedExtensions.exec(filePath)){
        $("#alert3").show(0).delay(15000).hide(0);
       $("#archivo4").val("Enviar Baucher de pago");
       $("#message3").text("Error...Debe ser un archivo PDF"); 

        return false;
    }
    }
    
}
    
$(document).on("submit",".formarchivo",function(e){
    var fileInput = document.getElementById('edad');
    var filePath = fileInput.value;
    if(filePath>="18"){
        fileValidation();
        
                fileValidation1();
                        fileValidation2();
                                fileValidation3();

                    //            return false;
    }else{
        fileValidation();
                    fileValidation2();
                                fileValidation3(); 
//                                return false; 
    }
        
        
        e.preventDefault();
        var formu=$(this);
        var nombreform=$(this).attr("id");

                

        //if(nombreform=="f_subir_imagen" ){ var miurl="subir_imagen_usuario";  var divresul="notificacion_resul_fci"}
        if(nombreform=="form_enviar" ){ var miurl="enviar-documentos";  var divresul="notificacion_resul_fcdu"}

        //informaci贸n del formulario
        var formData = new FormData($("#"+nombreform+"")[0]);

      
        //hacemos la petici贸n ajax   
        $.ajax({
            url: "enviar-documentos",  
            type: 'POST',
     
            // Form data
            //datos del formulario
            data: formData,
            //necesario para subir archivos via ajax
            cache: false,
            contentType: false,
            processData: false,
            //mientras enviamos el archivo
            //
            beforeSend: function(){
              //$("#"+divresul+"").html($("#cargador_empresa").html());                
            },
            //una vez finalizado correctamente
            success: function(data) {        
            if(data.edad>="18"){
            $("#archivo1").val("Enviar Ficha de Inscripción");
            $("#archivo2").val("Enviar Antecedentes Penales");
            $("#archivo3").val("Enviar DNI");
            $("#archivo4").val("Enviar Baucher de pago");
                alert(data.mensaje);     
                
                        
            
            
            var element = document.getElementById("idfinalizar");
	    element.classList.remove("dis");
	    element.classList.add("diso");
	
        
            }else{
	    $("#archivo1").val("Enviar Ficha de Inscripción");
            $("#archivo3").val("Enviar DNI");
            $("#archivo4").val("Enviar Baucher de pago"); 
            alert(data.mensaje);
            }
                    
            },
            //si ha ocurrido un error
            
            error: function(data){
               //alert("error") ;
                
            }
        });
        //alert("Se cargo con exito") ;
    });
</script>

<script type="text/javascript">

/*
var element = document.getElementById("idfinalizar2");
	    element.classList.remove("dis");
	    element.classList.add("diso");
*/
</script>

<script>
</script>
@endsection