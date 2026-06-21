<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Urban Shoes | E-commerce</title>

    <link rel="stylesheet" href="{{ asset('css/estilos.css') }}?v={{ time() }}">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.css">
</head>
<body>

<nav class="navbar-ecommerce">
    <div class="nav-content">
        <a href="{{ route('inicio') }}" class="logo">👟 Urban<span>Shoes</span></a>

        <div class="nav-links">
            <a href="{{ route('inicio') }}" class="active">Inicio</a>
            <a href="{{ route('catalogo') }}">Catálogo</a>
            <a href="{{ route('carrito') }}">Carrito 🛒</a>
        </div>
    </div>
</nav>

<section class="home-hero">
    <div class="home-hero-content">
        <div class="home-text">
            <span class="tag-outline">NUEVA COLECCIÓN 2026</span>

            <h1>
                Zapatos que <br>
                <span>definen tu estilo</span>
            </h1>

            <p>
                Descubre tenis deportivos, urbanos y casuales con comodidad,
                calidad premium y diseño moderno para todos los días.
            </p>

            <div class="hero-actions">
                <a href="{{ route('catalogo') }}" class="btn-main">
                    Explorar catálogo <i class="bi bi-arrow-right"></i>
                </a>

                <a href="{{ route('carrito') }}" class="btn-outline-light">
                    <i class="bi bi-cart3"></i> Ver carrito
                </a>
            </div>

            <div class="hero-benefits">
                <span><i class="bi bi-truck"></i> Envíos rápidos</span>
                <span><i class="bi bi-shield-check"></i> Pagos seguros</span>
                <span><i class="bi bi-award"></i> Calidad premium</span>
            </div>
        </div>

        <div class="home-image-card">
            <img src="https://images.unsplash.com/photo-1542291026-7eec264c27ff?w=900" alt="Zapato UrbanShoes">
        </div>
    </div>
</section>

<section class="stats home-stats">
    <div class="stat-box">
        <h2>500+</h2>
        <p>Productos</p>
    </div>

    <div class="stat-box">
        <h2>1200+</h2>
        <p>Clientes felices</p>
    </div>

    <div class="stat-box">
        <h2>24/7</h2>
        <p>Soporte</p>
    </div>
</section>

</body>
</html>