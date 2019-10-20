<?php

class Pemeriksaan extends App {

    // TICKETS


    public static function addPemeriksaanEDC($data) {
        global $database;
        
        if($data['seal_edc'] == false) $seal_edc = "false"; else $seal_edc = "true";
        if($data['seal_sim'] == false) $seal_sim = "false"; else $seal_sim = "true";
        if($data['simcard'] == false) $simcard = "false"; else $simcard = "true";
        if($data['transaksi_sale'] == false) $transaksi_sale = "false"; else $transaksi_sale = "true";
        if($data['transaksi_settlement'] == false) $transaksi_settlement = "false"; else $transaksi_settlement = "true";
        if($data['transaksi_emv'] == false) $transaksi_emv = "false"; else $transaksi_emv = "true";
        if($data['transaksi_void'] == false) $transaksi_void = "false"; else $transaksi_void = "true";
        if($data['transaksi_cicilan'] == false) $transaksi_cicilan = "false"; else $transaksi_cicilan = "true";
        if($data['printer_test'] == false) $printer_test = "false"; else $printer_test = "true";
        if($data['lcd'] == false) $lcd = "false"; else $lcd = "true";
        if($data['keypad'] == false) $keypad = "false"; else $keypad = "true";
        if($data['swipe_reader'] == false) $swipe_reader = "false"; else $swipe_reader = "true";
        if($data['chip_reader'] == false) $chip_reader = "false"; else $chip_reader = "true";

    
    	$pemeriksaanid = $database->insert("tabel_pemeriksaan", [
    		"idticket" => 0,
    		"idspk" => $data['idspk'],
            "seal_sim" => $seal_sim,
            "seal_edc" => $seal_edc,
            "simcard" => $simcard,
            "transaksi_sale" => $transaksi_sale,
            "transaksi_settlement" => $transaksi_settlement,
            "transaksi_emv" => $transaksi_emv,
            "transaksi_void" => $transaksi_void,
            "transaksi_cicilan" => $transaksi_cicilan,
            "printer_test" => $printer_test,
            "lcd" => $lcd,
            "keypad" => $keypad,
            "swipe_reader" => $swipe_reader,
            "chip_reader" => $chip_reader
            

    	]);

    	

        

    	if ($pemeriksaanid == "0") { return "11"; }
        else {
    		logSystem("Pemeriksaan Added - ID: " . $pemeriksaanid);
    		return "10";
        }

    }

    public static function addAPI($data) {
        global $database;
        
        if($data['seal_edc'] == false) $seal_edc = "false"; else $seal_edc = "true";
        if($data['seal_sim'] == false) $seal_sim = "false"; else $seal_sim = "true";
        if($data['simcard'] == false) $simcard = "false"; else $simcard = "true";
        if($data['transaksi_sale'] == false) $transaksi_sale = "false"; else $transaksi_sale = "true";
        if($data['transaksi_settlement'] == false) $transaksi_settlement = "false"; else $transaksi_settlement = "true";
        if($data['transaksi_emv'] == false) $transaksi_emv = "false"; else $transaksi_emv = "true";
        if($data['transaksi_void'] == false) $transaksi_void = "false"; else $transaksi_void = "true";
        if($data['transaksi_cicilan'] == false) $transaksi_cicilan = "false"; else $transaksi_cicilan = "true";
        if($data['printer_test'] == false) $printer_test = "false"; else $printer_test = "true";
        if($data['lcd'] == false) $lcd = "false"; else $lcd = "true";
        if($data['keypad'] == false) $keypad = "false"; else $keypad = "true";
        if($data['swipe_reader'] == false) $swipe_reader = "false"; else $swipe_reader = "true";
        if($data['chip_reader'] == false) $chip_reader = "false"; else $chip_reader = "true";

    
    	$pemeriksaanid = $database->insert("tabel_pemeriksaan", [
    		"idticket" => 0,
    		"idspk" => $data['idspk'],
            "seal_sim" => $data['seal_sim'],
            "seal_edc" => $data['seal_edc'],
            "simcard" => $data['simcard'],
            "transaksi_sale" => $data['transaksi_sale'],
            "transaksi_settlement" => $data['transaksi_settlement'],
            "transaksi_emv" => $data['transaksi_emv'],
            "transaksi_void" => $data['transaksi_void'],
            "transaksi_cicilan" => $data['transaksi_cicilan'],
            "printer_test" => $data['printer_test'],
            "lcd" => $data['lcd'],
            "keypad" => $data['keypad'],
            "swipe_reader" => $data['swipe_reader'],
            "chip_reader" => $data['chip_reader'],
            

    	]);

    	

        

    	if ($pemeriksaanid == "0") { return "11"; }
        else {
    		logSystem("Pemeriksaan Added - ID: " . $pemeriksaanid);
    		return "10";
        }

    }

