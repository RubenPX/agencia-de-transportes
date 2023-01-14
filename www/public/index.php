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
        header('Location: /public/Repartidor.php');
    }

    if ($sessionL->userType == "ADMIN") {
        header('Location: /public/admin.php');
    }

    die();
}

header('Location: /public/login.php');