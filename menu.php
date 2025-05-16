<?php
session_start();

// Agregar al carrito
if (isset($_POST['agregar'])) {
    $producto = $_POST['producto'];
    $precio = $_POST['precio'];

    if (!isset($_SESSION['carrito'])) {
        $_SESSION['carrito'] = [];
    }

    $_SESSION['carrito'][] = ['producto' => $producto, 'precio' => $precio];
}

// Calcular total del carrito
function calcularTotal() {
    $total = 0;
    if (isset($_SESSION['carrito'])) {
        foreach ($_SESSION['carrito'] as $item) {
            $total += $item['precio'];
        }
    }
    return $total;
}

// Vaciar carrito
if (isset($_POST['vaciar_carrito'])) {
    unset($_SESSION['carrito']);
}
?>

<!DOCTYPE html>
<html lang="es">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Menú | Hamburguesas Javy's</title>
  <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css">
  <style>
    body {
        font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
        background-color: #f9f9f9;
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
    .card.menu-card {
        border: none;
        border-radius: 12px;
        box-shadow: 0 4px 12px rgba(0, 0, 0, 0.05);
        transition: transform 0.2s;
    }
    .card.menu-card:hover {
        transform: translateY(-5px);
    }
    .card-img-top {
        border-top-left-radius: 12px;
        border-top-right-radius: 12px;
        height: 180px;
        object-fit: contain;
        background-color: #fff;
    }
    .card-body h5 {
        font-weight: 600;
        font-size: 1.2rem;
    }
    .card-body p {
        font-size: 0.95rem;
    }
    .btn-primary {
        background-color: #ff6600;
        border-color: #ff6600;
    }
    .btn-primary:hover {
        background-color: #e65c00;
        border-color: #e65c00;
        transform: scale(1.03);
    }
    .btn-danger {
        border-radius: 8px;
    }
    .list-group-item {
        border: none;
        background-color: #fff;
        border-radius: 6px;
        margin-bottom: 8px;
        box-shadow: 0 1px 4px rgba(0,0,0,0.05);
    }
    .cerrar-sesion {
        color: white;
        font-weight: bold;
    }
    .cerrar-sesion:hover {
        color: #ff6600;
        text-decoration: none;
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
      <li class="nav-item">
        <a class="nav-link" href="index.php" style="color: white;">Inicio</a>
      </li>
      <li class="nav-item">
        <a class="nav-link" href="menu.php" style="color: white;">Menú</a>
      </li>
      <li class="nav-item">
        <a class="nav-link" href="autor.php" style="color: white;">Autor</a>
      </li>
      <li class="nav-item">
        <a class="nav-link" href="usuarios.php" style="color: white;">Usuarios</a>
      </li>
      <!-- Opción "Cerrar sesión" eliminada -->
    </ul>
  </div>
</nav>


<!-- Header -->
<div class="header">
  <h1>Menú Completo</h1>
  <p>Selecciona tus platillos favoritos y agréguelos al carrito.</p>
</div>

<!-- Menú de Hamburguesas -->
<section id="menu" class="container mt-5">
  <h2>Hamburguesas</h2>
  <div class="row">
    <!-- Winny -->
    <div class="col-md-4">
      <div class="card menu-card">
        <img src="winny.png" class="card-img-top" alt="Hamburguesa de Winny">
        <div class="card-body">
          <h5 class="card-title">Hamburguesa de Winny</h5>
          <p class="card-text">Deliciosa hamburguesa con carne de winny.</p>
          <p class="card-text font-weight-bold">$50</p>
          <form action="menu.php" method="POST">
            <input type="hidden" name="producto" value="Hamburguesa de Winny">
            <input type="hidden" name="precio" value="50">
            <button type="submit" name="agregar" class="btn btn-primary">Agregar al Carrito</button>
          </form>
        </div>
      </div>
    </div>

    <!-- Piña -->
    <div class="col-md-4">
      <div class="card menu-card">
        <img src="pina.png" class="card-img-top" alt="Hamburguesa de Piña">
        <div class="card-body">
          <h5 class="card-title">Hamburguesa de Piña</h5>
          <p class="card-text">Hamburguesa con piña fresca, sabor único.</p>
          <p class="card-text font-weight-bold">$55</p>
          <form action="menu.php" method="POST">
            <input type="hidden" name="producto" value="Hamburguesa de Piña">
            <input type="hidden" name="precio" value="55">
            <button type="submit" name="agregar" class="btn btn-primary">Agregar al Carrito</button>
          </form>
        </div>
      </div>
    </div>

    <!-- Pyw -->
    <div class="col-md-4">
      <div class="card menu-card">
        <img src="doble.png" class="card-img-top" alt="Hamburguesa de Pyw">
        <div class="card-body">
          <h5 class="card-title">Hamburguesa de Pyw</h5>
          <p class="card-text">Hamburguesa con carne de pollo y cerdo.</p>
          <p class="card-text font-weight-bold">$60</p>
          <form action="menu.php" method="POST">
            <input type="hidden" name="producto" value="Hamburguesa de Pyw">
            <input type="hidden" name="precio" value="60">
            <button type="submit" name="agregar" class="btn btn-primary">Agregar al Carrito</button>
          </form>
        </div>
      </div>
    </div>
  </div>
</section>

<!-- Promociones -->
<section class="container mt-5">
  <h2 class="mt-5">Promociones Miércoles y Domingo</h2>
  <div class="row">
    <!-- Promoción 1 -->
    <div class="col-md-4">
      <div class="card menu-card">
        <img src="promo.PNG" class="card-img-top" alt="Promoción Winny y Papas">
        <div class="card-body">
          <h5 class="card-title">Hamburguesa de Winny + Papas y Refresco</h5>
          <p class="card-text">Disfruta de esta increíble promoción.</p>
          <p class="card-text font-weight-bold">$80</p>
          <form action="menu.php" method="POST">
            <input type="hidden" name="producto" value="Hamburguesa de Winny + Papas y Refresco">
            <input type="hidden" name="precio" value="80">
            <button type="submit" name="agregar" class="btn btn-primary">Agregar al Carrito</button>
          </form>
        </div>
      </div>
    </div>

    <!-- Promoción 2 -->
    <div class="col-md-4">
      <div class="card menu-card">
        <img src="promo.PNG" class="card-img-top" alt="Promoción Piña">
        <div class="card-body">
          <h5 class="card-title">Hamburguesa de Piña + Papas y Refresco</h5>
          <p class="card-text">Promoción con sabor tropical irresistible.</p>
          <p class="card-text font-weight-bold">$85</p>
          <form action="menu.php" method="POST">
            <input type="hidden" name="producto" value="Hamburguesa de Piña + Papas y Refresco">
            <input type="hidden" name="precio" value="85">
            <button type="submit" name="agregar" class="btn btn-primary">Agregar al Carrito</button>
          </form>
        </div>
      </div>
    </div>

    <!-- Promoción 3 -->
    <div class="col-md-4">
      <div class="card menu-card">
        <img src="promo.PNG" class="card-img-top" alt="Piña y Winny">
        <div class="card-body">
          <h5 class="card-title">Hamburguesa de Piña y Winny + P,R</h5>
          <p class="card-text">Una mezcla deliciosa de piña con winny.</p>
          <p class="card-text font-weight-bold">$90</p>
          <form action="menu.php" method="POST">
            <input type="hidden" name="producto" value="Hamburguesa de Piña y Winny + P,R">
            <input type="hidden" name="precio" value="90">
            <button type="submit" name="agregar" class="btn btn-primary">Agregar al Carrito</button>
          </form>
        </div>
      </div>
    </div>

    <!-- Promoción 4 -->
    <div class="col-md-4 mt-4">
      <div class="card menu-card">
        <img src="promo.PNG" class="card-img-top" alt="Doble Carne">
        <div class="card-body">
          <h5 class="card-title">Hamburguesa Doble Carne + P,R</h5>
          <p class="card-text">Más carne, más sabor. Ideal para los amantes de lo clásico.</p>
          <p class="card-text font-weight-bold">$100</p>
          <form action="menu.php" method="POST">
            <input type="hidden" name="producto" value="Hamburguesa Doble Carne">
            <input type="hidden" name="precio" value="100">
            <button type="submit" name="agregar" class="btn btn-primary">Agregar al Carrito</button>
          </form>
        </div>
      </div>
    </div>
  </div>
</section>

<!-- Carrito -->
<section class="container mt-5">
  <h2>Carrito de Compras</h2>
  <?php if (!empty($_SESSION['carrito'])): ?>
    <ul class="list-group">
      <?php foreach ($_SESSION['carrito'] as $item): ?>
        <li class="list-group-item d-flex justify-content-between align-items-center">
          <?php echo htmlspecialchars($item['producto']); ?>
          <span>$<?php echo number_format($item['precio'], 2); ?></span>
        </li>
      <?php endforeach; ?>
    </ul>
    <div class="mt-3">
      <strong>Total:</strong> $<?php echo number_format(calcularTotal(), 2); ?>
    </div>
    <form method="POST" class="mt-2">
      <button type="submit" name="vaciar_carrito" class="btn btn-danger">Vaciar Carrito</button>
    </form>
  <?php else: ?>
    <p>El carrito está vacío.</p>
  <?php endif; ?>
</section>

<!-- Footer -->
<footer class="footer">
  <p>&copy; <?php echo date('Y'); ?> Hamburguesas Javy's. Todos los derechos reservados.</p>
</footer>

<script src="https://code.jquery.com/jquery-3.3.1.slim.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js"></script>
</body>
</html>







