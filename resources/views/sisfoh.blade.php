@extends('layouts.master')

@section('title', '')

@section('content')
  @parent


<div class="">
  <div class="page-title">
    <div class="title_left">
      <h3>Ficha Socioeconómica Única</h3>
    </div>

    <div class="title_right">
      <div class="col-md-5 col-sm-5 col-xs-12 form-group pull-right top_search">
        <div class="input-group">
          <input type="text" class="form-control" placeholder="Search for...">
          <span class="input-group-btn">
                    <button class="btn btn-default" type="button">Go!</button>
                </span>
        </div>
      </div>
    </div>
  </div>
  <div class="clearfix"></div>
  <div class="row">

    <div class="col-md-12 col-sm-12 col-xs-12">
      <div class="x_panel">
        <div class="x_title">
          <h2>Padrón General de Hogares <small>SISFOH</small></h2>
          <div class="clearfix"></div>
        </div>
        <div class="x_content">

          <!-- Smart Wizard -->
          <div id="wizard" class="form_wizard wizard_horizontal">
            <ul class="wizard_steps">
              <li><a href="#step-1"><span class="step_no">1</span></a></li>
              <li><a href="#step-2"><span class="step_no">2</span></a></li>
              <li><a href="#step-3"><span class="step_no">3</span></a></li>
              <li><a href="#step-4"><span class="step_no">4</span></a></li>
              <li><a href="#step-5"><span class="step_no">5</span></a></li>
            </ul>
            <div>
              <div id="step-1">
                <form id="formstep1" class="panel" action="{{ url('sisfoh/save1') }}" method="POST">
                  {{ csrf_field() }}
                  <div class="panel panel-primary">
                    <div class="panel-heading">
                      <h3 class="panel-title">Ubicación Geográfica de la Vivienda</h3>
                    </div>
                    <div class="panel-body">

                      <div class="form-group row">
                        <div class="col-md-2 col-sm-4 col-xs-12">
                          <label for="">Departamento *</label>
                          <select class="form-control" id="selectDepartamento" name="iddepartamento">
                            <option value="0">(Selecciona)</option>
                            @foreach($departamentos as $departamento)
                                <option value="{{ $departamento->iddepa }}" 
                                    @if($departamento->iddepa == substr($ficha->idubigeo, 0,2)."0000") selected 
                                    @endif>
                                  {{ $departamento->departamento }}
                                </option>
                            @endforeach
                          </select>
                        </div>
                        <div class="col-md-2 col-sm-4 col-xs-12">
                          <label for="">Provincia *</label>
                          <select class="form-control" id="selectProvincia" name="idprovincia"
                          @if($provincias == "")
                          disabled>
                            <option value="0">(Selecciona)</option>
                          </select>
                          @else
                            >
                            <option value="0">(Selecciona)</option>
                            @foreach($provincias as $provincia)
                            <option value="{{ $provincia->idprov }}"
                                @if($provincia->idprov == substr($ficha->idubigeo, 0,4)."00")
                                  selected @endif>
                              {{ $provincia->provincia }}
                            </option>
                            @endforeach
                          </select>
                          @endif
                        </div>
                        <div class="col-md-2 col-sm-4 col-xs-12">
                          <label for="">Distrito *</label>
                          <select class="form-control" id="selectDistrito" name="iddistrito"
                           @if($distritos == "")
                          disabled>
                            <option value="0">(Selecciona)</option>
                          </select>
                          @else
                            >
                            <option value="0">(Selecciona)</option>
                            @foreach($distritos as $distrito)
                            <option value="{{ $distrito->iddist }}"
                                @if($distrito->iddist == $ficha->idubigeo)
                                  selected @endif>
                              {{ $distrito->distrito }}
                            </option>
                            @endforeach
                          </select>
                          @endif
                        </div>
                        <div class="col-md-6 col-sm-4 col-xs-12">
                          <label for="">Centro Poblado</label>
                          <input type="text" class="form-control" value="{{ $ficha->centropoblado }}" name="centropoblado" id="centropoblado">
                        </div>
                      </div>
                    </div>
                  </div>

                  <div class="panel panel-primary">
                    <div class="panel-heading">
                      <h3 class="panel-title">Dirección de la Vivienda</h3>
                    </div>
                    <div class="panel-body">
                      <div class="form-group row">
                        <div class="col-md-12 col-sm-12 col-xs-12">
                          <label for="">Tipo de Vía *</label>
                          @foreach($tipovia as $tipo)
                            <span style="margin: 20px;">
                              <input type="radio"  name="tipovia" id="tipovia" 
                                    value="{{ $tipo['codigo'] }}"  required 
                                    @if($ficha->tipovia == $tipo['codigo']) checked @endif
                                    /> 
                              {{ $tipo["descripcion"] }}
                            </span>
                          @endforeach
                        </div>
                      </div>
                      <div class="form-group row">
                        <div class="col-md-3 col-sm-4 col-xs-12">
                          <label for="">Nombre de la vía *</label>
                          <input type="text" name="nombrevia" id="nombrevia" value="{{ $ficha->nombrevia }}" class="form-control">
                        </div>
                        <div class="col-md-1 col-sm-2 col-xs-4">
                          <label for="">Número</label>
                          <input type="text" name="numeropuerta" id="numeropuerta" value="{{ $ficha->numeropuerta }}" class="form-control">
                        </div>
                        <div class="col-md-1 col-sm-2 col-xs-4">
                          <label for="">Block</label>
                          <input type="text" name="block" id="block" value="{{ $ficha->block }}" class="form-control">
                        </div>
                        <div class="col-md-1 col-sm-2 col-xs-4">
                          <label for="">Piso</label>
                          <input type="text" name="piso" id="piso" value="{{ $ficha->piso }}" class="form-control">
                        </div>
                        <div class="col-md-1 col-sm-2 col-xs-4">
                          <label for="">Interior</label>
                          <input type="text" name="interior" id="interior" value="{{ $ficha->interior }}" class="form-control">
                        </div>
                        <div class="col-md-1 col-sm-2 col-xs-4">
                          <label for="">Manzana</label>
                          <input type="text" name="manzana" id="manzana" value="{{ $ficha->manzana }}" class="form-control">
                        </div>
                        <div class="col-md-1 col-sm-2 col-xs-4">
                          <label for="">Lote</label>
                          <input type="text" name="lote" id="lote" value="{{ $ficha->lote }}" class="form-control">
                        </div>
                        <div class="col-md-1 col-sm-2 col-xs-4">
                          <label for="">Km</label>
                          <input type="text" name="kilometro" id="kilometro" value="{{ $ficha->kilometro }}" class="form-control">
                        </div>
                        <div class="col-md-2 col-sm-3 col-xs-6">
                          <label for="">Teléfono</label>
                          <input type="text" name="telefono" id="telefono" value="{{ $ficha->telefono }}" class="form-control">
                        </div>
                      </div>
                    </div>
                  </div>
                </form>
              </div>
              <div id="step-2">
                <form id="formstep2" class="panel" action="{{ url('sisfoh/save2') }}" method="POST">
                  {{ csrf_field() }}
                  <div class="panel panel-primary">
                    <div class="panel-heading">
                      <h3 class="panel-title">Características de la Vivienda</h3>
                    </div>
                    <div class="panel-body">
                      <div class="form-group row">
                        @foreach($lista as $sublista)
                          <div class="col-md-4 col-sm-4 col-xs-6">
                            <div class="form-group">
                              <label style="height: 3em;margin-top: 1em;">{{$sublista["titulo"]}}</label>
                              <select id="{{$sublista['idselect']}}" name="{{$sublista['name']}}" class="form-control">
                                @foreach ($sublista['lista'] as $item)
                                    <option value="{{ $item['codigo'] }}"
                                    @if(
                                      ($sublista['name'] == "tipovivienda" && $item['codigo'] == $ficha->tipovivienda) ||
                                      ($sublista['name'] == "suviviendaes" && $item['codigo'] == $ficha->suviviendaes) || 
                                      ($sublista['name'] == "materialparedes" && $item['codigo'] == $ficha->materialparedes) ||
                                      ($sublista['name'] == "materialtecho" && $item['codigo'] == $ficha->materialtecho) ||
                                      ($sublista['name'] == "materialpiso" && $item['codigo'] == $ficha->materialpiso) ||
                                      ($sublista['name'] == "tipoalumrado" && $item['codigo'] == $ficha->tipoalumrado) ||
                                      ($sublista['name'] == "abastecimientoagua" && $item['codigo'] == $ficha->abastecimientoagua) ||
                                      ($sublista['name'] == "serviciohigienico" && $item['codigo'] == $ficha->serviciohigienico)
                                    ) selected @endif
                                    >
                                      {{ $item["descripcion"] }}
                                    </option>
                                @endforeach
                              </select>
                              @if(strcmp($sublista['idtext'],'') !== 0)
                              <input type="text" style="margin-top: 5px;" id="{{$sublista['idtext']}}" name="{{$sublista['name'].'otro'}}"  class="form-control" name="" placeholder="Otro..."
                              @if($sublista['name'] == "tipovivienda" && strcmp($ficha->tipoviviendaotro,'')) value='{{$ficha->tipoviviendaotro}}'
                              @elseif($sublista['name'] == "suviviendaes" && strcmp($ficha->suviviendaesotro,'')) value='{{$ficha->suviviendaesotro}}'
                              @elseif($sublista['name'] == "materialparedes" && strcmp($ficha->materialparedesotro,'')) value='{{$ficha->materialparedesotro}}'
                              @elseif($sublista['name'] == "materialtecho" && strcmp($ficha->materialtechootro,'')) value='{{$ficha->materialtechootro}}'
                              @elseif($sublista['name'] == "materialpiso" && strcmp($ficha->materialpisootro,'')) value='{{$ficha->materialpisootro}}'
                              @elseif($sublista['name'] == "tipoalumrado" && strcmp($ficha->tipoalumradootro,'')) value='{{$ficha->tipoalumradootro}}'
                              @elseif($sublista['name'] == "abastecimientoagua" && strcmp($ficha->abastecimientoaguaotro,'')) value='{{$ficha->abastecimientoaguaotro}}' 
                              @else
                                disabled="true"
                              @endif
                              '>
                              @endif
                            </div>
                          </div>
                        @endforeach
                        <div class="col-md-4 col-sm-4 col-xs-6">
                          <div class="form-group">
                            <label style="height: 3em;margin-top: 1em;">9. ¿Cuántas horas demoran en llegar desde su vivienda a la capital distrital? </label>
                            <div class="row">
                              <div class="col-sm-4">
                                <input type="number" name="numberHorasDemoraLlegar" id="numberHorasDemoraLlegar" min="0" max="24" name="" class="form-control" value="{{ $ficha->demorallegarhoras }}">
                                <center>
                                  
                                </center>
                              </div>
                              <div class="col-sm-8" style="margin-bottom: 20px;">
                                <a class="btn btn-warning btn-xs"  id="btnHorasDemoraLlegar" 
                                  style="margin-top: 3px; 
                                  @if($ficha->demorallegar == 1 || $ficha->demorallegar == 2)  @else display: none; @endif">
                                  <span class="glyphicon glyphicon-time" aria-hidden="true"></span>
                                </a>
                                <small>(Si es menor a una hora anote 0)</small>
                              </div>
                              <div class="col-sm-12">
                                <input type="radio" name="radioHorasDemoraLlegar" value="1" @if($ficha->demorallegar == 1) checked @endif> Más de 24 horas<br>

                                <input type="radio" name="radioHorasDemoraLlegar" value="2"  @if($ficha->demorallegar == 2) checked @endif> Vive en la capital distrital
                              </div>
                            </div>
                          </div>
                        </div>
                      </div>
                    </div>
                  </div>
                </form>
              </div>
              <div id="step-3">
                <form id="formstep3" class="panel" action="{{ url('sisfoh/save3') }}" method="POST">
                  {{ csrf_field() }}
                  <div class="panel panel-primary">
                    <div class="panel-heading">
                      <h3 class="panel-title">Datos del Hogar</h3>
                    </div>
                    <div class="panel-body">
                      <div class="form-group row">
                      <div class="col-md-12 col-sm-12 col-xs-12">
                        <div class="form-group row">
                          <div class="col-sm-8 col-md-8 col-xs-8">
                            <label>1. Sin contar baño, cocina, pazadizos, ni garaje ¿Cuántas habitaciones ocupa tu hogar?</label>
                          </div>
                          <div class="col-xs-4 col-sm-2 col-md-2">
                            <input type="number" class="form-control" max="100" min="1" value="{{ $ficha->cantidadhabitaciones }}" name="cantidadhabitaciones" id="cantidadhabitaciones">
                          </div>
                        </div>
                      </div>
                      <div class="col-md-12 col-sm-12 col-xs-12">
                        <div class="form-group row">
                          <div class="col-md-6">
                            <label>
                            2. ¿Cuál es el combustible que más se utliza en el hogar para cocinar?
                            </label>
                          </div>
                          <div class="col-md-3">
                            <select id="selectCombustibleMasUsado" class="form-control" name="combustible" id="combustible">
                              <option value="">( Selecciona )</option>
                              <option value="1" @if($ficha->combustible == 1) selected @endif>¿Electricidad?</option>
                              <option value="2" @if($ficha->combustible == 2) selected @endif>¿Gas?</option>
                              <option value="3" @if($ficha->combustible == 3) selected @endif>¿Kerosene?</option>
                              <option value="4" @if($ficha->combustible == 4) selected @endif>¿Carbón?</option>
                              <option value="5" @if($ficha->combustible == 5) selected @endif>¿Leña?</option>
                              <option value="6" @if($ficha->combustible == 6) selected @endif>¿Bosta o estiercol?</option>
                              <option value="7" @if($ficha->combustible == 7) selected @endif>Otro (Especifique)</option>
                              <option value="8" @if($ficha->combustible == 8) selected @endif>NO TIENE</option>
                            </select>
                          </div>
                          <div class="col-md-3">
                            <input type="text" id="txtCombustibleMasUsado" disabled="true" class="form-control" name="combustibleotro" id="combustibleotro" placeholder="Otro..." value="{{ $ficha->combustibleotro }}">
                          </div>
                        </div>
                      </div>
                      <div class="col-md-12 col-sm-12 col-xs-12">
                        <label>3. Su hogar tiene:</label>
                        <div class="form-group row" style="margin-left: 20px;">
                            <label style="width: 200px;">
                              <input type="checkbox" class="optionhogar" id="equiposonido" name="equiposonido" value="1" 
                              @if($ficha->equiposonido) checked @endif> 1.Equipo de Sonido
                            </label>
                            <label style="width: 200px;">
                              <input type="checkbox" class="optionhogar" name="televisorcolor" value="1" 
                              @if($ficha->televisorcolor) checked @endif> 2.Televisor a Color
                            </label>
                            <label style="width: 200px;">
                              <input type="checkbox" class="optionhogar" name="dvd" value="1" 
                              @if($ficha->dvd) checked @endif> 3.DVD
                            </label>
                            <label style="width: 200px;">
                              <input type="checkbox" class="optionhogar" name="licuadora" value="1"
                              @if($ficha->licuadora) checked @endif> 4.Licuadora
                            </label>
                            <label style="width: 200px;">
                              <input type="checkbox" class="optionhogar" name="refrigeradora" value="1"
                              @if($ficha->refrigeradora) checked @endif> 5.Refrigeradora/congeladora
                            </label>
                            <label style="width: 200px;">
                              <input type="checkbox" class="optionhogar" name="cocinagas" value="1"
                              @if($ficha->cocinagas) checked @endif> 6.Cocina a gas
                            </label>
                            <label style="width: 200px;">
                              <input type="checkbox" class="optionhogar" name="telefonofijo" value="1"
                              @if($ficha->telefonofijo) checked @endif> 7.Telefono fijo
                            </label>
                            <label style="width: 200px;">
                              <input type="checkbox" class="optionhogar" name="planchaelectrica" value="1"
                              @if($ficha->planchaelectrica) checked @endif> 8.Plancha eléctrica
                            </label>
                            <label style="width: 200px;">
                              <input type="checkbox" class="optionhogar" name="lavadora" value="1"
                              @if($ficha->lavadora) checked @endif> 9.Lavadora
                            </label>
                            <label style="width: 200px;">
                              <input type="checkbox" class="optionhogar" name="computadora" value="1"
                              @if($ficha->computadora) checked @endif> 10.Computadora
                            </label>
                            <label style="width: 200px;">
                              <input type="checkbox" class="optionhogar" name="hornomicroondas" value="1"
                              @if($ficha->hornomicroondas) checked @endif> 11.Horno microondas
                            </label>
                            <label style="width: 200px;">
                              <input type="checkbox" class="optionhogar" name="internet" value="1"
                              @if($ficha->internet) checked @endif> 12.Internet
                            </label>
                            <label style="width: 200px;">
                              <input type="checkbox" class="optionhogar" name="cable" value="1"
                              @if($ficha->cable) checked @endif> 13.Cable
                            </label>
                            <label style="width: 200px;">
                              <input type="checkbox" class="optionhogar" name="celular" value="1"
                              @if($ficha->celular) checked @endif> 14.Celular
                            </label>
                            <label style="width: 200px;">
                              <input type="checkbox" name="ninguno" value="1" id="ninguno" 
                              onchange ="if($(this).prop('checked')){ $('.optionhogar').prop('checked', false); }"> 15.No tiene ninguno
                            </label>
                        </div>
                      </div><br>
                     

                      <div class="col-md-12 col-sm-12 col-xs-12">
                        <label>4. ¿Cuántas personas viven permanentemente en este hogar?</label>
                        
                        <div class="form-group row">
                          <div class="col-xs-3 col-sm-2 col-md-2">
                            <div class="form-group">
                              <label>Hombres</label>
                              <input type="number" id="canthombres" class="form-control"  
                                    onchange="$('#totalpersonas').val(parseInt($(this).val()) + parseInt($('#cantmujeres').val())) ;" 
                                    value="{{$ficha->cantidadhombres}}" min="0" name="cantidadhombres">
                            </div>
                          </div>
                          <div class="col-md-1"><br><center>+</center></div>
                          <div class="col-xs-3 col-sm-2 col-md-2">
                            <label>Mujeres</label>
                            <input type="number" id="cantmujeres" 
                              onchange="$('#totalpersonas').val(parseInt($(this).val()) + parseInt($('#canthombres').val())) ;" 
                              class="form-control" value="{{$ficha->cantidadmujeres}}" min="0" name="cantidadmujeres">
                          </div>
                          <div class="col-md-1"><br><center>=</center></div>
                          <div class="col-xs-3 col-sm-2 col-md-2">
                            <label>Total</label>
                            <input type="number" disabled="true" class="form-control" value="0" name="totalpersonas" id="totalpersonas" name="">
                          </div>
                        </div>
                        
                      </div>
                    </div>
                    </div>
                  </div>
                </form>
              </div>
              <div id="step-4">
                <form id="formstep4" class="panel" action="{{ url('sisfoh/save4') }}" method="POST">
                  <div id="panelPoblacion" class="panel panel-primary">
                    <div class="panel-heading">
                      <div class="row">
                        <div class="col-xs-8">
                          <h3 class="panel-title">Características de la población</h3>
                        </div>
                        <div class="col-xs-4">
                          <button type="button" id="btnNuevoPoblacion" onclick="nuevoPoblacion();" style="margin:0px" class="btn btn-warning  btn-xs pull-right" data-toggle="modal" data-target=".bs-example-modal-lg">
                            <span class="fa fa-plus"></span>  Agregar  
                          </button>
                        </div>
                      </div>
                    </div>
                    <div class="panel-body">
                      <div class="row">
                        <div class="col-md-12 col-sm-12 col-xs-12">
                          <table id="table-poblacion" class="table table-hover responsie">
                            <thead>
                              <tr>
                                <th>#</th>
                                <th>Ap. Paterno</th>
                                <th>Ap. Materno</th>
                                <th>Nombres</th>
                                <th>Documento</th>
                                <th>Sexo</th>
                                <th>Parentesco con Jefe de Hogar</th>
                                <th></th>
                              </tr>
                            </thead>
                            <tbody id="body-table-poblacion">
                              
                            </tbody>
                          </table>
                        </div>
                      </div>
                    </div>
                  </div>
                </form>
              </div>
              <div id="step-5">
              </div>
          </div>

          </div>

        </div>
      </div>
    </div>
  </div>  
