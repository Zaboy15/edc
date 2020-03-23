<?php

class Pemeriksaan extends App {

    // TICKETS


    public static function addPemeriksaanEDC($data) {
        global $database;
        
        if($data['seal_edc'] == false) $seal_edc = "false"; else $seal_edc = "true";
        if($data['seal_sim'] == false) $seal_sim = "false"; else $seal_sim = "true";
        if($data['simcard'] == false) $simcard = "false"; else $simcard = "true";
        if($data['transaksi_sale'] == false) $transaksi_sale = "false"; else $transaksi_sale = "true";
        if($data['transaksi_settlement'] == false) $transaksi_settlement = "false"; else $transaksi_settlement = "true";
        if($data['transaksi_emv'] == false) $transaksi_emv = "false"; else $transaksi_emv = "true";
        if($data['transaksi_void'] == false) $transaksi_void = "false"; else $transaksi_void = "true";
        if($data['transaksi_cicilan'] == false) $transaksi_cicilan = "false"; else $transaksi_cicilan = "true";
        if($data['printer_test'] == false) $printer_test = "false"; else $printer_test = "true";
        if($data['lcd'] == false) $lcd = "false"; else $lcd = "true";
        if($data['keypad'] == false) $keypad = "false"; else $keypad = "true";
        if($data['swipe_reader'] == false) $swipe_reader = "false"; else $swipe_reader = "true";
        if($data['chip_reader'] == false) $chip_reader = "false"; else $chip_reader = "true";

        if($data['idspk'] == 0) $idspk = 0; else $idspk = $data['idspk'];
        if($data['idticket'] == 0) $idticket = 0; else $idticket = $data['idticket'];



    
    	$pemeriksaanid = $database->insert("tabel_pemeriksaan", [
    		"idticket" => $idticket,
    		"idspk" => $idspk,
            "seal_sim" => $seal_sim,
            "seal_edc" => $seal_edc,
            "simcard" => $simcard,
            "transaksi_sale" => $transaksi_sale,
            "transaksi_settlement" => $transaksi_settlement,
            "transaksi_emv" => $transaksi_emv,
            "transaksi_void" => $transaksi_void,
            "transaksi_cicilan" => $transaksi_cicilan,
            "printer_test" => $printer_test,
            "lcd" => $lcd,
            "keypad" => $keypad,
            "swipe_reader" => $swipe_reader,
            "chip_reader" => $chip_reader
            

    	]);

    	

        

    	if ($pemeriksaanid == "0") { return "11"; }
        else {
    		logSystem("Pemeriksaan Added - ID: " . $pemeriksaanid);
    		return "10";
        }

    }

    public static function addAPI($data) {
        global $database;
        
        if($data['seal_edc'] == false) $seal_edc = "false"; else $seal_edc = "true";
        if($data['seal_sim'] == false) $seal_sim = "false"; else $seal_sim = "true";
        if($data['simcard'] == false) $simcard = "false"; else $simcard = "true";
        if($data['transaksi_sale'] == false) $transaksi_sale = "false"; else $transaksi_sale = "true";
        if($data['transaksi_settlement'] == false) $transaksi_settlement = "false"; else $transaksi_settlement = "true";
        if($data['transaksi_emv'] == false) $transaksi_emv = "false"; else $transaksi_emv = "true";
        if($data['transaksi_void'] == false) $transaksi_void = "false"; else $transaksi_void = "true";
        if($data['transaksi_cicilan'] == false) $transaksi_cicilan = "false"; else $transaksi_cicilan = "true";
        if($data['printer_test'] == false) $printer_test = "false"; else $printer_test = "true";
        if($data['lcd'] == false) $lcd = "false"; else $lcd = "true";
        if($data['keypad'] == false) $keypad = "false"; else $keypad = "true";
        if($data['swipe_reader'] == false) $swipe_reader = "false"; else $swipe_reader = "true";
        if($data['chip_reader'] == false) $chip_reader = "false"; else $chip_reader = "true";

    
    	$pemeriksaanid = $database->insert("tabel_pemeriksaan", [
    		"idticket" =>  $data['idticket'],
            "idspk" => $data['idspk'],
    		"idpm" => $data['idpm'],
            "seal_sim" => $data['seal_sim'],
            "seal_edc" => $data['seal_edc'],
            "simcard" => $data['simcard'],
            "transaksi_sale" => $data['transaksi_sale'],
            "transaksi_settlement" => $data['transaksi_settlement'],
            "transaksi_emv" => $data['transaksi_emv'],
            "transaksi_void" => $data['transaksi_void'],
            "transaksi_cicilan" => $data['transaksi_cicilan'],
            "printer_test" => $data['printer_test'],
            "lcd" => $data['lcd'],
            "keypad" => $data['keypad'],
            "swipe_reader" => $data['swipe_reader'],
            "chip_reader" => $data['chip_reader'],
            

    	]);

    	

        

    	if ($pemeriksaanid == "0") { return "11"; }
        else {
    		logSystem("Pemeriksaan Added - ID: " . $pemeriksaanid);
    		return "10";
        }

    }

    

    

