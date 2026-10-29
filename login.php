<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Iniciar sesión</title>
    <link rel="stylesheet" href="styles.css">
</head>
<body>

    <!-- Caja contenedora principal para centrar todo -->
    <div class="caja-principal">
        <h1>Lucy Skin & Care</h1>
        <h2>Iniciar sesión</h2>

        <form action="verificar_login.php" method="POST">
            <label>Usuario:</label><br>
            <input type="text" name="usuario" required><br><br>

            <label>Contraseña:</label><br>
            <input type="password" name="password" required><br><br>

            <button type="submit" class="btn-turno">Ingresar</button>
        </form>

        <p><a href="index.php">Volver al inicio</a></p>
    </div>

</body>
</html>