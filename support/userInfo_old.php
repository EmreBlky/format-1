 <?
include("../connection.php");
$q=$_GET["user_id"];
$veh_reg=$_GET["veh_reg"];
$row_id=$_GET["row_id"];
$comment=$_GET["comment"];

 //Final Close from Support
 
if(isset($_GET['action']) && $_GET['action']=='devicechangeclose')
{
	$Updateapprovestatus="update device_change set approve_status=1 where id=".$row_id;
	if(mysql_query($Updateapprovestatus))
	echo "Successfully Approved";
}

 

if(isset($_GET['action']) && $_GET['action']=='NewAccclose')
{
	$Updateapprovestatus="update new_account_creation set final_status=1 ,close_date='".date("Y-m-d H:i:s")."' where id=".$row_id;
	if(mysql_query($Updateapprovestatus))
	echo "Successfully closed";
}

if(isset($_GET['action']) && $_GET['action']=='imei_changeclose')
{
	$Updateapprovestatus="update imei_change set final_status=1 ,close_date='".date("Y-m-d H:i:s")."' where id=".$row_id;
	if(mysql_query($Updateapprovestatus))
	echo "Successfully closed";
}
if(isset($_GET['action']) && $_GET['action']=='stop_gpsclose')
{
	$Updateapprovestatus="update stop_gps set final_status=1 ,close_date='".date("Y-m-d H:i:s")."' where id=".$row_id;
	if(mysql_query($Updateapprovestatus))
	echo "Successfully closed";
}


if(isset($_GET['action']) && $_GET['action']=='new_device_additionclose')
{
	$Updateapprovestatus="update new_device_addition set final_status=1 ,close_date='".date("Y-m-d H:i:s")."' where id=".$row_id;
	if(mysql_query($Updateapprovestatus))
	echo "Successfully closed";
}


if(isset($_GET['action']) && $_GET['action']=='vehicle_no_changeclose')
{
	$Updateapprovestatus="update vehicle_no_change set final_status=1 ,close_date='".date("Y-m-d H:i:s")."' where id=".$row_id;
	if(mysql_query($Updateapprovestatus))
	echo "Successfully closed";
}
if(isset($_GET['action']) && $_GET['action']=='sim_changeclose')
{
	$Updateapprovestatus="update sim_change set final_status=1 ,close_date='".date("Y-m-d H:i:s")."' where id=".$row_id;
	if(mysql_query($Updateapprovestatus))
	echo "Successfully closed";
}

if(isset($_GET['action']) && $_GET['action']=='device_lostclose')
{
	$Updateapprovestatus="update device_lost set final_status=1 ,close_date='".date("Y-m-d H:i:s")."' where id=".$row_id;
	if(mysql_query($Updateapprovestatus))
	echo "Successfully closed";
}

if(isset($_GET['action']) && $_GET['action']=='deletionclose')
{
	$Updateapprovestatus="update deletion  set final_status=1 ,close_date='".date("Y-m-d H:i:s")."' where id=".$row_id;
	if(mysql_query($Updateapprovestatus))
	echo "Successfully closed";
}


if(isset($_GET['action']) && $_GET['action']=='sub_user_creationclose')
{
	$Updateapprovestatus="update sub_user_creation  set final_status=1 ,close_date='".date("Y-m-d H:i:s")."' where id=".$row_id;
	if(mysql_query($Updateapprovestatus))
	echo "Successfully closed";
}



if(isset($_GET['action']) && $_GET['action']=='deactivation_of_accountclose')
{
	$Updateapprovestatus="update deactivation_of_account  set final_status=1 ,close_date='".date("Y-m-d H:i:s")."' where id=".$row_id;
	if(mysql_query($Updateapprovestatus))
	echo "Successfully closed";
}


if(isset($_GET['action']) && $_GET['action']=='del_form_debtorsclose')
{
	$Updateapprovestatus="update del_form_debtors  set final_status=1 ,close_date='".date("Y-m-d H:i:s")."' where id=".$row_id;
	if(mysql_query($Updateapprovestatus))
	echo "Successfully closed";
}	


