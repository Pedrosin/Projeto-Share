<!DOCTYPE html>
<html lang="pt-BR">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="shortcut icon" type="image/x-icon" href="/img/favicon.ico">
    <title>@yield('title')</title>
    <!-- Bootstrap CSS-->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
    <!-- Bootstrap Icons -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.8.3/font/bootstrap-icons.css">
    <!-- Flickity Slick -->
    <link rel="stylesheet" href="https://unpkg.com/flickity@2/dist/flickity.min.css">
    <!-- CSS Geral -->
    <link rel="stylesheet" href="/css/style.css">
    <!-- DataTables -->
    <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.12.1/css/dataTables.bootstrap5.min.css" />
</head>

<body>
    <main class="d-flex flex-column min-vh-100">
        <header>
            <nav class="navbar navbar-expand-lg navbar-dark bg-dark">
                <div class="container">
                    <a class="navbar-brand" href="/">
                        <img src="/img/logo.png" alt="logo" height="35"> Share
                    </a>
                    <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav"
                        aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
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
                                    <a class="text-decoration-none dropdown-toggle link-light" type="button"
                                        id="userActions" data-bs-toggle="dropdown" aria-expanded="false">
                                        Bem vindo, {{ auth()->user()->name }} <img
                                            src="/img/profile_icons/{{ $nm_icon }}" class="rounded-circle"
                                            height="50" alt="Profile Icon" loading="lazy" id="nav-profile-icon"/>
                                    </a>
                                    <ul class="dropdown-menu" aria-labelledby="userActions">
                                        <li><a class="dropdown-item" href="/perfil">Perfil</a></li>
                                        @if (Auth()->user()->id_tipo == 1)
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

                    <a href="/"
                        class="col-md-4 d-flex align-items-center justify-content-center mb-3 mb-md-0 me-md-auto link-dark text-decoration-none">
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
        <script type="text/javascript" src="https://code.jquery.com/jquery-3.6.0.js"
            integrity="sha256-H+K7U5CnXl1h5ywQfKtSj8PCmoN9aaq30gDh27Xc0jk=" crossorigin="anonymous"></script>
        <!-- Nosso JS -->
        <script type="text/javascript" src="/js/funcoesGerais.js"></script>
        <!-- Bootstrap JS-->
        <script type="text/javascript" src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"
            integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous">
        </script>
        <!-- FlickitySlick JS -->
        <script type="text/javascript" src="https://unpkg.com/flickity@2/dist/flickity.pkgd.min.js"></script>
        <!-- jQuery Mask Plugin -->
        <script src="/js/plugins/jquery.mask.min.js"></script>
        <!-- DataTables JS-->
        <script type="text/javascript" src="https://cdn.datatables.net/1.12.1/js/jquery.dataTables.min.js"></script>
        <script type="text/javascript" src="https://cdn.datatables.net/1.12.1/js/dataTables.bootstrap5.min.js"></script>
        @yield('extra-script')
    </main>
</body>

</html>
