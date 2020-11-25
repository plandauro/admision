@extends('layouts.master')

@section('title', 'Inicio')

@section('content')
  @parent
  <div id="indexpage" class="">
    
    <img id="idlogo1" src="{{ asset('images/logo.png') }}" alt="">
    <h1>BIENVENIDOS AL PROCESO DE ADMISIÓN {{$descripcion}}</h1>

  </div>
@endsection

@section('css')
<style type="text/css">
  #indexpage{
    text-align: center;
    padding-top: 200px;
  }

  #idlogo1{
    width: 300px;
  }
</style>

@endsection