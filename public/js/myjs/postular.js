// Importar documentos
$urlbase = $("body").attr('urlbase');
document.write("<script type='text/javascript' src='"+$urlbase+"/js/myjs/ubigeo.js'></script>");

$cboTipoDocumento = $('#tipodocumento');
$rbExtranjero = $('.rbextrangero');
$chkColegioEctrangero = $('#colegioextranjero');
$btnGuardar = $("#btnGuardar");
// Ubigeo Nacimiento
$cboDepartamentoNacimiento = $('#iddepartamentonacimiento');
$cboProvinciaNacimiento = $('#idprovincianacimiento');
$cboDistritoNacimiento = $('#iddistritonacimiento');
//Ubigeo Direccion
$cboDepartamentoDireccion = $('#iddepartamentodirecion');
$cboProvinciaDireccion = $('#idprovinciadireccion');
$cboDistritoDireccion = $('#iddistritodireccion');
// Foto
$inputfoto = $("#inputfoto");
$imgfoto = $("#imgfoto");
$fileinput = $("#image");
$imginput =$("#img-input");
$frmFoto = $("#form-foto");
$imgtarget = "";
//Ubigeo IE
$cboDepartamentoIe = $('#iddepartamentocolegio');
$cboProvinciaIe = $('#idprovinciacolegio');
$cboDistritoIe = $('#iddistritocolegio');
$cboIe = $('#idinstitucioneducativa');
$txtnombreie = $('#nombreie');
$chkotrainstitucion = $('#isotrainstitucion');
$txtotrainstitucion = $('#otrainstitucion');
$isidinstitucioneducativa = $('#isidinstitucioneducativa');
$txtdocumento = $('#dni');

$cboTipoDocumento.change(function(){
	if($cboTipoDocumento.val() == 0)
		$txtdocumento.val("").prop('disabled', true);
	else
		$txtdocumento.prop('disabled', false);
});
$rbExtranjero.change(function() {
	
	if($("#extranjerosi").is(':checked')){
		$('.extranjero').show();
		$('.ubigeonacimiento').hide();
	}
	else{
		$('.extranjero').hide();
		$('.ubigeonacimiento').show();
	}
	var height = $("#step-1").outerHeight();
	$(".stepContainer").height(height + 20);
});
$chkColegioEctrangero.change(function() {
	if($chkColegioEctrangero.is(':checked')){
		$('.colegiooubigeo').hide();
		$('.colegioextranjero').show();
		$('#tipocolegio').show();
		$isidinstitucioneducativa.prop('checked', false);
		$chkotrainstitucion.prop('checked', false);
	}
	else{
		$('.colegiooubigeo').show();
		$('.colegioextranjero').hide();
		$('#tipocolegio').hide();
		$cboIe.show();
		$txtotrainstitucion.hide();
		$isidinstitucioneducativa.prop('checked', true);
	}
	var height = $("#step-1").outerHeight();
	$(".stepContainer").height(height + 20);
	$txtnombreie.val('');
	//$chkotrainstitucion.change();
});
$chkotrainstitucion.change(function() {
	if($chkotrainstitucion.is(':checked')){
		$cboIe.hide();
		$txtotrainstitucion.show();
		$('#tipocolegio').show();
		$txtotrainstitucion.focus();
		$('#idinstitucioneducativa').val(0);
		$isidinstitucioneducativa.prop('checked', false);
	}
	else{
		$cboIe.show();
		$txtotrainstitucion.hide();
		$('#tipocolegio').hide();
		$isidinstitucioneducativa.prop('checked', true);
	}
	$txtotrainstitucion.val('');
});

