<?php
include("../connection.php");
include_once(__DOCUMENT_ROOT.'/include/header.php');
include_once(__DOCUMENT_ROOT.'/include/leftmenu_admin.php');


?>
<div class="top-bar">
  <div align="center">
    <form name="myformlisting" method="post" action="">
      <select name="Showrequest" id="Showrequest" onchange="form.submit();" >
        <option value="0" <? if($_POST['Showrequest']==0){ echo 'Selected'; }?>>Select</option>
        <!--<option value=3 <?if($_POST['Showrequest']==3){ echo "Selected"; }?>>Admin Approved</option>-->
        <option value="" <?if($_POST['Showrequest']==''){ echo "Selected"; }?>>Pending</option>
       <!-- <option value="1" <?if($_POST['Showrequest']==1){ echo "Selected"; }?>>Closed</option>
        <option value="4" <?if($_POST['Showrequest']==4){ echo "Selected"; }?>>Action Taken</option>
        <option value="2" <?if($_POST['Showrequest']==2){ echo "Selected" ;}?>>All</option>-->
      </select>
    </form>
  </div>
	 
     <a href="debtor_summmary_report.php" class="button">Debtor Summary </a> 
     
  <h1>Client Debtors</h1>
</div>
<!--<div class="top-bar">
  <div style="float:right";><font style="color:#B6B6B4;font-weight:bold;">Grey:</font>Admin Approved</div>
  <br/>
  <div style="float:right";><font style="color:#D462FF;font-weight:bold;">Purple:</font> Back from support</div>
  <br/>
  <div style="float:right";><font style="color:#FF0000;font-weight:bold;">Red:</font> Back from Admin</div>
  <br/>
  <div style="float:right";><font style="color:#8BFF61;font-weight:bold;">Green:</font> Completed your requsest.</div>
</div>-->
<div class="table">
  <?php

