@extends('layouts.master')

@section('title', '')

@section('content')
  @parent
  <div class="">
    <div class="page-title">
      <div class="title_left">
        <h3>Cargar Resultados</h3>
      </div>

    </div>

    <div class="clearfix"></div>

    <div class="row">
      <div class="col-md-12 col-sm-12 col-xs-12">
        <div id="verificar" class="x_panel">
          
          <div id="principal"  class="x_content">
            <div class="row">
              <div class="col-sm-12">
                <h2>Cargue los resultados en un documento excel:</h2>
                <form id="form-cargar" action="cargar-resultados" method="post">
                  <input id="file" class="form-control" name="file" style="width: 350px;" align="center" type="file">
                  <br>

                  <div id="alert" style="display: none;" class="alert alert-info  alert-dismissible fade in" role="alert">
                    <p id="message"></p>
                  </div>

                  <button class="btn btn-primary"><span class="fa fa-cloud-upload "></span> Cargar Resultados</button>
                </form>
              </div>
            </div>
            
            
          </div>
        </div>
      </div>
    </div>
  </div>
@endsection

@section('css')
 
@endsection

@section('js')
<!-- PNotify -->
  <script src="{{ asset('js/pnotify.js') }}"></script>
  <script src="{{ asset('js/pnotify.buttons.js') }}"></script>
  <script src="{{ asset('js/pnotify.nonblock.js') }}"></script>
  <script>
    $( "#form-cargar" ).submit(function( event ) {
      event.preventDefault();
      var formData = new FormData($(this)[0]);
      $.ajax({
        url: "cargar-resultados",
        type: "POST",
        data: formData,
        cache: false,
        contentType: false,
        processData: false,
        beforeSend: function() {
          // body...
        },
        success: function(data) {
          $("#file").val("");
          $("#alert").show(0).delay(5000).hide(0);
          $("#message").text("Se guardaron "+data.correcto+" registro correctamente de un total de "+data.total+ " registros");
        },
        error: function(data) {
          // body...
        }
      });
    });
  </script>
@endsection