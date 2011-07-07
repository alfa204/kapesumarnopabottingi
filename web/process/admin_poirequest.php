<?php
    include_once '../connection/databaseHandler.php';
        $poi_id = $_GET['param'];
        $action = $_GET['action'];
        $database = new DatabaseHandler();
        $query1 = "SELECT id FROM ".$database->t_poistatus." WHERE label='".$action."'";
        $result1 = $database->execQuery($query1);
        $row1 = mysql_fetch_array($result1);
        echo $query1;
        $queryUpdate = "UPDATE ".$database->t_poi."
                    SET
                        poi_status_id=".$row1['id']."
                    WHERE
                        id = '$poi_id'";
        $database->execQuery($queryUpdate);
    echo ucfirst($action);
?>
