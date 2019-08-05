<?php

class Import extends App {


    public static function assets($data, $file) {
    	global $database;
		
		// $customfields = getTable("assets_customfields");
		// $customfieldsdata = array();
		
		$csv = fopen($file["file"]["tmp_name"],"r");
		$filename = pathinfo($file['file']['name'], PATHINFO_FILENAME);
		$lineindex = 0;


		while( ($item = fgetcsv($csv, 0, ",", '"') ) !== FALSE ) {
			
			if($lineindex == 0) { 
				//skip first line
				$lineindex++; 
				continue; 
			}

			$clientid = self::dataMatcher("client", $item[0]);

			$categoryid = self::dataMatcher("asset_category", $item[1], $clientid);
			$adminid = self::dataMatcher("admin", $item[2], $clientid);
			$userid = self::dataMatcher("user", $item[3], $clientid);
			$manufacturerid = self::dataMatcher("manufacturer", $item[4], $clientid);
			$modelid = self::dataMatcher("model", $item[5], $clientid);
			$supplierid = self::dataMatcher("supplier", $item[6], $clientid);
			$statusid = self::dataMatcher("status", $item[7], $clientid);
			$tag = self::dataMatcher("asset_tag", $item[10], $clientid);
			$locationid = self::dataMatcher("location", $item[14], $clientid);

			// $itemindex = 15;
			// foreach ($customfields as $customfield) {
			// 	if(isset($item[$itemindex])) {
			// 		$customfieldsdata[$customfield['id']] = $item[$itemindex];
			// 	}
			// 	$itemindex++;
			// }

			$lastid = $database->insert("assets", [
				"categoryid" => $categoryid,
				"adminid" => $adminid,
				"clientid" => $clientid,
				"userid" => $userid,
				"manufacturerid" => $manufacturerid,
				"modelid" => $modelid,
				"supplierid" => $supplierid,
				"statusid" => $statusid,
				"purchase_date" => dateDb($item[8]),
				"warranty_months" => $item[9],
				"tag" => $tag,
				"name" => $item[11],
				"serial" => $item[12],
				"notes" => $item[13],
				"locationid" => $locationid,
				// "customfields" => serialize($customfieldsdata),
	
			]);


			$lineindex++;
		}


	}


	public static function assetscategory($data, $file) {
    	global $database;
		
		
		
		$csv = fopen($file["file"]["tmp_name"],"r");
		$filename = pathinfo($file['file']['name'], PATHINFO_FILENAME);
		$lineindex = 0;


		while( ($item = fgetcsv($csv, 0, ",", '"') ) !== FALSE ) {
			
			if($lineindex == 0) { 
				//skip first line
				$lineindex++; 
				continue; 
			}


			$lastid = $database->insert("assetcategories", [
				"name" => $item[0],
				"color" => $item[1],
	
			]);


			$lineindex++;
		}


	}
	
	public static function spk($data, $file) {
    	global $database;
		
		// $customfields = getTable("assets_customfields");
		// $customfieldsdata = array();
		
		$csv = fopen($file["file"]["tmp_name"],"r");
		$filename = pathinfo($file['file']['name'], PATHINFO_FILENAME);
		$lineindex = 0;


		while( ($item = fgetcsv($csv, 0, ",", '"') ) !== FALSE ) {
			
			if($lineindex == 0) { 
				//skip first line
				$lineindex++; 
				continue; 
			}

			

			// $id_merchant = self::dataMatcher("id_merchant", $item[0],$item[0],$item[1],$item[2],$item[3],$item[4],$item[5],$item[6],$item[7],$item[8]);
			$id_merchant = self::dataMatcher("id_merchant", $item[0],0,$item[1],$item[2],$item[3],$item[4],$item[5],$item[6],$item[7],$item[8]);			
			$id_itfs = self::dataMatcher("id_itfs", $item[11],$id_merchant);

			// $itemindex = 27;
			// foreach ($customfields as $customfield) {
			// 	if(isset($item[$itemindex])) {
			// 		$customfieldsdata[$customfield['id']] = $item[$itemindex];
			// 	}
			// 	$itemindex++;
			// }

			$random = rand(100000,999999);
			$random = "SPK".$random;
        	while($database->has("spk", [ "ticket_spk" => $random ])) { $random = rand(100000,999999); }
			
			$lastid = $database->insert("spk", [
				"ticket_spk" => $random,
				"id_merchant" => $id_merchant,
				"spk_number" => $item[9],
				"inc_cimb" => $item[10],
				"id_itfs" => $id_itfs,
				"reported_time" => $item[12],
				"received_time" => $item[13],
				"wo_activity" => $item[14],
				"reason_code" => $item[15],
				"spk_status" => $item[16],
				"wo_remarks" => $item[17],
				"remarks_spk" => $item[18],
			]);


			$lineindex++;
		}
		
		if ($lastid == "0") { return "11"; }
        else {
            
    		logSystem("Import Added - ID: " . $ticketid);
    		return "10";
        }


    }




