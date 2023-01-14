<?php

// Session login
use Clases\SessionLogin;

$sessionL = new SessionLogin();

if (!$sessionL->verifySession()) {
    if ($sessionL->tryDeleteSession()) {
        die();
    }
}

$logedUser = $sessionL->userName;