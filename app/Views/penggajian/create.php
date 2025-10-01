<?= $this->extend('layouts/main') ?>

<?= $this->section('content') ?>
<div class="container mt-5">
    <h1>Create New Penggajian</h1>

    <?php if (session()->has('errors')) : ?>
        <div class="alert alert-danger">
            <ul>
                <?php foreach (session('errors') as $error) : ?>
                    <li><?= esc($error) ?></li>
                <?php endforeach; ?>
            </ul>
        </div>
    <?php endif; ?>

    <form action="/penggajian" method="post">
        <div class="mb-3" id="head">
            <label for="id_anggota" class="form-label">Anggota</label>
            <select class="form-select" name="id_anggota" id="id_anggota">
                    <option selected value="">Pilih Anggota</option>
                    <?php foreach ($anggota as $anggota) : ?>
                        <option value="<?= $anggota['id_anggota'] ?>"><?= $anggota['nama_depan'] . ' ' . $anggota['nama_belakang'] ?></option>
                    <?php endforeach ?>
            </select>
        </div>

        <button type="button" class="btn btn-secondary" id="tambahKomponenGaji" >
            Tambah Komponen Gaji
        </button>
  
        

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

<script>
    const btnTambahGaji = document.getElementById('tambahKomponenGaji')
    const head = document.getElementById('head')
    const anggota =  document.getElementById('id_anggota')
    
    let listKategori = [];

    anggota.addEventListener('change', async () => {
        const res = await fetch('/penggajian/komponen/' + anggota.value).then(res => res.json())
        anggota.setAttribute('readonly', 'readonly')
        console.log(res)
        listKategori = res
    })
    btnTambahGaji.addEventListener('click', () => {
        if(listKategori.length <= 0 ) return;
        const d = document.createElement('div')
        // <div class="mb-3">
        d.setAttribute('class', 'mb-3')
        d.innerHTML = `
            <select class="form-select" name="penggajian[]">
                    <option selected value="">Pilih Gaji</option>
                    ${listKategori.map(k => `<option value="${k.id_komponen_gaji}">${k.nama_komponen}</option>`).join('')}
            </select>
        `
        head.insertAdjacentElement('afterend', d)
    })
</script>
<?= $this->endSection() ?>