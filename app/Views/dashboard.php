<?= $this->extend('layouts/main') ?>

<?= $this->section('title') ?>
    <?= $title ?? 'Dashboard' ?>
<?= $this->endSection() ?>

<?= $this->section('content') ?>
    <h1>Hallo</h1>
    <p>Halo <?= is_admin() ? 'Admin' : 'User' ?></p>
<?= $this->endSection() ?>