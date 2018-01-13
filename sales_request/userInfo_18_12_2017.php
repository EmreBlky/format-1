<?php
error_reporting(0);
ob_start();
session_start();
include("../connection.php");
include_once(__DOCUMENT_ROOT.'/private/master.php');

/*include($_SERVER["DOCUMENT_ROOT"]."/format/connection.php");
include($_SERVER['DOCUMENT_ROOT']."/service/private/master.php");*/

$masterObj = new master();

$q=$_GET["user_id"];

$veh_reg=$_GET["veh_reg"];
$row_id=$_GET["row_id"];
$inst_id=$_GET["inst_id"];
$comment = str_replace("'","",$_GET["comment"]);

if(isset($_GET['action']) && $_GET['action']=='aacountcreationbackComment')
{
   
        $query = "SELECT forward_back_comment FROM new_account_creation  where id=".$row_id;
     $row=select_query($query);

     
    $Updateapprovestatus="update new_account_creation set forward_back_comment='".$row[0]["forward_back_comment"]."<br/>".date("Y-m-d H:i:s")." - " .$comment."' where id=".$row_id;
   
   
    //$Updateapprovestatus="update stop_gps set admin_comment='".$comment."' where id=".$row_id;
    if(mysql_query($Updateapprovestatus))
    echo "Comment added Successfully";
}

if(isset($_GET['action']) && $_GET['action']=='stopgpsbackComment')
{
   
        $query = "SELECT forward_back_comment FROM stop_gps  where id=".$row_id;
     $row=select_query($query);

     
    $Updateapprovestatus="update stop_gps set forward_back_comment='".$row[0]["forward_back_comment"]."<br/>".date("Y-m-d H:i:s")." - " .$comment."' where id=".$row_id;
   
   
    //$Updateapprovestatus="update stop_gps set admin_comment='".$comment."' where id=".$row_id;
    if(mysql_query($Updateapprovestatus))
    echo "Comment added Successfully";
}

/*if(isset($_GET['action']) && $_GET['action']=='StartUserGps')
{
   
        $query = "SELECT * FROM stop_gps  where id=".$row_id;
       $row=select_query($query);
       $reason = $row[0]["reason"];
       
        $Updateapprovestatus="update stop_gps set start_gps='Y',start_gps_date='".date("Y-m-d H:i:s")."' where id=".$row_id;
        mysql_query($Updateapprovestatus);
       
        $StartGps_query="INSERT INTO `start_gps` (`date`, `acc_manager`,`sales_manager`, `client`,`company`, `tot_no_of_vehicle`, `start_no_of_vehicle`, `reg_no`, `ps_of_ownership`, `reason`) VALUES ('".date("Y-m-d H:i:s")."','".$row[0]["acc_manager"]."','".$row[0]["sales_manager"]."','".$row[0]["client"]."','".$row[0]["company"]."','".$row[0]["total_no_of_vehicles"]."','".$row[0]["no_of_vehicle"]."','".$row[0]["reg_no"]."','".$row[0]["ps_of_ownership"]."','".$comment."')";       
               
        mysql_query($StartGps_query);
     
}*/

if(isset($_GET['action']) && $_GET['action']=='subusercreationbackComment')
{
   
        $query = "SELECT forward_back_comment FROM sub_user_creation  where id=".$row_id;
     $row=select_query($query);

     
    $Updateapprovestatus="update sub_user_creation set forward_back_comment='".$row[0]["forward_back_comment"]."<br/>".date("Y-m-d H:i:s")." - " .$comment."' where id=".$row_id;
   
   
    //$Updateapprovestatus="update stop_gps set admin_comment='".$comment."' where id=".$row_id;
    if(mysql_query($Updateapprovestatus))
    echo "Comment added Successfully";
}

