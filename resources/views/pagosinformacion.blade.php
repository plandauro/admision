@extends('layouts.master')

@section('title', '')

@section('content')
@parent
<div class="">


  <div class="clearfix"></div>

  <center>
    <div class="row">
      <div class="col-md-12 col-sm-12 col-xs-12">
        <div class="jumbotron">
          <div class="row">
            <div style="margin-bottom: 10px; margin-left: -15px" class="col-md-12">
              <h1 style="margin-top:-20px; font-size: 35px;">
                <strong>INFORMACIÓN DE PAGOS SEGÚN MODALIDAD</strong> 
              </h1>
              <p style=" font-size: 16px;margin-bottom: 15px;">Escoja su modalidad a postular para calcular el pago que debe realizar en el banco:</p>
                <br>
            </div>
            <div style="padding-right: 100px;margin-top: 0px;" class="col-xs-12 col-md-12">
              <p style="margin:0px 0px 10px -15px; font-size: 16px; font-weight: bold"><span></span>Realiza los siguientes depósitos: </p>
              <table id="tblpagos" class="table table-hover">
                <thead>
                  <tr>
                    <th>Descripción</th>
                    <th style="width: 100px">Importe (S/.) </th>
                  </tr>
                </thead>
                <tbody>
                  <tr id="costocarpetatotalX">
                    <td>Carpeta del Postulante</td>
                    <td id="costocarpeta">S/. <input id="costocarpetatotal" style="background: none;border: none; position: absolute;" value=" {{$costocarpeta}}" /></td>
                  </tr>
                  <tr id="costoprospectoatotalX">
                    <td>Prospecto de admisión</td>
                    <td id="costoprospecto">S/. <input id="costoprospectoatotal" style="background: none;border: none; position: absolute;" value=" {{$costoprospecto}}" /></td>
                  </tr>
                  <tr>
                    <td>
                      <select style="width: 450px" class="form-control" name="tarifa" id="tarifa">
                        <option value="0.00">(Seleccionar la modalidad a postular)</option>
                        @foreach($tarifas as $tarifa)
                        <option value="{{$tarifa->costotarifa}}">
                          {{$tarifa->descripcion}}
                        </option>
                        @endforeach
                      </select>
                    </td>
                    <td id="costopostulacion">S/. <label id="idlabel" name="idlabel"></label>
                    </td>
                  </tr>
                </tbody>
                <thead>
                  <tr>
                    <th>Total a depositar</th>
                    <th id="costototal">S/. <input id="costototalinput" style="background: none;border: none; position: absolute;" value=" 0" /></th>
                  </tr>
                </thead>
              </table>
              <p style="font-size: 14px"><strong>Nota: </strong>Puedes realizar el pago en cualquier AGENTE INTERBANK a nivel nacional con el siguiente código:
                <br><br>
              <p style="font-weight:bold; aling:center;"> DEPÓSITOS/PAGOS</p>
              <div class="prueba2">
                <p style="font-weight:bold; aling:center;   width: 600px;   font-size: 15px; "> AGENTE: 25-122-01-{{ $dni }} (PAGO PREFERENCIAL)</p>
              </div>
              <div class="prueba2">
                <p style="font-weight:bold; aling:center;"> VENTANILLA : 05-122-01-{{ $dni }}</p>
              </div>
              </p>
            </div>

            <div class="col-md-12">

            </div>
          </div>

        </div>
      </div>
    </div>
  </center>
</div>
@endsection


@section('css')
<style type="text/css">
  #lista-link li {
    list-style: none;
    margin: 5px 0px 0px 0px;
    font-size: 14px;
    font-weight: bold;
  }

  #lista-link li:hover {
    text-decoration: underline;
  }

  .prueba2 {
    margin: 10px;
    width: 600px;
    height: 50px;
    background-color: #004c99;
    font-size: 16px;

    margin-left: 50px;
    border: 2.5px solid #999;

    color: #fff;
    padding: 10px;
    border-radius: 15px;
    transition-property: width, height, background-color;
    transition-duration: 0.5s, 1s, 1s;
    transition-timing-function: ease, ease-out;
    transition-delay: 0s, 0.5s, 1.5s;

  }
</style>
@endsection

@section('js')

<script type="text/javascript">
  $(document).ready(function() {
    var select = document.getElementById('tarifa');
    select.addEventListener('change',
      function() {
        var selectedOption = this.options[select.selectedIndex];
        console.log(selectedOption.value + ': ' + selectedOption.text);
        document.getElementById("idlabel").innerHTML = selectedOption.value;

        suma = "";
        a = $('#costoprospectoatotal').val();
        b = $('#costocarpetatotal').val();
        suma = parseFloat(a) + parseFloat(b) + parseFloat(selectedOption.value);
        $('#costototalinput').val(' ' + suma + '.00');

        //AGREGADO 07/09/2018
        if (selectedOption.text == "Derecho de Admisión (sólo INGRESANTES POR CEPRE-UNAB)") {
          console.log('asasas');
          document.getElementById("costocarpetatotalX").hidden = true;
          document.getElementById("costoprospectoatotalX").hidden = true;
          $('#costototalinput').val(selectedOption.value);
        } else {
          document.getElementById("costocarpetatotalX").hidden = false;
          document.getElementById("costoprospectoatotalX").hidden = false;
        }


      });


  });
</script>
@endsection