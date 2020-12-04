<?php

class Ticket extends App {

    // TICKETS

    public static function sla_aging($dataopen,$dataclosed){

        $startDate = new DateTime($dataopen);
        $endDate = new DateTime($dataclosed);
        $periodInterval = new DateInterval( "PT1H" );
    
        $period = new DatePeriod( $startDate, $periodInterval, $endDate );
        $count = 0;
    
        foreach($period as $date){
    
        $startofday = clone $date;
        $startofday->setTime(7,00);
    
        $endofday = clone $date;
        $endofday->setTime(17,00);
    
            if($date > $startofday && $date <= $endofday && !in_array($date->format('l'), array('Sunday','Saturday'))){
    
                $count++;
            }
    
        }
        
        //Get seconds of Start time
        $start_d = date("Y-m-d H:00:00", strtotime($dataopen));
        $start_d_seconds = strtotime($start_d);
        $start_t_seconds = strtotime($dataopen);
        $start_seconds = $start_t_seconds - $start_d_seconds;
                                
        //Get seconds of End time
        $end_d = date("Y-m-d H:00:00", strtotime($dataclosed));
        $end_d_seconds = strtotime($end_d);
        $end_t_seconds = strtotime($dataclosed);
        $end_seconds = $end_t_seconds - $end_d_seconds;
                                        
        $diff = $end_seconds-$start_seconds;
        
        if($diff!=0):
            $count--;
        endif;
            
        $total_min_sec = date('i:s',$diff);
        
        return $count .":".$total_min_sec;
    }
    

