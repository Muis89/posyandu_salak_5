<?php
ob_start(); // mulai buffer output

// Koneksi database
include "../config/koneksi.php";

// Ambil semua data balita dari tabel anak
$query = mysql_query("SELECT id_anak, nama_anak, DATE_FORMAT(tanggal_lahir, '%d-%m-%Y') AS tanggal_lahir, jenis_kelamin, nama_ibu, nama_ayah, alamat, panjang_badan, berat_lahir, lingkar_kepala FROM anak ORDER BY nama_anak ASC");

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

  .table {
    width: 100%;
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
  <h3>LAPORAN DATA BALITA</h3>
  <p>Diunduh pada: <?= date('d-m-Y H:i:s') ?></p>
</div>

<table class="table" align="center">
  <thead>
    <tr>
      <th>NIB</th>
      <th>Nama</th>
      <th>Tgl Lahir</th>
      <th>JK</th>
      <th>Nama Ibu</th>
      <th>Nama Ayah</th>
      <th>Alamat</th>
      <th>Panjang Badan</th>
      <th>Berat Lahir</th>
      <th>Lingkar Kepala</th>
    </tr>
  </thead>
  <tbody>
    <?php while ($row = mysql_fetch_array($query)) { ?>
      <tr>
        <td><?= $row['id_anak'] ?></td>
        <td><?= $row['nama_anak'] ?></td>
        <td><?= $row['tanggal_lahir'] ?></td>
        <td><?= $row['jenis_kelamin'] ?></td>
        <td><?= $row['nama_ibu'] ?></td>
        <td><?= $row['nama_ayah'] ?></td>
        <td><?= $row['alamat'] ?></td>
        <td><?= $row['panjang_badan'] ?> cm</td>
        <td><?= $row['berat_lahir'] ?> gr</td>
        <td><?= $row['lingkar_kepala'] ?> cm</td>
      </tr>
    <?php } ?>
  </tbody>
</table>

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
  $html2pdf->Output('laporan-balita.pdf');
} catch (HTML2PDF_exception $e) {
  echo $e;
}
?>