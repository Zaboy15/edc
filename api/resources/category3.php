<?php
#################
## Category3




switch ($request_method) {
    case 'get':
        isAuthorizedApi("viewClients");

        if(empty($filters)) {
            $result = $database->select("category_3", "*");
        } else {
            $result = $database->select("category_3", "*", [ "AND" => $filters ]);
        }

        $response = [ "status" => 1, "status_message" => "Success!", "result" => $result ];
    break;


    default:
        $response = [ "status" => 907, "status_message" => "Request method " . $request_method . " not allowed for this resourse." ];
    break;
}





?>
