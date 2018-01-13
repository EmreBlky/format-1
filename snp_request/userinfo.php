<?php
session_start();
include("../connection.php");
//include_once(__DOCUMENT_ROOT.'/sqlconnection.php');

/*include($_SERVER["DOCUMENT_ROOT"]."/format/connection.php");
include($_SERVER["DOCUMENT_ROOT"]."/service/sqlconnection.php");*/

$q=$_GET["user_id"];

$veh_reg=$_GET["veh_reg"];
$row_id=$_GET["row_id"];
$inst_id=$_GET["inst_id"];
$comment=$_GET["comment"];

if(isset($_GET['action']) && $_GET['action']=='deletevehiclebackComment')
{
	
		$query = "SELECT forward_back_comment FROM deletion  where id=".$row_id;
	 $row=select_query($query);

	  
	$Updateapprovestatus="update deletion set forward_back_comment='".$row[0]["forward_back_comment"]."<br/>".date("Y-m-d H:i:s")." - " .$comment."' where id=".$row_id;
	
	
	//$Updateapprovestatus="update stop_gps set admin_comment='".$comment."' where id=".$row_id;
	if(mysql_query($Updateapprovestatus))
	echo "Comment added Successfully";
}
if(isset($_GET['action']) && $_GET['action']=='devicechangebackComment')
{
	
		$query = "SELECT forward_back_comment FROM device_change  where id=".$row_id;
	 $row=select_query($query);

	  
	$Updateapprovestatus="update device_change set forward_back_comment='".$row[0]["forward_back_comment"]."<br/>".date("Y-m-d H:i:s")." - " .$comment."' where id=".$row_id;
	
	
	//$Updateapprovestatus="update stop_gps set admin_comment='".$comment."' where id=".$row_id;
	if(mysql_query($Updateapprovestatus))
	echo "Comment added Successfully";
}

if(isset($_GET['action']) && $_GET['action']=='InstallationbackComment')
{

	$query = "SELECT sales_comment FROM installation  where id=".$row_id;
	 $row=select_query($query);

     $Updateapprovestatus="update installation set sales_comment='".$row[0]["sales_comment"]."<br/>".date("Y-m-d H:i:s")." - " .$comment."' where id=".$row_id;
	 mysql_query($Updateapprovestatus);
}

if(isset($_GET['action']) && $_GET['action']=='InstallationConfirm')
{
	$Updateapprovestatus="update installation set installation_status=1 where id=".$row_id;
	mysql_query($Updateapprovestatus);
	
}

if(isset($_GET['action']) && $_GET['action']=='AccCreationServiceComment')
{
	$query = "SELECT sales_comment FROM new_account_creation  where id=".$row_id;
	$row=select_query($query);
	  
	$Updateapprovestatus="update new_account_creation set sales_comment='".$row[0]["sales_comment"]."<br/>".date("Y-m-d H:i:s")." - ".$comment."', acc_creation_status='1' where id=".$row_id;
	
	//$Updateapprovestatus="update stop_gps set admin_comment='".$comment."' where id=".$row_id;
	if(mysql_query($Updateapprovestatus))
	echo "Comment added Successfully";
}


if(isset($_GET['action']) && $_GET['action']=='serviceComment')
{
	
		$query = "SELECT service_comment FROM device_change  where id=".$row_id;
	 $row=select_query($query);

	  
	$Updateapprovestatus="update device_change set service_comment='".$row[0]["service_comment"]."<br/>".date("Y-m-d H:i:s")." - " .$comment."' where id=".$row_id;
	
	
	//$Updateapprovestatus="update stop_gps set admin_comment='".$comment."' where id=".$row_id;
	if(mysql_query($Updateapprovestatus))
	echo "Comment added Successfully";
}

if(isset($_GET['action']) && $_GET['action']=='DevicecloseComment')
{
	
	$Updateapprovestatus="update device_change set close_comment='".date("Y-m-d H:i:s")." - " .$comment."',service_comment='".date("Y-m-d H:i:s")." - " .$comment."',final_status=1,close_date='".date("Y-m-d H:i:s")."' where id=".$row_id;
	
	mysql_query($Updateapprovestatus);
}

if(isset($_GET['action']) && $_GET['action']=='newdeviceadditionbackComment')
{
	
		$query = "SELECT forward_back_comment FROM new_device_addition  where id=".$row_id;
	 $row=select_query($query);

	  
	$Updateapprovestatus="update new_device_addition set forward_back_comment='".$row[0]["forward_back_comment"]."<br/>".date("Y-m-d H:i:s")." - " .$comment."' where id=".$row_id;
	
	
	//$Updateapprovestatus="update stop_gps set admin_comment='".$comment."' where id=".$row_id;
	if(mysql_query($Updateapprovestatus))
	echo "Comment added Successfully";
}
if(isset($_GET['action']) && $_GET['action']=='vehiclenochangebackComment')
{
	
		$query = "SELECT forward_back_comment FROM vehicle_no_change  where id=".$row_id;
	 $row=select_query($query);

	  
	$Updateapprovestatus="update vehicle_no_change set forward_back_comment='".$row[0]["forward_back_comment"]."<br/>".date("Y-m-d H:i:s")." - " .$comment."' where id=".$row_id;
	
	
	//$Updateapprovestatus="update stop_gps set admin_comment='".$comment."' where id=".$row_id;
	if(mysql_query($Updateapprovestatus))
	echo "Comment added Successfully";
}

if(isset($_GET['action']) && $_GET['action']=='vehicleserviceComment')
{
	
	 $query = "SELECT service_comment FROM vehicle_no_change  where id=".$row_id;
	 $row=select_query($query);

	$Updateapprovestatus="update vehicle_no_change set service_comment='".$row[0]["service_comment"]."<br/>".date("Y-m-d H:i:s")." - " .$comment."' where id=".$row_id;
	
	if(mysql_query($Updateapprovestatus))
	echo "Comment added Successfully";
}

