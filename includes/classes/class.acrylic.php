<?php

class Acrylic extends App {


    public static function addLog($data) {
		global $database;
		
		$random = "A".rand(100000,999999);
		while($database->has("log_acrylic", [ "ticket_acrylic" => $random ])) { $random = "A".rand(100000,999999); }
		
		if($data['status'] == "Incoming"){

			$lastid = $database->insert("log_acrylic", [
				"ticket_acrylic" => $random,
				"date" => dateDb($data['date']),
				"qty" => $data['qty'],
				"id_type" => $data['id_type'],
				"status" => $data['status'],
				"remarks" => $data['remarks'],
				"id_itfs" => $data['id_itfs']
			]);
			
			
			$qtybefore = getSingleValue("tabel_consumable","qty",$data['id_type']);
			$hasil = $qtybefore + $data['qty'];
			$database->update("tabel_consumable", [
				"qty" => $hasil,
			], [ "id" => $data['id_type']]);
			
			
			if ($lastid == "0") { return "11"; } else { logSystem("Incoming Acrylic Added - ID: " . $lastid); return "10"; }
		
		} else {
			$lastid = $database->insert("log_acrylic", [
				"ticket_acrylic" => $random,
				"date" => dateDb($data['date']),
				"qty" => $data['qty'],
				"status" => $data['status'],
				"id_type" => $data['id_type'],
				"remarks" => $data['remarks'],
				"id_itfs" => $data['id_itfs']
			]);
			
			
			$qtybefore = getSingleValue("tabel_consumable","qty",$data['id_type']);
			$hasil = $qtybefore - $data['qty'];
			$database->update("tabel_consumable", [
				"qty" => $hasil,
			], [ "id" => $data['id_type'] ]);
			
			if ($lastid == "0") { return "11"; } else { logSystem("Outgoing Acrylic Added - ID: " . $lastid); return "10"; }
		}

    	
	}
	
    public static function delete($id) {
		global $database;
		$status = getSingleValue("log_acrylic","status",$id);
		$idtype = getSingleValue("log_acrylic","id_type",$id);
		$qtybefore = getSingleValue("tabel_consumable","qty",$idtype);
		$qtyback = getSingleValue("log_acrylic","qty",$id);
		if($status == "Incoming"){
			$hasil = $qtybefore - $qtyback;
			$database->update("tabel_consumable", [
				"qty" => $hasil,
			], [ "id" => $idtype ]);
			$database->delete("log_acrylic", [ "id" => $id ]);
			logSystem("Acrylic Log Deleted - ID: " . $id);
			return "30";
		} else {
			$hasil = $qtybefore + $qtyback;
			$database->update("tabel_consumable", [
				"qty" => $hasil,
			], [ "id" => $idtype ]);
			$database->delete("log_acrylic", [ "id" => $id ]);
			logSystem("Acrylic Log Deleted - ID: " . $id);
			return "30";

		}
		
		
    }

   

}


?>
