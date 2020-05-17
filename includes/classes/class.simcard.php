<?php

class Simcard extends App {


    public static function add($data) {
		global $database;
			$lastid = $database->insert("tabel_simcard", [
				"id_itfs" => $data['id_itfs'],
				"pic" => $data['pic'],
				"date_incoming" => dateDb($data['date_incoming']),
				"date_outgoing" => dateDb($data['date_outgoing']),
				"data_sim" => $data['data_sim'],
				"remarks" => $data['remarks'],
				"provider" => $data['provider'],
				"remarks" => $data['remarks'],
				"status" => $data['status']

			]);
			
			
			if ($lastid == "0") { return "11"; } else { logSystem("Simcard Added - ID: " . $lastid); return "10"; }
		
		
	}

	public static function delete($id) {
    	global $database;
        $database->delete("tabel_simcard", [ "id" => $id ]);
    	logSystem("Simcard Deleted - ID: " . $id);
    	return "30";
    }

}


?>
