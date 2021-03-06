<?php

// ERROR REPORTING
$debug = false;

if($debug == false) {
    error_reporting(0);
    ini_set('display_errors', '0');
}

if($debug == true) {
    error_reporting(E_ALL & ~E_NOTICE);
    ini_set('display_errors', '1');
}

header('Content-Type: application/json');
$response = [ "status" => "901", "status_message" => "Unknown error." ];

$scriptpath = dirname(__DIR__);
$currentpath = __DIR__;

// LOAD FUNCTIONS
require($scriptpath . DIRECTORY_SEPARATOR . 'includes' . DIRECTORY_SEPARATOR . 'functions.php');

// AUTOLOAD CLASSES
spl_autoload_register('vendorClassAutoload');
spl_autoload_register('appClassAutoload');

// composer autoload
require $scriptpath . '/vendor/autoload.php';

# LOAD CONFIGURAGION FILE
require($scriptpath . DIRECTORY_SEPARATOR . 'config.php');

# INITIALIZE MEDOO
$database = new medoo($config);

# DATE & TIME
date_default_timezone_set(getConfigValue("timezone"));

//echo "<pre>";
//print_r($_POST);
//echo "</pre>";

if(isset($_POST['key'])) {
    $apikey = $database->get("api_keys", "*", [ "secretkey" => $_POST['key'] ] );
    if(empty($apikey)) {
        $response = [ "status" => 903, "status_message" => "Authentication failed. Invalid API Key" ];
        echo json_encode($response);
        exit;
    }
    else {
        $perms = unserialize(getSingleValue("roles","perms",$apikey['roleid']));
    }
}
else {
    $response = [ "status" => 902, "status_message" => "API key missing." ];
    echo json_encode($response);
    exit;
}

//$request_method = $_SERVER["REQUEST_METHOD"];
$request_method = $_POST["method"];
$request_resource = $_POST["resource"];



switch ($request_method) {
    case 'get':
        if(isset($_POST['filters'])) {
            if(is_array($_POST['filters'])) {
                $filters = $_POST['filters'];
            } else {
                $response = [ "status" => 908, "status_message" => "'filters' Error! Expected array, string given." ];
                echo json_encode($response);
                exit;
            }

        } else $filters = array();
    break;

    case 'getsearchpm':
        if(isset($_POST['filters'])) {
            if(is_array($_POST['filters'])) {
                $filters = $_POST['filters'];
                $data = $_POST['data'];
            } else {
                $response = [ "status" => 908, "status_message" => "'filters' Error! Expected array, string given." ];
                echo json_encode($response);
                exit;
            }

        } else {
        $filters = array();
        $data = $_POST['data'];
        }
    break;

    case 'add':
        if(isset($_POST['data'])) {
            if(is_array($_POST['data'])) {
                $data = $_POST['data'];
            } else {
                $response = [ "status" => 909, "status_message" => "'data' Error! Expected array, string given." ];
                echo json_encode($response);
                exit;
            }

        } else {
            $response = [ "status" => 910, "status_message" => "'data' array missing." ];
            echo json_encode($response);
            exit;
        }

    break;
    

    case 'edit':
        if(isset($_POST['data'])) {
            if(is_array($_POST['data'])) {
                $data = $_POST['data'];
            } else {
                $response = [ "status" => 909, "status_message" => "'data' Error! Expected array, string given." ];
                echo json_encode($response);
                exit;
            }

        } else {
            $response = [ "status" => 910, "status_message" => "'data' array missing." ];
            echo json_encode($response);
            exit;
        }
    break;

    case 'editStatus':
        if(isset($_POST['data'])) {
            if(is_array($_POST['data'])) {
                $data = $_POST['data'];
            } else {
                $response = [ "status" => 909, "status_message" => "'data' Error! Expected array, string given." ];
                echo json_encode($response);
                exit;
            }

        } else {
            $response = [ "status" => 910, "status_message" => "'data' array missing." ];
            echo json_encode($response);
            exit;
        }
    break;

    case 'getdataabsenku':
        if(isset($_POST['filters'])) {
            if(is_array($_POST['filters'])) {
                $filters = $_POST['filters'];
            } else {
                $response = [ "status" => 908, "status_message" => "'filters' Error! Expected array, string given." ];
                echo json_encode($response);
                exit;
            }

        } else $filters = array();
    break;

    case 'editStatusGlobal':
        if(isset($_POST['data'])) {
            if(is_array($_POST['data'])) {
                $data = $_POST['data'];
            } else {
                $response = [ "status" => 909, "status_message" => "'data' Error! Expected array, string given." ];
                echo json_encode($response);
                exit;
            }

        } else {
            $response = [ "status" => 910, "status_message" => "'data' array missing." ];
            echo json_encode($response);
            exit;
        }
    break;

    case 'editAPI':
        if(isset($_POST['data'])) {
            if(is_array($_POST['data'])) {
                $data = $_POST['data'];
            } else {
                $response = [ "status" => 909, "status_message" => "'data' Error! Expected array, string given." ];
                echo json_encode($response);
                exit;
            }

        } else {
            $response = [ "status" => 910, "status_message" => "'data' array missing." ];
            echo json_encode($response);
            exit;
        }
    break;

    case 'editToken':
        if(isset($_POST['data'])) {
            if(is_array($_POST['data'])) {
                $data = $_POST['data'];
            } else {
                $response = [ "status" => 909, "status_message" => "'data' Error! Expected array, string given." ];
                echo json_encode($response);
                exit;
            }

        } else {
            $response = [ "status" => 910, "status_message" => "'data' array missing." ];
            echo json_encode($response);
            exit;
        }
    break;

    case 'editLocation':
        if(isset($_POST['data'])) {
            if(is_array($_POST['data'])) {
                $data = $_POST['data'];
            } else {
                $response = [ "status" => 909, "status_message" => "'data' Error! Expected array, string given." ];
                echo json_encode($response);
                exit;
            }

        } else {
            $response = [ "status" => 910, "status_message" => "'data' array missing." ];
            echo json_encode($response);
            exit;
        }
    break;

    case 'attach':
        if(isset($_POST['data'])) {
            if(is_array($_POST['data'])) {
                $data = $_POST['data'];
            } else {
                $response = [ "status" => 909, "status_message" => "'data' Error! Expected array, string given." ];
                echo json_encode($response);
                exit;
            }

        } else {
            $response = [ "status" => 910, "status_message" => "'data' array missing." ];
            echo json_encode($response);
            exit;
        }
    break;

    case 'detach':
        if(isset($_POST['data'])) {
            if(is_array($_POST['data'])) {
                $data = $_POST['data'];
            } else {
                $response = [ "status" => 909, "status_message" => "'data' Error! Expected array, string given." ];
                echo json_encode($response);
                exit;
            }

        } else {
            $response = [ "status" => 910, "status_message" => "'data' array missing." ];
            echo json_encode($response);
            exit;
        }
    break;

    case 'delete':
        if(isset($_POST['id'])) {
            if(is_array($_POST['id'])) {
                $response = [ "status" => 911, "status_message" => "'id' Error! Expected string, array given." ];
                echo json_encode($response);
                exit;
            } else {
                $id = $_POST['id'];
            }

        } else {
            $response = [ "status" => 912, "status_message" => "'id' string missing." ];
            echo json_encode($response);
            exit;
        }
    break;



    default:
        $response = [ "status" => 906, "status_message" => "Request method " . $request_method . " not found." ];
    break;
}


