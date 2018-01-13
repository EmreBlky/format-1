<?php
error_reporting(0);
ob_start();
session_start();
include("../connection.php");
$q=$_GET["user_id"];
$veh_reg=$_GET["veh_reg"];
$row_id=$_GET["row_id"];
$comment=$_GET["comment"];
 
  

if(isset($_GET['action']) && $_GET['action']=='Dimts_imeiPaymentPending')
{
	  $Updateapprovestatus="update dimts_imei  set port_change_reason='".$comment."'  where id=".$row_id;
	if(mysql_query($Updateapprovestatus))
	echo "Successfully added pending amount";
	 
}

if(isset($_GET['action']) && $_GET['action']=='RenewDimts_imeiPort')
{
	  $Updateapprovestatus="update renew_dimts_imei set port_change_reason='".$comment."'  where id=".$row_id;
	if(mysql_query($Updateapprovestatus))
	echo "Successfully added pending amount";
	 
}

if(isset($_GET['action']) && $_GET['action']=='Dimts_imeiPaymentClear')
{
	  echo $Updateapprovestatus="update dimts_imei  set repair_comment='Port Changed-Done ".date("Y-m-d H:i:s")."'  where id=".$row_id;
	if(mysql_query($Updateapprovestatus))
	echo "Ok";
	 
}	

if(isset($_GET['action']) && $_GET['action']=='RenewDimts_imei')
{
	  echo $Updateapprovestatus="update renew_dimts_imei set repair_comment='Port Changed-Done ".date("Y-m-d H:i:s")."'  where id=".$row_id;
	if(mysql_query($Updateapprovestatus))
	echo "Ok";
	 
}

if(isset($_GET['action']) && $_GET['action']=='DeactivatesimComment')
{
	    $Updateapprovestatus="update deactivate_sim set account_comment='".addslashes($comment)."' where id=".$row_id;
	 if(mysql_query($Updateapprovestatus))
	 echo "Comment Added Successfully";
	
 }
 
if(isset($_GET['action']) && $_GET['action']=='ForwardServiceDone')
{
	/*$Updateapprovestatus="update services set service_status='2', fwd_repair_to_serv='".date("Y-m-d H:i:s")." - ".$comment."' where id=".$row_id;
	 mysql_query($Updateapprovestatus);*/
	
	if($_SESSION['userId'] != '') 
	{	 
		$Update_status = array('service_status' => 2, 'fwd_done_time' => date("Y-m-d H:i:s"), 'fwd_repair_to_serv' => $comment);
		$condition = array('id' => $row_id);	
		update_query('internalsoftware.services', $Update_status, $condition);
		
		$request_list = array('is_service' => '1');
		$condition2 = array('user_id' => $_SESSION['userId']);
		update_query('internalsoftware.request_forward_list', $request_list, $condition2);
	}
	else
	{
		echo "Your Login Session Expired. Kindly Re-Login!";
	}
}

if(isset($_GET['action']) && $_GET['action']=='ServiceDeviceRemoved')
{
	if($_SESSION['userId'] != '') 
	{
		$Update_status = array('service_status' => 2, 'fwd_done_time' => date("Y-m-d H:i:s"), 'fwd_repair_to_serv' => $comment);
		$condition = array('id' => $row_id);	
		update_query('internalsoftware.services', $Update_status, $condition);
		
		$request_list = array('is_service' => '1');
		$condition2 = array('user_id' => $_SESSION['userId']);
		update_query('internalsoftware.request_forward_list', $request_list, $condition2);
	}
	else
	{
		echo "Your Login Session Expired. Kindly Re-Login!";
	}
} 

if(isset($_GET['action']) && $_GET['action']=='ForwardInstallationDone')
{
	/*$Updateapprovestatus="update installation set installation_status='2', fwd_repair_to_install='".date("Y-m-d H:i:s")." - ".$comment."' where id=".$row_id;	   
	 mysql_query($Updateapprovestatus);*/
	
	if($_SESSION['userId'] != '') 
	{
		$Update_status = array('installation_status' => 2, 'fwd_done_time' => date("Y-m-d H:i:s"), 'fwd_repair_to_install' => $comment);
		$condition = array('id' => $row_id);	
		update_query('internalsoftware.installation', $Update_status, $condition);
		
		$request_list = array('is_installation' => '1');
		$condition2 = array('user_id' => $_SESSION['userId']);
		update_query('internalsoftware.request_forward_list', $request_list, $condition2);
	}
	else
	{
		echo "Your Login Session Expired. Kindly Re-Login!";
	}
	
} 

if(isset($_GET['action']) && $_GET['action']=='InstallationDeviceRemoved')
{	   	 
	if($_SESSION['userId'] != '') 
	{
		$Update_status = array('installation_status' => 2, 'fwd_done_time' => date("Y-m-d H:i:s"), 'fwd_repair_to_install' => $comment);
		$condition = array('id' => $row_id);	
		update_query('internalsoftware.installation', $Update_status, $condition);
		
		$request_list = array('is_installation' => '1');
		$condition2 = array('user_id' => $_SESSION['userId']);
		update_query('internalsoftware.request_forward_list', $request_list, $condition2);
	}
	else
	{
		echo "Your Login Session Expired. Kindly Re-Login!";
	}
} 

