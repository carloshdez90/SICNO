<?php 
function mostrarMenu() {
    echo '<div id="menu_container">
          <ul class="sf-menu" id="nav">
            <li><a href="inicio.php">Inicio</a></li>
            <li><a href="#">Contabilidad</a>
              <ul>
                <li><a href="registroDiario.php">Registros diarios</a></li>
                <li><a href="#">Catálogo de cuentas</a>
                <ul>
                    <li><a href="catalogoCuentasIngresar.php">Agregar cuentas</a></li>
                    <li><a href="catalogoCuentasEliminar.php">Eliminar cuentas</a></li>
                </ul>
                </li>
                <li><a href="#">Estados financieros</a>
                  <ul>
                    <li><a href="balanceComprobacion.php">Balance de comprobacion</a></li>
                    <li><a href="balanceResultado.php">Estado de Resultados</a></li>
                    <li><a href="#">Estado de capital</a></li>
                    <li><a href="balanceGeneral.php">Balance General</a></li>
                  </ul>
                </li>
            </ul>
            <li><a href="#">Centro de costos</a><ul>
                <li><a href="presupuestoCostoProduccion.php">Nueva orden de Produccion</a></li>
                <li><a href="listaDeOrdenes.php">Lista de ordenes de Produccion</a></li>
            </ul>
            </li>
            <li><a href="#">Inventarios</a>
            <ul>
                <li><a href="materiaPrima.php">Materia prima</a></li>
                <li><a href="#">Productos en proceso</a>
                <li><a href="#">Productos terminados</a>
                <li><a href="#">Materiales y suministros</a>
                </li>
            </ul>
            </li>
            <li><a href="#">Recursos Humanos</a>
            <ul>
                <li><a href="#">Empleados</a></li>
                <li><a href="#">Planilla</a></li>
            </ul>
            </li>
            <li><a href="#">Activos Fijos</a>
            <ul>
                <li><a href="ingresarMobiliarioYEquipo.php">Ingresar mobiliario y equipo</a></li>
                <li><a href="depreciacion.php">Depreciaciones</a></li>
            </ul>
            </li>
           </ul>
        </div>';
    }

function mostrarMenuLateral(){
  date_default_timezone_set('America/El_Salvador');
  $dias = array("Domingo","Lunes","Martes","Miércoles","Jueves","Viernes","Sábado");
  $meses = array("Enero","Febrero","Marzo","Abril","Mayo","Junio","Julio","Agosto","Septiembre","Octubre","Noviembre","Diciembre");

  echo '<div class="sidebar">
          <h3>Bienvenido @Usuario</h3>
          <h4>Puesto de usuario</h4>
          <h5>'.$dias[date('w')]." ".date('d')." de ".$meses[date('n')-1]. " del ".date('Y').'</h5>
          <p><a href="funciones/logout.php">Cerrar sesión</a></p>
        </div>
        <div class="sidebar">
          <h3>Accesos Rápidos</h3>
          <ul>
            <li><a href="#">Registro Diario</a></li>
            <li><a href="#">Registro en planilla</a></li>
            <li><a href="#">Compra</a></li>
            <li><a href="#">Registro orden de fab</a></li>
          </ul>
        </div>
        <div class="sidebar">
          <h3>Estadisticas</h3>
          <ul>
            <li><a href="#">Produccion</a></li>
            <li><a href="#">Ventas</a></li>
            <li><a href="#">Personal</a></li>
            <li><a href="#">Utilidades</a></li>
          </ul>
        </div>';
}

?>