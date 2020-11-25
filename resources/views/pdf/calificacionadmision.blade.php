<?php

$postulaciones = $data["postulaciones"];
?>
<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="latin-1">
	<title>Document</title>
	<style type="text/css">
		body{
			margin:0px;
			padding: 0px;
			font-family: Arial, Helvetica, Verdana,serif;
			font-size: 12px;
			background:url(images/FORMATO-DE-CONSTANCIA.jpg);
		}
		.constancia{
			width: 100%;
			height: 900px;
			margin-bottom: 5px;
		}
		.barcode{
			font-size: 14px;
		}
		#table-fila{
			margin: 5px 0px 0px 0px;

		}
		.fila td:nth-child(1){
			text-align: right;
			width: 120px;
			height: 30px;
			font-size: 16px;
			padding: 8px 10px 0px 15px;
		}
		.fila td:nth-child(2){
			border-bottom: 1px solid #000;
			width: 300px;
			text-align: center;
			font-size: 18px;
			font-weight: bold;
		}
		.fila td:nth-child(3){
			width: 220px;
			text-align: center;
		}
		#foto{
			width: 100%;
			height: 200px;
			text-align: center;
		}
		#foto img{
			max-width: 180px;
			max-height: 200px;
		}
		#huella{
			border: 1px solid #000;
			width: 130px;
			height: 150px;
			text-align: center;
			margin: 0px 0px 0px 45px;
		}
		#firma{
			margin: 70px 0px 0px 350px;
			text-align: center;
			border-top: 1px solid #000;
			width: 300px;
			height: 80px;
			font-weight: bold;
		}
		
				
	</style>
</head>
<body>
	@foreach($postulaciones as $postulaciones )
	<div class="constancia">
		<table width="100%">
			<tr>
				<td align="center" width="120px"><img src="{{asset('images/logochico.png')}}" alt=""></td>
				<td align="center">
					<h1 style="margin: 0px;">UNIVERSIDAD NACIONAL DE BARRANCA</h1>
					<h3 style="margin: 1.5px 0px 1.5px 0px">LEY DE CREACIÓN N°29553</h3>
					<p style="font-size: 10px; margin: 0px;">RESOLUCIÓN N° 002-2013-CONAFU (AUTORIZACIÓN DE FUNCIONAMIENTO PROVISIONAL) <br>	
					RESOLUCIÓN DE COMISIÓN ORGANIZADORA N° 312-2017-CO-UNAB (APROBACIÓN DEL PROCESO DE ADMISIÓN 2018-I) <br>
					RESOLUCIÓN PRESIDENCIAL N° 116-2013-UNAB-CO/P (APROBACIÓN DEL FORMATO DE CONSTANCIAS DE INGRESO)</p>
				</td>
			</tr>
			<tr>
				<td colspan="2"><h1 style="margin:10px 0px 0px 0px; font-size: 28px;" align="center">CONSTANCIA DE INGRESO</h1></td>
			</tr>
		</table>
		<table id="table-fila">
			<tr>
				<td>HOLA</td>
			</tr>
		</table>
		</h3>
	</div>
	@endforeach
</body>
</html>