if(isset($_GET['action']) && $_GET['action']=='no_billsclose')
{
	$Updateapprovestatus="update no_bills  set final_status=1 ,close_date='".date("Y-m-d H:i:s")."' where id=".$row_id;
	if(mysql_query($Updateapprovestatus))
	echo "Successfully closed";
}	

if(isset($_GET['action']) && $_GET['action']=='discount_detailsclose')
{
	$Updateapprovestatus="update discount_details  set final_status=1 ,close_date='".date("Y-m-d h:i:s")."' where id=".$row_id;
	if(mysql_query($Updateapprovestatus))
	echo "Successfully closed";
}	

if(isset($_GET['action']) && $_GET['action']=='software_requestclose')
{
	$Updateapprovestatus="update software_request  set final_status=1 ,close_date='".date("Y-m-d H:i:s")."' where id=".$row_id;
	if(mysql_query($Updateapprovestatus))
	echo "Successfully closed";
}

if(isset($_GET['action']) && $_GET['action']=='transfer_the_vehicleclose')
{
	$Updateapprovestatus="update transfer_the_vehicle  set final_status=1 ,close_date='".date("Y-m-d H:i:s")."' where id=".$row_id;
	if(mysql_query($Updateapprovestatus))
	echo "Successfully closed";
	 
}	
 

// Add Comment


if(isset($_GET['action']) && $_GET['action']=='devicechangesupportComment')
{
	$Updateapprovestatus="update device_change set support_comment='".$comment."' where id=".$row_id;
	if(mysql_query($Updateapprovestatus))
	echo "Comment added Successfully";
}

 

if(isset($_GET['action']) && $_GET['action']=='NewAccsupportComment')
{
	$Updateapprovestatus="update new_account_creation set support_comment='".$comment."' where id=".$row_id;
	if(mysql_query($Updateapprovestatus))
	echo "Comment added Successfully";
}

if(isset($_GET['action']) && $_GET['action']=='imei_changesupportComment')
{
	$Updateapprovestatus="update imei_change set support_comment='".$comment."' where id=".$row_id;
	if(mysql_query($Updateapprovestatus))
	echo "Comment added Successfully";
}
if(isset($_GET['action']) && $_GET['action']=='stop_gpssupportComment')
{
	$Updateapprovestatus="update stop_gps set support_comment='".$comment."' where id=".$row_id;
	if(mysql_query($Updateapprovestatus))
	echo "Comment added Successfully";
}


if(isset($_GET['action']) && $_GET['action']=='new_device_additionsupportComment')
{
	$Updateapprovestatus="update new_device_addition set support_comment='".$comment."' where id=".$row_id;
	if(mysql_query($Updateapprovestatus))
	echo "Comment added Successfully";
}


if(isset($_GET['action']) && $_GET['action']=='vehicle_no_changesupportComment')
{
	$Updateapprovestatus="update vehicle_no_change set support_comment='".$comment."' where id=".$row_id;
	if(mysql_query($Updateapprovestatus))
	echo "Comment added Successfully";
}
if(isset($_GET['action']) && $_GET['action']=='sim_changesupportComment')
{
	$Updateapprovestatus="update sim_change set support_comment='".$comment."' where id=".$row_id;
	if(mysql_query($Updateapprovestatus))
	echo "Comment added Successfully";
}

if(isset($_GET['action']) && $_GET['action']=='device_lostsupportComment')
{
	$Updateapprovestatus="update device_lost set support_comment='".$comment."' where id=".$row_id;
	if(mysql_query($Updateapprovestatus))
	echo "Comment added Successfully";
}

if(isset($_GET['action']) && $_GET['action']=='deletionsupportComment')
{
	$Updateapprovestatus="update deletion set support_comment='".$comment."' where id=".$row_id;
	if(mysql_query($Updateapprovestatus))
	echo "Comment added Successfully";
}


