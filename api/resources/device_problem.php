<?php
#################
## Clients




switch ($request_method) {
    case 'get':
        isAuthorizedApi("viewClients");

        if(empty($filters)) {
            $result = $database->select("device_problem", "*");
        } else {
            $result = $database->select("device_problem", "*", [ "AND" => $filters ]);
        }

        $response = [ "status" => 1, "status_message" => "Success!", "result" => $result ];
    break;


    default:
        $response = [ "status" => 907, "status_message" => "Request method " . $request_method . " not allowed for this resourse." ];
    break;
}





?>
