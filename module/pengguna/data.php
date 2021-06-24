<?php
    session_start();

    if ($_SESSION['status'] != 'kepsek') { ?>
    <div class="buttons mb-4 d-flex justify-content-end">
        <button id="add-button" class="btn btn-primary mr-3">Tambah</button>
    </div>
<?php } ?>

<table border="1" cellspacing="0" cellpadding="0" id="data-table">
    <thead>
        <tr>
            <th>No.</th>
            <th>Username</th>
            <th>Level</th>

            <?php if ($_SESSION['status'] != 'kepsek') { ?>
                <th>Aksi</th>
            <?php } ?>
        </tr>
    </thead>
    <tbody>
        <?php

   require "../../inc/functions.php";
   $no=1;
   $pengguna = $db->get_results("SELECT * FROM pengguna ORDER BY level");

    if ($pengguna) :
       foreach ($pengguna as $user) :
            if ($user->level == 'kepsek') {
                $user_level = 'Kepala Sekolah';
            } elseif ($user->level == 'wakepsek') {
                $user_level = 'Wakil Kepala Sekolah';
            } else {
                $user_level = ucwords($user->level);
            }
       ?>
        <tr>
            <td><?= $no++; ?></td>
            <td><?= $user->username; ?></td>
            <td><?= $user_level; ?></td>

            <?php if ($_SESSION['status'] != 'kepsek') { ?>
                <td>
                    <a href="actions?action=reset_password&user_id=<?= $user->id ?>" class="btn btn-sm btn-warning" onclick="return confirm('Yakin ingin reset password user: <?= $user->username; ?> | level: <?= $user_level; ?>?')">Reset Password</a>
                    <button id="delete-button" class="btn btn-sm btn-danger" data-id="<?= $user->id; ?>" data-action="pengguna_hapus">Hapus</button>
                </td>
            <?php } ?>
        </tr>
    <?php endforeach;
    else: ?>
        <tr><td colspan="4" style="text-align:center;">Tidak ada data</td></tr>
    <?php endif; ?>

    </tbody>
</table>

<script>
    $('#data-table').DataTable();
</script>