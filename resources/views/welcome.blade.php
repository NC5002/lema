<!-- resources/views/welcome.blade.php -->
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Bienvenido | Restaurante FL</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.3/font/bootstrap-icons.css" rel="stylesheet">
    <style>
        body {
            background-color: #F5F1ED; /* Beige claro */
            color: #2E2E2E; /* Gris oscuro */
            font-family: 'Segoe UI', sans-serif;
        }
        .hero {
            background-color: #7B2C32; /* Burgundy */
            color: white;
            padding: 100px 0;
            text-align: center;
        }
        .btn-custom {
            background-color: #6A994E; /* Verde oliva */
            border: none;
            transition: all 0.3s ease;
        }
        .btn-custom:hover {
            background-color: #588a40;
            transform: scale(1.05);
        }
    </style>
</head>
<body>

    <div class="hero">
        <h1 class="display-4 fw-bold">¡Bienvenido a Restaurante FL!</h1>
        <p class="lead">Gestión inteligente de compras, ventas y stock</p>
        @auth
            <a href="{{ route('dashboard') }}" class="btn btn-light btn-lg mt-3">
                <i class="bi bi-speedometer2 me-1"></i> Ir al Dashboard
            </a>
        @else
            <a href="{{ route('login') }}" class="btn btn-custom btn-lg mt-3 me-2">
                <i class="bi bi-box-arrow-in-right me-1"></i> Iniciar Sesión
            </a>
            <a href="{{ route('register') }}" class="btn btn-outline-light btn-lg mt-3">
                <i class="bi bi-person-plus me-1"></i> Registrarse
            </a>
        @endauth
    </div>

    <div class="container text-center mt-5">
        <h3 class="fw-bold">¿Qué puedes hacer aquí?</h3>
        <p class="text-muted">Administra tus compras, productos, ingredientes y más desde una plataforma ágil y moderna.</p>
        <div class="row justify-content-center mt-4">
            <div class="col-md-4">
                <i class="bi bi-clipboard-data fs-1 text-success"></i>
                <h5 class="mt-3">Control total</h5>
                <p class="text-muted">Gestiona inventario y ventas en tiempo real.</p>
            </div>
            <div class="col-md-4">
                <i class="bi bi-people fs-1 text-warning"></i>
                <h5 class="mt-3">Usuarios y Clientes</h5>
                <p class="text-muted">Administra accesos y perfiles fácilmente.</p>
            </div>
            <div class="col-md-4">
                <i class="bi bi-box-seam fs-1 text-danger"></i>
                <h5 class="mt-3">Productos e Ingredientes</h5>
                <p class="text-muted">Lleva el control de tus recetas y stock.</p>
            </div>
        </div>
    </div>

</body>
</html>
