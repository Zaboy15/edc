<?php

class Notification extends App {


    public static function ticketUser($ticketid,$reply,$templateid) { //send ticket notification
        global $database;
    	$template = getRowById("notificationtemplates",$templateid);
    	$ticket = getRowById("tickets",$ticketid);
    	$ccs = array(); if($ticket['ccs'] != "") $ccs = unserialize($ticket['ccs']);

        $client = __('Unassigned');
        $department = __('Unassigned');

        if($ticket['clientid'] != 0) $client = getSingleValue("clients","name",$ticket['clientid']);
        if($ticket['departmentid'] != 0) $department = getSingleValue("tickets_departments","name",$ticket['departmentid']);

    	if($ticket['userid'] == 0) $contact = $ticket['email']; else $contact = getSingleValue("people","name",$ticket['userid']);

    	$search = array('{ticketid}', '{status}', '{subject}', '{contact}', '{message}', '{company}', '{appurl}', '{client}', '{department}');
    	$replace = array($ticket['ticket'], $ticket['status'], $ticket['subject'], $contact, $reply, getConfigValue("company_name"), getConfigValue("app_url"), $client, $department);

    	$subject = str_replace($search, $replace, $template['subject']);
    	$message = str_replace($search, $replace, $template['message']);

        // attachments
        $replyid = $database->max("tickets_replies", "id", ["ticketid" => $ticketid]);
        $attachments = $database->select("files", "id", ["ticketreplyid" => $replyid]);

    	sendEmail($ticket['email'],$subject,$message,$ticket['clientid'],$ticket['userid'],$ccs,$attachments);

        sendFCM($ticket['userid'], "Ticket Notification", $subject);
	}
	
	public static function notifFCM($peopleid,$title,$body) {
		global $database;
		// global $scriptpath;
	
		if($peopleid == "") return 0;
		if($peopleid == 0) return 0;
	
		$people = getSingleValue("people","tokenfcm",$peopleid);
		if(empty($people)) return 0;
	
		
			
	
			$ch = curl_init("https://fcm.googleapis.com/fcm/send");
			//The device token.
			$people1 = "f6DWcgGPyug:APA91bEd_9iDvqNuOIczmTpZIF2qlNVt3vlzwtGzetx56K5aIx-MM3z59eAZeeiPS-EADRXGrclf4xTYti8G1UWh5f-lVBuA9wq7rmsqt_oKwwDidyvKb6xXd3W3zyoBg4AQCltuRoCK"; //token here
			//  //Title of the Notification.
			// $title1 = "Title Notification";
			//  //Body of the Notification.
			// $body1 = "This is the body show Notification";
			//Creating the notification array.
			$notification = array('title' =>$title , 'text' => $body);
			//This array contains, the token and the notification. The 'to' attribute stores the token.
			$arrayToSend = array('to' => $people, 'notification' => $notification,'priority'=>'high');
			//Generating JSON encoded string form the above array.
			$json = json_encode($arrayToSend);
			//Setup headers:
			$headers = array();
			$headers[] = 'Content-Type: application/json';
			$headers[] = 'Authorization: key= AAAAHUoc7b4:APA91bHaVS11p_e2QZbfFC1RQIJed1BkOOybFhkv12BdvCUhHtB8bZkE_D14qKeoKsVkZ0IOcPNYfCF1afqRJ7yDsuEvfNdQPf-2-putkdGWfri0PdYsnQApU0qcx6xhuDPideXQl1Fh'; // key here
			//Setup curl, add headers and post parameters.
			curl_setopt($ch, CURLOPT_CUSTOMREQUEST, "POST");                                                                     
			curl_setopt($ch, CURLOPT_POSTFIELDS, $json);
			curl_setopt($ch, CURLOPT_HTTPHEADER,$headers);       
			//Send the request
			$response = curl_exec($ch);
			//Close request
			curl_close($ch);
	
			// $file = fopen($scriptpath . "/fcmlog.txt","a+");
			// fwrite($file,$response);
			// fclose($file);
	
			// curl_close ( $ch );
	
			return 1;
		
	
	}