    public static function addPublicTicket($postdata) {
        global $database;

        $data['departmentid'] = $postdata['departmentid'];
        $data['clientid'] = 0;
        $data['adminid'] = 0;
        $data['userid'] = 0;
        $data['assetid'] = 0;
        $data['projectid'] = 0;
        $data['ccs'] = "";

        $data['email'] = $postdata['email'];
        $data['subject'] = $postdata['subject'];
        $data['priority'] = $postdata['priority'];
        $data['message'] = $postdata['message'];


        // match user based on email address
        $data['userid'] = $database->get("people", "id", [ "AND" => [ "type" => "user", "email" => strtolower($data['email']) ] ]); if($data['userid'] == "") $data['userid'] = 0;

        // if we do not know the user we do not know the client
        if($data['userid'] == 0) $data['clientid'] = 0;

        // if we know the user try to assign some data to the ticket
        else {
            // get the user's assigned client
            $data['clientid'] = $database->get("people", "clientid", [ "AND" => [ "type" => "user", "email" => $data['email'] ] ]);

            // get the assigned asset ( it will return only the first one if there are more than one assigned )
            $asset = $database->get("assets","*",[ "userid" => $data['userid'] ]);
            if(!empty($asset['id'])) {
                // assign the asset if any found
                $data['assetid'] = $asset['id'];
                // assign the admin for that asset if found
                $data['adminid'] = $asset['adminid'];
            }

        }

        return self::add($data);
    }

    public static function addReply($data) {
    	global $database;
    	if($data['adminid'] != "0") $peopleid = $data['adminid']; else $peopleid = $data['userid'];

        // insert reply
    	$lastid = $database->insert("tickets_replies", [
    		"ticketid" => $data['ticketid'],
    		"peopleid" => $peopleid,
    		"message" => $data['message'],
    		"timestamp" => date('Y-m-d H:i:s')
    	]);

        if(isset($_FILES["file"]["name"][0])) {
            if(!empty($_FILES["file"]["name"][0])) {
                $file_data = array();
                $file_data['clientid'] = 0;
                $file_data['projectid'] = 0;
                $file_data['assetid'] = 0;
                $file_data['ticketreplyid'] = $lastid;
                File::upload($file_data,$_FILES);
            }
        }

        // update ticket status
    	if(isset($data['status'])) self::updateStatus($data['ticketid'],$data['status']);

    	if ($lastid == "0") {
            return "11";
        } else {
            // user notification
    		if(isset($data['notification'])) { if($data['notification'] == true) Notification::ticketUser($data['ticketid'],$data['message'],2); }

            // admin notification
    		if(getSingleValue("people","type",$peopleid) == "user") Notification::ticketStaff($data['ticketid'],$data['message'],8);

            // send admin notification if guest ticket
    		if($peopleid == "0") Notification::ticketStaff($data['ticketid'],$data['message'],8);

    		logSystem("Ticket Reply Added - ID: " . $lastid);
    		return "10"; }
    }

