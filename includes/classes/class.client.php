<?php

class Client extends App {

    // ----------------------------------------------------------------------------------------------
    // CLIENTS

    public static function add($data) {
    	global $database;
    	$lastid = $database->insert("clients", [
            "name" => $data['name'],
            "branch_code" => $data['branch_code'],
            "alamat" => $data['alamat'],
            "pic" => $data['pic'],
            "phone_pic" => $data['phone_pic'],
            "kordinat" => $data['kordinat'],
            "status" => $data['status'],
            "asset_tag_prefix" => $data['asset_tag_prefix'],
            "license_tag_prefix" => $data['license_tag_prefix'],
            "id_customer" => $data['id_customer'],
            
        ]);
    	if ($lastid == "0") { return "11"; } else { logSystem("Client Added - ID: " . $lastid); return "10"; }
    }

    public static function edit($data) {
    	global $database;

        
            $database->update("clients", [
                "name" => $data['name'],
                "alamat" => $data['alamat'],
                "pic" => $data['pic'],
                "phone_pic" => $data['phone_pic'],
                "kordinat" => $data['kordinat'],
                "status" => $data['status'],
                "id_customer" => $data['id_customer'],
                "asset_tag_prefix" => $data['asset_tag_prefix'],
                "license_tag_prefix" => $data['license_tag_prefix']
            ], [ "id" => $data['id'] ]);
        

    	logSystem("Client Edited - ID: " . $data['id']);
    	return "20";
    }

    public static function delete($id) {
    	global $database;
        $database->delete("clients", [ "id" => $id ]);
    	logSystem("Client Deleted - ID: " . $id);
    	return "30";
    }


    public static function saveNotes($data) {
    	global $database;
    	$database->update("clients", [
    		"notes" => $data['notes']
    	], [ "id" => $data['id'] ]);
    	logSystem("Client Notes Updated - ID: " . $data['id']);
    	return "20";
    }


    public static function assignStaff($data) { //assign admin to client
    	global $database;
    	$lastid = $database->insert("clients_admins", [
    		"adminid" => $data['adminid'],
    		"clientid" => $data['clientid']
    	]);
    	if ($lastid == "0") { return "11"; } else { return "10"; }
    }

    public static function unassignStaff($id) { //unassign admin from client
    	global $database;
        $database->delete("clients_admins", [ "id" => $id ]);
    	return "30";
    }


}

?>
