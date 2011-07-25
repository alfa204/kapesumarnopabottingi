<?php
include_once '../../../connection/databaseHandler.php';
include_once '../../../connection/sessionHandler.php';
$database = new DatabaseHandler();
$session = new SessionHandler();

$queryDetailUser = "SELECT * FROM " . $database->t_poiuser . " WHERE username='" . $session->username . "'";
$resultDetailUser = $database->execQuery($queryDetailUser);
$row = mysql_fetch_array($resultDetailUser);
$name = $row['name'];
$username = $row['username'];
$email = $row['email'];
$password = $row['password'];
?>

<form action="process/user/setting.php" method="POST">
    <table border="1"> 
        <tr>
            <td> Name : </td>
            <td> <input type="text" name="name" value="<?php echo $name ?>"></td>
        </tr>

        <tr>
            <td> Username : </td>
            <td> <input type="text" name="username"  disabled="disabled"  value="<?php echo $username ?>">  </td>
        </tr>

        <tr>
            <td> Email :</td>
            <td> <input type="text" name="email" value="<?php echo $email ?>">  </td>
        </tr>

        <tr>
            <td> Password :</td>
            <td> <input type="password" name="password" value="<?php echo $password ?>">  </td>
        </tr>

        <tr>
            <td> Retype Password :</td>
            <td> <input type="password" name="repassword" value="<?php echo $password ?>">  </td>
        </tr>

        <tr>
            <td></td>
            <td> <input type="submit" value="Edit Profile!">  </td>
        </tr>
    </table>

</form>