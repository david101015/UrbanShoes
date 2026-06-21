<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Clientes | UrbanShoes</title>

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
    <a href="{{ route('admin.pedidos') }}">🧾 Pedidos</a>
    <a href="{{ route('admin.clientes') }}" class="active">👥 Clientes</a>
    <a href="{{ route('catalogo') }}">🛒 Ver tienda</a>
</div>

<div class="content">

    <div class="admin-header">
        <div>
            <h1>Clientes</h1>
            <p>Consulta los clientes que han realizado compras en UrbanShoes.</p>
        </div>

        <div class="date-pill">
            <i class="bi bi-calendar3"></i>
            {{ now()->format('d/m/Y') }}
        </div>
    </div>

    <div class="stats-grid">
        <div class="card-stat">
            <div class="stat-icon purple"><i class="bi bi-people"></i></div>
            <div>
                <h5>Total Clientes</h5>
                <h2>{{ $totalClientes }}</h2>
            </div>
        </div>

        <div class="card-stat">
            <div class="stat-icon blue"><i class="bi bi-receipt"></i></div>
            <div>
                <h5>Total Pedidos</h5>
                <h2>{{ $totalPedidosClientes }}</h2>
            </div>
        </div>

        <div class="card-stat">
            <div class="stat-icon green"><i class="bi bi-cash-coin"></i></div>
            <div>
                <h5>Total Compras</h5>
                <h2>$ {{ number_format($totalComprasClientes, 0, ',', '.') }}</h2>
            </div>
        </div>

        <div class="card-stat">
            <div class="stat-icon yellow"><i class="bi bi-trophy"></i></div>
            <div>
                <h5>Mejor Cliente</h5>
                <h2 class="small-title">{{ $mejorCliente->nombre ?? 'Sin clientes' }}</h2>
            </div>
        </div>
    </div>

    <div class="table-container">
        <h3>Clientes registrados</h3>

        <table class="table align-middle mt-3">
            <thead>
                <tr>
                    <th>Cliente</th>
                    <th>Correo</th>
                    <th>Teléfono</th>
                    <th>Pedidos</th>
                    <th>Total compras</th>
                </tr>
            </thead>

            <tbody>
                @foreach($clientes as $cliente)
                    <tr>
                        <td>
                            <strong>{{ $cliente->nombre }}</strong>
                        </td>
                        <td>{{ $cliente->correo }}</td>
                        <td>{{ $cliente->telefono }}</td>
                        <td>
                            <span class="badge bg-primary">{{ $cliente->total_pedidos }}</span>
                        </td>
                        <td>
                            <strong>$ {{ number_format($cliente->total_compras, 0, ',', '.') }}</strong>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>

        <div class="table-footer">
            Mostrando {{ $clientes->count() }} cliente(s)
        </div>
    </div>

    <footer class="admin-footer">
        © 2025 UrbanShoes. Todos los derechos reservados.
    </footer>

</div>

</body>
</html>