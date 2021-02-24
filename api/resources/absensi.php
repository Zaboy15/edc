<?php
#################
## absensi




switch ($request_method) {
    case 'get':
        isAuthorizedApi("viewTickets");
        $hari_ini = date("Y-m-d 23:59:00");
        // Tanggal pertama pada bulan ini
        $tgl_pertama = date('Y-m-01 00:00:01', strtotime($hari_ini));

        // Tanggal terakhir pada bulan ini
		$tgl_terakhir = date('Y-m-t 23:59:00', strtotime($hari_ini));
        // $sumrequest = $database->count("tickets",["AND" => ["category1"=> "2","open_ticket[<>]" => [$tgl_pertama, $tgl_terakhir]]]);

        if(empty($filters)) {
            $result = $database->select("absensi", "*");
        } else {
            $result = $database->select("absensi", "*", [ 
                "AND" => [
                    "OR" => [
                        $filters,
                    ],
                    "check_in[<>]" => [$tgl_pertama, $tgl_terakhir]
                ]
            ]);
        }

        $response = [ "status" => 1, "status_message" => "Success!", "result" => $result ];
    break;


    case 'getdataabsenku':
        isAuthorizedApi("viewTickets");
        $hariini = date("Y:m:d");
        $startdateclose = $hariini . " 00:00:01";
        $enddateclose = $hariini . " 23:59:59";
        
        if(empty($filters)) {
            $result = $database->select("absensi", "*");
        } else {
            $result = $database->select("absensi", "*", [ 
                "AND" => [
                    "OR" => [
                        $filters,
                    ],
                    "check_in[<>]" => [$startdateclose, $enddateclose]
                ]
            ]);
        }
        
        $response = [ "status" => 1, "status_message" => "Success!", "result" => $result ];
    break;


    case 'add':
        isAuthorizedApi("viewTickets");

        $status = Absensi::checkin($data);

        if($status == 10) $response = [ "status" => 1, "status_message" => "Success! Item has been added successfully." ];
        else $response = [ "status" => 2, "status_message" => "Error! Unable to add item." ];
    break;


    case 'edit':
        isAuthorizedApi("viewTickets");

        $status = Absensi::checkout($data);

        if($status == 20) $response = [ "status" => 1, "status_message" => "Success! Item has been updated successfully." ];
        else $response = [ "status" => 2, "status_message" => "Error! Unable to update item." ];
    break;

    



    default:
        $response = [ "status" => 907, "status_message" => "Request method " . $request_method . " not allowed for this resourse." ];
    break;
}





?>
