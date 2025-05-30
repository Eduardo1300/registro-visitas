<?php include 'includes/db.php'; ?>
<?php include 'includes/header.php'; ?>

<div class="container mt-5">
    <h2>Resultados de Búsqueda</h2>
    <a href="index.php" class="btn btn-secondary mb-3">Volver</a>

    <?php
    $busqueda = $conn->real_escape_string($_POST['buscar']);
    $sql = "SELECT * FROM visitas WHERE nombre LIKE '%$busqueda%' OR motivo LIKE '%$busqueda%' ORDER BY fecha DESC";
    $resultado = $conn->query($sql);
    ?>

    <table class="table table-bordered">
        <thead class="table-dark">
            <tr>
                <th>Nombre</th>
                <th>Motivo</th>
                <th>Fecha</th>
                <th>Acciones</th>
            </tr>
        </thead>
        <tbody>
        <?php while ($row = $resultado->fetch_assoc()): ?>
            <tr>
                <td><?= htmlspecialchars($row['nombre']) ?></td>
                <td><?= htmlspecialchars($row['motivo']) ?></td>
                <td><?= htmlspecialchars($row['fecha']) ?></td>
                <td>
                    <a href="visitas/editar_visita.php?id=<?= $row['id'] ?>" class="btn btn-sm btn-warning">Editar</a>
                    <a href="visitas/eliminar_visita.php?id=<?= $row['id'] ?>" class="btn btn-sm btn-danger">Eliminar</a>
                </td>
            </tr>
        <?php endwhile; ?>
        </tbody>
    </table>
</div>
