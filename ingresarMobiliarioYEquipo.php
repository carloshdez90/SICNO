<!DOCTYPE HTML>
<?php 
//error_reporting(E_ALL & ~E_NOTICE);
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
      <div class="content" style  = 'width:100%;'>
       <div>
          <h1>Ingresar Mobiliario y equipo</h1>

          <form action="" method="post">
              
          <table class="tablaEntrada" style="width: 100%; text-aling=left;">
                 <tr>
                    <td>Codigo</td>
                    <td>Descripcion</td>
                    <td>Costo</td>
                    <td>Fecha de compra</td>
                    <td>Vida Economica<br>(En años)</td>
                    <td>Localizacion</td>
                    <td>valor de <br>Recuperacion</td>
                    <td>Oservaciones</td>
                  </tr>
                  <tr>
                    <td ><input class='datos' id="Codigo" name="codigo" type="text" value=<?php 
                                                                            include("conexion.php"); 
                                                                            $con=mysql_connect($host,$user,$pw) or die("Problemas al conectar"); 
                                                                            mysql_select_db($db,$con) or die("Problemas al conectar con la base"); 
                                                                            $QUERY = mysql_query("SELECT codigo FROM afijo order by codigo desc", $con); 
                                                                            $resultado = mysql_fetch_row($QUERY);
                                                                            if(!isset($resultado)){
                                                                              $numero = 0;
                                                                            }else{
                                                                              $numero = $resultado[0]+1;
                                                                            }

                                                                            echo "'".$numero."'"; 
                                                                        ?>  readonly size= '5'></td>
                    <td ><input class='datos' id="Descripcion" name="descripcion" type="text" value="" size= '10'></td>
                    <td ><input class='datos' id="Costo" name="costo" type="text" value="" size= '5'></td>
                    <td ><?php $fecha = date("Y-m-d"); echo "<b>".$fecha."</b>"; ?></td>
                   <td ><input class='datos' id="vidaeconomica" name="vidaeconomica" type="text" value="" size= '5'></td>
                   <td ><select name="localizacion">
                          <option value="Administracion">Administracion</option>
                          <option value="Produccion">Produccion</option>
                        </select>
                  </td>
                    <td ><input class='datos' id="valorRecuperacion" name="valorRecuperacion" type="text" value="" size= '5'></td>
                    <td ><input class='datos' id="bbservaciones" name="observaciones" type="text" value="" size= '10'></td>
                  </tr> 
                  <tr>
                    <td colspan="8">
                      <input class='boton'  name="boton" type="reset"  value="Limpiar">
                      <input class='boton' name="boton" type="submit"  value="Agregar">
                    </td>
                  </tr>         
            </table>
          </form>
           <?php
              switch ($_POST['boton']) {
              case 'Agregar':{
                    include("conexion.php");
                      $con=mysql_connect($host,$user,$pw) or die("Problemas al conectar");
                      mysql_select_db($db,$con) or die("Problemas al conectar con la base");
                      $depreciacion=($_POST['costo']-$_POST['valorRecuperacion'])/$_POST['vidaeconomica'];
                      $vida=$_POST['vidaeconomica'];
                      $query="INSERT INTO afijo (descripcion, costo, fechaCompra, vidaEco, localizacion, valorRecuperacion, observaciones, aniosVida, depreciacion, VL, estado)       
                      VALUES ('".$_POST['descripcion']."','".$_POST['costo']."','".$fecha."','".$_POST['vidaeconomica']."','".$_POST['localizacion']."','".$_POST['valorRecuperacion']."','".$_POST['observaciones']."','".$_POST['vidaeconomica']."',".$depreciacion.", ".$_POST['costo'].",'sin depreciar')";
                      mysql_query($query, $con);

                    ?>
                      <script languaje="javascript">
                      //alert("Insercion Exitosa!");
                      //document.location="presupuestoCostoProduccion.php"
                      </script> 
                    <?php
                   
                    }break;
              }
          ?>

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

  

</body>
</html>
