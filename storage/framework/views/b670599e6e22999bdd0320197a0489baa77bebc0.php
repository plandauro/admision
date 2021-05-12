	<?php
$postulacion = $data["postulacion"];
$postulante = $data["postulante"];
?>
<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="latin-1">
	<title>Document</title>
	<style type="text/css">
		body{
			margin:0 0 0 0;
			padding: 0px;
			font-family: Arial, Helvetica, Verdana;
			font-size: 10px;
		}
		table, td{
			margin:0px;
			width: 100%;
		}
		h1{
			margin:0px 10px;
			font-size: 24px;
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
			padding:10px 0px 0px 0px;
		}
		.table-panel{
			border: 1px solid #000;
			margin: 0px;
		}
		.huella{
			width: 120px;
			height: 130px;
			border: 1px solid #000;
		}
		.huella p{
			text-align: center;
			bottom: 1px;
		}
		.foto{
			width: 120px;
			height: 130px;
		}
		.foto img{
			max-width: 120px;
			max-height: 130px;
			text-align: center;
		}

		
	</style>
</head>
<body>
	<table style="">
		<tr>
			<td style="width: 200px;">
				<img width="140px" src="<?php echo e(asset('images/logo.png')); ?>" alt="">
			</td>
			<td style="width: 500px;padding: 0px;text-align: right;">
				<h1 style="margin-top: 9px">1) FICHA DE INSCRIPCIÓN <?php echo e($postulacion->proceso); ?></h1>
			</td>
		</tr>
	</table>
	<table style="border: 0px;">
		<tr>
			<td style="width: 120px;">CÓDIGO DE POSTULACIÓN:</td>
			<td style="width: 80px; font-size: 18px; border: 2px solid #000; text-align: center;"><strong> <?php echo e(str_pad($postulacion->nroPostulante, 6, "0", STR_PAD_LEFT)); ?></strong></td>
			<td style="width: 80px"></td>
			<td style="width: 105px">FECHA DE INSCRIPCIÓN: </td>
			<td style="width: 100px; font-size: 18px; border: 2px solid #000; text-align: center;"><strong><?php echo e($postulacion->created_at->format('d-m-Y')); ?></strong></td>
		</tr>
	</table>
	<div class="sub-title"><h3>1. DATOS PERSONALES</h3></div>
	
	<table class="table">
		<tr>
			<td  class="sub-header" style="width: 400px;">APELLIDOS Y NOMBRES</td>
			<td  class="sub-header" style="width: 200px;">DOCUMENTO DE IDENTIDAD</td>
		</tr>
		<tr>
			<td style="text-align: center;">
				<strong>
					<?php echo e(strtoupper($postulante->apepaterno." / ".$postulante->apematerno." / ".$postulante->nombre)); ?>

				</strong>
			</td>
			<td style="text-align: center;">
				<strong><?php if($postulante->tipodocumento ==1): ?> DNI 
						<?php elseif($postulante->tipodocumento ==2): ?> LIBRETA MILITAR
						<?php elseif($postulante->tipodocumento ==3): ?> PARTIDA NACIMIENTO CUI
						<?php elseif($postulante->tipodocumento ==1): ?>CARNET DE EXTRANJERÍA
						<?php else: ?> OTRO <?php endif; ?>
						: <?php echo e($postulante->dni); ?></strong>
			</td>
		</tr>
	</table>
	<table class="table">
		<tr>
			<td class="header" colspan="4">LUGAR Y FECHA DE NACIMIENTO</td>
			
		</tr>
		<tr>
			<td class="sub-header">PAÍS</td>
			<td class="sub-header">DEPARTAMENTO</td>
			<td class="sub-header">PROVINCIA</td>
			<td class="sub-header">DISTRITO</td>
			<td class="sub-header">F. DE NACIMIENTO</td>
		</tr>
		<tr>
		<?php if($postulante->extranjero == 1): ?>
			<td align="center"><strong><?php echo e(strtoupper($postulante->ubigeoextrangeropais)); ?></strong></td>
			<td align="center"><strong><?php echo e(strtoupper($postulante->ubigeoextrangerodepartamento)); ?></strong></td>
			<td align="center"><strong><?php echo e(strtoupper($postulante->ubigeoextrangeroprovincia)); ?></strong></td>
			<td align="center"><strong><?php echo e(strtoupper($postulante->ubigeoextrangerodistrito)); ?></strong></td>
		<?php else: ?>
			<td align="center"><strong> PERÚ</strong></td>
			<td align="center"><strong><?php echo e(strtoupper($postulante->ubigeonacimiento->departamento)); ?></strong></td>
			<td align="center"><strong><?php echo e(strtoupper($postulante->ubigeonacimiento->provincia)); ?></strong></td>
			<td align="center"><strong><?php echo e(strtoupper($postulante->ubigeonacimiento->distrito)); ?></strong></td>
		<?php endif; ?>
			<td align="center"><strong><?php echo e($postulante->fechanacimiento); ?></strong></td>
		</tr>
	</table>
	<table class="table">
		<tr>
			<td class="sub-header" style="width: 40px;">EDAD: </td>
			<td style="width: 70px;"><strong><?php echo e(str_pad($postulante->edad, 2, "0", STR_PAD_LEFT)); ?></strong></td>

			<td class="sub-header" style="width:40px;">SEXO: </td>
			<td style="width: 100px;"><strong><?php echo e(strtoupper($postulante->sexo == "M" ? "Masculino":"Femenino")); ?></strong></td>

			<td class="sub-header" style="width: 80px;">ESTADO CIVIL: </td>
			<td style="width: 100px;">
				<strong>
					<?php if($postulante->estadocivil==1): ?> SOLTERO/A
					<?php elseif($postulante->estadocivil==2): ?> CASADO/A
					<?php elseif($postulante->estadocivil==3): ?> DIVOCIADO/A<a href=""></a>
					<?php elseif($postulante->estadocivil==4): ?> VIUDO/A
					<?php endif; ?>

				</strong>
			</td>
		</tr>
	</table>
	<div class="sub-title"><h3>2. DATOS DE UBICACIÓN</h3></div>
	<table class="table">
		<tr>
			<td class="sub-header" style="width: 80px">VÍA</td>
			<td class="sub-header" style="width: 200px">NOMBRE DE LA VÍA</td>
			<td class="sub-header" style="width: 80px">NÚMERO</td>
			
		</tr>
		<tr>
			<td>
				<strong>
					<?php if($postulante->via == 1): ?> JIRÓN
					<?php elseif($postulante->via == 2): ?> AVENIDA
					<?php elseif($postulante->via == 3): ?> CALLE
					<?php elseif($postulante->via == 4): ?> PASAJE
					<?php elseif($postulante->via == 5): ?> OTRO
					<?php endif; ?>
				</strong>
			</td>
			<td><strong><?php echo e(strtoupper($postulante->direccion)); ?></strong></td>
			<td><strong><?php echo e(strtoupper($postulante->numero)); ?></strong></td>
			
		</tr>
	</table>
	<table class="table">
		<tr>
			<td class="header" colspan="3">UBIGEO DE DOMICILIO</td>
			<td class="sub-header">TELÉFONO CELULAR</td>
		</tr>
		<tr>
			<td class="sub-header">DEPARTAMENTO</td>
			<td class="sub-header">PROVINCIA</td>
			<td class="sub-header">DISTRITO</td>
			<td align="center"><?php echo e($postulante->celular); ?></td>
		</tr>
		<tr>
			<td align="center"><strong><?php echo e(strtoupper($postulante->ubigeodireccion->departamento)); ?></strong></td>
			<td align="center"><strong><?php echo e(strtoupper($postulante->ubigeodireccion->provincia)); ?></strong></td>
			<td align="center"><strong><?php echo e(strtoupper($postulante->ubigeodireccion->distrito)); ?></strong></td>
			<td align="center"><strong></strong></td>
		</tr>
	</table>
	<table class="table">
		<tr>
			<td class="sub-header" style="width: 500px">CORREO ELECTRÓNICO</td>
			<td class="sub-header" style="width: 150px">DUEÑO DEL CELULAR</td>
		</tr>
		<tr>
			<td align="center"><strong><?php echo e(strtoupper($postulante->email)); ?></strong></td>
			<td align="center">
				<strong>
					<?php if($postulante->duenocelular == 1): ?> PROPIO
					<?php elseif($postulante->duenocelular == 2): ?> PADRE O MADRE
					<?php elseif($postulante->duenocelular == 3): ?> OTRO FAMILIAR
					<?php elseif($postulante->duenocelular == 4): ?> VECINO
					<?php endif; ?>
				</strong>
			</td>
		</tr>
	</table>
	<div class="sub-title"><h3>3. DATOS FAMILIARES</h3></div>
	<table class="table">
		<tr>
			<td class="sub-header">APELLIDOS Y NOMBRES DEL PADRE</td>
			<td class="sub-header">APELLIDOS Y NOMBRES DE LA MADRE</td>
			<td class="sub-header">TELÉFONO DE CONTACTO</td>
		</tr>
		<tr>
			<td align="center"><strong><?php echo e(strtoupper($postulante->padre)); ?></strong></td>
			<td align="center"><strong><?php echo e(strtoupper($postulante->madre)); ?></strong></td>
			<td align="center"><strong><?php echo e(strtoupper($postulante->telefono)); ?></strong></td>
		</tr>
	</table>
	<div class="sub-title"><h3>4. DATOS DE LA INSTITUCIÓN EDUCATIVA DE PROCEDENCIA</h3></div>
	<table class="table">
		<tr>
			<td class="sub-header">INSTITUCIÓN EDUCATIVA DE PROCEDENCIA</td>
			<td class="sub-header">AÑO EN QUE CONCLUYO</td>
		</tr>
		<tr>
			<?php if($postulante->colegioextranjero == 1 || $postulante->isotrainstitucion == 1): ?>
				<td align="center"><strong><?php echo e(strtoupper($postulante->nombreie)); ?></strong></td>
			<?php else: ?>
				<td align="center"><strong><?php echo e(strtoupper($postulante->colegio->nombreie)); ?></strong></td>
			<?php endif; ?>
			<td align="center"><strong><?php echo e($postulante->anotermino); ?></strong></td>
		</tr>
	</table>
	<table class="table">
		<tr>
			<td class="sub-header">RÉGIMEN DE LA I.E. DE PROCEDENCIA</td>
			<td class="sub-header">UBICACIÓN DE LA I.E. DE PROCEDENCIA</td>
		</tr>
		<tr>
			<?php if($postulante->colegioextranjero != 1 && $postulante->isotrainstitucion !=1): ?>
				<td align="center"><strong><?php echo e($postulante->colegio->tipo==1 ? "ESTATAL":"PRIVADA"); ?></strong></td>
				<td align="center">
					<strong>
						<?php echo e(strtoupper($postulante->ubigeocolegio->departamento)); ?> /
						<?php echo e(strtoupper($postulante->ubigeocolegio->provincia)); ?> / 
						<?php echo e(strtoupper($postulante->ubigeocolegio->distrito)); ?>

					</strong>
				</td>
			<?php else: ?>
				<td align="center"><strong><?php echo e($postulante->estatal== 1 ? "ESTATAL":"PRIVADA"); ?></strong></td>
				<td align="center">
					<strong>
					<?php if($postulante->colegioextranjero == 1): ?>
						COLEGIO EXTRANJERO
					<?php else: ?>
						<?php echo e(strtoupper($postulante->ubigeocolegio->departamento)); ?> /
						<?php echo e(strtoupper($postulante->ubigeocolegio->provincia)); ?> / 
						<?php echo e(strtoupper($postulante->ubigeocolegio->distrito)); ?>

					<?php endif; ?>
					</strong>
				</td>
			<?php endif; ?>
		</tr>
	</table>
	<div class="sub-title"><h3>5. MODALIDAD Y CARRERA PROFESIONAL</h3></div>
	<table class="table">
		<tr>
			<td class="sub-header">MODALIDAD A LA QUE POSTULA</td>
			<td class="sub-header">CARRERA PROFESIONAL A LA QUE POSTULA</td>
		</tr>
		<tr>
			<td align="center"><strong><?php echo e(strtoupper($postulacion->tarifa->descripcion)); ?></strong></td>
			<td align="center"><strong><?php echo e(strtoupper($postulacion->escuela->descripcion)); ?></strong></td>
		</tr>
	</table>
	<div class="sub-title"><h3>6. ENCUESTAS</h3></div>
	<table class="table">
		<tr>
			<td class="sub-header">MEDIO POR EL CUAL SE ENTERO DEL PROCESO DE ADMISIÓN</td>
			<td class="sub-header">LUGAR DE PREPARACIÓN</td>
		</tr>
		<tr>
			<td align="center"><strong>

					<?php if(strtoupper($postulacion->medioseentero) == 1): ?> VOLANTES
					<?php elseif(strtoupper($postulacion->medioseentero) == 2): ?> FAMILIAR O AMIGO
					<?php elseif(strtoupper($postulacion->medioseentero) == 3): ?> PAGINA WEB INSTITUCIONAL
					<?php elseif(strtoupper($postulacion->medioseentero)	 == 4): ?> FACEBOOK
					<?php elseif(strtoupper($postulacion->medioseentero)	 == 5): ?> RADIO
					<?php elseif(strtoupper($postulacion->medioseentero)	 == 6): ?> TELEVISIÓN
					<?php elseif(strtoupper($postulacion->medioseentero)	 == 7): ?> REVISTA
					<?php elseif(strtoupper($postulacion->medioseentero)	 == 8): ?> OTRO
					<?php endif; ?>

				</strong></td>
			<td align="center"><strong>
					<?php if(strtoupper($postulacion->dondesepreparo) == 1): ?> EN CASA
					<?php elseif(strtoupper($postulacion->dondesepreparo) == 2): ?> CEPRE - UNAB
					<?php elseif(strtoupper($postulacion->dondesepreparo) == 3): ?> ACADEMIA MUNICIPAL
					<?php elseif(strtoupper($postulacion->dondesepreparo)	 == 4): ?> ACADEMIA PARTICULAR
					<?php elseif(strtoupper($postulacion->dondesepreparo)	 == 5): ?> OTRO
					<?php endif; ?>
				</strong></td>
		</tr>
	</table>
	<div class="sub-title"><h3>7. DECLARACIÓN JURADA</h3></div>
	<table class="table-panel">
		<tr>
			<td style="width: 400px">
				<p>
					Declaro bajo Juramento que la información consignada es verdadera, comprometiendome, en caso de lograr una vacante entregar el certificado de estudios secundarios original a esta dependencia.
				</p>
			</td>
			<!-- <td rowspan="2">
				<div class="huella">
					<p><br><br><br><br><br><br><br> (Índice Derecho)</p>
				</div>
			</td> -->
			<td rowspan="2">
				<div class="foto">
					<img src="<?php echo e(asset($postulante->foto)); ?>" alt="">
				</div>
			</td>
		</tr>
		<tr>
			<!-- <td align="center"><br><br> __________________________________ <br>Firma del Postulante</td> -->
		</tr>
	</table>
	<p align="center" style="font-size: 15px"><strong> ADMISIÓN <?php echo e($postulacion->proceso); ?></strong></p>
</body>
</html>