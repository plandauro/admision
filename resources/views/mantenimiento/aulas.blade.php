@extends('layouts.master')

@section('title', '')

@section('content')
  @parent


  
  <div class="">
    <div class="page-title">
      <div class="title_left">
        <h3>Aulas por Modalidad de Examen<small> - Mantenimiento</small></h3>
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

     @include('mantenimiento.formNuevo')
  </div>


<div id="myModal" class="modal fade bs-example-modal-sm" tabindex="-1" role="dialog" aria-hidden="true">
  <div class="modal-dialog modal-sm">
    <div class="modal-content">

      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">×</span>
        </button>
        <h4 class="modal-title" id="myModalLabel2">Nueva Aula con Su respectiva Tipo de Examen</h4>
      </div>
   
      <form id="formAulas" class="form-horizontal form-label-left">
        
            <div class="form-group">
              <label class="control-label col-md-5 col-sm-5 col-xs-12">Nombre Aula:</label>
              <div class="col-md-7 col-sm-7 col-xs-12">
                <input id="descripcion" type="text" class="form-control" name="descripcion" placeholder="PB0@">
              </div>
            </div>
            <div class="form-group">
              <label class="control-label col-md-5 col-sm-5 col-xs-12">Capacidad:</label>
              <div class="col-md-7 col-sm-7 col-xs-12">
                <input id="CapacidadAula" type="text" class="form-control" name="CapacidadAula" placeholder="Capacidad">
              </div>
            </div>
            <div class="form-group">
              <label class="control-label col-md-5 col-sm-5 col-xs-12">Pabellón:</label>
              <div class="col-md-7 col-sm-7 col-xs-12">
                <input id="ubicacionAula" type="text" class="form-control" name="ubicacionAula" placeholder="Ubicacion">
              </div>
            </div>
            <div class="form-group">
              <label class="control-label col-md-5 col-sm-5 col-xs-12">Modalidad:</label>
              <div class="col-md-7 col-sm-7 col-xs-12">
             

                     <select  required="required" id="isoarea" name="isoarea" class="form-control"
                           
                            @if($areas == "")
                                  disabled >
                                  <option value="0">(Selecciona)</option>
                                </select>
                            @else
                            >
                            <option value="0">(Selecciona)</option>

                            @foreach($areas as $area)

                          <option value="{{$area->idarea }}"
                               
                                      @if($area->descripcion == Auth::user()->isoarea)
                                        selected @endif>
                                        
                                    {{$area->descripcion}}
                                  </option>

                                  @endforeach

                                </select>
                            @endif

          </div>
          <br>
 <br> 
            <div class="form-group">
              <label class="control-label col-md-5 col-sm-5 col-xs-12">Orden de Cobertura:</label>
              <div class="col-md-7 col-sm-7 col-xs-12">
                <input id="ordenCobertura" type="text" class="form-control" name="ordenCobertura" placeholder="Ubicacion">
              </div>
            </div>
      

        <div class="modal-footer">
          <button type="button" class="btn btn-default" data-dismiss="modal">Cancelar</button>
          <button type="submit" class="btn btn-primary">Guardar</button>
        </div>
      </form>

    </div>
  </div>

 

</div>


@endsection


@section('css')
  <link rel="stylesheet" href="{{ asset('css/jquery.dataTables.min.css') }}">
  <link rel="stylesheet" href="{{ asset('css/responsive.dataTables.min.css') }}">
  <!-- PNotify -->
  <link href="{{ asset('css/pnotify.css') }}" rel="stylesheet">
  <link href="{{ asset('css/pnotify.buttons.css') }}" rel="stylesheet">
  <link href="{{ asset('css/pnotify.nonblock.css') }}" rel="stylesheet">

  <link href="{{ asset('css/jquery.Jcrop.css') }}" rel="stylesheet">
 
  
@endsection

@section('js')

  <script src="{{ asset('js/jquery.dataTables.min.js') }}"></script>
  <script src="{{ asset('js/dataTables.responsive.min.js') }}"></script>
     <!-- PNotify -->
  <script src="{{ asset('js/pnotify.js') }}"></script>
  <script src="{{ asset('js/pnotify.buttons.js') }}"></script>
  <script src="{{ asset('js/pnotify.nonblock.js') }}"></script>
  <script src="{{ asset('js/bootbox.min.js') }}"></script>
 <script src="{{ asset('js/ie10-viewport-bug-workaround.js') }}"></script>
   <script src="{{ asset('js/validator.min.js') }}"></script>
   <script src="{{ asset('js/bootstrap.min.js') }}"></script>
  <script src="{{ asset('js/myjs/crud-aulasExamen.js') }}"></script>




    <script type="text/javascript">

   function addForm() {
        
     
        $('#modal-form').modal('show');
        $(this).removeData('#modal-form');

        $('.modal-title').text('Actualizar datos Aula');
      }





</script>

@endsection