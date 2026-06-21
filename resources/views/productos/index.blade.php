<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Urban Shoes | Catálogo</title>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="{{ asset('css/estilos.css') }}?v={{ time() }}">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.css">
</head>

<body>

<nav class="navbar-ecommerce">
    <div class="nav-content">
        <a href="{{ route('inicio') }}" class="logo">👟 Urban<span>Shoes</span></a>

        <div class="nav-links">
            <a href="{{ route('inicio') }}">Inicio</a>
            <a href="{{ route('catalogo') }}" class="active">Catálogo</a>
            <a href="#novedades">Novedades</a>
            <a href="#contacto">Contacto</a>
        </div>

        <div class="nav-icons">
            <a href="#catalogo">
                <i class="bi bi-search"></i>
            </a>

            <a href="{{ route('carrito') }}">
                <i class="bi bi-cart3"></i>
            </a>
        </div>
    </div>
</nav>

<section class="hero-shop">
    <div class="hero-grid">
        <div class="hero-text">
            <span class="tag-outline">NUEVA COLECCIÓN 2026</span>

            <h1>
                Zapatos que <br>
                <span>elevan tu estilo</span>
            </h1>

            <p>Explora modelos deportivos, urbanos y cómodos para todos los días.</p>

            <div class="hero-actions">
                <a href="#catalogo" class="btn-main">
                    Ver catálogo <i class="bi bi-arrow-right"></i>
                </a>

                <a href="{{ route('carrito') }}" class="btn-outline-light">
                    <i class="bi bi-cart3"></i> Ver carrito
                </a>
            </div>

            <div class="hero-benefits">
                <span><i class="bi bi-truck"></i> Envíos rápidos</span>
                <span><i class="bi bi-shield-check"></i> Pagos seguros</span>
                <span><i class="bi bi-award"></i> Calidad premium</span>
                <span><i class="bi bi-patch-check"></i> Garantía 30 días</span>
            </div>
        </div>

        <div class="hero-card">
            <span>OFERTA DESTACADA</span>
            <h2>SALE</h2>
            <strong>Hasta 30% OFF</strong>
            <p>Modelos deportivos y urbanos</p>

            <a href="{{ route('catalogo', ['categoria' => 'oferta']) }}">
                Ver ofertas <i class="bi bi-arrow-right"></i>
            </a>
        </div>
    </div>
</section>

