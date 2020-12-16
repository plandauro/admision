<?php $__env->startSection('title', ''); ?>

<?php $__env->startSection('content'); ?>
  @parent
  <div class="">
    <div class="page-title">
      <div class="title_left">
        <h3>Cargar Pagos</h3>
      </div>

    </div>

    <div class="clearfix"></div>

    <div class="row"> 
      <div class="col-md-12 col-sm-12 col-xs-12">
        <div id="verificar" class="x_panel">
          
          <div id="principal"  class="x_content">
            <div class="row">
              <div class="col-sm-12">
                <h2>Cargue los resultados en un documento excel:</h2>
                 
                <form  id="f_cargar_datos_usuarios" name="f_cargar_datos_usuarios" method="post"  action="cargar_datos_usuario" class="formarchivo" enctype="multipart/form-data" >                
      
      
       <input type="hidden" name="_token" id="_token"  value="<?= csrf_token(); ?>"> 
       <div id="alert" style="display: none;" class="alert alert-info  alert-dismissible fade in" role="alert">
                    <p id="message"></p>
                  </div>
      <div class="box-body">    

      <div class="form-group col-xs-12"  >
             <label>Agregar Archivo de Excel </label>
              <input name="archivo" id="archivo" type="file"   class="archivo form-control"  required/>
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
    $(document).on("submit",".formarchivo",function(e){

        $urlbase = $("body").attr('urlbase');
        e.preventDefault();
        var formu=$(this);
        var nombreform=$(this).attr("id");


        //if(nombreform=="f_subir_imagen" ){ var miurl="subir_imagen_usuario";  var divresul="notificacion_resul_fci"}
        if(nombreform=="f_cargar_datos_usuarios" ){ var miurl= $urlbase +"/cargar-pagos";  var divresul="notificacion_resul_fcdu"}

        //información del formulario
        var formData = new FormData($("#"+nombreform+"")[0]);
      
        //hacemos la petición ajax   
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
          $("#archivo").val("");
          $("#alert").show(0).delay(10000).hide(0);
          if(data.existe=="bien"){
            $("#message").text("Error al cargar ... debe ser un archivo excel");
          }else{
            if(data.existe=="SI"){           
            $("#message").text("Este archivo ya existe ... Ya se cargo este archivo en la Base de Datos");
          }else{
            $("#message").text("Se guardaron "+data.correcto+" registro correctamente de un total de "+data.total+ " registros.");
          }
          }
          
        },
            //si ha ocurrido un error
            error: function(data){
               alert("ha ocurrido un error") ;
console.log(data);

                
            }
        });
        //alert("Se cargo con exito") ;
    }); 
  </script>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.master', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>