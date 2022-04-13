@extends('layouts.app', ['class' => 'off-canvas-sidebar', 'activePage' => 'login', 'title' => __('Ficein')])

@section('content')
    <div class="container" style="height: auto; margin-top: 5%;">
        @if(session('status'))
            <div class="alert alert-success" role="alert">
                {{session('status')}}
            </div>
        @endif
        <div class="row align-items-center">
            <div class="row col-10 justify-content-center m-auto">
                <div class="col-5 p-0 hide-logo-login" style="z-index: 9;">
                    <img src="{{ asset('material') }}/img/fondo.png" style="width: inherit; height: 400px;  border-radius:10px 0 0 10px; filter: contrast(0.9)">
                </div>
                <div class="col-5 p-0 full-login">
                    <form class="form" method="POST" action="{{ route('login') }}">
                        @csrf
                        <div class="card card-login card-hidden m-0 full-radius" style="margin-left: -1px !important; border-radius:0 10px 10px 0; height: 400px !important;">
                            <div class="card-body mt-4">
                                <h4 style="font-weight: 500" class="text-center ficein-color">Iniciar Sesión</h4>
                                <p class="card-description text-center"><strong>{{ __('Debes estar registrado para iniciar sesión') }}</strong></p>
                                <div class="bmd-form-group{{ $errors->has('email') ? ' has-danger' : '' }}">
                                    <div class="input-group">
                                        <div class="input-group-prepend">
                                      <span class="input-group-text">
                                        <i class="material-icons">email</i>
                                      </span>
                                        </div>
                                        <input type="text" name="rfc" class="form-control own-form-2" placeholder="{{ __('RFC') }}" value="{{ old('rfc') }}" required>
                                    </div>
                                    @if ($errors->has('rfc'))
                                        <div id="rfc-error" class="error text-danger pl-3" for="rfc" style="display: block;">
                                            <strong>{{ $errors->first('rfc') }}</strong>
                                        </div>
                                    @endif
                                </div>
                                <div class="bmd-form-group{{ $errors->has('password') ? ' has-danger' : '' }} mt-3">
                                    <div class="input-group">
                                        <div class="input-group-prepend">
                                      <span class="input-group-text">
                                        <i class="material-icons">lock_outline</i>
                                      </span>
                                        </div>
                                        <input type="password" name="password" id="password" class="form-control own-form-2" placeholder="{{ __('Contraseña') }}" value="{{ old('password') }}" required>
                                    </div>
                                    @if ($errors->has('password'))
                                        <div id="password-error" class="error text-danger pl-3" for="password" style="display: block;">
                                            <strong>{{ $errors->first('password') }}</strong>
                                        </div>
                                    @endif
                                </div>
                                <div class="container text-center">
                                    <button type="submit" class="btn btn-ficein btn-sm mt-3" style="padding: 0.40625rem 4.50rem">{{ __('Ingresar') }}</button>
                                    <div class="form-check mt-3 text-left" style="margin-left: 7px">
                                        <label class="form-check-label">
                                            <input class="form-check-input" type="checkbox" name="remember" {{ old('remember') ? 'checked' : '' }}> {{ __('Recuerdame') }}
                                            <span class="form-check-sign">
                                                <span class="check"></span>
                                            </span>
                                        </label>
                                    </div>
                                    @if (Route::has('password.request'))
                                        <div class="form-check mt-3 text-left">
                                            <a href="{{ route('password.request') }}" class="ficein-color text-left">
                                                <span>{{ __('Restablecer mi contraseña.') }}</span>
                                            </a>
                                        </div>
                                    @endif
                                </div>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection
