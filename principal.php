<?php
session_start();
include ("class/class-conexion.php");
$conexion = new Conexion();
$conexion->establecerConexion();
$paylist=$conexion->ejecutarInstruccion("SELECT ROWNUM,A.CODIGO_PLAYLIST,A.NOMBRE_PLAYLIST,A.DESCRIPCION_PLAYLIST,A.NUMERO_SEGUIDORES,A.COVER
FROM TBL_PLAYLIST A
LEFT JOIN (SELECT A.CODIGO_PLAYLIST,A.NOMBRE_PLAYLIST,A.DESCRIPCION_PLAYLIST,A.NUMERO_SEGUIDORES,A.COVER
FROM TBL_PLAYLIST A
INNER JOIN(SELECT CODIGO_SEGUIDOR,CODIGO_PLAYLIST
FROM TBL_SEGUIDORES_PLAYLIST
WHERE CODIGO_SEGUIDOR = ".$_SESSION['codigo_usuario'].") B
ON(A.CODIGO_PLAYLIST=B.CODIGO_PLAYLIST)) B
ON(A.CODIGO_PLAYLIST=B.CODIGO_PLAYLIST)
WHERE B.CODIGO_PLAYLIST IS NULL");

$albums=$conexion->ejecutarInstruccion("SELECT ROWNUM,B.*
FROM (SELECT B.CODIGO_ALBUM
FROM (SELECT CODIGO_ALBUM
FROM TBL_SEGUIDORES_ALBUM
WHERE CODIGO_USUARIO=".$_SESSION['codigo_usuario'].") A
FULL OUTER JOIN(SELECT CODIGO_ALBUM
FROM TBL_SEGUIDORES_ALBUM
GROUP BY CODIGO_ALBUM) B
ON(A.CODIGO_ALBUM=B.CODIGO_ALBUM)
WHERE A.CODIGO_ALBUM IS NULL OR B.CODIGO_ALBUM IS NULL) A
LEFT JOIN (SELECT A.CODIGO_ALBUM,A.NOMBRE_ALBUM,NVL(B.NOMBRE_ARTISTAS,' ') AS NOMBRE_ARTISTAS,A.COVER,A.DESCRIPCION
FROM TBL_ALBUMES A
LEFT JOIN (SELECT A.CODIGO_ALBUM,LISTAGG(NOMBRE_ARTISTICO, ', ') WITHIN GROUP (ORDER BY A.CODIGO_ALBUM) over (partition by A.CODIGO_ALBUM) NOMBRE_ARTISTAS
FROM TBL_ALBUMES_X_ARTISTAS A
LEFT JOIN TBL_ARTISTAS B
ON(A.CODIGO_ARTISTA=B.CODIGO_ARTISTA)) B
ON(A.CODIGO_ALBUM=B.CODIGO_ALBUM)
GROUP BY A.CODIGO_ALBUM,A.NOMBRE_ALBUM,A.DESCRIPCION,B.NOMBRE_ARTISTAS,A.COVER) B
ON(A.CODIGO_ALBUM=B.CODIGO_ALBUM)");

$artistas=$conexion->ejecutarInstruccion("SELECT ROWNUM,A.*
FROM (SELECT A.CODIGO_ARTISTA,A.NOMBRE_ARTISTICO,A.COVER,NVL(C.SEGUIDORES,0) AS SEGUIDORES
FROM TBL_ARTISTAS A
LEFT JOIN (SELECT CODIGO_ARTISTA,COUNT(1) AS SEGUIDORES
FROM TBL_SEGUIDORES_ARTISTA
GROUP BY CODIGO_ARTISTA) C
ON(A.CODIGO_ARTISTA = C.CODIGO_ARTISTA)) A
LEFT JOIN (SELECT CODIGO_ARTISTA
FROM TBL_SEGUIDORES_ARTISTA
WHERE CODIGO_USUARIO=".$_SESSION['codigo_usuario'].") B
ON(A.CODIGO_ARTISTA=B.CODIGO_ARTISTA)
WHERE B.CODIGO_ARTISTA IS NULL");

function cortar($text){ 
    
     if ((strlen($text)>30)) {
      echo substr($text, 0, 30)."..."; 
     }else{
      echo $text;
     }
  
   }
?>

<!DOCTYPE html>
<html>
<head>
    <title>Inicio</title>
    <meta charset="utf-8">
    <link href="css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" type="text/css" href="css/principal.css">
    <link rel="stylesheet" type="text/css" href="css/perfil.css">
    <link rel="stylesheet" type="text/css" href="fantastic/css/font-awesome.min.css">
    <link rel="stylesheet" type="text/css" href="css/slider.css">
    <style type="text/css">
    
    body{
    height: 100%;
    margin: 0;
    padding: 0;
    overflow-x: hidden; 
  }
    .thumbnail .action-item-btn {
      -webkit-align-items: center;
      -ms-flex-align: center;
      align-items: center;
      background-color: rgba(0,0,0,.75);
      -webkit-box-shadow: 0 3px 2px 0 rgba(0,0,0,.21);
      box-shadow: 0 3px 2px 0 rgba(0,0,0,.21);
      border-radius: 50%;
      color: #fff;
      cursor: pointer;
      display: -webkit-flex;
      display: -ms-flexbox;
      display: flex;
      font-size: 12px;
      height: 36px;
      -webkit-justify-content: center;
      -ms-flex-pack: center;
      justify-content: center;
      line-height: 36px;
      opacity: 0;
      position: relative;
      text-align: center;
      width: 36px;
      -webkit-transition-duration: .15s;
      transition-duration: .15s;
      -webkit-transition-property: opacity,-webkit-transform;
      transition-property: opacity,-webkit-transform;
      transition-property: opacity,transform;
      transition-property: opacity,transform,-webkit-transform;
  }
  button, input[type=button], input[type=checkbox], input[type=radio], input[type=reset], input[type=submit], label {
      cursor: pointer;
  }
  button, html input[type=button], input[type=reset], input[type=submit] {
      -webkit-appearance: button;
      cursor: pointer;
  }
  button, input {
      line-height: normal;
  }
  button, input, select, textarea {
      font: inherit;
      margin: 0;
      outline: 0;
      vertical-align: middle;
  }
  button {
      background: rgba(0,0,0,0);
      border: 0;
      color: currentColor;
      overflow: visible;
      padding: 0;
  }
  button, select {
      text-transform: none;
  }
  button, input {
      overflow: visible;
  }
  button, input, optgroup, select, textarea {
      font: inherit;
      margin: 0;
  }
  button {
      background-color: rgba(0,0,0,0);
      border-radius: 0;
      color: inherit;
      cursor: pointer;
      line-height: normal;
      margin: 0;
      outline: none;
      text-decoration: none;
      -webkit-user-select: none;
      -moz-user-select: none;
      -ms-user-select: none;
      user-select: none;
      -webkit-appearance: button;
      -webkit-tap-highlight-color: transparent;
  }
  *, :after, :before {
      -webkit-box-sizing: border-box;
      box-sizing: border-box;
  }
  user agent stylesheet
  button {
      padding: 1px 6px;
  }
  user agent stylesheet
  button {
      align-items: flex-start;
      text-align: center;
      cursor: default;
      color: buttontext;
      background-color: buttonface;
      box-sizing: border-box;
      padding: 2px 6px 3px;
      border-width: 2px;
      border-style: outset;
      border-color: buttonface;
      border-image: initial;
  }
  user agent stylesheet
  button {
      text-rendering: auto;
      color: initial;
      letter-spacing: normal;
      word-spacing: normal;
      text-transform: none;
      text-indent: 0px;
      text-shadow: none;
      display: inline-block;
      text-align: start;
      margin: 0em;
      font: 400 13.3333px Arial;
  }
  user agent stylesheet
  button {
      -webkit-writing-mode: horizontal-tb !important;
  }
  user agent stylesheet
  button {
      -webkit-appearance: button;
  }
  dd, dl, dt, li, ol, ul {
      list-style: none;
      margin: 0;
      padding: 0;
  }
  user agent stylesheet
  li {
      text-align: -webkit-match-parent;
  }
  .thumbnail .action {
      bottom: 16px;
      left: 15px;
      line-height: 1;
      position: absolute;
      white-space: nowrap;
      z-index: 4;
      -webkit-transition-duration: .15s;
      transition-duration: .15s;
      -webkit-transition-property: opacity;
      transition-property: opacity;
  }
  ol, ul {
      list-style: none;
      margin: 0;
      padding: 0;
  }
  user agent stylesheet
  ul ul {
      list-style-type: circle;
  }
  user agent stylesheet
  ul {
      list-style-type: disc;
  }
  user agent stylesheet
  li {
      text-align: -webkit-match-parent;
  }
  user agent stylesheet
  ul {
      list-style-type: disc;
  }
  .dir-ltr {
      direction: ltr;
  }
  body {
      background-color: #fff;
      color: #72727d;
      font-family: Open Sans,Arial,sans-serif;
      font-size: 12px;
      line-height: 1.33333333;
      margin: 0;
      padding: 0;
  }
  body {
      font-family: inherit;
  }
  html {
      font-size: 100%;
      -ms-text-size-adjust: 100%;
      -webkit-text-size-adjust: 100%;
  }
  html {
      font-family: Open Sans,Arial,sans-serif;
  }
  user agent stylesheet
  html {
      color: -internal-root-color;
  }
  *, :after, :before {
      -webkit-box-sizing: border-box;
      box-sizing: border-box;
  }
  *, :after, :before {
      -webkit-box-sizing: border-box;
      box-sizing: border-box;
  }



  .carousel-controls {
      position: absolute;
      right: 0;
      top: 20%;
      -webkit-transform: translateY(-50%);
      -ms-transform: translateY(-50%);
      transform: translateY(-50%);
  }
  *, :after, :before {
      -webkit-box-sizing: border-box;
      box-sizing: border-box;
  }
  user agent stylesheet
  div {
      display: block;
  }
  .dir-ltr {
      direction: ltr;
  }
  body {
      background-color: #fff;
      color: #72727d;
      font-family: Open Sans,Arial,sans-serif;
      font-size: 12px;
      line-height: 1.33333333;
      margin: 0;
      padding: 0;
  }
  body {
      font-family: inherit;
  }
  html {
      font-size: 100%;
      -ms-text-size-adjust: 100%;
      -webkit-text-size-adjust: 100%;
  }
  html {
      font-family: Open Sans,Arial,sans-serif;
  }
  user agent stylesheet
  html {
      color: -internal-root-color;
  }
  *, :after, :before {
      -webkit-box-sizing: border-box;
      box-sizing: border-box;
  }
  *, :after, :before {
      -webkit-box-sizing: border-box;
      box-sizing: border-box;
  }

  :after, :before {
      -webkit-box-sizing: border-box;
      box-sizing: border-box;
  }

  div {
      display: block;
  }
  dd, dl, dt, li, ol, ul {
      list-style: none;
      margin: 0;
      padding: 0;
  }

  li {
      text-align: -webkit-match-parent;
  }
  .thumbnail .action {
      bottom: 16px;
      left: 15px;
      line-height: 1;
      position: absolute;
      white-space: nowrap;
      z-index: 4;
      -webkit-transition-duration: .15s;
      transition-duration: .15s;
      -webkit-transition-property: opacity;
      transition-property: opacity;
  }
  ol, ul {
      list-style: none;
      margin: 0;
      padding: 0;
  }

  ul ul {
      list-style-type: circle;
  }

  ul {
      list-style-type: disc;
  }

  li {
      text-align: -webkit-match-parent;
  }

  ul {
      list-style-type: disc;
  }
  .dir-ltr {
      direction: ltr;
  }


  .page-topbar {
    -webkit-align-items: center;
    -ms-flex-align: center;
    align-items: center;
    -webkit-app-region: drag;
    background-color: #fff;
    -webkit-box-shadow: 0 1px 12px 0 rgba(25,25,34,.12);
    box-shadow: 0 1px 12px 0 rgba(25,25,34,.12);
    display: -webkit-flex;
    display: -ms-flexbox;
    display: flex;
    height: 56px;
    left: 0px;
    min-width: 770px;
    padding: 0 24px;
    position: fixed;
    right: 0;
    top: 0;
    z-index: 200;
}
  

  
  </style>
</head>
<body>
  <div class="page-topbar" id="page_topbar" ><div class="topbar-search"><div class="popper-wrapper"><form class="topbar-search-form" autocomplete="off"><label class="sr-only" for="topbar-search">Buscar</label><input class="topbar-search-input" id="topbar-search" type="search" placeholder="Buscar" value=""><button class="topbar-search-clear" type="button"><svg class="svg-icon svg-icon-cancel topbar-search-icon" focusable="false" height="12" width="12" viewBox="0 0 12 12" aria-hidden="true">
  <path d="M1.75 10.25l8.5-8.5m.002 8.505L1.75 1.75" fill="none" fill-rule="evenodd" stroke-linecap="round" stroke-width="1.5"></path></svg></button><button class="topbar-search-submit" type="submit"><svg class="svg-icon svg-icon-search topbar-search-icon" focusable="false" height="16" width="16" viewBox="0 0 12 12" aria-hidden="true"><path d="M9.827 8.584l1.95 1.951a.879.879 0 0 1-1.242 1.242l-1.95-1.95c-2.137 1.55-5.12 1.383-7.02-.517-2.108-2.108-2.083-5.55.055-7.69C3.76-.518 7.202-.543 9.31 1.565c1.9 1.9 2.067 4.883.517 7.02zm-1.256-.013c1.721-1.72 1.741-4.49.045-6.187C6.92.688 4.15.708 2.429 2.43.708 4.149.688 6.919 2.384 8.616c1.696 1.696 4.466 1.676 6.187-.045z"></path></svg></button></form><div class="popper" style="display: none;"></div></div></div><div class="popper-wrapper topbar-action"><button class="topbar-notification" type="button"><svg class="svg-icon svg-icon-bell" focusable="false" height="18" width="18" viewBox="0 0 12 12" aria-hidden="true"><path d="M6.003 0C6.513 0 7.029 0 7 1c1.569.196 2.992 1.677 3 3.5.009 1.957.16 3.293.856 3.854.091.073.144.183.144.3v.961a.385.385 0 0 1-.385.385h-9.23A.385.385 0 0 1 1 9.615v-.961c0-.117.053-.227.144-.3.697-.56.847-1.897.856-3.854.009-1.99 1.23-3.342 2.999-3.5-.015-1 .494-1 1.004-1zM5 11.328L8 11l-.175.283c-.29.472-.733.717-1.305.717-.55 0-.982-.144-1.28-.437L5 11.328z"></path></svg></button>
  <div class="popper" style="display: none;"><div class="popper-arrow"></div></div></div><div class="popper-wrapper topbar-action"><button class="topbar-profile" type="button"><img class="topbar-profile-picture" src="img-slider/32x32-000000-80-0-0.jpg" alt="User"></button><div class="popper" style="display: none;"><div class="popper-arrow"></div></div></div></div><br><br><br><br>


  <div class="container"><div class="carousel-wrapper"><div class="carousel-inner" style="transform: translateX(0px);"><ul class="thumbnail-grid thumbnail-grid-responsive thumbnail-grid-one-line"><figure class="thumbnail-col-slide thumbnail-col slide slide-cut is-link"><div class="slide-background"><div class="slide-covers"><img class="slide-img active" src="img-slider/358x358-000000-80-0-0 (1).jpg" alt="Dedicated content cover"><img class="slide-img" src="img-slider/maluma.jpg" alt="Dedicated content cover"><img class="slide-img" src="img-slider/358x358-000000-80-0-0 (2).jpg" alt="Dedicated content cover"><img class="slide-img" src="img-slider/358x358-000000-80-0-0 (3).jpg" alt="Dedicated content cover"><img class="slide-img" src="img-slider/358x358-000000-80-0-0 (4).jpg" alt="Dedicated content cover"></div></div><div class="slide-foreground"><ul class="slide-play-icon"><li class="action-item"><button class="action-item-btn" type="button" aria-label="Pausa"><span><span class="glyphicon glyphicon-play app" style="color: #fff; left:17px; top:-5px;" aria-hidden="true"></span><span class="play-icon play-hover"><span class="icon icon-pause"></span></span><span class="play-icon play-active"><span class="equalizer equalizer-12 equalizer-inverse"></span></span></span></button></li></ul><div class="slide-text"><div class="flow-logo"><svg class="flow-logo-svg" viewBox="0 0 90 30" width="5em" height="2em"><desc>FLOW</desc><path fill="#32323D" fill-rule="evenodd" d="M0 29.25h1.25V0H0v29.25m3.442 0h1.26V0h-1.26v29.25m-1.692 0h1.26V0H1.75v29.25m3.43.038h1.26v-9.756h6.49v-1.268H6.44v-.468h6.49v-1.268H6.44v-.468h6.49V14.79H6.44v-.468h6.49v-1.268H6.44v-6.54h9.786v22.773h1.26V.038H5.18v29.25M6.44 2.207h9.787v-.9H6.44v.9m0 1.736h9.786v-.9H6.44v.9m0 1.737h9.786v-.9H6.44v.9zm13.237 23.608h1.26V.038h-1.26v29.25zm-1.725 0V.038h1.26v29.25h-1.26zM50.246.052h1.311l8.359 29.225h-1.312L54.996 16.66l-.036.245-.036.231c-.026.175-.053.357-.095.548l-.217.86c-.44 1.568-1.045 2.917-1.851 4.128a14.86 14.86 0 0 1-4.082 4.15 14.732 14.732 0 0 1-6.444 2.373 3 3 0 0 1-.376.036l-1.24.062c-.063.001-.116-.003-.17-.005l-.271-.012H22.733l-.198.017h-1.062V.044h1.26V22.8H28.5c-.01-.017-.022-.033-.033-.05a15.474 15.474 0 0 1-1.807-3.855c-.389-1.304-.6-2.73-.627-4.245.028-1.52.238-2.948.626-4.248a15.472 15.472 0 0 1 1.806-3.856 15.517 15.517 0 0 1 2.775-3.121c.185-.158.381-.305.57-.446.082-.06.163-.121.243-.183l.12-.09c.098-.072.195-.145.295-.215l.438-.272c.093-.055.181-.11.27-.164.196-.122.398-.247.61-.354l.9-.437C36.061.673 37.3.316 38.48.167c.507-.096 1.025-.12 1.526-.141.122-.006.243-.011.363-.018l.08-.003c.055-.003.11-.005.163-.005l1.246.061c.127.007.257.014.39.038a14.715 14.715 0 0 1 6.431 2.37 14.577 14.577 0 0 1 3.047 2.755L50.245.052zm-9.55 27.53h-.014c-.05 0-.095-.003-.14-.005l-.067-.003c-.13-.008-.254-.013-.38-.019-.424-.019-.863-.039-1.302-.124-1.008-.124-2.1-.439-3.321-.96l-.798-.386c-.184-.093-.356-.2-.523-.303-.083-.052-.167-.104-.251-.154l-.382-.235c-.094-.066-.176-.127-.258-.189l-.114-.086c-.08-.062-.16-.12-.238-.179-.16-.119-.326-.242-.483-.377a13.79 13.79 0 0 1-2.444-2.749 13.75 13.75 0 0 1-1.593-3.396c-.339-1.14-.524-2.398-.553-3.742.029-1.352.214-2.61.552-3.746a13.754 13.754 0 0 1 1.592-3.397 13.805 13.805 0 0 1 2.447-2.753c.156-.134.322-.257.482-.376l.235-.177.12-.09c.081-.06.162-.122.245-.18l.388-.24c.088-.051.171-.103.254-.155.167-.104.34-.21.522-.302l.791-.384c1.23-.525 2.321-.84 3.344-.966.425-.083.864-.103 1.288-.122l.375-.018.073-.004c.048-.002.097-.004.144-.004l1.104.055c.11.005.225.011.342.033 2.019.24 3.982.963 5.663 2.088a13.118 13.118 0 0 1 3.6 3.661c.706 1.057 1.239 2.245 1.629 3.631l.192.756c.037.171.06.327.082.478.011.072.021.143.033.212l.088.584c.018.13.023.249.027.354.002.051.004.101.008.148l.044.9-.044.914c-.004.053-.006.103-.008.154-.004.106-.01.225-.027.352l-.087.583c-.013.072-.023.143-.034.216-.022.15-.045.306-.08.47l-.193.758c-.391 1.39-.924 2.579-1.63 3.637a13.118 13.118 0 0 1-3.6 3.66 13.026 13.026 0 0 1-5.676 2.09c-.105.02-.22.026-.33.032l-1.095.054zm-.012-1.269l1.013-.051c.094-.005.182-.009.265-.025a11.797 11.797 0 0 0 5.134-1.886 11.842 11.842 0 0 0 3.247-3.304c.633-.947 1.113-2.018 1.468-3.274l.177-.694c.028-.13.048-.266.067-.397.01-.073.02-.145.032-.215l.081-.538c.014-.096.018-.192.022-.285.002-.053.004-.105.008-.154l.04-.829-.04-.814c-.004-.044-.006-.096-.008-.15a2.773 2.773 0 0 0-.022-.286l-.081-.54c-.011-.066-.022-.137-.032-.21-.02-.13-.039-.265-.068-.401l-.177-.696c-.354-1.251-.834-2.322-1.466-3.268a11.845 11.845 0 0 0-3.249-3.305 11.774 11.774 0 0 0-5.119-1.884 1.942 1.942 0 0 0-.28-.027l-1.021-.051c-.028 0-.065.002-.102.004l-.071.003c-.122.008-.25.014-.377.02-.373.016-.76.033-1.13.107-.922.113-1.904.396-3.018.87l-.726.352a5.509 5.509 0 0 0-.444.258c-.083.052-.166.104-.25.154l-.35.214c-.06.043-.13.096-.201.15l-.118.088c-.074.057-.152.115-.231.174-.14.104-.286.212-.419.326a12.54 12.54 0 0 0-2.211 2.487c-.59.899-1.073 1.93-1.434 3.063-.302 1.016-.47 2.153-.497 3.377.027 1.214.195 2.351.498 3.371.36 1.129.843 2.16 1.435 3.062a12.524 12.524 0 0 0 2.208 2.483c.134.115.279.223.42.327.078.058.157.117.234.177l.113.084c.071.054.142.107.214.159l.342.208c.081.048.164.1.247.151.152.095.295.185.446.26l.733.355c1.105.47 2.087.754 2.994.864.386.076.771.093 1.144.11.128.005.256.011.382.019l.066.003.112.004zm6.153-2.35a11.32 11.32 0 0 1-4.91 1.806c-.089.02-.19.023-.286.028l-.947.048h-.015c-.045 0-.083-.002-.121-.004l-.059-.003a20.116 20.116 0 0 0-.376-.02c-.353-.015-.717-.032-1.082-.105-.861-.103-1.778-.367-2.868-.828l-.69-.334a5.223 5.223 0 0 1-.44-.256c-.076-.047-.152-.095-.23-.14l-.33-.202a6.961 6.961 0 0 1-.214-.157l-.11-.084a11.372 11.372 0 0 0-.223-.167c-.133-.099-.271-.2-.402-.313a12.074 12.074 0 0 1-2.116-2.38 12.033 12.033 0 0 1-1.378-2.938c-.29-.976-.45-2.064-.479-3.238.029-1.184.19-2.272.478-3.244a12.02 12.02 0 0 1 1.376-2.939c.637-.928 1.35-1.729 2.12-2.383.13-.112.267-.214.4-.312.074-.055.148-.11.22-.166l.113-.085c.067-.05.134-.102.203-.15l.339-.208c.08-.047.157-.094.232-.142.14-.087.285-.178.439-.254l.682-.331c1.1-.466 2.017-.73 2.894-.835.349-.071.713-.087 1.066-.103.124-.006.248-.011.371-.02l.064-.003c.042-.002.084-.005.126-.004l.958.048c.097.005.196.01.3.03 1.743.21 3.44.834 4.894 1.804v.001a11.376 11.376 0 0 1 3.118 3.17c.613.917 1.06 1.915 1.408 3.141l.167.652c.032.146.05.277.069.404.01.067.018.131.029.194l.077.505c.016.111.02.215.023.306l.007.13.04.79v.01l-.04.773-.007.135c-.003.091-.007.194-.023.305l-.077.503-.03.197a5.213 5.213 0 0 1-.067.397l-.167.654c-.348 1.23-.796 2.23-1.41 3.147a11.377 11.377 0 0 1-3.116 3.17zm3.31-6.653l.153-.59c.022-.105.038-.217.053-.324.01-.068.019-.133.03-.196l.07-.458c.012-.079.015-.158.017-.235.001-.048.003-.094.006-.138l.037-.698-.037-.703a2.967 2.967 0 0 1-.006-.133 1.986 1.986 0 0 0-.017-.235l-.071-.462c-.01-.06-.02-.124-.029-.191a4.41 4.41 0 0 0-.054-.328l-.153-.592c-.194-.684-.535-1.721-1.244-2.778a10.104 10.104 0 0 0-2.766-2.815 10.067 10.067 0 0 0-4.354-1.601 1.43 1.43 0 0 0-.231-.023l-.88-.045-.08.004-.063.003c-.119.009-.244.014-.37.02-.302.013-.615.027-.913.089-.776.092-1.587.326-2.568.739l-.618.3c-.12.059-.237.132-.36.21a6.74 6.74 0 0 1-.23.14l-.3.182c-.044.032-.1.075-.155.118l-.112.084c-.069.054-.142.108-.216.162-.12.088-.232.171-.338.263a10.82 10.82 0 0 0-1.885 2.12 10.763 10.763 0 0 0-1.219 2.603c-.256.864-.394 1.806-.423 2.874.029 1.059.167 2 .425 2.869a10.76 10.76 0 0 0 1.22 2.603 10.8 10.8 0 0 0 1.88 2.114c.108.093.22.176.34.264l.22.165.106.08.17.128.29.175c.074.043.15.09.226.138.124.078.24.151.363.212l.625.302c.972.41 1.783.643 2.542.733.315.064.628.078.93.092.126.005.251.01.375.02l.057.002c.03.002.061.004.091.004l.87-.045c.077-.003.15-.006.214-.02a10.098 10.098 0 0 0 4.371-1.604 10.103 10.103 0 0 0 2.765-2.813c.71-1.059 1.051-2.096 1.247-2.785zm-.14-3.418c.002.038.002.075.006.11l.035.67v.01l-.035.653c-.004.04-.004.077-.005.116-.003.077-.005.164-.02.259l-.066.422c-.01.058-.018.115-.026.174-.014.105-.029.213-.054.328l-.142.55c-.19.664-.517 1.655-1.19 2.657a9.626 9.626 0 0 1-2.633 2.678 9.618 9.618 0 0 1-4.144 1.525c-.072.017-.158.02-.24.023l-.8.042h-.015c-.04 0-.072-.002-.105-.004l-.05-.003c-.123-.01-.24-.015-.36-.02a5.267 5.267 0 0 1-.874-.088c-.7-.08-1.473-.302-2.416-.696l-.582-.282a3.821 3.821 0 0 1-.36-.21c-.068-.042-.135-.085-.204-.124l-.28-.169a5.068 5.068 0 0 1-.176-.13l-.1-.076a7.226 7.226 0 0 0-.203-.153c-.107-.08-.219-.16-.325-.253a10.361 10.361 0 0 1-1.788-2.01 10.309 10.309 0 0 1-1.163-2.479c-.244-.823-.376-1.716-.405-2.735.03-1.03.161-1.923.403-2.742.301-.929.691-1.762 1.162-2.48a10.37 10.37 0 0 1 1.792-2.015c.105-.091.217-.173.324-.252.067-.05.134-.098.2-.15l.105-.08c.053-.04.106-.081.16-.12l.29-.176c.073-.041.14-.084.208-.127.113-.072.231-.146.359-.209l.574-.277c.952-.4 1.726-.622 2.443-.704.277-.06.572-.073.857-.085.119-.005.236-.01.353-.019l.057-.003c.036-.003.073-.006.108-.005l.81.042c.083.003.169.006.26.026a9.586 9.586 0 0 1 4.124 1.521h.001a9.629 9.629 0 0 1 2.634 2.681c.672 1 1 1.992 1.187 2.65l.142.548c.027.122.042.23.056.335.008.059.016.116.026.171l.066.425c.015.095.017.182.02.26zm-1.22.78a22.724 22.724 0 0 1-.037-.7c-.001-.06-.002-.123-.012-.184l-.06-.382a4.045 4.045 0 0 1-.026-.171c-.01-.083-.022-.169-.041-.257l-.128-.488c-.178-.62-.456-1.446-1.024-2.288a8.365 8.365 0 0 0-2.283-2.326 8.362 8.362 0 0 0-3.587-1.318l-.02-.004a.881.881 0 0 0-.165-.014l-.737-.04-.058.005-.055.003c-.11.01-.228.014-.347.02-.247.01-.48.02-.71.07l-.02.003c-.78.088-1.533.37-2.101.606-.16.08-.335.165-.511.247-.092.045-.183.103-.28.165a4.805 4.805 0 0 1-.205.126l-.248.148-.117.09a6.354 6.354 0 0 1-.294.222 3.986 3.986 0 0 0-.264.204A9.112 9.112 0 0 0 33.9 10.16a9.04 9.04 0 0 0-1.004 2.146c-.206.696-.32 1.473-.35 2.371.03.886.144 1.664.351 2.365a9.042 9.042 0 0 0 1.006 2.144c.475.686.999 1.275 1.553 1.746.083.072.172.137.266.205a6.534 6.534 0 0 1 .293.223l.131.099.237.14c.067.038.134.081.202.124.097.062.188.12.283.166.173.08.347.165.52.251.556.231 1.309.513 2.088.6l.02.004c.23.05.464.06.712.07.118.006.236.01.353.02l.048.003c.023.002.048.005.07.004l.725-.039c.06-.001.117-.003.164-.014l.02-.004a8.365 8.365 0 0 0 3.589-1.32 8.36 8.36 0 0 0 2.281-2.322c.57-.844.848-1.67 1.027-2.294l.127-.488c.017-.082.029-.169.04-.253a4.56 4.56 0 0 1 .025-.174l.06-.38c.01-.06.012-.123.013-.183a22.158 22.158 0 0 1 .037-.699zM40.21 28.008h.266v.012c.044.002.09.005.132.004l1.157-.057a2.42 2.42 0 0 0 .313-.03 13.502 13.502 0 0 0 5.9-2.169 13.588 13.588 0 0 0 3.729-3.793c.734-1.102 1.286-2.333 1.688-3.765l.202-.798c.035-.158.058-.32.082-.477l.034-.226.092-.618c.016-.114.021-.227.026-.335.003-.059.005-.116.01-.17l.045-.95-.046-.936c-.004-.049-.006-.105-.009-.164a3.656 3.656 0 0 0-.026-.338l-.092-.62c-.012-.069-.023-.144-.034-.221-.023-.156-.047-.317-.083-.481l-.202-.8c-.401-1.426-.953-2.657-1.686-3.758a13.586 13.586 0 0 0-3.731-3.795 13.48 13.48 0 0 0-5.886-2.166c-.113-.02-.217-.026-.328-.032l-1.163-.058H40.6c-.037 0-.08.002-.124.005l-.078.003c-.12.007-.245.012-.37.018-.448.02-.912.04-1.362.127-1.077.135-2.206.461-3.467 1l-.834.406c-.178.09-.35.196-.531.309-.089.054-.177.11-.267.162l-.4.248c-.079.055-.166.12-.252.185l-.118.088c-.078.06-.16.121-.242.182-.169.126-.344.256-.504.394a14.252 14.252 0 0 0-2.539 2.855 14.202 14.202 0 0 0-1.648 3.521c-.352 1.18-.544 2.487-.572 3.88.028 1.385.22 2.69.572 3.874a14.213 14.213 0 0 0 1.65 3.521 14.256 14.256 0 0 0 2.536 2.852c.161.138.336.269.505.395.082.06.164.121.245.184l.117.087c.086.064.172.129.26.19l.393.243c.086.051.174.106.263.16.182.113.354.22.535.311l.84.408c1.251.535 2.38.862 3.445.995.465.088.93.11 1.381.13l.177.008zm-17.478-.468v.9h11.909l-.854-.797a3.054 3.054 0 0 1-.1-.103H22.732zm0-.837h9.02a14.743 14.743 0 0 1-.587-.9h-8.433v.9zm0-1.736h7.135c-.14-.297-.277-.598-.409-.9h-6.726v.9zM52.013 0h1.311l8.359 29.225H60.37L52.012 0zm1.795 0h1.312l8.358 29.225h-1.311L53.808 0zm34.88 0H90l-8.359 29.225h-1.197l-.042-.145-7.6-26.588-.234.817 7.396 25.916h-1.311l-6.74-23.628-.255.894 6.51 22.734h-1.31L71 8.787l-.226.792 5.598 19.646H75.06l-.04-.145-4.9-17.213-4.966 17.358h-1.197L55.603 0h1.312l4.95 17.315L66.815 0h1.312L62.52 19.608l.241.843L68.611 0h1.312l-6.505 22.75.236.824L70.407 0h1.312l-7.41 25.865.248.867L72.203 0H73.4l.042.145 4.913 17.184L83.302 0h1.311l-5.6 19.636.236.822L85.097 0h1.312l-.073.255-6.427 22.513.232.81L86.893 0h1.311l-7.406 25.878.244.854L88.688 0z"></path></svg></div><div class="subtitle">Tu propia banda sonora</div></div></div></figure><figure class="thumbnail-col-slide thumbnail-col slide slide-cut is-link"><div class="slide-background"><div class="slide-covers"><img class="slide-img active" src="img-slider/358x358-000000-80-0-0 (5).jpg" alt="Dedicated content cover"><img class="slide-img" src="img-slider/358x358-000000-80-0-0 (6).jpg" alt="Dedicated content cover"><img class="slide-img" src="img-slider/358x358-000000-80-0-0 (7).jpg" alt="Dedicated content cover"></div></div><div class="slide-foreground"><ul class="slide-play-icon"><li class="action-item"><button class="action-item-btn" type="button" aria-label="Pausa"><span><span class="glyphicon glyphicon-play app" style="color: #fff; left:17px; top:-5px;" aria-hidden="true"></span><span class="play-icon play-hover"><span class="icon icon-pause"></span></span><span class="play-icon play-active"><span class="equalizer equalizer-12 equalizer-inverse"></span></span></span></button></li></ul><div class="slide-text"><div class="label">SEMANAL</div><div class="title">Descubrir</div><div class="subtitle ellipsis">Chino &amp; Nacho, Alex Sensation, Mozart la Para...</div></div><a class="btn slide-btn" href="/smarttracklist/discovery">TRACKLIST</a></div></figure></ul></div></div></div>



    <div class="col-lg-12 col-md-12 col-xs-12 col-sm-12">
       <div style="margin: 20px 54px 20px;"><a id="mod" href="#" style="text-decoration:none;"><h4 style="font-size:22px; font-family:calibri; color:black;">Explorar
          <span class="glyphicon glyphicon-menu-right" style="width:25px; top:2px;"></span></a>
        </h4><br>
        <p style="font-size:17px; font-family:calibri;">Explora por Genero Y Momento</p></div>
        <div class="container"><div class="carousel-wrapper"><div class="carousel-inner" style="transform: translateX(0px);"><ul class="thumbnail-grid thumbnail-grid-responsive thumbnail-grid-one-line"><li class="thumbnail-col"><a class="thumbnail thumbnail-rectangle thumbnail-channel" href="/es/channels/latin" style="background-color: rgb(255, 107, 0); "><img class="picture-img image-loader is-loaded" src="https://e-cdns-images.dzcdn.net/images/misc/99c707f42e754c25aebddf8fef79499d/134x264-000000-80-0-0.jpg" alt="" crossorigin="anonymous" height="134" style="" width="264"><div class="title"><p class="title-text" id="ariaThumbnailTitle48">Música latina</p></div></a></li><li class="thumbnail-col"><a class="thumbnail thumbnail-rectangle thumbnail-channel" href="/es/channels/pop" style="background-color: rgb(249, 59, 65);"><div class="picture overlay-hidden" aria-labelledby="ariaThumbnailTitle49"><img class="picture-img image-loader is-loaded" src="https://e-cdns-images.dzcdn.net/images/misc/6147a51f4df56d53b286dc3c9f02ae1f/134x264-000000-80-0-0.jpg" alt="" crossorigin="anonymous" height="134" width="264"></div><div class="title"><p class="title-text" id="ariaThumbnailTitle49">Pop</p></div></a></li><li class="thumbnail-col"><a class="thumbnail thumbnail-rectangle thumbnail-channel" href="/es/channels/mexican" style="background-color: rgb(206, 0, 7);"><div class="picture overlay-hidden" aria-labelledby="ariaThumbnailTitle50"><img class="picture-img image-loader is-loaded" src="https://e-cdns-images.dzcdn.net/images/misc/5e940164a7849e6240213c928d71081a/134x264-000000-80-0-0.jpg" alt="" crossorigin="anonymous" height="134" width="264"></div><div class="title"><p class="title-text" id="ariaThumbnailTitle50">Música mexicana</p></div></a></li><li class="thumbnail-col"><a class="thumbnail thumbnail-rectangle thumbnail-channel" href="/es/channels/reggaeton" style="background-color: rgb(255, 121, 97);"><div class="picture overlay-hidden" aria-labelledby="ariaThumbnailTitle51"><img class="picture-img image-loader is-loaded" src="https://e-cdns-images.dzcdn.net/images/misc/f7f1a49605d59281e75d8a0e9a69135b/134x264-000000-80-0-0.jpg" alt="" crossorigin="anonymous" height="134" width="264"></div><div class="title"><p class="title-text" id="ariaThumbnailTitle51">Reggaeton</p></div></a></li></div></a></li></ul></div></div></div><br><br></div>




      <div class="col-lg-12 col-md-12 col-xs-12 col-sm-12">
      <div style="margin: 20px 54px 20px;"><a id="mod" href="#" style="text-decoration:none;"><h4 style="font-size:22px; font-family:calibri; color:black;">Seleccion de Playlists
      <span class="glyphicon glyphicon-menu-right" style="width:25px; top:2px;"></span></a>
      </h4><br>
      <p style="font-size:17px; font-family:calibri;">Una selección de nuestros editores para ti</p></div>
      <div id="contenedor">
      
        <?php 
                      while ($row = $conexion->obtenerRegistro($paylist)) {
                        if ($row['ROWNUM']<5) {
                        echo 
                        '<div class="col-md-3 dash2">
                          <div class="change">
                            <div class="fotos" >
                              <img src="'.$row['COVER'].'" class="perf">

                            </div>

                          </div>
                          <div class="ubicar">
                            <div class="col-xs-3 circulo" onclick="play('.$row['CODIGO_PLAYLIST'].');"><span class="glyphicon glyphicon-play app" style="color: #fff" aria-hidden="true"></span></div>
                            <div class="col-xs-3 circulo"><span class="glyphicon glyphicon-heart app" style="color: #b8b8b8" aria-hidden="true"></span></div>
                            <div class="col-xs-3 circulo"><span class="glyphicon glyphicon-option-horizontal" style="color: #b8b8b8; top:13px; left:-3px;" aria-hidden="true"></span>
                            </div>
                                </div>
                                <div class="informacion">
                                  <table>
                                    <tr>
                                      <td>
                                        <span class="name-play">'; echo cortar("".$row['NOMBRE_PLAYLIST']."");echo '</span><br>
                                        <p class="name-play" style="font-size:12px;">'; echo cortar("".$row['DESCRIPCION_PLAYLIST']."");echo '</p>
                                      </td>
                                      <tr>
                                      </tr>
                                    </tr>
                                  </table>
                                </div>
                              </div>';



                  }
              }

          ?>
    </div>  

  

    </div>
    <div class="col-lg-12 col-md-12 col-xs-12 col-sm-12">
      <div style="margin: 20px 54px 20px;"><a id="mod"  href="#" style="text-decoration:none;"><h4 style="font-size:22px; font-family:calibri; color:black;">Popular
      <span class="glyphicon glyphicon-menu-right" style="width:25px; top:2px;"></span></a>
      </h4></div>
      <div id="contenedor">
      <?php 
                    while ($row = $conexion->obtenerRegistro($albums)) {
                      if ($row['ROWNUM']<5) {
                        echo 
                        '<div class="col-md-3 dash2">
                          <div class="change">
                            <div class="fotos" >
                                <img src="'.$row['COVER'].'" class="perf">

                            </div>

                          </div>
                          <div class="ubicar">
                            <div class="col-xs-3 circulo" onclick="playg('.$row['CODIGO_ALBUM'].');"><span class="glyphicon glyphicon-play app" style="color: #fff" aria-hidden="true"></span></div>
                            <div class="col-xs-3 circulo"><span class="glyphicon glyphicon-heart app" style="color: #b8b8b8" aria-hidden="true"></span></div>
                            <div class="col-xs-3 circulo"><span class="glyphicon glyphicon-option-horizontal" style="color: #b8b8b8; top:13px; left:-3px;" aria-hidden="true"></span>
                            </div>
                            </div>
                                <div class="informacion">
                                  <table>
                                    <tr>
                                      <td>
                                        <span class="name-play">'; echo cortar("".$row['NOMBRE_ALBUM']."");echo '</span>
                                        <p class="name-play" style="font-size:12px;">'; echo cortar("".$row['DESCRIPCION']."");echo '</p>
                                      </td>
                                      <tr>

                                      </tr>
                                    </tr>
                                  </table>
                                </div>
                              </div>';



               }
                       }

          ?>
        </div>
    </div>
    <div class="col-lg-12 col-md-12 col-xs-12 col-sm-12">
      <div style="margin: 20px 54px 20px;"><a id="mod"  href="#" style="text-decoration:none;"><h4 style="font-size:22px; font-family:calibri; color:black;">Nuevos Lanzamientos Para Ti
      <span class="glyphicon glyphicon-menu-right" style="width:25px; top:2px;"></span></a>
      </h4></div>
      <div id="contenedor">

          <?php 
                       while ($row = $conexion->obtenerRegistro($artistas)) {
                         if ($row['ROWNUM']<5) {
                        echo 
                        '<div class="col-md-3 dash2">
                          <div class="change2">
                            <div class="fotos2" >
                              <img src="'.$row['COVER'].'" class="perf2" style="border-radius:0%;">

                            </div>

                          </div>
                          <div class="ubicar2" style="margin-left:10px;">
                            <div class="col-xs-3 circulo" onclick="playa('.$row['CODIGO_ARTISTA'].');"><span class="glyphicon glyphicon-play app" style="color: #fff" aria-hidden="true"></span>
                            </div>
                            <div class="col-xs-3 circulo"><span class="glyphicon glyphicon-heart app" style="color: #b8b8b8" aria-hidden="true"></span>
                            </div>
                            <div class="col-xs-3 circulo"><span class="glyphicon glyphicon-option-horizontal" style="color: #b8b8b8; top:13px; left:-3px;" aria-hidden="true"></span>
                            </div>
                            </div>
                                <div class="informacion2">
                                  <table>
                                    <tr>
                                      <td>
                                        <span class="name-play">'; echo cortar("".$row['NOMBRE_ARTISTICO']."");echo '</span>
                                      </td>
                                      <tr>
                                        <td>
                                          <span class="tipop">'.$row['SEGUIDORES'].' seguidores</span>
                                        </td>
                                      </tr>
                                    </tr>
                                  </table>
                                </div>
                              </div>';


                  }
                       }
   
          
          ?>
      </div>
    </div>
  </div>
</div>




    



<script src="js/jquery.min.js"></script>
<script src="js/bootstrap.min.js"></script>
<script type="text/javascript" src="js/principal.js"></script>
<script type="text/javascript">
  function play(codigoplaylist){
var parametros="codigoplaylist="+codigoplaylist;
 $.ajax({
        url:"ajax/reproducto-ajax.php?accion=1",
        data:parametros,
        method:"POST",
        dataType:'json',
        success:function(respuesta){
          window.parent.top.myPlaylist.setPlaylist(respuesta);
          window.parent.top.myPlaylist.option('autoPlay', true);
        }
     });

}

 function playg(codigoalbum){
var parametros="codigoalbum="+codigoalbum;
 $.ajax({
        url:"ajax/reproducto-ajax.php?accion=2",
        data:parametros,
        method:"POST",
        dataType:'json',
        success:function(respuesta){
          window.parent.top.myPlaylist.setPlaylist(respuesta);
          window.parent.top.myPlaylist.option('autoPlay', true);
        }
     });

}

function playa(codigoartista){
var parametros="codigoartista="+codigoartista;
 $.ajax({
        url:"ajax/reproducto-ajax.php?accion=3",
        data:parametros,
        method:"POST",
        dataType:'json',
        success:function(respuesta){
          window.parent.top.myPlaylist.setPlaylist(respuesta);
          window.parent.top.myPlaylist.option('autoPlay', true);
        }
     });

}

$(document).ready(function(){
     
$(".ubicar2").hover(function(){

  $(this).css({"visibility":"visible","opacity":"1"});
  $(this).siblings("div.change2").css("opacity","0.8");
},function(){
  $(this).css({"visibility":"visible","opacity":"1"});
   $(this).siblings("div.change2").css("opacity","0.8");
});



$(".perf2").hover(function(){
  $(this).parent().parent().css("opacity","0.8");
  $(this).parent().parent().siblings("div.ubicar2").css({"visibility":"visible","opacity":"1"});
},function(){
  $(this).parent().parent().css("opacity","1");
  $(this).parent().parent().siblings("div.ubicar2").css({"visibility":"hidden","opacity":"0"});
});




 $(".tot").click(function(){
  $(this).popover('toggle');
});



 $(".ubicar").hover(function(){
  $(this).css({"visibility":"visible","opacity":"1"});
  $(this).siblings("div.change").css("opacity","0.8");
},function(){
  $(this).css({"visibility":"visible","opacity":"1"});
   $(this).siblings("div.change").css("opacity","0.8");
});
 

$(".change").hover(function(){
  $(this).css("opacity","0.8");
  $(this).siblings("div.ubicar").css({"visibility":"visible","opacity":"1"});
},function(){
  if ($(this).siblings("div.ubicar").children("div.tot").popover('hide')) {
       
  }else{
      $(this).siblings("div.ubicar").children("div.tot").popover('hide');
  }
  $(this).css("opacity","1");
  $(this).siblings("div.ubicar").css({"visibility":"hidden","opacity":"0"});
});

$(".change").click(function(){
  if ($(this).siblings("div.ubicar").children("div.tot").popover('hide')) {

  }else{
      $(this).siblings("div.ubicar").children("div.tot").popover('toggle');
  }
  
});


     });
</script>
<script>

</script>

</body>
</html>