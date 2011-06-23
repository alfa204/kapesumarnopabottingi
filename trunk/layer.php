<?php
// Created by Xuan Wang
// Layar Technical Support
// Email: xuan@layar.com
// Website: http://layar.com


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


// Put received POIs into an associative array. The returned values are assigned to $reponse["hotspots"].
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
	
  // Use PDO::prepare() to prepare SQL statement. 
  // This statement is used due to security reasons and will help prevent general SQL injection attacks.
  // ":lat1", ":lat2", ":long" and ":radius" are named parameter markers for which real values 
  // will be substituted when the statement is executed. 
  // $sql is returned as a PDO statement object. 
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
                      ) * 180 / pi()) * 60 * 1.1515 * 1.609344 * 1000) as distance
    		FROM POI_Table
			WHERE ( Checkbox & :checkbox )!=0
    		HAVING distance < :radius
    		ORDER BY distance ASC
    		LIMIT 0, 50 " );

  // PDOStatement::bindParam() binds the named parameter markers to the specified parameter values. 
  $sql->bindParam( ':lat1', $value['lat'], PDO::PARAM_STR );
  $sql->bindParam( ':lat2', $value['lat'], PDO::PARAM_STR );
  $sql->bindParam( ':long', $value['lon'], PDO::PARAM_STR );
  $sql->bindParam( ':radius', $value['radius'], PDO::PARAM_INT );
  
  // Custom filter settings parameters. The four Get functions can be customized. 
  $sql->bindParam( ':checkbox', GetCheckboxValue ( $value['CHECKBOXLIST'] ), PDO::PARAM_INT );
	
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
		
		// Use function Getactions() to return an array of actions asscociated with the current POI.
        $poi["actions"] = Getactions ( $poi, $db );
        
       // If POI "dimension" =2 or 3, use function Getobject() to return an object associated with the current POI. 
      	if ($poi["dimension"] == '2' || $poi["dimension"] == '3')
      		$poi["object"] = Getobject ( $poi, $db); 
      
      // If POI "dimension" =2 or 3, use function Gettransform() to return a transform dictionary associated with the current POI. 
      	if ($poi["dimension"] == '2' || $poi["dimension"] == '3')
      		$poi["transform"] = Gettransform ( $poi, $db);
      
    	// Store the integer value of "lat" and "lon" using predefined function ChangetoIntLoc.
    	$poi["lat"] = ChangetoIntLoc( $poi["lat"] );
    	$poi["lon"] = ChangetoIntLoc( $poi["lon"] );
    
   	 	// Change to Int with function ChangetoInt.
    	$poi["type"] = ChangetoInt( $poi["type"] );
    	$poi["dimension"] = ChangetoInt( $poi["dimension"] );
    
    	// Change to demical value with function ChangetoFloat
    	$poi["distance"] = ChangetoFloat( $poi["distance"] );
	
    	// Put the poi into the response array.
    	$response["hotspots"][$i] = $poi;
    	$i++;
  	}//foreach
  
  }//else
  
  return $response["hotspots"];
}//Gethotspots

