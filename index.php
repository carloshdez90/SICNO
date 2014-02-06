<!doctype html>
<?php 
error_reporting(E_ALL & ~E_NOTICE);
   include 'funciones/funciones.php';
   session_start();
   $_SESSION = array();
   session_destroy();
?>
<html>
<head>
<meta charset="utf-8">
<title>Sistema Contable 2013</title>
<link rel="stylesheet" type="text/css" href="css/styleindex.css" />

<link href="js/jquery-ui-1.10.3.custom/css/eggplant/jquery-ui-1.10.3.custom.css" rel="stylesheet">
<script src="js/jquery-ui-1.10.3.custom/js/jquery-1.9.1.js"></script>
<script src="js/jquery-ui-1.10.3.custom/js/jquery-ui-1.10.3.custom.js"></script>

</head>
<body>
<div class='login' id='main'>

  <div id='credenciales'>

    <form action="" method="post">

     <label class = "loginV" for="user">Usuario:&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</label>
      <input class = "pass" name="usuario" type="text" id="user" maxlength="10" />
      <br>
      <label class = "loginV" for="pass2">Contraseña:&nbsp;</label>
      <input class = "pass" name="password" type="password" id="pass" />
      <br>
      <input class = "loginB" name="enviar" type="submit" id="Enviar" value="INGRESAR" />
      <br>
    </form>
    
  </div>

   <footer>
      <p>Copyright &copy; SIC115 | Ciclo II 2013</p>
      <p>Las 'Cookies' deben estar habilitadas en su navegador</p>
    </footer>
</div>

<?php 
  switch ($_POST['enviar']) {
    case 'INGRESAR':
          $usuario = $_POST["usuario"];  
          $password = $_POST["password"];

          if(strcmp('chiricuto', $usuario) == 0)
          {    
          //Si el usuario es correcto ahora validamos su contraseña
           if(strcmp('kaiser', $password) == 0)
           {
            //Creamos sesión
            session_start(); 
            //Almacenamos el nombre de usuario en una variable de sesión usuario
            $_SESSION['usuario'] = $usuario; 
            //Redireccionamos a la pagina: index.php
            header("Location: inicio.php"); 
           }else{
              //En caso que la contraseña sea incorrecta enviamos un msj y redireccionamos a login.php
              ?>
             <script languaje="javascript">
              alert("Contraseña Incorrecta");
              location.href = "index.php";
             </script>
            <?php  
                       
           }
         }
          
          else
          {
           //en caso que el nombre de administrador es incorrecto enviamos un msj y redireccionamos a login.php
          ?>
           <script languaje="javascript">
            alert("El nombre de usuario es incorrecto!");
            location.href = "index.php";
           </script>
          <?php
          }
      break;
  }
?>

</body>
</html>