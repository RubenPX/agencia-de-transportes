<?php

require_once "./shared/blade.php";
use Clases\SessionLogin;

$sessionL = new SessionLogin();

if (isset($_GET["LogOut"])) {
    if ($sessionL->tryDeleteSession()) {
        die();
    }
}

if ($sessionL->verifySession()) {
    if ($sessionL->userType == "REPAR") {
        header('Location: /Repartidor.php');
    }

    if ($sessionL->userType == "ADMIN") {
        header('Location: /admin.php');
    }

    die();
}

header('Location: /login.php');