    public static function editPemeriksaanEDC($data) {
    	global $database;
        if($data['seal_edc'] == false) $seal_edc = "false"; else $seal_edc = "true";
        if($data['seal_sim'] == false) $seal_sim = "false"; else $seal_sim = "true";
        if($data['simcard'] == false) $simcard = "false"; else $simcard = "true";
        if($data['transaksi_sale'] == false) $transaksi_sale = "false"; else $transaksi_sale = "true";
        if($data['transaksi_settlement'] == false) $transaksi_settlement = "false"; else $transaksi_settlement = "true";
        if($data['transaksi_emv'] == false) $transaksi_emv = "false"; else $transaksi_emv = "true";
        if($data['transaksi_void'] == false) $transaksi_void = "false"; else $transaksi_void = "true";
        if($data['transaksi_cicilan'] == false) $transaksi_cicilan = "false"; else $transaksi_cicilan = "true";
        if($data['printer_test'] == false) $printer_test = "false"; else $printer_test = "true";
        if($data['lcd'] == false) $lcd = "false"; else $lcd = "true";
        if($data['keypad'] == false) $keypad = "false"; else $keypad = "true";
        if($data['swipe_reader'] == false) $swipe_reader = "false"; else $swipe_reader = "true";
        if($data['chip_reader'] == false) $chip_reader = "false"; else $chip_reader = "true";

            $database->update("tabel_pemeriksaan", [
                "idticket" => 0,
                "seal_sim" => $seal_sim,
                "seal_edc" => $seal_edc,
                "simcard" => $simcard,
                "transaksi_sale" => $transaksi_sale,
                "transaksi_settlement" => $transaksi_settlement,
                "transaksi_emv" => $transaksi_emv,
                "transaksi_void" => $transaksi_void,
                "transaksi_cicilan" => $transaksi_cicilan,
                "printer_test" => $printer_test,
                "lcd" => $lcd,
                "keypad" => $keypad,
                "swipe_reader" => $swipe_reader,
                "chip_reader" => $chip_reader,


            ], [ "idspk" => $data['idspk'] ]);
        

    	logSystem("Ticket Edited - ID: " . $data['id']);
    	return "20";
        }
        
        public static function editPemeriksaanEDCAPI($data) {
            global $database;
            if($data['seal_edc'] == false) $seal_edc = "false"; else $seal_edc = "true";
            if($data['seal_sim'] == false) $seal_sim = "false"; else $seal_sim = "true";
            if($data['simcard'] == false) $simcard = "false"; else $simcard = "true";
            if($data['transaksi_sale'] == false) $transaksi_sale = "false"; else $transaksi_sale = "true";
            if($data['transaksi_settlement'] == false) $transaksi_settlement = "false"; else $transaksi_settlement = "true";
            if($data['transaksi_emv'] == false) $transaksi_emv = "false"; else $transaksi_emv = "true";
            if($data['transaksi_void'] == false) $transaksi_void = "false"; else $transaksi_void = "true";
            if($data['transaksi_cicilan'] == false) $transaksi_cicilan = "false"; else $transaksi_cicilan = "true";
            if($data['printer_test'] == false) $printer_test = "false"; else $printer_test = "true";
            if($data['lcd'] == false) $lcd = "false"; else $lcd = "true";
            if($data['keypad'] == false) $keypad = "false"; else $keypad = "true";
            if($data['swipe_reader'] == false) $swipe_reader = "false"; else $swipe_reader = "true";
            if($data['chip_reader'] == false) $chip_reader = "false"; else $chip_reader = "true";
    
                $database->update("tabel_pemeriksaan", [
                    "idticket" => 0,
                    "seal_sim" => $seal_sim,
                    "seal_edc" => $seal_edc,
                    "simcard" => $simcard,
                    "transaksi_sale" => $transaksi_sale,
                    "transaksi_settlement" => $transaksi_settlement,
                    "transaksi_emv" => $transaksi_emv,
                    "transaksi_void" => $transaksi_void,
                    "transaksi_cicilan" => $transaksi_cicilan,
                    "printer_test" => $printer_test,
                    "lcd" => $lcd,
                    "keypad" => $keypad,
                    "swipe_reader" => $swipe_reader,
                    "chip_reader" => $chip_reader,
    
    
                ], [ "idspk" => $data['idspk'] ]);
            
    
            logSystem("Ticket Edited - ID: " . $data['id']);
            return "20";
            }

    public static function updateStatus($id,$status) {
    	global $database;
    	$database->update("tickets", [
    		"status" => $status
    	], [ "id" => $id ]);
    	logSystem("Ticket Status Update - ID: " . $id);
    	return "20";
    }

    public static function assignTo($id,$adminid) {
    	global $database;
    	$database->update("tickets", [
    		"adminid" => $adminid
    	], [ "id" => $id ]);
    	logSystem("Ticket Assigned - ID: " . $id);
    	return "20";
    }

    public static function updateNotes($data) {
    	global $database;
    	$database->update("tickets", [
    		"notes" => $data['notes']
    	], [ "id" => $data['id'] ]);
    	logSystem("Ticket Notes Update - ID: " . $data['id']);
    	return "20";
    }

    public static function delete($id) {
    	global $database;
        File::delete_ticket_files($id);

        $database->delete("tickets", [ "id" => $id ]);
    	$database->delete("tickets_replies", [ "ticketid" => $id ]);
    	logSystem("Ticket Deleted - ID: " . $id);
    	return "30";
    }

