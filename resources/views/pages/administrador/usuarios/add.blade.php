@extends('layouts.app', ['activePage' => 'Lista de Usuarios', 'titlePage' => __('Nuevo Usuario')])

@section('content')
    <div class="content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-md-12">
                    <div class="card bg-transparent own-card">
                        <div class="card-header card-header-primary m-0">
                            <div style="display: flex; flex-wrap: wrap">
                                <h4 class="card-title ">Formulario de Cliente</h4>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-12">
                                <div class="container message-box bg-transparent mt-2 pl-0 pr-0 float-left">
                                    <h4 class="own-card-title font-weight-bold">Añadir al sistema</h4>
                                    <p class="own-category font-weight-bold">Llena todos los campos para añadir un nuevo usuario a la base de datos de Ficein. Al terminar, presiona 'Agregar Cliente'.</p>
                                </div>
                            </div>
                        </div>
                        <div class="card-body bg-white pt-2">
                            <form action="{{route('AgregarCliente')}}" method="POST" enctype="multipart/form-data">
                                @csrf
                                <div class="form-row mt-3">
                                    <div class="form-group col-md-4">
                                        <label class="own-label">Nombres</label>
                                        <input type="text" class="form-control own-form-2" id="name" name="name" value="{{ old('name') }}" required>
                                        @error('name')
                                        <span class="text-danger mt-1">{{ $message }}</span>
                                        @enderror
                                    </div>
                                    <div class="form-group col-md-4">
                                        <label class="own-label">Apellidos</label>
                                        <input type="text" class="form-control own-form-2" id="last_name" name="last_name" value="{{ old('last_name') }}" required>
                                        @error('last_name')
                                        <span class="text-danger mt-1">{{ $message }}</span>
                                        @enderror
                                    </div>
                                    <div class="form-group col-md-4">
                                        <label class="own-label">RFC</label>
                                        <input type="text" class="form-control own-form-2" id="rfc" name="rfc" value="{{ old('rfc') }}" required>
                                        @error('rfc')
                                        <span class="text-danger mt-1">{{ $message }}</span>
                                        @enderror
                                    </div>
                                </div>
                                <div class="form-row mt-2">
                                    <div class="form-group col-md-8">
                                        <label class="own-label">Correo Electrónico</label>
                                        <input type="email" class="form-control own-form-2" id="email" name="email" value="{{ old('email') }}" required>
                                        @error('email')
                                        <span class="text-danger mt-1">{{ $message }}</span>
                                        @enderror
                                    </div>
                                    <div class="form-group col-md-4">
                                        <button type="submit" class="btn btn-action btn-sm btn-ficein m-0" style="padding: 10px 0px !important; border-radius:8px; width: -webkit-fill-available">Agregar Cliente</button>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-md-12">
                    <div class="card bg-transparent own-card">
                        <div class="card-header card-header-primary m-0">
                            <div style="display: flex; flex-wrap: wrap">
                                <h4 class="card-title ">Formulario de Administrador</h4>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-12">
                                <div class="container message-box bg-transparent mt-2 pl-0 pr-0 float-left">
                                    <h4 class="own-card-title font-weight-bold">Añadir al sistema</h4>
                                    <p class="own-category font-weight-bold">Para añadir un nuevo administrador al sistema de Ficein se deben llenar los siguientes campos. Al terminar, presiona 'Agregar Administrador'.</p>
                                </div>
                            </div>
                        </div>
                        <div class="card-body bg-white pt-2">
                            <form action="{{route('AgregarAdministrador')}}" method="POST" enctype="multipart/form-data">
                                @csrf
                                <div class="form-row mt-3">
                                    <div class="form-group col-md-4">
                                        <label class="own-label">Nombres</label>
                                        <input type="text" class="form-control own-form-2" id="name_admin" name="name_admin" value="{{ old('name_admin') }}" required>
                                        @error('name_admin')
                                        <span class="text-danger mt-1">{{ $message }}</span>
                                        @enderror
                                    </div>
                                    <div class="form-group col-md-4">
                                        <label class="own-label">Apellidos</label>
                                        <input type="text" class="form-control own-form-2" id="last_name_admin" name="last_name_admin" value="{{ old('last_name_admin') }}"  required>
                                        @error('last_name_admin')
                                        <span class="text-danger mt-1">{{ $message }}</span>
                                        @enderror
                                    </div>
                                    <div class="form-group col-md-4">
                                        <label class="own-label">Correo Electrónico</label>
                                        <input type="email" class="form-control own-form-2" id="email_admin" name="email_admin" value="{{ old('email_admin') }}" required>
                                        @error('email_admin')
                                        <span class="text-danger mt-1">{{ $message }}</span>
                                        @enderror
                                    </div>
                                    <div class="form-group col-md-4">
                                        <label class="own-label">Usuario de Login</label>
                                        <input type="email" class="form-control own-form-2" id="rfc_admin" name="rfc_admin" value="{{ old('rfc_admin') }}" required>
                                        @error('rfc_admin')
                                        <span class="text-danger mt-1">{{ $message }}</span>
                                        @enderror
                                    </div>
                                </div>
                                <div class="form-row mt-2">
                                    <div class="form-group col-md-8">
                                        <label class="own-label">Contraseña</label>
                                        <input type="password" class="form-control own-form-2" id="password_admin" name="password_admin" required>
                                        @error('password_admin')
                                        <span class="text-danger mt-1">{{ $message }}</span>
                                        @enderror
                                    </div>
                                    <div class="form-group col-md-4">
                                        <button type="submit" class="btn btn-action btn-sm btn-ficein m-0" style="padding: 10px 0px !important; border-radius:8px; width: -webkit-fill-available">Agregar Administrador</button>
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
