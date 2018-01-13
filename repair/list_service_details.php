<?php 
session_start();
include("../connection.php");
include_once(__DOCUMENT_ROOT.'/include/header.php');
include_once(__DOCUMENT_ROOT.'/include/leftmenu_repair.php');
include_once(__DOCUMENT_ROOT.'/sqlconnection.php');


$from_date = date('Y-m-d', strtotime('-1 month'));
$to_date = date("Y-m-d", strtotime('-25 day'));

$rslt_data = select_query("select services.date_of_installation, services.device_imei, services.company_name, addclient.UserName,
						   services.inst_name, services.inst_date as visit_date, services.reason as visit_reason, services.close_date 
						   from services left join addclient on services.user_id=addclient.Userid where 
						   services.atime>='".$from_date." 00:00:00"."' and services.atime<='".$to_date." 23:59:59". "' 
						   and services.service_status='5' and services.device_imei is not null ");

//echo "<pre>";print_r($query_service);die;

if(isset($_POST["submit"]))
{
 	$fromdate = $_POST["FromDate"];
	$todate = $_POST["ToDate"];
	$process_type = $_POST["process_type"];
	
	//echo "<pre>";print_r($_POST);die;
	
	if($process_type == "Device")
	{
		$rslt_data = select_query("select services.date_of_installation, services.device_imei, services.company_name, addclient.UserName, 
						   services.inst_name, count(*) as total_count 
						   from services left join addclient on services.user_id=addclient.Userid where 
						   services.atime>='".$fromdate." 00:00:00"."' and services.atime<='".$todate." 23:59:59". "' 
						   and services.service_status='5' and services.device_imei!='' group by services.device_imei");
	}
	else if($process_type == "Installer")
	{
		$rslt_data = select_query("select services.inst_name, count(*) as total_count 
						   from services where services.atime>='".$fromdate." 00:00:00"."' and services.atime<='".$todate." 23:59:59". "' 
						   and services.service_status='5' and services.device_imei!='' group by services.inst_name");
	}
	else if($process_type == "Client")
	{
		$rslt_data = select_query("select services.company_name, addclient.UserName, count(*) as total_count
						   from services left join addclient on services.user_id=addclient.Userid where 
						   services.atime>='".$fromdate." 00:00:00"."' and services.atime<='".$todate." 23:59:59". "' 
						   and services.service_status='5' and services.device_imei!='' group by addclient.UserName");
	}
	else
	{
	
		$rslt_data = select_query("select services.date_of_installation, services.device_imei, services.company_name, addclient.UserName,
						   services.inst_name, services.inst_date as visit_date, services.reason as visit_reason, services.close_date 
						   from services left join addclient on services.user_id=addclient.Userid where 
						   services.atime>='".$fromdate." 00:00:00"."' and services.atime<='".$todate." 23:59:59". "' 
						   and services.service_status='5' and services.device_imei is not null");
	}
	
	//echo "<pre>";print_r($rslt_data);die;
	
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

/*
var Path="http://localhost/service/";
//var Path="http://trackingexperts.com/service/";
function DetailClient(value)
{
	var rootdomain="http://"+window.location.hostname
	var loadstatustext="<img src='"+rootdomain+"/images/icons/other/waiting.gif' />"
	document.getElementById("DetailClient").innerHTML=loadstatustext; 
$.ajax({
		type:"GET",
		url:Path +"userInfo.php?action=DetailClient",
		//data:"category="+category+"&expairy="+expairy1+"&duration="+durationlist+"&sortby="+sortby+"&price="+price+"&search="+search1,
		 data:"RowId="+value,
		success:function(msg){
			 
		document.getElementById("DetailClient").innerHTML = msg;
						
		}
	});
}*/
</script>

<style type="text/css" >
.errorMsg{border:1px solid red; }
.message{color: red; font-weight:bold; }
</style>

<div class="top-bar">
    
    <h1>Service Details: </h1>
    
<?php echo "<p align='left' style='padding-left: 250px;width: 500px;' class='message'>" .$errorMsg. "</p>" ; ?>

</div>



<div class="top-bar">
<form name="myForm" action=""   method="post">

<table cellspacing="5" cellpadding="5">
	<tr>
        <td >From Date</td>
        <td><input type="text" name="FromDate" id="FromDate" value="<? echo $from_date;?>"/></td>
        
        <td>To Date</td>
        <td><input type="text" name="ToDate" id="ToDate"  value="<? echo $to_date;?>" /></td>
        
        <td>
        	<select name="process_type" id="process_type">
            	<option value="">select Type</option>
                <option value="Device" <? if($_POST["process_type"]=='Device') {?> selected="selected" <? } ?>>Device</option>
                <option value="Installer" <? if($_POST["process_type"]=='Installer') {?> selected="selected" <? } ?>>Installer</option>
                <option value="Client" <? if($_POST["process_type"]=='Client') {?> selected="selected" <? } ?>>Client</option>
            </select>
        </td>
        
        <td align="center"> <input type="submit" name="submit" value="submit" onClick="return req_validate(myForm)" /></td>
        
	</tr>
</table>
</form>
</div>
<!--<div style="float:right";><a href="reportfiles/service_installation_excel.xls">Create Excel</a><br/></div>-->
<div class="table">
   
<table cellpadding="0" cellspacing="0" border="0" class="display" id="example">
	<thead>
     <?php if($_POST["process_type"] == "Device"){?>
		<tr>
            <th><font color="#0E2C3C"><b>Installation Date</b></font></th>
            <th><font color="#0E2C3C"><b>Device Name</b></font></th>
            <th><font color="#0E2C3C"><b>Device IMEI </b></font></th>
            <th><font color="#0E2C3C"><b>Client Name</b></font></th>
            <th><font color="#0E2C3C"><b>Installer Name</b></font></th>
            <th><font color="#0E2C3C"><b>Service Count</b></font></th>
		</tr>
        
      <?php } else if($_POST["process_type"] == "Installer"){?>
		<tr>
            <th><font color="#0E2C3C"><b>Installer Name</b></font></th>
            <th><font color="#0E2C3C"><b>Service Count</b></font></th>
		</tr>
     
     <?php } else if($_POST["process_type"] == "Client"){?>
		<tr>
            <th><font color="#0E2C3C"><b>Client Name</b></font></th>
            <th><font color="#0E2C3C"><b>Service Count</b></font></th>
		</tr>
        
      <? } else { ?>
      
		<tr>
            <th><font color="#0E2C3C"><b>Installation Date</b></font></th>
            <th><font color="#0E2C3C"><b>Device Name</b></font></th>
            <th><font color="#0E2C3C"><b>Device IMEI </b></font></th>
            <th><font color="#0E2C3C"><b>Client Name</b></font></th>
            <th><font color="#0E2C3C"><b>Visit Date</b></font></th>
            <th><font color="#0E2C3C"><b>Installer Name</b></font></th>
            <th><font color="#0E2C3C"><b>Close Reason</b></font> </th>
            <th><font color="#0E2C3C"><b>Close Date</b></font> </th>
            <!--<th><font color="#0E2C3C"><b>R&amp;D Repair</b></font></th>
            <th><font color="#0E2C3C"><b>Manufacture</b></font></th>
            <th><font color="#0E2C3C"><b>Resolution TAT</b></font></th>-->
            <!--<th><font color="#0E2C3C"><b>Area</b></font></th>-->
            <th><font color="#0E2C3C"><b>View Detail</b></font></th>
		</tr>
      
      <? } ?>
      
	</thead>
	<tbody>
   
	<?php 
	/*$excel_data.='<table cellpadding="5" cellspacing="5" border="1"><thead><tr><td colspan="12" align="center"><strong>Service And Installation Report</strong></td></tr><tr><td colspan="12"></td></tr><tr><th width="5%">S/I</th><th width="7%">Request By </th><th width="10%">Company Name </th><th width="8%">Vehicle Number </th><th width="8%">IMEI / Done</th><th width="8%">Notworking / Make </th><th width="8%">Request Date </th><th width="8%">Available Time</th><th width="10%">Installer</th><th width="8%">Close date</th><th width="10%">Reason</th><th width="10%">Area</th></tr></thead><tbody>';*/
	
	for($i=0;$i<count($rslt_data);$i++)
	{
		 if($rslt_data[$i]['company_name'] == ''){ $company_name = $rslt_data[$i]['UserName'];}
		 else{ $company_name = $rslt_data[$i]['company_name'];}
		 
		 $device_model_query = mssql_query("select device.device_imei, item_master.item_name from device left join item_master
		 					   on device.device_type=item_master.item_id where device.device_imei='".trim($rslt_data[$i]['device_imei'])."'");
		 
		  while($row_device_model = mssql_fetch_array($device_model_query))
		  {
			  $device_name = $row_device_model['item_name'];
			  
		  }
    ?>  
 
 <?php if($_POST["process_type"] == "Device"){?>
 
	<tr align="Center" > 		
        <td><?php echo $rslt_data[$i]['date_of_installation'];?></td>
        <td><?php echo $device_name;?></td>
        <td><?php echo $rslt_data[$i]['device_imei'];?></td> 
        <td><?php echo $company_name;?></td>
        <td><?php echo $rslt_data[$i]['inst_name'];?></td>
        <td><?php echo $rslt_data[$i]['total_count'];?></td>
           
	</tr>
   
   <?php } else if($_POST["process_type"] == "Installer"){?>
 
	<tr align="Center" > 		
        <td><?php echo $rslt_data[$i]['inst_name'];?></td>
        <td><?php echo $rslt_data[$i]['total_count'];?></td>
           
	</tr>
    
    <?php } else if($_POST["process_type"] == "Client"){?>
 
	<tr align="Center" > 		
        <td><?php echo $company_name;?></td>
        <td><?php echo $rslt_data[$i]['total_count'];?></td>
           
	</tr>
    
    <? } else { ?>
    
	<tr align="Center" > 		
        <td><?php echo $rslt_data[$i]['date_of_installation'];?></td>
        <td><?php echo $device_name;?></td>
        <td><?php echo $rslt_data[$i]['device_imei'];?></td> 
        <td><?php echo $company_name;?></td>
        <td><?php echo $rslt_data[$i]['visit_date'];?></td>
        <td><?php echo $rslt_data[$i]['inst_name'];?></td>
		<td><?php echo $rslt_data[$i]['visit_reason'];?></td>
        <td><?php echo $rslt_data[$i]['close_date'];?></td>
        <!--<td><?php echo '';?></td>
        <td><?php echo '';?></td>
        <td><?php echo $rslt_data[$i]['reason'];?></td>-->
        <!--<td><?php echo $rslt_data[$i]['zonearea'];?></td>-->
        <td><a href="#" onclick="Show_record(<?php echo $rslt_data[$i]["id"];?>,'<? echo $tablename ?>','popup1'); " class="topopup">View Detail</a></td>
           
	</tr>

     <? } ?>
    
	<?php 
	
	/*$excel_data.="<tr><td width='5%'>".$rslt_data[$i]['service_inst']."</td><td width='7%'>".$rslt_data[$i]['request_by']."</td><td width='10%'>".$company."</td><td width='8%'>".$rslt_data[$i]['veh_reg']."</td><td width='8%'>". $rslt_data[$i]['imei_done']."</td><td width='8%'>".$rslt_data[$i]['notwoking_make']."</td><td width='8%'>".$rslt_data[$i]['req_date']."</td><td width='8%'>".$rslt_data[$i]['available_time']."</td><td width='10%'>".$rslt_data[$i]['inst_name']."</td><td width='8%'>".$rslt_data[$i]['close_date']."</td><td width='10%'>".$rslt_data[$i]['reason']."</td><td width='10%'>".$rslt_data[$i]['zonearea']."</td></tr>";*/
	 
	}
	
    /*$excel_data.='</tbody></table>';*/
	
    ?>
    </tbody>
</table>
     
   <div id="toPopup"> 
    	
        <div class="close">close</div>
       	<span class="ecs_tooltip">Press Esc to close <span class="arrow"></span></span>
		<div id="popup1" style ="height:100%;width:100%"> <!--your content start-->
            

 
        </div> <!--your content end-->
    
    </div> <!--toPopup end-->
    
	<div class="loader"></div>
   	<div id="backgroundPopup"></div>
</div>
 
 
 
<?
/*unlink(__DOCUMENT_ROOT.'/support/reportfiles/service_installation_excel.xls');
$filepointer=fopen(__DOCUMENT_ROOT.'/support/reportfiles/service_installation_excel.xls','w');
fwrite($filepointer,$excel_data);
fclose($filepointer);*/

include("../include/footer.php");

?>

 