    public static function editPemeriksaanEDC($data) {
    	global $database;
        if($data['seal_edc'] == false) $seal_edc = "false"; else $seal_edc = "true";
        if($data['seal_sim'] == false) $seal_sim = "false"; else $seal_sim = "true";
        if($data['simcard'] == false) $simcard = "false"; else $simcard = "true";
        if($data['transaksi_sale'] == false) $transaksi_sale = "false"; else $transaksi_sale = "true";
        if($data['transaksi_settlement'] == false) $transaksi_settlement = "false"; else $transaksi_settlement = "true";
        if($data['transaksi_emv'] == false) $transaksi_emv = "false"; else $transaksi_emv = "true";
        if($data['transaksi_void'] == false) $transaksi_void = "false"; else $transaksi_void = "true";
        if($data['transaksi_cicilan'] == false) $transaksi_cicilan = "false"; else $transaksi_cicilan = "true";
        if($data['printer_test'] == false) $printer_test = "false"; else $printer_test = "true";
        if($data['lcd'] == false) $lcd = "false"; else $lcd = "true";
        if($data['keypad'] == false) $keypad = "false"; else $keypad = "true";
        if($data['swipe_reader'] == false) $swipe_reader = "false"; else $swipe_reader = "true";
        if($data['chip_reader'] == false) $chip_reader = "false"; else $chip_reader = "true";

       


            $database->update("tabel_pemeriksaan", [
                "seal_sim" => $seal_sim,
                "seal_edc" => $seal_edc,
                "simcard" => $simcard,
                "transaksi_sale" => $transaksi_sale,
                "transaksi_settlement" => $transaksi_settlement,
                "transaksi_emv" => $transaksi_emv,
                "transaksi_void" => $transaksi_void,
                "transaksi_cicilan" => $transaksi_cicilan,
                "printer_test" => $printer_test,
                "lcd" => $lcd,
                "keypad" => $keypad,
                "swipe_reader" => $swipe_reader,
                "chip_reader" => $chip_reader,


            ], [ "idspk" => $data['idspk'] ]);
        

    	logSystem("Pemeriksaan Edited - ID: " . $data['id']);
    	return "20";
    }
        
    public static function editPemeriksaanEDCAPI($data) {
        global $database;
        if($data['seal_edc'] == "false") $seal_edc = "false"; else $seal_edc = "true";
        if($data['seal_sim'] == "false") $seal_sim = "false"; else $seal_sim = "true";
        if($data['simcard'] == "false") $simcard = "false"; else $simcard = "true";
        if($data['transaksi_sale'] == "false") $transaksi_sale = "false"; else $transaksi_sale = "true";
        if($data['transaksi_settlement'] == "false") $transaksi_settlement = "false"; else $transaksi_settlement = "true";
        if($data['transaksi_emv'] == "false") $transaksi_emv = "false"; else $transaksi_emv = "true";
        if($data['transaksi_void'] == "false") $transaksi_void = "false"; else $transaksi_void = "true";
        if($data['transaksi_cicilan'] == "false") $transaksi_cicilan = "false"; else $transaksi_cicilan = "true";
        if($data['printer_test'] == "false") $printer_test = "false"; else $printer_test = "true";
        if($data['lcd'] == "false") $lcd = "false"; else $lcd = "true";
        if($data['keypad'] == "false") $keypad = "false"; else $keypad = "true";
        if($data['swipe_reader'] == "false") $swipe_reader = "false"; else $swipe_reader = "true";
        if($data['chip_reader'] == "false") $chip_reader = "false"; else $chip_reader = "true";

        
            $database->update("tabel_pemeriksaan", [
                "seal_sim" => $seal_sim,
                "seal_edc" => $seal_edc,
                "simcard" => $simcard,
                "transaksi_sale" => $transaksi_sale,
                "transaksi_settlement" => $transaksi_settlement,
                "transaksi_emv" => $transaksi_emv,
                "transaksi_void" => $transaksi_void,
                "transaksi_cicilan" => $transaksi_cicilan,
                "printer_test" => $printer_test,
                "lcd" => $lcd,
                "keypad" => $keypad,
                "swipe_reader" => $swipe_reader,
                "chip_reader" => $chip_reader,


            ], [ "id" => $data['id'] ]);
        

        logSystem("Pemeriksaan Edited - ID: " . $data['id']);
        return "20";
    }

