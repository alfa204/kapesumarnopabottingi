<?php
include_once '../../../connection/databaseHandler.php';
$database = new DatabaseHandler();

$tagline_id = $_GET['tagline'];
// get info tagline
$query = "SELECT * FROM " . $database->t_tagline . " WHERE id=" . $tagline_id;
$result = $database->execQuery($query);
$row = mysql_fetch_array($result);
?>
<br/><br/>
<form action="process/user/edittagline.php?tagline_id=<?php echo $tagline_id; ?>" method="POST">
    <table>
        <caption>EDIT TAGLINE</caption>
        <tr>
            <td>
                <div class="item">
                    <label>Text :</label>
                </div>
            </td>
            <td>
                <div class="item">
                    <input type="text" id="text" name="text" value="<?php echo $row['text'];?>">
                </div>
            </td>
        </tr>
        <tr>
            <td>
                <div class="item">
                    <label>Start Date :</label>
                </div>
            </td>
            <td>
                <div class="item">
                    <input type="text" id="start" name="start"  value="<?php echo $row['start_date'];?>">
                </div>
            </td>
        </tr>
        <tr>
            <td>
                <div class="item">
                    <label>End Date :</label>
                </div>
            </td>
            <td>
                <div class="item">
                    <input type="text" id="end" name="end"  value="<?php echo $row['end_date'];?>">
                </div>
            </td>
        </tr>
        <tr>
            <td></td>
            <td>
                <div class="item">
                    <input type="submit" value="EDIT TAGLINE">
                </div>
            </td>
        </tr>
    </table>
</form>
