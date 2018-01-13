<?php
 ob_start();
 include ("config.php");
  define("DB_NAME", "gtracservicedb"); // db name
define("TABLE_NAME", "services"); // table


if(isset($_POST['submit'])) {
	
	 $id_array = 	  $_POST['name']; // return array
	 $id1_array = 	  $_POST['vehicle']; // return array
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
		$name_query=mysql_query("select * from users where user_id='".$id_array."'");
		$name_data=mysql_fetch_row($name_query);
		
	for($j = 0; $j < $id_count; $j++) { // each checked
	
		
		$name = $name_array[$j];
		$query = mysql_query("SELECT * FROM services WHERE name='".$name_data[1]."' AND veh_reg = '".$id1_array."' AND inst_date >= '".$id2_array."' AND inst_date <= '".$id3_array."'");

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