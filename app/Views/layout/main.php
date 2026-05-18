<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title><?= isset($title) ? esc($title) . ' - MyApp' : 'MyApp' ?></title>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">

    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.0/font/bootstrap-icons.css" rel="stylesheet">

    <link rel="stylesheet" href="<?= base_url('assets/css/custom.css') ?>">
</head>

<body>

    <!-- NAVBAR -->
    <nav class="navbar navbar-expand-lg navbar-dark bg-primary shadow-sm">
        <div class="container">

            <a class="navbar-brand" href="<?= base_url('/') ?>">
                <i class="bi bi-book"></i> PerpustakaanKu
            </a>

            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navMenu">
                <span class="navbar-toggler-icon"></span>
            </button>

            <div class="collapse navbar-collapse" id="navMenu">

                <ul class="navbar-nav me-auto">

                    <!-- BERANDA -->
                    <li class="nav-item">
                        <a class="nav-link <?= current_url() == base_url('/') ? 'active' : '' ?>"
                            href="<?= base_url('/') ?>">
                            <i class="bi bi-house"></i> Beranda
                        </a>
                    </li>

                    <!-- BUKU -->
                    <li class="nav-item">
                        <a class="nav-link <?= str_contains(current_url(), 'buku') ? 'active' : '' ?>"
                            href="<?= base_url('buku') ?>">
                            <i class="bi bi-journals"></i> Buku
                        </a>
                    </li>

                    <!-- KATEGORI -->
                    <li class="nav-item">
                        <a class="nav-link <?= str_contains(current_url(), 'kategori') ? 'active' : '' ?>"
                            href="<?= base_url('kategori') ?>">
                            <i class="bi bi-tag"></i> Kategori
                        </a>
                    </li>

                    <!-- PROFIL -->
                    <li class="nav-item">
                        <a class="nav-link <?= str_contains(current_url(), 'profil') ? 'active' : '' ?>"
                            href="<?= base_url('profil') ?>">
                            <i class="bi bi-person"></i> Profil
                        </a>
                    </li>

                    <!-- GALERI -->
                    <li class="nav-item">
                        <a class="nav-link <?= str_contains(current_url(), 'galeri') ? 'active' : '' ?>"
                            href="<?= base_url('galeri') ?>">
                            <i class="bi bi-images"></i> Galeri
                        </a>
                    </li>

                    <!-- TENTANG -->
                    <li class="nav-item">
                        <a class="nav-link <?= str_contains(current_url(), 'tentang') ? 'active' : '' ?>"
                            href="<?= base_url('tentang') ?>">
                            <i class="bi bi-info-circle"></i> Tentang
                        </a>
                    </li>

                </ul>

                <div class="navbar-nav">

                    <?php if (session()->get('logged_in')): ?>

                        <div class="nav-item dropdown">
                            <a class="nav-link dropdown-toggle text-light" href="#" id="navbarDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                                <i class="bi bi-person-circle"></i> <?= esc(is_string(session()->get('nama')) ? session()->get('nama') : '') ?>
                            </a>
                            <ul class="dropdown-menu dropdown-menu-end" aria-labelledby="navbarDropdown">
                                <li>
                                    <a class="dropdown-item" href="<?= base_url('akun/ganti-password') ?>">
                                        <i class="bi bi-key"></i> Ganti Password
                                    </a>
                                </li>
                                <li>
                                    <hr class="dropdown-divider">
                                </li>
                                <li>
                                    <a class="dropdown-item text-danger" href="<?= base_url('logout') ?>">
                                        <i class="bi bi-box-arrow-right"></i> Logout
                                    </a>
                                </li>
                            </ul>
                        </div>

                    <?php else: ?>

                        <a class="btn btn-outline-light btn-sm"
                            href="<?= base_url('login') ?>">
                            <i class="bi bi-box-arrow-in-right"></i> Login
                        </a>

                    <?php endif; ?>

                </div>

            </div>
        </div>
    </nav>

    <!-- KONTEN -->
    <main class="container py-4">

        <?php if (session()->getFlashdata('sukses')): ?>
            <div class="alert alert-success alert-dismissible fade show">
                <?= esc(is_string(session()->getFlashdata('sukses')) ? session()->getFlashdata('sukses') : '') ?>
                <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
            </div>
        <?php endif; ?>

        <?php if (session()->getFlashdata('error')): ?>
            <div class="alert alert-danger alert-dismissible fade show">
                <?= esc(is_string(session()->getFlashdata('error')) ? session()->getFlashdata('error') : '') ?>
                <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
            </div>
        <?php endif; ?>

        <?= $this->renderSection('content') ?>

    </main>

    <!-- FOOTER -->
    <footer class="py-4 mt-5 bg-dark text-light">
        <div class="container">
            <div class="row">

                <div class="col-md-6">
                    <h5><i class="bi bi-book"></i> PerpustakaanKu</h5>
                    <p class="text-muted">Sistem Informasi Perpustakaan Digital</p>
                </div>

                <div class="col-md-6 text-md-end">
                    <p class="text-muted mb-1">Dibangun dengan CodeIgniter 4</p>
                    <p class="text-muted">&copy; <?= date('Y') ?> Praktikum Pemrograman Web 2</p>
                </div>

            </div>
        </div>
    </footer>

    <!-- BOOTSTRAP JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>

    <!-- SECTION SCRIPT KHUSUS HALAMAN -->
    <?= $this->renderSection('scripts') ?>

</body>

</html>