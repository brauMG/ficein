@extends('layouts.app', ['activePage' => 'Facturaciones', 'titlePage' => __('Facturaciones')])

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
                            <h4 class="card-title">Verificar Facturas</h4>
                            <p class="category">Si has añadido nuevas facturas por medio de FTP, selecciona la fecha que corresponde a la carpeta donde las guardaste y posteriormente presiona "Verificar" para vincularlas a los usuarios.</p>
                        </div>
                        <div class="card-body">
                            <form action="{{route('verificar_facturas')}}" method="POST" enctype="multipart/form-data">
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
                                <h4 class="card-title ">Facturas de Clientes</h4>
                            </div>
                        </div>
                        <div class="card-body">
                            <div class="table-responsive">
                                <table class="table table-striped table-bordered data-table">
                                    <thead class="text-primary thead-color">
                                    <th>ID de cliente</th>
                                    <th>Nombre del cliente</th>
                                    <th>Contrato</th>
                                    <th>Día</th>
                                    <th>Mes</th>
                                    <th>Año</th>
                                    <th class="action-row">Descargar</th>
                                    </thead>
                                    <tbody>
                                    @foreach ($facturas as $factura)
                                        <tr>
                                            <td>{{$factura->client->id_client}}<i class="material-icons plus">add_circle</i></td>
                                            <td>{{$factura->client->name}} {{$factura->client->last_name}}</td>
                                            <td>{{$factura->contract_name}}</td>
                                            <td>{{date('d', strtotime($factura->date))}}</td>
                                            <td>
                                                @if(date('m', strtotime($factura->date)) === '01')
                                                    Enero
                                                @elseif(date('m', strtotime($factura->date)) === '02')
                                                    Febrero
                                                @elseif(date('m', strtotime($factura->date)) === '03')
                                                    Marzo
                                                @elseif(date('m', strtotime($factura->date)) === '04')
                                                    Abril
                                                @elseif(date('m', strtotime($factura->date)) === '05')
                                                    Mayo
                                                @elseif(date('m', strtotime($factura->date)) === '06')
                                                    Junio
                                                @elseif(date('m', strtotime($factura->date)) === '07')
                                                    Julio
                                                @elseif(date('m', strtotime($factura->date)) === '08')
                                                    Agosto
                                                @elseif(date('m', strtotime($factura->date)) === '09')
                                                    Septiembre
                                                @elseif(date('m', strtotime($factura->date)) === '10')
                                                    Octubre
                                                @elseif(date('m', strtotime($factura->date)) === '11')
                                                    Noviembre
                                                @elseif(date('m', strtotime($factura->date)) === '12')
                                                    Diciembre
                                                @endif
                                            </td>
                                            <td>{{date('Y', strtotime($factura->date))}}</td>
                                            <td class="action-row">
                                                <a href="{{ url('/cliente/facturas/pdf/download/' . $factura->id) }}" rel="tooltip" class="btn btn-sm btn-warning btn-adjust">
                                                    PDF <i class="material-icons">file_download</i>
                                                </a>
                                                <a href="{{ url('/cliente/facturas/xml/download/' . $factura->id) }}" rel="tooltip" class="btn btn-sm btn-warning btn-adjust">
                                                    XML <i class="material-icons">file_download</i>
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

        function deleted(button){
            console.warn('delete');
            var clave = $(button).attr('clave');
            $('#myModal').load( '{{ url('/my_sites/delete') }}/'+clave,function(response, status, xhr){
                if (status === "success") {
                    $('#myModal').modal('show');
                }
            } );
        }
    </script>
@endsection