<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="assets/bootstrap.darkly.min.css">
    <title>Iniciar sesión</title>
</head>

<body>
    <div class="container px-5 my-5">
        <div class="row justify-content-center">
            <div class="col-lg-8">
                <div class="card border-0 rounded-3 shadow-lg">
                    <div class="card-body p-4">
                        <div class="text-center pb-3">
                            <h1 class="h1 fw-light">Iniciar sesión</h1>
                        </div>

                        <form id="contactForm" method="POST" action="validar.php" name='login'>

                            <!-- USER -->
                            <div class="form-floating mb-3">
                                <input class="form-control" id="user" name="user" type="text" />
                                <label for="user">Usuario</label>
                            </div>

                            <!-- PASS -->
                            <div class="form-floating mb-3">
                                <input class="form-control" id="pass" name="pass" type="password" />
                                <label for="pass">Contraseña</label>
                            </div>

                            <div class="form-floating mb-3">
                                <select class="form-select" id="userType" name="userType">
                                    <option>administrador</option>
                                    <option>repartidor</option>
                                </select>
                                <label for="userType">Tipo de usuario</label>
                            </div>

                            <!-- Submit button -->
                            <div class="text-center">
                                <button class="btn btn-primary btn-lg" name='login' id="submitButton" type="submit">Acceder</button>
                            </div>
                        </form>
                    </div>
                </div>
                @if (isset($error))
                    <div class="alert alert-danger mb-0 mt-3">
                        <p class="mb-0 text-center">{{ $error }}</p>
                    </div>
                @endif
            </div>
        </div>
    </div>
</body>

</html>