if(isset($_GET['action']) && $_GET['action']=='sub_user_creationsupportComment')
{
	$Updateapprovestatus="update sub_user_creation  set support_comment='".$comment."' where id=".$row_id;
	if(mysql_query($Updateapprovestatus))
	echo "Comment added Successfully";
}



if(isset($_GET['action']) && $_GET['action']=='deactivation_of_accountsupportComment')
{
	$Updateapprovestatus="update deactivation_of_account  set support_comment='".$comment."' where id=".$row_id;
	if(mysql_query($Updateapprovestatus))
	echo "Comment added Successfully";
}


if(isset($_GET['action']) && $_GET['action']=='del_form_debtorssupportComment')
{
	$Updateapprovestatus="update del_form_debtors  set support_comment='".$comment."' where id=".$row_id;
	if(mysql_query($Updateapprovestatus))
	echo "Comment added Successfully";
}	


if(isset($_GET['action']) && $_GET['action']=='no_billssupportComment')
{
	$Updateapprovestatus="update no_bills  set support_comment='".$comment."' where id=".$row_id;
	if(mysql_query($Updateapprovestatus))
	echo "Comment added Successfully";
}	

if(isset($_GET['action']) && $_GET['action']=='discount_detailssupportComment')
{
	$Updateapprovestatus="update discount_details  set support_comment='".$comment."' where id=".$row_id;
	if(mysql_query($Updateapprovestatus))
	echo "Comment added Successfully";
}	

if(isset($_GET['action']) && $_GET['action']=='software_requestsupportComment')
{
	$Updateapprovestatus="update software_request  set support_comment='".$comment."' where id=".$row_id;
	if(mysql_query($Updateapprovestatus))
	echo "Comment added Successfully";
}

