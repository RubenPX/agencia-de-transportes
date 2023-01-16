<?php

namespace Clases;

/**
 * This is a temporal login implementation
 * todo: @RubenPX Implementar bien las funciones
 */
class SessionLogin {

    private string $cokieName = "loginInfo";

    public function __construct() {
        session_start();
    }

    public function verifySession(): array {
        if (isset($_SESSION[$this->cokieName])) {
            $loginInfo = $this->decryptLogin($_SESSION[$this->cokieName]);

            $foundLogin = $this->tryLogin($loginInfo["Name"], $loginInfo["Pass"], true);

            if (!!$foundLogin) {
                return $foundLogin;
            }
        }

        return [];
    }

    /**
     * Create session user (LogIn)
     * @param string $user
     * @param string $name
     * @param string $type
     * @return bool
     */
    public function tryCreateSession(string $user, string $pass): bool {
        $loginFound = $this->tryLogin($user, $pass);
        if (count($loginFound) == 0) {
            return false;
        }

        $_SESSION["loginInfo"] = $this->cryptLogin($loginFound["Nombre"], $loginFound["Pass"]);
        header('Location: /');
        return true;
    }

    /**
     * Delete session user (LogOut)
     * @param string $user
     * @return void
     */
    public function tryDeleteSession() {
        unset($_SESSION["loginInfo"]);

        header('Location: /');

        return true;
    }

    private function cryptLogin(string $user, string $pass) {
        $userP = base64_encode($user);
        $passP = base64_encode($pass);
        return base64_encode($userP . "|" . $passP);
    }

    private function decryptLogin(string $str) {
        $strD = explode("|", base64_decode($str));
        return ["Name" => base64_decode($strD[0]), "Pass" => base64_decode($strD[1])];
    }

    private function tryLogin(string $user, string $pass, bool $rawPass = false) {
        $found = $this->tryLoginAdmin($user, $pass, $rawPass);

        if (count($found) == 0) {
            $found = $this->tryLoginRepartidor($user, $pass, $rawPass);
            if (count($found) == 0) {
                return [];
            }
        }

        return $found;
    }

    private function tryLoginRepartidor(string $user, string $password, bool $rawPass = false) {
        $repartidor = new Repartidor();

        $found = $repartidor->recuperarRepartidores();

        foreach ($found as $item) {
            if ($item["Nombre"] != $user) {
                continue;
            }

            $passDB = $item["password"];
            $passUser = $rawPass ? $password : hash("sha256", $password);

            if ($passDB != $passUser) {
                continue;
            }

            return ["id" => $item["id"], "Nombre" => $item["Nombre"], "Pass" => $passUser, "type" => "REPAR"];
        }

        return [];
    }

    private function tryLoginAdmin(string $user, string $password, bool $rawPass = false) {
        $cliente = new Cliente();

        $found = $cliente->recuperarClientes();

        foreach ($found as $item) {
            if ($item["nombre"] != $user) {
                continue;
            }

            $passDB = $item["password"];
            $passUser = $rawPass ? $password : hash("sha256", $password);

            if ($passDB != $passUser) {
                continue;
            }

            return ["id" => $item["DNI"], "Nombre" => $item["nombre"], "Pass" => $passUser, "type" => "ADMIN"];
        }

        return [];
    }
}