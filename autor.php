<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Autor del Proyecto</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <!-- Íconos y Fuente -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;600;700&display=swap" rel="stylesheet">

    <style>
        body {
            margin: 0;
            font-family: 'Poppins', sans-serif;
            background: linear-gradient(135deg, #ff6600, #004d00);
            color: #fff;
            display: flex;
            justify-content: center;
            align-items: flex-start;
            min-height: 100vh;
            padding: 40px 15px;
        }

        .card {
            background-color: white;
            color: #333;
            border-radius: 18px;
            box-shadow: 0 10px 25px rgba(0, 0, 0, 0.25);
            padding: 30px 25px;
            max-width: 450px;
            width: 100%;
            text-align: center;
            transition: transform 0.3s ease;
        }

        .card:hover {
            transform: scale(1.01);
        }

        .autor-img {
            width: 140px;
            height: 140px;
            border-radius: 50%;
            object-fit: cover;
            border: 5px solid #ff6600;
            margin-bottom: 15px;
        }

        h1 {
            color: #004d00;
            font-size: 1.8rem;
            font-weight: 700;
            margin-bottom: 8px;
        }

        p {
            font-size: 0.95rem;
            margin: 0;
        }

        .qr-section {
            margin-top: 25px;
        }

        .qr-section h3 {
            font-size: 1.1rem;
            color: #004d00;
            margin-bottom: 18px;
        }

        .qr-container {
            display: flex;
            flex-wrap: wrap;
            justify-content: center;
            gap: 20px;
        }

        .qr-item {
            text-align: center;
        }

        .qr-item img {
            width: 140px;
            height: 140px;
            border-radius: 10px;
        }

        .qr-item h4 {
            margin-top: 8px;
            font-size: 0.95rem;
            font-weight: 600;
            color: #004d00;
        }

        .btn-volver {
            display: inline-block;
            margin-top: 25px;
            padding: 10px 22px;
            background-color: #004d00;
            color: white;
            text-decoration: none;
            border-radius: 40px;
            font-weight: 600;
            font-size: 0.95rem;
            transition: background-color 0.3s ease;
        }

        .btn-volver:hover {
            background-color: #003300;
        }

        .social-icons {
            margin-top: 20px;
        }

        .social-icons a {
            text-decoration: none;
        }

        .social-icons i {
            margin: 0 10px;
            color: #004d00;
            font-size: 24px;
            transition: transform 0.2s, color 0.2s;
        }

        .social-icons i:hover {
            transform: scale(1.2);
            color: #ff6600;
        }

        @media (max-width: 600px) {
            .card {
                padding: 25px 20px;
                max-width: 100%;
            }

            .autor-img {
                width: 120px;
                height: 120px;
            }

            .qr-item img {
                width: 120px;
                height: 120px;
            }
        }
    </style>
</head>
<body>

    <div class="card">
        <img src="foto1.jpeg" alt="Autor" class="autor-img">
        <h1>Javier Villaseñor</h1>
        <p><i class="fas fa-user-graduate"></i> Estudiante de medios digitales</p>

        <div class="qr-section">
            <h3><i class="fas fa-qrcode"></i> Escanea los QRs para visitar:</h3>
            <div class="qr-container">
                <!-- QR Awarspace -->
                <div class="qr-item">
                    <img src="https://api.qrserver.com/v1/create-qr-code/?data=http://jevvuacj.atwebpages.com/HMB3/index.php&size=200x200" alt="QR Awarspace">
                    <h4>Awarspace</h4>
                </div>

                <!-- QR GitHub -->
                <div class="qr-item">
                    <img src="https://api.qrserver.com/v1/create-qr-code/?data=https://github.com/JavierVV&size=200x200" alt="QR GitHub">
                    <h4>GitHub</h4>
                </div>
            </div>
        </div>

        <div class="social-icons">
            <a href="#"><i class="fab fa-facebook-square"></i></a>
            <a href="https://github.com/JavierVV" target="_blank"><i class="fab fa-github-square"></i></a>
            <a href="#"><i class="fab fa-instagram-square"></i></a>
        </div>

        <a href="index.php" class="btn-volver"><i class="fas fa-arrow-left"></i> Volver al Inicio</a>
    </div>

</body>
</html>

