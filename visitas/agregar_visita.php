<?php
include("../includes/db.php");

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $nombre = $_POST["nombre"];
    $motivo = $_POST["motivo"];
    $fecha = $_POST["fecha"];
    $hora = $_POST["hora"];

    $sql = "INSERT INTO visitas (nombre, motivo, fecha, hora) VALUES (?, ?, ?, ?)";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("ssss", $nombre, $motivo, $fecha, $hora);

    if ($stmt->execute()) {
        header("Location: ../index.php?mensaje=Visita+agregada+con+éxito");
    } else {
        echo "Error al agregar visita: " . $conn->error;
    }

    $stmt->close();
    $conn->close();
}
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Agregar Visita</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body class="container py-5">
    <h2 class="mb-4">Agregar Visita</h2>
    <form action="" method="POST" class="row g-3">
        <div class="col-md-6">
            <label class="form-label">Nombre</label>
            <input type="text" name="nombre" class="form-control" required>
        </div>
        <div class="col-md-6">
            <label class="form-label">Motivo</label>
            <input type="text" name="motivo" class="form-control" required>
        </div>
        <div class="col-md-6">
            <label class="form-label">Fecha</label>
            <input type="date" name="fecha" class="form-control" required>
        </div>
        <div class="col-md-6">
            <label class="form-label">Hora</label>
            <input type="time" name="hora" class="form-control" required>
        </div>
        <div class="col-12">
            <button type="submit" class="btn btn-primary">Guardar</button>
            <a href="../index.php" class="btn btn-secondary">Volver</a>
        </div>
    </form>
</body>
</html>
