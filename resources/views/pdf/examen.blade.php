<?php if(isset($data["preguntas"])){$preguntas = $data["preguntas"];} ?>
<?php if(isset($data["materias"])){$materias = $data["materias"];} ?>
<?php if(isset($data["evaluacion"])){$evaluacion = $data["evaluacion"];} ?>

<html lang="en">
  <head>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
    <!-- Meta, title, CSS, favicons, etc. -->
    <meta charset="utf-8">


    <!-- Bootstrap -->
    <!-- Font Awesome -->
    <!-- NProgress -->
    <!-- Animate.css -->

    <!-- Custom Theme Style -->




<style type="text/css">

body{
float: left;
text-align: justify;
font-size: 14px;

}
.portadaGeneral{
border-radius: 100px;
position: absolute;
width: 100%;
border: 4px solid #2a3f54;
}
.alternativas{
  font-family: new_font;

  font-size: 12px;
  width: 44%;
  float: left;

}
.contenedor{
  width: 100%;

}
.pregunta{

  font-size: 13px;
}
.izquierda {

  width: 44%;
  float: left;
  padding-right:50px;

}
.izquierdalitle {
  width: 44%;
  float: left;
  font-family: Arial;


}

.imagederecha {
  position: absolute;
  float: right;
  padding-right: -200px;
padding-top: -77px;
}


.derecha {
  width: 44%;
  float: right;
  padding-bottom: 10px;

}
.derechalitle {

  width: 44%;
  float: right;
}
.pagebreak{
  page-break-before: always;

}
.imagen{
  position: absolute;
  left:  5px;
  top: 20px;

}
.imagenreco{
  position: absolute;
  top: 450px;
  left: -70px;
  width: 100%;
  height:100%;

}

.portada{
  top: 20px;

  position: absolute;
  left:  140px;
}
.titlePortada{
  font-weight: bold;
  position: absolute;
  left:  140px;
  font-size: 16px;
  top: 190px;
}
.titlePortada2{
  width: 100%;
  position: absolute;
  font-weight: bold;
  left:  -100px;
  font-size: 43px;
  top: 250px;
  color:red;

}
.titlePortadaAreaB{
  width: 100%;
  position: absolute;
  font-weight: bold;
  font-size: 45px;
  right:  100px;
  top: 340px;
  color:blue;

}.titlePortada4{
  width: 100%;
  position: absolute;
  font-weight: bold;
  left:  150px;
  font-size: 15px;
  top: 899px;

}

.matecorpo{
  color:white;
  font-weight: bold;
z-index: 10;
  font-size: 15px;

  text-transform: uppercase;
  padding-top: 10px;
  padding-left: 30px;
padding-right:  55px;
  background:#2a3f54;
  height: 55px;
  width: 50%;
}
.white{
  color: white;
}
.line{

position: absolute;
 height: 100%;
left: 355px;
background: #2a3f54;
  border: 0,2px solid black;
}


.titleMateria{

width:100%;
}


</style>
</head>

<body>
  <label class="white">.</label>

  <div class="portadaGeneral">
  </div>

<div class="portada">
  <img class="imagen" src="pr/head.png" alt=""/><br>
  <label class="titlePortada"> Creada por Ley N° 29553 </label>
  <?php foreach ($evaluacion as $key => $evaluacion): ?>

  <label class="titlePortada2"> EXAMEN DE ADMISIÓN  <?php echo $evaluacion->descripcion; ?> </label>
<center>  <label class="titlePortadaAreaB">ÁREA   <?php echo $evaluacion->area; ?>  (<?php echo $evaluacion->areanombre; ?>)</label></center>
  <img class="imagenreco" src="pr/recomendaciones.png" alt=""/><br>
  <label class="titlePortada4">Barranca, <?php echo $evaluacion->fecha_evaluacion; ?><label>
  <?php endforeach; ?>

</div>
<div class="pagebreak">
</div>
  <?php foreach ($materias as $key => $materias): ?>
  <?php $i=0;  ?>
  <br>
  <br>
  <div class="matecorpo">

    <?php echo $materias->Materia;?>

  </div>

  <br><br><br>

<?php foreach ($preguntas as $key => $value): ?>


