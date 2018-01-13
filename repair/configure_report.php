<?php
session_start();
include("../connection.php");
include_once(__DOCUMENT_ROOT.'/include/header.php');
include_once(__DOCUMENT_ROOT.'/include/leftmenu_repair.php');
//include_once(__DOCUMENT_ROOT.'/sqlconnection.php');


//$FromDate = date('Y-m-d');
//$ToDate = date("Y-m-d");

$ConfigureQuery = select_query_inventory("SELECT itgc_id,device_id,recd_date, device_sno, item_master.item_name, 
									item_master.parent_id, device.device_status, TIMESTAMPDIFF(DAY,recd_date,NOW()) as PendingDays from 
									inventory.device LEFT JOIN inventory.item_master on device.device_type = item_master.item_id        
									WHERE sim_id=0 and itgc_id is not null and device_imei='' and (device.device_status in(20,21,65))   
									AND device.active_status=1 order by PendingDays desc ");


if($_POST["submit"])
{
		
	$FromDate = $_POST["FromDate"];
	$ToDate = $_POST["ToDate"];
	
	$ConfigureQuery = select_query_inventory("SELECT device.itgc_id, device.device_id, device.recd_date, 
									  device.device_sno, item_master.item_name, item_master.parent_id, device.device_status, 
									  devicehistorydate.configuredate, devicehistorydate.attach_sim_date, devicehistorydate.testedDate from 
									  device LEFT JOIN item_master on device.device_type = item_master.item_id LEFT JOIN devicehistorydate
									  on device.device_id=devicehistorydate.device_id WHERE itgc_id is not null AND device.active_status=1 
									  and devicehistorydate.configuredate>='".$FromDate." 00:00:00'
									  and devicehistorydate.configuredate<='".$ToDate." 23:59:59'
									  order by devicehistorydate.configuredate desc");
	
 //echo "<pre>";print_r($ConfigureQuery);die;
 
}

//echo "<pre>";print_r($ConfigureQuery);die;
 
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
  
  <h1>Configure Device Report</h1>
  
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
        <th><font color="#0E2C3C"><b>Sr No.</b></font></th>
        <th><font color="#0E2C3C"><b>Recd Date</b></font></th>
        <th><font color="#0E2C3C"><b>Device Type</b></font></th>
        <th><font color="#0E2C3C"><b>ITGC ID</b></font></th>
        <th><font color="#0E2C3C"><b>IMEI</b></font></th>
        <th><font color="#0E2C3C"><b>Configure Date</b></font></th>
        <th><font color="#0E2C3C"><b>Test Sim Date</b></font></th>
        <th><font color="#0E2C3C"><b>Attach Sim Date</b></font></th>
        <th><font color="#0E2C3C"><b>PendingDays</b></font></th>
      </tr>
    </thead>
    <tbody>
    <?php 
	
	for($i=0;$i<count($ConfigureQuery);$i++) 
	{
	
    ?>
      <tr align="Center">
        <td>&nbsp;<?php echo $i+1;?></td>
        <td>&nbsp;<?php echo $ConfigureQuery[$i]['recd_date'];?></td>
        <td>&nbsp;<?php echo $ConfigureQuery[$i]['item_name'];?></td>
        <td>&nbsp;<?php echo $ConfigureQuery[$i]['itgc_id'];?></td>
        <td>&nbsp;<?php echo $ConfigureQuery[$i]['device_sno'];?></td>
        <td>&nbsp;<?php echo $ConfigureQuery[$i]['configuredate'];?></td>
        <td>&nbsp;<?php echo $ConfigureQuery[$i]['testedDate'];?></td>
        <td>&nbsp;<?php echo $ConfigureQuery[$i]['attach_sim_date'];?></td>
        <td>&nbsp;<?php echo $ConfigureQuery[$i]['PendingDays'];?></td>
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
