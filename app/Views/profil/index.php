<?= $this->extend('layout/main') ?>
<?= $this->section('content') ?>

<?php
if ($ipk >= 3.5) {
    $badge = 'success';
} elseif ($ipk >= 3.0) {
    $badge = 'warning';
} else {
    $badge = 'danger';
}
?>

<div class="card">
    <div class="card-body">

        <h2><?= esc($nama) ?></h2>

        <table class="table">

            <tr>
                <td>NPM</td>
                <td><?= esc($npm) ?></td>
            </tr>

            <tr>
                <td>Program Studi</td>
                <td><?= esc($prodi) ?></td>
            </tr>

            <tr>
                <td>Angkatan</td>
                <td><?= esc($angkatan) ?></td>
            </tr>

            <tr>
                <td>IPK</td>
                <td>
                    <span class="badge bg-<?= $badge ?>">
                        <?= esc($ipk) ?>
                    </span>
                </td>
            </tr>

        </table>

        <h4>Mata Kuliah</h4>

        <ul>
            <?php foreach ($matkul as $m): ?>
                <li><?= esc($m) ?></li>
            <?php endforeach; ?>
        </ul>

    </div>
</div>

<?= $this->endSection() ?>