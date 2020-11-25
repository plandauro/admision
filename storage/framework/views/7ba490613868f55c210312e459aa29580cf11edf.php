<?php $__env->startSection('title', ''); ?>

<?php $__env->startSection('content'); ?>
  @parent
  <div class="">
    <div class="page-title">
      <div class="title_left">
        <h3>Verificación de Postulación</h3>
      </div>

     
    </div>

    <div class="clearfix"></div>

    <div class="row">
      <div class="col-md-12 col-sm-12 col-xs-12">
        <div id="verificar" class="x_panel">
          <div class="x_title">
            <div class="row pull-right">
              <div class="col-md-5" style="text-align: right;margin-top: 5px;font-weight: bold;">Código de Postulación:</div>
              <div class="col-md-5">
                <input type="text" 
                        class="form-control" 
                        id="txtbuscarpostulante"
                        placeholder="Código de postulación">
              </div>
              <div class="col-md-2">
                <button onclick="buscar($txtbuscar.val())" class="btn btn-primary"><span style="color: #fff;" class="fa fa-search"></span></button>
              </div>
            </div>

            <div class="clearfix"></div>
          </div>
          <div id="encontrado" style="display: none;" class="x_content">
            <form id="frm-verificar" class="form-horizontal form-label-left">
              <div class="panel panel-primary">
                <div class="panel-heading">
                  <h3 class="panel-title">1. Datos Personales</h3>
                </div>
                <div class="panel-body">
                  <div class="form-group row">
                    <div class="row">
                      <div class="col-md-6 col-sm-6 col-xs-12">
                        <input type="hidden" id="idPostulacion" name="idPostulacion">
                        <!-- input -->
                        <div class="form-group">
                          <label class="control-label col-md-5 col-sm-5 col-xs-12" for="">Apellido Paterno</label>
                          <div class="col-md-7 col-sm-7 col-xs-12">
                            <input type="text" class="form-control" required="required" id="apepaterno" value="" name="apepaterno">
                          </div>
                        </div>
                        <!-- input -->
                        <div class="form-group">
                          <label class="control-label col-md-5 col-sm-5 col-xs-12" for="">Apellido Materno</label>
                          <div class="col-md-7 col-sm-7 col-xs-12">
                            <input type="text" class="form-control col-md-7 col-xs-12" required="required" value="" id="apematerno" name="apematerno">
                          </div>
                        </div>
                        <!-- input -->
                        <div class="form-group">
                          <label class="control-label col-md-5 col-sm-5 col-xs-12" for="">Nombres</label>
                          <div class="col-md-7 col-sm-7 col-xs-12">
                            <input type="text" class="form-control col-md-7 col-xs-12" required="required" id="nombre" name="nombre">
                          </div>
                        </div>
                        <!-- input -->
                        <div class="form-group">
                          <label class="control-label col-md-5 col-sm-5 col-xs-12" for="">Sexo</label>
                          <div class="col-md-7 col-sm-7 col-xs-12">
                            <p style="margin: 7px 0px 7px 0px">
                              <span style="margin-right: 10px;">
                                  <input type="radio" class="inputsexo" id="sexoM" name="sexo" value="M" />
                                   Hombre 
                              </span>
                              <span>
                                  <input type="radio" class="inputsexo" id="sexoF" name="sexo" value="F" />
                                  Mujer
                              </span>
                            </p>
                          </div>
                        </div>  
                        <!-- input -->
                        <div class="form-group">
                          <label class="control-label col-md-5 col-sm-5 col-xs-12" for="">Tipo de Doc.</label>
                          <div class="col-md-7 col-sm-7 col-xs-12">
                            <select id="tipodocumento" name="tipodocumento" class="form-control" >
                              <option value="">(Seleccionar)</option>
                              <option value="1">DNI</option>
                              <option value="2">Libreta Militar</option>
                              <option value="3">Part. Nacimiento - CUI</option>
                              <option value="4">Carnet de Extranjería </option>
                              <option value="5">Otro</option>
                            </select>
                          </div>
                        </div>
                        <!-- input -->
                        <div class="form-group">
                          <label class="control-label col-md-5 col-sm-5 col-xs-12" for="">Número de Documento</label>
                          <div class="col-md-7 col-sm-7 col-xs-12">
                            <input type="text" id="dni" max="8" min="8" name="dni" class="form-control col-md-7 col-xs-12">
                          </div>
                        </div>
                        <!-- input -->
                        <div class="form-group">
                          <label class="control-label col-md-5 col-sm-5 col-xs-12" for="">Estado Civil</label>
                          <div class="col-md-7 col-sm-7 col-xs-12">
                            <select id="estadocivil" name="estadocivil" class="form-control">
                              <option value="0">(Seleccionar)</option>
                              <option value="1">Soltero/a</option>
                              <option value="2">Casado/a</option>
                              <option value="3">Divorciado/a</option>
                              <option value="4">Viudo</option>
                            </select>
                          </div>
                        </div> 
                      </div>

                      <div class="col-md-6 col-sm-6 col-xs-12">
                        <!-- input -->
                        <div class="form-group">
                          <label class="control-label col-md-5 col-sm-5 col-xs-12" for="">Fecha y Lugar de Nacimiento</label>
                          <div class="col-md-7 col-sm-7 col-xs-12">
                            <input type="date" class="form-control has-feedback-left" id="fechanacimiento" name="fechanacimiento" aria-describedby="inputSuccess2Status2">
                            <span class="fa fa-calendar-o form-control-feedback left" aria-hidden="true"></span>
                            <span id="inputSuccess2Status2" class="sr-only">(success)</span>
                          </div>
                        </div>
                        <!-- input -->
                        <?php $nacimientoextranjero = Auth::user()->extranjero==1? true:false ?>
                        <div class="form-group">
                          <label class="control-label col-md-5 col-sm-5 col-xs-12" for="">¿Nació en el extranjero? *</label>
                          <div class="col-md-7 col-sm-7 col-xs-12">
                            <p style="margin: 7px 0px 7px 0px">
                              <span style="margin-right: 10px;">
                                <input type="radio" class="rbextrangero" id="extranjerosi" name="extranjero" value="1"/>
                                SI
                              </span>
                              <span>
                                <input type="radio" class="rbextrangero" id="extranjerono" name="extranjero" value="0"/>
                                NO
                              </span>
                            </p>
                          </div>
                        </div>
                        <!-- input -->
                        <div class="form-group extranjero">
                          <label class="control-label col-md-5 col-sm-5 col-xs-12" for="">País*</label>
                          <div class="col-md-7 col-sm-7 col-xs-12">
                            <input type="text" class="form-control" id="ubigeoextrangeropais" name="ubigeoextrangeropais" value="">
                          </div>
                        </div>
                        <!-- input -->
                        <div class="form-group extranjero">
                          <label class="control-label col-md-5 col-sm-5 col-xs-12" for="">Departamento*</small></label>
                          <div class="col-md-7 col-sm-7 col-xs-12">
                            <input type="text" class="form-control" id="ubigeoextrangerodepartamento" name="ubigeoextrangerodepartamento">
                          </div>
                        </div>
                        <!-- input -->
                        <div class="form-group extranjero">
                          <label class="control-label col-md-5 col-sm-5 col-xs-12" for="">Provincia*</label>
                          <div class="col-md-7 col-sm-7 col-xs-12">
                            <input type="text" class="form-control"  id="ubigeoextrangeroprovincia" name="ubigeoextrangeroprovincia">
                          </div>
                        </div>
                        <!-- input -->
                        <div class="form-group extranjero">
                          <label class="control-label col-md-5 col-sm-5 col-xs-12" for="">Distrito*</label>
                          <div class="col-md-7 col-sm-7 col-xs-12">
                            <input type="text" class="form-control" id="ubigeoextrangerodistrito" name="ubigeoextrangerodistrito">
                          </div>
                        </div>
                         <!-- input -->
                        <div class="form-group ubigeonacimiento">
                          <label class="control-label col-md-5 col-sm-5 col-xs-12" for="">Departamento *</label>
                          <div class="col-md-7 col-sm-7 col-xs-12">
                            <select class="form-control" id="iddepartamentonacimiento" name="iddepartamentonacimiento">
                              <option value="0">(Selecciona)</option>
                              <?php $__currentLoopData = $departamentos; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $departamento): $__env->incrementLoopIndices(); $loop = $__env->getFirstLoop(); ?>
                                  <option value="<?php echo e($departamento->iddepa); ?>">
                                    <?php echo e($departamento->departamento); ?>

                                  </option>
                              <?php endforeach; $__env->popLoop(); $loop = $__env->getFirstLoop(); ?>
                            </select>
                          </div>
                        </div>
                        <!-- input -->
                        <div class="form-group ubigeonacimiento">
                          <label class="control-label col-md-5 col-sm-5 col-xs-12" for="">Provincia *</label>
                          <div class="col-md-7 col-sm-7 col-xs-12">
                           <select class="form-control" id="idprovincianacimiento" name="idprovincianacimiento">
                              <option value="0">(Selecciona)</option>
                            </select>
                          </div>
                        </div>
                        <!-- input -->
                        <div class="form-group ubigeonacimiento">
                          <label class="control-label col-md-5 col-sm-5 col-xs-12" for="">Distrito *</label>
                          <div class="col-md-7 col-sm-7 col-xs-12">
                            <select class="form-control" id="iddistritonacimiento" name="iddistritonacimiento">
                              <option value="0">(Selecciona)</option>
                            </select>
                          </div>
                        </div>
                        <!-- input -->
                        <div class="form-group">
                          <label class="control-label col-md-5 col-sm-5 col-xs-12" for="">Fotografía *</label>
                          <div class="col-md-7 col-sm-7 col-xs-12">
                              <div align="center" class="image-upload">
                                  <label id="img-btn" data-toggle="modal" data-target=".bs-example-modal-sm" style="cursor: pointer;">
                                      <img width="100%" height="100%" id="foto" name="foto" class="img-circle img-responsive" src="<?php echo e(asset('images/user.png')); ?>"/>
                                      <span class="fa fa-pencil"></span>
                                  </label>
                              </div>
                          </div>
                        </div>
                   
                      </div>
                    </div>
                  </div>
                </div>
              </div>
              <div class="panel panel-primary">
                <div class="panel-heading">
                  <h3 class="panel-title">2. Datos de Ubicación</h3>
                </div>
                <div class="panel-body">
                  <div class="form-group row">
                    <div class="col-md-2 col-sm-2 col-xs-12">
                      <label for="">Vía *</label>
                      <select name="via" id="via" class="form-control">
                        <option value="0">( Selecciona )</option>
                        <option value="1">Jirón</option>
                        <option value="2">Avenida</option>
                        <option value="3">Calle</option>
                        <option value="4">Pasaje</option>
                        <option value="5">Otro</option>
                      </select>
                    </div>
                    <div class="col-md-5 col-sm-5 col-xs-12">
                      <label for="">Dirección *</label>
                      <input type="text" name="direccion" id="direccion" class="form-control">
                    </div>
                    <div class="col-md-2 col-sm-2 col-xs-12">
                      <label for="">Número *</label>
                      <input type="text"  name="numero" id="numero" class="form-control">
                    </div>
                    <div class="col-md-3 col-sm-3 col-xs-12">
                      <label for="">Teléfono fijo</label>
                      <input type="text" name="telefono"  id="telefono" class="form-control">
                    </div>
                  </div>
                  <div class="form-group row">
                    <div class="col-md-4 col-sm-4 col-xs-12">
                      <label for="">Departamento *</label>
                      <select class="form-control"  id="iddepartamentodirecion" name="iddepartamentodirecion">
                        <option value="0">(Selecciona)</option>
                        <?php $__currentLoopData = $departamentos; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $departamento): $__env->incrementLoopIndices(); $loop = $__env->getFirstLoop(); ?>
                            <option value="<?php echo e($departamento->iddepa); ?>">
                              <?php echo e($departamento->departamento); ?>

                            </option>
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getFirstLoop(); ?>
                      </select>
                    </div>
                    <div class="col-md-4 col-sm-4 col-xs-12">
                      <label for="">Provincia *</label>
                      <select class="form-control" id="idprovinciadireccion" name="idprovinciadireccion">
                        <option value="0">(Selecciona)</option>
                      </select>
                    </div>
                    <div class="col-md-4 col-sm-4 col-xs-12">
                      <label for="">Distrito *</label>
                      <select class="form-control" id="iddistritodireccion" name="iddistritodireccion">
                        <option value="0">(Selecciona)</option>
                      </select>
                    </div>
                  </div>
                  <div class="form-group row">
                    <div class="col-md-5 col-sm-5 col-xs-12">
                      <label for="">Correo electrónico *</label>
                      <input type="text" name="email"  id="email" class="form-control">
                    </div>
                    <div class="col-md-4 col-sm-4 col-xs-12">
                      <label for="">Celular *</label>
                      <input type="text"  name="celular" id="celular" class="form-control">
                    </div>
                    <div class="col-md-3 col-sm-3 col-xs-12">
                      <label for="">Dueño del celular *</label>
                      <select class="form-control" id="duenocelular" name="duenocelular">
                        <option value="0">(Selecciona)</option>
                        <option value="1">Propio</option>
                        <option value="2">Padre o Madre</option>
                        <option value="3">Otro familiar</option>
                        <option value="4">Vecino</option>
                      </select>
                      
                    </div>
                  </div>
                </div>
              </div>
              <div class="panel panel-primary">
                <div class="panel-heading">
                  <h3 class="panel-title">3. Datos Familiares</h3>
                </div>
                <div class="panel-body">
                  <div class="form-group row">
                    <div class="col-md-6 col-sm-6 col-xs-12">
                      <label for="">Apellidos y nombres del Padre *</label>
                      <input type="text" name="padre"  id="padre" value="" class="form-control">
                    </div>
                    <div class="col-md-6 col-sm-6 col-xs-12">
                      <label for="">Apellidos y nombres de la Madre *</label>
                      <input type="text" name="madre"  id="madre" value="" class="form-control">
                    </div>
                  </div>
                </div>
              </div>
              <div class="panel panel-primary">
                <div class="panel-heading">
                  <h3 class="panel-title">4. Datos de la Institución Educativa de procedencia</h3>
                </div>
                <div class="panel-body">
                  <div class="form-group row ">
                    <div class="col-xs-12">
                      <input type="checkbox" id="colegioextranjero" name="colegioextranjero" value="1" >
                      <strong> Estudió en Colegio Extranjero</strong>
                    </div>
                  </div>
                  <div class="form-group row colegiooubigeo">
                    <div class="col-md-4 col-sm-4 col-xs-12">
                      <label for="">Departamento *</label>
                      <select class="form-control" id="iddepartamentocolegio" name="iddepartamentocolegio">
                        <option value="0">(Selecciona)</option>
                        <?php $__currentLoopData = $departamentos; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $departamento): $__env->incrementLoopIndices(); $loop = $__env->getFirstLoop(); ?>
                           <option value="<?php echo e($departamento->iddepa); ?>">
                              <?php echo e($departamento->departamento); ?>

                            </option>
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getFirstLoop(); ?>
                      </select>
                    </div>
                    <div class="col-md-4 col-sm-4 col-xs-12">
                      <label for="">Provincia *</label>
                      <select class="form-control" id="idprovinciacolegio" name="idprovinciacolegio" disabled>
                        <option value="0">(Selecciona)</option>
                      </select>
                    </div>
                    <div class="col-md-4 col-sm-4 col-xs-12">
                      <label for="">Distrito *</label>
                      <select class="form-control" id="iddistritocolegio" name="iddistritocolegio" disabled>
                          <option value="0">(Selecciona)</option>
                      </select>
                    </div>
                  </div>
                  <div class="form-group row">
                    <div class="col-md-6 col-sm-4 col-xs-12 colegiooubigeo">
                      <label for="">
                          <input type="checkbox" value="1" id="isidinstitucioneducativa" name="isidinstitucioneducativa" style="display: none;">
                          Institución Educativa *  
                          <input style="margin-left: 15px" value="1" id="isotrainstitucion" name="isotrainstitucion" type="checkbox"> Otra institución educativa
                      </label>
                      
                        <select class="form-control" id="idinstitucioneducativa" name="idinstitucioneducativa" disabled>
                          <option value="0">(Selecciona)</option>
                        </select>
                      <input type="text" class="form-control" value="" name="otrainstitucion" id="otrainstitucion">
                    </div>
                    <div class="col-md-6 col-sm-6 col-xs-12 colegioextranjero">
                      <label for="">Nombre de la Institución Educativa</label>
                      <input type="text" class="form-control" name="nombreie" id="nombreie" value="">
                    </div>
                    <div class="col-md-3 col-sm-3 col-xs-12" id="tipocolegio">
                      <label for="">¿Que tipo de institución es?</label>
                      <p style="margin: 7px 0px 7px 0px">
                        <span style="margin-right: 10px;">
                            <input type="radio" class="inputtipocolegio"  id="colegioestatal" name="estatal" value="1" />
                             Estatal 
                        </span>
                        <span>
                            <input type="radio" class="inputtipocolegio"  id="colegio" name="estatal" value="0"  />
                            Particular
                        </span>
                      </p>
                    </div>
                    <div class="col-md-3 col-sm-3 col-xs-12">
                      <label for="">Año en que concluyo *</label>
                      <input type="number" value="<?php echo e(date ('Y')); ?>" min="<?php echo e(date ('Y') -70); ?>" max="<?php echo e(date ('Y')); ?>" class="form-control" name="anotermino" id="anotermino">
                    </div>
                  </div>
                </div>
              </div>
              <div class="panel panel-primary">
                <div class="panel-heading">
                  <h3 class="panel-title">5. Modalidad y Carrera Profesional</h3>
                </div>
                <div class="panel-body">
                  <div class="col-md-6 col-sm-6 col-xs-12">
                    <label for="">Modalidad a la que postula *</label>
                    <select name="idtarifa" id="idtarifa" class="form-control">
                      <option value="0">(Seleccionar)</option>
                      <?php $__currentLoopData = $tarifas; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $tarifa): $__env->incrementLoopIndices(); $loop = $__env->getFirstLoop(); ?>
                      <option value="<?php echo e($tarifa->idtarifa); ?>"><?php echo e($tarifa->descripcion); ?></option>
                      <?php endforeach; $__env->popLoop(); $loop = $__env->getFirstLoop(); ?>
                    </select>
                  </div>
                  <div class="col-md-6 col-sm-6 col-xs-12">
                    <label for="">Carrera profesional a la que postula *</label>
                    <select name="idescuela" id="idescuela" class="form-control">
                      <option value="0">(Seleccionar)</option>
                      <?php $__currentLoopData = $escuelas; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $escuela): $__env->incrementLoopIndices(); $loop = $__env->getFirstLoop(); ?>
                      <option value="<?php echo e($escuela->idescuela); ?>"><?php echo e($escuela->descripcion); ?></option>
                      <?php endforeach; $__env->popLoop(); $loop = $__env->getFirstLoop(); ?>
                    </select>
                  </div>
                </div>
              </div>
              <div class="panel panel-info">
                <div class="panel-heading">6. Verificación</div>
                <div class="panel-body">
                  <div class="row">
                    <div class="col-sm-6">
                      <div class="form-group">
                        <label class="control-label col-md-6 col-sm-6 col-xs-12" for="first-name">N° Operación <small>(Baucher)</small></label>
                        <div class="col-md-6 col-sm-6 col-xs-12">
                          <input type="text" id="numerooperacion" name="numerooperacion" required="required" class="form-control col-md-7 col-xs-12">
                        </div>
                      </div>
                    </div>
                  </div>
                  
                </div>
              </div>
              <center>
                <button type="submit" class="btn btn-primary"><span class="fa fa-check"></span> Verificar</button>
              </center>
            </form>
          </div>
          <div id="principal"  class="x_content">
            <div class="mypanel">
              <div  class ="message">
                <img style="width: 70px" src="<?php echo e(asset('images/logochico.png')); ?>">
                <h2 id="message">Realice la busqueda de una postulación</h2>
              </div>
            </div>
          </div>
          <div id="loading" style="display: none;" class="x_content">
            <div>
              <div class ="loading">
                <img style="width: 70px" src="<?php echo e(asset('images/logochico.png')); ?>"> <br>
                <img style="width: 70px" src="<?php echo e(asset('images/loading.gif')); ?>">
              </div>
            </div>
          </div>
          <div id="verificado" style="display: none;" class="x_content">
            <div class="mypanel">
              <table style="margin:18px;">
                <tr>
                  <td>
                    <img style="width: 100px" id="v-imgPostulante" src="<?php echo e(asset('images/user.png')); ?>">
                  </td>
                  <td id="v-datos">                      
                  </td>
                </tr>
              </table>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>


  <!-- modal -->
  <div id="mymodal" class="modal fade bs-example-modal-sm" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog modal-sm">
      <div class="modal-content">
    
        <div  align="center" class="modal-body">
          <div class="row">
            <div class="col-sm-10">
              <h3  class="pull-left" style="font-size: 18px; margin-top: 5px;margin-left: 15px">
                La fotografía debe ser formal, contener fondo blanco y ser legible.
              </h3>
            </div>
            <div class="col-sm-2">
              <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">×</span></button>
            </div>
          </div>
          <br>
          <div align="center" class="image-upload">
              <label width="100px" height="100px">
                  <img id="img-input" name="foto" c