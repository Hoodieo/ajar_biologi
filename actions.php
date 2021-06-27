<?php
require "inc/functions.php";

$module     = explode('_', $_GET['action'])[0];
$_action    = explode('_', $_GET['action'])[1];

// ACTION LOGIN, LOGOUT, UPLOAD IMAGE, CHANGE PASSWORD, UPDATE PROFILE
switch ($_GET['action']){

    // LOGIN
    case 'check_login':
        $username	= $_POST['username'];
        $password	= $_POST['password'];

        $result = $db->get_row("SELECT * FROM pengguna WHERE username='$username' AND password='$password'");

        if ($result) {
            if ($result->username == 'kepsek') {
                $sesi_username = 'Kepala Sekolah';
            } elseif ($result->username == 'wakepsek') {
                $sesi_username = 'Wakil Kepala Sekolah';
            } elseif ($result->level == 'siswa') {
                $result_siswa = $db->get_row("SELECT nama_siswa FROM siswa WHERE nis=$username");
                $sesi_username = $result_siswa->nama_siswa;
            } else {
                $sesi_username = $result->username;
            }

            $_SESSION['userid']     = $result->id;
            $_SESSION['username']   = $sesi_username;
            $_SESSION['password']   = $result->password;
            $_SESSION['status']     = $result->level;

            // true = login successfully (redirect to index)
            echo true;
        } else {
            echo false;
        }
        break;

    // LOGOUT
    case 'logout':
        // clear cookies
        setcookie('id_tema', '', 1);
        setcookie('ids_soal', '', 1);
        setcookie('current_id', '', 1);
        setcookie('current_idsoal', '', 1);

        // clear session
        session_unset();
        session_destroy();

        redirect_js('login');
        break;

    // UPLOAD IMAGE
    case 'upload_image':
        $temp = "assets/upload/";
        if (!file_exists($temp))
            mkdir($temp);

        $filename       = $_POST['newfilename'];
        $fileupload     = $_FILES['fileupload']['tmp_name'];
        $ImageName      = $_FILES['fileupload']['name'];
        $ImageType      = $_FILES['fileupload']['type'];

        if (!empty($fileupload)){
            move_uploaded_file($_FILES["fileupload"]["tmp_name"], $temp.$filename); // Menyimpan file

            echo "File uploaded successfully"; //<message>_<alert-style>
        } else {
            echo "Failed to upload file!";
        }
        break;

    // CHANGE-UPDATE PASSWORD
    case 'change_password':
            $old_password   = $_POST['password_old'];
            $new_password   = $_POST['password_new'];
            $con_password   = $_POST['password_conf'];

            $user = $db->get_row("SELECT * FROM pengguna WHERE id='$_SESSION[userid]' AND password='$old_password'");

            if ($new_password == $con_password) {
                if ($user) {
                    $query = $db->query("UPDATE pengguna SET password='$new_password' WHERE id='$_SESSION[userid]'");
                    echo "Password updated!#info";
                    exit;
                } else {
                    echo "Password wrong!#danger";
                    exit;
                }
            } else {
                echo "Password not match!#danger";
                exit;
            }
        break;

    // RESET PASSWORD
    case 'reset_password':
            $user_id   = $_GET['user_id'];
            $query = $db->query("UPDATE pengguna SET password='12345' WHERE id=$user_id");
            echo "<script>alert('Password pengguna berhasil direset!')</script>";
            redirect_js('index?m=pengguna');
        break;

    // UPDATE MY PROFILE DATA
    case 'profile_update':
            $id         = trim($_POST['userid']);
            $username   = trim($_POST['username']);

            $query = $db->query("UPDATE pengguna SET username='$username' WHERE id='$id'");
            $_SESSION['username'] = $username;

            if ($query) {
                echo "Profile updated!#info";
                exit;
            } else {
                echo "Failed to update data. Details:".$query."#danger";
                exit;
            }
        break;

    // START LATIHAN
    case 'latihan':
            $temp_data_result = $db->get_row("SELECT COUNT(id) as total FROM temp_data_nilai WHERE id_tema=$_GET[id_tema] AND id_siswa=$_SESSION[userid]");

            if ($temp_data_result->total > 0) {
                $db->query("DELETE FROM temp_data_nilai WHERE id_tema=$_GET[id_tema] AND id_siswa=$_SESSION[userid]");
                $db->query("DELETE FROM nilai WHERE id_tema=$_GET[id_tema] AND id_siswa=$_SESSION[userid]");
            }

            $results = $db->get_results("SELECT id FROM soal WHERE id_tema=$_GET[id_tema] ORDER BY id");
            $ids_soal = [];

            foreach ($results as $result) {
                array_push($ids_soal, $result->id);
            }

            // set cookies data
            setcookie('id_tema', $_GET['id_tema'], time()+60*60*24*30);
            setcookie('ids_soal', serialize($ids_soal), time()+60*60*24*30);
            setcookie('current_id', 0, time()+60*60*24*30);
            setcookie('current_idsoal', $ids_soal[0], time()+60*60*24*30);

            // redirect to show soal
            redirect_js('index?m=latihan');
        break;

    case 'next_latihan': //soal atau materi berikutnya
            $id_tema = $_COOKIE['id_tema'];
            $userid = $_SESSION['userid'];

            $ids_soal = unserialize($_COOKIE['ids_soal']);
            $current_id = $_COOKIE['current_id'] + 1;
            $current_idsoal = ($ids_soal[$current_id]) ? $ids_soal[$current_id] : '-';

            // cek jawaban user dan soal, utk dapat nilai
            $jawaban_user = $_POST['jawaban_user'];
            $soal = $db->get_row("SELECT * FROM soal WHERE id=$_COOKIE[current_idsoal]");
            $_score = ($soal->jawaban == $jawaban_user) ? 1 : 0 ;

            // simpan jawaban user ke db: temp_data_nilai
            $db->query("INSERT into temp_data_nilai(id, id_tema, id_siswa, id_soal, score) VALUES (NULL, $id_tema, $userid, $_COOKIE[current_idsoal], $_score)");

            // update cookie value
            setcookie('current_id', $current_id, time()+60*60*24*30);
            setcookie('current_idsoal', $current_idsoal, time()+60*60*24*30);

            // jika sudah selesai
            if ($current_id >= count($ids_soal)) {
                // soal
                $soal = $db->get_row("SELECT count(id) AS jumlah_soal FROM soal WHERE id_tema=$id_tema");

                // hitung jawaban benar
                $result_jawaban = $db->get_row("SELECT COUNT(id) as jwb_benar FROM temp_data_nilai WHERE id_tema=$id_tema AND id_siswa=$userid AND score=1");

                // hitung nilai siswa
                $result_nilai = $db->get_row("SELECT SUM(score) as nilai FROM temp_data_nilai WHERE id_tema=$id_tema AND id_siswa=$userid");

                $nilai_siswa = ($result_jawaban->jwb_benar/$soal->jumlah_soal)*100;

                $db->query("INSERT INTO nilai(id, id_tema, id_siswa, nilai) VALUES (NULL,$id_tema, $userid, $nilai_siswa)");

                // reset cookies
                setcookie('current_id', '', 1);
                setcookie('current_idsoal', '', 1);
                redirect_js('index?m=latihan_result&id_tema='.$_COOKIE['id_tema']);
                exit;
            }

            redirect_js('index?m=latihan');
        break;

    case 'lanjut_latihan': //melanjutkan latihan soal sebelumnya
            // get soal data
            $results = $db->get_results("SELECT id FROM soal WHERE id_tema=$_GET[id_tema] ORDER BY id");
            $ids_soal = [];
            foreach ($results as $result ) { array_push($ids_soal, $result->id); }

            // get soal terakhir yg dikerjakan
            $result_id = $db->get_row("SELECT COUNT(id_soal) AS last_id FROM temp_data_nilai WHERE id_tema=$_GET[id_tema] AND id_siswa=$_SESSION[userid]");
            $result_idsoal = $db->get_row("SELECT MAX(id_soal)+1 AS last_idsoal FROM temp_data_nilai WHERE id_tema=$_GET[id_tema] AND id_siswa=$_SESSION[userid]");

            // set cookies data
            setcookie('id_tema', $_GET['id_tema'], time()+60*60*24*30);
            setcookie('ids_soal', serialize($ids_soal), time()+60*60*24*30);
            setcookie('current_id', $result_id->last_id, time()+60*60*24*30);
            setcookie('current_idsoal', $ids_soal[$result_id->last_id], time()+60*60*24*30);

            // redirect to show soal
            redirect_js('index?m=latihan');
        break;

    case 'reset_latihan':
            setcookie('id_tema', '', 1);
            setcookie('ids_soal', '', 1);
            setcookie('current_id', '', 1);
            setcookie('current_idsoal', '', 1);
            redirect_js('index?m=tema');
        break;

    case 'view_report':
            switch ($_POST['laporan']) {
                case 'siswa':
                    redirect_js('index?m=report_siswa&id_kelas='.$_POST['id_kelas']);
                    break;

                case 'nilai':
                    redirect_js('index?m=report_nilai&id_kelas='.$_POST['id_kelas']);
                    break;

                case 'soal':
                    redirect_js('index?m=report_soal&id_tema='.$_POST['id_tema']);
                    break;

                default:
                redirect_js('index?m=report');
                    break;
            }
        break;
}

