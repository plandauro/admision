$urlbase = $("body").attr('urlbase');
$tipo = $("#tipobusqueda");
$(document).ready(function() {
	consultar();
});
function llenar(response, index, value)
{
  $('#myTable').DataTable({
      "destroy": true,
      "data": response,
      "columns":[
          {
            "title": "",
            "width": 5,
            "render": function(data, type, row) {
              return "";
            }
          },
          {
          	"title":"#",
            "data":"id",
          },
          {
          	"title":"Proceso",
            "data":"descripcion",
            "width": 50
          },
          {
            "title":"Resolucion",
            "render": function(data, type, row) {

              return row.activo ? "<div id='edit-"+row.id+"'>"+
                                    "<button onclick='editResolucion("+row.id+")' class='btn btn-primary btn-xs' title='Editar la resolución'>"+
                                      "<span class='fa fa-pencil'></span>"+
                                    "</button>"+ row.resolucion +
                                  "</div>"+
                                  "<div style='display:none' id='save-"+row.id+"'>"+
                                    "<button onclick='saveResolucion("+row.id+")' class='btn btn-success btn-xs' title='Guardar'>"+
                                      "<span class='fa fa-save'></span>"+
                                    "</button>"+
                                    "<input style='width:70px;' type='text' value='"+row.resolucion+"' />"+
                                  "</div>"                         
                                  : row.resolucion;
            }
          },
          {
            "title": "Estado",
            "render": function(data, type, row) {
              if(row.activo==1) {
                $descripcion = "'"+row.descripcion+"'";
                return '<center><button type="button" onclick="terminarproceso('+row.id+','+$descripcion+')" title="ACTIVO" class="btn btn-round btn-success btn-xs"><span class="fa fa-check"></span></button></center>';
              }  else{
                return '<center><button type="button" title="TERMINADO" class="btn btn-round btn-danger btn-xs"><span class="fa fa-close"></span></button></center>';
             }
            },
            "width" : 50
          },
          {
            "title":"Responsable",
            "data":"responsable"
          },
          {
            "title":"Director",
            "data":"director"
          },
          {
            "title":"Carpeta (S/.)",
            "render": function(data, type, row) {
                return "S/."+row.costocarpeta;
              }
          },
          {
            "title":"Porspecto (S/.)",
            "render": function(data, type, row) {
                return "S/."+row.costoprospecto;
              }
          },
          
          {
            "title":"Fecha Ordinario",
            "data":"fechaexaordinario"
          },
          {
            "title":"Fecha Extraordinario",
            "data":"fechaexaextraordinario"
          }
      ],
      "language": {
        "lengthMenu": "Mostrar _MENU_ postulaciones",
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
        url: 'lista',
        method: 'POST',
    })
    .done(function(response){
      $datos = response.procesos;
      $.each(response, function(index, value){
          llenar($datos, index, value);
      });
    })
    .fail(function(response){
    }); 
}
$("#formproceso").submit(function(event) {
  event.preventDefault();
  $.ajax({
      url: 'create',
      method: 'POST',
      data: $(this).serialize(),
      success: function(data) {
        if(data.success){
          mensaje(data.message, "green")
          consultar();
          $("#myModal").modal('toggle');
          $("#formproceso")[0].reset();
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
function  terminarproceso ($idproceso, $descripcion){
  if(!confirm("¿Desea terminar el proceso "+$descripcion+"?"))
    return;
  $.ajax({
      url: 'terminar',
      method: 'POST',
      data: {
        id: $idproceso
      },
      success: function(data) {
        if(data.success){
          mensaje(data.message, "green")
          consultar();
        }
        else{
          mensaje(data.message, "red")
        }
      }
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