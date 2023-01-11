<header>
    <nav class="navbar navbar-expand-lg navbar-dark bg-primary">
        <div class="container-fluid">
            <a class="navbar-brand" href="#">@yield('titulo')</a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarColor01"
                aria-controls="navbarColor01" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarColor01">
                <ul class="navbar-nav me-auto">
                    <!-- <li class="nav-item">
                            <a class="nav-link active" href="#">Clientes</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="#">Features</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="#">Pricing</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="#">About</a>
                        </li> -->
                </ul>
                <form class="d-flex">
                    <input class="form-control text-center" type="text" disabled value="{{ $logedUser }}">
                    <button class="btn btn-secondary my-2 my-sm-0 mx-2" type="submit"
                        style="white-space: nowrap;">Cerrar Sesión</button>
                </form>
            </div>
        </div>
    </nav>
</header>