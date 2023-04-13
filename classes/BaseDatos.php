<?php
//Clase singleton que maneja la bbdd
class BaseDatos
{

    private static $instance = null;
    
    private $dsn;
    private $user;
    private $password;

    private $dbh;

    public static function getInstance()
    {
        if (self::$instance === null) {
            self::$instance = new BaseDatos();
        }

        return self::$instance;
    }

    private function __construct()
    {
        try {
            $this->dsn = 'mysql:host=' . getenv('DB_HOST') . ';dbname=' . getenv('DB_NAME');
            $this->user = getenv('DB_USER');
            $this->password = getenv('DB_PASSWORD');

            $this->dbh = new PDO($this->dsn, $this->user, $this->password);
            $this->dbh->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        } catch (PDOException $e) {
            print "¡Error!: " . $e->getMessage() . "\n";
            die();
        }
    }

    public function sentencia($sentencia, ...$condiciones)
    {

        $resultado = $this->dbh->prepare($sentencia);
        $resultado->setFetchMode(PDO::FETCH_ASSOC); //Asigno el modo de fetch a asociativo

        if ($condiciones) {

            for ($i = 0; $i < count($condiciones); $i++) {
                $resultado->bindValue($i + 1, $condiciones[$i]);
            }
        }

        $resultado->execute();
        return $resultado;
    }

    public function ejecutar($sentencia, ...$condiciones)
    {
        $resultado = $this->dbh->prepare($sentencia);

        if ($condiciones) {
            for ($i = 0; $i < count($condiciones); $i++) {
                $resultado->bindValue($i + 1, $condiciones[$i]);
            }
        }

        $resultado->execute();
    }




    public function cerrarBD()
    {
        // Ya se ha terminado; se cierra.
        $this->dbh = null;
    }
}
