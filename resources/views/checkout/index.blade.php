<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Finalizar compra | UrbanShoes</title>

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
            <a href="{{ route('carrito') }}">Carrito 🛒</a>
        </div>
    </div>
</nav>

@php
    $carrito = session('carrito', []);
    $total = 0;

    foreach ($carrito as $item) {
        $total += $item['precio'] * $item['cantidad'];
    }
@endphp

<main class="checkout-page checkout-page-pro">

    <section class="checkout-layout">

        <div class="checkout-card">

            <div class="checkout-header">
                <span class="form-tag">COMPRA SEGURA</span>
                <h1>Finalizar compra</h1>
                <p>Completa tus datos para generar el pedido.</p>
            </div>

            <form action="{{ route('pedido.store') }}" method="POST" class="checkout-form">
                @csrf

                <div class="form-group">
                    <label>
                        <i class="bi bi-person"></i>
                        Nombre completo
                    </label>
                    <input type="text"
                           name="nombre"
                           placeholder="Ej: Juan Pérez"
                           required>
                </div>

                <div class="form-group">
                    <label>
                        <i class="bi bi-envelope"></i>
                        Correo electrónico
                    </label>
                    <input type="email"
                           name="correo"
                           placeholder="Ej: correo@gmail.com"
                           required>
                </div>

                <div class="form-group">
                    <label>
                        <i class="bi bi-phone"></i>
                        Teléfono
                    </label>
                    <input type="text"
                           name="telefono"
                           placeholder="Ej: 3117451022"
                           required>
                </div>

                <div class="form-group">
                    <label>
                        <i class="bi bi-geo-alt"></i>
                        Dirección
                    </label>
                    <input type="text"
                           name="direccion"
                           placeholder="Ej: Calle 59 sur #60-19"
                           required>
                </div>

                <div class="form-group">
                    <label>
                        <i class="bi bi-credit-card"></i>
                        Método de pago
                    </label>

                    <select name="metodo_pago" id="metodo_pago" required>
                        <option value="" selected disabled>
                            Selecciona una opción
                        </option>

                        <option value="Contra entrega">
                            Contra entrega
                        </option>

                        <option value="Transferencia por llave">
                            Transferencia por llave
                        </option>

                        <option value="Tarjeta crédito/débito">
                            Tarjeta crédito/débito
                        </option>
                    </select>
                </div>

                <div id="payment-info" class="payment-info">

                    <div id="info-contra" class="payment-box d-none">
                        <h4>
                            <i class="bi bi-cash-coin"></i>
                            Pago contra entrega
                        </h4>

                        <p>
                            Pagarás tu pedido cuando lo recibas en la dirección registrada.
                        </p>
                    </div>

                    <div id="info-transferencia" class="payment-box d-none">
                        <h4>
                            <i class="bi bi-phone"></i>
                            Transferencia por llave
                        </h4>

                        <p>
                            Realiza tu transferencia utilizando esta llave:
                        </p>

                        <div class="llave-box">
                            <strong id="llave">
                                3117182375
                            </strong>
                        </div>

                        <button type="button"
                                class="btn-copy-key"
                                onclick="copiarLlave()">

                            <i class="bi bi-clipboard"></i>
                            Copiar llave
                        </button>

                        <p class="payment-note">
                            Compatible con Nequi, Daviplata,
                            Bancolombia y entidades adheridas a Bre-B.
                        </p>
                    </div>

                    <div id="info-tarjeta" class="payment-box d-none">
                        <h4>
                            <i class="bi bi-credit-card"></i>
                            Tarjeta crédito/débito
                        </h4>

                        <p>
                            Seleccionaste pago con tarjeta.
                            El pedido quedará registrado y el equipo
                            de UrbanShoes se comunicará contigo para
                            coordinar el pago.
                        </p>

                        <p class="payment-note">
                            No ingreses datos bancarios en esta página.
                        </p>
                    </div>

                </div>

                <button type="submit" class="btn-checkout-confirm">
                    Confirmar pedido
                    <i class="bi bi-check-circle"></i>
                </button>

            </form>

        </div>

        <aside class="checkout-summary">

            <h2>Resumen del pedido</h2>

            @forelse($carrito as $item)

                <div class="summary-product">

                    <div class="summary-img">
                        @if($item['imagen'])
                            <img src="{{ asset('storage/' . $item['imagen']) }}"
                                 alt="{{ $item['nombre'] }}">
                        @else
                            <span>Sin imagen</span>
                        @endif
                    </div>

                    <div>
                        <strong>{{ $item['nombre'] }}</strong>
                        <span>Cantidad: {{ $item['cantidad'] }}</span>

                        <p>
                            $ {{ number_format($item['precio'] * $item['cantidad'], 0, ',', '.') }}
                        </p>
                    </div>

                </div>

            @empty

                <p class="summary-empty">
                    No hay productos en el carrito.
                </p>

            @endforelse

            <div class="summary-lines">

                <div>
                    <span>Productos</span>
                    <strong>{{ count($carrito) }}</strong>
                </div>

                <div>
                    <span>Envío</span>
                    <strong class="free">Gratis</strong>
                </div>

                <div>
                    <span>Pago seguro</span>
                    <strong>Protegido</strong>
                </div>

            </div>

            <div class="summary-total">
                <span>Total a pagar</span>

                <strong>
                    $ {{ number_format($total, 0, ',', '.') }}
                </strong>
            </div>

            <div class="checkout-security">
                <span>
                    <i class="bi bi-shield-check"></i>
                    Compra protegida
                </span>

                <span>
                    <i class="bi bi-truck"></i>
                    Envío nacional
                </span>

                <span>
                    <i class="bi bi-lock"></i>
                    Datos seguros
                </span>
            </div>

            <a href="{{ route('carrito') }}"
               class="btn-return-cart">
                Volver al carrito
            </a>

        </aside>

    </section>

</main>

<script>
document.addEventListener('DOMContentLoaded', function() {

    const metodoPago = document.getElementById('metodo_pago');

    const contra = document.getElementById('info-contra');
    const transferencia = document.getElementById('info-transferencia');
    const tarjeta = document.getElementById('info-tarjeta');

    metodoPago.addEventListener('change', function() {

        contra.classList.add('d-none');
        transferencia.classList.add('d-none');
        tarjeta.classList.add('d-none');

        if (this.value === 'Contra entrega') {
            contra.classList.remove('d-none');
        }

        if (this.value === 'Transferencia por llave') {
            transferencia.classList.remove('d-none');
        }

        if (this.value === 'Tarjeta crédito/débito') {
            tarjeta.classList.remove('d-none');
        }
    });

});

function copiarLlave() {
    navigator.clipboard.writeText('3117182375');
    alert('Llave copiada correctamente');
}
</script>

</body>
</html>