if(isset($_GET['action']) && $_GET['action']=='transfer_the_vehiclesupportComment')
{
	$Updateapprovestatus="update transfer_the_vehicle  set support_comment='".$comment."' where id=".$row_id;
	if(mysql_query($Updateapprovestatus))
	echo "Comment added Successfully";
	 
}	


	if(isset($_GET['action']) && $_GET['action']=='getrowSales')
	{
		 ?>
		<style type="text/css">
#databox{width:840px; height:500px; margin: 30px auto auto; border:1px solid #bfc0c1; font-family:Arial, Helvetica, sans-serif; font-size:13px; font-weight:normal; color:#3f4041;}
.heading{ font-family:Arial, Helvetica, sans-serif; font-size:30px; font-weight:700; word-spacing:5px; text-align:center;   color:#3E3E3E;   background-color:#ECEFE7; margin-bottom:10px;  }
.dataleft{float:left; width:400px; height:400px; margin-left:20px; border-right:1px solid #bfc0c1;}
.dataright{float:left; width:400px; height:400px; margin-left:19px;}
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

</tbody></table></div>



<div class="dataright">
<table cellspacing="2" cellpadding="2"><tbody>
 <tr><td>Admin Approval</td>  <td><?if($row[0]["approve_status"]==1) echo "Approved"; else echo "Pending Approval"?></td></tr>
<tr><td>Account Comment</td>  <td><?echo $row[0]["account_comment"];?></td></tr>
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
	</tr>
</tbody></table>
</div>


	<?}


	else If($tablename=="stop_gps")
		{
		  $query = "SELECT * FROM ".$tablename." where id=".$RowId; 
			$row=select_query($query);
	?><div id="databox">
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
<tr><td>Sales Action 	</td><td><?echo $row[0]["sales_action"];?></td></tr>  

</tbody></table></div>



<div class="dataright">
<table cellspacing="2" cellpadding="2"><tbody>

 <tr><td>Admin Approval</td>  <td><?if($row[0]["approve_status"]==1) echo "Approved"; else echo "Pending Approval"?></td></tr>
<tr><td>Account Comment</td>  <td><?echo $row[0]["account_comment"];?></td></tr>
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

?></td> 
	</tr>
</tbody></table>
</div>

	<?}
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
<tr><td>Device Model	</td><td><?echo $row[0]["device_model"];?></td></tr>
<tr><td>Vehicle Num</td><td><?echo $row[0]["reg_no"];?></td></tr>
<tr><td>imei_device</td><td><?echo $row[0]["imei_device"];?></td></tr>
<tr><td>date_of_install 	</td><td><?echo $row[0]["date_of_install"];?></td></tr>
<tr><td>device_mobilenum 	</td><td><?echo $row[0]["device_mobilenum"];?></td></tr>
<tr><td>duration 	</td><td><?echo $row[0]["duration"];?></td></tr>
<tr><td>No Bill For	</td><td><?echo $row[0]["rent_device"];?></td></tr> 
<tr><td>Reason	</td><td><?echo $row[0]["reason"];?></td></tr> 
<tr><td>Provision Bill	</td><td><?echo $row[0]["provision_bill"];?></td></tr>  

</tbody></table></div>



<div class="dataright">
<table cellspacing="2" cellpadding="2"><tbody>

 <tr><td>Admin Approval</td>  <td><?if($row[0]["approve_status"]==1) echo "Approved"; else echo "Pending Approval"?></td></tr>
<tr><td>Account Comment</td>  <td><?echo $row[0]["account_comment"];?></td></tr>
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
	</tbody></table>
</div>


	<?}
      
 
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
<tr><td>Total No Of Vehicle	</td><td><?echo $row[0]["total_no_of_vehicles"];?></td></tr>
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
 <tr><td>Admin Approval</td>  <td><?if($row[0]["approve_status"]==1) echo "Approved"; else echo "Pending Approval"?></td></tr>
<tr><td>Account Comment</td>  <td><?echo $row[0]["account_comment"];?></td></tr>
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
	</tbody></table>
</div>


	<?}
	elseIf($tablename=="sub_user_creation")
		{

		  $query = "SELECT * FROM ".$tablename." where id=".$RowId; 
			$row=select_query($query);

	?><div id="databox">
<div class="heading">Sub User Creation</div>
<div class="dataleft"><table cellspacing="2" cellpadding="2">
    <tbody> 
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
</tbody></table></div>
 
<div class="dataright">
<table cellspacing="2" cellpadding="2"><tbody>

 <tr><td>Admin Approval</td>  <td><?if($row[0]["approve_status"]==1) echo "Approved"; else echo "Pending Approval"?></td></tr>
<tr><td>Account Comment</td>  <td><?echo $row[0]["account_comment"];?></td></tr>
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
	</tbody></table>
</div>



	<?}
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
</tbody></table></div>
 
<div class="dataright">
<table cellspacing="2" cellpadding="2"><tbody>


 <tr><td>Admin Approval</td>  <td><?if($row[0]["approve_status"]==1) echo "Approved"; else echo "Pending Approval"?></td></tr>
<tr><td>Account Comment</td>  <td><?echo $row[0]["account_comment"];?></td></tr>
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
	</tbody></table>
</div>



	<?}
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
<? $sql="select * from matrix.users  where id=".$row[0]["user_id"];
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
 <tr><td>Admin Approval</td>  <td><?if($row[0]["approve_status"]==1) echo "Approved"; else echo "Pending Approval"?></td></tr>
<tr><td>Account Comment</td>  <td><?echo $row[0]["account_comment"];?></td></tr>
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

	</tbody></table>
