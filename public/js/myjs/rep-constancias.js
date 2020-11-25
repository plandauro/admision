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
          	"title":"Escuela",
            "data":"descripcion",
            "width": 280
          },
          {
          	"title":"Cantidad de ingresantes",
            "data":"cantidad",
            "width": 80
          },
          {
            "title": "Constancias",
            "render": function(data, type, row) {
                return '<center><a href="'+$urlbase+'/pdf/constancias/'+row.idproceso+'/'+row.id+'" style="color:#E10F16;font-size:20px" title="Descargar constancias de la escuela de '+row.descripcion+'"><span class="fa fa-download"></span></a></center>'
            },
            "width": 50
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
                .column( 1 ).data()
                .reduce( function (a, b) {
                    return intVal(a) + intVal(b);
                }, 0 );
 
            $( api.column( 1 ).footer() ).html(total+ ' Ingresantes');
        }
  });
}
function consultar(){
    $.ajax({
        url: 'rep-constancias-list',
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
