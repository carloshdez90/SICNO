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
      $pdf->Cell(200, 10,'Balance de Comprobacion', 0, 1, 'C');
      $pdf->Cell(200, 10,'del 01 de '.$meses[$mes[1]-1].' al '.diasMes(date($mes[1]), date($mes[0])).' de '.$meses[$mes[1]-1].' del '.date($mes[0]) , 0, 1, 'C');
      $pdf->Line(0,40,210,40);
      $pdf->Ln(10);
      $pdf->SetFont('Arial', 'B', 14);
      $pdf->Cell(20, 10, '', 0,'C');
      $pdf->Ln(10);
      //Tabla con las cuentas
      
      $con=mysql_connect($host,$user,$pw) or die("Problemas al conectar"); 
      mysql_select_db($db,$con) or die("Problemas al conectar con la base"); 

      $queryAcreedoras = mysql_query("SELECT NombreCuenta, SaldoLibroMayor FROM catalogodecuentas, libromayor WHERE TipoCuenta='Acreedora' AND catalogodecuentas.CodCuenta = libromayor.CodigoCuenta order by NombreCuenta asc;", $con);
      $queryDeudoras = mysql_query("SELECT NombreCuenta, SaldoLibroMayor FROM catalogodecuentas, libromayor WHERE TipoCuenta='Deudora' AND catalogodecuentas.CodCuenta = libromayor.CodigoCuenta order by NombreCuenta asc;", $con);

      $nAcreedoras = mysql_fetch_row(mysql_query("SELECT count(TipoCuenta) as n FROM `catalogodecuentas` WHERE TipoCuenta='Acreedora';", $con));
      $nDeudoras = mysql_fetch_row(mysql_query("SELECT count(TipoCuenta) as n FROM `catalogodecuentas` WHERE TipoCuenta='Deudora';", $con));

      $queryTotalAcreedores = mysql_query("SELECT SUM(SaldoLibroMayor) as TOTAL FROM catalogodecuentas, libromayor WHERE TipoCuenta='Acreedora' AND catalogodecuentas.CodCuenta = libromayor.CodigoCuenta;", $con);
      $queryTotalDeudores = mysql_query("SELECT SUM(SaldoLibroMayor) as TOTAL FROM catalogodecuentas, libromayor WHERE TipoCuenta='Deudora' AND catalogodecuentas.CodCuenta = libromayor.CodigoCuenta;", $con);

      $tAcreedores = mysql_fetch_row($queryTotalAcreedores);
      $tDeudores = mysql_fetch_row($queryTotalDeudores);

     $pdf->SetFont('Arial', '', 10);
     for($i=0; $i<$nDeudoras[0]+$nAcreedoras[0]; $i++){
        
            //$resultadoPasivos = mysql_fetch_row($queryPasivos);            
            if($resultadoDeudoras = mysql_fetch_row($queryDeudoras)){
                  $pdf->Cell(20,10,"",0,'C');
                  $pdf->Cell(80,10,"$resultadoDeudoras[0]",0,'C');
                  $pdf->Cell(40,10,"$resultadoDeudoras[1]",0,'C');
                  $pdf->Cell(40,10,"",0,'C');
                  $pdf->Ln(10);

            }else{
                  $resultadoAcreedoras = mysql_fetch_row($queryAcreedoras);
                  $pdf->Cell(20,10,"",0,'C');
                  $pdf->Cell(80,10,"$resultadoAcreedoras[0]",0,'C');
                  $pdf->Cell(40,10,"",0,'C');
                  $pdf->Cell(40,10,"$resultadoAcreedoras[1]",0,'C');
                  $pdf->Ln(10);

            }
           
            
                        
      }

      $pdf->Ln(10);
      $pdf->SetFont('Arial', 'B', 12);
      $pdf->Cell(20,10,"",0,'C');
      $pdf->Cell(50, 10, 'Total Deudores:', 0,'C');
      $pdf->Cell(20, 10, number_format($tAcreedores[0],2), 0,'C');
      $pdf->Cell(50, 10, 'Total Acreedores:', 0,'C');
      $pdf->Cell(20, 10, number_format($tDeudores[0],2), 0,'C');

      $pdf->Ln(10);$pdf->Ln(10);$pdf->Ln(10);$pdf->Ln(10);
      $pdf->Cell(50, 10, '', 0,'C');
      $pdf->Cell(70, 10, 'Elaboro', 0,'C');
      $pdf->Cell(30, 10, 'Aprobo', 0,'C');
      //Tabla con las cuentas
      $pdf->Output("balanceComprobacion.pdf", "I");
?>
