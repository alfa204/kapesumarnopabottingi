<?php
    include_once '../connection/databaseHandler.php';
    include_once '../connection/sessionHandler.php';
    $database = new DatabaseHandler();
    $session = new SessionHandler();

    // mendapat password dan username
    $username=$_POST['username'];
    $password=$_POST['password'];

    // menghilangkan kemungkinan SQL Injection
    $username = stripslashes($username);
    $password = stripslashes($password);
    $username = mysql_real_escape_string($username);
    $password = mysql_real_escape_string($password);

    $query="SELECT * FROM ".$database->t_poiuser." WHERE username='".$username."' and password='".$password."'";
    $result = $database->execQuery($query);
    $count = mysql_num_rows($result);

    if($count==1){
        // Login OK
        $result = mysql_fetch_array($result);
        $session->setSession($result);
        header("location:../index.php?ref=loginSuccess");
    }
    else {
        // kalo salah disini handlernya
        header("location:../index.php?ref=loginFailed");
    }
 ?>
