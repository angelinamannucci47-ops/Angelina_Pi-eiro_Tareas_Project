<?php
require_once "conexion.php";

try {
    $nombre = "Administradora";
    $email = "admin@lucyskin.com";
    $password = password_hash("Estetica123!", PASSWORD_DEFAULT);

    $sql = "SELECT id FROM usuarios WHERE email = ?";
    $consulta = $conexion->prepare($sql);
    $consulta->execute([$email]);

    if ($consulta->fetch()) {
        exit("El usuario ya existe. No se creó otro.");
    }

    $sql = "INSERT INTO usuarios (nombre, email, password_hash)
            VALUES (?, ?, ?)";

    $consulta = $conexion->prepare($sql);
    $consulta->execute([$nombre, $email, $password]);

    echo "Usuario creado correctamente. Ya podés iniciar sesión.";

} catch (PDOException $e) {
    error_log($e->getMessage());
    exit("No se pudo crear el usuario.");
}
?>