$cboDepartamentoNacimiento.change(function() {
	if($cboDepartamentoNacimiento.val() == 0){
		$cboProvinciaNacimiento.html($optionSelecciona).prop('disabled', true);
		$cboDistritoNacimiento.html($optionSelecciona).prop('disabled', true);
	}
	else{
		$cboProvinciaNacimiento.html(getProvinciaOptions($cboDepartamentoNacimiento.val())).prop('disabled', false);
		$cboDistritoNacimiento.html(getDistritosOptions()).prop('disabled', true);
	}
});
$cboProvinciaNacimiento.change(function() {
	if($cboProvinciaNacimiento.val() == 0)
		$cboDistritoNacimiento.html($optionSelecciona).prop('disabled', true);
	else
		$cboDistritoNacimiento.html(getDistritosOptions($cboProvinciaNacimiento.val())).prop('disabled', false);
});
$cboDepartamentoDireccion.change(function() {
	if($cboDepartamentoDireccion.val() == 0){
		$cboProvinciaDireccion.html($optionSelecciona).prop('disabled', true);
		$cboDistritoDireccion.html($optionSelecciona).prop('disabled', true);
	}
	else{
		$cboProvinciaDireccion.html(getProvinciaOptions($cboDepartamentoDireccion.val())).prop('disabled', false);
		$cboDistritoDireccion.html(getDistritosOptions()).prop('disabled', true);
	}
});
$cboProvinciaDireccion.change(function() {
	if($cboProvinciaDireccion.val() == 0)
		$cboDistritoDireccion.html($optionSelecciona).prop('disabled', true);
	else
		$cboDistritoDireccion.html(getDistritosOptions($cboProvinciaDireccion.val())).prop('disabled', false);
});
$cboDepartamentoIe.change(function() {
	if($cboDepartamentoIe.val() == 0){
		$cboProvinciaIe.html($optionSelecciona).prop('disabled', true);
		$cboDistritoIe.html($optionSelecciona).prop('disabled', true);
		$cboIe.html($optionSelecciona).prop('disabled', true);
	}
	else{
		$cboProvinciaIe.html(getProvinciaOptions($cboDepartamentoIe.val())).prop('disabled',false);
		$cboDistritoIe.html(getDistritosOptions()).prop('disabled', true);
	}
});
$cboProvinciaIe.change(function() {
	if($cboProvinciaIe.val() == 0){
		$cboDistritoIe.html($optionSelecciona).prop('disabled', true);
		$cboIe.html($optionSelecciona).prop('disabled', true);
	}
	else
		$cboDistritoIe.html(getDistritosOptions($cboProvinciaIe.val())).prop('disabled', false);
});
$cboDistritoIe.change(function() {
	if($cboDistritoIe.val() == 0)
		$cboIe.html($optionSelecciona).prop('disabled', true);
	else
		$cboIe.html(getIeOptions($cboDistritoIe.val())).prop('disabled', false);
});

$inputfoto.change(function() {
	if(this.files && this.files[0]){
		var reader = new FileReader();
	    reader.onload = function (e) {
	        $imgfoto.attr('src', e.target.result);
	    }
	    reader.readAsDataURL(this.files[0]);
	}
	else{
		 $imgfoto.attr('src', $urlbase + '/images/user.png');
	}
	/**/
});

$fileinput.change(function() {
      if (this.files && this.files[0]) {
        $btnGuardar.prop('disabled', false);
        var reader = new FileReader();
        
        reader.onload = function (e) {
          $imgtarget = e.target.result;
          $imginput.attr('src', e.target.result);
        }
        reader.readAsDataURL(this.files[0]);
      }
      else{
        $imginput.attr('src', "{{ asset('images/user.png') }}");
        $btnGuardar.prop('disabled', true);
      }
});
$frmFoto.on("submit", function(e){
  e.preventDefault();
  var formData = new FormData(document.getElementById("form-foto"));
  $msg ="";
  $.ajax({
    url: $urlbase + '/'+'user/foto',
    type: "post",
    dataType: "html",
    data: formData,
    cache: false,
    contentType: false,
    processData: false,
    success: function(data) {
      mensaje("Imagen guardada correctamente.", "green");
      $("#img-btn img").attr("src", $imgtarget);
      //$("#img-btn").click();
      $('#mymodal').modal('hide');
    },
      error: function(data) {
        //  $result.success = false;
      if(data.status == "422"){
        $msg = "El archivo seleccionado debe ser una imagen y estar en el formato .jpg";
      }
      else{
        $msg  = "No se pudo guardar.<br> Inténtelo de nuevo más tarde.";
      }
      mensaje($msg, "red");
    }

  });
});

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