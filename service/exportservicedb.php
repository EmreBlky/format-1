<?php
 ob_start();
  // include("include/header.inc.php");//include("config.php");
  $host = 'gtracservicedb.db.5296103.hostedresource.com'; // <--  db address $user = 'gtracservicedb'; // <-- db user name $pass = 'eevPriyambada0'; // <-- password $db = 'gtracservicedb'; // db's name $table = 'services'; // table you want to export  $link = mysql_connect($host, $user, $pass) or die("Can not connect." . mysql_error()); mysql_select_db($db) or die("Can not connect.");
if(isset($_POST['submit'])) { 
	$id_array = 	  $_POST['name']; // return array
	$id1_array = 	  $_POST['dateStart']; // return array
	$id2_array = 	  $_POST['dateEnd']; // return array
	$id_count = count($_POST['name']); // count array
	 $out = ''; $field_name  = mysql_list_fields("gtracservicedb", "services" ); 
	$count_field = mysql_num_fields($field_name); // count the table field

	for($i = 0; $i < $count_field; $i++) { // name of all fields
		$l= mysql_field_name($field_name, $i);
			 $out .= $l . ', '; // echo table fileds,
	}
	
	$out .= "\n"; // echo new line

	for($j = 0; $j < $id_count; $j++) { // each checked
		
		$name = $name_array[$j];
		$query = mysql_query("SELECT * FROM services WHERE name = '$id_array' AND inst_date >= '$id1_array' AND inst_date <= '$id2_array'");

		while ($row = mysql_fetch_array($query)) {
			for($i = 0; $i < $count_field; $i++) {
				$out .= $row["$i"] . ', '; // echo data, 
			}
			$out .= "\n";  // echo new line per data
		}
		
	}

	// Output to browser with appropriate mime type.
	header("Content-type: text/x-csv");
	header("Content-Disposition: attachment; filename=".time().".csv");
	echo $out; // output
	exit;
}
?>