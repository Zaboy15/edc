<?php

class Consumable extends App {


    public static function add($data) {
		global $database;
		
		$lastid = $database->insert("tabel_consumable", [
			"name" => $data['name'],
			"detail" => $data['detail'],
			"type" => $data['type'],
		]);
		
		if ($lastid == "0") { return "11"; } else { logSystem("Tabel Consumable Added - ID: " . $lastid); return "10"; }

    	
	}



   

}


?>