    public static function lastReply($id) {
    	global $database;
    	$maxdate = $database->max("tickets_replies", "timestamp", ["ticketid" => $id]);
    	$timestamp = strtotime($maxdate);
    	return smartDate($timestamp);
    }


    public static function lastReplyText($ticketid) {
    	global $database;
        $admins = $database->select("people", "id", ["type" => "admin"]);

    	$lastReplyText = $database->get("tickets_replies", "*",
            [ "AND" => [ "ticketid" => $ticketid, "peopleid" => $admins ], "ORDER" => [ "timestamp" => "DESC" ] ]
        );

    	if($lastReplyText['message']) return $lastReplyText['message']; else return "";

    }

    public static function lastReplyStamp($id) {
        global $database;
        $maxdate = $database->max("tickets_replies", "timestamp", ["ticketid" => $id]);
        $timestamp = $maxdate . " ";
        return $timestamp;
    }

    public static function extractEmail($string) { //extract first email address from string
    	$pattern = '/[\\w\\.\\-+=*_]*@[\\w\\.\\-+=*_]*/';
    	preg_match($pattern, $string, $matches);
        return $matches[0];
    }

    public static function emailToTicket($to,$from,$subject,$body,$importance,$ccs){

    	global $database;

        // initialize arrays
    	$data = array();
    	$data['ccs'] = array();

        // extracs ccs, if any
    	if(!empty($ccs)) {
    		foreach($ccs as $cc) {
    			$ccemail = self::extractEmail($cc);
    			array_push($data['ccs'],$ccemail);
    		}
    	}

        // extract from email address
    	$data['email'] = self::extractEmail($from);

        // match user based on email address
    	$data['userid'] = $database->get("people", "id", [ "AND" => [ "type" => "user", "email" => $data['email'] ] ]); if($data['userid'] == "") $data['userid'] = 0;

        // match admin based on email address
    	$data['adminid'] = $database->get("people", "id", [ "AND" => [ "type" => "admin", "email" => $data['email'] ] ]); if($data['adminid'] == "") $data['adminid'] = 0;

        // if email from user reopen ticket, if email from admin set status to answered
        if($data['adminid'] != 0) $data['status'] = "Answered"; else $data['status'] = "Reopened";

        // we do not know the asset at this time
    	$data['assetid'] = 0;

        // if we do not know the user we do not know the client
    	if($data['userid'] == 0) $data['clientid'] = 0;

        // if we know the user try to assign some data to the ticket
    	else {
            // get the user's assigned client
    		$data['clientid'] = $database->get("people", "clientid", [ "AND" => [ "type" => "user", "email" => $data['email'] ] ]);

            // get the assigned asset ( it will return only the first one if there are more than one assigned )
    		$asset = $database->get("assets","*",[ "userid" => $data['userid'] ]);
    		if(!empty($asset['id'])) {
                // assign the asset if any found
                $data['assetid'] = $asset['id'];
                // assign the admin for that asset if found
                $data['adminid'] = $asset['adminid'];
            }

    	}


    	$data['subject'] = $subject;
    	$data['priority'] = $importance;
    	$data['message'] = $body;
        $data['departmentid'] = getConfigValue("tickets_defaultdepartment");
        $data['projectid'] = 0;

        foreach($to as $item) {
            $toaddr = self::extractEmail($item);
            $department = $database->get("tickets_departments", "*", [ "email[~]" => $toaddr ] );
            if(!empty($department)) { $data['departmentid'] = $department['id']; break; }
        }

        // select all the tickets
    	$tickets = $database->select("tickets", ["id", "ticket"]);

        // see if we can get a ticket match
    	foreach($tickets as $ticket) {

    		if (strpos($subject,$ticket['ticket']) !== false) { // match found, will add as ticket reply
                $data['ticketid'] = $ticket['id'];

                // do not send user notification if user sent the reply
                $data['notification'] = false;

                // if admin made the reply send notification to user
                if ($data['status'] == "Answered") $data['notification'] = true;

                break; // exit the loop prematurely if we find a match

            } else { // no match, new ticket will be created
                $data['ticketid'] = 0;
                if(getConfigValue("tickets_notification") == "false") $data['notification'] = false;
                if(getConfigValue("tickets_notification") == "true") $data['notification'] = true;

            }

    	}

        // in case we have an empty ticket table
    	if(empty($tickets)) { $data['ticketid'] = 0; $data['notification'] = getConfigValue("tickets_notification"); }

    	if($data['ticketid'] == 0) {
            // no match, create new ticket
            self::add($data);
        } else {
            // match found, add reply to matched ticket
            self::addReply($data);
        }

        // return last ticket reply id, required by cron job
    	return $database->max("tickets_replies","id");
    }