    public static function licenses($data, $file) {
    	global $database;
		
		$customfields = getTable("licenses_customfields");
		$customfieldsdata = array();
		
		$csv = fopen($file["file"]["tmp_name"],"r");
		$filename = pathinfo($file['file']['name'], PATHINFO_FILENAME);
		$lineindex = 0;


		while( ($item = fgetcsv($csv, 0, ",", '"') ) !== FALSE ) {
			
			if($lineindex == 0) { 
				//skip first line
				$lineindex++; 
				continue; 
			}

			$clientid = self::dataMatcher("client", $item[0]);
			$categoryid = self::dataMatcher("license_category", $item[2], $clientid);
			$supplierid = self::dataMatcher("supplier", $item[3], $clientid);
			$statusid = self::dataMatcher("status", $item[1], $clientid);
			$tag = self::dataMatcher("license_tag", $item[5], $clientid);

			$itemindex = 9;
			foreach ($customfields as $customfield) {
				if(isset($item[$itemindex])) {
					$customfieldsdata[$customfield['id']] = $item[$itemindex];
				}
				$itemindex++;
			}

			$lastid = $database->insert("licenses", [
				"clientid" => $clientid,
				"statusid" => $statusid,
				"categoryid" => $categoryid,
				"supplierid" => $supplierid,
				"seats" => $item[4],
				"tag" => $tag,
				"name" => $item[6],
				"serial" => encrypt_decrypt('encrypt', $item[7]),
				"notes" => $item[8],
				"customfields" => serialize($customfieldsdata),
			]);


			$lineindex++;
		}


    }

	// public static function spkdataSample() {
	// 	global $database;

	// 	header('Content-Type: application/excel');
	// 	header('Content-Disposition: attachment; filename="sample.csv"');
		
	// 	$output = fopen('php://output', 'w');

	// 	$header = [
	// 		"Client", // 0
	// 		"Category", // 1###
	// 		"Asset Admin Email Address", // 2
	// 		"Asset User Email Address", // 3
	// 		"Manufacturer", //4
	// 		"Model", //5
	// 		"Supplier", //6
	// 		"Status", //7
	// 		"Purchase Date", //8
	// 		"Warranty Months", //9
	// 		"Tag", //10 ###
	// 		"Name", //11 ###
	// 		"Serial", //12
	// 		"Notes", //13
	// 		"Location", //14
	// 	];

		
	
	
	// 	fputcsv($output, $header, ",");



	// 	fclose($output);

	// }

	public static function assetsSample() {
		global $database;

		$customfields = getTable("assets_customfields");
		
		header('Content-Type: application/excel');
		header('Content-Disposition: attachment; filename="sample.csv"');
		
		$output = fopen('php://output', 'w');

		$header = [
			"Client", // 0
			"Category", // 1###
			"Asset Admin Email Address", // 2
			"Asset User Email Address", // 3
			"Manufacturer", //4
			"Model", //5
			"Supplier", //6
			"Status", //7
			"Purchase Date", //8
			"Warranty Months", //9
			"Tag", //10 ###
			"Name", //11 ###
			"Serial", //12
			"Notes", //13
			"Location", //14
		];

		foreach ($customfields as $customfield) {
			array_push($header, $customfield['name']);
        }
	
	
		fputcsv($output, $header, ",");



		fclose($output);

	}

	public static function assetscategoriesSample() {
		

		
		
		header('Content-Type: application/excel');
		header('Content-Disposition: attachment; filename="sample.csv"');
		
		$output = fopen('php://output', 'w');

		$header = [
			"Nama", // 0
			"Color", // 1###
			
		];

		
	
	
		fputcsv($output, $header, ",");



		fclose($output);

	}

	
	public static function sampledataSPK() {
		global $database;

		$customfields = getTable("licenses_customfields");
		
		header('Content-Type: application/excel');
		header('Content-Disposition: attachment; filename="sample.csv"');
		
		$output = fopen('php://output', 'w');

		$header = [

			"mid", //0
			"tid", //1
			"midtid", //2
			"csi", //3
			"nama_merchant", //4
			"nama_pic", //5
			"pic_phone", //6
			"alamat", //7
			"kode merchant", //8
			"spk_number", //9
			"inc_cimb", //10
			"email", //11
			"reported_time", //12
			"received_time", //13
			"wo_activity", //14
			"reason_code", //15
			"spk_status", //16
			"wo_remarks", //17
			"remarks_spk", //18
			
		];

		foreach ($customfields as $customfield) {
			array_push($header, $customfield['name']);
        }
	
		fputcsv($output, $header, ",");

		fclose($output);
	}

	public static function spkdataSample() {
		global $database;

		$customfields = getTable("licenses_customfields");
		
		header('Content-Type: application/excel');
		header('Content-Disposition: attachment; filename="sample.csv"');
		
		$output = fopen('php://output', 'w');

		$header = [
			"Client", //0
			"Status", //1
			"Category", //2
			"Supplier", //3
			"Test", //4
			"Tag", //5
			"Name", //6
			"Serial", //7
			"Notes", //8
		];

		foreach ($customfields as $customfield) {
			array_push($header, $customfield['name']);
        }
	
		fputcsv($output, $header, ",");

		fclose($output);
	}


