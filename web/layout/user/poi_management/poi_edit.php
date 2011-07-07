<?php
include_once '../../../connection/databaseHandler.php';
include_once '../../../connection/sessionHandler.php';
$database = new DatabaseHandler();
$session = new SessionHandler();

$poiname = $_GET['poiname'];
$query = "SELECT * FROM " . $database->t_poi . " WHERE title='" . $poiname . "'";
$result = $database->execQuery($query);
$row = mysql_fetch_array($result);
?>
<div class="content">
    <form action="process/user/editpoi.php?poiname=<?php echo $poiname; ?>" method="POST">
        <table>
            <tr>
                <td>
                    <div class="item">
                        <label>Title :</label>
                    </div>
                </td>
                <td>
                    <div class="item">
                        <label><?php echo $row['title']; ?></label>
                    </div>
                </td>
            </tr>
            <tr>
                <td>
                    <div class="item">
                        <label>Latitude :</label>
                    </div>
                </td>
                <td>
                    <div class="item">
                        <label><?php echo $row['lat']; ?></label>
                    </div>
                </td>
            </tr>
            <tr>
                <td>
                    <div class="item">
                        <label>Longitude :</label>
                    </div>
                </td>
                <td>
                    <div class="item">
                        <label><?php echo $row['lon']; ?></label>
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
                        <input type="text" id="address" name="address" value="<?php echo $row['address']; ?>"/>
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
                        <input type="text" id="phone" name="phone" value="<?php echo $row['phone']; ?>"/>
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
                        <input type="text" id="email" name="email" value="<?php echo $row['email']; ?>"/>
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
                            <option value="1" <?php
if ($row['kategori'] == '1') {
    echo "SELECTED";
}
?>
                                    >Wisata</option>
                            <option value="2" <?php
if ($row['kategori'] == '2') {
    echo "SELECTED";
}
?>
                                    >Penginapan</option>
                        </select>
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
                        <textarea cols="16" rows="3" id="deskripsi" name="deskripsi"><?php echo $row['deskripsi']; ?></textarea>
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
                        <input type="file" id="imageurl" name="imageurl" value="<?php $row['imageURL']; ?>">
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
                        <input type="file" id="imagefull" name="imagefull" value="<?php $row['image_full']; ?>">
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
                        <input type="file" id="imagereduced" name="imagereduced" value="<?php $row['image_reduced']; ?>">
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
                        <input type="file" id="imageicon" name="imageicon" value="<?php $row['image_icon']; ?>">
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
                        <input type="file" id="imagewiki" name="imagewiki" value="<?php $row['image_wiki']; ?>">
                    </div>
                </td>
            </tr>
            <tr>
                <td></td>
                <td>
                    <div class="item">
                        <input type="submit" value="SUBMIT"/>
                    </div>
                </td>
            </tr>
        </table>
    </form>
</div>