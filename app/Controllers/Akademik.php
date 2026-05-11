<?php

namespace App\Controllers;

class Akademik extends BaseController
{
    // 1. Method index()
    public function index(): string
    {
        return "<h1>Sistem Informasi Akademik</h1>
                <p>Nama: Muhammad Farhan</p>";
    }

    // 2. Method matkul()
    public function matkul(): string
    {
        return "<h1>Daftar Mata Kuliah</h1>
                <ul>
                    <li>Metodologi Penelitian</li>
                    <li>Testing dan Implementasi</li>
                    <li>Keamanan Sistem Komputer</li>
                    <li>Riset Operasi</li>
                    <li>Pengolahan Citra</li>
                </ul>";
    }

    // 3. Method nilai($npm)
    public function nilai($npm): string
    {
        return "<h1>Nilai Mahasiswa</h1>
                <p>Nilai mahasiswa dengan NPM: $npm</p>";
    }
}
