@extends('layouts.master')

@section('title', 'Reporte de Postulantes')

@section('content')
  @parent
  <div class="">
    <div class="row">
      <div class="col-md-12 col-sm-12 col-xs-12">
        <div class="x_panel">
          <div class="x_title">
            <h2>Reporte Estadístico de Ingresantes</h2>
            <ul class="nav navbar-right panel_toolbox">
              <li style="margin-right: 15px">
                <h4> Filtros:</h4>
              </li>
               <li style="margin-right: 15px">
                <select style="width: 120px" id="idproceso" onchange="consultar()" class="form-control" name="">
                  @foreach($procesos as $proceso)
                    <option value="{{ $proceso->id }}">{{ $proceso->descripcion }}</option>
                  @endforeach
                </select>
              </li>
              <li style="margin-right: 15px">
                <select style="width: 200px" id="tipobusqueda" onchange="consultar()" class="form-control" name="" >
                  <option value="0">Por departamentos</option>
                  <option value="1">Por provincia</option>
                  <option value="2">Por distrito</option>
                </select>
              </li>
            </ul>
            <div class="clearfix"></div>
          </div>
          <div class="x_content">
            <p> <strong id="message"></strong></p>
              <table id="myTable" width="100%" class="table table-hover table-bordered">
                <tfoot>
                  <tr>
                      <th colspan="1" style="text-align:right">Total:</th>
                      <th></th>
                      <th></th>
                      <th></th>
                  </tr>
                </tfoot>
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
@endsection

@section('js')
  <script src="{{ asset('js/jquery.dataTables.min.js') }}"></script>
  <script src="{{ asset('js/dataTables.buttons.min.js') }}"></script>
  <script src="{{ asset('js/jszip.min.js') }}"></script>
  <script src="{{ asset('js/pdfmake.min.js') }}"></script>
  <script src="{{ asset('js/vfs_fonts.js') }}"></script>
  <script src="{{ asset('js/buttons.html5.min.js') }}"></script>
  <script src="{{ asset('js/buttons.print.min.js') }}"></script>
  <script src="{{ asset('js/myjs/rep-estadistica.js') }}"></script>
@endsection