<?php

##################################
###       QUICK ACTIONS        ###
##################################


switch($_GET['qa']) {

	case "deleteWhatsapp":
        Whatsapp::deleteWhatsapp();
        header("Location:?route=whatsapp/whatsapp");
		break;
		
	case "deleteWhatsappOne":
		Whatsapp::deleteWhatsappOne($_GET['id']);
		header("Location:?route=whatsapp/whatsapp");
		break;

	case "deleteWhatsapp2":
		Whatsapp::deleteWhatsapp2($_GET['id']);
		header("Location:?route=whatsapp/whatsapp2");
		break;

	case "ticketClose":
        Ticket::updateStatus($_GET['id'],"Closed");
        header("Location:?route=".$_GET['reroute']."&id=".$_GET['routeid']);
        break;

	case "ticketReopen":
        Ticket::updateStatus($_GET['id'],"Reopened");
        header("Location:?route=".$_GET['reroute']."&id=".$_GET['routeid']);
        break;

	case "ticketAssignToMe":
        Ticket::assignTo($_GET['id'],$liu['id']);
        header("Location:?route=".$_GET['reroute']."&id=".$_GET['routeid']);
        break;

	case "getTicketReply":
        echo getSingleValue("tickets_replies","message",$_GET['id']);
        break;

    case "getUserEmail":
        echo getSingleValue("people","email",$_GET['id']);
    break;

	case "getPReply":
		echo getSingleValue("tickets_pr","content",$_GET['id']);
	break;

	case "setAutorefresh":
        Profile::setAutorefresh($liu['id'],$_GET['autorefresh']);
        header("Location:?route=".$_GET['reroute']."&id=".$_GET['routeid']."&section=".$_GET['section']);
    break;

	case "removeAvatar":
        Profile::removeAvatar($liu['id']);
        header("Location:?route=profile");
    break;

    case "updateIssueStatus":
        Issue::updateStatus($_POST['issueid'],$_POST['status']);
    break;


    case "download":
        $file = getRowById("files",$_GET['id']);
        $targetfile = $scriptpath . DIRECTORY_SEPARATOR . "uploads" . DIRECTORY_SEPARATOR . $file['file'];
        if (file_exists($targetfile)) {
            header('Content-Description: File Transfer');
            header('Content-Type: application/octet-stream');
            header('Content-Disposition: attachment; filename="' . $file['file'] . '"');
            header('Expires: 0');
            header('Cache-Control: must-revalidate');
            header('Pragma: public');
            header('Content-Length: ' . filesize($targetfile));
            readfile($targetfile);
            exit;
            }
        else echo _e("File does not exist.");
	break;

	case "signspk":
        $file = getRowById("spk",$_GET['id']);
        $targetfile = $scriptpath . DIRECTORY_SEPARATOR . "uploads" . DIRECTORY_SEPARATOR . $file['sign'];
        if (file_exists($targetfile)) {
            header('Content-Description: File Transfer');
            header('Content-Type: application/octet-stream');
            header('Content-Disposition: attachment; filename="' . $file['sign'] . '"');
            header('Expires: 0');
            header('Cache-Control: must-revalidate');
            header('Pragma: public');
            header('Content-Length: ' . filesize($targetfile));
            readfile($targetfile);
            exit;
            }
        else echo _e("File does not exist.");
	break;

	case "signticket":
        $file = getRowById("tickets",$_GET['id']);
        $targetfile = $scriptpath . DIRECTORY_SEPARATOR . "uploads" . DIRECTORY_SEPARATOR . $file['sign'];
        if (file_exists($targetfile)) {
            header('Content-Description: File Transfer');
            header('Content-Type: application/octet-stream');
            header('Content-Disposition: attachment; filename="' . $file['sign'] . '"');
            header('Expires: 0');
            header('Cache-Control: must-revalidate');
            header('Pragma: public');
            header('Content-Length: ' . filesize($targetfile));
            readfile($targetfile);
            exit;
            }
        else echo _e("File does not exist.");
	break;

	case "fototoko":
        $file = getRowById("spk",$_GET['id']);
        $targetfile = $scriptpath . DIRECTORY_SEPARATOR . "uploads" . DIRECTORY_SEPARATOR . $file['foto_toko'];
        if (file_exists($targetfile)) {
            header('Content-Description: File Transfer');
            header('Content-Type: application/octet-stream');
            header('Content-Disposition: attachment; filename="' . $file['foto_toko'] . '"');
            header('Expires: 0');
            header('Cache-Control: must-revalidate');
            header('Pragma: public');
            header('Content-Length: ' . filesize($targetfile));
            readfile($targetfile);
            exit;
            }
        else echo _e("File does not exist.");
	break;

	case "fototokoticket":
        $file = getRowById("tickets",$_GET['id']);
        $targetfile = $scriptpath . DIRECTORY_SEPARATOR . "uploads" . DIRECTORY_SEPARATOR . $file['foto_toko'];
        if (file_exists($targetfile)) {
            header('Content-Description: File Transfer');
            header('Content-Type: application/octet-stream');
            header('Content-Disposition: attachment; filename="' . $file['foto_toko'] . '"');
            header('Expires: 0');
            header('Cache-Control: must-revalidate');
            header('Pragma: public');
            header('Content-Length: ' . filesize($targetfile));
            readfile($targetfile);
            exit;
            }
        else echo _e("File does not exist.");
	break;

	case "fotostruk":
        $file = getRowById("spk",$_GET['id']);
        $targetfile = $scriptpath . DIRECTORY_SEPARATOR . "uploads" . DIRECTORY_SEPARATOR . $file['foto_struk'];
        if (file_exists($targetfile)) {
            header('Content-Description: File Transfer');
            header('Content-Type: application/octet-stream');
            header('Content-Disposition: attachment; filename="' . $file['foto_struk'] . '"');
            header('Expires: 0');
            header('Cache-Control: must-revalidate');
            header('Pragma: public');
            header('Content-Length: ' . filesize($targetfile));
            readfile($targetfile);
            exit;
            }
        else echo _e("File does not exist.");
	break;

	case "fotostrukticket":
        $file = getRowById("tickets",$_GET['id']);
        $targetfile = $scriptpath . DIRECTORY_SEPARATOR . "uploads" . DIRECTORY_SEPARATOR . $file['foto_struk'];
        if (file_exists($targetfile)) {
            header('Content-Description: File Transfer');
            header('Content-Type: application/octet-stream');
            header('Content-Disposition: attachment; filename="' . $file['foto_struk'] . '"');
            header('Expires: 0');
            header('Cache-Control: must-revalidate');
            header('Pragma: public');
            header('Content-Length: ' . filesize($targetfile));
            readfile($targetfile);
            exit;
            }
        else echo _e("File does not exist.");
	break;

	case "fotomesin":
        $fotomesin = getRowById("spk",$_GET['id']);
        $targetfile = $scriptpath . DIRECTORY_SEPARATOR . "uploads" . DIRECTORY_SEPARATOR . $fotomesin['foto_mesin'];
        if (file_exists($targetfile)) {
            header('Content-Description: File Transfer');
            header('Content-Type: application/octet-stream');
            header('Content-Disposition: attachment; filename="' . $fotomesin['foto_mesin'] . '"');
            header('Expires: 0');
            header('Cache-Control: must-revalidate');
            header('Pragma: public');
            header('Content-Length: ' . filesize($targetfile));
            readfile($targetfile);
            exit;
            }
        else echo _e("File does not exist.");
	break;

	case "fotomesinticket":
        $fotomesin = getRowById("tickets",$_GET['id']);
        $targetfile = $scriptpath . DIRECTORY_SEPARATOR . "uploads" . DIRECTORY_SEPARATOR . $fotomesin['foto_mesin'];
        if (file_exists($targetfile)) {
            header('Content-Description: File Transfer');
            header('Content-Type: application/octet-stream');
            header('Content-Disposition: attachment; filename="' . $fotomesin['foto_mesin'] . '"');
            header('Expires: 0');
            header('Cache-Control: must-revalidate');
            header('Pragma: public');
            header('Content-Length: ' . filesize($targetfile));
            readfile($targetfile);
            exit;
            }
        else echo _e("File does not exist.");
	break;

	case "downloaddirect":
        $file = $_GET['data'];
        $targetfile = $scriptpath . DIRECTORY_SEPARATOR . "uploads" . DIRECTORY_SEPARATOR . $file;
        if (file_exists($targetfile)) {
            header('Content-Description: File Transfer');
            header('Content-Type: application/octet-stream');
            header('Content-Disposition: attachment; filename="' . $file['file'] . '"');
            header('Expires: 0');
            header('Cache-Control: must-revalidate');
            header('Pragma: public');
            header('Content-Length: ' . filesize($targetfile));
            readfile($targetfile);
            exit;
            }
        else echo _e("File does not exist.");
	break;

	case "show":
        $file = getRowById("files",$_GET['id']);
        $targetfile = $scriptpath . DIRECTORY_SEPARATOR . "uploads" . DIRECTORY_SEPARATOR . $file['file'];
        if (file_exists($targetfile)) {
            $content = get_mime_content($file['file']);
            header('Content-Type: ' . $content);
            header('Content-Length: ' . filesize($targetfile));
            readfile($targetfile);
            exit;
        }
        else echo _e("File does not exist.");
	break;

	case "locationData":
		$filterid = $_GET['filterid'];
		$searchstring = "";
		if(isset($_GET['q'])) $searchstring = $_GET['q'];
		$items = $database->select("people", "*");
		$results = array();

		$i = 1;
		foreach($items as $item) {
			$results[$i]['id'] = $item['id'];
			$results[$i]['nik'] = $item['nik'];
			$results[$i]['name'] = $item['name'];
			$results[$i]['latitude'] = $item['latitude'];
			$results[$i]['longtitude'] = $item['longtitude'];
			$i++;
		}

		echo json_encode($results);
	break;

	case "merchantData":
		$filterid = $_GET['filterid'];
		$searchstring = "";
		if(isset($_GET['q'])) $searchstring = $_GET['q'];

		
		$items = $database->select("clients", "*");

		$results = array();

		$i = 1;
		foreach($items as $item) {
			$results[$i]['id'] = $item['id'];
			$results[$i]['mid'] = $item['mid'];
			$results[$i]['name'] = $item['name'];
			$results[$i]['alamat'] = $item['alamat'];
			$results[$i]['status'] = $item['status'];
			$results[$i]['kota'] = $item['kota'];
			$i++;
		}

		echo json_encode($results);
	break;

	case "category1Select":
		$filterid = $_GET['filterid'];
		$searchstring = "";
		if(isset($_GET['q'])) $searchstring = $_GET['q'];

		if($searchstring != "") {
			if($filterid != 0) {
				$items = $database->select("category_1", "*", [ "AND" => [
					"id_customer" => $filterid,
					"OR" => [
						"name[~]" => $searchstring
					]
				]]);
			} else {
				$items = $database->select("category_1", "*", [ "OR" => [
					"name[~]" => $searchstring
				]]);
			}
		} else {
			if($filterid != 0) {
				$items = $database->select("category_1", "*", [ "id_customer" => $filterid ]);
			} else {
				$items = $database->select("category_1", "*");
			}
		}

		$results = array();
		$results[0]['id'] = 0;
		$results[0]['text'] = __('None');

		$i = 1;
		foreach($items as $item) {
			$results[$i]['id'] = $item['id'];
			$results[$i]['text'] = $item['name'];
			$i++;
		}

		echo json_encode($results);
	break;

	case "category2Select":
		$filterid = $_GET['filterid'];
		$categoryid = $_GET['categoryid'];
		$searchstring = "";
		if(isset($_GET['q'])) $searchstring = $_GET['q'];

		if($searchstring != "") {
			if($filterid != 0) {
				$items = $database->select("category_2", "*", [ "AND" => [
					"id_customer" => $filterid,
					"OR" => [
						"id_category_1" => $filterid,
						"name[~]" => $searchstring
					]
				]]);
			} else {
				$items = $database->select("category_2", "*", [ "OR" => [
					"name[~]" => $searchstring
				]]);
			}
		} else {
			if($filterid != 0) {
				$items = $database->select("category_2", "*", [ "id_customer" => $filterid ]);
			} else {
				$items = $database->select("category_2", "*");
			}
		}

		$results = array();
		$results[0]['id'] = 0;
		$results[0]['text'] = __('None');

		$i = 1;
		foreach($items as $item) {
			$results[$i]['id'] = $item['id'];
			$results[$i]['text'] = $item['name'];
			$i++;
		}

		echo json_encode($results);
	break;

	case "category3Select":
		$filterid = $_GET['filterid'];
		$categoryid = $_GET['categoryid'];
		$searchstring = "";
		if(isset($_GET['q'])) $searchstring = $_GET['q'];

		if($searchstring != "") {
			if($filterid != 0) {
				$items = $database->select("category_3", "*", [ "AND" => [
					"id_customer" => $filterid,
					"OR" => [
						"id_category_2" => $categoryid,
						"name[~]" => $searchstring
					]
				]]);
			} else {
				$items = $database->select("category_3", "*", [ "OR" => [
					"name[~]" => $searchstring
				]]);
			}
		} else {
			if($filterid != 0) {
				$items = $database->select("category_3", "*", [ "id_customer" => $filterid ]);
			} else {
				$items = $database->select("category_3", "*");
			}
		}

		$results = array();
		$results[0]['id'] = 0;
		$results[0]['text'] = __('None');

		$i = 1;
		foreach($items as $item) {
			$results[$i]['id'] = $item['id'];
			$results[$i]['text'] = $item['name'];
			$i++;
		}

		echo json_encode($results);
	break;

	case "statusSelect":
		$filterid = $_GET['filterid'];
		$searchstring = "";
		if(isset($_GET['q'])) $searchstring = $_GET['q'];

		if($searchstring != "") {
			if($filterid != 0) {
				$items = $database->select("status_tickets", "*", [ "AND" => [
					"id_customer" => $filterid,
					"OR" => [
						"name[~]" => $searchstring
					]
				]]);
			} else {
				$items = $database->select("status_tickets", "*", [ "OR" => [
					"name[~]" => $searchstring
				]]);
			}
		} else {
			if($filterid != 0) {
				$items = $database->select("status_tickets", "*", [ "id_customer" => $filterid ]);
			} else {
				$items = $database->select("status_tickets", "*");
			}
		}

		$itemsall = $database->select("status_tickets", "*", [ "OR" => [
			"id_customer[~]" => 0
		]]);

		$results = array();
		$results[0]['id'] = 0;
		$results[0]['text'] = __('None');

		$i = 1;
		foreach($items as $item) {
			$results[$i]['id'] = $item['id'];
			$results[$i]['text'] = $item['name'];
			$i++;
		}

		foreach($itemsall as $itemsall) {
			$results[$i]['id'] = $itemsall['id'];
			$results[$i]['text'] = $itemsall['name'];
			$i++;
		}


		echo json_encode($results);
	break;

	case "cabangSelect":
		$filterid = $_GET['filterid'];
		$searchstring = "";
		if(isset($_GET['q'])) $searchstring = $_GET['q'];

		if($searchstring != "") {
			if($filterid != 0) {
				$items = $database->select("clients", "*", [ "AND" => [
					"id_customer" => $filterid,
					"OR" => [
						"mid[~]" => $searchstring,
						"name[~]" => $searchstring
					]
				]]);
			} else {
				$items = $database->select("clients", "*", [ "OR" => [
					"name[~]" => $searchstring
				]]);
			}
		} else {
			if($filterid != 0) {
				$items = $database->select("clients", "*", [ "id_customer" => $filterid ]);
			} else {
				$items = $database->select("clients", "*");
			}
		}

		$results = array();
		$results[0]['id'] = 0;
		$results[0]['text'] = __('None');

		$i = 1;
		foreach($items as $item) {
			$results[$i]['id'] = $item['id'];
			if($item['branch_code'] == ""){
				$results[$i]['text'] = $item['name'];
			} else {
				$results[$i]['text'] = $item['name']."-". $item['branch_code'];
			}
			$i++;
		}

		echo json_encode($results);
	break;

	case "deviceSelect":
		$filterid = $_GET['filterid'];
		$searchstring = "";
		if(isset($_GET['q'])) $searchstring = $_GET['q'];

		if($searchstring != "") {
			if($filterid != 0) {
				$items = $database->select("device_problem", "*", [ "AND" => [
					"id_customer" => $filterid,
					"OR" => [
						"name[~]" => $searchstring,
					]
				]]);
			} else {
				$items = $database->select("device_problem", "*", [ "OR" => [
					"name[~]" => $searchstring
				]]);
			}
		} else {
			if($filterid != 0) {
				$items = $database->select("device_problem", "*", [ "id_customer" => $filterid ]);
			} else {
				$items = $database->select("device_problem", "*");
			}
		}

		$results = array();
		$results[0]['id'] = 0;
		$results[0]['text'] = __('None');
		foreach($items as $item) {
			$results[$i]['id'] = $item['id'];
			$results[$i]['text'] = $item['name'];
			$i++;
		}

		echo json_encode($results);
	break;

	case "simcardSelect":
		$filterid = $_GET['filterid'];
		$searchstring = "";
		if(isset($_GET['q'])) $searchstring = $_GET['q'];

		if($searchstring != "") {
			if($filterid != 0) {
				$items = $database->select("tabel_simcard", "*", [ "AND" => [
					"id" => $filterid,
					"OR" => [
						"data_sim[~]" => $searchstring,
						"provider[~]" => $searchstring
					]
				]]);
			} else {
				$items = $database->select("tabel_simcard", "*", [ "OR" => [
					"data_sim[~]" => $searchstring,
					"provider[~]" => $searchstring
				]]);
			}
		} else {
			if($filterid != 0) {
				$items = $database->select("tabel_simcard", "*", [ "id" => $filterid ]);
			} else {
				$items = $database->select("tabel_simcard", "*");
			}
		}

		$results = array();
		$results[0]['id'] = 0;
		$results[0]['text'] = __('None');

		$i = 1;
		foreach($items as $item) {
			$results[$i]['id'] = $item['id'];
			$results[$i]['text'] = $item['data_sim'];
			$i++;
		}

		echo json_encode($results);
	break;

	case "clientSelect":
		$filterid = $_GET['filterid'];
		$searchstring = "";
		if(isset($_GET['q'])) $searchstring = $_GET['q'];

		if($searchstring != "") {
			if($filterid != 0) {
				$items = $database->select("clients", "*", [ "AND" => [
					"id" => $filterid,
					"OR" => [
						"name[~]" => $searchstring,
						"mid[~]" => $searchstring
					]
				]]);
			} else {
				$items = $database->select("clients", "*", [ "OR" => [
					"name[~]" => $searchstring,
					"mid[~]" => $searchstring
				]]);
			}
		} else {
			if($filterid != 0) {
				$items = $database->select("clients", "*", [ "id" => $filterid ]);
			} else {
				$items = $database->select("clients", "*");
			}
		}

		$results = array();
		$results[0]['id'] = 0;
		$results[0]['text'] = __('None');

		$i = 1;
		foreach($items as $item) {
			$results[$i]['id'] = $item['id'];
			$results[$i]['text'] = $item['name']." - ".$item['mid'];
			$i++;
		}

		echo json_encode($results);
	break;

	case "phoneSelect":
		$filterid = $_GET['filterid'];
		$searchstring = "";
		if(isset($_GET['q'])) $searchstring = $_GET['q'];

		if($searchstring != "") {
			if($filterid != 0) {
				$items = $database->select("clients", "*", [ "AND" => [
					"id" => $filterid,
					"OR" => [
						"pic[~]" => $searchstring,
						"phone_pic[~]" => $searchstring
					]
				]]);
			} else {
				$items = $database->select("clients", "*", [ "OR" => [
					"phone_pic[~]" => $searchstring
				]]);
			}
		} else {
			if($filterid != 0) {
				$items = $database->select("clients", "*", [ "id" => $filterid ]);
			} else {
				$items = $database->select("clients", "*");
			}
		}

		$results = array();
		$results[0]['id'] = 0;
		$results[0]['text'] = __('None');

		$i = 1;
		foreach($items as $item) {
			$results[$i]['id'] = $item['id'];
			$results[$i]['text'] = $item['phone_pic'];
			$i++;
		}

		echo json_encode($results);
	break;

	


	case "assetsSelect":
		$filterid = $_GET['filterid'];
		$searchstring = "";
		if(isset($_GET['q'])) $searchstring = $_GET['q'];

		if($searchstring != "") {
			if($filterid != 0) {
				$items = $database->select("assets", "*", [ "AND" => [
					"clientid" => $filterid,
					"OR" => [
						"midtid[~]" => $searchstring,
						"name[~]" => $searchstring
					]
				]]);
			} else {
				$items = $database->select("assets", "*", [ "OR" => [
					"name[~]" => $searchstring
				]]);
			}
		} else {
			if($filterid != 0) {
				$items = $database->select("assets", "*", [ "clientid" => $filterid ]);
			} else {
				$items = $database->select("assets", "*");
			}
		}

		$results = array();
		$results[0]['id'] = 0;
		$results[0]['text'] = __('None');

		$i = 1;
		foreach($items as $item) {
			$results[$i]['id'] = $item['id'];
			$results[$i]['text'] = $item['name']."-".$item['midtid']."-".$item['serial'];
			$i++;
		}

		echo json_encode($results);
	break;

	case "merchantSelect":
		$filterid = $_GET['filterid'];
		$searchstring = "";
		if(isset($_GET['q'])) $searchstring = $_GET['q'];

		if($searchstring != "") {
			if($filterid != 0) {
				$items = $database->select("clients", "*", [ "AND" => [
					"id_customer" => $filterid,
					"OR" => [
						"mid[~]" => $searchstring,
						"name[~]" => $searchstring
					]
				]]);
			} else {
				$items = $database->select("clients", "*", [ "OR" => [
					"mid[~]" => $searchstring,
					"name[~]" => $searchstring
				]]);
			}
		} else {
			if($filterid != 0) {
				$items = $database->select("clients", "*", [ "id_customer" => $filterid ]);
			} else {
				$items = $database->select("clients", "*");
			}
		}

		$results = array();
		$results[0]['id'] = 0;
		$results[0]['text'] = __('None');

		$i = 1;
		foreach($items as $item) {
			$results[$i]['id'] = $item['id'];
			$results[$i]['text'] = $item['name'] . " " . $item['mid'];
			$i++;
		}

		echo json_encode($results);
	break;

	case "edcSelect":
		$filterid = $_GET['filterid'];
		$searchstring = "";
		if(isset($_GET['q'])) $searchstring = $_GET['q'];

		if($searchstring != "") {
			if($filterid != 0) {
				$items = $database->select("assets", "*", [ "AND" => [
					"clientid" => $filterid,
					"OR" => [
						"name[~]" => $searchstring,
						"serial[~]" => $searchstring
					]
				]]);
			} else {
				$items = $database->select("assets", "*", [ "OR" => [
					"name[~]" => $searchstring,
					"serial[~]" => $searchstring
				]]);
			}
		} else {
			if($filterid != 0) {
				$items = $database->select("assets", "*", [ "clientid" => $filterid ]);
			} else {
				$items = $database->select("assets", "*");
			}
		}

		$results = array();
		$results[0]['id'] = 0;
		$results[0]['text'] = __('None');

		$i = 1;
		foreach($items as $item) {
			$results[$i]['id'] = $item['id'];
			$results[$i]['text'] = getSingleValue("assetcategories","name",$item['categoryid']) . " " . $item['serial'];
			$i++;
		}

		echo json_encode($results);
	break;



	case "projectsSelect":
		$filterid = $_GET['filterid'];
		$searchstring = "";
		if(isset($_GET['q'])) $searchstring = $_GET['q'];

		if($searchstring != "") {
			if($filterid != 0) {
				$items = $database->select("projects", "*", [ "AND" => [
					"clientid" => $filterid,
					"OR" => [
						"tag[~]" => $searchstring,
						"name[~]" => $searchstring
					]
				]]);
			} else {
				$items = $database->select("projects", "*", [ "OR" => [
					"tag[~]" => $searchstring,
					"name[~]" => $searchstring
				]]);
			}
		} else {
			if($filterid != 0) {
				$items = $database->select("projects", "*", [ "clientid" => $filterid ]);
			} else {
				$items = $database->select("projects", "*");
			}
		}

		$results = array();
		$results[0]['id'] = 0;
		$results[0]['text'] = __('None');

		$i = 1;
		foreach($items as $item) {
			$results[$i]['id'] = $item['id'];
			$results[$i]['text'] = $item['tag'] . " " . $item['name'];
			$i++;
		}

		echo json_encode($results);
	break;


	case "usersSelect":
		$filterid = $_GET['filterid'];
		$searchstring = "";
		if(isset($_GET['q'])) $searchstring = $_GET['q'];

		if($searchstring != "") {
			if($filterid != 0) {
				$items = $database->select("people", "*", [ "AND" => [
					"type" => "user",
					"clientid" => $filterid,
					"OR" => [
						"name[~]" => $searchstring,
						"email[~]" => $searchstring
					]
				]]);
			} else {
				$items = $database->select("people", "*", [ "AND" => [
					"type" => "user",
					"OR" => [
						"name[~]" => $searchstring,
						"email[~]" => $searchstring
					]
				]]);
			}
		} else {
			if($filterid != 0) {
				$items = $database->select("people", "*", [ "AND" => [ "clientid" => $filterid, "type" => "user" ] ]);
			} else {
				$items = $database->select("people", "*", [ "type" => "user" ]);
			}
		}

		$results = array();
		$results[0]['id'] = 0;
		$results[0]['text'] = __('None');

		$i = 1;
		foreach($items as $item) {
			$results[$i]['id'] = $item['id'];
			$results[$i]['text'] = $item['name'] . " (" . $item['email'] . ")";
			$i++;
		}

		echo json_encode($results);
	break;



	case "issuesSelect":
		$filterid = $_GET['filterid'];
		$searchstring = "";
		if(isset($_GET['q'])) $searchstring = $_GET['q'];

		if($searchstring != "") {
			if($filterid != 0) {
				$items = $database->select("issues", "*", [
					"AND" => [
						"clientid" => $filterid,
						"name[~]" => $searchstring
					]
				]);
			} else {
				$items = $database->select("issues", "*", [
					"name[~]" => $searchstring
				]);
			}
		} else {
			if($filterid != 0) {
				$items = $database->select("issues", "*", [ "clientid" => $filterid ]);
			} else {
				$items = $database->select("issues", "*");
			}
		}

		$results = array();

		$i = 0;
		foreach($items as $item) {
			$results[$i]['id'] = $item['id'];
			$results[$i]['text'] = $item['name'];
			$i++;
		}

		echo json_encode($results);
	break;


	case "ticketsSelect":
		$filterid = $_GET['filterid'];
		$searchstring = "";
		if(isset($_GET['q'])) $searchstring = $_GET['q'];

		if($searchstring != "") {
			if($filterid != 0) {
				$items = $database->select("tickets", "*", [ "AND" => [
					"clientid" => $filterid,
					"OR" => [
						"ticket[~]" => $searchstring,
						"subject[~]" => $searchstring
					]
				]]);
			} else {
				$items = $database->select("tickets", "*", [ "OR" => [
					"ticket[~]" => $searchstring,
					"subject[~]" => $searchstring
				]]);
			}
		} else {
			if($filterid != 0) {
				$items = $database->select("tickets", "*", [ "clientid" => $filterid ]);
			} else {
				$items = $database->select("tickets", "*");
			}
		}

		$results = array();

		$i = 0;
		foreach($items as $item) {
			$results[$i]['id'] = $item['id'];
			$results[$i]['text'] = "#" . $item['ticket'] . " " . $item['subject'];
			$i++;
		}

		echo json_encode($results);
	break;

	case "usersSelectEmail":
		$filterid = $_GET['filterid'];
		$searchstring = "";
		if(isset($_GET['q'])) $searchstring = $_GET['q'];

		if($searchstring != "") {
			if($filterid != 0) {
				$items = $database->select("people", "*", [ "AND" => [
					"type" => "user",
					"clientid" => $filterid,
					"OR" => [
						"name[~]" => $searchstring,
						"email[~]" => $searchstring
					]
				]]);
			} else {
				$items = $database->select("people", "*", [ "AND" => [
					"type" => "user",
					"OR" => [
						"name[~]" => $searchstring,
						"email[~]" => $searchstring
					]
				]]);
			}
		} else {
			if($filterid != 0) {
				$items = $database->select("people", "*", [ "AND" => [ "clientid" => $filterid, "type" => "user" ] ]);
			} else {
				$items = $database->select("people", "*", [ "type" => "user" ]);
			}
		}

		$results = array();

		$i = 0;
		foreach($items as $item) {
			$results[$i]['id'] = $item['email'];
			$results[$i]['text'] = $item['name'] . " (" . $item['email'] . ")";
			$i++;
		}

		echo json_encode($results);
	break;

	case "sssssssa":



} // end switch



?>
