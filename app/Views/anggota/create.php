<?= $this->extend('layouts/main') ?>

<?= $this->section('content') ?>
<div class="container mt-5">
    <h1>Create Anggota</h1>

    <?php if (session()->has('errors')) : ?>
        <div class="alert alert-danger">
            <ul>
                <?php foreach (session('errors') as $error) : ?>
                    <li><?= esc($error) ?></li>
                <?php endforeach; ?>
            </ul>
        </div>
    <?php endif; ?>

    <form action="/anggota" method="post">
        <div class="mb-3">
            <label for="id_anggota" class="form-label">ID Anggota</label>
            <input type="number" class="form-control" id="id_anggota" name="id_anggota" value="<?= old('id_anggota') ?>" >
        </div>
        <div class="mb-3">
            <label for="nama_depan" class="form-label">Nama Depan</label>
            <input type="text" class="form-control" id="nama_depan" name="nama_depan" value="<?= old('nama_depan') ?>" >
        </div>
        <div class="mb-3">
            <label for="nama_belakang" class="form-label">Nama Belakang</label>
            <input type="text" class="form-control" id="nama_belakang" name="nama_belakang" value="<?= old('nama_belakang') ?>s" >
        </div>


        <div class="mb-3">
            <label for="gelar_depan" class="form-label">Gelar Depan</label>
            <input type="text" class="form-control" id="gelar_depan" name="gelar_depan" value="<?= old('gelar_depan') ?>" >
        </div>

        <div class="mb-3">
            <label for="gelar_belakang" class="form-label">Gelar Belakang</label>
            <input type="text" class="form-control" id="gelar_belakang" name="gelar_belakang"   value="<?= old('gelar_belakang') ?>" >
        </div>


        <div class="mb-3">
            <div class="mb-3">
                <label for="jabatan">Pilih jabatan</label>
                <select class="form-select" name="jabatan" id="jabatan">
                    <option selected value="">Jabatan</option>
                    <option value="Ketua">Ketua</option>
                    <option value="Wakil Ketua">Wakil Ketua</option>
                    <option value="Anggota">Anggota</option>
                </select>
            </div>
        </div>


        <div class="mb-3">
            <label for="status_pernikahan">Pilih status pernikahan</label>
            <select class="form-select" name="status_pernikahan" id="status_pernikahan">
                <option selected value="">Status Pernikahan</option>
                <option value="Kawin">Kawin</option>
                <option value="Belum Kawin">Belum Kawin</option>
                <option value="Cerai Hidup">Cerai Hidup</option>
                <option value="Cerai Mati">Cerai Mati</option>
            </select>
        </div>

        <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#createModal">
            Create
        </button>

        <!-- Create Modal -->
        <div class="modal fade" id="createModal" tabindex="-1" aria-labelledby="createModalLabel" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="createModalLabel">Confirm Creation</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        Are you sure you want to create this item?
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                        <button type="submit" class="btn btn-primary">Create</button>
                    </div>
                </div>
            </div>
        </div>
    </form>
</div>
<?= $this->endSection() ?>