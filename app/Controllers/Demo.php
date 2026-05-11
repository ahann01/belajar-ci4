<?php

namespace App\Controllers;

class Demo extends BaseController
{
    public function index(): string
    {
        helper('app');

        $data = [

            // String
            'title' => 'Halaman Demo',
            'judul' => 'Halaman Demo',

            // Integer
            'tahun' => date('Y'),

            // Array flat
            'warna' => [
                'Merah',
                'Hijau',
                'Biru'
            ],

            // Array asosiatif
            'user' => [
                'nama'  => 'Budi',
                'email' => 'budi@mail.com'
            ],

            // Array of array
            'produk' => [

                [
                    'id'    => 1,
                    'nama'  => 'Laptop',
                    'harga' => 8500000
                ],

                [
                    'id'    => 2,
                    'nama'  => 'Mouse',
                    'harga' => 150000
                ],

                [
                    'id'    => 3,
                    'nama'  => 'Keyboard',
                    'harga' => 350000
                ]
            ],

            // Boolean
            'show_footer' => true,

            // Null
            'promo' => null
        ];

        return view('demo/index', $data);
    }
}