if(isset($_GET['action']) && $_GET['action']=='vehiclecloseComment')
{
	
	$Updateapprovestatus="update vehicle_no_change set close_comment='".date("Y-m-d H:i:s")." - " .$comment."',final_status=1,close_date='".date("Y-m-d H:i:s")."' where id=".$row_id;
	
	mysql_query($Updateapprovestatus);
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

if(isset($_GET['action']) && $_GET['action']=='SimcloseComment')
{
	
	$Updateapprovestatus="update sim_change set close_comment='".date("Y-m-d H:i:s")." - " .$comment."',final_status=1,close_date='".date("Y-m-d H:i:s")."' where id=".$row_id;
	
	mysql_query($Updateapprovestatus);
}

if(isset($_GET['action']) && $_GET['action']=='ReactivateUserAccount')
{
	
		$query = "SELECT * FROM deactivation_of_account  where id=".$row_id;
	   $row=select_query($query);
		
		$Updateapprovestatus="update deactivation_of_account set reactivate_status='Y',ractivate_date='".date("Y-m-d H:i:s")."' where id=".$row_id;
		mysql_query($Updateapprovestatus);
		
		$ractivate_query="INSERT INTO `reactivation_of_account` (`date`, `acc_manager`,`sales_manager`, `company`, `user_id`, `total_no_of_vehicles`,`reactivate_account_status`,`deactivate_temp`,`deact_reason`,`reason`,`deact_req_date`,`deact_close_date`) 
		VALUES ('".date("Y-m-d H:i:s")."','".$row[0]["acc_manager"]."','".$row[0]["sales_manager"]."','".$row[0]["company"]."','".$row[0]["user_id"]."','".$row[0]["total_no_of_vehicles"]."','Y','".$row[0]["deactivate_temp"]."','".$row[0]["reason"]."','".$comment."','".$row[0]["date"]."','".$row[0]["close_date"]."')";
		
		mysql_query($ractivate_query);
	  
}

if(isset($_GET['action']) && $_GET['action']=='deactivateaccountbackComment')
{
	
		$query = "SELECT forward_back_comment FROM deactivation_of_account  where id=".$row_id;
	 $row=select_query($query);

	  
	$Updateapprovestatus="update deactivation_of_account set forward_back_comment='".$row[0]["forward_back_comment"]."<br/>".date("Y-m-d H:i:s")." - " .$comment."' where id=".$row_id;
	
	
	//$Updateapprovestatus="update stop_gps set admin_comment='".$comment."' where id=".$row_id;
	if(mysql_query($Updateapprovestatus))
	echo "Comment added Successfully";
}

if(isset($_GET['action']) && $_GET['action']=='reactivateaccountbackComment')
{
	
		$query = "SELECT forward_back_comment FROM reactivation_of_account  where id=".$row_id;
	 $row=select_query($query);

	  
	$Updateapprovestatus="update reactivation_of_account set forward_back_comment='".$row[0]["forward_back_comment"]."<br/>".date("Y-m-d H:i:s")." - " .$comment."' where id=".$row_id;
	
	if(mysql_query($Updateapprovestatus))
	echo "Comment added Successfully";
}


if(isset($_GET['action']) && $_GET['action']=='simchangeserviceComment')
{
	
		$query = "SELECT service_comment FROM sim_change  where id=".$row_id;
	 $row=select_query($query);

	$Updateapprovestatus="update sim_change set service_comment='".$row[0]["service_comment"]."<br/>".date("Y-m-d H:i:s")." - " .$comment."' where id=".$row_id;
	
	if(mysql_query($Updateapprovestatus))
	echo "Comment added Successfully";
}

if(isset($_GET['action']) && $_GET['action']=='devicelostbackComment')
{
	
		$query = "SELECT forward_back_comment FROM device_lost  where id=".$row_id;
	 $row=select_query($query);

	  
	$Updateapprovestatus="update device_lost set forward_back_comment='".$row[0]["forward_back_comment"]."<br/>".date("Y-m-d H:i:s")." - " .$comment."' where id=".$row_id;
	
	
	//$Updateapprovestatus="update stop_gps set admin_comment='".$comment."' where id=".$row_id;
	if(mysql_query($Updateapprovestatus))
	echo "Comment added Successfully";
}
if(isset($_GET['action']) && $_GET['action']=='deactivatesimbackComment')
{
	
		$query = "SELECT forward_back_comment FROM deactivate_sim  where id=".$row_id;
	 $row=select_query($query);

	  
	$Updateapprovestatus="update deactivate_sim set forward_back_comment='".$row[0]["forward_back_comment"]."<br/>".date("Y-m-d H:i:s")." - " .$comment."' where id=".$row_id;
	
	
	//$Updateapprovestatus="update stop_gps set admin_comment='".$comment."' where id=".$row_id;
	if(mysql_query($Updateapprovestatus))
	echo "Comment added Successfully";
}

if(isset($_GET['action']) && $_GET['action']=='dimtsimeibackComment')
{
	
		$query = "SELECT forward_back_comment FROM dimts_imei  where id=".$row_id;
	 $row=select_query($query);

	  
	$Updateapprovestatus="update dimts_imei set forward_back_comment='".$row[0]["forward_back_comment"]."<br/>".date("Y-m-d H:i:s")." - " .$comment."' where id=".$row_id;
	
	
	//$Updateapprovestatus="update stop_gps set admin_comment='".$comment."' where id=".$row_id;
	if(mysql_query($Updateapprovestatus))
	echo "Comment added Successfully";
}

if(isset($_GET['action']) && $_GET['action']=='RenewdimtsimeibackComment')
{
	
		$query = "SELECT forward_back_comment FROM renew_dimts_imei  where id=".$row_id;
	 $row=select_query($query);

	$Updateapprovestatus="update renew_dimts_imei set forward_back_comment='".$row[0]["forward_back_comment"]."<br/>".date("Y-m-d H:i:s")." - " .$comment."' where id=".$row_id;
	
	if(mysql_query($Updateapprovestatus))
	echo "Comment added Successfully";
}

if(isset($_GET['action']) && $_GET['action']=='aacountcreationbackComment')
{
	
		$query = "SELECT forward_back_comment FROM new_account_creation  where id=".$row_id;
	 $row=select_query($query);

	  
	$Updateapprovestatus="update new_account_creation set forward_back_comment='".$row[0]["forward_back_comment"]."<br/>".date("Y-m-d H:i:s")." - " .$comment."' where id=".$row_id;
	
	
	//$Updateapprovestatus="update stop_gps set admin_comment='".$comment."' where id=".$row_id;
	if(mysql_query($Updateapprovestatus))
	echo "Comment added Successfully";
}

if(isset($_GET['action']) && $_GET['action']=='RenewDimtsImiei')
{
	
		$query = "SELECT * FROM dimts_imei  where id=".$row_id;
	   $row=select_query($query);
		
		$Updateapprovestatus="update dimts_imei set renew_status='Y',renew_date='".date("Y-m-d H:i:s")."' where id=".$row_id;
		mysql_query($Updateapprovestatus);
		
		$renew_query="INSERT INTO `renew_dimts_imei` (`date`,sales_manager,acc_manager,`client`,`user_id`,`veh_reg`, `device_imei_7`,device_imei_15,port_change,reason) 
		VALUES ('".date("Y-m-d H:i:s")."','".$row[0]["sales_manager"]."','".$row[0]["acc_manager"]."','".$row[0]["client"]."','".$row[0]["user_id"]."','".$row[0]["veh_reg"]."','".$row[0]["device_imei_7"]."','".$row[0]["device_imei_15"]."','".$row[0]["port_change"]."','".$comment."')";
		
		mysql_query($renew_query);	  
}

if(isset($_GET['action']) && $_GET['action']=='getdata')
{
  
  $result="select services.id as id,services.id,veh_reg from matrix.services
 
		where services.id in 
		
		(select distinct sys_service_id from matrix.group_services where active=true and sys_group_id in (
		
		select sys_group_id from matrix.group_users where sys_user_id=(".$q.")))";

																
$data=select_query_live_con($result);
//$result = mysql_query("SELECT veh_reg FROM vehicles WHERE user_id = '".$q."'");ShowDeviceInfo(this.value);

$msg=' <select name="veh_reg" id="<?=$select_id?>" onchange="getdeviceImei(this.value,\'TxtDeviceIMEI\');getInstaltiondate(this.value,\'date_of_install\');getdevicemobile(this.value,\'Devicemobile\');">
<option value="0">Select Vehicle No</option>';

//while($row = mysql_fetch_array($data))
for($i=0;$i<count($data);$i++)
  {
	if($i%3==0) { 
	$msg .="</tr><tr>";
	}
  $msg .="<option value='".$data[$i]['veh_reg']."'>".$data[$i]['veh_reg']."</option>";   
  
  }
  
  
  $msg .="</select>";
  
  echo $msg;
}


if(isset($_GET['action']) && $_GET['action']=='getdatareplce')
{
  
  $result="select services.id as id,services.id,veh_reg from matrix.services
 
		where services.id in 
		
		(select distinct sys_service_id from matrix.group_services where active=true and sys_group_id in (
		
		select sys_group_id from matrix.group_users where sys_user_id=(".$q.")))";

																
$data=select_query_live_con($result);
//$result = mysql_query("SELECT veh_reg FROM vehicles WHERE user_id = '".$q."'");ShowDeviceInfo(this.value);

$msg=' <select name="veh_reg_replce" id="veh_reg_replce" onchange="getdeviceImei(this.value,\'replaceDeviceIMEI\');getInstaltiondate(this.value,\'replacedate_of_install\');getInstaltiondate(this.value,\'replacedate_oInstaltiondate_install\');getdevicemobile(this.value,\'replaceDevicemobile\');">
<option value="0">Select Vehicle No</option>';
$i=0;
//while($row = mysql_fetch_array($data))
for($i=0;$i<count($data);$i++)
  {
	if($i%3==0) { 
	$msg .="</tr><tr>";
	}
  $msg .="<option value=".$data[$i]['veh_reg'].">".$data[$i]['veh_reg']."</option>";
  
  }
  
  
  $msg .="</select>";
  
  echo $msg;
}
 


if(isset($_GET['action']) && $_GET['action']=='total')
	{
		  $result="select services.id as id,services.id,veh_reg from matrix.services
 
			where services.id in 
			
			(select distinct sys_service_id from matrix.group_services where active=true and sys_group_id in (
			
			select sys_group_id from matrix.group_users where sys_user_id=(".$q.")))";

																
		$data = select_query_live_con($result);
		
		echo count($data);
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



if(isset($_GET['action']) && $_GET['action']=='deviceImei')
	{
		 
	$sql1="select imei from matrix.devices where id in (select sys_device_id from matrix.services where veh_reg='".$veh_reg."') limit 1";
	$row=select_query_live_con($sql1);
	 
 echo $row[0]["imei"];
	}
	
	
if(isset($_GET['action']) && $_GET['action']=='deviceMobile')
	{
		 
	   $sql1="select mobile_no from matrix.mobile_simcards where id in ( select sys_simcard from matrix.devices where id in (select sys_device_id from matrix.services where veh_reg='".$veh_reg."'))";
	$row=select_query_live_con($sql1);
	 
 	echo $row[0]["mobile_no"];
	}


if(isset($_GET['action']) && $_GET['action']=='installermobile')
	{
		
		$sql2="select installer_mobile as installer_mobile from installer where inst_id=".$inst_id;

		$row2=select_query($sql2);

		echo $row2[0]["installer_mobile"];
	}


if(isset($_GET['action']) && $_GET['action']=='Instaltiondate')
	{
		 
		$sql="select sys_created from matrix.services where veh_reg='".$veh_reg."' limit 1";
 
		$row=select_query_live_con($sql);

		echo date("Y-m-d",strtotime($row[0]["sys_created"]));
	}
	
	
if(isset($_GET['action']) && $_GET['action']=='dimts_imeiclose')
{
	$Updateapprovestatus="update dimts_imei set final_status=1 ,close_date='".date("Y-m-d H:i:s")."' where id=".$row_id;
	if(mysql_query($Updateapprovestatus))
	echo "Successfully closed";
}

if(isset($_GET['action']) && $_GET['action']=='Renewdimts_imeiclose')
{
	$Updateapprovestatus="update renew_dimts_imei set final_status=1 ,close_date='".date("Y-m-d H:i:s")."' where id=".$row_id;
	if(mysql_query($Updateapprovestatus))
	echo "Successfully closed";
}

if(isset($_GET['action']) && $_GET['action']=='Port_change')
{
	$Updateapprovestatus="update renew_dimts_imei set port_change_status='Yes' where id=".$row_id;
	if(mysql_query($Updateapprovestatus))
	echo "Successfully Submit";
}
	
if(isset($_GET['action']) && $_GET['action']=='debugComment')
{
	
	
	 $Comment_by=$_SESSION['username'];
	
	    //$Updateapprovestatus="update device_lost set account_comment='".addslashes($comment)."' where id=".$row_id;
		  $Updateapprovestatus="insert into comment(service_id,comment,comment_by) values('".$row_id."','".addslashes($comment)."','".$Comment_by."')";
	 //if(mysql_query($Updateapprovestatus))
	  echo "Comment Added Successfully";
	
 }

	
 ?>
 

 
 <?
 

	if(isset($_GET['action']) && $_GET['action']=='getrowSales')
	{
		 
		 
			$RowId=$_GET["RowId"];
			$tablename=$_GET["tablename"];
			
	 ?>
	 
	  <style type="text/css">
#databox{width:840px; height:650px; margin: 30px auto auto; border:1px solid #bfc0c1; font-family:Arial, Helvetica, sans-serif; font-size:13px; font-weight:normal; color:#3f4041;}
.heading{ font-family:Arial, Helvetica, sans-serif; font-size:30px; font-weight:700; word-spacing:5px; text-align:center;   color:#3E3E3E;   background-color:#ECEFE7; margin-bottom:10px;  }
.dataleft{float:left; width:400px; height:400px; margin-left:10px; border-right:1px solid #bfc0c1;}
.dataright{float:right; width:400px; height:400px; margin-left:19px;}
td{padding-right:20px; padding-left:20px;}
</style>
 
<?

If($tablename=="device_change")
		{
	$query = "SELECT * FROM ".$tablename." where id=".$RowId;
			$row=select_query($query);
	?>
	
	
	<div id="databox">
<div class="heading">
	View Device Change</div>
	<div class="dataleft">
<table cellspacing="2" cellpadding="2">	 
     
     
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
<tr><td>Date of installation </td><td><?echo $row[0]["date_of_install"];?></td></tr>
<? $sql="SELECT Userid AS id,UserName AS sys_username FROM addclient  WHERE Userid=".$row[0]["rdd_username"];
	$rowuser_old=select_query($sql);
	?>
<tr><td>Replaced Device Details</td><td>---------------------------</td></tr>
<tr><td>Client User</td><td><?echo $rowuser_old[0]["sys_username"];?></td></tr>
<tr><td>Client Name</td><td><?echo $row[0]["rdd_companyname"];?></td></tr>
<tr><td>Device Type</td><td><?echo $row[0]["rdd_device_type"];?></td></tr>
<tr><td>Device Model</td><td><?echo $row[0]["rdd_device_model"];?></td></tr>
<tr><td>Vehicle No</td><td><?echo $row[0]["rdd_reg_no"];?></td></tr>
<tr><td>IMEI</td><td><?echo $row[0]["rdd_device_imei"];?></td></tr>
<tr><td>Mobile Number</td><td><?echo $row[0]["rdd_device_mobile_num"];?></td></tr>
<tr><td>Date of installation </td><td><?echo $row[0]["rdd_date_replace"];?></td></tr>
<tr><td>Installer Name </td><td><?echo $row[0]["inst_name"];?></td></tr>
</table></div>

<div class="dataright">
<table cellspacing="2" cellpadding="2">
<tr><td>Billing</td><td><?echo $row[0]["billing"];?></td></tr>
<tr><td>Billing Amount</td><td><?echo $row[0]["billing_amount"];?></td></tr>
<tr><td>Reason</td><td><?echo $row[0]["rdd_reason"];?></td></tr> 
<!--<tr><td>Admin Approval</td>  <td><?if($row[0]["approve_status"]==1) echo "Approved"; else echo "Pending Approval"?></td></tr>-->
<tr><td><strong>Process Pending </strong></td>  <td><strong>
<?  if($row[0]["device_change_status"]==2 || (($row[0]["support_comment"]!="" || $row[0]["admin_comment"]!="") && $row[0]["service_comment"]==""))
	{echo "Reply Pending at Request Side";}
	elseif($row[0]["account_comment"]=="" && $row[0]["pay_status"]=="" && $row[0]["approve_status"]==0 && $row[0]["final_status"]==0){echo "Pending at Accounts";} 
	elseif($row[0]["approve_status"]==0 && $row[0]["forward_req_user"]!="" && $row[0]["forward_back_comment"]=="" && $row[0]["device_change_status"]==1)	
	{echo "Pending Admin Approval (Req Forward to ".$row[0]["forward_req_user"].")";}
	elseif($row[0]["approve_status"]==0 && ($row[0]["account_comment"]!="" || $row[0]["pay_status"]!="") && $row[0]["final_status"]==0 && $row[0]["device_change_status"]==1)
	{echo "Pending Admin Approval";}
	elseif($row[0]["approve_status"]==1 && $row[0]["device_change_status"]==1 && $row[0]["final_status"]!=1){echo "Pending at Tech Support Team";}
	elseif($row[0]["final_status"]==1){echo "Process Done";}?></strong></td></tr>

<tr><td>Payment Pending </td>  <td><?echo $row[0]["pay_status"];?></td></tr>
<tr><td>Account Comment</td>  <td><?echo $row[0]["account_comment"];?></td></tr>
 <tr><td>Service Comment</td>  <td><?echo $row[0]["service_comment"];?></td></tr>
<tr><td>Support Comment</td><td><?echo $row[0]["support_comment"];?></td></tr>
<tr><td>Admin Comment</td><td><?echo $row[0]["admin_comment"];?></td></tr>
<tr><td>Req Forwarded to</td><td><?echo $row[0]["forward_req_user"];?></td></tr>
<tr><td>Forward Comment</td><td><?echo $row[0]["forward_comment"];?></td></tr>
<tr><td>F/W Request Back Comment</td><td><?echo $row[0]["forward_back_comment"];?></td></tr>
<?php if($row[0]["close_comment"]!=""){?>
<tr><td>Close Reason</td><td><?echo $row[0]["close_comment"];?></td></tr>
<?php } ?>
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
	</table>
	</div> 
	</div>	
	<? }


	else If($tablename=="new_account_creation")
		{
	$query = "SELECT * FROM ".$tablename." where id=".$RowId;
			$row=select_query($query);
	?>
	
	
	
	
	
	<div id="databox">
<div class="heading">New account creation</div>
<div class="dataleft"><table cellspacing="2" cellpadding="2">
	 
<tbody><tr><td>Date</td><td><?echo date("d-M-Y h:i:s A",strtotime($row[0]["date"]));?></td></tr>

<? /*if($row[0]["account_manager"]=='saleslogin') {
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
<tr><td>Contact No.</td><td><?echo $row[0]["contact_number"];?></td></tr>
<tr><td>Billing Name</td><td><?echo $row[0]["billing_name"];?></td></tr>
<tr><td>Billing Add</td><td><?echo $row[0]["billing_address"];?></td></tr>
<tr><td>Payment Mode</td><td><?echo $row[0]["mode_of_payment"];?></td></tr>
<tr><td>Demo Period</td><td><?echo $row[0]["demo_time"];?></td></tr>
<tr><td>Device Price </td><td><?echo $row[0]["device_price"];?></td></tr>	
<tr><td>Vat(5%) </td><td><?echo $row[0]["device_price_vat"];?></td></tr>	
<tr><td>Total </td><td><?echo $row[0]["device_price_total"];?></td></tr>	
<tr><td>Rent </td><td><?echo $row[0]["device_rent_Price"];?></td></tr>	
<tr><td>Service Tex(12.36%) </td><td><?echo $row[0]["device_rent_service_tax"];?></td></tr>	
<tr><td>Total Rent</td><td><?echo $row[0]["DTotalREnt"];?></td></tr>
<tr><td>Dimts Fee status </td><td><?echo $row[0]["dimts_fee"];?></td></tr>
<tr><td>Rent Status</td><td><?echo $row[0]["rent_status"];?></td></tr>
<tr><td>Rent Month</td><td><?echo $row[0]["rent_month"];?></td></tr>
<tr><td>Dimts</td><td><?echo $row[0]["dimts"];?></td></tr>
<tr><td>Account Type</td><td><?echo $row[0]["account_type"];?></td></tr>
</tbody></table></div>
<div class="dataright">
<table cellspacing="2" cellpadding="2"><tbody>
<tr><td>Type of Organisation</td><td><?echo $row[0]["type_of_org"];?></td></tr>
<tr><td>PAN No.</td><td><?echo $row[0]["pan_no"];?></td></tr>
<tr><td> Copy of Pan Card</td><td><?echo $row[0]["pan_card"];?></td></tr>
<tr><td>Copy of Address Proof</td><td><?echo $row[0]["address_proof"];?></td></tr>
<tr><td>Vehicle type</td><td><?echo $row[0]["vehicle_type"];?></td></tr>
<tr><td>Immobilizer</td><td><?echo $row[0]["immobilizer"];?></td></tr>
<tr><td>AC</td><td><?echo $row[0]["ac_on_off"];?></td></tr>
<tr><td>E_mail ID</td>  <td><?echo $row[0]["email_id"];?></td></tr>
<tr><td>User Name</td><td><?echo $row[0]["user_name"];?></td></tr>
<tr><td>Password</td><td><?echo $row[0]["user_password"];?></td></tr>
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


	<?}


	else If($tablename=="imei_change")
		{
		  $query = "SELECT * FROM ".$tablename." where id=".$RowId; 
			$row=select_query($query);
	?><div id="databox">
<div class="heading">IMEI Change</div>
<div class="dataleft"><table cellspacing="2" cellpadding="2">
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
<tr><td>Replaced IMEI Details</td><td>---------------------------</td></tr>
 
<tr><td>Device Model</td><td><?echo $row[0]["new_devicetype"];?></td></tr>
<tr><td>IMEI</td><td><?echo $row[0]["new_device_imei"];?></td></tr>
<tr><td>Device ID</td><td><?echo $row[0]["new_deviceid"];?></td></tr>
<tr><td>Mobile Number</td><td><?echo $row[0]["new_sim"];?></td></tr>
<tr><td>Replace Date</td><td><?echo $row[0]["replace_date"];?></td></tr>
<tr><td>Payment Status</td><td><?echo $row[0]["payment_status"];?></td></tr>
<tr><td>Reason</td><td><?echo $row[0]["reason"];?></td></tr> 
</table></div>
<div class="dataright">
<table cellspacing="2" cellpadding="2"><tbody>

 <tr><td>Admin Approval</td>  <td><?if($row[0]["approve_status"]==1) echo "Approved"; else echo "Pending Approval"?></td></tr>
<tr><td>Account Comment</td>  <td><?echo $row[0]["account_comment"];?></td></tr>
 <tr><td>Service Comment</td>  <td><?echo $row[0]["service_comment"];?></td></tr>
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
	</tr></tbody></table></div></div>

 
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

<tr><td>Veh No.</td><td><?echo $row[0]["vehicle"];?></td></tr>

<tr><td>Device IMEI</td><td><?echo $row[0]["device_imei"];?></td></tr>
<tr><td>Mobile Number</td><td><?echo $row[0]["device_sim"];?></td></tr>
<tr><td>Present Status of Device</td><td>---------------------------</td></tr>
<tr><td>Location</td><td><?echo $row[0]["ps_of_location"];?></td></tr>
<tr><td>Ownership</td><td><?echo $row[0]["ps_of_ownership"];?></td></tr>
<tr><td>SIM Status</td><td><?echo $row[0]["sim_status"];?></td></tr>
<tr><td>Change Date</td><td><?echo $row[0]["change_date"];?></td></tr>
<tr><td>Reason</td><td><?echo $row[0]["replace_date"];?></td></tr>
</table></div>
<div class="dataright">
<table cellspacing="2" cellpadding="2"><tbody>

<!--<tr><td>Admin Approval</td>  <td><?if($row[0]["approve_status"]==1) echo "Approved"; else echo "Pending Approval"?></td></tr>-->
<tr><td><strong>Process Pending </strong></td>  <td><strong>
<?  if($row[0]["account_comment"]=="" && $row[0]["final_status"]==0){echo "Pending at Accounts";} 
	elseif($row[0]["final_status"]==1){echo "Process Done";}?></strong></td></tr>
 
<tr><td>Account Comment</td>  <td><?echo $row[0]["account_comment"];?></td></tr>
<tr><td>Service Comment</td>  <td><?echo $row[0]["service_comment"];?></td></tr>
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
	</tr></tbody></table></div></div>
 
 
 <?}
    
    
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

	elseIf($tablename=="new_device_addition")
		{

		  $query = "SELECT * FROM ".$tablename." where id=".$RowId; 
			$row=select_query($query);

	?>
	
	<div id="databox">
<div class="heading">View New device Addition</div>
<div class="dataleft"><table cellspacing="2" cellpadding="2">

<tr><td>Date</td><td><?echo date("d-M-Y h:i:s A",strtotime($row[0]["date"]));?></td></tr>
<tr><td>Request By</td><td><?echo $row[0]["acc_manager"];?></td></tr>
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
if($row[0]["device_type"]=='Old' || $row[0]["device_type"]=='old') 
{
	$Deviceid=$row[0]["old_device_id"];
}
else {
	$Deviceid=$row[0]["device_id"];
}

?>
<tr><td>Device ID </td><td><?echo $Deviceid;?></td></tr>	
<tr><td>Device Mobile Number 	</td><td><?echo $row[0]["device_sim_num"];?></td></tr>
<tr><td>OLD Date Of Installation </td><td><?echo $row[0]["olddate_of_installation"];?></td></tr>	
<? /*if($row[0]["device_type"]=='New'){
$biliing_status=$row[0]["billing"];
}
else{
$biliing_status=$row[0]["billing_if_old_device"];
}*/
	?>
<tr><td>Billing</td><td><?echo $row[0]["billing"];?></td></tr>
<tr><td>Billing Reason</td><td><?echo $row[0]["billing_if_no_reason"];?></td></tr>
</table></div>
 
<div class="dataright">
<table cellspacing="2" cellpadding="2"><tbody>

<tr><td>Installer</td><td><?echo $row[0]["inst_name"];?></td></tr>
<tr><td>Dimts</td><td><?echo $row[0]["dimts"];?></td></tr>
<tr><td>Immobilizer  </td><td><?echo $row[0]["immobilizer"];?></td></tr>
<tr><td>AC 	 </td><td><?echo $row[0]["ac"];?></td></tr>
 <tr><td><strong>Process Pending</strong> </td>  <td><strong>
<?  if($row[0]["new_device_status"]==2 || ($row[0]["support_comment"]!="" && $row[0]["service_comment"]=="")){echo "Reply Pending at Request Side";}
	elseif($row[0]["new_device_status"]==1 && $row[0]["final_status"]!=1){echo "Pending at Tech Support Team";}
	elseif($row[0]["final_status"]==1){echo "Process Done";}?></strong></td></tr>

<tr><td>Account Comment</td>  <td><?echo $row[0]["account_comment"];?></td></tr>
 <tr><td>Service Comment</td>  <td><?echo $row[0]["service_comment"];?></td></tr>
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

	</table>
	</div> 
	</div> 



	<? }
	elseIf($tablename=="installer")
		{

		  $query = "SELECT * FROM ".$tablename." where id=".$RowId; 
			$row=select_query($query);

	?><div > <div style=" padding-left: 50px;">
	<h1>View Installer Contact Info</h1> </div>
	<div class="table">
	<table cellspacing="2" cellpadding="2" style=" padding-left: 100px;width: 500px;">
	 
     

<tr><td>Installer Name</td><td><?echo $row[0]["inst_name"];?></td></tr>
<tr><td>Address</td><td><?echo $row[0]["address"];?></td></tr>
<tr><td>E-mail</td><td><?echo $row[0]["email"];?></td></tr>
<tr><td>Mobile No. 	</td><td><?echo $row[0]["installer_mobile"];?></td></tr>
<? $sql="select * from gtrac_branch where id=".$row[0]["branch_id"];
	$rowuser=select_query($sql);
	?>
<tr><td>Branch Name</td><td><?echo $rowuser[0]["branch_name"];?></td></tr> 	
<tr><td>Status</td><td><?echo $row[0]["status"];?></td></tr>	
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
 
<tr><td>Date </td><td><?echo date("d-M-Y h:i:s A",strtotime($row[0]["date"]));?></td></tr> 	
<tr><td>Request By</td><td><?echo $row[0]["acc_manager"];?></td></tr>
<tr><td>Account Manager</td><td><?echo $row[0]["sales_manager"];?></td></tr>
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
<tr><td>Vehicle No Change Reason </td><td><?echo $row[0]["reason"];?></td></tr>	
<tr><td>Installer Name </td><td><?echo $row[0]["inst_name"];?></td></tr>
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
	else If($tablename=="dimts_imei")
		{
		 $query = "SELECT * FROM ".$tablename." where id=".$RowId; 
			$row=select_query($query);
	?>
	<div id="databox">
<div class="heading">View Dimts IMEI Details</div>
<div class="dataleft"><table cellspacing="2" cellpadding="2">
    <tbody> 
 
<tr><td>Date </td><td><?echo date("d-M-Y h:i:s A",strtotime($row[0]["date"]));?></td></tr> 	
<tr><td>Request By</td><td><?echo $row[0]["acc_manager"];?></td></tr>
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
<tr><td>Req Forwarded to</td><td><?echo $row[0]["forward_req_user"];?></td></tr>
<tr><td>Forward Comment</td><td><?echo $row[0]["forward_comment"];?></td></tr>
<tr><td>F/W Request Back Comment</td><td><?echo $row[0]["forward_back_comment"];?></td></tr>
<tr><td>Account Comment</td>  <td><?echo $row[0]["account_comment"];?></td></tr>
 <tr><td>Payment Pending</td>  <td><?echo $row[0]["payment_status"];?></td></tr>
<tr><td>Service Comment</td>  <td><?echo $row[0]["service_comment"];?></td></tr>
<tr><td>Support Comment</td><td><?echo $row[0]["support_comment"];?></td></tr>
<tr><td>Reason for Imei not uploading</td><td><?echo $row[0]["imei_upload_reason"];?></td></tr>
<tr><td>Repair Comment</td><td><?echo $row[0]["repair_comment"];?></td></tr>
<tr><td>Reason for Port not changing</td><td><?echo $row[0]["port_change_reason"];?></td></tr>
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
	else If($tablename=="renew_dimts_imei")
		{
		 $query = "SELECT * FROM ".$tablename." where id=".$RowId; 
			$row=select_query($query);

 
  
	?>
	<div id="databox">
<div class="heading">View Renew Dimts IMEI Details</div>
<div class="dataleft"><table cellspacing="2" cellpadding="2">
    <tbody> 
 
<tr><td>Date </td><td><?echo date("d-M-Y h:i:s A",strtotime($row[0]["date"]));?></td></tr> 	
<tr><td>Request By</td><td><?echo $row[0]["acc_manager"];?></td></tr>
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
<tr><td>Port Change Status</td><td><?echo $row[0]["port_change_status"];?></td></tr>

</tbody></table></div>
 
<div class="dataright">
<table cellspacing="2" cellpadding="2"><tbody>
<!--<tr><td>Admin Approval</td>  <td><?if($row[0]["approve_status"]==1) echo "Approved"; else echo "Pending Approval"?></td></tr>-->
<tr><td><strong>Process Pending </strong></td>  <td><strong>
<?  if($row[0]["renew_dimts_status"]==2 || ( $row[0]["admin_comment"]!="" && $row[0]["service_comment"]=="")){echo "Reply Pending at Request Side";}
	elseif($row[0]["account_comment"]=="" && $row[0]["payment_status"]=="" && $row[0]["approve_status"]==0 && $row[0]["final_status"]==0){echo "Pending at Accounts";} 
	elseif($row[0]["approve_status"]==0 && $row[0]["forward_req_user"]!="" && $row[0]["forward_back_comment"]=="" && $row[0]["renew_dimts_status"]==1)	
	{echo "Pending Admin Approval (Req Forward to ".$row[0]["forward_req_user"].")";}
	elseif($row[0]["approve_status"]==0 && $row[0]["payment_status"]!="" && $row[0]["final_status"]==0 && $row[0]["renew_dimts_status"]==1)
	{echo "Pending Admin Approval";}
	elseif(($row[0]["approve_status"]==1 || $row[0]["account_comment"]!="") && $row[0]["renew_dimts_status"]==1 && $row[0]["repair_comment"]=="" && $row[0]["port_change_status"]=="Yes" && $row[0]["final_status"]!=1)
	{echo "Pending at Repair For Port Change";}
	elseif(($row[0]["repair_comment"]!="" || ($row[0]["port_change_status"]!="Yes" && ($row[0]["approve_status"]==1 || $row[0]["account_comment"]!="")))&& $row[0]["final_status"]!=1){echo "Process Not Closed Request End";}
	elseif($row[0]["final_status"]==1){echo "Process Done";}?></strong></td></tr>

<tr><td>Admin Comment</td><td><?echo $row[0]["admin_comment"];?></td></tr>
<tr><td>Req Forwarded to</td><td><?echo $row[0]["forward_req_user"];?></td></tr>
<tr><td>Forward Comment</td><td><?echo $row[0]["forward_comment"];?></td></tr>
<tr><td>F/W Request Back Comment</td><td><?echo $row[0]["forward_back_comment"];?></td></tr>
<tr><td>Account Comment</td>  <td><?echo $row[0]["account_comment"];?></td></tr>
 <tr><td>Payment Pending</td>  <td><?echo $row[0]["payment_status"];?></td></tr>
<tr><td>Service Comment</td>  <td><?echo $row[0]["service_comment"];?></td></tr>
<!--<tr><td>Support Comment</td><td><?echo $row[0]["support_comment"];?></td></tr>
<tr><td>Reason for Imei not uploading</td><td><?echo $row[0]["imei_upload_reason"];?></td></tr>-->
<tr><td>Repair Comment</td><td><?echo $row[0]["repair_comment"];?></td></tr>
<tr><td>Reason for Port not changing</td><td><?echo $row[0]["port_change_reason"];?></td></tr>
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

	?>
	<div id="databox">
<div class="heading">View Mobile Number Change</div>
<div class="dataleft"><table cellspacing="2" cellpadding="2">
    <tbody> 
    
    
<tr><td>Date </td><td><?echo date("d-M-Y h:i:s A",strtotime($row[0]["date"]));?></td></tr> 	
<tr><td>Request By</td><td><?echo $row[0]["acc_manager"];?></td></tr>
<tr><td>Account Manager</td><td><?echo $row[0]["sales_manager"];?></td></tr>
<? $sql="SELECT Userid AS id,UserName AS sys_username FROM addclient  WHERE Userid=".$row[0]["user_id"];
	$rowuser=select_query($sql);
	?>
 <tr><td>Client User Name 	</td><td><?echo $rowuser[0]["sys_username"];?></td></tr>	
<tr><td>Company Name </td><td><?echo $row[0]["client"];?></td></tr>		
<tr><td>Registration No</td><td><?echo $row[0]["reg_no"];?></td></tr>	 	
<tr><td>Old Mobile Number </td><td><?echo $row[0]["old_sim"];?></td></tr>
<tr><td>New Mobile Number </td><td><?echo $row[0]["new_sim"];?></td></tr>	
 <tr><td>Sim Change Date 	</td><td><?echo $row[0]["sim_change_date"];?></td></tr>	
<tr><td>Reason </td><td><?echo $row[0]["reason"];?></td></tr>	
<tr><td>Installer Name </td><td><?echo $row[0]["inst_name"];?></td></tr>
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
<tr><td>Req Forwarded to</td><td><?echo $row[0]["forward_req_user"];?></td></tr>
<tr><td>Forward Comment</td><td><?echo $row[0]["forward_comment"];?></td></tr>
<tr><td>F/W Request Back Comment</td><td><?echo $row[0]["forward_back_comment"];?></td></tr>
<?php if($row[0]["close_comment"]!=""){?>
<tr><td>Close Reason</td><td><?echo $row[0]["close_comment"];?></td></tr>
<?php } ?>
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
	else If($tablename=="device_lost")
		{
		$query = "SELECT * FROM ".$tablename." where id=".$RowId; 
			$row=select_query($query);



	?><div id="databox">
<div class="heading">View Device Lost</div>
<div class="dataleft"><table cellspacing="2" cellpadding="2">
    <tbody> 
    
    

<tr><td>Date</td><td><?echo date("d-M-Y h:i:s A",strtotime($row[0]["date"]));?></td></tr>  	
<tr><td>Request By</td><td><?echo $row[0]["acc_manager"];?></td></tr>
<tr><td>Account Manager</td><td><?echo $row[0]["sales_manager"];?></td></tr>
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

<tr><td>Account Comment</td>  <td><?echo $row[0]["account_comment"];?></td></tr>
 <tr><td>Old Device Paid or Not</td>  <td><?echo $row[0]["odd_paid_unpaid"];?></td></tr>
  <tr><td>Service Comment</td>  <td><?echo $row[0]["service_comment"];?></td></tr>
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
	elseif($row[0]["approve_status"]==1 && $row[0]["delete_veh_status"]==1 && $row[0]["final_status"]!=1){echo "Pending at Tech Support Team";}
	elseif($row[0]["final_status"]==1){echo "Process Done";}?></strong></td></tr>

<tr><td>Account Comment</td>  <td><?echo $row[0]["account_comment"];?></td></tr>
 <tr><td>Old Device Paid or Not</td>  <td><?echo $row[0]["odd_paid_unpaid"];?></td></tr>
 <tr><td>Service Comment</td>  <td><?echo $row[0]["service_comment"];?></td></tr>
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


	else If($tablename=="stop_gps")
		{
		  $query = "SELECT * FROM ".$tablename." where id=".$RowId; 
			$row=select_query($query);
	?>
	
	<div id="databox">
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
<tr><td>Vehicle to Stop GPS </td><td><?echo $row[0]["reg_no"];?></td></tr>
<tr><td>Persent Status Of</td><td>:---</td></tr>
<tr><td>Location 	</td><td><?echo $row[0]["ps_of_location"];?></td></tr>
<tr><td>OwnerShip 	</td><td><?echo $row[0]["ps_of_ownership"];?></td></tr>
<tr><td>Data to Display 	</td><td><?echo $row[0]["data_display"];?></td></tr>
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
	elseif($row[0]["approve_status"]==1 && $row[0]["stop_gps_status"]==1 && $row[0]["final_status"]!=1){echo "Pending at Tech Support Team";}
	elseif($row[0]["final_status"]==1){echo "Process Done";}?></strong></td></tr>

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
	</tr></tbody>
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


	elseIf($tablename=="installation")
		{
	
	$query = "select * from  installation left join re_city_spr_1 on installation.Zone_area =re_city_spr_1.id where installation.id=".$RowId;
			$row=select_query($query);
	?>
	<div id="databox">
<div class="heading">Installation</div>
<div class="dataleft"><table cellspacing="2" cellpadding="2">
    <tbody><tr>
 <td> Date:  </td><td><?echo $row[0]["req_date"];?></td></tr>   	
<tr><td>Request By:  </td><td><?echo $row[0]["request_by"];?></td></tr>
<?  
$sales = select_query("select name from sales_person where id='".$row[0]['sales_person']."' ");
?>
<tr><td>Sales Person 	</td><td><?echo $sales[0]['name'];?></td></tr>
<? $sql="SELECT Userid AS id,UserName AS sys_username FROM addclient  WHERE Userid=".$row[0]["user_id"];
	$rowuser=select_query($sql);
	?>
<tr><td>Client User Name 	</td><td><?echo $rowuser[0]["sys_username"];?></td></tr>
<tr><td>Company Name	</td><td><?echo $row[0]["company_name"];?></td></tr>
<tr><td>No. Of Vehicales:   </td><td><?echo $row[0]["no_of_vehicals"];?></td></tr>
<tr><td>Approve Installation: </td><td><?echo $row[0]["installation_approve"];?></td></tr>
<tr><td>Area: </td><td><?echo $row[0]["name"];?></td></tr>   	

<?php if($row[0]['location']!=""){?>
<tr><td>Location: </td><td><?echo $row[0]["location"];?></td> </tr>
<?php }else{ $city= select_query("select * from tbl_city_name where branch_id='".$row[0]['inter_branch']."'");?>
<tr><td>Location: </td><td><?echo $city[0]["city"];?></td> </tr>
<?php }?>   	
<tr><td>Model:</td><td><?echo $row[0]["model"];?></td></tr>
<tr><td>Available Time Status: </td><td><?echo $row[0]["atime_status"];?></td></tr>	
<tr><td>Time:  </td><td><?echo $row[0]["time"];?></td></tr>  	
<tr><td>To Time:  </td><td><?echo $row[0]["totime"];?></td></tr> 	
<tr><td>Contact No.:</td><td><?echo $row[0]["contact_number"];?></td></tr>     	
<tr><td>Contact Person:   </td><td><?echo $row[0]["contact_person"];?></td></tr> 	
<tr><td>DIMTS:   </td><td><?echo $row[0]["dimts"];?></td></tr>  	
<tr><td>Demo:  </td><td><?echo $row[0]["demo"];?></td></tr>   	
<tr><td>Vehicle Type:  </td><td><?echo $row[0]["veh_type"];?></td></tr>   	
<tr><td>Immobilizer:  </td><td><?echo $row[0]["immobilizer_type"];?></td></tr>   
<tr><td>Comment:  </td><td><?echo $row[0]["comment"];?></td></tr>  
 
 </tr>

</tbody></table></div>



<div class="dataright">
<table cellspacing="2" cellpadding="2"><tbody>
<tr><td>Payment:  </td><td><?echo $row[0]["payment_req"];?></td> 
 <tr><td>Amount:  </td><td><?echo $row[0]["amount"];?></td> 
 <tr><td>Payment Mode:  </td><td><?echo $row[0]["pay_mode"];?></td> 
 <tr><td>Required.:</td><td><?echo $row[0]["required"];?></td></tr>     
<tr><td>IP Box.:    </td><td><?echo $row[0]["IP_Box"];?></td></tr>  
<tr><td>Contact Person No.:  </td><td><?echo $row[0]["contact_person_no"];?></td></tr>   
<tr><td>Installation Made:  </td><td><?echo $row[0]["installation_made"];?></td></tr>  
<tr><td>Installer Name: </td><td><?echo $row[0]["inst_name"];?></td></tr>  
<tr><td>Installer Current Location: </td><td><?echo $row[0]["inst_cur_location"];?></td></tr>  
<!--<tr><td>Change Installer Name: </td><td><?echo $row[0]["inst_cur_location"];?></td></tr>   
--><tr><td>Installation Done At: </td><td><?echo $row[0]["rtime"];?></td></tr>  
<tr><td>Reason To Back Services:</td><td><?echo $row[0]["back_reason"];?></td> </tr>
<tr><td><strong>Process Pending </strong></td>  <td><strong>
<?  if($row[0]["installation_status"]==7 && ($row[0]["admin_comment"]!="" || $row[0]["sales_comment"]=="")){echo "Reply Pending at Request Side";}
	elseif($row[0]["installation_status"]==7 && $row[0]["admin_comment"]=="" ){echo "Pending Saleslogin for Information";}
	elseif($row[0]["approve_status"]==0 && $row[0]["installation_status"]==8 ){echo "Pending Admin Approval";}
	elseif($row[0]["installation_status"]==9 && $row[0]["approve_status"]==1 ){echo "Pending Confirmation at Request Person";}
	elseif($row[0]["installation_status"]==1 ){echo "Pending Dispatch Team";}
	elseif($row[0]["installation_status"]==2 ){echo "Assign To Installer";}
	elseif($row[0]["installation_status"]==3 ){echo "Back Installation";}
	elseif($row[0]["installation_status"]==15 ){echo "Pending Remaining Installation";}
	elseif($row[0]["installation_status"]==5 || $row[0]["installation_status"]==6){echo "Installation Close";}?></strong></td></tr>

<?php if($_SESSION['BranchId']==1){?>
    <tr><td>Sales Comment</td>  <td><?echo $row[0]["sales_comment"];?></td></tr>
    <tr><td>Admin Comment</td><td><?echo $row[0]["admin_comment"];?></td></tr>
    <tr><td>Admin Approval</td>  <td><?if($row[0]["approve_status"]==1) echo "Approved"; else echo "Pending Approval"?></td></tr>
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
<?php } ?>
</tbody></table>
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
<tr><td>Date 	</td><td><?echo date("d-M-Y h:i:s A",strtotime($row[0]["date"]));?></td></tr>
<tr><td>Request By</td><td><?echo $row[0]["acc_manager"];?></td></tr>
<tr><td>Account Manager</td><td><?echo $row[0]["sales_manager"];?></td></tr>
<? $sql="SELECT Userid AS id,UserName AS sys_username FROM addclient  WHERE Userid=".$row[0]["client"];
	$rowuser=select_query($sql);
	?>
<tr><td>Client User Name 	</td><td><?echo $rowuser[0]["sys_username"];?></td></tr>
<tr><td>Company Name 	</td><td><?echo $row[0]["company_name"];?></td></tr>
<!--<tr><td>Vehicle Num</td><td><?echo $row[0]["reg_no"];?></td></tr>-->

<tr><td>Vehicle Num </td><td><?php $vechile_no = explode(",",$row[0]["reg_no"]); 
for($i=0;$i<=count($vechile_no);$i++){ if($i%3!=0){ echo $vechile_no[$i].", ";}else { echo "<br/>".$vechile_no[$i].", ";} }?></td></tr>

<tr><td>Total no of Vehicles </td><td><?echo $row[0]["tot_no_of_vehicles"];?></td></tr>
<tr><td>Vehicles for no bill</td><td><?echo $row[0]["veh_no_bill"];?></td></tr>
<tr><td>No Bill For	</td><td><?echo $row[0]["rent_device"];?></td></tr> 
<tr><td>Reason	</td><td><?echo $row[0]["reason"];?></td></tr> 
<tr><td>Provision Bill	</td><td><?echo $row[0]["provision_bill"];?></td></tr> 
<tr><td>Duration for Provision Bill	</td><td><?echo $row[0]["duration"];?></td></tr> 
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
<tr><td>Sales Comment</td>  <td><?echo $row[0]["sales_comment"];?></td></tr>
 <tr><td>Payment Pending</td>  <td><?echo $row[0]["total_pending"];?></td></tr>
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
	</tr></tbody>
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


<tr><td>Date 	</td><td><?echo date("d-M-Y h:i:s A",strtotime($row[0]["date"]));?></td></tr>
<tr><td>Request By</td><td><?echo $row[0]["acc_manager"];?></td></tr>
<tr><td>Account Manager</td><td><?echo $row[0]["sales_manager"];?></td></tr>
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
	</tr></tbody>
	</table>
	</div> 
	</div> 
	
	
<? /*}
	else If($tablename=="dimts_imei")
		{
		 $query = "SELECT * FROM ".$tablename." where id=".$RowId; 
			$row=select_query($query);*/

 
  
	?>
	<!--<div id="databox">
<div class="heading">View Dimts IMEI Details</div>
<div class="dataleft"><table cellspacing="2" cellpadding="2">
    <tbody> 
 
<tr><td>Date </td><td><?echo date("d-M-Y h:i:s A",strtotime($row[0]["date"]));?></td></tr> 	
<tr><td>Request By</td><td><?echo $row[0]["acc_manager"];?></td></tr>
<tr><td>Sales Manager </td><td><?echo $row[0]["sales_manager"];?></td></tr> 	
<? //$sql="select * from matrix.users  where id=".$row[0]["user_id"];
	//$rowuser=select_query($sql);
	?>
<tr><td>User Name 	</td><td><?echo $rowuser[0]["sys_username"];?></td></tr>	
<tr><td>Company Name </td><td><?echo $row[0]["client"];?></td></tr>		
<tr><td>Vehicle No</td><td><?echo $row[0]["veh_reg"];?></td></tr>	 	
<tr><td>7 digit IMEI </td><td><?echo $row[0]["device_imei_7"];?></td></tr>	
<tr><td>15 digit IMEI</td><td><?echo $row[0]["device_imei_15"];?></td></tr>
<tr><td>Changed to Port</td><td><?echo $row[0]["port_change"];?></td></tr>


</tbody></table></div>
 
<div class="dataright">
<table cellspacing="2" cellpadding="2"><tbody>
 <tr><td>Admin Approval</td>  <td><?if($row[0]["approve_status"]==1) echo "Approved"; else echo "Pending Approval"?></td></tr>
 <tr><td>Admin Comment</td><td><?echo $row[0]["admin_comment"];?></td></tr>
<tr><td>Req Forwarded to</td><td><?echo $row[0]["forward_req_user"];?></td></tr>
<tr><td>Forward Comment</td><td><?echo $row[0]["forward_comment"];?></td></tr>
<tr><td>F/W Request Back Comment</td><td><?echo $row[0]["forward_back_comment"];?></td></tr><tr><td>Account Comment</td>  <td><?echo $row[0]["account_comment"];?></td></tr>
 <tr><td>Payment Pending</td>  <td><?echo $row[0]["payment_status"];?></td></tr>
<tr><td>Service Comment</td>  <td><?echo $row[0]["service_comment"];?></td></tr>
<tr><td>Support Comment</td><td><?echo $row[0]["support_comment"];?></td></tr>
<tr><td>Reason for Imei not uploading</td><td><?echo $row[0]["imei_upload_reason"];?></td></tr>
<tr><td>Repair Comment</td><td><?echo $row[0]["repair_comment"];?></td></tr>
<tr><td>Reason for Port not changing</td><td><?echo $row[0]["port_change_reason"];?></td></tr>
<tr><td>Approval Date</td><td><?
/*if($row[0]["approve_status"]==1 && $row[0]["approve_date"]!='')
{
echo date("d-M-Y h:i:s A",strtotime($row[0]["approve_date"]));
}
else
{
	echo "";
}*/

?></td></tr>
<tr><td>Closed Date</td><td><?
/*if($row[0]["final_status"]==1 && $row[0]["close_date"]!='')
{
echo date("d-M-Y h:i:s A",strtotime($row[0]["close_date"]));
}
else
{
	echo "";
}*/

?></td> 
	</tr></tbody>

	</table>
	</div> 
	</div> 	-->
	
	
	<? }
	elseIf($tablename=="sub_user_creation")
		{

		  $query = "SELECT * FROM ".$tablename." where id=".$RowId; 
			$row=select_query($query);

	?><div id="databox">
<div class="heading">Sub User Creation</div>
<div class="dataleft"><table cellspacing="2" cellpadding="2">
    <tbody> 
 <tr><td>Date	</td><td><?echo date("d-M-Y h:i:s A",strtotime($row[0]["date"]));?></td></tr>
<tr><td>Request By</td><td><?echo $row[0]["acc_manager"];?></td></tr>
<tr><td>Account Manager</td><td><?echo $row[0]["sales_manager"];?></td></tr>
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

</tbody></table></div>
<div class="dataright">
<table cellspacing="2" cellpadding="2"><tbody>

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
	else If($tablename=="deactivation_of_account")
		{
		 $query = "SELECT * FROM ".$tablename." where id=".$RowId; 
			$row=select_query($query);


  
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
 <tr><td>Alert Date </td><td><?echo $row[0]["alert_date"];?></td></tr>
<tr><td>Delete From Debtors </td><td><?echo $row[0]["delete_form_debtors"];?></td></tr>
<tr><td>Reason</td><td><?echo $row[0]["reason"];?></td></tr> 

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
	else If($tablename=="reactivation_of_account")
		{
		 $query = "SELECT * FROM ".$tablename." where id=".$RowId; 
			$row=select_query($query);


  
	?><div id="databox">
<div class="heading">Reactivation Of Account</div>
<div class="dataleft"><table cellspacing="2" cellpadding="2">
    <tbody> 
<tr><td>Date </td><td><?echo date("d-M-Y h:i:s A",strtotime($row[0]["date"]));?></td></tr> 	
<? /*if($row[0]["acc_manager"]=='saleslogin') {
$account_manager=$row[0]["sales_manager"]; 
}
else {
$account_manager=$row[0]["acc_manager"]; 
}*/

?>
<tr><td>Request By</td><td><?echo $row[0]["acc_manager"];?></td></tr>
<tr><td>Account Manager</td><td><?echo $row[0]["sales_manager"];?></td></tr>
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
	else If($tablename=="del_form_debtors")
		{
		$query = "SELECT * FROM ".$tablename." where id=".$RowId; 
			$row=select_query($query);

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
 
<tr><td>Reason</td><td><?echo $row[0]["reason"];?></td></tr> 

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
	else If($tablename=="software_request")
		{
		$query = "SELECT * FROM ".$tablename." where id=".$RowId; 
			$row=select_query($query);



	?><div id="databox">
<div class="heading">Software Request</div>
<div class="dataleft"><table cellspacing="2" cellpadding="2">
    <tbody> 
  

<tr><td>Date</td><td><?echo date("d-M-Y h:i:s A",strtotime($row[0]["date"]));?></td></tr>  	
<tr><td>Request By</td><td><?echo $row[0]["acc_manager"];?></td></tr>
<tr><td>Account Manager</td><td><?echo $row[0]["sales_manager"];?></td></tr>
<? $sql="SELECT Userid AS id,UserName AS sys_username FROM addclient  WHERE Userid=".$row[0]["main_user_id"];
	$rowuser=select_query($sql);
	?>
<tr><td>Client User Name 	</td><td><?echo $rowuser[0]["sys_username"];?></td></tr>	

<tr><td>Company Name</td><td><?echo $row[0]["company"];?></td></tr>  	
<tr><td>Total No Of Vehicle</td><td><?echo $row[0]["total_no_of_vehicles"];?></td></tr>  	
<tr><td>Potential</td><td><?echo $row[0]["potential"];?></td></tr>  

<tr><td>Requested Alerts:---</td><td></td></tr>  	

<tr><td>Google Map</td><td><?echo $row[0]["rs_google_map"];?></td></tr>  	
<tr><td>Admin </td><td><?echo $row[0]["rs_admin"];?></td></tr> 	
<tr><td><tr><td>Type Of Alert</td><td><?echo $row[0]["alert"];?></td></tr>  

<tr><td>Requested Reports:---</td><td></td></tr>  
	<tr><td><tr><td>Reports</td><td><?echo $row[0]["reports"];?></td></tr>  

	</tbody></table></div>
<div class="dataright">
<table cellspacing="2" cellpadding="2"><tbody>

<tr><td>Other Alert/ Info</td><td><?echo $row[0]["rs_others"];?></td></tr>  	
<tr><td>Customize Report </td><td><?echo $row[0]["rs_customize_report"];?></td></tr> 	
<tr><td>Alert Contact Number</td><td><?echo $row[0]["alert_contact"];?></td></tr>  	
<tr><td>Client Contact Number </td><td><?echo $row[0]["client_contact_num"];?></td></tr> 
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
	<?
	}

	else If($tablename=="transfer_the_vehicle")
		{
		$query = "SELECT * FROM ".$tablename." where id=".$RowId; 
			$row=select_query($query);



	?><div id="databox">
<div class="heading">Transfer Vehicle</div>
<div class="dataleft"><table cellspacing="0" cellpadding="0">
    <tbody> 
 

<tr><td>Date</td><td><?echo date("d-M-Y h:i:s A",strtotime($row[0]["date"]));?></td></tr>  	
<tr><td>Request By</td><td><?echo $row[0]["acc_manager"];?></td></tr>
<tr><td>Account Manager</td><td><?echo $row[0]["sales_manager"];?></td></tr>

<? $sql="SELECT Userid AS id,UserName AS sys_username FROM addclient  WHERE Userid=".$row[0]["transfer_to_user"];
	$rowuser=select_query($sql);
	?>
<tr><td>Client User Name 	</td><td><?echo $rowuser[0]["sys_username"];?></td></tr>	
 <tr><td>Company Name </td><td><?echo $row[0]["transfer_from_company"];?></td></tr> 	
<tr><td>Total No Of Vehicle </td><td><?echo $row[0]["total_no_of_veh"];?></td></tr> 	
<!--<tr><td>Vehicle to move </td><td><?echo $row[0]["transfer_from_reg_no"];?></td></tr> -->

<tr><td>Vehicle to move </td><td><?php $vechile_no = explode(",",$row[0]["transfer_from_reg_no"]); 
for($i=0;$i<=count($vechile_no);$i++){ if($i%3!=0){ echo $vechile_no[$i].", ";}else { echo "<br/>".$vechile_no[$i].", ";} }?></td></tr>

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

?></td></tr>
</tbody>
 

	</table>
	</div> 
	</div> 
	<?
	}
	}
?> 