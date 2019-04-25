<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>Page Title</title>
    <link href="css/bootstrap.min.css" rel="stylesheet">
    <link href="css/login.css" rel="stylesheet">
    <style>
    @media only screen and (max-width: 992px) {
        #foto{
            display:none;/*Oculta imagen*/
        }
    }
</style>  
</head>
<body>
    <nav id="mainNav" class="navbar navbar-default navbar-fixed-top">
          <div class="container-fluid">
              <!--better mobile display -->
              <div class="navbar-header">
                  <button style="background-color:#478baa" type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1">
                      <a class="sr-only">Toggle navigation</a><i class="glyphicon glyphicon-align-justify"></i>
                  </button>
                 <a  href="landingpage.html" class="navbar-brand" style="margin-bottom: 20px;"><img id="foto" src="img/inicio/deezer.png" class="img-responsive" alt="" width="150px"></a>
              </div>
  
              
              <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
                  <ul class="nav navbar-nav navbar-right">
                     <li>
                        <a id="ofertas" onclick="location='ofertas.html'" >Ofertas</a>
                    </li>
                  <li>
                      <button onclick="location='#'" class="btn-registrar">  
                          Registrarse
                      </button>
                  </li>
                  <li>
                        <button  onclick="window.open('conectarse.php','_self')" class="btn-conectarse" >
                          Conectarse
                       </button>
  
                  </li>
                </ul>
              </div>
          </div>
      </nav>


      
      <main role="main" class="container">
        <div class="row">
            
            <div class="col-xl-6 col-lg-6 col-md-6 col-sm-12 col-12 d-none d-sm-block">
                <br><br><br><br><br><br><br>
              <div class="unlogged-container">
        <div class="unlogged-container-inner">
            <div class="unlogged-form-container">
                <h1 class="texto1">¿Qué quieres escuchar hoy?</h1>

  <div class="boton-sociales">
    <button  type="summit" class="btn btn-default btn-primary" style="width: 150px; height: 40px;float: center"><span style="float: left"><img src="img/facebook.svg" width="27" height="22">Facebook</span> </button>
      <button class="boton boton-rojo2" type="summit" ><span ><img src="img/googl.svg" width="30" height="20">Google</span></button>
      </div>

  <div class="login_form">
    <form class="unlogged-form" data-type="form-page">  
     <div  >
      <input type="email" id="txt-correo" class="inp"   placeholder="Correo Electronico" data-html="true"  data-toggle="popover" data-trigger="focus"  data-content="<h5 style='color:black'>Correo de la forma: Name@example.xxx</h5>" data-container="body" data-placement="right" >
      </div>

     <div  >
      <input type="password" id="txt-contrasena"   class="inp"  placeholder="Contraseña (6 caracteres mínimo)"  data-toggle="popover"  data-html="true" data-content="<h5 style='color:black'>-Usa [6-15] caracteres</h5>" data-placement="right" data-container="body" data-trigger="focus"  >
      </div>
      <div  >
        <input  type="text" id="txt-nombreu" class="inp"  placeholder="Nombre de usuario" data-toggle="popover" data-html="true" data-trigger="focus"   data-content="<h5 style='color:black'>-Usa [2-12] caracteres <br> -Puedes usar solo letras,numeros ej: a89,tyg87,jkj</h5>" data-container="body" data-placement="right">
        </div>
       
</form>
    <div  class="inform" >
        <select  id="slc-sexo" class="sexo">
          <option value="">Sexo</option> 
          <option value="1">Mujer</option>
          <option value="2">Hombre</option>
