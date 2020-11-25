<?php if(isset($data["calificacion"])){$calificacion= $data["calificacion"];} ?>

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
		
		.paginacion{
		position:absolute;
		bottom:0px;
		color:red;
		}
		
				
	</style>
</head>
<body>
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
				<td colspan="2"><h1 style="margin:10px 0px 0px 0px; font-size: 28px;" align="center">REPORTE DE INGRESANTES</h1></td>
			</tr>
		</table>
		



<table  width="100%">
  <thead>
    <tr>
      <th >N°</th>
      <th >CODIGO</th>
      <th  >APELLIDOS Y NOMBRES</th>
      <th >ESCUELA PROFESIONAL</th>
      <th  >PUNTAJE</th>
      <th >OBSERVACION</th>
    </tr>
  </thead>
  <tbody>
  
<?php foreach ($calificacion as $key => $value): ?>


		
    <tr>
      <th><?php echo $value->NUM?></th>
      <td><?php echo $value->apellidosnombres?></td>
      <td><?php echo $value->escuela?></td>
      <td><?php echo $value->puntaje?></td>
      <td><?php echo $value->puntaje?></td>
    </tr>
    <?php endforeach; ?>
    </tbody>
</table>

	</div>


</body>
</html>

<script type="text/php">
    if (isset($pdf)){
        $pdf->page_text(765, 550, "Pagina {PAGE_NUM} de {PAGE_COUNT}", 'Arial', 9, array(0, 0, 0));
    }
</script>