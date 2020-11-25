$urlbase = $("body").attr('urlbase');
$tipo = $("#tipobusqueda");
$idproceso = $("#idproceso");
$(document).ready(function() {
	consultar();
});
function llenar(response, index, value)
{
	$mensaje =  getMessage();
  $("#message").html($mensaje);
  $('#myTable').DataTable({
      "destroy": true,
      "data": response,
      "bFilter": false,
      "bPaginate": false,
      "bLengthChange": false,
      "bInfo": false,
      "columns":[
          {
          	"title":"Ubicación",
            "data":"ubicacion",
            "width": 280
          },
          {
          	"title":"Cantidad de Ingresantes",
            "data":"ingreso"
          },
          {
            "title":"Cantidad de NO Ingresantes",
            "data":"noingreso"
          },
          {
            "title":"Total",
            "data":"total"
          }
      ],
      dom: 'Bfrtip',
      buttons: [
          {
              extend: 'excel',
              messageTop: $mensaje,
              footer: true,
              exportOptions: {
                  columns: [ 0, 1, 2, 3 ]
              }
          },
          {
              extend: 'pdf',
              messageTop: $mensaje,
              footer: true,
              exportOptions: {
                  columns: [ 0, 1, 2, 3 ]
              },
          },
          {
              extend: 'print',
              messageTop: $mensaje,
              footer: true,
              exportOptions: {
                  columns: [ 0, 1, 2, 3 ]
              },
              customize: function ( win ) {
                  $(win.document.body)
                      .css( 'font-size', '9pt' )
                      .css('text-align', 'center');
                  $(win.document.body).find('table')
                      .addClass( 'compact' )
                      .css( 'font-size', 'inherit' );
              }
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
      "footerCallback": function ( row, data, start, end, display ) {
            var api = this.api(), data;
 
            // Remove the formatting to get integer data for summation
            var intVal = function ( i ) {
                return typeof i === 'string' ?
                    i.replace(/[\$,]/g, '')*1 :
                    typeof i === 'number' ?
                        i : 0;
            };
 
            // Total over all pages
            totalingresantes = api
                .column( 1 ).data()
                .reduce( function (a, b) {
                    return intVal(a) + intVal(b);
                }, 0 );
            totalnoingresantes = api
                .column( 2 ).data()
                .reduce( function (a, b) {
                    return intVal(a) + intVal(b);
                }, 0 );
            total= api
                .column( 3 ).data()
                .reduce( function (a, b) {
                    return intVal(a) + intVal(b);
                }, 0 );
 
            // Update footer
            $( api.column( 1 ).footer() ).html('('+totalingresantes + ') Ingresaron');
            $( api.column( 2 ).footer() ).html('('+totalnoingresantes +') No Ingresaron');
            $( api.column( 3 ).footer() ).html('('+total+ ') Postulantes');
        }
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
        url: 'rep-estadisticas-list',
        method: 'POST',
        data:{
    			tipo: $tipo.val(),
          idproceso: $idproceso.val()
		    }
    })
    .done(function(response){
      $datos = response.resultado;
      $.each(response, function(index, value){
          llenar($datos, index, value);
      });
    })
    .fail(function(response){
    }); 
}
