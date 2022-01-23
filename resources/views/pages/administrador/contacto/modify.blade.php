@extends('layouts.app', ['activePage' => 'Modificar Datos', 'titlePage' => __('Modificar Datos')])

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
                                    <h4 class="own-card-title font-weight-bold">Modificar datos</h4>
                                    <p class="own-category">Actualiza los campos que sean necesarios. Al terminar, presiona 'Actualizar'.</p>
                                </div>
                            </div>
                        </div>
                        <div class="container bg-white p-4" style="border-radius: 12px">
                        <form action="{{route('actualizar_contacto', $contacto->id)}}" method="POST" enctype="multipart/form-data">
                            @method('PUT')
                            @csrf
                            <div class="form-row">
                                <div class="form-group col-md-12">
                                    <label for="name" class="own-label">Texto</label>
                                    <textarea rows="5" type="text" class="form-control own-form-2" id="texto" name="texto" required>{{$contacto->texto}}</textarea>
                                    @error('name')
                                    <span class="text-danger mt-1">{{ $message }}</span>
                                    @enderror
                                </div>
                            </div>
                            <div class="form-row adjust-form-row">
                                <div class="form-group col-md-6">
                                    <label for="numero_1" class="own-label">Número Principal</label>
                                    <input type="text" class="form-control own-form-2" id="numero_1" name="numero_1" value="{{$contacto->numero_1}}" required>
                                    @error('numero_1')
                                    <span class="text-danger mt-1">{{ $message }}</span>
                                    @enderror
                                </div>
                                <div class="form-group col-md-6">
                                    <label for="email_1" class="own-label">Correo Electrónico Principal</label>
                                    <input type="email" class="form-control own-form-2" id="correo_1" name="correo_1" value="{{$contacto->correo_1}}" required>
                                    @error('correo_1')
                                    <span class="text-danger mt-1">{{ $message }}</span>
                                    @enderror
                                </div>
                            </div>
                            <div class="form-row adjust-form-row">
                                <div class="form-group col-md-6">
                                    <label for="numero_2" class="own-label">Número Secundario</label>
                                    <input type="text" class="form-control own-form-2" id="numero_2" name="numero_2" value="{{$contacto->numero_2}}">
                                    @error('numero_2')
                                    <span class="text-danger mt-1">{{ $message }}</span>
                                    @enderror
                                </div>
                                <div class="form-group col-md-6">
                                    <label for="email_2" class="own-label">Correo Electrónico Secundario</label>
                                    <input type="email" class="form-control own-form-2" id="correo_2" name="correo_2" value="{{$contacto->correo_2}}">
                                    @error('correo_2')
                                    <span class="text-danger mt-1">{{ $message }}</span>
                                    @enderror
                                </div>
                            </div>
                            <div class="form-row adjust-form-row">
                                <div class="form-group col-md-6">
                                    <label for="numero_3" class="own-label">Número Alternativo</label>
                                    <input type="text" class="form-control own-form-2" id="numero_3" name="numero_3" value="{{$contacto->numero_3}}">
                                    @error('numero_3')
                                    <span class="text-danger mt-1">{{ $message }}</span>
                                    @enderror
                                </div>
                                <div class="form-group col-md-6">
                                    <label for="email_3" class="own-label">Correo Electrónico Alternativo</label>
                                    <input type="email" class="form-control own-form-2" id="correo_3" name="correo_3" value="{{$contacto->correo_3}}">
                                    @error('correo_3')
                                    <span class="text-danger mt-1">{{ $message }}</span>
                                    @enderror
                                </div>
                            </div>
                            <button type="submit" class="btn btn-info btn-action btn-sm">Actualizar</button>
                        </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