// Put fetched actions for each POI into an associative array. The returned values are assigned to $poi[actions].
//
// Arguments:
//   poi ; The POI handler.
//   $db ; The database connection handler. 
//
// Returns:
//   array ; An array of received actions for this POI.
// 
function Getactions( $poi, $db ) {
  
  // A new table called "ACTION_Table" is created to store actions, each action has a field called
  // "poiID" which shows the POI id that this action belongs to. 
  // The SQL statement returns actions which have the same poiID as the id of $poi ($poi['id']).
  $sql_actions = $db->prepare( " SELECT label, 
  										uri, 
  										autoTriggerRange,
  										autoTriggerOnly,
  										contentType,
  										method,
  										activityType,
  										params,
  										closeBiw,
  										showActivity,
  										activityMessage
    						   	 FROM ACTION_Table
    						     WHERE poiID = :id " ); 
    						     
  // Binds the named parameter markers ":id" to the specified parameter values "$poi['id']".							   
  $sql_actions->bindParam( ':id', $poi['id'], PDO::PARAM_INT );
    
  // Use PDO::execute() to execute the prepared statement $sql_actions. 
  $sql_actions->execute();
  
  // Iterator for the $poi["actions"] array.
  $count = 0; 
    
  // Fetch all the poi actions. 
  $actions = $sql_actions->fetchAll( PDO::FETCH_ASSOC );
  
  /* Process the $actions result */
  
  // if $actions array is empty, return empty array. 
  if ( empty( $actions ) ) {
  
  	$poi["actions"] = array();
  	
  }//if 
  else {
  	
  	// Put each action information into $poi["actions"] array.
  	foreach ( $actions as $action ) {
  	  
  	  // Assign each action to $poi["actions"] array. 
  	  $poi["actions"][$count] = $action;
      
      // put 'params' into an array of strings
      $paramsArray = array();
      if (substr_count($action['params'],',')) {
      	$paramsArray = explode(",", $action['params']);
      }//if
      else if(strlen($action['params'])) {
      	$paramsArray[0] = $action['params'];
      } 
      $poi["actions"][$count]['params'] = $paramsArray;
      
      // Change 'activityType' to Integer.
      $poi["actions"][$count]['activityType'] = ChangetoInt( $poi["actions"][$count]['activityType'] );
      
      // Change the values of "closeBiw" into boolean value.
      $poi["actions"][$count]['closeBiw'] = ChangetoBool( $poi["actions"][$count]['closeBiw'] );
      
      // Change the values of "showActivity" into boolean value.
      $poi["actions"][$count]['showActivity'] = ChangetoBool( $poi["actions"][$count]['showActivity'] ); 
      
      // Change 'autoTriggerRange' to Integer.
      $poi["actions"][$count]['autoTriggerRange'] = ChangetoInt( $poi["actions"][$count]['autoTriggerRange'] );
      
	  // Change the values of "autoTriggerOnly" into boolean value,if the value is NULL, return NULL.
	  $poi["actions"][$count]['autoTriggerOnly'] = ChangetoBool( $poi["actions"][$count]['autoTriggerOnly'] );
	  
      $count++; 
    	
    }// foreach
   
   }//else
   
   return $poi["actions"];

}//Getactions

// Put fetched object related parameters for each POI into an associative array. The returned values are assigned to $poi[object].
//
// Arguments:
//   poi ; The POI handler.
//   $db ; The database connection handler. 
//
// Returns:
//   array ; An array of received object related parameters for this POI.
// 
function Getobject( $poi, $db ) {
  
  // A new table called "OBJECT_Table" is created to store object related parameters, namely "baseURL", "full", "reduced", "icon" and "size". 
  // "poiID" which shows the POI id that this object belongs to. 
  // The SQL statement returns object which has the same poiID as the id of $poi ($poi['id']).
  $sql_object = $db->prepare( " SELECT baseURL, full, reduced, icon, size 
    						   	 FROM OBJECT_Table
    						     WHERE poiID = :id 
    						     LIMIT 0,1 " ); 
    						     
  // Binds the named parameter markers ":id" to the specified parameter values "$poi['id']".							   
  $sql_object->bindParam( ':id', $poi['id'], PDO::PARAM_INT );
    
  // Use PDO::execute() to execute the prepared statement $sql_object. 
  $sql_object->execute();
    
  // Fetch the poi object. 
  $object = $sql_object->fetchAll( PDO::FETCH_ASSOC );
  
  /* Process the $object result */
  
  // if $object array is empty, return NULL. 
  if ( empty( $object ) ) {
  
  	$poi["object"] = null;
  	
  }//if 
  else {
  	// Since each POI only has one object. Logically, only one object should be returned. Assign the first object in the array to $poi["object"]
    $poi["object"] = $object[0];
    
    // Change "size" type to float. 
    $poi["object"]["size"] = ChangetoFloat( $poi["object"]["size"] );
    
   }//else
   
   return $poi["object"];

}//Getobject


// Put fetched transform related parameters for each POI into an associative array. The returned values are assigned to $poi[transform].
//
// Arguments:
//   poi ; The POI handler.
//   $db ; The database connection handler. 
//
// Returns:
//   array ; An array of received transform related parameters for this POI.
// 
function Gettransform( $poi, $db ) {
  
  // A new table called "TRANSFORM_Table" is created to store transform related parameters, namely "rel", "angle" and "scale"
  // "poiID" which shows the POI id that this transform belongs to. 
  // The SQL statement returns transform which has the same poiID as the id of $poi ($poi['id']).
  $sql_transform = $db->prepare( " SELECT rel, angle, scale
    						   	 FROM TRANSFORM_Table
    						     WHERE poiID = :id 
    						     LIMIT 0,1 " ); 
    						     
  // Binds the named parameter markers ":id" to the specified parameter values "$poi['id']".							   
  $sql_transform->bindParam( ':id', $poi['id'], PDO::PARAM_INT );
    
  // Use PDO::execute() to execute the prepared statement $sql_transform. 
  $sql_transform->execute();
    
  // Fetch the poi transform. 
  $transform = $sql_transform->fetchAll( PDO::FETCH_ASSOC );
  
  /* Process the $transform result */
  
  // if $transform array is empty, return NULL. 
  if ( empty( $transform ) ) {
  
  	$poi["transform"] = null;
  	
  }//if 
  else {
  	// Since each POI only has one transform. Logically, only one transform should be returned. Assign the first transform in the array to $poi["transform"]
    $poi["transform"] = $transform[0];
    
    // Change the value of "rel" into boolean value,if the value is NULL, return NULL.
    $poi["transform"]["rel"] = ChangetoBool( $poi["transform"]["rel"] );
    
    // Change the values of "angle" and "scale" to demical.
    $poi["transform"]["angle"] = ChangetoFloat( $poi["transform"]["angle"] );
    $poi["transform"]["scale"] = ChangetoFloat( $poi["transform"]["scale"] );
  }//else
  
   return $poi["transform"];

}//Gettransform


/*** Main entry point ***/


/* Pre-define connection to the MySQL database, please specify these fields.*/
$dbhost = 'db_hostname';
$dbdata = 'db_databasename';
$dbuser = 'db_username';
$dbpass = 'db_password';

/* Put parameters from GetPOI request into an associative array named $value */

// Put needed parameter names from GetPOI request in an array called $keys. 
$keys = array( "layerName", "lat", "lon", "radius" );

// Initialize an empty associative array.
$value = array(); 

try {
  // Retrieve parameter values using $_GET and put them in $value array with parameter name as key. 
  foreach( $keys as $key ) {
    if ( isset($_GET[$key]) )
      $value[$key] = $_GET[$key]; 
    else 
      throw new Exception($key ." parameter is not passed in GetPOI request.");
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
	
	// Assign cooresponding values to mandatory JSON response keys.
	$response["layer"] = $value["layerName"];
	
	// Use Gethotspots() function to retrieve POIs with in the search range.  
	$response["hotspots"] = Gethotspots( $db, $value );

	// if there is no POI found, return a custom error message.
	if ( empty( $response["hotspots"] ) ) {
		$response["errorCode"] = 20;
 		$response["errorString"] = "No POI found. Please adjust the range.";
	}//if
	else {
  		$response["errorCode"] = 0;
  		$response["errorString"] = "ok";
	}//else

	/* All data is in $response, print it into JSON format.*/
	
	// Put the JSON representation of $response into $jsonresponse.
	$jsonresponse = json_encode( $response );
	
	// Declare the correct content type in HTTP response header.
	header( "Content-type: application/json; charset=utf-8" );
	
	// Print out Json response.
	echo $jsonresponse;

	/* Close the MySQL connection.*/
	
	// Set $db to NULL to close the database connection.
	$db=null;
}
catch( PDOException $e )
    {
    echo $e->getMessage();
    }

?>
