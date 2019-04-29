<?php 
	class Matricula{

		private $codCarrera;
        private $codClase;
        private $seccion;

		public function __construct(
                    $codCarrera = null,
                    $codClase = null,
                    $seccion = null
        ){
			$this->codCarrera = $codCarrera;
            $this->codClase = $codClase;
            $this->seccion = $seccion;
        }
        
        public function toString(){
			return "CodCarrera: " . $this->codCarrera . 
                " CodClase: " . $this->codClase . 
                " Seccion: " . $this->seccion;
			
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
    
    
         public function guardarMatricula(){
            $respuesta = array();
     
                
           if(!file_exists("../data/matricula/".$_POST["facultad"]."/".$_POST["codCarrera"]."/".$_POST["cuenta"].".json")){
                    $archivo = fopen("../data/matricula/".$_POST["facultad"]."/".$_POST["codCarrera"]."/".$_POST["cuenta"].".json", "w");
           }
                $archivo = fopen("../data/matricula/".$_POST["facultad"]."/".$_POST["codCarrera"]."/".$_POST["cuenta"].".json", "a+");
    
                //obtener datos de la seccion/////////////
                        $archivoSeccion = fopen("../data/carreras/".$_POST["facultad"]."/asignaturas/secciones/".$_POST["codCarrera"]."-".$_POST["codClase"].".json","r");   
                        while(($linea = fgets($archivoSeccion))){
                            $registroSeccion = json_decode($linea,true);
                            if($registroSeccion["seccion"] == $_POST["seccion"]){
                                //Obtener datos
                                 $registro["codCarrera"] =$registroSeccion["codCarrera"];
                                 $registro["codClase"] =$registroSeccion["codClase"];
                                 $registro["uv"] =$registroSeccion["uv"];
                                 $registro["clase"] =$registroSeccion["clase"];
                                 $registro["seccion"] =$registroSeccion["seccion"];
                                 $registro["inicio"] =$registroSeccion["inicio"];
                                 $registro["final"] =$registroSeccion["final"];
                                 $registro["dias"] =$registroSeccion["dias"];
                                 $registro["edificio"] =$registroSeccion["edificio"];
                                 $registro["aula"] =$registroSeccion["aula"]; 

                                break;
                            }
                        }
                        fclose($archivoSeccion);

                fwrite($archivo, json_encode($_POST)."\n");
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
