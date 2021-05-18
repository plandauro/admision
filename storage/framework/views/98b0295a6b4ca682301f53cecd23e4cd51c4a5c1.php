<?php $__env->startSection('title', ''); ?>

<?php $__env->startSection('content'); ?>
  @parent
  <div class="">
    <div class="page-title">
      <div class="title_left">
        <h3>Cargar Información con DLM │ Examen GENERAL CONTABILIDAD Y FINANZAS TURNO TARDE</h3>
      </div>

    </div>

    <div class="clearfix"></div>

    <div class="row"> 
      <div class="col-md-12">
        <div id="verificar" class="x_panel">
          
          <div id="principal"  class="x_content">
            <div class="row">
              <div class="col-md-6">
                <h2>Cargue los resultados de DLM:</h2>
                 
                <form  id="f_cargar_datos_usuarios" name="f_cargar_datos_usuarios" method="post"  class="formarchivo" enctype="multipart/form-data" >                
      
      
      <input type="hidden" name="_token" id="_token"  value="<?= csrf_token(); ?>"> 
       <div id="alert" style="display: none;" class="alert alert-info  alert-dismissible fade in" role="alert">
                    <p id="message"></p>
                  </div>
      <div class="box-body">    

      <div class="form-group col-md-12"  >
             <label>Agregar Archivo hojaidentificacion DLM </label>
              <input name="archivo" id="archivo" type="file"   class="archivo form-control"  required/>
              <div id="alert1" style="display: none;" class="alert alert-danger alert-dismissable">
        	<button type="button" class="close" data-dismiss="alert">&times;</button>
                            <p id="message1"></p>         
            </div>
            <div id="alert11" style="display: none;" class="alert alert-success alert-dismissable">
        	<button type="button" class="close" data-dismiss="alert">&times;</button>
                            <p id="message11"></p>         
            </div>
      </div>
      
     

           <div class="box-footer">
                          <button type="submit" class="btn btn-primary">Cargar Datos</button>
      </div>
      </div>
      </form>
      
      <form  id="f_cargar_datos_usuarios1" name="f_cargar_datos_usuarios1" method="post"  class="formarchivo1" enctype="multipart/form-data" >                
      
      
      <input type="hidden" name="_token" id="_token"  value="<?= csrf_token(); ?>"> 
       <div id="alert" style="display: none;" class="alert alert-info  alert-dismissible fade in" role="alert">
                    <p id="message"></p>
                  </div>
      <div class="box-body">    

      <div class="form-group col-md-12"  >
             <label>Agregar Archivo hojarespuesta DLM </label>
              <input name="archivo2"  id="archivo2" type="file"   class="archivo form-control"  required/>
              <div id="alert2" style="display: none;" class="alert alert-danger alert-dismissable">
                <button type="button" class="close" data-dismiss="alert">&times;</button>
                            <p id="message2"></p>         
            </div>
            <div id="alert21" style="display: none;" class="alert alert-success alert-dismissable">
                <button type="button" class="close" data-dismiss="alert">&times;</button>
                            <p id="message21"></p>         
            </div>
      </div>
      <div class="box-footer">
                          <button type="submit" class="btn btn-primary">Cargar Datos</button>
      </div>
      </div>
      </form>
      
      <form  id="f_cargar_datos_usuarios2" name="f_cargar_datos_usuarios2" method="post"  class="formarchivo2" enctype="multipart/form-data" >                
      
      
      <input type="hidden" name="_token" id="_token"  value="<?= csrf_token(); ?>"> 
       <div id="alert" style="display: none;" class="alert alert-info  alert-dismissible fade in" role="alert">
                    <p id="message"></p>
                  </div>
      <div class="box-body">    

       <div class="form-group col-md-12"  >
             <label>Agregar Archivo claves DLM</label>
              <input name="archivo3"  id="archivo3" type="file"   class="archivo form-control"  required/>
              <div id="alert3" style="display: none;" class="alert alert-danger alert-dismissable">
                <button type="button" class="close" data-dismiss="alert">&times;</button>
                            <p id="message3"></p>         
            </div>
            <div id="alert31" style="display: none;" class="alert alert-success alert-dismissable">
                <button type="button" class="close" data-dismiss="alert">&times;</button>
                            <p id="message31"></p>         
            </div>
      </div>
      <div class="box-footer">
                          <button type="submit" class="btn btn-primary">Cargar Datos</button>
      </div>
      </div>
      </form>
      
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
  
  function fileValidation(){
    var fileInput = document.getElementById('archivo');
    
    var filePath = fileInput.value;
    console.log(filePath);
    var allowedExtensions = /(.dlm)$/i;

        if(!allowedExtensions.exec(filePath)){
       $("#archivo").val("");

       $("#alert1").show(0).delay(15000).hide(0);
       $("#message1").text("Error...Debe ser un archivo DLM");  
       

        return false;
    }
  }
    

    $(document).on("submit",".formarchivo",function(e){
  	fileValidation();

     
        e.preventDefault();
        var formu=$(this);
        var nombreform=$(this).attr("id");


        //if(nombreform=="f_subir_imagen" ){ var miurl="subir_imagen_usuario";  var divresul="notificacion_resul_fci"}
        if(nombreform=="f_cargar_datos_usuarios" ){ var miurl="cargar-txt-2020-2-CFT";  var divresul="notificacion_resul_fcdu"}

        //información del formulario
        var formData = new FormData($("#"+nombreform+"")[0]);
      
        //hacemos la petición ajax   
//        alert('ENTRO');
        $.ajax({
            url: miurl,  
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
            $("#alert1.1").show(0).delay(15000).hide(0);

	        if(data.correcto=="SI"){
		$("#archivo").val("");
	        $("#alert11").show(0).delay(15000).hide(0);
	        $("#message11").text("Se cargo correctamente"); 
	        


	        }

        	},
            //si ha ocurrido un error
            error: function(data){
               //alert(data);
                
            }
        });
        //alert("Se cargo con exito") ;
    }); 
  </script>
  
  <script>
  
  function fileValidation2(){
    var fileInput = document.getElementById('archivo2');
    var filePath = fileInput.value;
    var allowedExtensions = /(.dlm)$/i;
    
        if(!allowedExtensions.exec(filePath)){
       $("#archivo2").val("");

       $("#alert2").show(0).delay(15000).hide(0);
       $("#message2").text("Error...Debe ser un archivo DLM");  
       

        return false;
    
    }
    
 }
    

    $(document).on("submit",".formarchivo1",function(e){
  	fileValidation2();

     
        e.preventDefault();
        var formu=$(this);
        var nombreform=$(this).attr("id");


        //if(nombreform=="f_subir_imagen" ){ var miurl="subir_imagen_usuario";  var divresul="notificacion_resul_fci"}
        if(nombreform=="f_cargar_datos_usuarios1" ){ var miurl="cargar-txt1-2020-2-CFT";  var divresul="notificacion_resul_fcdu"}

        //información del formulario
        var formData = new FormData($("#"+nombreform+"")[0]);
      
        //hacemos la petición ajax   
//        alert('ENTRO');
        $.ajax({
            url: miurl,  
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
            $("#alert1.1").show(0).delay(15000).hide(0);

	        if(data.correcto=="SI"){
		$("#archivo2").val("");
                $("#alert21").show(0).delay(15000).hide(0);
	        $("#message21").text("Se cargo correctamente "); 

	        }

        	},
            //si ha ocurrido un error
            error: function(data){
               //alert(data);
                
            }
        });
        //alert("Se cargo con exito") ;
    }); 
  </script>
  
  <script>
  
  function fileValidation3(){
    var fileInput = document.getElementById('archivo3');
    var filePath = fileInput.value;
    var allowedExtensions = /(.dlm)$/i;
    
        if(!allowedExtensions.exec(filePath)){
       $("#archivo3").val("");

       $("#alert3").show(0).delay(15000).hide(0);
       $("#message3").text("Error...Debe ser un archivo DLM");  
       

        return false;
    
    }
    
 }
    

    $(document).on("submit",".formarchivo2",function(e){
  	fileValidation3();

     
        e.preventDefault();
        var formu=$(this);
        var nombreform=$(this).attr("id");


        //if(nombreform=="f_subir_imagen" ){ var miurl="subir_imagen_usuario";  var divresul="notificacion_resul_fci"}
        if(nombreform=="f_cargar_datos_usuarios2" ){ var miurl="cargar-txt2-2020-2-CFT";  var divresul="notificacion_resul_fcdu"}

        //información del formulario
        var formData = new FormData($("#"+nombreform+"")[0]);
      
        //hacemos la petición ajax   
//        alert('ENTRO');
        $.ajax({
            url: miurl,  
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
            $("#alert1.1").show(0).delay(15000).hide(0);

	        if(data.correcto=="SI"){
		$("#archivo3").val("");
                $("#alert31").show(0).delay(15000).hide(0);
                $("#message31").text("Se cargo correctamente"); 

	        }

        	},
            //si ha ocurrido un error
            error: function(data){
               //alert(data);
                
            }
        });
        //alert("Se cargo con exito") ;
    }); 
  </script>
  
  <script>
  

