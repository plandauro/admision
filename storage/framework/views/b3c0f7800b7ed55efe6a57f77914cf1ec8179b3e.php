<?php $__env->startSection('title', ''); ?>

<?php $__env->startSection('content'); ?>
  @parent
  <div class="">
    <div class="page-title">
      <div class="title_left">
        <h3>Inscripción de Postulante</h3>
      </div>
    </div>

    <div class="clearfix"></div>

    <div class="row">
      <div class="col-md-12 col-sm-12 col-xs-12">
        <div class="x_panel">
         <br>
          <div class="x_content">
            <!-- Smart Wizard -->
            <div id="wizard2" class="form_wizard wizard_horizontal">
              <ul class="wizard_steps">
                <li>
                  <a href="#step-1">
                    <span class="step_no">1</span>
                    <span class="step_descr">Información</span>
                  </a>
                </li>
                <li>
                  <a href="#step-2">
                    <span class="step_no">2</span>
                    <span class="step_descr">Inscripción</span>
                  </a>
                </li>
              <!--  <li>
                  <a href="#step-3">
                    <span class="step_no">3</span>
                    <span class="step_descr">Pago</span>
                  </a>
                </li>
                <li>
                  <a href="#step-4">
                    <span class="step_no">4</span>
                    <span class="step_descr">Finalizar</span>
                  </a>
                </li> -->
              </ul>
              <div id="step-1">
                <form class="form-horizontal form-label-left panel">
                  <input type="hidden" name="step_number" value="1">
                  <div class="panel panel-primary">
                    <div class="panel-heading">
                      <h3 class="panel-title">1. Datos Personales</h3>
                    </div>
                    <div class="panel-body">
                      <div class="form-group row">
                        <div class="row">
                          <div class="col-md-6 col-sm-6 col-xs-12">
                            <!-- input -->
                            <div class="form-group">
                              <label class="control-label col-md-5 col-sm-5 col-xs-12" for="">Apellido Paterno</label>
                              <div class="col-md-7 col-sm-7 col-xs-12">
                                <input type="text" class="form-control"  required="required" id="apepaterno" value="<?php echo e(Auth::user()->apepaterno); ?>" name="apepaterno">
                              </div>
                            </div>
                            <!-- input -->
                            <div class="form-group">
                              <label class="control-label col-md-5 col-sm-5 col-xs-12" for="">Apellido Materno</label>
                              <div class="col-md-7 col-sm-7 col-xs-12">
                                <input type="text"  required="required" class="form-control col-md-7 col-xs-12" value="<?php echo e(Auth::user()->apematerno); ?>" id="apematerno" name="apematerno">
                              </div>
                            </div>
                            <!-- input -->
                            <div class="form-group">
                              <label class="control-label col-md-5 col-sm-5 col-xs-12" for="">Nombres</label>
                              <div class="col-md-7 col-sm-7 col-xs-12">
                                <input type="text" required="required" class="form-control col-md-7 col-xs-12" value="<?php echo e(Auth::user()->nombre); ?>" id="nombre" name="nombre">
                              </div>
                            </div>
                            <!-- input -->
                            <div class="form-group">
                              <label class="control-label col-md-5 col-sm-5 col-xs-12" for="">Sexo</label>
                              <div class="col-md-7 col-sm-7 col-xs-12">
                                <p style="margin: 7px 0px 7px 0px">
                                  <span style="margin-right: 10px;">
                                      <input type="radio"  required="required" class="inputsexo"  id="sexoM" name="sexo" value="M" <?php if(Auth::user()->sexo == "M"): ?> checked <?php endif; ?> />
                                       Hombre 
                                  </span>
                                  <span>
                                      <input type="radio"  required="required" class="inputsexo"  id="sexoF" name="sexo" value="F" <?php if(Auth::user()->sexo == "F"): ?> checked <?php endif; ?>  />
                                      Mujer
                                  </span>
                                </p>
                              </div>
                            </div>  
                            <!-- input -->
                            <div class="form-group">
                              <label class="control-label col-md-5 col-sm-5 col-xs-12" for="">Tipo de Doc.</label>
                              <div class="col-md-7 col-sm-7 col-xs-12">
                                <select  required="required"  id="tipodocumento" name="tipodocumento" class="form-control" 
                                  onchange="if($(this).val() == '') $('#numerodocumento').prop('disabled', true); else $('#numerodocumento').prop('disabled', false);">
                                  <option value="">(Seleccionar)</option>
                                  <option value="1" <?php if(Auth::user()->tipodocumento == 1): ?> selected <?php endif; ?>>DNI</option>
                                  <option value="2" <?php if(Auth::user()->tipodocumento == 2): ?> selected <?php endif; ?>>Libreta Militar</option>
                                  <option value="3" <?php if(Auth::user()->tipodocumento == 3): ?> selected <?php endif; ?>>Part. Nacimiento - CUI</option>
                                  <option value="4" <?php if(Auth::user()->tipodocumento == 4): ?> selected <?php endif; ?>>Carnet de Extranjería </option>
                                  <option value="5" <?php if(Auth::user()->tipodocumento == 5): ?> selected <?php endif; ?>>Otro</option>
                                </select>
                              </div>
                            </div>
                            <!-- input -->
                            <div class="form-group">
                              <label class="control-label col-md-5 col-sm-5 col-xs-12" for="">Número de Documento</label>
                              <div class="col-md-7 col-sm-7 col-xs-12">
                                <input  required="required" type="text" id="dni" max="8" min="8" value="<?php echo e(Auth::user()->dni); ?>" name="dni" class="form-control col-md-7 col-xs-12" <?php if(!Auth::user()->tipodocumento): ?> disabled <?php endif; ?>>
                              </div>
                            </div>
                            <!-- input -->
                            <div class="form-group">
                              <label class="control-label col-md-5 col-sm-5 col-xs-12" for="">Estado Civil</label>
                              <div class="col-md-7 col-sm-7 col-xs-12">
                                <select  required="required" id="estadocivil" name="estadocivil" class="form-control">
                                  <option value="0">(Seleccionar)</option>
                                  <option value="1" <?php if(Auth::user()->estadocivil == 1): ?> selected <?php endif; ?>>Soltero/a</option>
                                  <option value="2" <?php if(Auth::user()->estadocivil == 2): ?> selected <?php endif; ?>>Casado/a</option>
                                  <option value="3" <?php if(Auth::user()->estadocivil == 3): ?> selected <?php endif; ?>>Divorciado/a</option>
                                  <option value="4" <?php if(Auth::user()->estadocivil == 4): ?> selected <?php endif; ?>>Viudo</option>
                                </select>
                              </div>
                            </div> 
                          </div>

                          <div class="col-md-6 col-sm-6 col-xs-12">
                            <!-- input -->
                            <div class="form-group">
                              <label class="control-label col-md-5 col-sm-5 col-xs-12" for="">Fecha y Lugar de Nacimiento</label>
                              <div class="col-md-7 col-sm-7 col-xs-12">
                                <input type="date"  required="required" class="form-control has-feedback-left"  id="fechanacimiento" name="fechanacimiento" aria-describedby="inputSuccess2Status2" value="<?php echo e(Auth::user()->fechanacimiento); ?>">
                                <span class="fa fa-calendar-o form-control-feedback left" aria-hidden="true"></span>
                                <span id="inputSuccess2Status2" class="sr-only">(success)</span>
                              </div>
                            </div>
                            <!-- input -->
                            <?php $nacimientoextranjero = Auth::user()->extranjero==1? true:false ?>
                            <div class="form-group">
                              <label class="control-label col-md-5 col-sm-5 col-xs-12" for="">Nació en el extranjero *</label>
                              <div class="col-md-7 col-sm-7 col-xs-12">
                                <p style="margin: 7px 0px 7px 0px">
                                  <span style="margin-right: 10px;">
                                    <input type="radio"  required="required" class="rbextrangero" id="extranjerosi" name="extranjero" value="1" <?php echo e($nacimientoextranjero? 'checked': ''); ?> />
                                    SI
                                  </span>
                                  <span>
                                    <input type="radio"  required="required" class="rbextrangero" id="extranjerono" name="extranjero" value="0" <?php echo e(!$nacimientoextranjero? 'checked': ''); ?> />
                                    NO
                                  </span>
                                </p>
                              </div>
                            </div>
                            <!-- input -->
                            <div class="form-group extranjero" <?php echo e($nacimientoextranjero? '': 'style=display:none'); ?> >
                              <label class="control-label col-md-5 col-sm-5 col-xs-12" for="">País*</label>
                              <div class="col-md-7 col-sm-7 col-xs-12">
                                <input type="text" class="form-control" id="ubigeoextrangeropais" name="ubigeoextrangeropais" value="<?php echo e(Auth::user()->ubigeoextrangeropais); ?>">
                              </div>
                            </div>
                            <!-- input -->
                            <div class="form-group extranjero" <?php echo e($nacimientoextranjero? '': 'style=display:none'); ?>>
                              <label class="control-label col-md-5 col-sm-5 col-xs-12" for="">Departamento*</small></label>
                              <div class="col-md-7 col-sm-7 col-xs-12">
                                <input type="text" class="form-control" id="ubigeoextrangerodepartamento" name="ubigeoextrangerodepartamento" value="<?php echo e(Auth::user()->ubigeoextrangerodepartamento); ?>">
                              </div>
                            </div>
                            <!-- input -->
                            <div class="form-group extranjero" <?php echo e($nacimientoextranjero? '': 'style=display:none'); ?>>
                              <label class="control-label col-md-5 col-sm-5 col-xs-12" for="">Provincia*</label>
                              <div class="col-md-7 col-sm-7 col-xs-12">
                                <input type="text" class="form-control" id="ubigeoextrangeroprovincia" name="ubigeoextrangeroprovincia" value="<?php echo e(Auth::user()->ubigeoextrangeroprovincia); ?>">
                              </div>
                            </div>
                            <!-- input -->
                            <div class="form-group extranjero" <?php echo e($nacimientoextranjero? '': 'style=display:none'); ?>>
                              <label class="control-label col-md-5 col-sm-5 col-xs-12" for="">Distrito*</label>
                              <div class="col-md-7 col-sm-7 col-xs-12">
                                <input type="text" class="form-control" id="ubigeoextrangerodistrito" name="ubigeoextrangerodistrito" value="<?php echo e(Auth::user()->ubigeoextrangerodistrito); ?>">
                              </div>
                            </div>
                             <!-- input -->
                            <div class="form-group ubigeonacimiento" <?php echo e($nacimientoextranjero? 'style=display:none': ''); ?>>
                              <label class="control-label col-md-5 col-sm-5 col-xs-12" for="">Departamento *</label>
                              <div class="col-md-7 col-sm-7 col-xs-12">
                                <select class="form-control" id="iddepartamentonacimiento" name="iddepartamentonacimiento">
                                  <option value="0">(Selecciona)</option>
                                  <?php $__currentLoopData = $departamentos; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $departamento): $__env->incrementLoopIndices(); $loop = $__env->getFirstLoop(); ?>
                                      <option value="<?php echo e($departamento->iddepa); ?>" 
                                      <?php if($departamento->iddepa ==substr(Auth::user()->idubigeonacimiento, 0,2)."0000"): ?> selected <?php endif; ?>>
                                        <?php echo e($departamento->departamento); ?>

                                      </option>
                                  <?php endforeach; $__env->popLoop(); $loop = $__env->getFirstLoop(); ?>
                                </select>
                              </div>
                            </div>
                            <!-- input -->
                            <div class="form-group ubigeonacimiento" <?php echo e($nacimientoextranjero? 'style=display:none': ''); ?>>
                              <label class="control-label col-md-5 col-sm-5 col-xs-12" for="">Provincia *</label>
                              <div class="col-md-7 col-sm-7 col-xs-12">
                               <select class="form-control" id="idprovincianacimiento" name="idprovincianacimiento"
                                <?php if($provinciasnacimiento == ""): ?>
                                disabled>
                                  <option value="0">(Selecciona)</option>
                                </select>
                                <?php else: ?>
                                  >
                                  <option value="0">(Selecciona)</option>
                                  <?php $__currentLoopData = $provinciasnacimiento; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $provincia): $__env->incrementLoopIndices(); $loop = $__env->getFirstLoop(); ?>
                                  <option value="<?php echo e($provincia->idprov); ?>"
                                      <?php if($provincia->idprov == substr(Auth::user()->idubigeonacimiento, 0,4)."00"): ?>
                                        selected <?php endif; ?>>
                                    <?php echo e($provincia->provincia); ?>

                                  </option>
                                  <?php endforeach; $__env->popLoop(); $loop = $__env->getFirstLoop(); ?>
                                </select>
                                <?php endif; ?>
                              </div>
                            </div>
                            <!-- input -->
                            <div class="form-group ubigeonacimiento" <?php echo e($nacimientoextranjero? 'style=display:none': ''); ?>>
                              <label class="control-label col-md-5 col-sm-5 col-xs-12" for="">Distrito *</label>
                              <div class="col-md-7 col-sm-7 col-xs-12">
                                <select class="form-control" id="iddistritonacimiento" name="iddistritonacimiento"
                                  <?php if($distritosnacimiento == ""): ?>
                                  disabled>
                                  <option value="0">(Selecciona)</option>
                                </select>
                                  <?php else: ?>
                                  >
                                  <option value="0">(Selecciona)</option>
                                  <?php $__currentLoopData = $distritosnacimiento; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $distrito): $__env->incrementLoopIndices(); $loop = $__env->getFirstLoop(); ?>
                                  <option value="<?php echo e($distrito->iddist); ?>"
                                      <?php if($distrito->iddist == Auth::user()->idubigeonacimiento): ?>
                                        selected <?php endif; ?>>
                                    <?php echo e($distrito->distrito); ?>

                                  </option>
                                  <?php endforeach; $__env->popLoop(); $loop = $__env->getFirstLoop(); ?>
                                </select>
                                <?php endif; ?>
                              </div>
                            </div>
                            <!-- input -->
                            <div class="form-group">
                              <label class="control-label col-md-5 col-sm-5 col-xs-12" for="">Fotografía *</label>
                              <div class="col-md-7 col-sm-7 col-xs-12">
                                  <div align="center" class="image-upload">
                                      <label id="img-btn" data-toggle="modal" data-target=".bs-example-modal-sm" style="cursor: pointer;">
                                          <img width="100%" height="100%" name="foto" class="img-circle img-responsive"
                                          <?php if(Auth::user()->foto == ""): ?> 
                                            src="<?php echo e(asset('images/user.png')); ?>"/>
                                          <?php else: ?>
                                            src="<?php echo e(asset('/').Auth::user()->foto); ?>"/>
                                          <?php endif; ?>
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
                            <option value="1" <?php if(Auth::user()->via == 1): ?> selected <?php endif; ?>>Jirón</option>
                            <option value="2" <?php if(Auth::user()->via == 2): ?> selected <?php endif; ?>>Avenida</option>
                            <option value="3" <?php if(Auth::user()->via == 3): ?> selected <?php endif; ?>>Calle</option>
                            <option value="4" <?php if(Auth::user()->via == 4): ?> selected <?php endif; ?>>Pasaje</option>
                            <option value="5" <?php if(Auth::user()->via == 5): ?> selected <?php endif; ?>>Otro</option>
                          </select>
                        </div>
                        <div class="col-md-4 col-sm-4 col-xs-12">
                          <label for="">Dirección *</label>
                          <input type="text" name="direccion" id="direccion" value="<?php echo e(Auth::user()->direccion); ?>" class="form-control mayusculas">
                        </div>
                        <div class="col-md-3 col-sm-3 col-xs-12">
                          <label for="">Número *</label>
                          <input type="text" name="numero" id="numero" value="<?php echo e(Auth::user()->numero); ?>" class="form-control mayusculas">
                        </div>
                        
                      </div>
                      <div class="form-group row">
                        <div class="col-md-4 col-sm-4 col-xs-12">
                          <label for="">Departamento *</label>
                          <select class="form-control" id="iddepartamentodirecion" name="iddepartamentodirecion">
                            <option value="0">(Selecciona)</option>
                            <?php $__currentLoopData = $departamentos; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $departamento): $__env->incrementLoopIndices(); $loop = $__env->getFirstLoop(); ?>
                                <option value="<?php echo e($departamento->iddepa); ?>" 
                                    <?php if($departamento->iddepa == substr(Auth::user()->idubigeodireccion, 0,2)."0000"): ?> selected 
                                    <?php endif; ?>>
                                  <?php echo e($departamento->departamento); ?>

                                </option>
                            <?php endforeach; $__env->popLoop(); $loop = $__env->getFirstLoop(); ?>
                          </select>
                        </div>
                        <div class="col-md-4 col-sm-4 col-xs-12">
                          <label for="">Provincia *</label>
                          <select class="form-control" id="idprovinciadireccion" name="idprovinciadireccion"
                          <?php if($provinciasdireccion == ""): ?>
                          disabled>
                            <option value="0">(Selecciona)</option>
                          </select>
                          <?php else: ?>
                            >
                            <option value="0">(Selecciona)</option>
                            <?php $__currentLoopData = $provinciasdireccion; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $provincia): $__env->incrementLoopIndices(); $loop = $__env->getFirstLoop(); ?>
                            <option value="<?php echo e($provincia->idprov); ?>"
                                <?php if($provincia->idprov == substr(Auth::user()->idubigeodireccion, 0,4)."00"): ?>
                                  selected <?php endif; ?>>
                              <?php echo e($provincia->provincia); ?>

                            </option>
                            <?php endforeach; $__env->popLoop(); $loop = $__env->getFirstLoop(); ?>
                          </select>
                          <?php endif; ?>
                        </div>
                        <div class="col-md-4 col-sm-4 col-xs-12">
                          <label for="">Distrito *</label>
                          <select class="form-control" id="iddistritodireccion" name="iddistritodireccion"
                           <?php if($distritosdireccion == ""): ?>
                          disabled>
                            <option value="0">(Selecciona)</option>
                          </select>
                          <?php else: ?>
                            >
                            <option value="0">(Selecciona)</option>
                            <?php $__currentLoopData = $distritosdireccion; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $distrito): $__env->incrementLoopIndices(); $loop = $__env->getFirstLoop(); ?>
                            <option value="<?php echo e($distrito->iddist); ?>"
                                <?php if($distrito->iddist == Auth::user()->idubigeodireccion): ?>
                                  selected <?php endif; ?>>
                              <?php echo e($distrito->distrito); ?>

                            </option>
                            <?php endforeach; $__env->popLoop(); $loop = $__env->getFirstLoop(); ?>
                          </select>
                          <?php endif; ?>
                        </div>
                      </div>
                      <div class="form-group row">
                        <div class="col-md-5 col-sm-5 col-xs-12">
                          <label for="">Correo electrónico *</label>
                          <input type="text" name="email" id="email" value="<?php echo e(Auth::user()->email); ?>" class="form-control">
                        </div>
                        <div class="col-md-4 col-sm-4 col-xs-12">
                          <label for="">Celular *</label>
                          <input type="text" name="celular" id="celular" value="<?php echo e(Auth::user()->celular); ?>" class="form-control">
                        </div>
                        <div class="col-md-3 col-sm-3 col-xs-12">
                          <label for="">Dueño del celular *</label>
                          <select class="form-control" id="duenocelular" name="duenocelular">
                            <option value="0">(Selecciona)</option>
                            <option value="1" <?php if(Auth::user()->duenocelular == 1): ?> selected <?php endif; ?>>Propio</option>
                            <option value="2" <?php if(Auth::user()->duenocelular == 2): ?> selected <?php endif; ?>>Padre o Madre</option>
                            <option value="3" <?php if(Auth::user()->duenocelular == 3): ?> selected <?php endif; ?>>Otro familiar</option>
                            <option value="4" <?php if(Auth::user()->duenocelular == 4): ?> selected <?php endif; ?>>Vecino</option>
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
                          <input type="text" name="padre" id="padre" value="<?php echo e(Auth::user()->padre); ?>" class="form-control mayusculas">
                        </div>
                        <div class="col-md-6 col-sm-6 col-xs-12">
                          <label for="">Apellidos y nombres de la Madre *</label>
                          <input type="text" name="madre" id="madre" value="<?php echo e(Auth::user()->madre); ?>" class="form-control mayusculas">
                        </div>
                      </div>
                    </div>
                  </div>
                  <div class="panel panel-primary">
                    <div class="panel-heading">
                      <h3 class="panel-title">4. Datos de la Institución Educativa de procedencia</h3>
                    </div>
                    <div class="panel-body">
                      <?php $colegioextranjero = Auth::user()->colegioextranjero == 1? true : false; ?>
                      <div class="form-group row ">
                        <div class="col-xs-12">
                          <input type="checkbox" id="colegioextranjero" name="colegioextranjero" value="1" <?php echo e($colegioextranjero? "checked":""); ?> >
                          <strong> Estudió en Colegio Extranjero</strong>
                        </div>
                      </div>
                      <div class="form-group row colegiooubigeo" <?php echo e($colegioextranjero? 'style=display:none':""); ?> >
                        <div class="col-md-4 col-sm-4 col-xs-12">
                          <label for="">Departamento *</label>
                          <select class="form-control" id="iddepartamentocolegio" name="iddepartamentocolegio">
                            <option value="0">(Selecciona)</option>
                            <?php $__currentLoopData = $departamentos; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $departamento): $__env->incrementLoopIndices(); $loop = $__env->getFirstLoop(); ?>
                               <option value="<?php echo e($departamento->iddepa); ?>" 
                                    <?php if(Auth::user()->idubigeocolegio): ?>
                                      <?php if($departamento->iddepa == substr(Auth::user()->idubigeocolegio, 0,2)."0000"): ?> selected <?php endif; ?>
                                    <?php endif; ?>
                                >
                                  <?php echo e($departamento->departamento); ?>

                                </option>
                            <?php endforeach; $__env->popLoop(); $loop = $__env->getFirstLoop(); ?>
                          </select>
                        </div>
                        <div class="col-md-4 col-sm-4 col-xs-12">
                          <label for="">Provincia *</label>
                          <select class="form-control" id="idprovinciacolegio" name="idprovinciacolegio" 
                            <?php if($provinciascolegio == ""): ?>
                            disabled>
                            <option value="0">(Selecciona)</option>
                          </select>
                            <?php else: ?>
                            >
                              <?php $__currentLoopData = $provinciascolegio; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $provincia): $__env->incrementLoopIndices(); $loop = $__env->getFirstLoop(); ?> >
                              <option value="<?php echo e($provincia->idprov); ?>"
                                <?php if($provincia->idprov == substr(Auth::user()->idubigeocolegio, 0,4)."00"): ?>
                                  selected <?php endif; ?>>
                                  <?php echo e($provincia->provincia); ?>

                              </option>
                              <?php endforeach; $__env->popLoop(); $loop = $__env->getFirstLoop(); ?>
                            <?php endif; ?>
                          </select>
                        </div>
                        <div class="col-md-4 col-sm-4 col-xs-12">
                          <label for="">Distrito *</label>
                          <select class="form-control" id="iddistritocolegio" name="iddistritocolegio"
                            <?php if($distritoscolegio == ""): ?>
                              disabled>
                              <option value="0">(Selecciona)</option>
                            </select>
                            <?php else: ?>
                            >
                            <option value="0">(Selecciona)</option>
                            <?php $__currentLoopData = $distritoscolegio; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $distrito): $__env->incrementLoopIndices(); $loop = $__env->getFirstLoop(); ?>
                            <option value="<?php echo e($distrito->iddist); ?>"
                                <?php if($distrito->iddist == Auth::user()->idubigeocolegio): ?>
                                  selected <?php endif; ?>>
                              <?php echo e($distrito->distrito); ?>

                            </option>
                            <?php endforeach; $__env->popLoop(); $loop = $__env->getFirstLoop(); ?>
                          </select>
                          <?php endif; ?>
                        </div>
                      </div>
                      <div class="form-group row">
                        <div class="col-md-6 col-sm-4 col-xs-12 colegiooubigeo"  <?php echo e($colegioextranjero? "style=display:none":""); ?> >
                          <label for="">
                              <input type="checkbox" value="1" id="isidinstitucioneducativa" name="isidinstitucioneducativa" style="display: none;" 
                                <?php if(Auth::user()->colegioextranjero != 1 && Auth::user()->isotrainstitucion != 1): ?> checked="true" <?php endif; ?> 
                                 >
                              Institución Educativa *  
                              <input style="margin-left: 15px" value="1" id="isotrainstitucion" name="isotrainstitucion" type="checkbox"
                              <?php if(Auth::user()->isotrainstitucion == 1): ?> checked="true" <?php endif; ?>> Otra institución educativa
                          </label>
                          
                            <select class="form-control" id="idinstitucioneducativa" name="idinstitucioneducativa" 
                            <?php if(Auth::user()->isotrainstitucion == 1): ?> style="display:none" <?php endif; ?>
                            <?php if($colegios == ""): ?>
                                  disabled>
                                  <option value="0">(Selecciona)</option>
                                </select>
                            <?php else: ?>
                                  <option value="0">(Selecciona)</option>
                                  <?php $__currentLoopData = $colegios; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $colegio): $__env->incrementLoopIndices(); $loop = $__env->getFirstLoop(); ?>
                                  <option value="<?php echo e($colegio->idie); ?>"
                                      <?php if($colegio->idie == Auth::user()->idinstitucioneducativa): ?>
                                        selected <?php endif; ?>>
                                    <?php echo e($colegio->nombreie); ?>

                                  </option>
                                  <?php endforeach; $__env->popLoop(); $loop = $__env->getFirstLoop(); ?>
                                </select>
                            <?php endif; ?>
                          <input type="text" class="form-control" value="<?php echo e(Auth::user()->nombreie); ?>" name="otrainstitucion" id="otrainstitucion" 
                          <?php if(Auth::user()->isotrainstitucion != 1): ?> style="display: none;" <?php endif; ?>>
                        </div>
                        <div class="col-md-6 col-sm-6 col-xs-12 colegioextranjero"  <?php echo e($colegioextranjero? "":"style=display:none"); ?> >
                          <label for="">Nombre de la Institución Educativa</label>
                          <input type="text" class="form-control mayusculas" name="nombreie" id="nombreie" value="<?php echo e(Auth::user()->nombreie); ?>">
                        </div>
                        <div class="col-md-3 col-sm-3 col-xs-12" id="tipocolegio"  
                            <?php if(Auth::user()->isotrainstitucion == null && Auth::user()->colegioextranjero == null): ?> style="display:none;" <?php endif; ?> >
                          <label for="">¿Que tipo de institución es?</label>
                          <p style="margin: 7px 0px 7px 0px">
                            <span style="margin-right: 10px;">
                                <input type="radio" class="inputtipocolegio"  id="colegioestatal" name="estatal" value="1" <?php if(Auth::user()->estatal == 1): ?> checked <?php endif; ?> />
                                 Estatal 
                            </span>
                            <span>
                                <input type="radio" class="inputtipocolegio"  id="colegio" name="estatal" value="0" <?php if(Auth::user()->estatal == 2): ?> checked <?php endif; ?>  />
                                Particular
                            </span>
                          </p>
                        </div>
                        <div class="col-md-3 col-sm-3 col-xs-12">
                          <label for="">Año en que concluyo *</label>
                          <input type="number" value="<?php echo e(Auth::user()->anotermino? Auth::user()->anotermino:date('Y')); ?>" min="<?php echo e(date ('Y') -70); ?>" max="<?php echo e(date ('Y')); ?>" class="form-control" name="anotermino" id="anotermino">
                        </div>
                      </div>
                    </div>
                  </div>
                </form>
              </div>
              <div id="step-2">
                <form class="form-horizontal form-label-left panel">
                <input type="hidden" name="step_number" value="2">
                  
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
                            <option value="<?php echo e($tarifa->idtarifa); ?>"
                            <?php if($postulacion): ?>
                              <?php if($tarifa->idtarifa == $postulacion->idtarifa): ?> selected <?php endif; ?>
                            <?php endif; ?>
                            ><?php echo e($tarifa->descripcion); ?></option>
                            <?php endforeach; $__env->popLoop(); $loop = $__env->getFirstLoop(); ?>
                          </select>
                        </div>
                        <div class="col-md-6 col-sm-6 col-xs-12">
                          <label for="">Carrera profesional a la que postula *</label>
                          <select name="idescuela" id="idescuela" class="form-control">
                            <option value="0">(Seleccionar)</option>
                            <?php $__currentLoopData = $escuelas; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $escuela): $__env->incrementLoopIndices(); $loop = $__env->getFirstLoop(); ?>
                            <option value="<?php echo e($escuela->idescuela); ?>"
                            <?php if($escuela->idescuela == $postulacion->idescuela): ?> selected <?php endif; ?>
                            ><?php echo e($escuela->descripcion); ?></option>
                            <?php endforeach; $__env->popLoop(); $loop = $__env->getFirstLoop(); ?>
                          </select>
                        </div>
                      </div>
                    </div>
                  
                    <div class="panel panel-primary">
                      <div class="panel-heading">
                        <h3 class="panel-title">Encuestas</h3>
                      </div>
                      <div class="panel-body">
                        <div class="col-md-6 col-sm-6 col-xs-12">
                          <label for="">¿Por qué medio se enteró del proceso de admisión?</label>
                          <select name="medioseentero" id="medioseentero" class="form-control">
                            <option value="0">(Seleccionar)</option>
                            <?php $__currentLoopData = $encuesta1; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $rpta): $__env->incrementLoopIndices(); $loop = $__env->getFirstLoop(); ?>
                            <option value="<?php echo e($rpta->id); ?>"
                              <?php echo e($postulacion->medioseentero == $rpta->id ? 'selected':''); ?>

                            ><?php echo e($rpta->descripcion); ?>

                            </option>
                            <?php endforeach; $__env->popLoop(); $loop = $__env->getFirstLoop(); ?>
                          </select>
                        </div>
                        <div class="col-md-6 col-sm-6 col-xs-12">
                          <label for="">¿Dónde se preparó para el examen de admisión?</label>
                          <select name="dondesepreparo" id="dondesepreparo" class="form-control" required="required">
                            <option value="0">(Seleccionar)</option>
                            <?php $__currentLoopData = $encuesta2; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $rpta): $__env->incrementLoopIndices(); $loop = $__env->getFirstLoop(); ?>
                            <option value="<?php echo e($rpta->id); ?>"
                              <?php echo e($postulacion->dondesepreparo == $rpta->id ? 'selected':''); ?>

                            ><?php echo e($rpta->descripcion); ?></option>
                            <?php endforeach; $__env->popLoop(); $loop = $__env->getFirstLoop(); ?>
                          </select>
                        </div>
                      </div>
                    </div>
                  
                    <div class="panel panel-primary">
                      <div class="panel-heading">
                        <h3 class="panel-title">Declaracion Jurada</h3>
                      </div>
                      <div class="panel-body">
                        <div class="col-md-12 col-sm-12 col-xs-12">
                          <p class="text-sm text-justify">En mi condición de postulante, declaro que la información consignada
                            en este formato corresponde a la verdad y tiene carácter de declaración jurada;
                            sujetándome a las acciones administrativas y/o penales que de ello pudieran derivarse, en el marco
                            de las normas legales y reglamentarias sobre la materia.
                            Por lo expuesto, autorizo expresamente la notificación a través del 
                            correo electrónico antes declarado.
                          </p>
                          <input type="checkbox" value="A" wire:model="foo" required>    
                          <label for="">Acepto los términos y condiciones</label>                                                
                        </div>
                      </div>
                    </div>
                </form>
              </div>
              <!--<div id="step-3">
                <form class="form-horizontal form-label-left panel">
                <input type="hidden" name="step_number" value="3">
                  <div class="row">
                    <div align="center" class="col-md-6 col-sm-12">
                      <h2>Modelo de Vaucher</h2>
                      <img style="height: : 30vh;" src="<?php echo e(asset('images/vaucher.jpg')); ?>" alt="">
                    </div>
                    <div class="col-md-6 col-sm-12">
                      <h2 style="font-size:30px;font-weight: bold;">Pago por la inscripción</h2>
                      <p style="margin-bottom: -10px;">El depósito se deberá hacer en el banco Interbank al número de cuenta: <br> <strong>454515-545654</strong></p>
                      <hr>
                      <table id="tblpagos" class="table table-hover">
                        <thead>
                          <tr>
                            <th>#</th>
                            <th>Descripción</th>
                            <th>Importe</th>
                          </tr>
                        </thead>
                        <tbody>
                          <tr>
                            <th scope="row">1</th>
                            <td>Carpeta del Postulante</td>
                            <td  id="costocarpeta">S/. 0.00</td>
                          </tr>
                          <tr>
                            <th scope="row">2</th>
                            <td>Prospecto de admisión</td>
                            <td id="costoprospecto">S/. 0.00</td>
                          </tr>
                          <tr>
                            <th scope="row">2</th>
                            <td>Admisión</td>
                            <td id="costopostulacion">S/. 0.00</td>
                          </tr>
                        </tbody>
                        <thead>
                          <tr>
                            <th scope="row"></th>
                            <th>Total</th>
                            <th id="costototal">S/. 0.00</th>
                          </tr>
                        </thead>
                      </table>
                      <form action="">
                        <div class="form-group">
                          <label class="control-label col-md-5 col-sm-5 col-xs-12" for="">Nro. de Operación</label>
                          <div class="col-md-7 col-sm-7 col-xs-12">
                            <input type="text" class="form-control col-md-7 col-xs-12" 
                                    id="numerooperacion" name="numerooperacion" 
                                    value="<?php echo e($postulacion->numerooperacion); ?>">
                          </div>
                        </div>
                      </form>
                    </div>
                  </div>
                  
                </form>
              </div>
              <div id="step-4">
                <form class="form-horizontal form-label-left panel">
                  <div class="jumbotron">
                    <div class="row">
                      <div class="col-md-12">
                        <h1 align="center">!Felicidades¡</h1>
                        <h3 align="center">Te has registrado de forma satisfactoria</h3>
                        <br>
                        <h2>Ahora imprime los siguientes formatos, revísalos y coloca tu firma y huella digital en los lugares que lo indique.</h2>
                        <h2>Luego dirígete al oficina de <strong>ADMISIÓN</strong> de la Universidad Nacional de Barranca,  ubicada en el Jr. Gálvez N° 557 - Barranca, para validar su inscripción.</h2>
                        <h2><strong>Nota:</strong> Debes validar tu inscripción en la oficina para que sea válida.</h2>
                      </div>
                      <div class="col-md-12">
                        <ul id="lista-link">
                          <li>
                            <a href="<?php echo e(url('/pdf/ficha_inscripcion')); ?>" target="_blank">
                              <span class="fa fa-file-pdf-o"></span> 1. Ficha de Inscripción
                            </a>
                          </li>
                          <li>
                            <a href="<?php echo e(url('/pdf/carne_inscripcion')); ?>" target="_blank">
                              <span class="fa fa-file-pdf-o"></span> 2. Carné de postulante - Declaración Jurada
                            </a>
                          </li>
                          <li>
                            <a href="<?php echo e(url('/pdf/jdantecedentes_inscripcion')); ?>" target="_blank">
                              <span class="fa fa-file-pdf-o"></span> 3. Declaración Jurada de Antecedentes Penales
                            </a>
                          </li>

                        </ul>
                        <style type="text/css">
                          #lista-link li{
                            list-style:none;
                            margin:15px 0px 15px 0px;
                            font-size: 15px;
                            font-weight: bold;
                            text-decoration: underline;
                          }
                        </style>
                      </div>
                    </div>
                    
                  </div>
                </form>
              </div> -->
            </div>
            <!-- End SmartWizard Content -->
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
                  <img id="img-input" name="foto" class="img-responsive"
                  <?php if(Auth::user()->foto == ""): ?> 
                    src="<?php echo e(asset('images/user.png')); ?>"/>
                  <?php else: ?>
                    src="<?php echo e(asset('/').Auth::user()->foto); ?>"/>
                  <?php endif; ?>
              </label>
          </div>
        </div>
        <div class="modal-footer">

          <form enctype="multipart/form-data" id="form-foto" method="post">
            <input type="hidden" name="_token" value="<?php echo e(csrf_token()); ?>" />
            <input type="file" name="image" id="image" />
            <input type="hidden" name="iduser" id="iduser" value="<?php echo e(Auth::id()); ?>">
            <button type="submit" disabled="true" id="btnGuardar" class="btn btn-primary">
              Guardar<span class="fa fa-save"></span>
            </button>
          </form>
        </div>

      </div>
    </div>
  </div>
