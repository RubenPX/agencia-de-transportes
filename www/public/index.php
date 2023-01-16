<?php

require_once "./shared/blade.php";
use Clases\SessionLogin;

$sessionL = new SessionLogin();

if (isset($_GET["LogOut"])) {
    $sessionL->tryDeleteSession();
}

$session = $sessionL->verifySession();

if (!!$session) {
    if ($session["type"] == "REPAR") {
        header('Location: /public/repartidor.php');
    }

    if ($session["type"] == "ADMIN") {
        header('Location: /public/admin.php');
    }

    die();
}

header('Location: /public/login.php');