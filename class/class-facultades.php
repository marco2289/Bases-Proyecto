<?php
class Facultad{
	private $nombre;
	private $abreviatura;

	public function __construct(
		$nombre = null,
		$abreviatura = null
	){

		$this->nombre = $nombre;
		$this->abreviatura = $abreviatura;
	
	}

	public function __toString(){
		$var = "Facultad{"
		."nombre: ".$this->nombre." , "
		."abreviatura: ".$this->abreviatura;
		return $var."}";
	}

	public function getNombre(){
		return $this->nombre;
	}

	public function setNombre($nombre){
		$this->nombre = $nombre;
	}
	public function getAbreviatura(){
		return $this->abreviatura;
	}

	public function setAbreviatura($abreviatura){
		$this->abreviatura = $abreviatura;
	}

	//Funcion estatica: se puede acceder sin crear una instancia
    public static function obtenerFacultades(){
        $archivo = fopen("../data/facultades.json", "r");
        $registros = array();
        while(($linea=fgets($archivo))){
            $registros[] = json_decode($linea, true);
        }
        return json_encode($registros);
    }
}
?>