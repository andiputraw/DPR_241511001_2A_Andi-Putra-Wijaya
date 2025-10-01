<?= $this->extend('layouts/main') ?>

<?= $this->section('content') ?>
<div class="container mt-5">
    <h1>Mata Kuliah Details</h1>
    <div class="card">
        <div class="card-header">
            <h3><?= $mata_kuliah['name'] ?></h3>
        </div>
        <div class="card-body">
            <p><strong>Credits:</strong> <?= $mata_kuliah['credits'] ?></p>
        </div>
        <div class="card-footer">
            <a href="/mata-kuliah" class="btn btn-primary">Back to List</a>
        </div>
    </div>
</div>
<?= $this->endSection() ?>
