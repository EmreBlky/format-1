<?php
include("../connection.php");
include_once(__DOCUMENT_ROOT.'/include/header.php');
include_once(__DOCUMENT_ROOT.'/include/leftmenu_account.php');


?>

<script>
 
function ConfirmProcessClose(row_id)
{
  var x = confirm("All payment cleared?");
  if (x)
  {
  PaymentClear(row_id);
      return ture;
  }
  else
    return false;
}

function PaymentClear(row_id)
{
	//alert(user_id);
	//return false;
	$.ajax({
		type:"GET",
		url:"userInfo.php?action=DebtorAmountRecd",
 		data:"row_id="+row_id,
		success:function(msg){
			//alert(msg);
			location.reload(true);		
		}
	});
}

</script>

<div class="top-bar">
  <div align="center">
    <form name="myformlisting" method="post" action="">
      <select name="Showrequest" id="Showrequest" onchange="form.submit();" >
        <option value="0" <? if($_POST['Showrequest']==0){ echo 'Selected'; }?>>Select</option>
        <option value="" <?if($_POST['Showrequest']==''){ echo "Selected"; }?>>Pending</option>
        <option value="1" <?if($_POST['Showrequest']==1){ echo "Selected"; }?>>Closed</option>
        <option value="2" <?if($_POST['Showrequest']==2){ echo "Selected" ;}?>>All</option>
      </select>
    </form>
  </div>
  <h1>Payment Received</h1>
</div>

<div class="top-bar">
  <br/>
  <div style="float:right";><font style="color:#99FF66;font-weight:bold;">Green:</font> Completed your requsest.</div>
  <br/>
</div>
<!--<div style="float:right";><a href="Billing_data/pending_debtor_list.xls">Create Excel</a><br/></div>-->

<div class="table">
<?php

if($_POST["Showrequest"]==1)
 {
	  $WhereQuery=" where crb.is_status='0' and crb.is_active='0'";
 }
 else if($_POST["Showrequest"]==2)
 {
	 $WhereQuery="  ";
 }
 else
 {
	 $WhereQuery=" where crb.is_status='1' and crb.is_active='1'";
 }
 
$query = select_query("select crb.id,crb.client_id,crb.company_name, sp.name as sales_manager,crb.sales_manager as manager,
			crb.collection_agent as agent, ca.name as collection_agent, crb.month, crb.year, crb.device_amount_recd,
			crb.rent_amount_recd, crb.accessory_amount_recd, crb.advance_amount_recd, crb.received_time, ad.UserName, 
			crb.is_status, crb.is_active from collection_received_billing as crb left join sales_person as sp
			on crb.sales_manager=sp.id left join collection_agent as ca on crb.collection_agent=ca.id left join addclient as ad 
			on crb.client_id=ad.Userid ". $WhereQuery." order by crb.id ");

?>
  <table cellpadding="0" cellspacing="0" border="0" class="display" id="example">
    <thead>
      <tr>
        <th>SL.No</th>
        <th>Received Date</th>
        <th>Account Manager</th>
        <th>Collection Agent</th>
        <th>Client Name</th>
        <th>Company Name</th>
        <th>Receive Month</th>
        <th>Device Amount Recd</th>
        <th>Rent Amount Recd</th>
        <th>Advance Amount Recd</th>
        <th>Total Amount Recd</th>
        <!--<th>Month Year</th>-->
        <th>View Detail</th>
        <th>Action</th>
      </tr>
    </thead>
    <tbody>
<?php 
	$total_amount = 0;
	
	$startdate = date('Y-m');
	
for($i=0;$i<count($query);$i++)
{	
		
	
	$total_amount = ($query[$i]["device_amount_recd"] + $query[$i]["rent_amount_recd"] + $query[$i]["advance_amount_recd"]);
		
?>
      
    <tr align="center" <? if($query[$i]["is_status"]=='0' && $query[$i]["is_active"]=='0'){ echo 'style="background-color:#99FF66"';}?>>
        <td><?php echo $i+1;?></td>
        <td><?php echo $query[$i]["received_time"];?></td>
        <td><?php echo $query[$i]["sales_manager"];?></td>
        <td><?php echo $query[$i]["collection_agent"];?></td>
        <td><?php echo $query[$i]["UserName"];?></td>
        <td><?php echo $query[$i]["company_name"];?></td>
        <td><?php echo date("F-Y",strtotime($query[$i]["year"].'-'.$query[$i]["month"]));?></td>
        <td><?php echo $query[$i]["device_amount_recd"];?></td>
        <td><?php echo $query[$i]["rent_amount_recd"];?></td>
        <td><?php echo $query[$i]["advance_amount_recd"];?></td>
        <td><?php echo $total_amount;?></td>
        <!--<td><?php echo $pending_month;?></td>-->
        <td><a href="#" onClick="Show_record(<?php echo $query[$i]["client_id"];?>,'debtor_show','popup1'); " class="topopup">View Detail</a></td>
        <td>
           <? if($_POST["Showrequest"]!=1 && $_POST["Showrequest"]!=2){ if($total_amount > 0 ) { ?> 
             <a href="received_debtor.php?company=<?=$query[$i]["company_name"];?>&manager=<?=$query[$i]["manager"];?>&agent=<?=$query[$i]["agent"];?>&client=<?=$query[$i]["client_id"];?>&device_recd=<?=$query[$i]["device_amount_recd"];?>&rent_recd=<?=$query[$i]["rent_amount_recd"];?>&month_year=<?=$query[$i]["year"].'-'.$query[$i]["month"];?>&AddRecd=true" target="_blank">Received</a> 
             | <a href="#" onclick="return ConfirmProcessClose(<?php echo $query[$i]["id"];?>);">Closed</a>
            <? } } ?>
            </td>
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

include("../include/footer.php"); 

?>
