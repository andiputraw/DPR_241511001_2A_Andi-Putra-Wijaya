<?= $this->extend('layouts/main') ?>

<?= $this->section('content') ?>
<div class="container mt-5">
    <h1>Create Komponen Gaji</h1>

    <?php if (session()->has('errors')) : ?>
        <div class="alert alert-danger">
            <ul>
                <?php foreach (session('errors') as $error) : ?>
                    <li><?= esc($error) ?></li>
                <?php endforeach; ?>
            </ul>
        </div>
    <?php endif; ?>

    <form action="/komponen-gaji/<?= $data['id_komponen_gaji'] ?>" method="post">
        <input type="hidden" name="_method" value="PUT" >
        <div class="mb-3">
            <label for="id_komponen_gaji" class="form-label">ID Komponen Gaji</label>
            <input type="number" class="form-control" id="id_komponen_gaji" name="id_komponen_gaji" value="<?= old('id_komponen_gaji') ?? $data['id_komponen_gaji'] ?>" >
        </div>
        <div class="mb-3">
            <label for="nama_komponen" class="form-label">Nama Komponen</label>
            <input type="text" class="form-control" id="nama_komponen" name="nama_komponen" value="<?= old('nama_komponen') ?? $data['nama_komponen'] ?>" >
        </div>
        <div class="mb-3">
            <label for="nominal" class="form-label">Nominal</label>
            <input type="number" class="form-control" id="nominal" name="nominal" value="<?=  old('nominal') ?? $data['nominal'] ?>" >
        </div>



        <div class="mb-3">
            <div class="mb-3">
                <label for="kategori">Pilih kategori</label>
                <select class="form-select" name="kategori" id="kategori">
                    <?php foreach (['Gaji Pokok', 'Tunjangan Melekat', 'Tunjangan Lain'] as $value): ?>
                        <option <?= $value == $data['kategori'] ? 'selected' : '' ?> value="<?= $value ?>"><?= $value ?></option>
                    <?php endforeach ?>
                </select>
            </div>
        </div>


        <div class="mb-3">  
            <label for="satuan">Pilih satuan</label>
            <select class="form-select" name="satuan" id="satuan">
                  <?php foreach (['Periode' , 'Bulan', 'Hari'] as $value): ?>
                        <option <?= $value == $data['satuan'] ? 'selected' : '' ?> value="<?= $value ?>"><?= $value ?></option>
                    <?php endforeach ?>
            </select>
        </div>


        <div class="mb-3">
            <div class="mb-3">
                <label for="jabatan">Pilih jabatan</label>
                <select class="form-select" name="jabatan" id="jabatan">
                      <?php foreach (['Ketua', 'Wakil Ketua', 'Anggota', 'Semua'] as $value): ?>
                        <option <?= $value == $data['jabatan'] ? 'selected' : '' ?> value="<?= $value ?>"><?= $value ?></option>
                    <?php endforeach ?>
                </select>
            </div>
        </div>

        <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#updateModal">
            Update
        </button>

        <!-- Create Modal -->
        <div class="modal fade" id="updateModal" tabindex="-1" aria-labelledby="updateModalLabel" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="updateModalLabel">Confirm Creation</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        Are you sure you want to update this item?
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                        <button type="submit" class="btn btn-primary">Submit</button>
                    </div>
                </div>
            </div>
        </div>
    </form>
</div>
<?= $this->endSection() ?>