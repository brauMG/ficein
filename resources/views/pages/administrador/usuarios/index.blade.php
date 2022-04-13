@extends('layouts.app', ['activePage' => 'Lista de Usuarios', 'titlePage' => __('Lista de Usuarios')])

@section('content')
    <div class="content">
        <!-- Modal -->
        <div class="modal fade" id="exampleModalCenter" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true" style="background-color: #222">
            <div class="modal-dialog modal-dialog-centered" role="document">
                <div class="modal-body">
                    <div class="e-loadholder">
                        <div class="m-loader">
                            <span class="e-text" style="font-size: 80%">Procesando</span>
                        </div>
                    </div>
                    <div id="particleCanvas-Blue"></div>
                    <div id="particleCanvas-White"></div>
                </div>
                <div class="container" style="position: absolute; text-align: center; bottom: 0; text-transform: uppercase">
                    <span class="e-text" style="font-size: 80%; color: white">Importando tabla de usuarios y enviando correos (NO CIERRES ESTA VENTANA)</span>
                </div>
            </div>
        </div>

        <div class="container-fluid" id="principal">
            <div class="row">
                <div class="col-md-8">
                    <div class="container message-box bg-danger">
                        <h6 class="own-card-title">Importar Usuarios</h6>
                        <p class="own-category">Para importar usuarios, selecciona un archivo excel que contenga las siguientes columnas, en el siguiente orden: Nombre, Apellidos, Correo.</p>
                    </div>
                </div>
            </div>
            <div class="row mt-4">
                <div class="col-md-8">
                    <div class="container message-box bg-transparent">
                        <form method="POST" action="{{ url('/administrador/usuarios/importar') }}" accept-charset="UTF-8" enctype="multipart/form-data">
                            {{ csrf_field() }}
                            <div class="form-row">
                                <div class="form-group col-md-10">
                                    <label class="own-category ficein-color font-weight-bold">Archivo</label>
                                    <input style="opacity: 1 !important; position: initial !important; height: auto" onchange="allow()" class="form-control" type="file" name="file" required>
                                    <small id="emailHelp" class="form-text text-muted">Asegurate de validar que el archivo sea correcto.</small>
                                </div>
                                <div class="form-group col-md-2 mt-1">
                                    <button type="submit" class="btn btn-action btn-info" title="Importar Contactos" style="margin-left: 5px !important;" id="submit-file" data-toggle="modal" data-target="#exampleModalCenter" data-backdrop="static" disabled>
                                        Procesar
                                    </button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>

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
                                <div class="col-md-8">
                                    <h4 class="card-title ">Lista de Usuarios</h4>
                                    <a href="{{ url('/administrador/usuarios/nuevo') }}" class="btn btn-secondary font-weight-bold" id="new">Añadir nuevo usuario <i class="material-icons">add_circle_outline</i></a>
                                </div>
                            </div>
                        </div>
                        <div class="card-body">
                            <div class="table-responsive">
                                <table class="table table-striped data-table">
                                    <thead class="text-primary thead-color">
                                    <th>RFC</th>
                                    <th>Email</th>
                                    <th>Nombres</th>
                                    <th>Apellidos</th>
                                    <th>Correos</th>
                                    <th class="action-row">Acciones</th>
                                    </thead>
                                    <tbody>
                                    @foreach ($users as $user)
                                        <tr>
                                            <td>{{$user->rfc}}<i class="material-icons plus">add_circle</i></td>
                                            <td>{{$user->email}}</td>
                                            <td>{{$user->name}}</td>
                                            <td>{{$user->last_name}}</td>
                                            <td>{{$user->email}}</td>
                                            <td class="action-row">
                                                <a href="{{ url('/administrador/usuarios/modificar/' . $user->id) }}" rel="tooltip" class="btn btn-sm btn-warning btn-adjust">
                                                    <i class="material-icons">edit</i>
                                                </a>
                                                <button clave="{{$user->id}}" onclick="deleted(this);" type="button" rel="tooltip" class="btn btn-sm btn-danger btn-adjust">
                                                    <i class="material-icons">delete</i>
                                                </button>
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

        function deleted(button){
            console.warn('delete');
            var clave = $(button).attr('clave');
            $('#myModal').load( '{{ url('/administrador/usuarios/eliminar') }}/'+clave,function(response, status, xhr){
                if (status === "success") {
                    $('#myModal').modal('show');
                }
            } );
        }

        function allow() {
            let submit_btn = document.getElementById('submit-file');
            submit_btn.removeAttribute('disabled');
        }
    </script>
@endsection
