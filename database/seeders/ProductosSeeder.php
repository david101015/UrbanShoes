<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Producto;

class ProductosSeeder extends Seeder
{
    public function run(): void
    {
        $productos = [

            [
                'nombre' => 'Nike Air Max 90',
                'descripcion' => 'Zapatilla deportiva clásica con excelente amortiguación.',
                'precio' => 450000,
                'stock' => 15,
                'imagen' => null,
                'talla' => '40',
                'color' => 'Blanco'
            ],

            [
                'nombre' => 'Nike Pegasus 41',
                'descripcion' => 'Diseñada para corredores que buscan comodidad y velocidad.',
                'precio' => 852000,
                'stock' => 10,
                'imagen' => null,
                'talla' => '41',
                'color' => 'Negro'
            ],

            [
                'nombre' => 'Nike Revolution 7',
                'descripcion' => 'Tenis cómodos para entrenamiento diario.',
                'precio' => 320000,
                'stock' => 20,
                'imagen' => null,
                'talla' => '39',
                'color' => 'Azul'
            ],

            [
                'nombre' => 'Adidas Superstar',
                'descripcion' => 'Modelo icónico con diseño urbano.',
                'precio' => 380000,
                'stock' => 12,
                'imagen' => null,
                'talla' => '42',
                'color' => 'Blanco'
            ],

            [
                'nombre' => 'Adidas Forum Low',
                'descripcion' => 'Estilo retro con gran comodidad.',
                'precio' => 470000,
                'stock' => 9,
                'imagen' => null,
                'talla' => '40',
                'color' => 'Blanco Azul'
            ],

            [
                'nombre' => 'Puma RS-X',
                'descripcion' => 'Diseño moderno y deportivo.',
                'precio' => 520000,
                'stock' => 14,
                'imagen' => null,
                'talla' => '41',
                'color' => 'Negro'
            ],

            [
                'nombre' => 'Puma Future Rider',
                'descripcion' => 'Ligera y cómoda para uso diario.',
                'precio' => 390000,
                'stock' => 18,
                'imagen' => null,
                'talla' => '40',
                'color' => 'Rojo'
            ],

            [
                'nombre' => 'New Balance 574',
                'descripcion' => 'Comodidad y estilo para cualquier ocasión.',
                'precio' => 480000,
                'stock' => 13,
                'imagen' => null,
                'talla' => '42',
                'color' => 'Gris'
            ],

            [
                'nombre' => 'New Balance 327',
                'descripcion' => 'Inspiración retro con diseño moderno.',
                'precio' => 510000,
                'stock' => 11,
                'imagen' => null,
                'talla' => '41',
                'color' => 'Blanco Gris'
            ],

            [
                'nombre' => 'Converse Chuck Taylor',
                'descripcion' => 'El clásico de todos los tiempos.',
                'precio' => 280000,
                'stock' => 25,
                'imagen' => null,
                'talla' => '39',
                'color' => 'Negro'
            ],

            [
                'nombre' => 'Converse Run Star',
                'descripcion' => 'Diseño elevado y moderno.',
                'precio' => 450000,
                'stock' => 10,
                'imagen' => null,
                'talla' => '38',
                'color' => 'Blanco'
            ],

            [
                'nombre' => 'Vans Old Skool',
                'descripcion' => 'Modelo urbano muy popular.',
                'precio' => 340000,
                'stock' => 16,
                'imagen' => null,
                'talla' => '40',
                'color' => 'Negro Blanco'
            ],

            [
                'nombre' => 'Vans Knu Skool',
                'descripcion' => 'Diseño inspirado en los años 90.',
                'precio' => 420000,
                'stock' => 12,
                'imagen' => null,
                'talla' => '41',
                'color' => 'Azul'
            ],

            [
                'nombre' => 'Reebok Classic',
                'descripcion' => 'Elegancia deportiva tradicional.',
                'precio' => 350000,
                'stock' => 15,
                'imagen' => null,
                'talla' => '40',
                'color' => 'Blanco'
            ],

            [
                'nombre' => 'Reebok Nano X4',
                'descripcion' => 'Ideal para entrenamiento funcional.',
                'precio' => 620000,
                'stock' => 8,
                'imagen' => null,
                'talla' => '42',
                'color' => 'Negro'
            ]

        ];

        foreach ($productos as $producto) {
            Producto::create($producto);
        }
    }
}