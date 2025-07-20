<?php

error_reporting(0);
?>
<style>
.header {border-bottom:solid 1px #666; height:85px; width:100%; margin:auto; margin-bottom:20px;}
.header img { overflow:hidden; width:50px!important;height:30px!important; float:left; margin-left:20px;margin-right:-30px; margin-top:10px;}
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
$data	= "SELECT * FROM sn_user WHERE id='1'";
$hasil	= mysql_query($data);
$row	= mysql_fetch_array($hasil);
?>
<div class="header">

<img src="logo-widodo.png" />

<p><b><?php echo $row['header'];?></b>
<?php echo $row['alamat_instansi'];?></p>
<img class="img2" width="70"src="logo2.jpg" />
</div>
<h4>LAPORAN HARIAN</h4>
<p>Tanggal : <?php 
$hari=$_POST['harian'];
$format = date('d-m-Y', strtotime($hari ));
echo $format; ?></p>


<table id="table-a">
        <thead>
        <tr><th width="20">ID</th>
            <th>Tanggal</th>
            <th width="35">Kategori</th>
            <th width="110">Nama Pasien</th>
            <th width="170">Alamat</th>
            <th width="50">Reg</th>
            <th width="20">Umur</th>
            <th width="40" >Jenis Pemeriksaan</th>
        </tr>
        </thead>
        <tbody>
       <?php 
$harian=mysql_real_escape_string($_POST['harian']);
//$nosppt=mysql_real_escape_string($_GET['nosppt']);
$sql = mysql_query("SELECT DATE_FORMAT(a.tanggal, '%d-%m-%Y') as tanggal,
					a.id_cek,b.jenis_pasien,b.nama_pasien,b.alamat_pasien,
					b.reg_pasien,b.umur_pasien,a.jenis_pemeriksaan 
					FROM sn_cek as a  
					JOIN sn_pasien as b
					ON a.id_pasien=b.id_pasien WHERE a.tanggal like '%$harian%'") or die (mysql_error());
//$sql=mysql_query("select * from penduduk order by nama desc");$no=0;
$tgl=date("d-m-Y");
while($datapost=mysql_fetch_array($sql)){$no++;
$idcek = strip_tags($datapost['id_cek']);
$tanggal= strip_tags($datapost['tanggal']);
$kategori = strip_tags($datapost['jenis_pasien']);
$nama = strip_tags($datapost['nama_pasien']);
$alamat = strip_tags($datapost['alamat_pasien']);
$reg= strip_tags($datapost['reg_pasien']);
$umur = strip_tags($datapost['umur_pasien']);
$jenis = strip_tags($datapost['jenis_pemeriksaan']);

?>
        <tr>
            <td><?PHP echo $idcek;?></td>
            <td><?PHP echo $tanggal;?></td>
            <td><?PHP echo $kategori;?></td>
            <td><?PHP echo $nama;?></td>
            <td><?PHP echo $alamat;?></td>
            <td><?PHP echo $reg;?></td>
            <td><?PHP echo $umur;?></td>
            <td><?php 
									$kalimat=$jenis;
									$kata=explode(",",$kalimat);
									for ($no = 0; $no < count ($kata); $no++){
									echo "$kata[$no]<br>";
									}
									
									?></td>
            
        </tr>
       <?PHP }?>
        </tbody>
        </table>
<br>		
<div class="ttd1">
Mengetahui,<br>
Dokter Penanggung Jawab<br><br><br><br><u><b><?php echo $row[kepala];?></b></u><br><?php echo $row[no_kepala];?>
</div>
<div class="ttd2">

Petugas Pemeriksa<br><br><br><br><u><b><?php echo $row[petugas];?></b></u>
</div>


