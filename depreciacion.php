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
      <!-- *********************************************************************** -->
      <div class="content" style='width : 100%; border: 1px solid white; border-radius: 20px 20px 20px 20px; box-shadow: inset 0 0 50px red;'>
        <div>
          <h1>Cálculo de la depreciación de Activos fijos<br>para el año actual</h1>
          <form method='post'>
          <table  class="tablaEntrada" style=" width: 100%; text-aling=left;" >
          <tr>
            <td><b>Codigo</b></td>
            <td><b>Descrípcion</b></td>
            <td><b>costo<br>inicial</b></td>
            <td><b>Vida<br>Económica<br>(En años)</b></td>
            <td><b>Valor en<br>libros</b></td>
            <td><b>vida<br>restante</b></td>
            <td><b>Depreciacion<br>Anual</b></td>
            <td><b>Estado</b></td>

          </tr>

            <?php  
              include("conexion.php");
              $link = @mysql_connect($host, $user,$pw)
                  or die ("Error al conectar a la base de datos.");
              @mysql_select_db($db, $link)
                  or die ("Error al conectar a la base de datos.");

              $query = "SELECT * FROM afijo";
              $result = mysql_query($query);
              $numero = 0;
              while($row = mysql_fetch_array($result))
              {
                echo "<tr><td ><font face=\"verdana\">".$row["codigo"] . "</font></td>";
                echo "<td><font face=\"verdana\">".$row["descripcion"] . "</font></td>"; 
                echo "<td><font face=\"verdana\">".$row["costo"] . "</font></td>";
                echo "<td><font face=\"verdana\">".$row["vidaEco"] . "</font></td>";
                //$VL=$row["costo"]-$row["depreciacion"];
                mysql_query("UPDATE afijo SET aniosVida=".$row['vidaEco']-1);
                echo "<td><font face=\"verdana\">".$row["VL"]."</font></td>";  
                echo "<td><font face=\"verdana\">".$row["aniosVida"] . "</font></td>";
                echo "<td><font face=\"verdana\">".$row["depreciacion"]."</font></td>";    
                echo "<td><font face=\"verdana\">".$row["estado"]."</font></td></tr>";    
                $numero++;
                $transaccion+=$row['depreciacion'];
              }
              echo "<tr><td colspan=\"15\"><font face=\"verdana\"><b>Total Activos Fijos: " . $numero . 
                  "</b></font></td></tr>";
              
              mysql_free_result($result);
              mysql_close($link);
            ?>
            
              <tr>
                <td colspan="8">
                    <input class='boton' name="boton" type="submit"  value="Aplicar depreciacion">
              </td>
              </tr>
           </table>
        </form>
          <!-- ***************************************PARTIDAS PARA DEPRECIACION DE MAQUINARIA Y EQUIPO******************************** -->

                    <?php 
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
                    ?>
                   <?php 
                  switch ($_POST['boton']) {
                    case 'Aplicar depreciacion':{
                      include("conexion.php"); 
                      $con=mysql_connect($host,$user,$pw) or die("Problemas al conectar"); 
                      mysql_select_db($db,$con) or die("Problemas al conectar con la base"); 
                      $ME='Mobiliario y equipo';
                      $DP='DA de mobiliaria y equipo';
                                  
                      $sqlME = "INSERT INTO librodiario(NumeroTransaccion, CodigoCuenta, CargoLibroDiario, AbonoLibroDiario, FechaLibroDiario)
                       VALUES(".$numero.",'121203', 0 ,".$transaccion.",'".date('Y-m-d')."')"; 
                      $sqlDP = "INSERT INTO librodiario(NumeroTransaccion, CodigoCuenta, CargoLibroDiario, AbonoLibroDiario, FechaLibroDiario)
                       VALUES(".$numero.",'12120803',".$transaccion.",0,'".date('Y-m-d')."')"; 
                      $sqlMEMayor= "SELECT CodigoLibroMayor, CodigoCuenta, CargoLibroMayor, AbonoLibroMayor, SaldoLibroMayor FROM libromayor WHERE CodigoCuenta=121203";
                      $sqlDPMayor= "SELECT CodigoLibroMayor, CodigoCuenta, CargoLibroMayor, AbonoLibroMayor, SaldoLibroMayor FROM libromayor WHERE CodigoCuenta=12120803";

                      $QUERY1 = mysql_query($sqlME, $con); 
                      $QUERY2 = mysql_query($sqlDP, $con); 
                      $QUERY3 = mysql_query($sqlMEMayor, $con);
                      $QUERY4 = mysql_query($sqlMEMayor, $con);    
                            $arreglo1 = mysql_fetch_row($QUERY3);
                              $cargomayor1 = $arreglo2[2];  
                              $abonomayor1 = $arreglo1[3];
                              $abonomayor1+=$transaccion;

                            $arreglo2 = mysql_fetch_row($QUERY4);
                              $cargomayor2 = $arreglo2[2];   
                              $abonomayor2 = $arreglo1[3];
                              $cargomayor2+=$transaccion;

                            $updatecargo="UPDATE libromayor SET CargoLibroMayor=".$cargomayor2.",SaldoLibroMayor=".($cargomayor2-$abonomayor2)." WHERE CodigoCuenta = 12120803";
                            $updateabono= "UPDATE libromayor SET AbonoLibroMayor=".$abonomayor1.",SaldoLibroMayor=".($cargomayor1-$abonomayor1)." WHERE CodigoCuenta = 12120803";

                            mysql_query($updatecargo,$con);
                            mysql_query($updateabono,$con);
                        
                        $QRY= "SELECT * FROM afijo";
                        $result = mysql_query($QRY);
                        while($row2 = mysql_fetch_array($result))
                        {
                          if(strcmp('sin depreciar', $row["estado"]))
                          {
                             $A="UPDATE afijo SET aniosVida=".($row2["aniosVida"]-1)." WHERE codigo=".$row2["codigo"];
                             $B="UPDATE afijo SET VL=".($row2["VL"]-$row2["depreciacion"])." WHERE codigo =".$row2["codigo"];
                             $C="UPDATE afijo SET estado='depreciado' WHERE codigo=".$row2["codigo"];
                               // echo $A.$B.$C;
                             mysql_query($A,$con);
                             mysql_query($B,$con);
                             mysql_query($C,$con);
                          }                                                          
                       }

                      ?>
                        <script languaje="javascript">
                          alert("Depreciacion aplicada con Exito");
                          window.location.reload();
                        </script>
                      <?php
                      //break;
                    }
                  }   
                  
                ?> 
          </div>
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