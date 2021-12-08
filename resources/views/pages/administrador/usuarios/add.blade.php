@extends('layouts.app', ['activePage' => 'Lista de Usuarios', 'titlePage' => __('Nuevo Usuario')])

@section('content')
    <div class="content">
        <div class="container-fluid">
            <div class="row">
                <div class="card card-nav-tabs">
                    <h4 class="card-header card-header-info">Formulario de Cliente</h4>
                    <div class="card-body">
                        <h4 class="card-title">Añadir al sistema</h4>
                        <p class="card-text">Llena todos los campos para añadir un nuevo usuario a la base de datos de Ficein. Al terminar, presiona 'Agregar Cliente'.</p>
                        <form action="{{route('AgregarCliente')}}" method="POST" enctype="multipart/form-data">
                            @csrf
                            <div class="form-row">
                                <div class="form-group col-md-6" id="id_client_field">
                                    <label for="inputPassword4">ID de Cliente</label>
                                    <input type="number" min="0" class="form-control" id="id_client" name="id_client" value="{{ old('id_client') }}" required>
                                    @error('id_client')
                                    <span class="text-danger mt-1">{{ $message }}</span>
                                    @enderror
                                </div>
                                <div class="form-group col-md-6">
                                    <label for="inputEmail4">Nombres</label>
                                    <input type="text" class="form-control" id="name" name="name" value="{{ old('name') }}" required>
                                    @error('name')
                                    <span class="text-danger mt-1">{{ $message }}</span>
                                    @enderror
                                </div>
                            </div>
                            <div class="form-row">
                                <div class="form-group col-md-6">
                                    <label for="inputPassword4">Apellidos</label>
                                    <input type="text" class="form-control" id="last_name" name="last_name" value="{{ old('last_name') }}" required>
                                    @error('last_name')
                                    <span class="text-danger mt-1">{{ $message }}</span>
                                    @enderror
                                </div>
                                <div class="form-group col-md-6">
                                    <label for="inputEmail4">Correo Electrónico</label>
                                    <input type="email" class="form-control" id="email" name="email" value="{{ old('email') }}" required>
                                    @error('email')
                                    <span class="text-danger mt-1">{{ $message }}</span>
                                    @enderror
                                </div>
                            </div>
                            <button type="submit" class="btn btn-primary">Agregar Cliente</button>
                        </form>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="card card-nav-tabs">
                    <h4 class="card-header card-header-info">Formulario de Administrador</h4>
                    <div class="card-body">
                        <h4 class="card-title">Añadir al sistema</h4>
                        <p class="card-text">Para añadir un nuevo administrador al sistema de Ficein se deben llenar los siguientes campos. Al terminar, presiona 'Agregar Administrador'.</p>
                        <form action="{{route('AgregarAdministrador')}}" method="POST" enctype="multipart/form-data">
                            @csrf
                            <div class="form-row">
                                <div class="form-group col-md-6">
                                    <label for="inputEmail4">Nombres</label>
                                    <input type="text" class="form-control" id="name_admin" name="name_admin" value="{{ old('name_admin') }}" required>
                                    @error('name_admin')
                                    <span class="text-danger mt-1">{{ $message }}</span>
                                    @enderror
                                </div>
                                <div class="form-group col-md-6">
                                    <label for="inputPassword4">Apellidos</label>
                                    <input type="text" class="form-control" id="last_name_admin" name="last_name_admin" value="{{ old('last_name_admin') }}"  required>
                                    @error('last_name_admin')
                                    <span class="text-danger mt-1">{{ $message }}</span>
                                    @enderror
                                </div>
                            </div>
                            <div class="form-row">
                                <div class="form-group col-md-6">
                                    <label for="inputEmail4">Correo Electrónico</label>
                                    <input type="email" class="form-control" id="email_admin" name="email_admin" value="{{ old('email_admin') }}" required>
                                    @error('email_admin')
                                    <span class="text-danger mt-1">{{ $message }}</span>
                                    @enderror
                                </div>
                                <div class="form-group col-md-6">
                                    <label for="inputPassword4">Contraseña</label>
                                    <input type="password" class="form-control" id="password_admin" name="password_admin" required>
                                    @error('password_admin')
                                    <span class="text-danger mt-1">{{ $message }}</span>
                                    @enderror
                                </div>
                            </div>
                            <button type="submit" class="btn btn-primary">Agregar Administrador</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
