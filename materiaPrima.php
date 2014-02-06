<!DOCTYPE HTML>
<?php 
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
          <?php mostrarMenu(); 
                function anadirfila($i){

                      echo '<tr><td><input type="date" name="bday[]" max=<?php echo "'.date('Y-m-d').'";  ?> ></td>
                      <td><select name="operacion[]">
                      <option value="0">Entrada</option>
                      <option value="1">Salida</option>
                      </select></td>
                      <td><input type="number" min="0" name="unidades[]" value="0"></td>
                      <td><input type="number" min="0" name="cu[]" value="0"></td>
                      <td><input type="number" min="0" name="saldo[]" value="0"></td></tr>'; 
              }
          ?>
      </nav>
    </header>
    <div id="site_content">
      <div class="content" style  = 'width:100%; text-aling: center;'>
        <h1>Inventario de Materia Prima</h1>


        <form name="libro_diario" method="post" action="" style="padding: 5px;">
            <table class="tablaEntrada" style="border-spacing: 10px; width: 100%; text-aling=left;">
                <tr>
                <td>Artículo: <?php
                      echo "<select name=\"articulo\">";
                      include("conexion.php"); 
                      $con=mysql_connect($host,$user,$pw) or die("Problemas al conectar"); 
                      mysql_select_db($db,$con) or die("Problemas al conectar con la base"); 
                      $QUERY = mysql_query("SELECT * FROM articulos WHERE codInventario = 111110703", $con); 
                      //$articulo = array(array());
                      while ( $resultado = mysql_fetch_row($QUERY)){
                        //$articulo[$resultado[0]][]= $resultado;
                        echo "<option value='".$resultado[0]."'>".$resultado[1]."</option>"; 
                      }
                      echo "</select>";
                      ?></td>
                <td>No. Artículo: <?php echo $resultado[0];?></td>
                </tr>
                <tr>
                <td>Existencias: <?php echo $resultado[2];?></td>
                <td>Saldo total: <?php echo $resultado[3];?></td>
                </tr>
            </table>
            <table class="tablaEntrada1" style="border-spacing: 10px; width: 100%; text-aling=left; ">
                <tr>
                <th>Fecha</th>
                <th>Operación</th>
                <th>Unidades</th>
                <th>Costo Unitario</th>
                <th>Saldo</th>
                </tr>
                <?php
                    if(isset($_GET['u'])){
                    $u=$_GET['u'];  
                      }
                    else {
                      $u=1;
                      }
                    for($i=0;$i<$u;$i++){
                      anadirfila($i);
                    }

                    echo "<tr>
                            <td colspan='3'>
                                <b><a class='boton' href='".$_SERVER['PHP_SELF']."?u=".($u+1)."'>Añadir</a>
                              </b>
                                <b><a class='boton' href='".$_SERVER['PHP_SELF']."?u=".($u-1)."'>Eliminar</a>
                              </b>
                            </td> 
                         </tr>";
                ?>
            </table>
            <input type="hidden" value="<?php echo $u; ?>" name="n">
            <input class='boton' name ="boton" type="reset" value="Limpiar Formulario" >                    
            <input class='boton' name ="boton" type="submit" value="Registrar" >
        </form>

        <?php 
          switch ($_POST['boton']) {
            case 'Registrar':{
              include("conexion.php"); 
              $con=mysql_connect($host,$user,$pw) or die("Problemas al conectar"); 
              mysql_select_db($db,$con) or die("Problemas al conectar con la base"); 
              $articulo = $_POST['articulo'];
              $cantidad=$_POST['cuenta'];
              $cu=$_POST['cu'];
              $saldo=$_POST['saldo'];
              $operacion = $_POST['operacion'];
              $bday = $_POST['bday'];
              $sql = mysql_query("SELECT MAX(numeroTransaccion) FROM librodiario");
              $numero = mysql_result($sql);
              $numero++;
              for($i=0; $i<$u; $i++){    
                  $sql = "INSERT INTO inventarios VALUES(".$articulo.",".$cantidad[$i].",".$cu[$i].",".$saldo[$i].",".$operacion[$i].",'".$bday[$i]."')"; 
                  $QUERY = mysql_query($sql, $con);
                      }              
                  //$resultado = mysql_fetch_row($QUERY);
              }

              ?>
                <script languaje="javascript">
                  alert("Inserción Exitosa");
                  //window.location.reload();
                </script>
              <?php
              break;
          }
        ?>

       
      </div>
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
