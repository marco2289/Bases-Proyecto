<?php
class Jefe{
	private $nombre;
    private $num;
    private $pass;
    private $facu;

	public function __construct(
		$nombre = null,
        $num = null,
        $pass = null,
		$facu = null
		
	){

		$this->nombre = $nombre;
        $this->num = $num;
        $this->pass = $pass;
        $this->facu = $facu;
        
		
	}

	public function __toString(){
		$var = "Jefe{"
		."nombre: ".$this->nombre." , "
        ."num: ".$this->num." , "
        ."pass: ".$this->pass." , "
		."facu: ".$this->facu;
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

    public static function obtenerJefes(){
        $archivo = fopen("../data/empleados/jefes.json", "r");
        $registros = array();
        while(($linea=fgets($archivo))){
            $registros[] = json_decode($linea, true);
        }
        return json_encode($registros);
	}
    


	public function guardarJefes(){
        $respuesta = array();
        if(isset($_POST["nombre"])){
            if(!file_exists("../data/empleados/jefes.json")){
                $archivo = fopen("../data/empleados/jefes.json", "w");
            }
            $archivo = fopen("../data/empleados/jefes.json", "a+");
           
            $registro["nombre"] = $this->nombre;
            $registro["num"] = $this->num;
			$registro["pass"] = $this->pass;
			$registro["facultad"] = $this->facu;
			

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