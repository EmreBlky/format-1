<?php 
include("../connection.php");
include_once(__DOCUMENT_ROOT.'/include/header.php');
include_once(__DOCUMENT_ROOT.'/include/leftmenu_support.php');

/*include($_SERVER['DOCUMENT_ROOT']."/format/include/header.php");
include($_SERVER['DOCUMENT_ROOT']."/format/include/leftmenu_support.php");*/

if($_SESSION['user_name']=="ankur"){
	$branch='branch_id IN (2,3,7) or inter_branch IN (2,3,7)';	
}
else if($_SESSION['user_name']=="rakhi"){
	$branch='branch_id IN (1) or inter_branch IN (1)';
}
else if($_SESSION['user_name']=="amit"){
	$branch='branch_id IN (6) or inter_branch IN (6)';
}
else{
	$branch='branch_id IN (1) or inter_branch IN (1)';
}

$tablename="";
 if($_POST["submit"])
 {
	 if($_POST["job"]=="Installation")
	 {
	 	$tablename="installation";
		if($_POST["mode"]=="Close")
	 	{
			$query = select_query("select installation.id,req_date,request_by,company_name,inst_id,inst_name,rtime,re_city_spr_1.name as zonearea from installation
left join re_city_spr_1   on installation.Zone_area = re_city_spr_1.id where req_date>='". $_POST["FromDate"]." 00:00:00"."' and req_date<='".$_POST["ToDate"]." 23:59:59"."' and (installation_status=5 or installation_status=6) and ($branch)");
		}
		else if($_POST["mode"]=="Back")
	 	{
			$query = select_query("select installation.id,req_date,request_by,company_name,inst_id,inst_name,rtime,re_city_spr_1.name as zonearea from installation
left join re_city_spr_1   on installation.Zone_area = re_city_spr_1.id where req_date>='". $_POST["FromDate"]." 00:00:00"."' and req_date<='".$_POST["ToDate"]." 23:59:59"."' and (installation_status=3 and installation_status=4) and ($branch)");
		}
		else
		{
			$query = select_query("select installation.id,req_date,request_by,company_name,inst_id,inst_name,rtime,re_city_spr_1.name as zonearea from installation
left join re_city_spr_1   on installation.Zone_area = re_city_spr_1.id where req_date>='". $_POST["FromDate"]." 00:00:00"."' and req_date<='".$_POST["ToDate"]." 23:59:59"."' and (installation_status!=5 and installation_status!=6) and ($branch)");
		}
 	 }
	 else
	 {
		$tablename="services";
 		if($_POST["mode"]=="Close")
	 	{
			$query = select_query("select services.id,req_date,request_by, company_name,inst_id,inst_name,close_date, veh_reg,device_imei,reason,date_of_installation, re_city_spr_1.name as zonearea from services
left join re_city_spr_1   on services.Zone_area = re_city_spr_1.id  where req_date>='". $_POST["FromDate"]." 00:00:00"."' and req_date<='" . $_POST["ToDate"]. " 23:59:59". "' and (service_status=5 or service_status=6) and ($branch)");
		}
		else if($_POST["mode"]=="Back")
	 	{
			$query = select_query("select services.id,req_date,request_by, company_name,inst_id,inst_name, close_date,veh_reg,device_imei, reason,date_of_installation, re_city_spr_1.name as zonearea from services
left join re_city_spr_1   on services.Zone_area = re_city_spr_1.id  where req_date>='". $_POST["FromDate"]." 00:00:00"."' and req_date<='" . $_POST["ToDate"]. " 23:59:59". "' and (service_status=3 and service_status=4) and ($branch)");
		}
		else
		{
			$query = select_query("select services.id,req_date,request_by, company_name,inst_id,inst_name,close_date, veh_reg,device_imei,reason,date_of_installation, re_city_spr_1.name as zonearea from services
left join re_city_spr_1   on services.Zone_area = re_city_spr_1.id  where req_date>='". $_POST["FromDate"]." 00:00:00"."' and req_date<='" . $_POST["ToDate"]. " 23:59:59". "' and (service_status!=5 and service_status!=6) and ($branch)");
 
		}
	 }
  
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

</script>

<div class="top-bar">
  <h1>Service & Installation Details</h1>
</div>
<div class="top-bar">
  <form name="myForm" action=""   method="post">
    <table cellspacing="5" cellpadding="5">
      <tr>
        <td >From Date</td>
        <td><input type="text" name="FromDate" id="FromDate" value="<?echo  $_POST["FromDate"]?>"/></td>
        <td>To Date</td>
        <td><input type="text" name="ToDate" id="ToDate"  value="<?echo  $_POST["ToDate"]?>" /></td>
        <td><input type="radio" name="job" id="Service" value="Service" <? if($_POST["job"]=="Service") echo "checked"?>/>
          Service
          <input type="radio" name="job" id="Installation" value="Installation" <? if($_POST["job"]=="Installation") echo "checked"?>/>
          Installation </td>
        <td><input type="radio" name="mode" id="New" value="New" <? if($_POST["mode"]=="New") echo "checked"?>/>
          New
          <input type="radio" name="mode" id="Back" value="Back" <? if($_POST["mode"]=="Back") echo "checked"?>/>
          Back
          <input type="radio" name="mode" id="Close" value="Close" <? if($_POST["mode"]=="Close") echo "checked"?>/>
          close </td>
        <td align="center"><input type="submit" name="submit" value="submit"  /></td>
      </tr>
    </table>
  </form>
</div>
<div class="table">
  <table cellpadding="0" cellspacing="0" border="0" class="display" id="example">
    <thead>
      <tr>
        <th>Sl. No</th>
        <th>Request By </th>
        <th>Request Date </th>
        <th width="10%" align="center"><font color="#0E2C3C"><b>Company Name </b></font></th>
        <th width="10%" align="center"><font color="#0E2C3C"><b>Vehicle Number </b></font></th>
        <th width="10%" align="center"><font color="#0E2C3C"><b>Device IMEI </b></font></th>
        <th width="10%" align="center"><font color="#0E2C3C"><b>Installer</b></font></th>
        <th width="10%" align="center"><font color="#0E2C3C"><b>Area</b></font></th>
        <?    if($_POST["job"]=="Service"){ ?>
        <th width="10%" align="center"><font color="#0E2C3C"><b>Reason</b></font></th>
        <? } ?>
        <th width="9%" align="center"><font color="#0E2C3C"><b>Close date</b></font></th>
        <th>View Detail</th>
      </tr>
    </thead>
    <tbody>
      <?php 
	 
  // while($row=mysql_fetch_array($query))
  for($i=0;$i<count($query);$i++)
  {
	 
	
    ?>
      
      <!-- <tr align="Center" <? if(($query[$i]['reason'] && $query[$i]['time']) ||  $query[$i]['back_reason']) { ?> style="background:#CCCCCC" <? }?>> -->
      <tr align="Center" >
        <td><?php echo $i+1; ?></td>
        <td>&nbsp;<?php echo $query[$i]['request_by'];?></td>
        <td>&nbsp;<?php echo $query[$i]['req_date'];?></td>
        <td><?php echo $query[$i]['company_name'];?></td>
        <td>&nbsp;<?php echo $query[$i]['veh_reg'];?></td>
        <td>&nbsp;<?php echo $query[$i]['device_imei'];?></td>
        <td>&nbsp;<?php echo $query[$i]['inst_name'];?></td>
        <td width="10%" align="center">&nbsp;<?php echo $query[$i]['zonearea'];?></td>
        <?    if($_POST["job"]=="Service"){ ?>
        <td>&nbsp;<?php echo $query[$i]['reason'];?></td>
        <? } ?>
        <?  if($_POST["job"]=="Installation"){ 
		 $close_date=$query[$i]['rtime'];
		 }
		 else {
		 $close_date=$query[$i]['close_date'];
		 }
		 ?>
        <td width="9%" align="center">&nbsp;<?php echo $close_date;?></td>
        <td><a href="#" onclick="Show_record(<?php echo $query[$i]["id"];?>,'<?echo $tablename ?>','popup1'); " class="topopup">View Detail</a></td>
      </tr>
      <?php  
       }
	 
    ?>
  </table>
  <div id="toPopup">
    <div class="close">close</div>
    <span class="ecs_tooltip">Press Esc to close <span class="arrow"></span></span>
    <div id="popup1" style ="height:100%;width:100%"> <!--your content start--> 
      
    </div>
    <!--your content end--> 
    
  </div>
  <!--toPopup end-->
  
  <div class="loader"></div>
  <div id="backgroundPopup"></div>
</div>
<?
include("../include/footer.inc.php");

?>
