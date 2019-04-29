<?php
class Centro{
	private $nombre;
	private $ubicacion;

	public function __construct(
		$nombre = null,
		$ubicacion = null
	){

		$this->nombre = $nombre;
		$this->ubicacion = $ubicacion;
	
	}

	public function __toString(){
		$var = "Centro{"
		."nombre: ".$this->nombre." , "
		."ubicacion: ".$this->ubicacion;
		return $var."}";
	}

	public function getNombre(){
		return $this->nombre;
	}

	public function setNombre($nombre){
		$this->nombre = $nombre;
	}
	public function getUbicacion(){
		return $this->ubicacion;
	}

	public function setUbicacion($ubicacion){
		$this->ubicacion = $ubicacion;
	}

//Funcion estatica: se puede acceder sin crear una instancia
    public static function obtenerCentros(){
        $archivo = fopen("../data/centros.json", "r");
        $registros = array();
        while(($linea=fgets($archivo))){
            $registros[] = json_decode($linea, true);
        }
        return json_encode($registros);
	}
	
	public function guardarCentro(){
        $archivo = fopen("../data/centros.json","a+");
        $registro["centro"] = $this->nombre;
		$registro["lugar"] = $this->ubicacion;
		fwrite($archivo, json_encode($registro)."\n");
		fclose($archivo);
		return json_encode($registro);
    }
}
?>