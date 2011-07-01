<?php
include_once '../../../connection/databaseHandler.php';
include_once '../../../connection/sessionHandler.php';
$database = new DatabaseHandler();
$session = new SessionHandler();
?>
<div id="detailcontent">
    <div class="content" style="width: 350px">
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
            $query2 = "SELECT * FROM " . $database->t_poi . " WHERE userid=3";
            $result2 = $database->execQuery($query2);
            $idx = 0;
            while ($row2 = mysql_fetch_array($result2)) {
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
                $query3 = "SELECT * FROM " . $database->t_tagline . " WHERE poi_id='" . $row2['id'] . "'";
                $result3 = $database->execQuery($query3);
                $row3 = mysql_fetch_array($result3);
                if ($row3) {
                    ?>
        <!--            <tr>
                        <th></th>
                        <th>Tagline</th>
                        <th>Start Date</th>
                        <th>End Date</th>
                    </tr>
                    <?php
                }
                while ($row3) {
                    ?>
                    <tr>
                        <td></td>
                        <td>
                            <div>
                    <?php echo $row3['text']; ?>
                            </div>
                        </td>
                        <td>
                            <div>
                    <?php echo $row3['start_date']; ?>
                            </div>
                        </td>
                        <td>
                            <div>
                    <?php echo $row3['end_date']; ?>
                            </div>
                        </td>
                    </tr>-->
                    <?php
                    $row3 = mysql_fetch_array($result3);
                }
            }
            ?>
        </table>
    </div>
    <div class="content" style="width: 450px; padding-left: 10px; border-style: solid">
        <div class="item">
            <label style="font-weight: bolder">CREATE NEW POI</label>
        </div>
        <form action="process/user_addpoi.php" method="POST">
            <div class="item">
                <label>Title :</label>
                <input type="text" id="title" name="title">
            </div>
            <div class="item">
                <label> Tagline :</label>
                <input type="text" id="tagline" name="tagline">
            </div>
            <div class="item">
                <label> Deskripsi :</label>
                <textarea id="deskripsi" name="deskripsi" cols="20" rows="3"></textarea>
            </div>
            <div class="item">
                <label> Kategori :</label>
                <select id="kategori" name="kategori">
                    <option value="1">Wisata</option>
                    <option value="2">Penginapan</option>
                </select>
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
                <label> Address :</label>
                <input type="text" id="address" name="address">
            </div>
            <div class="item">
                <label> Phone :</label>
                <input type="text" id="phone" name="phone">
            </div>
            <div class="item">
                <label> Email :</label>
                <input type="text" id="email" name="email">
            </div>
            <div class="item">
                <label> Image URL :</label>
                <input type="file" id="imageurl" name="imageurl">
            </div>
            <div class="item">
                <label> Image Full (256x256) :</label>
                <input type="file" id="imagefull" name="imagefull">
            </div>
            <div class="item">
                <label> Image Reduced (128x128) :</label>
                <input type="file" id="imagereduced" name="imagereduced">
            </div>
            <div class="item">
                <label> Image Icon (32x32) :</label>
                <input type="file" id="imageicon" name="imageicon">
            </div>
            <div class="item">
                <label> Image Wiki (64x64) :</label>
                <input type="file" id="imagewiki" name="imagewiki">
            </div>
            <div class="item">
                <input type="submit" value="Add POI">
            </div>
        </form>
    </div>
    <!--<div class="content">
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
    -->
</div>