$query = select_query("select dpb.id,dpb.client_id,dpb.company_name, sp.name as sales_manager,
					 dpb.sales_manager as manager,dpb.collection_agent as agent, 
					 ca.name as collection_agent, dpb.month, dpb.year, dpb.device_amount_pending,
					 dpb.rent_amount_pending, dpb.accessory_amount_pending, dpb.req_time
					 from debtor_pending_billing as dpb left join sales_person as sp
					 on dpb.sales_manager=sp.id left join collection_agent as ca
					 on dpb.collection_agent=ca.id where dpb.month='".date("m",strtotime('-1 months'))."' and dpb.year='".date("Y")."'");
					 
?>
  <table cellpadding="0" cellspacing="0" border="0" class="display" id="example">
    <thead>
      <tr>
        <th>SL.No</th>
        <th>Request Date</th>
        <th>Account Manager</th>
        <th>Collection Agent</th>
        <th>Company Name</th>
        <th>Device Pending</th>
        <th>Rent Pending</th>
        <th>Accessory pending</th>
        <th>Total Amount Pending</th>
        <!--<th>Month Year</th>-->
        <th>View Detail</th>
      </tr>
    </thead>
    <tbody>
      <?php 
$total_amount = 0;

for($i=0;$i<count($query);$i++)
{	
	//$monthyear = $query[$i]["year"].'-'.$query[$i]["month"];
	//$pending_month = date('F Y', strtotime($monthyear));
	
	$pndg_sub_query = select_query("select dpb.client_id,dpb.company_name, dpb.month,dpb.year, dpb.device_amount_pending, dpb.rent_amount_pending, dpb.accessory_amount_pending, dpb.req_time from debtor_pending_billing as dpb where dpb.client_id='".$query[$i]["client_id"]."'");
			
	$device_amount_pending = 0;
	$rent_amount_pending = 0;
	$accessory_amount_pending = 0;

	for($sq=0;$sq<count($pndg_sub_query);$sq++)
	{
	
		$device_amount_pending = $device_amount_pending + $pndg_sub_query[$sq]["device_amount_pending"];
		$rent_amount_pending = $rent_amount_pending + $pndg_sub_query[$sq]["rent_amount_pending"];
		$accessory_amount_pending = $accessory_amount_pending + $pndg_sub_query[$sq]["accessory_amount_pending"];
		
	}
	
	/*$recd_sub_query = select_query("select client_id,company_name, month, year, device_amount_recd, rent_amount_recd, accessory_amount_recd,  discounting, tds_amount, received_time from debtor_received_billing where client_id='".$query[$i]["client_id"]."'");
	
	$device_amount_recd = 0;
	$rent_amount_recd = 0;
	$accessory_amount_recd = 0;
	$discounting_amount = 0;
	$tds_amount = 0;
	
	for($rs=0;$rs<count($recd_sub_query);$rs++)
	{
	
		$device_amount_recd = $device_amount_recd + $recd_sub_query[$rs]["device_amount_recd"];
		$rent_amount_recd = $rent_amount_recd + $recd_sub_query[$rs]["rent_amount_recd"];
		$accessory_amount_recd = $accessory_amount_recd + $recd_sub_query[$rs]["accessory_amount_recd"];
		$discounting_amount = $discounting_amount + $recd_sub_query[$rs]["discounting"];
		$tds_amount = $tds_amount + $recd_sub_query[$rs]["tds_amount"];
		
	}
	
	$get_device_amount = $device_amount_pending - $device_amount_recd;
	if($get_device_amount < 0){ $final_device_amount = 0; }else{ $final_device_amount = $get_device_amount; }	
	
	$get_rent_amount = $rent_amount_pending - $rent_amount_recd;
	if($get_rent_amount < 0){ $final_rent_amount = 0; }else{ $final_rent_amount = $get_rent_amount; }
	
	$get_accessory_amount = $accessory_amount_pending - $accessory_amount_recd;
	if($get_accessory_amount < 0){ $final_accessory_amount = 0; }else{ $final_accessory_amount = $get_accessory_amount; }*/
	
	
	if($device_amount_pending < 0){ $final_device_amount = 0; }else{ $final_device_amount = $device_amount_pending; }
	if($rent_amount_pending < 0){ $final_rent_amount = 0; }else{ $final_rent_amount = $rent_amount_pending; }
	if($accessory_amount_pending < 0){ $final_accessory_amount = 0; }else{ $final_accessory_amount = $accessory_amount_pending; }
	
	$discounting_amount = 0;
	$tds_amount = 0;
	
	$total_amount = ($final_device_amount + $final_rent_amount + $final_accessory_amount) - ($discounting_amount + $tds_amount);
	
?>
      
    <tr align="center">
        <td><?php echo $i+1;?></td>
        <td><?php echo $query[$i]["req_time"];?></td>
        <td><?php echo $query[$i]["sales_manager"];?></td>
        <td><?php echo $query[$i]["collection_agent"];?></td>
        <td><?php echo $query[$i]["company_name"];?></td>
        <td><?php echo $final_device_amount;?></td>
        <td><?php echo $final_rent_amount;?></td>
        <td><?php echo $final_accessory_amount;?></td>
        <td><?php echo $total_amount;?></td>
        <!--<td><?php echo $pending_month;?></td>-->
        <td><a href="#" onClick="Show_record(<?php echo $query[$i]["client_id"];?>,'debtor_show','popup1'); " class="topopup">View Detail</a></td>
      </tr>
      <?php } ?>
  </table>
  <div id="toPopup">
    <div class="close">close</div>
    <span class="ecs_tooltip">Press Esc to close <span class="arrow"></span></span>
    <div id="popup1"> <!--your content start--> 
      
    </div>
    <!--your content end--> 
    
  </div>
  <!--toPopup end-->
  
  <div class="loader"></div>
  <div id="backgroundPopup"></div>
</div>

<?php include("../include/footer.php"); ?>
