<?php

function say($what)
{
    echo $what;
}

?>

<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Proyecto agencia de transportes</title>
</head>

<body>
    <h1>Esto es un proyecto de ejemplo de momento</h1>
    <img src="imagen_que_no_existe.png" alt="">
    <p>Esto es una beta que no afecta a el proyecto principal</p>

    <p>
        Lorem ipsum dolor sit amet consectetur adipisicing elit. Facere quae voluptatibus est, magni numquam distinc
    </p>

    <p> <?php say("Hello from " . php_uname("r")); ?> </p>
</body>

</html>