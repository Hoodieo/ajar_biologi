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
   $kelas = $db->get_results("SELECT * FROM kelas");

    if ($kelas) :
       foreach ($kelas as $kls) : ?>
        <tr>
            <td><?= $no++; ?></td>
            <td><?= $kls->kelas; ?></td>

            <?php if ($_SESSION['status'] != 'kepsek') { ?>
            <td>
                <button id="edit-button" class="btn btn-sm btn-warning" data-id="<?= $kls->id; ?>">Edit</button>
                <button id="delete-button" class="btn btn-sm btn-danger" data-id="<?= $kls->id; ?>" data-action="kelas_hapus">Hapus</button>
            </td>
            <?php } ?>
        </tr>
    <?php endforeach;
    else: ?>
        <tr><td colspan="4" style="text-align:center;">Tidak ada data</td></tr>
    <?php endif; ?>

    </tbody>
</table>

<script>
    $('#data-table').DataTable();
</script>