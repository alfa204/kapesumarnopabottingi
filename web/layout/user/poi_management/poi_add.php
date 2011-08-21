<div class="content" style="padding-left: 10px; border-style: solid">
    <button onclick="loadmap()">Load Map</button>
    <div class="item">
        <label style="font-weight: bolder">CREATE NEW POI</label>
    </div>
    <div class="item">
        <label>(*) means required</label>
    </div>
    <form action="process/user/addpoi.php" method="POST">
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
                        <textarea id="deskripsi" name="deskripsi" cols="20" rows="5"></textarea>
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
                        <label>Location (*) :</label>
                    </div>
                </td>
                <td>
                    <div class="item">
                        Select location on the map
                        <div id="map_canvas" style="border-style: groove">
                            Press "Load Map" Button Above
                        </div>
                        or input directly the location coordinate (latitude-longitude)
                        <br/>
                        <input type="text" id="lat" name="lat">
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