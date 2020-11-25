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
            "data":"NUM",
            "width": 80
          },
          {
          	"title":"DNI",
            "render": function(data, type, row) {
                return row.numerodocumento.toUpperCase();
              }
          },
          /*{
          	"title":"Apellidos y Nombres",
            "render": function(data, type, row) {
                return row.apePatern.toUpperCase() + ' / ' + row.apematerno.toUpperCase() + ' / ' + row.nom.toUpperCase();
              }
          },*/
          {
            "title": "Num. Operación",
            "data": "numerooperacion",   

          },
          {
            "title":"Fecha Pago",
            "data": "fechapago"
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
                  columns: [ 0, 1, 2, 3, 4, 5,6 ]
              }
          },
          {
              extend: 'pdf',
              messageTop: $mensaje,
              footer: true,
              exportOptions: {
                  columns: [ 0, 1, 2, 3, 4, 5,6 ]
              },
          },
          {
              extend: 'print',
              messageTop: $mensaje,
              footer: true,
              exportOptions: {
                  columns: [ 0, 1, 2, 3, 4, 5,6 ]
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
  });
}
function consultar(){
  urlbase = $("body").attr('urlbase');
    $.ajax({
        url: urlbase+'/rep-pagossubidos-list',
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
