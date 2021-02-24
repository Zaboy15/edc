<?php

class Absensi extends App {

    // ----------------------------------------------------------------------------------------------
    // CLIENTS

    

    public static function checkin($data) {
        global $database;



        $tanggalinputan = $data['check_in'];
        $dat = date('Y:m:d', $tanggalinputan);
		$enddate1 = date('Y-m-d 23:59:01', strtotime($tanggalinputan));
        $startdate1 = date('Y-m-d 00:00:01', strtotime($tanggalinputan));
        $cekabsenmasuk = $database->count("absensi",["AND" => ["staffid"=> $data['staffid'],"check_in[<>]" => [$startdate1, $enddate1]]]);
        if ($cekabsenmasuk > 0) {
            return "11";
            
        } else {
            $lastid = $database->insert("absensi", [
                "check_in" => $data['check_in'],
                "staffid" => $data['staffid'],
                "alasan_c_in" => $data['alasan_c_in'],
                "kordinat_in" => $data['kordinat_in'],
            ]);
            if ($lastid == "0") { return "11"; } else { logSystem("Check in Added - ID: " . $lastid); return "10"; }
    
        }
    }

    public static function addAbsenBackDate($data) {
        global $database;


		$hariini1 = date("Y:m:d");
        $startdate1 = $hariini1 . " 00:00:00";
		$enddate1 = $hariini1 . " 23:59:00";
        $cekabsenmasuk = $database->count("absensi",["AND" => ["staffid"=> $data['staffid'],"check_in[<>]" => [$startdate1, $enddate1]]]);
        if ($cekabsenmasuk > 0) {
            return "11";
            
        } else {
            $lastid = $database->insert("absensi", [
                "check_in" => $data['check_in'],
                "check_out" => $data['check_out'],
                "staffid" => $data['staffid'],
                "alasan_c_in" => $data['alasan_c_in'],
                "kordinat_out" => "-6.280688, 106.703048",
                "alasan_c_out" => $data['alasan_c_out'],
                "kordinat_in" => "-6.280688, 106.703048",
            ]);
            if ($lastid == "0") { return "11"; } else { logSystem("Check in Added - ID: " . $lastid); return "10"; }
    
        }
    }


    public static function checkout($data) {
        global $database;
        
            $database->update("absensi", [
                "check_out" => $data['check_out'],
                "kordinat_out" => $data['kordinat_out'],
                "alasan_c_out" => $data['alasan_c_out'],

            ], [ "id" => $data['id'] ]);
            logSystem("Check Out Added - ID: " . $data['id']);
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
