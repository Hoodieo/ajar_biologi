<?php
    include "../../inc/functions.php";

    // form_status (tambah/edit) -> get from script.js
    if ($_GET['form_status'] == 'siswa_edit') {
        $id=$_GET['id'];
        $result=$db->get_row("SELECT * FROM siswa WHERE id='$id'");
    }

    $id = (!empty($result->id)) ? $result->id : '';
    $nama_siswa = (!empty($result->nama_siswa)) ? $result->nama_siswa : '';
    $nis = (!empty($result->nis)) ? $result->nis : '';
    $tempat_lahir = (!empty($result->tempat_lahir)) ? $result->tempat_lahir : '';
    $tgl_lahir = (!empty($result->tgl_lahir)) ? $result->tgl_lahir : '';
    $jenis_kelamin = (!empty($result->jenis_kelamin)) ? $result->jenis_kelamin : '';
    $alamat = (!empty($result->alamat)) ? $result->alamat : '';
    $kelas_id = (!empty($result->id_kelas)) ? $result->id_kelas : '';

    $form_title = ($_GET['form_status'] == 'siswa_edit') ? 'Edit Data' : 'Tambah Data';
    echo "<h6>$form_title</h6>";
?>

<div class="row">
    <div class="col-md-6">
        <form method="POST" id="form" data-form-status='<?= $_GET['form_status'] ?>'>
            <input type="hidden" name="id" id="id" required value="<?= $id; ?>" />

            <div class="form-group col-md-6">
                <label for="nis">Nomor Induk Siswa/NIS</label>
                <input type="text" name="nis" id="nis" class="form-control" required value="<?= $nis; ?>" autocomplete="off"/>
            </div>

            <div class="form-group">
                <label for="nama_siswa">Nama Siswa</label>
                <input type="text" name="nama_siswa" id="nama_siswa" class="form-control" required value="<?= $nama_siswa; ?>" autocomplete="off"/>
            </div>

            <div class="form-group row">
                <div class="col-md-6">
                    <label for="tempat_lahir">Tempat Lahir</label>
                    <input type="text" name="tempat_lahir" id="tempat_lahir" class="form-control" required value="<?= $tempat_lahir; ?>" autocomplete="off"/>
                </div>
                <div class="col-md-6">
                    <label for="tgl_lahir">Tanggal Lahir</label>
                    <input type="date" name="tgl_lahir" id="tgl_lahir" class="form-control" required value="<?= $tgl_lahir; ?>" autocomplete="off"/>
                </div>
            </div>

            <div class="form-group">
                <label for="jenis_kelamin">Jenis Kelamin</label>
                <select name="jenis_kelamin" id="jenis_kelamin" class="form-select">
                    <option value="Laki-laki" <?= ($jenis_kelamin == 'Laki-laki') ? 'selected' : '' ?> >Laki-laki</option>
                    <option value="Perempuan" <?= ($jenis_kelamin == 'Perempuan') ? 'selected' : '' ?> >Perempuan</option>
                </select>
            </div>

            <div class="form-group">
                <label for="alamat">Alamat</label>
                <textarea name="alamat" id="alamat" rows="2" class="form-control"><?= $alamat; ?></textarea>
            </div>

            <div class="form-group">
                <label for="kelas_id">Kelas</label>
                <select name="kelas_id" id="kelas_id" class="form-select">
                    <?= getKelasOptions($kelas_id) ?>
                </select>
            </div>

            <div class="form-buttons">
                <button type="button" id="cancel-button" class="btn btn-secondary mr-2">Batal</button>
                <button type="submit" name="simpan" id="simpan" class="btn btn-primary">Simpan</button>
            </div>
        </form>
    </div>
</div>