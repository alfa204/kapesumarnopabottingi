<?php
include_once '../../../connection/databaseHandler.php';
include_once '../../../connection/sessionHandler.php';
$database = new DatabaseHandler();
$session = new SessionHandler();

$poiname = $_GET['poiname'];

// Get informasi dari database
$query = "SELECT * FROM " . $database->t_poi . " WHERE title='" . $poiname . "'";
$result = $database->execQuery($query);
while ($row = mysql_fetch_array($result)) {
    ?>
    <div id="editcontent">
        <div class="content">
            <div class="item">
                <label>Title : <?php echo $row['title']; ?></label><br/>
            </div>
            <div class="item">
                <label>Latitude : <?php echo $row['lat']; ?></label><br/>
            </div>
            <div class="item">
                <label>Longitude : <?php echo $row['lon']; ?></label><br/>
            </div>
        </div>
    </div>
    <?php
}
?>
