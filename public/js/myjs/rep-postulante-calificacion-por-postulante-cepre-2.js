$urlbase = $("body").attr('urlbase');
$idproceso = $("#idproceso");
$codigopostulante = $("#codigopostulante");
$(document).ready(function() {
	consultaProducto();
});
function llenar(response, index, value)
{
	$mensaje = "";
  $("#message").html($mensaje);
  $('#myTable').DataTable({
      "destroy": true,
      "data": response,
      "columns":[
          {
            "title":"CODIGO POSTULANTE",
            "data":"CODIGOPOSTULANTE",
            "width": 10
          },
          {
            "title": "Nº LITHO",
            "data": "LITHOHOJA",   

          },
          {
            "title":"CANAL",
            "data": "CANALPOSTULANTE"
          },
          {
            "title":"N° PREGUNTA",
            "data": "NROPREGUNTACONCATENADA"
          },
          {
            "title":"RESPUESTA MARCADA",
            "data": "RESPUESTAMARCADA"
          },
          {
            "title":"N° PREGUNTA CLAVE",
            "data": "NROPREGUNTACLAVECONCATENADA"
          },
          {
            "title":"CLAVES DEL EXAMEN",
            "data": "CLAVEMARCADA"
          },
          {
            "title":"OBSERVACION",
            "data": "OBSERVACION"
          },
          {
            "title":"PUNTAJE",
            "data": "PUNTAJE"
          }
      ],
      dom: 'Bfrtip',
      buttons: [
          {
              extend: 'pdf',
              messageTop: $mensaje,
              footer: true,
              title: 'Reporte de Calificacion del Postulante Buscado en el Proceso de Admisión 2020-1',
              exportOptions: {
                  columns: [ 0, 1, 2, 3, 4, 5, 6, 7, 8 ],
                  alignment: 'center',
                  image: ''
              },
              customize: function ( doc ) {
                doc.styles.title = {
                       color: 'red',
                       fontSize: '14',
                       alignment: 'center'
                    },
                    
                    doc.content.splice( 1, 0, {
                        margin: [ 0, 0, 0, 12 ],
                        alignment: 'center',
                        image: 'data:image/jpeg;base64,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'
                    } );
              }
          },
          {
              extend: 'print',
              messageTop: $mensaje,
              footer: true,
              title: 'Reporte de Calificacion del Postulante Buscado en el Proceso de Admisión 2020-1',
              exportOptions: {
                  columns: [ 0, 1, 2, 3, 4, 5, 6, 7, 8 ]
              },
              customize: function ( win ) {
                  $(win.document.body)
                      .css( 'font-size', '5pt' )
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
        "search": "Buscar Numero de Pregunta:",
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
            PUNTAJE = api
                .column(8)
                .data()
                .reduce( function (a, b) {
                    return intVal(a) + intVal(b);
                }, 0 );
            $(api.column(8).footer()).html((PUNTAJE).toFixed(4));




        /*var api = this.api();
        nb_cols = api.columns().nodes().length;
        var j = 9;
        while(j < nb_cols){
          var pageTotal = api
                .column( j, { page: 'current'} )
                .data()
                .reduce( function (a, b) {
                    return Number(a) + Number(b);
                }, 0 );
          // Update footer
          $( api.column( j ).footer() ).html(pageTotal);
          j++;
        } */  
        }
  });
}

function consultaProducto(){
    $.ajax({
      url: $urlbase+'/rep-lista-calificacion-por-postulante-cepre-2',
      method: 'POST',
      data:{
        codigopostulante: $codigopostulante.val(),
    }
    })
    .done(function(response){
        $.each(response, function(index, value){
            llenar(response.postulaciones, index, value);
        });
    })
    .fail(function(response){
    }); 
}