</div>


<!--  MODAL -->
<!-- Población -->
<div class="modal fade bs-example-modal-lg" id="myModal" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog modal-lg">
      <div class="modal-content">

        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">×</span>
          </button>
          <h4 class="modal-title" id="myModalLabel">
            <span class="glyphicon glyphicon-user" aria-hidden="true"></span> Agregar nuevo miembro del hogar
            <img class="loading-spin pull-right" style="display: none;" width="40px" src="{{ asset('images/loading.gif') }}">
          </h4>
        </div>
        <div class="modal-body">
          <form id="frmPoblacion" action="{{ url('poblacion/save') }}" class="form-horizontal form-label-left">
            
            <input type="text" style="display: none" id="idpersona" name="idpersona" value="0">
            <div class="panel panel-primary">
              <div class="panel-heading">Características de la población</div>
              <div class="panel-body">
                <div class="row">
                  <div class="col-md-6 col-sm-6 col-xs-12">
                    <!-- input -->
                    <div class="form-group">
                      <label class="control-label col-md-5 col-sm-5 col-xs-12" for="">Apellido Paterno</label>
                      <div class="col-md-7 col-sm-7 col-xs-12">
                        <input type="text" class="form-control" id="apepaterno" name="apepaterno">
                      </div>
                    </div>
                    <!-- input -->
                    <div class="form-group">
                      <label class="control-label col-md-5 col-sm-5 col-xs-12" for="">Apellido Materno</label>
                      <div class="col-md-7 col-sm-7 col-xs-12">
                        <input type="text" class="form-control col-md-7 col-xs-12" id="apematerno" name="apematerno">
                      </div>
                    </div>
                    <!-- input -->
                    <div class="form-group">
                      <label class="control-label col-md-5 col-sm-5 col-xs-12" for="">Nombres</label>
                      <div class="col-md-7 col-sm-7 col-xs-12">
                        <input type="text" class="form-control col-md-7 col-xs-12" id="nombres" name="nombres">
                      </div>
                    </div>
                     <!-- input -->
                    <div class="form-group">
                      <label class="control-label col-md-5 col-sm-5 col-xs-12" for="">Fecha de Nacimiento</label>
                      <div class="col-md-7 col-sm-7 col-xs-12">
                        <input type="date" class="form-control has-feedback-left"  id="fechanacimiento" name=" fechanacimiento" aria-describedby="inputSuccess2Status2">
                        <span class="fa fa-calendar-o form-control-feedback left" aria-hidden="true"></span>
                        <span id="inputSuccess2Status2" class="sr-only">(success)</span>
                      </div>
                    </div>
                    <!-- input -->
                    <div class="form-group">
                      <label class="control-label col-md-5 col-sm-5 col-xs-12" for="">Tipo de Doc.</label>
                      <div class="col-md-7 col-sm-7 col-xs-12">
                        <select  id="tipodocumento" name="tipodocumento" class="form-control" 
                          onchange="if($(this).val() == '') $('#numerodocumento').prop('disabled', true); else $('#numerodocumento').prop('disabled', false);">
                          <option value="">(Seleccionar)</option>
                          <option value="1">DNI</option>
                          <option value="2">Part. Nac. - CUI</option>
                          <option value="3">Carné Ex.</option>
                          <option value="4">No tiene doc.</option>
                        </select>
                      </div>
                    </div>
                    <!-- input -->
                    <div class="form-group">
                      <label class="control-label col-md-5 col-sm-5 col-xs-12" for="">Número de Documento</label>
                      <div class="col-md-7 col-sm-7 col-xs-12">
                        <input type="text" id="numerodocumento" max="8" min="8" name="numerodocumento" class="form-control col-md-7 col-xs-12" disabled="true">
                      </div>
                    </div>
                  </div>

                  <div class="col-md-6 col-sm-6 col-xs-12">
                    <!-- input -->
                    <div class="form-group">
                      <label class="control-label col-md-5 col-sm-5 col-xs-12" for="">Parentesco con el Jefe de Hogar</label>
                      <div class="col-md-7 col-sm-7 col-xs-12">
                        <select id="parentescojefe" name="parentescojefe" class="form-control">
                          <option value="">(Seleccionar)</option>
                          <option value="1">Jefe</option>
                          <option value="2">Cónyugue</option>
                          <option value="3">Hijo/a</option>
                          <option value="4">Yerno / Nuera</option>
                          <option value="5">Nieto/a</option>
                          <option value="6">Padres/suegros</option>
                          <option value="7">Hermano/a</option>
                          <option value="8">Trabajador del hogar</option>
                          <option value="9">Pensionista</option>
                          <option value="10">Otros Parientes</option>
                          <option value="11">Otros no Parientes</option>
                        </select>
                      </div>
                    </div>
                    <!-- input -->
                    <div class="form-group">
                      <label class="control-label col-md-5 col-sm-5 col-xs-12" for="">Estado Civil</label>
                      <div class="col-md-7 col-sm-7 col-xs-12">
                        <select id="estadocivil" name="estadocivil" class="form-control">
                          <option value="">(Seleccionar)</option>
                          <option value="1">Soltero/a</option>
                          <option value="2">Casado/a</option>
                          <option value="3">Conviviente</option>
                          <option value="4">Separado/a</option>
                          <option value="5">Divorciado/a</option>
                          <option value="6">Viudo</option>
                        </select>
                      </div>
                    </div> 
                    <!-- input -->
                    <div class="form-group">
                      <label class="control-label col-md-5 col-sm-5 col-xs-12" for="">Sexo</label>
                      <div class="col-md-7 col-sm-7 col-xs-12">
                        <p style="margin: 7px 0px 7px 0px">
                          <span style="margin-right: 10px;">
                              <input type="radio" class="inputsexo"  id="sexoM" name="sexo" value="M" />
                               Hombre 
                          </span>
                          <span>
                              <input type="radio" class="inputsexo"  id="sexoF" name="sexo" value="F" />
                              Mujer
                          </span>
                        </p>
                      </div>
                    </div> 
                    <!-- input -->
                    <div class="form-group">
                      <label class="control-label col-md-5 col-sm-5 col-xs-12" for="">Gestante</label>
                      <div class="col-md-7 col-sm-7 col-xs-12">
                        <p style="margin: 7px 0px 0px 0px">
                          <span style="margin-right: 10px;" >
                              <input type="radio" class="inputgestante"  id="gestante" name="gestante" disabled="" value="1" />
                              SI 
                          </span>
                          <span>
                              <input type="radio" class="inputgestante"  id="gestante" name="gestante" disabled="" value="0" />
                              NO  
                          </span>
                        </p>
                      </div>
                    </div> 
                    <!-- input -->
                    <div class="form-group">
                      <label style="margin-top: -4px; padding: 0px;" class="col-md-12 col-sm-12 col-xs-12" for="">¿Qué tipo de Seguro de salud tiene?</label>
                      <div class="col-xs-1"></div>
                      <div class="col-md-11 col-sm-11 col-xs-11">
                        <div class="row">
                          <div style="margin-bottom: 5px;" class="col-xs-4 col-sm-6 col-md-6">
                            <input type="checkbox" id="seguroessalud" name="seguroessalud" value="1" required class="seguro" /> Essalud
                          </div>
                          <div style="margin-bottom: 5px;"  class="col-xs-4 col-sm-6 col-md-6">
                            <input type="checkbox" id="segurofapnp" name="segurofapnp" value="1" required class="seguro" /> FF.AA. - P.N.P
                          </div>
                          <div style="margin-bottom: 5px;" class="col-xs-4 col-sm-6 col-md-6">
                            <input type="checkbox" id="seguroprivado" name="seguroprivado" value="1" required class="seguro" /> Seguro Privado
                          </div>
                          <div style="margin-bottom: 5px;" class="col-xs-4 col-sm-6 col-md-6">
                            <input type="checkbox" id="segurosis" name="segurosis" value="1" required class="seguro" /> SIS
                          </div>
                          <div style="margin-bottom: 5px;" class="col-xs-4 col-sm-6 col-md-6">
                            <input type="checkbox" id="segurootro" name="segurootro" value="1" required class="seguro" /> Otro
                          </div>
                          <div style="margin-bottom: 5px;" class="col-xs-4 col-sm-6 col-md-6">
                            <input type="checkbox" id="seguronotiene" name="seguronotiene" value="1" required class="" /> No tiene
                          </div>
                        </div>
                      </div>
                    </div>     
                  </div>
                </div>
              </div>
            </div>
            <div class="panel panel-primary">
              <div class="panel-heading">Educación</div>
              <div class="panel-body">
                <div class="row">
                  <div class="col-md-6 col-sm-6 col-xs-12">
                    <!-- input -->
                    <div class="form-group">
                      <label class="control-label col-md-5 col-sm-5 col-xs-12" for="">¿Qué idioma aprendió a hablar en su niñez?</label>
                      <div class="col-md-7 col-sm-7 col-xs-12">
                        <select name="idiomaninez" id="idiomaninez" class="form-control">
                          <option value="">(Seleccionar)</option>
                          <option value="1">Quechua</option>
                          <option value="2">Aymara</option>
                          <option value="3">Ashaninka</option>
                          <option value="4">Castellano</option>
                          <option value="5">Idioma extranjero</option>
                          <option value="6">Es sordomudo</option>
                          <option value="7">Otro</option>
                        </select>
                      </div>
                    </div>
                    <!-- input -->
                    <div class="form-group">
                      <label class="control-label col-md-5 col-sm-5 col-xs-12" for="">¿Sabe leer y escribir?</label>
                      <div class="col-md-7 col-sm-7 col-xs-12">
                        <p style="margin: 7px 0px 0px 0px">
                          <span style="margin-right: 15px;" >
                              SI <input type="radio" class="radiosabeleer" name="sabeleer" id="leesi" value="1" required/> 
                          </span>
                          <span>
                              NO <input type="radio" class="radiosabeleer" name="sabeleer" id="leeno" value="0" required/>
                          </span>
                        </p>
                      </div>
                    </div> 
                  </div>

                  <div class="col-md-6 col-sm-6 col-xs-12">
                    <!-- input -->
                    <div class="form-group">
                      <label class="control-label col-md-5 col-sm-5 col-xs-12" for="">Nivel educativo</label>
                      <div class="col-md-7 col-sm-7 col-xs-12">
                        <select name="niveleducativo" id="niveleducativo" class="form-control">
                          <option value="">(Seleccionar)</option>
                          <option value="1">Ninguno</option>
                          <option value="2">Inicial</option>
                          <option value="3">Primaria</option>
                          <option value="4">Secundari</option>
                          <option value="5">Superior no universitaria</option>
                          <option value="6">Superior universitaria</option>
                          <option value="7">Post grado u otro similar</option>
                        </select>
                      </div>
                    </div>
                    <!-- input -->
                    <div class="form-group">
                      <label class="control-label col-md-5 col-sm-5 col-xs-12" for="">Último año aprobado</label>
                      <div class="col-md-7 col-sm-7 col-xs-12">
                        <select name="ultimogrado" id="ultimogrado" class="form-control">
                          <option value="">(Seleccionar)</option>
                          <option value="1">1</option>
                          <option value="2">2</option>
                          <option value="3">3</option>
                          <option value="4">4</option>
                          <option value="5">5</option>
                          <option value="6">6</option>
                        </select>
                      </div>
                    </div>
                  </div>
                </div>
              </div>
            </div>
            <div class="panel panel-primary">
              <div class="panel-heading">Ocupación</div>
              <div class="panel-body">
                <div class="row">
                  <div class="col-md-6 col-sm-6 col-xs-12">
                    <!-- input -->
                    <div class="form-group">
                      <label class="control-label col-md-5 col-sm-5 col-xs-12" for="">¿En el último mes era un...?</label>
                      <div class="col-md-7 col-sm-7 col-xs-12">
                        <select name="ocupacionultimomes" id="ocupacionultimomes" class="form-control">
                          <option value="">(Seleccionar)</option>
                          <option value="1">Trabajador dependiente</option>
                          <option value="2">Trabajador independiente</option>
                          <option value="3">Emplaedo</option>
                          <option value="4">Trabajador del hogar</option>
                          <option value="5">Trabajador del hogar no remunerado</option>
                          <option value="6">Desempleado</option>
                          <option value="7">Dedicado a los quehaceres del hogar</option>
                          <option value="8">Estudiante</option>
                          <option value="9">Jubilado</option>
                          <option value="10">Sin actividad</option>
                        </select>
                      </div>
                    </div>
                  </div>
                  <div class="col-md-6 col-sm-6 col-xs-12">
                    <!-- input -->
                    <div class="form-group">
                      <label class="control-label col-md-5 col-sm-5 col-xs-12" for="">Sector en el que se desempeña</label>
                      <div class="col-md-7 col-sm-7 col-xs-12">
                        <select name="sector" id="sector" class="form-control">
                          <option value="">(Seleccionar)</option>
                          <option value="1">Agrícola</option>
                          <option value="2">Pecuaria</option>
                          <option value="3">Forestal</option>
                          <option value="4">Pesquera</option>
                          <option value="5">Minera</option>
                          <option value="6">Artesanal</option>
                          <option value="7">Comercial</option>
                          <option value="8">Servicios</option>
                          <option value="9">Otro</option>
                          <option value="10">Estado(Gob.)</option>
                        </select>
                      </div>
                    </div>
                  </div>
                </div>
              </div>
            </div>
            <div class="panel panel-primary">
              <div class="panel-heading">Discapacidad</div>
              <div class="panel-body">
                <div class="row">
                  <div class="col-xs-12">
                     <!-- input -->
                    <div class="form-group">
                      <label class="col-xs-12" for="">¿Presenta algún tipo de discapacidad?</label>
                      <div class="col-xs-12">
                        <div class="row">
                          <div style="margin-bottom: 5px;" class="col-xs-4 col-sm-4" title="Problemas para ver aún con lentes / no puede ver">
                            <input type="checkbox" name="discapacidadvisual" id="discapacidadvisual" value="1"  required class="discapacidad" /> Visual particial o total
                          </div>
                          <div style="margin-bottom: 5px;"  class="col-xs-4 col-sm-4" title="Problemas para oír con audífonos / no puede oír">
                            <input type="checkbox" name="discapacidadoir" id="discapacidadoir" value="1" required class="discapacidad" /> Para oír parcial o total
                          </div>
                          <div style="margin-bottom: 5px;" class="col-xs-4 col-sm-4" title="Dificultad para hablar / no puede hablar">
                            <input type="checkbox" name="discapacidadhablar" id="discapacidadhablar" value="1" required class="discapacidad" /> Para hablar parcial o total
                          </div>
                          <div style="margin-bottom: 5px;" class="col-xs-4 col-sm-4">
                            <input type="checkbox" name="discapacidadusarbrazos" id="discapacidadusarbrazos" value="1" required class="discapacidad" /> Para usar brazos y manos / piernas y pies
                          </div>
                          <div style="margin-bottom: 5px;" class="col-xs-4 col-sm-4" title="Dificultades permanentes para entender o para relacionarse con los demás">
                            <input type="checkbox" name="discapacidadmental" id="discapacidadmental" value="1" required class="discapacidad" /> Mental o intelectual
                          </div>
                          <div style="margin-bottom: 5px;" class="col-xs-4 col-sm-4">
                            <input type="checkbox" name="" id="dispacidadnotiene" value="1" required class="" /> No tiene discapacidad
                          </div>
                        </div>
                      </div>
                    </div>
                  </div>
                </div>
              </div>
            </div>
            <div class="panel panel-primary">
              <div class="panel-heading">Programas Sociales</div>
              <div class="panel-body">
                <div class="row">
                  <label class="col-xs-12" for="">¿De qué programa social es beneficiario en la actualidad?</label>
                  <div class="col-xs-12">
                    <div class="row">
                      <div style="margin-bottom: 5px;" class="col-xs-4 col-sm-4">
                        <input type="checkbox" name="vasoleche" id="vasoleche" value="1"  required class="programasocial" /> Vaso de leche
                      </div>
                      <div style="margin-bottom: 5px;"  class="col-xs-4 col-sm-4">
                        <input type="checkbox" name="comedorpopular" id="comedorpopular" value="1" required class="programasocial" /> Comedor popular
                      </div>
                      <div style="margin-bottom: 5px;" class="col-xs-4 col-sm-4">
                        <input type="checkbox" name="comidaescolar" id="comidaescolar" value="1" required class="programasocial" /> Desayuno o almuerzo escolar
                      </div>
                      <div style="margin-bottom: 5px;" class="col-xs-4 col-sm-4">
                        <input type="checkbox" name="papilla" id="papilla" value="1" required class="programasocial" /> Papilla o "Yapita"
                      </div>
                      <div style="margin-bottom: 5px;" class="col-xs-4 col-sm-4">
                        <input type="checkbox" name="canastaalimentaria" id="canastaalimentaria" value="1" required class="programasocial" /> Canasta alimentaria
                      </div>
                      <div style="margin-bottom: 5px;" class="col-xs-4 col-sm-4">
                        <input type="checkbox" name="juntos" id="juntos" value="1" required class="programasocial" /> Juntos
                      </div>
                      <div style="margin-bottom: 5px;" class="col-xs-4 col-sm-4">
                        <input type="checkbox" name="techopropio" id="techopropio" value="1" required class="programasocial" /> Techo Propio o mi vivienda
                      </div>
                      <div style="margin-bottom: 5px;" class="col-xs-4 col-sm-4">
                        <input type="checkbox" name="pension" id="pension" value="1" required class="programasocial" /> Pensión 65
                      </div>
                      <div style="margin-bottom: 5px;" class="col-xs-4 col-sm-4">
                        <input type="checkbox" name="cunamas" id="cunamas" value="1" required class="programasocial" /> Cuna Más
                      </div>
                      <div style="margin-bottom: 5px;" class="col-xs-4 col-sm-4">
                        <input type="checkbox" name="otros" id="otros" value="1" required class="programasocial" /> Otros
                      </div>
                      <div style="margin-bottom: 5px;" class="col-xs-4 col-sm-4">
                        <input type="checkbox" name="" id="programaninguno" value="1" required class="" /> Ninguno
                      </div>
                    </div>
                  </div>
                </div>
              </div>
            </div>
          </form> 

        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-danger" id="btnCancelarPersona" data-dismiss="modal">
            <span class="glyphicon glyphicon-remove-sign" aria-hidden="true"></span> Cancelar
          </button>
          <button type="button" class="btn btn-primary" id="btnAgregarPersona" onclick="savePoblacion()">
            <span class="glyphicon glyphicon-plus-sign" aria-hidden="true"></span> 
            <img class="loading-spin" style="display: none;" width="30px" src="{{ asset('images/loading.gif') }}">Guardar
          </button>
        </div>

      </div>
    </div>
