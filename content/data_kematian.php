<?php
// Aktifkan hanya saat debug
// error_reporting(E_ALL);
// ini_set('display_errors', 1);
include 'session_member.php';

if (!isset($_GET['act']) || $_GET['act'] == '') {
?>
<div class="col-md-12">
  <h4 style="text-align: center;">KEMATIAN IBU DAN ANAK</h4><hr>

  <div>
    <a href="?module=datakematian&act=tambah" class="btn btn-success">Tambah</a>
    <a href="?module=tambah_anak" class="btn btn-primary">+ Anak Baru</a>
    <br><br>
  </div>

  <?php
  // pagination
  $query  = mysql_query("SELECT COUNT(*) jumData FROM kematian");
  $data   = mysql_fetch_array($query);
  $jumlahData = $data['jumData'];

  $dataperPage = 5;
  $noPage = isset($_GET['hal']) ? (int)$_GET['hal'] : 1;
  $offset = ($noPage-1)*$dataperPage;
  ?>

  <div class="table-responsive">
    <table class="table table-bordered">
      <thead>
        <tr>
          <th>No.Kematian</th>
          <th>ID Anak</th>
          <th>Nama Anak</th>
          <th>Nama Ibu</th>
          <th>Tanggal Kematian</th>
          <th>Keterangan</th>
          <th width="140">Aksi</th>
        </tr>
      </thead>
      <tbody>
      <?php
      $tampil = mysql_query("
        SELECT  k.id_kematian,
                a.id_anak,
                a.nama_anak,
                a.nama_ibu,
                DATE_FORMAT(k.tanggal_kematian, '%d-%m-%Y') AS tanggal,
                k.keterangan
        FROM kematian k
        LEFT JOIN anak a ON k.id_anak = a.id_anak
        ORDER BY k.tanggal_kematian DESC
        LIMIT $offset, $dataperPage
      ");

      $rows = mysql_num_rows($tampil);
      if ($rows == 0) {
          echo '<tr><td colspan="7" class="text-center">Belum ada data kematian</td></tr>';
      } else {
          while ($row = mysql_fetch_array($tampil)) {
      ?>
        <tr>
          <td><?php echo $row['id_kematian']; ?></td>
          <td><?php echo $row['id_anak']; ?></td>
          <td><?php echo $row['nama_anak'] ?: '<em>-</em>'; ?></td>
          <td><?php echo $row['nama_ibu'] ?: '<em>-</em>'; ?></td>
          <td><?php echo $row['tanggal']; ?></td>
          <td><?php echo $row['keterangan']; ?></td>
          <td>
            <a href="?module=datakematian&act=edit&id=<?php echo $row['id_kematian']; ?>" class="btn btn-xs btn-default">Edit</a>
            <a href="content/aksi_kematian.php?module=datakematian&act=hapus&id=<?php echo $row['id_kematian']; ?>" onclick="return confirm('Yakin hapus?')" class="btn btn-xs btn-danger">Hapus</a>
          </td>
        </tr>
      <?php } } ?>
      </tbody>
    </table>

    <nav>
      <ul class="pagination">
        <?php
        $jumPage = ceil($jumlahData / $dataperPage);
        if ($noPage > 1) {
          echo '<li><a href="?module=datakematian&hal='.($noPage-1).'">&laquo;</a></li>';
        }
        for ($page = 1; $page <= $jumPage; $page++) {
          $showPage = 0;
          if ((($page >= $noPage-3) && ($page <= $noPage+3)) || ($page==1) || ($page==$jumPage)) {
            if (($showPage==1) && ($page!=2)) {
              echo '<li class="disabled"><a href="#">...</a></li>';
            }
            if (($showPage!=($jumPage-1)) && ($page==$jumPage)) {
              echo '<li class="disabled"><a href="#">...</a></li>';
            }
            if ($page==$noPage) {
              echo '<li class="disabled"><a href="#"><b>'.$page.'</b></a></li>';
            } else {
              echo '<li><a href="?module=datakematian&hal='.$page.'">'.$page.'</a></li>';
            }
            $showPage = $page;
          }
        }
        if ($noPage < $jumPage) {
          echo '<li><a href="?module=datakematian&hal='.($noPage+1).'">&raquo;</a></li>';
        }
        ?>
      </ul>
    </nav>
  </div>
</div>

<?php
} elseif ($_GET['act'] == 'tambah') {
  $q = mysql_query("SELECT MAX(id_kematian) AS maxID FROM kematian");
  $d = mysql_fetch_array($q);
  $no   = (int)substr($d['maxID'], 1, 4) + 1;
  $newID = 'K' . sprintf('%04s', $no);
?>

<h4 style="text-align: center;">INPUT DATA KEMATIAN</h4><hr><br>
<div class="col-md-6 col-sm-offset-2">
<form class="form-horizontal" method="post" action="content/aksi_kematian.php?module=datakematian&act=input">
  <div class="form-group">
    <label class="col-sm-4 control-label">No.Kematian</label>
    <div class="col-sm-8">
      <input type="text" class="form-control" readonly value="<?php echo $newID; ?>" name="id_kematian">
    </div>
  </div>

  <!-- ID Anak + AJAX auto-fill -->
  <div class="form-group">
    <label class="col-sm-4 control-label">ID Anak</label>
    <div class="col-sm-8">
      <input type="text" class="form-control" name="id_anak" id="id" oninput="isi_otomatis()" required>
    </div>
  </div>

  <div class="form-group">
    <label class="col-sm-4 control-label">Nama Anak</label>
    <div class="col-sm-8">
      <input type="text" class="form-control" name="nama_anak" id="nama_anak" readonly>
    </div>
  </div>

  <div class="form-group">
    <label class="col-sm-4 control-label">Tanggal Kematian</label>
    <div class="col-sm-8">
      <input type="date" class="form-control" name="tanggal_kematian" required>
    </div>
  </div>

  <div class="form-group">
    <label class="col-sm-4 control-label">Keterangan</label>
    <div class="col-sm-8">
      <textarea class="form-control" name="keterangan" rows="3"></textarea>
    </div>
  </div>

  <div class="form-group">
    <div class="col-sm-offset-4 col-sm-10">
      <input type="submit" class="btn btn-success" value="Simpan">
      <input type="reset" class="btn btn-danger" value="Reset">
    </div>
  </div>
</form>

<!-- JAVASCRIPT AJAX AUTO-FILL -->
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script>
function isi_otomatis() {
    var id_anak = $('#id').val();
    if (!id_anak) return;
    $.ajax({
        url: 'proses-ajax.php',
        type: 'GET',
        data: { id: id_anak },
        dataType: 'json',
        success: function (data) {
            $('#nama_anak').val(data.nama_anak || '');
        },
        error: function () {
            $('#nama_anak').val('');
        }
    });
}
</script>
</div>

<?php
} elseif ($_GET['act'] == 'edit') {
  $syarat = mysql_real_escape_string($_GET['id']);
  $data   = mysql_query("SELECT k.*, a.nama_anak FROM kematian k LEFT JOIN anak a ON k.id_anak=a.id_anak WHERE k.id_kematian='$syarat'");
  $row    = mysql_fetch_array($data);
?>

<h4 style="text-align: center;">EDIT DATA KEMATIAN</h4><hr><br>
<div class="col-md-6 col-sm-offset-2">
<form class="form-horizontal" method="post" action="content/aksi_kematian.php?module=datakematian&act=edit">
  <input type="hidden" name="id_kematian" value="<?php echo $row['id_kematian']; ?>">

  <div class="form-group">
    <label class="col-sm-4 control-label">ID Anak</label>
    <div class="col-sm-8">
      <input type="text" class="form-control" name="id_anak" id="id" value="<?php echo $row['id_anak']; ?>" readonly>
    </div>
  </div>

  <div class="form-group">
    <label class="col-sm-4 control-label">Nama Anak</label>
    <div class="col-sm-8">
      <input type="text" class="form-control" id="nama_anak" value="<?php echo $row['nama_anak']; ?>" readonly>
    </div>
  </div>

  <div class="form-group">
    <label class="col-sm-4 control-label">Tanggal Kematian</label>
    <div class="col-sm-8">
      <input type="date" class="form-control" name="tanggal_kematian" value="<?php echo $row['tanggal_kematian']; ?>">
    </div>
  </div>

  <div class="form-group">
    <label class="col-sm-4 control-label">Keterangan</label>
    <div class="col-sm-8">
      <textarea class="form-control" name="keterangan" rows="3"><?php echo $row['keterangan']; ?></textarea>
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