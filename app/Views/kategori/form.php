<?php

/**
 * @var \CodeIgniter\View\View $this
 * @var array<string, mixed>|null $kategori
 * @var string $title
 */
$kategori = $kategori ?? null;
$title = $title ?? ($kategori ? 'Edit Kategori' : 'Tambah Kategori');
$isEdit = !is_null($kategori);
?>
<?php $this->extend('layout/main') ?>
<?php $this->section('content') ?>

<div class='row justify-content-center'>
    <div class='col-md-8'>
        <div class='card shadow-sm'>
            <div class='card-header bg-primary text-white'>
                <h4 class='mb-0'>
                    <i class='bi bi-<?= $isEdit ? 'pencil' : 'plus-circle' ?>'></i>
                    <?= esc($title) ?>
                </h4>
            </div>
            <div class='card-body'>

                <!-- Error dari session -->
                <?php if (session()->getFlashdata('error')): ?>
                    <div class='alert alert-danger alert-dismissible fade show' role='alert'>
                        <i class='bi bi-exclamation-circle'></i> <?= esc((string) session()->getFlashdata('error')) ?>
                        <button type='button' class='btn-close' data-bs-dismiss='alert'></button>
                    </div>
                <?php endif; ?>

                <form action='<?= base_url($isEdit ? 'kategori/update/' . $kategori['id'] : 'kategori/simpan') ?>' method='post'>
                    <?= csrf_field() ?>

                    <div class='mb-3'>
                        <label class='form-label fw-bold'>Nama Kategori <span class='text-danger'>*</span></label>
                        <input type='text' name='nama' class='form-control' value='<?= esc(old('nama', $kategori['nama'] ?? '')) ?>' placeholder='Contoh: Fiksi, Non-Fiksi, dll' required>
                        <small class='text-muted'>Nama kategori harus unik dan tidak boleh kosong.</small>
                    </div>

                    <div class='mb-3'>
                        <label class='form-label fw-bold'>Deskripsi</label>
                        <textarea name='deskripsi' rows='4' class='form-control' placeholder='Deskripsi singkat tentang kategori ini (opsional)'><?= esc(old('deskripsi', $kategori['deskripsi'] ?? '')) ?></textarea>
                        <small class='text-muted'>Opsional. Gunakan untuk menjelaskan kategori secara lebih detail.</small>
                    </div>

                    <!-- Tombol Aksi -->
                    <div class='d-flex gap-2'>
                        <button type='submit' class='btn btn-primary'>
                            <i class='bi bi-save'></i> <?= $isEdit ? 'Perbarui Kategori' : 'Simpan Kategori' ?>
                        </button>
                        <a href='<?= base_url('kategori') ?>' class='btn btn-secondary'>
                            <i class='bi bi-x-circle'></i> Batal
                        </a>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

<?php $this->endSection() ?>