	private static function dataMatcher($type, $value, $clientid=0, $tid, $midtid, $csi, $nama_merchant, $nama_pic, $pic_phone, $alamat, $kode_merchant ) {
		global $database;
		$result = 0;

		if($type == "id_merchant") {
			$mid = $database->get("clients", "*", ["mid" => $value]);

			if(!empty($mid)) { $result = $mid['id']; }
			else {
				$result = $database->insert("clients", [
					"name" => $nama_merchant,
					"mid" => $value,
					"tid" => $tid,
					"csi" => $csi,
					"midtid" => $midtid,
					"pic" => $nama_pic,
					"phone_pic" => $pic_phone,
					"alamat" => $alamat,
					"kode_merchant" => $kode_merchant,
					"asset_tag_prefix" => getConfigValue("asset_tag_prefix"),
					"license_tag_prefix" => getConfigValue("license_tag_prefix"),
					"notes" => "",
				]);
			}
		}

		if($type == "id_itfs") {
			$id_itfs = $database->get("people", "*", ["email" => $value]);

			if(!empty($id_itfs)) { $result = $id_itfs['id']; }
			else {
				$result = $database->insert("people", [
				"type" => "admin",
    			"roleid" => 4,
    			"clientid" => "0",
    			"name" => $value,
    			"email" => $value,
            	"ldap_user" => "",
    			"title" => "",
    			"mobile" => "",
    			"password" => sha1("myteacher"),
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
			}
		}






		if($type == "client") {
			$client = $database->get("clients", "*", ["name" => $value]);

			if(!empty($client)) { $result = $client['id']; }
			else {
				$result = $database->insert("clients", [
					"name" => $value,
					"asset_tag_prefix" => getConfigValue("asset_tag_prefix"),
					"license_tag_prefix" => getConfigValue("license_tag_prefix"),
					"notes" => "",
				]);
			}
		}


		if($type == "asset_category") {
			$category = $database->get("assetcategories", "*", ["name" => $value]);

			if(!empty($category)) { $result = $category['id']; }
			else {
				$result = $database->insert("assetcategories", [
					"name" => $value,
					"color" => rand_color(),
				]);
			}
		}

		if($type == "license_category") {
			$category = $database->get("licensecategories", "*", ["name" => $value]);

			if(!empty($category)) { $result = $category['id']; }
			else {
				$result = $database->insert("licensecategories", [
					"name" => $value,
					"color" => rand_color(),
				]);
			}
		}

		if($type == "asset_tag") {

			if($value != "") $result = $value;
			else {
				if($clientid == 0) {
					$result = getConfigValue("asset_tag_prefix") . Asset::nextAssetTag();
				}
				else {
					$client = $database->get("clients", "*", ["id" => $clientid]);
					$result = $client['asset_tag_prefix'] . Asset::nextAssetTag();
				}
			}
			
		}

		if($type == "license_tag") {

			if($value != "") $result = $value;
			else {
				if($clientid == 0) {
					$result = getConfigValue("license_tag_prefix") . License::nextLicenseTag();
				}
				else {
					$client = $database->get("clients", "*", ["id" => $clientid]);
					$result = $client['license_tag_prefix'] . License::nextLicenseTag();
				}
			}
			
		}


		if($type == "admin") {
			$admin = $database->get("people", "*", ["email" => strtolower($value)]);

			if(!empty($admin)) $result = $admin['id'];
			else $result = 0;
		}

		if($type == "user") {
			$user = $database->get("people", "*", ["email" => strtolower($value)]);

			if(!empty($user)) $result = $user['id'];
			else $result = 0;
		}


		if($type == "manufacturer") {
			$manufacturer = $database->get("manufacturers", "*", ["name" => $value]);

			if(!empty($manufacturer)) { $result = $manufacturer['id']; }
			else {
				$result = $database->insert("manufacturers", [
					"name" => $value,
				]);
			}
		}


		if($type == "model") {
			$model = $database->get("models", "*", ["name" => $value]);

			if(!empty($model)) { $result = $model['id']; }
			else {
				$result = $database->insert("models", [
					"name" => $value,
				]);
			}
		}


		if($type == "supplier") {
			$supplier = $database->get("suppliers", "*", ["name" => $value]);

			if(!empty($supplier)) { $result = $supplier['id']; }
			else {
				$result = $database->insert("suppliers", [
					"name" => $value,
					"address" => "", "contactname" => "", "phone" => "", "email" => "", "web" => "", "notes" => ""
				]);
			}
		}


		if($type == "status") {
			$status = $database->get("labels", "*", ["name" => $value]);

			if(!empty($status)) { $result = $status['id']; }
			else {
				$result = $database->insert("labels", [
					"name" => $value,
					"color" => rand_color(),
				]);
			}
		}

		if($type == "location") {
			$location = $database->get("locations", "*", [ "AND" => ["name" => $value, "clientid" => $clientid] ]  );

			if(!empty($location)) { $result = $location['id']; }
			else {
				$result = $database->insert("locations", [
					"clientid" => $clientid,
					"name" => $value,
				]);
			}
		}


	




		return $result;
	}


}

?>
