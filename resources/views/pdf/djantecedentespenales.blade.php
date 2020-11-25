<?php
$postulante = $data["postulante"];
$postulacion = $data["postulacion"];
?>
<!DOCTYPE html>
<html lang="es">
<head>
	<meta charset="latin-1">
	<title>Document</title>
	<style type="text/css">
		body{
			margin:0px;
			padding: 0px 50px 50px 20px;
			font-family: Arial, Helvetica, Verdana;
			font-size: 14px;
			width: 100%;
		}
		table, td{
			margin:0px;
			width: 100%;
		}
		h1{
			text-align: center;
			font-size: 22px;
		}
		h3{
			margin: 0px 0px;
			padding: 0px 0px;
			font-size: 15px;
		}
		td {
			padding: 2px 10px;
		}
		.table, .table td{
			border-collapse: collapse;
			
			margin: 2px 0px;
		}
		.table td{
			border: 1px solid #000;
		}
		.table .header{
			background-color: #777;
			text-align: center;
			color: #fff;
			font-weight: bold;
		}
		.table .sub-header{
			background-color: #eee;
			text-align: center;
		}
		.sub-title{
			padding:10px 0px 2px 0px;
		}
		.table-panel{
			border: 1px solid #000;
		}
		.huella{
			width: 120px;
			height: 130px;
			border: 1px solid #000;
		}
		.huella p{
			text-align: center;
			bottom: 0px;
			font-size: 10px;
		}
	</style>
</head>
<body>

	<table>
		<tr>
			<td style="width: 120px;text-align: center;">
				<img width="120px" src="{{ asset('images/logo.png') }}" alt=""><br>
				<strong style="font-size: 15px;">Admisión {{ $postulacion->proceso->descripcion }}</strong>
			</td>
			<td  style="width: 500px;"><h1 style="text-align: right;">2) DECLARACIÓN JURADA DE NO TENER ANTECEDENTES PENALES</h1></td>
		</tr>
	</table>
	<br>
	<br>
	@if($postulante->sexo == 'M')
		<p>Por la presente, el suscrito:</p>
	@else
		<p>Por la presente, la suscrita:</p>
	@endif
	<table style="text-align: left;font-size: 15px;margin-left: 50px;">
		<tr>
			<td style="width: 80px;">Apellidos: </td>
			<td ><strong>{{ strtoupper($postulante->apepaterno) }} {{ strtoupper($postulante->apematerno) }}</strong></td>
		</tr>
		<tr>
			<td style="width: 80px;">Nombres: </td>
			<td><strong>{{ strtoupper($postulante->nombre) }}</strong></td>
		</tr>
		<tr>
			<td style="width: 80px;">DNI:</td>
			<td><strong>{{ $postulante->dni }}</strong></td>
		</tr>
		<tr>
			<td>Fecha Nac.</td>
			<td><strong>{{ $postulante->fechanacimiento }}</strong></td>
		</tr>
	</table>
	<br><br>
	
	<p>Declaro bajo juramento de Ley,  <strong>NO HABER SIDO CONDENADO POR EL DELITO DE TERRORISMO O APOLOGÍA AL TERRORISMO EN CUALQUIERA DE SUS MODALIDADES</strong> (Ley N° 30220, Art. 98°), para el Proceso de Admisión {{ $postulacion->proceso->descripcion }}.</p>
	<br>
	<p>En señal de conformidad firmo a continuación.</p>

	<br><br><br>
	<p style="text-align: right; margin: 20px">Barranca, {{ date("d") }} / {{ date("m") }} / {{ date("Y") }}</p>
	<br>
	<table>
		<tr>
			<td align="center">
				____________________________ <br> Firma del solicitante <br> D.N.I. N° {{ $postulante->dni }}
			</td>
			<td>
				<div class="huella"><p>Indice derecho</p></div>
			</td>
		</tr>
	</table>

</body>
</html>