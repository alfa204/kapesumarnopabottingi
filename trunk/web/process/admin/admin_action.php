<?php
    include_once '../connection/databaseHandler.php';
    
    $database = new DatabaseHandler();
    // get all label status poi
    $query2 = "SELECT id,label FROM " . $database->t_poistatus;
    $result2 = $database->execQuery($query2);
    $label_status = array();
    while ($row2 = mysql_fetch_array($result2)) {
        $label_status[$row2['label']] = $row2['id'];
    }
    
    
    $action = $_POST['action'];
    $checked = $_POST['checked'];
    if ($action=='approved' || $action=='rejected' || $action=='pending' || $action=='published' || $action=='unpublished' || $action=='edited') {
        // approve yang dichecked saja
        foreach($checked as $id) :
            $queryUpdate = "UPDATE ".$database->t_poi."
                            SET
                                poi_status_id=".$label_status[$action]."
                            WHERE
                                id = '$id'";
            $database->execQuery($queryUpdate);
        endforeach;
    } else if ($action=='delete') {
        // delete poi
        foreach($checked as $id) :
            $queryDelete = "DELETE FROM ".$database->t_poi."
                            WHERE
                                id = '$id'";
            $database->execQuery($queryDelete);
        endforeach;
    }
?>
