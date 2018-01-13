<?php

error_reporting(0);
ob_start();
session_start();
include("../connection.php");

$truncate = select_query("truncate internalsoftware.admin_stock_view");

$itemList = select_query("select * from inventory.item_master order by parent_id");

//echo "<pre>";print_r($itemList);

for($i=0;$i<count($itemList);$i++)
{
 	if($itemList[$i]['parent_id']!=0)
 	{
 		$deviceType=select_inventory_query("select * from inventory.item_master where item_id='".$itemList[$i]['parent_id']."'");
 		//echo "<pre>";print_r($deviceType);

 		$branchList = select_query("select * from inventory.branch_master");
 		
 		for ($j=0; $j <count($branchList) ; $j++) { 
 			//echo "select count(*) as new from inventory.device as d where d.active_status=1 and d.is_ffc=0 and d.is_permanent=0 and d.is_repaired=0 and d.device_status IN (62,99,116) and d.device_type='".$itemList[$i]['item_id']."' and dispatch_branch='".$branchList[$j]['id']."'";die;
 			$newCount="select count(*) as new from inventory.device as d where d.active_status=1 and d.is_ffc=0 and d.is_permanent=0 and d.is_repaired=0 and d.device_status IN (62,99,116) and d.device_type='".$itemList[$i]['item_id']."' and dispatch_branch='".$branchList[$j]['id']."'";
			$newCount=select_inventory_query($newCount);
			//echo '<pre>'; print_r($newCount); die;
			//echo $newCount[0]['new'];

			$ffcCount="select count(*) as ffc from inventory.device as d where d.active_status=1 and d.is_ffc=1 and d.is_permanent=1 and d.device_status IN (62,99,116) and d.device_type='".$itemList[$i]['item_id']."' and dispatch_branch='".$branchList[$j]['id']."'";
			$ffcCount=select_inventory_query($ffcCount);
			//echo '<pre>'; print_r($ffcCount); die;
			//echo $ffcCount[0]['ffc'];

			$totalDevice = $newCount[0]['new']+$ffcCount[0]['ffc'];
			//echo "INSERT into admin_stock_view(device_type_id,device_type,device_model,ffc_device,new_device,total_device,dispatch_branch,update_device_status) VALUES('".$itemList[$i]['item_id']."',".$itemList[$i]['item_name']."','".$deviceType[0]['item_name']."','".$newCount[0]['new']."','".$ffcCount[0]['ffc']."','".$totalDevice."','".$branchList[$j]['id']."',1)";
			$query=select_query("INSERT into internalsoftware.admin_stock_view(device_type_id,device_parent_id,device_type,device_model,ffc_device,new_device,total_device,dispatch_branch,update_device_status) VALUES('".$itemList[$i]['item_id']."','".$itemList[$i]['parent_id']."','".$itemList[$i]['item_name']."','".$deviceType[0]['item_name']."','".$newCount[0]['new']."','".$ffcCount[0]['ffc']."','".$totalDevice."','".$branchList[$j]['id']."',1)");		
			//echo $query;
		}
 	}
}		

?>