    // ESCALATION RULES

    public static function addRule($data) {
    	global $database;
        if(isset($data['act_notifyadmins'])) $act_notifyadmins = 1; else $act_notifyadmins = 0;
        if(isset($data['act_addreply'])) $act_addreply = 1; else $act_addreply = 0;
        if(empty($data['cond_status'])) $cond_status = ""; else $cond_status = serialize($data['cond_status']);
        if(empty($data['cond_priority'])) $cond_priority = ""; else $cond_priority = serialize($data['cond_priority']);

        if($data['cond_datetime_date'] == "0000-00-00") $cond_datetime = $data['cond_datetime_date'] . " " . $data['cond_datetime_time'];
        else $cond_datetime = dateDb($data['cond_datetime_date']) . " " . $data['cond_datetime_time'];

    	$lastid = $database->insert("tickets_rules", [
    		"ticketid" => $data['ticketid'],
            "executed" => 0,
            "name" => $data['name'],
    		"cond_status" => $cond_status,
    		"cond_priority" => $cond_priority,
    		"cond_timeelapsed" => $data['cond_timeelapsed'],
    		"cond_datetime" => $cond_datetime,
    		"act_status" => $data['act_status'],
    		"act_priority" => $data['act_priority'],
            "act_assignto" => $data['act_assignto'],
            "act_notifyadmins" => $act_notifyadmins,
            "act_addreply" => $act_addreply,
            "reply" => $data['reply']
    	]);
    	if ($lastid == "0") { return "11"; } else { logSystem("Escalation Rule Added - ID: " . $lastid); return "10"; }
    	}


    public static function editRule($data) {
    	global $database;
        if(isset($data['act_notifyadmins'])) $act_notifyadmins = 1; else $act_notifyadmins = 0;
        if(isset($data['act_addreply'])) $act_addreply = 1; else $act_addreply = 0;
        if(empty($data['cond_status'])) $cond_status = ""; else $cond_status = serialize($data['cond_status']);
        if(empty($data['cond_priority'])) $cond_priority = ""; else $cond_priority = serialize($data['cond_priority']);

        if($data['cond_datetime_date'] == "0000-00-00") $cond_datetime = $data['cond_datetime_date'] . " " . $data['cond_datetime_time'];
        else $cond_datetime = dateDb($data['cond_datetime_date']) . " " . $data['cond_datetime_time'];

    	$database->update("tickets_rules", [
            "ticketid" => $data['ticketid'],
            "name" => $data['name'],
    		"cond_status" => $cond_status,
    		"cond_priority" => $cond_priority,
    		"cond_timeelapsed" => $data['cond_timeelapsed'],
    		"cond_datetime" => $cond_datetime,
    		"act_status" => $data['act_status'],
    		"act_priority" => $data['act_priority'],
            "act_assignto" => $data['act_assignto'],
            "act_notifyadmins" => $act_notifyadmins,
            "act_addreply" => $act_addreply,
            "reply" => $data['reply']
    	], [ "id" => $data['id'] ]);
    	logSystem("Escalation Rule Edited - ID: " . $data['id']);
    	return "20";
    	}



    public static function deleteRule($id) {
    	global $database;
        $database->delete("tickets_rules", [ "id" => $id ]);
    	logSystem("Esclation Rule Deleted - ID: " . $id);
    	return "30";
    	}


