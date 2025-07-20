<?php
session_start();
error_reporting(0);
include '../config/koneksi.php';

$module = $_GET['module'];
$act    = $_GET['act'];

// Hapus
if ($module == 'timbang' && $act == 'hapus') {
    mysql_query("DELETE FROM penimbangan WHERE id_penimbangan='" . mysql_real_escape_string($_GET['id']) . "'");
    echo "<script>alert('Data Berhasil Dihapus');window.location='../?module=penimbangan';</script>";
}

// Input
elseif ($module == 'timbang' && $act == 'input') {
    $id_penimbangan = mysql_real_escape_string($_POST['id_penimbangan']);
    $id_anak        = mysql_real_escape_string($_POST['id_anak']);
    $tanggal_timbang= mysql_real_escape_string($_POST['tanggal_timbang']);
    $usia           = (int)$_POST['usia'];
    $berat_badan    = (float)$_POST['beratbadan'];
    $tinggi_badan   = (float)$_POST['tinggi_badan'];
    $id_imunisasi   = (int)$_POST['id_imunisasi'];
    $id_vitamin     = (int)$_POST['id_vitamin'];
    $saran          = mysql_real_escape_string($_POST['saran']);

    mysql_query("INSERT INTO penimbangan
      (id_penimbangan, id_anak, tanggal_timbang, usia, berat_badan, tinggi_badan, id_imunisasi, id_vitamin, saran)
      VALUES
      ('$id_penimbangan', '$id_anak', '$tanggal_timbang', $usia, $berat_badan, $tinggi_badan, $id_imunisasi, $id_vitamin, '$saran')");
    echo "<script>alert('Data Berhasil Disimpan');window.location='../?module=penimbangan';</script>";
}

// Edit
elseif ($module == 'timbang' && $act == 'edit') {
    $id_penimbangan = mysql_real_escape_string($_POST['id_penimbangan']);
    $id_anak        = mysql_real_escape_string($_POST['id_anak']);
    $tanggal_timbang= mysql_real_escape_string($_POST['tanggal_timbang']);
    $usia           = (int)$_POST['usia'];
    $berat_badan    = (float)$_POST['badan'];
    $tinggi_badan   = (float)$_POST['lingkar_perut'];
    $id_imunisasi   = (int)$_POST['id_imunisasi'];
    $id_vitamin     = (int)$_POST['id_vitamin'];
    $saran          = mysql_real_escape_string($_POST['saran']);

    mysql_query("UPDATE penimbangan SET
      id_anak        = '$id_anak',
      tanggal_timbang= '$tanggal_timbang',
      usia           = $usia,
      berat_badan    = $berat_badan,
      tinggi_badan   = $tinggi_badan,
      id_imunisasi   = $id_imunisasi,
      id_vitamin     = $id_vitamin,
      saran          = '$saran'
      WHERE id_penimbangan='$id_penimbangan'");
    echo "<script>alert('Data Berhasil Diupdate');window.location='../?module=penimbangan';</script>";
}
?>