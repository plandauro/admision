var dataTable = 0;
var id = 0;
$urlbase = $("body").attr('urlbase');
$formNuevas =$('#formNuevas');
$tipo = $("#tipobusqueda");
$(document).ready(function() {
  consultar();
});
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
            "data":"idAmbiente",
            "width": 5
          },
          {
            "title":"Nombre Aula",
            "data":"descripcionAmbiente",
            "width": 30
          },
        {
            "title":"Pabellón",
            "data":"ubicacion",
            "width": 100
          },
{
            "title":"Capacidad",
            "data":"capacidad",
            "width": 30
          },

  {
            "title":"Descrip.Modalidad ",
            "data":"descripcionarea",
             "width": 10
          }
          ,
          {
            "title":"Nombre Modalidad",
            "data":"nombre",
             "width": 40
          },
        
           {
            "title":"Orden Cobertura",
            "data":"proyector",
             "width": 10
          },
        
      ],
      "language": {
        "lengthMenu": "Mostrar _MENU_ Registros del total de Aulas",
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
     // order: ["data":"descripcionarea", 'asc' ]
      //order: [ 1, 'asc' ]
  });
       
}




function getMessage(){
  $mensaje = "Lista de todos los postulantes en el proceso actual.";
  switch($tipo.val()) {
      case "0":
            $mensaje = "Total de postulantes por Departamento.";
          break;   
      case "1":
            $mensaje = "Total de postulantes por Provincia.";
          break;
      case "2":
            $mensaje = "Total de postulantes por Distrito.";
          break;
  }
  return $mensaje;
}



function consultar(){
    $.ajax({
        url: 'listaAulas',
        method: 'POST',
    })
    .done(function(response){
      $datos = response.aulas;
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
    $msg = "No debe estar seleccionado ningún elemento";
          mensaje($msg, 'red');
          return;
        } 

      idAmbiente = 0;
//      $("#txtRazonSocial").prop('disabled', false);
      $('#descripcion').val("");
      $('#CapacidadAula').val("");
      $('#ubicacionAula').val("");

   
      $('#myModal').modal('show');
    });






      });
    })
    .fail(function(response){
    }); 
}




function  eliminaraula($ids){

 if(!confirm("¿Desea eliminar el aula "+$ids+"?"))
    return;
  $.ajax({
      url: 'eliminar',
      method: 'POST',
      data: {
        id: $ids
      },
      success: function(data) {
        if(data.success){
          mensaje(data.message, "green")
          consultar();
           window.location.reload();
        }
        else{
          mensaje(data.message, "red")
        }
      }
  });
}



$("#formNuevas").submit(function(event) {
  event.preventDefault();
  $.ajax({
      url: 'crearaulas1',
      method: 'POST',
      data: $(this).serialize(),
      success: function(data) {
        if(data.success){
          mensaje(data.message, "green")
          //consultar();
        window.location.reload();
          $("#modal-form").modal('toggle');
          $("#formNuevas")[0].reset();
        }

      },
      error: function(data) {
        $msg = "";
        if(data.status == "422")
          $msg =pinterrors(data);
        else
          $msg  = "No se pudo guardar.<br> Inténtelo de nuevo más tarde.";
        mensaje($msg, "red");
      }
  });
});



function datos() {

   var tablas=$('#myTable').DataTable();



if(tablas.rows('.selected').data().length == 0 || tablas.rows('.selected').data().length > 1) {
    $msg = "Seleccione solo un elemento";
          mensaje($msg, 'red');
          $("#modal-form").modal('hide');
          return;

        }        
    
    rows = tablas.rows('.selected').data();
    $.each(rows, function(i, item) {
        //console.log("i["+i+"] ID["+item.ID+"]");
        id = item.idAmbiente;
        //          $("#txtNombPers").prop('disabled', true);
        $('#descripcion1').val(item.descripcionAmbiente);
        $('#CapacidadAula1').val(item.capacidad);
        $('#ubicacionAula1').val(item.ubicacion);
        $('#isoarea1').val(item.areaid);
        $('#codAmbiente1').val(item.idAmbiente);
         $('#ordenCobertura').val(item.proyector);
     
        //$('#idAcceso').val(item.ID_ACCESO);           
        $('#modal-form').modal('show');
    });
}



$("#formAulas").submit(function(event) {
  event.preventDefault();
  $.ajax({
      url: 'crearaulas',
      method: 'POST',
      data: $(this).serialize(),
      success: function(data) {
        if(data.success){
          mensaje(data.message, "green")
         // consultar();
           window.location.reload();
          $("#myModal").modal('toggle');
          $("#formAulas")[0].reset();
        }
      },
      error: function(data) {
        $msg = "";
        if(data.status == "422")
          $msg =pinterrors(data);
        else
          $msg  = "No se pudo guardar.<br> Inténtelo de nuevo más tarde.";
        mensaje($msg, "red");
      }
  });
});






function pinterrors(data){
  $msg ="";
  $("input").removeClass("parsley-error");
  $.each(data.responseJSON, function(i, item) {
      $msg +=  "• "+item[0] +"<br>";
      $( "[name='"+i+"']" ).addClass("parsley-error");
  });
    return $msg;
}
function mensaje(msg, color) {
  $tipo = "error";
  $title = "Mensaje:";
  if(color == "red"){
      $tipo = "error";
      $title = "Error:";
  }
  if(color == "green") {
      $tipo = "success";
      $title = "Guardado:";
  }
  new PNotify({
    title: $title,
    text: msg,
    type: $tipo,
    styling: 'bootstrap3'
  });
}


function pinterrors(data){
  $msg ="";
  $("input").removeClass("parsley-error");
  $.each(data.responseJSON, function(i, item) {
      $msg +=  "• "+item[0] +"<br>";
      $( "[name='"+i+"']" ).addClass("parsley-error");
  });
    return $msg;
}
function mensaje(msg, color) {
  $tipo = "error";
  $title = "Mensaje:";
  if(color == "red"){
      $tipo = "error";
      $title = "Error:";
  }
  if(color == "green") {
      $tipo = "success";
      $title = "Guardado:";
  }
  new PNotify({
    title: $title,
    text: msg,
    type: $tipo,
    styling: 'bootstrap3'
  });
}

function editResolucion($id) {
  $("#edit-"+$id).hide();
  $("#save-"+$id).show();
  $("#save-"+$id +" input").focus();
}


function saveResolucion($id) {
  $resolucion = $("#save-"+$id +" input").val();
  $.ajax({
    url: 'editresolucion',
    method: 'POST',
    data:{
      id: $id,
      resolucion: $resolucion,
    }
  })
  .done(function(data){
    if(data.success){
      mensaje(data.message, 'green');
      consultar();
    }
    else{
      mensaje(data.message, 'red');
    }
  });
}