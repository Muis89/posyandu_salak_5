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
$data	= "SELECT * FROM sn_user WHERE id='1'";
$hasil	= mysql_query($data);
$row	= mysql_fetch_array($hasil);
?>

<h4>DATA PENIMBANGAN<br> POSYANDU </h4><br>



<table id="table-a">
        <thead>
        <tr><th width="60">Kode Timbang</th>
            <th width="170" >Nama</th>
            <th width="50">Tanggal Timbang</th>
            <th width="40">Usia Anak</th>
            <th width="100">Berat Badan</th>
            <th width="100">Lingkar Perut</th>
            <th width="100">Jenis Imunisasi</th>
            <th width="100" >Jenis Vitamin</th>
            <th width="140" >Saran</th>
            
        </tr>
        </thead>
        <tbody>
       <?php 
$bulan=mysql_real_escape_string($_POST['bulan']);
$tahun=mysql_real_escape_string($_POST['tahun']);
//$nosppt=mysql_real_escape_string($_GET['nosppt']);
$sql = mysql_query("SELECT id_penimbangan,
                             nama_anak, 
                             DATE_FORMAT(tanggal_timbang, '%d-%m-%Y') as tanggal,
                             usia,
                             berat_badan,
                             lingkar_perut,
                             jenis_imunisasi,
                             jenis_vitamin,
                             saran FROM penimbangan JOIN anak ON penimbangan.id_anak=anak.id_anak JOIN imunisasi ON penimbangan.id_imunisasi=imunisasi.id_imunisasi JOIN vitamin ON penimbangan.id_vitamin=vitamin.id_vitamin") or die (mysql_error());
//$sql=mysql_query("select * from penduduk order by nama desc");$no=0;
$tgl=date("d-m-Y");
while($datapost=mysql_fetch_array($sql)){$no++;
$idcek = strip_tags($datapost['id_penimbangan']);
$tanggal= strip_tags($datapost['nama_anak']);
$kategori = strip_tags($datapost['tanggal']);
$nama = strip_tags($datapost['usia']);
$alamat = strip_tags($datapost['berat_badan']);
$reg= strip_tags($datapost['lingkar_perut']);
$umur = strip_tags($datapost['jenis_imunisasi']);
$panjang = strip_tags($datapost['jenis_vitamin']);
$berat = strip_tags($datapost['saran']);


?>
        <tr>
            <td><?PHP echo $idcek;?></td>
            <td><?PHP echo $tanggal;?></td>
            <td><?PHP echo $kategori;?></td>
            <td><?PHP echo $nama;?></td>
            <td><?PHP echo $alamat;?></td>
            <td><?PHP echo $reg;?></td>
            <td><?PHP echo $umur;?></td>
            <td><?PHP echo $panjang;?></td>
            <td><?PHP echo $berat;?></td>
          
            
        </tr>
       <?PHP }?>
        </tbody>
        </table>
<br>		



