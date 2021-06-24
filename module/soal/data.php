<?php
    session_start();

    if ($_SESSION['status'] == 'admin' || $_SESSION['status'] == 'guru') { ?>
    <div class="buttons mb-4 d-flex justify-content-end">
        <button id="add-button" class="btn btn-primary mr-3">Tambah</button>
    </div>
<?php } ?>

<table border="1" cellspacing="0" cellpadding="0" id="data-table">
    <thead>
        <tr>
            <th>No.</th>
            <th>Tema</th>
            <th>Pertanyaan</th>
            <th>Aksi</th>
        </tr>
    </thead>
    <tbody>
        <?php

   require "../../inc/functions.php";
   $no=1;
   $soal = $db->get_results("SELECT soal.*, tema.nama_tema FROM soal LEFT JOIN tema ON tema.id=soal.id_tema");

    if ($soal) :
       foreach ($soal as $sl) : ?>
        <tr>
            <td><?= $no++; ?></td>
            <td><?= $sl->nama_tema; ?></td>
            <td style="width: 60ch;"><?= $sl->pertanyaan; ?></td>
            <td>
                <button type="button" class="btn btn-sm btn-primary" data-bs-toggle="modal" data-bs-target="#detailSoal<?= $sl->id ?>">
                Detail
                </button>
                <?php if ($_SESSION['status'] == 'admin' || $_SESSION['status'] == 'guru') { ?>
                    <button id="edit-button" class="btn btn-sm btn-warning" data-id="<?= $sl->id; ?>">Edit</button>
                    <button id="delete-button" class="btn btn-sm btn-danger" data-id="<?= $sl->id; ?>" data-action="soal_hapus">Hapus</button>
                <?php } ?>
            </td>
        </tr>

    <?php endforeach;
    else: ?>
        <tr><td colspan="4" style="text-align:center;">Tidak ada data</td></tr>
    <?php endif; ?>

    </tbody>
</table>


<?php
if ($soal) :
    foreach ($soal as $sl) : ?>
    <!--Basic Modal -->
    <div class="modal fade text-left" id="detailSoal<?= $sl->id ?>" tabindex="-1" role="dialog"
        aria-labelledby="detailSoal<?= $sl->id ?>Label" aria-hidden="true">
        <div class="modal-dialog modal-dialog-scrollable" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="detailSoal<?= $sl->id ?>Label">Tema: <?= $sl->nama_tema ?></h5>
                    <button type="button" class="close rounded-pill"
                        data-bs-dismiss="modal" aria-label="Close">
                        <i data-feather="x"></i>
                    </button>
                </div>
                <div class="modal-body">
                    <div class="soal-materi">
                        <!-- content materi -->
                        <?php
                        $format = $sl->content_materi ? explode('.', strtolower($sl->content_materi))[1] : '';

                        // format video
                        if ($format == 'mp4' || $format == 'webm' || $format == 'ogg' || $format == 'ogv') { ?>
                            <video width="100%" controls>
                                <source src="assets/upload/<?= $sl->content_materi ?>" type="video/mp4">
                                <source src="assets/upload/<?= $sl->content_materi ?>" type="video/webm">
                                <source src="assets/upload/<?= $sl->content_materi ?>" type="video/ogg">
                                Your browser does not support HTML video.
                            </video>

                        <?php // format image/picture
                        } elseif ($format == 'jpg' || $format == 'png' || $format == 'webp' || $format == 'gif' || $format == 'jpeg') { ?>
                            <img src="assets/upload/<?= $sl->content_materi ?>" alt="Not available" style="width: 100%; max-height: 400px; object-fit: contain;">
                        <?php } ?>

                        <!-- deskripsi materi -->
                        <div class="text-muted text-center mt-1"><?= $sl->deskripsi_materi ?></div>
                        <?= ($sl->deskripsi_materi) ? '<br>' : '' ?>
                    </div>

                    <div class="form-group">
                        <label>Pertanyaan</label>
                        <h4><?= $sl->pertanyaan ?></h4>

                        <label>Opsi Jawaban:</label>
                        <h5>a. <?= $sl->opsi_a ?></h5>
                        <h5>b. <?= $sl->opsi_b ?></h5>
                        <h5>c. <?= $sl->opsi_c ?></h5>
                        <h5>d. <?= $sl->opsi_d ?></h5>
                        <h5>e. <?= $sl->opsi_e ?></h5>

                        <label>Jawaban benar:</label>
                        <h5><?= explode('_',$sl->jawaban)[1].'. '.$sl->{$sl->jawaban} ?></h5>

                    </div>
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