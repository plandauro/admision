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
          	"title":"Cod. Post.",
            	"render": function(data, type, row) {
            		return pad(row.codPostulantex, 6);
            	},
              "width": 80
          },
          {
          	"title":"Postulante",
            "render": function(data, type, row) {
                return row.apepaterno.toUpperCase()+" "+row.apematerno.toUpperCase()+" "+row.nombre.toUpperCase();
              }
          },
          {
            "title": "Num. Operación",
            "data": "numerooperacion"
          },
          {
            "title":"Costo Carpeta",
            "render": function(data, type, row) {
                return "S/."+row.costocarpeta;
            }
          },
          {
            "title":"Costo Prospecto",
            "render": function(data, type, row) {
              return "S/."+row.costoprospecto;
            }
          },
          {
            "title":"Costo Tarifa",
            "render": function(data, type, row) {
		//return "S/."+row.costotarifa;
	      //MODIFICADO 17/09/2018
              var a = parseFloat(row.costocarpeta);
              var b = parseFloat(row.costoprospecto);
              var n= a + b;
              $costoT=row.costotarifa-n;
              return "S/."+$costoT;
            }
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
	    //$( api.column( 6 ).footer() ).html( "S/."+ total );
	    // AGREGADO 17/09/2018
            $( api.column( 6 ).footer() ).html( "S/."+  Math.round(total * 100) / 100 );

        }
     
  });
}

function pad (n, length) {
    var  n = n.toString();
    while(n.length < length)
         n = "0" + n;
    return n;
};

function consultar(){
    $.ajax({
        url: 'rep-pagos-list',
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