    public static function add($data) {
    	global $database;
    	if(empty($data['ccs'])) $ccs = ""; else $ccs = serialize($data['ccs']);

        if(!isset($data['userid'])) {
            $userid = $database->get("people","id", [ "email" => strtolower($data['email']) ]);
            if($userid == "") $userid = 0;
        } else {
            $userid = $data['userid'];
        }

        $random = rand(100000,999999);
        while($database->has("tickets", [ "ticket" => $random ])) { $random = rand(100000,999999); }

        if(isset($data['notes'])) $notes = $data['notes']; else $notes = "";

        if(isset($data['category_1'])) $category_1 = $data['category_1']; else $category_1 = 0;
        if(isset($data['category_2'])) $category_2 = $data['category_2']; else $category_2 = 0;
        if(isset($data['category_3'])) $category_3 = $data['category_3']; else $category_3 = 0;
        if(isset($data['device_problem'])) $device_problem = $data['device_problem']; else $device_problem = 0;

        if(isset($data['status'])) $statusticket = $data['status']; else $statusticket = 0;

        if(isset($data['close_by'])) $close_by = $data['close_by']; else $close_by = "Not Set";
        if(isset($data['projectid'])) $projectid = $data['projectid']; else $projectid = 0;
        if(isset($data['assetid'])) $assetid = $data['assetid']; else $assetid = 0;
        if(isset($data['clientid'])) $clientid = $data['clientid']; else $clientid = 0;

        if($data['adminid'] != "0") $peopleid = $data['adminid']; else $peopleid = 0;
        
        if($data['idcustomer'] == "2"){
            $ticketid = $database->insert("tickets", [
                "ticket" => $random,
                "departmentid" => 0,
                "clientid" => $clientid,
                "projectid" => $projectid,
                "assetid" => $assetid,
                "userid" => $userid,
                "adminid" => $peopleid,
                "email" => strtolower($data['email']),
                "idcustomer" => $data['idcustomer'],
                "subject" => $data['subject'],
                "status" => $statusticket,
                "device_problem" => $device_problem,
                "priority" => $data['priority'],
                "timestamp" => date('Y-m-d H:i:s'),
                "notes" => $notes,
                "ccs" => $ccs,
                "timespent" => 0,
            ]);

        } elseif($data['idcustomer'] == "6"){ //lenovo
            $ticketid = $database->insert("tickets", [
                "ticket" => $random,
                "departmentid" => 0,
                "clientid" => $clientid,
                "projectid" => $projectid,
                "assetid" => $assetid,
                "userid" => $userid,
                "adminid" => $peopleid,
                "email" => strtolower($data['email']),
                "idcustomer" => $data['idcustomer'],
                "subject" => $data['subject'],
                "status" => $statusticket,
                "priority" => $data['priority'],
                "timestamp" => date('Y-m-d H:i:s'),
                "notes" => $notes,
                "ccs" => $ccs,
                "timespent" => 0,
                "pic" => $data['pic'],
                "phone_pic" => $data['phone_pic'],
                "category_1" => $category_1,
                "customer_ticket" => $data['customer_ticket'],
                "create_on" => $data['create_on'],
                "response_time" => $data['response_time'],
                "part_received" => $data['part_received'],
                "departure_time" => $data['departure_time'],
                "arrival" => $data['arrival'],
                "start_working" => $data['start_working'],
                "closed_time" => $data['closed_time'],
                "category_2" => $category_2,
                "category_3" => $category_3,
                "device_problem" => $device_problem,
                "close_by" => $close_by,
                "serial_number" => $data['serial_number'],
                "action_ticket" => $data['action_ticket'],
                "description" => $data['description'],
                "visit" => $data['visit'],
            ]);
        }elseif($data['idcustomer'] == "7"){ //general
            $ticketid = $database->insert("tickets", [
                "ticket" => $random,
                "departmentid" => 0,
                "clientid" => $clientid,
                "projectid" => $projectid,
                "assetid" => $assetid,
                "userid" => $userid,
                "adminid" => $peopleid,
                "email" => strtolower($data['email']),
                "idcustomer" => $data['idcustomer'],
                "subject" => $data['subject'],
                "status" => $statusticket,
                "priority" => $data['priority'],
                "timestamp" => date('Y-m-d H:i:s'),
                "notes" => $notes,
                "ccs" => $ccs,
                "timespent" => 0,
                "pic" => $data['pic'],
                "phone_pic" => $data['phone_pic'],
                "category_1" => $category_1,
                "customer_ticket" => $data['customer_ticket'],
                "create_on" => $data['create_on'],
                "response_time" => $data['response_time'],
                "part_received" => $data['part_received'],
                "departure_time" => $data['departure_time'],
                "arrival" => $data['arrival'],
                "start_working" => $data['start_working'],
                "closed_time" => $data['closed_time'],
                "category_2" => $category_2,
                "category_3" => $category_3,
                "serial_number" => $data['serial_number'],
                "action_ticket" => $data['action_ticket'],
                "description" => $data['description'],

                "device_problem" => $data['device'],
                "sla" => $data['sla'],
                "parts" => $data['parts'],
                "backup_unit" => $data['backup_unit'],
                "sub_cust_name" => $data['sub_cust_name'],





            ]);
        } elseif($data['idcustomer'] == "5"){ //mcd
            $ticketid = $database->insert("tickets", [
                "ticket" => $random,
                "departmentid" => 0,
                "clientid" => $clientid,
                "projectid" => $projectid,
                "assetid" => $assetid,
                "userid" => $userid,
                "adminid" => $peopleid,
                "email" => strtolower($data['email']),
                "idcustomer" => $data['idcustomer'],
                "subject" => $data['subject'],
                "status" => $statusticket,
                "priority" => $data['priority'],
                "timestamp" => date('Y-m-d H:i:s'),
                "notes" => $notes,
                "ccs" => $ccs,
                "timespent" => 0,
                "pic" => $data['pic'],
                "phone_pic" => $data['phone_pic'],
                "category_1" => $category_1,
                "device_problem" => $device_problem,
                "customer_ticket" => $data['customer_ticket'],
                "create_on" => $data['create_on'],
                "response_time" => $data['response_time'],
                "part_received" => $data['part_received'],
                "departure_time" => $data['departure_time'],
                "arrival" => $data['arrival'],
                "start_working" => $data['start_working'],
                "closed_time" => $data['closed_time'],
                "category_2" => $category_2,
                "category_3" => $category_3,
                "close_by" => $close_by,
                "serial_number" => $data['serial_number'],
                "action_ticket" => $data['action_ticket'],
                "description" => $data['description'],
                "visit" => $data['visit'],
            ]);

        } else {
            $ticketid = $database->insert("tickets", [
                "ticket" => $random,
                "departmentid" => 0,
                "clientid" => $clientid,
                "projectid" => $projectid,
                "assetid" => $assetid,
                "userid" => $userid,
                "adminid" => $peopleid,
                "email" => strtolower($data['email']),
                "idcustomer" => $data['idcustomer'],
                "subject" => $data['subject'],
                "status" => $statusticket,
                "priority" => $data['priority'],
                "timestamp" => date('Y-m-d H:i:s'),
                "notes" => $notes,
                "ccs" => $ccs,
                "timespent" => 0,
                "pic" => $data['pic'],
                "phone_pic" => $data['phone_pic'],
                "category_1" => $category_1,
                "customer_ticket" => $data['customer_ticket'],
                "create_on" => $data['create_on'],
                "response_time" => $data['response_time'],
                "part_received" => $data['part_received'],
                "departure_time" => $data['departure_time'],
                "arrival" => $data['arrival'],
                "start_working" => $data['start_working'],
                "closed_time" => $data['closed_time'],
                "category_2" => $category_2,
                "category_3" => $category_3,
                "serial_number" => $data['serial_number'],
                "action_ticket" => $data['action_ticket'],
                "description" => $data['description'],
                "device_problem" => $data['device'],
                "sla" => $data['sla'],
                "parts" => $data['parts'],
                "backup_unit" => $data['backup_unit'],
                "sub_cust_name" => $data['sub_cust_name'],
                "eta" => $data['eta'],
                "alamat" => $data['alamat'],


                ]);
        }

    	$lastid = $database->insert("tickets_replies", [
    		"ticketid" => $ticketid,
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

    	if ($lastid == "0") { return "11"; }
        else {
            // user notification
    		if(isset($data['notification'])) { if($data['notification'] == true) Notification::ticketUser($ticketid, $data['message'], 1); }

            // admin notification
            // Notification::ticketStaff($ticketid, $data['message'], 7);
             Notification::notifFCM($data['adminid'],"New Ticket"."-".$random,$data['subject']);
            // log and return
    		logSystem("Ticket Added - ID: " . $ticketid);
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
            
            // Notification::notifFCM($peopleid,"test","isi test");

    		logSystem("Ticket Reply Added - ID: " . $lastid);
    		return "10"; }
    }

    public static function edit($data) {
    	global $database;
        if(empty($data['ccs'])) $ccs = ""; else $ccs = serialize($data['ccs']);
        if(isset($data['notes'])) $notes = $data['notes']; else $notes = "";

        if(isset($data['category_1'])) $category_1 = $data['category_1']; else $category_1 = 0;
        if(isset($data['category_2'])) $category_2 = $data['category_2']; else $category_2 = 0;
        if(isset($data['category_3'])) $category_3 = $data['category_3']; else $category_3 = 0;
        if(isset($data['status'])) $statusticket = $data['status']; else $statusticket = 0;
        if(isset($data['device_problem'])) $device_problem = $data['device_problem']; else $device_problem = 0;


        if(isset($data['close_by'])) $close_by = $data['close_by']; else $close_by = "Not Set";
        if(isset($data['projectid'])) $projectid = $data['projectid']; else $projectid = 0;
        if(isset($data['assetid'])) $assetid = $data['assetid']; else $assetid = 0;
        if(isset($data['clientid'])) $clientid = $data['clientid']; else $clientid = 0;

        if($data['adminid'] != "0") $peopleid = $data['adminid']; else $peopleid = 0;

        // $database->update("tickets", [
        //     "adminid" => $peopleid,
        //     "email" => strtolower($data['email']),
        //     "idcustomer" => $data['idcustomer'],
        //     "subject" => $data['subject'],
        //     "status" => $statusticket,
        //     "priority" => $data['priority'],
        //     "notes" => $notes,
        //     "ccs" => $ccs,
        //     "pic" => $data['pic'],
        //     "phone_pic" => $data['phone_pic'],
        //     "category_1" => $category_1,
        //     "customer_ticket" => $data['customer_ticket'],
        //     "create_on" => $data['create_on'],
        //     "response_time" => $data['response_time'],
        //     "part_received" => $data['part_received'],
        //     "departure_time" => $data['departure_time'],
        //     "arrival" => $data['arrival'],
        //     "start_working" => $data['start_working'],
        //     "closed_time" => $data['closed_time'],
        //     "category_2" => $category_2,
        //     "category_3" => $category_3,
        //     "close_by" => $close_by,
        //     "serial_number" => $data['serial_number'],
        //     "action_ticket" => $data['action_ticket'],
        //     "description" => $data['description'],
        //     "visit" => $data['visit'],
        // ],[ "id" => $data['id'] ]);

        if($data['idcustomer'] == "2"){
            $database->update("tickets", [
                "departmentid" => 0,
                "clientid" => $clientid,
                "projectid" => $projectid,
                "assetid" => $assetid,
                "userid" => $userid,
                "adminid" => $peopleid,
                "email" => strtolower($data['email']),
                "idcustomer" => $data['idcustomer'],
                "subject" => $data['subject'],
                "status" => $statusticket,
                "priority" => $data['priority'],
                "timestamp" => date('Y-m-d H:i:s'),
                "notes" => $notes,
                "ccs" => $ccs,
                "timespent" => 0,
            ],[ "id" => $data['id'] ]);

        } elseif($data['idcustomer'] == "6"){ //lenovo
            $database->update("tickets", [
                "adminid" => $peopleid,
                "email" => strtolower($data['email']),
                "idcustomer" => $data['idcustomer'],
                "subject" => $data['subject'],
                "status" => $statusticket,
                "priority" => $data['priority'],
                "notes" => $notes,
                "ccs" => $ccs,
                "pic" => $data['pic'],
                "phone_pic" => $data['phone_pic'],
                "category_1" => $category_1,

                "customer_ticket" => $data['customer_ticket'],
                "create_on" => $data['create_on'],
                "response_time" => $data['response_time'],
                "part_received" => $data['part_received'],
                "departure_time" => $data['departure_time'],
                "arrival" => $data['arrival'],
                "start_working" => $data['start_working'],
                "closed_time" => $data['closed_time'],
                "category_2" => $category_2,
                "category_3" => $category_3,
                "device_problem" => $device_problem,
                "close_by" => $close_by,
                "serial_number" => $data['serial_number'],
                "action_ticket" => $data['action_ticket'],
                "description" => $data['description'],
                "visit" => $data['visit'],
            ],[ "id" => $data['id'] ]);
        } elseif ($data['idcustomer'] == "5") { //mcd
            $database->update("tickets", [
                "adminid" => $peopleid,
                "email" => strtolower($data['email']),
                "idcustomer" => $data['idcustomer'],
                "subject" => $data['subject'],
                "status" => $statusticket,
                "priority" => $data['priority'],
                "notes" => $notes,
                "ccs" => $ccs,
                "pic" => $data['pic'],
                "device_problem" => $device_problem,

                "phone_pic" => $data['phone_pic'],
                "customer_ticket" => $data['customer_ticket'],
                "create_on" => $data['create_on'],
                "response_time" => $data['response_time'],
                "part_received" => $data['part_received'],
                "departure_time" => $data['departure_time'],
                "arrival" => $data['arrival'],
                "start_working" => $data['start_working'],
                "closed_time" => $data['closed_time'],
                "category_2" => $category_2,
                "close_by" => $close_by,
                "serial_number" => $data['serial_number'],
                "action_ticket" => $data['action_ticket'],
                "description" => $data['description'],
                "visit" => $data['visit'],
            ],[ "id" => $data['id'] ]);

        } elseif ($data['idcustomer'] == "7") { //general
            $database->update("tickets", [
                "adminid" => $peopleid,
                "email" => strtolower($data['email']),
                "idcustomer" => $data['idcustomer'],
                "subject" => $data['subject'],
                "status" => $statusticket,
                "priority" => $data['priority'],
                "notes" => $notes,
                "ccs" => $ccs,
                "pic" => $data['pic'],
                "phone_pic" => $data['phone_pic'],
                "category_1" => $category_1,
                "customer_ticket" => $data['customer_ticket'],
                "create_on" => $data['create_on'],
                "response_time" => $data['response_time'],
                "part_received" => $data['part_received'],
                "departure_time" => $data['departure_time'],
                "arrival" => $data['arrival'],
                "start_working" => $data['start_working'],
                "closed_time" => $data['closed_time'],
                "category_2" => $category_2,
                "category_3" => $category_3,
                "serial_number" => $data['serial_number'],
                "action_ticket" => $data['action_ticket'],
                "description" => $data['description'],


                "device_problem" => $data['device'],
                "sla" => $data['sla'],
                "parts" => $data['parts'],
                "backup_unit" => $data['backup_unit'],
                "sub_cust_name" => $data['sub_cust_name'],

            ],[ "id" => $data['id'] ]);

        } else {
            $database->update("tickets", [
                "adminid" => $peopleid,
                "email" => strtolower($data['email']),
                "idcustomer" => $data['idcustomer'],
                "subject" => $data['subject'],
                "status" => $statusticket,
                "priority" => $data['priority'],
                "notes" => $notes,
                "ccs" => $ccs,
                "pic" => $data['pic'],
                "phone_pic" => $data['phone_pic'],
                "category_1" => $category_1,
                "customer_ticket" => $data['customer_ticket'],
                "create_on" => $data['create_on'],
                "response_time" => $data['response_time'],
                "part_received" => $data['part_received'],
                "departure_time" => $data['departure_time'],
                "arrival" => $data['arrival'],
                "start_working" => $data['start_working'],
                "closed_time" => $data['closed_time'],
                "category_2" => $category_2,
                "category_3" => $category_3,
                "serial_number" => $data['serial_number'],
                "action_ticket" => $data['action_ticket'],
                "description" => $data['description'],


                "device_problem" => $data['device'],
                "sla" => $data['sla'],
                "parts" => $data['parts'],
                "backup_unit" => $data['backup_unit'],
                "sub_cust_name" => $data['sub_cust_name'],
                "eta" => $data['eta'],
                "alamat" => $data['alamat'],


            ],[ "id" => $data['id'] ]);

        }

        // $database->update("tickets", [
        //     "departmentid" => $data['departmentid'],
        //     "clientid" => $data['clientid'],
        //     "userid" => $data['userid'],
        //     "adminid" => $data['adminid'],
        //     "assetid" => $data['assetid'],
        //     "projectid" => $data['projectid'],
        //     "email" => $data['email'],
        //     "subject" => $data['subject'],
        //     "status" => $data['status'],
        //     "priority" => $data['priority'],
        //     "ccs" => $ccs,
        //     "notes" => $data['notes'],
        // ], [ "id" => $data['id'] ]);

        // if(isset($data['notes'])) {
        //     $database->update("tickets", [
        //         "departmentid" => $data['departmentid'],
        //         "clientid" => $data['clientid'],
        //         "userid" => $data['userid'],
        //         "adminid" => $data['adminid'],
        //         "assetid" => $data['assetid'],
        //         "projectid" => $data['projectid'],
        //         "email" => $data['email'],
        //         "subject" => $data['subject'],
        //         "status" => $data['status'],
        //         "priority" => $data['priority'],
        //         "ccs" => $ccs,
        //         "notes" => $data['notes'],
        //     ], [ "id" => $data['id'] ]);
        // } else {
        //     $database->update("tickets", [
        //         "departmentid" => $data['departmentid'],
        //         "clientid" => $data['clientid'],
        //         "userid" => $data['userid'],
        //         "adminid" => $data['adminid'],
        //         "assetid" => $data['assetid'],
        //         "projectid" => $data['projectid'],
        //         "email" => $data['email'],
        //         "subject" => $data['subject'],
        //         "status" => $data['status'],
        //         "priority" => $data['priority'],
        //         "ccs" => $ccs,

        //     ], [ "id" => $data['id'] ]);
        // }

    	logSystem("Ticket Edited - ID: " . $data['id']);
    	return "20";
        }
     
        public static function editAPI($data) {
            global $database;

            if(empty($data['ccs'])) $ccs = ""; else $ccs = serialize($data['ccs']);

            if(!isset($data['userid'])) {
                $userid = $database->get("people","id", [ "email" => strtolower($data['email']) ]);
                if($userid == "") $userid = 0;
            } else {
                $userid = $data['userid'];
            }

            if(isset($data['notes'])) $notes = $data['notes']; else $notes = "";

            if(isset($data['category_1'])) $category_1 = $data['category_1']; else $category_1 = 0;
            if(isset($data['category_2'])) $category_2 = $data['category_2']; else $category_2 = 0;
            if(isset($data['category_3'])) $category_3 = $data['category_3']; else $category_3 = 0;
            if(isset($data['status'])) $statusticket = $data['status']; else $statusticket = 0;
            if(isset($data['device_problem'])) $device_problem = $data['device_problem']; else $device_problem = 0;


            if(isset($data['close_by'])) $close_by = $data['close_by']; else $close_by = "Not Set";
            if(isset($data['projectid'])) $projectid = $data['projectid']; else $projectid = 0;
            if(isset($data['assetid'])) $assetid = $data['assetid']; else $assetid = 0;
            if(isset($data['clientid'])) $clientid = $data['clientid']; else $clientid = 0;

            if($data['adminid'] != "0") $peopleid = $data['adminid']; else $peopleid = 0;
            


            if($data['idcustomer'] == "2"){
                
                $database->update("tickets", [
                    "remarks_wo" => $data['remarks_wo'],
                    "root_cause" => $data['root_cause'],
                    "detail_cause" => $data['detail_cause'],
                    "collateral_qr" => $data['collateral_qr'],
                    "status" => $data['status'],
                ], [ "id" => $data['id'] ]);

                Staff::editLocation($data);

            } elseif($data['idcustomer'] == "6") {
                $database->update("tickets", [
                    "departmentid" => 0,
                    "clientid" => $clientid,
                    "projectid" => $projectid,
                    "assetid" => $assetid,
                    "userid" => $userid,
                    "adminid" => $peopleid,
                    "idcustomer" => $data['idcustomer'],
                    "status" => $statusticket,
                    "notes" => $notes,
                    "timespent" => 0,
                    "category_1" => $category_1,
                    "response_time" => $data['response_time'],
                    "part_received" => $data['part_received'],
                    "departure_time" => $data['departure_time'],
                    "arrival" => $data['arrival'],
                    "start_working" => $data['start_working'],
                    "closed_time" => $data['closed_time'],
                    "category_2" => $category_2,
                    "category_3" => $category_3,
                    "close_by" => $close_by,
                    "serial_number" => $data['serial_number'],
                    "action_ticket" => $data['action_ticket'],
                    "description" => $data['description'],
                    "visit" => $data['visit'],
                ], [ "id" => $data['id'] ]);

                Staff::editLocation($data);
            } elseif($data['idcustomer'] == "5") { // mcd

                $database->update("tickets", [
                    "departmentid" => 0,
                    "clientid" => $clientid,
                    "projectid" => $projectid,
                    "assetid" => $assetid,
                    "userid" => $userid,
                    "adminid" => $peopleid,
                    "idcustomer" => $data['idcustomer'],
                    "status" => $statusticket,
                    "notes" => $notes,
                    "timespent" => 0,
                    "device_problem" => $device_problem,
                    "response_time" => $data['response_time'],
                    "part_received" => $data['part_received'],
                    "departure_time" => $data['departure_time'],
                    "arrival" => $data['arrival'],
                    "start_working" => $data['start_working'],
                    "closed_time" => $data['closed_time'],
                    "category_2" => $category_2,
                    "close_by" => $close_by,
                    "serial_number" => $data['serial_number'],
                    "action_ticket" => $data['action_ticket'],
                    "description" => $data['description'],
                    "visit" => $data['visit'],
                ], [ "id" => $data['id'] ]);

                Staff::editLocation($data);

            } elseif($data['idcustomer'] == "7") { // btpns

                $database->update("tickets", [
                    "departmentid" => 0,
                    "clientid" => $clientid,
                    "projectid" => $projectid,
                    "assetid" => $assetid,
                    "userid" => $userid,
                    "adminid" => $peopleid,
                    "idcustomer" => $data['idcustomer'],
                    "status" => $statusticket,
                    "notes" => $notes,
                    "timespent" => 0,
                    "response_time" => $data['response_time'],
                    "part_received" => $data['part_received'],
                    "departure_time" => $data['departure_time'],
                    "arrival" => $data['arrival'],
                    "start_working" => $data['start_working'],
                    "closed_time" => $data['closed_time'],
                    "category_2" => $category_2,
                    "close_by" => $close_by,
                    "serial_number" => $data['serial_number'],
                    "action_ticket" => $data['action_ticket'],
                    "description" => $data['description'],
                    "visit" => $data['visit'],
                ], [ "id" => $data['id'] ]);

                Staff::editLocation($data);
                
            } else {
                $database->update("tickets", [
                    "departmentid" => 0,
                    "clientid" => $clientid,
                    "projectid" => $projectid,
                    "assetid" => $assetid,
                    "userid" => $userid,
                    "adminid" => $peopleid,
                    "idcustomer" => $data['idcustomer'],
                    "notes" => $notes,
                    "timespent" => 0,
                    "part_received" => $data['part_received'],
                    "serial_number" => $data['serial_number'],
                    "action_ticket" => $data['action_ticket'],
                    "parts" => $data['parts'],
                    "backup_unit" => $data['backup_unit'],



                ], [ "id" => $data['id'] ]);

                Staff::editLocation($data);

            }

            logSystem("Ticket Edited EDC API- ID: " . $data['id']);
            return "20";
            }
            
            public static function editAPIEDC($data) {
                global $database;
    
                    $database->update("tickets", [
                        "notes" => $data['notes'],
                        "code" => $data['code'],
                        "root_cause" => $data['root_cause'],
                        "collateral_qr" => $data['collateral_qr'],
                    ], [ "id" => $data['id'] ]);
    
                    Staff::editLocation($data);
                    
                logSystem("Ticket Edited EDC API- ID: " . $data['id']);
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

    public static function updateStatusAPI($data) {
    	global $database;
    	if($data['status'] == "Response"){
            $database->update("tickets", [
                "response_time" => date('Y-m-d H:i:s'),
                "status" => $data['status']
            ], [ "id" => $data['id'] ]);
            logSystem("Ticket Status Update API - ID: " . $data['id']);
            Staff::editLocation($data);
            self::updateRepliesApi($data);
            return "20";
        } else if($data['status'] == "In Progress"){
            $database->update("tickets", [
                "departure_time" => date('Y-m-d H:i:s'),
                "status" => $data['status']
            ], [ "id" => $data['id'] ]);
            logSystem("Ticket Status Update API - ID: " . $data['id']);
            Staff::editLocation($data);
            self::updateRepliesApi($data);
            return "20";
        } else if($data['status'] == "Close - Completed"){
            $tanggalopen = getSingleValue("tickets","timestamp",$data['id']);
            $tanggalopen2 = strtotime($tanggalopen);
            $closedtime = date('Y-m-d H:i:s');
            $closedtime2 = strtotime($closedtime);
            $datediff = $closedtime2 - $tanggalopen2;

            $hasil = round($datediff / (60 * 60 * 24));
            if($hasil <= 1){
                $slastatus = "Meet";
            } else {
                $slastatus = "Not Meet";
            }
            
            $database->update("tickets", [
                "closed_time" => $closedtime,
                "sla" => $hasil,
                "sla_status" => $slastatus,
                "status" => $data['status']
            ], [ "id" => $data['id'] ]);
            logSystem("Ticket Status Update API - ID: " . $data['id']);
            Staff::editLocation($data);
            self::updateRepliesApi($data);
            return "20";
        }


    }

    public static function updateStatusAPIGlobal($data) {
        global $database;
        
        $status = getSingleValue("status_tickets","name",$data['status']);

    	if($status == "Travel"){
            $database->update("tickets", [
                "departure_time" => date('Y-m-d H:i:s'),
                "status" => $data['status']
            ], [ "id" => $data['id'] ]);
            logSystem("Ticket Status Update API - ID: " . $data['id']);
            Staff::editLocation($data);
            self::updateRepliesApi($data);
            return "20";
        } else if($status == "Onsite"){
            $database->update("tickets", [
                "arrival" => date('Y-m-d H:i:s'),
                "status" => $data['status']
            ], [ "id" => $data['id'] ]);
            logSystem("Ticket Status Update API - ID: " . $data['id']);
            Staff::editLocation($data);
            self::updateRepliesApi($data);
            return "20";
        } else if($status == "Waiting Customer"){
            $database->update("tickets", [
                "status" => $data['status']
            ], [ "id" => $data['id'] ]);
            logSystem("Ticket Status Update API - ID: " . $data['id']);
            Staff::editLocation($data);
            self::updateRepliesApi($data);
            return "20";
        } else if($status == "Inprogress"){
            $database->update("tickets", [
                "start_working" => date('Y-m-d H:i:s'),
                "status" => $data['status']
            ], [ "id" => $data['id'] ]);
            logSystem("Ticket Status Update API - ID: " . $data['id']);
            Staff::editLocation($data);
            self::updateRepliesApi($data);
            return "20";
        } else if($status == "Closed"){
            $tanggalopen = getSingleValue("tickets","timestamp",$data['id']);
            $tanggalopen2 = strtotime($tanggalopen);
            $closedtime = date('Y-m-d H:i:s');
            $closedtime2 = strtotime($closedtime);
            $datediff = $closedtime2 - $tanggalopen2;

            $hasil = round($datediff / (60 * 60 * 24));
            if($hasil <= 1){
                $slastatus = "Meet";
            } else {
                $slastatus = "Not Meet";
            }
            
            $database->update("tickets", [
                "closed_time" => $closedtime,
                "sla" => $hasil,
                "sla_status" => $slastatus,
                "status" => $data['status']
            ], [ "id" => $data['id'] ]);
            logSystem("Ticket Status Update API - ID: " . $data['id']);
            Staff::editLocation($data);
            self::updateRepliesApi($data);
            return "20";
        } else {
            $database->update("tickets", [
                "status" => $data['status']
            ], [ "id" => $data['id'] ]);
            logSystem("Ticket Status Update API - ID: " . $data['id']);
            Staff::editLocation($data);
            self::updateRepliesApi($data);
            return "20";
        }


    }

    public static function updateRepliesApi($data){
        global $database;
        if($data['adminid'] != "0") $peopleid = $data['adminid']; else $peopleid = $userid;
        $status = getSingleValue("status_tickets","name",$data['status']);
        $type_tickets = getSingleValue("tickets","idcustomer",$data['id']);

        if ($type_tickets > 7){
            $message = "Status di ubah ke ".$status." dengan waktu ".date('Y-m-d H:i:s');
        } else {
            $message = "Status di ubah ke ".$data['status']." dengan waktu ".date('Y-m-d H:i:s');
        }


    	$lastid = $database->insert("tickets_replies", [
    		"ticketid" => $data['id'],
    		"peopleid" => $peopleid,
    		"message" => $message,
    		"timestamp" => date('Y-m-d H:i:s')
    	]);

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
