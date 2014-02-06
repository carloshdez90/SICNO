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
  <style type="text/css">
  .izquierda{
    text-align: left !important;
  }
  </style>

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
              //mostrarMenuLateral(); 
                function imprime_celdas($i){

                      echo "<td><select name=\"cuenta[]\" >";
                      include("conexion.php"); 
                      $con=mysql_connect($host,$user,$pw) or die("Problemas al conectar"); 
                      mysql_select_db($db,$con) or die("Problemas al conectar con la base"); 
                      $QUERY = mysql_query("SELECT * FROM catalogodecuentas ", $con); 
                      while ( $resultado = mysql_fetch_row($QUERY)){ 
                        echo "<option value='".$resultado[0]."'> ".$resultado[1]."</option>"; 
                      }
                  
                  echo"</select> </td><td><input type='number' min='0' name=\"deber[]\" value='0'></td><td><input type='number' min='0' name=\"haber[]\" value='0'></td><tr>";
                  
              }
        
          ?>
      </nav>
    </header>
    <div id="site_content">
      <!--<div id="sidebar_container">
          <?php mostrarMenuLateral(); ?>
      </div>-->
      <div class="content"  style='width : 95%; border: 1px solid black; border-radius: 20px 20px 20px 20px; box-shadow:  0 0 50px gray;' >
        <h1 align="center">Registro de Libro Diario</h1>


        <form name="libro_diario" method="post" action="" style="padding: 5px;">
            <table class="tablaEntrada" style="border-spacing: 20px; width: 100%; text-aling=center;" >
                <tr>
                <td>Partida N°: <input name="partida" type="text" value= <?php 
                                                                            include("conexion.php"); 
                                                                            $con=mysql_connect($host,$user,$pw) or die("Problemas al conectar"); 
                                                                            mysql_select_db($db,$con) or die("Problemas al conectar con la base"); 
                                                                            $QUERY = mysql_query("SELECT NumeroTransaccion FROM librodiario order by NumeroTransaccion desc", $con); 
                                                                            $resultado = mysql_fetch_row($QUERY);
                                                                            if(!isset($resultado)){
                                                                              $numero = 0;
                                                                            }else{
                                                                              $numero = $resultado[0]+1;
                                                                            }

                                                                            echo "'".$numero."'"; 
                                                                        ?>  readonly></td>
                <td><input type="date" name="bday" max=<?php echo '"'.date('Y-m-d').'"';  ?> ></td>
                </tr>
            </table>
            <table class="tablaEntrada1" style="border-spacing: 10px; width: 100%; text-aling=center; ">
                <tr>
                <th>Cuenta</th>
                <th>Deber</th>
                <th>Haber</th>
                </tr>
                <?php
                    if(isset($_GET['u'])){
                    $u=$_GET['u'];  
                      }
                    else {
                      $u=2;
                      }
                    for($i=0;$i<$u;$i++){
                      imprime_celdas($i);
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
            <table  class="tablaEntrada" style=" width: 100%; text-aling=left;" >
            <tr>
              <td><b>N° Partida</b></td>
              <td><b>Fecha de Registro</b></td>
              <td><b>Codigo</b></td>
              <td><b>Nombre de la Cuenta afectada</b></td>
              <td><b>Cargo</b></td>
              <td><b>Abono</b></td>
            </tr>
            <br>
            <br>
            <br>
            <br>
            <h1>Ultimas transacciones registradas</h1>
            <?php  
              include("conexion.php");
              $link = @mysql_connect($host, $user,$pw)
                  or die ("Error al conectar a la base de datos.");
              @mysql_select_db($db, $link)
                  or die ("Error al conectar a la base de datos.");

              $query = "SELECT * FROM librodiario ORDER BY NumeroTransaccion desc";
              $result = mysql_query($query);
              $numero = 0;
              $i=0;
             for($i; $i<10; $i++){
                $row=mysql_fetch_array($result);              
                echo "<tr><td><font face=\"verdana\">".$row["NumeroTransaccion"]."</font></td>";
                echo "<td><font face=\"verdana\">".$row["FechaLibroDiario"]."</font></td>"; 
                echo "<td><font face=\"verdana\">".$row["CodigoCuenta"]."</font></td>";
                $setencia="SELECT NombreCuenta FROM  catalogodecuentas WHERE CodCuenta=".$row['CodigoCuenta'] ;
                $nombrecuenta=mysql_query($setencia, $link);
                $roww=mysql_fetch_array($nombrecuenta);
                echo "<td class=\"izquierda\"><font face=\"verdana\">".$roww['NombreCuenta']."</font></td>";
                echo "<td><font face=\"verdana\">".$row["CargoLibroDiario"]."</font></td>";  
                echo "<td><font face=\"verdana\">".$row["AbonoLibroDiario"]."</font></td></tr>";
                $numero++;
              
              }
              echo "<tr><td colspan=\"15\"><font face=\"verdana\"><b>Ultimas transacciones que se muestran: " . $numero . 
                  "</b></font></td></tr>";
              
              mysql_free_result($result);
              mysql_close($link);
            ?>
            </table>
        </form>

        <?php 
          switch ($_POST['boton']) {
            case 'Registrar':{
              include("conexion.php"); 
              $con=mysql_connect($host,$user,$pw) or die("Problemas al conectar"); 
              mysql_select_db($db,$con) or die("Problemas al conectar con la base"); 
              $cuentas=$_POST['cuenta'];
              $deber=$_POST['deber'];
              $haber=$_POST['haber'];

              for($i=0; $i<$u; $i++){    
                  $sql = "INSERT INTO librodiario VALUES(".$numero.",".$cuentas[$i].",".$deber[$i].",".$haber[$i].",'".date('Y-m-d')."')"; 
                  //echo $sql;
                  $QUERY = mysql_query($sql, $con); 
                  // TODO ILOGIC Codigo hereeeeeeeeee
                  $sql2= "SELECT CodigoLibroMayor, CodigoCuenta, CargoLibroMayor, AbonoLibroMayor, SaldoLibroMayor FROM libromayor WHERE CodigoCuenta=".$cuentas[$i];
                  $Resultados2= mysql_query($sql2,$con);
                    $arreglo = mysql_fetch_row($Resultados2);
                    $cargomayor = $arreglo[2];
                    $abonomayor = $arreglo[3];
                    $cargomayor = $cargomayor+$deber[$i];
                    $abonomayor = $abonomayor+$haber[$i];
                    $sql3="SELECT `CodCuenta`, `NombreCuenta`, `TipoCuenta` FROM `catalogodecuentas` WHERE CodCuenta=".$cuentas[$i];
                    $Resultados3=mysql_query($sql3,$con);

                    $arreglo2=mysql_fetch_array($Resultados3);
                          if(strcmp('Deudora', $arreglo2[2]) == 0){
                            $sql4="UPDATE libromayor SET CodigoCuenta=".$cuentas[$i].",CargoLibroMayor=".$cargomayor.",AbonoLibroMayor=".$abonomayor.",SaldoLibroMayor=".($cargomayor-$abonomayor)." WHERE CodigoCuenta=".$cuentas[$i];
                            mysql_query($sql4,$con);
                         }else{
                           $sql4="UPDATE  libromayor SET CodigoCuenta=".$cuentas[$i].", CargoLibroMayor=".$cargomayor.",AbonoLibroMayor=".$abonomayor.", SaldoLibroMayor=".($abonomayor-$cargomayor)." WHERE CodigoCuenta=".$cuentas[$i];
                            mysql_query($sql4,$con);
                         }
                      }              
                  //$resultado = mysql_fetch_row($QUERY);
              }

              ?>
                <script languaje="javascript">
                  alert("Inserción Exitosa");
                  window.location.reload();
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
