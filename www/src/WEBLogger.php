<?php
function webConsoleLog($str, $any = "''") {
    global $logger;
    $logger->wcl($str, $any);
}

function webConsoleQueryLog(string $str, $any) {
    global $logger;
    $logger->wcq($str, $any);
}

function satinize_query(string $str) {

    $last = str_replace("\n", "\\n", $str);
    $last = str_replace("'", "\'", $last);
    while (true) {
        $newFix = str_replace("  ", " ", $last);
        if ($last == $newFix)
            break;
        $last = $newFix;
    }

    return $last;
}

class LOGGER {
    private $showDevConsole;
    private $WebLogs = [];


    function __construct(bool $showConsole) {
        $this->showDevConsole = $showConsole;
        if ($this->showDevConsole) {
            $this->wcl("ATENCIÓN: este ejercicio esta en modo desarollo");
        }
    }

    public function wcq(string $str, $any) {
        $this->WebLogs[] = ["TYP" => "query", "str" => $str, "any" => $any];
    }

    public function wcl($str, $any = "''") {
        $this->WebLogs[] = ["TYP" => "log", "str" => $str, "any" => $any];
    }

    // El motivo de usar el destruct es para que se puedan establecer las cookies, ya que si
    // escribes algo en el body, php ya no te deja setear cookies (esto pasa por el header)
    function __destruct() {
        if (!$this->showDevConsole) {
            return;
        }

        print "\n\n<script> // Logs desde PHP generados desde un __destruct()";
        while (!!$this->WebLogs) {
            $q = array_shift($this->WebLogs);
            print "\n";
            if ($q["TYP"] == "log") { // Imprimimos los datos
                print "\tconsole.log('%c[PHP]%c ";
                print $q["str"];
                print "', 'color: lightblue;text-decoration: underline', 'color: orange', $q[any])";
            } elseif ($q["TYP"] == "query") { // Formateamos los datos de la query
                $query = satinize_query($q["str"]);
                print "\tconsole.groupCollapsed('%c[PHP QUERY]%c click here to expand', 'color: teal;text-decoration: underline', 'color: green');";
                print "console.log('%c $query', 'color: orange'); ";
                print "console.log($q[any]); ";
                print "console.groupEnd();";
            }
        }
        print "\n</script>";
    }
}
?>