<?= $this->extend('layouts/main') ?>

<?= $this->section('content') ?>
<div class="container mt-5">
    <h1>List Penggajian</h1>
    <?php if (is_admin()) : ?>
        <a href="/penggajian/new" class="btn btn-primary mb-3">New Penggajian</a>
    <?php endif; ?>
    <table class="table table-bordered">
        <thead>
            <tr>
                <th>ID Anggota</th>
                <th>Gelar Depan</th>
                <th>Nama Depan</th>
                <th>Nama Belakang</th>
                <th>Gelar Belakang</th>
                <th>Jabatan</th>
                <th>Take Home Pay per Bulan</th>
                <th>Take Home Pay per Periode</th>


                <?php if (is_admin()) : ?>
                    <th>Actions</th>
                <?php endif; ?>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($datas as $data): ?>
                <tr>
                    <td> <a href="/penggajian/<?= $data['id_anggota'] ?>"> <?= $data['id_anggota'] ?> </a></td>
                    <td> <?= $data['gelar_depan'] ?> </td>
                    <td><?= $data['nama_depan'] ?></td>
                    <td><?= $data['nama_belakang'] ?></td>

                    <td><?= $data['gelar_belakang'] ?></td>
                    
                    <td><?= $data['jabatan'] ?></td>
                    <td>Rp. <?= number_format($data['take_home_pay_monthly'], 2, ',', '.')  ?></td>
                    <td>Rp. <?= number_format($data['take_home_pay_periode'], 2, ',', '.')  ?></td>

                    <!-- Aksi -->
                    <?php if (is_admin()) : ?>
                        <td>
                            <a href="/penggajian/<?= $data['id_anggota'] ?>/edit" class="btn btn-sm btn-warning">Edit</a>
                            <button type="button" class="btn btn-sm btn-danger" data-bs-toggle="modal" data-bs-target="#deleteModal-<?= $data['id_anggota'] ?>">
                                Delete
                            </button>

                            <!-- Delete Modal -->
                            <div class="modal fade" id="deleteModal-<?= $data['id_anggota'] ?>" tabindex="-1" aria-labelledby="deleteModalLabel-<?= $data['id_anggota'] ?>" aria-hidden="true">
                                <div class="modal-dialog">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <h5 class="modal-title" id="deleteModalLabel-<?= $data['id_anggota'] ?>">Confirm Deletion</h5>
                                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                        </div>
                                        <div class="modal-body">
                                            Are you sure you want to delete this item?
                                        </div>
                                        <div class="modal-footer">
                                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                                            <form action="/penggajian/<?= $data['id_anggota'] ?>" method="post">
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