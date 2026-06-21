<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>UrbanShoes Admin</title>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="{{ asset('css/admin.css') }}?v={{ time() }}">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.css">
</head>

<body>

<div class="sidebar">
    <h2>Urban<span>Shoes</span></h2>
    <hr>

    <a href="{{ route('admin.productos') }}" class="active">📦 Productos</a>
    <a href="{{ route('productos.create') }}">➕ Nuevo producto</a>
    <a href="{{ route('catalogo') }}">🛒 Ver tienda</a>
    <a href="{{ route('admin.pedidos') }}">🧾 Pedidos</a>
    <a href="{{ route('admin.clientes') }}">👥 Clientes</a>
</form>

</div>

<div class="content">

   <div class="admin-header">
    <div>
        <h1>Dashboard de Productos</h1>
        <p>Administra el catálogo, inventario y precios de tu tienda.</p>
    </div>

    <div class="admin-user-box">
        <div class="admin-avatar">
            {{ strtoupper(substr(auth()->user()->name, 0, 1)) }}
        </div>

        <div>
            <strong>{{ auth()->user()->name }}</strong>
            <span>Administrador</span>
        </div>

        <form method="POST" action="{{ route('logout') }}">
            @csrf
            <button type="submit" class="btn-logout-small">
                Salir
            </button>
        </form>
    </div>
</div>

    <div class="stats-grid">

        <div class="card-stat">
            <div class="stat-icon purple"><i class="bi bi-box-seam"></i></div>
            <div>
                <h5>Total Productos</h5>
                <h2>{{ $totalProductos }}</h2>
            </div>
        </div>

        <div class="card-stat">
            <div class="stat-icon green"><i class="bi bi-bag-check"></i></div>
            <div>
                <h5>Inventario</h5>
                <h2>{{ $inventarioTotal }}</h2>
            </div>
        </div>

        <div class="card-stat">
            <div class="stat-icon yellow"><i class="bi bi-cash-coin"></i></div>
            <div>
                <h5>Valor Inventario</h5>
                <h2>$ {{ number_format($valorInventario, 0, ',', '.') }}</h2>
            </div>
        </div>

        <div class="card-stat">
            <div class="stat-icon red"><i class="bi bi-exclamation-triangle"></i></div>
            <div>
                <h5>Stock Bajo</h5>
                <h2 class="stock-warning">{{ $stockBajo }}</h2>
            </div>
        </div>

        <div class="card-stat">
            <div class="stat-icon blue"><i class="bi bi-clipboard-check"></i></div>
            <div>
                <h5>Total Pedidos</h5>
                <h2>{{ $totalPedidos }}</h2>
            </div>
        </div>

        <div class="card-stat">
            <div class="stat-icon green"><i class="bi bi-graph-up-arrow"></i></div>
            <div>
                <h5>Ventas Totales</h5>
                <h2>$ {{ number_format($ventasTotales, 0, ',', '.') }}</h2>
            </div>
        </div>

        <div class="card-stat">
            <div class="stat-icon orange"><i class="bi bi-clock"></i></div>
            <div>
                <h5>Pedidos Pendientes</h5>
                <h2>{{ $pedidosPendientes }}</h2>
            </div>
        </div>

        <div class="card-stat">
            <div class="stat-icon purple"><i class="bi bi-trophy"></i></div>
            <div>
                <h5>Producto más vendido</h5>
                <h2 class="small-title">{{ $productoMasVendido->nombre_producto ?? 'Sin ventas' }}</h2>
            </div>
        </div>

    </div>

    <div class="charts-grid">

        <div class="chart-card">
            <div class="chart-header">
                <h3>Pedidos por estado</h3>
                <span>Resumen de órdenes</span>
            </div>

            <div class="chart-box chart-donut">
                <canvas id="estadoChart"></canvas>
            </div>
        </div>

        <div class="chart-card">
            <div class="chart-header">
                <h3>Productos más vendidos</h3>
                <span>Top unidades vendidas</span>
            </div>

            <div class="chart-box chart-bar">
                <canvas id="productosChart"></canvas>
            </div>
        </div>

    </div>

    <div class="table-container">
        <h3>Productos registrados</h3>

        <table class="table align-middle mt-3">
            <thead>
                <tr>
                    <th>Imagen</th>
                    <th>Producto</th>
                    <th>Precio</th>
                    <th>Stock</th>
                    <th>Acciones</th>
                </tr>
            </thead>

            <tbody>
                @foreach($productos as $producto)
                    <tr>
                        <td>
                            @if($producto->imagen)
                                <img src="{{ asset('storage/'.$producto->imagen) }}" class="product-img">
                            @endif
                        </td>

                        <td>{{ $producto->nombre }}</td>
                        <td>$ {{ number_format($producto->precio,0,',','.') }}</td>

                        <td>
                            @if($producto->stock < 5)
                                <span class="badge bg-danger">{{ $producto->stock }}</span>
                            @else
                                <span class="badge bg-success">{{ $producto->stock }}</span>
                            @endif
                        </td>

                        <td>
                            <div class="action-buttons">
                                <a href="{{ route('productos.edit', $producto->id) }}" class="btn btn-warning btn-sm">
                                    Editar
                                </a>

                                <form action="{{ route('productos.destroy',$producto->id) }}" method="POST">
                                    @csrf
                                    @method('DELETE')

                                    <button class="btn btn-danger btn-sm" onclick="return confirm('¿Eliminar producto?')">
                                        Eliminar
                                    </button>
                                </form>
                            </div>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>

        <div class="table-footer">
            Mostrando {{ $productos->count() }} producto(s)
        </div>
    </div>

    <footer class="admin-footer">
        © 2025 UrbanShoes. Todos los derechos reservados.
    </footer>

</div>

<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>

<script>
    const estadoLabels = @json($ventasPorEstado->pluck('estado'));
    const estadoData = @json($ventasPorEstado->pluck('total'));

    new Chart(document.getElementById('estadoChart'), {
        type: 'doughnut',
        data: {
            labels: estadoLabels,
            datasets: [{
                data: estadoData,
                borderWidth: 3
            }]
        },
        options: {
            responsive: true,
            maintainAspectRatio: false,
            cutout: '68%',
            plugins: {
                legend: {
                    position: 'right'
                }
            }
        }
    });

    const productoLabels = @json($productosMasVendidos->pluck('nombre_producto'));
    const productoData = @json($productosMasVendidos->pluck('total'));

    new Chart(document.getElementById('productosChart'), {
        type: 'bar',
        data: {
            labels: productoLabels,
            datasets: [{
                label: 'Unidades vendidas',
                data: productoData,
                borderRadius: 12,
                barThickness: 35
            }]
        },
        options: {
            indexAxis: 'y',
            responsive: true,
            maintainAspectRatio: false,
            plugins: {
                legend: {
                    display: true
                }
            },
            scales: {
                x: {
                    beginAtZero: true
                }
            }
        }
    });
</script>

</body>
</html>