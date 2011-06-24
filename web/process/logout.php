<?php
    include_once '../connection/databaseHandler.php';
    include_once '../connection/sessionHandler.php';
    $database = new DatabaseHandler();
    $session = new SessionHandler();

    $session->destroySession();
    header("location:../index.php");
?>
