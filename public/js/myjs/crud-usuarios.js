var dataTable = 0;
var id = 0;
var nombre="";
$formEditarUsu=$('formEditarUsu');
$urlbase = $("body").attr('urlbase');
$('#img-btn').click( function () {$('#mymodalPhoto').modal('show'); });
$(document).ready(function() {

  consultar();

});
function llenar(response, index, value)
{
  var tablas=$('#myTable').DataTable({
      "destroy": true,
      "data": response,
      "columns":[
          {
            "title": "",
            "width": 4,
            "render": function(data, type, row) {
              return "";
            }
          },
          {
            "title":"#",
            "data":"idUsuario",
            "width": 5
          },
          {
            "title":"Nombres y Apellidos",
            "data":"apellidos",
            "width": 50
          },
        {
            "title":"Dni",
            "data":"dni",
            "width": 8
          },
{
            "title":"Correo",
            "data":"email",
            "width": 50
          },

          {
            "title":"Tipo de Usuario",
            "data":"nombrerol",
             "width": 21
          },
          
        
      ],
      "language": {
        "lengthMenu": "Mostrar _MENU_ Registros del total de usuarios",
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
        url: 'listausuarios',
        method: 'POST',
    })
    .done(function(response){
      $datos = response.usuarios;
      $.each(response, function(index, value){
          llenar($datos, index, value);




 $('#myTable tbody').on( 'click', 'tr', function () {
        $(this).toggleClass('selected');
    }); 





$('#btnActualizar').click( function () {

datos();

     
    });



 $('#btnEliminar').click( function () {

        var tablas=$('#myTable').DataTable();
        if(tablas.rows('.selected').data().length == 0) {

            $msg = "No seleccione algún un elemento.";
          mensaje($msg, 'red');
          
          return;
        }  
        rows = tablas.rows('.selected').data();
        ids = "";
        $.each( rows, function( i, item ) {  
        console.log("i["+i+"] ID["+item.ID+"]");
        ids+=item.idAmbiente+",";
        
      }); 
  
          eliminaraula(ids);




    });

$('#btnNuevo').click( function() {

   var tablas=$('#myTable').DataTable();
if(tablas.rows('.selected').data().length >= 1) {
    $msg = "No debe estar seleccionado ningún elemento";
          mensaje($msg, 'red');
          return;
        } 

      idAmbiente = 0;
//      $("#txtRazonSocial").prop('disabled', false);
    $('#idPostulacion').val();
    $('#apepaterno').val();
    $('#apematerno').val();
    $('#nombre').val();
    $("[name=sexo]").val([]);
    $('#tipodocumento').val();
    $('#dni').val();
    $('#estadocivil').val();
    $('#fechanacimiento').val();
    $("[name=extranjero]").val([]);

     
        $('.extranjero').hide();    
        $('#iddepartamentonacimiento').val();
        $('#idprovincianacimiento').val();
        $('#iddistritonacimiento').val();
    
   
   // $('#ubigeoextrangeropais').val($usuarios.ubigeoextrangeropais);
    //$('#ubigeoextrangerodepartamento').val($usuarios.ubigeoextrangerodepartamento);
    //$('#ubigeoextrangeroprovincia').val($usuarios.ubigeoextrangeroprovincia);
    //$('#ubigeoextrangerodistrito').val($usuarios.ubigeoextrangerodistrito);
    
    $('#iduser').val();
    $('#via').val();
    $('#direccion').val();
    $('#numero').val();
    $('#telefono').val();
    $('#iddepartamentodirecion').val();
    $('#idprovinciadireccion').val();
    $('#iddistritodireccion').val();
    $('#email').val();
    $('#celular').val();
    $('#duenocelular').val();

    $('#rolusu').val();
      $('#myModalNuevo').modal('show');
    });





      });
    })
    .fail(function(response){
    }); 
}







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






function datos() {

   var tablas=$('#myTable').DataTable();



if(tablas.rows('.selected').data().length == 0 || tablas.rows('.selected').data().length > 1) {
    $msg = "Seleccione solo un elemento";
          mensaje($msg, 'red');
         $("#myModal").modal('hide');
          return;

        }        
    
    rows = tablas.rows('.selected').data();
    

    $.each( rows, function( i, item ) {  
       
        id= item.idUsuario;
        nombre= item.apellidos;
      }); 


    buscar(id,nombre);
}


function buscar($value,$nom) {
  

 if(!confirm("¿Desea editar el usuario "+$nom+"?"))
    return;
 


    $.ajax({
        data:{
            idUsuarios: $value
        },
        type: 'POST',
        url: $urlbase+'/usuarios',
        dataType: 'json',


 success: function(data) {

            cargarDatos(data);
            $('#myModal').modal('show');
        },
        error: function(data) {
           
            mensaje(data.message, "red");
        }

    });


}

function cargarDatos(data){

  $usuarios = data.usuario;
  $roles=data.rol;
  
 $('#idPostulacion').val($usuarios.id);
    $('#apepaterno').val($usuarios.apepaterno);
    $('#apematerno').val($usuarios.apematerno);
    $('#nombre').val($usuarios.nombre);
    $("[name=sexo]").val([$usuarios.sexo]);
    $('#tipodocumento').val($usuarios.tipodocumento);
    $('#dni').val($usuarios.dni);
    $('#estadocivil').val($usuarios.estadocivil);
    $('#fechanacimiento').val($usuarios.fechanacimiento);
    $("[name=extranjero]").val([$usuarios.extranjero]);

     if($usuarios.extranjero == 0)
    {
        $('.extranjero').hide();   
        $('.ubigeonacimiento').show();
        $('#iddepartamentonacimiento').val($usuarios.idubigeonacimiento.substr(0, 2)+"0000");
        $('#idprovincianacimiento').html(getProvinciaOptions($usuarios.idubigeonacimiento.substr(0, 2)+"0000", $usuarios.idubigeonacimiento.substr(0, 4)+"00"));
        $('#iddistritonacimiento').html(getDistritosOptions($usuarios.idubigeonacimiento.substr(0, 4)+"00", $usuarios.idubigeonacimiento));
    }
    else if($usuarios.extranjero == 1){ 
     $('.extranjero').show();
    $('.ubigeonacimiento').hide(); 
    $('#ubigeoextrangeropais').val($usuarios.ubigeoextrangeropais);
    $('#ubigeoextrangerodepartamento').val($usuarios.ubigeoextrangerodepartamento);
    $('#ubigeoextrangeroprovincia').val($usuarios.ubigeoextrangeroprovincia);
    $('#ubigeoextrangerodistrito').val($usuarios.ubigeoextrangerodistrito);
 
    }
    
    else{ 
     $('.extranjero').hide();
     $('.ubigeonacimiento').show();
     $('.ubigeonacimiento').hide(); 
     $('#iddepartamentonacimiento').val();
     $('#idprovincianacimiento').val();
     $('#iddistritonacimiento').val();
 
    }




     
   


    if($usuarios.foto != null){
        var num = Math.random();
        var imgSrc= $usuarios.foto+"?v="+num;
        $('#foto').prop('src', $urlbase+'/'+imgSrc);
        $('#img-input').prop('src', $urlbase+'/'+imgSrc);
    }



    $('#iduser').val($usuarios.id);
    $('#via').val($usuarios.via);
    $('#direccion').val($usuarios.direccion);
    $('#numero').val($usuarios.numero);
    $('#telefono').val($usuarios.telefono);
    $('#iddepartamentodirecion').val($usuarios.idubigeodireccion.substr(0, 2)+"0000");
    $('#idprovinciadireccion').html(getProvinciaOptions($usuarios.idubigeodireccion.substr(0, 2)+"0000", $usuarios.idubigeodireccion.substr(0, 4)+"00"));
    $('#iddistritodireccion').html(getDistritosOptions($usuarios.idubigeodireccion.substr(0, 4)+"00", $usuarios.idubigeodireccion));
    $('#email').val($usuarios.email);
    $('#celular').val($usuarios.celular);
    $('#duenocelular').val($usuarios.duenocelular);

    $('#rolusu').val($roles.idrol);
    
  
}


$("#formEd").submit(function(event) {
  event.preventDefault();
  $.ajax({
      url:  $urlbase+'/actualizarU',
      method: 'POST',
      data: $(this).serialize(),
      success: function(data) {
        if(data.success){
          mensaje(data.message, "green")
          consultar();
        window.location.reload();
          $("#myModal").modal('toggle');
          $("#formEd")[0].reset();
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



