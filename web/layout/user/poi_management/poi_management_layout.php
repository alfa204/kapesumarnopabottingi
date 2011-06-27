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
        $row = mysql_fetch_array($result1);
        //$query2 = "SELECT title FROM " . $database->t_poi . " WHERE userid=" . $row['userid'];
        $query2 = "SELECT title FROM " . $database->t_poi . " WHERE userid=0";
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
        ?>
    </table>
</div>
<div class="content">
    <form action="process/user_addpoi.php" method="POST">
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
            <input type="submit" value="Add New POI">
        </div>
    </form>
</div>
<div>
    <form action="process/user_addtagline.php" method="POST">
        <div class="item">
            <label>POI : </label>
            <select id="poiname" name="poiname">
                <?php
                //$query2 = "SELECT title FROM " . $database->t_poi . " WHERE userid=" . $row['userid'];
                $query3 = "SELECT title FROM " . $database->t_poi . " WHERE userid=0";
                $result3 = $database->execQuery($query2);
                while ($row3 = mysql_fetch_array($result3)) {
                    ?>
                    <option>
                        <?php echo $row3['title'] ?>
                    </option>
                    <?php
                }
                ?>
            </select>
        </div>
        <div class="item">
            <label>Tagline : </label>
            <input type="text" id="tagline" name="tagline">
        </div>
        <div class="item">
            <label>Start Date : </label>
            <input type="text" id="awal" name="awal">
        </div>
        <div class="item">
            <label>End Date : </label>
            <input type="text" id="akhir" name="akhir">
        </div>
        <div class="item">
            <input type="submit" value="Add Tagline">
        </div>
    </form>
    
</div>
