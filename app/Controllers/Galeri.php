<?php

namespace App\Controllers;

class Galeri extends BaseController
{
    public function index(): string
    {
        helper('app');

        $kategori = $this->request->getGet('kategori');

        $galeri = [

            [
                'judul' => 'Gunung',
                'url_gambar' => 'https://images.unsplash.com/photo-1501785888041-af3ef285b470?w=400',
                'deskripsi' => 'Pemandangan gunung yang indah dan sejuk.',
                'kategori' => 'alam'
            ],

            [
                'judul' => 'Pantai',
                'url_gambar' => 'https://images.unsplash.com/photo-1507525428034-b723cf961d3e?w=400',
                'deskripsi' => 'Pantai dengan pasir putih dan ombak tenang.',
                'kategori' => 'alam'
            ],

            [
                'judul' => 'Laptop',
                'url_gambar' => 'https://images.unsplash.com/photo-1496181133206-80ce9b88a853?w=400',
                'deskripsi' => 'Laptop modern untuk bekerja dan belajar.',
                'kategori' => 'teknologi'
            ],

            [
                'judul' => 'Keyboard',
                'url_gambar' => 'https://images.unsplash.com/photo-1511467687858-23d96c32e4ae?w=400',
                'deskripsi' => 'Keyboard mekanik gaming RGB.',
                'kategori' => 'teknologi'
            ],

            [
                'judul' => 'Kucing',
                'url_gambar' => 'https://images.unsplash.com/photo-1519052537078-e6302a4968d4?w=400',
                'deskripsi' => 'Kucing lucu dan menggemaskan.',
                'kategori' => 'hewan'
            ],

            [
                'judul' => 'Burung',
                'url_gambar' => 'https://images.unsplash.com/photo-1444464666168-49d633b86797?w=400',
                'deskripsi' => 'Burung terbang bebas di langit.',
                'kategori' => 'hewan'
            ]

        ];

        if ($kategori) {
            $galeri = array_filter($galeri, function ($g) use ($kategori) {
                return $g['kategori'] == $kategori;
            });
        }

        $data = [
            'title' => 'Galeri',
            'galeri' => $galeri
        ];

        return view('galeri/index', $data);
    }
}
