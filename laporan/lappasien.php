<?php error_reporting(0);
include 'config/koneksi.php';

?>
<style>
.header {border-bottom:solid 1px #666; height:85px; width:100%; margin:auto; margin-bottom:20px;}
.header img { overflow:hidden;width:50px!important;height:30px!important; float:left; margin-left:20px;margin-right:-30px; margin-top:10px;}
img.img2 {margin-left:650px; margin-top:-75px}
.header h3{font-family:Times, serif;font-size:30px; line-height:30px; text-align:center; margin-left:20px; margin-top:20px;  text-transform:uppercase}
.header p {text-align:center;  margin-left:-60px;padding:1px!important; }
.header span {padding-top:10px;}
.ttd2{
float:left;
margin-left:550px;
margin-top:-90px;
}
h4{
text-align:center;
}
#table-a
{ 
font-size: 12px;
width: 10%;
text-align: center;
border-collapse: collapse;
margin: 10px auto;
border:1px;

}
#table-a th
{ font-size: 12px;
font-weight: normal;
padding: 5px;
border:1px;

color: #000;
}
#table-a td,#table-a td 
{ padding: 8px;
border:1px;
font-size: 10px;
color: #000;
text-align:left;
}
#bod{
width:750px;

}
</style>

<?php 
$data2	= "SELECT * FROM sn_user WHERE id='1'";
$hasil2	= mysql_query($data2);
$row2	= mysql_fetch_array($hasil2);
?>
<div class="header">

<img src="logo-widodo.png" />

<p><b><?php echo $row2['header'];?></b>
<?php echo $row2['alamat_instansi'];?></p>
<img class="img2" width="70"src="logo2.jpg" />
</div>
<?php 
$pasien=mysql_real_escape_string($_POST['pasien']);
$data	= "SELECT DATE_FORMAT(a.tanggal, '%d-%m-%Y') as tanggal,
					b.nama_pasien,
					b.alamat_pasien,
					b.umur_pasien
					FROM sn_cek as a  
					JOIN sn_pasien as b
					ON a.id_pasien=b.id_pasien WHERE a.id_cek='$pasien'";
$hasil	= mysql_query($data);
$row	= mysql_fetch_array($hasil);?>
<h4>HASIL LABORATORIUM</h4>




<table id="table-a">
        <thead>
		<tr>
            <td>Nama</td>
            <td colspan="3" width="260"><b><?php echo $row[nama_pasien];?></b></td>
        </tr>
		<tr>
            <td>Alamat</td>
            <td colspan="3" width="260"><?php echo $row[alamat_pasien];?></td>
        </tr>
		<tr>
            <td>Umur</td>
            <td colspan="3" width="260"><?php echo $row[umur_pasien];?></td>
        </tr>
		<tr>
            <td>Tanggal</td>
            <td colspan="3" width="260"><?php echo $row[tanggal];?></td>
        </tr>
        <tr>
            <th width="120">Jenis Pemeriksaan</th>
            <th width="230">Nama Pemeriksaan</th>
            <th width="140">Hasil</th>
            <th width="150">Nilai Normal</th>
           
        </tr>
        </thead>
        <tbody>
       <?php 
$pasien=mysql_real_escape_string($_POST['pasien']);
//$nosppt=mysql_real_escape_string($_GET['nosppt']);
$sql = mysql_query("SELECT * FROM sn_cek as a  
JOIN sn_cek_detail as b
ON a.id_cek=b.id_cek WHERE a.id_cek='$pasien' AND b.hasil is not null order by b.id_cek_detail") or die (mysql_error());
//$sql=mysql_query("select * from penduduk order by nama desc");$no=0;
$tgl=date("d-m-Y");
while($datapost=mysql_fetch_array($sql)){$no++;
$jenis_pemeriksaan = strip_tags($datapost['jenis_pemeriksaan']);
$nama_pemeriksaan= strip_tags($datapost['nama_pemeriksaan']);
$hasil = strip_tags($datapost['hasil']);
$nilai_nominal = strip_tags($datapost['nilai_nominal']);


?>
        <tr>
            <td><?PHP echo $datapost['jenis_pemeriksaan'];?></td>
            <td><?PHP echo $datapost['nama_pemeriksaan'];?></td>
            <td><?PHP echo $datapost['hasil'];?></td>
            <td><?PHP echo htmlentities($datapost['nilai_nominal']);?></td>
           
            
        </tr>
       <?PHP }?>
        </tbody>
        </table>
<br>		
<div class="ttd1">
Mengetahui,<br>
Dokter Penanggung Jawab<br><br><br><br><u><b><?php echo $row2[kepala];?></b></u><br><?php echo $row2[no_kepala];?>
</div>
<div class="ttd2">

Petugas Pemeriksa<br><br><br><br><u><b><?php echo $row2[petugas];?></b></u>
</div>


