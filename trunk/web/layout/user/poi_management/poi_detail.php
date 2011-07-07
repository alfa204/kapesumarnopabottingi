<?php
include_once '../../../connection/databaseHandler.php';
include_once '../../../connection/sessionHandler.php';
$database = new DatabaseHandler();
$session = new SessionHandler();

$poiname = $_GET['poiname'];
?>
<div id="editcontent">
    <?php
    // Get informasi dari database
    $query = "SELECT * FROM " . $database->t_poi . " WHERE title='" . $poiname . "'";
    $result = $database->execQuery($query);
    while ($row = mysql_fetch_array($result)) {
        ?>
        <div class="content">
            <div class="item">
                <label>Title : <?php echo $row['title']; ?></label><br/>
            </div>
            <div class="item">
                <label>Category :
                    <?php
                    if ($row['kategori'] == 1) {
                        echo "Wisata";
                    } else if ($row['kategori'] == 2) {
                        echo "Penginapan";
                    }
                    ?>
                </label><br/>
            </div>
            <div class="item">
                <label>Description : <?php echo $row['deskripsi']; ?></label><br/>
            </div>
            <div class="item">
                <label>Latitude : <?php echo $row['lat']; ?></label><br/>
            </div>
            <div class="item">
                <label>Longitude : <?php echo $row['lon']; ?></label><br/>
            </div>
            <div class="item">
                <label>Address : <?php echo $row['address']; ?></label><br/>
            </div>
            <div class="item">
                <label>Phone : <?php echo $row['phone']; ?></label><br/>
            </div>
            <div class="item">
                <label>Email : <?php echo $row['email']; ?></label><br/>
            </div>
            <?php
            if ($row['poi_status_id'] != 1) {
                ?>
                <div class="item">
                    <button onclick="buttonOnClick('layout/user/poi_management/poi_edit.php?poiname=<?php echo $row['title']; ?>','editcontent')">EDIT</button>
                </div>
                <?php
            }
            ?>
            <br/><br/>
            <div class="item">
                <table>
                    <caption>Publishing Time</caption>
                    <tr>
                        <th>NO</th>
                        <th>LABEL</th>
                        <th>START DATE</th>
                        <th>END DATE</th>
                    </tr>
                    <?php
                    $i = 0;
                    $poi_id = $row['id'];
                    $query2 = "SELECT * FROM " . $database->t_waktutayang . " WHERE poi_id=" . $poi_id;
                    $result2 = $database->execQuery($query2);
                    while ($row2 = mysql_fetch_array($result2)) {
                        $i++;
                        ?>
                        <tr>
                            <td><?php echo $i; ?></td>
                            <td><?php echo $row2['label']; ?></td>
                            <td><?php echo $row2['start_date']; ?></td>
                            <td><?php echo $row2['end_date']; ?></td>
                        </tr>
                        <?php
                    }
                    ?>
                </table>
            </div>
            <div class="item">
                <table>
                    <caption>Tagline</caption>
                    <tr>
                        <th>NO</th>
                        <th>TEXT</th>
                        <th>START DATE</th>
                        <th>END DATE</th>
                        <th>STATUS</th>
                    </tr>
                    <?php
                    $i = 0;
                    $poi_id = $row['id'];
                    $query3 = "SELECT * FROM " . $database->t_tagline . " WHERE poi_id=" . $poi_id;
                    $result3 = $database->execQuery($query3);
                    while ($row3 = mysql_fetch_array($result3)) {
                        $i++;
                        ?>
                        <tr>
                            <td><?php echo $i; ?></td>
                            <td><?php echo $row3['text']; ?></td>
                            <td><?php echo $row3[start_date]; ?></td>
                            <td><?php echo $row3[end_date]; ?></td>
                            <td>
                                <?php
                                $query4 = "SELECT label FROM " . $database->t_taglinestatus . " WHERE id=" . $row3['tagline_status_id'];
                                $result4 = $database->execQuery($query4);
                                while ($row4 = mysql_fetch_array($result4)) {
                                    echo $row4['label'];
                                }
                                ?>
                            </td>
                        </tr>
                        <?php
                    }
                    ?>
                </table>
            </div>
        </div>
        <div class="content">
            <div class="content">
                <form action="process/user/addtagline.php?poi_id=<?php echo $row['id']; ?>" method="POST">
                    <table>
                        <caption>ADD TAGLINE</caption>
                        <tr>
                            <td>
                                <div class="item">
                                    <label>Text :</label>
                                </div>
                            </td>
                            <td>
                                <div class="item">
                                    <input type="text" id="text" name="text">
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
                                    <input type="text" id="start" name="start">
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
                                    <input type="text" id="end" name="end">
                                </div>
                            </td>
                        </tr>
                        <tr>
                            <td></td>
                            <td>
                                <div class="item">
                                    <input type="submit" value="ADD TAGLINE">
                                </div>
                            </td>
                        </tr>
                    </table>
                </form>
            </div>
            <div class="clearboth"></div>
            <div class="content">
                <form action="process/user/addpublishingtime.php?poi_id=<?php echo $row['id']; ?>" method="POST">
                    <table>
                        <caption>ADD PUBLISHING TIME</caption>
                        <tr>
                            <td>
                                <div class="item">
                                    <label>Label :</label>
                                </div>
                            </td>
                            <td>
                                <div class="item">
                                    <input type="text" id="label" name="label">
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
                                    <input type="text" id="start" name="start">
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
                                    <input type="text" id="end" name="end">
                                </div>
                            </td>
                        </tr>
                        <tr>
                            <td></td>
                            <td>
                                <div class="item">
                                    <input type="submit" value="ADD PUBLISHING TIME">
                                </div>
                            </td>
                        </tr>
                    </table>
                </form>
            </div>
        </div>
    </div>
    <?php
}
?>
