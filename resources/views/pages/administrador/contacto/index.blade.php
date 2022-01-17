@extends('layouts.app', ['activePage' => 'Visualizar Datos', 'titlePage' => __('Visualizar Datos')])

@section('content')
    <div class="content">
        <div class="container-fluid">
            <div class="row" style="justify-content: center; background-color: white; padding: 3%; border:solid; border-radius: 15px; width: 80%; margin: auto">
                <div class="info">
                    <h4 class="info-title"><i class="material-icons" style="vertical-align: sub">phone</i>Información de Contacto - Ficein</h4>
                    <p>{{$contacto->texto}}</p>
                </div>
                <div class="form-row" style="flex-wrap: wrap; width: -webkit-fill-available">
                    <div class="form-group col-md-12">
                        <div class="card card-nav-tabs" style="width: 20rem;">
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
                    </div>
                    <div class="form-group col-md-12">
                        <div class="card card-nav-tabs" style="width: 20rem;">
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
