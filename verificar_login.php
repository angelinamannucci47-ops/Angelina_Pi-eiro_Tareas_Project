<?php
session_start();
require_once "conexion.php";

$email = trim($_POST["usuario"] ?? "");
$password = $_POST["password"] ?? "";

if ($email === "" || $password === "") {
    header("Location: login.php?error=1");
    exit;
}

try {
    $sql = "SELECT id, nombre, email, password_hash
            FROM usuarios
            WHERE email = ?";

    $stmt = $conexion->prepare($sql);
    $stmt->execute([$email]);

    $datos = $stmt->fetch();

    if ($datos && password_verify($password, $datos["password_hash"])) {
        session_regenerate_id(true);

        $_SESSION["usuario_id"] = $datos["id"];
        $_SESSION["usuario"] = $datos["nombre"];

        header("Location: turnos.php");
        exit;
    }

    header("Location: login.php?error=1");
    exit;

} catch (PDOException $e) {
    error_log($e->getMessage());
    http_response_code(500);
    exit("Ocurrió un error al verificar el usuario.");
}
?>