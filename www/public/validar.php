<?php

session_start();
//Hacemos el autoload de las clases
require '../vendor/autoload.php';

function error($mensaje)
{
    $_SESSION['error'] = $mensaje;
    header('Location:login.php');
    die();
}

if (isset($_POST['login'])) {
    $nombre = trim($_POST['user']);
    $pass = trim($_POST['pass']);
    if (strlen($nombre) == 0 || strlen($pass) == 0) {
        error("Error, El nombre o la contraseña no pueden contener solo espacios en blancos.");
    }

    error("Esto es un error de prueba, no significa que ha fallado la autentificación, si no que no esta implementada");

}
?>