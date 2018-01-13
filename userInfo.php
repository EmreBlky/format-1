<?php
include("connection.php");
$q=$_GET["user_id"];


/*$result="select services.id as id,services.id,veh_reg,adddate(latest_telemetry.gps_time,INTERVAL 19800 second) as lastcontact,round(gps_speed*1.609,0) as speed,  case when tel_ignition=true then true else false end as aconoff , geo_street as street, latest_telemetry.gps_latitude as lat,latest_telemetry.gps_longitude as lng ,devices.imei from matrix.services

join matrix.latest_telemetry on latest_telemetry.sys_service_id=services.id

join matrix.devices on devices.id=services.sys_device_id

join matrix.mobile_simcards on matrix.mobile_simcards.id=devices.sys_simcard

where services.id in 

(select distinct sys_service_id from matrix.group_services where active=true and sys_group_id in (

select sys_group_id from matrix.group_users where sys_user_id=(".$q.")))";*/

$result="select services.id as id,services.id,veh_reg from matrix.services where services.id in(select distinct sys_service_id 
										from matrix.group_services where active=true and sys_group_id in(select 
										sys_group_id from matrix.group_users where sys_user_id=(".$q."))))";

																
$data=select_query_live_con($result);
 


if(isset($_GET['action']) && $_GET['action']=='getdata')
{
  
//$result = mysql_query("SELECT veh_reg FROM vehicles WHERE user_id = '".$q."'");

$msg= "<table border='0' style='width:50%;'><tr>";
$i=0;
while($row = mysql_fetch_array($data))
  {
	if($i%3==0) { 
	$msg .="</tr><tr>";
	}
  $msg .="<td>".$row['veh_reg']."</td><td><input type='checkbox' name='$i' value='".$row['veh_reg']."' style='width=20px;'/></td>" ;
  $i++;}
  
  
  $msg .="</tr></table>";
  
  echo $msg;
}

if(isset($_GET['action']) && $_GET['action']=='total')
	{
		 
		echo mysql_num_rows($data);
	}

if(isset($_GET['action']) && $_GET['action']=='companyname')
	{
		 
		$sql="select `group`.name as company from matrix.group_users left join matrix.`group` on group_users.sys_group_id=`group`.id where group_users.sys_user_id=".$q;

		$row=select_query_live_con($sql);

		echo $row[0]["company"];
	}


