<?php
session_start();

require_once "./shared/blade.php";

if (isset($_SESSION['error'])) {
    $error = $_SESSION['error'];
    echo $blade
        ->view()
        ->make('login', compact('error'))
        ->render();
    unset($_SESSION['error']);
} else {
    echo $blade
        ->view()
        ->make('login')
        ->render();
}