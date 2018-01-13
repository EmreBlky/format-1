<?php
session_start();
include("../connection.php");
include_once(__DOCUMENT_ROOT.'/include/header.php');
include_once(__DOCUMENT_ROOT.'/include/leftmenu_repair.php');
//include_once(__DOCUMENT_ROOT.'/sqlconnection.php');


$FromDate = date('Y-m-d');
$ToDate = date("Y-m-d");


$RepairQuery = select_query_inventory("select device_status.status, device_repair.client_name, device_repair.device_id, device_repair.device_imei, 
					device_repair.veh_no, device_repair.opencase_date, device_repair.closecase_date, device_repair.device_removed_problem, 
					device_repair.ManufactureRemarks, device_repair.problem as opencaseproblem, device_repair.actual_problem as closecaseproblem 
					from inventory.device_repair inner join inventory.device_status on device_status.status_sno=device_repair.device_status  
					where closecase_date >= '".$FromDate." 00:00:00.000' and closecase_date <= '".$ToDate." 23:59:59.000' ");


if($_POST["submit"])
{
		
	$FromDate = $_POST["FromDate"];
	$ToDate = $_POST["ToDate"];
	
	$RepairQuery = select_query_inventory("select device_status.status, device_repair.client_name, device_repair.device_id, 
					device_repair.device_imei, device_repair.veh_no, device_repair.opencase_date, 
					device_repair.closecase_date, device_repair.device_removed_problem, device_repair.ManufactureRemarks, 
					device_repair.problem as opencaseproblem, device_repair.actual_problem as closecaseproblem 
					from inventory.device_repair inner join inventory.device_status on device_status.status_sno=device_repair.device_status  
					where closecase_date >= '".$FromDate." 00:00:00.000' and closecase_date <= '".$ToDate." 23:59:59.000' ");
	
 //echo "<pre>";print_r($RepairQuery);die;
 
}

 
?>

<link rel="stylesheet" href="http://code.jquery.com/ui/1.10.3/themes/smoothness/jquery-ui.css" />
<script src="http://code.jquery.com/jquery-1.9.1.js"></script>
<script src="http://code.jquery.com/ui/1.10.3/jquery-ui.js"></script>
<script>
var j = jQuery.noConflict();
j(function() 
{
j( "#FromDate" ).datepicker({ dateFormat: "yy-mm-dd" });

j( "#ToDate" ).datepicker({ dateFormat: "yy-mm-dd" });

});

function req_validate(myForm)
{
	   if(document.myForm.FromDate.value ==""){
		   alert("Please Enter From Date");
		   document.myForm.FromDate.focus();
		   return false;
	   }
	   
	   if(document.myForm.ToDate.value ==""){
		   alert("Please Enter To Date");
		   document.myForm.ToDate.focus();
		   return false;
	   }
	   
	   /*if(document.myForm.process_type.value ==""){
		   alert("Please Select Process Type");
		   document.myForm.process_type.focus();
		   return false;
	   }*/
}

</script>

<style type="text/css" >
.errorMsg{border:1px solid red; }
.message{color: red; font-weight:bold; }
</style>

<div class="top-bar">
  
  <h1>Repair Close RD Device</h1>
  
</div>
<!--<div class="top-bar">
  <div style="float:right";><font style="color:#F6F;font-weight:bold;">Purple:</font> Open Device</div>
  <br/>
  <div style="float:right";><font style="color:#CCCCCC;font-weight:bold;">Grey:</font> Closed Case</div>
  <br/>
  <div style="float:right";><font style="color:red;font-weight:bold;">Red:</font> Dead device </div>
</div>-->

<div class="top-bar">
<form name="myForm" action=""   method="post">

<table cellspacing="5" cellpadding="5">
	<tr>
        <td >From Date</td>
        <td><input type="text" name="FromDate" id="FromDate" value="<? echo $FromDate;?>"/></td>
        
        <td>To Date</td>
        <td><input type="text" name="ToDate" id="ToDate"  value="<? echo $ToDate;?>" /></td>
                
        <td align="center"> <input type="submit" name="submit" value="submit" onClick="return req_validate(myForm)" /></td>
        
	</tr>
</table>
</form>
</div>

<div class="table">  
  
  <table cellpadding="0" cellspacing="0" border="0" class="display" id="example">
    <thead>
      <tr>
        <th><font color="#0E2C3C"><b>Device Id</b></font></th>
        <th><font color="#0E2C3C"><b>Device Imei</b></font></th>
        <th><font color="#0E2C3C"><b>Client Name </b></font></th>
        <th><font color="#0E2C3C"><b>Vehicle No</b></font></th>
        <th><font color="#0E2C3C"><b>Open Date</b></font></th>
        <th><font color="#0E2C3C"><b>Close date</b></font></th>
        <th><font color="#0E2C3C"><b>Open Reason</b></font></th>
        <th><font color="#0E2C3C"><b>Close Reason</b></font></th>
        <th><font color="#0E2C3C"><b>Status</b></font></th>
        <th><font color="#0E2C3C"><b>Device Removed Reason</b></font></th>
        <th><font color="#0E2C3C"><b>Manufacture Remarks</b></font></th>
      </tr>
    </thead>
    <tbody>
    <?php 
	
	for($i=0;$i<count($RepairQuery);$i++) 
	{
	
    ?>
      <tr align="Center">
        <td>&nbsp;<?php echo $RepairQuery[$i]['device_id'];?></td>
        <td>&nbsp;<?php echo $RepairQuery[$i]['device_imei'];?></td>
        <td>&nbsp;<?php echo $RepairQuery[$i]['client_name'];?></td>
        <td>&nbsp;<?php echo $RepairQuery[$i]['veh_no'];?></td>
        <td>&nbsp;<?php echo $RepairQuery[$i]['opencase_date'];?></td>
        <td>&nbsp;<?php echo $RepairQuery[$i]['closecase_date'];?></td>
        <td>&nbsp;<?php echo $RepairQuery[$i]['opencaseproblem'];?></td>
        <td>&nbsp;<?php echo $RepairQuery[$i]['closecaseproblem'] ?></td>
        <td>&nbsp;<?php echo $RepairQuery[$i]['status'] ?></td>
        <td>&nbsp;<?php echo $RepairQuery[$i]['device_removed_problem'] ?></td>
        <td>&nbsp;<?php echo $RepairQuery[$i]['ManufactureRemarks'] ;?></td>
      </tr>
<?php  
    
	}
	 
?>
  </table>
  <div id="toPopup">
    <div class="close">close</div>
    <span class="ecs_tooltip">Press Esc to close <span class="arrow"></span></span>
    <div id="popup1" style ="height:100%;width:100%"> </div>
  </div>
  <div class="loader"></div>
  <div id="backgroundPopup"></div>
</div>
<?

include("../include/footer.php");

?>