</div>


	<?} 
	else If($tablename=="software_request")
		{
		$query = "SELECT * FROM ".$tablename." where id=".$RowId; 
			$row=select_query($query);



	?><div id="databox">
<div class="heading">Software Request</div>
<div class="dataleft"><table cellspacing="2" cellpadding="2">
    <tbody> 

<tr><td>Date</td><td><?echo $row[0]["date"];?></td></tr>  	
<tr><td>Account Manager</td><td><?echo $row[0]["acc_manager"];?></td></tr>  	
<? $sql="select * from matrix.users  where id=".$row[0]["main_user_id"];
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
<tr><td>Client Contact Number </td><td><?echo $rowuser[0]["mobile_number"];?></td></tr> </tbody></table></div>
 
<div class="dataright">
<table cellspacing="2" cellpadding="2"><tbody>


 <tr><td>Admin Approval</td>  <td><?if($row[0]["approve_status"]==1) echo "Approved"; else echo "Pending Approval"?></td></tr>
<tr><td>Account Comment</td>  <td><?echo $row[0]["account_comment"];?></td></tr>
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
 

</tbody></table>
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


<? $sql="select * from matrix.users  where id=".$row[0]["transfer_to_user"];
	$rowuser=select_query($sql);
	?>
<tr><td>Client User Name 	</td><td><?echo $rowuser[0]["sys_username"];?></td></tr>	



 <tr><td>Company Name </td><td><?echo $row[0]["transfer_from_company"];?></td></tr> 	
<tr><td>Total No Of Vehicle </td><td><?echo $row[0]["date"];?></td></tr> 	
<tr><td>Vehicle to move </td><td><?echo $row[0]["transfer_from_reg_no"];?></td></tr> 



<tr><td>Transfer To:--</td><td> </td></tr> 
	
<? $sql="select * from matrix.users  where id=".$row[0]["transfer_to_user"];
	$rowuser=select_query($sql);
	?>
<tr><td>Transfer User Name 	</td><td><?echo $rowuser[0]["sys_username"];?></td></tr>	

<tr><td>Transfer Company Name 	</td><td><?echo $row[0]["transfer_to_company"];?></td></tr> 
<tr><td>Billing</td><td><?echo $row[0]["transfer_to_billing"];?></td></tr>  	
 	
<tr><td>Reason</td><td><?echo $row[0]["reason"];?></td></tr> 

</tbody></table></div>
 
<div class="dataright">
<table cellspacing="2" cellpadding="2"><tbody>

 <tr><td>Admin Approval</td>  <td><?if($row[0]["approve_status"]==1) echo "Approved"; else echo "Pending Approval"?></td></tr>
<tr><td>Account Comment</td>  <td><?echo $row[0]["account_comment"];?></td></tr>
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
 

</tbody></table>
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
<tr><td>Date</td><td><?echo $row[0]["date"];?></td></tr>
<tr><td>Account Manager</td><td><?echo $row[0]["acc_manager"];?></td></tr>
<tr><td>Company</td><td><?echo $row[0]["client"];?></td></tr>
<? $sql="select * from matrix.users  where id=".$row[0]["user_id"];
	$rowuser=select_query($sql);
	?>
<tr><td>Client User Name 	</td><td><?echo $rowuser[0]["sys_username"];?></td></tr>
<tr><td>Device Model</td><td><?echo $row[0]["device_model"];?></td></tr>
<tr><td>Device IMEI</td><td><?echo $row[0]["device_imei"];?></td></tr>
<tr><td>Veh Num</td><td><?echo $row[0]["reg_no"];?></td></tr>
<tr><td>Mobile Number</td><td><?echo $row[0]["mobile_no"];?></td></tr>

<tr><td><strong>Replaced Device Details</strong></td><td>---------------------------</td></tr>
<tr><td>Device TYpe</td><td><?echo $row[0]["rdd_device_type"];?></td></tr>
<tr><td>Device Model</td><td><?echo $row[0]["rdd_device_model"];?></td></tr>
<tr><td>IMEI</td><td><?echo $row[0]["rdd_device_imei"];?></td></tr>
<tr><td>Device ID</td><td><?echo $row[0]["rdd_device_id"];?></td></tr>
<tr><td>Mobile Number</td><td><?echo $row[0]["rdd_device_mobile_num"];?></td></tr>
<tr><td>Replace Date</td><td><?echo $row[0]["rdd_date"];?></td></tr>
<tr><td>Reason</td><td><?echo $row[0]["rdd_reason"];?></td></tr> 

</tbody></table></div>
 
<div class="dataright">
<table cellspacing="2" cellpadding="2"><tbody>

 <tr><td>Admin Approval</td>  <td><?if($row[0]["approve_status"]==1) echo "Approved"; else echo "Pending Approval"?></td></tr>
<tr><td>Account Comment</td>  <td><?echo $row[0]["account_comment"];?></td></tr>
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
	</tbody></table>
</div>



	<?}


	else If($tablename=="imei_change")
		{
		  $query = "SELECT * FROM ".$tablename." where id=".$RowId; 
			$row=select_query($query);
	?><div id="databox">
<div class="heading">IMEI Change</div>
<div class="dataleft"><table cellspacing="2" cellpadding="2">
    <tbody> 
    
<tr><td>Date</td><td><?echo $row[0]["date"];?></td></tr>
<tr><td>Account Manager</td><td><?echo $row[0]["acc_manager"];?></td></tr>
<tr><td>Company</td><td><?echo $row[0]["client"];?></td></tr>
<? $sql="select * from matrix.users  where id=".$row[0]["user_id"];
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
</tbody></table></div>
 
<div class="dataright">
<table cellspacing="2" cellpadding="2"><tbody>

 <tr><td>Admin Approval</td>  <td><?if($row[0]["approve_status"]==1) echo "Approved"; else echo "Pending Approval"?></td></tr>
<tr><td>Account Comment</td>  <td><?echo $row[0]["account_comment"];?></td></tr>
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

?></tbody></table>
</div>
 
	<?}

	elseIf($tablename=="new_device_addition")
		{

		  $query = "SELECT * FROM ".$tablename." where id=".$RowId; 
			$row=select_query($query);

	?><div id="databox">
<div class="heading">View New device Addition</div>
<div class="dataleft"><table cellspacing="2" cellpadding="2">
    <tbody> 

<tr><td>Date</td><td><?echo $row[0]["date"];?></td></tr>
<tr><td>Account Manager</td><td><?echo $row[0]["acc_manager"];?></td></tr>
<tr><td>Company</td><td><?echo $row[0]["client"];?></td></tr>
<? $sql="select * from matrix.users  where id=".$row[0]["user_id"];
	$rowuser=select_query($sql);
	?>
<tr><td>Client User Name 	</td><td><?echo $rowuser[0]["sys_username"];?></td></tr>

<tr><td>Vehicle Name</td><td><?echo $row[0]["vehicle_no"];?></td></tr> 	
<tr><td>Device Type </td><td><?echo $row[0]["device_type"];?></td></tr>	
 <tr><td>OLD Company Name </td><td><?echo $row[0]["old_device_client"];?></td></tr>	
<tr><td>OLD Registration No </td><td><?echo $row[0]["old_vehicle_name"];?></td></tr>	
<tr><td>Device Model 	</td><td><?echo $row[0]["device_model"];?></td></tr>
<tr><td>Device IMEI </td><td><?echo $row[0]["device_imei"];?></td></tr>	
<tr><td>Device Mobile Number 	</td><td><?echo $row[0]["device_sim_num"];?></td></tr>
<tr><td>OLD Date Of Installation </td><td><?echo $row[0]["olddate_of_installation"];?></td></tr>	
<tr><td>Immobilizer  </td><td><?echo $row[0]["immobilizer"];?></td></tr>
<tr><td>AC 	 </td><td><?echo $row[0]["ac"];?></td></tr>
<tr><td>Date Of Installation	</td><td><?echo $row[0]["date_of_installation"];?></td></tr>
<tr><td>Reason</td><td><?echo $row[0]["reason"];?></td></tr>
</tbody></table></div>
 
<div class="dataright">
<table cellspacing="2" cellpadding="2"><tbody>

 <tr><td>Admin Approval</td>  <td><?if($row[0]["approve_status"]==1) echo "Approved"; else echo "Pending Approval"?></td></tr>
<tr><td>Account Comment</td>  <td><?echo $row[0]["account_comment"];?></td></tr>
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

	
</tbody></table>
</div>




	<?}
	else If($tablename=="vehicle_no_change")
		{
		 $query = "SELECT * FROM ".$tablename." where id=".$RowId; 
			$row=select_query($query);

 
  
	?><div id="databox">
<div class="heading">View Vehicle Change</div>
<div class="dataleft"><table cellspacing="2" cellpadding="2">
    <tbody> 
    
<tr><td>Date </td><td><?echo $row[0]["date"];?></td></tr> 	
<tr><td>Account Manager </td><td><?echo $row[0]["acc_manager"];?></td></tr> 	
<? $sql="select * from matrix.users  where id=".$row[0]["user_id"];
	$rowuser=select_query($sql);
	?>
   
<tr><td>Company Name </td><td><?echo $row[0]["client"];?></td></tr>		
<tr><td>Registration No</td><td><?echo $row[0]["old_reg_no"];?></td></tr>	 	
<tr><td>New Registration No </td><td><?echo $row[0]["new_reg_no"];?></td></tr>		
<tr><td>Date 	</td><td><?echo $row[0]["numberchange_date"];?></td></tr>	
<tr><td>Reason </td><td><?echo $row[0]["reason"];?></td></tr>	

</tbody></table></div>
 
<div class="dataright">
<table cellspacing="2" cellpadding="2"><tbody>


 <tr><td>Admin Approval</td>  <td><?if($row[0]["approve_status"]==1) echo "Approved"; else echo "Pending Approval"?></td></tr>
<tr><td>Account Comment</td>  <td><?echo $row[0]["account_comment"];?></td></tr>
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
  
</tbody></table>
</div>



	<?}
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
<? $sql="select * from matrix.users  where id=".$row[0]["user_id"];
	$rowuser=select_query($sql);
	?>
 
