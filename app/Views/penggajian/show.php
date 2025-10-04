<?= $this->extend('layouts/main') ?>

<?= $this->section('content') ?>
<div class="container mt-5">
    <h1>Data gaji <?= $nama ?> </h1>
    <table class="table table-striped">
        <thead>
            <tr class="table-primary">
                <td>Nama</td>
                <td>Kategori</td>
                <td>Gaji</td>
                <td>Satuan</td>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($penggajian as $data) : ?>
                <tr>
                    <td><?= $data['nama_komponen'] ?></td>
                    <td><?= $data['kategori'] ?> </td>
                    <td><?php 
                        if($data['nama_komponen'] == "Tunjangan Anak") {
                            echo "Rp ";
                            echo number_format($data['nominal'], 2, ',', '.');
                            echo ' * ';
                            echo min(max($data['jumlah_anak'], 0), 2);
                            echo ' = Rp ';
                            echo number_format($data['nominal'] * min(max($data['jumlah_anak'], 0), 2), 2, ',', '.') ;
                        }else {
                            echo "Rp ";
                            echo number_format($data['nominal'], 2, ',', '.') ;
                        }
                        ?>
                    </td>
                    <td><?= $data['satuan'] ?></td>
                </tr>
            <?php endforeach ?>
            <tr>
                <td colspan="3" >Total Bulanan</td>
                <td> <b> Rp <?= number_format($totalBulanan, 2, ',', '.')  ?> </b></td>
            </tr>
            <tr>
                <td colspan="3">Total Periode</td>
                <td> <b> Rp <?= number_format($totalPeriode, 2, ',', '.')  ?> </b></td>
            </tr>
        </tbody>
    </table>
</div>
<?= $this->endSection() ?>
