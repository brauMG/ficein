@extends('layouts.app', ['activePage' => 'SMS', 'titlePage' => __('SMS')])

@section('content')
    <div class="content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-md-8">
                    <div class="container message-box bg-danger">
                        <h6 class="own-card-title">Agregar Números</h6>
                        <p class="own-category">
                            Para que el sistema reconozca todos los números, es necesario ingresarlos separando cada uno con una coma. Adicionalmente, es importante verificar que sean números de 10 digitos, sin (+).
                            <br>
                            <br>
                            Puedes utilizar el siguiente enlace para hacer el proceso automaticamente, en caso de tener una lista muy grande.
                        </p>
                        <p class="own-category">
                            <br>
                            <a href="https://www.dcode.fr/values-separation" style="color: #23fff6; text-decoration: underline" target="_blank">Separar Valores</a>
                            <br>
                            <br>
                            Instrucciones
                            <br>
                            • Ingresa el delimitador (una coma)
                            <br>
                            • Selecciona 'JOIN THE VALUES USING THE DELIMITER'
                            <br>
                            • Presiona 'SEPARATE'
                            <br>
                            • Copia el resultado y pegalo en el campo de texto
                        </p>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-md-12">
                    <div class="card bg-transparent own-card">
                        <div class="card-header card-header-primary m-0">
                            <div style="display: flex; flex-wrap: wrap">
                                <h4 class="card-title ">Enviar SMS</h4>
                            </div>
                        </div>
                        <div class="card-body bg-white pt-2">
                            <form action="{{route('SendSMS')}}" method="POST" enctype="multipart/form-data">
                                @if($errors->any())
                                    <ul>
                                        @foreach($errors->all() as $error)
                                            <li> {{ $error }} </li>
                                        @endforeach
                                    </ul>
                                @endif
                                    @if(\Illuminate\Support\Facades\Session::has('message'))
                                        <span class="alert-success" style="padding: 0 2%; color: black; font-weight: 500">{{\Illuminate\Support\Facades\Session::get('message')}}</span>
                                    @endif
                                    @csrf
                                <div class="form-row mt-3">
                                    <div class="form-group col-md-12">
                                        <label class="own-label">Números (separar por medio de comas)</label>
                                        <textarea rows="5" class="form-control own-form-2" id="numbers" name="numbers" required></textarea>
                                        @error('name')
                                        <span class="text-danger mt-1">{{ $message }}</span>
                                        @enderror
                                    </div>
                                    <div class="form-group col-md-12 mt-3">
                                        <label class="own-label">Contenido del Mensaje</label>
                                        <textarea rows="5" class="form-control own-form-2" id="message" name="message" required></textarea>
                                        @error('last_name')
                                        <span class="text-danger mt-1">{{ $message }}</span>
                                        @enderror
                                    </div>
                                </div>
                                <div class="form-row mt-2">
                                    <div class="form-group col-md-12">
                                        <button type="submit" class="btn btn-action btn-sm btn-ficein m-0" style="padding: 10px 0px !important; border-radius:8px; width: -webkit-fill-available">Enviar Mensaje</button>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
