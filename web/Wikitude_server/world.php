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
  if (isset($value['searchterm']) && isset($value['latitude']) && isset($value['longitude'])) {
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
	} else if (isset($value['searchterm']) && !isset($value['latitude']) && !isset($value['longitude'])) {
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
					   deskripsi
				FROM poilayar_table
				WHERE (attribution like '%:searchterm%' or title like like '%:searchterm%' or line4 like '%:searchterm%' or line3 like '%:searchterm%' or line2 like '%:searchterm%')
				LIMIT 0, :max " );
        } else if (!isset($value['searchterm']) && isset($value['latitude']) && isset($value['longitude'])) {
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
                     		           deskripsi
				FROM poilayar_table
				LIMIT 0, :max " );
        }
	
	
  // PDOStatement::bindParam() binds the named parameter markers to the specified parameter values. 
  if (isset($value['latitude'])) {
      $sql->bindParam( ':lat1', $value['latitude'], PDO::PARAM_STR );
      $sql->bindParam( ':lat2', $value['latitude'], PDO::PARAM_STR );
  }
  if (isset($value['longitude'])) {
      $sql->bindParam( ':long', $value['longitude'], PDO::PARAM_STR );
  }
  $intmaxnumber = (int)$value['maxNumberOfPois'];
  $sql->bindParam( ':max', $intmaxnumber, PDO::PARAM_INT );
  
  $distanceLLA = (int) $radiusSet / 1.112;
  if (isset($value['latitude']) && isset($value['longitude']))
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

//------------------------------------------------------------------------------
//------------------------------------------------------------------------------
 /*
 * CRON JOB
 */
//------------------------------------------------------------------------------
//------------------------------------------------------------------------------
include_once '../connection/databaseHandler.php';
$db = new DatabaseHandler();

/* Pre-define connection to the MySQL database, please specify these fields. */
$dbhost = $db->sqlURL;
$dbdata = $db->sqlDBName;
$dbuser = $db->sqlUsername;
$dbpass = $db->sqlPassword;

$today = mktime(0, 0, 0, date("m"), date("d"), date("Y"));
$yesterday = mktime(0, 0, 0, date("m"), date("d") - 1, date("Y"));

$mysqldatetoday = date('Y-m-d', $today);
$mysqldateyesterday = date('Y-m-d', $yesterday);

$today = strtotime($mysqldatetoday);
$yesterday = strtotime($mysqldateyesterday);

// Cek yang Approved atau UnPublished di POI TABLE
// Kalo approved/unpublished , cek di tabel waktu tayang :
// 1. Kalo start    : 1. Di POI Table, record itu diubah dari Approved jadi Published
//                    2. Insert record itu ke POI_Layar
// 2. Kalo between  : Update semua informasi dari POI_Table ke ke POI Layar dengan POI_id yg bersangkutan
$queryApprovedAndUnpublished = "SELECT * FROM " . $db->t_poi . " WHERE poi_status_id=2 OR poi_status_id=4";
//Eksekusi query:
$resultApprovedAndUnpublished = $db->execQuery($queryApprovedAndUnpublished);

