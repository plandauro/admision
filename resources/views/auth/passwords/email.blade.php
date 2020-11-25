@extends('layouts.master_auth')

@section('title', '')

@section('content')
  @parent
    <div>
      <div class="login_wrapper">
      
        <div id="register" class="animate form login_form">
          <section class="login_content">
            <img src="{{ asset('images/logo.png') }}" alt="">

            <form role="form" method="POST" action="{{ url('/password/email') }}">
              {{ csrf_field() }}
              <h1>Recuperar <br> Contraseña</h1>
              <div style="margin-bottom: 10px;">
                <input id="email" type="email" class="form-control" name="email" value="{{ $email or old('email') }}" placeholder="E-mail" required autofocus>

                @if ($errors->has('email'))
                    <span style="color: #f44">{{ $errors->first('email') }}</span>
                @endif
              </div>
             
             
            
              <div>
                <button type="submit" class="submit btn btn-default">
                    Enviar Contraseña
                </button>
              </div>

              <div class="clearfix"></div>

              <div class="separator">
                <p class="change_link">
                    <a style="font-size: 15px;" href="{{ url('/login') }}"> Iniciar Sesión </a>
                    <a style="font-size: 15px;" href="{{ url('register') }}"> Registrarse </a>
                 
                </p>

                <div class="clearfix"></div>
                <br />

                <div>
                  <p>UNAB ©{{ date("Y") }} All Rights Reserved</p>
                </div>
              </div>
            </form>
          </section>
        </div>
        

      </div>
    </div>

@endsection