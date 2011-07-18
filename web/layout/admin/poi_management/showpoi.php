<?php
include_once '../../../connection/databaseHandler.php';
$database = new DatabaseHandler();

$param = $_GET['param'];

if ($param == "all") {
    $query = "SELECT id,title,poi_status_id FROM " . $database->t_poi;
    $poistatus = 0;
} else {
    $query1 = "SELECT id FROM " . $database->t_poistatus . " WHERE label='" . $param . "'";
    $result1 = $database->execQuery($query1);
    $row1 = mysql_fetch_array($result1);
    $poistatus = $row1['id'];
    $query = "SELECT id,title,poi_status_id FROM " . $database->t_poi . " WHERE poi_status_id=" . $poistatus;
}

// get all label status poi
$query2 = "SELECT label FROM " . $database->t_poistatus;
$result2 = $database->execQuery($query2);
$label_status = array();
while ($row2 = mysql_fetch_array($result2)) {
    array_push($label_status, $row2['label']);
}

$result = $database->execQuery($query);
if (mysql_num_rows($result)!=0)
    $ada = true;
else
    $ada = false;
$i = 0;
?>
<div id="detailcontent">
    <div class="content">
        POI LIST : <?php echo $param; ?><br/>
        <?php if ($ada) { ?>
        <table>
            <tr>
                <th>NO</th>
                <th></th>
                <th>TITLE</th>
                <?php if ($param == "all") { ?>
                <th>STATUS</th>
                <?php } ?>
                <th></th>
                <th></th>
            </tr>
            <?php
            while ($row = mysql_fetch_array($result)) {
                $i++;
                ?>
                <tr>
                    <td>
                        <div>
                            <?php echo $i; ?>
                        </div>
                    </td>
                    <td>
                        <div>
                            <input type="checkbox" name="checklist" value="<?php echo $row['id']; ?>" />
                        </div>
                    </td>
                    <td>
                        <div>
                            <?php echo $row['title']; ?>
                        </div>
                    </td>
                    <?php if ($param == "all") { ?>
                    <td>
                        <div>
                            <?php echo $label_status[$row['poi_status_id']-1];?>
                        </div>
                    </td>
                    <?php } ?>
                    <td>
                        <div>
                            <button onclick="buttonOnClick('layout/admin/poi_management/poi_detail.php?poiname=<?php echo $row['title']; ?>','showpoi')">Details</button>
                        </div>
                    </td>
                    <td>
                        <div>
                            <button>Delete</button>
                        </div>
                    </td>
                </tr>
                <?php
            }
            ?>
        </table>
        <?php } else { ?>
        No POI with this status.
        <?php } ?>
    </div>
</div>
<div class="clearboth">
</div>
<div id="with_check">
    <?php if ($ada) { ?>
    <a href="javascript:check_all(true)">Check All</a> / <a href="javascript:check_all(false)">Uncheck All</a> 
    With Selected : 
    <select name="status" onchange="javascript:change_status()">
        <option value="change"> - Change Status - </option>
        <option value="approved">Approved</option>
        <option value="rejected">Rejected</option>
        <option value="pending">Pending</option>
        <option value="edited">Edited</option>
        <option value="published">Published</option>
        <option value="unpublished">Unpublished</option>
    </select>
    <a href="javascript:delete_poi()">Delete</a>
    <?php } ?>
</div>
