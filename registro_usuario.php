<?php
include('conexion.php');

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $nombre = $_POST['nombre'];
    $correo = $_POST['correo'];
    $contrasena = password_hash($_POST['contrasena'], PASSWORD_DEFAULT);

    $sql = "INSERT INTO usuarios (nombre, correo, contraseña) VALUES ('$nombre', '$correo', '$contrasena')";

    if ($conexion->query($sql) === TRUE) {
        echo "Usuario registrado con éxito";
    } else {
        echo "Error: " . $conexion->error;
    }

    $conexion->close();
}
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Registro de Usuario</title>
</head>
<body>
    <h2>Registro</h2>
    <form method="POST">
        Nombre: <input type="text" name="nombre" required><br><br>
        Correo: <input type="email" name="correo" required><br><br>
        Contraseña: <input type="password" name="contrasena" required><br><br>
        <button type="submit">Registrarse</button>
    </form>
</body>
</html>
