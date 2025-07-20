
<?php 
include 'session_member.php';
if ($_GET['act']==''){?>

<div class="col-md-12">

<h4 style="text-align: center;">BALITA</h4><hr> 
<a href="?module=dataanak&act=tambah" class="btn btn-success ">Tambah</a><br><br>
      <?php
      $query = mysql_query("SELECT COUNT(*) jumData from anak");
      $data = mysql_fetch_array($query);
      $jumlahData = $data["jumData"];
       
      $dataperPage = 5;
        if(isset($_GET['hal']))
        {
        $noPage= $_GET['hal'];
        }
        else
        {
        $noPage=1;
        }
      $offset = ($noPage-1)*$dataperPage;
      ?>
<div class="table-responsive">
<table class="table table-bordered">
  <thead>
    <tr>

      <th>NIB</th>
      <th>Nama</th>
      <th>Tanggal Lahir</th>
      <th>JK</th>
      <th>Nama Ibu</th>
      <th>Nama Ayah</th>
      <th>Alamat</th>
      <th>Panjang Badan</th>
      <th>Berat Lahir</th>
      <th>Lingkar Kepala</th>
      <th width="140">Aksi</th>
    </tr>
  </thead>
  <tbody>
  <?php 
  $tampil=mysql_query("SELECT id_anak, 
                              nama_anak, 
                              DATE_FORMAT(tanggal_lahir, '%d-%m-%Y') as tanggal, 
                              jenis_kelamin, 
                              nama_ibu,
                              nama_ayah,
                              alamat,
                              panjang_badan,
                              berat_lahir,
                              lingkar_kepala  FROM anak limit  $offset, $dataperPage");
    while($row=mysql_fetch_array($tampil)){
  ?>
    <tr>
        <td><?php echo $row['id_anak'];?></td>
      <td><?php echo $row['nama_anak'];?></td>
      <td><?php echo $row['tanggal'];?></td>
      <td><?php echo $row['jenis_kelamin'];?></td>
      <td><?php echo $row['nama_ibu'];?></td>
      <td><?php echo $row['nama_ayah'];?></td>
      <td><?php echo $row['alamat'];?></td>
      <td><?php echo $row['panjang_badan'];?></td>
      <td><?php echo $row['berat_lahir'];?></td>
      <td><?php echo $row['lingkar_kepala'];?></td>
      <td><a href="?module=dataanak&act=edit&id=<?php echo $row[id_anak];?>" class="btn btn-default">Edit</a> <a href="content/aksi_anak.php?module=anak&act=hapus&id=<?php echo $row[id_anak];?>" onclick="return confirm('Apakah anda yakin akan menghapus data ini?')"  class="btn btn-danger">Hapus</a></td>
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

<?php } elseif ($_GET['act']=='tambah') {

  $query = "SELECT 
      max(id_anak) as maxID 
      FROM anak";
$hasil = mysql_query($query);
$data = @mysql_fetch_array($hasil);
$idMax = $data['maxID'];

$noUrut = (int) substr($idMax, 1, 9);
$noUrut++;
$char = "B";
$newID = $char.sprintf("%04s", $noUrut); 
  ?>

<h4 style="text-align: center;">INPUT DATA BALITA</h4><hr><br>
<div class="col-md-6 col-sm-offset-2 ">
<form class="form-horizontal" method="post" action="content/aksi_anak.php?module=anak&act=input">
  <div class="form-group">
    <label for="inputEmail3" class="col-sm-4 control-label">NIB</label>
    <div class="col-sm-8">
      <input type="text" class="form-control" disabled value="<?php echo "$newID";?>" name='id_anak'>
      <input type="hidden" class="form-control"  value="<?php echo "$newID";?>" name='id_anak'>
    </div>
  </div>
  <div class="form-group">
    <label for="inputPassword3" class="col-sm-4 control-label">Nama</label>
    <div class="col-sm-8">
      <input type="text" class="form-control"  value="<?php echo $row[nama_anak];?>" name='nama_anak'>
    </div>
  </div>
  <div class="form-group">
    <label for="inputPassword3" class="col-sm-4 control-label">Tanggal Lahir</label>
    <div class="col-sm-8">
      <input type="date" class="form-control"  value="<?php echo $row[tanggal_lahir];?>" name='tanggal_lahir'>
    </div>
  </div>
  <div class="form-group">
    <label for="inputPassword3" class="col-sm-4 control-label">Jenis Kelamin</label>
    <div class="col-sm-8">
      <input type="text" class="form-control" value="<?php echo $row[jenis_kelamin];?>" name='jenis_kelamin'>
    </div>
  </div>
  <div class="form-group">
    <label for="inputPassword3" class="col-sm-4 control-label">Nama Ibu</label>
    <div class="col-sm-8">
      <input type="text" class="form-control"  value="<?php echo $row[nama_ibu];?>" name='nama_ibu'>
    </div>
  </div>
  <div class="form-group">
    <label for="inputPassword3" class="col-sm-4 control-label">Nama Ayah</label>
    <div class="col-sm-8">
      <input type="text" class="form-control"  value="<?php echo $row[nama_ayah];?>" name='nama_ayah'>
    </div>
  </div>
   <div class="form-group">
    <label for="inputPassword3" class="col-sm-4 control-label">Alamat</label>
    <div class="col-sm-8">
      <input type="text" class="form-control"   value="<?php echo $row[alamat];?>" name='alamat'>
    </div>
  </div>
    <div class="form-group">
    <label for="inputPassword3" class="col-sm-4 control-label">Panjang Badan</label>
    <div class="col-sm-8">
      <input type="text" class="form-control"    value="<?php echo $row[panjang_badan];?>" name='panjang_badan'>
    </div>
  </div>
    <div class="form-group">
    <label for="inputPassword3" class="col-sm-4 control-label">Berat Lahir</label>
    <div class="col-sm-8">
      <input type="text" class="form-control"   value="<?php echo $row[berat_lahir];?>" name='berat_lahir'>
    </div>
  </div>
    <div class="form-group">
    <label for="inputPassword3" class="col-sm-4 control-label">Lingkar Kepala</label>
    <div class="col-sm-8">
      <input type="text" class="form-control"   value="<?php echo $row[lingkar_kepala];?>" name='lingkar_kepala'>
    </div>
  </div>
  <div class="form-group">
    <div class="col-sm-offset-4 col-sm-10">
      <input type="submit" class="btn btn-success" value="Simpan"> <input type="reset" class="btn btn-danger" value="Reset">
    </div>
 
  </div>
</form>
</div>

<?php } elseif ($_GET['act']=='edit') {
$syarat=$_GET['id'];
$data = "SELECT * FROM anak WHERE id_anak='$syarat'";
$hasil  = mysql_query($data);
$row  = mysql_fetch_array($hasil);
?>

<h4 style="text-align: center;">EDIT DATA</h4><hr><br>
<div class="col-md-6 col-sm-offset-2 ">
<form class="form-horizontal" method="post" action="content/aksi_anak.php?module=anak&act=edit">
  <div class="form-group">
    <label for="inputEmail3" class="col-sm-4 control-label">NIB</label>
    <div class="col-sm-8">
      <input type="text" class="form-control"  value="<?php echo $row[id_anak];?>" name='id_anak'>
      
    </div>
  </div>
  <div class="form-group">
    <label for="inputPassword3" class="col-sm-4 control-label">Nama</label>
    <div class="col-sm-8">
      <input type="text" class="form-control"  value="<?php echo $row[nama_anak];?>" name='nama_anak'>
    </div>
  </div>
  <div class="form-group">
    <label for="inputPassword3" class="col-sm-4 control-label">Tanggal Lahir</label>
    <div class="col-sm-8">
      <input type="date" class="form-control"  value="<?php echo $row[tanggal_lahir];?>" name='tanggal_lahir'>
    </div>
  </div>
  <div class="form-group">
    <label for="inputPassword3" class="col-sm-4 control-label">Jenis Kelamin</label>
    <div class="col-sm-8">
      <input type="text" class="form-control" value="<?php echo $row[jenis_kelamin];?>" name='jenis_kelamin'>
    </div>
  </div>
  <div class="form-group">
    <label for="inputPassword3" class="col-sm-4 control-label">Nama Ibu</label>
    <div class="col-sm-8">
      <input type="text" class="form-control"  value="<?php echo $row[nama_ibu];?>" name='nama_ibu'>
    </div>
  </div>
  <div class="form-group">
    <label for="inputPassword3" class="col-sm-4 control-label">Nama Ayah</label>
    <div class="col-sm-8">
      <input type="text" class="form-control"  value="<?php echo $row[nama_ayah];?>" name='nama_ayah'>
    </div>
  </div>
   <div class="form-group">
    <label for="inputPassword3" class="col-sm-4 control-label">Alamat</label>
    <div class="col-sm-8">
      <input type="text" class="form-control"   value="<?php echo $row[alamat];?>" name='alamat'>
    </div>
  </div>
    <div class="form-group">
    <label for="inputPassword3" class="col-sm-4 control-label">Panjang Badan</label>
    <div class="col-sm-8">
      <input type="text" class="form-control"    value="<?php echo $row[panjang_badan];?>" name='panjang_badan'>
    </div>
  </div>
    <div class="form-group">
    <label for="inputPassword3" class="col-sm-4 control-label">Berat Lahir</label>
    <div class="col-sm-8">
      <input type="text" class="form-control"   value="<?php echo $row[berat_lahir];?>" name='berat_lahir'>
    </div>
  </div>
    <div class="form-group">
    <label for="inputPassword3" class="col-sm-4 control-label">Lingkar Kepala</label>
    <div class="col-sm-8">
      <input type="text" class="form-control"   value="<?php echo $row[lingkar_kepala];?>" name='lingkar_kepala'>
    </div>
  </div>
  <div class="form-group">
    <div class="col-sm-offset-4 col-sm-10">
      <input type="submit" class="btn btn-success" value="Simpan"> <input type="reset" class="btn btn-danger" value="Reset">
    </div>
 
  </div>
</form>
</div>

<?php } ?>
