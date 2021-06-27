<?php
    include "../../inc/functions.php";

    // form_status (tambah/edit) -> get from script.js
    if ($_GET['form_status'] == 'materi_edit') {
        $id=$_GET['id'];
        $result=$db->get_row("SELECT * FROM materi WHERE id='$id'");
    }

    $id = (!empty($result->id)) ? $result->id : '';
    $id_tema = (!empty($result->id_tema)) ? $result->id_tema : '';
    $judul_materi = (!empty($result->judul_materi)) ? $result->judul_materi : '';
    $deskripsi_materi = (!empty($result->deskripsi)) ? $result->deskripsi : '';
    $file_materi = (!empty($result->content)) ? $result->content : '';

    $form_title = ($_GET['form_status'] == 'materi_edit') ? 'Edit Data' : 'Tambah Data';
    echo "<h6>$form_title</h6>";
?>

<div class="row">
    <div class="col-md-6">
        <form method="POST" id="form" data-form-status='<?= $_GET['form_status'] ?>'>
            <input type="hidden" name="id" id="id" required value="<?= $id; ?>" />

            <div class="form-group">
                <label for="tema">Tema</label>
                <select name="id_tema" id="tema" class="form-select">
                    <?= getTemaOptions($id_tema) ?>
                </select>
            </div>

            <div class="form-group">
                <label for="judul_materi">Judul Materi</label>
                <input type="text" name="judul_materi" id="judul_materi" class="form-control" required value="<?= $judul_materi; ?>" autocomplete="off"/>
            </div>

            <div class="form-group">
                <label for="deskripsi_materi">Deskripsi Materi</label>
                <textarea name="deskripsi_materi" id="deskripsi_materi" rows="2" class="form-control"><?= $deskripsi_materi; ?></textarea>
            </div>

            <div class="form-group">
                <label for="file_materi">File Materi</label>
                    <input type="file" name="fileimage" id="fileimage" class="form-control" id="file_materi" name="file_materi" accept=".pdf">
                    <input type="hidden" name="tmp_image_url" id="tmp_image_url" value="<?= $file_materi; ?>" >
                    <small class="text-muted">Upload file berupa pdf berukuran maksimal 1GB.</small class="text-muted">
            </div>

            <div class="form-buttons">
                <button type="button" id="cancel-button" class="btn btn-secondary mr-2">Batal</button>
                <button type="submit" name="simpan" id="simpan" class="btn btn-primary">Simpan</button>
            </div>
        </form>
    </div>
</div>