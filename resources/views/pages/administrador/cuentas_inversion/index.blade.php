@extends('layouts.app', ['activePage' => 'Inversiones', 'titlePage' => __('Estados de Cuenta de Inversiones')])

@section('content')
    <div class="content">
        <div class="container-fluid">
            @if(\Illuminate\Support\Facades\Session::has('message'))
                    <div class="alert alert-success" role="alert">
                        {{\Illuminate\Support\Facades\Session::get('message')}}
                    </div>
                @endif
                @if(\Illuminate\Support\Facades\Session::has('error-message'))
                    <div class="alert alert-danger" role="alert">
                        {{\Illuminate\Support\Facades\Session::get('error-message')}}
                    </div>
                @endif
                @if(\Illuminate\Support\Facades\Session::has('warning-message'))
                    <div class="alert alert-warning" role="alert">
                        {{\Illuminate\Support\Facades\Session::get('warning-message')}}
                    </div>
                @endif
                <div class="row">
                    <div class="col-md-8">
                        <div class="container message-box bg-danger">
                            <h6 class="own-card-title">Verificar Estados de Cuenta de Inversiones</h6>
                            <p class="own-category">Si has añadido nuevos archivos por medio de FTP, selecciona la fecha que corresponde a la carpeta donde las guardaste y posteriormente presiona "Verificar" para vincular las cuentas a los usuarios.</p>
                        </div>
                    </div>
                </div>
                <div class="row mt-4">
                    <div class="col-md-8">
                        <div class="container message-box bg-transparent">
                            <form action="{{route('verificar_cuentas_inversiones')}}" method="POST" enctype="multipart/form-data">
                                @csrf
                                <div class="form-row">
                                    <div class="form-group col-md-10">
                                        <label class="own-category ficein-color font-weight-bold" for="exampleInputEmail1">Fecha de la carpeta:</label>
                                        <input type="date" class="form-control own-form" name="date" id="date" aria-describedby="date" required>
                                        <small id="emailHelp" class="form-text text-muted">Asegurate de validar que sea la carpeta correcta.</small>
                                    </div>
                                    <div class="form-group col-md-2 mt-1">
                                        <button type="submit" class="btn btn-info btn-action">Verificar</button>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-12">
                        <div class="card bg-transparent own-card">
                            <div class="card-header card-header-primary m-0">
                            <div style="display: flex; flex-wrap: wrap">
                                <h4 class="card-title ">Estados de Cuenta de Inversiones</h4>
                            </div>
                        </div>
                        <div class="card-body">
                            <div class="table-responsive">
                                <table id="admin-datatable" class="table table-striped  data-table">
                                    <thead class="text-primary thead-color">
                                    <th>Email del Cliente</th>
                                    <th>RFC</th>
                                    <th>Nombre del Cliente</th>
                                    <th>Divisa</th>
                                    <th>Contrato</th>
                                    <th>Mes</th>
                                    <th>Año</th>
                                    <th class="action-row">Descargar</th>
                                    </thead>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script>
        $(function () {
            $('[data-toggle="tooltip"]').tooltip()
        });

        $(document).ready(function () {
            $('#admin-datatable').DataTable({
                "processing": true,
                "serverSide": true,
                "responsive": true,
                "deferRender": true,
                "ajax": "{{route('admin-data')}}",
                "buttons": [
                    'excel',
                ],
                "columns": [
                    { "data": "client.email"},
                    { "data": "client.rfc"},
                    { "data": "full_name"},
                    { "data": "currency"},
                    { "data": "contract_name"},
                    { "data": "month"},
                    { "data": "year"},
                    { "data": "action"},
                ]
            })
        })
    </script>
@endsection
