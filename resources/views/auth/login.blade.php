<?php 
use App\Proceso;
?>
@extends('layouts.master_auth')

@section('title', 'Acceso')

@section('content')
  @parent

    <div>

      <div class="login_wrapper">
        <div class="animate form login_form">
          <section class="login_content">
            <img src="{{ asset('images/logo.png') }}" alt="">
            <form role="form" method="POST" action="{{ url('/login') }}">
                {{ csrf_field() }}
              <h1>Inicio de Sesió</h1>
              <div style="margin-bottom: 10px;">
                <input style="margin-bottom: 1px;" id="email" type="email" class="form-control"  name="email" value="{{ old('email') }}" placeholder="E-mail" required autofocus />
                @if ($errors->has('email'))
                    <span style="color: #f44">{{ $errors->first('email') }}</span>
                @endif
              </div>
              <div>
                <input style="margin-bottom: 1px;" id="password" type="password" class="form-control" placeholder="Contraseña" name="password" required />
                @if ($errors->has('password'))
                    <span style="color: #f44">{{ $errors->first('password') }}</span>
                @endif
              </div>
              <div style="margin-top: 15px">
                  
                <button  type="submit" class="submit btn btn-default">
                    Ingresar
                </button>
              </div>

              <div class="clearfix"></div>

              <div class="separator">
                @if(Proceso::abierto())
                <p class="change_link">
                  <a style="font-size: 15px;" href="{{ url('register') }} " hidden=""> Registrarse </a>
                  <a style="font-size: 15px;" target="blank" href="{{ url('/pdf/MANUAL-DE-USUARIO-UNAB-ADMISION-2020-II.pdf') }}"> Descargar Instrucciones </a>
                </p>
                @endif

                <div class="clearfix"></div>
                <br />

                <div>
                  <br>
                    <center>
                        <p>UNAB © 2019 Todos los Derechos Reservados - Desarrollado por UTIC</p>
                    </center>
                </div>
              </div>
            </form>
          </section>
        </div>

      </div>
    </div>
@endsection