<?php if ($materias->id==$value->id_materia){ ?>



  <?php $i=$i+1;?>

<?php if ($i%2==0){

//  if(strlen($value->pregunta)>270){ echo '<div class="derechalitle">'; }else{ echo '<div class="derecha">';}
?>
<div class="derecha">

   <!-- <?php echo "leng:" ?>
    <?php echo strlen($value->pregunta); ?>
    <?php echo "leng" ?>-->

    <label class="pregunta"><?php echo $i.'. '.$value->pregunta; ?></label> <br><br>
    <div class="contenedor">
              <div class="alternativas">
          <label class="pregunta">A) </label><?php echo $value->A1; ?><br>
          <label class="pregunta">B) </label><?php echo $value->A2; ?><br>
          <label class="pregunta">C) </label><?php echo $value->A3; ?><br>
          <label class="pregunta">D) </label><?php echo $value->A4; ?><br>

          <label class="pregunta">E) </label><?php echo $value->A5; ?><br>
<?php if ($value->img): ?>


        <img class="imagederecha" src="pr/<?php echo $value->img; ?>" alt="">
      <?php endif; ?>

          </div>
    </div>
</div>
<br>
<?php
if(    strlen($value->pregunta)>1010){ echo '<br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br>'; }
elseif(strlen($value->pregunta)>1000){ echo '<br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br>'; }
elseif(strlen($value->pregunta)>900){ echo ' <br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br>'; }
elseif(strlen($value->pregunta)>860){ echo ' <br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br>'; }
elseif(strlen($value->pregunta)>800){ echo ' <br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br>'; }
elseif(strlen($value->pregunta)>790){ echo ' <br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br> '; }
elseif(strlen($value->pregunta)>710){ echo ' <br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br> '; }
elseif(strlen($value->pregunta)>700){ echo ' <br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br> '; }
elseif(strlen($value->pregunta)>600){ echo ' <br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br>'; }
elseif(strlen($value->pregunta)>560){ echo ' <br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br> '; }
elseif(strlen($value->pregunta)>530){ echo ' <br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br> '; }
elseif(strlen($value->pregunta)>520){ echo ' <br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br> '; }
elseif(strlen($value->pregunta)>500){ echo ' <br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br> '; }
elseif(strlen($value->pregunta)>470){ echo ' <br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br>'; }
elseif(strlen($value->pregunta)>460){ echo ' <br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br>'; }
elseif(strlen($value->pregunta)>440){ echo ' <br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br>'; }
elseif(strlen($value->pregunta)>430){ echo ' <br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br>'; }
elseif(strlen($value->pregunta)>410){ echo ' <br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br>'; }
elseif(strlen($value->pregunta)>400){ echo ' <br><br><br><br><br><br><br><br><br><br><br><br><br><br><br>'; }
elseif(strlen($value->pregunta)>390){ echo ' <br><br><br><br><br><br><br><br><br><br><br><br><br><br><br> '; }
elseif(strlen($value->pregunta)>380){ echo ' <br><br><br><br><br><br><br><br><br><br><br><br><br><br>'; }
elseif(strlen($value->pregunta)>370){ echo ' <br><br><br><br><br><br><br><br><br><br><br><br><br><br> '; }
elseif(strlen($value->pregunta)>360){ echo ' <br><br><br><br><br><br><br><br><br><br><br><br><br><br> '; }
elseif(strlen($value->pregunta)>350){ echo ' <br><br><br><br><br><br><br><br><br><br><br><br><br><br> '; }
elseif(strlen($value->pregunta)>340){ echo ' <br><br><br><br><br><br><br><br><br><br><br><br><br><br>  '; }
elseif(strlen($value->pregunta)>330){ echo ' <br><br><br><br><br><br><br><br><br><br><br><br><br><br> '; }
elseif(strlen($value->pregunta)>320){ echo ' <br><br><br><br><br><br><br><br><br><br><br><br><br><br>  '; }
elseif(strlen($value->pregunta)>310){ echo ' <br><br><br><br><br><br><br><br><br><br><br><br><br>  '; }
elseif(strlen($value->pregunta)>300){ echo ' <br><br><br><br><br><br><br><br><br><br><br><br><br> '; }
elseif(strlen($value->pregunta)>290){ echo ' <br><br><br><br><br><br><br><br><br><br><br><br><br>  '; }
elseif(strlen($value->pregunta)>280){ echo ' <br><br><br><br><br><br><br><br><br><br><br><br><br>  '; }
elseif(strlen($value->pregunta)>270){ echo ' <br><br><br><br><br><br><br><br><br><br><br><br><br> '; }
elseif(strlen($value->pregunta)>220){ echo ' <br><br><br><br><br><br><br><br><br><br><br><br> '; }
elseif(strlen($value->pregunta)>210){ echo ' <br><br><br><br><br><br><br><br><br><br><br><br> '; }
 elseif(strlen($value->pregunta)>200){ echo '<br><br><br><br><br><br><br><br><br><br><br><br> '; }
 elseif(strlen($value->pregunta)>190){ echo '<br><br><br><br><br><br><br><br><br><br><br><br';}
 elseif(strlen($value->pregunta)>180){ echo '<br><br><br><br><br><br><br><br><br><br><br>';}
 elseif(strlen($value->pregunta)>170){ echo '<br><br><br><br><br><br><br><br><br><br><br><br>';}
 elseif(strlen($value->pregunta)>168){ echo '<br><br><br><br><br><br><br><br><br><br><br><br>';}
 elseif(strlen($value->pregunta)>160){ echo '<br><br><br><br><br><br><br><br><br><br><br><br>';}
 elseif(strlen($value->pregunta)>150){ echo '<br><br><br><br><br><br><br><br><br><br><br>   ';}
 elseif(strlen($value->pregunta)>140){ echo '<br><br><br><br><br><br><br><br><br>';}
 elseif(strlen($value->pregunta)>130){ echo '<br><br><br><br><br><br><br><br><br><br> ';}
 elseif(strlen($value->pregunta)>120){ echo '<br><br><br><br><br><br><br><br><br><br>  ';}
 elseif(strlen($value->pregunta)>110){ echo '<br><br><br><br><br><br><br><br><br><br>  ';}
 elseif(strlen($value->pregunta)>100){ echo '<br><br><br><br><br><br><br><br><br><br><br> ';}
 elseif(strlen($value->pregunta)>90){  echo '<br><br><br><br><br><br><br><br><br><br><br>';}
 elseif(strlen($value->pregunta)>80){  echo '<br><br><br><br><br><br><br><br><br><br><br> ';}
 elseif(strlen($value->pregunta)>70){  echo '<br><br><br><br><br><br><br><br><br><br><br>  ';}
 elseif(strlen($value->pregunta)>60){  echo '<br><br><br><br><br><br><br><br><br><br><br>';}
 elseif(strlen($value->pregunta)>50){  echo '<br><br><br><br><br><br><br><br><br><br><br> ';}
 elseif(strlen($value->pregunta)>40){  echo '<br><br><br><br><br><br><br><br><br><br><br>';}
 elseif(strlen($value->pregunta)>30){  echo '<br><br><br><br><br><br><br><br><br><br>';}
 elseif(strlen($value->pregunta)>20){  echo '<br><br><br><br><br><br><br><br><br<br> ';}
 elseif(strlen($value->pregunta)>10){  echo '<br><br><br><br><br><br><br><br><br> ';}
 elseif(strlen($value->pregunta)>5){   echo '<br><br><br><br><br><br><br><br><br>';}
elseif(strlen($value->pregunta)>0){    echo '<br><br><br><br><br><br>';}
else{ } ?>
<?php }else{

//if(strlen($value->pregunta)>270){ echo '<div class="izquierdalitle">'; }else{ echo '<div class="izquierda">';}

?>
<div class="line"><label class="">.</label> </div>
<!-- <?php echo $materias->Materia; ?> -->
<div class="izquierda">
<!--
  <?php echo "leng:" ?>
<?php echo strlen($value->pregunta); ?>
<?php echo "leng" ?> -->

    <label class="pregunta"><?php echo $i.'. '.$value->pregunta; ?></label> <br><br>

<div class="contenedor">
        <div class="alternativas">
    <label class="pregunta">A) </label><?php echo $value->A1; ?><br>
    <label class="pregunta">B) </label><?php echo $value->A2; ?><br>
    <label class="pregunta">C) </label><?php echo $value->A3; ?><br>
    <label class="pregunta">D) </label><?php echo $value->A4; ?><br>

    <label class="pregunta">E) </label><?php echo $value->A5; ?><br>



    </div>
</div>
</div>


  <br>



<?php } ?>
<?php } ?>
<?php endforeach; ?>
<?php endforeach; ?>

</body>
</html>
