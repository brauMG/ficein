@extends('layouts.app', ['activePage' => 'Créditos', 'titlePage' => __('Estados de Cuenta de Créditos')])

@section('content')
    <div class="content">
        <div class="container-fluid">
            @if(\Illuminate\Support\Facades\Session::has('message'))
                <div class="alert alert-success" role="alert">
                    {{\Illuminate\Support\Facades\Session::get('message')}}
                </div>
            @endif
            <div class="row">
                <div class="col-md-12">
                    <div class="card">
                        <div class="card-header card-header-danger">
                            <h4 class="card-title">Verificar Estados de Cuenta de Créditos</h4>
                            <p class="category">Si has añadido nuevos archivos por medio de FTP, selecciona la fecha que corresponde a la carpeta donde las guardaste y posteriormente presiona "Verificar" para vincular las cuentas a los usuarios.</p>
                        </div>
                        <div class="card-body">
                            <form action="{{route('verificar_cuentas_creditos')}}" method="POST" enctype="multipart/form-data">
                                @csrf
                                <div class="form-group">
                                    <label for="exampleInputEmail1">Fecha de la carpeta:</label>
                                    <input type="date" class="form-control" name="date" id="date" aria-describedby="date" required>
                                    <small id="emailHelp" class="form-text text-muted">Asegurate de validar que sea la carpeta correcta.</small>
                                </div>
                                <button type="submit" class="btn btn-info">Verificar</button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-md-12">
                    <div class="card">
                        <div class="card-header card-header-primary">
                            <div style="display: flex; flex-wrap: wrap">
                                <h4 class="card-title ">Estados de Cuenta de Créditos</h4>
                            </div>
                        </div>
                        <div class="card-body">
                            <div class="table-responsive">
                                <table class="table table-striped table-bordered data-table">
                                    <thead class="text-primary thead-color">
                                    <th>ID de cliente</th>
                                    <th>Nombre del cliente</th>
                                    <th>Mes</th>
                                    <th>Año</th>
                                    <th class="action-row">Descargar</th>
                                    </thead>
                                    <tbody>
                                    @foreach ($cuentas_creditos as $credito)
                                        <tr>
                                            <td>{{$credito->client->id_client}}<i class="material-icons plus">add_circle</i></td>
                                            <td>{{$credito->client->name}} {{$credito->client->last_name}}</td>
                                            <td>
                                                @if(date('m', strtotime($credito->date)) === '01')
                                                    Enero
                                                @elseif(date('m', strtotime($credito->date)) === '02')
                                                    Febrero
                                                @elseif(date('m', strtotime($credito->date)) === '03')
                                                    Marzo
                                                @elseif(date('m', strtotime($credito->date)) === '04')
                                                    Abril
                                                @elseif(date('m', strtotime($credito->date)) === '05')
                                                    Mayo
                                                @elseif(date('m', strtotime($credito->date)) === '06')
                                                    Junio
                                                @elseif(date('m', strtotime($credito->date)) === '07')
                                                    Julio
                                                @elseif(date('m', strtotime($credito->date)) === '08')
                                                    Agosto
                                                @elseif(date('m', strtotime($credito->date)) === '09')
                                                    Septiembre
                                                @elseif(date('m', strtotime($credito->date)) === '10')
                                                    Octubre
                                                @elseif(date('m', strtotime($credito->date)) === '11')
                                                    Noviembre
                                                @elseif(date('m', strtotime($credito->date)) === '12')
                                                    Diciembre
                                                @endif
                                            </td>
                                            <td>{{date('Y', strtotime($credito->date))}}</td>
                                            <td class="action-row">
                                                <a href="{{ url('/cliente/cuentas_credito/pdf/download/' . $credito->id) }}" rel="tooltip" class="btn btn-sm btn-warning btn-adjust">
                                                    PDF <i class="material-icons">file_download</i>
                                                </a>
                                            </td>
                                        </tr>
                                    @endforeach
                                    </tbody>
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

        if (window.innerWidth > 500) {
            var table = $('.data-table').DataTable({
                    lengthMenu: [
                        [10, 25, 50, -1],
                        ['10 Filas', '25 Filas', '50 Filas', 'Mostrar todo']
                    ],
                    dom: 'Blfrtip',
                    buttons: [
                        {extend: 'pdf', text: 'Exportar a PDF', charset: 'UTF-8'},
                        {extend: 'csv', text: 'Exportar a EXCEL', charset: 'UTF-8'}
                    ],
                    language: {
                        "sProcessing": "Procesando...",
                        "sLengthMenu": "Mostrar _MENU_ registros",
                        "sZeroRecords": "No se encontraron resultados",
                        "sEmptyTable": "Ningún dato disponible en esta tabla =(",
                        "sInfo": "Mostrando registros del _START_ al _END_ de un total de _TOTAL_ registros",
                        "sInfoEmpty": "Mostrando registros del 0 al 0 de un total de 0 registros",
                        "sInfoFiltered": "(filtrado de un total de _MAX_ registros)",
                        "sInfoPostFix": "",
                        "sSearch": "Buscar:",
                        "sUrl": "",
                        "sInfoThousands": ",",
                        "sLoadingRecords": "Cargando...",
                        "oPaginate": {
                            "sFirst": "Primero",
                            "sLast": "Último",
                            "sNext": "Siguiente",
                            "sPrevious": "Anterior"
                        },
                        "oAria": {
                            "sSortAscending": ": Activar para ordenar la columna de manera ascendente",
                            "sSortDescending": ": Activar para ordenar la columna de manera descendente"
                        },
                        "buttons": {
                            "copy": "Copiar",
                            "colvis": "Visibilidad",
                            "print": "Imprimir",
                            "csv": "Excel"
                        }
                    },

                }
            );
        }
        else {
            var table = $('.data-table').DataTable({
                    responsive: true,
                    lengthMenu: [
                        [10, 25, 50, -1],
                        ['10 Filas', '25 Filas', '50 Filas', 'Mostrar todo']
                    ],
                    dom: 'Blfrtip',
                    buttons: [
                        {extend: 'pdf', text: 'Exportar a PDF', charset: 'UTF-8'},
                        {extend: 'csv', text: 'Exportar a EXCEL', charset: 'UTF-8'}
                    ],
                    language: {
                        "sProcessing": "Procesando...",
                        "sLengthMenu": "Mostrar _MENU_ registros",
                        "sZeroRecords": "No se encontraron resultados",
                        "sEmptyTable": "Ningún dato disponible en esta tabla =(",
                        "sInfo": "Mostrando registros del _START_ al _END_ de un total de _TOTAL_ registros",
                        "sInfoEmpty": "Mostrando registros del 0 al 0 de un total de 0 registros",
                        "sInfoFiltered": "(filtrado de un total de _MAX_ registros)",
                        "sInfoPostFix": "",
                        "sSearch": "Buscar:",
                        "sUrl": "",
                        "sInfoThousands": ",",
                        "sLoadingRecords": "Cargando...",
                        "oPaginate": {
                            "sFirst": "Primero",
                            "sLast": "Último",
                            "sNext": "Siguiente",
                            "sPrevious": "Anterior"
                        },
                        "oAria": {
                            "sSortAscending": ": Activar para ordenar la columna de manera ascendente",
                            "sSortDescending": ": Activar para ordenar la columna de manera descendente"
                        },
                        "buttons": {
                            "copy": "Copiar",
                            "colvis": "Visibilidad",
                            "print": "Imprimir",
                            "csv": "Excel"
                        }
                    },

                }
            );
        }

        $(function () {
            $('[data-toggle="tooltip"]').tooltip()
        });
    </script>
@endsection