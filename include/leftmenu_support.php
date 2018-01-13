<?php
$group_id = $_SESSION['support_group_id'];
//$support_id = $_SESSION['userId'];

if($_SESSION['user_name']=="ankur" && $_SESSION['ParentId'] == "3"){
	$branch='branch_id IN (2,3,4,7)';	
}
else if($_SESSION['user_name']=="rakhi" && $_SESSION['ParentId'] == "3"){
	$branch='branch_id IN (1)';
}
else if($_SESSION['user_name']=="amit" && $_SESSION['ParentId'] == "3"){
	$branch='branch_id IN (6)';
}
else{
	$branch='branch_id IN (0)';
}

$user_id = "";
if($_SESSION['support_group_id'] == 9 && $_SESSION['ParentId'] == "3"){
	$user_query = select_query("SELECT Userid FROM internalsoftware.addclient WHERE GroupId IN ('1','".$group_id."')");
}
else if($_SESSION['support_group_id'] != 9 && $_SESSION['ParentId'] == "3"){
	$user_query = select_query("SELECT Userid FROM internalsoftware.addclient WHERE GroupId='".$group_id."'");
}
 //$user_query = mysql_query("SELECT id FROM matrix.users WHERE $branch AND id NOT IN(1,2143)");
 //while($user_data = mysql_fetch_array($user_query))
 for($u=0;$u<count($user_query);$u++)
 {
     $user_id.= $user_query[$u]['Userid'].",";
 }
 $user = substr($user_id,0,-1);

