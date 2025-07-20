<?php


$q = $_GET['term']; // variabel $q untuk mengambil inputan user
$sql = mysql_query("SELECT * FROM karyawan WHERE id_karyawan LIKE '%".$q."%'"); // menampilkan data yg ada didatabase yg sesuai dengan inputan user ( nik )
while ($data = mysql_fetch_array($sql)){
        
        $row['value']    =$data['id_karyawan'];
        $row['nama_karyawan']    =$data['nama_karyawan'];
        $row_set[]        =$row;
}
//echo json_encode($result);
echo json_encode($row_set);
?>