<?php
    $tema = $db->get_row("SELECT nama_tema FROM tema WHERE id=$_COOKIE[id_tema]");
    $soal = $db->get_row("SELECT * FROM soal WHERE id=$_COOKIE[current_idsoal]");
?>

<div class="page-heading">
    <h3>Topik Materi: <?= $tema->nama_tema ?> | Soal: <?= $_COOKIE['current_id']+1 .' / '.count(unserialize($_COOKIE['ids_soal'])); ?></h3>
</div>
<div class="alert-container"></div>

<div class="page-content">
    <section class="row">
        <div class="col-12">
            <div class="card">
                <div id="content-data" class="card-body">
                    <?php //echo "<pre>"; var_dump($soal->content_materi); echo "</pre>"; ?>

                    <?php if ($soal->content_materi) : ?>
                    <h5>Materi</h5>
                    <div class="soal-materi">
                        <!-- content materi -->
                        <?php
                        $format = $soal->content_materi ? explode('.', strtolower($soal->content_materi))[1] : '';

                        // format video
                        if ($format == 'mp4' || $format == 'webm' || $format == 'ogg' || $format == 'ogv') { ?>
                            <video width="100%" controls>
                                <source src="assets/upload/<?= $soal->content_materi ?>" type="video/mp4">
                                <source src="assets/upload/<?= $soal->content_materi ?>" type="video/webm">
                                <source src="assets/upload/<?= $soal->content_materi ?>" type="video/ogg">
                                Your browser does not support HTML video.
                            </video>

                        <?php // format image/picture
                        } elseif ($format == 'jpg' || $format == 'png' || $format == 'webp' || $format == 'gif' || $format == 'jpeg') { ?>
                            <div class="text-center">
                                <img src="assets/upload/<?= $soal->content_materi ?>" alt="Not available" style="width: 100%; max-width: 700px; max-height: 400px; object-fit: contain;">
                            </div>
                        <?php } ?>

                        <!-- deskripsi materi -->
                        <div class="text-muted text-center mt-1"><?= $soal->deskripsi_materi ?></div>
                            <?= ($soal->deskripsi_materi) ? '<br>' : '' ?>
                        </div>
                    <?php endif; ?>

                    <form action="actions?action=next_latihan" method="POST">
                    <h5>Pertanyaan</h5>
                        <?= $soal->pertanyaan ?>
                    <br><br>

                    <h5>Opsi:</h5>
                        <div class="form-check">
                            <input class="form-check-input" type="radio" name="jawaban_user" id="opsi_a" value="opsi_a" required>
                            <label class="form-check-label" for="opsi_a">a. <?= $soal->opsi_a ?> </label>
                        </div>
                        <div class="form-check">
                            <input class="form-check-input" type="radio" name="jawaban_user" id="opsi_b" value="opsi_b">
                            <label class="form-check-label" for="opsi_b">b. <?= $soal->opsi_b ?> </label>
                        </div>
                        <div class="form-check">
                            <input class="form-check-input" type="radio" name="jawaban_user" id="opsi_c" value="opsi_c">
                            <label class="form-check-label" for="opsi_c">c. <?= $soal->opsi_c ?> </label>
                        </div>
                        <div class="form-check">
                            <input class="form-check-input" type="radio" name="jawaban_user" id="opsi_d" value="opsi_d">
                            <label class="form-check-label" for="opsi_d">d. <?= $soal->opsi_d ?> </label>
                        </div>
                        <div class="form-check">
                            <input class="form-check-input" type="radio" name="jawaban_user" id="opsi_e" value="opsi_e">
                            <label class="form-check-label" for="opsi_e">e. <?= $soal->opsi_e ?> </label>
                        </div>

                        <button type="submit" class="btn btn-primary mt-3">
                            <?= $_COOKIE['current_id'] == (count(unserialize($_COOKIE['ids_soal']))-1) ? 'Selesai' : 'Berikutnya' ?>
                        </button>
                    </form>
				</div>
            </div>
        </div>
    </section>
</div>