<?php
error_reporting(0);
include "config/koneksi.php";
$pass=$_POST[password];
$username = $_POST[nama_admin];

$login=mysql_query("SELECT * FROM admin
			WHERE nama_admin='".mysql_real_escape_string($username)."' AND password='$pass'");
$cocok=mysql_num_rows($login);
$r=mysql_fetch_array($login);

	if ($cocok > 0){
		session_start();
		$_SESSION[nama_admin]     = $r[nama_admin];
		$_SESSION[password]     = $r[password];
		
		
		echo "<script>window.alert('Login Anda Sukses !');
					window.location='index.php?module=home'</script>";
	}else{
		echo "<script>window.alert('Username atau Password anda salah.');
					window.location='login.html'</script>";
	}


?>