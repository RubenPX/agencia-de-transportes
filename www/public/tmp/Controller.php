<?php

require_once "logger.php";

// Evitamos que se impriman los errores
// error_reporting(E_ERROR | E_PARSE);

class DatabaseController
{
    // Esta variablesirve para saber si se tiene mostrar las consultas
    private static $logQuerys = True;

    // DB conection properties
    private string $server;
    private string $userDB;
    private string $passDB;
    private string $nameDB;

    // DB conetion
    private mysqli $conex;
    private $ready = False;


    // el servidor se llama db porque tengo una redirección en el archivo
    function __construct(string $server = "db", string $user = "agencia", string $password = "agencia", string $db = "agencia")
    {
        $this->server = $server;
        $this->userDB = $user;
        $this->passDB = $password;
        $this->nameDB = $db;

        $this->tryConnect();
        mysqli_report(MYSQLI_REPORT_OFF);
    }

    // metodo para establecer conexión
    public function tryConnect()
    {
        try {
            $this->conex = new mysqli($this->server, $this->userDB, $this->passDB, $this->nameDB);

            $err = $this->conex->connect_errno;
            if ($err != null) {
                throw new Exception($this->conex->connect_error);
            }

            webConsoleLog("Conexión establecida " . $this->conex->server_info);
            $this->ready = True;
        } catch (Exception $e) {
            echo '<link rel="stylesheet" href="/shared/assets/style/bootstrap.min.css">';

            // echo "Fallo al conectar con las base de datos... <br />";
            if ($err == 2002) { // host not found
                print "Fallo al conectar con la base de datos host o ip no encontrado";
            } elseif ($err == 1045) { // login failed
                print "Acceso denegado: Fallo al hacer login (Usuario o contraseña equivocados)";
            } elseif ($err == 1044) { // Access denied for database
                print "Fallo al acceder a la base de datos $this->nameDB";
            } else {
                print $this->conex->connect_error;
            }

            die();
        }
    }

    function __destruct()
    {
        // La ventaja de crear un destructor, es que nada mas terminar el programa se cierra la conexión automaticamente
        webConsoleLog("Cerrando conexión con base de datos");
        $this->closeConex();
    }

    public function closeConex()
    {
        if ($this->ready == False) return;
        $this->conex->close();
    }

    public function runQuery(string $queryString)
    { // This will return a throw if has an error. SHOULD BE CONTROLLED
        try {
            if ($this->ready == False) return;
            $resultQ = $this->conex->query($queryString);

            if ($resultQ) {
                // Put results to array
                $array = [];
                for ($i = 0; $array[$i] = $resultQ->fetch_object(); $i++);

                // remove last element of array. Always will be "null"
                array_pop($array);

                // print con browser console
                webConsoleQueryLog($queryString, json_encode($array));

                // return query data
                return $array;
            } else {
                echo '<link rel="stylesheet" href="/shared/assets/style/bootstrap.min.css">';
                echo "<pre style='white-space: pre-line;'>";
                echo $queryString;
                echo "</pre><hr />";
                echo $this->conex->error;
                die();
            }
        } catch (\Throwable $th) {
            //throw $th;
            echo $th;
            die();
        }
    }

    // & significa enviar el valor por referencia
    public function runPreparedQuery(string $queryString)
    {
        // Prepare statement
        $statement = $this->conex->stmt_init();
        $statement->prepare($queryString);

        
        if($statement->error){
            echo "Se ha producido un error: " . $statement->error;
            die();
        }
        
        return $statement;
    }
}
