<?php

$postulaciones = $data["postulaciones"];
?>
<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="latin-1">
	<title>Document</title>
	<style type="text/css">
	    html{
	        margin:0px;
	        padding:0px;
	    }
		body{
			margin:0px;
			padding: 0px;
			font-family: Arial, Helvetica, Verdana,serif;
			font-size: 12px;
		}
		.constancia{
			width: 100%;
			height: auto;
		}
		.barcode{
			font-size: 14px;
		}
		#table-fila{
			margin: 0px 0px 0px 0px;

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
			margin: 20px 0px 0px 350px;
			text-align: center;
			border-top: 1px solid #000;
			width: 300px;
			height: 150px;
			font-weight: bold;
		}
		
				
	</style>
</head>
<body style="background: url(<?php echo e(asset('images/FORMATO-DE-CONSTANCIA-2019.jpg')); ?>);">
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
				<td align="center" width="120px" style="padding-left:20px"><img src="<?php echo e(asset('images/logochico.png')); ?>" alt=""></td>
				<td align="center">
					<h1 style="margin: 0px;">UNIVERSIDAD NACIONAL DE BARRANCA</h1>
					<h3 style="margin: 1.5px 0px 1.5px 0px">LEY DE CREACIÓN N°29553</h3>
					<!-- <br>	
					RESOLUCIÓN DE COMISIÓN ORGANIZADORA N° 019-2019-UNAB (APROBACIÓN DEL PROCESO DE ADMISIÓN 2019-II) <br>-->
					<p style="font-size: 10px; margin: 0px;">RESOLUCIÓN DEL CONSEJO DIRECTIVO N° 047-2018-SUNEDU/CD (RESOLUCIÓN DE LICENCIA INSTITUCIONAL) <br>	
					RESOLUCIÓN DE COMISIÓN ORGANIZADORA N° 298-2019-UNAB (APROBACIÓN DEL PROCESO DE ADMISIÓN 2020-I y 2020-II) <br>
					RESOLUCIÓN DE COMISIÓN ORGANIZADORA N° 032-2019-UNAB (APROBACIÓN DEL FORMATO DE CONSTANCIA DE INGRESO)</p>
				</td>
			</tr>
			<tr>
				<td colspan="2"><h1 style="margin:10px 0px 0px 0px; font-size: 28px;" align="center">CONSTANCIA DE INGRESO</h1></td>
			</tr>
		</table>
		<table id="table-fila">
			<tr class="fila">
				<td>CÓDIGO DE POSTULANTE</td>
				<td><?php echo e(str_pad($postulacion->nroPostulante, 6, "0", STR_PAD_LEFT)); ?> - <?php echo e(mb_strtoupper($postulacion->proceso)); ?></td>
				<td align="center" rowspan="4">
					<div id="foto"  style="padding-left:10px;">
						<img src="<?php echo e(asset('/'.$postulacion->foto)); ?>" alt="">
					</div>
				</td>
			</tr>
			<tr class="fila">
				<td>APELLIDOS</td>
				<td><?php echo e(mb_strtoupper($postulacion->apellidos)); ?></td>
			</tr>
			<tr class="fila">
				<td>NOMBRES</td>
				<td><?php echo e(mb_strtoupper($postulacion->nombre)); ?></td>
			</tr>
			<tr class="fila">
				<td>D.N.I. N°</td>
				<td><?php echo e($postulacion->dni); ?></td>
			</tr>
			<tr class="fila">
				<td>ESCUELA PROF.</td>
				<td><?php echo e(strtoupper($postulacion->escuela)); ?></td>
				<td></td>
			</tr>
			<tr class="fila">
				<td>MODALIDAD</td>
				<td><?php echo e(mb_strtoupper($postulacion->modalidad)); ?></td>
				<td></td>
			</tr>
			<tr class="fila">
				<td>PUNTAJE</td>
				<td><?php echo e($postulacion->puntaje); ?></td>
				<td align="center" rowspan="4">
					<div id="huella"></div>
					<p align="center">HUELLA DIGITAL</p>
				</td>
			</tr>
			<tr class="fila">
				<td>O.M. GENERAL</td>
				<td><?php echo e($postulacion->omg); ?></td>
			</tr>
			<tr class="fila">
				<td>O.M. CARRERA</td>
				<td><?php echo e($postulacion->ome); ?></td>
			</tr>
			<tr class="fila">
				<td>RESOLUCIÓN N°</td>
				<td><?php echo e(strtoupper($postulacion->resolucion)); ?></td>
			</tr>
		</table>
		<!-- <p style="text-align: center; font-weight: bold;font-size: 18px; margin: 20px 0px 0px 0px;">BARRANCA, 03 ABRIL <?php echo e(date("Y")); ?></p> -->
		<p style="text-align: center; font-weight: bold;font-size: 18px; margin: 20px 0px 0px 0px;">BARRANCA, 26 MAYO <?php echo e(date("Y")); ?></p>
		<br><br><br>
		<img style="padding-left:380px" src="<?php echo e(asset('images/FIRMAANACECILIA.png')); ?>" alt="">
		<div id="firma">
			<span style="font-size: 16px;"><?php echo e($postulacion->responsable); ?></span> <br>
			<span>DIRECTOR(A) DE ADMISIÓN</span><br>
		</div>
		<h3 class="barcode" style="margin: 10px 0px 0px 0px; padding-left:40px"  align="left"><?php echo e(str_pad($postulacion->nroPostulante, 6, "0", STR_PAD_LEFT)); ?>  /  <?php echo e($postulacion->dni); ?>

		
		</h3>

		
	</div>
	<?php endforeach; $__env->popLoop(); $loop = $__env->getFirstLoop(); ?>
</body>
</html>