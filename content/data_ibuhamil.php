<?php
include 'session_member.php';
if ($_GET['act']==''){ ?>

<div class="col-md-12">
  <h4 style="text-align: center;">DATA PEMERIKSAAN IBU HAMIL</h4><hr>
  <div class="">
    <a href="?module=ibuhamil&act=tambah" class="btn btn-success">Tambah Pemeriksaan</a>
    <!-- <a href="?module=tambah_ibu" class="btn btn-primary">+ Ibu Baru</a><br><br> -->
  </div>

  <?php
  // hitung total data
  $query  = mysql_query("SELECT COUNT(*) jumData FROM pemeriksaan_ibu");
  $data   = mysql_fetch_array($query);
  $jumlahData = $data["jumData"];

  $dataperPage = 5;
  $noPage = isset($_GET['hal']) ? (int)$_GET['hal'] : 1;
  $offset = ($noPage-1)*$dataperPage;
  ?>

  <div class="table-responsive">
    <table class="table table-bordered">
      <thead>
        <tr>
          <th>Kode Periksa</th>
          <th>NIK Ibu</th>
          <th>Nama</th>
          <th>Tgl Periksa</th>
          <th>Usia Keh</th>
          <th>BB</th>
          <th>TB</th>
          <th>Imunisasi</th>
          <th>Vitamin</th>
          <th width="170">Aksi</th>
        </tr>
      </thead>
      <tbody>
      <?php
      $sql = "SELECT  p.id_periksa,
                      p.tgl_periksa,
                      p.usia_kandungan,
                      p.bb_ibu,
                      p.tb_ibu,
                      p.imunisasi,
                      p.vitamin,
                      i.nik,
                      i.nama_ibu
              FROM pemeriksaan_ibu p
              JOIN ibu_hamil i ON p.id_ibu=i.id_ibu
              ORDER BY p.tgl_periksa DESC
              LIMIT $offset, $dataperPage";
      $tampil = mysql_query($sql);
      while($row=mysql_fetch_array($tampil)){
      ?>
        <tr>
          <td><?php echo $row['id_periksa']; ?></td>
          <td><?php echo $row['nik']; ?></td>
          <td><?php echo $row['nama_ibu']; ?></td>
          <td><?php echo date('d-m-Y',strtotime($row['tgl_periksa'])); ?></td>
          <td><?php echo $row['usia_kandungan']; ?> mgg</td>
          <td><?php echo $row['bb_ibu']; ?> kg</td>
          <td><?php echo $row['tb_ibu']; ?> cm</td>
          <td><?php echo $row['imunisasi']; ?></td>
          <td><?php echo $row['vitamin']; ?></td>
          <td>
            <a href="?module=ibuhamil&act=edit&id=<?php echo $row['id_periksa'];?>" class="btn btn-default">Edit</a>
            <a href="content/aksi_hamil.php?module=hamil&act=hapus&id=<?php echo $row['id_periksa'];?>" onclick="return confirm('Yakin hapus?')" class="btn btn-danger">Hapus</a>
          </td>
        </tr>
      <?php } ?>
      </tbody>
    </table>

    <nav>
      <ul class="pagination">
        <?php include 'content/view_ibuhamil.php'; ?>
      </ul>
    </nav>
  </div>
</div>

<?php } elseif ($_GET['act']=='tambah') {

// kode otomatis
$q = mysql_query("SELECT MAX(id_periksa) maxID FROM pemeriksaan_ibu");
$d = mysql_fetch_array($q);
$no   = (int) substr($d['maxID'],1,4) + 1;
$newID = "H".sprintf("%04s",$no);
?>

<h4 style="text-align: center;">INPUT DATA PEMERIKSAAN IBU HAMIL</h4><hr><br>
<div class="col-md-6 col-sm-offset-2">
<form class="form-horizontal" method="post" action="content/aksi_hamil.php?module=hamil&act=input">
  <div class="form-group">
    <label class="col-sm-4 control-label">Kode Periksa</label>
    <div class="col-sm-8">
      <input type="text" class="form-control" readonly value="<?php echo $newID;?>" name="id_periksa">
    </div>
  </div>

  <!-- Pilih ibu (dropdown) -->
  <div class="form-group">
    <label class="col-sm-4 control-label">Nama Ibu</label>
    <div class="col-sm-8">
      <select name="id_ibu" id="id_ibu" class="form-control" required onchange="toggleIbuBaru()">
        <option value="">-- Pilih --</option>
        <?php
        $ibu=mysql_query("SELECT * FROM ibu_hamil ORDER BY nama_ibu");
        while($b=mysql_fetch_array($ibu)){
          echo "<option value='$b[id_ibu]'>$b[nama_ibu] - $b[nik]</option>";
        }
        ?>
        <option value="new">+ Ibu Baru</option>
      </select>
    </div>
  </div>

  <!-- Form Ibu Baru -->
  <div id="ibu_baru_form" style="display:none;">
    <div class="form-group">
      <label class="col-sm-4 control-label">NIK Ibu Baru</label>
      <div class="col-sm-8">
        <input type="text" class="form-control" name="nik_baru" placeholder="16 digit NIK">
      </div>
    </div>
    <div class="form-group">
      <label class="col-sm-4 control-label">Nama Ibu Baru</label>
      <div class="col-sm-8">
        <input type="text" class="form-control" name="nama_baru" placeholder="Nama lengkap ibu">
      </div>
    </div>
    <div class="form-group">
      <label class="col-sm-4 control-label">Alamat</label>
      <div class="col-sm-8">
        <textarea class="form-control" name="alamat_baru" rows="2"></textarea>
      </div>
    </div>
    <div class="form-group">
      <label class="col-sm-4 control-label">Telepon</label>
      <div class="col-sm-8">
        <input type="text" class="form-control" name="telepon_baru" placeholder="08xxxxxxxx">
      </div>
    </div>
  </div>

  <div class="form-group">
    <label class="col-sm-4 control-label">Tgl Periksa</label>
    <div class="col-sm-8">
      <input type="date" class="form-control" name="tgl_periksa" required>
    </div>
  </div>

  <div class="form-group">
    <label class="col-sm-4 control-label">Usia Kehamilan</label>
    <div class="col-sm-8">
      <input type="number" class="form-control" name="usia_kandungan" required> <small>mgg</small>
    </div>
  </div>

  <div class="form-group">
    <label class="col-sm-4 control-label">Berat Badan</label>
    <div class="col-sm-8">
      <input type="text" class="form-control" name="bb_ibu" required> <small>kg</small>
    </div>
  </div>

  <div class="form-group">
    <label class="col-sm-4 control-label">Tinggi Badan</label>
    <div class="col-sm-8">
      <input type="text" class="form-control" name="tb_ibu" required> <small>cm</small>
    </div>
  </div>

  <div class="form-group">
    <label class="col-sm-4 control-label">Imunisasi</label>
    <div class="col-sm-8">
      <input type="text" class="form-control" name="imunisasi" placeholder="TT / lainnya">
    </div>
  </div>

  <div class="form-group">
    <label class="col-sm-4 control-label">Vitamin</label>
    <div class="col-sm-8">
      <input type="text" class="form-control" name="vitamin" placeholder="Fe / lainnya">
    </div>
  </div>

  <div class="form-group">
    <label class="col-sm-4 control-label">Saran</label>
    <div class="col-sm-8">
      <textarea class="form-control" name="saran" rows="3"></textarea>
    </div>
  </div>

  <div class="form-group">
    <div class="col-sm-offset-4 col-sm-10">
      <input type="submit" class="btn btn-success" value="Simpan">
      <input type="reset" class="btn btn-danger" value="Reset">
    </div>
  </div>
</form>
</div>

<script>
function toggleIbuBaru() {
    var select = document.getElementById('id_ibu');
    var formBaru = document.getElementById('ibu_baru_form');
    if (select.value === 'new') {
        formBaru.style.display = 'block';
        // set required
        document.getElementsByName('nik_baru')[0].required = true;
        document.getElementsByName('nama_baru')[0].required = true;
    } else {
        formBaru.style.display = 'none';
        document.getElementsByName('nik_baru')[0].required = false;
        document.getElementsByName('nama_baru')[0].required = false;
    }
}
</script>

<?php } elseif ($_GET['act']=='edit') {
$syarat = $_GET['id'];
$edit   = mysql_query("SELECT * FROM pemeriksaan_ibu WHERE id_periksa='$syarat'");
$row    = mysql_fetch_array($edit);
?>

<h4 style="text-align: center;">EDIT DATA PEMERIKSAAN IBU HAMIL</h4><hr><br>
<div class="col-md-6 col-sm-offset-2">
<form class="form-horizontal" method="post" action="content/aksi_hamil.php?module=hamil&act=edit">
  <input type="hidden" name="id_periksa" value="<?php echo $row['id_periksa'];?>">

  <div class="form-group">
    <label class="col-sm-4 control-label">Nama Ibu</label>
    <div class="col-sm-8">
      <select name="id_ibu" class="form-control" required>
        <?php
        $ibu=mysql_query("SELECT * FROM ibu_hamil ORDER BY nama_ibu");
        while($b=mysql_fetch_array($ibu)){
          $sel = ($b['id_ibu']==$row['id_ibu']) ? 'selected' : '';
          echo "<option value='$b[id_ibu]' $sel>$b[nama_ibu] - $b[nik]</option>";
        }?>
      </select>
    </div>
  </div>

  <div class="form-group">
    <label class="col-sm-4 control-label">Tgl Periksa</label>
    <div class="col-sm-8">
      <input type="date" class="form-control" name="tgl_periksa" value="<?php echo $row['tgl_periksa'];?>" required>
    </div>
  </div>

  <div class="form-group">
    <label class="col-sm-4 control-label">Usia Kehamilan</label>
    <div class="col-sm-8">
      <input type="number" class="form-control" name="usia_kandungan" value="<?php echo $row['usia_kandungan'];?>" required>
    </div>
  </div>

  <div class="form-group">
    <label class="col-sm-4 control-label">Berat Badan</label>
    <div class="col-sm-8">
      <input type="text" class="form-control" name="bb_ibu" value="<?php echo $row['bb_ibu'];?>" required>
    </div>
  </div>

  <div class="form-group">
    <label class="col-sm-4 control-label">Tinggi Badan</label>
    <div class="col-sm-8">
      <input type="text" class="form-control" name="tb_ibu" value="<?php echo $row['tb_ibu'];?>" required>
    </div>
  </div>

  <div class="form-group">
    <label class="col-sm-4 control-label">Imunisasi</label>
    <div class="col-sm-8">
      <input type="text" class="form-control" name="imunisasi" value="<?php echo $row['imunisasi'];?>">
    </div>
  </div>

  <div class="form-group">
    <label class="col-sm-4 control-label">Vitamin</label>
    <div class="col-sm-8">
      <input type="text" class="form-control" name="vitamin" value="<?php echo $row['vitamin'];?>">
    </div>
  </div>

  <div class="form-group">
    <label class="col-sm-4 control-label">Saran</label>
    <div class="col-sm-8">
      <textarea class="form-control" name="saran" rows="3"><?php echo $row['saran'];?></textarea>
    </div>
  </div>

  <div class="form-group">
    <div class="col-sm-offset-4 col-sm-10">
      <input type="submit" class="btn btn-success" value="Update">
    </div>
  </div>
</form>
</div>

<?php } ?>