<?php $__env->stopSection(); ?>

<?php $__env->startSection('css'); ?>
  <link href="<?php echo e(asset('css/jquery.Jcrop.css')); ?>" rel="stylesheet">
  <!-- PNotify -->
  <link href="<?php echo e(asset('css/pnotify.css')); ?>" rel="stylesheet">
  <link href="<?php echo e(asset('css/pnotify.buttons.css')); ?>" rel="stylesheet">
  <link href="<?php echo e(asset('css/pnotify.nonblock.css')); ?>" rel="stylesheet">
  <style type="text/css">
    #img-input{
      width: 600px;
      border: 1px;
    }
    #target {
      background-color: #ccc;
      width: 500px;
      height: 330px;
      font-size: 24px;
      display: block;
    }
    #img-btn{
       width: 100px; 
       height: 100px;
    }
    #img-btn:hover span{
      display: block;
    }
    #img-btn:hover img{
      background-color: rgba(0,0,0,0.8);
      filter:brightness(0.4);
    }

    #img-btn span{
      position: absolute;
      left:46%; 
      top: 30%;
      color: #fff;
      font-size: 2em; 
      display: none;
    }
  </style>
<?php $__env->stopSection(); ?>

<?php $__env->startSection('js'); ?>
  <script src="<?php echo e(asset('js/jquery.smartWizard.js')); ?>"></script>
  <script src="<?php echo e(asset('js/jquery.Jcrop.js')); ?>"></script>
  <script src="<?php echo e(asset('js/jquery.color.js')); ?>"></script>

   <!-- PNotify -->
  <script src="<?php echo e(asset('js/pnotify.js')); ?>"></script>
  <script src="<?php echo e(asset('js/pnotify.buttons.js')); ?>"></script>
  <script src="<?php echo e(asset('js/pnotify.nonblock.js')); ?>"></script>
  <script src="<?php echo e(asset('js/myjs/postular.js')); ?>"></script>


  <script type="text/javascript">
    $(document).ready(function() {
      // Initialize Smart Wizard with ajax content load
      $('#wizard2').smartWizard({
        labelNext: "Siguiente",
        labelPrevious: "Anterior",
        labelFinish: "Finalizar",
        buttonOrder: [ 'prev', 'next', 'finish',],
        onLeaveStep: leaveAStepCallback,
        onFinish:onFinishCallback,
      });
      $(".buttonNext").addClass("btn btn-success");
      $(".buttonPrevious").addClass("btn btn-primary");
      $(".buttonFinish").addClass("btn btn-default"); 
    }); 
    function leaveAStepCallback(obj, context) {
      $msg = "";
      $success = false;
      $form = $("#step-"+context.fromStep+" form");
      $.ajax({
        async:false, 
            type: 'POST',
            url: $urlbase+'/postular/save',
            data: $form.serialize(),
            dataType: 'json',
            success: function(data) {
              $msg = data.message;
              if(context.fromStep == 2) {
                printdatos3(data);
              }
              mensaje($msg, "green");
                $success = true;
                window.scrollTo(0,0);
            },
            error: function(data) {
              //  $result.success = false;
              if(data.status == "422"){
                pinterrors(data);
              }
              else{
                $msg  = "No se pudo guardar.<br> Inténtelo de nuevo más tarde.";
              }
              mensaje($msg, "red");
          $success = false;
            }
        });
        return $success;  
    }

    function onFinishCallback(objs, context) {
      $msg = "";
      $success = false;
      $form = $("#step-"+context.fromStep+" form");
      $.ajax({
        async:false, 
            type: 'POST',
            url: $urlbase+'/postular/save',
            data: $form.serialize(),
            dataType: 'json',
            success: function(data) {
              window.location.replace($urlbase+ '/postular');
            },
            error: function(data) {
              //  $result.success = false;
              if(data.status == "422"){
                pinterrors(data);
              }
              else{
                $msg  = "No se pudo guardar.<br> Inténtelo de nuevo más tarde.";
              }
              mensaje($msg, "red");
          $success = false;
            }
        });
        return $success;  
    }

    

    function pinterrors(data){
      $msg ="";
      $("input").removeClass("parsley-error");
      $.each(data.responseJSON, function(i, item) {
          $msg +=  "• "+item[0] +"<br>";
          $( "[name='"+i+"']" ).addClass("parsley-error");
      });
        return $msg;
    }

    function printdatos3(data) {
      console.log(data);
      $('#costocarpeta').html("S/. "+data.costocarpeta);
      $('#costoprospecto').html("S/. "+data.costoprospecto);
      $('#costopostulacion').html("S/. "+data.costopostulacion);
      $('#costototal').html("S/. "+(parseFloat(data.costocarpeta)+
                        parseFloat(data.costoprospecto)+
                        parseFloat(data.costopostulacion)).toFixed(2));
    }
  </script>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.master', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>