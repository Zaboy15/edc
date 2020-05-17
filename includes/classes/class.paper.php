<?php

class Paper extends App {


    public static function addLog($data) {
		global $database;

		$random = "P".rand(100000,999999);
		while($database->has("log_paper", [ "ticket_paper" => $random ])) { $random = "P".rand(100000,999999); }
			
		
		if($data['status'] == "Incoming"){
			$lastid = $database->insert("log_paper", [
				"ticket_paper" => $random,
				"date" => dateDb($data['date']),
				"qty" => $data['qty'],
				"status" => $data['status'],
				"id_type" => $data['id_type'],
				"remarks" => $data['remarks'],
				"id_itfs" => $data['id_itfs']
			]);
			
			
			$qtybefore = getSingleValue("tabel_consumable","qty",$data['id_type']);
			$hasil = $qtybefore + $data['qty'];
			$database->update("tabel_consumable", [
				"qty" => $hasil,
			], [ "id" => $data['id_type'] ]);
			
			
			if ($lastid == "0") { return "11"; } else { logSystem("Incoming Paper Added - ID: " . $lastid); return "10"; }
		} else {

			$lastid = $database->insert("log_paper", [
				"ticket_paper" => $random,
				"date" => dateDb($data['date']),
				"qty" => $data['qty'],
				"id_type" => $data['id_type'],
				"status" => $data['status'],
				"remarks" => $data['remarks'],
				"id_itfs" => $data['id_itfs']
			]);
			
			
			$qtybefore = getSingleValue("tabel_consumable","qty",$data['id_type']);
			$hasil = $qtybefore - $data['qty'];
			$database->update("tabel_consumable", [
				"qty" => $hasil,
			], [ "id" => $data['id_type'] ]);
	
	
			$qtybeforeitfs = getSingleValue("people","paper_roll",$data['id_itfs']);
			$hasil = $qtybeforeitfs + $data['qty'];
			$database->update("people", [
				"paper_roll" => $hasil,
			], [ "id" => $data['id_itfs'] ]);
	
			
			if ($lastid == "0") { return "11"; } else { logSystem("Outgoing Paper Added - ID: " . $lastid); return "10"; }

		}
		
	}

    public static function delete($id) {
		global $database;
		$status = getSingleValue("log_paper","status",$id);
		$idtype = getSingleValue("log_paper","id_type",$id);
		$iditfs = getSingleValue("log_paper","id_itfs",$id);

		$qtybefore = getSingleValue("tabel_consumable","qty",$idtype);
		$qtyback = getSingleValue("log_paper","qty",$id);
		if($status == "Incoming"){
			$hasil = $qtybefore - $qtyback;
			$database->update("tabel_consumable", [
				"qty" => $hasil,
			], [ "id" => $idtype ]);
			$database->delete("log_paper", [ "id" => $id ]);
			logSystem("Acrylic Log Deleted - ID: " . $id);
			return "30";
		} else {
			$hasil = $qtybefore + $qtyback;
			$database->update("tabel_consumable", [
				"qty" => $hasil,
			], [ "id" => $idtype ]);

			$qtybeforeitfs = getSingleValue("people","paper_roll",$iditfs);
			$hasilitfs = $qtybeforeitfs - $qtyback;
			$database->update("people", [
				"paper_roll" => $hasilitfs,
			], [ "id" => $iditfs ]);


			$database->delete("log_paper", [ "id" => $id ]);

			

			logSystem("Paper Log Deleted - ID: " . $id);
			return "30";

		}
		
		
    }

}


?>
