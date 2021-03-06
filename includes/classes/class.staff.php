<?php

class Staff extends App {

    public static function add($data) {
    	global $database;
    	$email = strtolower($data['email']);
		$count = $database->count("people",["email" => $email]);
		if(empty($data['project'])) $project = ""; else $project = serialize($data['project']);
    	if ($count == "1") { return "11"; }


    	$password = sha1($data['password']);
    	$lastid = $database->insert("people", [
    		"type" => "admin",
    		"roleid" => $data['roleid'],
    		"clientid" => "0",
    		"name" => $data['name'],
    		"email" => $email,
            "ldap_user" => $data['ldap_user'],
    		"title" => $data['title'],
    		"mobile" => $data['mobile'],
			"password" => $password,
			"project" => $project,
    		"theme" => "skin-blue",
    		"sidebar" => "opened",
    		"layout" => "",
    		"notes" => "",
    		"signature" => "",
    		"sessionid" => "",
    		"resetkey" => "",
    		"autorefresh" => 0,
    		"lang" => getConfigValue("default_lang"),
    		"ticketsnotification" => 1,

    		]);
    		if ($lastid == "0") { return "11"; } else {
    			if(isset($data['notification'])) { if($data['notification'] == true) Notification::newUser($lastid,$data['password']); }
    			logSystem("Staff Account Added - ID: " . $lastid);
    			return "10";
    		}
	}
	public static function edit($data) {
		global $database;
		if(empty($data['project'])) $project = ""; else $project = serialize($data['project']);
		
		$email = strtolower($data['email']);
		
		$customfields = getTable("staff_customfields");
        $customfieldsdata = array();

        foreach ($customfields as $customfield) {
            $customfieldsdata[$customfield['id']] = $data[$customfield['id']];
        }

    	if ($data['password'] == "") {
    		$database->update("people", [
    			"roleid" => $data['roleid'],
    			"name" => $data['name'],
    			"email" => $email,
                "ldap_user" => $data['ldap_user'],
    			"title" => $data['title'],
    			"mobile" => $data['mobile'],
    			"theme" => $data['theme'],
    			"sidebar" => $data['sidebar'],
    			"layout" => $data['layout'],
    			"notes" => $data['notes'],
    			"signature" => $data['signature'],
				"lang" => $data['lang'],
				"project" => $project,
    			"tokenfcm" => $data['tokenfcm'],
				"customfields" => serialize($customfieldsdata),
    			"ticketsnotification" => $data['ticketsnotification'],

    			],["id" => $data['id']]);
    		logSystem("Staff Account Edited - ID: " . $data['id']);
    		return "20";
    		}
    	else {
    		$password = sha1($data['password']);
    		$database->update("people", [
    			"roleid" => $data['roleid'],
    			"name" => $data['name'],
				"email" => $email,
				"project" => $project,
                "ldap_user" => $data['ldap_user'],
    			"title" => $data['title'],
    			"mobile" => $data['mobile'],
    			"password" => $password,
    			"theme" => $data['theme'],
    			"sidebar" => $data['sidebar'],
    			"layout" => $data['layout'],
    			"notes" => $data['notes'],
    			"signature" => $data['signature'],
				"lang" => $data['lang'],
    			"tokenfcm" => $data['tokenfcm'],
				"customfields" => serialize($customfieldsdata),
    			"ticketsnotification" => $data['ticketsnotification'],

    			],["id" => $data['id']]);
    		logSystem("Staff Account Edited - ID: " . $data['id']);
    		return "20";
    		}

	}

    public static function editAPI($data) {
    	global $database;
		$email = strtolower($data['email']);
		
		$customfields = getTable("staff_customfields");
        $customfieldsdata = array();

        foreach ($customfields as $customfield) {
            $customfieldsdata[$customfield['id']] = $data[$customfield['id']];
        }

    	if ($data['password'] == "") {
    		$database->update("people", [
    			"roleid" => $data['roleid'],
    			"name" => $data['name'],
    			"email" => $email,
                "ldap_user" => $data['ldap_user'],
    			"title" => $data['title'],
    			"mobile" => $data['mobile'],
    			"theme" => $data['theme'],
    			"sidebar" => $data['sidebar'],
    			"layout" => $data['layout'],
    			"notes" => $data['notes'],
    			"signature" => $data['signature'],
				"lang" => $data['lang'],
    			"tokenfcm" => $data['tokenfcm'],
				"customfields" => serialize($customfieldsdata),
    			"ticketsnotification" => $data['ticketsnotification'],

    			],["id" => $data['id']]);
    		logSystem("Staff Account Edited - ID: " . $data['id']);
    		return "20";
    		}
    	else {
    		$password = sha1($data['password']);
    		$database->update("people", [
    			"roleid" => $data['roleid'],
    			"name" => $data['name'],
    			"email" => $email,
                "ldap_user" => $data['ldap_user'],
    			"title" => $data['title'],
    			"mobile" => $data['mobile'],
    			"password" => $password,
    			"theme" => $data['theme'],
    			"sidebar" => $data['sidebar'],
    			"layout" => $data['layout'],
    			"notes" => $data['notes'],
    			"signature" => $data['signature'],
				"lang" => $data['lang'],
    			"tokenfcm" => $data['tokenfcm'],
				"customfields" => serialize($customfieldsdata),
    			"ticketsnotification" => $data['ticketsnotification'],

    			],["id" => $data['id']]);
    		logSystem("Staff Account Edited - ID: " . $data['id']);
    		return "20";
    		}

	}
	
	public static function editToken($data) {
    	global $database;
    	
    		$database->update("people", [
    			"tokenfcm" => $data['tokenfcm'],

    			],["id" => $data['id']]);
    		logSystem("Token FCM Account Update - ID: " . $data['id']);
    		return "20";
    		
    	

	}

	
	public static function editLocation($data) {
    	global $database;
    	if ($data['adminid'] == "") {
    		$database->update("people", [
				"latitude" => $data['latitude'],
    			"longtitude" => $data['longtitude'],
				

				],["id" => $data['id']]);
			
			$nama = getSingleValue("people","name",$data['id']);	
			$lastid = $database->insert("log_location", [
					"latitude" => $data['latitude'],
					"longtitude" =>  $data['longtitude'],
					"nama" => $nama,
					"adminid" => $data['id'],

			]);
			} else {

				$database->update("people", [
					"latitude" => $data['latitude'],
					"longtitude" => $data['longtitude'],
					
	
					],["id" => $data['adminid']]);
				
				$nama = getSingleValue("people","name",$data['adminid']);	
				$lastid = $database->insert("log_location", [
						"latitude" => $data['latitude'],
						"longtitude" =>  $data['longtitude'],
						"nama" => $nama,
						"adminid" => $data['adminid'],
	
				]);

			}

    		logSystem("Location Account Update - ID: " . $data['id']);
    		return "20";
    		
    	

	}

    public static function delete($id) {
    	global $database;
        $database->delete("people", [ "id" => $id ]);
    	logSystem("Staff Account Deleted - ID: " . $id);
    	return "30";
    }

}


?>
