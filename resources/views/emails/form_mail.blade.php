@extends('layouts.master')

@section('title', '')

@section('content')
  @parent


       
   <div class="">
    <div class="page-title">
      <div class="title_left">
        <h3>Aulas para Admision por Modalidad de Examen <small>Mantenimiento</small></h3>
      </div>
    </div>
    <div class="clearfix"></div>
    <div class="row">
      <div class="col-md-12 col-sm-12 col-xs-12">
        <div class="x_panel">
          <div class="x_title">
            
            <div class="col-md-12">
            <form    action="{{ url('enviar') }}" method="POST" enctype="multipart/form-data">

        {{csrf_field() }}
            
              
                    <div class="box-header with-border">
                      <h3 class="box-title">Crear Nuevo Correo</h3>
                    </div><!-- /.box-header -->
                    <div class="box-body">
                    
                      <div class="form-group">
                        <input class="form-control" placeholder="Para:" id="destinatario" name="destinatario">
                      </div>
                      <div class="form-group">
                        <input class="form-control" placeholder="Asunto:" id="asunto" name="asunto">
                      </div>
                      <div class="form-group">
                        <textarea id="contenido_mail" name="contenido_mail" class="form-control" style="height: 200px" placeholder="escriba aquí...">
                         
                        </textarea>
                      </div>
                      <div class="form-group">
                        <div class="btn btn-default btn-file">
                          <i class="fa fa-paperclip"></i> Adjuntar Archivo
                          <input type="file"  id="file" name="file" class="email_archivo" >
                        </div>
                        <p class="help-block"  >Max. 20MB</p>
                        <div id="texto_notificacion">
                        
                        </div>
                      </div>

                

                    </div><!-- /.box-body -->
                    <div class="box-footer">
                      <div class="pull-right">
                     
                        <button type="submit" class="btn btn-primary"><i class="fa fa-envelope-o"></i> ENVIAR</button>
                      </div>
                   <br/>
                    </div><!-- /.box-footer -->
              
                     

              </form>
            </div><!-- /.col -->
          </div><!-- /.row -->
              
</div>
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
 <script src="{{ asset('js/myjs/enviarCorreo.js') }}"></script>  



@endsection