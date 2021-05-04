$urlbase = $("body").attr('urlbase');
$tipo = $("#tipobusqueda");
$dato = $("#dato");
$idproceso = $("#idproceso");
$(document).ready(function() {
	consultaProducto();
});
function llenar(response, index, value)
{
	$mensaje =  getMessage();
  $("#message").html($mensaje);
    $('#myTable').DataTable({
        "destroy": true,
        "data": response,
        "columns":[
            {
            	"title":"Cod. Post.",
            	"render": function(data, type, row) {
            		return pad(row.idpostulacion, 6);
            	},
              "width": 50
            },
            {
              "title":"Codigo Matricula",
              "data":"codalumno"
            },
            {
            	"title":"Apellidos y Nombres",
            	"render": function ( data, type, row ) {
			         return row.apepaterno.toUpperCase() + ' | ' + row.apematerno.toUpperCase() + ' | ' +row.nombre.toUpperCase() ;
			         },
              "width": 225
			       }, 

             
             {
            	"title":"N° Doc.",
            	"data":"dni"
            },
            
            {
            	"title":"Escuela Profesional",
            	"data":"escuela"
            },
            {
              "title":"Modalidad de Ingreso",
              "data":"modalidad"
            },
            {
              "title":"OMG",
              "data":"omg"
            },
            {
              "title":"OME",
              "data":"ome"
            },
            {
              "title":"Puntaje",
              "data":"puntaje"
            }
            ,
            {
              "title":"Resultado",
              "data":"resultado"
            }
            ,
        ],
        dom: 'Bfrtip',
        buttons: [
            {
                extend: 'excel',
                messageTop: $mensaje,
                footer: true,
                exportOptions: {
                    columns: [ 0, 1, 2,3,4, 5,6,7,8 ]
                }
            },
            {
                extend: 'pdf',
                messageTop: $mensaje,
                footer: true,
                exportOptions: {
                    columns: [ 0, 1, 2,3,4, 5,6,7,8 ]
                },
            },
            {
                extend: 'print',
                messageTop: $mensaje,
                footer: true,
                exportOptions: {
                    columns: [ 0, 1, 2,3,4, 5,6,7,8 ] 
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
function getMessage(){
	$mensaje = "Lista de todos los Ingresantes en el proceso actual.";
	switch($tipo.val()) {
	    case "1":
	        if($dato.val() != 0)
	        	$mensaje = "Lista postulantes en el ambiente "+$("#dato option:selected").text()+" en el proceso actual.";
	        break;
	    case "2":
	        if($dato.val() != 0)
	        	$mensaje = "Lista postulantes en la escuela "+$("#dato option:selected").text()+" en el proceso actual.";
	        break;
	    case "3":
	        if($dato.val() != 0)
	        	$mensaje = "Lista postulantes en la modalidad "+$("#dato option:selected").text()+" en el proceso actual.";
	        break;    
	    default:
	        $mensaje = "Lista de todos los postulantes en el proceso actual.";
	}
	return $mensaje;
}
function cargarCombo(){
	
	$html = '<option value="0">Todos</option>';
	if($tipo.val() == 0){
		$("#dato").prop('disabled', true);
		$("#dato").html($html);
    consultaProducto();
		return;
	}
	$.ajax({
		url: 'cargarfiltro',
		method: 'POST',
		data:{
			tipo: $tipo.val(),
			dato: $dato.val()
		}
	})
	.done(function(responce) {
		$.each(responce.list, function (index, value) {
		  $html += '<option value="'+value.codigo+'">'+value.descripcion+'</option>';
		});
		$("#dato").html($html);
		$("#dato").prop('disabled', false);
	})
	.fail(function(responce) {
		// body...
	});
}
function consultaProducto(){
    $.ajax({
      url: 'rep-ingresante-list',
      method: 'POST',
      data:{
  			tipo: $tipo.val(),
  			dato: $dato.val(),
        idproceso: $idproceso.val()
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

function pad (n, length) {
    var  n = n.toString();
    while(n.length < length)
         n = "0" + n;
    return n;
};

function getEdad(fecha){ 
   	hoy=new Date();
   	//calculo la fecha que recibo 
   	//La descompongo en un array 
   	var array_fecha = fecha.split("-");
   	//si el array no tiene tres partes, la fecha es incorrecta 
   	if (array_fecha.length!=3) 
      	return false 

   	//compruebo que los ano, mes, dia son correctos 
   	var ano;
   	ano = parseInt(array_fecha[0]); 
   	if (isNaN(ano)) 
      	return false ;

   	var mes ;
   	mes = parseInt(array_fecha[1]); 
   	if (isNaN(mes)) 
      	return false ;

   	var dia;
   	dia = parseInt(array_fecha[2]);	
   	if (isNaN(dia)) 
      	return false 

   	//si el año de la fecha que recibo solo tiene 2 cifras hay que cambiarlo a 4 
   	if (ano<=99) 
      	ano +=1900;

   	//resto los años de las dos fechas 
   	edad=hoy.getFullYear()- ano - 1; //-1 porque no se si ha cumplido años ya este año 

   	//si resto los meses y me da menor que 0 entonces no ha cumplido años. Si da mayor si ha cumplido 
   	if (hoy.getMonth() + 1 - mes < 0) //+ 1 porque los meses empiezan en 0 
      	return edad;
   	if (hoy.getMonth() + 1 - mes > 0) 
      	return edad+1; 

   	//entonces es que eran iguales. miro los dias 
   	//si resto los dias y me da menor que 0 entonces no ha cumplido años. Si da mayor o igual si ha cumplido 
   	if (hoy.getUTCDate() - dia >= 0) 
      	return edad + 1; 

   	return edad;
}