@extends('layouts.app', ['activePage' => 'Lista de Usuarios', 'titlePage' => __('Nuevo Usuario')])

@section('content')
    <div class="content">
        <div class="container-fluid">
            <div class="row">
                <div class="card card-nav-tabs">
                    <h4 class="card-header card-header-info">Cliente - {{$user->name}} {{$user->last_name}}</h4>
                    <div class="card-body">
                        <h4 class="card-title">Modificar datos</h4>
                        <p class="card-text">Actualiza los campos que sean necesarios. Al terminar, presiona 'Actualizar Cliente'.</p>
                        <form action="{{route('ActualizarCliente', $user->id)}}" method="POST" enctype="multipart/form-data">
                            @method('PUT')
                            @csrf
                            <div class="form-row">
                                <div class="form-group col-md-6" id="id_client_field">
                                    <label for="inputPassword4">ID de Cliente</label>
                                    <input type="number" min="0" class="form-control" id="id_client" name="id_client" value="{{$user->id_client}}" required readonly>
                                    @error('id_client')
                                    <span class="text-danger mt-1">{{ $message }}</span>
                                    @enderror
                                </div>
                                <div class="form-group col-md-6">
                                    <label for="inputEmail4">Nombres</label>
                                    <input type="text" class="form-control" id="name" name="name" value="{{$user->name}}" required>
                                    @error('name')
                                    <span class="text-danger mt-1">{{ $message }}</span>
                                    @enderror
                                </div>
                            </div>
                            <div class="form-row">
                                <div class="form-group col-md-6">
                                    <label for="inputPassword4">Apellidos</label>
                                    <input type="text" class="form-control" id="last_name" name="last_name" value="{{$user->last_name}}" required>
                                    @error('last_name')
                                    <span class="text-danger mt-1">{{ $message }}</span>
                                    @enderror
                                </div>
                                <div class="form-group col-md-6">
                                    <label for="inputEmail4">Correo Electrónico</label>
                                    <input type="email" class="form-control" id="email" name="email" value="{{$user->email}}" required>
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
        </div>
    </div>
@endsection