    public static function ticketStaff($ticketid,$reply,$templateid) { //send ticket notification
        global $database;
    	$template = getRowById("notificationtemplates",$templateid);
    	$ticket = getRowById("tickets",$ticketid);

        $client = __('Unassigned');
        $department = __('Unassigned');

        if($ticket['clientid'] != 0) $client = getSingleValue("clients","name",$ticket['clientid']);
        if($ticket['departmentid'] != 0) $department = getSingleValue("tickets_departments","name",$ticket['departmentid']);

        if($ticket['userid'] == 0) $contact = $ticket['email']; else $contact = getSingleValue("people","name",$ticket['userid']);

    	$search = array('{ticketid}', '{status}', '{subject}', '{contact}', '{message}', '{company}', '{appurl}', '{client}', '{department}');
    	$replace = array($ticket['ticket'], $ticket['status'], $ticket['subject'], $contact, $reply, getConfigValue("company_name"), getConfigValue("app_url"), $client, $department);

    	$subject = str_replace($search, $replace, $template['subject']);
    	$message = str_replace($search, $replace, $template['message']);

        // attachments
        $replyid = $database->max("tickets_replies", "id", ["ticketid" => $ticketid]);
        $attachments = $database->select("files", "id", ["ticketreplyid" => $replyid]);

    	$admins = getTableFiltered("people","type","admin","ticketsnotification","1");
    	foreach($admins as $admin) {
    		sendEmail($admin['email'],$subject,$message,0,$admin['id'],$ccs=array(),$attachments);

            sendFCM($admin['id'], "Ticket Notification", $subject);
    	}
    }


    public static function newUser($peopleid,$password) { //send new user/admin notification
    	global $database;
    	$template = getRowById("notificationtemplates",3);
    	$people = getRowById("people",$peopleid);

    	$search = array('{contact}', '{email}', '{password}', '{company}', '{appurl}');
    	$replace = array($people['name'], $people['email'], $password, getConfigValue("company_name"), getConfigValue("app_url"));

    	$subject = str_replace($search, $replace, $template['subject']);
    	$message = str_replace($search, $replace, $template['message']);

    	sendEmail($people['email'],$subject,$message,$people['clientid'],$people['id']);
    }


    public static function passwordReset($peopleid,$resetlink) { //send password reset link
    	global $database;
    	$template = getRowById("notificationtemplates",5);
    	$people = getRowById("people",$peopleid);

    	$search = array('{contact}', '{resetlink}', '{company}', '{appurl}');
    	$replace = array($people['name'], $resetlink, getConfigValue("company_name"), getConfigValue("app_url"));

    	$subject = str_replace($search, $replace, $template['subject']);
    	$message = str_replace($search, $replace, $template['message']);

    	sendEmail($people['email'],$subject,$message,$people['clientid'],$people['id']);
    }


    public static function monitoringEmail($peopleid,$hostid,$hostinfo,$status) { //send monitoting email alert
    	global $database;
    	$template = getRowById("notificationtemplates",6);
    	$people = getRowById("people",$peopleid);
    	$host = getRowById("hosts",$hostid);

    	$search = array('{hostinfo}', '{status}', '{contact}', '{company}', '{appurl}');
    	$replace = array($hostinfo, $status, $people['name'], getConfigValue("company_name"), getConfigValue("app_url"));

    	$subject = str_replace($search, $replace, $template['subject']);
    	$message = str_replace($search, $replace, $template['message']);

    	sendEmail($people['email'],$subject,$message,$host['clientid'],$people['id']);
    }


    public static function monitoringSMS($peopleid,$hostid,$hostinfo,$status) { //send monitoring SMS alert
    	global $database;
    	$template = getRowById("notificationtemplates",6);
    	$people = getRowById("people",$peopleid);
    	$host = getRowById("hosts",$hostid);

    	$search = array('{hostinfo}', '{status}', '{contact}', '{company}', '{appurl}');
    	$replace = array($hostinfo, $status, $people['name'], getConfigValue("company_name"), getConfigValue("app_url"));

    	$sms = str_replace($search, $replace, $template['sms']);

    	sendSMS($people['mobile'],$sms,$host['clientid'],$people['id']);
    }


}


?>
