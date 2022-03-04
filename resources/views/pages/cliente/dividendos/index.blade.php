@extends('layouts.app', ['activePage' => 'Dividendos', 'titlePage' => __('Dividendos')])

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
                    <div class="col-md-12">
                        <div class="card bg-transparent own-card">
                            <div class="card-header card-header-primary m-0">
                            <div style="display: flex; flex-wrap: wrap">
                                <h4 class="card-title ">Mis Dividendos</h4>
                            </div>
                        </div>
                        <div class="card-body" id="clients_body">
                            <div class="table-responsive">
                                <table class="table table-striped  data-table">
                                    <thead class="text-primary thead-color">
                                    <th>Mes</th>
                                    <th>Año</th>
                                    <th class="action-row">Descargar</th>
                                    </thead>
                                    <tbody>
                                    @foreach ($dividendos as $dividendo)
                                        <tr>
                                            <td>
                                                @if(date('m', strtotime($dividendo->date)) === '01')
                                                    Enero
                                                @elseif(date('m', strtotime($dividendo->date)) === '02')
                                                    Febrero
                                                @elseif(date('m', strtotime($dividendo->date)) === '03')
                                                    Marzo
                                                @elseif(date('m', strtotime($dividendo->date)) === '04')
                                                    Abril
                                                @elseif(date('m', strtotime($dividendo->date)) === '05')
                                                    Mayo
                                                @elseif(date('m', strtotime($dividendo->date)) === '06')
                                                    Junio
                                                @elseif(date('m', strtotime($dividendo->date)) === '07')
                                                    Julio
                                                @elseif(date('m', strtotime($dividendo->date)) === '08')
                                                    Agosto
                                                @elseif(date('m', strtotime($dividendo->date)) === '09')
                                                    Septiembre
                                                @elseif(date('m', strtotime($dividendo->date)) === '10')
                                                    Octubre
                                                @elseif(date('m', strtotime($dividendo->date)) === '11')
                                                    Noviembre
                                                @elseif(date('m', strtotime($dividendo->date)) === '12')
                                                    Diciembre
                                                @endif
                                                <i class="material-icons plus">add_circle</i></td>
                                            <td>{{date('Y', strtotime($dividendo->date))}}</td>
                                            <td class="action-row">
                                                <a href="{{ url('/cliente/dividendos/pdf/download/' . $dividendo->id) }}" rel="tooltip" class="btn btn-sm btn-warning btn-adjust">
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
                        "sSearch": "Buscador",
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
                        "sSearch": "Buscador",
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
