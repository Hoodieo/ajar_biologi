<?php
    session_start();

    if ($_SESSION['status'] == 'wakepsek' || $_SESSION['status'] == 'guru' || $_SESSION['status'] == 'admin') { ?>
    <div class="buttons mb-4 d-flex justify-content-end">
        <button id="add-button" class="btn btn-primary mr-3">Tambah</button>
    </div>
<?php } ?>

<table border="1" cellspacing="0" cellpadding="0" id="data-table">
    <thead>
        <tr>
            <th>No.</th>
            <th>Tema</th>
            <th>Judul Materi</th>
            <th>Aksi</th>
        </tr>
    </thead>
    <tbody>
        <?php

   require "../../inc/functions.php";
   $no=1;
   $materi = $db->get_results("SELECT materi.*, tema.nama_tema FROM materi LEFT JOIN tema ON materi.id_tema=tema.id ORDER BY id ASC");

    if ($materi) :
       foreach ($materi as $mtr) :
       ?>
        <tr>
            <td><?= $no++; ?></td>
            <td><?= $mtr->nama_tema; ?></td>
            <td><?= $mtr->judul_materi; ?></td>
            <td>
                <button type="button" class="btn btn-sm btn-secondary" data-bs-toggle="modal" data-bs-target="#modalMateri<?=$mtr->id?>">Preview</button>
                <a href="assets/upload/<?=$mtr->content?>" class="btn btn-sm btn-primary" download>Download</a>

                <?php if ($_SESSION['status'] == 'wakepsek' || $_SESSION['status'] == 'guru' || $_SESSION['status'] == 'admin') : ?>
                <button id="edit-button" class="btn btn-sm btn-warning" data-id="<?= $mtr->id; ?>">Edit</button>
                <button id="delete-button" class="btn btn-sm btn-danger" data-id="<?= $mtr->id; ?>" data-action="materi_hapus">Hapus</button>
                <?php endif; ?>
            </td>
        </tr>
    <?php endforeach;
    else: ?>
        <tr><td colspan="4" style="text-align:center;">Tidak ada data</td></tr>
    <?php endif; ?>

    </tbody>
</table>

<?php
if ($materi) :
       foreach ($materi as $mtr) :
       ?>

<div class="modal fade text-left" id="modalMateri<?=$mtr->id?>" tabindex="-1" role="dialog" aria-labelledby="myModalMateri<?=$mtr->id?>" aria-hidden="true">
    <div class="modal-dialog modal-dialog-scrollable modal-lg
    " role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="myModalMateri<?=$mtr->id?>">Materi: <?=$mtr->judul_materi?></h5>
                <button type="button" class="close rounded-pill"
                    data-bs-dismiss="modal" aria-label="Close">
                    <i data-feather="x"></i>
                </button>
            </div>
            <div class="modal-body">
                    <h5 class="text-muted">Tema : <?=$mtr->nama_tema?>
                    <h5 class="text-muted">Deskripsi Materi : <?=($mtr->deskripsi) ? $mtr->deskripsi : '-' ?></h5>

                <embed src="assets/upload/<?=$mtr->content?>" type="application/pdf" width="100%" height="600px" navpans='0'>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn" data-bs-dismiss="modal">
                    <i class="bx bx-x d-block d-sm-none"></i>
                    <span class="d-none d-sm-block">Tutup</span>
                </button>
            </div>
        </div>
    </div>
</div>
    <?php endforeach;
endif; ?>

<script>
    $('#data-table').DataTable();
</script>