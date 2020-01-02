<?php
// Skrip berikut ini adalah skrip yang bertugas untuk meng-export data tadi ke excell
header("Content-type: application/vnd-ms-excel");
header("Content-Disposition: attachment; filename=merchant.xls");
?>
<h3>Data Merchant</h3>
    
<table border="1" cellpadding="5">
  <tr>
    <th>No</th>
    <th>NAMA MERCHANT</th>
    <th>MID</th>
    <th>ALAMAT</th>
    <th>PIC</th>
    <th>PIC Phone</th>
  </tr>
  <?php
  // Load file koneksi.php
  include "koneksi.php";
  
  // Buat query untuk menampilkan semua data siswa
  $sql = $pdo->prepare("SELECT * FROM clients WHERE id_customer = 2");
  $sql->execute(); // Eksekusi querynya
  
  $no = 1; // Untuk penomoran tabel, di awal set dengan 1
  while($data = $sql->fetch()){ // Ambil semua data dari hasil eksekusi $sql
    echo "<tr>";
    echo "<td>".$no."</td>";
    echo "<td>".$data['name']."</td>";
    echo "<td>".$data['mid']."</td>";
    echo "<td>".$data['alamat']."</td>";
    echo "<td>".$data['pic']."</td>";
    echo "<td>".$data['phone_pic']."</td>";
    echo "</tr>";
    
    $no++; // Tambah 1 setiap kali looping
  }
  ?>
</table>


