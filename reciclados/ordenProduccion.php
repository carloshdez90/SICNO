<!DOCTYPE HTML>
<?php 
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
      <div class="content">
        <div>
          <h1>Orden de Producción</h1>

          <form action="" method="post">
            <table class="tablaEntrada" style="border-spacing: 10px; width: 100%; text-aling=left;">
               <tr>
                 <td style="border-spacing: 10px;"><span class='valores'>Empresa:</span></td>
                 <td >Empresa Maderera</td>
                 <td ><span class='valores'>N° de Orden:</span></td>
                 <td ><?php $fecha = date("d m Y"); echo "<b>".$fecha."</b>"; ?></td>
               </tr>
               <tr></tr>
               <tr>
                 <td ><span class='valores'>Cliente:</span></td>
                 <td ><input class='datos' id="cliente" name="txtDepo" type="text" value=""></td>
                 <td ><span class='valores'>Fecha:</span></td>
                 <td ><?php $fecha = date("d/m/Y"); echo "<b>".$fecha."</b>"; ?></td>
               </tr>
              </table>

               <table class="tablaEntrada" style="border-spacing: 10px; width: 100%; text-aling=left;">
               <tr>
                 <td ><span class='valores'>Cantidad</span></td>
                 <td ><span class='valores'>Productos</span></td>
                 <td ><span class='valores'>Especificación de materiales</span></td>
               </tr>
               <tr>
                 <td ><input class='datos' name="cantidad" type="number"  min="1" title = "Debe ser un número mayor que cero" placeholder="Cantidad"/></td>
                 <td ><select name="productos">
                          <option value="Silla">Silla</option>
                          <option value="Mesa">Mesa</option>
                          <option value="Comedor">Comedor</option>
                          <option value="Perchero">Perchero</option>
                          <option value="Juguetera">Juguetera</option>
                          <option value="Banquito">Banquito</option>
                          <option value="Closet">Closet</option>
                          <option value="Puerta">Puerta</option>
                          <option value="Ventana">Ventana</option>
                        </select> </td>
                 <td ><input class='datos' name="especificacion" type="text" placeholder="Especificaciones Materiales"/></td>
               </tr>
               <tr>
                  <td colspan="3">
                    <input class='boton' onclick="formReset()" name="boton" type="submit"  value="Limpiar">
                    <input class='boton' name="boton" type="submit"  value="Agregar">
                    <input type="hidden" value="anadir" name="accion"> <!-- de la tabla dinamica -->
                  </td>
               </tr>
              </table>

              <table class="tablaEntrada" style=" width: 100%; text-aling=left;">
               <tr>
                 <td ><span class='valores'>Cantidad</span></td>
                 <td ><span class='valores'>Productos</span></td>
                 <td ><span class='valores'>Especificación</span></td>
               </tr>
               
               <!-- Creacion de la tabla dinamica -->
                
                <?php 
                    //para la tabla dinamica
                  switch( $_POST['boton'] ) {
                    case "Agregar":{
                      
                      if($_POST['accion']=="anadir") {

                          $_SESSION['datos'][$_SESSION['contador']][0]=$_POST['cantidad'];
                          $_SESSION['datos'][$_SESSION['contador']][1]=$_POST['productos'];
                          $_SESSION['datos'][$_SESSION['contador']][2]=$_POST['especificacion'];       
                          $_SESSION['contador']=$_SESSION['contador']+1;
                      }
                       break;
                    } //del case Agregar

                    case "Confirmar":{
                       
                    } //del case Limpiar

                    case "Cancelar":{
                        $_SESSION['contador']=0;
                        break;
                    } //del case Limpiar
                  }
                ?>         


                <?php

                for($i=0;$i<$_SESSION['contador'];$i++) {

                  echo "
                    <tr>
                      <td> <input name='cantidad".$i."' type=\"number\"  min=\"1\" title = \"Debe ser un número mayor que cero\" value=\"".$_SESSION['datos'][$i][0]."\"/> </td>
                      <td> <input name='productos".$i."' type=\"text\" title=\"Productos\" value=\"".$_SESSION['datos'][$i][1]."\"  readonly/> </td>
                      <td> <input name='especificacion".$i."' type=\"text\" title=\"Especificaciones\" value=\"".$_SESSION['datos'][$i][2]."\"/> </td>
                    </tr>
                  ";
                }
              ?>

              <td colspan="3">
                    <input class='boton' name="boton" type="submit"  value="Cancelar">
                    <input class='boton' name="boton" type="submit"  value="Confirmar">
              </td>
              <!-- Creacion de la tabla dinamica -->
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
</body>
</html>
