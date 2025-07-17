<?php
if (session_status() === PHP_SESSION_NONE) {
  session_start();
}

?>

<!DOCTYPE html>
<html lang="es">
<head>
  <title>BASES PWD</title>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@3.4.1/dist/css/bootstrap.min.css">

  <script src="https://code.jquery.com/jquery-1.12.4.min.js"></script>

  <script src="https://cdn.jsdelivr.net/npm/bootstrap@3.4.1/dist/js/bootstrap.min.js"></script>

  <style>
    pre {
      display: block;
      font-family: arial;
      white-space: pre;
      margin: 2em 0;
    }
    #background {
      position: fixed;
      top: 0;
      left: 0;
      width: 100%;
      height: 100%;
      background-image: url('images/b_bkg_3.jpg');
      background-repeat: no-repeat;
      background-attachment: fixed;
      background-size: 100%;
      opacity: 0.6;
      filter:alpha(opacity=80);
    }
  </style>
</head>

<body style="padding: 0px 0px 0px 0px;">
<div id="background"></div>
<div class="container-fluid">

  <nav class="navbar navbar-inverse navbar-static-top navbar2" role="navigation">
    <a class="navbar-brand" href="index.php">
      <img src="images/b_bkg_3.jpg" alt="Logo"
           style="display:inline; height:30px; margin-right:8px;">
      Lautaro Baez
    </a>

    <div class="navbar-header">
      <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#navbar-main-menu" aria-expanded="false">
        <span class="sr-only">Toggle navigation</span>
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>
      </button>
    </div>

    <div class="collapse navbar-collapse" id="navbar-main-menu">
      <ul class="nav navbar-nav ">
        <li><a href="index.php"><span class="glyphicon glyphicon-home"></span></a></li>
        <li><a href="cartelera.php">Cartelera</a></li>
        <li><a href="ayuda.php">Ayuda</a></li>
        <li><a href="abm_ld.php">Libros</a></li>

        <!-- NUEVO MENÚ BIBLIOTECA -->
        <li class="dropdown">
          <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">
            Biblioteca <span class="caret"></span>
          </a>
          <ul class="dropdown-menu">
            <li><a href="listar_libros.php">Listado de Libros</a></li>
            <li><a href="registrar_prestamo.php">Registrar Préstamo</a></li>
            <li><a href="lista_prestamos.php">Préstamos Activos</a></li>
          </ul>
        </li>

        <?php 
        if (isset($_SESSION['username']) && $_SESSION['rol']=='administrador'){
          echo '<li><a href="abm_p.php">Usuarios</a></li>';
          echo '<li><a href="abm_c.php">Carteles</a></li>';
        }
        ?>
      </ul>

      <ul class="nav navbar-nav navbar-right" style="padding-right: 10px;">
        <?php 
        if (isset($_SESSION['username'])) {
          echo ' <li class="navbar-brand">'.htmlspecialchars($_SESSION['rol']).' : '.htmlspecialchars($_SESSION['username']).'</li>'; 
          
          // Mostramos el contador solo si es administrador
          if ($_SESSION['rol'] === 'administrador') {
            echo '<li class="navbar-text"><span class="label label-info">Conectados: <span id="contador_ws">...</span></span></li>';
          }
        }
        ?>
        
        <?php
        if (!isset($_SESSION['username'])){
          echo '	  
            <li><a href="registro.php"  data-toggle="modal" data-target="#myModal"><span class="glyphicon glyphicon-user"></span> Registro</a></li>
            <li><a href="login.php" data-toggle="modal" data-target="#myModal"><span class="glyphicon glyphicon-log-in"></span> Login</a></li>
          ';
        } else {
          echo '	  
            <li><a href="i_chat.php">Chat</a></li>
            <li><a href="logout.php" ><span class="glyphicon glyphicon-log-out"></span> Logout</a></li>
          ';
        }
        ?>		   
      </ul>
    </div>
  </nav>

  <!-- Modal -->
  <div id="myModal" class="modal fade" role="dialog">
    <div class="modal-dialog">
      <!-- Modal content-->
      <div class="modal-content">
        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal">&times;</button>
          <h4 class="modal-title">Modal Header</h4>
        </div>
        <div class="modal-body">
          <p></p>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-default" data-dismiss="modal">Cerrar</button>
        </div>
      </div>
    </div>
  </div>

</div>

<!-- WebSocket Contador -->
<script>
let ws = new WebSocket("ws://localhost:8080");
ws.onmessage = function(event) {
  const el = document.getElementById("contador_ws");
  if (el) el.innerText = event.data;
};
</script>

<!-- Función cargar() necesaria para el AJAX -->
<script>
function cargar(div, desde) {
  $(div).load(desde);
}
</script>

</body>
</html>
