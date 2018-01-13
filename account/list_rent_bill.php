<?php
include("../connection.php");
include_once(__DOCUMENT_ROOT.'/include/header.php');
include_once(__DOCUMENT_ROOT.'/include/leftmenu_account.php');
  
?>

<div class="top-bar">
  <div align="center">
    <form name="myformlisting" method="post" action="">
      <select name="Showrequest" id="Showrequest" onchange="form.submit();" >
        <option value="0" <? if($_POST['Showrequest']==0){ echo 'Selected'; }?>>Select</option>
        <option value="" <?if($_POST['Showrequest']==''){ echo "Selected"; }?>>Pending</option>
        <option value="1" <?if($_POST['Showrequest']==1){ echo "Selected"; }?>>Action Taken</option>
        <option value="2" <?if($_POST['Showrequest']==2){ echo "Selected" ;}?>>All </option>
      </select>
    </form>
  </div>
  <h1>Rent Bill List</h1>
</div>
<div class="top-bar">
  <!--<div style="float:right";><font style="color:#D462FF;font-weight:bold;">Purple:</font> Deactivate Users</div>
  <br/>
  <div style="float:right";><font style="color:#8BFF61;font-weight:bold;">Green:</font> Activate Users.</div>-->
</div>
<!--<div style="float:right";><a href="reportfiles/list_billed_client.xls">Create Excel</a><br/>
</div>-->
<div class="table">
<?php
$todaydate = date('Y-m-d');


if($_POST["Showrequest"]==1)
 {
      if($todaydate >= date("Y")."-01-01" && $todaydate <= date("Y")."-04-30")
	  {
			$WhereQuery=" WHERE itgt_time_period='".date("y", strtotime("-1 years"))."-".date("y")."' AND current_bill_month='".date('Y-m',strtotime(date('M Y', strtotime("last month"))))."' AND bill_invoice_no!='' AND update_action!='' AND is_active=1";
	  }
	  else
	  {
			$WhereQuery=" WHERE itgt_time_period='".date("y")."-".date("y", strtotime("+1 years"))."' AND current_bill_month='".date('Y-m',strtotime(date('M Y', strtotime("last month"))))."' AND bill_invoice_no!='' AND update_action!='' AND is_active=1";
	  }
 }
 else if($_POST["Showrequest"]==2)
 {
     if($todaydate >= date("Y")."-01-01" && $todaydate <= date("Y")."-04-30")
	  {
			$WhereQuery=" WHERE itgt_time_period='".date("y", strtotime("-1 years"))."-".date("y")."' AND current_bill_month='".date('Y-m',strtotime(date('M Y', strtotime("last month"))))."' AND bill_invoice_no!='' AND is_active=1";
	  }
	  else
	  {
		   $WhereQuery=" WHERE itgt_time_period='".date("y")."-".date("y", strtotime("+1 years"))."' AND current_bill_month='".date('Y-m',strtotime(date('M Y', strtotime("last month"))))."' AND bill_invoice_no!='' AND is_active=1";
	  }
 }
 else
 {
     if($todaydate >= date("Y")."-01-01" && $todaydate <= date("Y")."-04-30")
	  {
			$WhereQuery=" WHERE itgt_time_period='".date("y", strtotime("-1 years"))."-".date("y")."' AND current_bill_month='".date('Y-m',strtotime(date('M Y', strtotime("last month"))))."' AND bill_invoice_no!='' AND update_action is null AND is_active=1";
	  }
	  else
	  {
		    $WhereQuery=" WHERE itgt_time_period='".date("y")."-".date("y", strtotime("+1 years"))."' AND current_bill_month='".date('Y-m',strtotime(date('M Y', strtotime("last month"))))."' AND bill_invoice_no!='' AND update_action is null AND is_active=1";
	  }
 }
 

$query_rslt = select_query("SELECT * FROM service_tax_invoice_bill ".$WhereQuery." ORDER BY branch_id ");


//echo "<pre>";print_r($query_rslt);die; 

?>
  <table cellpadding="0" cellspacing="0" border="0" class="display" id="example">
    <thead>
      <tr>
        <th>SL No</th>
        <th>User Name</th>
        <th>Company Name</th>
        <th>Address</th>
        <th>Unit Price</th>
        <th>Rent Amount</th>
        <th>Final Amount</th>
        <th>No of device</th>
        <th>Branch</th>
        <th>Edit</th>
      </tr>
    </thead>
    <tbody>
<?php
	  
for($j=0;$j<count($query_rslt);$j++)
{
	
    if($query_rslt[$j]["branch_id"]==1){ $branch = "Delhi";}
	elseif($query_rslt[$j]["branch_id"]==2){ $branch = "Mumbai";}
	elseif($query_rslt[$j]["branch_id"]==3){ $branch = "Jaipur";}
	elseif($query_rslt[$j]["branch_id"]==4){ $branch = "Sonipath";}
	elseif($query_rslt[$j]["branch_id"]==6){ $branch = "Ahmedabad";}
	elseif($query_rslt[$j]["branch_id"]==7){ $branch = "Kolkata";}
	
	
	
	
?>
      <tr align="center" >
        <td><?php echo $j+1;?></td>
        <td><?php echo $query_rslt[$j]["client_name"];?></td>
        <td><?php echo $query_rslt[$j]["company_name"];?></td>
        <td><?php echo $query_rslt[$j]["address"];?></td>
        <td><?php echo $query_rslt[$j]["unit_price"];?></td>
        <td><?php echo $query_rslt[$j]["rent_amount"];?></td>
        <td><?php echo $query_rslt[$j]["final_amount"];?></td>
        <td><?php echo $query_rslt[$j]["no_of_device_rent"];?></td>
        <td><?php echo $branch;?></td>
        <td><a href="update_rent_bill.php?id=<?=$query_rslt[$j]['id'];?>&action=edit" target="_blank"> edit</a></td>
      </tr>
      <?php 
	  
	  }
	   
	  ?>
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
<?php

include("../include/footer.php"); ?>