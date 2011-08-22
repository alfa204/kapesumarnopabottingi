<?php
include_once '../../../connection/databaseHandler.php';
include_once '../../../connection/sessionHandler.php';
$database = new DatabaseHandler();
$session = new SessionHandler();
?>
<div id="addpoi">
    <div id="detailcontent">
        <?php
        $query1 = "SELECT id FROM " . $database->t_poiuser . " WHERE name='" . $session->name . "'";
        $result1 = $database->execQuery($query1);
        $row = mysql_fetch_array($result1);
        $query2 = "SELECT title FROM " . $database->t_poi . " WHERE user_id=" . $row['id'];
        //$query2 = "SELECT * FROM " . $database->t_poi . " WHERE user_id=3";
        $result2 = $database->execQuery($query2);
        $row2 = mysql_fetch_array($result2);
        if (!$row2) {
            ?>
            <div>
                You don't have any POI yet.
            </div>
            <?php
        } else {
            $idx = 0;
            ?>
            <div class="content" style="width: 350px">
                <table border="1">
                    <tr>
                        <th>NO</th>
                        <th>POI TITLE</th>
                        <th></th>
                        <th></th>
                    </tr>
                    <?php
                    do {
                        $idx++;
                        ?>
                        <tr>
                            <td>
                                <div>
                                    <?php echo $idx; ?>
                                </div>
                            </td>
                            <td>
                                <div>
                                    <?php echo $row2['title']; ?>
                                </div>
                            </td>
                            <td>
                                <div>
                                    <button onclick="buttonOnClick('layout/user/poi_management/poi_detail.php?poiname=<?php echo $row2['title']; ?>','detailcontent')">Details</button>
                                </div>
                            </td>
                            <td>
                                <div>
                                    <button>Delete</button>
                                </div>
                            </td>
                        </tr>
                        <?php
                    } while ($row2 = mysql_fetch_array($result2));
                    ?>
                </table>
            </div>
            <?php
        }
        ?>
        <br/>
        <div>
            <button onclick="buttonOnClick('layout/user/poi_management/poi_add.php?','addpoi')">Create New POI</button>
        </div>
    </div>
</div>