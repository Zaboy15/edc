<?php
#################
## users




switch ($request_method) {
    case 'get':
        isAuthorizedApi("viewStaff");

        $filters['type'] = 'admin';
        $result = $database->select("people", "*", [ "AND" => $filters ]);
        $i=0;
        foreach($result as $item) {
            $result[$i]['project'] = unserialize($item['project']);
            $i++;
        }

        $s=0;
        foreach($result as $item1) {
            $result[$s]['customfields'] = unserialize($item1['customfields']);
            $s++;
        }

        $response = [ "status" => 1, "status_message" => "Success!", "result" => $result ];
    break;

    case 'add':
        isAuthorizedApi("addStaff");

        $status = Staff::add($data);

        if($status == 10) $response = [ "status" => 1, "status_message" => "Success! Item has been added successfully." ];
        else $response = [ "status" => 2, "status_message" => "Error! Unable to add item." ];
    break;

    case 'edit':
        isAuthorizedApi("editStaff");

        $status = Staff::edit($data);

        if($status == 20) $response = [ "status" => 1, "status_message" => "Success! Item has been updated successfully." ];
        else $response = [ "status" => 2, "status_message" => "Error! Unable to update item." ];
    break;

    case 'editAPI':
        isAuthorizedApi("editStaff");

        $status = Staff::editAPI($data);

        if($status == 20) $response = [ "status" => 1, "status_message" => "Success! Item has been updated successfully." ];
        else $response = [ "status" => 2, "status_message" => "Error! Unable to update item." ];
    break;

    case 'editToken':
        isAuthorizedApi("editStaff");

        $status = Staff::editToken($data);

        if($status == 20) $response = [ "status" => 1, "status_message" => "Success! Item has been updated successfully." ];
        else $response = [ "status" => 2, "status_message" => "Error! Unable to update item." ];
    break;

    case 'editLocation':
        isAuthorizedApi("editStaff");

        $status = Staff::editLocation($data);

        if($status == 20) $response = [ "status" => 1, "status_message" => "Success! Item has been updated successfully." ];
        else $response = [ "status" => 2, "status_message" => "Error! Unable to update item." ];
    break;

    case 'delete':
        isAuthorizedApi("deleteStaff");

        $status = Staff::delete($id);

        if($status == 30) $response = [ "status" => 1, "status_message" => "Success! Item has been delete successfully." ];
        else $response = [ "status" => 2, "status_message" => "Error! Unable to delete item." ];
    break;



    default:
        $response = [ "status" => 907, "status_message" => "Request method " . $request_method . " not allowed for this resourse." ];
    break;
}





?>
