<?php 
// show the details of poi
// details return as string plain text
	if ( isset($_GET["poiID"]) )
      $poiID = $_GET["poiID"]; 
    else 
      throw new Exception("poiID parameter is not passed in GetPOI request.");
/* Pre-define connection to the MySQL database, please specify these fields.*/
$dbhost = 'box9.host1free.com';
$dbdata = 'testin75_POIDB';
$dbuser = 'testin75_root';
$dbpass = 'root123';

	/* Connect to MySQL server. We use PDO which is a PHP extension to formalise database connection.
	   For more information regarding PDO, please see http://php.net/manual/en/book.pdo.php. 
	*/
	
	// Connect to predefined MySQl database.  
	$db = new PDO( "mysql:host=$dbhost; dbname=$dbdata", $dbuser, $dbpass, array(PDO::MYSQL_ATTR_INIT_COMMAND =>  "SET NAMES utf8") );
	
	// set the error reporting attribute to Exception.
	$db->setAttribute( PDO::ATTR_ERRMODE , PDO::ERRMODE_EXCEPTION );
	
	// Use PDO::prepare() to prepare SQL statement. 
  // This statement is used due to security reasons and will help prevent general SQL injection attacks.
  // will be substituted when the statement is executed. 
  // $sql is returned as a PDO statement object. 
  $sql_actions = $db->prepare( "
  			SELECT deskripsi
    		FROM poi_table
			WHERE poi_table.id=:poiID" );
	// Binds the named parameter markers ":id" to the specified parameter values "$poiID".							   
  $sql_actions->bindParam( ':poiID', $poiID, PDO::PARAM_INT );
  
  // Use PDO::execute() to execute the prepared statement $sql_actions. 
  $sql_actions->execute();
  
  // Iterator for the $details array.
  $count = 0; 
    
  // Fetch all the poi actions. 
  $details = $sql_actions->fetchAll( PDO::FETCH_ASSOC );
  
  /* Process the $details result */
  
  // if $details array is empty, return empty array. 
  if ( empty( $details ) ) {
	echo "No details.";
  }//if 
  else {
	// Put each details information to echo.
  	foreach ( $details as $detail ) {
		echo $detail["deskripsi"];
	}
  }

?>