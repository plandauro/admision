<?php $__env->startSection('title', ''); ?>

<?php $__env->startSection('content'); ?>
  @parent


  
  <div class="">
    <div class="page-title">
      <div class="title_left">
        <h3>Gestion de Usuarios<small> - Mantenimiento</small></h3>
      </div>
    </div>
    <div class="clearfix"></div>
    <div class="row">
      <div class="col-md-12 col-sm-12 col-xs-12">
        <div class="x_panel">


          <div class="x_title">

            <a>
            <button id="btnEliminar" type="button" class="navbar-right btn btn-danger" data-toggle="modal">
              <span class="fa fa-times-circle"></span> Eliminar
            </button>
            </a>
            
            <a>
            <button id="btnActualizar"  onclick="addForm()" type="button" class="navbar-right btn btn-warning"  >
              <span class="fa fa-pencil"></span> Editar 
            </button>
            </a> 

            <a>
            <button id="btnNuevo"  type="button" class="navbar-right btn btn-primary"  >
              <span class="fa fa-plus"></span> Nuevo
            </button>
            </a> 
            
<div class="clearfix"></div>

          </div>


 <div class="x_content">
              <table id="myTable" style="font-size: 13px" width="100%" class="table table-hover table-bordered display nowrap">
  

              </table>
          </div>

        </div>
      </div>
     </div>
<?php echo $__env->make('mantenimiento.editarUsuarios', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>

<div class="modal" id="myModalNuevo" tabindex="1" role="dialog" aria-hidden="true"  style="overflow-y: auto; "  >
    <div class="modal-dialog modal-lg">
        <div class="modal-content">


            <form id="formEd"  class="form-horizontal" data-toggle="validator" >
                
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true"> &times; </span>
                    </button>
                    <h4 class="modal-title" id="myModalLabel2">Nuevo Usuario</h4>
                </div>

                <div class="modal-body">
                    

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
                            <input type="text" class="form-control"  id="apepaterno" value="" name="apepaterno">
                          </div>
                        </div>
                        <!-- input -->
                        <div class="form-group">
                          <label class="control-label col-md-5 col-sm-5 col-xs-12" for="">Apellido Materno</label>
                          <div class="col-md-7 col-sm-7 col-xs-12">
                            <input type="text" class="form-control col-md-7 col-xs-12"  value="" id="apematerno" name="apematerno">
                          </div>
                        </div>
                        <!-- input -->
                        <div class="form-group">
                          <label class="control-label col-md-5 col-sm-5 col-xs-12" for="">Nombres</label>
                          <div class="col-md-7 col-sm-7 col-xs-12">
                            <input type="text" class="form-control col-md-7 col-xs-12"  id="nombre" name="nombre">
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
                          <label class="control-label col-md-5 col-sm-5 col-xs-12" for=""><small>Departamento*</small></label>
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
                                  <label id="img-btn" style="cursor: pointer;"  >
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
                              <?php echo e(