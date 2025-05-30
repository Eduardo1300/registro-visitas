<?php include 'includes/db.php'; ?>
<?php include 'includes/header.php'; ?>

<div class="container mt-5">
    

    <!-- Formulario de búsqueda -->
    <form action="buscar.php" method="post" class="mb-4">
        <div class="input-group">
            <input type="text" name="buscar" class="form-control" placeholder="Buscar por nombre o motivo">
            <button type="submit" class="btn btn-primary">Buscar</button>
        </div>
    </form>

    <!-- Botón para agregar nueva visita -->
    <div class="mb-4">
        <a href="visitas/agregar_visita.php" class="btn btn-success">Agregar nueva visita</a>
    </div>

    <!-- Mostrar tabla de visitas -->
    <?php
    $resultado = $conn->query("SELECT * FROM visitas ORDER BY fecha DESC");
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
                    <a href="visitas/eliminar_visita.php?id=<?= $row['id'] ?>" class="btn btn-sm btn-danger" onclick="return confirm('¿Estás seguro de eliminar esta visita?')">Eliminar</a>
                </td>
            </tr>
        <?php endwhile; ?>
        </tbody>
    </table>
</div>
