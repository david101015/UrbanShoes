<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Editar producto | Urban Shoes</title>

    <link rel="stylesheet" href="{{ asset('css/admin.css') }}?v={{ time() }}">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.css">
</head>

<body>

<aside class="sidebar">
    <h2>Urban<span>Shoes</span></h2>

        <a href="{{ route('admin.productos') }}" class="active">📦 Productos</a>
    <a href="{{ route('productos.create') }}">➕ Nuevo producto</a>
    <a href="{{ route('catalogo') }}">🛒 Ver tienda</a>
    <a href="{{ route('admin.pedidos') }}">🧾 Pedidos</a>
    <a href="{{ route('admin.clientes') }}">👥 Clientes</a>
</aside>

<main class="content">

    <div class="admin-header">
        <div>
            <h1>Editar producto</h1>
            <p>Actualiza la información del producto seleccionado.</p>
        </div>

        <a href="{{ route('admin.productos') }}" class="btn-admin-primary">
            ← Volver al dashboard
        </a>
    </div>

    <section class="edit-product-layout">

        <div class="form-card-admin edit-card">

            <div class="form-section-title">
                <div class="stat-icon orange">
                    <i class="bi bi-pencil-square"></i>
                </div>

                <div>
                    <h3>Información del producto</h3>
                    <p>Edita los datos principales del calzado.</p>
                </div>
            </div>

            <form action="{{ route('productos.update', $producto->id) }}" method="POST" enctype="multipart/form-data" class="edit-product-form">
                @csrf
                @method('PUT')

                <div class="form-field full">
                    <label>Nombre del producto</label>
                    <input type="text" name="nombre" value="{{ old('nombre', $producto->nombre) }}" required>
                </div>

                <div class="form-field full">
                    <label>Descripción</label>
                    <textarea name="descripcion" rows="5" required>{{ old('descripcion', $producto->descripcion) }}</textarea>
                </div>

                <div class="form-field">
                    <label>Precio</label>
                    <input type="number" name="precio" value="{{ old('precio', $producto->precio) }}" required>
                </div>

                <div class="form-field">
                    <label>Stock</label>
                    <input type="number" name="stock" value="{{ old('stock', $producto->stock) }}" required>
                </div>

                <div class="form-field">
                    <label>Talla</label>
                    <input type="text" name="talla" value="{{ old('talla', $producto->talla) }}">
                </div>

                <div class="form-field">
                    <label>Color</label>
                    <input type="text" name="color" value="{{ old('color', $producto->color) }}">
                </div>

                <div class="form-field full">
                    <label>Cambiar imagen</label>
                    <input type="file" name="imagen" accept="image/*">
                </div>

                <div class="form-actions full">
                    <button type="submit" class="btn-save">
                        <i class="bi bi-save"></i> Actualizar producto
                    </button>

                    <a href="{{ route('admin.productos') }}" class="btn-cancel">
                        Cancelar
                    </a>
                </div>
            </form>

        </div>

        <div class="preview-card-admin edit-preview">
            <div class="preview-icon">
                <i class="bi bi-image"></i>
            </div>

            <h3>Vista actual</h3>

            @if($producto->imagen)
                <div class="mini-product-preview">
                    <div class="mini-img">
                        <img src="{{ asset('storage/' . $producto->imagen) }}" alt="{{ $producto->nombre }}">
                    </div>

                    <div>
                        <span>Producto actual</span>
                        <h4>{{ $producto->nombre }}</h4>
                        <p>$ {{ number_format($producto->precio, 0, ',', '.') }}</p>
                        <p>Stock: {{ $producto->stock }}</p>
                    </div>
                </div>
            @else
                <p>Este producto no tiene imagen registrada.</p>
            @endif

            <ul>
                <li>Verifica que el precio esté correcto.</li>
                <li>Actualiza el stock disponible.</li>
                <li>Sube una imagen clara del producto.</li>
            </ul>
        </div>

    </section>

</main>

</body>
</html>