    public static function editPemeriksaanEDCAPISPK($data) {
        global $database;
        if($data['seal_edc'] == "false") $seal_edc = "false"; else $seal_edc = "true";
        if($data['seal_sim'] == "false") $seal_sim = "false"; else $seal_sim = "true";
        if($data['simcard'] == "false") $simcard = "false"; else $simcard = "true";
        if($data['transaksi_sale'] == "false") $transaksi_sale = "false"; else $transaksi_sale = "true";
        if($data['transaksi_settlement'] == "false") $transaksi_settlement = "false"; else $transaksi_settlement = "true";
        if($data['transaksi_emv'] == "false") $transaksi_emv = "false"; else $transaksi_emv = "true";
        if($data['transaksi_void'] == "false") $transaksi_void = "false"; else $transaksi_void = "true";
        if($data['transaksi_cicilan'] == "false") $transaksi_cicilan = "false"; else $transaksi_cicilan = "true";
        if($data['printer_test'] == "false") $printer_test = "false"; else $printer_test = "true";
        if($data['lcd'] == "false") $lcd = "false"; else $lcd = "true";
        if($data['keypad'] == "false") $keypad = "false"; else $keypad = "true";
        if($data['swipe_reader'] == "false") $swipe_reader = "false"; else $swipe_reader = "true";
        if($data['chip_reader'] == "false") $chip_reader = "false"; else $chip_reader = "true";

            $database->update("tabel_pemeriksaan", [
                "seal_sim" => $seal_sim,
                "seal_edc" => $seal_edc,
                "simcard" => $simcard,
                "transaksi_sale" => $transaksi_sale,
                "transaksi_settlement" => $transaksi_settlement,
                "transaksi_emv" => $transaksi_emv,
                "transaksi_void" => $transaksi_void,
                "transaksi_cicilan" => $transaksi_cicilan,
                "printer_test" => $printer_test,
                "lcd" => $lcd,
                "keypad" => $keypad,
                "swipe_reader" => $swipe_reader,
                "chip_reader" => $chip_reader,


            ], [ "idspk" => $data['idspk'] ]);
        

        logSystem("Ticket Edited - ID: " . $data['id']);
        return "20";
    }

    public static function editPemeriksaanEDCAPIPM($data) {
        global $database;
        if($data['seal_edc'] == "false") $seal_edc = "false"; else $seal_edc = "true";
        if($data['seal_sim'] == "false") $seal_sim = "false"; else $seal_sim = "true";
        if($data['simcard'] == "false") $simcard = "false"; else $simcard = "true";
        if($data['transaksi_sale'] == "false") $transaksi_sale = "false"; else $transaksi_sale = "true";
        if($data['transaksi_settlement'] == "false") $transaksi_settlement = "false"; else $transaksi_settlement = "true";
        if($data['transaksi_emv'] == "false") $transaksi_emv = "false"; else $transaksi_emv = "true";
        if($data['transaksi_void'] == "false") $transaksi_void = "false"; else $transaksi_void = "true";
        if($data['transaksi_cicilan'] == "false") $transaksi_cicilan = "false"; else $transaksi_cicilan = "true";
        if($data['printer_test'] == "false") $printer_test = "false"; else $printer_test = "true";
        if($data['lcd'] == "false") $lcd = "false"; else $lcd = "true";
        if($data['keypad'] == "false") $keypad = "false"; else $keypad = "true";
        if($data['swipe_reader'] == "false") $swipe_reader = "false"; else $swipe_reader = "true";
        if($data['chip_reader'] == "false") $chip_reader = "false"; else $chip_reader = "true";

            $database->update("tabel_pemeriksaan", [
                "seal_sim" => $seal_sim,
                "seal_edc" => $seal_edc,
                "simcard" => $simcard,
                "transaksi_sale" => $transaksi_sale,
                "transaksi_settlement" => $transaksi_settlement,
                "transaksi_emv" => $transaksi_emv,
                "transaksi_void" => $transaksi_void,
                "transaksi_cicilan" => $transaksi_cicilan,
                "printer_test" => $printer_test,
                "lcd" => $lcd,
                "keypad" => $keypad,
                "swipe_reader" => $swipe_reader,
                "chip_reader" => $chip_reader,


            ], [ "idpm" => $data['idpm'] ]);
        

        logSystem("Ticket Edited - ID: " . $data['id']);
        return "20";
    }

                

    public static function delete($id) {
    	global $database;
        File::delete_ticket_files($id);

        $database->delete("tickets", [ "id" => $id ]);
    	$database->delete("tickets_replies", [ "ticketid" => $id ]);
    	logSystem("Ticket Deleted - ID: " . $id);
    	return "30";
    }

    



}

?>
