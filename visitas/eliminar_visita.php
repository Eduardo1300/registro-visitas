<?php
include("../includes/db.php");

if (!isset($_GET["id"])) {
    die("ID no especificado");
}

$id = $_GET["id"];

$sql = "DELETE FROM visitas WHERE id=?";
$stmt = $conn->prepare($sql);
$stmt->bind_param("i", $id);

if ($stmt->execute()) {
    header("Location: ../index.php?mensaje=Visita+eliminada");
} else {
    echo "Error al eliminar visita: " . $conn->error;
}

$stmt->close();
$conn->close();
?>
