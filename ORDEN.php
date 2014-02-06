<!DOCTYPE HTML>
<?php 
error_reporting(E_ALL & ~E_NOTICE);
   include 'funciones/funciones.php';
   date_default_timezone_set('America/El_Salvador');
  $dias = array("Domingo","Lunes","Martes","Miércoles","Jueves","Viernes","Sábado");
  $meses = array("Enero","Febrero","Marzo","Abril","Mayo","Junio","Julio","Agosto","Septiembre","Octubre","Noviembre","Diciembre");
   //creamos la sesion
    session_start();
    if(!isset($_SESSION['contador'])) {
      $_SESSION['contador']=0;
    }
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

  <!-- Limpiar los campos -->
<script type="text/javascript">
function formReset()
{
document.getElementById("insertarOrden").reset();
}
</script>

<script languaje="javascript"> 
function confirmacion(){ 
    $( "#dialog-message" ).dialog({
      modal: true,
      buttons: {
        Ok: function() {
          $( this ).dialog( "close" );
          window.location.reload();
        }
      }
    });
  
} 
</script>

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
      <div class="content" style='width : 100%'>
        <div>
          <h1>Nueva Orden de Producción</h1>
           <?php
                      $matpri=$_POST['MP'];
                      $mod=$_POST['MOD'];
                      $cif=$_POST['CIF'];
                      $total=$_POST['TOTAL_TOTAL'];
                      $cliente=$_POST['CLIENTE'];
                      $prod=$_POST['productos'];
                      $cant=$_POST['CANTIDAD'];
                      $norden=$_POST['norden'];
                      $fentrega=$_POST['mes'];
                      $fecha = date("Y-m-d");


            ?>

          <form name="formulario" action="" method="post">                       
              <table class="tablaEntrada" style=" width: 100%; text-aling=left;">
               <tr>
                      <td><b>N° Orden</b></td>
                      <td><b>Producto</b></td>
                      <td><b>Cantidad</b></td>
                      <td><b>Fecha Entrega</b></td>
                      <td><b>Cliente</b></td>
                      <td><b>MP</b></td>
                      <td><b>MOD</b></td>
                      <td><b>CIF</b></td>
                      <td><b>TOTAL</b></td>
              </tr>
              <tr>

                      <td><input name= 'norden' size= 5 class='valores' type="text" value=<?php echo "'".$norden."'" ;?>/></td>
                      <td><input name= 'productos' size= 12 class='valores' type="text" value=<?php echo "'".$prod."'" ;?>/></td>
                      <td><input name= 'CANTIDAD' size = 3 class='valores' type="text" value=<?php echo "'".$cant."'" ;?>/></td>
                      <td><input name= 'mes' size = 12 class='valores' type="text" value=<?php echo "'".$fentrega."'" ;?>/></td>
                      <td><input name= 'CLIENTE' size = 12 class='valores' type="text" value=<?php echo "'".$cliente."'" ;?>/></td>
                      <td><input name= 'MP'size = 5 class='valores' type="text" value=<?php echo "'".$matpri."'" ;?>/></td>
                      <td><input name= 'MOD'size = 5 class='valores' type="text" value=<?php echo "'".$mod."'" ;?>/></td>
                      <td><input name= 'CIF'size = 5 class='valores' type="text" value=<?php echo "'".$cif."'" ;?>/></td>
                      <td><input name= 'TOTAL_TOTAL' size = 8 class='valores' type="text" value=<?php echo "'".$total."'" ;?>/></td>
                      <td><input size = 8 class='valores' type="hidden" value=<?php echo "'".$fecha."'" ;?>/></td>
                </tr>               
              <td colspan="9">
                    <input class='boton' name="boton" type="submit"  value="Cancelar">
                    <input class='boton' name="boton" type="submit"  value="Confirmar">
              </td>
            </table>
          </form>
          <?php
              switch ($_POST['boton']) {
              case 'Confirmar':{
                    include("conexion.php");
                      $con=mysql_connect($host,$user,$pw) or die("Problemas al conectar");
                      mysql_select_db($db,$con) or die("Problemas al conectar con la base");
                      $query="INSERT INTO ordenes (fechaOrden, Cliente, producto, cantProducto, MontoMP, MontoMObra, MontoGIF, totalCostoProduccion, Estado)       
                      VALUES ('".$fecha."','".$cliente."','".$prod."','".$cant."','".$matpri."','".$mod."','".$cif."','".$total."','En proceso')";
                      
                      mysql_query($query, $con);

                    ?>
                      <script languaje="javascript">
                       alert("Insercion exitosa!");
                      document.location="presupuestoCostoProduccion.php"
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
