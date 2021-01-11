<?php
$postulacion = $data["postulacion"];
$postulante = $data["postulante"];
$ambiente = $data["ambiente"];
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
		table, td{
			margin:0px;
			width: 100%;
		}
		h1{
			margin: 0px 0px;
			font-size: 22px;
			text-decoration: underline;
		}
		h2{
			margin:0px 10px;
			font-size: 20px;
		}
		h2 small{
			margin:0px 10px;
			font-size: 16px;
		}
		h3{
			margin: 0px 0px;
			padding: 0px 0px;
			font-size: 15px;
		}
		td {
			padding: -5px 10px;
		}
		tr{
			padding: 0px;
		}
		.table, .table td{
			border-collapse: collapse;
			padding: 0px;
			margin: 0px;
			/*border: 1px solid #000;*/
		}
		.table td, strong{
			padding: -3px 0px;
			margin: -3px 0px;
		}
		.foto{
			width: 130px;
			margin:0px;
			padding: 0px;
		}
		.foto img{
			width: 130px;
			margin:0px;
			padding: 0px;
		}
		.huella{
			width: 100px;
			height: 120px;
			border: 1px solid #000;
			text-align: center;
			margin: 10px;
			border-radius: 10px;
		}
		.huella span{
			font-size: 8px;
			bottom: 1px;
		}
		#img-foto{
			max-width: 120px;
			max-height: 140px;
		}
	</style>
</head>
<body>
	<table>
		<tr>
			<td style="width: 200px;">
				<img style="margin:0px; padding: 0px;" 
					width="100px" src="<?php echo e(asset('images/logo.png')); ?>">
			</td>
			<td style="width: 480px;">
				<h2 style="text-align: right;">
					Universidad Nacional de Barranca <br> 
					<small> Dirección General de Admisión</small>
				</h2>
			</td>
		</tr>
		<tr>
			<td colspan="2" style="text-align: center;">
				<h1 style="margin-top: 10px;">CARNÉ DE POSTULANTE - DECLARACIÓN JURADA</h1>
			</td>
		</tr>
	</table>
	<table class="table">
		<tr>
			<td style="width: 150px;"><strong>CÓDIGO DE POSTULANTE</strong></td>
			<td style="width: 10px;">:</td>
			<td style="width: 360px">
				<?php echo e(str_pad($postulacion->nroPostulante, 6, "0", STR_PAD_LEFT)); ?>

				<strong style="margin-left: 30px;">DOC. IDEN.:</strong><span> <?php echo e($postulante->dni); ?> </span>
				<strong style="margin-left: 30px;">AULA:</strong><span> 
					<?php if($ambiente): ?>
					<?php echo e($ambiente->descripcion); ?>

					<?php else: ?> SIN ASIGNAR
					<?php endif; ?>
				</span>
			</td>
			<td style="width: 100px; padding: 0px;" rowspan="5">
				<div class="foto">
					<img id="img-foto" src="<?php echo e(asset($postulante->foto)); ?>" alt="">
				</div>
			</td>
		</tr>
		<tr>
			<td style="width: 150px;"><strong>APELLIDOS Y NOMBRES</strong></td>
			<td style="width: 10px;">:</td>
			<td style="width: 360px"><?php echo e(strtoupper($postulante->apepaterno)); ?> <?php echo e(strtoupper($postulante->apematerno)); ?> <?php echo e(strtoupper($postulante->nombre)); ?></td>
		</tr>
		<tr>
			<td style="width: 150px;""><strong>MODALIDAD POSTULACIÓN</strong></td>
			<td style="width: 10px;">:</td>
			<td style="width: 360px"><?php echo e(strtoupper($postulacion->modalidad)); ?></td>
		</tr>
		<tr>
			<td style="width: 150px;""><strong>ESCUELA PROFESIONAL</strong></td>
			<td style="width: 10px;">:</td>
			<td style="width: 360px"><?php echo e(strtoupper($postulacion->escuela)); ?></td>
		</tr>
		<tr>
			<td colspan="3">
			<br>
				<strong style="margin:0px;">DECLARACIÓN JURADA:</strong>
				<p style="margin:0px">- La información consignada al momento de inscribirme es verdadera y de mi entera responsabilidad.</p>
				<p style="margin:0px 0px 12px 0px">- Conozco y acepto todas las disposiciones del Reglamento General de Admision al cual me someto.</p>
			</td>
		</tr>
		<tr>
			<td colspan="3">
				<strong>DÍA DEL EXAMEN</strong>
				<p style="margin:0px">- Presentarse con este Carné en el local que le corresponda rendir su examen de admisión.</p>
				<p style="margin:0px">- Portar además el DNI original, lápiz 2B, tajador y borrador.</p>
			</td>
		</tr>
	</table>
	<table class="table" style="margin-top: 10px;">
		<tr>
			<td style="width:120px;">
				<div class="huella">
					<span>INDICE IZQUIERDO</span>
				</div>
			</td>
			<td style="width:120px;">
				<div class="huella">
					<span>INDICE DERECHO</span>
				</div>
			</td>
			<td align="center">
				<p>____________________________</p>
				<p>Firma del Postulante</p>
			</td>
			<td align="center" style="padding-left: 25px; ">
				<p>____________________________</p>
				<p>Firma del Docente de Aula</p>
			</td>
		</tr>
	</table>

	<br>

