<?php
    include "../../inc/functions.php";

    // form_status (tambah/edit) -> get from script.js
    if ($_GET['form_status'] == 'tema_edit') {
        $id=$_GET['id'];
        $result=$db->get_row("SELECT * FROM tema WHERE id='$id'");
    }

    $id = (!empty($result->id)) ? $result->id : '';
    $tema = (!empty($result->nama_tema)) ? $result->nama_tema : '';

    $form_title = ($_GET['form_status'] == 'tema_edit') ? 'Edit Data' : 'Tambah Data';
    echo "<h6>$form_title</h6>";
?>

<div class="row">
    <div class="col-md-6">
        <form method="POST" id="form" data-form-status='<?= $_GET['form_status'] ?>'>
            <input type="hidden" name="id" id="id" required value="<?= $id; ?>" />

            <div class="form-group">
                <label for="tema">Tema</label>
                <input type="text" name="tema" id="tema" class="form-control" required value="<?= $tema; ?>" autocomplete="off"/>
            </div>

            <div class="form-buttons">
                <button type="button" id="cancel-button" class="btn btn-secondary mr-2">Batal</button>
                <button type="submit" name="simpan" id="simpan" class="btn btn-primary">Simpan</button>
            </div>
        </form>
    </div>
</div>