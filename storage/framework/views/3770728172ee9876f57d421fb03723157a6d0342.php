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
			font-family: Arial, Helvetica, Verdana;
			font-size: 12px;
		}
		.constancia{
			width: 100%;
			height: 900px;
			margin-bottom: 5px;
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
	<?php
		$mes ="";
		switch (date("n")) {
			case 1: $mes = "ENERO";break;
			case 2: $mes = "FEBRERO";break;
			case 3: $mes = "MARZO";break;
			case 4: $mes = "ABRIL";break;
			case 5: $mes = "MAYO";break;
			case 6: $mes = "JUNIO";break;
			case 7: $mes = "JULIO";break;
			case 8: $mes = "AGOSTO";break;
			case 9: $mes = "SETIEMBRE";break;
			case 10: $mes = "OCTUBRE";break;
			case 11: $mes = "NOVIEMBRE";break;
			case 12: $mes = "DICIEMBRE";break;
		}
	 ?>
	<?php $__currentLoopData = $postulaciones; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $postulacion): $__env->incrementLoopIndices(); $loop = $__env->getFirstLoop(); ?>
	<div class="constancia">
		<table width="100%">
			<tr>
				<td align="center" width="120px"><img src="<?php echo e(asset('images/logochico.png')); ?>" alt=""></td>
				<td align="center">
					<h1 style="margin: 0px;">UNIVERSIDAD NACIONAL DE BARRANCA</h1>
					<h3 style="margin: 1.5px 0px 1.5px 0px">LEY DE CREACIÓN N°29553</h3>
					<p style="font-size: 10px; margin: 0px;">RESOLUCIÓN N° 002-2013-CONAFU (AUTORIZACIÓN DE FUNCIONAMIENTO PROVISIONAL) <br>	
					RESOLUCIÓN N° 112-2014-CONAFU (APROBACIÓN DEL PROCESO DE ADMISIÓN 2014-I) <br>
					RESOLUCIÓN PRESIDENCIAL N° 116-2013-UNAB-CO/P (APROBACIÓN DEL FORMATO DE CONSTANCIAS DE INGRESO)</p>
				</td>
			</tr>
			<tr>
				<td colspan="2"><h1 style="margin:10px 0px 0px 0px; font-size: 25px;" align="center">CONSTANCIA DE INGRESO <?php echo e($postulacion->proceso); ?></h1></td>
			</tr>
		</table>
		<table id="table-fila">
			<tr class="fila">
				<td>CÓD. ALUMNO:</td>
				<td><?php echo e(strtoupper($postulacion->codalumno)); ?></td>
				<td align="center" rowspan="4">
					<div id="foto">
						<img src="<?php echo e(asset('/'.$postulacion->foto)); ?>" alt="">
						<p>FOTOGRAFÍA DEL ALUMNO</p>
					</div>
				</td>
			</tr>
			<tr class="fila">
				<td>APELLIDOS:</td>
				<td><?php echo e(strtoupper($postulacion->apellidos)); ?></td>
			</tr>
			<tr class="fila">
				<td>NOMBRES:</td>
				<td><?php echo e(strtoupper($postulacion->nombre)); ?></td>
			</tr>
			<tr class="fila">
				<td>D.N.I. N°:</td>
				<td><?php echo e($postulacion->dni); ?></td>
			</tr>
			<tr class="fila">
				<td>CARRERA:</td>
				<td><?php echo e(strtoupper($postulacion->escuela)); ?></td>
				<td></td>
			</tr>
			<tr class="fila">
				<td>MODALIDAD:</td>
				<td><?php echo e(strtoupper($postulacion->modalidad)); ?></td>
				<td></td>
			</tr>
			<tr class="fila">
				<td>PUNTAJE:</td>
				<td><?php echo e($postulacion->puntaje); ?></td>
				<td align="center" rowspan="4">
					<div id="huella"></div>
					<p align="center">HUELLA DIGITAL</p>
				</td>
			</tr>
			<tr class="fila">
				<td>O.M. GENERAL:</td>
				<td><?php 