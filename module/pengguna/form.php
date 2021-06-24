<?php
    include "../../inc/functions.php";

    // form_status (tambah/edit) -> get from script.js
    if ($_GET['form_status'] == 'pengguna_edit') {
        $id=$_GET['id'];
        $result=$db->get_row("SELECT * FROM pengguna WHERE id='$id'");
    }

    $id = (!empty($result->id)) ? $result->id : '';
    $username = (!empty($result->username)) ? $result->username : '';
    $level = (!empty($result->level)) ? $result->level : '';

    $form_title = ($_GET['form_status'] == 'pengguna_edit') ? 'Edit Data' : 'Tambah Data';
    echo "<h6>$form_title</h6>";
?>

<div class="row">
    <div class="col-md-6">
        <form method="POST" id="form" data-form-status='<?= $_GET['form_status'] ?>'>
            <input type="hidden" name="id" id="id" required value="<?= $id; ?>" />

            <div class="form-group">
                <label for="username">Username</label>
                <input type="text" name="username" id="username" class="form-control" required value="<?= $username; ?>" autocomplete="off"/>
            </div>

            <div class="form-group">
                <label for="level">Level</label>
                <select name="level" id="level" class="form-select">
                    <option value="kepsek" <?= ($level == 'kepsek') ? 'selected' : '' ?>">Kepala Sekolah</option>
                    <option value="wakepsek" <?= ($level == 'wakepsek') ? 'selected' : '' ?>">Wakil Kepala Sekolah</option>
                    <option value="guru" <?= ($level == 'guru') ? 'selected' : '' ?>">Guru</option>
                    <option value="siswa" <?= ($level == 'siswa') ? 'selected' : '' ?>">Siswa</option>
                </select>
            </div>

            <div class="form-buttons">
                <button type="button" id="cancel-button" class="btn btn-secondary mr-2">Batal</button>
                <button type="submit" name="simpan" id="simpan" class="btn btn-primary">Simpan</button>
            </div>
        </form>
    </div>
</div>