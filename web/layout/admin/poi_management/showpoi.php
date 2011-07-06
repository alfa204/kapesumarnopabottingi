<?php
include_once '../../../connection/databaseHandler.php';
$database = new DatabaseHandler();

$param = $_GET['param'];

if ($param == "all") {
    $query = "SELECT title FROM " . $database->t_poi;
} else {
    $query1 = "SELECT id FROM " . $database->t_poistatus . " WHERE label='" . $param . "'";
    $result1 = $database->execQuery($query1);
    $row1 = mysql_fetch_array($result1);
    $poistatus = $row1['id'];
    $query = "SELECT title FROM " . $database->t_poi . " WHERE poi_status_id=" . $poistatus;
}

$result = $database->execQuery($query);
$i = 0;
?>
<div class="content">
    <table>
        <caption>POI LIST : <?php echo $param; ?></caption>
        <tr>
            <th>NO</th>
            <th>TITLE</th>
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
                        <?php echo $row['title']; ?>
                    </div>
                </td>
                <td>
                    <div>
                        <button>Details</button>
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
</div>

