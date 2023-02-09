<!DOCTYPE html>
<html lang="pt-BR">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <link rel="shortcut icon" type="image/x-icon" href="/img/favicon.ico">
    <title>@yield('title')</title>
    {{-- Bootstrap CSS --}}
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css">
    {{-- Bootstrap Icons --}}
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.9.1/font/bootstrap-icons.css">
    {{-- Date Range Picker CSS --}}
    <link rel="stylesheet" type="text/css" href="https://cdn.jsdelivr.net/npm/daterangepicker/daterangepicker.css" />
    {{-- CSS Geral --}}
    <link rel="stylesheet" href="/css/style.css">
    {{-- DataTables --}}
    <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.12.1/css/dataTables.bootstrap5.min.css" />
</head>

<body>
    <main>
        <div class="container-fluid">
            <div class="row">
                <div class="col-2 p-0">
                    <header class="dashboard-header" data-userid="{{ auth()->user()->id }}">
                        <nav class="sidebar bg-dark p-2">
                            <div class="nav-logo text-center">
                                <a href="/" class="text-decoration-none">
                                    <img class="img-fluid" src="/img/logo.png" alt="logo">
                                    <span class="logo-name text-white fw-bold text-uppercase">Share</span>
                                </a>
                            </div>
                            <div class="nav-items">
                                <ul class="w-100">
                                    @if (Auth()->user()->id_tipo == 2)
                                        <li>
                                            <a href="/dashboard">
                                                <i class="bi bi-house-heart-fill"></i>
                                                <span>Dashboard</span>
                                            </a>
                                        </li>
                                        <li>
                                            <a href="/publicar">
                                                <i class="bi bi-pencil-square"></i>
                                                <span>Criar publicação</span>
                                            </a>
                                        </li>
                                        <li>
                                            <a href="/metricas">
                                                <i class="bi bi-graph-up-arrow"></i>
                                                <span>Métricas</span>
                                            </a>
                                        </li>
                                        <li>
                                            <a href="/conta">
                                                <i class="bi bi-wallet"></i>
                                                <span>Formas de recebimento</span>
                                            </a>
                                        </li>
                                    @else
                                        {{-- Todas opções do administrador --}}
                                        <li>
                                            <a href="/projetos">
                                                <i class="bi bi-check-circle"></i>
                                                <span>Aprovar Projetos</span>
                                            </a>
                                        </li>
                                    @endif
                                    <li>
                                        <a href="/perfil">
                                            <i class="bi bi-person-circle"></i>
                                            <span>Editar Perfil</span>
                                        </a>
                                    </li>
                                    <li>
                                        <a href="/logout">
                                            <i class="bi bi-box-arrow-left"></i>
                                            <span>Sair</span>
                                        </a>
                                    </li>
                                </ul>
                            </div>
                        </nav>
                    </header>
                </div>
                <div class="col-10 p-2 d-flex flex-column min-vh-100">
                    @yield('content')
                    <footer class="mt-auto">
                        <div class="container-fluid">
                            <div class="d-flex flex-wrap justify-content-between align-items-center py-3 border-top">
                                <p class="col-md-4 mb-0 text-muted">© 2022 Share</p>

                                <a href="/"
                                    class="col-md-4 d-flex align-items-center justify-content-center mb-3 mb-md-0 me-md-auto link-dark text-decoration-none">
                                    <img src="/img/logo.png" alt="logo" height="35">
                                </a>

                                <ul class="nav col-md-4 justify-content-end">
                                    <li class="nav-item"><a href="/" class="nav-link px-2 text-muted">Inicio</a>
                                    </li>
                                    <li class="nav-item"><a href="/explorar"
                                            class="nav-link px-2 text-muted">Explorar</a></li>
                                    <li class="nav-item"><a href="/logout" class="nav-link px-2 text-muted">Sair</a>
                                    </li>
                                </ul>
                            </div>
                        </div>
                    </footer>
                </div>
            </div>
        </div>
        {{-- Jquery --}}
        <script type="text/javascript" src="https://code.jquery.com/jquery-3.6.0.js"></script>
        {{-- Bootstrap JS --}}
        <script type="text/javascript" src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js">
        </script>
        {{-- Moment JS --}}
        <script type="text/javascript" src="https://momentjs.com/downloads/moment-with-locales.js"></script>
        {{-- Date Range Picker JS --}}
        <script type="text/javascript" src="https://cdn.jsdelivr.net/npm/daterangepicker/daterangepicker.min.js"></script>
        {{-- jQuery Mask Plugin --}}
        <script src="/js/plugins/jquery.mask.min.js"></script>
        {{-- DataTables JS --}}
        <script type="text/javascript" src="https://cdn.datatables.net/1.12.1/js/jquery.dataTables.min.js"></script>
        <script type="text/javascript" src="https://cdn.datatables.net/1.12.1/js/dataTables.bootstrap5.min.js"></script>
        {{-- Chart JS --}}
        <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
        {{-- Script JS --}}
        <script type="text/javascript" src="/js/funcoesGerais.js"></script>
        @yield('extra-script')
    </main>
</body>

</html>
