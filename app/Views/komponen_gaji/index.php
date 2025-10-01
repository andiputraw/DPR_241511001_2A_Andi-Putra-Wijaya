<?= $this->extend('layouts/main') ?>

<?= $this->section('content') ?>
<div class="container mt-5">
    <h1>List Komponen Gaji</h1>
    <?php if (is_admin()) : ?>
        <a href="/komponen-gaji/new" class="btn btn-primary mb-3">New Komponen Gaji</a>
    <?php endif; ?>
    <table class="table table-bordered">
        <thead>
            <tr>
                <th>ID</th>
                <th>Nama Komponen</th>
                <th>Nama Kategori</th>
                <th>Jabatan</th>
                <th>Nominal</th>
                <th>Satuan</th>

                <?php if (is_admin()) : ?>
                    <th>Actions</th>
                <?php endif; ?>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($datas as $data): ?>
                <tr>
                    <td><?= $data['id_komponen_gaji'] ?></td>
                    <td> <a href="/komponen-gaji/<?= $data['id_komponen_gaji'] ?>"><?= $data['nama_komponen'] ?></a> </td>
                    <td><?= $data['kategori'] ?></td>
                    <td><?= $data['jabatan'] ?></td>
                    <td>Rp. <?= number_format($data['nominal'], 2, ',', '.')  ?></td>
                    <td><?= $data['satuan'] ?></td>

                    <!-- Aksi -->
                    <?php if (is_admin()) : ?>
                        <td>
                            <a href="/komponen-gaji/<?= $data['id_komponen_gaji'] ?>/edit" class="btn btn-sm btn-warning">Edit</a>
                            <button type="button" class="btn btn-sm btn-danger" data-bs-toggle="modal" data-bs-target="#deleteModal-<?= $data['id_komponen_gaji'] ?>">
                                Delete
                            </button>

                            <!-- Delete Modal -->
                            <div class="modal fade" id="deleteModal-<?= $data['id_komponen_gaji'] ?>" tabindex="-1" aria-labelledby="deleteModalLabel-<?= $data['id_komponen_gaji'] ?>" aria-hidden="true">
                                <div class="modal-dialog">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <h5 class="modal-title" id="deleteModalLabel-<?= $data['id_komponen_gaji'] ?>">Confirm Deletion</h5>
                                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                        </div>
                                        <div class="modal-body">
                                            Are you sure you want to delete this item?
                                        </div>
                                        <div class="modal-footer">
                                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                                            <form action="/komponen-gaji/<?= $data['id_komponen_gaji'] ?>" method="post">
                                                <input type="hidden" name="_method" value="DELETE">
                                                <button type="submit" class="btn btn-danger">Delete</button>
                                            </form>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </td>
                    <?php endif; ?>
                </tr>
            <?php endforeach; ?>
        </tbody>
    </table>
</div>
<?= $this->endSection() ?>