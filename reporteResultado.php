<?php 
error_reporting(E_ALL & ~E_NOTICE);
include('fpdf/fpdf.php');
include("conexion.php"); 
            
      $meses = array("Enero","Febrero","Marzo","Abril","Mayo","Junio","Julio","Agosto","Septiembre","Octubre","Noviembre","Diciembre");
            
      function diasMes($month, $year) {
            return date("d",mktime(0,0,0,$month+1,0,$year));
      }


      if (!strcmp($_GET['mes'], "") == 0) {
            $mes = explode('-',$_GET['mes']);

      }else{
            header('Location: balanceResultado.php');
      }
      
      $pdf = new FPDF();
      $pdf->AddPage();
      $pdf->SetFont('Arial', 'B', 16);
      $pdf->Cell(200, 10,'Empresas Madereras de El Salvador', 0, 1, 'C');
      $pdf->Cell(200, 10,'Estado de Resultados', 0, 1, 'C');
      $pdf->Cell(200, 10,'del 01 de '.$meses[$mes[1]-1].' al '.diasMes(date($mes[1]), date($mes[0])).' de '.$meses[$mes[1]-1].' del '.date($mes[0]) , 0, 1, 'C');
      $pdf->Line(0,40,210,40);
      $pdf->Ln(10);
      $pdf->SetFont('Arial', 'B', 14);
      
      $pdf->Ln(10);
      //Tabla con las cuentas
      
      $con=mysql_connect($host,$user,$pw) or die("Problemas al conectar"); 
      mysql_select_db($db,$con) or die("Problemas al conectar con la base"); 

      $queryResultado = mysql_query("SELECT NombreCuenta, SaldoLibroMayor FROM catalogodecuentas, libromayor WHERE  catalogodecuentas.CodCuenta = libromayor.CodigoCuenta order by NombreCuenta asc;", $con);
            
      $nResultados = mysql_fetch_row(mysql_query("SELECT count(tipo2) as n FROM `catalogodecuentas`;", $con));

      $pdf->SetFont('Arial', '', 10);
      $valores = array();
     for($i=0; $i<$nResultados[0]; $i++){

            $resultadoResultados = mysql_fetch_row($queryResultado);
            $valores[$resultadoResultados[0]] = $resultadoResultados[1];                       

      }
            $materiaPrimautilizada = number_format(($valores["venta"]+$valores["costo de materia prima"]-$valores["Inv de materia prima"]), 2);
            $CostosDeFabricacion = number_format($materiaPrimautilizada + $valores["costo de mano de obra directa"] + $valores["Costos indirectos de fabricacion"],2);
            $costoDeLoVendido = number_format($CostosDeFabricacion + $valores["Inv de producto terminado Inic"] - $valores["Inv de producto terminado"],2);
            $UtilidadBruta =  number_format($valores["venta"] - $costoDeLoVendido, 2);             
            $GastosOperacion = number_format($valores["gastos de administracion"]+ $valores["gastos de venta"] + $valores["gastos financieros comisiones bancarias"],2);
            $UtilidadOperacion = number_format($UtilidadBruta -  $GastosOperacion - $valores["DA de mobiliario y equipo"],2);
            $GastosFinancieros = number_format($valores["gastos finacieros intereses"] +  $valores["gastos financieros comisiones bancarias"],2);
            $UAI = number_format($UtilidadOperacion - $GastosFinancieros,2);
            $Impuestos = number_format($valores["IPP sobre renta"] + $valores["IPP sobre patrimonio"] + $valores["IPP municipales"],2);
            $UNP = number_format($UAI - $Impuestos,2);

            
            $pdf->Cell(20, 10, '', 0,'C'); $pdf->SetFont('Arial', 'B', 10);
            $pdf->Cell(80, 10, 'Ventas', 0,'C');
            $pdf->Cell(40, 10, '', 0,'C');
            $pdf->Cell(40, 10, $valores["venta"], 0,'C'); $pdf->SetFont('Arial', '', 10);
            $pdf->Ln(10);

            $pdf->Cell(20, 10, '', 0,'C'); $pdf->SetFont('Arial', 'B', 10); 
            $pdf->Cell(80, 10, 'Costo de lo Vendido', 0,'C');
            $pdf->Cell(40, 10, '', 0,'C');
            $pdf->Cell(40, 10,$costoDeLoVendido, 0,'C'); $pdf->SetFont('Arial', '', 10);
            $pdf->Ln(10);

            $pdf->Cell(20, 10, '', 0,'C');
            $pdf->Cell(80, 10, 'Inventario Inicial Materia Prima', 0,'C');
            $pdf->Cell(40, 10, $valores["Inv de materia prima inic"], 0,'C');
            $pdf->Cell(40, 10, '', 0,'C');
            $pdf->Ln(10);

            $pdf->Cell(20, 10, '', 0,'C');
            $pdf->Cell(80, 10, 'Compras de Materia Prima', 0,'C');
            $pdf->Cell(40, 10, $valores["costo de materia prima"], 0,'C');
            $pdf->Cell(40, 10, '', 0,'C');
            $pdf->Ln(10);

            $pdf->Cell(20, 10, '', 0,'C'); 
            $pdf->Cell(80, 10, 'Inventario Final de Materia Prima', 0,'C'); $pdf->SetFont('Arial', 'U', 10);
            $pdf->Cell(40, 10, $valores["Inv de materia prima"], 0,'C'); $pdf->SetFont('Arial', '', 10);
            $pdf->Cell(40, 10, '', 0,'C');
            $pdf->Ln(10);

            $pdf->Cell(20, 10, '', 0,'C');
            $pdf->Cell(80, 10, 'Materia Prima Utilizada', 0,'C');
            $pdf->Cell(40, 10, $materiaPrimautilizada, 0,'C');
            $pdf->Cell(40, 10, '', 0,'C');
            $pdf->Ln(10);

            $pdf->Cell(20, 10, '', 0,'C'); 
            $pdf->Cell(80, 10, 'Mano de Obra Directa', 0,'C'); 
            $pdf->Cell(40, 10, $valores["costo de mano de obra directa"], 0,'C'); 
            $pdf->Cell(40, 10, '', 0,'C');
            $pdf->Ln(10);

            $pdf->Cell(20, 10, '', 0,'C'); 
            $pdf->Cell(80, 10, 'Gastos Indirectos de Fabricacion', 0,'C');  $pdf->SetFont('Arial', 'U', 10);
            $pdf->Cell(40, 10, $valores["Costos indirectos de fabricacion"], 0,'C'); $pdf->SetFont('Arial', '', 10);
            $pdf->Cell(40, 10, '', 0,'C');
            $pdf->Ln(10);

            $pdf->Cell(20, 10, '', 0,'C'); 
            $pdf->Cell(80, 10, 'Costo de Fabricacion', 0,'C'); 
            $pdf->Cell(40, 10, $CostosDeFabricacion , 0,'C'); 
            $pdf->Cell(40, 10, '', 0,'C');
            $pdf->Ln(10);

            $pdf->Cell(20, 10, '', 0,'C'); 
            $pdf->Cell(80, 10, 'Inventario Inicial de Productos Terminados', 0,'C'); 
            $pdf->Cell(40, 10, $valores["Inv de producto terminado Inic"], 0,'C'); 
            $pdf->Cell(40, 10, '', 0,'C');
            $pdf->Ln(10);

            $pdf->Cell(20, 10, '', 0,'C'); 
            $pdf->Cell(80, 10, 'Inventario Final de Productos Terminados', 0,'C');  $pdf->SetFont('Arial', 'U', 10);
            $pdf->Cell(40, 10, $valores["Inv de producto terminado"], 0,'C'); $pdf->SetFont('Arial', '', 10);
            $pdf->Cell(40, 10, '', 0,'C');
            $pdf->Ln(10);

            $pdf->Cell(20, 10, '', 0,'C'); $pdf->SetFont('Arial', 'B', 10);
            $pdf->Cell(80, 10, 'Utilidad Bruta', 0,'C');
            $pdf->Cell(40, 10, '', 0,'C');
            $pdf->Cell(40, 10,$UtilidadBruta, 0,'C'); $pdf->SetFont('Arial', '', 10);
            $pdf->Ln(10);

            $pdf->Cell(20, 10, '', 0,'C'); $pdf->SetFont('Arial', 'B', 10);
            $pdf->Cell(80, 10, 'Gastos de Operacion', 0,'C');
            $pdf->Cell(40, 10, '', 0,'C');
            $pdf->Cell(40, 10,$GastosOperacion, 0,'C'); $pdf->SetFont('Arial', '', 10);
            $pdf->Ln(10);

            $pdf->Cell(20, 10, '', 0,'C'); 
            $pdf->Cell(80, 10, 'Gastos de Administracion', 0,'C'); 
            $pdf->Cell(40, 10, $valores["gastos de administracion"], 0,'C'); 
            $pdf->Cell(40, 10, '', 0,'C');
            $pdf->Ln(10);

            $pdf->Cell(20, 10, '', 0,'C'); 
            $pdf->Cell(80, 10, 'Gastos de Venta', 0,'C'); 
            $pdf->Cell(40, 10, $valores["gastos de venta"], 0,'C'); 
            $pdf->Cell(40, 10, '', 0,'C');
            $pdf->Ln(10);

            $pdf->Cell(20, 10, '', 0,'C'); 
            $pdf->Cell(80, 10, 'Comisiones Bancarias', 0,'C'); $pdf->SetFont('Arial', 'U', 10);
            $pdf->Cell(40, 10, $valores["gastos financieros comisiones bancarias"], 0,'C'); $pdf->SetFont('Arial', '', 10);
            $pdf->Cell(40, 10, '', 0,'C');
            $pdf->Ln(10);

            $pdf->Cell(20, 10, '', 0,'C'); $pdf->SetFont('Arial', 'B', 10);
            $pdf->Cell(80, 10, 'Depreciacion de Mobiliario y Equipo', 0,'C');
            $pdf->Cell(40, 10,'', 0,'C'); 
            $pdf->Cell(40, 10, $valores["DA de mobiliario y equipo"], 0,'C'); $pdf->SetFont('Arial', '', 10);
            $pdf->Ln(10);

            $pdf->Cell(20, 10, '', 0,'C'); $pdf->SetFont('Arial', 'B', 10);
            $pdf->Cell(80, 10, 'Utilidad de Operacion', 0,'C');
            $pdf->Cell(40, 10, '', 0,'C');
            $pdf->Cell(40, 10,$UtilidadOperacion, 0,'C'); $pdf->SetFont('Arial', '', 10);
            $pdf->Ln(10);

            $pdf->Cell(20, 10, '', 0,'C'); $pdf->SetFont('Arial', 'B', 10); 
            $pdf->Cell(80, 10, 'Gastos Financieros', 0,'C'); 
            $pdf->Cell(40, 10, '', 0,'C');
            $pdf->Cell(40, 10, $GastosFinancieros, 0,'C'); $pdf->SetFont('Arial', '', 10);
            $pdf->Ln(10);

            $pdf->Cell(20, 10, '', 0,'C'); 
            $pdf->Cell(80, 10, 'Gastos Financieros Intereses', 0,'C'); 
            $pdf->Cell(40, 10, $valores["gastos finacieros intereses"], 0,'C'); $pdf->SetFont('Arial', '', 10);
            $pdf->Cell(40, 10, '', 0,'C');
            $pdf->Ln(10);

            $pdf->Cell(20, 10, '', 0,'C'); 
            $pdf->Cell(80, 10, 'Gastos Financieros Comisiones Bancarias', 0,'C'); $pdf->SetFont('Arial', 'U', 10);
            $pdf->Cell(40, 10, $valores["gastos financieros comisiones bancarias"], 0,'C');  $pdf->SetFont('Arial', '', 10);
            $pdf->Cell(40, 10, '', 0,'C');
            $pdf->Ln(10);



            $pdf->Cell(20, 10, '', 0,'C'); $pdf->SetFont('Arial', 'B', 10);
            $pdf->Cell(80, 10, 'Utilidad Neta Antes de Impuesto', 0,'C');
            $pdf->Cell(40, 10, '', 0,'C');
            $pdf->Cell(40, 10, $UAI, 0,'C'); $pdf->SetFont('Arial', '', 10);
            $pdf->Ln(10);

            $pdf->Cell(20, 10, '', 0,'C'); $pdf->SetFont('Arial', 'B', 10);
            $pdf->Cell(80, 10, 'Impuestos', 0,'C');
            $pdf->Cell(40, 10, '', 0,'C');
            $pdf->Cell(40, 10, $Impuestos, 0,'C'); $pdf->SetFont('Arial', '', 10);
            $pdf->Ln(10);


            $pdf->Cell(20, 10, '', 0,'C'); 
            $pdf->Cell(80, 10, 'Impuesto sobre la renta', 0,'C');
            $pdf->Cell(40, 10, $valores["IPP sobre renta"], 0,'C'); 
            $pdf->Cell(40, 10, '', 0,'C');
            $pdf->Ln(10);

            $pdf->Cell(20, 10, '', 0,'C'); 
            $pdf->Cell(80, 10, 'Impuesto Sobre Patrimonio', 0,'C'); 
            $pdf->Cell(40, 10, $valores["IPP sobre patrimonio"], 0,'C');  
            $pdf->Cell(40, 10, '', 0,'C');
            $pdf->Ln(10);

            $pdf->Cell(20, 10, '', 0,'C'); 
            $pdf->Cell(80, 10, 'Impuestos Municipales', 0,'C'); $pdf->SetFont('Arial', 'U', 10);
            $pdf->Cell(40, 10, $valores["IPP municipales"], 0,'C');  $pdf->SetFont('Arial', '', 10);
            $pdf->Cell(40, 10, '', 0,'C');
            $pdf->Ln(10);

            $pdf->Cell(20, 10, '', 0,'C'); $pdf->SetFont('Arial', 'B', 10);
            $pdf->Cell(80, 10, 'Utilidad Neta del Periodo', 0,'C');
            $pdf->Cell(40, 10, '', 0,'C');
            $pdf->Cell(40, 10, $UNP, 0,'C'); $pdf->SetFont('Arial', '', 10);
            $pdf->Ln(10);



//      var_dump($valores);

      $pdf->Ln(10);
      $pdf->SetFont('Arial', 'B', 12);
      $pdf->Ln(10);$pdf->Ln(10);$pdf->Ln(10);
      $pdf->Cell(50, 10, '', 0,'C');
      $pdf->Cell(70, 10, 'Elaboro', 0,'C');
      $pdf->Cell(30, 10, 'Aprobo', 0,'C');
      //$pdf->Line(0,40,210,40);
      //Tabla con las cuentas
      $pdf->Output("balanceComprobacion.pdf", "I");
?>
