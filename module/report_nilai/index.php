<?php
    $where = '';
    if ($_GET['id_kelas'] != 'semua') {
        $where = 'WHERE id_kelas='.$_GET['id_kelas'];
    }

    $siswa = $db->get_results("SELECT siswa.*, kelas.kelas, IFNULL(nilai.nilai, 0) AS nilai FROM siswa
	LEFT JOIN kelas ON kelas.id=siswa.id_kelas
	LEFT JOIN pengguna ON pengguna.username=siswa.nis
	LEFT JOIN nilai ON nilai.id_siswa=pengguna.id
    $where ORDER BY siswa.id_kelas, siswa.nis");

?>

<div class="page-heading">
    <h3>Laporan Nilai Siswa <?= ($_GET['id_kelas'] == 'semua') ? '' : 'Kelas '.$siswa[0]->kelas; ?></h3>
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
        <a href="module/report_nilai/excel?id_kelas=<?= $_GET['id_kelas'] ?>&export_excel=true" class="btn btn-primary mr-3">Export Excel</a>
        <!-- <a href="module/report_nilai/report?id_kelas=<?= $_GET['id_kelas'] ?>" class="btn btn-primary mr-3">Cetak</a> -->
    </div>
</div>

<table border="1" cellspacing="0" cellpadding="0" id="data-table" class="table">
    <thead>
        <tr>
            <th>No.</th>
            <th>NIS</th>
            <th>Nama Siswa</th>
            <th>Kelas</th>
            <th>Nilai</th>
        </tr>
    </thead>
    <tbody>
        <?php

    $no=1;
    if ($siswa) :
       foreach ($siswa as $sw) : ?>
        <tr>
            <td><?= $no++; ?></td>
            <td><?= $sw->nis; ?></td>
            <td><?= ucwords($sw->nama_siswa); ?></td>
            <td><?= $sw->kelas; ?></td>
            <td><?= $sw->nilai; ?></td>
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