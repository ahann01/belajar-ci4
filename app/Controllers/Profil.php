<?php

namespace App\Controllers;

class Profil extends BaseController
{
    public function index(): string
    {
        helper('app');

        $data = [
            'title' => 'Profil Mahasiswa',
            'npm' => '2310010700',
            'nama' => 'Muhammad Farhan',
            'prodi' => 'Teknik Informatika',
            'angkatan' => '2023',
            'ipk' => 3.72,

            'matkul' => [
                'Metodologi Penelitian',
                'Testing dan Implementasi',
                'Keamanan Sistem Komputer',
                'Riset Operasi',
                'Pengolahan Citra'
            ]
        ];

        return view('profil/index', $data);
    }
}
