<?php
// Skrip berikut ini adalah skrip yang bertugas untuk meng-export data tadi ke excell
header("Content-type: application/vnd-ms-excel");
header("Content-Disposition: attachment; filename=spk_all.xls");
?>
<h3>Data SPK ALL</h3>
    
<table border="1" cellpadding="5">
  <tr>
  <th>No</th>
    <th>SPK Number</th>
    <th>Received Date SPK</th>
    <th>Received Date File Sticker</th>
    <th>Target Date SPK</th>
    <th>Target Date Bank</th>
    <th>Work Activity </th>
    <th>Merchant Name</th>
    <th>Alamat</th>
    <th>City</th>
    <th>Service Point</th>
    <th>MIDTID</th>
    <th>Master MID</th>
    <th>SPK Status</th>
    <th>WO Remarks</th>
    <th>Complete DateWO</th>
    <th>Remark SPK</th>
    <th>PIC Merchant</th>
    <th>Telp Merhant</th>
    <th>ITFS</th>
    <th>SLA Status</th>
    <th>BTS</th>
    <th>Root Cause</th>
    <th>Sub Root Cause</th>
    <th>MCC Description</th>
    <th>Month</th>
    <th>Year</th>
    <th>Day</th>
    <th>Aging</th>
  </tr>
  <?php
  // Load file koneksi.php
  include "koneksi.php";
  
  // Buat query untuk menampilkan semua data siswa
  $sql = $pdo->prepare("SELECT
  `a`.`id` AS `id`,
  `a`.`spk_number` AS `spk_number`,
  `a`.`received_time` AS `received_time`,
  `a`.`received_date_sticker` AS `received_date_sticker`,
  `a`.`target_spk` AS `target_spk`,
  `a`.`target_bank` AS `target_bank`,
  `a`.`wo_activity` AS `wo_activity`,
  `c`.`name` AS `namamerchant`,
  `c`.`alamat` AS `alamat`,
  `c`.`kota` AS `kota`,
  `a`.`city` AS `city`,
  `a`.`service_point` AS `service_point`,
  `a`.`midtid` AS `midtid`,
  `a`.`mid` AS `mid`,
  `a`.`spk_status` AS `spk_status`,
  `a`.`wo_remarks` AS `wo_remarks`,
  `a`.`c_date_wo` AS `c_date_wo`,
  `a`.`remarks_spk` AS `remarks_spk`,
  `c`.`pic` AS `pic`,
  `c`.`phone_pic` AS `phone_pic`,
  `a`.`id_itfs` AS `id_itfs`,
  `d`.`name` AS `namaitfs`,
  `a`.`bts` AS `bts`,
  `a`.`root_cause` AS `root_cause`,
  `a`.`sub_root_cause` AS `sub_root_cause`,
  `a`.`mmc_desc` AS `mmc_desc`,
  `a`.`month` AS `month`,
  `a`.`year` AS `year`,
  `a`.`day` AS `day`,
  `a`.`aging` AS `aging`
FROM
  (
      (
          (
              `u4580489_edc`.`spk` `a`
          JOIN `u4580489_edc`.`assets` `b`
          ON
              ((`a`.`id_sn_edc` = `b`.`id`))
          )
      JOIN `u4580489_edc`.`clients` `c`
      ON
          ((`a`.`id_merchant` = `c`.`id`))
      )
  LEFT JOIN `u4580489_edc`.`people` `d`
  ON
      ((`a`.`id_itfs` = `d`.`id`))
  )");
  $sql->execute(); // Eksekusi querynya
  
  $no = 1; // Untuk penomoran tabel, di awal set dengan 1
  while($data = $sql->fetch()){ // Ambil semua data dari hasil eksekusi $sql
    echo "<tr>";
    echo "<td>".$no."</td>";
    echo "<td>".$data['spk_number']."</td>";
    echo "<td>".$data['received_time']."</td>";
    echo "<td>".$data['received_date_sticker']."</td>";
    echo "<td>".$data['target_spk']."</td>";
    echo "<td>".$data['target_bank']."</td>";
    echo "<td>".$data['wo_activity']."</td>";
    echo "<td>".$data['namamerchant']."</td>";
    echo "<td>".$data['alamat']."</td>";
    echo "<td>".$data['city']."</td>";
    echo "<td>".$data['service_point']."</td>";
    echo "<td>".$data['midtid']."</td>";
    echo "<td>".$data['mid']."</td>";
    echo "<td>".$data['spk_status']."</td>";
    echo "<td>".$data['wo_remarks']."</td>";
    echo "<td>".$data['c_date_wo']."</td>";
    echo "<td>".$data['remarks_spk']."</td>";
    echo "<td>".$data['pic']."</td>";
    echo "<td>".$data['phone_pic']."</td>";
    echo "<td>".$data['namaitfs']."</td>";
    echo "<td>".$data['bts']."</td>";
    echo "<td>".$data['root_cause']."</td>";
    echo "<td>".$data['sub_root_cause']."</td>";
    echo "<td>".$data['mmc_desc']."</td>";
    echo "<td>".$data['month']."</td>";
    echo "<td>".$data['year']."</td>";
    echo "<td>".$data['day']."</td>";
    echo "<td>".$data['aging']."</td>";
    echo "</tr>";
    
    $no++; // Tambah 1 setiap kali looping
  }
  ?>
</table>


