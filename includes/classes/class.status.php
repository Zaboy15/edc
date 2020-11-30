<?php

class Status extends App {


    public static function add($data) {
    	global $database;
    	$lastid = $database->insert("status_tickets", [
    		"name" => $data['name'],
			"id_customer" => $data['id_customer'],
    		"timestamp" => date('Y-m-d H:i:s')
    	]);
    	if ($lastid == "0") { return "11"; } else { logSystem("Status Ticket Added - ID: " . $lastid); return "10"; }
	}
	
	


    public static function edit($data) {
    	global $database;
    	$database->update("status_tickets", [
    		"name" => $data['name'],
			"id_customer" => $data['id_customer']
    	], [ "id" => $data['id'] ]);
    	logSystem("Status Ticket Edited - ID: " . $data['id']);
    	return "20";
    	}


    public static function delete($id) {
    	global $database;
        $database->delete("status_tickets", [ "id" => $id ]);
    	logSystem("Status Ticket Deleted - ID: " . $id);
    	return "30";
    	}


}

?>
