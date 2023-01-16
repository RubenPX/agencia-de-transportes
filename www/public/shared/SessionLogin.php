<?php

// Session login
use Clases\SessionLogin;

$sessionL = new SessionLogin();

$foundValidSession = $sessionL->verifySession();

if (!$foundValidSession) {
    if ($sessionL->tryDeleteSession()) {
        die();
    }
}

$loggedID = $foundValidSession["id"];
$logedUser = $foundValidSession["Nombre"];
$userType = $foundValidSession["type"];