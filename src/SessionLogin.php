<?php

namespace Clases;

/**
 * This is a temporal login implementation
 */
Class SessionLogin {

    public string $userName; // User Name
    public string $UID; // Repartidor ID | User DNI
    public string $userType; // Repartidor | Admin

    public function verifySession(): bool {
        // Query to database if $UID exists
        session_start();

        if (isset($_SESSION["userName"]) && isset($_SESSION["userType"])) {
            $this->userName = base64_decode($_SESSION["userName"]);
            $this->userType = base64_decode($_SESSION["userType"]);
            return true;
        }

        return false;
    }

    /**
     * Create session user (LogIn)
     * @param string $user
     * @param string $name
     * @param string $type
     * @return bool
     */
    public function tryCreateSession(string $user, string $pass, string $type): bool {
        session_start();

        $_SESSION["userName"] = base64_encode($user);
        $_SESSION["userType"] = base64_encode($type);

        header('Location: /');

        return true;
    }

    /**
     * Delete session user (LogOut)
     * @param string $user
     * @return void
     */
    public function tryDeleteSession() {
        session_start();

        unset($_SESSION["userName"]);
        unset($_SESSION["userType"]);

        header('Location: /');

        return true;
    }
}