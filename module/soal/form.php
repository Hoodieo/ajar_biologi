<?php
    include "../../inc/functions.php";

    // form_status (tambah/edit) -> get from script.js
    if ($_GET['form_status'] == 'soal_edit') {
        $id=$_GET['id'];
        $result=$db->get_row("SELECT * FROM soal WHERE id='$id'");
    }

    $id         = (!empty($result->id)) ? $result->id : '';
    $pertanyaan = (!empty($result->pertanyaan)) ? $result->pertanyaan : '';
    $opsi_a     = (!empty($result->opsi_a)) ? $result->opsi_a : '';
    $opsi_b     = (!empty($result->opsi_b)) ? $result->opsi_b : '';
    $opsi_c     = (!empty($result->opsi_c)) ? $result->opsi_c : '';
    $opsi_d     = (!empty($result->opsi_d)) ? $result->opsi_d : '';
    $opsi_e     = (!empty($result->opsi_e)) ? $result->opsi_e : '';
    $jawaban            = (!empty($result->jawaban)) ? $result->jawaban : '';
    $deskripsi_materi   = (!empty($result->deskripsi_materi)) ? $result->deskripsi_materi : '';
    $content_materi     = (!empty($result->content_materi)) ? $result->content_materi : '';
    $id_tema            = (!empty($result->id_tema)) ? $result->id_tema : '';

    $form_title = ($_GET['form_status'] == 'soal_edit') ? 'Edit Soal '.$id : 'Tambah Soal';
    echo "<h4>$form_title</h4>";
?>

<div class="row">
    <div class="col-md-6">
        <form method="POST" id="form" data-form-status='<?= $_GET['form_status'] ?>' enctype="multipart/form-data">
            <input type="hidden" name="id" id="id" required value="<?= $id; ?>" />

            <div class="form-group">
                <label for="tema">Tema</label>
                <select name="id_tema" id="tema" class="form-select">
                    <?= getTemaOptions($id_tema) ?>
                </select>
            </div>

            <!-- MATERI -->
            <hr>
            <div class="section-materi mb-3">
                <div class="form-group">
                    <label for="content_materi">Gambar/Video Materi</label>
                    <?php if ($content_materi !== '') :
                        $format = $content_materi ? explode('.', strtolower($content_materi))[1] : '';

                        // format video
                        if ($format == 'mp4' || $format == 'webm' || $format == 'ogg' || $format == 'ogv') { ?>
                            <video width="100%" controls>
                                <source src="assets/upload/<?= $content_materi ?>" type="video/mp4">
                                <source src="assets/upload/<?= $content_materi ?>" type="video/webm">
                                <source src="assets/upload/<?= $content_materi ?>" type="video/ogg">
                                Your browser does not support HTML video.
                            </video>

                        <?php // format image/picture
                        } elseif ($format == 'jpg' || $format == 'png' || $format == 'webp' || $format == 'gif' || $format == 'jpeg') { ?>
                            <img src="assets/upload/<?= $content_materi ?>" alt="Not available" style="width: 100%; max-height: 400px; object-fit: contain;">
                            <br><br>
                        <?php } ?>
                    <?php endif; ?>

                    <input type="file" name="fileimage" id="fileimage" class="form-control" id="content_materi" name="content_materi" accept=".mp4,.webm,.ogg,.ogv,image/*">
                    <input type="hidden" name="tmp_image_url" id="tmp_image_url" value="<?= $content_materi; ?>" >
                    <small class="text-muted">Upload file berupa gambar (.jpg, .jpeg, .png, .gif) atau video (.mp4, .webm, .ogg) berukuran maksimal 1GB.</small class="text-muted">
                </div>

                <div class="form-group">
                    <label for="deskripsi_materi">Deskripsi Materi (opsional)</label>
                    <textarea name="deskripsi_materi" id="deskripsi_materi" rows="2" class="form-control"><?= $deskripsi_materi; ?></textarea>
                </div>
            </div>

            <!-- PERTANYAAN -->
            <hr>
            <div class="section-pertanyaan mb-3">
                <div class="form-group">
                    <label for="pertanyaan">Pertanyaan</label>
                    <textarea name="pertanyaan" id="pertanyaan" rows="3" class="form-control" required><?= $pertanyaan; ?></textarea>
                </div>
            </div>

            <!-- JAWABAN -->
            <hr>
            <div class="section-pertanyaan mb-3">
                <label for="pertanyaan">Opsi Jawaban</label>

                <div class="form-group row d-flex align-items-center">
                    <input type="radio" id="opsi_a" name="jawaban" value="opsi_a" class="custom-control-input col-sm-1"
                        <?= ($jawaban == 'opsi_a' || $jawaban == '' ) ? 'checked' : '' ?> >
                    <input type="text" class="form-control col" name="opsi_a" id="opsi_a_text" placeholder="Jawaban A" autocomplete="off" required value="<?= $opsi_a; ?>">
                </div>
                <div class="form-group row d-flex align-items-center">
                    <input type="radio" id="opsi_b" name="jawaban" value="opsi_b" class="custom-control-input col-sm-1" <?= ($jawaban == 'opsi_b') ? 'checked' : '' ?> >
                    <input type="text" class="form-control col" name="opsi_b" id="opsi_b_text" placeholder="Jawaban B" autocomplete="off" required value="<?= $opsi_b; ?>">
                </div>
                <div class="form-group row d-flex align-items-center">
                    <input type="radio" id="opsi_c" name="jawaban" value="opsi_c" class="custom-control-input col-sm-1" <?= ($jawaban == 'opsi_c') ? 'checked' : '' ?> >
                    <input type="text" class="form-control col" name="opsi_c" id="opsi_c_text" placeholder="Jawaban C" autocomplete="off" required value="<?= $opsi_c; ?>">
                </div>
                <div class="form-group row d-flex align-items-center">
                    <input type="radio" id="opsi_d" name="jawaban" value="opsi_d" class="custom-control-input col-sm-1" <?= ($jawaban == 'opsi_d') ? 'checked' : '' ?> >
                    <input type="text" class="form-control col" name="opsi_d" id="opsi_d_text" placeholder="Jawaban D" autocomplete="off" required value="<?= $opsi_d; ?>">
                </div>
                <div class="form-group row d-flex align-items-center">
                    <input type="radio" id="opsi_e" name="jawaban" value="opsi_e" class="custom-control-input col-sm-1" <?= ($jawaban == 'opsi_e') ? 'checked' : '' ?> >
                    <input type="text" class="form-control col" name="opsi_e" id="opsi_e_text" placeholder="Jawaban E" autocomplete="off" required value="<?= $opsi_e; ?>">
                </div>
            </div>

            <div class="form-buttons mt-4">
                <button type="button" id="cancel-button" class="btn btn-secondary mr-2">Batal</button>
                <button type="submit" name="simpan" id="simpan" class="btn btn-primary">Simpan</button>
            </div>
        </form>
    </div>
</div>