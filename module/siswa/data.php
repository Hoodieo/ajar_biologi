<?php
    session_start();

    if ($_SESSION['status'] != 'kepsek') { ?>
    <div class="buttons mb-4 d-flex justify-content-end">
        <button id="add-button" class="btn btn-primary mr-3">Tambah</button>
    </div>
<?php } ?>

<table border="1" cellspacing="0" cellpadding="0" id="data-table">
    <thead>
        <tr>
            <th>No.</th>
            <th>NIS</th>
            <th>Nama Siswa</th>
            <th>Tempat/Tanggal Lahir</th>
            <th>Jenis Kelamin</th>
            <th>Kelas</th>

            <?php if ($_SESSION['status'] != 'kepsek') { ?>
                <th>Aksi</th>
            <?php } ?>
        </tr>
    </thead>
    <tbody>
        <?php

   require "../../inc/functions.php";
   $no=1;
   $siswa = $db->get_results("SELECT siswa.*, kelas.kelas FROM siswa LEFT JOIN kelas ON kelas.id=siswa.id_kelas");

    if ($siswa) :
       foreach ($siswa as $sw) : ?>
        <tr>
            <td><?= $no++; ?></td>
            <td><?= $sw->nis; ?></td>
            <td><?= ucwords($sw->nama_siswa); ?></td>
            <td><?= ucwords($sw->tempat_lahir).', '.date("d M Y", strtotime($sw->tgl_lahir)); ?></td>
            <td><?= $sw->jenis_kelamin; ?></td>
            <td><?= $sw->kelas; ?></td>

            <?php if ($_SESSION['status'] != 'kepsek') { ?>
                <td>
                    <button id="edit-button" class="btn btn-sm btn-warning" data-id="<?= $sw->id; ?>">Edit</button>
                    <button id="delete-button" class="btn btn-sm btn-danger" data-id="<?= $sw->id; ?>" data-action="siswa_hapus">Hapus</button>
                </td>
            <?php } ?>
        </tr>
    <?php endforeach;
    else: ?>
        <tr><td colspan="7" style="text-align:center;">Tidak ada data</td></tr>
    <?php endif; ?>

    </tbody>
</table>

<script>
    $('#data-table').DataTable();
</script>