<?php
include_once("libreria/conexion.php");

$conexion = new Conexion();
$conn = $conexion->getConexion();


if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $id_libro = intval($_POST['id_libro']);
    $id_persona = intval($_POST['id_persona']);
    $fecha_prestamo = date('Y-m-d');

    // Insertar préstamo (activo, sin fecha devolución aún)
    $sql = "INSERT INTO prestamos_libros (id_libro, id_persona, fecha_prestamo) VALUES (?, ?, ?)";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("iis", $id_libro, $id_persona, $fecha_prestamo);
    if($stmt->execute()){
        $msg = "Préstamo registrado correctamente.";
    } else {
        $msg = "Error al registrar préstamo.";
    }
}

// Traer libros y personas para los selects
$libros = $conn->query("SELECT id_libro, Titulo FROM libros_d ORDER BY Titulo");
$personas = $conn->query("SELECT id, nombre, apellido FROM personas ORDER BY apellido");
?>

<!DOCTYPE html>
<html>
<head>
    <title>Registrar Préstamo</title>
    <link rel="stylesheet" href="bootstrap/carteles.css">
</head>
<body>
<h1>Registrar préstamo de libro</h1>

<?php if(isset($msg)) echo "<p>$msg</p>"; ?>

<form method="POST" action="">
    <label for="id_libro">Libro:</label>
    <select name="id_libro" required>
        <option value="">Seleccione un libro</option>
        <?php while($libro = $libros->fetch_assoc()): ?>
            <option value="<?= $libro['id_libro'] ?>"><?= htmlspecialchars($libro['Titulo']) ?></option>
        <?php endwhile; ?>
    </select><br><br>

    <label for="id_persona">Socio (Persona):</label>
    <select name="id_persona" required>
        <option value="">Seleccione un socio</option>
        <?php while($persona = $personas->fetch_assoc()): ?>
            <option value="<?= $persona['id'] ?>"><?= htmlspecialchars($persona['apellido'].", ".$persona['nombre']) ?></option>
        <?php endwhile; ?>
    </select><br><br>

    <button type="submit">Registrar Préstamo</button>
</form>


     <a href="index.php">volver al inicio</a>

</body>
</html>
