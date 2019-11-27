<?php
#################
## tickets




switch ($request_method) {
    case 'get':
        isAuthorizedApi("viewBatchPM");

        if(empty($filters)) {
            $result = $database->select("tabelpm","*");
        } else {
            $result = $database->select("tabelpm", "*",[ "AND" => $filters ]);
        }

        $response = [ "status" => 1, "status_message" => "Success!", "result" => $result ];
    break;

    case 'edit':
        isAuthorizedApi("addTicket");

        $status = GPSTrack::edit($data);

        if($status == 10) $response = [ "status" => 1, "status_message" => "Success! Item has been added successfully." ];
        else $response = [ "status" => 2, "status_message" => "Error! Unable to add item." ];
    break;

    case 'editAPI':
        isAuthorizedApi("editBatchPM");

        $status = PMBatch::editAPI($data);

        if($status == 20) $response = [ "status" => 1, "status_message" => "Success! Item has been updated successfully." ];
        else $response = [ "status" => 2, "status_message" => "Error! Unable to update item." ];
    break;

    case 'delete':
        isAuthorizedApi("deleteTicket");

        $status = Ticket::delete($id);

        if($status == 30) $response = [ "status" => 1, "status_message" => "Success! Item has been delete successfully." ];
        else $response = [ "status" => 2, "status_message" => "Error! Unable to delete item." ];
    break;



    default:
        $response = [ "status" => 907, "status_message" => "Request method " . $request_method . " not allowed for this resourse." ];
    break;
}





?>
