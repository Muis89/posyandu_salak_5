<?php
ob_start(); // mulai buffer output

// Koneksi database
include "../config/koneksi.php";

// Query ambil data kematian
$sql = mysql_query("
    SELECT  
        k.id_kematian,
        a.id_anak,
        a.nama_anak,
        a.nama_ibu,
        DATE_FORMAT(k.tanggal_kematian, '%d-%m-%Y') AS tgl,
        k.keterangan
    FROM kematian k
    LEFT JOIN anak a ON k.id_anak = a.id_anak
    ORDER BY k.tanggal_kematian DESC
");
?>
<style>
  body {
    font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
    font-size: 12px;
    color: #333;
    margin: 0;
    padding: 0;
  }

  .header {
    text-align: center;
    margin-bottom: 25px;
    padding-bottom: 15px;
    border-bottom: 2px solid #ccc;
  }

  .header h3 {
    margin: 0;
    font-size: 18px;
    font-weight: bold;
    color: #2c3e50;
  }

  .header p {
    margin: 5px 0 0;
    font-size: 12px;
    color: #666;
  }

  .container {
    width: 100%;
    max-width: 95%;
    margin: 0 auto;
    padding: 0 10px;
  }

  .table {
    border-collapse: collapse;
    box-shadow: 0 2px 4px rgba(0,0,0,0.05);
    background-color: #fff;
  }

  .table th,
  .table td {
    border: 1px solid #ddd;
    padding: 8px 12px;
    vertical-align: top;
  }

  .table th {
    background-color: #f2f2f2;
    color: #333;
    text-align: center;
    font-weight: 600;
    text-transform: uppercase;
  }

  .table td {
    background-color: #fbfbfb;
  }

  .table tr:nth-child(even) td {
    background-color: #f9f9f9;
  }

  .footer-signature {
    margin-top: 40px;
    text-align: right;
    font-size: 13px;
    color: #333;
    padding-right: 30px;
  }

  .footer-signature p {
    margin: 5px 0;
  }
</style>

<div class="header">
  <h3>LAPORAN KEMATIAN IBU DAN ANAK</h3>
  <p>Diunduh pada: <?= date('d-m-Y H:i:s') ?></p>
</div>

<div class="container">
  <table class="table" align="center">
    <thead>
      <tr>
        <th>No</th>
        <th>No.Kematian</th>
        <th>ID Anak</th>
        <th>Nama Anak</th>
        <th>Nama Ibu</th>
        <th>Tanggal Kematian</th>
        <th>Keterangan</th>
      </tr>
    </thead>
    <tbody>
      <?php $no = 1; while ($r = mysql_fetch_array($sql)) { ?>
        <tr>
          <td><?= $no++ ?></td>
          <td><?= $r['id_kematian'] ?></td>
          <td><?= $r['id_anak'] ?></td>
          <td><?= $r['nama_anak'] ?: '-' ?></td>
          <td><?= $r['nama_ibu'] ?: '-' ?></td>
          <td><?= $r['tgl'] ?></td>
          <td><?= $r['keterangan'] ?></td>
        </tr>
      <?php } ?>
    </tbody>
  </table>
</div>

<div class="footer-signature">
  <p>_________________________</p>
  <p>Kepala Posyandu</p>
</div>

<?php
$content = ob_get_clean();

// Conversion HTML => PDF
require_once(dirname(__FILE__).'/html2pdf/html2pdf.class.php');
try {
  $html2pdf = new HTML2PDF('L','A4', 'fr', false, 'ISO-8859-15');
  $html2pdf->writeHTML($content, isset($_GET['vuehtml']));
  $html2pdf->Output('laporan-kematian.pdf');
} catch (HTML2PDF_exception $e) {
  echo $e;
}
?>
