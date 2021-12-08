<div class="sidebar" data-color="azure" data-background-color="black" data-image="{{ asset('material') }}/img/sidebar-4.jpg">
    <!--
        Tip 1: You can change the color of the sidebar using: data-color="purple | azure | green | orange | danger"

        Tip 2: you can also add an image using data-image tag
    -->
    <div class="logo">
        <a href="/" class="simple-text logo-normal">
            <strong style="font-size: 24px">Ficein</strong>
            <br>
            <h6 style="color: gray">
                @if(Auth::user()->type === 0)
                    Administrador
                    <br>
                @elseif(Auth::user()->user_role_id === 1)
                    Cliente
                    <br>
                @endif
                {{Auth::user()->name}}
            </h6>
        </a>
    </div>
    <div class="sidebar-wrapper">
        <ul class="nav">
                @if(Auth::user()->type == 0)
                    <li class="nav-item{{ $activePage == 'Lista de Usuarios' ? ' active' : '' }}">
                        <a class="nav-link" href="{{ url('/administrador/usuarios') }}">
                            <i class="material-icons text-white">dashboard</i>
                            <p>{{ __('Usuarios') }}</p>
                        </a>
                    </li>

                    <li class="nav-item{{ $activePage == 'Facturaciones' ? ' active' : '' }}">
                        <a class="nav-link" href="{{ url('/administrador/facturas') }}">
                            <i class="material-icons text-white">request_quote</i>
                            <p>{{ __('Facturaciones') }}</p>
                        </a>
                    </li>

                <li class="nav-item{{ $activePage == 'Constancias de Inversión' ? ' active' : '' }}">
                    <a class="nav-link" href="{{ url('/administrador/constancia_inversion') }}">
                        <i class="material-icons text-white">request_quote</i>
                        <p>{{ __('Constancias de Inversión') }}</p>
                    </a>
                </li>

                    <li class="nav-item {{ ($activePage == 'Estados de Cuenta') ? ' active' : '' }}">
                        <a class="nav-link collapsed" data-toggle="collapse" href="#estados" aria-expanded="false">
                            <i><img style="width:25px" src="{{ asset('material') }}/img/laravel.svg"></i>
                            <p>{{ __('Estados de Cuenta') }}
                                <b class="caret"></b>
                            </p>
                        </a>
                        <div class="collapse" id="estados">
                            <ul class="nav">
                                <li class="nav-item{{ $activePage == 'Inversiones' ? ' active' : '' }}">
                                     <a class="nav-link" href="{{ url('/administrador/cuentas_inversion') }}">
                                        <i class="material-icons text-white">filter_list</i>
                                        <span class="sidebar-normal">{{ __('Inversiones') }} </span>
                                    </a>
                                </li>
                                <li class="nav-item{{ $activePage == 'Créditos' ? ' active' : '' }}">
                                     <a class="nav-link" href="{{ url('/administrador/cuentas_credito') }}">
                                        <i class="material-icons text-white">style</i>
                                        <span class="sidebar-normal">{{ __('Créditos') }} </span>
                                    </a>
                                </li>
                            </ul>
                        </div>
                    </li>

                <li class="nav-item {{ ($activePage == 'Retenciones') ? ' active' : '' }}">
                    <a class="nav-link collapsed" data-toggle="collapse" href="#retenciones" aria-expanded="false">
                        <i><img style="width:25px" src="{{ asset('material') }}/img/laravel.svg"></i>
                        <p>{{ __('Retenciones') }}
                            <b class="caret"></b>
                        </p>
                    </a>
                    <div class="collapse" id="retenciones">
                        <ul class="nav">
                            <li class="nav-item{{ $activePage == 'Dividendos' ? ' active' : '' }}">
                                <a class="nav-link" href="{{ url('/administrador/dividendos') }}">
                                    <i class="material-icons text-white">filter_list</i>
                                    <span class="sidebar-normal">{{ __('Dividendos') }} </span>
                                </a>
                            </li>
                            <li class="nav-item{{ $activePage == 'Intereses' ? ' active' : '' }}">
                                <a class="nav-link" href="{{ url('/administrador/intereses') }}">
                                    <i class="material-icons text-white">style</i>
                                    <span class="sidebar-normal">{{ __('Intereses') }} </span>
                                </a>
                            </li>
                        </ul>
                    </div>
                </li>

                <li class="nav-item{{ $activePage == 'Contacto' ? ' active' : '' }}">
                    <a class="nav-link" href="{{ url('/administrador/contacto') }}">
                        <i class="material-icons text-white">request_quote</i>
                        <p>{{ __('Información de Contacto') }}</p>
                    </a>
                </li>
                @endif

                @if(Auth::user()->type == 1)
                    <li class="nav-item{{ $activePage == 'Facturaciones' ? ' active' : '' }}">
                        <a class="nav-link" href="{{ url('/cliente/facturas') }}">
                            <i class="material-icons text-white">request_quote</i>
                            <p>{{ __('Facturaciones') }}</p>
                        </a>
                    </li>

                        <li class="nav-item{{ $activePage == 'Constancias de Inversión' ? ' active' : '' }}">
                            <a class="nav-link" href="{{ url('/cliente/constancia_inversion') }}">
                                <i class="material-icons text-white">request_quote</i>
                                <p>{{ __('Constancias de Inversión') }}</p>
                            </a>
                        </li>

                        <li class="nav-item {{ ($activePage == 'Estados de Cuenta') ? ' active' : '' }}">
                            <a class="nav-link collapsed" data-toggle="collapse" href="#estados" aria-expanded="false">
                                <i><img style="width:25px" src="{{ asset('material') }}/img/laravel.svg"></i>
                                <p>{{ __('Estados de Cuenta') }}
                                    <b class="caret"></b>
                                </p>
                            </a>
                            <div class="collapse" id="estados">
                                <ul class="nav">
                                    <li class="nav-item{{ $activePage == 'Inversiones' ? ' active' : '' }}">
                                        <a class="nav-link" href="{{ url('/cliente/cuentas_inversion') }}">
                                            <i class="material-icons text-white">filter_list</i>
                                            <span class="sidebar-normal">{{ __('Inversiones') }} </span>
                                        </a>
                                    </li>
                                    <li class="nav-item{{ $activePage == 'Créditos' ? ' active' : '' }}">
                                        <a class="nav-link" href="{{ url('/cliente/cuentas_credito') }}">
                                            <i class="material-icons text-white">style</i>
                                            <span class="sidebar-normal">{{ __('Créditos') }} </span>
                                        </a>
                                    </li>
                                </ul>
                            </div>
                        </li>

                        <li class="nav-item {{ ($activePage == 'Retenciones') ? ' active' : '' }}">
                            <a class="nav-link collapsed" data-toggle="collapse" href="#retenciones" aria-expanded="false">
                                <i><img style="width:25px" src="{{ asset('material') }}/img/laravel.svg"></i>
                                <p>{{ __('Retenciones') }}
                                    <b class="caret"></b>
                                </p>
                            </a>
                            <div class="collapse" id="retenciones">
                                <ul class="nav">
                                    <li class="nav-item{{ $activePage == 'Dividendos' ? ' active' : '' }}">
                                        <a class="nav-link" href="{{ url('/cliente/dividendos') }}">
                                            <i class="material-icons text-white">filter_list</i>
                                            <span class="sidebar-normal">{{ __('Dividendos') }} </span>
                                        </a>
                                    </li>
                                    <li class="nav-item{{ $activePage == 'Intereses' ? ' active' : '' }}">
                                        <a class="nav-link" href="{{ url('/cliente/intereses') }}">
                                            <i class="material-icons text-white">style</i>
                                            <span class="sidebar-normal">{{ __('Intereses') }} </span>
                                        </a>
                                    </li>
                                </ul>
                            </div>
                        </li>

                        <li class="nav-item{{ $activePage == 'Contacto' ? ' active' : '' }}">
                            <a class="nav-link" href="{{ url('/cliente/contacto') }}">
                                <i class="material-icons text-white">request_quote</i>
                                <p>{{ __('Información de Contacto') }}</p>
                            </a>
                        </li>
                @endif

            <li class="nav-item{{ $activePage == 'language' ? ' active' : '' }}">
                <a class="nav-link text-white bg-dark" href="{{ route('logout') }}" onclick="event.preventDefault();document.getElementById('logout-form').submit();">
                    <i class="material-icons text-white">logout</i>
                    <p>{{ __('Cerrar Sesión') }}</p>
                </a>
            </li>
        </ul>
    </div>
</div>
