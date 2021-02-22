<?php

namespace BaseDatos;

class Conexion{

    private $host;
    private $user;
    private $pass;
    private $bd;

    public $con;

    public function __construct(){

        $this->user = "root";
        $this->host = "localhost";
        $this->pass = "";
        $this->bd = "compresor";

        $this->con = mysqli_connect($this->host, $this->user, $this->pass, $this->bd);

        if(!$this->con){
            echo "Error al conectar con la base de datos";
            exit;
        }
        
    }

}
