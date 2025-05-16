<?php
$host = "localhost";
$usuario = "root";
$contrasena = ""; // Deja esto vacío si no tienes contraseña en XAMPP
$base_datos = "hmbs";

$conexion = new mysqli($host, $usuario, $contrasena, $base_datos);

if ($conexion->connect_error) {
    die("Conexión fallida: " . $conexion->connect_error);
}
?>

