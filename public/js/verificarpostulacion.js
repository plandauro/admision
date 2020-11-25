$urlbase = $("body").attr('urlbase');
$encontrado = $('#encontrado');
$principal = $('#principal');
$loading =  $('#loading');
$message = $('#message')
$txtbuscar = $('#txtbuscarpostulante');
$frmVerificar =$('#frm-verificar');
$verificado = $('#verificado');

$txtbuscar.keypress(function(e) {
	if(e.which == 13) {
       buscar($txtbuscar.val());
    }
});

function buscar($value) {
	if($value.toString().trim().length < 1) return;
	$encontrado.hide();
	$verificado.hide();
	$.ajax({
        type: 'POST',
        url: $urlbase+'/getpostulacion',
        data: {
        	codigo: $value,
        },
        dataType: 'json',
        beforeSend: function() {
        	$loading.show();
        	$principal.hide();
        },
        success: function(data) {
        	$txtbuscar.val("");
        	if(!data.success){
        		$loading.hide();
        		$principal.show();
        		$message.text(data.message);
        		return;
        	}
        	if(data.postulacion.estado == 2){
        		$verificado.show();
        		$loading.hide();
        		var num = Math.random();
				var imgSrc= data.postulante.foto+"?v="+num;
		    	$("#v-imgPostulante").prop('src', imgSrc);
		    	$htmlPostulante = data.postulante.nombre+" "+data.postulante.apepaterno+" "+data.postulante.apematerno+ 
    				"<br><small>Postulación Verificada: <strong>"+pad(data.postulacion.id, 6)+"</strong></small></h1>"+
                      "<p style='margin-left: 20px'>El postulante debe imprimir su carnet de postulación volviendo a ingresar después de la verificación.</p>";
                      
                if(data.iscoordinador == 1)
                	$htmlPostulante += "<p style='margin: 0px 0px 20px 20px;'>"+
                        "<button onclick='editar("+data.postulacion.id+")' class='btn btn-primary btn-xs'> <span class='fa fa-pencil'></span> Editar</button>"+
                      "</p>";

		    	$("#v-datos").html($htmlPostulante);
		    	return;
        	}

        	cargarDatos(data);
        	$loading.hide();
        	$encontrado.show();
        },
        error: function(data) {
        	$loading.hide();
        	$message.text("Sucedió un error. Intentalo nuevamente.");
        }
    });
}