// MODULE ACTIONS
switch ($module){
    // =================== TEMA ===================
    case 'tema':
        $id     = trim($_POST['id']);
        $tema   = trim($_POST['tema']);

        switch ($_action) {
            case 'tambah':
                $query = $db->query("INSERT INTO tema(id, nama_tema) VALUES (NULL,'$tema')");

                if ($query) {
                    echo "Data disimpan!#info";
                } else {
                    echo "Data failed to save. Details: ".$query."#danger";
                }
                break;

            case 'edit':
                $query = $db->query("UPDATE tema SET nama_tema='$tema' WHERE id='$id'");

                if ($query) {
                    echo "Data diupdate!#info";
                } else {
                    echo "Failed to update data. Details:".$query."#danger";
                }
                break;

            case 'hapus':
                $query = $db->query("DELETE FROM tema WHERE id='$id'");

                if ($query) {
                    echo "Data dihapus!#info";
                } else {
                    echo "Failed to delete data. Details:".$query."#danger";
                }
                break;
        }
    break;

    // =================== MATERI ===================
    case 'materi':
        $id                 = $_POST['id'];
        $id_tema            = $_POST['id_tema'];
        $judul_materi       = trim($_POST['judul_materi']);
        $deskripsi_materi   = trim($_POST['deskripsi_materi']);
        $content            = ($_POST['image_url']) ? $_POST['image_url'] : $_POST['tmp_image_url'] ;

        switch ($_action) {
            case 'tambah':
                $query = $db->query("INSERT INTO materi(id, judul_materi, deskripsi, content, id_tema) VALUES (NULL,'$judul_materi', '$deskripsi_materi', '$content', $id_tema)");

                echo "Data disimpan!#info";
                break;

            case 'edit':
                $query = $db->query("UPDATE materi SET judul_materi='$judul_materi', deskripsi='$deskripsi_materi', content='$content', id_tema=$id_tema WHERE id='$id'");

                echo "Data diupdate!#info";
                break;

            case 'hapus':
                $query = $db->query("DELETE FROM materi WHERE id='$id'");

                echo "Data dihapus!#info";
                break;
        }
    break;

    // =================== KELAS ===================
    case 'kelas':
        $id     = trim($_POST['id']);
        $kelas  = trim($_POST['kelas']);

        switch ($_action) {
            case 'tambah':
                $query = $db->query("INSERT INTO kelas(id, kelas) VALUES (NULL,'$kelas')");

                if ($query) {
                    echo "Data disimpan!#info";
                } else {
                    echo "Data failed to save. Details: ".$query."#danger";
                }
                break;

            case 'edit':
                $query = $db->query("UPDATE kelas SET kelas='$kelas' WHERE id='$id'");

                if ($query) {
                    echo "Data diupdate!#info";
                } else {
                    echo "Failed to update data. Details:".$query."#danger";
                }
                break;

            case 'hapus':
                $query = $db->query("DELETE FROM kelas WHERE id='$id'");

                if ($query) {
                    echo "Data dihapus!#info";
                } else {
                    echo "Failed to delete data. Details:".$query."#danger";
                }
                break;
        }
    break;

    // =================== SISWA ===================
    case 'siswa':
        $id             = trim($_POST['id']);
        $nis            = trim($_POST['nis']);
        $nama_siswa     = trim($_POST['nama_siswa']);
        $tempat_lahir   = trim($_POST['tempat_lahir']);
        $tgl_lahir      = $_POST['tgl_lahir'];
        $alamat         = trim($_POST['alamat']);
        $jenis_kelamin  = trim($_POST['jenis_kelamin']);
        $id_kelas       = trim($_POST['kelas_id']);

        switch ($_action) {
            case 'tambah':
                $query = $db->query("INSERT INTO siswa(id, nis, nama_siswa, tempat_lahir, tgl_lahir, alamat, jenis_kelamin, id_kelas) VALUES (NULL, '$nis', '$nama_siswa', '$tempat_lahir', '$tgl_lahir', '$alamat', '$jenis_kelamin', $id_kelas)");

                $query = $db->query("INSERT INTO pengguna(id, username, password, level) VALUES (NULL, '$nis', '12345', 'siswa')");

                if ($query) {
                    echo "Data disimpan!#info";
                } else {
                    echo "Data failed to save. Details: ".$query."#danger";
                }
                break;

            case 'edit':
                $query = $db->query("UPDATE siswa SET nis='$nis', nama_siswa='$nama_siswa', tempat_lahir='$tempat_lahir', tgl_lahir='$tgl_lahir', alamat='$alamat', jenis_kelamin='$jenis_kelamin', id_kelas='$id_kelas' WHERE id='$id'");

                if ($query) {
                    echo "Data diupdate!#info";
                } else {
                    echo "Failed to update data. Details:".$query."#danger";
                }
                break;

            case 'hapus':
                $query = $db->query("DELETE FROM siswa WHERE id='$id'");

                if ($query) {
                    echo "Data dihapus!#info";
                } else {
                    echo "Failed to delete data. Details:".$query."#danger";
                }
                break;
        }
    break;

    // =================== PENGGUNA ===================
    case 'pengguna':
        $id         = trim($_POST['id']);
        $username   = trim($_POST['username']);
        $password   = $_POST['password'] ? trim($_POST['password']) : '12345';
        $level      = $_POST['level'];

        switch ($_action) {
            case 'tambah':
                $query = $db->query("INSERT INTO pengguna(id, username, password, level) VALUES (NULL,'$username', '$password', '$level')");

                if ($query) {
                    echo "Data disimpan!#info";
                } else {
                    echo "Data failed to save. Details: ".$query."#danger";
                }
                break;

            case 'edit':
                $query = $db->query("UPDATE pengguna SET username='$username', level='$level' WHERE id='$id'");

                if ($query) {
                    echo "Data diupdate!#info";
                } else {
                    echo "Failed to update data. Details:".$query."#danger";
                }
                break;

            case 'hapus':
                $query = $db->query("DELETE FROM pengguna WHERE id='$id'");

                if ($query) {
                    echo "Data dihapus!#info";
                } else {
                    echo "Failed to delete data. Details:".$query."#danger";
                }
                break;
        }
    break;

    // =================== SOAL ===================
    case 'soal':
        $id         = trim($_POST['id']);
        $pertanyaan = htmlspecialchars(trim($_POST['pertanyaan']));
        $opsi_a     = htmlspecialchars(trim($_POST['opsi_a']));
        $opsi_b     = htmlspecialchars(trim($_POST['opsi_b']));
        $opsi_c     = htmlspecialchars(trim($_POST['opsi_c']));
        $opsi_d     = htmlspecialchars(trim($_POST['opsi_d']));
        $opsi_e     = htmlspecialchars(trim($_POST['opsi_e']));
        $jawaban    = htmlspecialchars($_POST['jawaban']);
        $deskripsi  = htmlspecialchars(trim($_POST['deskripsi_materi']));
        $content    = ($_POST['image_url']) ? $_POST['image_url'] : $_POST['tmp_image_url'] ;
        $id_tema    = $_POST['id_tema'];

        switch ($_action) {
            case 'tambah':
                $query = $db->query("INSERT INTO soal(id, pertanyaan, opsi_a, opsi_b, opsi_c, opsi_d, opsi_e, jawaban, deskripsi_materi, content_materi, id_tema ) VALUES (NULL,'$pertanyaan', '$opsi_a', '$opsi_b', '$opsi_c', '$opsi_d', '$opsi_e', '$jawaban', '$deskripsi', '$content', $id_tema)");


                if ($query) {
                    echo "Data disimpan!#info";
                } else {
                    echo "Data failed to save. Details: ".$query."#danger";
                }
                break;

            case 'edit':
                $query = $db->query("UPDATE soal SET pertanyaan='$pertanyaan', opsi_a='$opsi_a', opsi_b='$opsi_b', opsi_c='$opsi_c', opsi_d='$opsi_d', opsi_e='$opsi_e', jawaban='$jawaban', deskripsi_materi='$deskripsi', content_materi='$content', id_tema='$id_tema' WHERE id='$id'");

                if ($query) {
                    echo "Data diupdate!#info";
                } else {
                    echo "Failed to update data. Details:".$query."#danger";
                }
                break;

            case 'hapus':
                $query = $db->query("DELETE FROM soal WHERE id='$id'");

                if ($query) {
                    echo "Data dihapus!#info";
                } else {
                    echo "Failed to delete data. Details:".$query."#danger";
                }
                break;
        }
    break;
}
?>