function fileValidation4(){
    var fileInput = document.getElementById('archivo4');
    var filePath = fileInput.value;
    var allowedExtensions = /(.dlm)$/i;
    
        if(!allowedExtensions.exec(filePath)){
       $("#archivo4").val("");

       $("#alert4").show(0).delay(15000).hide(0);
       $("#message4").text("Error...Debe ser un archivo DLM");  
       

        return false;
    
    }
    
 }

    $(document).on("submit",".formarchivo3",function(e){
  	fileValidation4();

     
        e.preventDefault();
        var formu=$(this);
        var nombreform=$(this).attr("id");


        //if(nombreform=="f_subir_imagen" ){ var miurl="subir_imagen_usuario";  var divresul="notificacion_resul_fci"}
        if(nombreform=="f_cargar_datos_usuarios3" ){ var miurl="cargar-txt3-2020-2-CFT";  var divresul="notificacion_resul_fcdu"}

        //información del formulario
        var formData = new FormData($("#"+nombreform+"")[0]);
      
        //hacemos la petición ajax   
//        alert('ENTRO');
        $.ajax({
            url: miurl,  
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
            $("#alert1.1").show(0).delay(15000).hide(0);

	        if(data.correcto=="SI"){
		$("#archivo4").val("");
                $("#alert41").show(0).delay(15000).hide(0);
                $("#message41").text("Se cargo correctamente");

	        }

        	},
            //si ha ocurrido un error
            error: function(data){
               //alert(data);
                
            }
        });
        //alert("Se cargo con exito") ;
    }); 
  </script>
  
<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.master', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>