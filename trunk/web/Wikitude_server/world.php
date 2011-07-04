<?php 

include("lib/IPOI.php");
include("lib/POI.php");
include("lib/Attachment.php");
include("lib/Arml.php");

/*** Custom functions ***/


// Convert a decimal GPS latitude or longitude value to an integer by multiplying by 1000000.
// 
// Arguments:
//   value_Dec ; The decimal latitude or longitude GPS value.
//
// Returns:
//   int ; The integer value of the latitude or longitude.
//
function ChangetoIntLoc( $value_Dec ) {

  return $value_Dec * 1000000;
  
}//ChangetoIntLoc

// Change a string value to integer. 
//
// Arguments:
//   string ; A string value.
// 
// Returns:
//   Int ; If the string is empty, return NULL.
//
function ChangetoInt( $string ) {

  if ( strlen( trim( $string ) ) != 0 ) {
  
    return (int)$string;
  }
  else 
  	return NULL;
}//ChangetoInt

// Change a string value to float
//
// Arguments:
//   string ; A string value.
// 
// Returns:
//   float ; If the string is empty, return NULL.
//
function ChangetoFloat( $string ) {

  if ( strlen( trim( $string ) ) != 0 ) {
  
    return (float)$string;
  }
  else 
  	return NULL;
}//ChangetoFloat

//Convert a TinyInt value to a boolean value TRUE or FALSE
//
// Arguments: 
//   value_Tinyint ; The Tinyint value (0 or 1) of a key in the database. 
//
// Returns:
//	 value_Bool ; The boolean value, return 'TRUE' when Tinyint is 1. Return 'FALSE' when Tinyint is 0.
//
function ChangetoBool( $value_Tinyint ) {

  if ( strlen( trim( $value_Tinyint ) ) != 0 ) {
  
    if ( $value_Tinyint == 1 )
  	  $value_Bool = TRUE;
  	else 
  	  $value_Bool = FALSE;
   
  	return $value_Bool;
  }
  else 
  	return NULL;
  
}//ChangetoBool


function GetCheckboxValue ( $checkboxlist ) {

  // if $checkboxlist exists, prepare checkbox_value. 	
  if( isset( $checkboxlist ) ) {
  
    // Initialize returned value to be 0 if $checkboxlist is empty. 
	$checkbox_value = 0;
	
	// If $checkboxlist is not empty, return the added value of all the numbers splited by ','.
	if (!empty($checkboxlist)) {
	
		if ( strstr($checkboxlist,',') ) {
		
			$checkbox_array = explode(',', $checkboxlist);
			
			for( $i=0; $i<count($checkbox_array); $i++ )
				$checkbox_value+=$checkbox_array[$i]; 
				
		}//if
		else 
			$checkbox_value = $checkboxlist;
	}//if
	
	return $checkbox_value;
  } //if
  else {
    throw new Exception("checkboxlist parameter is not passed in GetPOI request.");
  }//else

}//GetCheckboxValue

