<div class="sidebar-menu">
    <ul class="menu">
        <li class="sidebar-title">Selamat datang, <strong><?= ucwords($_SESSION['username'])?></strong></li>

        <li class="sidebar-item <?=checkMenuActive('index')?> ">
            <a href="index" class='sidebar-link'>
                <i class="bi bi-grid-fill"></i>
                <span>Dashboard</span>
            </a>
        </li>

        <?php if ($_SESSION['status'] != 'kepsek') { ?>
        <li class="sidebar-item <?=checkMenuActive('tema')?>">
            <a href="index?m=tema" class='sidebar-link'>
                <i class="bi bi-file-earmark-spreadsheet-fill"></i>
                <span>Tema</span>
            </a>
        </li>

        <?php if ($_SESSION['status'] != 'siswa') { ?>
        <li class="sidebar-item <?=checkMenuActive('soal')?>">
            <a href="index?m=soal" class='sidebar-link'>
                <i class="bi bi-file-earmark-spreadsheet-fill"></i>
                <span>Soal</span>
            </a>
        </li>
        <?php } ?>
        <?php } ?>

        <?php if ($_SESSION['status'] == 'admin' || $_SESSION['status'] == 'kepsek' || $_SESSION['status'] == 'wakepsek') { ?>
        <li class="sidebar-item <?=checkMenuActive('siswa')?>">
            <a href="index?m=siswa" class='sidebar-link'>
                <i class="bi bi-file-earmark-spreadsheet-fill"></i>
                <span>Siswa</span>
            </a>
        </li>

        <li class="sidebar-item <?=checkMenuActive('kelas')?>">
            <a href="index?m=kelas" class='sidebar-link'>
                <i class="bi bi-file-earmark-spreadsheet-fill"></i>
                <span>Kelas</span>
            </a>
        </li>

        <li class="sidebar-item <?=checkMenuActive('pengguna')?>">
            <a href="index?m=pengguna" class='sidebar-link'>
                <i class="bi bi-file-earmark-spreadsheet-fill"></i>
                <span>Pengguna</span>
            </a>
        </li>
        <?php } ?>

        <li class="sidebar-item <?=checkMenuActive('profile')?>">
            <a href="index?m=profile" class='sidebar-link'>
                <i class="bi bi-file-earmark-spreadsheet-fill"></i>
                <span>Profil</span>
            </a>
        </li>

        <li class="sidebar-item <?=checkMenuActive('change_password')?>">
            <a href="index?m=change_password" class='sidebar-link'>
                <i class="bi bi-file-earmark-spreadsheet-fill"></i>
                <span>Ganti Password</span>
            </a>
        </li>

        <?php if ($_SESSION['status'] != 'siswa') : ?>
        <li class="sidebar-item <?=checkMenuActive('report')?>">
            <a href="index?m=report" class='sidebar-link'>
                <i class="bi bi-stack"></i>
                <span>Laporan</span>
            </a>
        </li>
        <?php endif; ?>

        <li class="sidebar-item">
            <a href="actions?action=logout" class='btn btn-outline-danger w-100'>
                <span>Logout</span>
            </a>
        </li>

    </ul>
</div>
