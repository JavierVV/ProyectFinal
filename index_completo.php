<?php session_start(); ?>
<!DOCTYPE html>
<html lang="es">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Inicio | Hamburguesas Javy's</title>
  <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css">
  <style>
    body {
      font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
      background-color: #f9f9f9;
      color: #333;
      margin: 0;
      padding: 0;
    }

    .navbar {
      background-color: #004d00;
    }

    .navbar a {
      color: white !important;
      text-decoration: none;
      padding: 14px 20px;
      display: block;
      transition: background-color 0.3s;
    }

    .navbar a:hover {
      background-color: #ff6600;
    }

    .cerrar-sesion {
      color: white !important;
      font-weight: bold;
    }

    .cerrar-sesion:hover {
      color: #ff6600 !important;
    }

    .header {
      text-align: center;
      margin-top: 40px;
      margin-bottom: 20px;
    }

    .header h1 {
      font-size: 2.8rem;
      color: #004d00;
    }

    .header p {
      font-size: 1.1rem;
      color: #ff6600;
    }

    .footer {
      text-align: center;
      background-color: #333;
      color: white;
      padding: 20px 0;
      margin-top: 50px;
    }

    .carousel-item img {
      width: 100%;
      height: 100%;
      object-fit: contain;
    }

    @media (min-width: 992px) {
      .carousel-item img {
        height: 500px;
      }
    }

    @media (max-width: 991px) {
      .carousel-item img {
        height: auto;
      }
    }

    .quienes-somos {
      margin: 60px auto;
      max-width: 1000px;
    }

    .quienes-somos h2 {
      font-size: 2rem;
      margin-bottom: 30px;
      text-align: center;
      color: #004d00;
    }

    .quienes-somos .img-circular {
      width: 250px;
      height: 250px;
      object-fit: cover;
      border-radius: 50%;
      cursor: pointer;
      border: 4px solid #ff6600;
    }
  </style>
</head>
<body>

<!-- Navbar -->
<nav class="navbar navbar-expand-lg navbar-light">
  <a class="navbar-brand d-flex align-items-center" href="index.php">
    <img src="fotologo.png" alt="Hamburguesas Javy's" style="height: 40px; margin-right: 10px;">
    <span style="color: white; font-weight: bold;">
      Hamburguesas Javy's
      <?php if (isset($_SESSION['usuario_registrado'])): ?>
        <span style="font-style: italic; font-family: 'Courier New', Courier, monospace;">
          (<?php echo htmlspecialchars($_SESSION['usuario_registrado']['nombre']); ?>)
        </span>
      <?php endif; ?>
    </span>
  </a>
  <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNav"
          aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
    <span class="navbar-toggler-icon"></span>
  </button>

  <div class="collapse navbar-collapse" id="navbarNav">
    <ul class="navbar-nav ml-auto">
      <li class="nav-item"><a class="nav-link" href="index.php" style="color: white;">Inicio</a></li>
      <li class="nav-item"><a class="nav-link" href="menu.php" style="color: white;">Menú</a></li>
      <li class="nav-item"><a class="nav-link" href="autor.php" style="color: white;">Autor</a></li>
      <li class="nav-item"><a class="nav-link" href="http://jevvuacj.atwebpages.com/HMB3/usuarios.php" style="color: white;">Usuarios</a></li>
      <!-- Eliminada opción "Cerrar sesión"
      <?php if (isset($_SESSION['usuario_registrado'])): ?>
        <li class="nav-item"><a class="nav-link cerrar-sesion" href="cerrar_sesion.php">Cerrar sesión</a></li>
      <?php endif; ?>
      -->
    </ul>
  </div>
</nav>

<!-- Header -->
<div class="header">
  <h1>Bienvenidos a Hamburguesas Javy's</h1>
  <p>Disfruta de nuestras deliciosas hamburguesas, hechas con ingredientes frescos y de calidad.</p>
</div>

<!-- Carrusel -->
<div id="carouselExampleIndicators" class="carousel slide" data-ride="carousel">
  <ol class="carousel-indicators">
    <li data-target="#carouselExampleIndicators" data-slide-to="0" class="active"></li>
    <li data-target="#carouselExampleIndicators" data-slide-to="1"></li>
    <li data-target="#carouselExampleIndicators" data-slide-to="2"></li>
  </ol>
  <div class="carousel-inner">
    <div class="carousel-item active"><img src="foto2.JPG" class="d-block w-100" alt="Hamburguesa 1"></div>
    <div class="carousel-item"><img src="foto3.JPG" class="d-block w-100" alt="Hamburguesa 2"></div>
    <div class="carousel-item"><img src="foto4.JPG" class="d-block w-100" alt="Hamburguesa 3"></div>
  </div>
  <a class="carousel-control-prev" href="#carouselExampleIndicators" role="button" data-slide="prev">
    <span class="carousel-control-prev-icon" aria-hidden="true"></span><span class="sr-only">Anterior</span>
  </a>
  <a class="carousel-control-next" href="#carouselExampleIndicators" role="button" data-slide="next">
    <span class="carousel-control-next-icon" aria-hidden="true"></span><span class="sr-only">Siguiente</span>
  </a>
</div>

<!-- ¿Quiénes somos? -->
<div class="quienes-somos container mt-5">
  <h2>¿Quiénes somos?</h2>
  <div class="row align-items-center">
    <div class="col-md-4 text-center">
      <img src="menu.png" alt="Quiénes somos" class="img-circular" data-toggle="modal" data-target="#imagenModal">
    </div>
    <div class="col-md-8">
      <p>
        En Hamburguesas Javy's nos especializamos en ofrecer hamburguesas con sabor casero, ingredientes frescos y una
        experiencia única para nuestros clientes. Con años de experiencia en la cocina, cada platillo es preparado con
        dedicación y pasión.
      </p>
    </div>
  </div>
</div>

<!-- Modal -->
<div class="modal fade" id="imagenModal" tabindex="-1" role="dialog" aria-labelledby="imagenModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered" role="document">
    <div class="modal-content">
      <div class="modal-body p-0">
        <img src="menu.png" alt="Menú completo" class="img-fluid w-100">
      </div>
    </div>
  </div>
</div>

<!-- Footer -->
<footer class="footer">
  <p>&copy; <?php echo date("Y"); ?> Hamburguesas Javy's. Todos los derechos reservados.</p>
</footer>

<!-- Scripts de Bootstrap -->
<script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@4.3.1/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
























