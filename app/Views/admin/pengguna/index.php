<?= $this->extend('layout/main') ?>
<?= $this->section('content') ?>

<?php
/**
 * @var \CodeIgniter\View\View $this
 * @var array $pengguna
 */
?>

<div class="d-flex justify-content-between align-items-center mb-4">
    <h2><i class="bi bi-people"></i> Manajemen Pengguna</h2>
</div>

<?php if (session()->getFlashdata('sukses')) : ?>
    <div class="alert alert-success alert-dismissible fade show" role="alert">
        <?= session()->getFlashdata('sukses') ?>
        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
    </div>
<?php endif; ?>

<?php if (session()->getFlashdata('error')) : ?>
    <div class="alert alert-danger alert-dismissible fade show" role="alert">
        <?= session()->getFlashdata('error') ?>
        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
    </div>
<?php endif; ?>

<div class="card">
    <div class="card-body p-0">
        <div class="table-responsive">
            <table class="table table-hover table-striped mb-0">
                <thead class="table-light">
                    <tr>
                        <th>No</th>
                        <th>Username</th>
                        <th>Nama Lengkap</th>
                        <th>Email</th>
                        <th>Role</th>
                        <th>Status</th>
                        <th>Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    <?php $no = 1;
                    foreach ($pengguna as $u) : ?>
                        <tr>
                            <td><?= $no++ ?></td>
                            <td><?= esc($u['username']) ?></td>
                            <td><?= esc($u['nama_lengkap']) ?></td>
                            <td><?= esc($u['email']) ?></td>
                            <td>
                                <!-- Form Ubah Role -->
                                <form action="<?= base_url('admin/pengguna/ubah-role/' . $u['id']) ?>" method="post" class="d-inline">
                                    <?= csrf_field() ?>
                                    <div class="input-group input-group-sm" style="width: 150px;">
                                        <select name="role" class="form-select" <?= $u['id'] == session()->get('user_id') ? 'disabled' : '' ?>>
                                            <option value="admin" <?= $u['role'] === 'admin' ? 'selected' : '' ?>>Admin</option>
                                            <option value="petugas" <?= $u['role'] === 'petugas' ? 'selected' : '' ?>>Petugas</option>
                                            <option value="anggota" <?= $u['role'] === 'anggota' ? 'selected' : '' ?>>Anggota</option>
                                        </select>
                                        <?php if ($u['id'] != session()->get('user_id')) : ?>
                                            <button class="btn btn-outline-secondary" type="submit" title="Simpan Role">
                                                <i class="bi bi-check2"></i>
                                            </button>
                                        <?php endif; ?>
                                    </div>
                                </form>
                            </td>
                            <td>
                                <?php if ($u['aktif']) : ?>
                                    <span class="badge bg-success">Aktif</span>
                                <?php else : ?>
                                    <span class="badge bg-danger">Nonaktif</span>
                                <?php endif; ?>
                            </td>
                            <td>
                                <!-- Tombol Toggle Aktif -->
                                <?php if ($u['id'] != session()->get('user_id')) : ?>
                                    <form action="<?= base_url('admin/pengguna/toggle-aktif/' . $u['id']) ?>" method="post" class="d-inline">
                                        <?= csrf_field() ?>
                                        <button type="submit" class="btn btn-sm <?= $u['aktif'] ? 'btn-warning' : 'btn-success' ?>" title="<?= $u['aktif'] ? 'Nonaktifkan Akun' : 'Aktifkan Akun' ?>">
                                            <i class="bi <?= $u['aktif'] ? 'bi-x-circle' : 'bi-check-circle' ?>"></i>
                                            <?= $u['aktif'] ? 'Nonaktifkan' : 'Aktifkan' ?>
                                        </button>
                                    </form>
                                <?php else : ?>
                                    <button class="btn btn-sm btn-secondary" disabled title="Anda tidak bisa menonaktifkan akun sendiri">
                                        <i class="bi bi-shield-lock"></i> Sendiri
                                    </button>
                                <?php endif; ?>
                            </td>
                        </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
        </div>
    </div>
</div>

<?php $this->endSection(); ?>