if (is_bool($resultApprovedAndUnpublished)) {
    //echo "Gak ada poi dengan status = 2 atau status = 4 di tabel POI.<br>";
} else {
    while ($rowResultApprovedAndUnpublished = mysql_fetch_array($resultApprovedAndUnpublished, MYSQL_ASSOC)) {
        //Untuk setiap row ini, cek waktu tayang :
        $queryWaktuTayang = "SELECT * FROM " . $db->t_waktutayang . " WHERE poi_id = " . $rowResultApprovedAndUnpublished['id'] . "";
        //Exec Query :
        $resultWaktuTayang = $db->execQuery($queryWaktuTayang);
        while ($rowResultWaktuTayang = mysql_fetch_array($resultWaktuTayang, MYSQL_ASSOC)) {
            //KASUS INI TESTED OK
            if ($mysqldatetoday == $rowResultWaktuTayang['start_date']) {
                //Insert ke POI Layar:
                $queryInsert = "INSERT INTO " . $db->t_poilayar . "(
                                poi_id, userid,
                                attribution, title,
                                lat, lon,
                                imageURL, line4, 
                                line3, line2,
                                type, dimension,
                                alt, relativeAlt,
                                distance, inFocus,
                                doNotIndex, showSmallBiw,
                                showBiwOnClick, kategori,
                                deskripsi
                            ) VALUES (
                                '" . $rowResultApprovedAndUnpublished['id'] . "',
                                '" . $rowResultApprovedAndUnpublished['user_id'] . "',
                                '',
                                '" . $rowResultApprovedAndUnpublished['title'] . "',
                                '" . $rowResultApprovedAndUnpublished['lat'] . "',
                                '" . $rowResultApprovedAndUnpublished['lon'] . "',
                                '" . $rowResultApprovedAndUnpublished['imageURL'] . "',
                                '" . $rowResultApprovedAndUnpublished['email'] . "',
                                '" . $rowResultApprovedAndUnpublished['phone'] . "',
                                '" . $rowResultApprovedAndUnpublished['address'] . "',
                                0, 1,
                                '', '',
                                0.0000000000, 0,
                                0, 1,
                                1,
                                '" . $rowResultApprovedAndUnpublished['kategori'] . "',
                                '" . $rowResultApprovedAndUnpublished['deskripsi'] . "'
                            )";
                //Exec queryInsert :
                $db->execQuery($queryInsert);

                //Update POI_Table row ini statusnya jadi Published (3)
                $queryUpdate = "UPDATE " . $db->t_poi . " SET poi_status_id = 3 WHERE id = " . $rowResultApprovedAndUnpublished['id'] . "";

                //Exec Update :
                $db->execQuery($queryUpdate);
            } else if ($rowResultApprovedAndUnpublished['start_date'] < $mysqldatetoday && $mysqldatetoday < $rowResultApprovedAndUnpublished['end_date']) {
                //between
                //Update semua informasi dari poi_table dengan poi_id yang bersangkutan
                $queryUpdate = "UPDATE " . $db->t_poilayar . " 
                                SET 
                                    attribution     = '',
                                    imageURL        = '" . $rowResultApprovedAndUnpublished['imageURL'] . "',
                                    line4           = '" . $rowResultApprovedAndUnpublished['email'] . "',
                                    line3           = '" . $rowResultApprovedAndUnpublished['phone'] . "',
                                    line2           = '" . $rowResultApprovedAndUnpublished['address'] . "',
                                    kategori        = '" . $rowResultApprovedAndUnpublished['kategori'] . "',
                                    deskripsi       = '" . $rowResultApprovedAndUnpublished['deskripsi'] . "'
                                WHERE 
                                    poi_id = " . $rowResultApprovedAndUnpublished['id'] . "";
                //Exec query :
                $db->execQuery($queryUpdate);
            }
        }
    }
}


// Cek yang Published di  Poi Table
// Kalo Published,  Cek waktu tayang_table
// 1. Kalo end : 1. Delete record dengan poi_id itu di tabel POI_Layar
//               2. Di POI_Table record itu diubah jadi Unpublished
//               3. Delete record di table waktu_tayang dengan poi_id bersangkutan
$queryPublished = "SELECT * FROM " . $db->t_poi . " WHERE poi_status_id=3";

//Eksekusi query : 
$resultPublished = $db->execQuery($queryPublished);
if (is_bool($resultPublished)) {
    //echo "Gak ada poi dengan status = 3 di tabel POI.<br>";
} else { 
    //KASUS INI OK TESTED
    while ($rowResultPublished = mysql_fetch_array($resultPublished, MYSQL_ASSOC)) {
        //Untuk setiap row ini, cek waktu tayang :
        $queryWaktuTayang = "SELECT * FROM " . $db->t_waktutayang . " WHERE poi_id = " . $rowResultPublished['id'] . "";
        //Exec Query :
        $resultWaktuTayang = $db->execQuery($queryWaktuTayang);
        while ($rowResultWaktuTayang = mysql_fetch_array($resultWaktuTayang, MYSQL_ASSOC)) {
            if ($mysqldatetoday >= $rowResultWaktuTayang['end_date']) {
                //Delete dari POI Layar:
                $queryDelete = "DELETE 
                            FROM " . $db->t_poilayar . "
                            WHERE poi_id = " . $rowResultPublished['id'] . "";
                //Exec queryDelete :
                $db->execQuery($queryDelete);

                //Update POI_Table row ini statusnya jadi UnPublished (4)
                $queryUpdate = "UPDATE " . $db->t_poi . " 
                            SET poi_status_id = 4
                            WHERE id = " . $rowResultPublished['id'] . "";

                //Exec Update :
                $db->execQuery($queryUpdate);

                //Delete record di tabel waktu tayang dengan poi_id bersangkutan :
                $queryDeleteWaktuTayang = "DELETE 
                                       FROM " . $db->t_waktutayang . "
                                       WHERE poi_id = " . $rowResultPublished['id'] . "";
                //Exec queryDelete :
                $db->execQuery($queryDeleteWaktuTayang);
            }
        }
    }
}