if(isset($_GET['action']) && $_GET['action']=='ReactivateUserAccount')
{
   
        $query = "SELECT * FROM deactivation_of_account  where id=".$row_id;
       $row=select_query($query);
       $reason = str_replace("'","",$row[0]["reason"]);
       
        $Updateapprovestatus="update deactivation_of_account set reactivate_status='Y',ractivate_date='".date("Y-m-d H:i:s")."' where id=".$row_id;
        mysql_query($Updateapprovestatus);
       
        $ractivate_query="INSERT INTO `reactivation_of_account` (`date`, `acc_manager`,`sales_manager`, `company`, `user_id`, `total_no_of_vehicles`,`reactivate_account_status`,`deactivate_temp`,`deact_reason`,`reason`,`deact_req_date`,`deact_close_date`)
        VALUES ('".date("Y-m-d H:i:s")."','".$row[0]["acc_manager"]."','".$row[0]["sales_manager"]."','".$row[0]["company"]."','".$row[0]["user_id"]."','".$row[0]["total_no_of_vehicles"]."','Y','".$row[0]["deactivate_temp"]."','".$reason."','".$comment."','".$row[0]["date"]."','".$row[0]["close_date"]."')";
       
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

if(isset($_GET['action']) && $_GET['action']=='reactiavteReasonComment')
{
         
    $Updateapprovestatus="update reactivation_of_account set reason='".$comment."' where id=".$row_id;
   
    if(mysql_query($Updateapprovestatus))
    echo "Comment added Successfully";
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

if(isset($_GET['action']) && $_GET['action']=='reactivateaccountbackComment')
{
   
        $query = "SELECT forward_back_comment FROM reactivation_of_account  where id=".$row_id;
     $row=select_query($query);

     
    $Updateapprovestatus="update reactivation_of_account set forward_back_comment='".$row[0]["forward_back_comment"]."<br/>".date("Y-m-d H:i:s")." - " .$comment."' where id=".$row_id;
   
    if(mysql_query($Updateapprovestatus))
    echo "Comment added Successfully";
}


if(isset($_GET['action']) && $_GET['action']=='deletefromdebtorsbackComment')
{
   
        $query = "SELECT forward_back_comment FROM del_form_debtors  where id=".$row_id;
     $row=select_query($query);

     
    $Updateapprovestatus="update del_form_debtors set forward_back_comment='".$row[0]["forward_back_comment"]."<br/>".date("Y-m-d H:i:s")." - " .$comment."' where id=".$row_id;
   
   
    //$Updateapprovestatus="update stop_gps set admin_comment='".$comment."' where id=".$row_id;
    if(mysql_query($Updateapprovestatus))
    echo "Comment added Successfully";
}
if(isset($_GET['action']) && $_GET['action']=='nobillbackComment')
{
   
        $query = "SELECT forward_back_comment FROM no_bills  where id=".$row_id;
     $row=select_query($query);

     
    $Updateapprovestatus="update no_bills set forward_back_comment='".$row[0]["forward_back_comment"]."<br/>".date("Y-m-d H:i:s")." - " .$comment."' where id=".$row_id;
   
   
    //$Updateapprovestatus="update stop_gps set admin_comment='".$comment."' where id=".$row_id;
    if(mysql_query($Updateapprovestatus))
    echo "Comment added Successfully";
}
if(isset($_GET['action']) && $_GET['action']=='discountingbackComment')
{
   
        $query = "SELECT forward_back_comment FROM discounting  where id=".$row_id;
     $row=select_query($query);

     
    $Updateapprovestatus="update discounting set forward_back_comment='".$row[0]["forward_back_comment"]."<br/>".date("Y-m-d H:i:s")." - " .$comment."' where id=".$row_id;
   
   
    //$Updateapprovestatus="update stop_gps set admin_comment='".$comment."' where id=".$row_id;
    if(mysql_query($Updateapprovestatus))
    echo "Comment added Successfully";
}
if(isset($_GET['action']) && $_GET['action']=='softwarerequestbackComment')
{
   
        $query = "SELECT forward_back_comment FROM software_request  where id=".$row_id;
     $row=select_query($query);

     
    $Updateapprovestatus="update software_request set forward_back_comment='".$row[0]["forward_back_comment"]."<br/>".date("Y-m-d H:i:s")." - " .$comment."' where id=".$row_id;
   
   
    //$Updateapprovestatus="update stop_gps set admin_comment='".$comment."' where id=".$row_id;
    if(mysql_query($Updateapprovestatus))
    echo "Comment added Successfully";
}
if(isset($_GET['action']) && $_GET['action']=='transferthevehiclebackComment')
{
   
        $query = "SELECT forward_back_comment FROM transfer_the_vehicle  where id=".$row_id;
     $row=select_query($query);

     
    $Updateapprovestatus="update transfer_the_vehicle set forward_back_comment='".$row[0]["forward_back_comment"]."<br/>".date("Y-m-d H:i:s")." - " .$comment."' where id=".$row_id;
   
   
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

/*$result="select services.id, veh_reg, adddate(latest_telemetry.gps_time,INTERVAL 19800 second) as lastcontact, round(gps_speed*1.609,0) as speed,  case when tel_ignition=true then true else false end as aconoff , geo_street as street, latest_telemetry.gps_latitude as lat,latest_telemetry.gps_longitude as lng ,devices.imei from matrix.services
join matrix.latest_telemetry on latest_telemetry.sys_service_id=services.id
join matrix.devices on devices.id=services.sys_device_id
join matrix.mobile_simcards on matrix.mobile_simcards.id=devices.sys_simcard
where services.id in
(select distinct sys_service_id from matrix.group_services where active=true and sys_group_id in (
select sys_group_id from matrix.group_users where sys_user_id=(".$q.")))";
                                                               
$data = select_query_live($result);*/

/*$data = $masterObj->ImeiSearchDetails($q);*/
 
$data = $masterObj->getVehicleDetail($q);

if(isset($_GET['action']) && $_GET['action']=='getdata')
{
	
$ab = count($data);
//$result = mysql_query("SELECT veh_reg FROM vehicles WHERE user_id = '".$q."'");

$msg= '<table border="0" style="width:50%;">
<tr><td>All</td>
<td><input type="checkbox" name="all_check" id="all_check" onchange="CheckUncheck('.$ab.');" style="width=20px;"/></td></tr><tr>';

//while($row = mysql_fetch_array($data))
for($veh=0;$veh<count($data);$veh++)
  {
    if($veh%3==0) {
    $msg .="</tr><tr>";
    }
  $msg .='<td>'.trim($data[$veh]['veh_reg']).'</td><td><input type="checkbox" name='.$veh.' id='.$veh.' value='.trim($data[$veh]['veh_reg']).' style="width=20px;"/></td>' ;
  }
 
 
  $msg .="</tr></table>";
 
  echo $msg;
}


if(isset($_GET['action']) && $_GET['action']=='getdataddl')
{
 
 /* $result="select services.id as id,services.id,veh_reg from matrix.services
where services.id in
(select distinct sys_service_id from matrix.group_services where active=true and sys_group_id in (
select sys_group_id from matrix.group_users where sys_user_id=(".$q.")))";
$data = select_query_live($result);*/

$vehicledata = $masterObj->getVehicleDetail($q);


$msg=' <select name="veh_reg" id="<?=$select_id?>" onchange="getdeviceImei(this.value,\'TxtDeviceIMEI\');getInstaltiondate(this.value,\'date_of_install\');getdevicemobile(this.value,\'Devicemobile\');">
<option value="0">Select Vehicle No</option>';

//while($row = mysql_fetch_array($data))
 for($veh=0;$veh<count($vehicledata);$veh++)
  {
    if($veh%3==0) {
    	$msg .="</tr><tr>";
    }
  $msg .="<option value=".$vehicledata[$veh]['veh_reg'].">".$vehicledata[$veh]['veh_reg']."</option>";
 
  }
 
 
  $msg .="</select>";
 
  echo $msg;
}

 



if(isset($_GET['action']) && $_GET['action']=='total')
    {
         
        echo count($data);
    }

if(isset($_GET['action']) && $_GET['action']=='companyname')
    {
         
        /*$sql="select `group`.name as company from matrix.group_users left join matrix.`group` on group_users.sys_group_id=`group`.id where group_users.sys_user_id=".$q;
        $row=select_query_live($sql);*/
		
		$commpany = $masterObj->getCompanyName($q);
        echo $commpany[0]["company"];

    }


if(isset($_GET['action']) && $_GET['action']=='creationdate')
    {
         
        /*$sql="select * from matrix.users where id=".$q;
        $row=select_query_live($sql);*/

		$add_date = $masterObj->getCreationDate($q);
		
        echo date("d-M-Y",strtotime($add_date[0]["sys_added_date"]));
    }
   
   
if(isset($_GET['action']) && $_GET['action']=='deviceImei')
    {
     
    /*$sql1="select imei from matrix.devices where id in (select sys_device_id from matrix.services where veh_reg='".$veh_reg."') limit 1";
    $row=select_query_live($sql1);*/
     
	$imeino = $masterObj->getDeviceImei($veh_reg);
    
	 echo $imeino[0]["imei"];
    }
   
   
if(isset($_GET['action']) && $_GET['action']=='deviceMobile')
    {
         
   /* $sql1="select mobile_no from matrix.mobile_simcards where id in ( select sys_simcard from matrix.devices where id in (select sys_device_id from matrix.services where veh_reg='".$veh_reg."'))";
    $row=select_query_live($sql1);*/
     
	$phoneno = $masterObj->getDeviceMobile($veh_reg);
    
     echo $phoneno[0]["mobile_no"];
    }



if(isset($_GET['action']) && $_GET['action']=='Instaltiondate')
    {
         
       /* $sql="select sys_created from matrix.services where veh_reg='".$veh_reg."' limit 1";
        $row=select_query_live($sql);*/

		$inst_date = $masterObj->getDeviceInstaltiondate($veh_reg);
		
        echo date("d-M-Y",strtotime($inst_date[0]["sys_created"]));
    }

if(isset($_GET['action']) && $_GET['action']=='getmodel')
{
 	$getmodel = $_GET["model"];
  	$model_query = "select * from internalsoftware.device_model where `status`=1 and parent_id='".$q."' order by device_model asc ";
	$model_data = select_query($model_query);
	
	$msg=' <select name="modelno[]" id="modelno" style="width:150px" ><option value="">Select Model No</option>';

	for($m=0;$m<count($model_data);$m++)
	  {
	 	   if($model_data[$m]['device_model']==$getmodel){ $selected="selected";}
           else { $selected=""; }
		 
		 $msg .="<option value='".$model_data[$m]['device_model']."' ".$selected.">".$model_data[$m]['device_model']."</option>"; 
	  }
	 
	  $msg .="</select>";
	 
	  echo $msg;
}
   
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
.dataleft2 {
	float:left;
	width:400px;
	/*height:200px;*/
	margin-left:10px;
	border-right:1px solid #bfc0c1;
}
.dataright2 {
	float:right;
	width:400px;
	/*height:200px;*/
	margin-left:19px;
}
.datacenter {
	margin-top:350px;
	width:800px;
	/*height:200px;*/
	margin-left:10px;
}
td{padding-right:20px; padding-left:20px;}
</style>

     <?

   
If($tablename=="new_account_creation")
   {
    		$query = "SELECT * FROM ".$tablename." where id=".$RowId;
            $row=select_query($query);
			
			$ModelData = select_query("select * from new_account_model_master where is_active='0' and new_account_reqid='".$RowId."' ");
			$modelcount = count($ModelData);
			
			$oldModelData = select_query("select * from new_account_model_master where is_active='1' and new_account_reqid='".$RowId."' ");
			$oldmodelcount = count($oldModelData);
			
    ?>
<div id="databox">
  <div class="heading">New account creation</div>
  <div class="dataleft2">
    <table cellspacing="2" cellpadding="2">
      <tbody>
        <tr>
          <td>Date</td>
          <td><?echo date("d-M-Y h:i:s A",strtotime($row[0]["date"]));?></td>
        </tr>
        <? /*if($row[0]["account_manager"]=='saleslogin') {
		$account_manager=$row[0]["sales_manager"];
		}
		else {
		$account_manager=$row[0]["account_manager"];
		}*/
		?>
        <tr>
          <td>Request By</td>
          <td><?echo $row[0]["account_manager"];?></td>
        </tr>
        <tr>
          <td>Account Manager</td>
          <td><?echo $row[0]["sales_manager"];?></td>
        </tr>
        <tr>
          <td>Company</td>
          <td><?echo $row[0]["company"];?></td>
        </tr>
        <tr>
          <td>Potential</td>
          <td><?echo $row[0]["potential"];?></td>
        </tr>
        <tr>
          <td>Contact Person</td>
          <td><?echo $row[0]["contact_person"];?></td>
        </tr>
        <tr>
          <td>Contact No.</td>
          <td><?echo $row[0]["contact_number"];?></td>
        </tr>
        <tr>
          <td>Billing Name</td>
          <td><?echo $row[0]["billing_name"];?></td>
        </tr>
        <tr>
          <td>Billing Add</td>
          <td><?echo $row[0]["billing_address"];?></td>
        </tr>
        <tr>
          <td>E-Mail ID</td>
          <td><?echo $row[0]["email_id"];?></td>
        </tr>
        <tr>
          <td>User Name</td>
          <td><?echo $row[0]["user_name"];?></td>
        </tr>
        <tr>
          <td>Password</td>
          <td><?echo $row[0]["user_password"];?></td>
        </tr>
        <tr>
          <td>Vehicle type</td>
          <td><?echo $row[0]["vehicle_type"];?></td>
        </tr>
        <tr>
          <td>Dimts</td>
          <td><?echo $row[0]["dimts"];?></td>
        </tr>
        <tr>
          <td>Dimts Fee status </td>
          <td><?echo $row[0]["dimts_fee"];?></td>
        </tr>
        <tr>
          <td>Type of Organisation</td>
          <td><?echo $row[0]["type_of_org"];?></td>
        </tr>      
       </tbody>
    </table>
  </div>
  <div class="dataright2">
    <table cellspacing="2" cellpadding="2">
      <tbody>
        <tr>
          <td>PAN No.</td>
          <td><?echo $row[0]["pan_no"];?></td>
        </tr>        
        <tr>
          <td>Immobilizer</td>
          <td><?echo $row[0]["immobilizer"];?></td>
        </tr>
        <tr>
          <td>AC</td>
          <td><?echo $row[0]["ac_on_off"];?></td>
        </tr>
        <!-- <tr><td>Admin Approval</td>  <td><?if($row[0]["approve_status"]==1) echo "Approved"; else echo "Pending Approval"?></td></tr>-->
        <tr>
          <td><strong>Process Pending </strong></td>
          <td><strong>
            <?  if($row[0]["acc_creation_status"]==2 || (($row[0]["support_comment"]!="" || $row[0]["admin_comment"]!="") && $row[0]["sales_comment"]==""))
    {echo "Reply Pending at Request Side";}
    elseif($row[0]["approve_status"]==0 && $row[0]["forward_req_user"]!="" && $row[0]["forward_back_comment"]=="" && $row[0]["acc_creation_status"]==1)   
    {echo "Pending Admin Approval (Req Forward to ".$row[0]["forward_req_user"].")";}
    elseif($row[0]["approve_status"]==0 && $row[0]["acc_creation_status"]==1)
    {echo "Pending Admin Approval";}
    elseif($row[0]["approve_status"]==1 && $row[0]["acc_creation_status"]==1 && $row[0]["final_status"]!=1){echo "Pending at Tech Support Team";}
    elseif($row[0]["approve_status"]==1 && $row[0]["final_status"]==1){echo "Process Done";}?>
            </strong></td>
        </tr>
        <tr>
          <td>Sales Comment</td>
          <td><?echo $row[0]["sales_comment"];?></td>
        </tr>
        <tr>
          <td>Support Comment</td>
          <td><?echo $row[0]["support_comment"];?></td>
        </tr>
        <tr>
          <td>Admin Comment</td>
          <td><?echo $row[0]["admin_comment"];?></td>
        </tr>
        <tr>
          <td>Approval Date</td>
          <td><?
			if($row[0]["approve_status"]==1 && $row[0]["approve_date"]!='')
			{
			echo date("d-M-Y h:i:s A",strtotime($row[0]["approve_date"]));
			}
			else
			{
				echo "";
			}
			
			?></td>
					</tr>
					<tr>
					  <td>Closed Date</td>
					  <td><?
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
  <div>&nbsp;</div>
  <div class="datacenter">
	<table cellspacing="2" cellpadding="2" border="1">
      <tbody>
		<?php if($modelcount>0){?>
        <tr>
              <th align="left">SrNo.</th>
              <th align="left">DeviceType</th>
              <th align="left">modelType</th>
              <th align="left">AccountType</th>
              <th align="left">PaymentMode</th>
              <th align="left">RentPlan</th>
        </tr>
        <tr>
        	<td colspan="6" style="background-color:#FF6"><font style="color:#000;font-weight:bold;">Pending Model for Approval</font></td>
        </tr>
       <?php for($gm=0;$gm<$modelcount;$gm++){
				
			   if($ModelData[$gm]["rent_month"] == '1'){$plan = 'Monthly';}
			   elseif($ModelData[$gm]["rent_month"] == '3'){$plan = 'Quarterly';}
			   elseif($ModelData[$gm]["rent_month"] == '6'){$plan = 'HalfYearly';}
			   elseif($ModelData[$gm]["rent_month"] == '12'){$plan = 'Yearly';}
			   else{$plan = '--';}
			   
			   $getdevice = select_query("SELECT * FROM internalsoftware.device_type  WHERE id=".$ModelData[$gm]["device_type"]);
		?>
       <tr>
       		  <td><? echo $gm+1;?></td>
              <td><strong><? echo $getdevice[0]["device_type"];?></strong></td>
              <td><strong><? echo $ModelData[$gm]["device_model"];?></strong></td>
              <td><strong><? echo $ModelData[$gm]["account_type"];?></strong></td>
              <td><strong><? echo $ModelData[$gm]["mode_of_payment"];?></strong></td>
              <td><strong><? echo $plan;?></strong></td>
       </tr>
       <?php if($ModelData[$gm]["mode_of_payment"] == 'Billed'){ ?>
       <tr>    
              <td>&nbsp;</td>
              <td>DPrice - <? echo $ModelData[$gm]["device_price"];?></td>
              <td>Status - <? echo $ModelData[$gm]["device_status"];?></td>
              <td>Vat(5%) - <? echo $ModelData[$gm]["device_price_vat"];?></td>
              <td>DTotal - <? echo $ModelData[$gm]["device_price_total"];?></td>
        </tr>
        <tr>    
              <td>&nbsp;</td>
              <td>RPrice - <? echo $ModelData[$gm]["device_rent_Price"];?></td>
              <td>Status - <? echo $ModelData[$gm]["rent_status"];?></td>
              <td>STex(15%) - <? echo $ModelData[$gm]["device_rent_service_tax"];?></td>
              <td>RTotal - <? echo $ModelData[$gm]["DTotalREnt"];?> </td>
        </tr> 
       <?php } elseif($ModelData[$gm]["mode_of_payment"] == 'CashClient'){ ?> 
          <tr>    
              <td>&nbsp;</td>
              <td colspan="2">DPrice - <? echo $ModelData[$gm]["device_price_total"];?></td>
              <td colspan="2">RPrice - <? echo $ModelData[$gm]["DTotalREnt"];?></td>
          </tr>
        <?php } elseif($ModelData[$gm]["account_type"] == 'Foc'){ ?>
		  <tr>    
              <td>&nbsp;</td>
              <td colspan="4">FOC Reason - <? echo $ModelData[$gm]["foc_reason"];?></td>
          </tr>
       <?php } elseif($ModelData[$gm]["account_type"] == 'Demo'){ ?>
		  <tr>    
              <td>&nbsp;</td>
              <td colspan="2">Demo Period - <? echo $ModelData[$gm]["demo_time"]." Days";?></td>
          </tr>
       <?php } elseif($ModelData[$gm]["account_type"] == 'InternalTesting'){ ?>
		  <tr>    
              <td>&nbsp;</td>
              <td colspan="2">Testing Period - <? echo $ModelData[$gm]["testing_time"]." Days";?></td>
          </tr>
       <?php } 
	      } 
	   }
	   if($oldmodelcount>0){ 
	   ?>   
	   <tr>
        	<td colspan="6" style="background-color:#99FF66"><font style="color:#000;font-weight:bold;">Approved Model</font></td>
        </tr>
       <?php for($gd=0;$gd<$oldmodelcount;$gd++){
				
			   if($oldModelData[$gd]["rent_month"] == '1'){$plan = 'Monthly';}
			   elseif($oldModelData[$gd]["rent_month"] == '3'){$plan = 'Quarterly';}
			   elseif($oldModelData[$gd]["rent_month"] == '6'){$plan = 'HalfYearly';}
			   elseif($oldModelData[$gd]["rent_month"] == '12'){$plan = 'Yearly';}
			   else{$plan = '--';}
			   
			   $getdevice = select_query("SELECT * FROM internalsoftware.device_type  WHERE id=".$oldModelData[$gd]["device_type"]);
		?>
       <tr>
       		  <td><? echo $gd+1;?></td>
              <td><strong><? echo $getdevice[0]["device_type"];?></strong></td>
              <td><strong><? echo $oldModelData[$gd]["device_model"];?></strong></td>
              <td><strong><? echo $oldModelData[$gd]["account_type"];?></strong></td>
              <td><strong><? echo $oldModelData[$gd]["mode_of_payment"];?></strong></td>
              <td><strong><? echo $plan;?></strong></td>
       </tr>
       <?php if($oldModelData[$gd]["mode_of_payment"] == 'Billed'){ ?>
       <tr>    
              <td>&nbsp;</td>
              <td>DPrice - <? echo $oldModelData[$gd]["device_price"];?></td>
              <td>Status - <? echo $oldModelData[$gd]["device_status"];?></td>
              <td>Vat(5%) - <? echo $oldModelData[$gd]["device_price_vat"];?></td>
              <td>DTotal - <? echo $oldModelData[$gd]["device_price_total"];?></td>
        </tr>
        <tr>    
              <td>&nbsp;</td>
              <td>RPrice - <? echo $oldModelData[$gd]["device_rent_Price"];?></td>
              <td>Status - <? echo $oldModelData[$gd]["rent_status"];?></td>
              <td>STex(15%) - <? echo $oldModelData[$gd]["device_rent_service_tax"];?></td>
              <td>RTotal - <? echo $oldModelData[$gd]["DTotalREnt"];?> </td>
        </tr> 
       <?php } elseif($oldModelData[$gd]["mode_of_payment"] == 'CashClient'){ ?> 
          <tr>    
              <td>&nbsp;</td>
              <td colspan="2">DPrice - <? echo $oldModelData[$gd]["device_price_total"];?></td>
              <td colspan="2">RPrice - <? echo $oldModelData[$gd]["DTotalREnt"];?></td>
          </tr>
        <?php } elseif($oldModelData[$gd]["account_type"] == 'Foc'){ ?>
		  <tr>    
              <td>&nbsp;</td>
              <td colspan="4">FOC Reason - <? echo $oldModelData[$gd]["foc_reason"];?></td>
          </tr>
       <?php } elseif($oldModelData[$gd]["account_type"] == 'Demo'){ ?>
		  <tr>    
              <td>&nbsp;</td>
              <td colspan="2">Demo Period - <? echo $oldModelData[$gd]["demo_time"]." Days";?></td>
          </tr>
       <?php } elseif($oldModelData[$gd]["account_type"] == 'InternalTesting'){ ?>
		  <tr>    
              <td>&nbsp;</td>
              <td colspan="2">Testing Period - <? echo $oldModelData[$gd]["testing_time"]." Days";?></td>
          </tr>
       <?php } 
	      } 	   
	   }
	   if($modelcount==0 && $oldmodelcount==0)
	   {
	   ?>
       <tr>
              <th align="left">AccountType</th>
              <th align="left">PaymentMode</th>
              <th align="left">DevicePrice</th>
              <th align="left">Total Price</th>
              <th align="left">Rent</th>
              <th align="left">Total Rent</th>
              <th align="left">RentMonth</th>
              <th align="left">RentStatus</th>
              <th align="left">DemoPeriod</th>
              <th align="left">FOCReason</th>
        </tr> 
       <tr>
              <td><strong><? echo $row[0]["account_type"];?></strong></td>
              <td><strong><? echo $row[0]["mode_of_payment"];?></strong></td>
              <td><? echo $row[0]["device_price"];?></td>
              <td><? echo $row[0]["device_price_total"];?></td>
              <td><? echo $row[0]["device_rent_Price"];?></td>
              <td><? echo $row[0]["DTotalREnt"];?></td>
              <td><? if($row[0]["rent_month"]!=""){echo $row[0]["rent_month"]." Month";}?></td>
              <td><? echo $row[0]["rent_status"];?></td>
              <td><? if($row[0]["demo_time"]!=""){echo $row[0]["demo_time"];}?></td>
              <td><? echo $row[0]["foc_reason"];?></td>
       </tr>
       <?php } ?>
       </tbody>
     </table>         
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
$sales=select_query("select name from sales_person where id='".$row[0]['sales_person']."' ");
?>
<tr><td>Sales Person     </td><td><?echo $sales[0]['name'];?></td></tr>
<? $sql="SELECT Userid AS id,UserName AS sys_username FROM addclient  WHERE Userid=".$row[0]["user_id"];
    $rowuser=select_query($sql);
    ?>
<tr><td>Client User Name     </td><td><?echo $rowuser[0]["sys_username"];?></td></tr>
<tr><td>Company Name    </td><td><?echo $row[0]["company_name"];?></td></tr>
<tr><td>No. Of Vehicales:   </td><td><?echo $row[0]["no_of_vehicals"];?></td></tr>
<tr><td>Approve Installation: </td><td><?echo $row[0]["installation_approve"];?></td></tr>
<tr><td>Area: </td><td><?echo $row[0]["name"];?></td></tr>      

<tr><td>Location: </td><td><?echo $row[0]["location"];?></td></tr>      
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


</tbody></table></div>



<div class="dataright">
<table cellspacing="2" cellpadding="2"><tbody>
<tr><td>Payment:  </td><td><?echo $row[0]["payment_req"];?></td>
 <tr><td>Amount:  </td><td><?echo $row[0]["amount"];?></td>
 <tr><td>Payment Mode:  </td><td><?echo $row[0]["pay_mode"];?></td>
 <tr><td>Required.:</td><td><?echo $row[0]["required"];?></td></tr>    
<tr><td>IP Box.:    </td><td><?echo $row[0]["IP_Box"];?></td></tr> 
<tr><td>Fuel Sensor:  </td><td><?echo $row[0]["fuel_sensor"];?></td>
<tr><td>Bonnet Sensor:  </td><td><?echo $row[0]["bonnet_sensor"];?></td>
<tr><td>RFID Reader:  </td><td><?echo $row[0]["rfid_reader"];?></td>
<tr><td>Speed Alarm:  </td><td><?echo $row[0]["speed_alarm"];?></td> </tr>
<tr><td>Door lock/unlock circuit:  </td><td><?echo $row[0]["door_lock_unlock"];?></td>
<tr><td>Temperature Sensor:  </td><td><?echo $row[0]["temperature_sensor"];?></td>
<tr><td>Duty Box:  </td><td><?echo $row[0]["duty_box"];?></td>
<tr><td>Panic Button:  </td><td><?echo $row[0]["panic_button"];?></td></tr>

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
    elseif($row[0]["installation_status"]==11 ){echo "Request Forward to Repair Team";}
    elseif($row[0]["installation_status"]==3 ){echo "Back Installation";}
    elseif($row[0]["installation_status"]==15 ){echo "Pending Remaining Installation";}
    elseif($row[0]["installation_status"]==5 || $row[0]["installation_status"]==6){echo "Installation Close";}?></strong></td></tr>

<?php if($_SESSION['BranchId']==1){?>
    <tr><td>Sales Comment</td>  <td><?echo $row[0]["sales_comment"];?></td></tr>
    <tr><td>Admin Comment</td><td><?echo $row[0]["admin_comment"];?></td></tr>
    <!--<tr><td>Admin Approval</td>  <td><?if($row[0]["approve_status"]==1) echo "Approved"; else echo "Pending Approval"?></td></tr>-->
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


elseIf($tablename=="installation_request")
        {
   
    $query = "select * from  installation_request left join re_city_spr_1 on installation_request.Zone_area =re_city_spr_1.id where installation_request.id=".$RowId;
            $row=select_query($query);
    ?>
    <div id="databox">
<div class="heading">Installation Request</div>
<div class="dataleft"><table cellspacing="2" cellpadding="2">
    <tbody><tr>
 <td> Date:  </td><td><?echo $row[0]["req_date"];?></td></tr>      
<tr><td>Request By:  </td><td><?echo $row[0]["request_by"];?></td></tr>
<? 
$sales=select_query("select name from sales_person where id='".$row[0]['sales_person']."' ");
?>
<tr><td>Sales Person     </td><td><?echo $sales[0]['name'];?></td></tr>
<? $sql="SELECT Userid AS id,UserName AS sys_username FROM addclient  WHERE Userid=".$row[0]["user_id"];
    $rowuser=select_query($sql);
    ?>
<tr><td>Client User Name     </td><td><?echo $rowuser[0]["sys_username"];?></td></tr>
<tr><td>Company Name    </td><td><?echo $row[0]["company_name"];?></td></tr>
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
<tr><td>Payment:  </td><td><?echo $row[0]["payment_req"];?></td>

 </tr>

</tbody></table></div>



<div class="dataright">
<table cellspacing="2" cellpadding="2"><tbody>
<tr><td>Job:     </td><td><?echo $row[0]["instal_reinstall"];?></td></tr>
<tr><td>Amount:  </td><td><?echo $row[0]["amount"];?></td>
<tr><td>Payment Mode:  </td><td><?echo $row[0]["pay_mode"];?></td>
<tr><td>Required.:</td><td><?echo $row[0]["required"];?></td></tr>    
<tr><td>IP Box.:    </td><td><?echo $row[0]["IP_Box"];?></td></tr>
<tr><td>Fuel Sensor:  </td><td><?echo $row[0]["fuel_sensor"];?></td>
<tr><td>Bonnet Sensor:  </td><td><?echo $row[0]["bonnet_sensor"];?></td>
<tr><td>RFID Reader:  </td><td><?echo $row[0]["rfid_reader"];?></td>
<tr><td>Speed Alarm:  </td><td><?echo $row[0]["speed_alarm"];?></td>
<tr><td>Door lock/unlock circuit:  </td><td><?echo $row[0]["door_lock_unlock"];?></td>
<tr><td>Temperature Sensor:  </td><td><?echo $row[0]["temperature_sensor"];?></td>
<tr><td>Duty Box:  </td><td><?echo $row[0]["duty_box"];?></td>
<tr><td>Panic Button:  </td><td><?echo $row[0]["panic_button"];?></td></tr>
 
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
    elseif($row[0]["installation_status"]==11 ){echo "Request Forward to Repair Team";}
    elseif($row[0]["installation_status"]==3 ){echo "Back Installation";}
    elseif($row[0]["installation_status"]==15 ){echo "Pending Remaining Installation";}
    elseif($row[0]["installation_status"]==5 || $row[0]["installation_status"]==6){echo "Installation Close";}?></strong></td></tr>

<?php if($_SESSION['BranchId']==1 || $row[0]["inter_branch"]==1){?>
    <tr><td>Sales Comment</td>  <td><?echo $row[0]["sales_comment"];?></td></tr>
    <tr><td>Admin Comment</td><td><?echo $row[0]["admin_comment"];?></td></tr>
    <!--<tr><td>Admin Approval</td>  <td><?if($row[0]["approve_status"]==1) echo "Approved"; else echo "Pending Approval"?></td></tr>-->
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


    else If($tablename=="stop_gps")
        {
          $query = "SELECT * FROM ".$tablename." where id=".$RowId;
            $row=select_query($query);
    ?>
   
    <div id="databox">
<div class="heading">Stop Gps</div>
<div class="dataleft"><table cellspacing="2" cellpadding="2">
    <tbody>
<tr><td>Date     </td><td><?echo date("d-M-Y h:i:s A",strtotime($row[0]["date"]));?></td></tr>
<? /*if($row[0]["acc_manager"]=='saleslogin') {
$account_manager=$row[0]["sales_manager"];
}
else {
$account_manager=$row[0]["acc_manager"];
}*/

?>
<tr><td>Request By</td><td><?echo $row[0]["acc_manager"];?></td></tr>
<tr><td>Account Manager</td><td><?echo $row[0]["sales_manager"];?></td></tr>
<? $sql="SELECT Userid AS id,UserName AS sys_username FROM addclient  WHERE Userid=".$row[0]["client"];
    $rowuser=select_query($sql);
    ?>
<tr><td>Client User Name     </td><td><?echo $rowuser[0]["sys_username"];?></td></tr>
<tr><td>Company Name     </td><td><?echo $row[0]["company"];?></td></tr>
<tr><td>Total No Of Vehicle     </td><td><?echo $row[0]["tot_no_of_vehicle"];?></td></tr>
<tr><td>Persent Status Of</td><td>:---</td></tr>
<tr><td>Location     </td><td><?echo $row[0]["ps_of_location"];?></td></tr>
<tr><td>OwnerShip     </td><td><?echo $row[0]["ps_of_ownership"];?></td></tr>
<tr><td>Data to Display     </td><td><?echo $row[0]["data_display"];?></td></tr>
<tr><td>Reason     </td><td><?echo $row[0]["reason"];?></td></tr>
<tr><td>Vehicle to Stop GPS </td><td><?php $vechile_no = explode(",",$row[0]["reg_no"]);
for($i=0;$i<=count($vechile_no);$i++){ if($i%3!=0){ echo $vechile_no[$i].", ";}else { echo "<br/>".$vechile_no[$i].", ";} }?></td></tr>

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


    else If($tablename=="start_gps")
        {
          $query = "SELECT * FROM ".$tablename." where id=".$RowId;
            $row=select_query($query);
    ?>
   
    <div id="databox">
<div class="heading">Start Gps</div>
<div class="dataleft"><table cellspacing="2" cellpadding="2">
    <tbody>
<tr><td>Date     </td><td><?echo date("d-M-Y h:i:s A",strtotime($row[0]["date"]));?></td></tr>
<tr><td>Request By</td><td><?echo $row[0]["acc_manager"];?></td></tr>
<tr><td>Account Manager</td><td><?echo $row[0]["sales_manager"];?></td></tr>
<? $sql="SELECT Userid AS id,UserName AS sys_username FROM addclient  WHERE Userid=".$row[0]["client"];
    $rowuser=select_query($sql);
    ?>
<tr><td>Client User Name     </td><td><?echo $rowuser[0]["sys_username"];?></td></tr>
<tr><td>Company Name     </td><td><?echo $row[0]["company"];?></td></tr>
<tr><td>Total No Of Vehicle     </td><td><?echo $row[0]["tot_no_of_vehicle"];?></td></tr>
<tr><td>Persent Status Of</td><td>:---</td></tr>
<tr><td>OwnerShip     </td><td><?echo $row[0]["ps_of_ownership"];?></td></tr>
<tr><td>Reason     </td><td><?echo $row[0]["reason"];?></td></tr>
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
    elseif($row[0]["approve_status"]==0 && ($row[0]["account_comment"]!="" || $row[0]["total_pending"]!="") && $row[0]["forward_req_user"]!="" && $row[0]["forward_back_comment"]=="" && $row[0]["start_gps_status"]==1)    {echo "Pending Admin Approval (Req Forward to ".$row[0]["forward_req_user"].")";}
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
else If($tablename=="no_bills")
        {
          $query = "SELECT * FROM ".$tablename." where id=".$RowId;
            $row=select_query($query);
           
    ?><div id="databox">
<div class="heading">No Bills</div>
<div class="dataleft"><table cellspacing="2" cellpadding="2">
    <tbody>
<tr><td>Date     </td><td><?echo date("d-M-Y h:i:s A",strtotime($row[0]["date"]));?></td></tr>
<? /*if($row[0]["acc_manager"]=='saleslogin') {
$account_manager=$row[0]["sales_manager"];
}
else {
$account_manager=$row[0]["acc_manager"];
}*/

?>
<tr><td>Request By</td><td><?echo $row[0]["acc_manager"];?></td></tr>
<tr><td>Account Manager</td><td><?echo $row[0]["sales_manager"];?></td></tr>
<? $sql="SELECT Userid AS id,UserName AS sys_username FROM addclient  WHERE Userid=".$row[0]["client"];
    $rowuser=select_query($sql);
    ?>
<tr><td>Client User Name     </td><td><?echo $rowuser[0]["sys_username"];?></td></tr>
<tr><td>Company Name     </td><td><?echo $row[0]["company_name"];?></td></tr>
<!--<tr><td>Vehicle Num</td><td><?echo $row[0]["reg_no"];?></td></tr>-->

<tr><td>Vehicle Num </td><td><?php $vechile_no = explode(",",$row[0]["reg_no"]);
for($i=0;$i<=count($vechile_no);$i++){ if($i%3!=0){ echo $vechile_no[$i].", ";}else { echo "<br/>".$vechile_no[$i].", ";} }?></td></tr>

<tr><td>Total no of Vehicles </td><td><?echo $row[0]["tot_no_of_vehicles"];?></td></tr>
<tr><td>Vehicles for no bill</td><td><?echo $row[0]["veh_no_bill"];?></td></tr>
<tr><td>No Bill For    </td><td><?echo $row[0]["rent_device"];?></td></tr>
<tr><td>Reason    </td><td><?echo $row[0]["reason"];?></td></tr>
<tr><td>Provision Bill    </td><td><?echo $row[0]["provision_bill"];?></td></tr>
<tr><td>Duration for Provision Bill    </td><td><?echo $row[0]["duration"];?></td></tr>
<tr><td>Issue for No Bill</td><td><?echo $row[0]["no_bill_issue"];?></td></tr>

</tbody></table></div>

<div class="dataright">
<table cellspacing="2" cellpadding="2"><tbody>
 <!--<tr><td>Admin Approval</td>  <td><?if($row[0]["approve_status"]==1) echo "Approved"; else echo "Pending Approval"?></td></tr>-->
<tr><td><strong>Process Pending </strong></td>  <td><strong>
<?  if($row[0]["no_bill_status"]==2 || (($row[0]["support_comment"]!="" || $row[0]["admin_comment"]!="") && $row[0]["sales_comment"]==""))
    {echo "Reply Pending at Request Side";}   
    elseif($row[0]["no_bill_issue"]=="Software Issue" && ($row[0]["support_comment"]=="" || $row[0]["no_bill_status"]==1) && $row[0]["software_comment"]=="")
    {echo "Pending at Tech Support Team";}   
    elseif(($row[0]["no_bill_issue"]=="Service Issue" || $row[0]["no_bill_issue"]=="Client Side Issue") && $row[0]["no_bill_status"]==1 && $row[0]["approve_status"]!=1 && $row[0]["service_comment"]=="")    {echo "Pending at Service Team";}   
    elseif($row[0]["no_bill_status"]==1 && $row[0]["account_comment"]=="" && $row[0]["total_pending"]=="" && $row[0]["approve_status"]==0 ){echo "Pending at Accounts";}    
    elseif($row[0]["approve_status"]==0 && $row[0]["forward_req_user"]!="" && $row[0]["forward_back_comment"]=="" && $row[0]["no_bill_status"]==1)   
    {echo "Pending Admin Approval (Req Forward to ".$row[0]["forward_req_user"].")";}   
    elseif($row[0]["approve_status"]==0 && ($row[0]["account_comment"]!="" || $row[0]["total_pending"]!="") && $row[0]["final_status"]==0 && $row[0]["no_bill_status"]==1)
    {echo "Pending Admin Approval";}
    elseif($row[0]["approve_status"]==1 && $row[0]["final_status"]==0){echo "Pending at Account For No Bill";}   
    elseif($row[0]["final_status"]==1){echo "Process Done";}?></strong></td></tr>

<tr><td>Account Comment</td>  <td><?echo $row[0]["account_comment"];?></td></tr>
<tr><td>Sales Comment</td>  <td><?echo $row[0]["sales_comment"];?></td></tr>
 <tr><td>Payment Pending</td>  <td><?echo $row[0]["total_pending"];?></td></tr>
<tr><td>Service Comment</td><td><?echo $row[0]["service_comment"];?></td></tr>
<tr><td>Software Comment</td><td><?echo $row[0]["software_comment"];?></td></tr>
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
     
 
    else If($tablename=="discount_details")
        {
          $query = "SELECT * FROM ".$tablename." where id=".$RowId;
            $row=select_query($query);
           
           
          
            
            
    ?><div id="databox">
<div class="heading">Discount</div>
<div class="dataleft"><table cellspacing="2" cellpadding="2">
    <tbody>


<tr><td>Date     </td><td><?echo date("d-M-Y h:i:s A",strtotime($row[0]["date"]));?></td></tr>
<? /*if($row[0]["acc_manager"]=='saleslogin') {
$account_manager=$row[0]["sales_manager"];
}
else {
$account_manager=$row[0]["acc_manager"];
}*/

?>
<tr><td>Request By</td><td><?echo $row[0]["acc_manager"];?></td></tr>
<tr><td>Account Manager</td><td><?echo $row[0]["sales_manager"];?></td></tr>

<? $sql="SELECT Userid AS id,UserName AS sys_username FROM addclient  WHERE Userid=".$row[0]["user"];
    $rowuser=select_query($sql);
    ?>
<tr><td>Client User Name     </td><td><?echo $rowuser[0]["sys_username"];?></td></tr>
<tr><td>Company Name     </td><td><?echo $row[0]["client"];?></td></tr>
<!--<tr><td>Vehicle    for discount</td><td><?echo $row[0]["reg_no"];?></td></tr>-->
<tr><td>Vehicle    for discount </td><td><?php $vechile_no = explode(",",$row[0]["reg_no"]);
for($i=0;$i<=count($vechile_no);$i++){ if($i%3!=0){ echo $vechile_no[$i].", ";}else { echo "<br/>".$vechile_no[$i].", ";} }?></td></tr>

<tr><td>Discount For</td><td><?echo $row[0]["rent_device"];?></td></tr>
<tr><td>Month</td><td><?echo $row[0]["mon_of_dis_in_case_of_rent"];?></td></tr>
<tr><td>Discount Amount     </td><td><?echo $row[0]["dis_amt"];?></td></tr>
<tr><td>Before Discount     </td><td><?echo $row[0]["amt_before_dis"];?></td></tr>
<tr><td>After Discount     </td><td><?echo $row[0]["amt_rec_after_dis"];?></td></tr>
<tr><td>Reason    </td><td><?echo $row[0]["reason"];?></td></tr>
<tr><td>Issue for Discountng</td><td><?echo $row[0]["discount_issue"];?></td></tr>
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
    elseif($row[0]["approve_status"]==0 && ($row[0]["account_comment"]!="" || $row[0]["total_pending"]!="") && $row[0]["forward_req_user"]!="" && $row[0]["forward_back_comment"]=="" && $row[0]["discount_status"]==1)    {echo "Pending Admin Approval (Req Forward to ".$row[0]["forward_req_user"].")";}   
    elseif($row[0]["approve_status"]==0 && ($row[0]["account_comment"]!="" || $row[0]["total_pending"]!="") && $row[0]["final_status"]==0 && $row[0]["discount_status"]==1)
    {echo "Pending Admin Approval";}       
    elseif($row[0]["approve_status"]==1 && $row[0]["final_status"]==0){echo "Pending at Account For Discounting";}
    elseif($row[0]["final_status"]==1){echo "Process Done";}?></strong></td></tr>

<tr><td>Account Comment</td>  <td><?echo $row[0]["account_comment"];?></td></tr>
<tr><td>Payment Pending</td>  <td><?echo $row[0]["total_pending"];?></td></tr>
<tr><td>Sales Comment</td>  <td><?echo $row[0]["sales_comment"];?></td></tr>
<tr><td>Service Comment</td><td><?echo $row[0]["service_comment"];?></td></tr>
<tr><td>Repair Comment</td><td><?echo $row[0]["repair_comment"];?></td></tr>
<tr><td>Software Comment</td><td><?echo $row[0]["software_comment"];?></td></tr>
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
<tr><td>User Name     </td><td><?echo $rowuser[0]["sys_username"];?></td></tr>   
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
<tr><td>F/W Request Back Comment</td><td><?echo $row[0]["forward_back_comment"];?></td></tr><tr><td>Account Comment</td>  <td><?echo $row[0]["account_comment"];?></td></tr>
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
    elseIf($tablename=="sub_user_creation")
        {

          $query = "SELECT * FROM ".$tablename." where id=".$RowId;
            $row=select_query($query);

    ?><div id="databox">
<div class="heading">Sub User Creation</div>
<div class="dataleft"><table cellspacing="2" cellpadding="2">
    <tbody>
 <tr><td>Date    </td><td><?echo date("d-M-Y h:i:s A",strtotime($row[0]["date"]));?></td></tr>
<? /*if($row[0]["acc_manager"]=='saleslogin') {
$account_manager=$row[0]["sales_manager"];
}
else {
$account_manager=$row[0]["acc_manager"];
}*/

?>
<tr><td>Request By</td><td><?echo $row[0]["acc_manager"];?></td></tr>
<tr><td>Account Manager</td><td><?echo $row[0]["sales_manager"];?></td></tr>
<? $sql="SELECT Userid AS id,UserName AS sys_username FROM addclient  WHERE Userid=".$row[0]["main_user_id"];
    $rowuser=select_query($sql);
    ?>
<tr><td>Client User Name     </td><td><?echo $rowuser[0]["sys_username"];?></td></tr>

 <tr><td>Company Name     </td><td><?echo $row[0]["company"];?></td></tr>
<tr><td>Total No Of Vehicle     </td><td><?echo $row[0]["tot_no_of_vehicles"];?></td></tr>
<!--<tr><td>Vehicle to move     </td><td><?echo $row[0]["reg_no_of_vehicle_to_move"];?></td></tr>-->

<tr><td>Vehicle to move </td><td><?php $vechile_no = explode(",",$row[0]["reg_no_of_vehicle_to_move"]);
for($i=0;$i<=count($vechile_no);$i++){ if($i%3!=0){ echo $vechile_no[$i].", ";}else { echo "<br/>".$vechile_no[$i].", ";} }?></td></tr>

<tr><td>Contact Person     </td><td><?echo $row[0]["contact_person"];?></td></tr>
<tr><td>Contact Number     </td><td><?echo $row[0]["contact_number"];?></td></tr>
<tr><td>Sub-User Name     </td><td><?echo $row[0]["name"];?></td></tr>
<tr><td>Password</td><td><?echo $row[0]["req_sub_user_pass"];?></td></tr>

<tr><td>Reason</td><td><?echo $row[0]["reason"];?></td></tr>

</tbody></table></div>
<div class="dataright">
<table cellspacing="2" cellpadding="2"><tbody>
<tr><td>Main User Separate</td><td><?echo $row[0]["billing_separate"];?></td></tr>
<tr><td>Billing Name</td><td><?echo $row[0]["billing_name"];?></td></tr>
<tr><td>Billing Address</td><td><?echo $row[0]["billing_address"];?></td></tr>
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
<tr><td>Client User Name     </td><td><?echo $rowuser[0]["sys_username"];?></td></tr>   
<tr><td>Company Name </td><td><?echo $row[0]["company"];?></td></tr>    
<tr><td>Total No Of Vehicle </td><td><?echo $row[0]["total_no_of_vehicles"];?></td></tr>    
<tr><td>Deactivate </td><td><?echo $row[0]["deactivate_temp"];?></td></tr>
 <tr><td>Alert Date </td><td><?echo $row[0]["alert_date"];?></td></tr>
<tr><td>Delete From Debtors </td><td><?echo $row[0]["delete_form_debtors"];?></td></tr>
<tr><td>Device Removed Status</td><td><?echo $row[0]["device_remove_status"];?></td></tr>
<tr><td>No of Removed Device</td><td><?echo $row[0]["no_of_removed_devices"];?></td></tr>
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
<tr><td>Client User Name     </td><td><?echo $rowuser[0]["sys_username"];?></td></tr>   
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
<tr><td>Client User Name     </td><td><?echo $rowuser[0]["sys_username"];?></td></tr>   
<tr><td>Company Name </td><td><?echo $row[0]["company"];?></td></tr>    
<tr><td>Total No Of Vehicle </td><td><?echo $row[0]["total_no_of_vehicle"];?></td></tr>    
<tr><td>Date Of Creation  </td><td><?echo $row[0]["date_of_creation"];?></td></tr>    
<tr><td>Device Removed Status</td><td><?echo $row[0]["device_remove_status"];?></td></tr>
<tr><td>No of Removed Device</td><td><?echo $row[0]["no_of_devices_removed"];?></td></tr>
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
<? /*if($row[0]["acc_manager"]=='saleslogin') {
$account_manager=$row[0]["sales_manager"];
}
else {
$account_manager=$row[0]["acc_manager"];
}*/

?>
<tr><td>Request By</td><td><?echo $row[0]["acc_manager"];?></td></tr>
<tr><td>Account Manager</td><td><?echo $row[0]["sales_manager"];?></td></tr>
<? $sql="SELECT Userid AS id,UserName AS sys_username FROM addclient  WHERE Userid=".$row[0]["main_user_id"];
    $rowuser=select_query($sql);
    ?>
<tr><td>Client User Name     </td><td><?echo $rowuser[0]["sys_username"];?></td></tr>   

<tr><td>Company Name</td><td><?echo $row[0]["company"];?></td></tr>     
<tr><td>Total No Of Vehicle</td><td><?echo $row[0]["total_no_of_vehicles"];?></td></tr>     
<tr><td>Potential</td><td><?echo $row[0]["potential"];?></td></tr> 


<tr><td>Google Map</td><td><?echo $row[0]["rs_google_map"];?></td></tr>     
<tr><td>Admin </td><td><?echo $row[0]["rs_admin"];?></td></tr>    
<tr><td><tr><td>Type Of Alert</td><td><?echo $row[0]["alert"];?></td></tr> 
<tr><td>Alert Contact Number</td><td><?echo $row[0]["alert_contact"];?></td></tr>     
<tr><td><tr><td>Reports</td><td><?echo $row[0]["reports"];?></td></tr> 
</tbody></table></div>
<div class="dataright">
<table cellspacing="2" cellpadding="2"><tbody>
<tr><td>Client Contact Number </td><td><?echo $row[0]["client_contact_num"];?></td></tr>
<tr><td>Other Alert/ Info</td><td><?echo $row[0]["rs_others"];?></td></tr>     
<tr><td>Customize Report </td><td><?echo $row[0]["rs_customize_report"];?></td></tr>    
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
<? /*if($row[0]["acc_manager"]=='saleslogin') {
$account_manager=$row[0]["sales_manager"];
}
else {
$account_manager=$row[0]["acc_manager"];
}*/

?>
<tr><td>Request By</td><td><?echo $row[0]["acc_manager"];?></td></tr>
<tr><td>Account Manager</td><td><?echo $row[0]["sales_manager"];?></td></tr>

<? $sql="SELECT Userid AS id,UserName AS sys_username FROM addclient  WHERE Userid=".$row[0]["transfer_from_user"];
    $rowuser=select_query($sql);
    ?>
<tr><td>Client User Name     </td><td><?echo $rowuser[0]["sys_username"];?></td></tr>   



 <tr><td>Company Name </td><td><?echo $row[0]["transfer_from_company"];?></td></tr>    
<tr><td>Total No Of Vehicle </td><td><?echo $row[0]["total_no_of_veh"];?></td></tr>    
<!--<tr><td>Vehicle to move </td><td><?echo $row[0]["transfer_from_reg_no"];?></td></tr>-->

<tr><td>Vehicle to move </td><td><?php $vechile_no = explode(",",$row[0]["transfer_from_reg_no"]);
for($i=0;$i<=count($vechile_no);$i++){ if($i%3!=0){ echo $vechile_no[$i].", ";}else { echo "<br/>".$vechile_no[$i].", ";} }?></td></tr>

<tr><td>Transfer To:--</td><td> </td></tr>
<? $sql="SELECT Userid AS id,UserName AS sys_username FROM addclient  WHERE Userid=".$row[0]["transfer_to_user"];
    $rowuser=select_query($sql);
    ?>
<tr><td>Transfer User Name     </td><td><?echo $rowuser[0]["sys_username"];?></td></tr>   
<tr><td>Transfer Company Name     </td><td><?echo $row[0]["transfer_to_company"];?></td></tr>
<tr><td>Billing</td><td><?echo $row[0]["transfer_to_billing"];?></td></tr>
<tr><td>Billing Name</td><td><?echo $row[0]["billing_name"];?></td></tr>
<tr><td>Billing Address</td><td><?echo $row[0]["billing_address"];?></td></tr>     
</tbody></table></div>
<div class="dataright">
<table cellspacing="2" cellpadding="2"><tbody>
<tr><td>Reason</td><td><?echo $row[0]["reason"];?></td></tr>
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

?></td>
    </tr>
</tbody>
 

    </table>
    </div>
    </div>
    <?
    }
    }
?> 