if(isset($_GET['action']) && $_GET['action']=='rdconversion_addComment')
{
	$query = "SELECT rd_comment FROM ad_rd_conversion  where id=".$row_id;
	$row=select_query($query);
	  
	$Updateapprovestatus="update ad_rd_conversion set rd_comment='".$row[0]["rd_comment"]."<br/>".date("Y-m-d H:i:s")." - ".$comment."', status='2' where id=".$row_id;
	
	if(mysql_query($Updateapprovestatus))
	echo "Comment added Successfully";
}

 
if(isset($_GET['action']) && $_GET['action']=='accountSimchangeComment')
{
	    $Updateapprovestatus="update sim_change set account_comment='".addslashes($comment)."' where id=".$row_id;
	 if(mysql_query($Updateapprovestatus))
	 echo "Comment Added Successfully";
	
 }

if(isset($_GET['action']) && $_GET['action']=='discount_addComment')
{
	$query = "SELECT repair_comment FROM discount_details  where id=".$row_id;
	$row=select_query($query);
 
	$Updateapprovestatus="update discount_details  set repair_comment='".$row[0]["repair_comment"]."<br/>".date("Y-m-d H:i:s")." - " .$comment."' where id=".$row_id;
	mysql_query($Updateapprovestatus);
} 

if(isset($_GET['action']) && $_GET['action']=='discountingbackComment')
{
	 $query = "SELECT forward_back_comment FROM discounting  where id=".$row_id;
	 $row=select_query($query);

	$Updateapprovestatus="update discounting set forward_back_comment='".$row[0]["forward_back_comment"]."<br/>".date("Y-m-d H:i:s")." - " .$comment."' where id=".$row_id;
	
	mysql_query($Updateapprovestatus);
}
  
if(isset($_GET['action']) && $_GET['action']=='Device_lostPaymentClear')
{
	    $Updateapprovestatus="update device_lost  set account_comment='Payment cleared' where id=".$row_id;
	 if(mysql_query($Updateapprovestatus))
	 echo "Comment Added Successfully";
	
 }
 
 
  
if(isset($_GET['action']) && $_GET['action']=='Device_lostPaymentPending')
{
	    $Updateapprovestatus="update device_lost set odd_paid_unpaid='".addslashes($comment)."' where id=".$row_id;
	 if(mysql_query($Updateapprovestatus))
	 echo "Comment Added Successfully";
	
 }
 
  
if(isset($_GET['action']) && $_GET['action']=='Device_lostComment')
{
	    $Updateapprovestatus="update device_lost set account_comment='".addslashes($comment)."' where id=".$row_id;
	 if(mysql_query($Updateapprovestatus))
	 echo "Comment Added Successfully";
	
 }
 
 if(isset($_GET['action']) && $_GET['action']=='deletionPaymentClear')
{
	    $Updateapprovestatus="update deletion  set odd_paid_unpaid='Payment cleared' where id=".$row_id;
	 if(mysql_query($Updateapprovestatus))
	 echo "Comment Added Successfully";
	
 }
 
 
  
