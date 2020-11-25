$urlbase = $("body").attr('urlbase');
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
                return pad(row.idpostulacionX, 6);
              },
              "width": 50
            },
            {
              "title":"Apellidos y Nombres",
              "render": function ( data, type, row ) {
               return row.apepaterno.toUpperCase() + ' | ' + row.apematerno.toUpperCase() + ' | ' +row.nombre.toUpperCase() ;
               },
              "width": 260
             },
            {
              "title":"Escuela Postula",
              "data":"escuela",
              "width": 200
            },
            {
              "title":"Área",
              "data":"area",
              "width": 60
            },
            {
              "title":"Ambiente",
              "data":"ambiente",
              "width": 60
            },
            {
              "title": "Modalidad",
              "data": "modalidad",
              "width": 100
            },
            {
              "title": "Estado",
              "data": "estado",
              "width": 60
            }
        ],
        dom: 'Bfrtip',
        buttons: [
            {
                extend: 'excel',
                messageTop: $mensaje,
                footer: true,
                exportOptions: {
                    columns: [ 0, 1, 2,3,4, 5,6]
                },
            },
            {
                extend: 'pdf',
                messageTop: $mensaje,
                footer: true,
                exportOptions: {
                  columns: [ 0, 1, 2,3,4, 5,6]
                },
            },
            {
                extend: 'print',
                messageTop: $mensaje,
                footer: true,
                exportOptions: {
                    columns: [ 0, 1, 2,3,4, 5,6]
                },
                customize: function ( win ) {
                    $(win.document.body)
                        .css( 'font-size', '9pt' )
                        .css('text-align', 'center');
                    $(win.document.body).find('table')
                        .addClass( 'compact' )
                        .css( 'font-size', 'inherit' );
                },
            },
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
  $mensaje = "Lista de todos los postulantes en el proceso actual.";
  switch($dato.val()) {
      case "1":
          if($dato.val() != 0)
            $mensaje = "Lista postulantes "+$("#dato option:selected").text()+" en el proceso actual.";
          break;
      case "2":
          if($dato.val() != 0)
            $mensaje = "Lista postulantes "+$("#dato option:selected").text()+" en el proceso actual.";
          break;
      default:
          $mensaje = "Lista de todos los postulantes Vaidos / No Validos en el proceso actual.";
  }
  return $mensaje;
}
  
function consultaProducto(){
    $.ajax({
      url: 'rep-postulantesvalidado-list',
      method: 'POST',
      data:{
        idproceso: $idproceso.val(),
        dato: $dato.val()
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