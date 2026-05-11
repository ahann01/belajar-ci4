<?php if (!empty($msg)): ?>

    <div class="alert alert-<?= esc($type ?? 'info') ?> alert-dismissible fade show">

        <?= esc($msg) ?>

        <button type="button" class="btn-close" data-bs-dismiss="alert"></button>

    </div>

<?php endif; ?>