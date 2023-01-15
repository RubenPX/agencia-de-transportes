<?php

namespace Clases;

use PDO;
use PDOException;
use PDOStatement;

class Conexion {
    private $host;
    private $db;
    private $user;
    private $pass;
    private $dsn;
    protected PDO $conexion;
    protected PDOStatement $stmt;

    public function __construct() {
        $this->host = "db";
        $this->db = "agencia";
        $this->user = "agencia";
        $this->pass = "agencia";
        $this->dsn = "mysql:host={$this->host};dbname={$this->db};charset=utf8mb4";
        $this->crearConexion();
    }

    public function __destruct() {
        // $this->conexion;
    }

    public function crearConexion(): PDO {
        try {
            $this->conexion = new PDO($this->dsn, $this->user, $this->pass);
            $this->conexion->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        } catch (PDOException $ex) {
            die("Error en la conexión: mensaje: " . $ex->getMessage());
        }
        return $this->conexion;
    }

    public function prepareStatement(string $query) {
        try {
            $this->stmt = $this->conexion->prepare($query);
        } catch (PDOException $ex) {
            throw new PDOException("Error al preparar la query");
        }
    }

    public function setParam(string $key, string $value) {
        try {
            $this->stmt->bindParam($key, $value);
        } catch (PDOException $ex) {
            throw new PDOException("Error al añadir un parametro");
        }
    }

    // Debug SQL + Params
    function pdo_debugStrParams($stmt) {
        ob_start();
        $stmt->debugDumpParams();
        $r = ob_get_contents();
        ob_end_clean();
        return explode("\n", $r);
      }

    public function runStatement(): bool {
        try {
            return $this->stmt->execute();
        } catch (PDOException $ex) {
            throw new PDOException("Error al ejecutar la sentencia");
        }
    }

    public function fetch() {
        try {
            return $this->stmt->fetch(PDO::FETCH_ASSOC);
        } catch (PDOException $ex) {
            throw new PDOException("Fallo al extraer datos");
        }
    }

    public function fetchAll() {
        try {
            return $this->stmt->fetchAll(PDO::FETCH_ASSOC);
        } catch (PDOException $ex) {
            throw new PDOException("Fallo al extraer datos");
        }
    }
}