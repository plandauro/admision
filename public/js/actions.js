// 1
$("#selectTipoVivienda").change(function() {
	if($('select#selectTipoVivienda').val()==8){
	  $('#txtTipoVivienda').prop('disabled', false);
	  $('#txtTipoVivienda').focus();
	}
	else{
	  $('#txtTipoVivienda').prop('disabled', true);
	  $('#txtTipoVivienda').val('');
	}
});
//2
$("#selectSuViviendaEs").change(function() {
	if($('select#selectSuViviendaEs').val()==7){
      $('#txtSuViviendaEs').prop('disabled', false);
      $('#txtSuViviendaEs').focus();
    }
    else{
      $('#txtSuViviendaEs').prop('disabled', true);
      $('#txtSuViviendaEs').val('');
   	}; 
});
//3
$("#selectMaterialPredominantePared").change(function() {
	if($('select#selectMaterialPredominantePared').val()==8){
      $('#txtMaterialPredominantePared').prop('disabled', false);
      $('#txtMaterialPredominantePared').focus();
    }
    else{
      $('#txtMaterialPredominantePared').prop('disabled', true);
      $('#txtMaterialPredominantePared').val('');
    };
});
//4
$("#selectMaterialPredominanteTecho").change(function() {
	if($('select#selectMaterialPredominanteTecho').val()==8){
      $('#txtMaterialPredominanteTecho').prop('disabled', false);
      $('#txtMaterialPredominanteTecho').focus();
    }
    else{
      $('#txtMaterialPredominanteTecho').prop('disabled', true);
      $('#txtMaterialPredominanteTecho').val('');
    };
});
//5
$("#selectMaterialPredominantePisos").change(function() {
	if($('select#selectMaterialPredominantePisos').val()==7){
      $('#txtMaterialPredominantePisos').prop('disabled', false);
      $('#txtMaterialPredominantePisos').focus();
    }
    else{
      $('#txtMaterialPredominantePisos').prop('disabled', true);
      $('#txtMaterialPredominantePisos').val('');
    };
});
//6
$("#selectTipoAlumbrado").change(function() {
	if($('select#selectTipoAlumbrado').val()==5){
      $('#txtTipoAlumbrado').prop('disabled', false);
      $('#txtTipoAlumbrado').focus();
    }
    else{
      $('#txtTipoAlumbrado').prop('disabled', true);
      $('#txtTipoAlumbrado').val('');
    };
});
//7
$("#selectAbastecimientoAgua").change(function() {
	if($('select#selectAbastecimientoAgua').val()==7){
      $('#txtAbastecimientoAgua').prop('disabled', false);
      $('#txtAbastecimientoAgua').focus();
    }
    else{
      $('#txtAbastecimientoAgua').prop('disabled', true);
      $('#txtAbastecimientoAgua').val('');
    };
});

//8
$("#selectCombustibleMasUsado").change(function() {
	if($('select#selectCombustibleMasUsado').val()==7){
      $('#txtCombustibleMasUsado').prop('disabled', false);
      $('#txtCombustibleMasUsado').focus();
    }
    else{
      $('#txtCombustibleMasUsado').prop('disabled', true);
      $('#txtCombustibleMasUsado').val('');
    };
});

$("#numberHorasDemoraLlegar").on('input', function() {
	if($(this).val() > 24)
		$(this).val(24);
	else if($(this).val() < 0)
		$(this).val(0);
});

$('input[name="radioHorasDemoraLlegar"]:radio').click(function() {
	$("#numberHorasDemoraLlegar").val("");
	$("#numberHorasDemoraLlegar").prop('disabled', true);
	$("#btnHorasDemoraLlegar").show();
});
$("#btnHorasDemoraLlegar").click(function() {
	$("#numberHorasDemoraLlegar").prop('disabled', false);
	$("#numberHorasDemoraLlegar").focus();
	$("#btnHorasDemoraLlegar").hide();
	$('input[name="radioHorasDemoraLlegar"]:radio').prop('checked', false);
});