<?php
session_start();
if (isset($_SESSION['username'])) {
    header('Location: index.php');
    exit();
}
?>

<!DOCTYPE html>
<html lang="es">
<head>
  <meta charset="UTF-8">
  <title>Login</title>
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@3.4.1/dist/css/bootstrap.min.css">
</head>
<body>
<div class="container" style="max-width: 400px; margin-top: 100px;">
  <h3 class="text-center">Iniciar Sesión</h3>

  <?php
  if (isset($_GET['error'])) {
      echo '<div class="alert alert-danger">Usuario o contraseña incorrectos</div>';
  }
  ?>

  <form action="login_procesar.php" method="POST">
    <div class="form-group">
      <label for="usuario">Usuario</label>
      <input type="text" name="usuario" class="form-control" required>
    </div>

    <div class="form-group">
      <label for="clave">Contraseña</label>
      <input type="password" name="clave" class="form-control" required>
    </div>

    <button type="submit" class="btn btn-primary btn-block">Ingresar</button>
  </form>
</div>
</body>
</html>
