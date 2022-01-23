@extends('layouts.app', ['activePage' => 'Lista de Usuarios', 'titlePage' => __('Nuevo Usuario')])

@section('content')
    <div class="content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-md-12">
                    <div class="card bg-transparent own-card">
                        <div class="card-header card-header-primary m-0">
                            <div style="display: flex; flex-wrap: wrap">
                                <h4 class="card-title ">Cliente - {{$user->name}} {{$user->last_name}}</h4>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-12">
                                <div class="container message-box bg-transparent mt-2 pl-0 pr-0">
                                    <h4 class="own-card-title font-weight-bold">Modificar datos</h4>
                                    <p class="own-category font-weight-bold">Actualiza los campos que sean necesarios. Al terminar, presiona 'Actualizar Cliente'.</p>
                                </div>
                            </div>
                        </div>
                        <div class="card-body bg-white pt-2">
                            <form action="{{route('ActualizarCliente', $user->id)}}" method="POST" enctype="multipart/form-data">
                                @method('PUT')
                                @csrf
                                <div class="form-row mt-3">
                                    <div class="form-group col-md-6">
                                        <label class="own-label" for="inputEmail4">Nombres</label>
                                        <input type="text" class="form-control own-form-2" id="name" name="name" value="{{$user->name}}" required>
                                        @error('name')
                                        <span class="text-danger mt-1">{{ $message }}</span>
                                        @enderror
                                    </div>
                                    <div class="form-group col-md-6">
                                        <label class="own-label" for="inputPassword4">Apellidos</label>
                                        <input type="text" class="form-control own-form-2" id="last_name" name="last_name" value="{{$user->last_name}}" required>
                                        @error('last_name')
                                        <span class="text-danger mt-1">{{ $message }}</span>
                                        @enderror
                                    </div>
                                </div>
                                <div class="form-row mt-2">
                                    <div class="form-group col-md-8">
                                        <label class="own-label" for="inputEmail4">Correo Electrónico</label>
                                        <input type="email" class="form-control own-form-2" id="email" name="email" value="{{$user->email}}" required>
                                        @error('email')
                                        <span class="text-danger mt-1">{{ $message }}</span>
                                        @enderror
                                    </div>
                                    <div class="form-group col-md-4">
                                        <button type="submit" class="btn btn-action btn-sm btn-ficein m-0" style="padding: 10px 0px !important; border-radius:8px; width: -webkit-fill-available">Actualizar Cliente</button>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
@endsection
