<?php
// Skrip berikut ini adalah skrip yang bertugas untuk meng-export data tadi ke excell
header("Content-type: application/vnd-ms-excel");
header("Content-Disposition: attachment; filename=inventory_edc.xls");
?>
<h3>Data Inventory EDC</h3>
    
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
  $sql = $pdo->prepare("SELECT
  `b`.`id` AS `id`,
  `a`.`mid` AS `mid`,
  `a`.`name` AS `name`,
  `a`.`alamat` AS `alamat`,
  `a`.`pic` AS `pic`,
  `a`.`phone_pic` AS `phone_pic`,
  `b`.`midtid` AS `midtid`,
  `b`.`tid` AS `tid`,
  `b`.`csi` AS `csi`,
  `b`.`categoryid` AS `categoryid`,
  `b`.`serial` AS `serial`,
  `b`.`communication_line` AS `communication_line`,
  `b`.`sn_simcard` AS `sn_simcard`,
  `b`.`operator_sim` AS `operator_sim`
FROM
  (
      `u4580489_edc`.`clients` `a`
  JOIN `u4580489_edc`.`assets` `b`
  ON
      ((`a`.`id` = `b`.`clientid`))
  )
WHERE
  (`b`.`categoryid` = 6)");
  $sql->execute(); // Eksekusi querynya
  
  $no = 1; // Untuk penomoran tabel, di awal set dengan 1
  while($data = $sql->fetch()){ // Ambil semua data dari hasil eksekusi $sql
    echo "<tr>";
    echo "<td>".$no."</td>";
    echo "<td>".$data['name']."</td>";
    echo "<td>".$data['mid']."</td>";
    echo "<td>".$data['alamat']."</td>";
    echo "<td>".$data['pic']."</td>";
    echo "<td>".$data['tid']."</td>";
    echo "<td>".$data['midtid']."</td>";
    echo "<td>".$data['serial']."</td>";
    echo "<td>".$data['communication_line']."</td>";

    echo "</tr>";
    
    $no++; // Tambah 1 setiap kali looping
  }
  ?>
</table>


