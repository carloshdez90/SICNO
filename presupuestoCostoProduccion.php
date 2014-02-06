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

  <script>

      function totalSum(){
        var suma = 0;
        suma = parseInt(document.formulario.matPrima13.value) + parseInt(document.formulario.manoObra13.value) + parseInt(document.formulario.CIF13.value);
               document.formulario.TOTAL13.value=suma;
      }

      function Calcular(v,n,str){
        //alert(n+" "+str);
        var suma = 0;

        switch(v)
        {
        case 'm':
            suma = parseInt(document.formulario.matPrima1.value) + parseInt(document.formulario.matPrima2.value) + parseInt(document.formulario.matPrima3.value)+ parseInt(document.formulario.matPrima4.value)+ parseInt(document.formulario.matPrima5.value)+ parseInt(document.formulario.matPrima6.value)+ parseInt(document.formulario.matPrima7.value)+ parseInt(document.formulario.matPrima8.value)+ parseInt(document.formulario.matPrima9.value)+ parseInt(document.formulario.matPrima10.value)+ parseInt(document.formulario.matPrima11.value)+ parseInt(document.formulario.matPrima12.value); 
            document.formulario.matPrima13.value=suma; 
          break;

        case 'mo':
            suma = parseInt(document.formulario.manoObra1.value) + parseInt(document.formulario.manoObra2.value) + parseInt(document.formulario.manoObra3.value)+ parseInt(document.formulario.manoObra4.value)+ parseInt(document.formulario.manoObra5.value)+ parseInt(document.formulario.manoObra6.value)+ parseInt(document.formulario.manoObra7.value)+ parseInt(document.formulario.manoObra8.value)+ parseInt(document.formulario.manoObra9.value)+ parseInt(document.formulario.manoObra10.value)+ parseInt(document.formulario.manoObra11.value)+ parseInt(document.formulario.manoObra12.value); 
            document.formulario.manoObra13.value=suma;
          break;

        case 'c':
           suma = parseInt(document.formulario.CIF1.value) + parseInt(document.formulario.CIF2.value) + parseInt(document.formulario.CIF3.value)+ parseInt(document.formulario.CIF4.value)+ parseInt(document.formulario.CIF5.value)+ parseInt(document.formulario.CIF6.value)+ parseInt(document.formulario.CIF7.value)+ parseInt(document.formulario.CIF8.value)+ parseInt(document.formulario.CIF9.value)+ parseInt(document.formulario.CIF10.value)+ parseInt(document.formulario.CIF11.value)+ parseInt(document.formulario.CIF12.value); 
           document.formulario.CIF13.value=suma;
          break;

        case 't':
            suma = parseInt(document.formulario.TOTAL1.value) + parseInt(document.formulario.TOTAL2.value) + parseInt(document.formulario.TOTAL3.value)+ parseInt(document.formulario.TOTAL4.value)+ parseInt(document.formulario.TOTAL5.value)+ parseInt(document.formulario.TOTAL6.value)+ parseInt(document.formulario.TOTAL7.value)+ parseInt(document.formulario.TOTAL8.value)+ parseInt(document.formulario.TOTAL9.value)+ parseInt(document.formulario.TOTAL10.value)+ parseInt(document.formulario.TOTAL11.value)+ parseInt(document.formulario.TOTAL12.value); 
            document.formulario.TOTAL3.value=suma;
          break;

        default:
          alert('wtf');
        }


        
        switch(n)
        {
        case 1:
            suma = parseInt(document.formulario.matPrima1.value) + parseInt(document.formulario.manoObra1.value) + parseInt(document.formulario.CIF1.value);
            document.formulario.TOTAL1.value=suma; totalSum();
          break;

        case 2:
            suma = parseInt(document.formulario.matPrima2.value) + parseInt(document.formulario.manoObra2.value) + parseInt(document.formulario.CIF2.value);
            document.formulario.TOTAL2.value=suma; totalSum();
          break;

        case 3:
            suma = parseInt(document.formulario.matPrima3.value) + parseInt(document.formulario.manoObra3.value) + parseInt(document.formulario.CIF3.value);
            document.formulario.TOTAL3.value=suma; totalSum();
          break;

        case 4:
            suma = parseInt(document.formulario.matPrima4.value) + parseInt(document.formulario.manoObra4.value) + parseInt(document.formulario.CIF4.value);
            document.formulario.TOTAL4.value=suma; totalSum();
          break;

        case 5:
            suma = parseInt(document.formulario.matPrima5.value) + parseInt(document.formulario.manoObra5.value) + parseInt(document.formulario.CIF5.value);
            document.formulario.TOTAL5.value=suma; totalSum();
          break;

        case 6:
            suma = parseInt(document.formulario.matPrima6.value) + parseInt(document.formulario.manoObra6.value) + parseInt(document.formulario.CIF6.value);
            document.formulario.TOTAL6.value=suma; totalSum();
          break; 

        case 7:
            suma = parseInt(document.formulario.matPrima7.value) + parseInt(document.formulario.manoObra7.value) + parseInt(document.formulario.CIF7.value);
            document.formulario.TOTAL7.value=suma; totalSum();
          break;

        case 8:
            suma = parseInt(document.formulario.matPrima8.value) + parseInt(document.formulario.manoObra8.value) + parseInt(document.formulario.CIF8.value);
            document.formulario.TOTAL8.value=suma; totalSum();
          break;

        case 9:
            suma = parseInt(document.formulario.matPrima9.value) + parseInt(document.formulario.manoObra9.value) + parseInt(document.formulario.CIF9.value);
            document.formulario.TOTAL9.value=suma; totalSum();
          break;

        case 10:
            suma = parseInt(document.formulario.matPrima10.value) + parseInt(document.formulario.manoObra10.value) + parseInt(document.formulario.CIF10.value);
            document.formulario.TOTAL10.value=suma; totalSum();
          break;

        case 11:
            suma = parseInt(document.formulario.matPrima11.value) + parseInt(document.formulario.manoObra11.value) + parseInt(document.formulario.CIF11.value);
            document.formulario.TOTAL11.value=suma; totalSum();
          break;

        case 12:
            suma = parseInt(document.formulario.matPrima12.value) + parseInt(document.formulario.manoObra12.value) + parseInt(document.formulario.CIF12.value);
            document.formulario.TOTAL12.value=suma; totalSum();
          break;
        
        default:
          alert('wtf');
        }
           
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
      <div class="content" style="width:100%;">
        <!--********************************************************************* -->
          <div>
          <h1>Orden de Producción</h1>

          <form  name="formulario" action="ORDEN.php" method="post">
            <table class="tablaEntrada" style="border-spacing: 10px; width: 100%; text-aling=left;">
               <tr>
                 <td style="border-spacing: 10px;"><span class='valores'>Empresa:</span></td>
                 <td >Empresa Maderera</td>
                 <td ><span class='valores'>N° de Orden:</span></td>
                 <td>Partida N°: <input size= 5 name="norden" type="text" value= <?php 
                                                                            include("conexion.php"); 
                                                                            $con=mysql_connect($host,$user,$pw) or die("Problemas al conectar"); 
                                                                            mysql_select_db($db,$con) or die("Problemas al conectar con la base"); 
                                                                            $QUERY = mysql_query("SELECT numOrden FROM ordenes order by numOrden desc", $con); 
                                                                            $resultado = mysql_fetch_row($QUERY);
                                                                            if(!isset($resultado)){
                                                                              $numero = 0;
                                                                            }else{
                                                                              $numero = $resultado[0]+1;
                                                                            }

                                                                            echo "'".$numero."'"; 
                                                                        ?>  readonly></td>
               </tr>
               <tr></tr>
               <tr>
                 <td ><span class='valores'>Cliente:</span></td>
                 <td ><input class='datos' id="cliente" name="CLIENTE" type="text" value=""></td>
                 <td ><span class='valores'>Fecha:</span></td>
                 <td ><?php $fecha = date("d/m/Y"); echo "<b>".$fecha."</b>"; ?></td>
               </tr>
               <tr>
                 <td ><span class='valores'>Producto:</span></td>
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
                        </select>
                  </td>
                 <td ><span class='valores'>Cantidad:</span></td>
                 <td ><input size = 20 class='datos' id="cant" name="CANTIDAD" type="text" value=""></td>
               </tr>
               <tr><td ><span class='valores'>Fecha Entrega de Orden:</span></td>
                   <td ><input type="date" min=<?php echo date('Y-m-d'); ?> name="mes"></td>
                </tr>
              </table>

              <table class="tablaEntrada" style="width: 100%; text-aling=left;">
                 <tr>
                    <td><strong>Proceso</strong></td>
                    <td><strong>Materia Prima</strong></td>
                    <td><strong>Mano de Obra</strong></td>
                    <td><strong>CIF</strong></td>
                    <td><strong>TOTAL</strong></td>
                  </tr>
                  <tr>
                    <td>Corte (Sierra Circular)</td>
                    <td><input class = "valores" onkeyup="Calcular('m',1,this.value)" value='0' id="matPrima1" type="number" pattern="[0-9]+([\.|,][0-9]+)?" step="0.01" title="Solo se permiten dos decimales" /></td>
                    <td><input class = "valores" onkeyup="Calcular('mo',1,this.value)" value='0' id="manoObra1" type="number" pattern="[0-9]+([\.|,][0-9]+)?" step="0.01" title="Solo se permiten dos decimales" /></td>
                    <td><input class = "valores" onkeyup="Calcular('c',1,this.value)" value='0' id="CIF1" type="number" pattern="[0-9]+([\.|,][0-9]+)?" step="0.01" title="Solo se permiten dos decimales" /></td>
                    <td><input class = "valores" onkeyup="Calcular('t',1,this.value)" value='0' id="TOTAL1" type="number" pattern="[0-9]+([\.|,][0-9]+)?" step="0.01" title="Solo se permiten dos decimales"  readonly/></td>
                  </tr>
                  <tr>
                    <td>Cepillado</td>
                    <td><input class = "valores" onkeyup="Calcular('m',2,this.value)" value='0' id="matPrima2" type="number" pattern="[0-9]+([\.|,][0-9]+)?" step="0.01" title="Solo se permiten dos decimales" /></td>
                    <td><input class = "valores" onkeyup="Calcular('mo',2,this.value)" value='0' id="manoObra2" type="number" pattern="[0-9]+([\.|,][0-9]+)?" step="0.01" title="Solo se permiten dos decimales" /></td>
                    <td><input class = "valores" onkeyup="Calcular('c',2,this.value)" value='0' id="CIF2" type="number" pattern="[0-9]+([\.|,][0-9]+)?" step="0.01" title="Solo se permiten dos decimales" /></td>
                    <td><input class = "valores" onkeyup="Calcular('t',2,this.value)" value='0' id="TOTAL2" type="number" pattern="[0-9]+([\.|,][0-9]+)?" step="0.01" title="Solo se permiten dos decimales" readonly/></td>
                  </tr>
                  <tr>
                    <td>Trazado</td>
                    <td><input class = "valores" onkeyup="Calcular('m',3,this.value)" value='0' id="matPrima3" type="number" pattern="[0-9]+([\.|,][0-9]+)?" step="0.01" title="Solo se permiten dos decimales" /></td>
                    <td><input class = "valores" onkeyup="Calcular('mo',3,this.value)" value='0' id="manoObra3" type="number" pattern="[0-9]+([\.|,][0-9]+)?" step="0.01" title="Solo se permiten dos decimales" /></td>
                    <td><input class = "valores" onkeyup="Calcular('c',3,this.value)" value='0' id="CIF3" type="number" pattern="[0-9]+([\.|,][0-9]+)?" step="0.01" title="Solo se permiten dos decimales" /></td>
                    <td><input class = "valores" onkeyup="Calcular('t',3,this.value)" value='0' id="TOTAL3" type="number" pattern="[0-9]+([\.|,][0-9]+)?" step="0.01" title="Solo se permiten dos decimales" readonly/></td>
                  </tr>
                 <tr>
                    <td>Corte (Sierra Cinta)</td>
                    <td><input class = "valores" onkeyup="Calcular('m',4,this.value)" value='0' id="matPrima4" type="number" pattern="[0-9]+([\.|,][0-9]+)?" step="0.01" title="Solo se permiten dos decimales" /></td>
                    <td><input class = "valores" onkeyup="Calcular('mo',4,this.value)" value='0' id="manoObra4" type="number" pattern="[0-9]+([\.|,][0-9]+)?" step="0.01" title="Solo se permiten dos decimales" /></td>
                    <td><input class = "valores" onkeyup="Calcular('c',4,this.value)" value='0' id="CIF4" type="number" pattern="[0-9]+([\.|,][0-9]+)?" step="0.01" title="Solo se permiten dos decimales" /></td>
                    <td><input class = "valores" onkeyup="Calcular('t',4,this.value)" value='0' id="TOTAL4" type="number" pattern="[0-9]+([\.|,][0-9]+)?" step="0.01" title="Solo se permiten dos decimales" readonly/></td>
                  </tr>
                  <tr>
                    <td>Bocelado</td>
                    <td><input class = "valores" onkeyup="Calcular('m',5,this.value)" value='0' id="matPrima5" type="number" pattern="[0-9]+([\.|,][0-9]+)?" step="0.01" title="Solo se permiten dos decimales" /></td>
                    <td><input class = "valores" onkeyup="Calcular('mo',5,this.value)" value='0' id="manoObra5" type="number" pattern="[0-9]+([\.|,][0-9]+)?" step="0.01" title="Solo se permiten dos decimales" /></td>
                    <td><input class = "valores" onkeyup="Calcular('c',5,this.value)" value='0' id="CIF5" type="number" pattern="[0-9]+([\.|,][0-9]+)?" step="0.01" title="Solo se permiten dos decimales" /></td>
                    <td><input class = "valores" onkeyup="Calcular('t',5,this.value)" value='0' id="TOTAL5" type="number" pattern="[0-9]+([\.|,][0-9]+)?" step="0.01" title="Solo se permiten dos decimales" readonly/></td>
                  </tr>
                  <tr>
                    <td>Taladro</td>
                    <td><input class = "valores" onkeyup="Calcular('m',6,this.value)" value='0' id="matPrima6" type="number" pattern="[0-9]+([\.|,][0-9]+)?" step="0.01" title="Solo se permiten dos decimales" /></td>
                    <td><input class = "valores" onkeyup="Calcular('mo',6,this.value)" value='0' id="manoObra6" type="number" pattern="[0-9]+([\.|,][0-9]+)?" step="0.01" title="Solo se permiten dos decimales" /></td>
                    <td><input class = "valores" onkeyup="Calcular('c',6,this.value)" value='0' id="CIF6" type="number" pattern="[0-9]+([\.|,][0-9]+)?" step="0.01" title="Solo se permiten dos decimales" /></td>
                    <td><input class = "valores" onkeyup="Calcular('t',6,this.value)" value='0' id="TOTAL6" type="number" pattern="[0-9]+([\.|,][0-9]+)?" step="0.01" title="Solo se permiten dos decimales" readonly/></td>
                  </tr>
                  <tr>
                    <td>Armado</td>
                    <td><input class = "valores" onkeyup="Calcular('m',7,this.value)" value='0' id="matPrima7" type="number" pattern="[0-9]+([\.|,][0-9]+)?" step="0.01" title="Solo se permiten dos decimales" /></td>
                    <td><input class = "valores" onkeyup="Calcular('mo',7,this.value)" value='0' id="manoObra7" type="number" pattern="[0-9]+([\.|,][0-9]+)?" step="0.01" title="Solo se permiten dos decimales" /></td>
                    <td><input class = "valores" onkeyup="Calcular('c',7,this.value)" value='0' id="CIF7" type="number" pattern="[0-9]+([\.|,][0-9]+)?" step="0.01" title="Solo se permiten dos decimales" /></td>
                    <td><input class = "valores" onkeyup="Calcular('t',7,this.value)" value='0' id="TOTAL7" type="number" pattern="[0-9]+([\.|,][0-9]+)?" step="0.01" title="Solo se permiten dos decimales" readonly/></td>
                  </tr>
                  <tr>
                    <td>Macillado</td>
                    <td><input class = "valores" onkeyup="Calcular('m',8,this.value)" value='0' id="matPrima8" type="number" pattern="[0-9]+([\.|,][0-9]+)?" step="0.01" title="Solo se permiten dos decimales" /></td>
                    <td><input class = "valores" onkeyup="Calcular('mo',8,this.value)" value='0' id="manoObra8" type="number" pattern="[0-9]+([\.|,][0-9]+)?" step="0.01" title="Solo se permiten dos decimales" /></td>
                    <td><input class = "valores" onkeyup="Calcular('c',8,this.value)" value='0' id="CIF8" type="number" pattern="[0-9]+([\.|,][0-9]+)?" step="0.01" title="Solo se permiten dos decimales" /></td>
                    <td><input class = "valores" onkeyup="Calcular('t',8,this.value)" value='0' id="TOTAL8" type="number" pattern="[0-9]+([\.|,][0-9]+)?" step="0.01" title="Solo se permiten dos decimales" readonly/></td>
                  </tr>
                  <tr>
                    <td>Pulido</td>
                    <td><input class = "valores" onkeyup="Calcular('m',9,this.value)" value='0' id="matPrima9" type="number" pattern="[0-9]+([\.|,][0-9]+)?" step="0.01" title="Solo se permiten dos decimales" /></td>
                    <td><input class = "valores" onkeyup="Calcular('mo',9,this.value)" value='0' id="manoObra9" type="number" pattern="[0-9]+([\.|,][0-9]+)?" step="0.01" title="Solo se permiten dos decimales" /></td>
                    <td><input class = "valores" onkeyup="Calcular('c',9,this.value)" value='0' id="CIF9" type="number" pattern="[0-9]+([\.|,][0-9]+)?" step="0.01" title="Solo se permiten dos decimales" /></td>
                    <td><input class = "valores" onkeyup="Calcular('t',9,this.value)" value='0' id="TOTAL9" type="number" pattern="[0-9]+([\.|,][0-9]+)?" step="0.01" title="Solo se permiten dos decimales" readonly/></td>
                  </tr>
                  <tr>
                    <td>Pintado</td>
                    <td><input class = "valores" onkeyup="Calcular('m',10,this.value)" value='0' id="matPrima10" type="number" pattern="[0-9]+([\.|,][0-9]+)?" step="0.01" title="Solo se permiten dos decimales" /></td>
                    <td><input class = "valores" onkeyup="Calcular('mo',10,this.value)" value='0' id="manoObra10" type="number" pattern="[0-9]+([\.|,][0-9]+)?" step="0.01" title="Solo se permiten dos decimales" /></td>
                    <td><input class = "valores" onkeyup="Calcular('c',10,this.value)" value='0' id="CIF10" type="number" pattern="[0-9]+([\.|,][0-9]+)?" step="0.01" title="Solo se permiten dos decimales" /></td>
                    <td><input class = "valores" onkeyup="Calcular('t',10,this.value)" value='0' id="TOTAL10" type="number" pattern="[0-9]+([\.|,][0-9]+)?" step="0.01" title="Solo se permiten dos decimales" readonly/></td>
                  </tr>
                  <tr>
                    <td>Tapizado y Vidrio</td>
                    <td><input class = "valores" onkeyup="Calcular('m',11,this.value)" value='0' id="matPrima11" type="number" pattern="[0-9]+([\.|,][0-9]+)?" step="0.01" title="Solo se permiten dos decimales" /></td>
                    <td><input class = "valores" onkeyup="Calcular('mo',11,this.value)" value='0' id="manoObra11" type="number" pattern="[0-9]+([\.|,][0-9]+)?" step="0.01" title="Solo se permiten dos decimales" /></td>
                    <td><input class = "valores" onkeyup="Calcular('c',11,this.value)" value='0' id="CIF11" type="number" pattern="[0-9]+([\.|,][0-9]+)?" step="0.01" title="Solo se permiten dos decimales" /></td>
                    <td><input class = "valores" onkeyup="Calcular('t',11,this.value)" value='0' id="TOTAL11" type="number" pattern="[0-9]+([\.|,][0-9]+)?" step="0.01" title="Solo se permiten dos decimales" readonly/></td>
                  </tr>
                  <tr>
                    <td>Otros</td>
                    <td><input class = "valores" onkeyup="Calcular('m',12,this.value)" value='0' id="matPrima12" type="number" pattern="[0-9]+([\.|,][0-9]+)?" step="0.01" title="Solo se permiten dos decimales" /></td>
                    <td><input class = "valores" onkeyup="Calcular('mo',12,this.value)" value='0' id="manoObra12" type="number" pattern="[0-9]+([\.|,][0-9]+)?" step="0.01" title="Solo se permiten dos decimales" /></td>
                    <td><input class = "valores" onkeyup="Calcular('c',12,this.value)" value='0' id="CIF12" type="number" pattern="[0-9]+([\.|,][0-9]+)?" step="0.01" title="Solo se permiten dos decimales" /></td>
                    <td><input class = "valores" onkeyup="Calcular('t',12,this.value)" value='0' id="TOTAL12" type="number" pattern="[0-9]+([\.|,][0-9]+)?" step="0.01" title="Solo se permiten dos decimales" readonly/></td>
                  </tr>
                  <tr>
                    <td>TOTAL</td>
                    <td><input class = "valores" onkeyup="Calcular('m',13,this.value)" value='0' id="matPrima13" name='MP' type="number" pattern="[0-9]+([\.|,][0-9]+)?" step="0.01" title="Solo se permiten dos decimales" readonly/></td>
                    <td><input class = "valores" onkeyup="Calcular('mo',13,this.value)" value='0' id="manoObra13" name='MOD' type="number" pattern="[0-9]+([\.|,][0-9]+)?" step="0.01" title="Solo se permiten dos decimales" readonly/></td>
                    <td><input class = "valores" onkeyup="Calcular('c',13,this.value)" value='0' id="CIF13" name= 'CIF' type="number" pattern="[0-9]+([\.|,][0-9]+)?" step="0.01" title="Solo se permiten dos decimales" readonly/></td>
                    <td><input class = "valores" onkeyup="Calcular('t',13,this.value)" value='0' id="TOTAL13" name ='TOTAL_TOTAL' type="number" pattern="[0-9]+([\.|,][0-9]+)?" step="0.01" title="Solo se permiten dos decimales" readonly/></td>
                  </tr>
                  <tr>
                    <td colspan="5">
                      <input class='boton' onclick="formReset()" name="boton" type="submit"  value="Cancelar">
                      <input class='boton' name="boton" type="submit"  value="Enviar a Producción">
                    </td>  
                  </tr>           
            
              </table>
            </form>
      </div>        
        <!--********************************************************************* -->
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
