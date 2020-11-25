$urlbase = $("body").attr('urlbase');
$tipo = $("#tipobusqueda");
$idproceso = $("#idproceso");
$(document).ready(function() {
	consultar();
});
function llenar(response, index, value)
{
	$mensaje =  "";
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
          	"title":"EDADES",
            "data":"EDAD",
            "width": 80
          },
          {
            "title":"MASCULINO",
            "data":"MASCULINO",
            "width": 80
          },
          {
            "title":"FEMENINO",
            "data":"FEMENINO",
            "width": 80
          },
          {
            "title":"TOTAL",
            "data":"TOTAL",
            "width": 100
          }
      ],
      dom: 'Bfrtip',
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
            total= api
                .column( 2 ).data()
                .reduce( function (a, b) {
                    return intVal(a) + intVal(b);
                }, 0 );
 
            $( api.column( 2 ).footer() ).html(total+ ' Postulantes');
        }
  });
}
function consultar(){
    $.ajax({
        url: 'rep-estadisticas-list-post-edad',
        method: 'POST',
        data:{
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
