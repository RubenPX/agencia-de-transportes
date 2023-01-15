<?php

namespace Clases;

use PDO;
use PDOException;
use PDOStatement;

require_once "WEBLogger.php";

class STMT {
    protected PDOStatement $stmt;
    protected array $params;

    public function __construct(PDO $Conex, string $query) {
        global $logger;
        try {
            $this->stmt = $Conex->prepare($query);
            $this->params = [];
            
        } catch (PDOException $ex) {
            throw new PDOException("Error al preparar la query");
        }
    }

    public function setParam(string $key, string $value) {
        try {
            $this->stmt->bindParam($key, $value);
            $this->params[$key] = $value;
            
        } catch (PDOException $ex) {
            throw new PDOException("Error al añadir un parametro");
        }
    }

    private function preDebugQuery() {
        webConsoleLog("QUERY: " . $this->stmt->queryString);
        foreach ($this->params as $key => $value) {
            webConsoleLog("> PARAM: " . $key . " => " . $value);
        }
    }

    private function debugRunQuery(int $rows) {
        global $logger;
        webConsoleLog("> Result count: " . $rows);
    }

    public function runStatement() {
        try {
            $this->preDebugQuery();
            $result = $this->stmt->execute();
            $this->debugRunQuery($this->stmt->rowCount());
            return $result;
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

class Conexion {
    private $host;
    private $db;
    private $user;
    private $pass;
    private $dsn;
    protected PDO $conexion;

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
        return new STMT($this->conexion, $query);
    }
}