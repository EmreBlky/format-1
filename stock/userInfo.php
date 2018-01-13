<?php
session_start();
include("../connection.php");

$q=$_GET["user_id"];
$veh_reg=$_GET["veh_reg"];
 $row_id=$_GET["row_id"];
 $Devicecomment=$_GET["Devicecomment"];
  $backcomment=$_GET["backcomment"];
  $stockcomment=$_GET["Stockcomment"];
  $comment=$_GET["comment"];

if(isset($_GET['action']) && $_GET['action']=='devicechangeComment')
{
	$Updateapprovestatus="update device_change set stock_comment='".date("Y-m-d H:i:s")." - ".$comment."' where id=".$row_id;
	if(mysql_query($Updateapprovestatus))
	echo "Comment added Successfully";
}

if(isset($_GET['action']) && $_GET['action']=='getdataDebtors')
	{
		$q=$_GET["user_id"]; 
		
		$imei_query="SELECT services.id,veh_reg, devices.imei FROM matrix.services JOIN matrix.devices ON devices.id=services.sys_device_id JOIN matrix.mobile_simcards ON mobile_simcards.id=devices.sys_simcard WHERE services.id IN 
(SELECT DISTINCT sys_service_id FROM matrix.group_services WHERE active=TRUE ) AND imei= '".$q."'";
		
		$row_data=select_query_live($imei_query);

		$imei_id = $row_data[0]["id"];
		
		$user_query="SELECT sys_username FROM matrix.users WHERE id IN (SELECT sys_user_id FROM matrix.group_services JOIN matrix.group_users ON group_services.sys_group_id=group_users.sys_group_id WHERE group_services.sys_service_id='".$imei_id."')";
		
		$row=select_query_live($user_query);
		if($row[0]["sys_username"]!=""){
			echo $row[0]["sys_username"];
		}else{
			echo "g-track office";	
		}
		
	}

if(isset($_GET['action']) && $_GET['action']=='DetailFromDebtors')
{
 
	$UserId=$_GET["UserId"];
	$msg='<table>';
for($N=1;$N<=$_GET["RowId"];$N++)
	{

$result = select_query_live("SELECT services.id AS device_id,veh_reg,devices.imei AS device_imei,mobile_simcards.mobile_no FROM matrix.services JOIN matrix.latest_telemetry ON latest_telemetry.sys_service_id=services.id JOIN matrix.devices ON devices.id=services.sys_device_id JOIN matrix.mobile_simcards ON mobile_simcards.id=devices.sys_simcard WHERE services.id IN (SELECT DISTINCT sys_service_id FROM matrix.group_services WHERE active=TRUE AND sys_group_id IN (SELECT sys_group_id FROM matrix.group_users WHERE sys_user_id='".$UserId."'))");
 
$msg.='<tr><td><select  name="DeviceIMEI'.$N.'" id="DeviceIMEI" onchange="showUser1(this.value,\'userRecord'.$N.'\')">
<option value="">Select IMEI</option>';
  
//while($row = mysql_fetch_assoc($result))
for($d=0;$d<count($result);$d++)
  {
	 
  $msg .="<option name='DeviceIMEI$N' value=".$result[$d]['device_imei'].">".$result[$d]['device_imei']."</option>";
   
  }
	
  $msg .='</select></td><td>or IMEI:<input type="text" name="otherDeviceIMEI'.$N.'" id="otherDeviceIMEI" onblur="showUser1(this.value,\'userRecord'.$N.'\')"></td>';
  
  $msg .="<td><input type='text' name='userRecord$N' id='userRecord$N' value=".$row['userRecord']."></td>";
  
  $msg .='<td><select name="devicelocation'.$N.'" id="devicelocation'.$N.'" >
  				<option value="">Select Location</option>
				<option value="client office">Client Office</option>
				<option value="g-track office">g-track Office</option>
				<option value="Installed Same Client">Installed Same Client</option>
				<option value="Installed Other Client">Installed Other Client</option>
			</select>
			</td></tr>';

  	}
	$msg.='</table>';
	echo $msg;
}

if(isset($_GET['action']) && $_GET['action']=='stockSimchangeComment')
{
	    
		$query = "SELECT stock_comment FROM sim_change  where id=".$row_id;
	$row=select_query($query);
 

	$Updateapprovestatus="update sim_change  set stock_comment='".$row[0]["stock_comment"]."<br/>".date("Y-m-d H:i:s")." - " .$comment."' where id=".$row_id;
		
		
		//$Updateapprovestatus="update sim_change set account_comment='".addslashes($comment)."' where id=".$row_id;
	 if(mysql_query($Updateapprovestatus))
	 echo "Comment Added Successfully";
	
 }

if(isset($_GET['action']) && $_GET['action']=='simchangebackComment')
{
	
		$query = "SELECT forward_back_comment FROM sim_change  where id=".$row_id;
	 $row=select_query($query);

	  
	$Updateapprovestatus="update sim_change set forward_back_comment='".$row[0]["forward_back_comment"]."<br/>".date("Y-m-d H:i:s")." - " .$comment."' where id=".$row_id;
	
	
	//$Updateapprovestatus="update stop_gps set admin_comment='".$comment."' where id=".$row_id;
	if(mysql_query($Updateapprovestatus))
	echo "Comment added Successfully";
}

