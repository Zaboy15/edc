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
            "spk.foto_mesin",
            "spk.foto_toko",
            "spk.foto_struk",
            "spk.sign",
            "spk.target_spk",
            "spk.target_bank",
            "spk.city",
            "spk.service_point",
            "spk.provinsi",
            "spk.mmc_desc",
            "spk.received_date_sticker",
            "spk.month",
            "spk.year",
            "spk.day",
            "spk.aging",
            "spk.mid(midqr)",
            "spk.midtid",
            "spk.tid",
            "clients.name",
            "clients.alamat",
            "clients.pic",
            "clients.phone_pic",
            "clients.mid"]);
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
            "spk.foto_mesin",
            "spk.foto_toko",
            "spk.foto_struk",
            "spk.received_date_sticker",
            "spk.sign",
            "spk.target_spk",
            "spk.target_bank",
            "spk.city",
            "spk.service_point",
            "spk.provinsi",
            "spk.mmc_desc",
            "spk.month",
            "spk.year",
            "spk.day",
            "spk.aging",
            "spk.mid(midqr)",
            "spk.midtid",
            "spk.tid",
            "clients.alamat",
            "clients.pic",
            "clients.phone_pic",
            "clients.name",
            "clients.mid",], [ "AND" => [
                "OR" => $filters, 
                "spk.spk_status[!]" => "Closed - Completed"]]);
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

    case 'editAPI':
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
