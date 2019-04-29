<?php
 include("../class/class-clases.php");
	class Seccion{

		private $codCarrera;
        private $codClase;
        private $seccion;
		private $aula;
		private $cupos;
		private $HI;
		private $HF;
		private $dias;
		private $edificio;
		private $docente;

		public function __construct(
                    $codCarrera = null,
                    $codClase = null,
                    $seccion = null,
					$aula = null,
					$cupos = null,
					$HI = null,
					$HF = null,
					$dias = null,
					$edificio = null,
                    $docente = null
        ){
			$this->codCarrera = $codCarrera;
            $this->codClase = $codClase;
            $this->seccion = $seccion;
			$this->aula = $aula;
			$this->cupos = $cupos;
			$this->HI = $HI;
			$this->HF = $HF;
			$this->dias = $dias;
			$this->edificio = $edificio;
			$this->docente = $docente;
        }
        
        public function toString(){
			return "CodCarrera: " . $this->codCarrera . 
                " CodClase: " . $this->codClase . 
                " Seccion: " . $this->seccion.
				" Aula: " . $this->aula . 
				" Cupos: " . $this->cupos . 
				" HI: " . $this->HI . 
				" HF: " . $this->HF . 
				" Dias: " . $this->dias . 
				" Edificio: " . $this->edificio . 
				" Docente: " . $this->docente;
		}



		public function getCodCarrera(){
			return $this->codCarrera;
		}
		public function setCodCarrera($codCarrera){
			$this->codCarrera = $codCarrera;
		}
		public function getCodClase(){
			return $this->codClase;
		}
		public function setCodClase($codClase){
			$this->codClase = $codClase;
        }
        public function getSeccion(){
			return $this->seccion;
		}
		public function setSeccion($seccion){
			$this->seccion = $seccion;
		}
      
		public function getAula(){
			return $this->aula;
		}
		public function setAula($aula){
			$this->aula = $aula;
		}
		public function getCupos(){
			return $this->cupos;
		}
		public function setCupos($cupos){
			$this->cupos = $cupos;
		}
		public function getHI(){
			return $this->HI;
		}
		public function setHI($HI){
			$this->HI = $HI;
		}
		public function getHF(){
			return $this->HF;
		}
		public function setHF($HF){
			$this->HF = $HF;
		}
		public function getDias(){
			return $this->dias;
		}
		public function setDias($dias){
			$this->dias = $dias;
		}
		public function getEdificio(){
			return $this->edificio;
		}
		public function setEdificio($edificio){
			$this->edificio = $edificio;
		}
		public function getDocente(){
			return $this->docente;
		}
		public function setDocente($docente){
			$this->docente = $docente;
		}
        
        public static function obtenerSecciones($facultad, $codCarrera, $codClase){	
            $archivo = fopen("../data/carreras/".$facultad."/asignaturas/secciones/".$codCarrera."-".$codClase.".json", "r");
            $registros = array();
            while(($linea=fgets($archivo))){
                $registros[] = json_decode($linea,true);
            }
            return json_encode($registros);
        }
    
    
         public function guardarSecciones(){
            $respuesta = array();
            if(isset($_POST["seccion"])){
                if(!file_exists("../data/carreras/".$_POST["facultad"]."/asignaturas/secciones/".$_POST["codCarrera"]."-".$_POST["codClase"].".json")){
                    $archivo = fopen("../data/carreras/".$_POST["facultad"]."/asignaturas/secciones/".$_POST["codCarrera"]."-".$_POST["codClase"].".json", "w");
                }
                $archivo = fopen("../data/carreras/".$_POST["facultad"]."/asignaturas/secciones/".$_POST["codCarrera"]."-".$_POST["codClase"].".json", "a+");
    

                $registro["codCarrera"] = $this->codCarrera;
                $registro["codClase"] = $this->codClase;
                $registro["seccion"] = $this->seccion;

                //obtener el numero de UV de la clase/////////////
                        $archivoClases = fopen("../data/carreras/".$_POST["facultad"]."/asignaturas/".$_POST["codCarrera"].".json","r");   
                        while(($linea = fgets($archivoClases))){
                            $registroClase = json_decode($linea,true);
                            if($registroClase["codigo"] == $_POST["codClase"]){
                                //Obtener uv de clase
               					 $registro["UV"] =$registroClase["uv"];
                                break;
                            }
                        }
                        fclose($archivoClases);
                /////////////////////////////////////////

                $registro["aula"] = $this->aula;
                $registro["cupos"] = $this->cupos;
                $registro["inicio"] = $this->HI;
                $registro["final"] = $this->HF;
                $registro["dias"] = $this->dias;
                $registro["edificio"] = $this->edificio;
                $registro["docente"] = $this->docente;
        
              //obtener el nombre de la clase/////////////

                        $archivoClases = fopen("../data/carreras/".$_POST["facultad"]."/asignaturas/".$_POST["codCarrera"].".json","r");   
                        while(($linea = fgets($archivoClases))){
                            $registroClase = json_decode($linea,true);
                            if($registroClase["codigo"] == $_POST["codClase"]){
                                //Obtener nombre de clase
                $registro["clase"] =$registroClase["clase"];
                                break;
                            }
                        }
                        fclose($archivoClases);
                /////////////////////////////////////////

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