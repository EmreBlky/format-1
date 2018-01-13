<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
<title>Tracking Experts : Live Tracking</title>
 <script src="thickbox/jquery-latest.js" type="text/javascript"></script>
<script src="thickbox/thickbox.js" type="text/javascript"></script>
<link rel="stylesheet" href="thickbox/thickbox.css" type="text/css" media="projection, screen" />
<link rel="icon" href="./favicon.ico" type="image/x-icon" />
<link rel="shortcut icon" href="./favicon.ico" type="image/x-icon" />

<style type="text/css">
<!--
.style1 {font-size: 12px}
.style3 {font-size:12px; color:#666666; font-style:italic; text-decoration:none; font-family: Arial, Helvetica, sans-serif;}

p { margin:0px; padding:0px; }

.servic_h { font-family:Arial, Helvetica, sans-serif; font-weight:bold; font-size:17px; color:#ff6600; }
.city_h { font-family:Arial, Helvetica, sans-serif; font-weight:bold; font-size:19px; color:#030303; }

.small_h { font-family:Arial, Helvetica, sans-serif; font-size:11px; font-weight:bold;}
-->
</style>
</head><?php

function checkValues($value)
{
	 // Use this function on all those values where you want to check for both sql injection and cross site scripting
	 //Trim the value
	 $value = trim($value);
	 
	// Stripslashes
	if (get_magic_quotes_gpc()) {
		$value = stripslashes($value);
	}
	
	 // Convert all &lt;, &gt; etc. to normal html and then strip these
	 $value = strtr($value,array_flip(get_html_translation_table(HTML_ENTITIES)));
	
	 // Strip HTML Tags
	 $value = strip_tags($value);
	
	// Quote the value
	$value = mysql_real_escape_string($value);
	return $value;
	
}	

include("dbcon.php");

$rec = checkValues($_REQUEST['val']);
//get table contents

if($rec)
{

	  $sql = "select * from users where (sys_username like '%$rec%' or fullname like '%$rec%' or sales_user_id like '%$rec%' or company like '%$rec%') and  (sys_active=true)   order by trim(fullname)"; 
	
}

else

{

	$sql = "select * from users where sys_active=true and sys_parent_user=1 order by trim(fullname)";

}


 
$rsd = mysql_query($sql);
$total =  mysql_num_rows($rsd);

?>



 
<table width="100%" border="1" cellpadding="0" cellspacing="0" align="center" id="myTable" class="tablesorter"><thead>
<tr align="Center">
		<th width="11%" align="center"><font color="#0E2C3C"><b>Name </b></font></th>
		<th width="11%" align="center"><font color="#0E2C3C"><b>User name</b></font></th>
		<th width="11%" align="center"><font color="#0E2C3C"><b>Company Name </b></font></th>
		<th width="11%" align="center"><font color="#0E2C3C"><b>Billing Address</b></font></th>
		<th width="11%" align="center"><font color="#0E2C3C"><b>Mobile Number</b></font></th>
		<th width="11%" align="center"><font color="#0E2C3C"><b>Contact No</b></font></th>
        <th width="11%" align="center"><font color="#0E2C3C"><b>User Created Date</b></font></th>
		<td width="11%" align="center"><font color="#0E2C3C"><b>Rent per device</b></font></td>
		<td width="15%" align="center"><font color="#0E2C3C"><b>Payment Detail</b></font></td>

				<td width="15%" align="center"><font color="#0E2C3C"><b>Add Comment</b></font></td>


		<td width="15%" align="center"><font color="#0E2C3C"><b>View comment</b></font></td>

		<!--<td width="11%" align="center"><font color="#0E2C3C"><b>Delete</b></font></td>-->
		 
		
	</tr></thead>
			<tbody>
	<?php  
	while ($row = mysql_fetch_assoc($rsd))
	{	
    ?>  
	<tr align="Center">
	
		<td width="11%" align="center">&nbsp;<?php echo $row['fullname'];?></td>
		<td width="11%" align="center">&nbsp;<?php echo $row['sys_username'];?></td>
		
		<td width="12%" align="center">&nbsp;<?php echo $row['company'];?></td>
		<td width="10%" align="center">&nbsp;<?php echo $row['billing_address'];?></td>
		<td width="10%" align="center">&nbsp;<?php echo $row['phone_number'];?></td>
		<td width="12%" align="center">&nbsp;<?php echo $row['mobile_number'];?></td>
        <td width="12%" align="center">&nbsp;<?php echo date("d-M-Y",strtotime($row['sys_added_date']));?></td>
        <td width="12%" align="center">&nbsp;<?php echo $row['price_per_unit'] ;?></td>

		 
		<td width="15%" align="center">&nbsp;<a href='viewpayment.php?userid=<?= $row["id"]?>&price=<?= $row["price_per_unit"]?>' class='thickbox' style='font-size:12px; color:#EE7000;'>Payment Detail</a> </td>

		<td width="15%" align="center">&nbsp;<a href='addcomment-iframe.php?userid=<?= $row["id"]?>' class='thickbox' style='font-size:12px; color:#EE7000;'>Add Comment</td>
		<td width="15%" align="center">&nbsp;<a href='viewcomment-iframe.php?userid=<?= $row["id"]?>' class='thickbox' style='font-size:12px; color:#EE7000;'>View Comment</td>
		<!--<td width="12%" align="center">&nbsp;<a href="services.php?id=<?php echo $row['id'];?>">Delete</a></td>-->
		
	</tr>
 

		<?php  
    }
	 
    ?>
	
</table> 
 
 
 
 