function cargarDatos(data){
	$postulacion = data.postulacion;
	$postulante = data.postulante;
	//-----------------------------
	$('#idPostulacion').val($postulacion.id);
	$('#apepaterno').val($postulante.apepaterno);
	$('#apematerno').val($postulante.apematerno);
	$('#nombre').val($postulante.nombre);
	$("[name=sexo]").val([$postulante.sexo]);
	$('#tipodocumento').val($postulante.tipodocumento);
	$('#dni').val($postulante.dni);
	$('#estadocivil').val($postulante.estadocivil);
	$('#fechanacimiento').val($postulante.fechanacimiento);
	$("[name=extranjero]").val([$postulante.extranjero]);
	if(!$postulante.extranjero)
	{
		$('.extranjero').hide();
        $('.ubigeonacimiento').show();
		$('#iddepartamentonacimiento').val($postulante.idubigeonacimiento.substr(0, 2)+"0000");
		$('#idprovincianacimiento').html(getProvinciaOptions($postulante.idubigeonacimiento.substr(0, 2)+"0000", $postulante.idubigeonacimiento.substr(0, 4)+"00"));
		$('#iddistritonacimiento').html(getDistritosOptions($postulante.idubigeonacimiento.substr(0, 4)+"00", $postulante.idubigeonacimiento));
	}
	else $('.ubigeonacimiento').hide();
    $('#ubigeoextrangeropais').val($postulante.ubigeoextrangeropais);
    $('#ubigeoextrangerodepartamento').val($postulante.ubigeoextrangerodepartamento);
    $('#ubigeoextrangeroprovincia').val($postulante.ubigeoextrangeroprovincia);
    $('#ubigeoextrangerodistrito').val($postulante.ubigeoextrangerodistrito);

	if($postulante.foto != null){
		var num = Math.random();
		var imgSrc= $postulante.foto+"?v="+num;
		$('#foto').prop('src', $urlbase+'/'+imgSrc);
		$('#img-input').prop('src', $urlbase+'/'+imgSrc);
	}
	$('#iduser').val($postulante.id);
	$('#via').val($postulante.via);
	$('#direccion').val($postulante.direccion);
	$('#numero').val($postulante.numero);
	$('#telefono').val($postulante.telefono);
	$('#iddepartamentodirecion').val($postulante.idubigeodireccion.substr(0, 2)+"0000");
	$('#idprovinciadireccion').html(getProvinciaOptions($postulante.idubigeodireccion.substr(0, 2)+"0000", $postulante.idubigeodireccion.substr(0, 4)+"00"));
	$('#iddistritodireccion').html(getDistritosOptions($postulante.idubigeodireccion.substr(0, 4)+"00", $postulante.idubigeodireccion));
	$('#email').val($postulante.email);
	$('#celular').val($postulante.celular);
	$('#duenocelular').val($postulante.duenocelular);
	$('#padre').val($postulante.padre);
	$('#madre').val($postulante.madre);
	if($postulante.colegioextranjero == 1) {
		$chkColegioEctrangero.prop('checked', true);
		$('.colegiooubigeo').hide();
		$txtnombreie.val($postulante.nombreie);
		$("[name=estatal]").val([$postulante.estatal]);
	}
	else {
		$('#iddepartamentocolegio').val($postulante.idubigeocolegio.substr(0, 2)+"0000");
		$('#idprovinciacolegio').html(getProvinciaOptions($postulante.idubigeocolegio.substr(0, 2)+"0000", $postulante.idubigeocolegio.substr(0, 4)+"00"));
		$('#idprovinciacolegio').prop('disabled', false);
		$('#iddistritocolegio').html(getDistritosOptions($postulante.idubigeocolegio.substr(0, 4)+"00", $postulante.idubigeocolegio));
		$('#iddistritocolegio').prop('disabled', false);
		$('.colegioextranjero').hide();
		if($postulante.isotrainstitucion == 1){
			$chkotrainstitucion.prop('checked', true);
			$cboIe.hide();
			$txtotrainstitucion.focus();
			$("[name=estatal]").val([$postulante.estatal]);
			$txtotrainstitucion.val($postulante.nombreie);
		}
		else{
			$('#idinstitucioneducativa').html(getIeOptions($postulante.idubigeocolegio, $postulante.idinstitucioneducativa));
			$('#idinstitucioneducativa').prop('disabled', false);
			$isidinstitucioneducativa.prop('checked', true);
			$txtotrainstitucion.hide();
			$('#tipocolegio').hide();
			$chkotrainstitucion.prop('disabled', false);
		}
	}
	$('#anotermino').val($postulante.anotermino);
	$('#idtarifa').val($postulacion.idtarifa);
	$('#idescuela').val($postulacion.idescuela);
	$('#numerooperacion').val($postulacion.numerooperacion);
}

function editar($idPostulacion){
	$.ajax({
		data:{
			idPostulacion: $idPostulacion
		},
		type: 'POST',
		url: $urlbase+'/editar',
		dataType: 'json',
		success: function(data) {
			if(data.success){
				mensaje(data.message, "green");
				buscar($idPostulacion);
			}
			else{
				mensaje(data.message, "red");
			}

		}
	});
}

$frmVerificar.on("submit", function(e) {
	e.preventDefault();
	$.ajax({
	    url: $urlbase + '/'+'verificar',
	    type: "post",
	    dataType: 'json',
	    data: $frmVerificar.serialize(),
	    success: function(data) {
	    	buscar($('#idPostulacion').val());
	    	document.getElementById("frm-verificar").reset();
	    },
	    error: function(data) {
	    }

  	});
  	window.scrollTo(0,0);
});

function pad (n, length) {
    var  n = n.toString();
    while(n.length < length)
         n = "0" + n;
    return n;
}