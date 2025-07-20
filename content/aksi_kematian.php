<?php
session_start();
error_reporting(0);
include '../config/koneksi.php';

$module = $_GET['module'];
$act    = $_GET['act'];

// Hapus
if ($module == 'datakematian' && $act == 'hapus') {
    mysql_query("DELETE FROM kematian WHERE id_kematian='".mysql_real_escape_string($_GET['id'])."'");
    echo "<script>alert('Data Berhasil Dihapus');window.location.href='../?module=datakematian';</script>";
    exit();
}

// Input
elseif ($module == 'datakematian' && $act == 'input') {
    $id_kematian      = mysql_real_escape_string($_POST['id_kematian']);
    $id_anak          = mysql_real_escape_string($_POST['id_anak']);
    $tanggal_kematian = mysql_real_escape_string($_POST['tanggal_kematian']);
    $keterangan       = mysql_real_escape_string($_POST['keterangan']);

    mysql_query("INSERT INTO kematian
      (id_kematian, id_anak, tanggal_kematian, keterangan)
      VALUES
      ('$id_kematian', '$id_anak', '$tanggal_kematian', '$keterangan')");

    echo "<script>alert('Data Berhasil Disimpan');window.location.href='../?module=datakematian';</script>";
    exit();
}

// Edit
elseif ($module == 'datakematian' && $act == 'edit') {
    $id_kematian      = mysql_real_escape_string($_POST['id_kematian']);
    $id_anak          = mysql_real_escape_string($_POST['id_anak']);
    $tanggal_kematian = mysql_real_escape_string($_POST['tanggal_kematian']);
    $keterangan       = mysql_real_escape_string($_POST['keterangan']);

    mysql_query("UPDATE kematian SET
      id_anak          = '$id_anak',
      tanggal_kematian = '$tanggal_kematian',
      keterangan       = '$keterangan'
      WHERE id_kematian='$id_kematian'");

    echo "<script>alert('Data Berhasil Diupdate');window.location.href='../?module=datakematian';</script>";
    exit();
}
?>