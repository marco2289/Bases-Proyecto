<?php
class Coordinador{
	private $nombre;
    private $num;
    private $pass;
    private $facu;
    private $carrera;

	public function __construct(
		$nombre = null,
        $num = null,
        $pass = null,
        $facu = null,
        $carrera = null
		
	){

		$this->nombre = $nombre;
        $this->num = $num;
        $this->pass = $pass;
        $this->facu = $facu;
        $this->carrera = $carrera;
        
		
	}

	public function __toString(){
		$var = "Coordinador{"
		."nombre: ".$this->nombre." , "
        ."num: ".$this->num." , "
        ."pass: ".$this->pass." , "
        ."facu: ".$this->facu." , "
		."carrera: ".$this->carrera;
		return $var."}";
	}

	public function getNombre(){
		return $this->nombre;
	}

	public function setNombre($nombre){
		$this->nombre = $nombre;
	}
	public function getFacu(){
		return $this->facu;
	}

	public function setFacu($facu){
		$this->facu = $facu;
	}

	public function getNum(){
		return $this->num;
	}

	public function setNum($num){
		$this->num = $num;
    }
    
    public function getPass(){
		return $this->pass;
	}

	public function setPass($pass){
		$this->pass = $pass;
	}

    public function getCarrera(){
		return $this->carrera;
	}

	public function setCarrera($carrera){
		$this->carrera = $carrera;
	}
	

    public static function obtenerCoordinador(){
        $archivo = fopen("../data/empleados/coordinadores.json", "r");
        $registros = array();
        while(($linea=fgets($archivo))){
            $registros[] = json_decode($linea, true);
        }
        return json_encode($registros);
	}
    


	public function guardarCoordinador(){
        $respuesta = array();
        if(isset($_POST["nombre"])){
            if(!file_exists("../data/empleados/coordinadores.json")){
                $archivo = fopen("../data/empleados/coordinadores.json", "w");
            }
            $archivo = fopen("../data/empleados/coordinadores.json", "a+");
           
            $registro["nombre"] = $this->nombre;
            $registro["num"] = $this->num;
			$registro["pass"] = $this->pass;
			$registro["facultad"] = $this->facu;
			$registro["carrera"] = $this->carrera;

            fwrite($archivo, json_encode($registro)."\n");
            fclose($archivo);

            $respuesta = $registro;
            $respuesta["cod"] = 1;
            echo json_encode($respuesta);
        }else{
            $respuesta["cod"] = 0;
            echo json_encode($respuesta);
           
        }

    }
}
?>