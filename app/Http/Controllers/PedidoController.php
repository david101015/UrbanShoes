<?php

namespace App\Http\Controllers;

use App\Models\Pedido;
use Illuminate\Http\Request;
use App\Models\PedidoDetalle;

class PedidoController extends Controller
{
    public function store(Request $request)
    {
        $request->validate([
            'nombre' => 'required',
            'correo' => 'required|email',
            'telefono' => 'required',
            'direccion' => 'required',
            'metodo_pago' => 'required'
        ]);

        $carrito = session()->get('carrito', []);

        $total = 0;

        foreach ($carrito as $item) {
            $total += $item['precio'] * $item['cantidad'];
        }

        $pedido = Pedido::create([
            'nombre' => $request->nombre,
            'correo' => $request->correo,
            'telefono' => $request->telefono,
            'direccion' => $request->direccion,
            'metodo_pago' => $request->metodo_pago,
            'total' => $total,
            'estado' => 'Pendiente'
        ]);

        foreach ($carrito as $item) {
            PedidoDetalle::create([
                'pedido_id' => $pedido->id,
                'producto_id' => $item['id'],
                'nombre_producto' => $item['nombre'],
                'precio' => $item['precio'],
                'cantidad' => $item['cantidad'],
                'subtotal' => $item['precio'] * $item['cantidad']
            ]);

            $producto = \App\Models\Producto::find($item['id']);

            if ($producto) {
                $producto->decrement('stock', $item['cantidad']);
            }
        }

        session()->forget('carrito');

        return redirect()->route('pedido.confirmado', $pedido->id);
    }

    public function index()
    {
        $pedidos = Pedido::latest()->get();

        $totalPedidos = Pedido::count();
        $ventasTotales = Pedido::sum('total');
        $pedidosPendientes = Pedido::where('estado', 'Pendiente')->count();
        $pedidosEntregados = Pedido::where('estado', 'Entregado')->count();

        return view('pedidos.admin', compact(
            'pedidos',
            'totalPedidos',
            'ventasTotales',
            'pedidosPendientes',
            'pedidosEntregados'
        ));
    }

    public function factura(Pedido $pedido)
    {
        $pedido->load('detalles');

        return view('pedidos.factura', compact('pedido'));
    }

    public function confirmado(Pedido $pedido)
    {
        return view('pedidos.confirmado', compact('pedido'));
    }

    public function actualizarEstado(Request $request, Pedido $pedido)
    {
        $request->validate([
            'estado' => 'required'
        ]);

        $pedido->update([
            'estado' => $request->estado
        ]);

        return redirect()->route('admin.pedidos')
            ->with('ok', 'Estado del pedido actualizado');
    }

    public function clientes()
    {
        $clientes = Pedido::selectRaw('
                nombre,
                correo,
                telefono,
                COUNT(*) as total_pedidos,
                SUM(total) as total_compras
            ')
            ->groupBy('nombre', 'correo', 'telefono')
            ->orderByDesc('total_compras')
            ->get();

        $totalClientes = $clientes->count();
        $totalComprasClientes = $clientes->sum('total_compras');
        $mejorCliente = $clientes->first();
        $totalPedidosClientes = $clientes->sum('total_pedidos');

        return view('pedidos.clientes', compact(
            'clientes',
            'totalClientes',
            'totalComprasClientes',
            'mejorCliente',
            'totalPedidosClientes'
        ));
    }
}