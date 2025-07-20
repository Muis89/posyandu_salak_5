<?php
session_start();
error_reporting(0);
include '../config/koneksi.php';
$module=$_GET['module'];
$act=$_GET['act'];

// Hapus format
if ($module=='anak' AND $act=='hapus'){
  mysql_query("DELETE FROM anak WHERE id_anak='$_GET[id]'");
 
echo "<script language='javascript'>alert('Data Berhasil Dihapus');
document.location='../?module=dataanak';
</script>";
}

// Input format
elseif ($module=='anak' AND $act=='input'){

		mysql_query("INSERT INTO anak (id_anak,
											nama_anak,
											tanggal_lahir,
											jenis_kelamin,
											nama_ibu,
											nama_ayah,
											alamat,
											panjang_badan,
											berat_lahir,
											lingkar_kepala) 
								VALUES( '$_POST[id_anak]',
										'$_POST[nama_anak]',
										'$_POST[tanggal_lahir]',
										'$_POST[jenis_kelamin]',
										'$_POST[nama_ibu]',
										'$_POST[nama_ayah]',
										'$_POST[alamat]',
										'$_POST[panjang_badan]',
										'$_POST[berat_lahir]',
										'$_POST[lingkar_kepala]')");
								   
echo "<script language='javascript'>alert('Data Berhasil Disimpan');
document.location='../?module=dataanak';
</script>";

}
elseif ($module=='anak' AND $act=='edit'){

mysql_query("UPDATE anak SET nama_anak='$_POST[nama_anak]',
								tanggal_lahir='$_POST[tanggal_lahir]',
								jenis_kelamin='$_POST[jenis_kelamin]',
								nama_ibu='$_POST[nama_ibu]',
								nama_ayah='$_POST[nama_ayah]',
								alamat='$_POST[alamat]',
								panjang_badan='$_POST[panjang_badan]',
								berat_lahir='$_POST[berat_lahir]',
								lingkar_kepala='$_POST[lingkar_kepala]' WHERE id_anak='$_POST[id_anak]'");
echo "<script language='javascript'>alert('Data Berhasil Diedit');
document.location='../?module=dataanak';
</script>";
		

}
elseif ($module=='siswabaru' AND $act=='update'){

      mysql_query("UPDATE rb_siswa SET noinduk	 = '$_POST[aa]',
								       password  = '$_POST[ab]',
									   status    = '1',
									   kodekelas = '$_POST[ac]'
									where nopendaftaran ='$_POST[id]'");
									
	 header('location:../../media.php?module=siswabaru&status=0');
}


?>
