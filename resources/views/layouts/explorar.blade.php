<!DOCTYPE html>
<html lang="pt-BR">

<head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <meta name="mapbox_api_key" content="{{ config('app.mapbox_api_key') }}">
    <link rel="shortcut icon" type="image/x-icon" href="/img/favicon.ico">
    <title>@yield('title')</title>
    <!-- Google Fonts -->
    <link href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:400,700" rel="stylesheet" />
    <!-- Mapbox CSS -->
    <link href='https://api.tiles.mapbox.com/mapbox-gl-js/v2.9.2/mapbox-gl.css' rel='stylesheet' />
    <!-- Explorar CSS -->
    <link href="/css/explorar.css" rel="stylesheet" />
    <!-- Bootstrap CSS-->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" crossorigin="anonymous">
    <!-- Bootstrap Icons -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.8.3/font/bootstrap-icons.css">
</head>

<body>
    <main>
        <header>
            <nav class="navbar navbar-expand-lg navbar-dark bg-dark">
                <div class="container">
                    <a class="navbar-brand" href="/">
                        <img src="/img/logo.png" alt="logo" height="35"> Share
                    </a>
                    <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
                        <span class="navbar-toggler-icon"></span>
                    </button>
                    <div class="collapse navbar-collapse" id="navbarNav">
                        <ul class="navbar-nav me-auto mb-2 mb-lg-0">
                            <li class="nav-item">
                                <a class="nav-link" href="/">Início</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" href="/explorar">Explorar</a>
                            </li>
                        </ul>
                        <div class="d-flex">
                            @auth
                            <div class="dropdown">
                                <a class="text-decoration-none dropdown-toggle link-light" type="button" id="userActions" data-bs-toggle="dropdown" aria-expanded="false">
                                    Bem vindo, {{ auth()->user()->name }}
                                </a>
                                <ul class="dropdown-menu" aria-labelledby="userActions">
                                    <li><a class="dropdown-item" href="/perfil">Perfil</a></li>
                                    @if( Auth()->user()->id_tipo == 1 )
                                    <li><a class="dropdown-item" href="/minhas-doacoes">Minha Doações</a></li>
                                    @else
                                    <li><a class="dropdown-item" href="/dashboard">Dashboard</a></li>
                                    @endif
                                    <li><a class="dropdown-item" href="/logout">Sair</a></li>
                                </ul>
                            </div>
                            @else
                            <a class="btn btn-share me-3" href="/login" role="button">Entrar</a>
                            @endauth
                        </div>
                    </div>
                </div>
            </nav>
        </header>
        @yield('content')
        <footer class="mt-auto">
            <div class="container">
                <div class="d-flex flex-wrap justify-content-between align-items-center py-3 border-top">
                    <p class="col-md-4 mb-0 text-muted">© 2022 Share</p>

                    <a href="/" class="col-md-4 d-flex align-items-center justify-content-center mb-3 mb-md-0 me-md-auto link-dark text-decoration-none">
                        <img src="/img/logo.png" alt="logo" height="35">
                    </a>

                    <ul class="nav col-md-4 justify-content-end">
                        <li class="nav-item"><a href="/" class="nav-link px-2 text-muted">Inicio</a></li>
                        <li class="nav-item"><a href="/explorar" class="nav-link px-2 text-muted">Explorar</a></li>
                        <li class="nav-item"><a href="/login" class="nav-link px-2 text-muted">Login</a></li>
                    </ul>
                </div>
            </div>
        </footer>
        <!-- Jquery -->
        <script type="text/javascript" src="https://code.jquery.com/jquery-3.6.0.js"></script>
        <!-- Mapbox JS -->
        <script src='https://api.tiles.mapbox.com/mapbox-gl-js/v2.9.2/mapbox-gl.js'></script>
        <!-- Funções para controlar o Mapbox -->
        <script type="text/javascript" src="/js/funcoesMapbox.js"></script>
        <!-- Funções para controlar modais e interações com o Mapbox -->
        <script type="text/javascript" src="/js/funcoesExplorar.js"></script>
        <!-- Notify JS -->
        <script type="text/javascript" src="/js/plugins/notify.min.js"></script>
        <!-- Bootstrap JS-->
        <script type="text/javascript" src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"></script>
        <!-- QrCode -->
        <script type="text/javascript" src="/js/plugins/qrcode.min.js"></script>
    </main>
</body>

</html>