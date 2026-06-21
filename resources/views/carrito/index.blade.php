<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Carrito de compras | UrbanShoes</title>

    <link rel="stylesheet" href="{{ asset('css/estilos.css') }}?v={{ time() }}">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.css">
</head>
<body>

<nav class="navbar-ecommerce">
    <div class="nav-content">
        <a href="{{ route('inicio') }}" class="logo">👟 Urban<span>Shoes</span></a>

        <div class="nav-links">
            <a href="{{ route('inicio') }}">Inicio</a>
            <a href="{{ route('catalogo') }}">Catálogo</a>
            <a href="{{ route('carrito') }}" class="active">Carrito</a>
        </div>
    </div>
</nav>

<main class="cart-page">

    <div class="cart-title">
        <span>COMPRA SEGURA</span>
        <h1>Tu carrito de compras <i class="bi bi-cart3"></i></h1>
        <p>Revisa tus productos antes de finalizar la compra.</p>
    </div>

    @php $total = 0; @endphp

    @if(count($carrito) > 0)

        <div class="carrito-layout">

            <section class="cart-items">
                @foreach($carrito as $item)

                    @php
                        $subtotal = $item['precio'] * $item['cantidad'];
                        $total += $subtotal;
                    @endphp

                    <article class="item-carrito">
                        <div class="item-img">
                            @if($item['imagen'])
                                <img src="{{ asset('storage/' . $item['imagen']) }}" alt="{{ $item['nombre'] }}">
                            @else
                                <span>Sin imagen</span>
                            @endif
                        </div>

                        <div class="item-info">
                            <div class="item-top">
                                <div>
                                    <span class="item-category">Sneakers</span>
                                    <h2>{{ $item['nombre'] }}</h2>
                                </div>

                                <form action="{{ route('carrito.eliminar', $item['id']) }}" method="POST">
                                    @csrf
                                    @method('DELETE')
                                    <button class="btn-remove-icon" title="Eliminar producto">
                                        <i class="bi bi-trash"></i>
                                    </button>
                                </form>
                            </div>

                            <div class="item-meta">
                                <span>Precio unitario</span>
                                <strong>$ {{ number_format($item['precio'], 0, ',', '.') }}</strong>
                            </div>

                            <div class="cart-item-bottom">
                                <div class="cantidad-box">
                                    <form action="{{ route('carrito.disminuir', $item['id']) }}" method="POST">
                                        @csrf
                                        <button type="submit">−</button>
                                    </form>

                                    <span>{{ $item['cantidad'] }}</span>

                                    <form action="{{ route('carrito.aumentar', $item['id']) }}" method="POST">
                                        @csrf
                                        <button type="submit">+</button>
                                    </form>
                                </div>

                                <div class="subtotal-box">
                                    <span>Subtotal</span>
                                    <strong>$ {{ number_format($subtotal, 0, ',', '.') }}</strong>
                                </div>
                            </div>
                        </div>
                    </article>

                @endforeach
            </section>

            <aside class="resumen-carrito">
                <h2>Resumen de compra</h2>

                <div class="resumen-linea">
                    <span>Productos diferentes</span>
                    <strong>{{ count($carrito) }}</strong>
                </div>

                <div class="resumen-linea">
                    <span>Envío</span>
                    <strong class="gratis">Gratis</strong>
                </div>

                <div class="resumen-linea">
                    <span>Impuestos</span>
                    <strong>Incluidos</strong>
                </div>

                <div class="total">
                    <span>Total a pagar</span>
                    <strong>$ {{ number_format($total, 0, ',', '.') }}</strong>
                </div>

                <a href="{{ route('checkout') }}" class="btn-finalizar">
                    Finalizar compra <i class="bi bi-arrow-right"></i>
                </a>

                <a href="{{ route('catalogo') }}" class="btn-seguir">
                    Seguir comprando
                </a>

                <form action="{{ route('carrito.vaciar') }}" method="POST">
                    @csrf
                    @method('DELETE')
                    <button class="btn-vaciar">
                        Vaciar carrito
                    </button>
                </form>
            </aside>

        </div>

    @else

        <div class="empty-cart">
            <i class="bi bi-cart-x"></i>
            <h2>Tu carrito está vacío</h2>
            <p>Agrega productos para iniciar tu compra.</p>
            <a href="{{ route('catalogo') }}" class="btn-main">Ver catálogo</a>
        </div>

    @endif

</main>

</body>
</html>