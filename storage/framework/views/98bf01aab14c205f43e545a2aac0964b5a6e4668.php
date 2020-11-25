  <?php $__env->startSection('title', ''); ?>

  <?php $__env->startSection('content'); ?>
    @parent

    <div class="">
      <div class="page-title">
        <div class="title_left">
          <h3>Generar Examen de Admision</h3>
        </div>

      </div>
      <br>

      <div class="clearfix">

        <div class="x_content">
          <canvas hidden id="mycanvas"></canvas>

          <form hidden action="<?php echo e(url('/convertir')); ?>" method="post" enctype="multipart/form-data">

        			Select image to convert into base64 data:
              <input type="hidden" name="_token" id="_token"  value="<?= csrf_token(); ?>">

              <input type="file" name="fileToUpload" id="fileToUpload"><br>
        			<input type="submit" value="TESTBASE64" name="submit">

        		</form>

                                        <div class="x_title">

                      <a>
                      <button id="btnEliminar" type="button" class="navbar-right btn btn-danger" data-toggle="modal">
                        <span class="fa fa-times-circle"></span> Eliminar
                      </button>
                      </a>

                      <a>
                      <button id="btnActualizar"  onclick="" type="button" class="navbar-right btn btn-warning"  >
                        <span class="fa fa-pencil"></span> Editar
                      </button>
                      </a>

                      <a>
                      <button id="btnNuevo"  type="button" class="navbar-right btn btn-primary"  >
                        <span class="fa fa-plus"></span> Nuevo
                      </button>
                      </a>

          <div class="clearfix"></div>

                    </div>
                     <table id="myTable" style="font-size: 13px" width="100%" class="table table-hover table-bordered display nowrap">


                     </table>
                 </div>
               </div>



</div>

  <?php $__env->stopSection(); ?>

  <?php $__env->startSection('css'); ?>

    <link rel="stylesheet" href="<?php echo e(asset('css/jquery.dataTables.min.css')); ?>">
    <link rel="stylesheet" href="<?php echo e(asset('css/responsive.dataTables.min.css')); ?>">
    <!-- PNotify -->
    <link href="<?php echo e(asset('css/pnotify.css')); ?>" rel="stylesheet">
    <link href="<?php echo e(asset('css/pnotify.buttons.css')); ?>" rel="stylesheet">
    <link href="<?php echo e(asset('css/pnotify.nonblock.css')); ?>" rel="stylesheet">

    <link href="<?php echo e(asset('css/jquery.Jcrop.css')); ?>" rel="stylesheet">
  <?php $__env->stopSection(); ?>

  <?php $__env->startSection('js'); ?>
  <!-- PNotify -->

    <script src="<?php echo e(asset('js/jquery.dataTables.min.js')); ?>"></script>


    <script src="<?php echo e(asset('js/jquery.dataTables.min.js')); ?>"></script>
    <script src="<?php echo e(asset('js/dataTables.responsive.min.js')); ?>"></script>


     <script src="<?php echo e(asset('js/bootstrap.min.js')); ?>"></script>


<script type="text/javascript">
var dataTable = 0;
urlbase = $("body").attr('urlbase');

$(document).ready(function() {

  consultar();

});





function consultar(){

  url=urlbase+"/listaevaluaciones";
    $.ajax({
        url: url,
        method: 'POST',
    })
    .done(function(response){
      $datos = response.usuarios;
      $.each(response, function(index, value){
          llenar($datos, index, value);




 $('#myTable tbody').on( 'click', 'tr', function () {
        $(this).toggleClass('selected');
    });





$('#btnActualizar').click( function () {

datos();


    });



 $('#btnEliminar').click( function () {

        var tablas=$('#myTable').DataTable();
        if(tablas.rows('.selected').data().length == 0) {

            $msg = "No seleccione algún un elemento.";
          mensaje($msg, 'red');

          return;
        }
        rows = tablas.rows('.selected').data();
        ids = "";
        $.each( rows, function( i, item ) {
        console.log("i["+i+"] ID["+item.ID+"]");
        ids+=item.idAmbiente+",";

      });

          eliminaraula(ids);




    });

$('#btnNuevo').click( function() {

   var tablas=$('#myTable').DataTable();
if(tablas.rows('.selected').data().length >= 1) {
console.log('nodeveseleccionarnada');
}else{

  window.location.replace($urlbase+ '/generarexa/index/0');

}


    });





      });
    })
    .fail(function(response){
    });
}



