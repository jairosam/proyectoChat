<?php

namespace BaseDatos;

require_once('./Algoritmo/LZW.php');
require_once('Conexion.php');

use BaseDatos\Conexion;
use Algoritmo\LZW;
use mysqli;

class GestionBd
{

    public $conexion;
    private $LZW;

    public function __construct(){
        $this->conexion = new Conexion;
        $this->LZW = new LZW;
    }

    public function insertar_mensaje($usuario, $texto){
        $comprimido = $this->LZW->comprimir($texto);
        $comprimido = $this->arrayEncode($comprimido);
        $diccionario = $this->arrayEncode($this->LZW->getDic());
        $sql = "INSERT INTO mensajes (name, diccionario, comprimido) 
        VALUES ('$usuario', '$diccionario', '$comprimido')";
        mysqli_query($this->conexion->con, $sql);
    }

    public function consultar_mensaje($usuario){
        $sql = "SELECT * FROM mensajes WHERE name='$usuario'";
        $mensajes = mysqli_query($this->conexion->con, $sql);
        $decodes = [];
        $cont = 0;
        while ($row = mysqli_fetch_array($mensajes)) {
            echo "<br><br>" . $row['id'] . " ";
            echo "<br><br>" . $row['usuario'] . " ";
            $this->LZW->setDic($this->arrayDecode($row['diccionario']));
            $comprimido = $this->arrayDecode($row['comprimido']);
            echo $this->LZW->descomprimir($comprimido);
        }
    }

    public function retornar_mensaje($cod_base, $dic_base){
        $comprimido = $this->arrayDecode($cod_base);
        $diccionario = $this->arrayDecode($dic_base);
        $this->LZW->setDic($diccionario);
        return $this->LZW->descomprimir($comprimido);
    }

    public function arrayEncode($array){
        return base64_encode(json_encode($array));
    }

    public function arrayDecode($array){
        return json_decode(base64_decode($array), true);
    }
}

//$gestion = new GestionBd;
//$gestion->insertar_mensaje("pepe", "compadre no compro coco");
//$gestion->consultar_mensaje("pepe");
