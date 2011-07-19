<?php
include_once '../../../connection/databaseHandler.php';
$database = new DatabaseHandler();

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
            <div class="item">
                <label>Status : <?php
                $query1 = "SELECT label FROM " . $database->t_poistatus . " WHERE id=" . $row['poi_status_id'];
                $result1 = $database->execQuery($query1);
                $row1 = mysql_fetch_array($result1);
                echo $row1['label'];
                    ?></label><br/>
            </div>
            <div class="item">
                <select name="status" onchange="javascript:change_status('<?php echo $row['id']; ?>')">
                    <option value="change"> - Change Status - </option>
                    <option value="approved">Approved</option>
                    <option value="rejected">Rejected</option>
                    <option value="pending">Pending</option>
                    <option value="edited">Edited</option>
                    <option value="published">Published</option>
                    <option value="unpublished">Unpublished</option>
                </select>
                <a href="javascript:delete_poi('<?php echo $row['id']; ?>')">Delete</a>
            </div>
            <br/><br/>
        </div>
        <div class="clearboth"></div>
        <div class="content">
            <div class="item">
                <table>
                    <caption><strong>Publishing Time</strong></caption>
                    <tr>
                        <th>NO</th>
                        <th>LABEL</th>
                        <th>START DATE</th>
                        <th>END DATE</th>
                        <th></th>
                        <th></th>
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
                            <td><a href="">Edit</a></td>
                            <td><a href="">Delete</a></td>
                        </tr>
                        <?php
                    }
                    ?>
                </table>
            </div>
            <br/>
            <div class="item">
                <table>
                    <caption><strong>Tagline</strong></caption>
                    <tr>
                        <th>NO</th>
                        <th></th>
                        <th>TEXT</th>
                        <th>START DATE</th>
                        <th>END DATE</th>
                        <th>STATUS</th>
                        <th></th>
                        <th></th>
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
                            <td>
                                <input type="checkbox" name="checklist_tagline" value="<?php echo $row3['id']; ?>" />
                            </td>
                            <td><?php echo $row3['text']; ?></td>
                            <td><?php echo $row3[start_date]; ?></td>
                            <td><?php echo $row3[end_date]; ?></td>
                            <td>
                                <?php
                                $query4 = "SELECT label FROM " . $database->t_taglinestatus . " WHERE id=" . $row3['tagline_status_id'];
                                $result4 = $database->execQuery($query4);
                                while ($row4 = mysql_fetch_array($result4)) {
                                    echo "<div id='status_tagline_".$row3['id']."'>";
                                    echo $row4['label'];
                                    echo "</div>";
                                }
                                ?>
                            </td>
                            <td><a href="">Edit</a></td>
                        </tr>
                        <?php
                    }
                    ?>
                </table>
            </div>
            <div class="item">
                <a href="javascript:check_all('checklist_tagline', true)">Check All</a> / <a href="javascript:check_all('checklist_tagline', false)">Uncheck All</a>
                With Selected : 
                <select name="status_tagline" onchange="javascript:change_status_tagline()">
                    <option value="change"> - Change Status - </option>
                    <option value="approved">Approved</option>
                    <option value="rejected">Rejected</option>
                    <option value="pending">Pending</option>
                    <option value="edited">Edited</option>
                </select>
                <a href="javascript:delete_tagline()">Delete</a>
            </div>
        </div>
        <div class="clearboth"></div>
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
                                    <label>Start Date(YY-MM-DD):</label>
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
                                    <label>End Date(YY-MM-DD):</label>
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
                                    <label>Start Date(YY-MM-DD):</label>
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
                                    <label>End Date(YY-MM-DD):</label>
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