<main class="catalogo-page" id="catalogo">

    @if(session('ok'))
        <div class="alert alert-success mt-4">
            {{ session('ok') }}
        </div>
    @endif

    <section class="section-header">
        <div>
            <span class="tag-orange">Colección UrbanShoes</span>
            <h2>Catálogo de productos</h2>
            <p>Encuentra zapatos deportivos y urbanos para tu estilo.</p>
        </div>

        <form method="GET" action="{{ route('catalogo') }}" class="search-box search-pro">
            <i class="bi bi-search"></i>

            <input 
                type="text" 
                name="buscar" 
                placeholder="Buscar zapato..."
                value="{{ request('buscar') }}"
            >

            <button type="submit">Buscar</button>

            @if(request('buscar'))
                <a href="{{ route('catalogo') }}" class="btn-clear-search">Limpiar</a>
            @endif
        </form>
    </section>

    <div class="category-filters">
        <a href="{{ route('catalogo') }}" class="{{ !request('categoria') ? 'active' : '' }}">
            <i class="bi bi-grid"></i> Todos
        </a>

        <a href="{{ route('catalogo', ['categoria' => 'deportivo']) }}" class="{{ request('categoria') == 'deportivo' ? 'active' : '' }}">
            <i class="bi bi-lightning"></i> Deportivos
        </a>

        <a href="{{ route('catalogo', ['categoria' => 'urbano']) }}" class="{{ request('categoria') == 'urbano' ? 'active' : '' }}">
            <i class="bi bi-stars"></i> Urbanos
        </a>

        <a href="{{ route('catalogo', ['categoria' => 'running']) }}" class="{{ request('categoria') == 'running' ? 'active' : '' }}">
            <i class="bi bi-fire"></i> Running
        </a>

        <a href="{{ route('catalogo', ['categoria' => 'oferta']) }}" class="{{ request('categoria') == 'oferta' ? 'active' : '' }}">
            <i class="bi bi-tag"></i> Ofertas
        </a>
    </div>

    @if($productos->count() > 0)

        <div class="products-grid">
            @foreach($productos as $producto)

                <div class="product-card product-card-pro">
                    <div class="product-image">
                        <span class="discount-label">Nuevo</span>

                        @if($producto->imagen)
                            <img src="{{ asset('storage/' . $producto->imagen) }}" alt="{{ $producto->nombre }}">
                        @else
                            <div class="no-image">Sin imagen</div>
                        @endif

                        <button class="favorite-btn" type="button">
                            <i class="bi bi-heart"></i>
                        </button>
                    </div>

                    <div class="product-info">
                        <span class="category">Sneakers</span>

                        <h3>{{ $producto->nombre }}</h3>

                        <div class="product-type">Deportivo</div>

                        <div class="product-details">
                            <strong>$ {{ number_format($producto->precio, 0, ',', '.') }}</strong>

                            @if($producto->stock > 0)
                                <span>Stock: {{ $producto->stock }}</span>
                            @else
                                <span class="text-danger">Agotado</span>
                            @endif
                        </div>

                        <div class="product-actions">
                            <a href="{{ route('producto.show', $producto->id) }}" class="btn-ver">
                                <i class="bi bi-eye"></i> Ver producto
                            </a>

                            @if($producto->stock > 0)
                                <form action="{{ route('carrito.agregar', $producto->id) }}" method="POST">
                                    @csrf
                                    <button type="submit" class="btn-carrito">
                                        <i class="bi bi-cart3"></i>
                                    </button>
                                </form>
                            @else
                                <button type="button" class="btn-carrito disabled" disabled>
                                    <i class="bi bi-x-circle"></i>
                                </button>
                            @endif
                        </div>
                    </div>
                </div>

            @endforeach
        </div>

    @else
        <div class="empty-catalog">
            <h3>No encontramos productos</h3>
            <p>Intenta buscar con otro nombre o vuelve al catálogo completo.</p>
            <a href="{{ route('catalogo') }}">Ver todos</a>
        </div>
    @endif

    <section id="novedades" class="novedades-section">
        <div>
            <span class="tag-orange">Lanzamientos</span>
            <h2>Novedades UrbanShoes</h2>
            <p>Descubre nuestros últimos lanzamientos, promociones y modelos destacados.</p>
        </div>

        <div class="novedades-grid">
            <div class="novedad-card">
                <i class="bi bi-stars"></i>
                <h3>Nuevos modelos</h3>
                <p>Tenis deportivos y urbanos para todos los estilos.</p>
            </div>

            <div class="novedad-card">
                <i class="bi bi-tag"></i>
                <h3>Promociones</h3>
                <p>Ofertas especiales disponibles por tiempo limitado.</p>
            </div>

            <div class="novedad-card">
                <i class="bi bi-truck"></i>
                <h3>Envíos rápidos</h3>
                <p>Entregas ágiles y seguras a nivel nacional.</p>
            </div>
        </div>
    </section>

    <section id="contacto" class="contacto-section">
        <div>
            <span class="tag-orange">Estamos para ayudarte</span>
            <h2>Contáctanos</h2>
            <p>Comunícate con UrbanShoes para resolver dudas sobre productos, compras o envíos.</p>
        </div>

        <div class="contacto-grid">
            <div class="contacto-card">
                <i class="bi bi-whatsapp"></i>
                <strong>WhatsApp</strong>
                <span>311 718 2375</span>
            </div>

            <div class="contacto-card">
                <i class="bi bi-envelope"></i>
                <strong>Email</strong>
                <span>ventas@urbanshoes.com</span>
            </div>

            <div class="contacto-card">
                <i class="bi bi-geo-alt"></i>
                <strong>Ubicación</strong>
                <span>Bogotá, Colombia</span>
            </div>
        </div>
    </section>

</main>

</body>
</html>