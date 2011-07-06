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
            $query1 = "SELECT id FROM " . $database->t_poiuser . " WHERE name='" . $session->name . "'";
            $result1 = $database->execQuery($query1);
            $row = mysql_fetch_array($result1);
            $query2 = "SELECT title FROM " . $database->t_poi . " WHERE user_id=" . $row['id'];
            //$query2 = "SELECT * FROM " . $database->t_poi . " WHERE user_id=3";
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
            }
            ?>
        </table>
    </div>
    <div class="content" style="width: 450px; padding-left: 10px; border-style: solid">
        <div class="item">
            <label style="font-weight: bolder">CREATE NEW POI</label>
        </div>
        <div class="item">
            <label>(*) means required</label>
        </div>
        <form action="process/user_addpoi.php" method="POST">
            <table>
                <tr>
                    <td>
                        <div class="item">
                            <label>Title (*) :</label>
                        </div>
                    </td>
                    <td>
                        <div class="item">
                            <input type="text" id="title" name="title">
                        </div>
                    </td>
                </tr>
                <tr>
                    <td>
                        <div class="item">
                            <label>Description :</label>
                        </div>
                    </td>
                    <td>
                        <div class="item">
                            <textarea id="deskripsi" name="deskripsi" cols="16" rows="3"></textarea>
                        </div>
                    </td>
                </tr>
                <tr>
                    <td>
                        <div class="item">
                            <label>Category :</label>
                        </div>
                    </td>
                    <td>
                        <div class="item">
                            <select id="kategori" name="kategori">
                                <option value="1">Wisata</option>
                                <option value="2">Penginapan</option>
                            </select>
                        </div>
                    </td>
                </tr>
                <tr>
                    <td>
                        <div class="item">
                            <label>Latitude (*) :</label>
                        </div>
                    </td>
                    <td>
                        <div class="item">
                            <input type="text" id="lat" name="lat">
                        </div>
                    </td>
                </tr>
                <tr>
                    <td>
                        <div class="item">
                            <label>Longitude (*) :</label>
                        </div>
                    </td>
                    <td>
                        <div class="item">
                            <input type="text" id="lon" name="lon">
                        </div>
                    </td>
                </tr>
                <tr>
                    <td>
                        <div class="item">
                            <label>Address :</label>
                        </div>
                    </td>
                    <td>
                        <div class="item">
                            <input type="text" id="address" name="address">
                        </div>
                    </td>
                </tr>
                <tr>
                    <td>
                        <div class="item">
                            <label>Phone :</label>
                        </div>
                    </td>
                    <td>
                        <div class="item">
                            <input type="text" id="phone" name="phone">
                        </div>
                    </td>
                </tr>
                <tr>
                    <td>
                        <div class="item">
                            <label>Email :</label>
                        </div>
                    </td>
                    <td>
                        <div class="item">
                            <input type="text" id="email" name="email">
                        </div>
                    </td>
                </tr>
                <tr>
                    <td>
                        <div class="item">
                            <label>Image URL :</label>
                        </div>
                    </td>
                    <td>
                        <div class="item">
                            <input type="file" id="imageurl" name="imageurl">
                        </div>
                    </td>
                </tr>
                <tr>
                    <td>
                        <div class="item">
                            <label>Image Full (256x256) (*) :</label>
                        </div>
                    </td>
                    <td>
                        <div class="item">
                            <input type="file" id="imagefull" name="imagefull">
                        </div>
                    </td>
                </tr>
                <tr>
                    <td>
                        <div class="item">
                            <label>Image Reduced (128x128) :</label>
                        </div>
                    </td>
                    <td>
                        <div class="item">
                            <input type="file" id="imagereduced" name="imagereduced">
                        </div>
                    </td>
                </tr>
                <tr>
                    <td>
                        <div class="item">
                            <label>Image Icon (32x32) :</label>
                        </div>
                    </td>
                    <td>
                        <div class="item">
                            <input type="file" id="imageicon" name="imageicon">
                        </div>
                    </td>
                </tr>
                <tr>
                    <td>
                        <div class="item">
                            <label>Image Wiki (64x64) :</label>
                        </div>
                    </td>
                    <td>
                        <div class="item">
                            <input type="file" id="imagewiki" name="imagewiki">
                        </div>
                    </td>
                </tr>
                <tr>
                    <td style="border-style: solid" colspan="2">
                        <table>
                            <caption>POI Publishing Time</caption>
                            <tr>
                                <td>
                                    <div class="item">
                                        <label>Label (*) :</label>
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
                                        <label>Publishing Date (Start) (*) :</label>
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
                                        <label>Publishing Date (End) (*) :</label>
                                    </div>
                                </td>
                                <td>
                                    <div class="item">
                                        <input type="text" id="end" name="end">
                                    </div>
                                </td>
                            </tr>
                        </table>
                    </td>
                </tr>
                <tr>
                    <td></td>
                    <td>
                        <div class="item">
                            <input type="submit" value="Create POI">
                        </div>
                    </td>
                </tr>
            </table>
        </form>
    </div>
</div>