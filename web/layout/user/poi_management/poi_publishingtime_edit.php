<?php
include_once '../../../connection/databaseHandler.php';
include_once '../../../connection/sessionHandler.php';
$database = new DatabaseHandler();
$session = new SessionHandler();

$publishingtime_id = $_GET['publishingtime_id'];
$poi_id = $_GET['poi_id'];

$query = "SELECT title FROM " . $database->t_poi . " WHERE id='" . $poi_id . "'";
$result = $database->execQuery($query);
$row = mysql_fetch_array($result);

$query2 = "SELECT * FROM " . $database->t_waktutayang . " WHERE id='" . $publishingtime_id . "'";
$result2 = $database->execQuery($query2);
$row2 = mysql_fetch_array($result2);
?>

<div>
    POI Name : <?php echo $row['title'] ?>
</div>
<form method="POST" action="process/user/editpublishingtime.php?publishingtime_id=<?php echo $publishingtime_id; ?>">
    <table>
        <tr>
            <td>
                <div class="item">
                    <label>Label</label>
                </div>
            </td>
            <td> : </td>
            <td>
                <div class="item">
                    <input type="text" id="label" name="label" value="<?php echo $row2['label']; ?>"/>
                </div>
            </td>
        </tr>
        <tr>
            <td>
                <div class="item">
                    <label>Start Date</label>
                </div>
            </td>
            <td> : </td>
            <td>
                <div class="item">
                    <input type="text" id="start_date" name="start_date" value="<?php echo $row2['start_date']; ?>"/>
                </div>
            </td>
        </tr>
        <tr>
            <td>
                <div class="item">
                    <label>End Date</label>
                </div>
            </td>
            <td> : </td>
            <td>
                <div class="item">
                    <input type="text" id="end_date" name="end_date" value="<?php echo $row2['end_date']; ?>"/>
                </div>
            </td>
        </tr>
        <tr>
            <td colspan="3">
                <input type="submit" name="edit_publishingtime" id="edit_publishingtime" value="Submit"/>
            </td>
        </tr>
    </table>
</form>