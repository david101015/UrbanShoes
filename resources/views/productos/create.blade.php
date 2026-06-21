<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Agregar producto | UrbanShoes</title>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="{{ asset('css/admin.css') }}?v={{ time() }}">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.css">
</head>

<body>

<div class="sidebar">
    <h2>Urban<span>Shoes</span></h2>
    <hr>

    <a href="{{ route('admin.productos') }}">📦 Productos</a>
    <a href="{{ route('productos.create') }}" class="active">➕ Nuevo producto</a>
    <a href="{{ route('admin.pedidos') }}">🧾 Pedidos</a>
    <a href="{{ route('admin.clientes') }}">👥 Clientes</a>
    <a href="{{ route('catalogo') }}">🛒 Ver tienda</a>
</div>

<div class="content">

    <div class="admin-header">
        <div>
            <h1>Agregar producto</h1>
            <p>Registra un nuevo zapato para publicarlo en el catálogo.</p>
        </div>

        <a href="{{ route('admin.productos') }}" class="btn-admin-primary">
            Volver al dashboard
        </a>
    </div>

    <div class="product-form-layout">

        <div class="form-card-admin">
            <div class="form-section-title">
                <div class="stat-icon purple">
                    <i class="bi bi-box-seam"></i>
                </div>
                <div>
                    <h3>Información del producto</h3>
                    <p>Completa los datos principales del zapato.</p>
                </div>
            </div>

            <form action="{{ route('productos.store') }}" method="POST" enctype="multipart/form-data">
                @csrf

                <div class="mb-3">
                    <label class="form-label">Nombre del zapato</label>
                    <input type="text" name="nombre" class="form-control" placeholder="Ej: Nike Pegasus 42" required>
                </div>

                <div class="mb-3">
                    <label class="form-label">Descripción</label>
                    <textarea name="descripcion" class="form-control" rows="4" placeholder="Describe materiales, estilo, uso y beneficios..." required></textarea>
                </div>

                <div class="row">
                    <div class="col-md-6 mb-3">
                        <label class="form-label">Precio</label>
                        <input type="number" name="precio" class="form-control" placeholder="Ej: 590000" required>
                    </div>

                    <div class="col-md-6 mb-3">
                        <label class="form-label">Stock</label>
                        <input type="number" name="stock" class="form-control" placeholder="Ej: 10" required>
                    </div>
                </div>
                    <div class="mb-3">
    <label class="form-label">Talla</label>
    <input type="text"
           name="talla"
           class="form-control"
           placeholder="Ej: 38,39,40,41,42">
</div>

<div class="mb-3">
    <label class="form-label">Color</label>
    <input type="text"
           name="color"
           class="form-control"
           placeholder="Ej: Negro, Blanco, Azul">
</div>
                <div class="mb-4">
                    <label class="form-label">Imagen del producto</label>
                    <input type="file" name="imagen" class="form-control">
                    <small class="text-muted">Recomendado: imagen clara, fondo blanco o neutro.</small>
                </div>

                <div class="d-flex gap-2">
                    <button type="submit" class="btn btn-success px-4">
                        <i class="bi bi-check-circle"></i> Guardar producto
                    </button>

                    <a href="{{ route('admin.productos') }}" class="btn btn-secondary px-4">
                        Cancelar
                    </a>
                </div>
            </form>
        </div>

        <div class="preview-card-admin">
            <div class="preview-icon">
                <i class="bi bi-stars"></i>
            </div>

            <h3>Consejos para publicar</h3>

            <ul>
                <li>Usa un nombre corto y claro.</li>
                <li>Agrega una descripción llamativa.</li>
                <li>Verifica precio y stock antes de guardar.</li>
                <li>Sube una imagen nítida del producto.</li>
            </ul>

            <div class="mini-product-preview">
                <div class="mini-img">
                    <i class="bi bi-image"></i>
                </div>

                <div>
                    <span>Vista previa</span>
                    <h4>Nuevo producto</h4>
                    <p>Se mostrará en el catálogo después de guardarlo.</p>
                </div>
            </div>
        </div>

    </div>

</div>

</body>
</html>