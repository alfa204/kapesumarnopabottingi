<?php
    include_once "connection/sessionHandler.php";
    $session = new SessionHandler();
?>



<!--
To change this template, choose Tools | Templates
and open the template in the editor.
-->
<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN">
<div class="container">
    <div class="content" style="width: 865px;">
        <div class="content">
            <button onclick="buttonOnClick('layout/general_layout/homecontent_layout.php','ajax_wrapper')">HOME</button>
        </div>
        <div class="content">
            <button onclick="buttonOnClick('layout/general_layout/product_layout.php','ajax_wrapper')">PRODUK</button>
        </div>
        <div class="content">
            <button onclick="buttonOnClick('layout/general_layout/about_layout.php','ajax_wrapper')">ABOUT</button>
        </div>
        <div class="content">
            <button onclick="buttonOnClick('layout/general_layout/contact_layout.php','ajax_wrapper')">KONTAK</button>
        </div>
        <div class="content">
            <?php
                if ($session->statusAdmin==0) { //user
                    echo "<button onclick=".'"buttonOnClick'."('layout/user/poi_management/poi_management_layout.php','ajax_wrapper')".'"'.">POI MANAGEMENT</button>";
                } else { //admin
                    echo "<button onclick=".'"buttonOnClick'."('layout/admin/poi_management/poi_management_layout.php','ajax_wrapper')".'"'.">POI MANAGEMENT</button>";
                }
            ?>
        </div>
        <div class="content">
             <?php
                if ($session->statusAdmin==0) { //user
                    echo "<button onclick=".'"buttonOnClick'."('layout/user/user_management/user_management_layout.php','ajax_wrapper')".'"'.">SETTING</button>";
                } else { //admin
                    echo "<button onclick=".'"buttonOnClick'."('layout/admin/user_management/user_management_layout.php','ajax_wrapper')".'"'.">USER MANAGEMENT</button>";
                }
            ?>
        </div>
        <div class="content">
            <form action="process/logout.php" method="POST">
                <button>LOGOUT</button>
            </form>
        </div>
    </div>
    <div class="content" style="width: 865px">
        <div id="ajax_wrapper">
            
        </div>
    </div>
    <div class="clearboth"></div>
</div>