</div>

<!-- Pregunta -->
<div class="modal fade bs-example-modal-sm" id="questionModal" tabindex="-1" role="dialog" aria-hidden="true">
  <div class="modal-dialog modal-sm" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <h4 class="modal-title" id="myModalLabel">Pregunta</h4>
      </div>
      <div class="modal-body">
        En esta sección debe agregar a todos los miembros de su hogar. ¿Desea continuar?
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-default" id="addmore" onclick="continuar4(1);" data-dismiss="modal">
          <span class="fa fa-plus"></span> Agregar más miembros
        </button>
        <button type="button" onclick="continuar4(2);" class="btn btn-primary" data-dismiss="modal">Continuar</button>
      </div>
    </div>
  </div>
</div>
       
@endsection

@section('css')
    <!-- NProgress -->
    <link href="{{ asset('css/nprogress.css') }}" rel="stylesheet">
    <!-- iCheck -->
    <link href="{{ asset('css/green.css') }}" rel="stylesheet">
    <!-- bootstrap-daterangepicker -->
    <link href="{{ asset('css/daterangepicker.css') }}" rel="stylesheet">
    <!-- Select2 -->
    <link href="{{ asset('css/select2.min.css') }}" rel="stylesheet">
    <link href="{{ asset('css/dataTables.bootstrap.min.css') }}" rel="stylesheet">
    <link href="{{ asset('css/responsive.bootstrap.min.css') }}" rel="stylesheet">
    <!-- PNotify -->
    <link href="{{ asset('css/pnotify.css') }}" rel="stylesheet">
    <link href="{{ asset('css/pnotify.buttons.css') }}" rel="stylesheet">
    <link href="{{ asset('css/pnotify.nonblock.css') }}" rel="stylesheet">
