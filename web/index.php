<?php
    include_once 'connection/sessionHandler.php';

    $session = new SessionHandler();
?>
<!--
To change this template, choose Tools | Templates
and open the template in the editor.
-->
<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN">
<html>
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
        <link rel="stylesheet" href="css/style.css" type="text/css" />
        <title></title>
    </head>
    <body>
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
    </body>
</html>
