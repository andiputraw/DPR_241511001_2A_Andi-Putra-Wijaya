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

    <form action="/penggajian/<?= $anggota['id_anggota'] ?>" method="post">
        <input type="hidden" name="_method" value="PUT">
        <div class="mb-3">
            <label for="id_anggota" class="form-label">Anggota</label>
            <select class="form-select" name="id_anggota" id="id_anggota" disabled>
                <option selected value="<?= $anggota['id_anggota'] ?>"><?= $anggota['nama_depan'] . ' ' . $anggota['nama_belakang'] ?></option>
            </select>
        </div>
        <?php foreach ($penggajian as $penggajian) : ?>
            <div class="mb-3">
                <div class="input-group">
                    <select class="form-select" name="penggajian[]">
                        <option selected value="<?= $penggajian['id_komponen_gaji'] ?>"><?= $penggajian['nama_komponen'] ?></option>
                    </select>
                    <button class="btn btn-danger delete-komponen-button" type="button"> <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="lucide lucide-trash2-icon lucide-trash-2">
                            <path d="M10 11v6" />
                            <path d="M14 11v6" />
                            <path d="M19 6v14a2 2 0 0 1-2 2H7a2 2 0 0 1-2-2V6" />
                            <path d="M3 6h18" />
                            <path d="M8 6V4a2 2 0 0 1 2-2h4a2 2 0 0 1 2 2v2" />
                        </svg> </button>
                </div>
            </div>
        <?php endforeach ?>
        <div id="head"></div>


        <button type="button" class="btn btn-secondary" id="tambahKomponenGaji">
            Tambah Komponen Gaji
        </button>



        <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#createModal">
            Update
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

<script>
    const btnTambahGaji = document.getElementById('tambahKomponenGaji')
    const head = document.getElementById('head')
    const anggota = document.getElementById('id_anggota')

    let listKategori = [];

    function getSelectedKomponenPenggajian() {
        return Array.from(document.querySelectorAll('select[name="penggajian[]"]')).map(s => s.value)
    }

    const deleteKomponenPenggajian = function(e) {
        /** @type {HTMLButtonElement} */
        let self = this;
        
        self.closest('.input-group').remove();
    };

    const populateDataPenggajian = function(e) {
        
        /**@type {HTMLSelectElement} */
        const self = this
        const nonSelectedOptions = self.querySelectorAll('option:not([selected])')
        
        nonSelectedOptions.forEach(opt => {
            if(opt.value == this.value) return
            opt.remove()
        })
        for (const k of listKategori.filter(k => !getSelectedKomponenPenggajian().includes(k.id_komponen_gaji))) {
            const opt = document.createElement('option')
            opt.value = k.id_komponen_gaji
            opt.innerText = k.nama_komponen
            self.appendChild(opt)
        }
    };

    (async () => {
        const res = await fetch('/penggajian/komponen/' + anggota.value).then(res => res.json())
        anggota.setAttribute('readonly', 'readonly')
        console.log(res)
        listKategori = res
        // initialize selects
        document.querySelectorAll('select[name="penggajian[]"]').forEach(d => {

            const btns = document.querySelectorAll('.delete-komponen-button')
            
            btns.forEach(btn => {
                btn.addEventListener('click', deleteKomponenPenggajian)
            })
            
            d.addEventListener('mouseover', populateDataPenggajian)
            
        })
    })()

    btnTambahGaji.addEventListener('click', () => {

        if (listKategori.length <= 0) return;
        const d = document.createElement('div')
        // <div class="mb-3">
        d.setAttribute('class', 'mb-3')
        d.innerHTML = `
        <div class="input-group" >
            <select class="form-select" name="penggajian[]">
                    <option selected value="">Pilih Gaji</option>
                    
                            </select>
                            <button class="btn btn-danger delete-komponen-button" type="button" > <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="lucide lucide-trash2-icon lucide-trash-2"><path d="M10 11v6"/><path d="M14 11v6"/><path d="M19 6v14a2 2 0 0 1-2 2H7a2 2 0 0 1-2-2V6"/><path d="M3 6h18"/><path d="M8 6V4a2 2 0 0 1 2-2h4a2 2 0 0 1 2 2v2"/></svg> </button>
                            </div>
        `
        head.insertAdjacentElement('beforebegin', d)

        const selects = d.querySelectorAll('select[name="penggajian[]"]')
        selects.forEach(s => {
            s.addEventListener('mouseover', populateDataPenggajian)
        })

        const btns = d.querySelectorAll('.delete-komponen-button')

        btns.forEach(btn => {

            btn.addEventListener('click', deleteKomponenPenggajian)
        })

    })
</script>
<?= $this->endSection() ?>