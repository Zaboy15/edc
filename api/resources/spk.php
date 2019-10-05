<?php
#################
## tickets




switch ($request_method) {
    case 'get':
        isAuthorizedApi("viewTickets");

        if(empty($filters)) {
            $result = $database->select("spk", [
            "[><]clients" => ["id_merchant" => "id"]], [
            "spk.id",
            "spk.ticket_spk",
            "spk.id_merchant",
            "spk.spk_number",
            "spk.inc_cimb",
            "spk.id_itfs",
            "spk.reported_time",
            "spk.received_time",
            "spk.wo_activity",
            "spk.reason_code",
            "spk.supply_kertas",
            "spk.c_date_wo",
            "spk.spk_status",
            "spk.wo_remarks",
            "spk.id_sn_edc",
            "spk.id_sn_simcard",
            "spk.test_credit",
            "spk.test_prepaid",
            "spk.test_debit",
            "spk.sla_status",
            "spk.root_cause",
            "spk.sub_root_cause",
            "spk.remarks_spk",
            "clients.name"]);
        } else {
            $result = $database->select("spk", [
            "[><]clients" => ["id_merchant" => "id"]], [
            "spk.id",
            "spk.ticket_spk",
            "spk.id_merchant",
            "spk.spk_number",
            "spk.inc_cimb",
            "spk.id_itfs",
            "spk.reported_time",
            "spk.received_time",
            "spk.wo_activity",
            "spk.reason_code",
            "spk.supply_kertas",
            "spk.c_date_wo",
            "spk.spk_status",
            "spk.wo_remarks",
            "spk.id_sn_edc",
            "spk.id_sn_simcard",
            "spk.test_credit",
            "spk.test_prepaid",
            "spk.test_debit",
            "spk.sla_status",
            "spk.root_cause",
            "spk.sub_root_cause",
            "spk.remarks_spk",
            "clients.name"], [ "AND" => $filters ]);
        }

        $i=0;
        foreach($result as $item) {
            $result[$i]['ccs'] = unserialize($item['ccs']);
            $i++;
        }

        $response = [ "status" => 1, "status_message" => "Success!", "result" => $result ];
    break;

    case 'add':
        isAuthorizedApi("addTicket");

        $status = Spk::add($data);

        if($status == 10) $response = [ "status" => 1, "status_message" => "Success! Item has been added successfully." ];
        else $response = [ "status" => 2, "status_message" => "Error! Unable to add item." ];
    break;

    case 'edit':
        isAuthorizedApi("editTicket");

        $status = Spk::editAPI($data);

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