    public static function processRules() {
        global $database;
        $generalRules = getTableFiltered("tickets_rules","ticketid","0");
        $ticketRules = $database->select("tickets_rules", "*", [ "AND" => [ "ticketid[!]" => 0, "executed" => 0 ] ]);


        foreach ($generalRules as $rule) {
            if($rule['cond_status'] == "") $cond_status = ["Open","In Progress","Answered","Reopened","Closed"]; else $cond_status = unserialize($rule['cond_status']);
            if($rule['cond_priority'] == "") $cond_priority = ["Low","Normal","High"]; else $cond_priority = unserialize($rule['cond_priority']);

            $tickets = $database->select("tickets", "*", [ "AND" => [ "status" => $cond_status, "priority" => $cond_priority ] ]);

            foreach ($tickets as $ticket) {
                $lastreply = $database->max("tickets_replies", "timestamp", ["ticketid" => $ticket['id']]);

                $lastreply = strtotime($lastreply) / 60;
                $now = strtotime("now") / 60;
                $difference = $now - $lastreply;

                if ($rule['cond_timeelapsed'] == "" or $difference > $rule['cond_timeelapsed']) {
                    $message = "";
                    if($rule['act_status'] != "0") { $database->update("tickets", [ "status" => $rule['act_status'] ], [ "id" => $ticket['id'] ]); $message .= "Status changed to <b>" . $rule['act_status'] . "</b><br>"; }
                    if($rule['act_priority'] != "0") { $database->update("tickets", [ "priority" => $rule['act_priority'] ], [ "id" => $ticket['id'] ]); $message .= "Proirity changed to <b>" . $rule['act_priority'] . "</b><br>"; }
                    if($rule['act_assignto'] != "0") { $database->update("tickets", [ "adminid" => $rule['act_assignto'] ], [ "id" => $ticket['id'] ]); $message .= "Assigned to <b>" . getSingleValue("people","name",$rule['act_assignto']) . "</b><br>"; }
                    if($rule['act_addreply'] == "1") { $message .= "Reply added<br>";
                        $data = array();
                        $data['adminid'] = -1;
                        $data['ticketid'] = $ticket['id'];
                        $data['message'] = $rule['reply'];
                        $data['notification'] = true;
                        self::addReply($data);
                    }
                    if($rule['act_notifyadmins'] == "1") { Notification::ticketStaff($ticket['id'],$message,9); }
                }

            }

        }

        foreach ($ticketRules as $rule) {
            if($rule['cond_status'] == "") $cond_status = ["Open","In Progress","Answered","Reopened","Closed"]; else $cond_status = unserialize($rule['cond_status']);
            if($rule['cond_priority'] == "") $cond_priority = ["Low","Normal","High"]; else $cond_priority = unserialize($rule['cond_priority']);


            $ticket = $database->get("tickets","*",[ "id" => $rule['ticketid'] ]);

            if(in_array($ticket['status'],$cond_status) && in_array($ticket['priority'],$cond_priority)) {



                $processat = new DateTime($rule['cond_datetime']);
                $now = new DateTime(date("Y-m-d H:i:s"));


                if ($now->format('U') >= $processat->format('U')) {
                    $message = "";
                    if($rule['act_status'] != "0") { $database->update("tickets", [ "status" => $rule['act_status'] ], [ "id" => $ticket['id'] ]); $message .= "Status changed to <b>" . $rule['act_status'] . "</b><br>"; }
                    if($rule['act_priority'] != "0") { $database->update("tickets", [ "priority" => $rule['act_priority'] ], [ "id" => $ticket['id'] ]); $message .= "Proirity changed to <b>" . $rule['act_priority'] . "</b><br>"; }
                    if($rule['act_assignto'] != "0") { $database->update("tickets", [ "adminid" => $rule['act_assignto'] ], [ "id" => $ticket['id'] ]); $message .= "Assigned to <b>" . getSingleValue("people","name",$rule['act_assignto']) . "</b><br>"; }
                    if($rule['act_addreply'] == "1") { $message .= "Reply Added<br>";
                        $data = array();
                        $data['adminid'] = -1;
                        $data['ticketid'] = $ticket['id'];
                        $data['message'] = $rule['reply'];
                        $data['notification'] = true;
                        self::addReply($data);
                    }
                    if($rule['act_notifyadmins'] == "1") { Notification::ticketStaff($ticket['id'],$message,9); }

                    $database->update("tickets_rules", [ "executed" => 1 ], [ "id" => $rule['id'] ]);
                }
            }
        }

    }

    public static function autoClose() {
        global $database;
        $autoclose = getConfigValue("auto_close_tickets") * 3600;

        if($autoclose > 0) {
            $tickets = $database->select("tickets", "*", [ "status" => "Answered" ]);

            foreach ($tickets as $ticket) {
                $lastreply = $database->max("tickets_replies", "timestamp", ["ticketid" => $ticket['id']]);
                $lastreply = strtotime($lastreply);
                $now = strtotime("now");

                $difference = $now - $lastreply;

                if ($difference > $autoclose) {
                    self::updateStatus($ticket['id'],"Closed");
                    if( getConfigValue("auto_close_tickets_notify") == "true" ) Notification::ticketUser($ticket['id'],"",10);
                }
            }
        }
    }



}

?>
