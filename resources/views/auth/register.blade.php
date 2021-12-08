@extends('layouts.app', ['class' => 'off-canvas-sidebar', 'activePage' => 'register', 'title' => __('Ficein')])

@section('content')
    <div class="container" style="height: auto;">
        <div class="row align-items-center">
            <div class="col-lg-4 col-md-6 col-sm-8 ml-auto mr-auto">
                <form class="form" method="POST" action="{{ route('register') }}">
                    @csrf

                    <div class="card card-login card-hidden mb-3">
                        <div class="card-header card-header-primary text-center">
                            <h4 class="card-title"><strong>{{ __('Register') }}</strong></h4>
                            <div class="social-line">
                                <a href="#pablo" class="btn btn-just-icon btn-link btn-white">
                                    <i class="fa fa-facebook-square"></i>
                                </a>
                                <a href="#pablo" class="btn btn-just-icon btn-link btn-white">
                                    <i class="fa fa-twitter"></i>
                                </a>
                                <a href="#pablo" class="btn btn-just-icon btn-link btn-white">
                                    <i class="fa fa-google-plus"></i>
                                </a>
                            </div>
                        </div>
                        <div class="card-body ">
                            <p class="card-description text-center">{{ __('Or Be Classical') }}</p>
                            <div class="bmd-form-group{{ $errors->has('name') ? ' has-danger' : '' }}">
                                <div class="input-group">
                                    <div class="input-group-prepend">
                  <span class="input-group-text">
                      <i class="material-icons">face</i>
                  </span>
                                    </div>
                                    <input type="text" name="name" class="form-control" placeholder="{{ __('Nombre...') }}" value="{{ old('name') }}" required>
                                </div>
                                @if ($errors->has('name'))
                                    <div id="name-error" class="error text-danger pl-3" for="name" style="display: block;">
                                        <strong>{{ $errors->first('name') }}</strong>
                                    </div>
                                @endif
                            </div>
                            <div class="bmd-form-group{{ $errors->has('username') ? ' has-danger' : '' }}">
                                <div class="input-group">
                                    <div class="input-group-prepend">
                  <span class="input-group-text">
                      <i class="material-icons">account_box</i>
                  </span>
                                    </div>
                                    <input type="text" name="username" class="form-control" placeholder="{{ __('Nombre de usuario...') }}" value="{{ old('username') }}" required>
                                </div>
                                @if ($errors->has('username'))
                                    <div id="name-error" class="error text-danger pl-3" for="username" style="display: block;">
                                        <strong>{{ $errors->first('username') }}</strong>
                                    </div>
                                @endif
                            </div>
                            <div class="bmd-form-group{{ $errors->has('email') ? ' has-danger' : '' }} mt-3">
                                <div class="input-group">
                                    <div class="input-group-prepend">
                  <span class="input-group-text">
                    <i class="material-icons">email</i>
                  </span>
                                    </div>
                                    <input type="email" name="email" class="form-control" placeholder="{{ __('Email...') }}" value="{{ old('email') }}" required>
                                </div>
                                @if ($errors->has('email'))
                                    <div id="email-error" class="error text-danger pl-3" for="email" style="display: block;">
                                        <strong>{{ $errors->first('email') }}</strong>
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
                                    <input type="password" name="password" id="password" class="form-control" placeholder="{{ __('Contraseña...') }}" required>
                                </div>
                                @if ($errors->has('password'))
                                    <div id="password-error" class="error text-danger pl-3" for="password" style="display: block;">
                                        <strong>{{ $errors->first('password') }}</strong>
                                    </div>
                                @endif
                            </div>
                            <div class="bmd-form-group{{ $errors->has('password_confirmation') ? ' has-danger' : '' }} mt-3">
                                <div class="input-group">
                                    <div class="input-group-prepend">
                  <span class="input-group-text">
                    <i class="material-icons">lock_outline</i>
                  </span>
                                    </div>
                                    <input type="password" name="password_confirmation" id="password_confirmation" class="form-control" placeholder="{{ __('Confirmar Contraseña...') }}" required>
                                </div>
                                @if ($errors->has('password_confirmation'))
                                    <div id="password_confirmation-error" class="error text-danger pl-3" for="password_confirmation" style="display: block;">
                                        <strong>{{ $errors->first('password_confirmation') }}</strong>
                                    </div>
                                @endif
                            </div>
                            <div class="bmd-form-group{{ $errors->has('topic') ? ' has-danger' : '' }}">
                                <div class="input-group">
                                    <div class="input-group-prepend">
                  <span class="input-group-text">
                      <i class="material-icons">topic</i>
                  </span>
                                    </div>
                                    <select name="topic" class="form-control" required>
                                        <option disabled selected>Giro de la cuenta</option>
                                        @foreach($topics as $topic)
                                            <option class="form-control" value="{{$topic->id}}">{{$topic->name}}</option>
                                        @endforeach
                                    </select>
                                </div>
                                @if ($errors->has('topic'))
                                    <div id="name-error" class="error text-danger pl-3" for="topic" style="display: block;">
                                        <strong>{{ $errors->first('topic') }}</strong>
                                    </div>
                                @endif
                            </div>
                            <div class="bmd-form-group{{ $errors->has('country') ? ' has-danger' : '' }}">
                                <div class="input-group">
                                    <div class="input-group-prepend">
                  <span class="input-group-text">
                      <i class="material-icons">flag</i>
                  </span>
                                    </div>
                                    <select name="country" class="form-control" required>
                                        <option disabled selected>Nacionalidad</option>
                                        @foreach($countries as $code => $country)
                                            <option class="custom-select" value="{{$code}}" @if($country == "Mexico") selected @else @endif>{{$country}}</option>
                                        @endforeach
                                    </select>
                                </div>
                                @if ($errors->has('country'))
                                    <div id="name-error" class="error text-danger pl-3" for="country" style="display: block;">
                                        <strong>{{ $errors->first('country') }}</strong>
                                    </div>
                                @endif
                            </div>
                            <div class="bmd-form-group{{ $errors->has('slug') ? ' has-danger' : '' }}">
                                <div class="input-group">
                                    <div class="input-group-prepend">
                  <span class="input-group-text">
                      <i class="material-icons">link</i>
                  </span>
                                    </div>
                                    <input type="text" name="slug" class="form-control" placeholder="{{ __('Escribe la URL que deseas para tu perfil...') }}" value="{{ old('slug') }}" required>
                                </div>
                                @if ($errors->has('slug'))
                                    <div id="name-error" class="error text-danger pl-3" for="slug" style="display: block;">
                                        <strong>{{ $errors->first('slug') }}</strong>
                                    </div>
                                @endif
                            </div>
                            <div class="bmd-form-group{{ $errors->has('gender') ? ' has-danger' : '' }}">
                                <div class="input-group">
                                    <div class="input-group-prepend">
                  <span class="input-group-text">
                      <i class="material-icons">spoke</i>
                  </span>
                                    </div>
                                    <select name="gender" id="gender" class="form-control" required>
                                        <option disabled selected>Género</option>
                                        <option class="custom-select" value="0">Femenino</option>
                                        <option class="custom-select" value="1">Masculino</option>
                                    </select>
                                </div>
                                @if ($errors->has('gender'))
                                    <div id="name-error" class="error text-danger pl-3" for="gender" style="display: block;">
                                        <strong>{{ $errors->first('gender') }}</strong>
                                    </div>
                                @endif
                            </div>
                            <div class="bmd-form-group{{ $errors->has('is_company') ? ' has-danger' : '' }}">
                                <div class="input-group">
                                    <div class="input-group-prepend">
                  <span class="input-group-text">
                      <i class="material-icons">verified</i>
                  </span>
                                    </div>
                                    <select name="is_company" id="is_company" class="form-control" required onclick="verify_type()">
                                        <option disabled selected>Tipo de Cuenta</option>
                                        <option class="custom-select" value="0">Personal</option>
                                        <option class="custom-select" value="1">Empresarial</option>
                                    </select>
                                </div>
                                @if ($errors->has('is_company'))
                                    <div id="name-error" class="error text-danger pl-3" for="is_company" style="display: block;">
                                        <strong>{{ $errors->first('is_company') }}</strong>
                                    </div>
                                @endif
                            </div>
                            <div class="bmd-form-group{{ $errors->has('company_role') ? ' has-danger' : '' }}" id="role_form" style="display: none">
                                <div class="input-group">
                                    <div class="input-group-prepend">
                  <span class="input-group-text">
                      <i class="material-icons">badge</i>
                  </span>
                                    </div>
                                    <select name="company_role" id="company_role" class="form-control">
                                        <option disabled selected>Rol en la Empresa</option>
                                        <option class="custom-select" value="Empleado">Empleado</option>
                                        <option class="custom-select" value="Gerente">Gerente</option>
                                        <option class="custom-select" value="Director">Director</option>
                                        <option class="custom-select" value="Dueño">Dueño</option>
                                        <option class="custom-select" value="Socio">Socio</option>
                                        <option class="custom-select" value="Otro">Otro</option>
                                    </select>
                                </div>
                                @if ($errors->has('company_role'))
                                    <div id="name-error" class="error text-danger pl-3" for="company_role" style="display: block;">
                                        <strong>{{ $errors->first('company_role') }}</strong>
                                    </div>
                                @endif
                            </div>
                            <div class="form-check mr-auto ml-3 mt-3">
                                <label class="form-check-label">
                                    <input class="form-check-input" type="checkbox" id="policy" name="policy" {{ old('policy', 1) ? 'checked' : '' }} >
                                    <span class="form-check-sign">
                  <span class="check"></span>
                </span>
                                    {{ __('I agree with the ') }} <a href="#">{{ __('Privacy Policy') }}</a>
                                </label>
                            </div>
                        </div>
                        <div class="card-footer justify-content-center">
                            <button type="submit" class="btn btn-primary btn-link btn-lg">{{ __('Create account') }}</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <script>
        var is_company = document.getElementById('is_company');
        var role_form = document.getElementById('role_form');
        var company_role = document.getElementById('company_role');

        function verify_type() {
            if(is_company.value === '1') {
                role_form.style.display = 'block';
                company_role.required = true;
            }
            else {
                role_form.style.display = 'none';
                company_role.required = false;
                company_role.value = null;
            }
        }
    </script>
@endsection

