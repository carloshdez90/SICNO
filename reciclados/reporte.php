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
            header('Location: balanceComprobacion.php');
      }
      
      $pdf = new FPDF();
      $pdf->AddPage();
      $pdf->SetFont('Arial', 'B', 16);
      $pdf->Cell(200, 10,'Empresas Madereras de El Salvador', 0, 1, 'C');
      $pdf->Cell(200, 10,'Balance General', 0, 1, 'C');
      $pdf->Cell(200, 10,'del 01 de '.$meses[$mes[1]-1].' al '.diasMes(date($mes[1]), date($mes[0])).' de '.$meses[$mes[1]-1].' del '.date($mes[0]) , 0, 1, 'C');
      $pdf->Line(0,40,210,40);
      $pdf->Ln(10);
      $pdf->SetFont('Arial', 'B', 14);
      $pdf->Cell(95, 10, 'ACTIVO', 0,'C');
      $pdf->Cell(95, 10, 'PASIVO', 0,'C');
      $pdf->Ln(10);
      //Tabla con las cuentas
      
      $con=mysql_connect($host,$user,$pw) or die("Problemas al conectar"); 
      mysql_select_db($db,$con) or die("Problemas al conectar con la base"); 

      $queryActivos = mysql_query("SELECT NombreCuenta, SaldoLibroMayor FROM catalogodecuentas, libromayor WHERE tipo2='Activo' AND catalogodecuentas.CodCuenta = libromayor.CodigoCuenta order by NombreCuenta asc;", $con);
      $queryPasivos = mysql_query("SELECT NombreCuenta, SaldoLibroMayor FROM catalogodecuentas, libromayor WHERE tipo2='Pasivo' AND catalogodecuentas.CodCuenta = libromayor.CodigoCuenta order by NombreCuenta asc;", $con); 
      $queryCapital = mysql_query("SELECT NombreCuenta, SaldoLibroMayor FROM catalogodecuentas, libromayor WHERE tipo2='Capital' AND catalogodecuentas.CodCuenta = libromayor.CodigoCuenta order by NombreCuenta asc;", $con); 

      $queryTotalActivos = mysql_query("SELECT SUM(SaldoLibroMayor) as TOTAL FROM catalogodecuentas, libromayor WHERE tipo2='Activo' AND catalogodecuentas.CodCuenta = libromayor.CodigoCuenta;", $con);
      $queryTotalPasivos = mysql_query("SELECT SUM(SaldoLibroMayor) as TOTAL FROM catalogodecuentas, libromayor WHERE tipo2='Pasivo' AND catalogodecuentas.CodCuenta = libromayor.CodigoCuenta;", $con);
      $queryTotalCapital = mysql_query("SELECT SUM(SaldoLibroMayor) as TOTAL FROM catalogodecuentas, libromayor WHERE tipo2='Capital' AND catalogodecuentas.CodCuenta = libromayor.CodigoCuenta;", $con);

      
      $nActivos = mysql_fetch_row(mysql_query("SELECT count(tipo2) as n FROM `catalogodecuentas` WHERE tipo2='Activo';", $con));
      $nPasivos = mysql_fetch_row(mysql_query("SELECT count(tipo2) as n FROM `catalogodecuentas` WHERE tipo2='Pasivo';", $con));
      $nCapital = mysql_fetch_row(mysql_query("SELECT count(tipo2) as n FROM `catalogodecuentas` WHERE tipo2='Capital';", $con));



      $pdf->SetFont('Arial', '', 10);
      
     for($i=0; $i<($nActivos[0]>($nPasivos[0]+$nCapital[0]) ? $nActivos[0] : ($nPasivos[0]+$nCapital[0])); $i++){
        
            $resultadoActivos = mysql_fetch_row($queryActivos);
            $resultadoPasivos = mysql_fetch_row($queryPasivos);            
            

            $pdf->Cell(70,10,"$resultadoActivos[0]",0,'C');
            $pdf->Cell(25,10,"$resultadoActivos[1]",0,'C');
            
            if($i < $nPasivos[0]){
                  $pdf->Cell(70,10,"$resultadoPasivos[0]",0,'C');
                  $pdf->Cell(25,10,"$resultadoPasivos[1]",0,'C');
                  $pdf->Ln(10);
                  
            }else{
                  if($i==$nPasivos[0]) {
                        $totalPasivos = mysql_fetch_row($queryTotalPasivos);
                        $pdf->SetFont('Arial', 'B', 10);
                        $tPasivo=$totalPasivos[0];
                        $pdf->Cell(70, 10, 'Total Pasivo:', 0,'C');
                        $pdf->Cell(25, 10, "$tPasivo", 0,'C');
                        $pdf->SetFont('Arial', '', 10);
                        $pdf->Ln(10);     
                                                
                  }else{
                        if ($i == $nPasivos[0]+1) {
                              $pdf->SetFont('Arial', 'B', 14);
                              $pdf->Cell(95, 10, 'CAPITAL', 0,'C');
                              $pdf->Ln(10);
                              $pdf->SetFont('Arial', '', 10);
                        }else{
                        
                              if ($i == $nPasivos[0]+$nCapital[0]+2) {
                                    $totalCapital = mysql_fetch_row($queryTotalCapital);
                                    $pdf->SetFont('Arial', 'B', 10);
                                    $tCapital=$totalCapital[0];
                                    $pdf->Cell(70, 10, 'Total Capital:', 0,'C');
                                    $pdf->Cell(25, 10, "$tCapital", 0,'C');
                                    $pdf->SetFont('Arial', '', 10);
                                    $pdf->Ln(10);
                              }else{
                                    $resultadoCapital = mysql_fetch_row($queryCapital);
                                    $pdf->Cell(70,10,"$resultadoCapital[0]",0,'C');
                                    $pdf->Cell(25,10,"$resultadoCapital[1]",0,'C');
                                    $pdf->Ln(10);
                                    
                              }
                              
                        }
                  }
            }

            if ($i == $nActivos[0]-1) {
                  $totalActivo = mysql_fetch_row($queryTotalActivos);
                  $pdf->SetFont('Arial', 'B', 10);
                  $tActivo=$totalActivo[0];
                  $pdf->Cell(70, 10, 'Total Activo:', 0,'C');
                  $pdf->Cell(25, 10, "$tActivo", 0,'C');
                  $pdf->Line(0,40,210,40);
                  $pdf->Ln(10);
            }
            
            
      }
      $pdf->Ln(10);
      $pdf->SetFont('Arial', 'B', 12);
      $pdf->Cell(70, 10, 'Total Activo:', 0,'C');
      $pdf->Cell(25, 10, "$tActivo", 0,'C');
      $pdf->Cell(70, 10, 'Total Participaciones:', 0,'C');
      $tParticipaciones=$tCapital+$tPasivo;
      $pdf->Cell(25, 10, "$tParticipaciones", 0,'C');
      $pdf->Ln(10);$pdf->Ln(10);$pdf->Ln(10);
      $pdf->Cell(50, 10, '', 0,'C');
      $pdf->Cell(70, 10, 'Elaboro', 0,'C');
      $pdf->Cell(30, 10, 'Aprobo', 0,'C');
      $pdf->Line(0,40,210,40);
      //Tabla con las cuentas
      $pdf->Output("balanceComprobacion.pdf", "I");
?>
