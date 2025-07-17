<?php
include_once("libreria/conexion.php");

$conexion = new Conexion();
$conn = $conexion->getConexion();

// Marcar devolución si se recibe el parámetro
if (isset($_GET['devolver'])) {
    $id_prestamo = intval($_GET['devolver']);
    $fecha_devolucion_real = date('Y-m-d');

    $sql = "UPDATE prestamos_libros SET fecha_devolucion_real = ? WHERE id = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("si", $fecha_devolucion_real, $id_prestamo);
    $stmt->execute();
}

// Consulta para traer préstamos activos (sin devolución real)
$sql = "SELECT p.id, l.Titulo, per.nombre, per.apellido, p.fecha_prestamo
        FROM prestamos_libros p
        JOIN libros_d l ON p.id_libro = l.id_libro
        JOIN personas per ON p.id_persona = per.id
        WHERE p.fecha_devolucion_real IS NULL
        ORDER BY p.fecha_prestamo";

$result = $conn->query($sql);
?>

<!DOCTYPE html>
<html>
<head>
    <title>Préstamos Activos</title>
    <link rel="stylesheet" href="bootstrap/carteles.css">
</head>
<body>
<h1>Préstamos activos</h1>

<table border="1" cellpadding="8" cellspacing="0">
    <thead>
        <tr>
            <th>ID Préstamo</th>
            <th>Libro</th>
            <th>Socio</th>
            <th>Fecha Préstamo</th>
            <th>Acción</th>
        </tr>
    </thead>
    <tbody>
        <?php while($row = $result->fetch_assoc()): ?>
        <tr>
            <td><?= $row['id'] ?></td>
            <td><?= htmlspecialchars($row['Titulo']) ?></td>
            <td><?= htmlspecialchars($row['apellido'] . ", " . $row['nombre']) ?></td>
            <td><?= $row['fecha_prestamo'] ?></td>
            <td><a href="?devolver=<?= $row['id'] ?>" onclick="return confirm('Confirmar devolución?')">Devolver</a></td>
        </tr>
        <?php endwhile; ?>
    </tbody>
</table>


<li><a href="index.php">Volver al inicio</a></li>

</body>
</html>
