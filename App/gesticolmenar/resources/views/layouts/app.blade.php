<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    {{-- , minimum-scale=1, user-scalable=no --}}
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>@yield('title')</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-rbsA2VBKQhggwzxH7pPCaAqO46MgnOM80zW1RWuH61DGLwZJEdK2Kadq2F9CUG65" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.3/font/bootstrap-icons.css">
    <link rel="stylesheet" href="{{ asset('css/app.css') }}">
</head>

<body>
    <nav class="navbar navbar-expand-lg">
        <div class="container-fluid">
            <a class="navbar-brand ms-3" href="{{ route('apiaries.index') }}">
                <img src="{{ asset('img/logo.png') }}" width="50" alt="Imagen del logotipo" />
            </a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNavAltMarkup"
                aria-controls="navbarNavAltMarkup" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarNavAltMarkup">
                <div class="navbar-nav">
                    <a class="nav-link" aria-current="page" href="{{ route('apiaries.index') }}">Colmenares</a>

                    {{-- <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                          Colmenas
                        </a>
                        <ul class="dropdown-menu">
                            @foreach($apiaries as $apiary)
                                <li><a class="dropdown-item" href="{{ route('beehives.beehivesApiary', $apiary->id) }}">{{ $apiary->place_name }}</a></li>
                            @endforeach
                          <li><a class="dropdown-item" href="#">Action</a></li>
                          <li><a class="dropdown-item" href="#">Another action</a></li>
                          <li><a class="dropdown-item" href="#">Something else here</a></li>
                        </ul>
                      </li> --}}

                    <a class="nav-link" href="{{ route('places.index') }}">Ubicaciones</a>
                    <a class="nav-link" href="{{ route('queens.index') }}">Reinas disponibles</a>
                    <a class="nav-link" href="{{ route('users.index')}}">Perfil <i class="bi bi-person-circle"></i></a>
                    <a class="nav-link" href="{{ route('logout') }}">Logout
                        <i class="bi bi-box-arrow-right"></i>
                    </a>


                </div>
            </div>
        </div>
    </nav>

    @yield('content')

    <footer class="container-fluid text-center icons-copyright fixed-bottom" style="height: 110px">
        <div class="p-2 pb-0">
            <section class="mb-2">
                <a class="btn text-white btn-floating m-1" style="background-color: #0082ca;" target="_blank"
                    href="https://www.linkedin.com/in/josevicentefalco/" role="button"><i
                        class="bi bi-linkedin"></i></a>
                <a class="btn text-white btn-floating m-1" style="background-color: #333333;" target="_blank"
                    href="https://github.com/Ocklaf" role="button"><i class="bi bi-github"></i></a>
            </section>
        </div>

        <div class="text-center p-2 copyright">
            © {{ date('Y') }} Copyright: José Vicente Falcó Milla
        </div>
    </footer>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-kenU1KFdBIe4zVF0s0G1M5b4hcpxyD9F7jL+jjXkk+Q2h455rYXK/7HAuoJl+0I4" crossorigin="anonymous">
    </script>
    <script src="https://kit.fontawesome.com/5b4a7e4489.js" crossorigin="anonymous"></script>
    {{-- <script src="{{asset('js/prueba.js')}}"></script> --}}
</body>

</html>
