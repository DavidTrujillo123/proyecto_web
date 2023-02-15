<?php
class Conexion {
    private $host = "localhost:3306";
    private $user = "root";
    private $password = "root";
    private $name_db = "db_lico";
    private $conn;

    public function __construct() {
        $this->conn = new mysqli($this->host, $this->user, $this->password, $this->name_db);
        if ($this->conn->connect_error) {
            die("Error de conexión: " . $this->conn->connect_error);
        }
    }
    public function getConnection() {
        return $this->conn;
    }
    //desconexion de Mysqly
    public function closeConnection() {
        $this->conn->close();
    }
    //Funcion que solicita una sentencia sql
    public function OperSql($sql){
        if($this->getConnection()){
            $result = $this->conn->query($sql);
            return $result;
        }
        else{
            die("Error de conexión: " );
            // return null;
        } 
    }
    public function Read($sql){
        $result = $this->OperSql($sql);
        return $result->fetch_all(MYSQLI_ASSOC);//MYSQLI_ASSOC = puede acceder desde el nombre de la columa
    }
    
}
?>