<!DOCTYPE HTML>
<?php 
error_reporting(E_ALL & ~E_NOTICE);
   include 'funciones/funciones.php';
   date_default_timezone_set('America/El_Salvador');
  $dias = array("Domingo","Lunes","Martes","Miércoles","Jueves","Viernes","Sábado");
  $meses = array("Enero","Febrero","Marzo","Abril","Mayo","Junio","Julio","Agosto","Septiembre","Octubre","Noviembre","Diciembre");
   //creamos la sesion
    session_start();

    //si no se ha hecho la sesion nos regresará a login.php
    if(!isset($_SESSION['usuario']))
    {
      header('Location: index.php');
      $_SESSION = array();
     //Destruir Sesión
     session_destroy();
     exit();
    }
?>


<html>

<head>
  <title>Sistema Contable 2013</title>
  <meta name="description" content="website description" />
  <meta name="keywords" content="website keywords, website keywords" />
  <meta http-equiv="content-type" content="text/html; charset=UTF-8" />
  <link rel="stylesheet" type="text/css" href="css/style.css" />
  <!-- modernizr enables HTML5 elements and feature detects -->
  <script type="text/javascript" src="js/modernizr-1.5.min.js"></script>

  <link href="js/jquery-ui-1.10.3.custom/css/eggplant/jquery-ui-1.10.3.custom.css" rel="stylesheet">
  <script src="js/jquery-ui-1.10.3.custom/js/jquery-1.9.1.js"></script>
  <script src="js/jquery-ui-1.10.3.custom/js/jquery-ui-1.10.3.custom.js"></script>

</head>

<body>
  <div id="main">
    <header>
      <div id="logo">
         <div id="logo_text">
          <!-- class="logo_colour", allows you to change the colour of the text -->
          <h1><a href="index.php">Sistema Contable</a><br> </h1>
             <h3> <?php
                echo $dias[date('w')]." ".date('d')." de ".$meses[date('n')-1]. " del ".date('Y');

              ?></h3>
         
          <h2></h2>
        </div>
      </div>
      <nav>
          <?php mostrarMenu(); ?>
      </nav>
    </header>
    <div id="site_content">
       <!--<div id="sidebar_container">
          <?php mostrarMenuLateral(); ?>
      </div>-->
      <!-- *********************************************************************** -->
      <div class="content">
        <div>
          <h1>Catálogo de Cuentas</h1>

          <form action="" method="post">
            

               <table class="tablaEntrada" style="border-spacing: 10px; width: 100%; text-aling=left;">
                   <tr>
                     <td ><span class='valores'>Nombre Cuenta:</span></td>
                     <td ><select id="combobox" class="ui-widget" name="cCuenta">
                  <?php 
                        include("conexion.php");
                        $con=mysql_connect($host,$user,$pw) or die("Problemas al conectar");
                        mysql_select_db($db,$con) or die("Problemas al conectar con la base");
                        $QUERY = mysql_query("SELECT * FROM catalogodecuentas ", $con);
                         while ( $resultado = mysql_fetch_row($QUERY)){
                    echo "<option value='".$resultado[1]."'> ".$resultado[1]."</option>";
                    }
                  ?>
              </select></td>
                   </tr>
                   <tr>
                      <td colspan="3">
                        <input class='boton' id="enviar" name="cmdEnter" type="submit"  value="Eliminar">
                      </td>
                   </tr>
              </table>

          </form>

        </div>
      </div>
      <!-- *********************************************************************** -->
    </div>
    <div id="scroll">
      <a title="Scroll to the top" class="top" href="#"><img src="images/top.png" alt="top" /></a>
    </div>
    <footer>
      <p></p>
      <p><a href="index.php">Inicio</a> 
           | <a href="examples.php">Contabilidad General</a> 
           | <a href="page.php">Contabilidad de costos</a> 
           | <a href="another_page.php">Estados financieros</a> 
           | <a href="contact.php">Recursos Humanos</a>
           | <a href="funciones/logout.php"> Cerrar sesión </a>
      </p>

      <p>Copyright &copy; SIC115 | Ciclo II 2013</p>
    </footer>
  </div>
  <!-- javascript at the bottom for fast page loading -->
  <script type="text/javascript" src="js/jquery.js"></script>
  <script type="text/javascript" src="js/jquery.easing-sooper.js"></script>
  <script type="text/javascript" src="js/jquery.sooperfish.js"></script>
  <script type="text/javascript">
    $(document).ready(function() {
      $('ul.sf-menu').sooperfish();
      $('.top').click(function() {$('html, body').animate({scrollTop:0}, 'fast'); return false;});
    });
  </script>

  <?php
 switch ($_POST['cmdEnter']){
  case 'Eliminar':
 include("conexion.php");

  $con=mysql_connect($host,$user,$pw) or die("Problemas al conectar");
  mysql_select_db($db,$con) or die("Problemas al conectar con la base");
  $query=("DELETE FROM catalogodecuentas WHERE NombreCuenta='".$_POST[cCuenta]."'");
  
  mysql_query($query, $con);

?>
  <script languaje="javascript">
   alert("Eliminacion exitosa!");
  </script>
  <?php 
}//break;

?>
</body>
</html>