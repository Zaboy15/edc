<?php
#################
## spk




switch ($request_method) {
    case 'get':
        isAuthorizedApi("viewBatchPM");

        if(empty($filters)) {
            $result = $database->count("spk","*");
        } else {
            $result = $database->count("spk", "*",[ "AND" => [
                "OR" => $filters, 
                "spk_status[!]" => ["Closed - Completed","Close - Completed"]]]);
        }

        $response = [ "status" => 1, "status_message" => "Success!", "result" => $result ];
    break;


    default:
        $response = [ "status" => 907, "status_message" => "Request method " . $request_method . " not allowed for this resourse." ];
    break;
}





?>