if(isset($_GET['action']) && $_GET['action']=='getdataAccount')
	{
		$q=$_GET["user_id"]; 
		
		$imei_query="SELECT services.id,veh_reg, devices.imei FROM matrix.services JOIN matrix.devices ON devices.id=services.sys_device_id JOIN matrix.mobile_simcards ON mobile_simcards.id=devices.sys_simcard WHERE services.id IN 
(SELECT DISTINCT sys_service_id FROM matrix.group_services WHERE active=TRUE ) AND imei= '".$q."'";
		
		$row_data=select_query_live($imei_query);

		$imei_id = $row_data[0]["id"];
		
		$user_query="SELECT sys_username FROM matrix.users WHERE id IN (SELECT sys_user_id FROM matrix.group_services JOIN matrix.group_users ON group_services.sys_group_id=group_users.sys_group_id WHERE group_services.sys_service_id='".$imei_id."')";
		
		$row=select_query_live($user_query);
		if($row[0]["sys_username"]!=""){
			echo $row[0]["sys_username"];
		}else{
			echo "g-track office";	
		}
	}

if(isset($_GET['action']) && $_GET['action']=='DetailFromAccount')
{
 
	$UserId=$_GET["UserId"];
	$msg='<table>';
for($N=1;$N<=$_GET["RowId"];$N++)
	{
	
	$result = select_query_live("SELECT services.id AS device_id,devices.imei AS device_imei FROM matrix.services JOIN matrix.latest_telemetry ON latest_telemetry.sys_service_id=services.id JOIN matrix.devices ON devices.id=services.sys_device_id JOIN matrix.mobile_simcards ON mobile_simcards.id=devices.sys_simcard WHERE services.id IN (SELECT DISTINCT sys_service_id FROM matrix.group_services WHERE active=TRUE AND sys_group_id IN (SELECT sys_group_id FROM matrix.group_users WHERE sys_user_id='".$UserId."'))");
 
$msg.='<tr><td><select  name="DeviceIMEI'.$N.'" id="DeviceIMEI'.$N.'" onchange="showUser(this.value,\'userRecord'.$N.'\')">
<option name="DeviceIMEI'.$N.'" value="">Select IMEI</option>';
  
//while($row = mysql_fetch_assoc($result))
for($d=0;$d<count($result);$d++)
  {
	 
  $msg .="<option name='DeviceIMEI$N' value=".$result[$d]['device_imei'].">".$result[$d]['device_imei']."</option>";
   
  }
	
  $msg .='</select></td><td>or IMEI:<input type="text" name="otherDeviceIMEI'.$N.'" id="otherDeviceIMEI'.$N.'" onblur="showUser(this.value,\'userRecord'.$N.'\')"></td>';
  
  $msg .="<td><input type='text' name='userRecord$N' id='userRecord$N' value=".$row['userRecord']."></td>";
  $msg .='<td><select name="devicelocation'.$N.'" id="devicelocation'.$N.'" >
  				<option value="">Select Location</option>
				<option value="client office">Client Office</option>
				<option value="g-track office">g-track Office</option>
				<option value="Installed Same Client">Installed Same Client</option>
				<option value="Installed Other Client">Installed Other Client</option>
			</select>
			</td></tr>';

  	}
	$msg.='</table>';
	echo $msg;
}

if(isset($_GET['action']) && $_GET['action']=='deletionComment')
{
	$Updateapprovestatus="update deletion set stock_comment='".date("Y-m-d H:i:s")." - ".$comment."' where id=".$row_id;
	if(mysql_query($Updateapprovestatus))
	echo "Comment added Successfully";
}

if(isset($_GET['action']) && $_GET['action']=='deactivation_of_accountbackComment')
{
	$Updateapprovestatus="update deactivation_of_account  set forward_back_comment='".date("Y-m-d H:i:s")." - ".$backcomment."' where id=".$row_id;
	if(mysql_query($Updateapprovestatus))
	echo "Comment added Successfully";
}

if(isset($_GET['action']) && $_GET['action']=='deact_of_accStockComment')
{
	$Updateapprovestatus="update deactivation_of_account  set stock_comment='".$stockcomment." - ".date("Y-m-d H:i:s")."' where id=".$row_id;
	if(mysql_query($Updateapprovestatus))
	echo "Comment added Successfully";
}

if(isset($_GET['action']) && $_GET['action']=='deactivation_of_accountDeviceComment')
{
	$Updateapprovestatus="update deactivation_of_account  set no_device_removed='".date("Y-m-d H:i:s")." - ".$Devicecomment."' where id=".$row_id;
	if(mysql_query($Updateapprovestatus))
	echo "Comment added Successfully";
}

