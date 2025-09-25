<!DOCTYPE html>
<html lang="pt-BR">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Sistema de Gestão</title>

    <link rel="icon" type="image/svg+xml" href="data:image/svg+xml,<svg xmlns='http://www.w3.org/2000/svg' viewBox='0 0 316 316'><path fill='%23ffc107' d='M305.8 81.125C305.77 80.995 305.69 80.885 305.65 80.755C305.56 80.525 305.49 80.285 305.37 80.075C305.29 79.935 305.17 79.815 305.07 79.685C304.94 79.515 304.83 79.325 304.68 79.175C304.55 79.045 304.39 78.955 304.25 78.845C304.09 78.715 303.95 78.575 303.77 78.475L251.32 48.275C249.97 47.495 248.31 47.495 246.96 48.275L194.51 78.475C194.33 78.575 194.19 78.725 194.03 78.845C193.89 78.955 193.73 79.045 193.6 79.175C193.45 79.325 193.34 79.515 193.21 79.685C193.11 79.815 192.99 79.935 192.91 80.075C192.79 80.285 192.71 80.525 192.63 80.755C192.58 80.875 192.51 80.995 192.48 81.125C192.38 81.495 192.33 81.875 192.33 82.265V139.625L148.62 164.795V52.575C148.62 52.185 148.57 51.805 148.47 51.435C148.44 51.305 148.36 51.195 148.32 51.065C148.23 50.835 148.16 50.595 148.04 50.385C147.96 50.245 147.84 50.125 147.74 49.995C147.61 49.825 147.5 49.635 147.35 49.485C147.22 49.355 147.06 49.265 146.92 49.155C146.76 49.025 146.62 48.885 146.44 48.785L93.99 18.585C92.64 17.805 90.98 17.805 89.63 18.585L37.18 48.785C37 48.885 36.86 49.035 36.7 49.155C36.56 49.265 36.4 49.355 36.27 49.485C36.12 49.635 36.01 49.825 35.88 49.995C35.78 50.125 35.66 50.245 35.58 50.385C35.46 50.595 35.38 50.835 35.3 51.065C35.25 51.185 35.18 51.305 35.15 51.435C35.05 51.805 35 52.185 35 52.575V232.235C35 233.795 35.84 235.245 37.19 236.025L142.1 296.425C142.33 296.555 142.58 296.635 142.82 296.725C142.93 296.765 143.04 296.835 143.16 296.865C143.53 296.965 143.9 297.015 144.28 297.015C144.66 297.015 145.03 296.965 145.4 296.865C145.5 296.835 145.59 296.775 145.69 296.745C145.95 296.655 146.21 296.565 146.45 296.435L251.36 236.035C252.72 235.255 253.55 233.815 253.55 232.245V174.885L303.81 145.945C305.17 145.165 306 143.725 306 142.155V82.265C305.95 81.875 305.89 81.495 305.8 81.125ZM144.2 227.205L100.57 202.515L146.39 176.135L196.66 147.195L240.33 172.335L208.29 190.625L144.2 227.205Z'/></svg>">

    @vite(['resources/css/app.css', 'resources/js/app.js'])

    <!-- Bootstrap CSS (CDN) -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">

    <style>
        /* Hover leve nos links do navbar */
        .navbar-nav .nav-link {
            transition: color 0.2s ease, transform 0.2s ease;
        }

        .navbar-nav .nav-link:hover {
            color: #000; /* leve escurecimento */
            transform: translateY(-2px); /* leve elevação */
        }
    </style>
</head>

<body>
    <nav class="navbar navbar-expand-lg navbar-dark mb-4">
        <div class="container">
            <div class="d-flex align-items-center gap-2">
                <x-application-logo class="w-10 h-10 fill-current text-gray-500" />
                <a class="navbar-brand text-dark fw-bold" href="{{ route('grupo-economico.index') }}">Sistema de Gestão</a>
            </div>

            <div class="navbar-collapse" id="navbarNav">
                <ul class="navbar-nav me-auto">
                    <li class="nav-item" wire:ignore.self>
                        <a class="nav-link text-dark position-relative {{ request()->routeIs('grupo-economico.*') ? 'active' : '' }}"
                           href="{{ route('grupo-economico.index') }}">
                            Grupos Econômicos
                            @if(request()->routeIs('grupo-economico.*'))
                                <span class="position-absolute start-50 translate-middle-x bottom-0 w-75 border-bottom border-2 border-dark"></span>
                            @endif
                        </a>
                    </li>
                    <li class="nav-item" wire:ignore.self>
                        <a class="nav-link text-dark position-relative {{ request()->routeIs('bandeira.*') ? 'active' : '' }}"
                           href="{{ route('bandeira.index') }}">
                            Bandeiras
                            @if(request()->routeIs('bandeira.*'))
                                <span class="position-absolute start-50 translate-middle-x bottom-0 w-50 border-bottom border-2 border-dark"></span>
                            @endif
                        </a>
                    </li>
                    <li class="nav-item" wire:ignore.self>
                        <a class="nav-link text-dark position-relative {{ request()->routeIs('unidades.*') ? 'active' : '' }}"
                           href="{{ route('unidades.index') }}">
                            Unidades
                            @if(request()->routeIs('unidades.*'))
                                <span class="position-absolute start-50 translate-middle-x bottom-0 w-50 border-bottom border-2 border-dark"></span>
                            @endif
                        </a>
                    </li>
                    <li class="nav-item" wire:ignore.self>
                        <a class="nav-link text-dark position-relative {{ request()->routeIs('colaboradores.*') ? 'active' : '' }}"
                           href="{{ route('colaboradores.index') }}">
                            Colaboradores
                            @if(request()->routeIs('colaboradores.*'))
                                <span class="position-absolute start-50 translate-middle-x bottom-0 w-50 border-bottom border-2 border-dark"></span>
                            @endif
                        </a>
                    </li>
                    <li class="nav-item" wire:ignore.self>
                        <a class="nav-link text-dark position-relative {{ request()->routeIs('relatorios.colaboradores') ? 'active' : '' }}"
                           href="{{ route('relatorios.colaboradores') }}">
                            Relatórios de Colaboradores
                            @if(request()->routeIs('relatorios.colaboradores'))
                                <span class="position-absolute start-50 translate-middle-x bottom-0 w-50 border-bottom border-2 border-dark"></span>
                            @endif
                        </a>
                    </li>
                </ul>

                @auth
                    <ul class="navbar-nav">
                        <li class="nav-item dropdown">
                            <a class="nav-link dropdown-toggle text-dark" href="#" id="userDropdown" role="button"
                               data-bs-toggle="dropdown" aria-expanded="false">
                                {{ Auth::user()->name }}
                            </a>
                            <ul class="dropdown-menu dropdown-menu-end" aria-labelledby="userDropdown">
                                <li>
                                    <a class="dropdown-item" href="{{ route('profile.edit') }}">Perfil</a>
                                </li>
                                <li>
                                    <form method="POST" action="{{ route('logout') }}">
                                        @csrf
                                        <button type="submit" class="dropdown-item">Sair</button>
                                    </form>
                                </li>
                            </ul>
                        </li>
                    </ul>
                @endauth

                @guest
                    <ul class="navbar-nav">
                        <li class="nav-item"><a class="nav-link" href="{{ route('login') }}">Login</a></li>
                        <li class="nav-item"><a class="nav-link" href="{{ route('register') }}">Registrar</a></li>
                    </ul>
                @endguest
            </div>
        </div>
    </nav>

    <main class="container">
        @yield('content')
    </main>

    <!-- Bootstrap JS (CDN) -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>
