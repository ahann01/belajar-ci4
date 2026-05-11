<?php
/**
 * @var \CodeIgniter\View\View $this
 * @var array $statistik
 * @var float $rata_rata
 * @var array $topStok
 * @var array $stokHabis
 */
?>
<?php $this->extend('layout/main') ?>
<?php $this->section('content') ?>

<div class='d-flex justify-content-between align-items-center mb-4'>
    <div>
        <h2><i class='bi bi-bar-chart-line'></i> Statistik Buku</h2>
        <p class='text-muted mb-0'>Ringkasan data buku dan stok</p>
    </div>
    <a href='<?= base_url('buku') ?>' class='btn btn-secondary'>
        <i class='bi bi-arrow-left'></i> Kembali ke Daftar
    </a>
</div>

<div class="row mb-4">
    <div class="col-md-4">
        <div class="card bg-primary text-white mb-3">
            <div class="card-body">
                <h5 class="card-title"><i class="bi bi-book"></i> Total Buku</h5>
                <h2 class="display-4"><?= $statistik['total'] ?></h2>
            </div>
        </div>
    </div>
    <div class="col-md-4">
        <div class="card bg-success text-white mb-3">
            <div class="card-body">
                <h5 class="card-title"><i class="bi bi-boxes"></i> Total Stok</h5>
                <h2 class="display-4"><?= $statistik['total_stok'] ?></h2>
            </div>
        </div>
    </div>
    <div class="col-md-4">
        <div class="card bg-info text-white mb-3">
            <div class="card-body">
                <h5 class="card-title"><i class="bi bi-calculator"></i> Rata-rata Stok/Buku</h5>
                <h2 class="display-4"><?= $rata_rata ?></h2>
            </div>
        </div>
    </div>
</div>

<div class="row">
    <div class="col-md-6 mb-4">
        <div class="card h-100">
            <div class="card-header bg-white">
                <h5 class="card-title mb-0"><i class="bi bi-pie-chart"></i> Distribusi Kategori</h5>
            </div>
            <div class="card-body">
                <?php if (empty($statistik['per_kategori'])): ?>
                    <p class="text-muted">Belum ada data kategori.</p>
                <?php else: ?>
                    <div class="table-responsive">
                        <table class="table table-hover table-bordered mb-0">
                            <thead class="table-light">
                                <tr>
                                    <th>Kategori</th>
                                    <th class="text-center">Jumlah Buku</th>
                                    <th class="text-center">Total Stok</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php foreach ($statistik['per_kategori'] as $kat): ?>
                                    <tr>
                                        <td><?= esc((string)($kat['nama'] ?: 'Tanpa Kategori')) ?></td>
                                        <td class="text-center"><?= $kat['jumlah'] ?></td>
                                        <td class="text-center"><?= $kat['total_stok'] ?? 0 ?></td>
                                    </tr>
                                <?php endforeach; ?>
                            </tbody>
                        </table>
                    </div>
                <?php endif; ?>
            </div>
        </div>
    </div>

    <div class="col-md-6 mb-4">
        <div class="card h-100">
            <div class="card-header bg-white">
                <h5 class="card-title mb-0"><i class="bi bi-trophy"></i> Top 5 Buku (Stok Terbanyak)</h5>
            </div>
            <div class="card-body">
                <?php if (empty($topStok)): ?>
                    <p class="text-muted">Belum ada data buku.</p>
                <?php else: ?>
                    <ul class="list-group list-group-flush">
                        <?php foreach ($topStok as $buku): ?>
                            <li class="list-group-item d-flex justify-content-between align-items-center">
                                <div>
                                    <strong><?= esc((string)$buku['judul']) ?></strong><br>
                                    <small class="text-muted">Kode: <?= esc((string)$buku['kode_buku']) ?></small>
                                </div>
                                <span class="badge bg-success rounded-pill"><?= $buku['stok'] ?> stok</span>
                            </li>
                        <?php endforeach; ?>
                    </ul>
                <?php endif; ?>
            </div>
        </div>
    </div>
</div>

<div class="row">
    <div class="col-12">
        <div class="card border-danger">
            <div class="card-header bg-danger text-white">
                <h5 class="card-title mb-0"><i class="bi bi-exclamation-triangle"></i> Buku Perlu Restock (Stok 0)</h5>
            </div>
            <div class="card-body">
                <?php if (empty($stokHabis)): ?>
                    <div class="alert alert-success mb-0">
                        <i class="bi bi-check-circle"></i> Semua buku saat ini memiliki stok. Tidak ada yang perlu direstock.
                    </div>
                <?php else: ?>
                    <div class="table-responsive">
                        <table class="table table-hover table-bordered align-middle mb-0">
                            <thead class="table-light">
                                <tr>
                                    <th width="60">No.</th>
                                    <th width="100">Kode</th>
                                    <th>Judul</th>
                                    <th>Penulis</th>
                                    <th width="120" class="text-center">Aksi</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php $no = 1; foreach ($stokHabis as $buku): ?>
                                    <tr>
                                        <td class="text-center"><?= $no++ ?></td>
                                        <td><code><?= esc((string)$buku['kode_buku']) ?></code></td>
                                        <td><strong><?= esc((string)$buku['judul']) ?></strong></td>
                                        <td><?= esc((string)$buku['penulis']) ?></td>
                                        <td class="text-center">
                                            <a href="<?= base_url('buku/edit/' . $buku['id']) ?>" class="btn btn-sm btn-warning" title="Edit Stok">
                                                <i class="bi bi-pencil"></i> Edit Stok
                                            </a>
                                        </td>
                                    </tr>
                                <?php endforeach; ?>
                            </tbody>
                        </table>
                    </div>
                <?php endif; ?>
            </div>
        </div>
    </div>
</div>

<?php $this->endSection() ?>
