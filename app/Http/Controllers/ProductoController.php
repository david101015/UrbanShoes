<?php

namespace App\Http\Controllers;
use App\Models\Producto;
use Illuminate\Http\Request;
use App\Models\Pedido;
use App\Models\PedidoDetalle;

class ProductoController extends Controller
{
   public function index(Request $request)
   {
    $buscar = $request->buscar;
    $categoria = $request->categoria;

    $productos = Producto::query()
        ->when($buscar, function ($query) use ($buscar) {
            $query->where('nombre', 'like', "%{$buscar}%")
                  ->orWhere('descripcion', 'like', "%{$buscar}%");
        })
        ->when($categoria, function ($query) use ($categoria) {
            $query->where('nombre', 'like', "%{$categoria}%")
                  ->orWhere('descripcion', 'like', "%{$categoria}%");
        })
        ->latest()
        ->get();

    return view('productos.index', compact('productos'));
  } 

       // NUEVO MÉTODO
   public function show(Producto $producto)
    {
    $relacionados = Producto::where('id', '!=', $producto->id)
        ->inRandomOrder()
        ->take(4)
        ->get();

    return view('productos.show', compact('producto', 'relacionados'));
    }

   public function admin()
   {
    $productos = Producto::latest()->get();

    $totalProductos = $productos->count();
    $inventarioTotal = $productos->sum('stock');
    $valorInventario = $productos->sum(fn($p) => $p->precio * $p->stock);
    $stockBajo = $productos->where('stock', '<', 5)->count();

    $totalPedidos = Pedido::count();
    $ventasTotales = Pedido::sum('total');
    $pedidosPendientes = Pedido::where('estado', 'Pendiente')->count();

    $productoMasVendido = PedidoDetalle::selectRaw('nombre_producto, SUM(cantidad) as total_vendido')
        ->groupBy('nombre_producto')
        ->orderByDesc('total_vendido')
        ->first();
      $ventasPorEstado = Pedido::selectRaw('estado, COUNT(*) as total')
    ->groupBy('estado')
    ->get();

$productosMasVendidos = PedidoDetalle::selectRaw('nombre_producto, SUM(cantidad) as total')
    ->groupBy('nombre_producto')
    ->orderByDesc('total')
    ->limit(5)
    ->get();

               
    return view('productos.admin', compact(
        'productos',
        'totalProductos',
        'inventarioTotal',
        'valorInventario',
        'stockBajo',
        'totalPedidos',
        'ventasTotales',
        'pedidosPendientes',
        'productoMasVendido',
        'ventasPorEstado',
        'productosMasVendidos'
    ));
   }

    public function create()
    {
        return view('productos.create');
    }

    public function store(Request $request)
    {
       $data = $request->validate([
    'nombre' => 'required',
    'descripcion' => 'required',
    'precio' => 'required|numeric',
    'stock' => 'required|integer',
    'imagen' => 'nullable|image',

    'talla' => 'nullable|string',
    'color' => 'nullable|string',
    ]);

        if ($request->hasFile('imagen')) {
            $data['imagen'] = $request->file('imagen')->store('productos', 'public');
        }

        Producto::create($data);

        return redirect()->route('admin.productos')->with('ok', 'Producto guardado correctamente');
    }

    public function edit(Producto $producto)
    {
        return view('productos.edit', compact('producto'));
    }

    public function update(Request $request, Producto $producto)
    {
       $data = $request->validate([
    'nombre' => 'required',
    'descripcion' => 'required',
    'precio' => 'required|numeric',
    'stock' => 'required|integer',
    'imagen' => 'nullable|image',

    'talla' => 'nullable|string',
    'color' => 'nullable|string',
    ]);

        if ($request->hasFile('imagen')) {
            $data['imagen'] = $request->file('imagen')->store('productos', 'public');
        }

        $producto->update($data);

        return redirect()->route('admin.productos')->with('ok', 'Producto actualizado correctamente');
    }

    public function destroy(Producto $producto)
    {
        $producto->delete();

        return redirect()->route('admin.productos')->with('ok', 'Producto eliminado correctamente');
    }
}