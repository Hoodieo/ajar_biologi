<?php
    session_start();
    if (!isset($_GET['id_tema'])) { redirect_js('index?m=tema'); }

    $tema = $db->get_row("SELECT nama_tema FROM tema WHERE id=$_GET[id_tema]");
    $soal = $db->get_row("SELECT count(id) AS jumlah_soal FROM soal WHERE id_tema=$_GET[id_tema]");

    // identitas siswa
    $user = $db->get_row("SELECT username FROM pengguna WHERE id=$_SESSION[userid]");
    $siswa = $db->get_row("SELECT siswa.nis, siswa.nama_siswa, kelas.kelas FROM siswa LEFT JOIN kelas ON siswa.id_kelas=kelas.id WHERE siswa.nis=$user->username");

    // total soal
    $result_temp = $db->get_row("SELECT COUNT(id) AS total_soal FROM temp_data_nilai WHERE id_tema=$_GET[id_tema] AND id_siswa=$_SESSION[userid]");

    // hitung jawaban benar
    $result_jawaban = $db->get_row("SELECT COUNT(id) as jwb_benar FROM temp_data_nilai WHERE id_tema=$_GET[id_tema] AND id_siswa=$_SESSION[userid] AND score=1");

    // hitung nilai latihan
    $result_nilai = $db->get_row("SELECT SUM(score) as nilai FROM temp_data_nilai WHERE id_tema=$_GET[id_tema] AND id_siswa=$_SESSION[userid]");

?>

<div class="page-heading">
    <h3>Hasil Materi: <?= $tema->nama_tema ?> </h3>
</div>
<div class="alert-container"></div>

<div class="page-content">
    <section class="row">
        <div class="col-12">
            <div class="card">
                <div id="content-data" class="card-body">
                    <h3 class="text-center">Selesai!</h3><br>
                    <table class="mx-auto" cellpadding="6">
                        <tr><td width="140">NIS</td><th style="min-width: 160px"><?= $siswa->nis ?></th></tr>
                        <tr><td>Nama Siswa</td><th><?= $siswa->nama_siswa ?></th></tr>
                        <tr><td>Kelas</td><th><?= $siswa->kelas ?></th></tr>
                        <tr><td>Tema Soal</td><th><?= $tema->nama_tema ?></th></tr>
                        <tr><td>Total Soal</td><th><?= $result_temp->total_soal ?></th></tr>
                        <tr><td>Jawaban Benar</tthd><th><?= $result_jawaban->jwb_benar ?></th></tr>
                        <tr><td>Nilai</td><th><?= ($result_jawaban->jwb_benar/$soal->jumlah_soal)*100 ?></th></tr>
                    </table>

                    <br>
                    <div class="menu-btns text-center">
                        <a href="index?m=tema" class="btn btn-primary">Kembali</a>
                        <a href="actions?action=latihan&id_tema=3" class="btn btn-secondary" onclick="return confirm('Yakin ingin mengerjakan ulang soal <?= $tema->nama_tema; ?>?')">Kerjakan ulang</a>
                    </div>
				</div>
            </div>
        </div>
    </section>
</div>