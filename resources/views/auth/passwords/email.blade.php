@extends('layouts.app', ['class' => 'off-canvas-sidebar', 'activePage' => 'email', 'title' => __('Ficein')])

@section('content')
    <div class="container" style="height: auto;">
        <div class="row align-items-center">
            <div class="col-lg-4 col-md-6 col-sm-8 ml-auto mr-auto">
                <form class="form" method="POST" action="{{ route('password.email') }}">
                    @csrf

                    <div class="card card-login card-hidden mb-3">
                        <div class="card-header card-header-primary text-center">
                            <h4 class="card-title"><strong>{{ __('Olvide mi contraseña') }}</strong></h4>
                        </div>
                        <div class="card-body">
                            @if (session('status'))
                                <div class="row">
                                    <div class="col-sm-12">
                                        <div class="alert alert-success">
                                            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                                <i class="material-icons">close</i>
                                            </button>
                                            <span>{{ session('status') }}</span>
                                        </div>
                                    </div>
                                </div>
                            @endif
                            <div class="bmd-form-group{{ $errors->has('rfc') ? ' has-danger' : '' }}">
                                <div class="input-group">
                                    <div class="input-group-prepend">
                                      <span class="input-group-text">
                                        <i class="material-icons">email</i>
                                      </span>
                                    </div>
                                    <input type="text" name="rfc" class="form-control" placeholder="{{ __('RFC') }}" value="{{ old('rfc') }}" required>
                                </div>
                                @if ($errors->has('rfc'))
                                    <div id="rfc-error" class="error text-danger pl-3" for="rfc" style="display: block;">
                                        <strong>{{ $errors->first('rfc') }}</strong>
                                    </div>
                                @endif
                            </div>
                        </div>
                        <div class="card-footer justify-content-center">
                            <button type="submit" class="btn ficein-color btn-link btn-lg">{{ __('Enviar enlace para restablecer') }}</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection
