<?php
include_once '../../../connection/databaseHandler.php';
include_once '../../../connection/sessionHandler.php';
$database = new DatabaseHandler();
$session = new SessionHandler();
?>
<div class="content">
    <table border="1">
        <tr>
            <th>NO</th>
            <th>POI TITLE</th>
            <th></th>
            <th></th>
        </tr>
        <?php
        $query1 = "SELECT userid FROM " . $database->t_poiuser . " WHERE name='" . $session->name . "'";
        $result1 = $database->execQuery($query1);
        while ($row = mysql_fetch_array($result1)) {
            $query2 = "SELECT title FROM ".$database->t_poi." WHERE userid=".$row['userid'];
            //$query2 = "SELECT title FROM " . $database->t_poi . " WHERE userid=0";
            $result2 = $database->execQuery($query2);
            $idx = 0;
            while ($row2 = mysql_fetch_array($result2)) {
                $idx++;
                ?>
                <tr>
                    <td>
                        <div>
                            <?php echo $idx ?>
                        </div>
                    </td>
                    <td>
                        <div>
                            <?php echo $row2['title'] ?>
                        </div>
                    </td>
                    <td>
                        <div>
                            <button>Edit</button>
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
        }
        ?>
    </table>
</div>
<div class="content">
    <form action="process/addpoi.php" method="POST">
        <div class="item">
            <label>Title :</label>
            <input type="text" id="title" name="title">
        </div>
        <div class="item">
            <label>Attribution :</label>
            <input type="text" id="attribution" name="attribution">
        </div>
        <div class="item">
            <label>Latitude :</label>
            <input type="text" id="lat" name="lat">
        </div>
        <div class="item">
            <label> Longitude :</label>
            <input type="text" id="lon" name="lon">
        </div>
        <div class="item">
            <label>Image URL :</label>
            <input type="text" id="imageurl" name="imageurl">
        </div>
        <div class="item">
            <input type="submit" value="Add New POI">
        </div>
    </form>
</div>
