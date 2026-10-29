<?php
session_start();

if (!isset($_SESSION["usuario"])) {
    header("Location: login.php");
    exit;
}

require_once "conexion.php";

$id = $_GET["id"] ?? "";
$nombre = "";
$servicio = "";
$fecha = "";
$hora = "";

// 1. Si viene un ID, buscamos el turno usando PDO
if ($id != "") {
    $stmt = $conexion->prepare("SELECT * FROM turnos WHERE id = ?");
    $stmt->execute([$id]);
    $turno = $stmt->fetch(PDO::FETCH_ASSOC);

    if ($turno) {
        $nombre = $turno["nombre"];
        $servicio = $turno["servicio"];
        $fecha = $turno["fecha"];
        $hora = $turno["hora"];
    }
}

// 2. Cuando guardamos o actualizamos por POST
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $id = $_POST["id"];
    $nombre = $_POST["nombre"];
    $servicio = $_POST["servicio"];
    $fecha = $_POST["fecha"];
    $hora = $_POST["hora"];

    if ($id == "") {
        // Insertar nuevo turno
        $stmt = $conexion->prepare("INSERT INTO turnos (nombre, servicio, fecha, hora) VALUES (?, ?, ?, ?)");
        $stmt->execute([$nombre, $servicio, $fecha, $hora]);
    } else {
        // Actualizar turno existente
        $stmt = $conexion->prepare("UPDATE turnos SET nombre = ?, servicio = ?, fecha = ?, hora = ? WHERE id = ?");
        $stmt->execute([$nombre, $servicio, $fecha, $hora, $id]);
    }

    header("Location: turnos.php");
    exit;
}
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Guardar turno</title>
    <link rel="stylesheet" href="styles.css">
</head>
<body>

    <!-- Contenedor principal para centrar todo -->
    <div class="caja-principal">
        <h1>Lucy Skin & Care</h1>
        <h2>Datos del turno</h2>

        <form method="POST">
            <input type="hidden" name="id" value="<?= htmlspecialchars($id) ?>">

            <label>Nombre del cliente:</label><br>
            <input type="text" name="nombre" value="<?= htmlspecialchars($nombre) ?>" required><br><br>

            <label>Servicio:</label><br>
            <select name="servicio" required>
                <option value="">Elegir servicio</option>
                <option value="Limpieza facial" <?= ($servicio == "Limpieza facial") ? "selected" : "" ?>>Limpieza facial</option>
                <option value="Manicura" <?= ($servicio == "Manicura") ? "selected" : "" ?>>Manicura</option>
                <option value="Perfilado de cejas" <?= ($servicio == "Perfilado de cejas") ? "selected" : "" ?>>Perfilado de cejas</option>
            </select><br><br>

            <label>Fecha:</label><br>
            <input type="date" name="fecha" value="<?= htmlspecialchars($fecha) ?>" required><br><br>

            <label>Hora:</label><br>
            <input type="time" name="hora" value="<?= htmlspecialchars($hora) ?>" required><br><br>

            <button type="submit" class="btn-turno">Guardar turno</button>
        </form>

        <p><a href="turnos.php">Volver a los turnos</a></p>
    </div>

</body>
</html>