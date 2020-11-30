<?php
#################
## tickets




switch ($request_method) {
    case 'get':
        isAuthorizedApi("viewTickets");

        if($filters['id'] != "") {
            $result = $database->select("tabel_customer", "*", ["id" => $filters['id'], "ORDER" => ["id" => "DESC"] ]);

        } else if($filters['adminid'] != "")  {
            $result = $database->select("tabel_customer", "*");
        } else {
            $result = $database->select("tabel_customer", "*");
        }

        $i=0;
        foreach($result as $item) {
            $result[$i]['ccs'] = unserialize($item['ccs']);
            $i++;
        }

        $l = 0;

        foreach($result as $data){
            $result[$l]['count'] = $database->count("tickets", [ "AND" => ["idcustomer" => $data['id'], "adminid" => $filters['adminid']] ]);
            $l++;
        }

        $response = [ "status" => 1, "status_message" => "Success!", "result" => $result ];
    break;

    case 'add':
        isAuthorizedApi("addTicket");

        $status = Ticket::add($data);

        if($status == 10) $response = [ "status" => 1, "status_message" => "Success! Item has been added successfully." ];
        else $response = [ "status" => 2, "status_message" => "Error! Unable to add item." ];
    break;

    case 'edit':
        isAuthorizedApi("editTicket");

        $status = Ticket::edit($data);

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
