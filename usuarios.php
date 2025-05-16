<?php
include('conexion.php');

// Eliminar usuario
if (isset($_GET['eliminar'])) {
    $id = $_GET['eliminar'];
    $conexion->query("DELETE FROM usuarios WHERE id = $id");
    header("Location: usuarios.php");
    exit;
}

// Editar usuario
if (isset($_POST['editar'])) {
    $id = $_POST['id'];
    $nombre = $_POST['nombre'];
    $telefono = $_POST['telefono'];

    $stmt = $conexion->prepare("UPDATE usuarios SET nombre = ?, telefono = ? WHERE id = ?");
    $stmt->bind_param("ssi", $nombre, $telefono, $id);
    $stmt->execute();
    header("Location: usuarios.php");
    exit;
}
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Administrar Usuarios</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <style>
        body {
            background-color: #f7f7f7;
            font-family: Arial, sans-serif;
            color: #333;
        }

        .navbar {
            background-color: #004d00;
        }
        .navbar a {
            color: white !important;
        }
        .navbar a:hover {
            background-color: #ff6600;
        }

        .container {
            margin-top: 30px;
        }

        .table {
            background-color: white;
            border-radius: 8px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
        }

        .btn-custom {
            background-color: #004d00;
            color: white;
        }
        .btn-custom:hover {
            background-color: #ff6600;
            color: white;
        }

        .form-container {
            background-color: white;
            padding: 20px;
            border-radius: 8px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
        }

        h2, h3 {
            color: #004d00;
        }

        .footer {
            background-color: #004d00;
            color: white;
            text-align: center;
            padding: 20px;
            margin-top: 50px;
        }

        .btn-danger {
            background-color: #ff6600;
            border-color: #ff6600;
        }

        .btn-danger:hover {
            background-color: #e65c00;
            border-color: #e65c00;
        }

        /* Estilos responsivos */
        @media (max-width: 767px) {
            .table {
                font-size: 14px;  /* Hacer las fuentes más pequeñas en pantallas pequeñas */
            }

            .form-container {
                margin: 10px;
                padding: 15px;
            }

            .btn-custom, .btn-danger {
                width: 100%;  /* Los botones ocupan todo el ancho en dispositivos móviles */
            }

            .navbar-brand {
                font-size: 1.2rem;  /* Ajustar tamaño del texto de la navbar */
            }

            .navbar-nav {
                margin-top: 10px;  /* Separar un poco los elementos de la navbar */
            }
        }

        /* Para tabletas */
        @media (max-width: 991px) {
            .navbar-nav {
                text-align: center;
            }

            .table {
                font-size: 16px;
            }
        }
    </style>
</head>
<body>

    <!-- Navbar -->
    <nav class="navbar navbar-expand-lg navbar-light">
        <a class="navbar-brand" href="#">Hamburguesas Javy's</a>
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNav" 
                aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarNav">
            <ul class="navbar-nav ml-auto">
                <li class="nav-item"><a class="nav-link" href="index_completo.php">Inicio</a></li>
                <li class="nav-item"><a class="nav-link" href="usuarios.php">Usuarios</a></li>
            </ul>
        </div>
    </nav>

    <div class="container">
        <h2 class="text-center">Usuarios Registrados</h2>

        <!-- Tabla de usuarios -->
        <table class="table table-striped table-hover">
            <thead class="thead-dark">
                <tr>
                    <th>Nombre</th>
                    <th>Teléfono</th>
                    <th>Acciones</th>
                </tr>
            </thead>
            <tbody>
                <?php
                $resultado = $conexion->query("SELECT * FROM usuarios");
                while ($fila = $resultado->fetch_assoc()):
                ?>
                    <tr>
                        <td><?php echo htmlspecialchars($fila['nombre']); ?></td>
                        <td><?php echo htmlspecialchars($fila['telefono']); ?></td>
                        <td>
                            <button class="btn btn-warning btn-sm" onclick="editarUsuario('<?php echo $fila['id']; ?>', '<?php echo addslashes($fila['nombre']); ?>', '<?php echo $fila['telefono']; ?>')">Editar</button>
                            <a href="usuarios.php?eliminar=<?php echo $fila['id']; ?>" class="btn btn-danger btn-sm" onclick="return confirm('¿Estás seguro de eliminar este usuario?')">Eliminar</a>
                        </td>
                    </tr>
                <?php endwhile; ?>
            </tbody>
        </table>

        <!-- Formulario para editar usuario -->
        <div id="formEditar" class="form-container" style="display:none;">
            <h3>Editar Usuario</h3>
            <form method="POST" action="usuarios.php">
                <input type="hidden" name="id" id="edit_id">
                <div class="form-group">
                    <label for="edit_nombre">Nombre:</label>
                    <input type="text" class="form-control" name="nombre" id="edit_nombre" required>
                </div>
                <div class="form-group">
                    <label for="edit_telefono">Teléfono:</label>
                    <input type="text" class="form-control" name="telefono" id="edit_telefono" required>
                </div>
                <button type="submit" class="btn btn-success" name="editar">Guardar Cambios</button>
                <button type="button" class="btn btn-secondary" onclick="cancelarEdicion()">Cancelar</button>
            </form>
        </div>

    </div>

    <!-- Footer -->
    <div class="footer">
        <p>&copy; <?php echo date("Y"); ?> Hamburguesas Javy's | Todos los derechos reservados</p>
    </div>

    <!-- Scripts -->
    <script>
        function editarUsuario(id, nombre, telefono) {
            document.getElementById('formEditar').style.display = 'block';
            document.getElementById('edit_id').value = id;
            document.getElementById('edit_nombre').value = nombre;
            document.getElementById('edit_telefono').value = telefono;
        }

        function cancelarEdicion() {
            document.getElementById('formEditar').style.display = 'none';
        }
    </script>

    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.5.3/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>

</body>
</html>




