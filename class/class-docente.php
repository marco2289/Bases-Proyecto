<?php
class Docente{
	private $nombre;
    private $num;
    private $pass;

	public function __construct(
		$nombre = null,
        $num = null,
        $pass = null
		
	){

		$this->nombre = $nombre;
        $this->num = $num;
        $this->pass = $pass;
        
		
	}

	public function __toString(){
		$var = "Docente{"
		."nombre: ".$this->nombre." , "
        ."num: ".$this->num." , "
        ."pass: ".$this->pass;
		return $var."}";
	}

	public function getNombre(){
		return $this->nombre;
	}

	public function setNombre($nombre){
		$this->nombre = $nombre;
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

    public static function obtenerDocentes(){
        $archivo = fopen("../data/empleados/docentes.json", "r");
        $registros = array();
        while(($linea=fgets($archivo))){
            $registros[] = json_decode($linea, true);
        }
        return json_encode($registros);
	}
    


	public function guardarDocentes(){
        $respuesta = array();
        if(isset($_POST["nombre"])){
            if(!file_exists("../data/empleados/docentes.json")){
                $archivo = fopen("../data/empleados/docentes.json", "w");
            }
            $archivo = fopen("../data/empleados/docentes.json", "a+");
           
            $registro["nombre"] = $this->nombre;
            $registro["num"] = $this->num;
			$registro["pass"] = $this->pass;
			

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