<?php 
/*ob_start();
date_default_timezone_set ("Asia/Calcutta");
 
$Server = "203.115.101.30";
$User = "sa_inv";
$Pass = "sa_inv@123";
//$DB = "Inventory";

$DB = "Inventory";

//connection to the database
$dbconn = mssql_connect($Server, $User, $Pass)
  or die("Couldn't connect to SQL Server on $Server");

//select a database to work with
$selected = mssql_select_db($DB, $dbconn)
  or die("Couldn't open database $myDB");


//close the connection
mssql_close($dbconn);


function select_query_sql($query,$condition=0){
	
	global $dbconn;

	$Server = '203.115.101.30'; // host/instance_name
	$User = 'sa_inv'; // username
	$Pass = 'sa_inv@123'; // paasword
	$DB = 'Inventory'; // database name
	
	$dbconn = mssql_connect($Server, $User, $Pass);

		if($condition==1){
			//echo "<br>".$query."<br>";
		}
	$qry=@mssql_query($query,$dbconn);  
	 
	  $num=@mssql_num_rows($qry);
	$num_field=@mssql_num_fields($qry);
	for($i=0;$i<$num_field;$i++)
	{
	$fname[]=@mssql_field_name($qry,$i);
	}
	for($i=0;$i<$num;$i++){
	$result=mssql_fetch_array($qry);
	foreach($fname as $key => $value ) {
		$arr[$i][$value]=$result[$value];
		}
	}


	return $arr;
}

function insert_query_sql($table_name, $form_data)
{
   
	global $dbconn;

	$Server = '203.115.101.30'; // host/instance_name
	$User = 'sa_inv'; // username
	$Pass = 'sa_inv@123'; // paasword
	$DB = 'Inventory'; // database name
	
	$dbconn = mssql_connect($Server, $User, $Pass);

    // retrieve the keys of the array (column titles)
    $fields = array_keys($form_data);
 
    // build the query
     $sql = "INSERT INTO ".$table_name."
    (`".implode('`,`', $fields)."`)
    VALUES('".implode("','", $form_data)."')";
 
    // run and return the query result resource
	$insert = mssql_query($sql,$dbconn);
    return $insert;
}

function update_query_sql($table_name,$form_data,$condition)
{
   
	global $dbconn;

	$Server = '203.115.101.30'; // host/instance_name
	$User = 'sa_inv'; // username
	$Pass = 'sa_inv@123'; // paasword
	$DB = 'Inventory'; // database name
	
	$dbconn = mssql_connect($Server, $User, $Pass);
	
	$cond = array();
	foreach($condition as $field => $val) {
	   $cond[] = "$field = '$val'";
	}
	
	$fields = array();
	foreach($form_data as $field => $val) {
	   $fields[] = "$field = '$val'";
	}
	
    // build the query 	
	$sql = "UPDATE ".$table_name." SET ". join(', ', $fields) ." WHERE ".join(' and ', $cond);
 
    // run and return the query result resource
	$update = mssql_query($sql,$dbconn);
    return $update;
}*/


?> 
 