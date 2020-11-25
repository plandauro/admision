@extends('layouts.master')

@section('title', 'Reporte de Postulantes Validos / No Validos ')

@section('content')
  @parent
  <div class="">
    <div class="row">
      <div class="col-md-12 col-sm-12 col-xs-12">
        <div class="x_panel">
          <div class="x_title">
            <h2>Reporte de postulantes Validos / No Validos</h2>
            <ul class="nav navbar-right panel_toolbox">
              <li style="margin-right: 15px">
                <h4> Filtros de busqueda:</h4>
              </li>
              <li style="margin-right: 15px">
                <select style="width: 120px" id="idproceso" onchange="consultaProducto()" class="form-control" name="" id="">
                  @foreach($procesos as $proceso)
                    <option value="{{ $proceso->id }}">{{ $proceso->descripcion }}</option>
                  @endforeach
                </select>
              </li>
              <li>
                <select id="dato" style="width: 150px" onchange="consultaProducto()" class="form-control" name="" id="">
                  <option value="0">Todos</option>
                  <option value="1">Validados</option>
                  <option value="2">No Validados</option>
                </select>
              </li>
            </ul>
            <div class="clearfix"></div>
          </div>
          <div class="x_content">
            <p> <strong id="message"></strong></p>
              <table id="myTable" width="100%" class="table table-hover table-bordered">
              </table>
          </div>
        </div>
      </div>
    </div>
  </div>
@endsection

@section('css')
<link rel="stylesheet" href="{{ asset('css/jquery.dataTables.min.css') }}">
<link rel="stylesheet" href="{{ asset('css/buttons.dataTables.min.css') }}">

<style>
  .td-formatos{
    font-size: 15px; text-align: center;
  }
  .td-formatos > a{
    margin: 0px 3px 0px 3px;
  }
</style>
@endsection

@section('js')
<script src="{{ asset('js/jquery.dataTables.min.js') }}"></script>
 <script src="{{ asset('js/dataTables.buttons.min.js') }}"></script>
 <script src="{{ asset('js/jszip.min.js') }}"></script>
 <script src="{{ asset('js/pdfmake.min.js') }}"></script>
 <script src="{{ asset('js/vfs_fonts.js') }}"></script>
 <script src="{{ asset('js/buttons.html5.min.js') }}"></script>
 <script src="{{ asset('js/buttons.print.min.js') }}"></script>
  <script src="{{ asset('js/myjs/rep-postulantevalidado.js') }}"></script>
@endsection