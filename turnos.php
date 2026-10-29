
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>final</title>
    <link rel="stylesheet" href="styles.css">
</head>
<body>
    
<?php
session_start();

if (!isset($_SESSION["usuario"])) {
    header("Location: login.php");
    exit;
}

require_once "conexion.php";

$sql = "SELECT * FROM turnos";
$resultado = $conexion->query($sql);
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Turnos</title>
    <link rel="stylesheet" href="styles.css">
</head>
<body>

   
    <div class="caja-principal">
        <h1>Lucy Skin & Care</h1>
        <h2>Gestión de turnos</h2>

        <p>Bienvenida al sistema de turnos.</p>
        <p><a href="guardar_turno.php" class="btn-enlace">Agregar turno</a></p>
        
        <table class="tabla-turnos">
            <tr>
                <th>Nombre</th>
                <th>Servicio</th>
                <th>Fecha</th>
                <th>Hora</th>
                <th>Acciones</th>
            </tr>

            <?php while ($fila = $resultado->fetch()) { ?>
            <tr>
                <!-- Cambiado de $turno a $fila para que coincida con el while -->
                <td><?= htmlspecialchars($fila["nombre"]) ?></td>
                <td><?= htmlspecialchars($fila["servicio"]) ?></td>
                <td><?= htmlspecialchars($fila["fecha"]) ?></td>
                <td><?= htmlspecialchars($fila["hora"]) ?></td>
                <td class="acciones">
                    <a href="guardar_turno.php?id=<?= $fila["id"] ?>">Editar</a>

                    <form action="eliminar_turno.php" method="POST" style="display:inline;">
                        <input type="hidden" name="id" value="<?= $fila["id"] ?>">
                        <button type="submit" class="btn-eliminar">Eliminar</button>
                    </form>
                </td>
            </tr>
            <?php } ?>
        </table>
        
       <p><a href="indexx.php">Cerrar sesión</a></p>
    </div>

</body>
</html>
</body>
</html>