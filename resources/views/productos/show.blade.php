<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>{{ $producto->nombre }} | UrbanShoes</title>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="{{ asset('css/estilos.css') }}?v={{ time() }}">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.css">
</head>

<body>

<nav class="product-navbar">
    <a href="{{ route('inicio') }}" class="logo">Urban<span>Shoes</span></a>

    <div class="product-nav-links">
        <a href="{{ route('inicio') }}">Inicio</a>
        <a href="{{ route('catalogo') }}">Catálogo</a>
        <a href="{{ route('carrito') }}">Carrito 🛒</a>
    </div>
</nav>

<main class="product-page">

    <div class="breadcrumb-product">
        <a href="{{ route('inicio') }}">Inicio</a>
        <span>›</span>
        <a href="{{ route('catalogo') }}">Catálogo</a>
        <span>›</span>
        <strong>{{ $producto->nombre }}</strong>
    </div>

    <section class="product-detail-layout">

        <div class="product-gallery">
            <div class="main-product-image">
                @if($producto->imagen)
                    <img src="{{ asset('storage/'.$producto->imagen) }}" alt="{{ $producto->nombre }}">
                @else
                    <div class="no-image">Sin imagen</div>
                @endif
            </div>
        </div>

        <div class="product-detail-info">

            <span class="product-category">Running</span>

            <h1>{{ $producto->nombre }}</h1>

            <div class="rating">
                ★★★★★ <span>4.6 (128 reseñas)</span>
            </div>

            <h2 class="product-price">
                $ {{ number_format($producto->precio, 0, ',', '.') }}
            </h2>

            <div class="product-tags">
                <span>✓ Original</span>
                <span>✓ Garantía</span>
                <span>✓ Envío nacional</span>
            </div>

            <p class="free-shipping">
                <i class="bi bi-truck"></i>
                Envío gratis en pedidos superiores a $200.000
            </p>

            <p class="product-description">
                {{ $producto->descripcion }}
            </p>

            <hr>

            <div class="option-block">
                <div class="option-title">
                    <strong>1. Selecciona tu talla</strong>
                    <span><i class="bi bi-rulers"></i> Guía de tallas</span>
                </div>

                <div class="size-options">
                    @foreach(explode(',', $producto->talla ?? '38,39,40,41,42') as $talla)
                        <button type="button">{{ trim($talla) }}</button>
                    @endforeach
                </div>
            </div>

            @php
    $colorTexto = strtolower(trim($producto->color ?? 'negro'));

    $colores = [
        'negro' => '#111827',
        'blanco' => '#ffffff',
        'rosado' => '#f9a8d4',
        'rosa' => '#f9a8d4',
        'azul' => '#2563eb',
        'rojo' => '#dc2626',
        'gris' => '#9ca3af',
        'verde' => '#16a34a',
        'amarillo' => '#facc15',
        'morado' => '#7c3aed',
        'naranja' => '#f97316',
        'beige' => '#d6b98c',
        'cafe' => '#7c3f1d',
        'café' => '#7c3f1d',
        'marron' => '#7c3f1d',
        'marrón' => '#7c3f1d',
        'vinotinto' => '#6b1026',
        'dorado' => '#d4af37',
        'plateado' => '#c0c0c0',
    ];

    $hexColor = $colores[$colorTexto] ?? '#111827';
@endphp

<div class="option-block">
    <strong>2. Color disponible</strong>

    <div class="color-options">
        <span class="color-dot"
              style="background: {{ $hexColor }};"></span>

        <span class="color-name">
            {{ ucfirst($producto->color ?? 'Color único') }}
        </span>
    </div>
</div>

            @if($producto->stock > 0)
                <div class="stock-alert">
                    <i class="bi bi-check-circle"></i>
                    Stock disponible: {{ $producto->stock }} unidades
                </div>

                <form action="{{ route('carrito.agregar', $producto->id) }}" method="POST">
                    @csrf

                    <div class="quantity-selector">
                        <button type="button" id="menos">−</button>

                        <input 
                            type="number" 
                            id="cantidad" 
                            name="cantidad" 
                            value="1" 
                            min="1" 
                            max="{{ $producto->stock }}"
                        >

                        <button type="button" id="mas">+</button>
                    </div>

                    <button type="submit" class="btn-add-cart">
                        <i class="bi bi-bag"></i>
                        Agregar al carrito
                    </button>
                </form>
            @else
                <div class="stock-alert danger">
                    <i class="bi bi-x-circle"></i>
                    Producto agotado
                </div>
            @endif

            <a href="{{ route('catalogo') }}" class="btn-back-catalog">
                Volver al catálogo
            </a>

        </div>

    </section>

    <section class="related-products">
    <div class="related-header">
        <h2>También te puede interesar</h2>
        <p>Explora otros modelos disponibles en UrbanShoes.</p>
    </div>

    <div class="related-grid">
        @foreach($relacionados as $item)
            <div class="related-card">
                <div class="related-img">
                    @if($item->imagen)
                        <img src="{{ asset('storage/'.$item->imagen) }}" alt="{{ $item->nombre }}">
                    @else
                        <span>Sin imagen</span>
                    @endif
                </div>

                <h3>{{ $item->nombre }}</h3>

                <p>$ {{ number_format($item->precio, 0, ',', '.') }}</p>

                <a href="{{ route('producto.show', $item->id) }}">
                    Ver producto
                </a>
            </div>
        @endforeach
    </div>
</section>

    <section class="product-benefits">
        <div>
            <i class="bi bi-shield-check"></i>
            <strong>Compra segura</strong>
            <span>Tus datos protegidos</span>
        </div>

        <div>
            <i class="bi bi-truck"></i>
            <strong>Envíos rápidos</strong>
            <span>A todo el país</span>
        </div>

        <div>
            <i class="bi bi-arrow-clockwise"></i>
            <strong>Devoluciones fáciles</strong>
            <span>Hasta 30 días</span>
        </div>

        <div>
            <i class="bi bi-headset"></i>
            <strong>Atención al cliente</strong>
            <span>Estamos para ayudarte</span>
        </div>
    </section>

</main>

<script>
    document.querySelectorAll('.size-options button').forEach(btn => {
        btn.addEventListener('click', function () {
            document.querySelectorAll('.size-options button')
                .forEach(b => b.classList.remove('active'));

            this.classList.add('active');
        });
    });

    const cantidad = document.getElementById('cantidad');
    const mas = document.getElementById('mas');
    const menos = document.getElementById('menos');

    if (cantidad && mas && menos) {
        mas.addEventListener('click', () => {
            let valor = parseInt(cantidad.value);
            let max = parseInt(cantidad.max);

            if (valor < max) {
                cantidad.value = valor + 1;
            }
        });

        menos.addEventListener('click', () => {
            let valor = parseInt(cantidad.value);

            if (valor > 1) {
                cantidad.value = valor - 1;
            }
        });
    }
</script>

</body>
</html>