<?php 
// dd($listvendor)jenis_vendor;

?>
<table id="table-style-hover" data-show-export="true" class="table table-striped table-hover table-bordered nowrap">
    <thead>
        <tr>
            <th>NO</th>
            <th>AKSI</th>
            <th>FOTO</th>
            <th>Email</th>
            <th>Nama</th>
            <th>Tanggal Lahir</th>
            <th>Gaji</th>
            <th>Status Karyawan</th>
        </tr>
    </thead>
    <tbody>
        <?php 
            $no =1;
            foreach ($listkaryawan as $key) {
                if ($key['status_karyawan']==0) {
                    $status_karyawan = "TIDAK AKTIF";
                }else{
                    $status_karyawan = "AKTIF";
                }
            ?>
            <tr>
                <td><?= $no++; ?></td>
                <td>
                    <button type="button" class="btn btn-danger btn-sm" onclick="hapus_karyawan('<?=$key['id']?>')">Hapus</button>
                    <button type="button" class="btn btn-warning btn-sm" onclick="fmenu('Tambah Karyawan','<?=$key['id']?>')">Edit</button>
                </td>
                <td>
                    <img src="upload/<?= $key['fotonya'] ?>" alt="foto" style="width: 100px; widtg: 200px;">
                </td>
                <td><?= $key['email'] ?></td>
                <td><?= $key['nama'] ?></td>
                <td><?= $key['tanggal_lahir'] ?></td>
                <td style="text-align: right;">Rp. <?= number_format($key['gaji']) ?></td>
                <td><?= $status_karyawan ?></td>
            </tr>
        <?php
            }
        ?>

    </tbody>

</table>