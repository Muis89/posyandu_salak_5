<?php
include 'config/koneksi.php';          // sesuaikan path
$id = mysql_real_escape_string($_GET['id']);
$q  = mysql_query("SELECT nama_anak, tanggal_lahir FROM anak WHERE id_anak='$id'");
$row= mysql_fetch_assoc($q);
echo json_encode($row ?: []);
?>