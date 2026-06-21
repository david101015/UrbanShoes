<?php

namespace App\Http\Controllers;


use App\Models\Producto;
use Illuminate\Http\Request;

class CarritoController extends Controller
{
    public function agregar(Producto $producto)
   {
    if ($producto->stock <= 0) {
        return redirect()->route('catalogo')
            ->with('ok', 'Producto agotado');
    }

    $carrito = session()->get('carrito', []);

    if (isset($carrito[$producto->id])) {

        if ($carrito[$producto->id]['cantidad'] >= $producto->stock) {
            return redirect()->route('carrito')
                ->with('ok', 'No hay más unidades disponibles');
        }

        $cantidad = (int) request('cantidad', 1);

    } else {
        $carrito[$producto->id] = [
            'id' => $producto->id,
            'nombre' => $producto->nombre,
            'precio' => $producto->precio,
            'imagen' => $producto->imagen,
            'cantidad' => 1
        ];
    }

    session()->put('carrito', $carrito);

    return redirect()->route('carrito')->with('ok', 'Producto agregado al carrito');
   }

    public function ver()
    {
        $carrito = session()->get('carrito', []);

        return view('carrito.index', compact('carrito'));
    }

    public function eliminar($id)
    {
        $carrito = session()->get('carrito', []);

        if (isset($carrito[$id])) {
            unset($carrito[$id]);
        }

        session()->put('carrito', $carrito);

        return redirect()->route('carrito')->with('ok', 'Carrito vaciado correctamente');
    }

    public function vaciar()
    {
        session()->forget('carrito');

        return redirect('/carrito')->with('ok', 'Carrito vaciado correctamente');
    }

   public function aumentar($id)
    {
    $carrito = session()->get('carrito', []);
    $producto = Producto::find($id);

    if (isset($carrito[$id]) && $producto) {

        if ($carrito[$id]['cantidad'] >= $producto->stock) {
            return redirect()->route('carrito')
                ->with('ok', 'No hay más unidades disponibles en stock');
        }

        $carrito[$id]['cantidad']++;
    }

    session()->put('carrito', $carrito);

    return redirect()->route('carrito');
  }
public function disminuir($id)
{
    $carrito = session()->get('carrito', []);

    if (isset($carrito[$id])) {
        if ($carrito[$id]['cantidad'] > 1) {
            $carrito[$id]['cantidad']--;
        } else {
            unset($carrito[$id]);
        }
    }

    session()->put('carrito', $carrito);

    return redirect()->route('carrito');
}
}