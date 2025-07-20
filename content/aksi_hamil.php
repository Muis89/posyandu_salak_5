<?php
session_start();
error_reporting(0);
include '../config/koneksi.php';
$module = $_GET['module'];
$act    = $_GET['act'];

// === HAPUS ===
if ($module=='hamil' AND $act=='hapus'){
  mysql_query("DELETE FROM pemeriksaan_ibu WHERE id_periksa='$_GET[id]'");
  echo "<script>alert('Data Berhasil Dihapus');window.location='../?module=ibuhamil';</script>";
}

// === INPUT ===
elseif ($module=='hamil' AND $act=='input'){

  // jika pilih "Ibu Baru"
  if ($_POST['id_ibu'] == 'new') {
      // generate id ibu baru
      $q = mysql_query("SELECT MAX(id_ibu) maxID FROM ibu_hamil");
      $d = mysql_fetch_array($q);
      $no = (int) substr($d['maxID'],1,4) + 1;
      $id_ibu_baru = "I".sprintf("%04s",$no);

      // simpan ibu baru
      mysql_query("INSERT INTO ibu_hamil
                  (id_ibu,nik,nama_ibu,alamat,telepon,tgl_daftar)
                  VALUES
                  ('$id_ibu_baru',
                   '$_POST[nik_baru]',
                   '$_POST[nama_baru]',
                   '$_POST[alamat_baru]',
                   '$_POST[telepon_baru]',
                   CURDATE())");
      $id_ibu = $id_ibu_baru;
  } else {
      $id_ibu = $_POST['id_ibu'];
  }

  mysql_query("INSERT INTO pemeriksaan_ibu
              (id_periksa,id_ibu,tgl_periksa,usia_kandungan,bb_ibu,tb_ibu,imunisasi,vitamin,saran)
              VALUES
              ('$_POST[id_periksa]','$id_ibu','$_POST[tgl_periksa]',
               '$_POST[usia_kandungan]','$_POST[bb_ibu]','$_POST[tb_ibu]',
               '$_POST[imunisasi]','$_POST[vitamin]','$_POST[saran]')");
  echo "<script>alert('Data Berhasil Disimpan');window.location='../?module=ibuhamil';</script>";
}

// === EDIT ===
elseif ($module=='hamil' AND $act=='edit'){
  mysql_query("UPDATE pemeriksaan_ibu SET
                id_ibu          = '$_POST[id_ibu]',
                tgl_periksa     = '$_POST[tgl_periksa]',
                usia_kandungan  = '$_POST[usia_kandungan]',
                bb_ibu          = '$_POST[bb_ibu]',
                tb_ibu          = '$_POST[tb_ibu]',
                imunisasi       = '$_POST[imunisasi]',
                vitamin         = '$_POST[vitamin]',
                saran           = '$_POST[saran]'
              WHERE id_periksa  = '$_POST[id_periksa]'");
  echo "<script>alert('Data Berhasil Diupdate');window.location='../?module=ibuhamil';</script>";
}
?>