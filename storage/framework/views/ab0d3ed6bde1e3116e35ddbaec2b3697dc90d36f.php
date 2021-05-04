﻿<?php

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


		}
		.constancia{
			width: 100%;
			height: 450px;


		}

		#table-fila{

			border: 1px solid black;
		}
		.fila td:nth-child(1){
			text-align: center;
			width: 120px;
			height: 13px;
			font-size: 12px;

		}
		.fila td:nth-child(2){			
			border-bottom: 1px solid #000;
			width: 300px;
			text-align: center;
			font-size: 11px;
			font-weight: bold;
		}
		.fila td:nth-child(3){
			width: 220px;
			text-align: center;
		}
		#foto{
			width: 100%;
			height: 150px;
			text-align: center;
		}
		#foto img{
			max-width: 180px;
			max-height: 180px;
		}
		#huella{
			border: 1px solid #000;
			width: 110px;
			height: 130px;
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
				<td colspan="2"><h1 style="margin:10px 0px 0px 0px; font-size: 22px;" align="center">PADRON</h1></td>
			</tr>
		</table>
		<table id="table-fila">
			<tr class="fila">

				<td>CÓD. POSTULANTE</td>
				<td><?php echo e(str_pad($postulacion->nroPostulante, 6, "0", STR_PAD_LEFT)); ?></td>
				<td align="center" rowspan="4">
					<div id="foto">
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
				<td>ESCUELA PROF.</td>
				<td><?php echo e(mb_strtoupper($postulacion->escuela)); ?></td>
				
			<td></td>
			</tr>
			<tr class="fila">
				<td>MODALIDAD</td>
				<td><?php echo e(mb_strtoupper($postulacion->modalidad)); ?></td>
					<td align="center" rowspan="4">
					<div id="huella"></div>
					<p align="center">HUELLA DIGITAL</p>
				</td>	
	
			</tr>
			<tr >
			<td></td>
			<td><center><br><br><br><br><br>____________________________________<br>
			FIRMA DEL INGRESANTE</center></td>
			<td></td>

				
			
			</tr>
			
		</table>
		
		
		
	</div>
	<?php endforeach; $__env->popLoop(); $loop = $__env->getFirstLoop(); ?>
</body>
</html>