@extends('layouts.app', ['activePage' => 'Visualizar Datos', 'titlePage' => __('Visualizar Datos')])

@section('content')
    <style>
        .copyright {
            color: black !important;
        }
    </style>
    <div class="content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-md-12">
                    <div class="card bg-transparent own-card">
                        <div class="card-header card-header-primary m-0">
                            <div style="display: flex; flex-wrap: wrap">
                                <h4 class="card-title ">Ficein</h4>
                            </div>
                        </div>
                        <div class="card-body">
                            <div class="row">
                                <div class="col-md-8">
                                    <div class="container message-box bg-transparent">
                                        <h4 class="own-card-title font-weight-bold"><i class="material-icons" style="vertical-align: sub">phone</i>Información de Contacto - Ficein</h4>
                                    </div>
                                </div>
                            </div>
                            <div class="card-body">
                                <div class="form-row">
                                    <div class="form-group col-md-12">
                                        <label for="name" class="own-label">Texto</label>
                                        <textarea rows="7" type="text" class="form-control own-form-2" id="texto" name="texto" disabled>{{$contacto->texto}}</textarea>
                                        @error('name')
                                        <span class="text-danger mt-1">{{ $message }}</span>
                                        @enderror
                                    </div>
                                </div>
                                <div class="form-row" style="flex-wrap: wrap; width: -webkit-fill-available">
                                    <div class="card card-nav-tabs" style="width: 33%">
                                        <div class="card-header card-header-primary">
                                            Correos electrónicos
                                        </div>
                                        <ul class="list-group list-group-flush">
                                            <li class="list-group-item"><a>{{$contacto->correo_1}}</a></li>
                                            @if(isset($contacto->correo_2))
                                                <li class="list-group-item"><a>{{$contacto->correo_2}}</a></li>
                                            @endif
                                            @if(isset($contacto->correo_3))
                                                <li class="list-group-item"><a>{{$contacto->correo_3}}</a></li>
                                            @endif
                                        </ul>
                                    </div>
                                    <div style="width: 33%"></div>
                                    <div class="card card-nav-tabs" style="width: 33%">
                                        <div class="card-header card-header-primary">
                                            Números de contacto
                                        </div>
                                        <ul class="list-group list-group-flush">
                                            <li class="list-group-item"><a>{{$contacto->numero_1}}</a></li>
                                            @if(isset($contacto->numero_2))
                                                <li class="list-group-item"><a>{{$contacto->numero_2}}</a></li>
                                            @endif
                                            @if(isset($contacto->numero_3))
                                                <li class="list-group-item"><a>{{$contacto->numero_3}}</a></li>
                                            @endif
                                        </ul>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
@endsection
