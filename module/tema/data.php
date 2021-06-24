<?php
    session_start();

    if ($_SESSION['status'] == 'admin' || $_SESSION['status'] == 'guru') { ?>
    <div class="buttons mb-4 d-flex justify-content-end">
        <button id="add-button" class="btn btn-primary mr-3">Tambah</button>
    </div>
<?php } ?>

<table border="1" cellspacing="0" cellpadding="0" id="data-table">
    <thead>
        <tr>
            <th>No.</th>
            <th width="500">Tema</th>

            <?php if ($_SESSION['status'] == 'admin' || $_SESSION['status'] == 'guru' || $_SESSION['status'] == 'siswa') { ?>
                <th>Aksi</th>
            <?php } ?>
        </tr>
    </thead>
    <tbody>

    <?php
    require "../../inc/functions.php";
    $no=1;
    $temas = $db->get_results("SELECT * FROM tema");

    if ($temas) :
       foreach ($temas as $tema) :
        $soal       = $db->get_row("SELECT COUNT(id) AS jumlah_soal FROM soal WHERE id_tema=$tema->id");
        $temp_data  = $db->get_row("SELECT COUNT(id) AS total FROM temp_data_nilai WHERE id_tema=$tema->id AND id_siswa=$_SESSION[userid]");
       ?>
        <tr>
            <td><?= $no++; ?></td>
            <td><?= $tema->nama_tema; ?></td>

            <?php if ($_SESSION['status'] == 'admin' || $_SESSION['status'] == 'guru') { ?>
                <td>
                <button id="edit-button" class="btn btn-sm btn-warning" data-id="<?= $tema->id; ?>">Edit</button>
                <button id="delete-button" class="btn btn-sm btn-danger" data-id="<?= $tema->id; ?>" data-action="tema_hapus">Hapus</button>
                </td>

            <?php } else if ($_SESSION['status'] == 'siswa') { ?>
                <td>
                <?php if ($temp_data->total < 1) : ?>
                <a href="actions?action=latihan&id_tema=<?= $tema->id; ?>" class="btn btn-sm btn-outline-secondary">Mulai Mengerjakan</a>
                <?php endif; ?>

                <?php if (($temp_data->total > 0) && ($temp_data->total < $soal->jumlah_soal)) : ?>
                <a href="actions?action=lanjut_latihan&id_tema=<?= $tema->id; ?>" class="btn btn-sm btn-outline-secondary">Lanjut Mengerjakan</a>
                <?php endif; ?>

                <?php if (($temp_data->total > 0) && ($temp_data->total < $soal->jumlah_soal)) : ?>
                <a href="actions?action=latihan&id_tema=<?= $tema->id; ?>" class="btn btn-sm btn-outline-secondary" onclick="return confirm('Yakin ingin mengerjakan ulang soal <?= $tema->nama_tema; ?>?')">Kerjakan Ulang</a>
                <?php endif; ?>

                <?php if (($temp_data->total > 0) && ($temp_data->total == $soal->jumlah_soal)) : ?>
                <a href="index?m=latihan_result&id_tema=<?= $tema->id; ?>"  class="btn btn-sm btn-outline-secondary">Lihat Hasil</a>
                <?php endif; ?>
                </td>
            <?php } ?>


        </tr>
    <?php endforeach;
    else: ?>
        <tr>
            <td colspan="3" style="text-align:center;">Tidak ada data</td>
        </tr>
    <?php endif; ?>

    </tbody>
</table>

<script>
    $('#data-table').DataTable();
</script>