<tr><td>Company Name </td><td><?echo $row[0]["client"];?></td></tr>		
<tr><td>Registration No</td><td><?echo $row[0]["reg_no"];?></td></tr>	 	
<tr><td>Old Mobile Number </td><td><?echo $row[0]["old_sim"];?></td></tr>
<tr><td>New Mobile Number </td><td><?echo $row[0]["new_sim"];?></td></tr>	
 <tr><td>Sim Change Date 	</td><td><?echo $row[0]["sim_change_date"];?></td></tr>	
<tr><td>Reason </td><td><?echo $row[0]["reason"];?></td></tr>	


</tbody></table></div>
 
<div class="dataright">
<table cellspacing="2" cellpadding="2"><tbody>

 <tr><td>Admin Approval</td>  <td><?if($row[0]["approve_status"]==1) echo "Approved"; else echo "Pending Approval"?></td></tr>
<tr><td>Account Comment</td>  <td><?echo $row[0]["account_comment"];?></td></tr>
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
  </tbody></table>
</div>


 
 
	<?} 
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
<? $sql="select * from matrix.users  where id=".$row[0]["user_id"];
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


 <tr><td>Admin Approval</td>  <td><?if($row[0]["approve_status"]==1) echo "Approved"; else echo "Pending Approval"?></td></tr>
<tr><td>Account Comment</td>  <td><?echo $row[0]["account_comment"];?></td></tr>
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
</tbody></table>
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
    
  <tr><td>date</td><td><?echo $row[0]["date"];?></td></tr>  	
<tr><td>Account Manager </td><td><?echo $row[0]["acc_manager"];?></td></tr> 
 
<? $sql="select * from matrix.users  where id=".$row[0]["user_id"];
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
</tbody></table></div>
 
<div class="dataright">
<table cellspacing="2" cellpadding="2"><tbody>

 <tr><td>Admin Approval</td>  <td><?if($row[0]["approve_status"]==1) echo "Approved"; else echo "Pending Approval"?></td></tr>
<tr><td>Account Comment</td>  <td><?echo $row[0]["account_comment"];?></td></tr>
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
</tbody></table>
</div>

	<?
	}
	}
?>