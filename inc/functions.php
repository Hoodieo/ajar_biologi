<?php
error_reporting(~E_NOTICE);
session_start();
date_default_timezone_set('Asia/Jakarta');

ini_set('max_execution_time', 60 * 1);
ini_set('memory_limit', '256M');
ini_set('upload_max_filesize', '999M');

include 'config.php';
include 'db.php';
$db = new DB($config['server'], $config['username'], $config['password'], $config['database_name']);
include 'general.php';

check_last_activity();

function checkMenuActive($menu){
    if (!isset($_GET['m']) && $menu=='index' ) {
        return 'active';
    } elseif (isset($_GET['m']) && $menu==$_GET['m']) {
        return 'active';
    }

    return null;
}

function getMonthInd($month){
    switch ($month) {
        case 1:
            $month = 'Januari';
            break;
        case 2:
            $month = 'Februari';
            break;
        case 3:
            $month = 'Maret';
            break;
        case 4:
            $month = 'April';
            break;
        case 5:
            $month = 'Mei';
            break;
        case 6:
            $month = 'Juni';
            break;
        case 7:
            $month = 'Juli';
            break;
        case 8:
            $month = 'Agustus';
            break;
        case 9:
            $month = 'September';
            break;
        case 10:
            $month = 'Oktober';
            break;
        case 11:
            $month = 'November';
            break;

        default:
            $month = 'Desember';
            break;
    }
    return $month;
}

function getKelasOptions($selected = ''){
    global $db;
    $a = '';
    $rows = $db->get_results("SELECT * FROM kelas ORDER BY id");
    foreach($rows as $row){
        if($row->id==$selected)
            $a.="<option value='$row->id' selected>$row->kelas</option>";
        else
            $a.="<option value='$row->id'>$row->kelas</option>";
    }
    return $a;
}

function getTemaOptions($selected = ''){
    global $db;
    $a = '';
    $rows = $db->get_results("SELECT * FROM tema ORDER BY id");
    foreach($rows as $row){
        if($row->id==$selected)
            $a.="<option value='$row->id' selected>$row->nama_tema</option>";
        else
            $a.="<option value='$row->id'>$row->nama_tema</option>";
    }
    return $a;
}

function uploadFoto(){
    $namafile = $_FILES['foto']['name'];
    $ukuranfile = $_FILES['foto']['size'];
    $error = $_FILES['foto']['error'];
    $tmpnama = $_FILES['foto']['tmp_name'];

    // Cek ada gambar yg diupload/tidak
    if ($error === 4) {
        $value = ($_POST['tmp_foto']) ? $_POST['tmp_foto'] : '';
        return $value;
    }

    // Cek pastikan file yang diupload adalah foto/gambar
    $ekstensigambarvalid = ['jpg','jpeg','png'];
    $ekstensigambar = explode('.', $namafile);
    $ekstensigambar = strtolower(end($ekstensigambar));
    if (!in_array($ekstensigambar, $ekstensigambarvalid)) {
        echo "<script> alert('File yang diupload bukan foto/gambar') </script>";
        return false;
    }

    // Cek ukuran file
    //Jika lebih dari 2MB atau error code 1: The uploaded file exceeds the upload_max_filesize
    if ($ukuranfile > 2000000 || $error === 1) {
        echo "<script> alert('Ukuran file terlalu besar!') </script>";
        return false;
    }

    // Pengecekan selesai, Foto/Gambar siap upload!
    // Generate nama baru
    $namafilebaru = uniqid().'_'.uniqid();
    $namafilebaru .= '.';
    $namafilebaru .= $ekstensigambar;

    move_uploaded_file($tmpnama, '../assets/images/'.$namafilebaru);
    return $namafilebaru;
}

