<?php 
if ($_GET['module']=='') {
	include 'content/login.php';
}elseif ($_GET['module']=='home') {
	include 'content/home.php';
}elseif ($_GET['module']=='dataanak') {
	include 'content/data_anak.php';
}elseif ($_GET['module']=='penimbangan') {
	include 'content/data_penimbangan.php';
}elseif ($_GET['module']=='vitamin') {
	include 'content/vitamin.php';
}elseif ($_GET['module']=='perbalita') {
	include 'content/perbalita.php';
}elseif ($_GET['module']=='imunisasi') {
	include 'content/imunisasi.php';
}elseif ($_GET['module']=='datakematian') {
	include 'content/data_kematian.php';
}elseif ($_GET['module']=='lapperbalita') {
	include 'content/laporanperbalita.php';
}elseif ($_GET['module']=='ibuhamil') {
	include 'content/data_ibuhamil.php';
}
?>