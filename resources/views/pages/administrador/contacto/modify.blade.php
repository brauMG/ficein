@extends('layouts.app', ['activePage' => 'Modificar Datos', 'titlePage' => __('Modificar Datos')])

@section('content')
    <div class="content">
        <div class="container-fluid">
            <div class="row">
                <div class="card card-nav-tabs">
                    <h4 class="card-header card-header-info">Ficein</h4>
                    <div class="card-body">
                        <h4 class="card-title">Modificar datos</h4>
                        <p class="card-text">Actualiza los campos que sean necesarios. Al terminar, presiona 'Actualizar'.</p>
                        <form action="{{route('actualizar_contacto', $contacto->id)}}" method="POST" enctype="multipart/form-data">
                            @method('PUT')
                            @csrf
                            <div class="form-row">
                                <div class="form-group col-md-12">
                                    <label for="name">Texto</label>
                                    <textarea rows="5" type="text" class="form-control" id="texto" name="texto" required>{{$contacto->texto}}</textarea>
                                    @error('name')
                                    <span class="text-danger mt-1">{{ $message }}</span>
                                    @enderror
                                </div>
                            </div>
                            <div class="form-row">
                                <div class="form-group col-md-6">
                                    <label for="numero_1">Número Principal</label>
                                    <input type="text" class="form-control" id="numero_1" name="numero_1" value="{{$contacto->numero_1}}" required>
                                    @error('numero_1')
                                    <span class="text-danger mt-1">{{ $message }}</span>
                                    @enderror
                                </div>
                                <div class="form-group col-md-6">
                                    <label for="email_1">Correo Electrónico Principal</label>
                                    <input type="email" class="form-control" id="correo_1" name="correo_1" value="{{$contacto->correo_1}}" required>
                                    @error('correo_1')
                                    <span class="text-danger mt-1">{{ $message }}</span>
                                    @enderror
                                </div>
                            </div>
                            <div class="form-row">
                                <div class="form-group col-md-6">
                                    <label for="numero_2">Número Secundario</label>
                                    <input type="text" class="form-control" id="numero_2" name="numero_2" value="{{$contacto->numero_2}}">
                                    @error('numero_2')
                                    <span class="text-danger mt-1">{{ $message }}</span>
                                    @enderror
                                </div>
                                <div class="form-group col-md-6">
                                    <label for="email_2">Correo Electrónico Secundario</label>
                                    <input type="email" class="form-control" id="correo_2" name="correo_2" value="{{$contacto->correo_2}}">
                                    @error('correo_2')
                                    <span class="text-danger mt-1">{{ $message }}</span>
                                    @enderror
                                </div>
                            </div>
                            <div class="form-row">
                                <div class="form-group col-md-6">
                                    <label for="numero_3">Número Alternativo</label>
                                    <input type="text" class="form-control" id="numero_3" name="numero_3" value="{{$contacto->numero_3}}">
                                    @error('numero_3')
                                    <span class="text-danger mt-1">{{ $message }}</span>
                                    @enderror
                                </div>
                                <div class="form-group col-md-6">
                                    <label for="email_3">Correo Electrónico Alternativo</label>
                                    <input type="email" class="form-control" id="correo_3" name="correo_3" value="{{$contacto->correo_3}}">
                                    @error('correo_3')
                                    <span class="text-danger mt-1">{{ $message }}</span>
                                    @enderror
                                </div>
                            </div>
                            <button type="submit" class="btn btn-primary">Actualizar</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
