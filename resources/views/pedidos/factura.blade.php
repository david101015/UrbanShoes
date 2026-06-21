<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Factura #{{ $pedido->id }}</title>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">

    <style>
        body{
            background:#f4f6f9;
            padding:40px;
        }

        .factura{
            background:white;
            max-width:1000px;
            margin:auto;
            padding:40px;
            border-radius:20px;
            box-shadow:0 10px 30px rgba(0,0,0,.1);
        }

        .logo{
            font-size:32px;
            font-weight:900;
        }

        .logo span{
            color:#ff7b00;
        }

        .total{
            font-size:28px;
            font-weight:bold;
            color:#16a34a;
        }
        @media print {
    body {
        background: white;
        padding: 0;
    }

    .factura {
        box-shadow: none;
        border-radius: 0;
        max-width: 100%;
    }

    .no-print {
        display: none;
    }

    @page {
        margin: 20mm;
    }
}
    </style>
</head>
<body>

<div class="factura">

    <div class="d-flex justify-content-between mb-4">
        <div>
            <h1 class="logo">Urban<span>Shoes</span></h1>
            <p>Bogotá - Colombia</p>
        </div>

        <div class="text-end">
            <h3>FACTURA #{{ str_pad($pedido->id,6,'0',STR_PAD_LEFT) }}</h3>
            <p>{{ $pedido->created_at->format('d/m/Y H:i') }}</p>
        </div>
    </div>

    <hr>

    <h4>Datos del cliente</h4>

    <p><strong>Nombre:</strong> {{ $pedido->nombre }}</p>
    <p><strong>Correo:</strong> {{ $pedido->correo }}</p>
    <p><strong>Teléfono:</strong> {{ $pedido->telefono }}</p>
    <p><strong>Dirección:</strong> {{ $pedido->direccion }}</p>

    <hr>

    <h4>Productos comprados</h4>

    <table class="table">
        <thead>
        <tr>
            <th>Producto</th>
            <th>Cantidad</th>
            <th>Precio</th>
            <th>Subtotal</th>
        </tr>
        </thead>

        <tbody>

        @foreach($pedido->detalles as $detalle)

            <tr>
                <td>{{ $detalle->nombre_producto }}</td>

                <td>{{ $detalle->cantidad }}</td>

                <td>
                    ${{ number_format($detalle->precio,0,',','.') }}
                </td>

                <td>
                    ${{ number_format($detalle->subtotal,0,',','.') }}
                </td>
            </tr>

        @endforeach

        </tbody>
    </table>

    <div class="text-end mt-4">

        <p>
            <strong>Método de pago:</strong>
            {{ $pedido->metodo_pago }}
        </p>

        <p>
            <strong>Estado:</strong>
            {{ $pedido->estado }}
        </p>

        <h2 class="total">
            Total: ${{ number_format($pedido->total,0,',','.') }}
        </h2>

    </div>

    <div class="mt-5 text-center">

        <button onclick="window.print()" class="btn btn-dark no-print">
         Imprimir factura
        </button>

    </div>

</div>

</body>
</html>