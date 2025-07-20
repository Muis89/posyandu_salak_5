<?php 
include 'session_member.php';

$syarat=$_GET['id'];
  $tampil2=mysql_query("SELECT *  FROM anak WHERE id_anak='$syarat'");
        $row2=mysql_fetch_array($tampil2);

        
?>
<h4 style="text-align: center;">CEK IMUNISASI</h4><hr><br>
<div class="col-md-6 col-sm-offset-0 ">
<form class="form-horizontal" method="post" action="content/aksi_penimbangan.php?module=cekimunisasi&act=input">
  
  <div class="form-group">
    <label for="inputPassword3" class="col-sm-4 control-label">NIB</label>
    <div class="col-sm-8">
      <input type="text" class="form-control"   name='id_anak'  onchange="isi_otomatis()" id="id" value="<?php echo $syarat;?>" >
    </div>
  </div>
  <div class="form-group">
    <label for="inputPassword3" class="col-sm-4 control-label">Nama</label>
    <div class="col-sm-8">

      <input type="text" class="form-control"  name='nama_anak' id="nama_anak" value="<?php echo $row2['nama_anak'];?>">
    </div>
  </div>



  <div class="form-group">
    <div class="col-sm-offset-9 col-sm-10">
      <input type="submit" class="btn btn-success" value="Cek Anak">
    </div>
 
  </div>
</form>
</div>
<div class="col-md-12">
<div class="table-responsive">
<table class="table table-bordered">
  <thead>
    <tr>

      <th>Kode Timbang</th>
      <th>Tanggal Timbang</th>
      <th>Usia Anak</th>
      <th>Jenis Imunisasi</th>
      <th>Usia Wajib</th>
    </tr>
  </thead>
  <tbody>
  <?php 
  $tampil=mysql_query("SELECT id_penimbangan, 
                              DATE_FORMAT(tanggal_timbang, '%d-%m-%Y') as tanggal, 
                              usia, 
                              jenis_imunisasi,
                              usia_wajib FROM penimbangan JOIN imunisasi ON penimbangan.id_imunisasi=imunisasi.id_imunisasi WHERE id_anak='$syarat'");
    while($row=mysql_fetch_array($tampil)){
  ?>
    <tr>
        <td><?php echo $row['id_penimbangan'];?></td>
      <td><?php echo $row['tanggal'];?></td>
      <td><?php echo $row['usia'];?></td>
      <td><?php echo $row['jenis_imunisasi'];?></td>
      <td><?php echo $row['usia_wajib'];?></td>
    </tr>
  <?php } ?>
   
  </tbody>
</table>
<nav>
        <ul class="pagination ">
        <?php include 'content/view_anak.php';?>
        </ul>
        </nav>
</div>
<br>
</div>