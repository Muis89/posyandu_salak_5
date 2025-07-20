<?php
// ---------- DEBUG (aktifkan bila perlu) ----------
// error_reporting(E_ALL);
// ini_set('display_errors', 1);

include 'session_member.php';

if (!isset($_GET['act']) || $_GET['act'] == '') {
?>
<div class="col-md-12">
  <h4 style="text-align: center;">DATA PENIMBANGAN</h4><hr>

  <div>
    <a href="?module=perbalita" class="btn btn-warning">Lihat Per Anak</a>
    <a href="?module=penimbangan&act=tambah" class="btn btn-success">Tambah</a>
    <a href="?module=dataanak&act=tambah" class="btn btn-primary">+ Anak Baru</a>
    <br><br>
  </div>

  <?php
  // pagination
  $query  = mysql_query("SELECT COUNT(*) jumData FROM penimbangan");
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
          <th>Kode Timbang</th>
          <th>ID Anak</th>
          <th>Nama Anak</th>
          <th>Tgl Timbang</th>
          <th>Usia (bln)</th>
          <th>Berat (kg)</th>
          <th>Tinggi (cm)</th>
          <th>Imunisasi</th>
          <th>Vitamin</th>
          <th width="170">Aksi</th>
        </tr>
      </thead>
      <tbody>
      <?php
      $tampil = mysql_query("
        SELECT  p.id_penimbangan,
                a.id_anak,
                a.nama_anak,
                DATE_FORMAT(p.tanggal_timbang, '%d-%m-%Y') AS tanggal,
                p.usia,
                p.berat_badan,
                p.tinggi_badan,
                i.jenis_imunisasi,
                v.jenis_vitamin
        FROM penimbangan p
        LEFT JOIN anak      a ON p.id_anak      = a.id_anak
        LEFT JOIN imunisasi i ON p.id_imunisasi = i.id_imunisasi
        LEFT JOIN vitamin   v ON p.id_vitamin   = v.id_vitamin
        ORDER BY p.tanggal_timbang DESC
        LIMIT $offset, $dataperPage
      ");

      $rows = mysql_num_rows($tampil);
      if ($rows == 0) {
          echo '<tr><td colspan="10" class="text-center">Belum ada data penimbangan</td></tr>';
      } else {
          while ($row = mysql_fetch_array($tampil)) {
      ?>
        <tr>
          <td><?php echo $row['id_penimbangan']; ?></td>
          <td><?php echo $row['id_anak']; ?></td>
          <td><?php echo $row['nama_anak'] ?: '<em>belum ada</em>'; ?></td>
          <td><?php echo $row['tanggal']; ?></td>
          <td><?php echo $row['usia']; ?></td>
          <td><?php echo $row['berat_badan']; ?></td>
          <td><?php echo $row['tinggi_badan']; ?></td>
          <td><?php echo $row['jenis_imunisasi'] ?: '-'; ?></td>
          <td><?php echo $row['jenis_vitamin'] ?: '-'; ?></td>
          <td>
            <a href="?module=penimbangan&act=edit&id=<?php echo $row['id_penimbangan']; ?>" class="btn btn-xs btn-default">Edit</a>
            <a href="content/aksi_penimbangan.php?module=timbang&act=hapus&id=<?php echo $row['id_penimbangan']; ?>" onclick="return confirm('Yakin hapus?')" class="btn btn-xs btn-danger">Hapus</a>
          </td>
        </tr>
      <?php } } ?>
      </tbody>
    </table>

    <nav>
      <ul class="pagination">
        <?php include 'content/view_penimbangan.php'; ?>
      </ul>
    </nav>
  </div>
</div>

<?php
} elseif ($_GET['act'] == 'tambah') {
  $q = mysql_query("SELECT MAX(id_penimbangan) AS maxID FROM penimbangan");
  $d = mysql_fetch_array($q);
  $no   = (int)substr($d['maxID'], 1, 4) + 1;
  $newID = 'P' . sprintf('%04s', $no);
?>

<h4 style="text-align: center;">INPUT DATA PENIMBANGAN</h4><hr><br>
<div class="col-md-6 col-sm-offset-2">
<form class="form-horizontal" method="post" action="content/aksi_penimbangan.php?module=timbang&act=input">
  <div class="form-group">
    <label class="col-sm-4 control-label">Kode Timbang</label>
    <div class="col-sm-8">
      <input type="text" class="form-control" readonly value="<?php echo $newID; ?>" name="id_penimbangan">
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
    <label class="col-sm-4 control-label">Tanggal Lahir</label>
    <div class="col-sm-8">
      <input type="date" class="form-control" name="tanggal_lahir" id="tanggal_lahir" readonly>
    </div>
  </div>

  <div class="form-group">
    <label class="col-sm-4 control-label">Tanggal Timbang</label>
    <div class="col-sm-8">
      <input type="date" class="form-control" name="tanggal_timbang" required>
    </div>
  </div>

  <div class="form-group">
    <label class="col-sm-4 control-label">Usia (bulan)</label>
    <div class="col-sm-8">
      <input type="number" class="form-control" name="usia" required>
    </div>
  </div>

  <div class="form-group">
    <label class="col-sm-4 control-label">Berat Badan (kg)</label>
    <div class="col-sm-8">
      <input type="number" step="0.01" class="form-control" name="beratbadan" required>
    </div>
  </div>

  <div class="form-group">
    <label class="col-sm-4 control-label">Tinggi Badan (cm)</label>
    <div class="col-sm-8">
      <input type="number" step="0.1" class="form-control" name="tinggi_badan" required>
    </div>
  </div>

  <div class="form-group">
    <label class="col-sm-4 control-label">Jenis Imunisasi</label>
    <div class="col-sm-8">
      <select name="id_imunisasi" class="form-control" required>
        <option value="">-- Pilih --</option>
        <?php
        $q = mysql_query("SELECT id_imunisasi, jenis_imunisasi FROM imunisasi ORDER BY jenis_imunisasi");
        while($w = mysql_fetch_array($q)){
          echo "<option value='{$w['id_imunisasi']}'>{$w['jenis_imunisasi']}</option>";
        } ?>
      </select>
    </div>
  </div>

  <div class="form-group">
    <label class="col-sm-4 control-label">Jenis Vitamin</label>
    <div class="col-sm-8">
      <select name="id_vitamin" class="form-control" required>
        <option value="">-- Pilih --</option>
        <?php
        $q = mysql_query("SELECT id_vitamin, jenis_vitamin FROM vitamin ORDER BY jenis_vitamin");
        while($w = mysql_fetch_array($q)){
          echo "<option value='{$w['id_vitamin']}'>{$w['jenis_vitamin']}</option>";
        } ?>
      </select>
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

<!-- JAVASCRIPT AJAX AUTO-FILL -->
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script>
function isi_otomatis() {
    var id_anak = $('#id').val();
    if (!id_anak) return;   // abaikan jika kosong

    $.ajax({
        url: 'proses-ajax.php',
        type: 'GET',
        data: { id: id_anak },
        dataType: 'json',
        success: function (data) {
            $('#nama_anak').val(data.nama_anak || '');
            $('#tanggal_lahir').val(data.tanggal_lahir || '');
        },
        error: function () {
            $('#nama_anak').val('');
            $('#tanggal_lahir').val('');
        }
    });
}
</script>
</div>

<?php } elseif ($_GET['act'] == 'edit') {
  // (kode edit sudah sama seperti sebelumnya)
  // ... copy dari langkah sebelumnya ...
} ?>