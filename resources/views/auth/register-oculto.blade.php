@extends('layouts.master_auth')

@section('title', 'Registro')

@section('content')
  @parent
    <div>
      <div class="login_wrapper">
      
        <div id="register" class="animate form login_form">
          <section class="login_content">
            <img src="{{ asset('images/logo.png') }}" alt="">
            <form role="form" method="POST" role="form" action="{{ url('/register') }}">
              {{ csrf_field() }}
              <h1>Registrate</h1>
              <div style="margin-bottom: 10px;">
                <input type="text" style="margin-bottom: 1px;" class="form-control mayusculas" placeholder="Apellidos Paterno" name="apepaterno" value="{{ old('apepaterno') }}" required autofocus/>
                @if ($errors->has('apepaterno'))
                    <span style="color: #f44">{{ $errors->first('apepaterno') }}</span>
                @endif
              </div>
              <div style="margin-bottom: 10px;">
                <input type="text" style="margin-bottom: 1px;" class="form-control mayusculas"  value="{{ old('apematerno') }}" placeholder="Apellido Materno" name="apematerno" required="" />
                @if ($errors->has('apematerno'))
                    <span style="color: #f44">{{ $errors->first('apematerno') }}</span>
                @endif
              </div>
              <div style="margin-bottom: 10px;">
                <input type="text" style="margin-bottom: 1px;" class="form-control mayusculas"  value="{{ old('nombre') }}" placeholder="Nombres" name="nombre" required="" />
                @if ($errors->has('nombre'))
                    <span style="color: #f44">{{ $errors->first('nombre') }}</span>
                @endif
              </div>
              <div style="margin-bottom: 10px;">
                <select name="tipodocumento" id="tipodocumento" class="form-control" style="color: #888"
                  onchange="if($(this).val() != '') $('#dni').prop('disabled', false); else $('#dni').prop('disabled', true);">
                  <option value="" {{ (old('tipodocumento') == '' ? 'selected':'') }}>(Tipo Documento)</option>
                  <option value="1" {{ (old('tipodocumento') == 1 ? 'selected':'') }}>DNI</option>
                  <option value="2" {{ (old('tipodocumento') == 2 ? 'selected':'') }}>Libreta Militar</option>
                  <option value="3" {{ (old('tipodocumento') == 3 ? 'selected':'') }}>Part. Nacimiento - CUI</option>
                  <option value="4" {{ (old('tipodocumento') == 4 ? 'selected':'') }}>Carnet de Extranjería </option>
                  <option value="5" {{ (old('tipodocumento') == 5 ? 'selected':'') }}>Otro </option>
                </select>
                @if ($errors->has('dni'))
                    <span style="color: #f44">{{ $errors->first('dni') }}</span>
                @endif
              </div>
              <div style="margin-bottom: 10px;">
                <input type="text" style="margin-bottom: 1px;" disabled class="form-control"  value="{{ old('dni') }}" placeholder="N° Documento" name="dni" id="dni" required="" />
                @if ($errors->has('dni'))
                    <span style="color: #f44">{{ $errors->first('dni') }}</span>
                @endif
              </div>
              
              <div style="margin-bottom: 10px;">
                <input type="email" style="margin-bottom: 1px;" class="form-control"  value="{{ old('email') }}" placeholder="Email" name="email" required="" />
                @if ($errors->has('email'))
                    <span style="color: #f44">{{ $errors->first('email') }}</span>
                @endif
              </div>
              <div style="margin-bottom: 10px;">
                
                <input  style="margin-bottom: 1px;" id="password" type="password" class="form-control" placeholder="Contraseña" name="password" required>
                @if ($errors->has('password'))
                    <span style="color: #f44">{{ $errors->first('password') }}</span>
                @endif
              </div>
              <div>
                <input id="password-confirm"  type="password" class="form-control" placeholder="Confirmar contraseña" name="password_confirmation" required>
              </div>
              <div>
                <button type="submit" class="submit btn btn-default">
                    Registrarse
                </button>
              </div>

              <div class="clearfix"></div>

              <div class="separator">
                <p class="change_link">
                <a style="font-size: 15px;" href="{{ url('/login') }}"> Iniciar Sesión </a>
                  <a style="font-size: 15px;" href="{{ url('/password/reset') }}"> ¿Olvidaste tu contraseña? </a>
                  
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