<?php

class Customer extends App {

    // ----------------------------------------------------------------------------------------------
    // CLIENTS

    public static function add($data) {
    	global $database;
    	$lastid = $database->insert("tabel_customer", [
            "id_cust" => $data['id_cust'],
            "nama_customer" => $data['nama_customer'],
            "cost_center" => $data['cost_center'],
            "address" => $data['address'],
            "phone" => $data['phone'],
            "contact_person" => $data['contact_person'],
            "project_manager" => $data['project_manager'],

        ]);
    	if ($lastid == "0") { return "11"; } else { logSystem("Customer Added - ID: " . $lastid); return "10"; }
    }

    public static function edit($data) {
    	global $database;

            $database->update("tabel_customer", [
                "id_cust" => $data['id_cust'],
                "nama_customer" => $data['nama_customer'],
                "cost_center" => $data['cost_center'],
                "address" => $data['address'],
                "phone" => $data['phone'],
                "contact_person" => $data['contact_person'],
                "project_manager" => $data['project_manager'],
            ], [ "id" => $data['id'] ]);
        

    	logSystem("Customers Edited - ID: " . $data['id']);
    	return "20";
    }

    public static function delete($id) {
    	global $database;
        $database->delete("tabel_customer", [ "id" => $id ]);
    	logSystem("Customers Deleted - ID: " . $id);
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
