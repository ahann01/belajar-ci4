<?php

namespace App\Controllers;

use App\Models\KategoriModel;

class Kategori extends BaseController
{
    private KategoriModel $kategoriModel;

    public function __construct()
    {
        $this->kategoriModel = new KategoriModel();
    }

    // ────────────────────────────────────── 
    // READ - Daftar Kategori 
    // ────────────────────────────────────── 
    public function index(): string
    {
        $kategori = $this->kategoriModel
            ->select('kategori.*, COUNT(buku.id) AS jumlah_buku')
            ->join('buku', 'buku.kategori_id = kategori.id', 'left')
            ->groupBy('kategori.id')
            ->orderBy('kategori.nama', 'ASC')
            ->findAll();

        $data = [
            'title'    => 'Daftar Kategori',
            'kategori' => $kategori,
            'total'    => count($kategori),
        ];
        return view('kategori/index', $data);
    }

    // ────────────────────────────────────── 
    // CREATE - Form tambah 
    // ────────────────────────────────────── 
    public function tambah(): string
    {
        return view('kategori/form', [
            'title'    => 'Tambah Kategori',
            'kategori' => null,
        ]);
    }

    // ────────────────────────────────────── 
    // CREATE - Proses simpan 
    // ────────────────────────────────────── 
    public function simpan()
    {
        $data = $this->ambilDataForm();

        // Validasi nama tidak kosong
        if (empty(trim($data['nama']))) {
            session()->setFlashdata('error', 'Nama kategori tidak boleh kosong.');
            return redirect()->back()->withInput();
        }

        // Validasi nama tidak duplikat
        if ($this->kategoriModel->isNamaExists($data['nama'])) {
            session()->setFlashdata('error', 'Nama kategori sudah ada.');
            return redirect()->back()->withInput();
        }

        $this->kategoriModel->insert($data);
        session()->setFlashdata('sukses', "Kategori '{$data['nama']}' berhasil ditambahkan.");
        return redirect()->to('/kategori');
    }

    // ────────────────────────────────────── 
    // UPDATE - Form edit 
    // ────────────────────────────────────── 
    public function edit(int $id): string
    {
        $kategori = $this->kategoriModel->find($id);
        if (!$kategori) {
            throw new \CodeIgniter\Exceptions\PageNotFoundException('Kategori tidak ditemukan');
        }

        return view('kategori/form', [
            'title'    => 'Edit Kategori: ' . $kategori['nama'],
            'kategori' => $kategori,
        ]);
    }

    // ────────────────────────────────────── 
    // UPDATE - Proses update 
    // ────────────────────────────────────── 
    public function update(int $id)
    {
        $kategori = $this->kategoriModel->find($id);
        if (!$kategori) {
            session()->setFlashdata('error', 'Kategori tidak ditemukan.');
            return redirect()->to('/kategori');
        }

        $data = $this->ambilDataForm();

        // Validasi nama tidak kosong
        if (empty(trim($data['nama']))) {
            session()->setFlashdata('error', 'Nama kategori tidak boleh kosong.');
            return redirect()->back()->withInput();
        }

        // Validasi nama tidak duplikat (kecuali kategori yang sedang diedit)
        if ($this->kategoriModel->isNamaExists($data['nama'], $id)) {
            session()->setFlashdata('error', 'Nama kategori sudah digunakan kategori lain.');
            return redirect()->back()->withInput();
        }

        $this->kategoriModel->update($id, $data);
        session()->setFlashdata('sukses', "Kategori '{$data['nama']}' berhasil diperbarui.");
        return redirect()->to('/kategori');
    }

    // ────────────────────────────────────── 
    // DELETE 
    // ────────────────────────────────────── 
    public function hapus(int $id)
    {
        $kategori = $this->kategoriModel->find($id);
        if (!$kategori) {
            session()->setFlashdata('error', 'Kategori tidak ditemukan.');
            return redirect()->to('/kategori');
        }

        // Cek apakah ada buku dalam kategori ini
        if ($this->kategoriModel->countBooks($id) > 0) {
            session()->setFlashdata('error', 'Tidak dapat menghapus kategori yang masih memiliki buku. Pindahkan atau hapus buku terlebih dahulu.');
            return redirect()->back();
        }

        $this->kategoriModel->delete($id);
        session()->setFlashdata('sukses', "Kategori '{$kategori['nama']}' berhasil dihapus.");
        return redirect()->to('/kategori');
    }

    // ────────────────────────────────────── 
    // PRIVATE HELPER - Kumpulkan data dari form 
    // ────────────────────────────────────── 
    private function ambilDataForm(): array
    {
        return [
            'nama'       => $this->request->getPost('nama'),
            'deskripsi'  => $this->request->getPost('deskripsi'),
        ];
    }
}