// fungsi untuk mengambil details dari suatu poi
// keluaran dalam bentuk array dari phone, email, url, dan attachment
function GetInfoDetails($poiID, $db) {
	$sql_actions = $db->prepare( " SELECT label, 
  										uri
    						   	 FROM action_table
    						     WHERE poiID = :id " ); 
								 
	// Binds the named parameter markers ":id" to the specified parameter values "$poi['id']".							   
  $sql_actions->bindParam( ':id', $poiID, PDO::PARAM_INT );
    
  // Use PDO::execute() to execute the prepared statement $sql_actions. 
  $sql_actions->execute();
  
  // Iterator for the $poi["actions"] array.
  $count = 0; 
    
  // Fetch all the poi actions. 
  $actions = $sql_actions->fetchAll( PDO::FETCH_ASSOC );
  /* Process the $actions result */
  
  // if $actions array is empty, return empty array. 
  if ( empty( $actions ) ) {
  	$array_info["phone"]="";
  	$array_info["url"]="";
  	$array_info["email"]="";
  	$array_info["attachment"]="";
  }//if 
  else {
	// Put each action information into $poi["actions"] array.
  	foreach ( $actions as $action ) {
			if (strcmp($action["label"], "Call")==0) {
				// action call
				// add tel to uri
				$array_info["phone"] = $action["uri"];
		  } else if (strcmp($action["label"], "Email")==0) {
				// action email
				// add mailto to uri
				$array_info["email"] = $action["uri"];
		  } else if (strcmp($action["label"], "Contact")==0) {
				// action contact
				// add poiID to uri
				$array_info["url"] = $action["uri"];
		  } else if (strcmp($action["label"], "Audio")==0) {
				// action audio
				// add poiID to uri
				$attach = new PowerHour_Wikitude_Attachment($action["uri"]);
				$array_info["attachment"] = $attach;
		  } else if (strcmp($action["label"], "Video")==0) {
				// action video
				// add poiID to uri
				$attach = new PowerHour_Wikitude_Attachment($action["uri"]);
				$array_info["attachment"] = $attach;
		  }
			$count++;	  
	}
  }
  return $array_info;
}

function GetThumbnail($db, $poiID) {
	$sql_actions = $db->prepare( " SELECT baseURL, 
  										icon_wiki
    						   	 FROM object_table
    						     WHERE poiID = :id " ); 
								 
	// Binds the named parameter markers ":id" to the specified parameter values "$poi['id']".							   
  $sql_actions->bindParam( ':id', $poiID, PDO::PARAM_INT );
    
  // Use PDO::execute() to execute the prepared statement $sql_actions. 
  $sql_actions->execute();
  
  // Iterator for the $poi["actions"] array.
  $count = 0; 
    
  // Fetch all the poi actions. 
  $actions = $sql_actions->fetchAll( PDO::FETCH_ASSOC );
  /* Process the $actions result */
   // if $actions array is empty, return empty array. 
  if ( empty( $actions ) ) {
  	$thumbnail = array();
  }//if 
  else {
  	foreach ( $actions as $action ) {
		$thumbnail = $action["baseURL"].$action["icon_wiki"];
	}
  }
  return $thumbnail;
}


// Put received POIs into an associative array.
//
// Arguments:
//   db ; The handler of the database.
//   value ; An array which contains all the needed parameters retrieved from GetPOI request. 
//
// Returns:
//   array ; An array of received POIs.
//
function Gethotspots( $db, $value ) {

/* Create the SQL query to retrieve POIs within the "radius" returned from GetPOI request. 
       Returned POIs are sorted by distance and the first 50 POIs are selected. 
	   The distance is caculated based on the Haversine formula. 
	   Note: this way of calculation is not scalable for querying large database.
*/
	$radiusSet = "15000"; //REQUIRED - retrieve POIs (Points of Interests) from database within this search radius in meters from the current location of the Wikitude user
	
  // Use PDO::prepare() to prepare SQL statement. 
  // This statement is used due to security reasons and will help prevent general SQL injection attacks.
  // ":lat1", ":lat2", ":long" and ":radius" are named parameter markers for which real values 
  // will be substituted when the statement is executed. 
  // $sql is returned as a PDO statement object. 
  if (!isset($value['searchterm'])) {
	  $sql = $db->prepare( "
				SELECT id,
					   attribution, 
					   title, 
					   lat,
					   lon,
					   imageURL,
					   line4, 
					   line3,
					   line2,
					   type,
					   dimension,
					   (((acos(sin((:lat1 * pi() / 180)) * sin((lat * pi() / 180)) +
						   cos((:lat2 * pi() / 180)) * cos((lat * pi() / 180)) * 
						   cos((:long  - lon) * pi() / 180))
						  ) * 180 / pi()) * 60 * 1.1515 * 1.609344 * 1000) as distance,
				deskripsi
				FROM poilayar_table
				HAVING distance < :radius
				ORDER BY distance ASC
				LIMIT 0, :max " );
	} else {
		$sql = $db->prepare( "
				SELECT id,
					   attribution, 
					   title, 
					   lat,
					   lon,
					   imageURL,
					   line4, 
					   line3,
					   line2,
					   type,
					   dimension,
					   (((acos(sin((:lat1 * pi() / 180)) * sin((lat * pi() / 180)) +
						   cos((:lat2 * pi() / 180)) * cos((lat * pi() / 180)) * 
						   cos((:long  - lon) * pi() / 180))
						  ) * 180 / pi()) * 60 * 1.1515 * 1.609344 * 1000) as distance,
						deskripsi
				FROM poilayar_table
				WHERE (attribution like '%:searchterm%' or title like like '%:searchterm%' or line4 like '%:searchterm%' or line3 like '%:searchterm%' or line2 like '%:searchterm%')
				HAVING distance < :radius
				ORDER BY distance ASC
				LIMIT 0, :max " );
	}
	
	
  // PDOStatement::bindParam() binds the named parameter markers to the specified parameter values. 
  $sql->bindParam( ':lat1', $value['latitude'], PDO::PARAM_STR );
  $sql->bindParam( ':lat2', $value['latitude'], PDO::PARAM_STR );
  $sql->bindParam( ':long', $value['longitude'], PDO::PARAM_STR );
  $intmaxnumber = (int)$value['maxNumberOfPois'];
  $sql->bindParam( ':max', $intmaxnumber, PDO::PARAM_INT );
  $distanceLLA = (int) $radiusSet / 1.112;
  $sql->bindParam( ':radius', $distanceLLA, PDO::PARAM_INT );
  if (isset($value['searchterm']))
	$sql->bindParam( ':searchterm', $value['searchterm'], PDO::PARAM_STR );
	
  // Use PDO::execute() to execute the prepared statement $sql. 
  $sql->execute();
	
  // Iterator for the response array.
  $i = 0; 
  
  // Use fetchAll to return an array containing all of the remaining rows in the result set.
  // Use PDO::FETCH_ASSOC to fetch $sql query results and return each row as an array indexed by column name.
  $pois = $sql->fetchAll(PDO::FETCH_ASSOC);
 
  /* Process the $pois result */
  
  // if $pois array is empty, return empty array. 
  if ( empty($pois) ) {
  	
  	$response["hotspots"] = array ();
	echo "empty";
  }//if 
  else { 
  	
  	// Put each POI information into $response["hotspots"] array.
 	foreach ( $pois as $poi ) {
		$poi_obj = new PowerHour_Wikitude_POI("testinglayer-sp-kape.com",$poi["title"]);
		$poi_obj->setId($poi["id"]);
		$poi_obj->setDescription($poi["deskripsi"].$poi["attribution"]);
		$poi_obj->setThumbnail(GetThumbnail($db, $poi["id"]));
		$poi_obj->setThumbnail(null);
		$array_info = GetInfoDetails($poi["id"], $db);
		$poi_obj->setPhone($array_info["phone"]);
		$poi_obj->setUrl($array_info["url"]);
		$poi_obj->setEmail($array_info["email"]);
		$poi_obj->setAddress($poi["line2"].$poi["line3"]);
		if ($array_info["attachment"]!=null)
			$poi_obj->setAttachment($array_info["attachment"]);
		$poi_obj->setLongitude($poi["lon"]);
		$poi_obj->setLatitude($poi["lat"]);
		
    	$response["hotspots"][$i] = $poi_obj;
    	$i++;
  	}//foreach
  
  }//else
  
  return $response["hotspots"];
}//Gethotspots



/*** Main entry point ***/


/* Pre-define connection to the MySQL database, please specify these fields.*/
$dbhost = 'box9.host1free.com';
$dbdata = 'testin75_POIDB';
$dbuser = 'testin75_root';
$dbpass = 'root123';

/* Put parameters from GetPOI request into an associative array named $value */

// Put needed parameter names from GetPOI request in an array called $keys. 
$keys = array( "latitude", "longitude", "maxNumberOfPois", "searchterm" );

// Initialize an empty associative array.
$value = array(); 

try {
  // Retrieve parameter values using $_GET and put them in $value array with parameter name as key. 
  foreach( $keys as $key ) {
    if ( isset($_GET[$key]) )
      $value[$key] = $_GET[$key]; 
    // else 
      // throw new Exception($key ." parameter is not passed in GetPOI request.");
  }
}
catch(Exception $e) {
  echo 'Message: ' .$e->getMessage();
}
 
 
try {
	/* Connect to MySQL server. We use PDO which is a PHP extension to formalise database connection.
	   For more information regarding PDO, please see http://php.net/manual/en/book.pdo.php. 
	*/
	
	// Connect to predefined MySQl database.  
	$db = new PDO( "mysql:host=$dbhost; dbname=$dbdata", $dbuser, $dbpass, array(PDO::MYSQL_ATTR_INIT_COMMAND =>  "SET NAMES utf8") );
	
	// set the error reporting attribute to Exception.
	$db->setAttribute( PDO::ATTR_ERRMODE , PDO::ERRMODE_EXCEPTION );
	
	/* Construct the response into an associative array.*/
	
	// Create an empty array named response.
	$response = array();
	
	// Create object Arml
	$arml = new PowerHour_Wikitude_Arml("testinglayer-sp-kape.com", "Tempat Wisata dan Akomodasi di Indonesia");
	$arml->setDescription("Cari tempat wisata di Indonesia yang dekat dengan posisi Anda.");
	$arml->setProviderUrl("http://testinglayer.sx33.net/");
	$arml->setTags("travel, wisata, perjalanan, penginapan, transportasi");
	//$arml->setIcon();
	//$arml->setLogo();
	
	// get array of poi
	$arml->addPOIList(Gethotspots($db, $value));
	
	// echo the arml to xml string
	echo $arml->__toString();
	
	/* Close the MySQL connection.*/
	
	// Set $db to NULL to close the database connection.
	$db=null;
}
catch( PDOException $e )
    {
    echo $e->getMessage();
    }

?>
