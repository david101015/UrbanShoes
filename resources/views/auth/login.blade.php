<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Login Administrador | UrbanShoes</title>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="{{ asset('css/admin.css') }}?v={{ time() }}">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.css">
</head>

<body>

<div class="login-admin-page">

    <div class="login-brand">
        <h1>Urban<span>Shoes</span></h1>
        <p>Panel administrativo para gestionar productos, pedidos, clientes e inventario.</p>

        <div class="login-features">
            <div><i class="bi bi-box-seam"></i> Gestión de productos</div>
            <div><i class="bi bi-receipt"></i> Control de pedidos</div>
            <div><i class="bi bi-graph-up-arrow"></i> Estadísticas de ventas</div>
        </div>
    </div>

    <div class="login-card">

        <div class="login-icon">
            <i class="bi bi-person-lock"></i>
        </div>

        <h2>Iniciar sesión</h2>
        <p>Acceso exclusivo para administradores.</p>

        @if ($errors->any())
            <div class="alert alert-danger">
                Verifica tu correo o contraseña.
            </div>
        @endif

        <form method="POST" action="{{ route('login') }}">
            @csrf

            <div class="mb-3">
                <label class="form-label">Correo electrónico</label>
                <input type="email" name="email" class="form-control" required autofocus>
            </div>

            <div class="mb-3">
                <label class="form-label">Contraseña</label>
                <input type="password" name="password" class="form-control" required>
            </div>

            <div class="d-flex justify-content-between align-items-center mb-4">
                <label class="remember">
                    <input type="checkbox" name="remember">
                    Recordarme
                </label>
            </div>

            <button type="submit" class="btn-login-admin">
                Entrar al panel
            </button>
        </form>

        <a href="{{ route('inicio') }}" class="back-store">
            <i class="bi bi-arrow-left"></i> Volver a la tienda
        </a>

    </div>

</div>

</body>
</html>