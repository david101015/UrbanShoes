<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Pedidos | UrbanShoes</title>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="{{ asset('css/admin.css') }}?v={{ time() }}">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.css">
</head>

<body>

<div class="sidebar">
    <h2>Urban<span>Shoes</span></h2>
    <hr>

    <a href="{{ route('admin.productos') }}">📦 Productos</a>
    <a href="{{ route('productos.create') }}">➕ Nuevo producto</a>
    <a href="{{ route('catalogo') }}">🛒 Ver tienda</a>
    <a href="{{ route('admin.pedidos') }}">🧾 Pedidos</a>
    <a href="{{ route('admin.clientes') }}">👥 Clientes</a>
</div>

<div class="content">

    <div class="admin-header">
        <div>
            <h1>Panel de Pedidos</h1>
            <p>Consulta las compras realizadas por los clientes.</p>
        </div>
    </div>

    <div class="stats-grid">
        <div class="card-stat">
            <div class="stat-icon blue"><i class="bi bi-clipboard-check"></i></div>
            <div>
                <h5>Total Pedidos</h5>
                <h2>{{ $totalPedidos }}</h2>
            </div>
        </div>

        <div class="card-stat">
            <div class="stat-icon green"><i class="bi bi-cash-coin"></i></div>
            <div>
                <h5>Ventas Totales</h5>
                <h2>$ {{ number_format($ventasTotales, 0, ',', '.') }}</h2>
            </div>
        </div>

        <div class="card-stat">
            <div class="stat-icon orange"><i class="bi bi-clock"></i></div>
            <div>
                <h5>Pendientes</h5>
                <h2>{{ $pedidosPendientes }}</h2>
            </div>
        </div>

        <div class="card-stat">
            <div class="stat-icon purple"><i class="bi bi-check-circle"></i></div>
            <div>
                <h5>Entregados</h5>
                <h2>{{ $pedidosEntregados }}</h2>
            </div>
        </div>
    </div>

    <div class="table-container">
        <h3>Pedidos registrados</h3>

        <table class="table align-middle mt-3">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Cliente</th>
                    <th>Correo</th>
                    <th>Teléfono</th>
                    <th>Pago</th>
                    <th>Total</th>
                    <th>Estado</th>
                    <th>Fecha</th>
                    <th>Factura</th>
                </tr>
            </thead>

            <tbody>
                @foreach($pedidos as $pedido)
                    <tr>
                        <td>#{{ $pedido->id }}</td>
                        <td>{{ $pedido->nombre }}</td>
                        <td>{{ $pedido->correo }}</td>
                        <td>{{ $pedido->telefono }}</td>
                        <td>{{ $pedido->metodo_pago }}</td>
                        <td>$ {{ number_format($pedido->total, 0, ',', '.') }}</td>

                        <td>
                            <form action="{{ route('pedidos.estado', $pedido->id) }}" method="POST">
                                @csrf
                                @method('PATCH')

                                <select name="estado" onchange="this.form.submit()" class="form-select form-select-sm">
                                    <option value="Pendiente" {{ $pedido->estado == 'Pendiente' ? 'selected' : '' }}>Pendiente</option>
                                    <option value="Pagado" {{ $pedido->estado == 'Pagado' ? 'selected' : '' }}>Pagado</option>
                                    <option value="Preparando" {{ $pedido->estado == 'Preparando' ? 'selected' : '' }}>Preparando</option>
                                    <option value="Enviado" {{ $pedido->estado == 'Enviado' ? 'selected' : '' }}>Enviado</option>
                                    <option value="Entregado" {{ $pedido->estado == 'Entregado' ? 'selected' : '' }}>Entregado</option>
                                    <option value="Cancelado" {{ $pedido->estado == 'Cancelado' ? 'selected' : '' }}>Cancelado</option>
                                </select>
                            </form>
                        </td>

                        <td>{{ $pedido->created_at->format('d/m/Y') }}</td>

                        <td>
                            <a href="{{ route('pedidos.factura', $pedido->id) }}" class="btn btn-primary btn-sm">
                                Ver factura
                            </a>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>

</div>

</body>
</html>