switch ($request_resource) {

    case 'withdraw': ## DONE ##d
        require $scriptpath . '/api/resources/withdraw.php';
    break;

    case 'kode_action': ## DONE ##d
        require $scriptpath . '/api/resources/action.php';
    break;

    case 'status_tickets': ## DONE ##d
        require $scriptpath . '/api/resources/status_tickets.php';
    break;

    case 'device_problem': ## DONE ##d
        require $scriptpath . '/api/resources/device_problem.php';
    break;

    case 'category1': ## DONE ##d
        require $scriptpath . '/api/resources/category1.php';
    break;
    
    case 'category2': ## DONE ##d
        require $scriptpath . '/api/resources/category2.php';
    break;

    case 'category3': ## DONE ##d
        require $scriptpath . '/api/resources/category3.php';
    break;

    case 'count_tickets_dashboard': ## DONE ##d
        require $scriptpath . '/api/resources/count_tickets_dashboard.php';
    break;


    case 'count_spk': ## DONE ##d
        require $scriptpath . '/api/resources/count_spk.php';
    break;

    case 'count_pm': ## DONE ##d
        require $scriptpath . '/api/resources/count_pm.php';
    break;

    case 'count_ticket': ## DONE ##d
        require $scriptpath . '/api/resources/count_ticket.php';
    break;

    case 'spk': ## DONE ##d
        require $scriptpath . '/api/resources/spk.php';
    break;

    case 'rootcause': ## DONE ##d
        require $scriptpath . '/api/resources/rootcause.php';
    break;

    case 'kode': ## DONE ##d
        require $scriptpath . '/api/resources/kode.php';
    break;

    case 'ticketsedc': ## DONE ##d
        require $scriptpath . '/api/resources/ticketsedc.php';
    break;

    case 'absensi': ## DONE ##d
        require $scriptpath . '/api/resources/absensi.php';
    break;

    case 'gpstrack': ## DONE ##d
        require $scriptpath . '/api/resources/gpstrack.php';
    break;

    case 'tabel_pm': ## DONE ##d
        require $scriptpath . '/api/resources/pm.php';
    break;

    case 'pmsearch': ## DONE ##d
        require $scriptpath . '/api/resources/pmsearch.php';
    break;

    case 'pemeriksaan': ## DONE ##d
        require $scriptpath . '/api/resources/pemeriksaan.php';
    break;

    case 'tabel_customer': ## DONE ##d
        require $scriptpath . '/api/resources/tabel_customer.php';
    break;

    case 'clients': ## DONE ##d
        require $scriptpath . '/api/resources/clients.php';
    break;

    case 'customer': ## DONE ##d
        require $scriptpath . '/api/resources/customer.php';
    break;

    case 'assets': ## DONE ##
        require $scriptpath . '/api/resources/assets.php';
    break;

    case 'licenses': ## DONE ##
        require $scriptpath . '/api/resources/licenses.php';
    break;

    case 'credentials': ## DONE ##
        require $scriptpath . '/api/resources/credentials.php';
    break;

    case 'asset_categories': ## DONE ##
        require $scriptpath . '/api/resources/asset_categories.php';
    break;

    case 'license_categories': ## DONE ##
        require $scriptpath . '/api/resources/license_categories.php';
    break;

    case 'status_labels': ## DONE ##
        require $scriptpath . '/api/resources/status_labels.php';
    break;

    case 'manufacturers': ## DONE ##
        require $scriptpath . '/api/resources/manufacturers.php';
    break;

    case 'qrcodes': ## DONE ##
        require $scriptpath . '/api/resources/qrcodes.php';
    break;

    case 'models': ## DONE ##
        require $scriptpath . '/api/resources/models.php';
    break;

    case 'locations': ## DONE ##
        require $scriptpath . '/api/resources/locations.php';
    break;

    case 'suppliers': ## DONE ##
        require $scriptpath . '/api/resources/suppliers.php';
    break;

    case 'projects': ## DONE ##
        require $scriptpath . '/api/resources/projects.php';
    break;

    case 'tickets':  ## DONE ##
        require $scriptpath . '/api/resources/tickets.php';
    break;

    case 'ticket_replies':
        require $scriptpath . '/api/resources/ticket_replies.php';
    break;

    case 'issues': ## DONE ##
        require $scriptpath . '/api/resources/issues.php';
    break;

    case 'kb_categories': ## DONE ##
        require $scriptpath . '/api/resources/kb_categories.php';
    break;

    case 'kb_articles': ## DONE ##
        require $scriptpath . '/api/resources/kb_articles.php';
    break;

    case 'monitoring_hosts': ## DONE ##
        require $scriptpath . '/api/resources/monitoring_hosts.php';
    break;

    case 'monitoring_checks': ## DONE ##
        require $scriptpath . '/api/resources/monitoring_checks.php';
    break;

    case 'users': ## DONE ##
        require $scriptpath . '/api/resources/users.php';
    break;

    case 'staff': ## DONE ##
        require $scriptpath . '/api/resources/staff.php';
    break;

    case 'roles': ## DONE ## GET
        require $scriptpath . '/api/resources/roles.php';
    break;

    case 'languages': ## DONE ## GET
        require $scriptpath . '/api/resources/languages.php';
    break;

    case 'contacts': ## DONE ##
        require $scriptpath . '/api/resources/contacts.php';
    break;

    case 'comments': ## DONE ##
        require $scriptpath . '/api/resources/comments.php';
    break;

    case 'milestones': ## DONE ##
        require $scriptpath . '/api/resources/milestones.php';
    break;

    case 'predefined_replies': ## DONE ##
        require $scriptpath . '/api/resources/predefined_replies.php';
    break;

    case 'custom_asset_fields': ## DONE ## GET
        require $scriptpath . '/api/resources/custom_asset_fields.php';
    break;

    case 'custom_license_fields': ## DONE ## GET
        require $scriptpath . '/api/resources/custom_license_fields.php';
    break;

    case 'ticket_departments': ## DONE ## GET
        require $scriptpath . '/api/resources/ticket_departments.php';
    break;

    case 'config': ## DONE  ## GET
        require $scriptpath . '/api/resources/config.php';
    break;

    case 'time_log': ## DONE ##
        require $scriptpath . '/api/resources/time_log.php';
    break;

    case 'system_log': ## DONE ##
        require $scriptpath . '/api/resources/system_log.php';
    break;

    case 'files': ## DONE ##
        require $scriptpath . '/api/resources/files.php';
    break;

    case 'authenticate': ## DONE ##
        require $scriptpath . '/api/resources/authenticate.php';
    break;


    default:
        $response = [ "status" => 904, "status_message" => "Resource " . $request_resource . " does not exist." ];
        echo json_encode($response);
        exit;

    break;
}




echo json_encode($response);


?>
