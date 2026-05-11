<?php

/**
 * @var \CodeIgniter\View\View $this
 * @var array<int, array<string, mixed>> $kategori
 * @var int $total
 */
?>
<?php $this->extend('layout/main') ?>
<?php $this->section('content') ?>

<div class='d-flex justify-content-between align-items-center mb-4'>
    <div>
        <h2><i class='bi bi-tag'></i> Daftar Kategori</h2>
        <p class='text-muted mb-0'>Total: <?= $total ?> kategori ditemukan</p>
    </div>
    <a href='<?= base_url('kategori/tambah') ?>' class='btn btn-primary'>
        <i class='bi bi-plus-circle'></i> Tambah Kategori
    </a>
</div>

<!-- Flash Message -->
<?php if (session()->getFlashdata('sukses')): ?>
    <div class='alert alert-success alert-dismissible fade show' role='alert'>
        <i class='bi bi-check-circle'></i> <?= esc((string) session()->getFlashdata('sukses')) ?>
        <button type='button' class='btn-close' data-bs-dismiss='alert'></button>
    </div>
<?php endif; ?>

<?php if (session()->getFlashdata('error')): ?>
    <div class='alert alert-danger alert-dismissible fade show' role='alert'>
        <i class='bi bi-exclamation-circle'></i> <?= esc((string) session()->getFlashdata('error')) ?>
        <button type='button' class='btn-close' data-bs-dismiss='alert'></button>
    </div>
<?php endif; ?>

<!-- Tabel Kategori -->
<?php if (empty($kategori)): ?>
    <div class='text-center py-5'>
        <i class='bi bi-inbox display-1 text-muted'></i>
        <h4 class='mt-3 text-muted'>Tidak ada kategori ditemukan</h4>
        <p><a href='<?= base_url('kategori/tambah') ?>'>Buat kategori pertama Anda</a>.</p>
    </div>
<?php else: ?>
    <div class='table-responsive'>
        <table class='table table-hover table-bordered align-middle'>
            <thead class='table-primary'>
                <tr>
                    <th width='60'>No.</th>
                    <th>Nama Kategori</th>
                    <th width='120'>Jumlah Buku</th>
                    <th width='180'>Deskripsi</th>
                    <th width='130'>Aksi</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($kategori as $i => $k): ?>
                    <?php /** @var array<string, mixed> $k */ ?>
                    <tr>
                        <td class='text-center'><?= $i + 1 ?></td>
                        <td><strong><?= esc((string) $k['nama']) ?></strong></td>
                        <td class='text-center'>
                            <span class='badge bg-<?= ((int) $k['jumlah_buku']) > 0 ? 'info' : 'secondary' ?>'>
                                <?= (int) $k['jumlah_buku'] ?>
                            </span>
                        </td>
                        <td>
                            <small><?= esc((string) ($k['deskripsi'] ?? '-')) ?></small>
                        </td>
                        <td class='text-center'>
                            <a href='<?= base_url('kategori/edit/' . $k['id']) ?>' class='btn btn-sm btn-warning' title='Edit'>
                                <i class='bi bi-pencil'></i>
                            </a>
                            <a href='<?= base_url('kategori/hapus/' . $k['id']) ?>' class='btn btn-sm btn-danger' title='Hapus' onclick="return confirm('Yakin ingin menghapus kategori &quot;<?= esc((string) $k['nama'], 'js') ?>&quot;?')">
                                <i class='bi bi-trash'></i>
                            </a>
                        </td>
                    </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
    </div>
<?php endif; ?>

<?php $this->endSection() ?>