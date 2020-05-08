<?php

class Export extends App {

    public static function exportDataSPK($data) {
        global $database;
        
        
        if($data['spk_status'] == ""){
            $startdate = dateDb($data['startDate']) . " 00:00:00";
        $enddate = dateDb($data['endDate']) . " 23:59:59";
            $spk = $database->select("spk", [
                "[>]clients" => ["id_merchant" => "id"],
                "[>]people" => ["id_itfs" => "id"],
                ], [
                "spk.id",
                "spk.ticket_spk",
                "spk.id_merchant",
                "spk.spk_number",
                "spk.inc_cimb",
                "spk.id_itfs",
                "people.name(namaitfs)",
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
                "clients.name(namamerchant)",
                "clients.mid(midmerchant)",],["c_date_wo[<>]" => [$startdate,$enddate]]);
            
            header('Content-Type: application/excel');
            header('Content-Disposition: attachment; filename="reportspk.csv"');
            
            $output = fopen('php://output', 'w');
            $no = 1;
    
            $header = [
                "No",
                "SPK Number",
                "Received Date SPK",
                "Received Date File Sticker",
                "Target Date SPK",
                "Target Date Bank",
                "Work Activity ",
                "Merchant Name",
                "Alamat",
                "City",
                "Service Point",
                "MIDTID",
                "Master MID",
                "MID QR",
                "SPK Status",
                "WO Remarks",
                "Complete DateWO",
                "Remark SPK",
                "PIC Merchant",
                "Telp Merhant",
                "ITFS",
                "SLA Status",
                "BTS",
                "Root Cause",
                "Sub Root Cause",
                "MCC Description",
                "Month",
                "Year",
                "Day",
                "Aging",
            ];
    
        
        
            fputcsv($output, $header);
    
            foreach ($spk as $row) 
                {
                    $data = [
                        $no,
                        $row['spk_number'],
                        $row['received_time'],
                        $row['received_date_sticker'],
                        $row['target_spk'],
                        $row['target_bank'],
                        $row['wo_activity'],
                        $row['namamerchant'],
                        $row['alamat'],
                        $row['city'],
                        $row['service_point'],
                        $row['midtid'],
                        $row['midmerchant'],
                        $row['midqr'],
                        $row['spk_status'],
                        $row['wo_remarks'],
                        $row['c_date_wo'],
                        $row['remarks_spk'],
                        $row['pic'],
                        $row['phone_pic'],
                        $row['namaitfs'],
                        $row['bts'],
                        $row['root_cause'],
                        $row['sub_root_cause'],
                        $row['mmc_desc'],
                        $row['month'],
                        $row['year'],
                        $row['day'],
                        $row['aging'],
                    ];
                    $no++;
            fputcsv($output, $data);
                }
    
    
    
            fclose($output);
        } else {
            $startdate = dateDb($data['startDate']) . " 00:00:00";
            $enddate = dateDb($data['endDate']) . " 23:59:59";
        $spk = $database->select("spk", [
            "[>]clients" => ["id_merchant" => "id"],
            "[>]people" => ["id_itfs" => "id"],
            ], [
            "spk.id",
            "spk.ticket_spk",
            "spk.id_merchant",
            "spk.spk_number",
            "spk.inc_cimb",
            "spk.id_itfs",
            "people.name(namaitfs)",
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
            "clients.name(namamerchant)",
            "clients.mid(midmerchant)"],[
                "AND" => [
                    "spk.c_date_wo[<>]" => [$startdate,$enddate],
                    "spk.spk_status" => $data['spk_status'],

                ]
                ]);
        
		header('Content-Type: application/excel');
		header('Content-Disposition: attachment; filename="reportspk.csv"');
		
        $output = fopen('php://output', 'w');
        $no = 1;

		$header = [
			"No",
            "SPK Number",
            "Received Date SPK",
            "Received Date File Sticker",
            "Target Date SPK",
            "Target Date Bank",
            "Work Activity ",
            "Merchant Name",
            "Alamat",
            "City",
            "Service Point",
            "MIDTID",
            "Master MID",
            "MID QR",
            "SPK Status",
            "WO Remarks",
            "Complete DateWO",
            "Remark SPK",
            "PIC Merchant",
            "Telp Merhant",
            "ITFS",
            "SLA Status",
            "BTS",
            "Root Cause",
            "Sub Root Cause",
            "MCC Description",
            "Month",
            "Year",
            "Day",
            "Aging",
		];

	
	
        fputcsv($output, $header);

        foreach ($spk as $row) 
            {
                $data = [
                    $no,
                    $row['spk_number'],
                    $row['received_time'],
                    $row['received_date_sticker'],
                    $row['target_spk'],
                    $row['target_bank'],
                    $row['wo_activity'],
                    $row['namamerchant'],
                    $row['alamat'],
                    $row['city'],
                    $row['service_point'],
                    $row['midtid'],
                    $row['midmerchant'],
                    $row['midqr'],
                    $row['spk_status'],
                    $row['wo_remarks'],
                    $row['c_date_wo'],
                    $row['remarks_spk'],
                    $row['pic'],
                    $row['phone_pic'],
                    $row['namaitfs'],
                    $row['bts'],
                    $row['root_cause'],
                    $row['sub_root_cause'],
                    $row['mmc_desc'],
                    $row['month'],
                    $row['year'],
                    $row['day'],
                    $row['aging'],
                ];
                $no++;
        fputcsv($output, $data);
            }



		fclose($output);
        }

	}

    }

?>