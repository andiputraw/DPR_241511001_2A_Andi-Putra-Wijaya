<?= $this->extend('layouts/main') ?>

<?= $this->section('content') ?>
<div class="container mt-5">
    <h1>List Komponen Gaji</h1>
    <?php if (is_admin()) : ?>
        <a href="/komponen-gaji/new" class="btn btn-primary mb-3">New Komponen Gaji</a>
    <?php endif; ?>
     <form action="" method="get">
        <div class="input-group mb-3">
            <input type="text" id="keyword" class="form-control" name="keyword"  placeholder="Cari..." aria-label="Search" >
            <script>
                const keyword = document.getElementById('keyword');
                const url = new URL(location.href);
                keyword.value = url.searchParams.get('keyword');
            </script>
            <button class="btn btn-outline-primary" type="button">
                <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-search" viewBox="0 0 16 16">
                    <path d="M11.742 10.344a6.5 6.5 0 1 0-1.397 1.398h-.001c.03.04.062.078.098.115l3.85 3.85a1 1 0 0 0 1.415-1.414l-3.85-3.85a1.007 1.007 0 0 0-.115-.1zM12 6.5a5.5 5.5 0 1 1-11 0 5.5 5.5 0 0 1 11 0z" />
                </svg>
            </button>
        </div>
    </form>
    <div class="table-responsive ">
    <table class="table table-bordered table-striped">
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
</div>
<?= $this->endSection() ?>