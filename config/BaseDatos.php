<?php
//Clase singleton que maneja la bbdd
class BaseDatos {

    private static $instance = null;
    private CONST DSN = 'mysql:host=localhost;dbname=primeraBase';
    private CONST USER = 'fjavierlasso';
    private CONST PASSWORD = '1234';

    private $dbh;

    public static function getInstance()
    {
        if (self::$instance === null) {
            self::$instance = new BaseDatos();
        }

        return self::$instance;
    }

    private function __construct(){
        try {

            $this->dbh = new PDO(self::DSN, self::USER, self::PASSWORD); //Abro la conexión
            $this->dbh->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION); //Manejo de errores
            
          } catch (PDOException $e) {
            print "¡Error!: " . $e->getMessage() . "\n";
            die();
          }
    }

    public function sentencia($sentencia, ...$condiciones){
        
       $resultado = $this->dbh->prepare($sentencia);
       $resultado->setFetchMode(PDO::FETCH_ASSOC); //Asigno el modo de fetch a asociativo

       if ($condiciones) {

        for ($i=0;$i<count($condiciones);$i++) {

            $resultado->bindValue($i+1,$condiciones[$i]);

        }
       }

       $resultado->execute();
       return $resultado;
        
    }

    public function ejecutar($sentencia, ...$condiciones) {
        $resultado = $this->dbh->prepare($sentencia);
    
        if ($condiciones) {
            for ($i = 0; $i < count($condiciones); $i++) {
                $resultado->bindValue($i + 1, $condiciones[$i]);
            }
        }
    
        $resultado->execute();
    }
    

  

    public function cerrarBD() {
        // Ya se ha terminado; se cierra.
        $this->dbh = null;
    }


}