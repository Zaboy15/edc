<?php
#################
## tickets




switch ($request_method) {
    case 'get':
        isAuthorizedApi("viewBatchPM");

        if(empty($filters)) {
            $result = $database->count("tickets","*");
        } else {
            $result = $database->count("tickets", "*",[ "AND" => [
                "OR" => $filters, 
                "status[!]" => "Closed - Completed"]]);
        }

        $response = [ "status" => 1, "status_message" => "Success!", "result" => $result ];
    break;


    default:
        $response = [ "status" => 907, "status_message" => "Request method " . $request_method . " not allowed for this resourse." ];
    break;
}





?>