</select> 
        
          <select  class="edad" id="slc-edad" >
            <option value="">Edad</option> 
               <?php
                   for ($i=1; $i <100 ; $i++) { 
                     echo "<option value=".$i.">".$i."</option>";
                   }
               ?>
          </select><br>
        
          
   <button  id="btn-registro" class="btn btn-success" type="submit" style="color:rgb(255, 255, 255)">Registrarse</button>
   <div id="resultado">
           
           </div>
 
       </div>
        
                <div> <a  role="button"> <p class="recuperacion">Al hacer clic en "Registrarse",</p>
                  </a>
                  aceptas las Condiciones generales de uso.</div>
                </div>
              </div>
          </div>
                 </div>
                </div>

           <div class="container">
            <div id="foto" class="col-xl-6 col-lg-6 col-md-6 col-sm-12 col-12" style="
                 padding-left: 39% ">
            <img  src="img/inicio/chico.png" >
          </div>

        </div> <!-- /. -->
        

        
      </main>


      <section class="footer" style=" padding: 200px 80px 80px 80px">
      
        <div class="col-xl-4 col-lg-4 col-md-4 col-sm-12 col-12" id="prub">
        
          <a href="#" style="color: #fff"><img id="foto2" src="img/inicio/deeze2.png" class="img-responsive" alt="" ></a>  <br>
          <a href="#"> <img class="mb-4 rounded-circle" src="img/inicio/Facebok.png" style=" width: 14%"></a>
          <a href="#"> <img class="mb-4 rounded-circle" src="img/inicio/twi.png" style=" width: 14%">         </a>
          <a href="#"><img class="mb-4 rounded-circle" src="img/inicio/you.png" style=" width: 14%">    </a>
          <a href="#"><img class="mb-4 rounded-circle" src="img/inicio/inst.png" style=" width: 14%">    </a><br><br><br><br>
          
              
                          
          </div>      
      </div>

<br> <div class="col-xl-2 col-lg-2 col-md-2 col-sm-12 col-12" id="prub1">
        <a href="#" style="color: #03608a">DEEZER</a><br><br>
      <a href="#" style="color: #fff">Datos personales</a><br>
      <a href="#" style="color: #fff">Ofertas</a><br>
        <a href="#" style="color: #fff">Ventajas</a><br>
        <a href="#" style="color: #fff">Explorar</a><br>
        <a href="#" style="color: #fff">Dispositivos</a><br>
        <a href="#" style="color: #fff">Blog</a><br>
        <a href="#" style="color: #fff">Ayuda</a>          <br>  
          
                      
    
    </div>

    <div class="col-xl-2 col-lg-2 col-md-2 col-sm-12 col-12" id="prub2">
      <a href="#" style="color: #03608a">¿QUIÉN ERES?</a><br><br>
        <a href="#" style="color: #fff">Sellos y artistas</a><br>
        <a href="#" style="color: #fff">Desarrolladores</a><br>
        <a href="#" style="color: #fff">Prensa</a><br><br><br><br>
            
                 
           
  
  </div>
  
  <div class="col-xl-2 col-lg-2 col-md-2 col-sm-12 col-12" id="prub3">
    <a href="#" style="color: #03608a">¿QUIÉNES SOMOS?</a><br><br>
    <a href="#" style="color: #fff">Quiénes somos</a><br>
    <a href="#" style="color: #fff">Ofertas de empleo</a><br><br><br><br><br><br>
           
               

</div>
 <div class="col-xl-2 col-lg-2 col-md-2 col-sm-12 col-12" id="prub4">
  <a href="#" style="color: #03608a">LEGAL</a><br><br>
  <a href="#" style="color: #fff">Condiciones</a><br>
  <a href="#" style="color: #fff">Datos personales</a><br>
  <a href="#" style="color: #fff">Aviso legal</a><br>
  <a href="#" style="color: #fff">Ajustes de privacidad</a><br><br><br><br><br>
   
  <p id="p1">© 2019 Deezer</p>
    
    </div>
    
        
  </section>

 
      <script type="text/javascript" src="js/jquery.min.js"></script>

  <script src="js/bootstrap.min.js"></script>
  <script src="js/login.min.js"></script>
  <script src="js/validarRegistro.js"></script>
        <script type="text/javascript">
          $(function () {
    $('[data-toggle="popover"]').popover();
      });
        </script>

        
</body>

</html>