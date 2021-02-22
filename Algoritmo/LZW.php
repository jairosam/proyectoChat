<?php 

namespace Algoritmo;

class LZW{

    private $dic;

    public function __construct(){
        $this->dic = [];
    }



    public function comprimir($texto){
        
        // --------------- Inicializar Diccionario ----------------- //

        $longitud = (int)strlen($texto);
        $aux = 0;
        for($i=0;$i<$longitud;$i++){
            if(!in_array($texto[$i],array_keys($this->dic))){
                $this->dic[$texto[$i]] = $aux;
                $aux++;
            }
        }

        // ----------------Compresión de texto-------------------//
        $w = "";
        $dic = $this->dic;
        //echo "Diccionario: ";
        //var_dump($dic);
        $compresion = [];
        for($i=0;$i<$longitud;$i++){
            $k = $texto[$i];
            if(in_array($w.$k, array_keys($dic))){
                $w=$w.$k;
            }else{
                $compresion[$aux] = $dic[$w];
                $dic[$w.$k] = $aux;
                $w = $k;
                $aux++;
            }
        }
        //echo "<br><br>";
        $compresion[$aux] = $dic[$w];
        //echo "Compresion: ";
        //var_dump($compresion);
        //echo "<br><br>";
        //echo "diccionario: "; 
        //var_dump($dic);
        //echo "<br><br>";
        return array_values($compresion);
    }

    

    public function descomprimir($compresion){
        //echo "<br><br>";
        //var_dump($this->dic);
        
        //echo "<br><br>";
        //var_dump(array_values($compresion));
        $descomprimir = "";
        $compresion = array_values($compresion);
        $cod_viejo = $compresion[0];
        $caracter = array_keys($this->dic)[$cod_viejo];
        $descomprimir.=$caracter;
        //echo "<br><br>".$caracter;
        for($i=1;$i<sizeof($compresion);$i++){
            $cod_nuevo = $compresion[$i];
            if(!in_array($cod_nuevo,$this->dic)){
                $cadena = array_keys($this->dic)[$cod_viejo];
                $cadena = $cadena.$caracter;
            }else{
                $cadena = array_keys($this->dic)[$cod_nuevo];
            }
            $descomprimir.=$cadena;
            //echo $cadena;
            $caracter = $cadena[0];
            $this->dic[array_keys($this->dic)[$cod_viejo].$caracter] = sizeof($this->dic);
            $cod_viejo = $cod_nuevo;
        }
        //echo "<br><br>";
        return $descomprimir;
    }

	public function getDic(){
		return $this->dic;
	}

	public function setDic($dic){
		$this->dic = $dic;
	}

}
