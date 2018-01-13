<?php
include("../connection.php");
include_once(__DOCUMENT_ROOT.'/include/header.php');
include_once(__DOCUMENT_ROOT.'/include/leftmenu_admin.php');


$ClientDetails = select_query("select Userid,UserName from addclient where sys_active=1 and sys_parent_user=1 order by UserName");

$SalesPersion = select_query("select id,name from sales_person where active=1 order by name");

$CollectionAgent = select_query("select id,name from collection_agent where is_active=1 and branch_id='1' order by name");


$query = select_query("select dpb.id,dpb.client_id,dpb.company_name, sp.name as sales_manager,
					 dpb.sales_manager as manager,dpb.collection_agent as agent, 
					 ca.name as collection_agent, dpb.month, dpb.year, dpb.device_amount_pending,
					 dpb.rent_amount_pending, dpb.accessory_amount_pending, dpb.req_time
					 from debtor_pending_billing as dpb left join sales_person as sp
					 on dpb.sales_manager=sp.id left join collection_agent as ca
					 on dpb.collection_agent=ca.id where dpb.month='".date("m",strtotime('-1 months'))."' and dpb.year='".date("Y")."'");

$data=array();
$total_amount = 0;

for($i=0;$i<count($query);$i++)
{
		
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
	
	
	if($device_amount_pending < 0){ $final_device_amount = 0; }else{ $final_device_amount = $device_amount_pending; }
	if($rent_amount_pending < 0){ $final_rent_amount = 0; }else{ $final_rent_amount = $rent_amount_pending; }
	if($accessory_amount_pending < 0){ $final_accessory_amount = 0; }else{ $final_accessory_amount = $accessory_amount_pending; }
	
	$discounting_amount = 0;
	$tds_amount = 0;
	
	$total_amount = ($final_device_amount + $final_rent_amount + $final_accessory_amount) - ($discounting_amount + $tds_amount);
		
		
		
		$arr=array (
				'id' => $query[$i]["id"],
				'r_date'=> $query[$i]["req_time"],
				'sales_manager' => $query[$i]["sales_manager"],
				'collection_agent' => $query[$i]["collection_agent"],
				'company_name' => $query[$i]["company_name"],
				'final_device_amount' => $final_device_amount,
				'final_rent_amount' => $final_rent_amount,
				'final_accessory_amount' => $final_accessory_amount,
				'total_amount' => $total_amount,
				'client_id' => $query[$i]["client_id"],
				'status' => "Pending",
				
				) ;
				
		array_push($data,$arr);
		
}
	
		
$rslt_data = $data;



if(isset($_POST["submit"]))
 {
	$sales_manager = $_POST["sales_manager"];
	$collection_agent = $_POST["collection_agent"];
	$client_name = $_POST["client_name"];	
	$mode = $_POST["mode"];
	
	//echo "<pre>";print_r($_POST);die;
	
	$data=array();
	

	if($mode=="Received")
	{
		
		if($sales_manager != " " && $collection_agent == " " && $client_name == " ")
		{
			$query_recd = select_query("SELECT drb.id,drb.client_id,drb.company_name, sp.name AS sales_manager,
						drb.sales_manager AS manager,drb.collection_agent AS agent, 
						ca.name AS collection_agent, drb.month, drb.year, drb.device_amount_recd,
						drb.rent_amount_recd, drb.accessory_amount_recd, drb.received_time
						FROM debtor_received_billing AS drb LEFT JOIN sales_person AS sp
						ON drb.sales_manager=sp.id LEFT JOIN collection_agent AS ca
						ON drb.collection_agent=ca.id WHERE drb.sales_manager='".$sales_manager."' GROUP BY drb.client_id");
			
		}
		else if($sales_manager == " " && $collection_agent != " " && $client_name == " ")
		{
			$query_recd = select_query("SELECT drb.id,drb.client_id,drb.company_name, sp.name AS sales_manager,
						drb.sales_manager AS manager,drb.collection_agent AS agent, 
						ca.name AS collection_agent, drb.month, drb.year, drb.device_amount_recd,
						drb.rent_amount_recd, drb.accessory_amount_recd, drb.received_time
						FROM debtor_received_billing AS drb LEFT JOIN sales_person AS sp
						ON drb.sales_manager=sp.id LEFT JOIN collection_agent AS ca
						ON drb.collection_agent=ca.id WHERE drb.collection_agent='".$collection_agent."' GROUP BY drb.client_id");
		
		}
		else if($sales_manager == " " && $collection_agent == " " && $client_name != " ")
		{
			$query_recd = select_query("SELECT drb.id,drb.client_id,drb.company_name, sp.name AS sales_manager,
						drb.sales_manager AS manager,drb.collection_agent AS agent, 
						ca.name AS collection_agent, drb.month, drb.year, drb.device_amount_recd,
						drb.rent_amount_recd, drb.accessory_amount_recd, drb.received_time
						FROM debtor_received_billing AS drb LEFT JOIN sales_person AS sp
						ON drb.sales_manager=sp.id LEFT JOIN collection_agent AS ca
						ON drb.collection_agent=ca.id WHERE drb.client_id='".$client_name."' GROUP BY drb.client_id");
		
		}
		else if($sales_manager != " " && $collection_agent != " " && $client_name == " ")
		{
			$query_recd = select_query("SELECT drb.id,drb.client_id,drb.company_name, sp.name AS sales_manager,
						drb.sales_manager AS manager,drb.collection_agent AS agent, 
						ca.name AS collection_agent, drb.month, drb.year, drb.device_amount_recd,
						drb.rent_amount_recd, drb.accessory_amount_recd, drb.received_time
						FROM debtor_received_billing AS drb LEFT JOIN sales_person AS sp
						ON drb.sales_manager=sp.id LEFT JOIN collection_agent AS ca ON drb.collection_agent=ca.id 
						WHERE drb.sales_manager='".$sales_manager."' AND drb.collection_agent='".$collection_agent."' GROUP BY drb.client_id");
		
		}
		else if($sales_manager != " " && $collection_agent == " " && $client_name != " ")
		{
			$query_recd = select_query("SELECT drb.id,drb.client_id,drb.company_name, sp.name AS sales_manager,
						drb.sales_manager AS manager,drb.collection_agent AS agent, 
						ca.name AS collection_agent, drb.month, drb.year, drb.device_amount_recd,
						drb.rent_amount_recd, drb.accessory_amount_recd, drb.received_time
						FROM debtor_received_billing AS drb LEFT JOIN sales_person AS sp
						ON drb.sales_manager=sp.id LEFT JOIN collection_agent AS ca ON drb.collection_agent=ca.id 
						WHERE drb.sales_manager='".$sales_manager."' AND drb.client_id='".$client_name."' GROUP BY drb.client_id");
		
		}
		else if($sales_manager == " " && $collection_agent != " " && $client_name != " ")
		{
			$query_recd = select_query("SELECT drb.id,drb.client_id,drb.company_name, sp.name AS sales_manager,
						drb.sales_manager AS manager,drb.collection_agent AS agent, 
						ca.name AS collection_agent, drb.month, drb.year, drb.device_amount_recd,
						drb.rent_amount_recd, drb.accessory_amount_recd, drb.received_time
						FROM debtor_received_billing AS drb LEFT JOIN sales_person AS sp
						ON drb.sales_manager=sp.id LEFT JOIN collection_agent AS ca ON drb.collection_agent=ca.id 
						WHERE drb.client_id='".$client_name."' AND drb.collection_agent='".$collection_agent."' GROUP BY drb.client_id");
		
		}
		else if($sales_manager != " " && $collection_agent != " " && $client_name != " ")
		{
			$query_recd = select_query("SELECT drb.id,drb.client_id,drb.company_name, sp.name AS sales_manager,
						drb.sales_manager AS manager,drb.collection_agent AS agent, 
						ca.name AS collection_agent, drb.month, drb.year, drb.device_amount_recd,
						drb.rent_amount_recd, drb.accessory_amount_recd, drb.received_time
						FROM debtor_received_billing AS drb LEFT JOIN sales_person AS sp
						ON drb.sales_manager=sp.id LEFT JOIN collection_agent AS ca ON drb.collection_agent=ca.id 
						WHERE drb.sales_manager='".$sales_manager."' AND drb.collection_agent='".$collection_agent."' and 
						drb.client_id='".$client_name."' GROUP BY drb.client_id");
						 
		}
		
		
		$total_amount = 0;

		for($qr=0;$qr<count($query_recd);$qr++)
		{
				
			$recd_sub_query = select_query("select client_id,company_name, month, year, device_amount_recd, rent_amount_recd, 
			accessory_amount_recd, discounting, tds_amount, received_time from debtor_received_billing 
			where client_id='".$query_recd[$qr]["client_id"]."'");
				
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
			
						
			$total_amount = ($device_amount_recd + $rent_amount_recd + $accessory_amount_recd) - ($discounting_amount + $tds_amount);
				
			$arr=array (
					'id' => $query_recd[$qr]["id"],
					'r_date'=> $query_recd[$qr]["req_time"],
					'sales_manager' => $query_recd[$qr]["sales_manager"],
					'collection_agent' => $query_recd[$qr]["collection_agent"],
					'company_name' => $query_recd[$qr]["company_name"],
					'final_device_amount' => $device_amount_recd,
					'final_rent_amount' => $rent_amount_recd,
					'final_accessory_amount' => $accessory_amount_recd,
					'total_amount' => $total_amount,
					'client_id' => $query_recd[$qr]["client_id"],
					'status' => "Received",
					
					) ;
					
			array_push($data,$arr);
				
		}		
	}
	else
	{
		
		if($sales_manager != " " && $collection_agent == " " && $client_name == " ")
		{
			$query_pending = select_query("select dpb.id,dpb.client_id,dpb.company_name, sp.name as sales_manager,
						 dpb.sales_manager as manager,dpb.collection_agent as agent, 
						 ca.name as collection_agent, dpb.month, dpb.year, dpb.device_amount_pending,
						 dpb.rent_amount_pending, dpb.accessory_amount_pending, dpb.req_time
						 from debtor_pending_billing as dpb left join sales_person as sp
						 on dpb.sales_manager=sp.id left join collection_agent as ca
						 on dpb.collection_agent=ca.id WHERE dpb.sales_manager='".$sales_manager."' GROUP BY dpb.client_id");
			
		}
		else if($sales_manager == " " && $collection_agent != " " && $client_name == " ")
		{
			$query_pending = select_query("select dpb.id,dpb.client_id,dpb.company_name, sp.name as sales_manager,
						 dpb.sales_manager as manager,dpb.collection_agent as agent, 
						 ca.name as collection_agent, dpb.month, dpb.year, dpb.device_amount_pending,
						 dpb.rent_amount_pending, dpb.accessory_amount_pending, dpb.req_time
						 from debtor_pending_billing as dpb left join sales_person as sp
						 on dpb.sales_manager=sp.id left join collection_agent as ca
						 on dpb.collection_agent=ca.id WHERE dpb.collection_agent='".$collection_agent."' GROUP BY dpb.client_id");
		
		}
		else if($sales_manager == " " && $collection_agent == " " && $client_name != " ")
		{
			$query_pending = select_query("select dpb.id,dpb.client_id,dpb.company_name, sp.name as sales_manager,
						 dpb.sales_manager as manager,dpb.collection_agent as agent, 
						 ca.name as collection_agent, dpb.month, dpb.year, dpb.device_amount_pending,
						 dpb.rent_amount_pending, dpb.accessory_amount_pending, dpb.req_time
						 from debtor_pending_billing as dpb left join sales_person as sp
						 on dpb.sales_manager=sp.id left join collection_agent as ca
						 on dpb.collection_agent=ca.id WHERE dpb.client_id='".$client_name."' GROUP BY dpb.client_id");
		
		}
		else if($sales_manager != " " && $collection_agent != " " && $client_name == " ")
		{
			$query_pending = select_query("select dpb.id,dpb.client_id,dpb.company_name, sp.name as sales_manager,
						 dpb.sales_manager as manager,dpb.collection_agent as agent, 
						 ca.name as collection_agent, dpb.month, dpb.year, dpb.device_amount_pending,
						 dpb.rent_amount_pending, dpb.accessory_amount_pending, dpb.req_time
						 from debtor_pending_billing as dpb left join sales_person as sp
						 on dpb.sales_manager=sp.id left join collection_agent as ca on dpb.collection_agent=ca.id
						 WHERE dpb.sales_manager='".$sales_manager."' AND dpb.collection_agent='".$collection_agent."' GROUP BY dpb.client_id");
		
		}
		else if($sales_manager != " " && $collection_agent == " " && $client_name != " ")
		{
			$query_pending = select_query("select dpb.id,dpb.client_id,dpb.company_name, sp.name as sales_manager,
						 dpb.sales_manager as manager,dpb.collection_agent as agent, 
						 ca.name as collection_agent, dpb.month, dpb.year, dpb.device_amount_pending,
						 dpb.rent_amount_pending, dpb.accessory_amount_pending, dpb.req_time
						 from debtor_pending_billing as dpb left join sales_person as sp
						 on dpb.sales_manager=sp.id left join collection_agent as ca on dpb.collection_agent=ca.id 
						 WHERE dpb.sales_manager='".$sales_manager."' AND dpb.client_id='".$client_name."' GROUP BY dpb.client_id");
		
		}
		else if($sales_manager == " " && $collection_agent != " " && $client_name != " ")
		{
			$query_pending = select_query("select dpb.id,dpb.client_id,dpb.company_name, sp.name as sales_manager,
						 dpb.sales_manager as manager,dpb.collection_agent as agent, 
						 ca.name as collection_agent, dpb.month, dpb.year, dpb.device_amount_pending,
						 dpb.rent_amount_pending, dpb.accessory_amount_pending, dpb.req_time
						 from debtor_pending_billing as dpb left join sales_person as sp
						 on dpb.sales_manager=sp.id left join collection_agent as ca on dpb.collection_agent=ca.id 
						 WHERE dpb.client_id='".$client_name."' AND dpb.collection_agent='".$collection_agent."' GROUP BY dpb.client_id");
		
		}
		else if($sales_manager != " " && $collection_agent != " " && $client_name != " ")
		{
			$query_pending = select_query("select dpb.id,dpb.client_id,dpb.company_name, sp.name as sales_manager,
						 dpb.sales_manager as manager,dpb.collection_agent as agent, 
						 ca.name as collection_agent, dpb.month, dpb.year, dpb.device_amount_pending,
						 dpb.rent_amount_pending, dpb.accessory_amount_pending, dpb.req_time
						 from debtor_pending_billing as dpb left join sales_person as sp
						 on dpb.sales_manager=sp.id left join collection_agent as ca on dpb.collection_agent=ca.id 
						 WHERE dpb.sales_manager='".$sales_manager."' AND dpb.collection_agent='".$collection_agent."' 
						 and dpb.client_id='".$client_name."' GROUP BY dpb.client_id");
						 
		}
		
		
		$total_amount = 0;

		for($qp=0;$qp<count($query_pending);$qp++)
		{
				
				$pndg_sub_query = select_query("select dpb.client_id,dpb.company_name, dpb.month,dpb.year, dpb.device_amount_pending, 
				dpb.rent_amount_pending, dpb.accessory_amount_pending, dpb.req_time from debtor_pending_billing as dpb 
				where dpb.client_id='".$query_pending[$qp]["client_id"]."'");
				
					
			$device_amount_pending = 0;
			$rent_amount_pending = 0;
			$accessory_amount_pending = 0;
		
			for($sq=0;$sq<count($pndg_sub_query);$sq++)
			{
			
				$device_amount_pending = $device_amount_pending + $pndg_sub_query[$sq]["device_amount_pending"];
				$rent_amount_pending = $rent_amount_pending + $pndg_sub_query[$sq]["rent_amount_pending"];
				$accessory_amount_pending = $accessory_amount_pending + $pndg_sub_query[$sq]["accessory_amount_pending"];
				
			}
			
			if($device_amount_pending < 0){ $final_device_amount = 0; }else{ $final_device_amount = $device_amount_pending; }
			if($rent_amount_pending < 0){ $final_rent_amount = 0; }else{ $final_rent_amount = $rent_amount_pending; }
			if($accessory_amount_pending < 0){ $final_accessory_amount = 0; }else{ $final_accessory_amount = $accessory_amount_pending; }
			
			$discounting_amount = 0;
			$tds_amount = 0;
			
			$total_amount = ($final_device_amount + $final_rent_amount + $final_accessory_amount) - ($discounting_amount + $tds_amount);
				
			$arr=array (
					'id' => $query_pending[$qp]["id"],
					'r_date'=> $query_pending[$qp]["req_time"],
					'sales_manager' => $query_pending[$qp]["sales_manager"],
					'collection_agent' => $query_pending[$qp]["collection_agent"],
					'company_name' => $query_pending[$qp]["company_name"],
					'final_device_amount' => $final_device_amount,
					'final_rent_amount' => $final_rent_amount,
					'final_accessory_amount' => $final_accessory_amount,
					'total_amount' => $total_amount,
					'client_id' => $query_pending[$qp]["client_id"],
					'status' => "Pending",
					
					) ;
					
			array_push($data,$arr);
				
		}
			
	
	}

	
	$rslt_data = $data;
	 
 }
 
//echo "<pre>";print_r($rslt_data);die;

?>
<script>

function req_validate()
{
	   var sales = document.myForm.sales_manager.value;
	   var cagent = document.myForm.collection_agent.value;
	   var client = document.myForm.client_name.value;
	   	   
	   if(sales == " " && cagent == " " && client == " "){
		   alert("Please One Drop Down Value.");
		   //document.myForm.sales_manager.focus();
		   return false;
	   }
	   
	   
}

</script>
<style type="text/css" >
.tb tr th {
	width: 137px !important;
}
.errorMsg {
	border:1px solid red;
}
.message {
	color: red;
	font-weight:bold;
}
</style>

<div class="top-bar"> 
  <!--<div align="center">
    <form name="myformlisting" method="post" action="">
      <select name="Showrequest" id="Showrequest" onchange="form.submit();" >
        <option value="0" <? if($_POST['Showrequest']==0){ echo 'Selected'; }?>>Select</option>
        <option value="" <?if($_POST['Showrequest']==''){ echo "Selected"; }?>>Pending</option>
      </select>
    </form>
  </div>--> 
  
  <!-- <a href="#" class="button">Debtor Report </a> -->
  
  <h1>Client Debtors:</h1>
  <?php echo "<p align='left' style='padding-left: 250px;width: 500px;' class='message'>" .$errorMsg. "</p>" ; ?> </div>
<!--<div class="top-bar">
  <div style="float:right";><font style="color:#B6B6B4;font-weight:bold;">Grey:</font>Admin Approved</div>
  <br/>
  <div style="float:right";><font style="color:#D462FF;font-weight:bold;">Purple:</font> Back from support</div>
  <br/>
  <div style="float:right";><font style="color:#FF0000;font-weight:bold;">Red:</font> Back from Admin</div>
  <br/>
  <div style="float:right";><font style="color:#8BFF61;font-weight:bold;">Green:</font> Completed your requsest.</div>
</div>-->

<div class="top-bar">
  <form name="myForm" action=""   method="post">
    <table cellspacing="5" cellpadding="5">
      <tr>
        <td>Account Manager</td>
        <td colspan="2"><select name="sales_manager" id="sales_manager" >
            <option value=" ">Select</option>
            <?php 
                    for($sl=0;$sl<count($SalesPersion);$sl++) {
                ?>
            <option required value="<?php echo $SalesPersion[$sl]['id']; ?>" <? if($sales_manager==$SalesPersion[$sl]['id']){ echo "Selected"; }?> ><?php echo $SalesPersion[$sl]['name']; ?></option>
            <?php }  ?>
          </select></td>
        <td>Collection Agent</td>
        <td colspan="2"><select name="collection_agent" id="collection_agent" >
            <option value=" ">Select</option>
            <?php 
                    for($ca=0;$ca<count($CollectionAgent);$ca++) {
                ?>
            <option required value="<?php echo $CollectionAgent[$ca]['id']; ?>" <? if($collection_agent==$CollectionAgent[$ca]['id']){ echo "Selected"; }?> ><?php echo $CollectionAgent[$ca]['name']; ?></option>
            <?php }  ?>
          </select></td>
        <td>Client Name</td>
        <td colspan="2"><select name="client_name" id="client_name" >
            <option value=" ">Select</option>
            <?php 
                    for($cl=0;$cl<count($ClientDetails);$cl++) {
                ?>
            <option value="<?php echo $ClientDetails[$cl]['Userid']; ?>" <? if($client_name==$ClientDetails[$cl]['Userid']){ echo "Selected"; }?> ><?php echo $ClientDetails[$cl]['UserName']; ?></option>
            <?php } ?>
          </select></td>
        <td><input type="radio" name="mode" id="Pending" value="Pending" <? if($_POST["mode"]=="Pending") echo "checked"?> checked="checked"/>
          Pending
          <input type="radio" name="mode" id="Received" value="Received" <? if($_POST["mode"]=="Received") echo "checked"?>/>
          Received </td>
        <td align="center"><input type="submit" name="submit" value="submit" onClick="return req_validate()" /></td>
        <td align="center"><input type="button" name="Reset" value="Reset" onClick="window.location = 'list_client_debtor.php' " /></td>
      </tr>
    </table>
  </form>
</div>
<div class="table">
  <table cellpadding="0" cellspacing="0" border="0" class="display" id="example">
    <thead>
      <tr>
        <th>SL.No</th>
        <th>R Date</th>
        <th>Account Manager</th>
        <th>Collection Agent</th>
        <th>Company Name</th>
        <th>Device</th>
        <th>Rent</th>
        <th>Accessory</th>
        <th>Total Amount</th>
        <!--<th>Month Year</th>-->
        <th>View Detail</th>
      </tr>
    </thead>
    <tbody>
      <?php 


for($fn=0;$fn<count($rslt_data);$fn++)
{	
	
?>
      <tr align="center">
        <td><?php echo $fn+1;?></td>
        <td><?php echo $rslt_data[$fn]["r_date"];?></td>
        <td><?php echo $rslt_data[$fn]["sales_manager"];?></td>
        <td><?php echo $rslt_data[$fn]["collection_agent"];?></td>
        <td><?php echo $rslt_data[$fn]["company_name"];?></td>
        <td><?php echo $rslt_data[$fn]["final_device_amount"];?></td>
        <td><?php echo $rslt_data[$fn]["final_rent_amount"];?></td>
        <td><?php echo $rslt_data[$fn]["final_accessory_amount"];?></td>
        <td><?php echo $rslt_data[$fn]["total_amount"];?></td>
        <td><a href="#" onClick="Show_record(<?php echo $rslt_data[$fn]["client_id"];?>,'debtor_show','popup1'); " class="topopup">View Detail</a></td>
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