// Cek yang Rejected di Poi table 
// Kalo rejected, cek waktutayang_table
// 1. Kalo end : delete di 
$queryRejected = "SELECT * FROM " . $db->t_poi . " WHERE poi_status_id=6";

//Eksekusi query :
$resultRejected = $db->execQuery($queryRejected);
if (is_bool($resultRejected)) {
    //echo "Gak ada POI dengan status = 6 di tabel POI";
} else {
    while ($rowResultRejected = mysql_fetch_array($resultRejected, MYSQL_ASSOC)) {
        //Untuk setiap row ini, cek waktu tayang :
        $queryWaktuTayang = "SELECT * FROM " . $db->t_waktutayang . " WHERE poi_id = " . $rowResultRejected['id'] . "";
        //Exec Query :
        $resultWaktuTayang = $db->execQuery($queryWaktuTayang);
        while ($rowResultWaktuTayang = mysql_fetch_array($resultWaktuTayang, MYSQL_ASSOC)) {
            if ($mysqldatetoday == $rowResultWaktuTayang['end_date']) {
                //Delete dari POI Layar:
                $queryDelete = "DELETE 
                            FROM " . $db->t_poilayar . "
                            WHERE poi_id = " . $rowResultRejected['id'] . "";
                //Exec queryDelete :
                $db->execQuery($queryDelete);
            }
        }
    }
}


//SELECT semua data dari tagline yang udah diapprove dan start datenya sama ma hari ini
$querySelectStartDate = "SELECT * FROM " . $db->t_tagline . " WHERE tagline_status_id=2 AND  start_date='" . $mysqldatetoday . "'";
$querySelectEndDate = "SELECT * FROM " . $db->t_tagline . " WHERE tagline_status_id=2 AND  end_date='" . $mysqldateyesterday . "'";
//Exec Query
$resultStart = $db->execQuery($querySelectStartDate);
$resultEnd = $db->execQuery($querySelectEndDate);

//Update StartDate :
while ($rowStart = mysql_fetch_array($resultStart, MYSQL_ASSOC)) {
    $text = $rowStart['text'];
    $poi_id = $rowStart['poi_id'];
    $queryUpdateStart = "UPDATE " . $db->t_poilayar . "
  SET
  attribution='$text'
  WHERE
  poi_id = '$poi_id'";
    $db->execQuery($queryUpdateStart);
}

//Update EndDate :
while ($rowEnd = mysql_fetch_array($resultEnd, MYSQL_ASSOC)) {
    $text = "";
    $poi_id = $rowEnd['poi_id'];
    $queryUpdateStart = "UPDATE " . $db->t_poilayar . "
  SET
  attribution='$text'
  WHERE
  poi_id = '$poi_id'";
    $db->execQuery($queryUpdateStart);
}

//------------------------------------------------------------------------------
//------------------------------------------------------------------------------
/**
 * END OF DAEMON
 */
//------------------------------------------------------------------------------
//------------------------------------------------------------------------------


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
    // set default for maxNumberOfPois
    else if ($key=="maxNumberOfPois") {
      $value["maxNumberOfPois"] = 50;
    }
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
	$arml->setProviderUrl("http://danangtri20.byethost5.com/");
	$arml->setTags("travel, wisata, perjalanan, penginapan, transportasi");
	$arml->setIcon("http://icons-search.com/img/fasticon/Comic_Tiger_LNX_2.zip/Comic_Tiger_LNX_2-Icons-32X32-home.png-32x32.png");
	//$arml->setLogo();
	
	$poilist = Gethotspots($db, $value);
        
        if ( !isset($_GET["json"]) ) {
            // get array of poi
            $arml->addPOIList($poilist);

            // echo the arml to xml string
            echo $arml->__toString();
        } else {
            // output in json
            $poi_array = array();
            $count = 0;
            foreach ($poilist as $poi) :
                $poi_array[$count]['name'] = $poi->getName();
                $poi_array[$count]['description'] = $poi->getDescription();
                $poi_array[$count]['longitude'] = $poi->getLongitude();
                $poi_array[$count]['latitude'] = $poi->getLatitude();
                $poi_array[$count]['altitude'] = $poi->getAltitude();
                $count++;
            endforeach;
            echo json_encode($poi_array);
        }
	
	/* Close the MySQL connection.*/
	
	// Set $db to NULL to close the database connection.
	$db=null;
}
catch( PDOException $e )
    {
    echo $e->getMessage();
    }

?>
			