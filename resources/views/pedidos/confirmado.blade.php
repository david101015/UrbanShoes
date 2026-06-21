<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Pedido confirmado | UrbanShoes</title>

    <link rel="stylesheet" href="{{ asset('css/estilos.css') }}?v={{ time() }}">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.css">
</head>
<body>

<nav class="navbar-ecommerce">
    <div class="container nav-content">
        <a href="{{ route('inicio') }}" class="logo">Urban<span>Shoes</span> 👟</a>

        <div class="nav-links">
            <a href="{{ route('inicio') }}">Inicio</a>
            <a href="{{ route('catalogo') }}">Catálogo</a>
            <a href="{{ route('carrito') }}">Carrito 🛒</a>
        </div>
    </div>
</nav>

<main class="success-page">
    <div class="success-card">

        <div class="success-icon">
            <i class="bi bi-check-circle-fill"></i>
        </div>

        <h1>¡Pedido realizado con éxito!</h1>

        <p>
            Tu pedido fue registrado correctamente.
        </p>

        <h2>
            Pedido #{{ str_pad($pedido->id, 6, '0', STR_PAD_LEFT) }}
        </h2>

        <p>
            Total: <strong>$ {{ number_format($pedido->total, 0, ',', '.') }}</strong>
        </p>

        <div class="success-actions">
            <a href="{{ route('pedidos.factura', $pedido->id) }}" class="btn-success-primary">
                <i class="bi bi-receipt"></i> Ver factura
            </a>

            <a href="{{ route('catalogo') }}" class="btn-success-secondary">
                <i class="bi bi-bag"></i> Seguir comprando
            </a>
        </div>

    </div>
</main>

</body>
</html>