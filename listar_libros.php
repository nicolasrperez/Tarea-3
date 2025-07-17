<?php
include_once("libreria/conexion.php"); // Ajusta según la ruta correcta

$objConexion = new Conexion();
$conn = $objConexion->getConexion();

$sql = "SELECT * FROM libros_d ORDER BY Titulo";
$result = $conn->query($sql);
?>

<!DOCTYPE html>
<html>
<head>
    <title>Listado de Libros</title>
    <link rel="stylesheet" href="bootstrap/carteles.css">
</head>
<body>
<h1>Libros disponibles</h1>
<table border="1" cellpadding="8" cellspacing="0">
    <thead>
        <tr>
            <th>ID</th>
            <th>Autor</th>
            <th>Título</th>
            <th>Edición</th>
            <th>Año</th>
            <th>Área</th>
            <th>Materia</th>
            <th>Comentario</th>
        </tr>
    </thead>
    <tbody>
        <?php while($row = $result->fetch_assoc()): ?>
        <tr>
            <td><?= $row['id_libro'] ?></td>
            <td><?= htmlspecialchars($row['Autor']) ?></td>
            <td><?= htmlspecialchars($row['Titulo']) ?></td>
            <td><?= htmlspecialchars($row['edicion']) ?></td>
            <td><?= htmlspecialchars($row['año']) ?></td>
            <td><?= htmlspecialchars($row['Area']) ?></td>
            <td><?= htmlspecialchars($row['Materia']) ?></td>
            <td><?= htmlspecialchars($row['Comentario']) ?></td>
        </tr>
        <?php endwhile; ?>
    </tbody>
</table>
</body>
</html>
