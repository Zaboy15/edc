<?php

class Paper extends App {


    public static function addIncoming($data) {
		global $database;
		
		$random = "P".rand(100000,999999);
		while($database->has("log_paper", [ "ticket_paper" => $random ])) { $random = "P".rand(100000,999999); }
		

    	$lastid = $database->insert("log_paper", [
    		"ticket_paper" => $random,
    		"incoming_date" => dateDb($data['incoming_date']),
			"incoming_qty" => $data['incoming_qty'],
    		"id_type" => $data['id_type'],
			"remarks" => $data['remarks'],
			"id_itfs" => $data['id_itfs']
		]);
		
		
		$qtybefore = getSingleValue("tabel_paperroll","qty",$data['id_type']);
		$hasil = $qtybefore + $data['incoming_qty'];
		$database->update("tabel_paperroll", [
			"qty" => $hasil,
		], [ "id" => $data['id_type'] ]);
		
		
    	if ($lastid == "0") { return "11"; } else { logSystem("Incoming Paper Added - ID: " . $lastid); return "10"; }
	}
	
	public static function addOutgoing($data) {
		global $database;
		
		$random = "P".rand(100000,999999);
		while($database->has("log_paper", [ "ticket_paper" => $random ])) { $random = "P".rand(100000,999999); }
		

    	$lastid = $database->insert("log_paper", [
    		"ticket_paper" => $random,
    		"outgoing_date" => dateDb($data['outgoing_date']),
			"outgoing_qty" => $data['outgoing_qty'],
    		"id_type" => $data['id_type'],
			"remarks" => $data['remarks'],
			"id_itfs" => $data['id_itfs']
		]);
		
		
		$qtybefore = getSingleValue("tabel_paperroll","qty",$data['id_type']);
		$hasil = $qtybefore - $data['outgoing_qty'];
		$database->update("tabel_paperroll", [
			"qty" => $hasil,
		], [ "id" => $data['id_type'] ]);


		$qtybeforeitfs = getSingleValue("people","paper_roll",$data['id_itfs']);
		$hasil = $qtybeforeitfs + $data['outgoing_qty'];
		$database->update("people", [
			"paper_roll" => $hasil,
		], [ "id" => $data['id_itfs'] ]);


		
		
    	if ($lastid == "0") { return "11"; } else { logSystem("Incoming Paper Added - ID: " . $lastid); return "10"; }
    }


    public static function edit($data) {
    	global $database;

        $customfields = getTable("licenses_customfields");
        $customfieldsdata = array();

        foreach ($customfields as $customfield) {
            $customfieldsdata[$customfield['id']] = $data[$customfield['id']];
        }

    	$database->update("licenses", [
    		"clientid" => $data['clientid'],
    		"statusid" => $data['statusid'],
    		"categoryid" => $data['categoryid'],
			"supplierid" => $data['supplierid'],
			"seats" => $data['seats'],
    		"tag" => $data['tag'],
    		"name" => $data['name'],
    		"serial" => encrypt_decrypt('encrypt', $data['serial']),
    		"notes" => $data['notes'],
            "customfields" => serialize($customfieldsdata),
            "qrvalue" => $data['qrvalue'],
    	], [ "id" => $data['id'] ]);
    	logSystem("License Edited - ID: " . $data['id']);
    	return "20";
    }

    public static function delete($id) {
    	global $database;
        $database->delete("licenses", [ "id" => $id ]);
    	logSystem("License Deleted - ID: " . $id);
    	return "30";
    }

    public static function nextLicenseTag() {
    	global $database;
        $max = $database->max("licenses", "id");
    	return $max+1;
    }


    public static function assignAsset($data) { //assign license to asset
    	global $database;
    	$lastid = $database->insert("licenses_assets", [
    		"licenseid" => $data['licenseid'],
    		"assetid" => $data['assetid']
    	]);
    	if ($lastid == "0") { return "11"; } else { return "10"; }
    }

    public static function unassignAsset($id) { //unassign license to asset
    	global $database;
        $database->delete("licenses_assets", [ "id" => $id ]);
    	return "30";
	}


	public static function countUsedSeats($id) { //unassign license to asset
    	global $database;
        return $database->count("licenses_assets", [ "licenseid" => $id ] );
	}
	
	public static function sisaLicense($id,$total) { //unassign license to asset
    	global $database;
		$terpakai = $database->count("licenses_assets", [ "licenseid" => $id ] );
		$sisa = $total-$terpakai;
		return $sisa;
    }

}


?>
