<?php
class Clase{
	private $nombre;
    private $codigo;
    private $uv;
    private $carrera;
	private $facu;
	
    

	public function __construct(
		$nombre = null,
        $codigo = null,
        $uv = null,
        $carrera = null,
        $facu = null
        
		
	){

		$this->nombre = $nombre;
        $this->codigo = $codigo;
        $this->uv = $uv;
        $this->carrera = $carrera;
        $this->facu = $facu;
        
		
	}

	public function __toString(){
		$var = "Clase{"
		."nombre: ".$this->nombre." , "
        ."codigo: ".$this->codigo." , "
        ."uv: ".$this->uv." , "
        ."carrera:".$this->carrera." , "
		."facu:".$this->facu;
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

	public function getCodigo(){
		return $this->codigo;
	}

	public function setCodigo($codigo){
		$this->codigo = $codigo;
    }
    
    public function getCarrera(){
		return $this->carrera;
	}

	public function setCarrera($carrera){
		$this->carrera = $carrera;
	}

    public function getUv(){
		return $this->uv;
	}

	public function setUv($uv){
		$this->uv = $uv;
	}

	public static function obtenerClases(){	
		$archivo = fopen("../data/carreras/".$_GET["facultad"]."/asignaturas/".$_GET["carrera"].".json", "r");
		$registros = array();
		while(($linea=fgets($archivo))){
			$registros[] = json_decode($linea,true);
		}
		return json_encode($registros);
	}



 	public function guardarClase(){
        $respuesta = array();
        if(isset($_POST["clase"])){
			if(!file_exists("../data/carreras/".$_POST["facultad"]."/asignaturas/".$_POST["carrera"].".json")){
				$archivo = fopen("../data/carreras/".$_POST["facultad"]."/asignaturas/".$_POST["carrera"].".json", "w");
			}
			$archivo = fopen("../data/carreras/".$_POST["facultad"]."/asignaturas/".$_POST["carrera"].".json", "a+");

			$registro["clase"] = $this->nombre;
            $registro["codigo"] = $this->codigo;
            $registro["uv"] = $this->uv;
            $registro["carrera"] = $this->carrera;
            $registro["facultad"] = $this->facu;
            
			

            fwrite($archivo, json_encode($registro)."\n");
            fclose($archivo);

            $respuesta = $registro;
            $respuesta["num"] = 1;
            echo json_encode($respuesta);
        }else{
            $respuesta["num"] = 0;
            echo json_encode($respuesta);
           
        }
    }
}
?>