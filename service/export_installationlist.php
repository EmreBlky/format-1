<?php
  ob_start();
 include ("config.php");
  define("DB_NAME", "gtracservicedb"); // db name
define("TABLE_NAME", "installation"); // table

if(isset($_POST['submit'])) {
	
	$id_array = 	  $_POST['name']; // return array
	$id1_array = 	  $_POST['client_name']; // return array
	$id2_array = 	  $_POST['dateStart']; // return array
	$id3_array = 	  $_POST['dateEnd']; // return array
	$id_count = count($_POST['name']); // count array
	
	$out = '';
	$field_name  = mysql_list_fields( DB_NAME, TABLE_NAME );
	$count_field = mysql_num_fields($field_name); // count the table field

	for($i = 0; $i < $count_field; $i++) { // name of all fields
		$l= mysql_field_name($field_name, $i);
			 $out .= $l . ', '; // echo table fileds,
	}
	
	$out .= "\n"; // echo new line

	for($j = 0; $j < $id_count; $j++) { // each checked
		
		$name = $name_array[$j];
		$query = mysql_query("SELECT * FROM installation WHERE client = '$id_array' OR client = '$id1_array' AND time >= '$id2_array' AND time <= '$id3_array'");

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