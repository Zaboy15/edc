<?php

class Category extends App {


    public static function addCategory1($data) {
    	global $database;
    	$lastid = $database->insert("category_1", [
    		"name" => $data['name'],
			"id_customer" => $data['id_customer'],
    		"timestamp" => date('Y-m-d H:i:s')
    	]);
    	if ($lastid == "0") { return "11"; } else { logSystem("Category1 Added - ID: " . $lastid); return "10"; }
	}
	
	public static function addCategory2($data) {
    	global $database;
    	$lastid = $database->insert("category_2", [
    		"name" => $data['name'],
			"id_customer" => $data['id_customer'],
			"id_category_1" => $data['id_category_1'],
    		"timestamp" => date('Y-m-d H:i:s')
    	]);
    	if ($lastid == "0") { return "11"; } else { logSystem("Category2 Added - ID: " . $lastid); return "10"; }
	}
	
	public static function addCategory3($data) {
    	global $database;
    	$lastid = $database->insert("category_3", [
    		"name" => $data['name'],
			"id_customer" => $data['id_customer'],
			"id_category_1" => $data['id_category_1'],
			"id_category_2" => $data['id_category_2'],
    		"timestamp" => date('Y-m-d H:i:s')
    	]);
    	if ($lastid == "0") { return "11"; } else { logSystem("Category3 Added - ID: " . $lastid); return "10"; }
    }


    public static function edit($data) {
    	global $database;
    	$database->update("contacts", [
    		"name" => $data['name'],
    		"email" => $data['email'],
            "phone" => $data['phone'],
            "address" => $data['address'],
            "webaddress" => $data['webaddress'],
            "notes" => $data['notes']
    	], [ "id" => $data['id'] ]);
    	logSystem("Contact Edited - ID: " . $data['id']);
    	return "20";
    	}


    public static function delete($id) {
    	global $database;
        $database->delete("contacts", [ "id" => $id ]);
    	logSystem("Contact Deleted - ID: " . $id);
    	return "30";
    	}


}

?>
