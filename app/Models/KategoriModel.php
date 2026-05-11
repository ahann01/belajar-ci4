<?php

namespace App\Models;

use CodeIgniter\Model;

class KategoriModel extends Model
{
    protected $table            = 'kategori';
    protected $primaryKey       = 'id';
    protected $useAutoIncrement = true;
    protected $returnType       = 'array';
    protected $useSoftDeletes   = false;
    protected $useTimestamps    = true;
    protected $allowedFields    = ['nama', 'deskripsi'];

    /** 
     * Ambil semua kategori sebagai dropdown options 
     * Return: ['id' => 'nama'] untuk form select 
     */
    public function getDropdown(): array
    {
        $kategori = $this->orderBy('nama')->findAll();
        $result = ['' => '-- Pilih Kategori --'];
        foreach ($kategori as $k) {
            $result[$k['id']] = $k['nama'];
        }
        return $result;
    }

    /** 
     * Hitung jumlah buku dalam kategori tertentu 
     */
    public function countBooks(int $kategoriId): int
    {
        $db = \Config\Database::connect();
        return (int) $db->table('buku')
            ->where('kategori_id', $kategoriId)
            ->countAllResults();
    }

    /** 
     * Ambil nama kategori berdasarkan ID 
     */
    public function getNamaById(int $id): string|null
    {
        $result = $this->select('nama')->find($id);
        return $result ? (string) $result['nama'] : null;
    }

    /** 
     * Cek apakah nama kategori sudah ada (untuk validasi unik) 
     */
    public function isNamaExists(string $nama, int $excludeId = 0): bool
    {
        $qb = $this->where('nama', $nama);
        if ($excludeId > 0) {
            $qb->where('id !=', $excludeId);
        }
        return $qb->countAllResults() > 0;
    }
}
