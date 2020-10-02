<?php
#################
## Clients




switch ($request_method) {
    case 'get':
        isAuthorizedApi("viewClients");

        if(empty($filters)) {
            $result = $database->select("status_tickets", "*");
        } else {
            $filters['id[!]'] = ['7','2','1'];
            $result = $database->select("status_tickets", "*", [ "AND" => $filters ]);
        }

        $response = [ "status" => 1, "status_message" => "Success!", "result" => $result ];
    break;


    default:
        $response = [ "status" => 907, "status_message" => "Request method " . $request_method . " not allowed for this resourse." ];
    break;
}





?>
