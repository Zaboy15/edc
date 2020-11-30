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
            $result[$l]['count_tickets_open'] = $database->count("tickets", [ "AND" => ["idcustomer" => $data['id'],"status" =>"1"] ]);
            $result[$l]['count_tickets_all'] = $database->count("tickets", [ "AND" => ["idcustomer" => $data['id']] ]);
            $l++;
        }

        $response = [ "status" => 1, "status_message" => "Success!", "result" => $result ];
    break;

    default:
        $response = [ "status" => 907, "status_message" => "Request method " . $request_method . " not allowed for this resourse." ];
    break;
}





?>