if(isset($_GET['action']) && $_GET['action']=='creationdate')
	{
		 
		$sql="select * from matrix.users where id=".$q;

		$row=select_query_live_con($sql);

		echo date("d-M-Y",strtotime($row[0]["sys_added_date"]));
	}





	
	


	if(isset($_GET['action']) && $_GET['action']=='getrowSales')
	{
		 
			$RowId=$_GET["RowId"];
			$tablename=$_GET["tablename"];
			
	 

If($tablename=="new_account_creation")
		{
	$query = "SELECT * FROM ".$tablename." where id=".$RowId;
			$row=select_query($query);
	?><div > <div style=" padding-left: 50px;">
	<h1>New account creation</h1> </div>
	<div class="table">
	<table cellspacing="2" cellpadding="2" style=" padding-left: 100px;width: 500px;">
	 
<tr><td>Date</td><td><?echo $row[0]["date"];?></td></tr>
<tr><td>Account Manager</td><td><?echo $row[0]["account_manager"];?></td></tr>
<tr><td>Company</td><td><?echo $row[0]["company"];?></td></tr>
<tr><td>Potential</td>  <td><?echo $row[0]["potential"];?></td></tr>
<tr><td>Contact Person</td><td><?echo $row[0]["contact_person"];?></td></tr>
<tr><td>Contact Number</td><td><?echo $row[0]["contact_number"];?></td></tr>
<tr><td>Billing Name</td><td><?echo $row[0]["billing_name"];?></td></tr>
<tr><td>Billing Address</td><td><?echo $row[0]["billing_address"];?></td></tr>
<tr><td>price</td><td><?echo $row[0]["device_rent_price"];?></td></tr>
<tr><td>vat</td><td><?echo $row[0]["device_rent_vat"];?></td></tr>
<tr><td>total</td><td><?echo $row[0]["device_rent_total"];?></td></tr>
<tr><td>rent</td><td><?echo $row[0]["device_rent_rent"];?></td></tr>
<tr><td>service tax</td><td><?echo $row[0]["device_rent_service_tax"];?></td></tr>
<td>mode of payment</td><td><?echo $row[0]["mode_of_payment"];?></td></tr>
<tr><td>Vehicle type</td><td><?echo $row[0]["vehicle_type"];?></td></tr>
<tr><td>Immobilizer (Y/N)</td><td><?echo $row[0]["immobilizer"];?></td></tr>
<tr><td>AC (ON/OFF)</td><td><?echo $row[0]["ac_on_off"];?></td></tr>
<tr><td>E_mail ID</td>  <td><?echo $row[0]["email_id"];?></td></tr>
<tr><td>User Name</td><td><?echo $row[0]["user_name"];?></td></tr>
<tr><td>Password</td><td><?echo $row[0]["user_password"];?></td></tr>
	</table>
	</div> 
	</div> 


	<?}


	If($tablename=="stop_gps")
		{
		echo $query = "SELECT * FROM ".$tablename." where id=".$RowId;die();
			$row=select_query($query);
	?><div > <div style=" padding-left: 50px;">
	<h1>New account creation</h1> </div>
	<div class="table">
	<table cellspacing="2" cellpadding="2" style=" padding-left: 100px;width: 500px;">
	 
<tr><td>Date 	</td><td><?echo $row[0]["date"];?></td></tr>
<tr><td>Account Manager 	</td><td><?echo $row[0]["date"];?></td></tr>
<tr><td>Client User Name 	</td><td><?echo $row[0]["date"];?></td></tr>
<tr><td>Company Name 	</td><td><?echo $row[0]["date"];?></td></tr>
<tr><td>Total No Of Vehicle 	</td><td><?echo $row[0]["date"];?></td></tr>
<tr><td>Vehicle to Stop GPS </td><td><?echo $row[0]["date"];?></td></tr>
<tr><td>Persent Status Of</td><td>:---</td></tr>
<tr><td>Location 	</td><td><?echo $row[0]["date"];?></td></tr>
<tr><td>OwnerShip 	</td><td><?echo $row[0]["date"];?></td></tr>
<tr><td>Reason 	</td><td><?echo $row[0]["date"];?></td></tr>
<tr><td>Sales Action 	</td><td><?echo $row[0]["date"];?></td></tr> 

	</table>
	</div> 
	</div> 


	<?}

	If($tablename=="new_account_creation")
		{
	?><div > <div style=" padding-left: 50px;">
	<h1>New account creation</h1> </div>
	<div class="table">
	<table cellspacing="2" cellpadding="2" style=" padding-left: 100px;width: 500px;">
	 
<tr><td>Date</td><td><?echo $row[0]["date"];?></td></tr>
<tr><td>Account Manager</td><td><?echo $row[0]["account_manager"];?></td></tr>
<tr><td>Company</td><td><?echo $row[0]["company"];?></td></tr>
<tr><td>Potential</td>  <td><?echo $row[0]["potential"];?></td></tr>
<tr><td>Contact Person</td><td><?echo $row[0]["contact_person"];?></td></tr>
<tr><td>Contact Number</td><td><?echo $row[0]["contact_number"];?></td></tr>
<tr><td>Billing Name</td><td><?echo $row[0]["billing_name"];?></td></tr>
<tr><td>Billing Address</td><td><?echo $row[0]["billing_address"];?></td></tr>
<tr><td>price</td><td><?echo $row[0]["device_rent_price"];?></td></tr>
<tr><td>vat</td><td><?echo $row[0]["device_rent_vat"];?></td></tr>
<tr><td>total</td><td><?echo $row[0]["device_rent_total"];?></td></tr>
<tr><td>rent</td><td><?echo $row[0]["device_rent_rent"];?></td></tr>
<tr><td>service tax</td><td><?echo $row[0]["device_rent_service_tax"];?></td></tr>
<td>mode of payment</td><td><?echo $row[0]["mode_of_payment"];?></td></tr>
<tr><td>Vehicle type</td><td><?echo $row[0]["vehicle_type"];?></td></tr>
<tr><td>Immobilizer (Y/N)</td><td><?echo $row[0]["immobilizer"];?></td></tr>
<tr><td>AC (ON/OFF)</td><td><?echo $row[0]["ac_on_off"];?></td></tr>
<tr><td>E_mail ID</td>  <td><?echo $row[0]["email_id"];?></td></tr>
<tr><td>User Name</td><td><?echo $row[0]["user_name"];?></td></tr>
<tr><td>Password</td><td><?echo $row[0]["user_password"];?></td></tr>
	</table>
	</div> 
	</div> 


	<?}
	If($tablename=="new_account_creation")
		{
	?><div > <div style=" padding-left: 50px;">
	<h1>New account creation</h1> </div>
	<div class="table">
	<table cellspacing="2" cellpadding="2" style=" padding-left: 100px;width: 500px;">
	 
<tr><td>Date</td><td><?echo $row[0]["date"];?></td></tr>
<tr><td>Account Manager</td><td><?echo $row[0]["account_manager"];?></td></tr>
<tr><td>Company</td><td><?echo $row[0]["company"];?></td></tr>
<tr><td>Potential</td>  <td><?echo $row[0]["potential"];?></td></tr>
<tr><td>Contact Person</td><td><?echo $row[0]["contact_person"];?></td></tr>
<tr><td>Contact Number</td><td><?echo $row[0]["contact_number"];?></td></tr>
<tr><td>Billing Name</td><td><?echo $row[0]["billing_name"];?></td></tr>
<tr><td>Billing Address</td><td><?echo $row[0]["billing_address"];?></td></tr>
<tr><td>price</td><td><?echo $row[0]["device_rent_price"];?></td></tr>
<tr><td>vat</td><td><?echo $row[0]["device_rent_vat"];?></td></tr>
<tr><td>total</td><td><?echo $row[0]["device_rent_total"];?></td></tr>
<tr><td>rent</td><td><?echo $row[0]["device_rent_rent"];?></td></tr>
<tr><td>service tax</td><td><?echo $row[0]["device_rent_service_tax"];?></td></tr>
<td>mode of payment</td><td><?echo $row[0]["mode_of_payment"];?></td></tr>
<tr><td>Vehicle type</td><td><?echo $row[0]["vehicle_type"];?></td></tr>
<tr><td>Immobilizer (Y/N)</td><td><?echo $row[0]["immobilizer"];?></td></tr>
<tr><td>AC (ON/OFF)</td><td><?echo $row[0]["ac_on_off"];?></td></tr>
<tr><td>E_mail ID</td>  <td><?echo $row[0]["email_id"];?></td></tr>
<tr><td>User Name</td><td><?echo $row[0]["user_name"];?></td></tr>
<tr><td>Password</td><td><?echo $row[0]["user_password"];?></td></tr>
	</table>
	</div> 
	</div> 


	<?}
	If($tablename=="new_account_creation")
		{
	?><div > <div style=" padding-left: 50px;">
	<h1>New account creation</h1> </div>
	<div class="table">
	<table cellspacing="2" cellpadding="2" style=" padding-left: 100px;width: 500px;">
	 
<tr><td>Date</td><td><?echo $row[0]["date"];?></td></tr>
<tr><td>Account Manager</td><td><?echo $row[0]["account_manager"];?></td></tr>
<tr><td>Company</td><td><?echo $row[0]["company"];?></td></tr>
<tr><td>Potential</td>  <td><?echo $row[0]["potential"];?></td></tr>
<tr><td>Contact Person</td><td><?echo $row[0]["contact_person"];?></td></tr>
<tr><td>Contact Number</td><td><?echo $row[0]["contact_number"];?></td></tr>
<tr><td>Billing Name</td><td><?echo $row[0]["billing_name"];?></td></tr>
<tr><td>Billing Address</td><td><?echo $row[0]["billing_address"];?></td></tr>
<tr><td>price</td><td><?echo $row[0]["device_rent_price"];?></td></tr>
<tr><td>vat</td><td><?echo $row[0]["device_rent_vat"];?></td></tr>
<tr><td>total</td><td><?echo $row[0]["device_rent_total"];?></td></tr>
<tr><td>rent</td><td><?echo $row[0]["device_rent_rent"];?></td></tr>
<tr><td>service tax</td><td><?echo $row[0]["device_rent_service_tax"];?></td></tr>
<td>mode of payment</td><td><?echo $row[0]["mode_of_payment"];?></td></tr>
<tr><td>Vehicle type</td><td><?echo $row[0]["vehicle_type"];?></td></tr>
<tr><td>Immobilizer (Y/N)</td><td><?echo $row[0]["immobilizer"];?></td></tr>
<tr><td>AC (ON/OFF)</td><td><?echo $row[0]["ac_on_off"];?></td></tr>
<tr><td>E_mail ID</td>  <td><?echo $row[0]["email_id"];?></td></tr>
<tr><td>User Name</td><td><?echo $row[0]["user_name"];?></td></tr>
<tr><td>Password</td><td><?echo $row[0]["user_password"];?></td></tr>
	</table>
	</div> 
	</div> 


	<?}
	}
?> 