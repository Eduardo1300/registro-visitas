<?php
include("../includes/db.php");

if (!isset($_GET["id"])) {
    die("ID no proporcionado");
}

$id = $_GET["id"];

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $nombre = $_POST["nombre"];
    $motivo = $_POST["motivo"];
    $fecha = $_POST["fecha"];
    $hora = $_POST["hora"];

    $sql = "UPDATE visitas SET nombre=?, motivo=?, fecha=?, hora=? WHERE id=?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("ssssi", $nombre, $motivo, $fecha, $hora, $id);

    if ($stmt->execute()) {
        header("Location: ../index.php?mensaje=Visita+actualizada");
    } else {
        echo "Error al actualizar: " . $conn->error;
    }

    $stmt->close();
    $conn->close();
    exit;
}

$sql = "SELECT * FROM visitas WHERE id=?";
$stmt = $conn->prepare($sql);
$stmt->bind_param("i", $id);
$stmt->execute();
$resultado = $stmt->get_result();
$visita = $resultado->fetch_assoc();

if (!$visita) {
    die("Visita no encontrada");
}
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Editar Visita</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body class="container py-5">
    <h2 class="mb-4">Editar Visita</h2>
    <form action="" method="POST" class="row g-3">
        <div class="col-md-6">
            <label class="form-label">Nombre</label>
            <input type="text" name="nombre" class="form-control" value="<?= $visita['nombre'] ?>" required>
        </div>
        <div class="col-md-6">
            <label class="form-label">Motivo</label>
            <input type="text" name="motivo" class="form-control" value="<?= $visita['motivo'] ?>" required>
        </div>
        <div class="col-md-6">
            <label class="form-label">Fecha</label>
            <input type="date" name="fecha" class="form-control" value="<?= $visita['fecha'] ?>" required>
        </div>
        <div class="col-md-6">
            <label class="form-label">Hora</label>
            <input type="time" name="hora" class="form-control" value="<?= $visita['hora'] ?>" required>
        </div>
        <div class="col-12">
            <button type="submit" class="btn btn-primary">Actualizar</button>
            <a href="../index.php" class="btn btn-secondary">Cancelar</a>
        </div>
    </form>
</body>
</html>
