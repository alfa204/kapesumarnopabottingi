<?php
    include_once '../../connection/databaseHandler.php';
    $database = new DatabaseHandler();
    // get all label status tagline
    $query = "SELECT id,label FROM " . $database->t_taglinestatus;
    $result = $database->execQuery($query);
    $label_status = array();
    while ($row = mysql_fetch_array($result)) {
        $label_status[$row['label']] = $row['id'];
    }
    
    $action = $_POST['action'];
    $checked = $_POST['checked'];
    if ($action=='approved' || $action=='rejected' || $action=='pending' || $action=='edited') {
        // approve yang dichecked saja
        foreach($checked as $id) :
            $queryUpdate = "UPDATE ".$database->t_tagline."
                            SET
                                tagline_status_id=".$label_status[$action]."
                            WHERE
                                id = '$id'";
            $database->execQuery($queryUpdate);
        endforeach;
    } else if ($action=='delete') {
        // delete tagline
        foreach($checked as $id) :
            $queryDelete = "DELETE FROM ".$database->t_tagline."
                            WHERE
                                id = '$id'";
            $database->execQuery($queryDelete);
        endforeach;
    }
    
?>
