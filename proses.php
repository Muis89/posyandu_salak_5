<?php
include 'config/koneksi.php';
$nim = $_GET['id'];
$query = mysql_query("select * from anak where id_anak='$nim'");
$mahasiswa = mysql_fetch_array($query);
$data = array(
            'nama_anak'      =>  $mahasiswa['nama_anak'],
            'tanggal_lahir'   =>  $mahasiswa['tanggal_lahir'],
            'jenis_kelamin'    =>  $mahasiswa['jenis_kelamin'],);
 echo json_encode($data);
?>