?>
 
 
  <div id="middle">
            <div id="left-column">
                
                <? if($_SESSION['BranchId']==1 && ($_SESSION['ParentId'] == "16" || $_SESSION['ParentId'] == "3") && $_SESSION['user_name']!="amit"){ ?>
                
                 <h3>Services Installation</h3>            
                    <ul class="nav">
                        <li><a href="list_service_support.php">Running Services(<? echo getcountRow("SELECT * FROM services where service_status='11' and fwd_tech_rm_id='".$_SESSION['userId']."' and fwd_reason is NOT NULL and fwd_repair_id is NULL and fwd_serv_to_repair is NULL and fwd_repair_to_serv is NULL");?>)</a></li>
                        
                        <li><a href="list_installation_support.php">Running Installation(<? echo getcountRow("SELECT * FROM installation where installation_status='11' and fwd_tech_rm_id='".$_SESSION['userId']."' and fwd_reason is NOT NULL and fwd_repair_id is NULL and fwd_install_to_repair is null and fwd_repair_to_install is null");?>)</a></li>  
                        
                        <?php if($_SESSION['user_name']=="ankur" || $_SESSION['user_name']=="rakhi") {?>
                        
                        <li><a href="<?php echo __SITE_URL;?>/support/all_branch_ser_inst.php">Service Installation </a></li>
                        
                        <?php } ?> 
                                                
                    </ul> 
                    
                <h3>Login Report</h3>
                    <ul class="nav">
                        <?php if(($_SESSION['user_name']=="ankur" || $_SESSION['user_name']=="rakhi") && $_SESSION['isadmin']!=""){?>
                        <li><a href="list_login_assign.php">Login Assign </a></li>
                        <?php } ?>  
                        <li><a href="login_status_change.php">Login Activety </a></li>
    
                    </ul>
                
				<? } if($_SESSION['BranchId']==1 && $_SESSION['ParentId'] == "3") {?>
                
                <h3>Service Request</h3>
                    <ul class="nav">
                        <li><a href="list_device_change.php" > Device Change(<? echo getcountRow("SELECT * FROM device_change where (user_id IN($user) and (approve_status=1 and final_status!=1 and device_change_status=1 and (support_comment is null or service_comment!=''))) or (forward_req_user='".$_SESSION["user_name"]."' and (forward_back_comment is null or forward_back_comment=''))");?>) </a></li>
                       
                        <li><a href="list_new_device_addition.php">New Device Addition (<? echo getcountRow("  SELECT * FROM new_device_addition  where (user_id IN($user) and (approve_status=0 and final_status!=1) and new_device_status=1 and (support_comment is null or service_comment!='')) or (forward_req_user='".$_SESSION["user_name"]."' and (forward_back_comment is null or forward_back_comment=''))");?>) </a></li>
                       
                        <!--<li><a href="list_vehicle_no_change.php">Vehicle Number Change(<?echo getcountRow(" SELECT * FROM vehicle_no_change  where  (approve_status=1 and final_status!=1 and support_comment is null) or (forward_back_comment is null and forward_req_user='".$_SESSION["user_name"]."')");?>) </a></li>-->
                       
                        <li><a href="list_vehicle_no_change.php">Vehicle Number Change(<? echo getcountRow(" SELECT * FROM vehicle_no_change  where (user_id IN($user) and ((approve_status=0 and reason IN('Temperory no to Permanent no','Personal no to Commercial no','Commercial no to Personal no','For Warranty Renuwal Purpose')) or approve_status=1) and final_status!=1 and (support_comment is null or service_comment!='') and vehicle_status=1 ) or (forward_req_user='".$_SESSION["user_name"]."' and (forward_back_comment is null or forward_back_comment='')) ");?>) </a></li>
                       
                        <!--<li><a href="list_sim_change.php">Sim Change(<?echo getcountRow("SELECT * FROM sim_change where  (approve_status=1 and final_status!=1 and support_comment is null) or (forward_back_comment is null and forward_req_user='".$_SESSION["user_name"]."')");?>) </a></li>-->
                       
                        <li><a href="list_sim_change.php">Sim Change(<? echo getcountRow("SELECT * FROM sim_change where (user_id IN($user) and approve_status=0 and final_status!=1 and sim_change_status=1 and (support_comment is null or service_comment!='')) or (forward_req_user='".$_SESSION["user_name"]."' and (forward_back_comment is null or forward_back_comment=''))");?>) </a></li>
                       
                        <!--  <li><a href="search_km_alerts.php">KM Alert</a></li> -->
                        <!--<li><a href="list_deactivate_sim.php">Deactivate Sim(<?echo getcountRow(" SELECT * FROM deactivate_sim where  (approve_status=1 and final_status!=1 and support_comment is null) or (forward_back_comment is null and forward_req_user='".$_SESSION["user_name"]."')");?>)</a></li>  -->
                       
                        <li><a href="list_device_lost.php">Device Lost(<? echo getcountRow("SELECT * FROM device_lost  where (user_id IN($user) and (approve_status=1 and final_status!=1 and device_lost_status=1 and (support_comment is null or service_comment!=''))) or (forward_req_user='".$_SESSION["user_name"]."' and (forward_back_comment is null or forward_back_comment=''))");?>) </a></li>
                       
                        <li><a href="list_delete_vehicle.php">Delete Vehicle(<? echo getcountRow(" SELECT * FROM deletion where (user_id IN($user) and (approve_status=1 and final_status!=1 and delete_veh_status=1 and (support_comment is null or service_comment!=''))) or (forward_req_user='".$_SESSION["user_name"]."' and (forward_back_comment is null or forward_back_comment=''))");?>)</a></li>
                       
                        <li><a href="list_dimts_imei.php">Dimts IMEI Upload(<? echo getcountRow("SELECT * FROM dimts_imei where (user_id IN($user) and (approve_status=1 or account_comment!='') and (support_comment IS NULL or service_comment!='') and dimts_status=1) or (forward_req_user='".$_SESSION["user_name"]."' and (forward_back_comment is null or forward_back_comment=''))");?>)</a></li> 
                    </ul>
            
        <?php //if($_SESSION['user_name']=="anoop" && $_SESSION['isadmin']!=""){?>
        <!--<h3>Stop Client Billing</h3>
            <ul class="nav">
                        
                    <li><a href="list_deactivate_of_users.php">Users Account List</a></li>
                                       
            </ul>-->
         <?php //}?>
         
        <h3>Sales Request</h3>
            <ul class="nav">
                <li><a href="accountcreation.php" >Account Creation(<? echo getcountRow("SELECT * FROM new_account_creation where ($branch and approve_status=1 and final_status!=1 and (support_comment is null or sales_comment!='') and acc_creation_status=1) or (forward_req_user='".$_SESSION["user_name"]."' and (forward_back_comment is null or forward_back_comment=''))");?>)</a></li>
                <!-- <li><a href="list_stop_gps.php">Stop Gps(<?echo getcountRow("  SELECT * FROM stop_gps   where  (approve_status=1 and support_comment IS NULL) or (forward_back_comment is null and forward_req_user='".$_SESSION["user_name"]."')");?>) </a></li>
                -->
               
                <li><a href="list_stop_gps.php">Stop Gps(<? echo getcountRow("  SELECT * FROM stop_gps where (client IN($user) and (approve_status=1 and final_status!=1 and stop_gps_status=1 and (support_comment is null or sales_comment!=''))) or (forward_req_user='".$_SESSION["user_name"]."' and (forward_back_comment is null or forward_back_comment=''))");?>) </a></li>
               
                <li><a href="list_start_gps.php">Start Gps(<? echo getcountRow("  SELECT * FROM start_gps where (client IN($user) and (approve_status=1 and final_status!=1 and start_gps_status=1 and (support_comment is null or sales_comment!=''))) or (forward_req_user='".$_SESSION["user_name"]."' and (forward_back_comment is null or forward_back_comment=''))");?>) </a></li>
               
                <li><a href="list_sub_user_creation.php">Sub User Creation(<? echo getcountRow(" SELECT * FROM sub_user_creation  where (main_user_id IN($user) and (approve_status=1 and final_status!=1 and sub_user_status=1 and (support_comment is null or sales_comment!=''))) or (forward_req_user='".$_SESSION["user_name"]."' and (forward_back_comment is null or forward_back_comment=''))");?>) </a></li>
               
                <li><a href="list_reactivate_of_account.php">Reactivation Of Account(<? echo getcountRow("SELECT * FROM reactivation_of_account where (user_id IN($user) and  (approve_status=1 and final_status!=1 and reactivation_status=1 and (support_comment is null or sales_comment!=''))) or (forward_req_user='".$_SESSION["user_name"]."' and (forward_back_comment is null or forward_back_comment=''))");?>) </a></li>
               
                <li><a href="list_deactivate_of_account.php">Deactivation Of Account(<? echo getcountRow("SELECT * FROM deactivation_of_account where (user_id IN($user) and (approve_status=1 and final_status!=1 and deactivation_status=1 and (support_comment is null or sales_comment!=''))) or (forward_req_user='".$_SESSION["user_name"]."' and (forward_back_comment is null or forward_back_comment=''))");?>) </a></li>
               
                <!-- <li><a href="list_deletion_from_debtors.php">Delete From Debtors(<?echo getcountRow("SELECT * FROM del_form_debtors where  (approve_status=1 and final_status!=1 and support_comment is null) or (forward_back_comment is null and forward_req_user='".$_SESSION["user_name"]."')");?>) </a></li>-->
                <!--  <li><a href="search_km_alerts.php">KM Alert</a></li> -->
               
                <!--<li><a href="list_no_bill.php">NO Bill(<?echo getcountRow("SELECT * FROM no_bills where (client IN($user) and (approve_status=0 and no_bill_issue='Software Issue' and no_bill_status=1 and ((support_comment is null and software_comment is null) or sales_comment!=''))) or (forward_req_user='".$_SESSION["user_name"]."' and (forward_back_comment is null or forward_back_comment=''))");?>) </a></li>-->
               
                <li><a href="list_discounting.php">Discounting(<? echo getcountRow("SELECT * FROM discount_details  where (user IN($user) and (approve_status=0 and discount_issue='Software Issue' and discount_status=1 and (support_comment is null or sales_comment!='') and software_comment is null) and (forward_req_user is null or forward_back_comment!='')) or (forward_req_user='".$_SESSION["user_name"]."' and (forward_back_comment is null or forward_back_comment=''))");?>)</a></li>
               
                <li><a href="list_software_request.php">Software Request(<? echo getcountRow("SELECT * FROM software_request  where (main_user_id IN($user) and (approve_status=1 and final_status!=1 and software_status=1 and (support_comment is null or sales_comment!=''))) or (forward_req_user='".$_SESSION["user_name"]."' and (forward_back_comment is null or forward_back_comment=''))");?>) </a></li>
               
                <li><a href="list_transfer_the_vehicle.php">Transfer The Vehicle(<? echo getcountRow("SELECT * FROM transfer_the_vehicle where (transfer_from_user IN($user) and (approve_status=1 and final_status!=1 and transfer_veh_status=1 and (support_comment is null or sales_comment!=''))) or (forward_req_user='".$_SESSION["user_name"]."' and (forward_back_comment is null or forward_back_comment=''))");?>)</a></li>
            </ul>
            
            <h3>Daily Branch Report</h3>
                <ul class="nav">
                    <li><a href="list_branch_repiar_report.php">Repair Reoprt </a></li>
                    <li><a href="service_installation_details.php">Service & Installation </a></li>
                    <li><a href="list_branch_service_report.php">Service Reoprt </a></li>
                    <li><a href="inventory_stock_details.php">Stock Details </a></li>
                    <li><a href="list_branch_stock_report.php">Stock Reoprt </a></li>
                    <li><a href="list_branch_account_report.php">Payment Reoprt </a></li>
                </ul>
                      
            <? } ?>   
</div>

<div id="center-column">