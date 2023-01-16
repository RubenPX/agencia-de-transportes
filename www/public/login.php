<?php
require_once "./shared/blade.php";
use Clases\SessionLogin;

$error = "";

if (isset($_POST["login"])) {
    if (isset($_POST["user"]) && isset($_POST["pass"])) {
        $sLogin = new SessionLogin();
        if (!$sLogin->tryCreateSession(trim($_POST["user"]), trim($_POST["pass"]), trim($_POST["userType"]))) {
            $error = "Fallo al iniciar sesión";
        }
    } else {
        $error = "Asegurate de completar los campos necesarios";
    }
}

echo $blade
    ->view()
    ->make('login', compact('error'))
    ->render();
