<?php

if (!function_exists('format_tanggal')) {
    function format_tanggal(string $tanggal): string
    {
        $bulan = [
            1 => 'Januari',
            2 => 'Februari',
            3 => 'Maret',
            4 => 'April',
            5 => 'Mei',
            6 => 'Juni',
            7 => 'Juli',
            8 => 'Agustus',
            9 => 'September',
            10 => 'Oktober',
            11 => 'November',
            12 => 'Desember'
        ];

        $timestamp = strtotime($tanggal);

        return date('d', $timestamp) . ' ' .
            $bulan[(int)date('m', $timestamp)] . ' ' .
            date('Y', $timestamp);
    }
}

if (!function_exists('format_rupiah')) {
    function format_rupiah($nominal): string
    {
        return 'Rp ' . number_format($nominal, 0, ',', '.');
    }
}

if (!function_exists('truncate_text')) {
    function truncate_text(string $text, int $length = 100): string
    {
        if (strlen($text) <= $length) {
            return $text;
        }

        return substr($text, 0, $length) . '...';
    }
}

if (!function_exists('status_badge')) {
    function status_badge(string $status): string
    {
        $map = [
            'aktif' => 'success',
            'nonaktif' => 'secondary',
            'dipinjam' => 'warning',
            'tersedia' => 'info',
            'hilang' => 'danger'
        ];

        $warna = $map[strtolower($status)] ?? 'secondary';

        return "<span class='badge bg-{$warna}'>" . ucfirst($status) . "</span>";

        if (!function_exists('inisial_nama')) {
            function inisial_nama($namaLengkap)
            {
                $kata = explode(' ', $namaLengkap);
                $hasil = '';

                foreach ($kata as $k) {
                    $hasil .= strtoupper(substr($k, 0, 1));
                }

                return $hasil;
            }
        }

        if (!function_exists('avatar_url')) {
            function avatar_url($nama)
            {
                return 'https://ui-avatars.com/api/?name=' . urlencode($nama);
            }
        }
    }
}
