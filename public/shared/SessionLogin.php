<?php

// Session login
use Clases\SessionLogin;
$sessionL = new SessionLogin();
if (!$sessionL->verifySession()) {
    $sessionL->tryDeleteSession();
}
$logedUser = $sessionL->userName;