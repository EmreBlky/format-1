<?php
include($_SERVER["DOCUMENT_ROOT"]."/format/connection.php");
$q=$_GET["user_id"];
$veh_reg=$_GET["veh_reg"];
 $row_id=$_GET["row_id"];
 $comment=$_GET["comment"];
 $user_id=$_GET["user_id"];

if(isset($_GET['action']) && $_GET['action']=='DetailVehicle')
{


   $user_Id=$_GET["user_Id"];
	$msg='<table>';
for($N=1;$N<=$_GET["RowId"];$N++)
	{
	$msg.=" <tr><td><input type='text' name='Veh_name$N'></td><td>";
	
		$result="select services.id as id,services.id,veh_reg from matrix.services
 
where services.id in 

(select distinct sys_service_id from matrix.group_services where active=true and sys_group_id in (

select sys_group_id from matrix.group_users where sys_user_id=(".$user_Id.")))";

$data=mysql_query($result,$dblink);

$msg=' <select name="veh_reg" id="veh_reg" onchange="getdeviceImei(this.value,\'TxtDeviceIMEI\');getInstaltiondate(this.value,\'date_of_install\');getdevicemobile(this.value,\'Devicemobile\');getNotwokingdate(this.value,\'Notwoking\')">
<option value="0">Select Vehicle No</option>';
 
while($row = mysql_fetch_array($data))
  {
	 
  $msg .="<option value=".$row['veh_reg'].">".$row['veh_reg']."</option>";
   
  
  }
  
  
  $msg .="</select></td></tr> ";
	}
	$msg.='</table>';
	echo $msg;
}

	
	 
 
 if(isset($_GET['action']) && $_GET['action']=='getrowSales')
	{
 ?>
 
 <style type="text/css">
#databox{width:840px; height:650px; margin: 30px auto auto; border:1px solid #bfc0c1; font-family:Arial, Helvetica, sans-serif; font-size:13px; font-weight:normal; color:#3f4041;}
.heading{ font-family:Arial, Helvetica, sans-serif; font-size:30px; font-weight:700; word-spacing:5px; text-align:center;   color:#3E3E3E;   background-color:#ECEFE7; margin-bottom:10px;  }
.dataleft{float:left; width:400px; height:400px; margin-left:10px; border-right:1px solid #bfc0c1;}
.dataright{float:right; width:400px; height:400px; margin-left:19px;}
td{padding-right:20px; padding-left:20px;}
</style>


<?
	
		 
			$RowId=$_GET["RowId"];
			$tablename=$_GET["tablename"];
			
	 

If($tablename=="new_account_creation")
		{
	$query = "SELECT * FROM ".$tablename." where id=".$RowId;
			$row=select_query($query);
	?><div id="databox">
<div class="heading">New account creation</div>
<div class="dataleft"><table cellspacing="2" cellpadding="2">
	 
<tbody><tr><td><strong>Date</strong></td><td><?echo $row[0]["date"];?></td></tr>

<? if($row[0]["account_manager"]=='saleslogin') {
$account_manager=$row[0]["sales_manager"]; 
}
else {
$account_manager=$row[0]["account_manager"]; 
}

?>
<tr><td>Account Manager</td><td><?echo $account_manager;?></td></tr><tr><td><strong>Company</strong></td><td><?echo $row[0]["company"];?></td></tr>
<tr><td><strong>Potential</strong></td>  <td><?echo $row[0]["potential"];?></td></tr>
<tr><td><strong>Contact Person</strong></td><td><?echo $row[0]["contact_person"];?></td></tr>
<tr><td><strong>Contact Number</strong></td><td><?echo $row[0]["contact_number"];?></td></tr>
<tr><td><strong>Billing Name</strong></td><td><?echo $row[0]["billing_name"];?></td></tr>
<tr><td><strong>Billing Address</strong></td><td><?echo $row[0]["billing_address"];?></td></tr>
<tr><td><strong>Type of Organisation</strong></td><td><?echo $row[0]["type_of_org"];?></td></tr>
<tr><td><strong>PAN No.</strong></td><td><?echo $row[0]["pan_no"];?></td></tr>
<tr><td><strong> Copy of Pan Card</strong></td><td><?echo $row[0]["pan_card"];?></td></tr>
<tr><td><strong>Copy of Address Proof</strong></td><td><?echo $row[0]["address_proof"];?></td></tr>
<tr><td><strong>mode of payment</strong></td><td><?echo $row[0]["mode_of_payment"];?></td></tr>
<tr><td><strong>Demo Period</strong></td><td><?echo $row[0]["demo_time"];?></td></tr>
<tr><td><strong>Device Price</strong> </td><td><?echo $row[0]["device_price"];?></td></tr>	
<tr><td><strong>Vat(5%)</strong> </td><td><?echo $row[0]["device_price_vat"];?></td></tr>	
<tr><td><strong>Total </strong></td><td><?echo $row[0]["device_price_total"];?></td></tr>	
<tr><td><strong>Rent </strong></td><td><?echo $row[0]["device_rent_Price"];?></td></tr>	
<tr><td><strong>Service Tex(12.36%)</strong> </td><td><?echo $row[0]["device_rent_service_tax"];?></td></tr>	
<tr><td><strong>Total Rent</strong></td><td><?echo $row[0]["DTotalREnt"];?></td></tr>
<tr><td><strong>Dimts Fee status </strong></td><td><?echo $row[0]["dimts_fee"];?></td></tr>
<tr><td><strong>Rent Status</strong></td><td><?echo $row[0]["rent_status"];?></td></tr>
<tr><td><strong>Rent Month</strong></td><td><?echo $row[0]["rent_month"];?></td></tr>
</tbody></table></div>



<div class="dataright">
<table cellspacing="2" cellpadding="2"><tbody>
 <tr><td>Dimts</td><td><?echo $row[0]["dimts"];?></td></tr>
<tr><td><strong>Vehicle type</strong></td><td><?echo $row[0]["vehicle_type"];?></td></tr>
<tr><td><strong>Immobilizer (Y/N)</strong></td><td><?echo $row[0]["immobilizer"];?></td></tr>
<tr><td><strong>AC (ON/OFF)</strong></td><td><?echo $row[0]["ac_on_off"];?></td></tr>
<tr><td><strong>E_mail ID</strong></td>  <td><?echo $row[0]["email_id"];?></td></tr>
<tr><td><strong>User Name</strong></td><td><?echo $row[0]["user_name"];?></td></tr>
<tr><td><strong>Password</strong></td><td><?echo $row[0]["user_password"];?></td></tr>

<tr><td colspan="2">-------------------------------------------</td> </tr>

<!-- <tr><td>Admin Approval</td>  <td><?if($row[0]["approve_status"]==1) echo "Approved"; else echo "Pending Approval"?></td></tr>-->
 <tr><td><strong>Process Pending </strong></td>  <td><strong>
<?  if($row[0]["acc_creation_status"]==2 || (($row[0]["support_comment"]!="" || $row[0]["admin_comment"]!="") && $row[0]["sales_comment"]==""))
	{echo "Reply Pending at Request Side";}
	elseif($row[0]["approve_status"]==0 && $row[0]["forward_req_user"]!="" && $row[0]["forward_back_comment"]=="" && $row[0]["acc_creation_status"]==1)	
	{echo "Pending Admin Approval (Req Forward to ".$row[0]["forward_req_user"].")";}
	elseif($row[0]["approve_status"]==0 && $row[0]["final_status"]==0 && $row[0]["acc_creation_status"]==1)
	{echo "Pending Admin Approval";}
	elseif($row[0]["approve_status"]==1 && $row[0]["acc_creation_status"]==1 && $row[0]["final_status"]!=1){echo "Pending at Tech Support Team";}
	elseif($row[0]["final_status"]==1){echo "Process Done";}?></strong></td></tr>

<tr><td><strong>Account Comment</strong></td>  <td><?echo $row[0]["account_comment"];?></td></tr>
 <tr><td><strong>Sales Comment</strong></td>  <td><?echo $row[0]["sales_comment"];?></td></tr>
<tr><td><strong>Support Comment</strong></td><td><?echo $row[0]["support_comment"];?></td></tr>
<tr><td><strong>Admin Comment</strong></td><td><?echo $row[0]["admin_comment"];?></td></tr>
<tr><td><strong>Closed Date</strong></td><td><?

if($row[0]["final_status"]==1)
{
echo date("d-M-Y h:i:s A",strtotime($row[0]["close_date"]));
}
else
{
	echo "";
}?></td></tr>
</tbody></table>
</div>

</div>

<? }
	else If($tablename=="reactivation_of_account")
		{
		 $query = "SELECT * FROM ".$tablename." where id=".$RowId; 
			$row=select_query($query);


  
	?><div id="databox">
<div class="heading">Reactivation Of Account</div>
<div class="dataleft"><table cellspacing="2" cellpadding="2">
    <tbody> 
<tr><td>Date </td><td><?echo date("d-M-Y h:i:s A",strtotime($row[0]["date"]));?></td></tr> 	
<? if($row[0]["acc_manager"]=='saleslogin') {
$account_manager=$row[0]["sales_manager"]; 
}
else {
$account_manager=$row[0]["acc_manager"]; 
}

?>
<tr><td>Account Manager</td><td><?echo $account_manager;?>
<? $sql="SELECT Userid AS id,UserName AS sys_username FROM addclient  WHERE Userid=".$row[0]["user_id"];
	$rowuser=select_query($sql);
	?>
<tr><td>Client User Name 	</td><td><?echo $rowuser[0]["sys_username"];?></td></tr>	
<tr><td>Company Name </td><td><?echo $row[0]["company"];?></td></tr> 	
<tr><td>Total No Of Vehicle </td><td><?echo $row[0]["total_no_of_vehicles"];?></td></tr> 	
<tr><td>Deactivate Account</td><td><?echo $row[0]["deactivate_temp"];?></td></tr>
<tr><td>Deactivate Reason</td><td><?echo $row[0]["deact_reason"];?></td></tr> 
<tr><td>Deactivate Req Date</td><td><?echo $row[0]["deact_req_date"];?></td></tr> 
<tr><td>Deactivate Close Date</td><td><?echo $row[0]["deact_close_date"];?></td></tr> 

<tr><td>Reactivate Account Status</td><td><?echo $row[0]["reactivate_account_status"];?></td></tr>
<tr><td>Reactivate Reason</td><td><?echo $row[0]["reason"];?></td></tr>  

</tbody></table></div>
<div class="dataright">
<table cellspacing="2" cellpadding="2"><tbody>

 <!--<tr><td>Admin Approval</td>  <td><?if($row[0]["approve_status"]==1) echo "Approved"; else echo "Pending Approval"?></td></tr>-->
<tr><td><strong>Process Pending </strong></td>  <td><strong>
<?  if($row[0]["reactivation_status"]==2 || (($row[0]["support_comment"]!="" || $row[0]["admin_comment"]!="") && $row[0]["sales_comment"]==""))
	{echo "Reply Pending at Request Side";}
	elseif($row[0]["account_comment"]=="" && $row[0]["pay_pending"]=="" && $row[0]["approve_status"]==0 && $row[0]["final_status"]==0){echo "Pending at Accounts";} 
	elseif($row[0]["approve_status"]==0 && $row[0]["forward_req_user"]!="" && $row[0]["forward_back_comment"]=="" && $row[0]["reactivation_status"]==1)	
	{echo "Pending Admin Approval (Req Forward to ".$row[0]["forward_req_user"].")";}
	elseif($row[0]["approve_status"]==0 && ($row[0]["account_comment"]!="" || $row[0]["pay_pending"]!="") && $row[0]["final_status"]==0 && $row[0]["reactivation_status"]==1)
	{echo "Pending Admin Approval";}
	elseif($row[0]["approve_status"]==1 && $row[0]["reactivation_status"]==1 && $row[0]["final_status"]!=1){echo "Pending at Tech Support Team";}
	elseif($row[0]["final_status"]==1){echo "Process Done";}?></strong></td></tr>

<tr><td>Pending Amount</td>  <td><?echo $row[0]["pay_pending"];?></td></tr>
<tr><td>Account Comment</td>  <td><?echo $row[0]["account_comment"];?></td></tr>
<tr><td>Sales Comment</td>  <td><?echo $row[0]["sales_comment"];?></td></tr>
<tr><td>Support Comment</td><td><?echo $row[0]["support_comment"];?></td></tr>
<tr><td>Admin Comment</td><td><?echo $row[0]["admin_comment"];?></td></tr>
<tr><td>Req Forwarded to</td><td><?echo $row[0]["forward_req_user"];?></td></tr>
<tr><td>Forward Comment</td><td><?echo $row[0]["forward_comment"];?></td></tr>
<tr><td>F/W Request Back Comment</td><td><?echo $row[0]["forward_back_comment"];?></td></tr><tr><td>Approval Date</td><td><?
if($row[0]["approve_status"]==1 && $row[0]["approve_date"]!='')
{
echo date("d-M-Y h:i:s A",strtotime($row[0]["approve_date"]));
}
else
{
	echo "";
}

?></td></tr>
<tr><td>Closed Date</td><td><?
if($row[0]["final_status"]==1 && $row[0]["close_date"]!='')
{
echo date("d-M-Y h:i:s A",strtotime($row[0]["close_date"]));
}
else
{
	echo "";
}

?></td> 
	</tr>
</tbody>
	</table>
	</div> 
	</div>

<? }

	elseIf($tablename=="new_device_addition")
		{

		  $query = "SELECT * FROM ".$tablename." where id=".$RowId; 
			$row=select_query($query);

	?>
	
	<div id="databox">
<div class="heading">View New device Addition</div>
<div class="dataleft"><table cellspacing="2" cellpadding="2">

<tr><td>Date</td><td><?echo $row[0]["date"];?></td></tr>
<tr><td>Account Manager</td><td><?echo $row[0]["sales_manager"];?></td></tr>
<tr><td>Company</td><td><?echo $row[0]["client"];?></td></tr>
<? $sql="SELECT Userid AS id,UserName AS sys_username FROM addclient  WHERE Userid=".$row[0]["user_id"];
	$rowuser=select_query($sql);
	?>
<tr><td>Client User Name 	</td><td><?echo $rowuser[0]["sys_username"];?></td></tr>

<tr><td>Vehicle Name</td><td><?echo $row[0]["vehicle_no"];?></td></tr> 	
<tr><td>Device Type </td><td><?echo $row[0]["device_type"];?></td></tr>	
 <tr><td>OLD Company Name </td><td><?echo $row[0]["old_device_client"];?></td></tr>	
<tr><td>OLD Registration No </td><td><?echo $row[0]["old_vehicle_name"];?></td></tr>	
<tr><td>Device Model 	</td><td><?echo $row[0]["device_model"];?></td></tr>
<tr><td>Device IMEI </td><td><?echo $row[0]["device_imei"];?></td></tr>	

<? 
if($row[0]["device_type"]=='New') {
$Deviceid=$row[0]["device_id"];
}
else if($row[0]["device_type"]=='Old') {
$Deviceid=$row[0]["old_device_id"];
}
?>
<tr><td>Device ID </td><td><?echo $Deviceid;?></td></tr>	
<tr><td>Device Mobile Number 	</td><td><?echo $row[0]["device_sim_num"];?></td></tr>
<tr><td>OLD Date Of Installation </td><td><?echo $row[0]["olddate_of_installation"];?></td></tr>	
<? if($row[0]["device_type"]=='New'){
$biliing_status=$row[0]["billing"];
}
else{
$biliing_status=$row[0]["billing_if_old_device"];
}
	?>
<tr><td>Billing</td><td><?echo $biliing_status;?></td></tr>
<tr><td>Billing Reason</td><td><?echo $row[0]["billing_if_no_reason"];?></td></tr>
<tr><td>Installer</td><td><?echo $row[0]["inst_name"];?></td></tr>
<tr><td>Dimts</td><td><?echo $row[0]["dimts"];?></td></tr>
<tr><td>Immobilizer  </td><td><?echo $row[0]["immobilizer"];?></td></tr>
<tr><td>AC 	 </td><td><?echo $row[0]["ac"];?></td></tr>
<tr><td>Date Of Installation	</td><td><?echo $row[0]["date_of_installation"];?></td></tr>
<tr><td>Reason</td><td><?echo $row[0]["reason"];?></td></tr>
 <tr><td colspan="2">-------------------------------------------</td> </tr>
</table></div>
 
<div class="dataright">
<table cellspacing="2" cellpadding="2"><tbody>
 <tr><td><strong>Process Pending</strong> </td>  <td><strong>
<?  if($row[0]["new_device_status"]==2 || ($row[0]["support_comment"]!="" && $row[0]["service_comment"]=="")){echo "Reply Pending at Request Side";}
	elseif($row[0]["new_device_status"]==1 && $row[0]["final_status"]!=1){echo "Pending at Tech Support Team";}
	elseif($row[0]["final_status"]==1){echo "Process Done";}?></strong></td></tr>

<tr><td>Account Comment</td>  <td><?echo $row[0]["account_comment"];?></td></tr>
 <tr><td>Service Comment</td>  <td><?echo $row[0]["service_comment"];?></td></tr>
<tr><td>Support Comment</td><td><?echo $row[0]["support_comment"];?></td></tr>
<tr><td>Admin Comment</td><td><?echo $row[0]["admin_comment"];?></td></tr>

<tr><td>Closed Date</td><td><?
if($row[0]["final_status"]==1)
{
echo date("d-M-Y h:i:s A",strtotime($row[0]["close_date"]));
}
else
{
	echo "";
}

?></td></tr>

	</table>
	</div> 
	</div> 

<? }
elseif($tablename=="device_change")
		{
	$query = "SELECT * FROM ".$tablename." where id=".$RowId;
			$row=select_query($query);
	?>
	
	
	<div id="databox">
<div class="heading">
	View Device Change</div>
	<div class="dataleft">
<table cellspacing="2" cellpadding="2">	 
     
     
<tr><td>Date</td><td><?echo $row[0]["date"];?></td></tr>
<tr><td>Account Manager</td><td><?echo $row[0]["sales_manager"];?></td></tr>
<tr><td>Company</td><td><?echo $row[0]["client"];?></td></tr>
<? $sql="SELECT Userid AS id,UserName AS sys_username FROM addclient  WHERE Userid=".$row[0]["user_id"];
	$rowuser=select_query($sql);
	?>
<tr><td>Client User Name 	</td><td><?echo $rowuser[0]["sys_username"];?></td></tr>
<tr><td>Device Model</td><td><?echo $row[0]["device_model"];?></td></tr>
<tr><td>Device IMEI</td><td><?echo $row[0]["device_imei"];?></td></tr>
<tr><td>Veh Num</td><td><?echo $row[0]["reg_no"];?></td></tr>
<tr><td>Mobile Number</td><td><?echo $row[0]["mobile_no"];?></td></tr>
<? $sql="SELECT Userid AS id,UserName AS sys_username FROM addclient  WHERE Userid=".$row[0]["rdd_username"];
	$rowuser_old=select_query($sql);
	?>
<tr><td><strong>Replaced Device Details</strong></td><td>---------------------------</td></tr>
<tr><td>Client User</td><td><?echo $rowuser_old[0]["sys_username"];?></td></tr>
<tr><td>Client Name</td><td><?echo $row[0]["rdd_companyname"];?></td></tr>
<tr><td>Device Type</td><td><?echo $row[0]["rdd_device_type"];?></td></tr>
<tr><td>Device Model</td><td><?echo $row[0]["rdd_device_model"];?></td></tr>
<tr><td>Vehicle No</td><td><?echo $row[0]["rdd_reg_no"];?></td></tr>
<tr><td>IMEI</td><td><?echo $row[0]["rdd_device_imei"];?></td></tr>
<tr><td>Device ID</td><td><?echo $row[0]["rdd_device_id"];?></td></tr>
<tr><td>Mobile Number</td><td><?echo $row[0]["rdd_device_mobile_num"];?></td></tr>
<tr><td>Date of installation </td><td><?echo $row[0]["rdd_date_replace"];?></td></tr>
<tr><td>Replace Date</td><td><?echo $row[0]["rdd_date"];?></td></tr>
<tr><td colspan="2">-------------------------------------------</td> </tr></table></div>

<div class="dataright">
<table cellspacing="2" cellpadding="2">
<tr><td>Billing</td><td><?echo $row[0]["billing"];?></td></tr>
<tr><td>Billing Reason</td><td><?echo $row[0]["billing_reason"];?></td></tr>

<tr><td>Reason</td><td><?echo $row[0]["rdd_reason"];?></td></tr> 
<!--<tr><td>Admin Approval</td>  <td><?if($row[0]["approve_status"]==1) echo "Approved"; else echo "Pending Approval"?></td></tr>-->
<tr><td><strong>Process Pending </strong></td>  <td><strong>
<?  if($row[0]["device_change_status"]==2 || (($row[0]["support_comment"]!="" || $row[0]["admin_comment"]!="") && $row[0]["service_comment"]==""))
	{echo "Reply Pending at Request Side";}
	elseif($row[0]["rdd_device_imei"]=="" && $row[0]["rdd_reason"]=="" && $row[0]["approve_status"]==0){echo "Request Not Completely Generate.";}
	elseif($row[0]["account_comment"]=="" && $row[0]["pay_status"]=="" && $row[0]["rdd_reason"]!="" && $row[0]["approve_status"]==0){echo "Pending at Accounts";} 
	elseif($row[0]["approve_status"]==0 && $row[0]["forward_req_user"]!="" && $row[0]["forward_back_comment"]=="" && $row[0]["device_change_status"]==1)	
	{echo "Pending Admin Approval (Req Forward to ".$row[0]["forward_req_user"].")";}
	elseif($row[0]["approve_status"]==0 && ($row[0]["account_comment"]!="" || $row[0]["pay_status"]!="") && $row[0]["final_status"]==0 && $row[0]["device_change_status"]==1)
	{echo "Pending Admin Approval";}
	elseif($row[0]["approve_status"]==1 && $row[0]["device_change_status"]==1 && $row[0]["final_status"]!=1){echo "Pending at Tech Support Team";}
	elseif($row[0]["final_status"]==1){echo "Process Done";}?></strong></td></tr>

<tr><td>Account Comment</td>  <td><?echo $row[0]["account_comment"];?></td></tr>
<tr><td>Service Comment</td>  <td><?echo $row[0]["service_comment"];?></td></tr>
<tr><td>Support Comment</td><td><?echo $row[0]["support_comment"];?></td></tr>
<tr><td>Admin Comment</td><td><?echo $row[0]["admin_comment"];?></td></tr>
<tr><td>Req Forwarded to</td><td><?echo $row[0]["forward_req_user"];?></td></tr>
<tr><td>Forward Comment</td><td><?echo $row[0]["forward_comment"];?></td></tr>
<tr><td>F/W Request Back Comment</td><td><?echo $row[0]["forward_back_comment"];?></td></tr>
<tr><td>Approval Date</td><td><?
if($row[0]["approve_status"]==1 && $row[0]["approve_date"]!='')
{
echo date("d-M-Y h:i:s A",strtotime($row[0]["approve_date"]));
}
else
{
	echo "";
}

?></td></tr>
<?php if($row[0]["close_comment"]!=""){?>
<tr><td>Duplicate Close Reason</td><td><?echo $row[0]["close_comment"];?></td></tr>
<?php } ?>
<tr><td>Closed Date</td><td><?
if($row[0]["final_status"]==1)
{
echo date("d-M-Y h:i:s A",strtotime($row[0]["close_date"]));
}
else
{
	echo "";
}

?></td></tr>
	</table>
	</div> 
	</div>

	<? }


	else If($tablename=="stop_gps")
		{
		  $query = "SELECT * FROM ".$tablename." where id=".$RowId; 
			$row=select_query($query);
	?>
	
	<div > <div id="databox">
<div class="heading">Stop Gps</div>
<div class="dataleft"><table cellspacing="2" cellpadding="2">
    <tbody> 

	
	 

<tr><td>Date 	</td><td><?echo $row[0]["date"];?></td></tr>
<tr><td>Account Manager 	</td><td><?echo $row[0]["acc_manager"];?></td></tr>
<? $sql="SELECT Userid AS id,UserName AS sys_username FROM addclient  WHERE Userid=".$row[0]["client"];
	$rowuser=select_query($sql);
	?>
<tr><td>Client User Name 	</td><td><?echo $rowuser[0]["sys_username"];?></td></tr>
<tr><td>Company Name 	</td><td><?echo $row[0]["company"];?></td></tr>
<tr><td>Total No Of Vehicle 	</td><td><?echo $row[0]["tot_no_of_vehicle"];?></td></tr>
<tr><td>Vehicle to Stop GPS </td><td><?echo $row[0]["no_of_vehicle"];?></td></tr>
<tr><td>Persent Status Of</td><td>:---</td></tr>
<tr><td>Location 	</td><td><?echo $row[0]["ps_of_location"];?></td></tr>
<tr><td>OwnerShip 	</td><td><?echo $row[0]["ps_of_ownership"];?></td></tr>
<tr><td>Reason 	</td><td><?echo $row[0]["reason"];?></td></tr>
<tr><td colspan="2">-------------------------------------------</td> </tr>
</tbody></table></div>
 <div class="dataright">
<table cellspacing="2" cellpadding="2"><tbody>
 <!--<tr><td>Admin Approval</td>  <td><?if($row[0]["approve_status"]==1) echo "Approved"; else echo "Pending Approval"?></td></tr>-->
<tr><td><strong>Process Pending </strong></td>  <td><strong>
<?  if($row[0]["stop_gps_status"]==2 || (($row[0]["support_comment"]!="" || $row[0]["admin_comment"]!="") && $row[0]["sales_comment"]==""))
	{echo "Reply Pending at Request Side";}
	elseif($row[0]["account_comment"]=="" && $row[0]["total_pending"]=="" && $row[0]["approve_status"]==0 && $row[0]["final_status"]==0){echo "Pending at Accounts";} 
	elseif($row[0]["approve_status"]==0 && $row[0]["forward_req_user"]!="" && $row[0]["forward_back_comment"]=="" && $row[0]["stop_gps_status"]==1)	
	{echo "Pending Admin Approval (Req Forward to ".$row[0]["forward_req_user"].")";}
	elseif($row[0]["approve_status"]==0 && ($row[0]["account_comment"]!="" || $row[0]["total_pending"]!="") && $row[0]["final_status"]==0 && $row[0]["stop_gps_status"]==1)
	{echo "Pending Admin Approval";}
	elseif($row[0]["approve_status"]==1 && $row[0]["stop_gps_status"]==1 && $row[0]["final_status"]!=1){echo "Pending at Tech Support Team";}
	elseif($row[0]["final_status"]==1){echo "Process Done";}?></strong></td></tr>

<tr><td>Account Comment</td>  <td><?echo $row[0]["account_comment"];?></td></tr>
 <tr><td>Payment Pending</td>  <td><?echo $row[0]["total_pending"];?></td></tr>
<tr><td>Sales Comment</td>  <td><?echo $row[0]["sales_comment"];?></td></tr>
<tr><td>Support Comment</td><td><?echo $row[0]["support_comment"];?></td></tr>
<tr><td>Admin Comment</td><td><?echo $row[0]["admin_comment"];?></td></tr>

<tr><td>Closed Date</td><td><?
if($row[0]["final_status"]==1)
{
echo date("d-M-Y h:i:s A",strtotime($row[0]["close_date"]));
}
else
{
	echo "";
}

?></td></tr>
</tbody>
	</table>
	</div> 
	</div> 

<? }


	else If($tablename=="start_gps")
		{
		  $query = "SELECT * FROM ".$tablename." where id=".$RowId; 
			$row=select_query($query);
	?>
	
	<div id="databox">
<div class="heading">Start Gps</div>
<div class="dataleft"><table cellspacing="2" cellpadding="2">
    <tbody> 
<tr><td>Date 	</td><td><?echo date("d-M-Y h:i:s A",strtotime($row[0]["date"]));?></td></tr>
<tr><td>Request By</td><td><?echo $row[0]["acc_manager"];?></td></tr>
<tr><td>Account Manager</td><td><?echo $row[0]["sales_manager"];?></td></tr>
<? $sql="SELECT Userid AS id,UserName AS sys_username FROM addclient  WHERE Userid=".$row[0]["client"];
	$rowuser=select_query($sql);
	?>
<tr><td>Client User Name 	</td><td><?echo $rowuser[0]["sys_username"];?></td></tr>
<tr><td>Company Name 	</td><td><?echo $row[0]["company"];?></td></tr>
<tr><td>Total No Of Vehicle 	</td><td><?echo $row[0]["tot_no_of_vehicle"];?></td></tr>
<tr><td>Persent Status Of</td><td>:---</td></tr>
<tr><td>OwnerShip 	</td><td><?echo $row[0]["ps_of_ownership"];?></td></tr>
<tr><td>Reason 	</td><td><?echo $row[0]["reason"];?></td></tr>
<tr><td>Vehicle to Start GPS </td><td><?php $vechile_no = explode(",",$row[0]["reg_no"]); 
for($i=0;$i<=count($vechile_no);$i++){ if($i%3!=0){ echo $vechile_no[$i].", ";}else { echo "<br/>".$vechile_no[$i].", ";} }?></td></tr>

</tbody></table></div>

<div class="dataright">
<table cellspacing="2" cellpadding="2"><tbody>
 <!--<tr><td>Admin Approval</td>  <td><?if($row[0]["approve_status"]==1) echo "Approved"; else echo "Pending Approval"?></td></tr>-->
<tr><td><strong>Process Pending </strong></td>  <td><strong>
<?  if($row[0]["start_gps_status"]==2 || (($row[0]["support_comment"]!="" || $row[0]["admin_comment"]!="") && $row[0]["sales_comment"]==""))
	{echo "Reply Pending at Request Side";}
	elseif($row[0]["account_comment"]=="" && $row[0]["total_pending"]=="" && $row[0]["approve_status"]==0 && $row[0]["final_status"]==0){echo "Pending at Accounts";} 
	elseif($row[0]["approve_status"]==0 && ($row[0]["account_comment"]!="" || $row[0]["total_pending"]!="") && $row[0]["forward_req_user"]!="" && $row[0]["forward_back_comment"]=="" && $row[0]["start_gps_status"]==1)	{echo "Pending Admin Approval (Req Forward to ".$row[0]["forward_req_user"].")";}
	elseif($row[0]["approve_status"]==0 && ($row[0]["account_comment"]!="" || $row[0]["total_pending"]!="") && $row[0]["final_status"]==0 && $row[0]["start_gps_status"]==1)
	{echo "Pending Admin Approval";}
	elseif($row[0]["approve_status"]==1 && $row[0]["start_gps_status"]==1 && $row[0]["final_status"]!=1){echo "Pending at Tech Support Team";}
	elseif($row[0]["final_status"]==1){echo "Process Done";}?></strong></td></tr>

<tr><td>Account Comment</td>  <td><?echo $row[0]["account_comment"];?></td></tr>
<tr><td>Payment Pending</td>  <td><?echo $row[0]["total_pending"];?></td></tr>
<tr><td>Sales Comment</td>  <td><?echo $row[0]["sales_comment"];?></td></tr>
<tr><td>Support Comment</td><td><?echo $row[0]["support_comment"];?></td></tr>
<tr><td>Admin Comment</td><td><?echo $row[0]["admin_comment"];?></td></tr>
<tr><td>Req Forwarded to</td><td><?echo $row[0]["forward_req_user"];?></td></tr>
<tr><td>Forward Comment</td><td><?echo $row[0]["forward_comment"];?></td></tr>
<tr><td>F/W Request Back Comment</td><td><?echo $row[0]["forward_back_comment"];?></td></tr>
<tr><td>Approval Date</td><td><?
if($row[0]["approve_status"]==1 && $row[0]["approve_date"]!='')
{
echo date("d-M-Y h:i:s A",strtotime($row[0]["approve_date"]));
}
else
{
	echo "";
}

?></td></tr>
<tr><td>Closed Date</td><td><?
if($row[0]["final_status"]==1 && $row[0]["close_date"]!='')
{
echo date("d-M-Y h:i:s A",strtotime($row[0]["close_date"]));
}
else
{
	echo "";
}

?></td> 
	</tr></tbody>
	</table>
	</div> 
	</div> 
	
	<? }
	else If($tablename=="dimts_imei")
		{
		 $query = "SELECT * FROM ".$tablename." where id=".$RowId; 
			$row=select_query($query);

 
  
	?>
	<div id="databox">
<div class="heading">View Dimts IMEI Details</div>
<div class="dataleft"><table cellspacing="2" cellpadding="2">
    <tbody> 
 
<tr><td>Date </td><td><?echo $row[0]["date"];?></td></tr> 	
<tr><td>Sales Manager </td><td><?echo $row[0]["sales_manager"];?></td></tr> 	
<? $sql="SELECT Userid AS id,UserName AS sys_username FROM addclient  WHERE Userid=".$row[0]["user_id"];
	$rowuser=select_query($sql);
	?>
<tr><td>User Name 	</td><td><?echo $rowuser[0]["sys_username"];?></td></tr>	
<tr><td>Company Name </td><td><?echo $row[0]["client"];?></td></tr>		
<tr><td>Vehicle No</td><td><?echo $row[0]["veh_reg"];?></td></tr>	 	
<tr><td>7 digit IMEI </td><td><?echo $row[0]["device_imei_7"];?></td></tr>	
<tr><td>15 digit IMEI</td><td><?echo $row[0]["device_imei_15"];?></td></tr>
<tr><td>Changed to Port</td><td><?echo $row[0]["port_change"];?></td></tr>

 <tr><td colspan="2">-------------------------------------------</td> </tr>

</tbody></table></div>
 
<div class="dataright">
<table cellspacing="2" cellpadding="2"><tbody>
<!-- <tr><td>Admin Approval</td>  <td><?if($row[0]["approve_status"]==1) echo "Approved"; else echo "Pending Approval"?></td></tr>-->
<tr><td><strong>Process Pending </strong></td>  <td><strong>
<?  if($row[0]["dimts_status"]==2 || (($row[0]["imei_upload_reason"]!="" || $row[0]["admin_comment"]!="") && $row[0]["support_comment"]=="" && $row[0]["service_comment"]==""))
	{echo "Reply Pending at Request Side";}
	elseif($row[0]["account_comment"]=="" && $row[0]["payment_status"]=="" && $row[0]["approve_status"]==0 && $row[0]["final_status"]==0){echo "Pending at Accounts";} 
	elseif($row[0]["approve_status"]==0 && $row[0]["forward_req_user"]!="" && $row[0]["forward_back_comment"]=="" && $row[0]["dimts_status"]==1)	
	{echo "Pending Admin Approval (Req Forward to ".$row[0]["forward_req_user"].")";}
	elseif($row[0]["approve_status"]==0 && $row[0]["payment_status"]!="" && $row[0]["final_status"]==0 && $row[0]["dimts_status"]==1)
	{echo "Pending Admin Approval";}
	elseif(($row[0]["approve_status"]==1 || $row[0]["account_comment"]!="") && $row[0]["dimts_status"]==1 && $row[0]["support_comment"]=="" && $row[0]["final_status"]!=1){echo "Pending at Tech Support for IMEI Uplode";}
	elseif(($row[0]["approve_status"]==1 || $row[0]["account_comment"]!="") && $row[0]["dimts_status"]==1 && $row[0]["repair_comment"]=="" && $row[0]["final_status"]!=1){echo "Pending at Repair For Port Change";}
	elseif($row[0]["support_comment"]!="" && $row[0]["repair_comment"]!="" && $row[0]["final_status"]!=1){echo "Process Not Closed Request End";}
	elseif($row[0]["final_status"]==1){echo "Process Done";}?></strong></td></tr>
 
 <tr><td>Admin Comment</td><td><?echo $row[0]["admin_comment"];?></td></tr>
<tr><td>Account Comment</td>  <td><?echo $row[0]["account_comment"];?></td></tr>
 <tr><td>Payment Pending</td>  <td><?echo $row[0]["payment_status"];?></td></tr>
<tr><td>Sales Comment</td>  <td><?echo $row[0]["service_comment"];?></td></tr>
<tr><td>Support Comment</td><td><?echo $row[0]["support_comment"];?></td></tr>
<tr><td>Admin Comment</td><td><?echo $row[0]["admin_comment"];?></td></tr>

<tr><td>Closed Date</td><td><?
if($row[0]["final_status"]==1)
{
echo date("d-M-Y h:i:s A",strtotime($row[0]["close_date"]));
}
else
{
	echo "";
}

?></td></tr></tbody>

	</table>
	</div> 
	</div> 
	

	<? }
	else If($tablename=="no_bills")
		{
		  $query = "SELECT * FROM ".$tablename." where id=".$RowId; 
			$row=select_query($query);
            
            
	?><div id="databox">
<div class="heading">No Bills</div>
<div class="dataleft"><table cellspacing="2" cellpadding="2">
    <tbody> 


<tr><td>Date 	</td><td><?echo $row[0]["date"];?></td></tr>
<tr><td>Account Manager 	</td><td><?echo $row[0]["acc_manager"];?></td></tr>
<? $sql="SELECT Userid AS id,UserName AS sys_username FROM addclient  WHERE Userid=".$row[0]["client"];
	$rowuser=select_query($sql);
	?>
<tr><td>Client User Name 	</td><td><?echo $rowuser[0]["sys_username"];?></td></tr>
<tr><td>Company Name 	</td><td><?echo $row[0]["company_name"];?></td></tr>
<tr><td>Vehicle Num</td><td><?echo $row[0]["reg_no"];?></td></tr>
<tr><td>Total no of Vehicles </td><td><?echo $row[0]["tot_no_of_vehicles"];?></td></tr>
<tr><td>Vehicles for No Bill</td><td><?echo $row[0]["veh_no_bill"];?></td></tr>
<tr><td>No Bill For	</td><td><?echo $row[0]["rent_device"];?></td></tr> 
<tr><td>Reason	</td><td><?echo $row[0]["reason"];?></td></tr> 
<tr><td>Provision Bill	</td><td><?echo $row[0]["provision_bill"];?></td></tr>
<tr><td>Duration for Provision Bill	</td><td><?echo $row[0]["duration"];?></td></tr> 
<tr><td colspan="2">-------------------------------------------</td> </tr>
</tbody></table></div>
<div class="dataright">
<table cellspacing="2" cellpadding="2"><tbody>
 <!--<tr><td>Admin Approval</td>  <td><?if($row[0]["approve_status"]==1) echo "Approved"; else echo "Pending Approval"?></td></tr>-->
<tr><td><strong>Process Pending </strong></td>  <td><strong>
<?  if($row[0]["no_bill_status"]==2 || (($row[0]["support_comment"]!="" || $row[0]["admin_comment"]!="") && $row[0]["sales_comment"]==""))
	{echo "Reply Pending at Request Side";}
	elseif(($row[0]["no_bill_issue"]=="Software Issue" && $row[0]["support_comment"]=="") || $row[0]["approve_status"]==1 && $row[0]["no_bill_status"]==1 && $row[0]["final_status"]!=1){echo "Pending at Tech Support Team";}
	elseif($row[0]["no_bill_issue"]=="Service Issue" && $row[0]["no_bill_status"]==1 && $row[0]["approve_status"]!=1 && $row[0]["service_comment"]=="")
	{echo "Pending at Service Team";}
	elseif($row[0]["account_comment"]=="" && $row[0]["total_pending"]=="" && $row[0]["approve_status"]==0 && $row[0]["final_status"]==0){echo "Pending at Accounts";} 
	elseif($row[0]["approve_status"]==0 && $row[0]["forward_req_user"]!="" && $row[0]["forward_back_comment"]=="" && $row[0]["no_bill_status"]==1)	
	{echo "Pending Admin Approval (Req Forward to ".$row[0]["forward_req_user"].")";}
	elseif($row[0]["approve_status"]==0 && ($row[0]["account_comment"]!="" || $row[0]["total_pending"]!="") && $row[0]["final_status"]==0 && $row[0]["no_bill_status"]==1)
	{echo "Pending Admin Approval";}
	elseif($row[0]["final_status"]==1){echo "Process Done";}?></strong></td></tr>
 
<tr><td>Account Comment</td>  <td><?echo $row[0]["account_comment"];?></td></tr>
 <tr><td>Payment Pending</td>  <td><?echo $row[0]["total_pending"];?></td></tr>
<tr><td>Sales Comment</td>  <td><?echo $row[0]["sales_comment"];?></td></tr>
<tr><td>Support Comment</td><td><?echo $row[0]["support_comment"];?></td></tr>
<tr><td>Admin Comment</td><td><?echo $row[0]["admin_comment"];?></td></tr>

<tr><td>Closed Date</td><td><?
if($row[0]["final_status"]==1)
{
echo date("d-M-Y h:i:s A",strtotime($row[0]["close_date"]));
}
else
{
	echo "";
}

?></td></tr></tbody>

	</table>
	</div> 
	</div> 

	<? }
      
 
    else If($tablename=="discount_details")
		{
		  $query = "SELECT * FROM ".$tablename." where id=".$RowId; 
			$row=select_query($query);
            
	?><div id="databox">
<div class="heading">Discount</div>
<div class="dataleft"><table cellspacing="2" cellpadding="2">
    <tbody> 

<tr><td>Date 	</td><td><?echo $row[0]["date"];?></td></tr>
<tr><td>Account Manager 	</td><td><?echo $row[0]["acc_manager"];?></td></tr>
<? $sql="SELECT Userid AS id,UserName AS sys_username FROM addclient  WHERE Userid=".$row[0]["user"];
	$rowuser=select_query($sql);
	?>
<tr><td>Client User Name 	</td><td><?echo $rowuser[0]["sys_username"];?></td></tr>
<tr><td>Company Name 	</td><td><?echo $row[0]["client"];?></td></tr>
<!--<tr><td>Vehicle	for discount</td><td><?echo $row[0]["reg_no"];?></td></tr>-->
<tr><td>Vehicle	for discount </td><td><?php $vechile_no = explode(",",$row[0]["reg_no"]); 
for($i=0;$i<=count($vechile_no);$i++){ if($i%3!=0){ echo $vechile_no[$i].", ";}else { echo "<br/>".$vechile_no[$i].", ";} }?></td></tr>

<tr><td>Discount For</td><td><?echo $row[0]["rent_device"];?></td></tr>
<tr><td>Month</td><td><?echo $row[0]["mon_of_dis_in_case_of_rent"];?></td></tr>
<tr><td>Discount Amount 	</td><td><?echo $row[0]["dis_amt"];?></td></tr>
<tr><td>After Discount 	</td><td><?echo $row[0]["amt_rec_after_dis"];?></td></tr>
<tr><td>Before Discount 	</td><td><?echo $row[0]["amt_before_dis"];?></td></tr>
<tr><td>Reason	</td><td><?echo $row[0]["reason"];?></td></tr> 
<tr><td>Service Action</td><td><?echo $row[0]["service_action"];?></td></tr>  
<tr><td colspan="2">-------------------------------------------</td> </tr>
</tbody></table></div>
 <div class="dataright">
<table cellspacing="2" cellpadding="2"><tbody>
 <!--<tr><td>Admin Approval</td>  <td><?if($row[0]["approve_status"]==1) echo "Approved"; else echo "Pending Approval"?></td></tr>-->
<tr><td><strong>Process Pending </strong></td>  <td><strong>
<?  if($row[0]["discount_status"]==2 || (($row[0]["support_comment"]!="" || $row[0]["admin_comment"]!="") && $row[0]["sales_comment"]==""))
	{echo "Reply Pending at Request Side";}
	elseif($row[0]["discount_issue"]=="Software Issue" && $row[0]["approve_status"]==0 && $row[0]["software_comment"]=="" && $row[0]["forward_req_user"]!="" && $row[0]["forward_back_comment"]=="" && $row[0]["discount_status"]==1){echo "Pending at Tech Support Login (Req Forward to ".$row[0]["forward_req_user"].")";}
	elseif($row[0]["discount_issue"]=="Software Issue" && $row[0]["discount_status"]==1 && $row[0]["approve_status"]!=1 && $row[0]["software_comment"]=="")
	{echo "Pending at Tech Support Login";}
	elseif($row[0]["discount_issue"]=="Repair Cost Issue" && $row[0]["discount_status"]==1 && $row[0]["approve_status"]!=1 && $row[0]["repair_comment"]=="")
	{echo "Pending at Repair Login";}
	elseif($row[0]["discount_issue"]=="Service Issue" && $row[0]["discount_status"]==1 && $row[0]["approve_status"]!=1 && $row[0]["service_comment"]=="")
	{echo "Pending at Service Support Login";}	
	elseif($row[0]["discount_status"]==1 && $row[0]["account_comment"]=="" && $row[0]["total_pending"]=="" && $row[0]["approve_status"]!=1){echo "Pending at Account Login";}	
	elseif($row[0]["approve_status"]==0 && $row[0]["forward_req_user"]!="" && $row[0]["forward_back_comment"]=="" && $row[0]["discount_status"]==1)	
	{echo "Pending Admin Approval (Req Forward to ".$row[0]["forward_req_user"].")";}
	elseif($row[0]["approve_status"]==0 && ($row[0]["account_comment"]!="" || $row[0]["total_pending"]!="") && $row[0]["final_status"]==0 && $row[0]["discount_status"]==1)
	{echo "Pending Admin Approval";}		
	elseif($row[0]["approve_status"]==1 && $row[0]["final_status"]==0){echo "Pending at Account For Discounting";} 
	elseif($row[0]["final_status"]==1){echo "Process Done";}?></strong></td></tr>

<tr><td>Account Comment</td>  <td><?echo $row[0]["account_comment"];?></td></tr>
 <tr><td>Payment Pending</td>  <td><?echo $row[0]["total_pending"];?></td></tr>
 <tr><td>Sales Comment</td>  <td><?echo $row[0]["sales_comment"];?></td></tr>
<tr><td>Service Comment</td><td><?echo $row[0]["service_comment"];?></td></tr>
<tr><td>Software Comment</td><td><?echo $row[0]["software_comment"];?></td></tr>
<tr><td>Repair Comment</td><td><?echo $row[0]["repair_comment"];?></td></tr>
<tr><td>Admin Comment</td><td><?echo $row[0]["admin_comment"];?></td></tr>


<tr><td>Closed Date</td><td><?
if($row[0]["final_status"]==1)
{
echo date("d-M-Y h:i:s A",strtotime($row[0]["close_date"]));
}
else
{
	echo "";
}

?></td></tr></tbody>
	</table>
	</div> 
	</div> 

	<? }
	elseIf($tablename=="sub_user_creation")
		{

		  $query = "SELECT * FROM ".$tablename." where id=".$RowId; 
			$row=select_query($query);

	?><div > <div style=" padding-left: 50px;">
	<h1>Sub User Creation
</h1> </div>
	<div class="table">
	<table cellspacing="2" cellpadding="2" style=" padding-left: 100px;width: 500px;">
	 
 <tr><td>Date	</td><td><?echo $row[0]["date"];?></td></tr>
<tr><td>Account Manager 	</td><td><?echo $row[0]["acc_manager"];?></td></tr>
<? $sql="SELECT Userid AS id,UserName AS sys_username FROM addclient  WHERE Userid=".$row[0]["main_user_id"];
	$rowuser=select_query($sql);
	?>
<tr><td>Client User Name 	</td><td><?echo $rowuser[0]["sys_username"];?></td></tr>

 <tr><td>Company Name 	</td><td><?echo $row[0]["company"];?></td></tr>
<tr><td>Total No Of Vehicle 	</td><td><?echo $row[0]["tot_no_of_vehicles"];?></td></tr>
<tr><td>Vehicle to move 	</td><td><?echo $row[0]["reg_no_of_vehicle_to_move"];?></td></tr>
<tr><td>Contact Person 	</td><td><?echo $row[0]["contact_person"];?></td></tr>
<tr><td>Contact Number 	</td><td><?echo $row[0]["contact_number"];?></td></tr>
<tr><td>Sub-User Name 	</td><td><?echo $row[0]["name"];?></td></tr>
<tr><td>Password</td><td><?echo $row[0]["req_sub_user_pass"];?></td></tr>
<tr><td>Main User Separate</td><td><?echo $row[0]["billing_separate"];?></td></tr>
<tr><td>Billing Name</td><td><?echo $row[0]["billing_name"];?></td></tr>
<tr><td>Billing Address</td><td><?echo $row[0]["billing_address"];?></td></tr>
<tr><td>Reason</td><td><?echo $row[0]["reason"];?></td></tr> 
<tr><td colspan="2">-------------------------------------------</td> </tr>
 <!--<tr><td>Admin Approval</td>  <td><?if($row[0]["approve_status"]==1) echo "Approved"; else echo "Pending Approval"?></td></tr>-->
<tr><td><strong>Process Pending </strong></td>  <td><strong>
<?  if($row[0]["sub_user_status"]==2 || (($row[0]["support_comment"]!="" || $row[0]["admin_comment"]!="") && $row[0]["sales_comment"]==""))
	{echo "Reply Pending at Request Side";}
	elseif($row[0]["approve_status"]==0 && $row[0]["forward_req_user"]!="" && $row[0]["forward_back_comment"]=="" && $row[0]["sub_user_status"]==1)	
	{echo "Pending Admin Approval (Req Forward to ".$row[0]["forward_req_user"].")";}
	elseif($row[0]["approve_status"]==0 && $row[0]["final_status"]==0 && $row[0]["sub_user_status"]==1){echo "Pending Admin Approval";}
	elseif($row[0]["approve_status"]==1 && $row[0]["sub_user_status"]==1 && $row[0]["final_status"]!=1){echo "Pending at Tech Support Team";}
	elseif($row[0]["final_status"]==1){echo "Process Done";}?></strong></td></tr>

<tr><td>Account Comment</td>  <td><?echo $row[0]["account_comment"];?></td></tr>
<tr><td>Sales Comment</td>  <td><?echo $row[0]["sales_comment"];?></td></tr>
<tr><td>Support Comment</td><td><?echo $row[0]["support_comment"];?></td></tr>
<tr><td>Admin Comment</td><td><?echo $row[0]["admin_comment"];?></td></tr>


<tr><td>Closed Date</td><td><?
if($row[0]["final_status"]==1)
{
echo date("d-M-Y h:i:s A",strtotime($row[0]["close_date"]));
}
else
{
	echo "";
}

?></td></tr>
	</table>
	</div> 
	</div> 
<? }


	else If($tablename=="deactivate_sim")
		{
		  $query = "SELECT * FROM ".$tablename." where id=".$RowId; 
			$row=select_query($query);
	?><div id="databox">
<div class="heading">Deactivate SIM</div>
<div class="dataleft"><table cellspacing="2" cellpadding="2">
<tr><td>Date</td><td><?echo $row[0]["date"];?></td></tr>
<tr><td>Account Manager</td><td><?echo $row[0]["acc_manager"];?></td></tr>
<? $sql="SELECT Userid AS id,UserName AS sys_username FROM addclient  WHERE Userid=".$row[0]["user_id"];
	$rowuser=select_query($sql);
	?>
<tr><td>Client User Name 	</td><td><?echo $rowuser[0]["sys_username"];?></td></tr>
<tr><td>Company</td><td><?echo $row[0]["client"];?></td></tr>

<tr><td>Veh Num</td><td><?echo $row[0]["vehicle"];?></td></tr>

<tr><td>Device Model</td><td><?echo $row[0]["device_model"];?></td></tr>
<tr><td>Device IMEI</td><td><?echo $row[0]["device_imei"];?></td></tr>
<tr><td>Mobile Number</td><td><?echo $row[0]["device_sim"];?></td></tr>
<tr><td><strong>Present Status of Device</strong></td><td>---------------------------</td></tr>
<tr><td>Location</td><td><?echo $row[0]["ps_of_location"];?></td></tr>
<tr><td>Ownership</td><td><?echo $row[0]["ps_of_ownership"];?></td></tr>
<tr><td>Payment Status</td><td><?echo $row[0]["payment_status"];?></td></tr>
<tr><td>SIM Status</td><td><?echo $row[0]["sim_status"];?></td></tr>
<tr><td>Change Date</td><td><?echo $row[0]["change_date"];?></td></tr>
<tr><td>Reason</td><td><?echo $row[0]["replace_date"];?></td></tr>
<tr><td colspan="2">-------------------------------------------</td> </tr></table></div>
<div class="dataright">
<table cellspacing="2" cellpadding="2"><tbody>

<!--<tr><td>Admin Approval</td>  <td><?if($row[0]["approve_status"]==1) echo "Approved"; else echo "Pending Approval"?></td></tr>-->
<tr><td><strong>Process Pending </strong></td>  <td><strong>
<?  if($row[0]["account_comment"]=="" && $row[0]["final_status"]==0){echo "Pending at Accounts";} 
	elseif($row[0]["final_status"]==1){echo "Process Done";}?></strong></td></tr>
 
<tr><td>Account Comment</td>  <td><?echo $row[0]["account_comment"];?></td></tr>
<tr><td>Support Comment</td><td><?echo $row[0]["support_comment"];?></td></tr>
<tr><td>Service Comment</td>  <td><?echo $row[0]["service_comment"];?></td></tr>
<tr><td>Admin Comment</td><td><?echo $row[0]["admin_comment"];?></td></tr>
<tr><td>Closed Date</td><td><?
if($row[0]["final_status"]==1)
{
echo date("d-M-Y h:i:s A",strtotime($row[0]["close_date"]));
}
else
{
	echo "";
}

?></td></tr></tbody></table></div></div>
 

	<? }
	else If($tablename=="deactivation_of_account")
		{
		 $query = "SELECT * FROM ".$tablename." where id=".$RowId; 
			$row=select_query($query);


  ?><div id="databox">
<div class="heading">Deactivation Of Account</div>
<div class="dataleft"><table cellspacing="2" cellpadding="2">
    <tbody> 
	 
<tr><td>Date </td><td><?echo $row[0]["date"];?></td></tr> 	
<tr><td>Account Manager </td><td><?echo $row[0]["acc_manager"];?></td></tr> 	
<? $sql="SELECT Userid AS id,UserName AS sys_username FROM addclient  WHERE Userid=".$row[0]["user_id"];
	$rowuser=select_query($sql);
	?>
<tr><td>Client User Name 	</td><td><?echo $rowuser[0]["sys_username"];?></td></tr>	
<tr><td>Company Name </td><td><?echo $row[0]["company"];?></td></tr> 	
<tr><td>Total No Of Vehicle </td><td><?echo $row[0]["total_no_of_vehicles"];?></td></tr> 	
<tr><td>Deactivate </td><td><?echo $row[0]["deactivate_temp"];?></td></tr> 
<tr><td>Reason</td><td><?echo $row[0]["reason"];?></td></tr> 

<tr><td colspan="2">-------------------------------------------</td> </tr>
</tbody></table></div>
 
<div class="dataright">
<table cellspacing="2" cellpadding="2"><tbody>


<tr><td>Pending Amount</td>  <td><?echo $row[0]["pay_pending"];?></td></tr>

 <!--<tr><td>Admin Approval</td>  <td><?if($row[0]["approve_status"]==1) echo "Approved"; else echo "Pending Approval"?></td></tr>-->
<tr><td><strong>Process Pending </strong></td>  <td><strong>
<?  if($row[0]["deactivation_status"]==2 || (($row[0]["support_comment"]!="" || $row[0]["admin_comment"]!="") && $row[0]["sales_comment"]==""))
	{echo "Reply Pending at Request Side";}
	elseif($row[0]["device_remove_status"]=="Y" && $row[0]["no_of_removed_devices"]=="" && $row[0]["approve_status"]==0 && $row[0]["final_status"]==0){echo "Pending at Stock";} 
	elseif($row[0]["account_comment"]=="" && $row[0]["pay_pending"]=="" && $row[0]["approve_status"]==0 && $row[0]["final_status"]==0){echo "Pending at Accounts";} 
	elseif($row[0]["approve_status"]==0 && $row[0]["forward_req_user"]!="" && $row[0]["forward_back_comment"]=="" && $row[0]["deactivation_status"]==1)	
	{echo "Pending Admin Approval (Req Forward to ".$row[0]["forward_req_user"].")";}
	elseif($row[0]["approve_status"]==0 && ($row[0]["account_comment"]!="" || $row[0]["pay_pending"]!="") && $row[0]["final_status"]==0 && $row[0]["deactivation_status"]==1)
	{echo "Pending Admin Approval";}
	elseif($row[0]["approve_status"]==1 && $row[0]["deactivation_status"]==1 && $row[0]["final_status"]!=1){echo "Pending at Tech Support Team";}
	elseif($row[0]["final_status"]==1){echo "Process Done";}?></strong></td></tr>

<tr><td>Account Comment</td>  <td><?echo $row[0]["account_comment"];?></td></tr>
<tr><td>Support Comment</td><td><?echo $row[0]["support_comment"];?></td></tr>
<tr><td>Sales Comment</td>  <td><?echo $row[0]["sales_comment"];?></td></tr>
<tr><td>Admin Comment</td><td><?echo $row[0]["admin_comment"];?></td></tr>

<tr><td>Closed Date</td><td><?
if($row[0]["final_status"]==1)
{
echo date("d-M-Y h:i:s A",strtotime($row[0]["close_date"]));
}
else
{
	echo "";
}

?></td></tr>
</tbody>
	</table>
	</div> 
	</div> 


	<? }
	else If($tablename=="del_form_debtors")
		{
		$query = "SELECT * FROM ".$tablename." where id=".$RowId; 
			$row=select_query($query);

	?><div id="databox">
<div class="heading">Delete From Debtors</div>
<div class="dataleft"><table cellspacing="2" cellpadding="2">
    <tbody> 
<tr><td>Date </td><td><?echo $row[0]["date"];?></td></tr> 	
<tr><td>Account Manager </td><td><?echo $row[0]["acc_manager"];?></td></tr> 	
<? $sql="SELECT Userid AS id,UserName AS sys_username FROM addclient  WHERE Userid=".$row[0]["user_id"];
	$rowuser=select_query($sql);
	?>
<tr><td>Client User Name 	</td><td><?echo $rowuser[0]["sys_username"];?></td></tr>	
<tr><td>Company Name </td><td><?echo $row[0]["company"];?></td></tr> 	
<tr><td>Total No Of Vehicle </td><td><?echo $row[0]["total_no_of_vehicle"];?></td></tr> 	
<tr><td>Date Of Creation  </td><td><?echo $row[0]["date_of_creation"];?></td></tr> 	
<tr><td>Reason</td><td><?echo $row[0]["reason"];?></td></tr> 
<tr><td colspan="2">-------------------------------------------</td> </tr>
</tbody></table></div>
 <div class="dataright">
<table cellspacing="2" cellpadding="2"><tbody>

 <!--<tr><td>Admin Approval</td>  <td><?if($row[0]["approve_status"]==1) echo "Approved"; else echo "Pending Approval"?></td></tr>-->
<tr><td><strong>Process Pending </strong></td>  <td><strong>
<?  if($row[0]["del_debtors_status"]==2 || (($row[0]["support_comment"]!="" || $row[0]["admin_comment"]!="") && $row[0]["sales_comment"]==""))
	{echo "Reply Pending at Request Side";}
	elseif($row[0]["device_remove_status"]=="Y" && $row[0]["no_device_removed"]=="" && $row[0]["approve_status"]==0 && $row[0]["final_status"]==0){echo "Pending at Stock";} 
	elseif($row[0]["account_comment"]=="" && $row[0]["total_pending"]=="" && $row[0]["approve_status"]==0 && $row[0]["final_status"]==0){echo "Pending at Accounts";} 
	elseif($row[0]["approve_status"]==0 && $row[0]["forward_req_user"]!="" && $row[0]["forward_back_comment"]=="" && $row[0]["del_debtors_status"]==1)	
	{echo "Pending Admin Approval (Req Forward to ".$row[0]["forward_req_user"].")";}
	elseif($row[0]["approve_status"]==0 && ($row[0]["account_comment"]!="" || $row[0]["total_pending"]!="") && $row[0]["final_status"]==0 && $row[0]["del_debtors_status"]==1)
	{echo "Pending Admin Approval";}
	elseif($row[0]["approve_status"]==1 && $row[0]["del_debtors_status"]==1 && $row[0]["final_status"]!=1){echo "Pending at Tech Support Team";}
	elseif($row[0]["final_status"]==1){echo "Process Done";}?></strong></td></tr>

 <tr><td>Payment Pending</td>  <td><?echo $row[0]["total_pending"];?></td></tr>
<tr><td>Account Comment</td>  <td><?echo $row[0]["account_comment"];?></td></tr>
<tr><td>Sales Comment</td>  <td><?echo $row[0]["sales_comment"];?></td></tr>
<tr><td>Support Comment</td><td><?echo $row[0]["support_comment"];?></td></tr>
<tr><td>Admin Comment</td><td><?echo $row[0]["admin_comment"];?></td></tr>


<tr><td>Closed Date</td><td><?
if($row[0]["final_status"]==1)
{
echo date("d-M-Y h:i:s A",strtotime($row[0]["close_date"]));
}
else
{
	echo "";
}

?></td></tr><br />
</tbody>

	</table>
	</div> 
	</div> 


	<? } 
	else If($tablename=="software_request")
		{
		$query = "SELECT * FROM ".$tablename." where id=".$RowId; 
			$row=select_query($query);



	?><div > <div style=" padding-left: 50px;">
	<h1>Software Request</h1> </div>
	<div class="table">
	<table cellspacing="2" cellpadding="2" style=" padding-left: 100px;width: 500px;">
	 
  

<tr><td>Date</td><td><?echo $row[0]["date"];?></td></tr>  	
<tr><td>Account Manager</td><td><?echo $row[0]["acc_manager"];?></td></tr>  	
<? $sql="SELECT Userid AS id,UserName AS sys_username FROM addclient  WHERE Userid=".$row[0]["main_user_id"];
	$rowuser=select_query($sql);
	?>
<tr><td>Client User Name 	</td><td><?echo $rowuser[0]["sys_username"];?></td></tr>	

<tr><td>Company Name</td><td><?echo $row[0]["company"];?></td></tr>  	
<tr><td>Total No Of Vehicle</td><td><?echo $row[0]["total_no_of_vehicle"];?></td></tr>  	
<tr><td>Potential</td><td><?echo $row[0]["potential"];?></td></tr>  

<tr><td>Requested Software:---</td><td></td></tr>  	

<tr><td>Google Map</td><td><?echo $row[0]["rs_google_map"];?></td></tr>  	
<tr><td>Admin </td><td><?echo $row[0]["rs_admin"];?></td></tr> 	
<tr><td><tr><td>Type Of Alert</td><td><?echo $row[0]["alert"];?></td></tr>  	
<tr><td>Other Alert/ Info</td><td><?echo $row[0]["rs_others"];?></td></tr>  	
<tr><td>Customize Report </td><td><?echo $row[0]["rs_customize_report"];?></td></tr> 	
<tr><td>Alert Contact Number</td><td><?echo $row[0]["alert_contact`"];?></td></tr>  	
<tr><td>Client Contact Number </td><td><?echo $rowuser[0]["mobile_number"];?></td></tr> 
<tr><td colspan="2">-------------------------------------------</td> </tr>

 <!--<tr><td>Admin Approval</td>  <td><?if($row[0]["approve_status"]==1) echo "Approved"; else echo "Pending Approval"?></td></tr>-->
<tr><td><strong>Process Pending </strong></td>  <td><strong>
<?  if($row[0]["software_status"]==2 || (($row[0]["support_comment"]!="" || $row[0]["admin_comment"]!="") && $row[0]["sales_comment"]==""))
	{echo "Reply Pending at Request Side";}
	elseif($row[0]["approve_status"]==0 && $row[0]["forward_req_user"]!="" && $row[0]["forward_back_comment"]=="" && $row[0]["software_status"]==1)	
	{echo "Pending Admin Approval (Req Forward to ".$row[0]["forward_req_user"].")";}
	elseif($row[0]["approve_status"]==0 && $row[0]["final_status"]==0 && $row[0]["software_status"]==1){echo "Pending Admin Approval";}
	elseif($row[0]["approve_status"]==1 && $row[0]["software_status"]==1 && $row[0]["final_status"]!=1){echo "Pending at Tech Support Team";}
	elseif($row[0]["final_status"]==1){echo "Process Done";}?></strong></td></tr>

<tr><td>Account Comment</td>  <td><?echo $row[0]["account_comment"];?></td></tr>
<tr><td>Sales Comment</td>  <td><?echo $row[0]["sales_comment"];?></td></tr>
<tr><td>Support Comment</td><td><?echo $row[0]["support_comment"];?></td></tr>
<tr><td>Admin Comment</td><td><?echo $row[0]["admin_comment"];?></td></tr>



<tr><td>Closed Date</td><td><?
if($row[0]["final_status"]==1)
{
echo date("d-M-Y h:i:s A",strtotime($row[0]["close_date"]));
}
else
{
	echo "";
}

?></td></tr>

	</table>
	</div> 
	</div> 
	<?
	}

	else If($tablename=="transfer_the_vehicle")
		{
		$query = "SELECT * FROM ".$tablename." where id=".$RowId; 
			$row=select_query($query);



	?><div id="databox">
<div class="heading">Transfer Vehicle</div>
<div class="dataleft"><table cellspacing="2" cellpadding="2">
    <tbody> 
    
 

<tr><td>Date</td><td><?echo $row[0]["date"];?></td></tr>  	
<tr><td>Account Manager </td><td><?echo $row[0]["acc_manager"];?></td></tr> 


<? $sql="SELECT Userid AS id,UserName AS sys_username FROM addclient  WHERE Userid=".$row[0]["transfer_to_user"];
	$rowuser=select_query($sql);
	?>
<tr><td>Client User Name 	</td><td><?echo $rowuser[0]["sys_username"];?></td></tr>	



 <tr><td>Company Name </td><td><?echo $row[0]["transfer_from_company"];?></td></tr> 	
<tr><td>Total No Of Vehicle </td><td><?echo $row[0]["date"];?></td></tr> 	
<tr><td>Vehicle to move </td><td><?echo $row[0]["transfer_from_reg_no"];?></td></tr> 



<tr><td>Transfer To:--</td><td> </td></tr> 
	
<? $sql="SELECT Userid AS id,UserName AS sys_username FROM addclient  WHERE Userid=".$row[0]["transfer_to_user"];
	$rowuser=select_query($sql);
	?>
<tr><td>Transfer User Name 	</td><td><?echo $rowuser[0]["sys_username"];?></td></tr>	

<tr><td>Transfer Company Name 	</td><td><?echo $row[0]["transfer_to_company"];?></td></tr> 
<tr><td>Billing</td><td><?echo $row[0]["transfer_to_billing"];?></td></tr>  	

<tr><td>Billing Name</td><td><?echo $row[0]["billing_name"];?></td></tr>  	
 	
<tr><td>Billing Address</td><td><?echo $row[0]["billing_address"];?></td></tr> 

<tr><td>Reason</td><td><?echo $row[0]["reason"];?></td></tr> 
</tbody></table></div>
 
<div class="dataright">
<table cellspacing="2" cellpadding="2"><tbody>

 <!--<tr><td>Admin Approval</td>  <td><?if($row[0]["approve_status"]==1) echo "Approved"; else echo "Pending Approval"?></td></tr>-->
<tr><td><strong>Process Pending </strong></td>  <td><strong>
<?  if($row[0]["transfer_veh_status"]==2 || (($row[0]["support_comment"]!="" || $row[0]["admin_comment"]!="") && $row[0]["sales_comment"]==""))
	{echo "Reply Pending at Request Side";}
	elseif($row[0]["account_comment"]=="" && $row[0]["total_pending"]=="" && $row[0]["approve_status"]==0 && $row[0]["final_status"]==0){echo "Pending at Accounts";} 
	elseif($row[0]["approve_status"]==0 && $row[0]["forward_req_user"]!="" && $row[0]["forward_back_comment"]=="" && $row[0]["transfer_veh_status"]==1)	
	{echo "Pending Admin Approval (Req Forward to ".$row[0]["forward_req_user"].")";}
	elseif($row[0]["approve_status"]==0 && ($row[0]["account_comment"]!="" || $row[0]["total_pending"]!="") && $row[0]["final_status"]==0 && $row[0]["transfer_veh_status"]==1)
	{echo "Pending Admin Approval";}
	elseif($row[0]["approve_status"]==1 && $row[0]["transfer_veh_status"]==1 && $row[0]["final_status"]!=1){echo "Pending at Tech Support Team";}
	elseif($row[0]["final_status"]==1){echo "Process Done";}?></strong></td></tr>

<tr><td>Account Comment</td>  <td><?echo $row[0]["account_comment"];?></td></tr>
<tr><td>Payment Pending</td>  <td><?echo $row[0]["total_pending"];?></td></tr>
<tr><td>Sales Comment</td>  <td><?echo $row[0]["sales_comment"];?></td></tr>
<tr><td>Support Comment</td><td><?echo $row[0]["support_comment"];?></td></tr>
<tr><td>Admin Comment</td><td><?echo $row[0]["admin_comment"];?></td></tr>

<tr><td>Closed Date</td><td><?
if($row[0]["final_status"]==1)
{
echo date("d-M-Y h:i:s A",strtotime($row[0]["close_date"]));
}
else
{
	echo "";
}

?></td></tr>
 

	</table>
	</div> 
	</div> 
	

	<? }


	else If($tablename=="imei_change")
		{
		  $query = "SELECT * FROM ".$tablename." where id=".$RowId; 
			$row=select_query($query);
	?><div > <div style=" padding-left: 50px;">
	<h1>IMEI Change</h1> </div>
	<div class="table">
	<table cellspacing="2" cellpadding="2" style=" padding-left: 100px;width: 500px;">
	  
<tr><td>Date</td><td><?echo $row[0]["date"];?></td></tr>
<tr><td>Account Manager</td><td><?echo $row[0]["acc_manager"];?></td></tr>
<tr><td>Company</td><td><?echo $row[0]["client"];?></td></tr>
<? $sql="SELECT Userid AS id,UserName AS sys_username FROM addclient  WHERE Userid=".$row[0]["user_id"];
	$rowuser=select_query($sql);
	?>
<tr><td>Client User Name 	</td><td><?echo $rowuser[0]["sys_username"];?></td></tr>

<tr><td>Veh Num</td><td><?echo $row[0]["vehicle"];?></td></tr>

<tr><td>Device Model</td><td><?echo $row[0]["device_model"];?></td></tr>
<tr><td>Device IMEI</td><td><?echo $row[0]["od_imei"];?></td></tr>
<tr><td>Mobile Number</td><td><?echo $row[0]["od_sim"];?></td></tr>
<tr><td>Date of installation</td><td><?echo $row[0]["date_of_installation"];?></td></tr>
<tr><td><strong>Replaced IMEI Details</strong></td><td>---------------------------</td></tr>
 
<tr><td>Device Model</td><td><?echo $row[0]["new_devicetype"];?></td></tr>
<tr><td>IMEI</td><td><?echo $row[0]["new_device_imei"];?></td></tr>
<tr><td>Device ID</td><td><?echo $row[0]["new_deviceid"];?></td></tr>
<tr><td>Mobile Number</td><td><?echo $row[0]["new_sim"];?></td></tr>
<tr><td>Replace Date</td><td><?echo $row[0]["replace_date"];?></td></tr>
<tr><td>Reason</td><td><?echo $row[0]["reason"];?></td></tr> 

 <tr><td colspan="2">-------------------------------------------</td> </tr>

 <tr><td>Admin Approval</td>  <td><?if($row[0]["approve_status"]==1) echo "Approved"; else echo "Pending Approval"?></td></tr>
<tr><td>Account Comment</td>  <td><?echo $row[0]["account_comment"];?></td></tr>
 <tr><td>Service Comment</td>  <td><?echo $row[0]["service_comment"];?></td></tr>
<tr><td>Support Comment</td><td><?echo $row[0]["support_comment"];?></td></tr>
<tr><td>Admin Comment</td><td><?echo $row[0]["admin_comment"];?></td></tr>

<tr><td>Closed Date</td><td><?
if($row[0]["final_status"]==1)
{
echo date("d-M-Y h:i:s A",strtotime($row[0]["close_date"]));
}
else
{
	echo "";
}

?></td></tr>

	
	<? }
	else If($tablename=="sim_change")
		{
		$query = "SELECT * FROM ".$tablename." where id=".$RowId; 
			$row=select_query($query);

	?><div id="databox">
<div class="heading">View Mobile Number Change</div>
<div class="dataleft"><table cellspacing="2" cellpadding="2">
    <tbody> 
<tr><td>Date </td><td><?echo $row[0]["date"];?></td></tr> 	
<tr><td>Account Manager </td><td><?echo $row[0]["acc_manager"];?></td></tr> 	
<? $sql="SELECT Userid AS id,UserName AS sys_username FROM addclient  WHERE Userid=".$row[0]["user_id"];
	$rowuser=select_query($sql);
	?>
 
<tr><td>Company Name </td><td><?echo $row[0]["client"];?></td></tr>		
<tr><td>Registration No</td><td><?echo $row[0]["reg_no"];?></td></tr>	 	
<tr><td>Old Mobile Number </td><td><?echo $row[0]["old_sim"];?></td></tr>
<tr><td>New Mobile Number </td><td><?echo $row[0]["new_sim"];?></td></tr>	
 <tr><td>Sim Change Date 	</td><td><?echo $row[0]["sim_change_date"];?></td></tr>	
<tr><td>Reason </td><td><?echo $row[0]["reason"];?></td></tr>	
    <tr><td colspan="2">-------------------------------------------</td> </tr>
</tbody></table></div>
 
<div class="dataright">
<table cellspacing="2" cellpadding="2"><tbody>
<!--<tr><td>Support Approval</td>  <td><?if($row[0]["approve_status"]==1) echo "Approved"; else echo "Pending Approval"?></td></tr>-->
<tr><td><strong>Process Pending </strong></td>  <td><strong>
<? 	if($row[0]["sim_change_status"]==2 || ($row[0]["support_comment"]!="" && $row[0]["service_comment"]==""))
		{echo "Reply Pending at Request Side";}
		elseif($row[0]["sim_change_status"]==1 && $row[0]["final_status"]!=1){echo "Pending at Tech Support Team";}
		elseif($row[0]["final_status"]==1){echo "Process Done";} 
	 ?></strong></td></tr>
    
<tr><td>Account Comment</td>  <td><?echo $row[0]["account_comment"];?></td></tr>
 <tr><td>Service Comment</td>  <td><?echo $row[0]["service_comment"];?></td></tr>
<tr><td>Support Comment</td><td><?echo $row[0]["support_comment"];?></td></tr>
<tr><td>Admin Comment</td><td><?echo $row[0]["admin_comment"];?></td></tr>

<?php if($row[0]["close_comment"]!=""){?>
<tr><td>Duplicate Close Reason</td><td><?echo $row[0]["close_comment"];?></td></tr>
<?php } ?>
<tr><td>Closed Date</td><td><?
if($row[0]["final_status"]==1)
{
echo date("d-M-Y h:i:s A",strtotime($row[0]["close_date"]));
}
else
{
	echo "";
}

?></td></tr>
</tbody>
  
	</table>
	</div> 
	</div> 


 
 
	<? } 
	else If($tablename=="device_lost")
		{
		$query = "SELECT * FROM ".$tablename." where id=".$RowId; 
			$row=select_query($query);


	?><div id="databox">
<div class="heading">View Device Lost</div>
<div class="dataleft"><table cellspacing="2" cellpadding="2">
    <tbody> 

<tr><td>Date</td><td><?echo $row[0]["date"];?></td></tr>  	
<tr><td>Account Manager </td><td><?echo $row[0]["acc_manager"];?></td></tr>  	
<? $sql="SELECT Userid AS id,UserName AS sys_username FROM addclient  WHERE Userid=".$row[0]["user_id"];
	$rowuser=select_query($sql);
	?>
<tr><td>Client User Name 	</td><td><?echo $rowuser[0]["sys_username"];?></td></tr>	

<tr><td>Company Name</td><td><?echo $row[0]["client"];?></td></tr>  	
<tr><td>Registration No </td><td><?echo $row[0]["odd_reg_no"];?></td></tr>  	
<tr><td>Device Model </td><td><?echo $row[0]["odd_device_model"];?></td></tr> 
<tr><td>Device IMEI </td><td><?echo $row[0]["odd_imei"];?></td></tr>  	
<tr><td>Device Mobile Number  </td><td><?echo $row[0]["odd_sim"];?></td></tr>   
<tr><td>Date Of Installation   </td><td><?echo $row[0]["odd_instaltion_date"];?></td></tr> 
<tr><td>New Device Detail:---</td><td></td></tr>  	
<tr><td>Device Model </td><td><?echo $row[0]["ndd_device_model"];?></td></tr>  	
<tr><td>Device Id  </td><td><?echo $row[0]["ndd_device_id"];?></td></tr> 	
<tr><td>Device IMEI</td><td><?echo $row[0]["ndd_imei"];?></td></tr>  	
<tr><td>Device Mobile Number  </td><td><?echo $row[0]["ndd_sim"];?></td></tr> 	
<tr><td>Date</td><td><?echo $row[0]["newdevice_addeddate"];?></td></tr>  
<tr><td>Reason </td><td><?echo $row[0]["reason"];?></td></tr> 
<tr><td colspan="2">-------------------------------------------</td> </tr>
</tbody></table></div>
 
<div class="dataright">
<table cellspacing="2" cellpadding="2"><tbody>

<!--<tr><td>Admin Approval</td>  <td><?if($row[0]["approve_status"]==1) echo "Approved"; else echo "Pending Approval"?></td></tr>-->
<tr><td><strong>Process Pending </strong></td>  <td><strong>
<?  if($row[0]["device_lost_status"]==2 || (($row[0]["support_comment"]!="" || $row[0]["admin_comment"]!="") && $row[0]["service_comment"]==""))
	{echo "Reply Pending at Request Side";}
	elseif($row[0]["account_comment"]=="" && $row[0]["odd_paid_unpaid"]=="" && $row[0]["approve_status"]==0 && $row[0]["final_status"]==0){echo "Pending at Accounts";} 
	elseif($row[0]["approve_status"]==0 && $row[0]["forward_req_user"]!="" && $row[0]["forward_back_comment"]=="" && $row[0]["device_lost_status"]==1)	
	{echo "Pending Admin Approval (Req Forward to ".$row[0]["forward_req_user"].")";}
	elseif($row[0]["approve_status"]==0 && ($row[0]["account_comment"]!="" || $row[0]["odd_paid_unpaid"]!="") && $row[0]["final_status"]==0 && $row[0]["device_lost_status"]==1)
	{echo "Pending Admin Approval";}
	elseif($row[0]["approve_status"]==1 && $row[0]["device_lost_status"]==1 && $row[0]["final_status"]!=1){echo "Pending at Tech Support Team";}
	elseif($row[0]["final_status"]==1){echo "Process Done";}?></strong></td></tr>

 <tr><td>Old Device Paid or Not</td>  <td><?echo $row[0]["odd_paid_unpaid"];?></td></tr>
 <tr><td>Account Comment</td>  <td><?echo $row[0]["account_comment"];?></td></tr>
 <tr><td>Service Comment</td>  <td><?echo $row[0]["service_comment"];?></td></tr>
 <tr><td>Support Comment</td><td><?echo $row[0]["support_comment"];?></td></tr>
<tr><td>Admin Comment</td><td><?echo $row[0]["admin_comment"];?></td></tr>


<tr><td>Closed Date</td><td><?
if($row[0]["final_status"]==1)
{
echo date("d-M-Y h:i:s A",strtotime($row[0]["close_date"]));
}
else
{
	echo "";
}

?></td></tr>
 
</tbody>
	</table>
	</div> 
	</div>

	
		<? }
	else If($tablename=="vehicle_no_change")
		{
		 $query = "SELECT * FROM ".$tablename." where id=".$RowId; 
			$row=select_query($query);

 
  
	?>
	<div id="databox">
<div class="heading">View Vehicle Change</div>
<div class="dataleft"><table cellspacing="2" cellpadding="2">
    <tbody> 
 
<tr><td>Date </td><td><?echo $row[0]["date"];?></td></tr> 	
<tr><td>Account Manager </td><td><?echo $row[0]["sales_manager"];?></td></tr> 	
<? $sql="SELECT Userid AS id,UserName AS sys_username FROM addclient  WHERE Userid=".$row[0]["user_id"];
	$rowuser=select_query($sql);
	?>
<tr><td>Client User Name 	</td><td><?echo $rowuser[0]["sys_username"];?></td></tr>	
<tr><td>Company Name </td><td><?echo $row[0]["client"];?></td></tr>		
<tr><td>Registration No</td><td><?echo $row[0]["old_reg_no"];?></td></tr>	 	
<tr><td>New Registration No </td><td><?echo $row[0]["new_reg_no"];?></td></tr>	
<tr><td>Billing</td><td><?echo $row[0]["billing"];?></td></tr>
<tr><td>Billing Reason</td><td><?echo $row[0]["billing_reason"];?></td></tr>
<tr><td>Date 	</td><td><?echo $row[0]["numberchange_date"];?></td></tr>	
<tr><td>Reason </td><td><?echo $row[0]["reason"];?></td></tr>	
 <tr><td colspan="2">-------------------------------------------</td> </tr>

</tbody></table></div>
 
<div class="dataright">
<table cellspacing="2" cellpadding="2"><tbody>

<!--<tr><td>Admin Approval</td>  <td><?if($row[0]["approve_status"]==1) echo "Approved"; else echo "Pending Approval"?></td></tr>-->
<tr><td><strong>Process Pending </strong></td>  <td><strong>
<?  if($row[0]["reason"]=='Temperory no to Permanent no' || $row[0]["reason"]=='Personal no to Commercial no' || $row[0]["reason"]=='Commercial no to Personal no' || $row[0]["reason"]=='For Warranty Renuwal Purpose')
	{
		if($row[0]["vehicle_status"]==2 || ($row[0]["support_comment"]!="" && $row[0]["service_comment"]==""))
		{echo "Reply Pending at Request Side";}
		elseif($row[0]["vehicle_status"]==1 && $row[0]["final_status"]!=1){echo "Pending at Tech Support Team";}
		elseif($row[0]["final_status"]==1){echo "Process Done";} 
	}
	else{
		if($row[0]["vehicle_status"]==2 || (($row[0]["support_comment"]!="" || $row[0]["admin_comment"]!="") && $row[0]["service_comment"]==""))
		{echo "Reply Pending at Request Side";}
		elseif($row[0]["new_reg_no"]=="" && $row[0]["reason"]=="" && $row[0]["approve_status"]==0){echo "Request Not Completely Generate.";}
		elseif($row[0]["account_comment"]=="" && $row[0]["payment_status"]=="" && $row[0]["reason"]!="" && $row[0]["approve_status"]==0){echo "Pending at Accounts";} 
		elseif($row[0]["approve_status"]==0 && $row[0]["forward_req_user"]!="" && $row[0]["forward_back_comment"]=="" && $row[0]["vehicle_status"]==1)	
		{echo "Pending Admin Approval (Req Forward to ".$row[0]["forward_req_user"].")";}
		elseif($row[0]["approve_status"]==0 && ($row[0]["account_comment"]!="" || $row[0]["payment_status"]!="") && $row[0]["final_status"]==0 && $row[0]["vehicle_status"]==1)
		{echo "Pending Admin Approval";}
		elseif($row[0]["approve_status"]==1 && $row[0]["vehicle_status"]==1 && $row[0]["final_status"]!=1){echo "Pending at Tech Support Team";}
		elseif($row[0]["final_status"]==1){echo "Process Done";} 
	} ?></strong></td></tr>

<tr><td>Account Comment</td>  <td><?echo $row[0]["account_comment"];?></td></tr>
 <tr><td>Service Comment</td>  <td><?echo $row[0]["service_comment"];?></td></tr>
<tr><td>Support Comment</td><td><?echo $row[0]["support_comment"];?></td></tr>
<tr><td>Admin Comment</td><td><?echo $row[0]["admin_comment"];?></td></tr>
<?php if($row[0]["close_comment"]!=""){?>
<tr><td>Duplicate Close Reason</td><td><?echo $row[0]["close_comment"];?></td></tr>
<?php } ?>
   <tr><td>Closed Date</td><td><?
if($row[0]["final_status"]==1)
{
echo date("d-M-Y h:i:s A",strtotime($row[0]["close_date"]));
}
else
{
	echo "";
}

?></td></tr>
 </tbody> 
	</table>
	</div> 
	</div> 
	

<? }
	else If($tablename=="deletion")
		{
		$query = "SELECT * FROM ".$tablename." where id=".$RowId; 
			$row=select_query($query);



	?><div id="databox">
<div class="heading">Deletion Vehicle</div>
<div class="dataleft"><table cellspacing="2" cellpadding="2">
    <tbody> 	 
  <tr><td>date</td><td><?echo $row[0]["date"];?></td></tr>  	
<tr><td>Account Manager </td><td><?echo $row[0]["acc_manager"];?></td></tr> 
 
<? $sql="SELECT Userid AS id,UserName AS sys_username FROM addclient  WHERE Userid=".$row[0]["user_id"];
	$rowuser=select_query($sql);
	?>
<tr><td>Client User Name 	</td><td><?echo $rowuser[0]["sys_username"];?></td></tr>	
  	
<tr><td>Company Name </td><td><?echo $row[0]["client"];?></td></tr> 		
<tr><td>Registration No </td><td><?echo $row[0]["reg_no"];?></td></tr> 		
<tr><td>Device Model 	</td><td><?echo $row[0]["device_model"];?></td></tr> 	
<tr><td>Device IMEI 	</td><td><?echo $row[0]["imei"];?></td></tr> 	
<tr><td>Device Mobile Number </td><td><?echo $row[0]["device_sim_no"];?></td></tr> 		
<tr><td>Date Of Installation </td><td><?echo $row[0]["date_of_installation"];?></td></tr> 		
<tr><td>Present Status of device</td><td>----------------------</td></tr> 	
<tr><td>Location 	</td><td><?echo $row[0]["vehicle_location"];?></td></tr> 	
<tr><td>Contact person 	</td><td><?echo $row[0]["Contact_person"];?></td></tr> 	
<tr><td>Deactivation of SIM 	</td><td><?echo $row[0]["deactivation_of_sim"];?></td></tr>
<tr><td>Deletion date 	</td><td><?echo $row[0]["deletion_date"];?></td></tr> 	
<tr><td>Reason</td><td><?echo $row[0]["reason"];?></td></tr> 	
 <tr><td colspan="2">-------------------------------------------</td> </tr>
</tbody></table></div>
 
<div class="dataright">
<table cellspacing="2" cellpadding="2"><tbody>
<!--<tr><td>Admin Approval</td>  <td><?if($row[0]["approve_status"]==1) echo "Approved"; else echo "Pending Approval"?></td></tr>-->
<tr><td><strong>Process Pending </strong></td>  <td><strong>
<?  if($row[0]["delete_veh_status"]==2 || (($row[0]["support_comment"]!="" || $row[0]["admin_comment"]!="") && $row[0]["service_comment"]==""))
	{echo "Reply Pending at Request Side";}
	elseif($row[0]["vehicle_location"]=="gtrack office" && $row[0]["stock_comment"]==""){echo "Pending at Stock";}
	elseif($row[0]["account_comment"]=="" && $row[0]["odd_paid_unpaid"]=="" && $row[0]["approve_status"]==0 && $row[0]["final_status"]==0){echo "Pending at Accounts";} 
	elseif($row[0]["approve_status"]==0 && $row[0]["forward_req_user"]!="" && $row[0]["forward_back_comment"]=="" && $row[0]["delete_veh_status"]==1)	
	{echo "Pending Admin Approval (Req Forward to ".$row[0]["forward_req_user"].")";}
	elseif($row[0]["approve_status"]==0 && ($row[0]["account_comment"]!="" || $row[0]["odd_paid_unpaid"]!="") && $row[0]["final_status"]==0 && $row[0]["delete_veh_status"]==1)
	{echo "Pending Admin Approval";}
	elseif($row[0]["approve_status"]==1 && $row[0]["delete_veh_status"]==1 && $row[0]["final_status"]!=1){echo "Pending at Tech Support Team";}
	elseif($row[0]["final_status"]==1){echo "Process Done";}?></strong></td></tr>

 <tr><td>Old Device Paid or Not</td>  <td><?echo $row[0]["odd_paid_unpaid"];?></td></tr>
 <tr><td>Account Comment</td>  <td><?echo $row[0]["account_comment"];?></td></tr>
 <tr><td>Service Comment</td>  <td><?echo $row[0]["service_comment"];?></td></tr>
 <tr><td>Support Comment</td><td><?echo $row[0]["support_comment"];?></td></tr>
<tr><td>Admin Comment</td><td><?echo $row[0]["admin_comment"];?></td></tr>


<tr><td>Closed Date</td><td><?
if($row[0]["final_status"]==1)
{
echo date("d-M-Y h:i:s A",strtotime($row[0]["close_date"]));
}
else
{
	echo "";
}

?></td></tr>
</tbody>
	</table>
	</div> 
	</div> 
	<?
	}
	}
?> 