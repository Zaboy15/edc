<?php
#################
## spk




switch ($request_method) {
    case 'get':
        isAuthorizedApi("viewBatchPM");

        if(empty($filters)) {
            $result = $database->count("tabel_pm","*");
        } else {
            $result = $database->count("tabel_pm", "*",[ "AND" => [
                "OR" => $filters, 
                "status[!]" => "Not Success"]]);
        }

        $response = [ "status" => 1, "status_message" => "Success!", "result" => $result ];
    break;


    default:
        $response = [ "status" => 907, "status_message" => "Request method " . $request_method . " not allowed for this resourse." ];
    break;
}





?>