@endsection
@section('js')
    <script src="{{ asset('js/actions.js') }}"></script>
     <!-- FastClick -->
    <script src="{{ asset('js/fastclick.js') }}"></script>
    <!-- NProgress -->
    <script src="{{ asset('js/nprogress.js') }}"></script>
    <!-- jQuery Smart Wizard -->
    <script src="{{ asset('js/jquery.smartWizardsisfoh.js') }}"></script>
    <!-- iCheck -->
    <script src="{{ asset('js/icheck.min.js') }}"></script>
     <!-- Select2 -->
    <script src="{{ asset('js/select2.full.min.js') }}"></script>

    <!-- DataTime Picker -->
    <script src="{{ asset('js/moment.min.js') }}"></script>
    <script src="{{ asset('js/daterangepicker.js') }}"></script>
     <!-- PNotify -->
    <script src="{{ asset('js/pnotify.js') }}"></script>
    <script src="{{ asset('js/pnotify.buttons.js') }}"></script>
    <script src="{{ asset('js/pnotify.nonblock.js') }}"></script>
    <!-- Tables -->
    <script src="{{ asset('js/jquery.dataTables.min.js') }}"></script>
    <script src="{{ asset('js/dataTables.responsive.min.js') }}"></script>
    <script>
      $(document).ready(function() {
          var table = $('#myTable').DataTable( {
              "responsive": true,
              "paging":   false,
              "ordering": false,
              "info":     false,
              "search": false
          } );

          $('.inputsexo').change(function() {
            if(this.value == "F")
              $('.inputgestante').prop('disabled', false);
            else
              $('.inputgestante').prop('disabled', true);
            $('.inputgestante').prop('checked', false);
          });
          $('#seguronotiene').change(function() {
            if($(this).prop('checked')) 
              $('.seguro').prop('checked', false);
          });
          $('.seguro').click(function() {
            $('#seguronotiene').prop('checked', false);
          });
          $('#dispacidadnotiene').change(function() {
            if($(this).prop('checked'))
              $('.discapacidad').prop('checked', false);
          });
          $('.discapacidad').click(function() {
            $('#dispacidadnotiene').prop('checked', false);
          });
          $('#programaninguno').change(function() {
            if($(this).prop('checked'))
              $('.programasocial').prop('checked', false);
          });
          $('.programasocial').click(function() {
            $('#programaninguno').prop('checked', false);
          })

          
      } );
    </script>
     <script type="text/javascript">
      $('.optionhogar').click(function() {
        $('#ninguno').prop('checked', false);
      });
    </script>
    <script src="{{ asset('js/myjs/sisfoh.js') }}"></script>



@endsection