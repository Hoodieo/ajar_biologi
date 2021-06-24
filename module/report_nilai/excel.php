<?php
    require_once '../../inc/functions.php';

    $where = '';
    if ($_GET['id_kelas'] != 'semua') {
        $where = 'WHERE id_kelas='.$_GET['id_kelas'];
    }

    $siswa = $db->get_results("SELECT siswa.*, kelas.kelas, IFNULL(nilai.nilai, 0) AS nilai FROM siswa
	LEFT JOIN kelas ON kelas.id=siswa.id_kelas
	LEFT JOIN pengguna ON pengguna.username=siswa.nis
	LEFT JOIN nilai ON nilai.id_siswa=pengguna.id
    $where ORDER BY siswa.id_kelas, siswa.nis");

    $judul = 'Laporan Nilai Siswa';
    $judul .= ($_GET['id_kelas'] == 'semua') ? '' : 'Kelas '.$siswa[0]->kelas;

    if (isset($_GET['export_excel'])) {
        header("Content-type: application/vnd-ms-excel");
        header("Content-Disposition: attachment; filename=".$judul.".xls");
    }
?>

<div class="page-heading">
    <h3><?= $judul; ?></h3>
</div>

<div class="page-content">
    <section class="row">
        <div class="col-12">
            <div class="card">
                <div id="content-data" class="card-body">

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