function llenar(response, index, value)
{
  var tablas=$('#myTable').DataTable({
      "destroy": true,
      "data": response,
      "columns":[
          {
            "title": "",
            "width": 4,
            "render": function(data, type, row) {
              return "";
            }
          },
          {
            "title":"#",
            "data":"id",
            "width": 5
          },
          {
            "title":"Proceso",
            "data":"proceso",
            "width": 10
          },
        {
            "title":"Area",
            "data":"area",
            "width": 8
          },
{
            "title":"Fecha de evaluación",
            "data":"fecha_evaluacion",
            "width": 30
          },

          {
            "title":"Nro de preguntas",
            "data":"nropre",
             "width": 21
          }
          ,

          {
            "title":"Tipo",
            "render": function(data, type, row) {
              if(row.tipo==1) {return '<center>REPETITIVAS + ALEATORIAS</center>';}
              if(row.tipo==2) {return '<center>INSERTAR ALEATORIAS</center>';}
              if(row.tipo==3) {return '<center>SOLO REPETITIVAS</center>';}
              if(row.tipo==4) {return '<center>SOLO ALEATORIAS</center>';}
            },
             "width": 21
          }
          ,
          {
            "title":"Estado",
            "render": function(data, type, row) {
              if(row.estado!=3) {
                return '<center><a type="button" href="/generarexa/index/'+row.token+'"  title="CLICK PARA CULMINAR PROCESO" class="btn btn-round btn-danger btn-xs"><span class="fa fa-close"> Pendiente</span></a></center>';
              }
              else
                return '<center><button type="button" title="PROCESO TERMINADO" class="btn btn-round btn-success btn-xs"><span class="fa fa-check"> Terminado</span></button></center>';
            },"width": 5
          },
          {
            "title":"Exámen",
            "render": function(data, type, row) {
              if(row.estado!=3) {
                return '<center><a type="button"   title="AUN NO A FINALIZADO EL PROCESO" class="btn btn-round btn-danger btn-xs"><span class="fa fa-chevron-down"></span></a></center>';
              }

              if(row.tipo==1) {
                return '<center><a type="button" href="/examenAdmisionTONE/'+row.token+'"  title="CLICK PARA DESCARGAR EXÁMEN" class="btn btn-round btn-warning btn-xs"><span class="fa fa-chevron-down"></span></a></center>';
              }
              if(row.tipo==2) {
                return '<center><a type="button" href="/examenAdmisionTTWO/'+row.token+'/'+row.id_proceso+'"  title="CLICK PARA DESCARGAR EXÁMEN" class="btn btn-round btn-warning btn-xs"><span class="fa fa-chevron-down"></span></a></center>';
              }
              if(row.tipo==3) {
                return '<center><a type="button" href="/examenAdmisionTTREE/'+row.token+'/'+row.id_proceso+'"  title="CLICK PARA DESCARGAR EXÁMEN" class="btn btn-round btn-warning btn-xs"><span class="fa fa-chevron-down"></span></a></center>';
              }
              if(row.tipo==4) {
                return '<center><a type="button" href="/examenAdmisionTFOUR/'+row.token+'"  title="CLICK PARA DESCARGAR EXÁMEN" class="btn btn-round btn-warning btn-xs"><span class="fa fa-chevron-down"></span></a></center>';
              }
            },"width": 5
          },


      ],
      "language": {
        "lengthMenu": "Mostrar _MENU_ Registros del total de evaluaciones ",
        "zeroRecords": "No se encontró ningún registro",
        "info": "_PAGE_ de _PAGES_",
        "infoEmpty": "No records available",
        "infoFiltered": "(Filtrado de un total de _MAX_ total registros)",
        "search": "Buscar:",
        "paginate": {
          "first":      "Primero",
          "last":       "Último",
          "next":       "Siguiente",
          "previous":   "Anterior"
        },
      },
      responsive: {
        details: {
            type: 'column'
        }
      },
      columnDefs: [ {
        className: 'control',
        orderable: false,
        targets:   0
      } ],
      order: [ 1, 'asc' ]
  });

}



function datos() {

   var tablas=$('#myTable').DataTable();



if(tablas.rows('.selected').data().length == 0 || tablas.rows('.selected').data().length > 1) {
    $msg = "Seleccione solo un elemento";
          mensaje($msg, 'red');
         $("#myModal").modal('hide');
          return;

        }

    rows = tablas.rows('.selected').data();


    $.each( rows, function( i, item ) {

        id= item.idUsuario;
        nombre= item.apellidos;
      });


    buscar(id,nombre);
}


function buscar($value,$nom) {


 if(!confirm("¿Desea editar el usuario "+$nom+"?"))
    return;



    $.ajax({
        data:{
            idUsuarios: $value
        },
        type: 'POST',
        url: $urlbase+'/usuarios',
        dataType: 'json',


 success: function(data) {

            cargarDatos(data);
            $('#myModal').modal('show');

        },
        error: function(data) {

            mensaje(data.message, "red");
        }

    });


}


$('#base').click( function () {
convertir();

    });


function convertir() {
  imagen=$('#fileToUpload').val();
_token=$('#_token').val();

    $.ajax({
        data:{
          _token:_token,
            imagen: imagen
        },
        type: 'POST',
        url: $urlbase+'/convertir',
        dataType: 'json',


 complete: function(data) {
console.log(data);

        },
        error: function(data) {

        }

    });


}



</script>

<script type="text/javascript">
var canvas = document.getElementById('mycanvas');
var ctx = canvas.getContext('2d');
imgData="data:image/png;base64,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";
var myImage = new Image();
myImage.src = imgData;
ctx.drawImage(myImage, 0, 0);


var imgData = canvas.toDataURL();
</script>


    <?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.master', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>