<?php
    $where = '';
    if (isset($_GET['id_tema']) && ($_GET['id_tema'] != 'semua')) {
        $where = 'WHERE id_tema='.$_GET['id_tema'];
    }

    $soal = $db->get_results("SELECT soal.*, tema.nama_tema FROM soal
    LEFT JOIN tema ON soal.id_tema=tema.id $where
    ORDER BY soal.id_tema, soal.id");
?>

<div class="page-heading">
    <h3><?= ($_GET['id_tema'] == 'semua') ? 'Laporan Soal' : 'Laporan Soal Tema '.$soal[0]->nama_tema; ?></h3>
</div>
<div class="alert-container"></div>

<div class="page-content">
    <section class="row">
        <div class="col-12">
            <div class="card">
                <div id="content-data" class="card-body">

<div class="buttons mb-4 d-flex justify-content-between">
    <a href="index?m=report" class="btn btn-outline-secondary">Kembali</a>
    <div>
    <a href="module/report_soal/excel?id_tema=<?= $_GET['id_tema'] ?>&export_excel=true" class="btn btn-primary mr-3">Export Excel</a>
    <!-- <a href="module/report_soal/report?id_tema=<?= $_GET['id_tema'] ?>" class="btn btn-primary mr-3">Cetak</a> -->
    </div>
</div>

<table border="1" cellspacing="0" cellpadding="0" id="data-table" class="table">
    <thead>
        <tr>
            <th>No.</th>
            <th>Tema</th>
            <th>Pertanyaan</th>
            <th>Opsi Jawaban</th>
            <th>Jawaban Benar</th>
        </tr>
    </thead>
    <tbody>
        <?php

    $no=1;
    if ($soal) :
       foreach ($soal as $sl) : ?>
        <tr>
            <td><?= $no++; ?></td>
            <td><?= $sl->nama_tema; ?></td>
            <td><?= $sl->pertanyaan; ?></td>
            <td><?= 'a. '.$sl->opsi_a.
                    '<br/> b. '.$sl->opsi_b.
                    '<br/> c. '.$sl->opsi_c.
                    '<br/> d. '.$sl->opsi_d.
                    '<br/> e. '.$sl->opsi_e; ?></td>
            <td><?= explode('_',$sl->jawaban)[1].'. '.$sl->{$sl->jawaban}; ?></td>
        </tr>
    <?php endforeach;
    else: ?>
        <tr><td colspan="7" style="text-align:center;">Tidak ada data</td></tr>
    <?php endif; ?>

    </tbody>
</table>

				</div>
            </div>
        </div>
    </section>
</div>