<p>--------------------------------------------------------------------------------------------------------------------------------------------------------------------------------</p>
<br>
	<table>
		<tr>
			<td style="width: 200px;">
				<img style="margin:0px; padding: 0px;" 
					width="100px" src="<?php echo e(asset('images/logo.png')); ?>">
			</td>
			<td style="width: 480px;">
				<h2 style="text-align: right;">
					Universidad Nacional de Barranca <br> 
					<small> Dirección General de Admisión</small>
				</h2>
			</td>
		</tr>
		<tr>
			<td colspan="2" style="text-align: center;">
				<h1 style="margin-top: 10px;">CARNÉ DE POSTULANTE - DECLARACIÓN JURADA</h1>
			</td>
		</tr>
	</table>
	<table class="table">
		<tr>
			<td style="width: 150px;"><strong>CÓDIGO DE POSTULANTE</strong></td>
			<td style="width: 10px;">:</td>
			<td style="width: 360px">
				<?php echo e(str_pad($postulacion->nroPostulante, 6, "0", STR_PAD_LEFT)); ?>

				<strong style="margin-left: 30px;">DOC. IDEN.:</strong><span> <?php echo e($postulante->dni); ?> </span>
				<strong style="margin-left: 30px;">AULA:</strong><span> 
					<?php if($ambiente): ?>
					<?php echo e($ambiente->descripcion); ?>

					<?php else: ?> SIN ASIGNAR
					<?php endif; ?>
				</span>
			</td>
			<td style="width: 100px; padding: 0px;" rowspan="5">
				<div class="foto">
					<img  id="img-foto"  src="<?php echo e(asset($postulante->foto)); ?>" alt="">
				</div>
			</td>
		</tr>
		<tr>
			<td style="width: 150px;"><strong>APELLIDOS Y NOMBRES</strong></td>
			<td style="width: 10px;">:</td>
			<td style="width: 360px"><?php echo e(strtoupper($postulante->apepaterno)); ?> <?php echo e(strtoupper($postulante->apematerno)); ?> <?php echo e(strtoupper($postulante->nombre)); ?></td>
		</tr>
		<tr>
			<td style="width: 150px;""><strong>MODALIDAD POSTULACIÓN</strong></td>
			<td style="width: 10px;">:</td>
			<td style="width: 360px"><?php echo e(strtoupper($postulacion->modalidad)); ?></td>
		</tr>
		<tr>
			<td style="width: 150px;""><strong>ESCUELA PROFESIONAL</strong></td>
			<td style="width: 10px;">:</td>
			<td style="width: 360px"><?php echo e(strtoupper($postulacion->escuela)); ?></td>
		</tr>
		<tr>
			<td colspan="3">
			<br>
				<strong style="margin:0px;">DECLARACIÓN JURADA:</strong>
				<p style="margin:0px">- La información consignada al momento de inscribirme es verdadera y de mi entera responsabilidad.</p>
				<p style="margin:0px 0px 12px 0px">- Conozco y acepto todas las disposiciones del Reglamento General de Admision al cual me someto.</p>
			</td>
		</tr>
		<tr>
			<td colspan="3">
				<strong>DÍA DEL EXAMEN</strong>
				<p style="margin:0px">- Presentarse con este Carné en el local que le corresponda rendir su examen de admisión.</p>
				<p style="margin:0px">- Portar además el DNI original, lápiz 2B, tajador y borrador.</p>
			</td>
		</tr>
	</table>
	<table class="table" style="margin-top: 10px;">
		<tr>
			<td style="width:120px;">
				<div class="huella">
					<span>INDICE IZQUIERDO</span>
				</div>
			</td>
			<td style="width:120px;">
				<div class="huella">
					<span>INDICE DERECHO</span>
				</div>
			</td>
			<td align="center">
				<p>____________________________</p>
				<p>Firma del Postulante</p>
			</td>
			<td align="center" style="padding-left: 25px; ">
				<p>____________________________</p>
				<p>Firma del Docente de Aula</p>
			</td>
		</tr>
	</table>

</body>
</html>