if(isset($_GET['action']) && $_GET['action']=='del_form_debtorsbackComment')
{
	$Updateapprovestatus="update del_form_debtors  set forward_back_comment='".date("Y-m-d H:i:s")." - ".$backcomment."' where id=".$row_id;
	if(mysql_query($Updateapprovestatus))
	echo "Comment added Successfully";
}	

if(isset($_GET['action']) && $_GET['action']=='del_form_debtorsStockComment')
{
	$Updateapprovestatus="update del_form_debtors  set stock_comment='".$stockcomment." - ".date("Y-m-d H:i:s")."' where id=".$row_id;
	if(mysql_query($Updateapprovestatus))
	echo "Comment added Successfully";
}

if(isset($_GET['action']) && $_GET['action']=='deletionbackComment')
{
	$Updateapprovestatus="update deletion  set forward_back_comment='".date("Y-m-d H:i:s")." - ".$backcomment."' where id=".$row_id;
	if(mysql_query($Updateapprovestatus))
	echo "Comment added Successfully";
}	

if(isset($_GET['action']) && $_GET['action']=='del_form_debtorsDeviceComment')
{
	$Updateapprovestatus="update del_form_debtors  set no_device_removed='".date("Y-m-d H:i:s")." - ".$Devicecomment."' where id=".$row_id;
	if(mysql_query($Updateapprovestatus))
	echo "Comment added Successfully";
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
    <tbody> 
    
<tr><td>Date</td><td><?echo date("d-M-Y h:i:s A",strtotime($row[0]["date"]));?></td></tr>
<? /*if($row[0]["account_manager"]=='reena') {
$account_manager=$row[0]["sales_manager"]; 
}
else {
$account_manager=$row[0]["account_manager"]; 
}*/

?>
<tr><td>Request By</td><td><?echo $row[0]["account_manager"];?></td></tr>
<tr><td>Account Manager</td><td><?echo $row[0]["sales_manager"];?></td></tr>
<tr><td>Company</td><td><?echo $row[0]["company"];?></td></tr>
<tr><td>Potential</td>  <td><?echo $row[0]["potential"];?></td></tr>
<tr><td>Contact Person</td><td><?echo $row[0]["contact_person"];?></td></tr>
<tr><td>Contact Number</td><td><?echo $row[0]["contact_number"];?></td></tr>
<tr><td>Billing Name</td><td><?echo $row[0]["billing_name"];?></td></tr>
<tr><td>Billing Address</td><td><?echo $row[0]["billing_address"];?></td></tr>
<tr><td>Type of Organisation</td><td><?echo $row[0]["type_of_org"];?></td></tr>
<tr><td>PAN No.</td><td><?echo $row[0]["pan_no"];?></td></tr>
<tr><td>Copy of Pan Card</td><td><?echo $row[0]["pan_card"];?></td></tr>
<tr><td>Copy of Address Proof</td><td><?echo $row[0]["address_proof"];?></td></tr>
<tr><td>Price</td><td><?echo $row[0]["device_price"];?></td></tr>
<tr><td>Vat</td><td><?echo $row[0]["device_price_vat"];?></td></tr>
<tr><td>Total Price</td><td><?echo $row[0]["device_price_total"];?></td></tr>
<tr><td>Rent</td><td><?echo $row[0]["device_rent_Price"];?></td></tr>
<tr><td>Service tax</td><td><?echo $row[0]["device_rent_service_tax"];?></td></tr>
<tr><td>Total Rent</td><td><?echo $row[0]["DTotalREnt"];?></td></tr>
<td>mode of payment</td><td><?echo $row[0]["mode_of_payment"];?></td></tr>
<tr><td>Account Type</td><td><?echo $row[0]["account_type"];?></td></tr>
</tbody></table></div>



<div class="dataright">
<table cellspacing="2" cellpadding="2"><tbody>
 <tr><td>Demo Period</td><td><?echo $row[0]["demo_time"];?></td></tr>
<tr><td>Vehicle type</td><td><?echo $row[0]["vehicle_type"];?></td></tr>
<tr><td>Immobilizer (Y/N)</td><td><?echo $row[0]["immobilizer"];?></td></tr>
<tr><td>AC (ON/OFF)</td><td><?echo $row[0]["ac_on_off"];?></td></tr>
<tr><td>E_mail ID</td>  <td><?echo $row[0]["email_id"];?></td></tr>
<tr><td>User Name</td><td><?echo $row[0]["user_name"];?></td></tr>
<tr><td>Password</td><td><?echo $row[0]["user_password"];?></td></tr>

<tr><td colspan="2">-------------------------------------------</td> </tr>

<!-- <tr><td>Admin Approval</td>  <td><?if($row[0]["approve_status"]==1) echo "Approved"; else echo "Pending Approval"?></td></tr>-->
 <tr><td><strong>Process Pending </strong></td>  <td><strong>
<?  if($row[0]["acc_creation_status"]==2 || (($row[0]["support_comment"]!="" || $row[0]["admin_comment"]!="") && $row[0]["sales_comment"]==""))
	{echo "Reply Pending at Request Side";}
	elseif($row[0]["approve_status"]==0 && $row[0]["forward_req_user"]!="" && $row[0]["forward_back_comment"]=="" && $row[0]["acc_creation_status"]==1)	
	{echo "Pending Admin Approval (Req Forward to ".$row[0]["forward_req_user"].")";}
	elseif($row[0]["approve_status"]==0 && $row[0]["final_status"]==0 && $row[0]["acc_creation_status"]==1)
	{echo "Pending Admin Approval";}
	elseif($row[0]["approve_status"]==1 && $row[0]["acc_creation_status"]==1 && $row[0]["final_status"]!=1){echo "Pending at Support Team";}
	elseif($row[0]["final_status"]==1){echo "Process Done";}?></strong></td></tr>

<tr><td>Account Comment</td>  <td><?echo $row[0]["account_comment"];?></td></tr>
<tr><td>Sales Comment</td>  <td><?echo $row[0]["sales_comment"];?></td></tr>
<tr><td>Support Comment</td><td><?echo $row[0]["support_comment"];?></td></tr>
<tr><td>Admin Comment</td><td><?echo $row[0]["admin_comment"];?></td></tr>
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
	</tr>
	</tr>
</tbody></table>
</div>
</div>

	<? }

	else If($tablename=="comment")
        {
        //"select * from comment where service_id='".$service_id."' order by date desc"
         
    ?><div > <div style=" padding-left: 50px;">
    <h1>Comment</h1> </div>
    <div class="table">
     <table cellspacing="2" cellpadding="2" style=" padding-left: 100px;width: 500px;">
     
       <tr><td>  
 <?

$data=select_query_live_con("select * from matrix.comment where service_id='".$RowId."' order by date desc");
 
if(count($data)>0)
{
echo '<table cellspacing="0" cellpadding="0" border="1" width="100%" >
     
        <tr  ><th>Date</th><th>Comment By</th><th>Comment</th></tr>';
for($c=0;$c<count($data);$c++)
    {

 echo '<tr ><td>'. $data[$c]["date"]. '</td><td>'. $data[$c]["comment_by"]. '</td><td>'. $data[$c]["comment"]. '</td></tr>';
    /*echo '<div>'. $data[$c]["date"]. '<div>';
    echo '<br/>';
    echo '<div>Comment By--'. $data[$c]["comment_by"]. '<div>';
    echo '<br/>';
    echo '<div>'. $data[$c]["comment"]. '<div>';
    //echo '<div align="right"><a href="?d=true&id='.$data[$c]["id"].'" >Remove </a></div>';

    echo '<hr>&nbsp;</hr>';*/
    }
    echo '</table>';

 }
 else
    {
     echo '<div> No Comments<div>';

    echo '<hr>&nbsp;</hr>';
    }
 ?>
 </td></tr>
 </table>
    </div>
    </div>
 
    <? }
	
	
	else If($tablename=="stop_gps")
		{
		  $query = "SELECT * FROM ".$tablename." where id=".$RowId; 
			$row=select_query($query);
	?><div id="databox">
<div class="heading">Stop Gps</div>
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
<tr><td>Vehicle to Stop GPS </td><td><?echo $row[0]["no_of_vehicle"];?></td></tr>
<tr><td>Present Status Of</td><td>:---</td></tr>
<tr><td>Location 	</td><td><?echo $row[0]["ps_of_location"];?></td></tr>
<tr><td>Data to display 	</td><td><?echo $row[0]["data_display"];?></td></tr>
<tr><td>OwnerShip 	</td><td><?echo $row[0]["ps_of_ownership"];?></td></tr>
<tr><td>Payment status 	</td><td><?echo $row[0]["payment_status"];?></td></tr>  
<tr><td>Reason 	</td><td><?echo $row[0]["reason"];?></td></tr>

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
	elseif($row[0]["approve_status"]==1 && $row[0]["stop_gps_status"]==1 && $row[0]["final_status"]!=1){echo "Pending at Support Team";}
	elseif($row[0]["final_status"]==1){echo "Process Done";}?></strong></td></tr>

<tr><td>Account Comment</td>  <td><?echo $row[0]["account_comment"];?></td></tr>
 <tr><td>Payment Pending</td>  <td><?echo $row[0]["total_pending"];?></td></tr>
<tr><td>Sales Comment</td>  <td><?echo $row[0]["sales_comment"];?></td></tr>
<tr><td>Support Comment</td><td><?echo $row[0]["support_comment"];?></td></tr>
<tr><td>Admin Comment</td><td><?echo $row[0]["admin_comment"];?></td></tr>
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
	</tr>
</tbody></table>
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
	else If($tablename=="sim_change")
		{
		$query = "SELECT * FROM ".$tablename." where id=".$RowId; 
			$row=select_query($query);

	?><div id="databox">
<div class="heading">View Mobile Number Change</div>
<div class="dataleft"><table cellspacing="2" cellpadding="2">
    <tbody> 
<tr><td>Date </td><td><?echo date("d-M-Y h:i:s A",strtotime($row[0]["date"]));?></td></tr> 	
<tr><td>Request By</td><td><?echo $row[0]["acc_manager"];?></td></tr>
<tr><td>Account Manager</td><td><?echo $row[0]["sales_manager"];?></td></tr>

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
		elseif($row[0]["sim_change_status"]==1 && $row[0]["final_status"]!=1){echo "Pending at Support Team";}
		elseif($row[0]["final_status"]==1){echo "Process Done";} 
	 ?></strong></td></tr>
    
<tr><td>Account Comment</td>  <td><?echo $row[0]["account_comment"];?></td></tr>
 <tr><td>Service Comment</td>  <td><?echo $row[0]["service_comment"];?></td></tr>
<tr><td>Support Comment</td><td><?echo $row[0]["support_comment"];?></td></tr>
<tr><td>Stock Comment</td><td><?echo $row[0]["stock_comment"];?></td></tr>
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
	</tr>
</tbody>
  
	</table>
	</div> 
	</div>
	<? }
	else If($tablename=="deactivation_of_account")
		{
		 $query = "SELECT * FROM ".$tablename." where id=".$RowId; 
			$row=select_query($query);
		 $query1 = select_query("SELECT imei_of_removed_devices,other_imei_removed,client,device_location FROM stock_deactivation_of_account where deactivate_acc_id=".$RowId); 

  
	?><div id="databox">
<div class="heading">Deactivation Of Account</div>
<div class="dataleft"><table cellspacing="2" cellpadding="2">
    <tbody> 
    
<tr><td>Date </td><td><?echo date("d-M-Y h:i:s A",strtotime($row[0]["date"]));?></td></tr> 	
<tr><td>Request By</td><td><?echo $row[0]["acc_manager"];?></td></tr>
<tr><td>Account Manager</td><td><?echo $row[0]["sales_manager"];?></td></tr>

<? $sql="SELECT Userid AS id,UserName AS sys_username FROM addclient  WHERE Userid=".$row[0]["user_id"];
	$rowuser=select_query($sql);
	?>
<tr><td>Client User Name 	</td><td><?echo $rowuser[0]["sys_username"];?></td></tr>	
<tr><td>Company Name </td><td><?echo $row[0]["company"];?></td></tr> 	
<tr><td>Total No Of Vehicle </td><td><?echo $row[0]["total_no_of_vehicles"];?></td></tr> 	
<tr><td>Deactivate </td><td><?echo $row[0]["deactivate_temp"];?></td></tr> 	
<tr><td>Device Removed Status</td><td><?echo $row[0]["device_remove_status"];?></td></tr>
<tr><td>No of Removed Device</td><td><?echo $row[0]["no_of_removed_devices"];?></td></tr> 
 <tr><td>Alert Date </td><td><?echo $row[0]["alert_date"];?></td></tr>
<tr><td>Delete From Debtors </td><td><?echo $row[0]["delete_form_debtors"];?></td></tr>
<tr><td>Payment status 	</td><td><?echo $row[0]["payment_status"];?></td></tr>  
<tr><td>Reason</td><td><?echo $row[0]["reason"];?></td></tr> 
<tr><td colspan="2">-------------------------------------------</td> </tr>
<tr>
	<td colspan="2">
    	<table cellspacing="2" cellpadding="2">
            <tbody>
            	<tr>
                	<td align="left">IMEI No.</td>
                    <td>Client Name</td>
                    <td>Device Location</td>
                </tr>
                <?php //while($get_imei = mysql_fetch_array($query1))
					  for($i=0;$i<count($query1);$i++){?>
                <tr>
                <?php if($query1[$i]["imei_of_removed_devices"]!=""){ ?>
                    <td><?php echo $query1[$i]["imei_of_removed_devices"];?></td>
                    <?php }else{ ?>
                    <td><?php echo $query1[$i]["other_imei_removed"];?></td>
                    <?php } ?>
                    <td><?php echo $query1[$i]["client"];?></td>
                    <td><?php echo $query1[$i]["device_location"];?></td>
                </tr>
                <?php } ?>
            </tbody>
        </table>
    </td>
</tr>
</tbody></table></div>
 
<div class="dataright">
<table cellspacing="2" cellpadding="2"><tbody>
 <!--<tr><td>Admin Approval</td>  <td><?if($row[0]["approve_status"]==1) echo "Approved"; else echo "Pending Approval"?></td></tr>-->
<tr><td><strong>Process Pending </strong></td>  <td><strong>
<?  if($row[0]["deactivation_status"]==2 || (($row[0]["support_comment"]!="" || $row[0]["admin_comment"]!="") && $row[0]["sales_comment"]==""))
	{echo "Reply Pending at Request Side";}
	elseif($row[0]["device_remove_status"]=="Y" && $row[0]["no_device_removed"]=="" && $row[0]["approve_status"]==0 && $row[0]["final_status"]==0){echo "Pending at Stock";} 
	elseif($row[0]["account_comment"]=="" && $row[0]["pay_pending"]=="" && $row[0]["approve_status"]==0 && $row[0]["final_status"]==0){echo "Pending at Accounts";} 
	elseif($row[0]["approve_status"]==0 && $row[0]["forward_req_user"]!="" && $row[0]["forward_back_comment"]=="" && $row[0]["deactivation_status"]==1)	
	{echo "Pending Admin Approval (Req Forward to ".$row[0]["forward_req_user"].")";}
	elseif($row[0]["approve_status"]==0 && ($row[0]["account_comment"]!="" || $row[0]["pay_pending"]!="") && $row[0]["final_status"]==0 && $row[0]["deactivation_status"]==1)
	{echo "Pending Admin Approval";}
	elseif($row[0]["approve_status"]==1 && $row[0]["deactivation_status"]==1 && $row[0]["final_status"]!=1){echo "Pending at Tech Support Team";}
	elseif($row[0]["final_status"]==1){echo "Process Done";}?></strong></td></tr>

<tr><td>No of Devices Received </td>  <td><?echo $row[0]["no_device_removed"];?></td></tr>
<tr><td>Req Forward To</td>  <td><?echo $row[0]["forward_req_user"];?></td></tr>
<tr><td>Admin Comment</td>  <td><?echo $row[0]["forward_comment"];?></td></tr>
<tr><td>Forward Back Comment</td>  <td><?echo $row[0]["forward_back_comment"];?></td></tr>
<tr><td>Stock Comment</td>  <td><?echo $row[0]["stock_comment"];?></td></tr>
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
	</tr>
	</tbody></table>
</div>
</div>


	<? }
	else If($tablename=="del_form_debtors")
		{
		$query = "SELECT * FROM ".$tablename." where id=".$RowId; 
		$row=select_query($query);
        $query1 = select_query("SELECT imei_of_removel_devices,other_imei_removed,client,device_location FROM stock_del_form_debtors where del_debtors_id=".$RowId);

	?><div id="databox">
<div class="heading">Delete From Debtors</div>
<div class="dataleft"><table cellspacing="2" cellpadding="2">
    <tbody> 
<tr><td>Date </td><td><?echo date("d-M-Y h:i:s A",strtotime($row[0]["date"]));?></td></tr> 	
<tr><td>Request By</td><td><?echo $row[0]["acc_manager"];?></td></tr>
<tr><td>Account Manager</td><td><?echo $row[0]["sales_manager"];?></td></tr>

<? $sql="SELECT Userid AS id,UserName AS sys_username FROM addclient  WHERE Userid=".$row[0]["user_id"];
	$rowuser=select_query($sql);
	?>
<tr><td>Client User Name 	</td><td><?echo $rowuser[0]["sys_username"];?></td></tr>	
<tr><td>Company Name </td><td><?echo $row[0]["company"];?></td></tr> 	
<tr><td>Total No Of Vehicle </td><td><?echo $row[0]["total_no_of_vehicle"];?></td></tr> 	
<tr><td>Date Of Creation  </td><td><?echo $row[0]["date_of_creation"];?></td></tr> 	 
<tr><td>Payment status 	</td><td><?echo $row[0]["payment_status"];?></td></tr> 
<tr><td>Device Removed Status</td><td><?echo $row[0]["device_remove_status"];?></td></tr>
<tr><td>No of Removed Device</td><td><?echo $row[0]["no_of_devices_removed"];?></td></tr> 
<tr><td>Reason</td><td><?echo $row[0]["reason"];?></td></tr> 
<tr><td colspan="2">-------------------------------------------</td> </tr>
<tr>
	<td colspan="2">
    	<table cellspacing="2" cellpadding="2">
            <tbody>
            	<tr>
                	<td align="left">IMEI No.</td>
                    <td>Client Name</td>
                    <td>Device Location</td>
                </tr>
                <?php //while($get_imei = mysql_fetch_array($query1))
				      for($i=0;$i<count($query1);$i++){?>
                <tr>
                <?php if($query1[$i]["imei_of_removel_devices"]!=""){ ?>
                    <td><?php echo $query1[$i]["imei_of_removel_devices"];?></td>
                    <?php }else{ ?>
                    <td><?php echo $query1[$i]["other_imei_removed"];?></td>
                    <?php } ?>
                    <td><?php echo $query1[$i]["client"];?></td>
                    <td><?php echo $query1[$i]["device_location"];?></td>
                </tr>
                <?php } ?>
            </tbody>
        </table>
    </td>
</tr>
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

<tr><td>No of Devices Received </td>  <td><?echo $row[0]["no_device_removed"];?></td></tr>
<tr><td>Stock Comment</td>  <td><?echo $row[0]["stock_comment"];?></td></tr>
<tr><td>Req Forward To</td>  <td><?echo $row[0]["forward_req_user"];?></td></tr>
<tr><td>Admin Comment</td>  <td><?echo $row[0]["forward_comment"];?></td></tr>
<tr><td>Forward Back Comment</td>  <td><?echo $row[0]["forward_back_comment"];?></td></tr>
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
	</tr>

	</tbody></table>
</div>
</div>



	<?
	}
	If($tablename=="device_change")
		{
	$query = "SELECT * FROM ".$tablename." where id=".$RowId;
			$row=select_query($query);
	?><div id="databox">
<div class="heading">View Device Change</div>
<div class="dataleft"><table cellspacing="2" cellpadding="2">
    <tbody> 
<tr><td>Date</td><td><?echo date("d-M-Y h:i:s A",strtotime($row[0]["date"]));?></td></tr>
<tr><td>Request By</td><td><?echo $row[0]["acc_manager"];?></td></tr>
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
<tr><td>IMEI</td><td><?echo $row[0]["rdd_device_imei"];?></td></tr>
<tr><td>Device ID</td><td><?echo $row[0]["rdd_device_id"];?></td></tr>
<tr><td>Mobile Number</td><td><?echo $row[0]["rdd_device_mobile_num"];?></td></tr>
<tr><td>Date of installation </td><td><?echo $row[0]["rdd_date_replace"];?></td></tr>
<tr><td>Replace Date</td><td><?echo $row[0]["rdd_date"];?></td></tr>
<tr><td>Payment status 	</td><td><?echo $row[0]["payment_status"];?></td></tr>  
<tr><td>Reason</td><td><?echo $row[0]["rdd_reason"];?></td></tr> 

</tbody></table></div>
 
<div class="dataright">
<table cellspacing="2" cellpadding="2"><tbody>

<tr><td><strong>Process Pending </strong></td>  <td><strong>
<?  if(($row[0]["device_change_status"]==2 && $row[0]["rdd_device_type"]!="New" && $row[0]["billing"]!="Advance") || (($row[0]["support_comment"]!="" || ($row[0]["admin_comment"]!="" && $row[0]["rdd_device_type"]!="New" && $row[0]["billing"]!="Advance")) && $row[0]["service_comment"]=="")){echo "Reply Pending at Request Side";}
	elseif($row[0]["rdd_device_imei"]=="" && $row[0]["rdd_reason"]=="" && $row[0]["approve_status"]==0){echo "Request Not Completely Generate.";}
	elseif($row[0]["account_comment"]=="" && $row[0]["pay_status"]=="" && $row[0]["rdd_reason"]!="" && $row[0]["approve_status"]==0){echo "Pending at Accounts";} 
	elseif($row[0]["rdd_device_type"]=="New" && $row[0]["billing"]=="Advance" && ($row[0]["service_support_com"]=='' || $row[0]["device_change_status"]==2) && $row[0]["approve_status"]==0){echo "Pending at Delhi Service Support Login";}
	elseif($row[0]["approve_status"]==0 && $row[0]["forward_req_user"]!="" && $row[0]["forward_back_comment"]=="" && $row[0]["device_change_status"]==1)	
	{echo "Pending Admin Approval (Req Forward to ".$row[0]["forward_req_user"].")";}
	elseif($row[0]["approve_status"]==0 && ($row[0]["account_comment"]!="" || $row[0]["pay_status"]!="") && $row[0]["final_status"]==0 && $row[0]["device_change_status"]==1)
	{echo "Pending Admin Approval";}
	elseif($row[0]["approve_status"]==1 && $row[0]["device_change_status"]==1 && $row[0]["final_status"]!=1){echo "Pending at Tech Support Team";}
	elseif($row[0]["final_status"]==1){echo "Process Done";}?></strong></td></tr>

<tr><td>Billing</td><td><?echo $row[0]["billing"];?></td></tr>
<!--<tr><td>Admin Approval</td>  <td><?if($row[0]["approve_status"]==1) echo "Approved"; else echo "Pending Approval"?></td></tr>-->
<tr><td>Account Comment</td>  <td><?echo $row[0]["account_comment"];?></td></tr>
 <tr><td>Service Comment</td>  <td><?echo $row[0]["service_comment"];?></td></tr>
<tr><td>Support Comment</td><td><?echo $row[0]["support_comment"];?></td></tr>
<tr><td>Stock Comment</td><td><?echo $row[0]["stock_comment"];?></td></tr>

<tr><td>Req Forwarded to</td><td><?echo $row[0]["forward_req_user"];?></td></tr>
<tr><td>Forward Comment</td><td><?echo $row[0]["forward_comment"];?></td></tr>
<tr><td>F/W Request Back Comment</td><td><?echo $row[0]["forward_back_comment"];?></td></tr>

<tr><td>Admin Comment</td><td><?echo $row[0]["admin_comment"];?></td></tr>
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
	</tr>
	</tbody></table>
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
<tr><td>Date</td><td><?echo date("d-M-Y h:i:s A",strtotime($row[0]["date"]));?></td></tr>
<tr><td>Request By</td><td><?echo $row[0]["acc_manager"];?></td></tr>
<tr><td>Account Manager</td><td><?echo $row[0]["sales_manager"];?></td></tr>

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
<?  if($row[0]["account_comment"]=="" && $row[0]["final_status"]==0){echo "Pending In Accounts";} 
	elseif($row[0]["final_status"]==1){echo "Process Done";}?></strong></td></tr>
 
<tr><td>Account Comment</td>  <td><?echo $row[0]["account_comment"];?></td></tr>
 <tr><td>Service Comment</td>  <td><?echo $row[0]["service_comment"];?></td></tr>
<tr><td>Support Comment</td><td><?echo $row[0]["support_comment"];?></td></tr>
<tr><td>Admin Comment</td><td><?echo $row[0]["admin_comment"];?></td></tr>
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
	</tr></tbody></table></div></div>
 
 
 
 


	<? }


	else If($tablename=="imei_change")
		{
		  $query = "SELECT * FROM ".$tablename." where id=".$RowId; 
			$row=select_query($query);
	?><div id="databox">
<div class="heading">IMEI Change</div>
<div class="dataleft"><table cellspacing="2" cellpadding="2">
    <tbody> 
    
<tr><td>Date</td><td><?echo date("d-M-Y h:i:s A",strtotime($row[0]["date"]));?></td></tr>
<tr><td>Request By</td><td><?echo $row[0]["acc_manager"];?></td></tr>
<tr><td>Account Manager</td><td><?echo $row[0]["sales_manager"];?></td></tr>
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
<tr><td>Payment Status</td><td><?echo $row[0]["payment_status"];?></td></tr>
<tr><td>Reason</td><td><?echo $row[0]["reason"];?></td></tr> 
</tbody></table></div>
 
<div class="dataright">
<table cellspacing="2" cellpadding="2"><tbody>

 <tr><td>Admin Approval</td>  <td><?if($row[0]["approve_status"]==1) echo "Approved"; else echo "Pending Approval"?></td></tr>
<tr><td>Account Comment</td>  <td><?echo $row[0]["account_comment"];?></td></tr>
 <tr><td>Service Comment</td>  <td><?echo $row[0]["service_comment"];?></td></tr>
<tr><td>Support Comment</td><td><?echo $row[0]["support_comment"];?></td></tr>
<tr><td>Admin Comment</td><td><?echo $row[0]["admin_comment"];?></td></tr>
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

?></tbody></table>
</div>
</div> 
	

	<?
	}


	else If($tablename=="deletion")
		{
		$query = "SELECT * FROM ".$tablename." where id=".$RowId; 
			$row=select_query($query);



	?><div id="databox">
<div class="heading">Deletion Vehicle</div>
<div class="dataleft"><table cellspacing="2" cellpadding="2">
    <tbody> 
    
  <tr><td>date</td><td><?echo date("d-M-Y h:i:s A",strtotime($row[0]["date"]));?></td></tr>  	
<tr><td>Request By</td><td><?echo $row[0]["acc_manager"];?></td></tr>
<tr><td>Account Manager</td><td><?echo $row[0]["sales_manager"];?></td></tr>
 
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
<tr><td>Device Status</td><td><?echo $row[0]["device_status"];?></td></tr> 	
<tr><td>Location 	</td><td><?echo $row[0]["vehicle_location"];?></td></tr> 	
<tr><td>Contact person 	</td><td><?echo $row[0]["Contact_person"];?></td></tr> 	
<tr><td>Deactivation of SIM 	</td><td><?echo $row[0]["deactivation_of_sim"];?></td></tr>
<tr><td>Payment Status</td><td><?echo $row[0]["payment_status"];?></td></tr>
<tr><td>Deletion date 	</td><td><?echo $row[0]["deletion_date"];?></td></tr> 	
<tr><td>Reason</td><td><?echo $row[0]["reason"];?></td></tr> 	
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
	elseif($row[0]["approve_status"]==1 && $row[0]["delete_veh_status"]==1 && $row[0]["final_status"]!=1){echo "Pending at Support Team";}
	elseif($row[0]["final_status"]==1){echo "Process Done";}?></strong></td></tr>

<tr><td>Account Comment</td>  <td><?echo $row[0]["account_comment"];?></td></tr>
 <tr><td>Old Device Paid or Not</td>  <td><?echo $row[0]["odd_paid_unpaid"];?></td></tr>
  <tr><td>Service Comment</td>  <td><?echo $row[0]["service_comment"];?></td></tr>
<tr><td>Support Comment</td><td><?echo $row[0]["support_comment"];?></td></tr>
<tr><td>Stock Comment</td><td><?echo $row[0]["stock_comment"];?></td></tr>
<tr><td>Admin Comment</td><td><?echo $row[0]["admin_comment"];?></td></tr>
<tr><td>Req Forwarded to</td><td><?echo $row[0]["forward_req_user"];?></td></tr>
<tr><td>Forward Comment</td><td><?echo $row[0]["forward_comment"];?></td></tr>
<tr><td>Forward Back Comment</td>  <td><?echo $row[0]["forward_back_comment"];?></td></tr>
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
if($row[0]["final_status"]==1 && $row[0]["close_date"]!="")
{
echo date("d-M-Y h:i:s A",strtotime($row[0]["close_date"]));
}
else
{
	echo "";
}

?></td></tr>
</tbody></table>
</div>

	<?
	}
	}
?>