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
                  <button style="background-color: #478baa" type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1">
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
                      <button  onclick="window.open('registro.php','_self')" class="btn-registrar">  
                        Registrarse
                      </button>
                  </li>
                  <li>
                        <button onclick="location='#'" class="btn-conectarse" >
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
    <div>
    <form class="unlogged-form" data-type="form-page">
       
           <div  class="unlogged-input-container">
          <input id="nombreu" class="inp"  type="text"  id="nombreu" placeholder="Correo Electronico" >
          </div>

          <div >
          <input class="inp"  type="password" id="contrasena" placeholder="Contraseña" ><br><br>
          </div>
    </form>
    </div>
    <center>
          <div id="resultado">
          </div>
    </center>
    <button  type="summit" id="btn-conectarse" class="btn btn-success"  style="color:rgb(255, 255, 255)">Conectarse</button>
  
     
       </div>
         <div ><a href="#"><p class="Conectardi">Conectarse con la dirección de email</p></a></div>
                    
                <div> <a  role="button"> <p class="recuperacion">¿Has olvidado tu contraseña?</p>
                  </a>
                  ¿Todavía no tienes una cuenta Deezer? <a  href="#">Registrarse</a></div>
                </div>
           </div>
          </div>
        </div>
     <div id="foto" class="col-xl-6 col-lg-6 col-md-6 col-sm-12 col-12" style="padding-left: 39%">
                   <img src="img/inicio/chica.png" >
        </div>
      
  </div> <!-- /. --->
              
        
  </main>


      
      <section class="footer" style=" padding: 200px 80px 200px 80px">
      
        <div class="col-xl-4 col-lg-4 col-md-4 col-sm-12 col-12" id="prub">
        
          <a href="#" style="color: #fff"><img id="foto2" src="img/inicio/deeze2.png" class="img-responsive" alt="" ></a>  <br><br>
          <a href="#"> <img class="mb-4 rounded-circle" src="img/face.png" style=" width: 14%"></a>
          <a href="#"> <img class="mb-4 rounded-circle" src="img/inicio/twi.png" style=" width: 14%">         </a>
          <a href="#"><img class="mb-4 rounded-circle" src="img/inicio/you.png" style=" width: 14%">    </a>
          <a href="#"><img class="mb-4 rounded-circle" src="img/inicio/inst.png" style=" width: 14%">    </a><br><br><br><br>
          
              
                          
          </div>      
      </div>

      <div class="col-xl-2 col-lg-2 col-md-2 col-sm-12 col-12" id="prub1" >
        <ul class="list-group list-group-flush" id="lst1">
          <li id = "lst1" class="list-group-item " style="color:mediumturquoise ">DEEZER</li>
          <li id = "lst1"class="list-group-item "data-toggle="list">Ofertas</li>
          <li id = "lst1"class="list-group-item">Ventajas</li>
          <li id = "lst1"class="list-group-item">Explorador de canales</li>
          <li id = "lst1"class="list-group-item">Dispositivos</li>
          <li id = "lst1"class="list-group-item">Blogs</li>
        </ul>
      </div>
          <div class="col-xl-2 col-lg-2 col-md-2 col-sm-12 col-12" id="prub2">
            <ul id = "lst1"class="list-group list-group-flush">
              <li id = "lst1"class="list-group-item"style="color:mediumturquoise ">¿QUIEN ERES?</li>
              <li id = "lst1"class="list-group-item">Sellos y artistas</li>
              <li id = "lst1"class="list-group-item">Desarrolladores</li>
              <li id = "lst1"class="list-group-item">Prensa</li>
            </ul>
      
        </div>
        
        <div class="col-xl-2 col-lg-2 col-md-2 col-sm-12 col-12" id="prub3">
          <ul class="list-group list-group-flush">
            <li id = "lst1"class="list-group-item"style="color:mediumturquoise ">¿QUIENES SOMOS?</li>
            <li id = "lst1"class="list-group-item">Quienes somos</li>
            <li id = "lst1"class="list-group-item">Desarrolladores</li>
            <li id = "lst1"class="list-group-item"></li>
          </ul>
      </div>
       <div class="col-xl-2 col-lg-2 col-md-2 col-sm-12 col-12" id="prub4">
        <ul id = "lst"class="list-group list-group-flush">
          <li id = "lst"class="list-group-item"style="color:mediumturquoise ">LEGAL</li>
          <li id = "lst"class="list-group-item">Condiciones generales de uso</li>
          <li id = "lst"class="list-group-item">Datos personales y cookies</li>
          <li id = "lst"class="list-group-item">Contacto: privacy@deezer.com</li>
          <li id = "lst"class="list-group-item">Aviso legal</li>
          <li id = "lst"class="list-group-item">Ajustes de privacidad</li>
        </ul>
         
        <p id="p1">© 2019 Deezer</p>
          
          </div>
    
    </div>
    
        
  </section>
  <script type="text/javascript" src="js/jquery.min.js"></script>

  <script src="js/bootstrap.min.js"></script>
  <script src="js/login.min.js"></script>
  <script src="js/login.js"></script>
  <script type="text/javascript">
    $(function () {
$('[data-toggle="popover"]').popover();
});
  </script>
</body>

</html>