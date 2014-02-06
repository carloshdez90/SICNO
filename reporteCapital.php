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
            header('Location: balanceCapital.php');
      }
      
      $pdf = new FPDF();
      $pdf->AddPage();
      $pdf->SetFont('Arial', 'B', 16);
      $pdf->Cell(200, 10,'Empresas Madereras de El Salvador', 0, 1, 'C');
      $pdf->Cell(200, 10,'Balance de Capital', 0, 1, 'C');
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
            $capitalContable = $valores["capital"] + $valores["utilidad del ejercicio"];
            $pdf->Cell(20, 10, '', 0,'C'); $pdf->SetFont('Arial', 'B', 10);
            $pdf->Cell(80, 10, 'INVERSIONES', 0,'C');
            $pdf->Cell(40, 10, '', 0,'C');
            $pdf->Cell(40, 10, number_format($capitalContable, 2), 0,'C'); $pdf->SetFont('Arial', '', 10);
            $pdf->Ln(10);

            $pdf->Cell(20, 10, '', 0,'C');
            $pdf->Cell(80, 10, 'Capital Inicial', 0,'C');
            $pdf->Cell(40, 10, $valores["capital"], 0,'C');
            $pdf->Cell(40, 10, '', 0,'C');
            $pdf->Ln(10);

            $pdf->Cell(20, 10, '', 0,'C');
            $pdf->Cell(80, 10, 'Utilidades', 0,'C');$pdf->SetFont('Arial', 'U', 10);
            $pdf->Cell(40, 10, $valores["utilidad del ejercicio"], 0,'C');
            $pdf->Cell(40, 10, '', 0,'C');$pdf->SetFont('Arial', '', 10);
            $pdf->Ln(10);

            $pdf->Cell(20, 10, '', 0,'C'); $pdf->SetFont('Arial', 'B', 10);
            $pdf->Cell(80, 10, 'DESINVERSIONES', 0,'C'); 
            $pdf->Cell(40, 10, '', 0,'C'); 
            $pdf->Cell(40, 10, number_format(0, 2), 0,'C'); $pdf->SetFont('Arial', '', 10);
            $pdf->Ln(10);

            $pdf->Ln(10);
            $pdf->Cell(20, 10, '', 0,'C'); $pdf->SetFont('Arial', 'B', 10);
            $pdf->Cell(80, 10, 'CAPITAL CONTABLE', 0,'C');
            $pdf->Cell(40, 10, '', 0,'C'); 
            $pdf->Cell(40, 10, number_format($capitalContable, 2), 0,'C'); $pdf->SetFont('Arial', '', 10);
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
      $pdf->Output("balanceCapital.pdf", "I");
?>