if(isset($_GET['action']) && $_GET['action']=='deletionPaymentPending')
{
	    $Updateapprovestatus="update deletion set odd_paid_unpaid='".addslashes($comment)."' where id=".$row_id;
	 if(mysql_query($Updateapprovestatus))
	 echo "Comment Added Successfully";
	
 }
 
  if(isset($_GET['action']) && $_GET['action']=='getdatareplce')
{
  
  $result="select services.id as id,services.id,veh_reg from matrix.services
 
where services.id in 

(select distinct sys_service_id from matrix.group_services where active=true and sys_group_id in (

select sys_group_id from matrix.group_users where sys_user_id=(".$q.")))";

																
$data = select_query_live_con($result);
//$result = mysql_query("SELECT veh_reg FROM vehicles WHERE user_id = '".$q."'");ShowDeviceInfo(this.value);

$msg=' <select name="veh_reg_replce" id="veh_reg_replce" onchange="getdeviceImei(this.value,\'replaceDeviceIMEI\');getInstaltiondate(this.value,\'replacedate_of_install\');getInstaltiondate(this.value,\'replacedate_oInstaltiondate_install\');getdevicemobile(this.value,\'Devicemobile\');">
<option value="0">Select Vehicle No</option>';

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


 if(isset($_GET['action']) && $_GET['action']=='getrowSales')
	{
 ?>
<style type="text/css">
#databox {
	width:840px;
	height:500px;
	margin: 30px auto auto;
	border:1px solid #bfc0c1;
	font-family:Arial, Helvetica, sans-serif;
	font-size:13px;
	font-weight:normal;
	color:#3f4041;
}
.heading {
	font-family:Arial, Helvetica, sans-serif;
	font-size:30px;
	font-weight:700;
	word-spacing:5px;
	text-align:center;
	color:#3E3E3E;
	background-color:#ECEFE7;
	margin-bottom:10px;
}
.dataleft {
	float:left;
	width:400px;
	height:400px;
	margin-left:10px;
	border-right:1px solid #bfc0c1;
}
.dataright {
	float:left;
	width:400px;
	height:400px;
	margin-left:19px;
}
td {
	padding-right:20px;
	padding-left:20px;
}
</style>
<?

			$RowId=$_GET["RowId"];
			$tablename=$_GET["tablename"];
	
	 If($tablename=="dimts_imei")
		{
		 $query = "SELECT * FROM ".$tablename." where id=".$RowId; 
			$row=select_query($query);
	?>
<div id="databox">
  <div class="heading">View Dimts IMEI Details</div>
  <div class="dataleft">
    <table cellspacing="2" cellpadding="2">
      <tbody>
        <tr>
          <td>Date </td>
          <td><?echo $row[0]["date"];?></td>
        </tr>
        <tr>
          <td>Request By</td>
          <td><?echo $row[0]["acc_manager"];?></td>
        </tr>
        <tr>
          <td>Sales Manager </td>
          <td><?echo $row[0]["sales_manager"];?></td>
        </tr>
        <? $sql="SELECT Userid AS id,UserName AS sys_username FROM addclient  WHERE Userid=".$row[0]["user_id"];
	$rowuser=select_query($sql);
	?>
        <tr>
          <td>User Name </td>
          <td><?echo $rowuser[0]["sys_username"];?></td>
        </tr>
        <tr>
          <td>Company Name </td>
          <td><?echo $row[0]["client"];?></td>
        </tr>
        <tr>
          <td>Vehicle No</td>
          <td><?echo $row[0]["veh_reg"];?></td>
        </tr>
        <tr>
          <td>7 digit IMEI </td>
          <td><?echo $row[0]["device_imei_7"];?></td>
        </tr>
        <tr>
          <td>15 digit IMEI</td>
          <td><?echo $row[0]["device_imei_15"];?></td>
        </tr>
        <tr>
          <td>Changed to Port</td>
          <td><?echo $row[0]["port_change"];?></td>
        </tr>
        <tr>
          <td colspan="2">-------------------------------------------</td>
        </tr>
      </tbody>
    </table>
  </div>
  <div class="dataright">
    <table cellspacing="2" cellpadding="2">
      <tbody>
        <!-- <tr><td>Admin Approval</td>  <td><?if($row[0]["approve_status"]==1) echo "Approved"; else echo "Pending Approval"?></td></tr>-->
        <tr>
          <td><strong>Process Pending </strong></td>
          <td><strong>
            <?  if($row[0]["dimts_status"]==2 || (($row[0]["imei_upload_reason"]!="" || $row[0]["admin_comment"]!="") && $row[0]["support_comment"]=="" && $row[0]["service_comment"]==""))
	{echo "Reply Pending at Request Side";}
	elseif($row[0]["account_comment"]=="" && $row[0]["payment_status"]=="" && $row[0]["approve_status"]==0 && $row[0]["final_status"]==0){echo "Pending at Accounts";} 
	elseif($row[0]["approve_status"]==0 && $row[0]["forward_req_user"]!="" && $row[0]["forward_back_comment"]=="" && $row[0]["dimts_status"]==1)	
	{echo "Pending Admin Approval (Req Forward to ".$row[0]["forward_req_user"].")";}
	elseif($row[0]["approve_status"]==0 && $row[0]["payment_status"]!="" && $row[0]["final_status"]==0 && $row[0]["dimts_status"]==1)
	{echo "Pending Admin Approval";}
	elseif(($row[0]["approve_status"]==1 || $row[0]["account_comment"]!="") && $row[0]["dimts_status"]==1 && $row[0]["support_comment"]=="" && $row[0]["final_status"]!=1){echo "Pending at Support for IMEI Uplode";}
	elseif(($row[0]["approve_status"]==1 || $row[0]["account_comment"]!="") && $row[0]["dimts_status"]==1 && $row[0]["repair_comment"]=="" && $row[0]["final_status"]!=1){echo "Pending at Repair For Port Change";}
	elseif($row[0]["support_comment"]!="" && $row[0]["repair_comment"]!="" && $row[0]["final_status"]!=1){echo "Process Not Closed Request End";}
	elseif($row[0]["final_status"]==1){echo "Process Done";}?>
            </strong></td>
        </tr>
        <tr>
          <td>Admin Comment</td>
          <td><?echo $row[0]["admin_comment"];?></td>
        </tr>
        <tr>
          <td>Account Comment</td>
          <td><?echo $row[0]["account_comment"];?></td>
        </tr>
        <tr>
          <td>service Comment</td>
          <td><?echo $row[0]["service_comment"];?></td>
        </tr>
        <tr>
          <td>Support Comment</td>
          <td><?echo $row[0]["support_comment"];?></td>
        </tr>
        <tr>
          <td>Repair Comment</td>
          <td><?echo $row[0]["repair_comment"];?></td>
        </tr>
        <tr>
          <td>Reason for Port not changing</td>
          <td><?echo $row[0]["port_change_reason"];?></td>
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
      </tbody>
    </table>
  </div>
</div>
<? } 
	
	else If($tablename=="comment")
        {
        //"select * from comment where service_id='".$service_id."' order by date desc"
         
    ?>
<div >
  <div style=" padding-left: 50px;">
    <h1>Comment</h1>
  </div>
  <div class="table">
    <table cellspacing="2" cellpadding="2" style=" padding-left: 100px;width: 500px;">
      <tr>
        <td><?

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
 ?></td>
      </tr>
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
  <div class="dataleft">
    <table cellspacing="2" cellpadding="2">
      <tbody>
        <tr>
          <td>Date </td>
          <td><?echo $row[0]["date"];?></td>
        </tr>
        <tr>
          <td>Request By</td>
          <td><?echo $row[0]["acc_manager"];?></td>
        </tr>
        <tr>
          <td>Sales Manager </td>
          <td><?echo $row[0]["sales_manager"];?></td>
        </tr>
        <? $sql="SELECT Userid AS id,UserName AS sys_username FROM addclient  WHERE Userid=".$row[0]["user_id"];
	$rowuser=select_query($sql);
	?>
        <tr>
          <td>User Name </td>
          <td><?echo $rowuser[0]["sys_username"];?></td>
        </tr>
        <tr>
          <td>Company Name </td>
          <td><?echo $row[0]["client"];?></td>
        </tr>
        <tr>
          <td>Vehicle No</td>
          <td><?echo $row[0]["veh_reg"];?></td>
        </tr>
        <tr>
          <td>7 digit IMEI </td>
          <td><?echo $row[0]["device_imei_7"];?></td>
        </tr>
        <tr>
          <td>15 digit IMEI</td>
          <td><?echo $row[0]["device_imei_15"];?></td>
        </tr>
        <tr>
          <td>Changed to Port</td>
          <td><?echo $row[0]["port_change"];?></td>
        </tr>
        <tr>
          <td>Port Change Status</td>
          <td><?echo $row[0]["port_change_status"];?></td>
        </tr>
        <tr>
          <td colspan="2">-------------------------------------------</td>
        </tr>
      </tbody>
    </table>
  </div>
  <div class="dataright">
    <table cellspacing="2" cellpadding="2">
      <tbody>
        <!--<tr><td>Admin Approval</td>  <td><?if($row[0]["approve_status"]==1) echo "Approved"; else echo "Pending Approval"?></td></tr>-->
        <tr>
          <td><strong>Process Pending </strong></td>
          <td><strong>
            <?  if($row[0]["renew_dimts_status"]==2 || ( $row[0]["admin_comment"]!="" && $row[0]["service_comment"]=="")){echo "Reply Pending at Request Side";}
	elseif($row[0]["account_comment"]=="" && $row[0]["payment_status"]=="" && $row[0]["approve_status"]==0 && $row[0]["final_status"]==0){echo "Pending at Accounts";} 
	elseif($row[0]["approve_status"]==0 && $row[0]["forward_req_user"]!="" && $row[0]["forward_back_comment"]=="" && $row[0]["renew_dimts_status"]==1)	
	{echo "Pending Admin Approval (Req Forward to ".$row[0]["forward_req_user"].")";}
	elseif($row[0]["approve_status"]==0 && $row[0]["payment_status"]!="" && $row[0]["final_status"]==0 && $row[0]["renew_dimts_status"]==1)
	{echo "Pending Admin Approval";}
	elseif(($row[0]["approve_status"]==1 || $row[0]["account_comment"]!="") && $row[0]["renew_dimts_status"]==1 && $row[0]["repair_comment"]=="" && $row[0]["port_change_status"]=="Yes" && $row[0]["final_status"]!=1)
	{echo "Pending at Repair For Port Change";}
	elseif(($row[0]["repair_comment"]!="" || ($row[0]["port_change_status"]!="Yes" && ($row[0]["approve_status"]==1 || $row[0]["account_comment"]!="")))&& $row[0]["final_status"]!=1){echo "Process Not Closed Request End";}
	elseif($row[0]["final_status"]==1){echo "Process Done";}?>
            </strong></td>
        </tr>
        <tr>
          <td>Admin Comment</td>
          <td><?echo $row[0]["admin_comment"];?></td>
        </tr>
        <tr>
          <td>Account Comment</td>
          <td><?echo $row[0]["account_comment"];?></td>
        </tr>
        <tr>
          <td>service Comment</td>
          <td><?echo $row[0]["service_comment"];?></td>
        </tr>
        <!--<tr><td>Support Comment</td><td><?echo $row[0]["support_comment"];?></td></tr>-->
        <tr>
          <td>Repair Comment</td>
          <td><?echo $row[0]["repair_comment"];?></td>
        </tr>
        <tr>
          <td>Reason for Port not changing</td>
          <td><?echo $row[0]["port_change_reason"];?></td>
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
      </tbody>
    </table>
  </div>
</div>
<? }


	else If($tablename=="services")
	{
		  $query = "SELECT * FROM services left join re_city_spr_1 on services.Zone_area =re_city_spr_1.id  where services.id=".$RowId; 
		  $row=select_query($query);
		  
		  if($row[0]['fwd_tech_rm_id'] != "" && $row[0]['fwd_repair_id'] == ""){
				$support_query = select_query("select user_name from request_forward_list where user_id='".$row[0]['fwd_tech_rm_id']."'");
				$forward_name = $support_query[0]['user_name'];
			} else if($row[0]['fwd_repair_id'] != "") {
				$support_query = select_query("select user_name from request_forward_list where user_id='".$row[0]['fwd_repair_id']."'");
				$forward_name = $support_query[0]['user_name'];
			} else { $forward_name = '';}
		  
		  
	?>
<div id="databox">
  <div class="heading">Service</div>
  <div class="dataleft">
    <table cellspacing="2" cellpadding="2">
      <tbody>
        <tr>
          <td> Date </td>
          <td><?echo $row[0]["req_date"];?></td>
        </tr>
        <tr>
          <td>Request By </td>
          <td><?echo $row[0]["request_by"];?></td>
        </tr>
        <? $sql="SELECT Userid AS id,UserName AS sys_username FROM addclient  WHERE Userid=".$row[0]["user_id"];
	$rowuser=select_query($sql);
	?>
        <tr>
          <td>Client User Name </td>
          <td><?echo $rowuser[0]["sys_username"];?></td>
        </tr>
        <tr>
          <td>Company Name </td>
          <td><?echo $row[0]["company_name"];?></td>
        </tr>
        <tr>
          <td>Registration No </td>
          <td><?echo $row[0]["veh_reg"];?></td>
        </tr>
        <tr>
          <td>Device Model: </td>
          <td><?echo $row[0]["device_model"];?></td>
        </tr>
        <tr>
          <td>Device IMEI: </td>
          <td><?echo $row[0]["device_imei"];?></td>
        </tr>
        <tr>
          <td>Date Of Installation: </td>
          <td><?echo $row[0]["date_of_installation"];?></td>
        </tr>
        <tr>
          <td>Not working:</td>
          <td><?echo $row[0]["Notwoking"];?></td>
        </tr>
        <tr>
          <td>Area: </td>
          <td><?echo $row[0]["name"];?></td>
        </tr>
        <?php if($row[0]['location']!=""){?>
        <tr>
          <td>Location: </td>
          <td><?echo $row[0]["location"];?></td>
        </tr>
        <?php }else{ $city= mysql_fetch_array(mysql_query("select * from tbl_city_name where branch_id='".$row[0]['inter_branch']."'"));?>
        <tr>
          <td>Location: </td>
          <td><?echo $city["city"];?></td>
        </tr>
        <?php }?>
        <tr>
          <td>Available Time Status: </td>
          <td><?echo $row[0]["atime_status"];?></td>
        </tr>
        <tr>
          <td>Available Time: </td>
          <td><?echo $row[0]["atime"];?></td>
        </tr>
        <tr>
          <td>To Available Time: </td>
          <td><?echo $row[0]["atimeto"];?></td>
        </tr>
        <tr>
          <td>Person Name: </td>
          <td><?echo $row[0]["pname"];?></td>
        </tr>
        <tr>
          <td>Contact No: </td>
          <td><?echo $row[0]["cnumber"];?></td>
        </tr>
      </tbody>
    </table>
  </div>
  <div class="dataright">
    <table cellspacing="2" cellpadding="2">
      <tbody>
        <tr>
          <td>Job: </td>
          <td><?echo $row[0]["service_reinstall"];?></td>
        </tr>
        <tr>
          <td>Required: </td>
          <td><?echo $row[0]["required"];?></td>
        </tr>
        <tr>
          <td>IP Box: </td>
          <td><?echo $row[0]["IP_Box"];?></td>
        </tr>
        <tr>
          <td>Comment</td>
          <td><?echo $row[0]["comment"];?></td>
        </tr>
        <tr>
          <td>Reason To Back Services:</td>
          <td><?echo $row[0]["back_reason"];?></td>
        </tr>
        <tr>
          <td>Installer Name: </td>
          <td><?echo $row[0]["inst_name"];?></td>
        </tr>
        <tr>
          <td>Installer Current Location: </td>
          <td><?echo $row[0]["inst_cur_location"];?></td>
        </tr>
        <tr>
          <td>Problem:</td>
          <td><?echo $row[0]["reason"];?></td>
        </tr>
        <tr>
          <td>Problem Due to:</td>
          <td><?echo $row[0]["problem_in_service"];?></td>
        </tr>
        <tr>
          <td>Reason:</td>
          <td><?echo $row[0]["problem"];?></td>
        </tr>
        <tr>
          <td>Antenna Billing:</td>
          <td><?echo $row[0]["ant_billing_amt"];?></td>
        </tr>
        <tr>
          <td>Billing Reason:</td>
          <td><?echo $row[0]["ant_billing_reason"];?></td>
        </tr>
        <tr>
          <td>Forward to <strong>
            <?=$forward_name;?>
            </strong> :</td>
          <td><? if($row[0]['fwd_reason'] != "" && $row[0]['fwd_tech_rm_id'] != "" && $row[0]['fwd_repair_id'] == "") {
			echo $row[0]['fwd_datetime'].' - '.$row[0]['fwd_reason'];
		} else if($row[0]['fwd_serv_to_repair'] != "" && $row[0]['fwd_repair_id'] == "") {
			echo $row[0]['fwd_serv_to_repair']; 
		} else if($row[0]['fwd_serv_to_repair'] != "" && $row[0]['fwd_repair_id'] != "") {
			echo $row[0]['fwd_repair_date'].' - '.$row[0]['fwd_serv_to_repair']; 
		}
	?></td>
        </tr>
        <tr>
          <td>Reply Comment:</td>
          <td><? if(($row[0]['fwd_tech_rm_id'] != "" || $row[0]['fwd_repair_id'] == "") && $row[0]["fwd_repair_to_serv"] != ''){
			 echo $row[0]['fwd_done_time'].' - '.$row[0]["fwd_repair_to_serv"];
		} else {
			echo $row[0]["fwd_repair_to_serv"];
		}
	 ?></td>
        </tr>
        <tr>
          <td><strong>Process Pending </strong></td>
          <td><strong>
            <? if($row[0]["service_status"]==1 ){echo "Pending Dispatch Team";}
				elseif($row[0]["service_status"]==2 ){echo "Assign To Installer";}
				elseif($row[0]["service_status"]==11 ){echo "Request Forward to ".$forward_name;}
				elseif($row[0]["service_status"]==3 ){echo "Back Installation";}
				elseif($row[0]["service_status"]==5 || $row[0]["service_status"]==6){echo "Service Close";}?>
            </strong></td>
        </tr>
        <tr>
          <td>Service Done At: </td>
          <td><?echo $row[0]["time"];?></td>
        </tr>
    </table>
  </div>
</div>
<? }


	else If($tablename=="installation")
		{
	
        $query = "select * from  installation left join re_city_spr_1 on installation.Zone_area =re_city_spr_1.id where installation.id=".$RowId;
        $row=select_query($query);
		
		if($row[0]['fwd_tech_rm_id'] != "" && $row[0]['fwd_repair_id'] == ""){
			$support_query = select_query("select user_name from request_forward_list where user_id='".$row[0]['fwd_tech_rm_id']."'");
			$forward_name = $support_query[0]['user_name'];
		} else if($row[0]['fwd_repair_id'] != "") {
			$support_query = select_query("select user_name from request_forward_list where user_id='".$row[0]['fwd_repair_id']."'");
			$forward_name = $support_query[0]['user_name'];
		} else { $forward_name = '';}
	
        ?>
<div id="databox">
  <div class="heading">Installation</div>
  <div class="dataleft">
    <table cellspacing="2" cellpadding="2">
      <tbody>
        <tr>
          <td> Date: </td>
          <td><?echo $row[0]["req_date"];?></td>
        </tr>
        <tr>
          <td>Request By: </td>
          <td><?echo $row[0]["request_by"];?></td>
        </tr>
        <?  
$sales=mysql_fetch_array(mysql_query("select name from sales_person where id='".$row[0]['sales_person']."'"));
?>
        <tr>
          <td>Sales Person </td>
          <td><?echo $sales['name'];?></td>
        </tr>
        <? $sql="SELECT Userid AS id,UserName AS sys_username FROM addclient  WHERE Userid=".$row[0]["user_id"];
	$rowuser=select_query($sql);
	?>
        <tr>
          <td>Client User Name </td>
          <td><?echo $rowuser[0]["sys_username"];?></td>
        </tr>
        <tr>
          <td>Company Name </td>
          <td><?echo $row[0]["company_name"];?></td>
        </tr>
        <tr>
          <td>No. Of Vehicales: </td>
          <td><?echo $row[0]["no_of_vehicals"];?></td>
        </tr>
        <tr>
          <td>Area: </td>
          <td><?echo $row[0]["name"];?></td>
        </tr>
        
        <!--<tr><td>Location: </td><td><?echo $row[0]["location"];?></td></tr>-->
        <?php if($row[0]['location']!=""){?>
        <tr>
          <td>Location: </td>
          <td><?echo $row[0]["location"];?></td>
        </tr>
        <?php }else{ $city= mysql_fetch_array(mysql_query("select * from tbl_city_name where branch_id='".$row[0]['inter_branch']."'"));?>
        <tr>
          <td>Location: </td>
          <td><?echo $city["city"];?></td>
        </tr>
        <?php }?>
        <tr>
          <td>Model:</td>
          <td><?echo $row[0]["model"];?></td>
        </tr>
        <tr>
          <td>Available Time Status: </td>
          <td><?echo $row[0]["atime_status"];?></td>
        </tr>
        <tr>
          <td>Time: </td>
          <td><?echo $row[0]["time"];?></td>
        </tr>
        <tr>
          <td>To Time: </td>
          <td><?echo $row[0]["totime"];?></td>
        </tr>
        <tr>
          <td>Contact No.:</td>
          <td><?echo $row[0]["contact_number"];?></td>
        </tr>
        <tr>
          <td>Contact Person: </td>
          <td><?echo $row[0]["contact_person"];?></td>
        </tr>
        <tr>
          <td>DIMTS: </td>
          <td><?echo $row[0]["dimts"];?></td>
        </tr>
        <tr>
          <td>Demo: </td>
          <td><?echo $row[0]["demo"];?></td>
        </tr>
        <tr>
          <td>Vehicle Type: </td>
          <td><?echo $row[0]["veh_type"];?></td>
        </tr>
        <tr>
          <td>Immobilizer: </td>
          <td><?echo $row[0]["immobilizer_type"];?></td>
        </tr>
          </tr>
        
      </tbody>
    </table>
  </div>
  <div class="dataright">
    <table cellspacing="2" cellpadding="2">
      <tbody>
        <tr>
          <td>Payment: </td>
          <td><?echo $row[0]["payment_req"];?></td>
        <tr>
          <td>Amount: </td>
          <td><?echo $row[0]["amount"];?></td>
        <tr>
          <td>Payment Mode: </td>
          <td><?echo $row[0]["pay_mode"];?></td>
        <tr>
          <td>Required.:</td>
          <td><?echo $row[0]["required"];?></td>
        </tr>
        <tr>
          <td>IP Box.: </td>
          <td><?echo $row[0]["IP_Box"];?></td>
        </tr>
        <tr>
          <td>Contact Person No.: </td>
          <td><?echo $row[0]["contact_person_no"];?></td>
        </tr>
        <tr>
          <td>Installation Made: </td>
          <td><?echo $row[0]["installation_made"];?></td>
        </tr>
        <tr>
          <td>Installer Name: </td>
          <td><?echo $row[0]["inst_name"];?></td>
        </tr>
        <tr>
          <td>Installer Current Location: </td>
          <td><?echo $row[0]["inst_cur_location"];?></td>
        </tr>
        <!--<tr><td>Change Installer Name: </td><td><?echo $row[0]["inst_cur_location"];?></td></tr>   
-->
        <tr>
          <td>Installation Done At: </td>
          <td><?echo $row[0]["rtime"];?></td>
        </tr>
        <tr>
          <td>Reason To Back Services:</td>
          <td><?echo $row[0]["back_reason"];?></td>
        </tr>
        <tr>
          <td>Forward to <strong>
            <?=$forward_name;?>
            </strong> :</td>
          <td><? if($row[0]['fwd_reason'] != "" && $row[0]['fwd_tech_rm_id'] != "" && $row[0]['fwd_repair_id'] == "") {
			echo $row[0]['fwd_datetime'].' - '.$row[0]['fwd_reason'];
		} else if($row[0]['fwd_install_to_repair'] != "" && $row[0]['fwd_repair_id'] == "") {
			echo $row[0]['fwd_install_to_repair']; 
		} else if($row[0]['fwd_install_to_repair'] != "" && $row[0]['fwd_repair_id'] != "") {
			echo $row[0]['fwd_repair_date'].' - '.$row[0]['fwd_install_to_repair']; 
		}
	?></td>
        </tr>
        <tr>
          <td>Reply Comment:</td>
          <td><? if(($row[0]['fwd_tech_rm_id'] != "" || $row[0]['fwd_repair_id'] == "") && $row[0]["fwd_repair_to_install"] != ""){
			 echo $row[0]['fwd_done_time'].' - '.$row[0]["fwd_repair_to_install"];
		} else {
			echo $row[0]["fwd_repair_to_install"];
		}
	 ?></td>
        </tr>
        <tr>
          <td><strong>Process Pending </strong></td>
          <td><strong>
            <? if($row[0]["installation_status"]==7 && ($row[0]["admin_comment"]!="" || $row[0]["sales_comment"]=="")){echo "Reply Pending at Request Side";}
    elseif($row[0]["installation_status"]==7 && $row[0]["admin_comment"]=="" ){echo "Pending Saleslogin for Information";}
    elseif($row[0]["approve_status"]==0 && $row[0]["installation_status"]==8 ){echo "Pending Admin Approval";}
    elseif($row[0]["installation_status"]==9 && $row[0]["approve_status"]==1 ){echo "Pending Confirmation at Request Person";}
    elseif($row[0]["installation_status"]==1 ){echo "Pending Dispatch Team";}
    elseif($row[0]["installation_status"]==2 ){echo "Assign To Installer";}
    elseif($row[0]["installation_status"]==11 ){echo "Request Forward to ".$forward_name;}
    elseif($row[0]["installation_status"]==3 ){echo "Back Installation";}
    elseif($row[0]["installation_status"]==15 ){echo "Pending Remaining Installation";}
    elseif($row[0]["installation_status"]==5 || $row[0]["installation_status"]==6){echo "Installation Close";}?>
            </strong></td>
        </tr>
      </tbody>
    </table>
  </div>
</div>
<? }
      
 
    else If($tablename=="discount_details")
		{
		  $query = "SELECT * FROM ".$tablename." where id=".$RowId; 
			$row=select_query($query);
            
	?>
<div id="databox">
  <div class="heading">Discount</div>
  <div class="dataleft">
    <table cellspacing="2" cellpadding="2">
      <tbody>
        <tr>
          <td>Date </td>
          <td><?echo $row[0]["date"];?></td>
        </tr>
        <? /*if($row[0]["acc_manager"]=='saleslogin') {
$account_manager=$row[0]["sales_manager"]; 
}
else {
$account_manager=$row[0]["acc_manager"]; 
}*/

?>
        <tr>
          <td>Request By</td>
          <td><?echo $row[0]["acc_manager"];?></td>
        </tr>
        <tr>
          <td>Account Manager</td>
          <td><?echo $row[0]["sales_manager"];?></td>
        </tr>
        <? $sql="SELECT Userid AS id,UserName AS sys_username FROM addclient  WHERE Userid=".$row[0]["user"];
	$rowuser=select_query($sql);
	?>
        <tr>
          <td>Client User Name </td>
          <td><?echo $rowuser[0]["sys_username"];?></td>
        </tr>
        <tr>
          <td>Company Name </td>
          <td><?echo $row[0]["client"];?></td>
        </tr>
        <!--<tr><td>Vehicle	for discount</td><td><?echo $row[0]["reg_no"];?></td></tr>-->
        <tr>
          <td>Vehicle	for discount </td>
          <td><?php $vechile_no = explode(",",$row[0]["reg_no"]); 
for($i=0;$i<=count($vechile_no);$i++){ if($i%3!=0){ echo $vechile_no[$i].", ";}else { echo "<br/>".$vechile_no[$i].", ";} }?></td>
        </tr>
        <tr>
          <td>Discount For</td>
          <td><?echo $row[0]["rent_device"];?></td>
        </tr>
        <tr>
          <td>Month</td>
          <td><?echo $row[0]["mon_of_dis_in_case_of_rent"];?></td>
        </tr>
        <tr>
          <td>Discount Amount </td>
          <td><?echo $row[0]["dis_amt"];?></td>
        </tr>
        <tr>
          <td>After Discount </td>
          <td><?echo $row[0]["amt_rec_after_dis"];?></td>
        </tr>
        <tr>
          <td>Before Discount </td>
          <td><?echo $row[0]["amt_before_dis"];?></td>
        </tr>
        <tr>
          <td>Reason </td>
          <td><?echo $row[0]["reason"];?></td>
        </tr>
        <tr>
          <td>Issue for Discountng</td>
          <td><?echo $row[0]["discount_issue"];?></td>
        </tr>
      </tbody>
    </table>
  </div>
  <div class="dataright">
    <table cellspacing="2" cellpadding="2">
      <tbody>
        <!--<tr><td>Admin Approval</td>  <td><?if($row[0]["approve_status"]==1) echo "Approved"; else echo "Pending Approval"?></td></tr>-->
        <tr>
          <td><strong>Process Pending </strong></td>
          <td><strong>
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
	elseif($row[0]["final_status"]==1){echo "Process Done";}?>
            </strong></td>
        </tr>
        <tr>
          <td>Account Comment</td>
          <td><?echo $row[0]["account_comment"];?></td>
        </tr>
        <tr>
          <td>Payment Pending</td>
          <td><?echo $row[0]["total_pending"];?></td>
        </tr>
        <tr>
          <td>Sales Comment</td>
          <td><?echo $row[0]["sales_comment"];?></td>
        </tr>
        <tr>
          <td>Service Comment</td>
          <td><?echo $row[0]["service_comment"];?></td>
        </tr>
        <tr>
          <td>Software Comment</td>
          <td><?echo $row[0]["software_comment"];?></td>
        </tr>
        <tr>
          <td>Repair Comment</td>
          <td><?echo $row[0]["repair_comment"];?></td>
        </tr>
        <tr>
          <td>Admin Comment</td>
          <td><?echo $row[0]["admin_comment"];?></td>
        </tr>
        <tr>
          <td>Closed Date</td>
          <td><?
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
      </tbody>
    </table>
  </div>
</div>
<?
	}
	}
?>
