<?= $this->extend('layout/main') ?>
<?= $this->section('content') ?>

<div class='row justify-content-center mt-3'>
    <div class='col-md-5 col-lg-4'>
        <div class='card shadow'>
            <div class='card-header bg-primary text-white text-center py-3'>
                <h4 class='mb-0'><i class='bi bi-key'></i> Ganti Password</h4>
            </div>
            <div class='card-body p-4'>

                <?php
                $sessionErrors = session()->getFlashdata('errors');
                $errors = is_array($sessionErrors) ? $sessionErrors : [];
                $singleError = session()->getFlashdata('error');
                if (is_string($singleError)) {
                    $errors[] = $singleError;
                }
                ?>

                <?php if (!empty($errors)): ?>
                    <div class='alert alert-danger py-2'>
                        <?php foreach ($errors as $e): ?>
                            <div><i class='bi bi-x-circle'></i> <?= esc($e) ?></div>
                        <?php endforeach; ?>
                    </div>
                <?php endif; ?>

                <form action='<?= base_url('akun/proses-ganti-password') ?>' method='post'>
                    <?= csrf_field() ?>

                    <div class='mb-3'>
                        <label class='form-label fw-bold'>Password Lama</label>
                        <div class='input-group'>
                            <span class='input-group-text'><i class='bi bi-lock'></i></span>
                            <input type='password' name='password_lama' class='form-control' placeholder='Password Lama' required autofocus>
                        </div>
                    </div>

                    <div class='mb-3'>
                        <label class='form-label fw-bold'>Password Baru</label>
                        <div class='input-group'>
                            <span class='input-group-text'><i class='bi bi-shield-lock'></i></span>
                            <input type='password' name='password_baru' class='form-control' placeholder='Minimal 8 karakter' required minlength="8">
                        </div>
                    </div>

                    <div class='mb-3'>
                        <label class='form-label fw-bold'>Konfirmasi Password Baru</label>
                        <div class='input-group'>
                            <span class='input-group-text'><i class='bi bi-shield-check'></i></span>
                            <input type='password' name='konfirmasi_password' class='form-control' placeholder='Ulangi password baru' required minlength="8">
                        </div>
                    </div>

                    <button type='submit' class='btn btn-primary w-100 py-2'>
                        <i class='bi bi-save'></i> Simpan Password
                    </button>

                    <a href="<?= base_url('/') ?>" class="btn btn-secondary w-100 mt-2">Batal</a>
                </form>
            </div>
        </div>
    </div>
</div>

<?= $this->endSection() ?>