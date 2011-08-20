<?php
include_once 'connection/sessionHandler.php';
$session = new SessionHandler();
?>
<!--
To change this template, choose Tools | Templates
and open the template in the editor.
-->
<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN">
<body>
    <div class="maincontent">
        <?php
        // put your code here
        include 'layout/general_layout/header.php';

        if ($session->isLoggedIn) {
            include 'layout/home_layout/home_content.php';
        } else {
            include 'layout/home_layout/home_prelog.php';
        }
        include 'layout/general_layout/footer.php';
        ?>
    </div>
</body>
</html>
