<?php
session_start();
session_unset();
session_destroy();
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Sesión cerrada</title>
    <link rel="stylesheet" href="styles.css">
</head>
<body style="background-image: url('img/fondo.png'); background-size: cover; background-position: center; display: flex; justify-content: center; align-items: center; height: 100vh; margin: 0;">

    <div class="caja-principal" style="text-align: center;">
        <h2>Sesión cerrada con éxito</h2>
        <p>Has salido del sistema de Lucy Skin & Care.</p>
        <p><a href="login.php" class="btn-enlace">Iniciar sesión nuevamente</a></p>
    </div>

</body>
</html>