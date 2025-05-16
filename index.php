<?php
session_start();
include('conexion.php');

// Cierre de sesión
if (isset($_GET['cerrar_sesion'])) {
    session_destroy();
    header('Location: index.php');
    exit;
}

// Registro
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['registrarse'])) {
    $nombre = $_POST['nombre'];
    $telefono = $_POST['telefono'];
    $correo = $_POST['correo'];

    if (!empty($nombre) && !empty($telefono) && !empty($correo)) {
        if (preg_match('/^\d{7}$/', $telefono)) {
            if (filter_var($correo, FILTER_VALIDATE_EMAIL)) {
                $stmt = $conexion->prepare("INSERT INTO usuarios (nombre, telefono, correo) VALUES (?, ?, ?)");
                $stmt->bind_param("sss", $nombre, $telefono, $correo);
                if ($stmt->execute()) {
                    $_SESSION['usuario_registrado'] = ['nombre' => $nombre];
                    echo "<script>alert('¡Registro exitoso!'); window.location.href = 'index.php';</script>";
                    exit;
                } else {
                    echo "<script>alert('Error al registrar.');</script>";
                }
            } else {
                echo "<script>alert('Correo electrónico inválido.');</script>";
            }
        } else {
            echo "<script>alert('El número de teléfono debe tener exactamente 7 dígitos.');</script>";
        }
    } else {
        echo "<script>alert('Por favor, completa todos los campos.');</script>";
    }
}

// Inicio de sesión
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['iniciar_sesion'])) {
    $nombre = $_POST['nombre_login'];
    $telefono = $_POST['telefono_login'];

    if (!empty($nombre) && !empty($telefono)) {
        $stmt = $conexion->prepare("SELECT * FROM usuarios WHERE nombre = ? AND telefono = ?");
        $stmt->bind_param("ss", $nombre, $telefono);
        $stmt->execute();
        $resultado = $stmt->get_result();

        if ($resultado->num_rows > 0) {
            $_SESSION['usuario_registrado'] = ['nombre' => $nombre];
            echo "<script>alert('¡Inicio de sesión exitoso!'); window.location.href = 'index.php';</script>";
            exit;
        } else {
            echo "<script>alert('Nombre o número incorrecto.');</script>";
        }
    } else {
        echo "<script>alert('Completa todos los campos para iniciar sesión.');</script>";
    }
}
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Formulario de Registro Opcional</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css">
    <style>
        body {
            background-color: #f8f9fa;
            font-family: 'Arial', sans-serif;
            color: #333;
        }
        .container {
            background-color: #fff;
            padding: 30px;
            border-radius: 8px;
            box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
            margin-top: 30px;
        }
        .logo {
            display: block;
            margin: 0 auto;
            height: 200px;
            width: auto;
        }
        h2 {
            color: #007bff;
            text-align: center;
            margin-bottom: 20px;
        }
        .btn-primary, .btn-success {
            background-color: #007bff;
            border-color: #007bff;
        }
        .btn-primary:hover, .btn-success:hover {
            background-color: #0056b3;
            border-color: #0056b3;
        }
        .btn-secondary {
            background-color: #6c757d;
            border-color: #6c757d;
        }
        .btn-secondary:hover {
            background-color: #5a6268;
            border-color: #5a6268;
        }
        .form-group label {
            font-weight: bold;
            color: #495057;
        }
        .form-control {
            border-radius: 4px;
            border: 1px solid #ced4da;
        }
        .acciones-usuario {
            display: flex;
            justify-content: center;
            gap: 15px;
            margin-top: 20px;
        }
        #formularioRegistro, #formularioLogin {
            display: none;
        }
    </style>
</head>
<body>
    <div>
        <img src="fotologo.png" alt="Logo" class="logo">
    </div>

    <div class="container mt-5">
        <h2>Bienvenido a nuestra página</h2>

        <?php if (isset($_SESSION['usuario_registrado'])): ?>
            <div class="alert alert-success text-center">
                <h4>¡Hola, <?php echo htmlspecialchars($_SESSION['usuario_registrado']['nombre']); ?>!</h4>
                <p>Ya estás registrado. ¿Qué deseas hacer?</p>
                <div class="acciones-usuario">
                    <a href="?cerrar_sesion=1" class="btn btn-danger">Cerrar sesión</a>
                    <a href="index_completo.php" class="btn btn-primary">Continuar</a>
                </div>
            </div>
        <?php else: ?>
            <div id="preguntaRegistro" class="text-center">
                <p>¿Deseas registrarte o iniciar sesión?</p>
                <button class="btn btn-primary" onclick="mostrarFormularioRegistro()">Registrarse</button>
                <button class="btn btn-secondary" onclick="mostrarFormularioLogin()">Iniciar sesión</button>
                <br><br>
                <button class="btn btn-link" onclick="noRegistrarse()">Continuar sin registrarse</button>
            </div>

            <!-- Formulario Registro -->
            <div id="formularioRegistro">
                <h3>Formulario de Registro</h3>
                <form method="POST" action="index.php">
                    <div class="form-group">
                        <label for="nombre">Nombre</label>
                        <input type="text" class="form-control" id="nombre" name="nombre" required>
                    </div>
                    <div class="form-group">
                        <label for="telefono">Número de Teléfono (7 dígitos)</label>
                        <input type="tel" class="form-control" id="telefono" name="telefono" pattern="\d{7}" maxlength="7" required>
                    </div>
                    <div class="form-group">
                        <label for="correo">Correo Electrónico</label>
                        <input type="email" class="form-control" id="correo" name="correo" required>
                    </div>
                    <button type="submit" class="btn btn-success" name="registrarse">Registrar</button>
                </form>
            </div>

            <!-- Formulario Login -->
            <div id="formularioLogin">
                <h3>Iniciar Sesión</h3>
                <form method="POST" action="index.php">
                    <div class="form-group">
                        <label for="nombre_login">Nombre</label>
                        <input type="text" class="form-control" id="nombre_login" name="nombre_login" required>
                    </div>
                    <div class="form-group">
                        <label for="telefono_login">Número de Teléfono (7 dígitos)</label>
                        <input type="tel" class="form-control" id="telefono_login" name="telefono_login" pattern="\d{7}" maxlength="7" required>
                    </div>
                    <button type="submit" class="btn btn-primary" name="iniciar_sesion">Iniciar sesión</button>
                </form>
            </div>
        <?php endif; ?>
    </div>

    <script>
        function mostrarFormularioRegistro() {
            document.getElementById("preguntaRegistro").style.display = "none";
            document.getElementById("formularioRegistro").style.display = "block";
        }

        function mostrarFormularioLogin() {
            document.getElementById("preguntaRegistro").style.display = "none";
            document.getElementById("formularioLogin").style.display = "block";
        }

        function noRegistrarse() {
            window.location.href = 'index_completo.php';
        }
    </script>

    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.5.3/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</body>
</html>



