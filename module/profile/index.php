<?php
    $user = $db->get_row("SELECT * FROM pengguna WHERE id='$_SESSION[userid]'");

    if ($_SESSION['status'] == 'siswa') {
        $siswa = $db->get_row("SELECT siswa.*, kelas.kelas FROM siswa LEFT JOIN kelas ON siswa.id_kelas=kelas.id WHERE nis='$user->username'");
    }
?>

<div class="page-heading">
    <h3>Profil Pengguna</h3>
</div>
<div class="alert-container"></div>

<div class="page-content">
    <section class="row">
        <div class="col-12">
            <div class="card">
                <div id="content-data" class="card-body">
                  <div class="row">
                      <div class="col-md-6">
                          <form method="POST" id="update-profile-form">
                          <input type="hidden" id="userid" name="userid" value="<?= $user->id ?>">
                          <div class="form-group">
                              <label for="username">Username</label>
                              <input type="text" class="form-control" id="username" name="username" value="<?= $user->username ?>" autocomplete="off" <?= ($_SESSION['status']=='siswa') ? 'readonly' : ''?> >
                          </div>

                          <?php if ($_SESSION['status'] == 'siswa') : ?>
                            <div class="form-group">
                                <label for="nis">Nomor Induk Siswa</label>
                                <input type="text" class="form-control" id="nis" value="<?= $siswa->nis ?>" readonly>
                            </div>
                            <div class="form-group">
                                <label for="nama">Nama</label>
                                <input type="text" class="form-control" id="nama" value="<?= $siswa->nama_siswa ?>" readonly>
                            </div>
                            <div class="form-group">
                                <label for="lahir">Tempat, Tanggal lahir</label>
                                <input type="text" class="form-control" id="lahir" value="<?= ucwords($siswa->tempat_lahir).', '.date("d M Y", strtotime($siswa->tgl_lahir)) ?>" readonly>
                            </div>
                            <div class="form-group">
                                <label for="alamat">Alamat</label>
                                <textarea name="alamat" id="alamat" rows="2" class="form-control" readonly><?= $siswa->alamat ?></textarea>
                            </div>
                            <div class="form-group">
                                <label for="jk">Jenis Kelamin</label>
                                <input type="text" class="form-control" id="jk" value="<?= $siswa->jenis_kelamin ?>" readonly>
                            </div>
                            <div class="form-group">
                                <label for="kelas">Kelas</label>
                                <input type="text" class="form-control" id="kelas" value="<?= $siswa->kelas ?>" readonly>
                            </div>
                          <?php endif; ?>

                          <div class="form-group">
                              <label for="level">Level</label>
                                  <input type="text" class="form-control" id="level" value="<?= $user->level ?>" readonly>
                          </div>

                          <?php if ($_SESSION['status'] != 'siswa') : ?>
                          <button type="submit" id="update-profile-btn" class="btn btn-primary">Update</button>
                          <?php endif; ?>
                          </form>
                      </div>
                  </div>
                </div>
            </div>
        </div>
    </section>
</div>