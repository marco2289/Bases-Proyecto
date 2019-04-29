<?php
class Alumno{
    
	private $nombre;
    private $apellido;
    private $cuenta;
    private $id;
    private $pass;
    private $mail;
    private $facu;
    private $carrera;
    private $centro;

	public function __construct(
		$nombre = null,
        $apellido = null,
        $cuenta = null,
        $id = null,
        $pass = null,
        $mail = null,
        $facu = null,
        $carrera = null,
        $centro = null
		
	){

		$this->nombre = $nombre;
        $this->apellido = $apellido;
        $this->cuenta = $cuenta;
        $this->id = $id;
        $this->pass = $pass;
        $this->mail = $mail;
        $this->facu = $facu;
        $this->carrera = $carrera;
        $this->centro = $centro;
		
	}

	public function __toString(){
		$var = "Alumno{"
		."nombre: ".$this->nombre." , "
        ."apellido: ".$this->apellido." , "
        ."cuenta: ".$this->cuenta." , "
        ."id: ".$this->id." , "
        ."pass: ".$this->pass." , "
        ."mail: ".$this->mail." , "
        ."facu: ".$this->facu." , "
        ."carrera: ".$this->carrera." , "
        ."centro: ".$this->centro;
		return $var."}";
	}
///////
	public function getNombre(){
		return $this->nombre;
	}

	public function setNombre($nombre){
		$this->nombre = $nombre;
    }
///////   
    public function getApellido(){
		return $this->apellido;
	}

	public function setApellido($apellido){
		$this->apellido = $apellido;
	}
///////
    public function getCuenta(){
		return $this->cuenta;
	}

	public function setCuenta($cuenta){
		$this->cuenta = $cuenta;
    }
///////    
    public function getId(){
		return $this->id;
	}

	public function setId($id){
		$this->id = $id;
    }
///////   
    public function getPass(){
        return $this->pass;
    }

    public function setPass($pass){
        $this->pass = $pass;
    }
///////
    
    public function getMail(){
		return $this->mail;
	}

	public function setMail($mail){
		$this->mail = $mail;
    }
///////   
    public function getFacu(){
		return $this->facu;
	}

	public function setFacu($facu){
		$this->facu = $facu;
    }
///////    
    public function getCarrera(){
		return $this->carrera;
	}

	public function setCarrera($carrera){
		$this->carrera = $carrera;
    }
///////    
    public function getCentro(){
        return $this->centro;
    }

    public function setCentro($centro){
        $this->centro = $centro;
    }
//---------------------------------------funciones------------------------------------

    public static function obtenerAlumnos(){
        $archivo = fopen("../data/alumnos/alumnos.json", "r");
        $registros = array();
        while(($linea=fgets($archivo))){
            $registros[] = json_decode($linea, true);
        }
        return json_encode($registros);
	}
    


	public function guardarAlumnos(){
        $respuesta = array();
        if(isset($_POST["nombre"])){


            if(!file_exists("../data/alumnos/alumnos.json")){
                $archivo = fopen("../data/alumnos/alumnos.json", "w");
            }



             //obtener datos de la seccion/////////////
             $archivoCarrera = fopen("../data/carreras/".$_POST["facultad"]."/carreras.json","r");   
             while(($linea = fgets($archivoCarrera))){
                 $registroCarrera = json_decode($linea,true);
                 if($registroCarrera["carrera"] == $_POST["carrera"]){
                     //Obtener datos
                     $registroCod["codCarrera"] =$registroCarrera["codigo"];
                        if(!file_exists("../data/matricula/".$_POST["facultad"]."/".$registroCod["codCarrera"]."/".$_POST["cuenta"].".json")){
                            $archivo = fopen("../data/matricula/".$_POST["facultad"]."/".$registroCod["codCarrera"]."/".$_POST["cuenta"].".json", "w");
                        }
                     break;
                 }
             }
             fclose($archivoCarrera);

           ////////////////////////////////////////////

            $archivo = fopen("../data/alumnos/alumnos.json", "a+");
           
            $registro["nombre"] = $this->nombre;
            $registro["apellido"] = $this->apellido;
            $registro["cuenta"] = $this->cuenta;
            $registro["ID"] = $this->id;
            $registro["pass"] = $this->pass;
            $registro["correo"] = $this->mail;
            $registro["facultad"] = $this->facu;
            $registro["carrera"] = $this->carrera;
            $registro["centro"] = $this->centro;
            
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