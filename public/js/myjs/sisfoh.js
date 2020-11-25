// Elementos input
$selectDepartamento = $("#selectDepartamento");
$selectProvincia = $("#selectProvincia");
$selectDistrito = $("#selectDistrito");
// Asignación de eventos
$selectDepartamento.bind("change", cargarProvincias);
$selectProvincia.bind("change", cargarDistritos);
$pasa4 = false;

// Funciones de eventos
function cargarProvincias(){
	$iddepartamento = $selectDepartamento.val();
	if ($iddepartamento != 0) {
		habilitarCombosUbigeo();
		$.ajax({
	    	type: "GET",
		    dataType: 'json',
		    url: $urlbase+'/provincias/'+$iddepartamento,
		    success: function(datos) {
		    			$html ="<option value='0'>(Selecciona)</option>";
		                for(var i in datos.provincias) {
		                  	$html +="<option value='"+datos.provincias[i].idprov+"'>"+datos.provincias[i].provincia+"</option>";
		                }
		                $selectProvincia.html($html);
		             },
		});
	}else {
		$selectProvincia.html("<option value='0'>(Selecciona)</option>").prop( "disabled", true);
		$selectDistrito.html("<option value='0'>(Selecciona)</option>").prop( "disabled", true);
	}
}
function cargarDistritos() {
	$idprovincia = $selectProvincia.val();
	
	if ($idprovincia != 0) {
		habilitarCombosUbigeo();
		$.ajax({
	    	type: "GET",
		    dataType: 'json',
		    url: $urlbase+'/distritos/'+$idprovincia,
		    success: function(datos) {
		    			$html ="<option value='0'>(Selecciona)</option>";
		                for(var i in datos.distritos) {
		                  	$html +="<option value='"+datos.distritos[i].iddist+"'>"+datos.distritos[i].distrito+"</option>";
		                }
		                $selectDistrito.html($html);
		             },
		});
	}else $selectDistrito.html("<option value='0'>(Selecciona)</option>").prop( "disabled", true);
}
// Funciones adicionales
function habilitarCombosUbigeo() {
	$iddepartamento = $selectDepartamento.val();
	if($iddepartamento == 0){
		$selectProvincia.prop( "disabled", true);
		$selectDistrito.prop( "disabled", true);
	}
	else{
		$selectProvincia.prop( "disabled", false);
		$idprovincia = $selectProvincia.val();
		if($idprovincia == 0){
			$selectDistrito.prop( "disabled", true);
		}
		else{
			$selectDistrito.prop( "disabled", false);
		}
	}
}
function btnNextClick($step){
	event.preventDefault();
	$form = $("#formstep"+($step+1));
	$result = {
		success: false,
		message: ""
	};
	$.ajax({
		async:false, 
        type: 'POST',
        url: $form.attr('action'),
        data: $form.serialize(),
        dataType: 'json',
        success: function(data) {
        	$result.success = true;
        	$result.message = data.message;
            console.log(data);
        },
        error: function(data) {
        	$result.success = false;
        	if(data.status == "422"){
        		if($step == 0) $result.message = pinterrors_Step1(data);
				if($step == 1) $result.message = pinterrors_Step2(data);
				if($step == 2) $result.message = pinterrors_Step3(data);
				if($step == 3) $result.message = pinterrors_Step4(data);
        	}
        	else{
        		$result.message = "No se pudo guardar.<br> Inténtelo de nuevo más tarde.";
        	}
        }
    });
    return $result;
}
function pinterrors_Step1(data){
	$msg ="";
	if(data.responseJSON.iddepartamento != undefined){
	    	$msg += "• "+data.responseJSON.iddepartamento +"<br>";
	    	$("#selectDepartamento").addClass("parsley-error");
	}else 	$("#selectDepartamento").removeClass("parsley-error");
	if(data.responseJSON.idprovincia != undefined){
	    	$msg += "• "+data.responseJSON.idprovincia +"<br>";
	    	$("#selectProvincia").addClass("parsley-error");
	}else 	$("#selectProvincia").removeClass("parsley-error");
	if(data.responseJSON.iddistrito != undefined){
	    	$msg += "• "+data.responseJSON.iddistrito +"<br>";
	    	$("#selectDistrito").addClass("parsley-error");
	}else 	$("#selectDistrito").removeClass("parsley-error");
    if(data.responseJSON.centropoblado != undefined){
        	$msg +="• "+ data.responseJSON.centropoblado +"<br>";
	    	$("#centropoblado").addClass("parsley-error");
	}else 	$("#centropoblado").removeClass("parsley-error");
    if(data.responseJSON.tipovia != undefined){
        	$msg +="• "+ data.responseJSON.tipovia +"<br>";
	    	$("#tipovia").addClass("parsley-error");
	}else 	$("#tipovia").removeClass("parsley-error");
    if(data.responseJSON.nombrevia != undefined){
        	$msg +="• "+ data.responseJSON.nombrevia +"<br>";
	    	$("#nombrevia").addClass("parsley-error");
	}else 	$("#nombrevia").removeClass("parsley-error");
    return $msg;
}
function pinterrors_Step2(data){
	$msg="";
	if(data.responseJSON.tipovivienda != undefined){
	    	$msg +="• "+ data.responseJSON.tipovivienda +"<br>";
	    	$("#selectTipoVivienda").addClass("parsley-error");
	}else 	$("#selectTipoVivienda").removeClass("parsley-error");

	if(data.responseJSON.tipoviviendaotro != undefined){
	    	$msg +="• "+ data.responseJSON.tipoviviendaotro +"<br>";
	    	$("#txtTipoVivienda").addClass("parsley-error");
	}else 	$("#txtTipoVivienda").removeClass("parsley-error");

    if(data.responseJSON.suviviendaes != undefined){
    		$msg +="• "+ data.responseJSON.suviviendaes +"<br>";
    		$("#selectSuViviendaEs").addClass("parsley-error");
    }else 	$("#selectSuViviendaEs").removeClass("parsley-error");
    if(data.responseJSON.suviviendaesotro != undefined){
        	$msg +="• "+ data.responseJSON.suviviendaesotro +"<br>";
        	$("#txtSuViviendaEs").addClass("parsley-error");
    }else 	$("#txtSuViviendaEs").removeClass("parsley-error");

    if(data.responseJSON.materialparedes != undefined){
        	$msg +="• "+ data.responseJSON.materialparedes +"<br>";
        	$("#selectMaterialPredominantePared").addClass("parsley-error");
   	}else 	$("#selectMaterialPredominantePared").removeClass("parsley-error");
    if(data.responseJSON.materialparedesotro != undefined){
        	$msg +="• "+ data.responseJSON.materialparedesotro +"<br>";
        	$("#txtMaterialPredominantePared").addClass("parsley-error");
    }else 	$("#txtMaterialPredominantePared").removeClass("parsley-error");

    if(data.responseJSON.materialtecho != undefined){
        	$msg +="• "+ data.responseJSON.materialtecho +"<br>";
        	$("#selectMaterialPredominanteTecho").addClass("parsley-error");
    }else 	$("#selectMaterialPredominanteTecho").removeClass("parsley-error");
    if(data.responseJSON.materialtechootro != undefined){
        	$msg +="• "+ data.responseJSON.materialtechootro +"<br>";
        	$("#txtMaterialPredominanteTecho").addClass("parsley-error");
    }else 	$("#txtMaterialPredominanteTecho").removeClass("parsley-error");

     if(data.responseJSON.materialpiso != undefined){
     	$msg +="• "+ data.responseJSON.materialpiso +"<br>";
     	$("#selectMaterialPredominantePisos").addClass("parsley-error");
    }else 	$("#selectMaterialPredominantePisos").removeClass("parsley-error");
    if(data.responseJSON.materialpisootro != undefined){
        	$msg +="• "+ data.responseJSON.materialpisootro +"<br>";
        	$("#txtMaterialPredominantePisos").addClass("parsley-error");
    }else 	$("#txtMaterialPredominantePisos").removeClass("parsley-error");

    if(data.responseJSON.tipoalumrado != undefined){
        	$msg +="• "+ data.responseJSON.tipoalumrado +"<br>";
        	$("#selectTipoAlumbrado").addClass("parsley-error");
    }else 	$("#selectTipoAlumbrado").removeClass("parsley-error");
    if(data.responseJSON.tipoalumradootro != undefined){
        	$msg +="• "+ data.responseJSON.tipoalumradootro +"<br>";
        	$("#txtTipoAlumbrado").addClass("parsley-error");
    }else 	$("#txtTipoAlumbrado").removeClass("parsley-error");

    if(data.responseJSON.abastecimientoagua != undefined){
        	$msg +="• "+ data.responseJSON.abastecimientoagua +"<br>";
        	$("#selectAbastecimientoAgua").addClass("parsley-error");
    }else 	$("#selectAbastecimientoAgua").removeClass("parsley-error");
	if(data.responseJSON.abastecimientoaguaotro != undefined){
	    	$msg += "• "+data.responseJSON.abastecimientoaguaotro +"<br>";
	    	$("#txtAbastecimientoAgua").addClass("parsley-error");
    }else 	$("#txtAbastecimientoAgua").removeClass("parsley-error");

    if(data.responseJSON.serviciohigienico != undefined){
        	$msg += "• "+data.responseJSON.serviciohigienico +"<br>";
        	$("#selectServicioHigienico").addClass("parsley-error");
    }else 	$("#selectServicioHigienico").removeClass("parsley-error");
    if(data.responseJSON.numberHorasDemoraLlegar != undefined){
        	$msg += "• "+data.responseJSON.numberHorasDemoraLlegar +"<br>";
        	$("#numberHorasDemoraLlegar").addClass("parsley-error");
    }else 	$("#numberHorasDemoraLlegar").removeClass("parsley-error");
    if(data.responseJSON.radioHorasDemoraLlegar != undefined){
        	$msg += "• "+data.responseJSON.radioHorasDemoraLlegar +"<br>";
        	$("#radioHorasDemoraLlegar").addClass("parsley-error");
    }else 	$("#radioHorasDemoraLlegar").removeClass("parsley-error");
	return $msg;
}
function pinterrors_Step3(data){
	$msg="";
	if(data.responseJSON.cantidadhabitaciones != undefined){
        	$msg += "• "+data.responseJSON.cantidadhabitaciones +"<br>";
        	$("#cantidadhabitaciones").addClass("parsley-error");
    }else 	$("#cantidadhabitaciones").removeClass("parsley-error");

    if(data.responseJSON.combustible != undefined){
        	$msg += "• "+data.responseJSON.combustible +"<br>";
        	$("#combustible").addClass("parsley-error");
    }else 	$("#combustible").removeClass("parsley-error");

    if(data.responseJSON.totalpersonas != undefined){
        	$msg += "• "+data.responseJSON.totalpersonas +"<br>";
        	$("#totalpersonas").addClass("parsley-error");
    }else 	$("#totalpersonas").removeClass("parsley-error");

    if(data.responseJSON.cantidadmujeres != undefined){
        	$msg += "• "+data.responseJSON.cantidadmujeres +"<br>";
        	$("#cantidadmujeres").addClass("parsley-error");
    }else 	$("#cantidadmujeres").removeClass("parsley-error");

    if(data.responseJSON.cantidadhombres != undefined){
        	$msg += "• "+data.responseJSON.cantidadhombres +"<br>";
        	$("#cantidadhombres").addClass("parsley-error");
    }else 	$("#cantidadhombres").removeClass("parsley-error");

    if(data.responseJSON.combustibleotro != undefined){
        	$msg += "• "+data.responseJSON.combustibleotro +"<br>";
        	$("#combustibleotro").addClass("parsley-error");
    }else 	$("#combustibleotro").removeClass("parsley-error");
	return $msg;
}
function pinterrors_Step4(data) {
	$msg ="";
	if(!data.responseJSON.success){
		$msg += data.responseJSON.message;
	}
	return $msg;
}
function printerrors_Poblacion(data) {
	$msg="";
	if(data.responseJSON.apematerno != undefined){
        	$msg += "• "+data.responseJSON.apematerno +"<br>";
        	$("#apematerno").addClass("parsley-error");
    }else 	$("#apematerno").removeClass("parsley-error");

    if(data.responseJSON.apepaterno != undefined){
        	$msg += "• "+data.responseJSON.apepaterno +"<br>";
        	$("#apepaterno").addClass("parsley-error");
    }else 	$("#apepaterno").removeClass("parsley-error");

    if(data.responseJSON.estadocivil != undefined){
        	$msg += "• "+data.responseJSON.estadocivil +"<br>";
        	$("#estadocivil").addClass("parsley-error");
    }else 	$("#estadocivil").removeClass("parsley-error");

    if(data.responseJSON.fechanacimiento != undefined){
        	$msg += "• "+data.responseJSON.fechanacimiento +"<br>";
        	$("#fechanacimiento").addClass("parsley-error");
    }else 	$("#fechanacimiento").removeClass("parsley-error");

    if(data.responseJSON.idiomaninez != undefined){
        	$msg += "• "+data.responseJSON.idiomaninez +"<br>";
        	$("#idiomaninez").addClass("parsley-error");
    }else 	$("#idiomaninez").removeClass("parsley-error");

    if(data.responseJSON.niveleducativo != undefined){
        	$msg += "• "+data.responseJSON.niveleducativo +"<br>";
        	$("#niveleducativo").addClass("parsley-error");
    }else 	$("#niveleducativo").removeClass("parsley-error");

    if(data.responseJSON.nombres != undefined){
        	$msg += "• "+data.responseJSON.nombres +"<br>";
        	$("#nombres").addClass("parsley-error");
    }else 	$("#nombres").removeClass("parsley-error");

    if(data.responseJSON.numerodocumento != undefined){
        	$msg += "• "+data.responseJSON.numerodocumento +"<br>";
        	$("#numerodocumento").addClass("parsley-error");
    }else 	$("#numerodocumento").removeClass("parsley-error");

    if(data.responseJSON.ocupacionultimomes != undefined){
        	$msg += "• "+data.responseJSON.ocupacionultimomes +"<br>";
        	$("#ocupacionultimomes").addClass("parsley-error");
    }else 	$("#ocupacionultimomes").removeClass("parsley-error");

    if(data.responseJSON.parentescojefe != undefined){
        	$msg += "• "+data.responseJSON.parentescojefe +"<br>";
        	$("#parentescojefe").addClass("parsley-error");
    }else 	$("#parentescojefe").removeClass("parsley-error");

    if(data.responseJSON.sabeleer != undefined){
        	$msg += "• "+data.responseJSON.sabeleer +"<br>";
        	$("#sabeleer").addClass("parsley-error");
    }else 	$("#sabeleer").removeClass("parsley-error");

    if(data.responseJSON.sector != undefined){
        	$msg += "• "+data.responseJSON.sector +"<br>";
        	$("#sector").addClass("parsley-error");
    }else 	$("#sector").removeClass("parsley-error");

    if(data.responseJSON.sexo != undefined){
        	$msg += "• "+data.responseJSON.sexo +"<br>";
        	$("#sexo").addClass("parsley-error");
    }else 	$("#sexo").removeClass("parsley-error");

    if(data.responseJSON.tipodocumento != undefined){
        	$msg += "• "+data.responseJSON.tipodocumento +"<br>";
        	$("#tipodocumento").addClass("parsley-error");
    }else 	$("#tipodocumento").removeClass("parsley-error");

    if(data.responseJSON.ultimogrado != undefined){
        	$msg += "• "+data.responseJSON.ultimogrado +"<br>";
        	$("#ultimogrado").addClass("parsley-error");
    }else 	$("#ultimogrado").removeClass("parsley-error");
    return $msg;
}
function continuar4(option) {
	if(option == 1){
		nuevoPoblacion();
		$('#myModal').modal('toggle');
	}
	else{
		$pasa4 = true;
		$(".buttonNext").trigger('click');
	}
}
function redimencionarContenedor(){
	var height = $("#panelPoblacion").outerHeight();
	$(".stepContainer").height(height + 20);
}
// Gestion de población
function loadPoblacion(){
	$.ajax({
		async:false, 
        type: 'GET',
        url: $("body").attr("urlbase")+"/poblacion/all",
        success: function(data) {
        	$html ="";

        	data.poblacion.forEach(function(persona, indice, array) {
        		$html += `<tr>
	                          <th scope="row">${(indice+1)}</th>
	                          <td>${persona.apepaterno}</td>
	                          <td>${persona.apematerno}</td>
	                          <td>${persona.nombres}</td>
	                          <td>${persona.numerodocumento}</td>
	                          <td>${persona.sexo}</td>`;
	            switch(persona.parentescojefe) {
				    case "1": $html += "<td>Jefe</td>"; break;
				    case "2": $html += "<td>Cónyugue</td>"; break;
				    case "3": $html += "<td>Hijo/a</td>"; break;
				    case "4": $html += "<td>Yerno/Nuera</td>"; break;
				    case "5": $html += "<td>Nieto/a</td>"; break;
				    case "6": $html += "<td>Padres/suegros</td>"; break;
				    case "7": $html += "<td>Hermano/a</td>"; break;
				    case "8": $html += "<td>Trabajador del hogar</td>"; break;
				    case "9": $html += "<td>Pensionista</td>"; break;
				    case "10": $html += "<td>Otros Parientes</td>"; break;
				    case "11": $html += "<td>Otros no Parientes</td>"; break;
				    default:
				        $html += "<td>(Vacio)</td>";
				}
	            $html +=      `<td>
	            				<a class="btn btn-primary btn-xs pull-right" 
	                            	data-toggle="modal"
	                            	data-target=".bs-example-modal-lg"
	                            	onclick="detailPoblacion('${persona.id}')">
	                            	<span class="fa fa-pencil"></span> 
	                            </a>`;
	            if(persona.informante != 1)
	            $html +=       `<a class="btn btn-danger btn-xs pull-right" 
	                            	onclick="deletePoblacion('${persona.id}')">
	                            	<span class="fa fa-trash"></span> 
	                            </a>
	                          </td>
	                        </tr>`;
        	});
	        $("#body-table-poblacion").html($html);
	        
        },
        error: function(data) {
        }
    });
    redimencionarContenedor();
}
function nuevoPoblacion() {
	document.getElementById("frmPoblacion").reset();
	$("#frmPoblacion :input").attr("readonly", false);
	$(".form-control").removeClass("parsley-error");
}
function detailPoblacion($idpersona) {
	nuevoPoblacion();
	$.ajax({
        type: 'GET',
        url: $("body").attr("urlbase")+"/poblacion/"+$idpersona,
        beforeSend: function(argument) {
        	loading(true);
        },
        success: function(data) {
        	$persona = data.persona;
        	$("#idpersona").val($persona.id);
        	$("#apepaterno").val($persona.apepaterno);
        	$("#apematerno").val($persona.apematerno);
        	$("#nombres").val($persona.nombres);
        	$("#fechanacimiento").val($persona.fechanacimiento);
        	$("#tipodocumento").val($persona.tipodocumento);
        	$("#numerodocumento").val($persona.numerodocumento);
        	$("#parentescojefe").val($persona.parentescojefe);
        	$("#estadocivil").val($persona.estadocivil);
        	$('input[name="sexo"][value="' + $persona.sexo + '"]').prop('checked', true);
        	if($persona.sexo == "F")
        	{
        		$(".inputgestante").prop('disabled', false);
        		$('input[name="gestante"][value="' + $persona.gestante + '"]').prop('checked', true);
        	}
        	else{
        		$(".inputgestante").prop('disabled', true);
        		$('input[name="gestante"][value="' + $persona.gestante + '"]').prop('checked', false);
        	}
        	$('#seguroessalud').prop('checked', $persona.seguroessalud == 1 ? true:false);
        	$('#segurofapnp').prop('checked', $persona.segurofapnp == 1 ? true:false);
        	$('#seguroprivado').prop('checked', $persona.seguroprivado == 1 ? true:false);
        	$('#segurosis').prop('checked', $persona.segurosis == 1 ? true:false);
        	$('#segurootro').prop('checked', $persona.segurootro == 1 ? true:false);
    		$('#seguronotiene').prop('checked', $persona.seguroessalud != 1 && 
    											$persona.segurofapnp != 1 && 
    											$persona.seguroprivado != 1 && 
    											$persona.segurosis != 1 && 
    											$persona.segurootro != 1 ? true:false);
    		$('#idiomaninez').val($persona.idiomaninez);
    		$('input[name="sabeleer"][value="' + $persona.sabeleer + '"]').prop('checked', true);
    		$("#niveleducativo").val($persona.niveleducativo);
    		$("#ultimogrado").val($persona.ultimogrado);
    		$("#ocupacionultimomes").val($persona.ocupacionultimomes);
    		$("#sector").val($persona.sector);
    		$('#discapacidadvisual').prop('checked', $persona.discapacidadvisual == 1 ? true:false);
    		$('#discapacidadoir').prop('checked', $persona.discapacidadoir == 1 ? true:false);
    		$('#discapacidadhablar').prop('checked', $persona.discapacidadhablar == 1 ? true:false);
    		$('#discapacidadusarbrazos').prop('checked', $persona.discapacidadusarbrazos == 1 ? true:false);
    		$('#discapacidadmental').prop('checked', $persona.discapacidadmental == 1 ? true:false);
    		$('#dispacidadnotiene').prop('checked', $persona.discapacidadvisual != 1 &&
    												$persona.discapacidadoir != 1 &&
    												$persona.discapacidadhablar != 1 &&
    												$persona.discapacidadusarbrazos != 1 &&
    												$persona.discapacidadmental != 1 ? true:false);
    		$('#vasoleche').prop('checked', $persona.vasoleche == 1 ? true:false);
    		$('#comedorpopular').prop('checked', $persona.comedorpopular == 1 ? true:false);
    		$('#comidaescolar').prop('checked', $persona.comidaescolar == 1 ? true:false);
    		$('#papilla').prop('checked', $persona.papilla == 1 ? true:false);
    		$('#canastaalimentaria').prop('checked', $persona.canastaalimentaria == 1 ? true:false);
    		$('#juntos').prop('checked', $persona.juntos == 1 ? true:false);
    		$('#techopropio').prop('checked', $persona.techopropio == 1 ? true:false);
    		$('#pension').prop('checked', $persona.pension == 1 ? true:false);
    		$('#cunamas').prop('checked', $persona.cunamas == 1 ? true:false);
    		$('#otros').prop('checked', $persona.otros == 1 ? true:false);
    		$('#programaninguno').prop('checked', $persona.vasoleche != 1 &&
												$persona.comedorpopular!= 1 &&
												$persona.comidaescolar != 1 &&
												$persona.papilla != 1 &&
												$persona.canastaalimentaria != 1 &&
												$persona.juntos != 1 &&
												$persona.techopropio != 1 &&
												$persona.pension != 1 &&
												$persona.cunamas != 1 &&
												$persona.otros != 1 ? true:false);
    		loading(false);
    		if($persona.informante == 1)
        	{
        		$("#apepaterno").attr("readonly", true);
	        	$("#apematerno").attr("readonly", true);
	        	$("#nombres").attr("readonly", true);
	        	$("#tipodocumento").attr("readonly", true);
	        	$("#fechanacimiento").attr("readonly", true);
	        	$("#numerodocumento").attr("readonly", true);
        	}
        }
    });
}
function savePoblacion() {
	$form = $("#frmPoblacion");
	$msg = "";
	$tipo = "success";
    $title = "Mensaje:";
	$.ajax({
		async:false, 
        type: 'POST',
        url: $form.attr('action'),
        data: $form.serialize(),
        dataType: 'json',
        beforeSend: function() {
        	loading(true);
        },
        success: function(data) {
        	$tipo = "success";
            $title = "Guardado:";
            $msg = "Persona guardada correctamente.";
            $('#myModal').modal('toggle');
            loadPoblacion();
            loading(false);
        },
        error: function(data) {
        	$tipo = "error";
            $title = "Error:";
        	if(data.status == "422"){
        		$msg = printerrors_Poblacion(data);
        	}
        	else{
        		$msg = "No se pudo guardar.<br> Inténtelo de nuevo más tarde.";
        	}
        	loading(false);
        }
    });
    new PNotify({
      title: $title,
      text: $msg,
      type: $tipo,
      styling: 'bootstrap3'
    });
}
function deletePoblacion($idpersona) {
	$msg = "";
	$tipo = "success";
    $title = "Mensaje:";
	$.ajax({
		async:false, 
        type: 'POST',
        url: $("body").attr('urlbase')+"/poblacion/delete",
        data: { idpersona :$idpersona },
        dataType: 'json',
        beforeSend: function() {
        },
        success: function(data) {
        	$tipo = "info";
            $title = "Eliminado:";
            $msg = "Persona eliminada correctamente.";
            loadPoblacion();
        },
        error: function(data) {
        	$tipo = "error";
            $title = "Error:";
        	$msg = "No se pudo eliminar.<br> Inténtelo de nuevo más tarde.";
        }
    });
    new PNotify({
      title: $title,
      text: $msg,
      type: $tipo,
      styling: 'bootstrap3'
    });
}
function loading($v) {
	if($v){
	  $(".loading-spin").show();
	  $("#frmPoblacion :input").attr("disabled", true);
	  $("#btnAgregarPersona").attr("disabled", true);
	  $("#btnCancelarPersona").attr("disabled", true);
	}
	else{
	  $(".loading-spin").hide();
	  $("#frmPoblacion :input").attr("disabled", false);
	  $("#btnAgregarPersona").attr("disabled", false);
	  $("#btnCancelarPersona").attr("disabled", false);
	}
}