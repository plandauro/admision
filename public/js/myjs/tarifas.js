$urlbase = $("body").attr('urlbase');
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
      "columns":[
          {
          	"title":"Codigo",
            "data":"idpostulacion",
            "width": 80
          },
          {
          	"title":"DNI",
            "render": function(data, type, row) {
                return row.numerodocumento.toUpperCase();
              }
          },
          {
            "title": "Num. Operación",
            "data": "numerooperacion",   

          },
          {
            "title":"Fecha Pago",
            "data": "fechapago"
          },
          {
             "title":"Hora Pago",
            "data": "horapago" 

          },
          {
             "title":"Observacion",
            "data": "observacion"

          },
          {
            "title":"Total",
            "data": "total"
          }
      ],
      dom: 'Bfrtip',
      buttons: [
          {
              extend: 'excel',
              messageTop: $mensaje,
              footer: true,
              exportOptions: {
                  columns: [ 0, 1, 2, 3, 4, 5 ]
              }
          },
          {
              extend: 'pdf',
              messageTop: $mensaje,
              footer: true,
              exportOptions: {
                  columns: [ 0, 1, 2, 3, 4, 5 ]
              },
          },
          {
              extend: 'print',
              messageTop: $mensaje,
              footer: true,
              exportOptions: {
                  columns: [ 0, 1, 2, 3, 4, 5 ]
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

            var intVal = function ( i ) {
                return typeof i === 'string' ?
                    i.replace("S/.", '')*1 :
                    typeof i === 'number' ?
                        i : 0;
            };

            // Total over all pages
            total = api
                .column( 6 )
                .data()
                .reduce( function (a, b) {
                    return intVal(a) + intVal(b);
                }, 0 );
 
            // Update footer
            $( api.column( 6 ).footer() ).html( "S/."+ total );
        }
     
  });
}
function consultar(){
    $.ajax({
        url: 'listTarifas',
        method: 'POST',
        data:{
          idproceso: $idproceso.val()
		    }
    })
    .done(function(response){
      $datos = response.tarifas;
      $.each(response, function(index, value){
          llenar($datos, index, value);
      });
    })
    .fail(function(response){
    }); 
}
