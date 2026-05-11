<?= $this->extend('layout/main') ?>
<?= $this->section('content') ?>

<h1>Galeri</h1>

<a href="<?= base_url('galeri') ?>" class="btn btn-secondary btn-sm">Semua</a>
<a href="?kategori=alam" class="btn btn-success btn-sm">Alam</a>
<a href="?kategori=teknologi" class="btn btn-primary btn-sm">Teknologi</a>
<a href="?kategori=hewan" class="btn btn-warning btn-sm">Hewan</a>

<div class="row mt-3">

    <?php foreach ($galeri as $g): ?>

        <div class="col-md-4 mb-3">

            <div class="card h-100">

                <img src="<?= esc($g['url_gambar']) ?>" class="card-img-top" style="height:220px; object-fit:cover;">

                <div class="card-body">

                    <h5><?= esc($g['judul']) ?></h5>

                    <p><?= truncate_text($g['deskripsi'], 40) ?></p>

                    <span class="badge bg-info">
                        <?= esc($g['kategori']) ?>
                    </span>

                </div>
            </div>
        </div>

    <?php endforeach; ?>

</div>

<?= $this->endSection() ?>