<div id="middle">

    <div id="left-column">
<?  if($_SESSION['BranchId']==1 && $_SESSION['username']=='prabhaat'){?>
  
        <h3>Live Debug</h3>
    
            <ul class="nav">
            
                <li><a href="<?php echo __SITE_URL;?>/service_request/imeisearch_vendor.php" >Data BY IMEI</a></li> 
            
            </ul>
        
        <?php } else {?>
      
       <h3> Request</h3>

        <ul class="nav">

            <li><a href="<?php echo __SITE_URL;?>/service_request/list_device_change.php" > Device Change(<? echo getcountRow("SELECT * FROM device_change where final_status!=1 and (acc_manager='".$_SESSION['user_name']."' or (forward_req_user='".$_SESSION["user_name"]."' and (forward_back_comment is null or forward_back_comment='')))");?>)</a></li>
            
            <?  if($_SESSION['BranchId']==1 && $_SESSION['username']=='saleslogin'){?>
            
            <li><a href="<?php echo __SITE_URL;?>/service_request/list_new_device_addition_delhi.php">New Device Addition(<? echo getcountRow("SELECT * FROM new_device_addition where final_status!=1  and acc_manager='triloki'");?>)</a></li>
            
			<? } else { ?>
           
            <li><a href="<?php echo __SITE_URL;?>/service_request/list_new_device_addition.php">New Device Addition(<? echo getcountRow("SELECT * FROM new_device_addition where final_status!=1 and (service_comment is null or new_device_status=2) and (acc_manager='".$_SESSION['user_name']."' or (forward_req_user='".$_SESSION["user_name"]."' and (forward_back_comment is null or forward_back_comment='')))");?>) </a></li>
           
           <? } ?>
           
            <!--<li><a href="<?php echo __SITE_URL;?>/service_request/list_vehicle_no_change.php">Vehicle Number Change(<?echo getcountRow("SELECT * FROM vehicle_no_change where (approve_status=0 or approve_status=2) and (service_comment is null and forward_back_comment is null) and (acc_manager='".$_SESSION['user_name']."' or forward_req_user='".$_SESSION["user_name"]."') ");?>)</a></li>-->
           
            <li><a href="<?php echo __SITE_URL;?>/service_request/list_vehicle_no_change.php">Vehicle Number Change(<? echo getcountRow("SELECT * FROM vehicle_no_change where (((approve_status=0) or (approve_status=1)) and final_status!=1) and (service_comment is null or vehicle_status=2) and (acc_manager='".$_SESSION['user_name']."' or (forward_req_user='".$_SESSION["user_name"]."' and (forward_back_comment is null or forward_back_comment='')))");?>)</a></li>
           
            <!--<li><a href="<?php echo __SITE_URL;?>/service_request/list_sim_change.php">Sim Change(<?echo getcountRow("SELECT * FROM sim_change where (approve_status=0 or approve_status=2) and (service_comment is null and forward_back_comment is null) and (acc_manager='".$_SESSION['user_name']."' or forward_req_user='".$_SESSION["user_name"]."')");?>)</a></li>-->
           
            <li><a href="<?php echo __SITE_URL;?>/service_request/list_sim_change.php">Sim Change(<? echo getcountRow("SELECT * FROM sim_change where ((approve_status=0 and final_status!=1) or (approve_status=1 and final_status!=1 and support_comment!='')) and (service_comment is null or sim_change_status=2) and (acc_manager='".$_SESSION['user_name']."' or (forward_req_user='".$_SESSION["user_name"]."' and (forward_back_comment is null or forward_back_comment='')))");?>)</a></li>
           
            <!--  <li><a href="search_km_alerts.php">KM Alert</a></li> -->
           
            <!--<li><a href="<?php echo __SITE_URL;?>/service_request/list_device_lost.php">Device Lost(<?echo getcountRow("SELECT * FROM device_lost where ((approve_status=0) or (approve_status=1 and support_comment!='' and final_status!=1))  and (service_comment is null or device_lost_status=2) and (acc_manager='".$_SESSION['user_name']."' or (forward_req_user='".$_SESSION["user_name"]."' and (forward_back_comment is null or forward_back_comment='')))");?>)</a></li>-->
           
            <li><a href="<?php echo __SITE_URL;?>/service_request/list_delete_vehicle.php">Delete Vehicle(<? echo getcountRow("SELECT * FROM deletion where ((approve_status=0 or approve_status=1) and final_status!=1) and (service_comment is null or delete_veh_status=2) and (acc_manager='".$_SESSION['user_name']."' or (forward_req_user='".$_SESSION["user_name"]."' and (forward_back_comment is null or forward_back_comment='')))");?>)</a></li> 
           
            <!--<li><a href="<?php echo __SITE_URL;?>/service_request/list_deactivate_sim.php">Deactivate Sim(<?echo getcountRow("SELECT * FROM deactivate_sim where (approve_status=0 or approve_status=2) and (service_comment is null and forward_back_comment is null) and (acc_manager='".$_SESSION['user_name']."' or forward_req_user='".$_SESSION["user_name"]."')");?>)</a></li> -->
           
            <li><a href="<?php echo __SITE_URL;?>/service_request/list_deactivate_sim.php">Deactivate Sim(<? echo getcountRow("SELECT * FROM deactivate_sim where (final_status=0 and approve_status=0) and (service_comment is null and forward_back_comment is null) and (acc_manager='".$_SESSION['user_name']."' or forward_req_user='".$_SESSION["user_name"]."')");?>)</a></li>

 <? if($_SESSION['BranchId']==1 && $_SESSION['username']=='triloki'){?>

         <li><a href="<?php echo __SITE_URL;?>/service_request/list_dimts_imei.php" >Dimts Imei Addition(<? echo getcountRow("SELECT * FROM dimts_imei where ((approve_status=0 or approve_status=1) and final_status!=1) and (service_comment is null or dimts_status=2) and (acc_manager='".$_SESSION['user_name']."' or (forward_req_user='".$_SESSION["user_name"]."' and (forward_back_comment is null or forward_back_comment='')))");?>)</a></li>   
            
         <li><a href="<?php echo __SITE_URL;?>/service_request/list_renew_dimts_imei.php" >Renew Dimts Imei Addition(<? echo getcountRow("SELECT * FROM renew_dimts_imei where (((approve_status=0 and (service_comment is null or renew_dimts_status=2)) or approve_status=1) and final_status!=1)  and (acc_manager='".$_SESSION['user_name']."' or (forward_req_user='".$_SESSION["user_name"]."' and (forward_back_comment is null or forward_back_comment='')))");?>)</a></li>
        
      <?}?>

    </ul>

 <? //if($_SESSION['BranchId']==1 && $_SESSION['username']=='triloki'){?>

            <!--<h3>Device Commands</h3>
           
                <ul class="nav">

                          <li><a href="<?php echo __SITE_URL;?>/repair/device_cmd.php" >Device Commands</a></li>
                 </ul>-->

    <? //} ?>

              

        <h3>Live Debug</h3>
   
            <ul class="nav">
   
                <li><a href="<?php echo __SITE_URL;?>/service_request/debug.php" >Debug</a></li>
       
                <li><a href="<?php echo __SITE_URL;?>/service_request/imeisearch.php" >Data BY IMEI</a></li>
       
                <li><a href="<?php echo __SITE_URL;?>/service_request/sendsms.php" >Send sms</a></li>
                
                <li><a href="<?php echo __SITE_URL;?>/service_request/billing.php" target="_blank">Billing</a></li>
   
            </ul>

 <? if($_SESSION['BranchId']==6 && $_SESSION['user_name'] == "asaleslogin"){ ?>
 
        <h3>Daily Branch Report</h3>
       
            <ul class="nav">
           
                    <li><a href="<?php echo __SITE_URL;?>/service_request/list_branch_account_report.php">Payment Reoprt </a></li>
                   
            </ul>
 <? } ?>  

         <? if($_SESSION['username']=='msaleslogin' or $_SESSION['username']=='saleslogin' or $_SESSION['username']=='asaleslogin' or $_SESSION['username']=='jsaleslogin' or $_SESSION['username']=='ksaleslogin')

        {?>

      <h3>Sales Request</h3>

            <ul class="nav">

                <li><a href="<?php echo __SITE_URL;?>/service_request/accountcreation.php?for=formatrequest" >New Account creation(<? echo getcountRow("SELECT * FROM new_account_creation where (approve_status=0 or (approve_status=1 and support_comment!='' and final_status!=1)) and (sales_comment is null or acc_creation_status=2) and (account_manager='".$_SESSION['user_name']."' or (forward_req_user='".$_SESSION["user_name"]."' and (forward_back_comment is null or forward_back_comment='')))");?>)</a></li>
               
                <li><a href="<?php echo __SITE_URL;?>/service_request/installation.php?for=formatrequest"> Installation Request(<? echo getcountRow("SELECT * FROM installation_request where (installation_status='1' or installation_status='2'  or installation_status='4' or installation_status='7' or installation_status='8' or installation_status='9') and branch_id=".$_SESSION['BranchId']."  and request_by='".$_SESSION['username']."'");?>)</a></li>
               
                <li><a   href="<?php echo __SITE_URL;?>/service_request/back_installation.php?for=formatrequest">Back to installation(<? echo getcountRow("SELECT * FROM installation   WHERE  installation_status='3' and branch_id=".$_SESSION['BranchId'] ."  and request_by='".$_SESSION['username']."'"); ?>)</a></li>      
                               
                <li><a href="<?php echo __SITE_URL;?>/service_request/running_installation.php?for=formatrequest">Running Installation(<? echo getcountRow("SELECT * FROM installation where installation_status IN ('1','2','11') AND (inter_branch='".$_SESSION['BranchId']."' OR branch_id='".$_SESSION['BranchId']."') and request_by='".$_SESSION['username']."'");?>)</a></li>
               
                <!--<li><a  href="add_installation.php">Add installation</a></li>-->

                <!--
               
                <li><a href="http://trackingexperts.com/service/servicecalling/closed_installations.php">Closed installation</a></li>
               
                <li><a href="http://trackingexperts.com/service/servicecalling/closed_services.php">Closed Services</a></li> -->
               
                <li><a href="<?php echo __SITE_URL;?>/sales_request/list_stop_gps.php">Stop Gps(<? echo getcountRow("SELECT * FROM stop_gps where (approve_status=0 or (approve_status=1 and support_comment!='' and final_status!=1)) and (sales_comment is null or stop_gps_status=2) and (acc_manager='".$_SESSION['user_name']."' or (forward_req_user='".$_SESSION["user_name"]."' and (forward_back_comment is null or forward_back_comment='')))");?>)</a></li>
               
                <li><a href="<?php echo __SITE_URL;?>/sales_request/list_start_gps.php">Start Gps(<? echo getcountRow("SELECT * FROM start_gps where (approve_status=0 or (approve_status=1 and support_comment!='' and final_status!=1)) and (sales_comment is null or start_gps_status=2) and (acc_manager='".$_SESSION['user_name']."' or (forward_req_user='".$_SESSION["user_name"]."' and (forward_back_comment is null or forward_back_comment='')))");?>)</a></li>
               
                <li><a href="<?php echo __SITE_URL;?>/sales_request/list_sub_user_creation.php">Sub User Creation(<? echo getcountRow("SELECT * FROM sub_user_creation  where (approve_status=0 or (approve_status=1 and support_comment!='' and final_status!=1)) and (sales_comment is null or sub_user_status=2) and (acc_manager='".$_SESSION['user_name']."' or (forward_req_user='".$_SESSION["user_name"]."' and (forward_back_comment is null or forward_back_comment='')))");?>)</a></li>
               
                <li><a href="<?php echo __SITE_URL;?>/sales_request/list_reactivate_of_account.php">Reactivation Of Account(<? echo getcountRow("SELECT * FROM reactivation_of_account where (approve_status=0 or (approve_status=1 and support_comment!='' and final_status!=1)) and (sales_comment is null or reactivation_status=2) and (acc_manager='".$_SESSION['user_name']."' or (forward_req_user='".$_SESSION["user_name"]."' and (forward_back_comment is null or forward_back_comment='')))");?>)</a></li>
               
                <li><a href="<?php echo __SITE_URL;?>/sales_request/list_deactivate_of_account.php">Deactivation Of Account(<? echo getcountRow("SELECT * FROM deactivation_of_account where (approve_status=0 or (approve_status=1 and support_comment!='' and final_status!=1)) and (sales_comment is null or deactivation_status=2)  and (acc_manager='".$_SESSION['user_name']."' or (forward_req_user='".$_SESSION["user_name"]."' and (forward_back_comment is null or forward_back_comment='')))");?>)</a></li>
               
                <!--<li><a href="<?php echo __SITE_URL;?>/sales_request/list_deletion_from_debtors.php">Delete From Debtors(<?echo getcountRow("SELECT * FROM del_form_debtors where (approve_status=0  and (sales_comment is null or del_debtors_status=2))  and (acc_manager='".$_SESSION['user_name']."' or (forward_req_user='".$_SESSION["user_name"]."' and (forward_back_comment is null or forward_back_comment='')))");?>)</a></li>-->
               
                <!--  <li><a href="search_km_alerts.php">KM Alert</a></li> -->
               
               
               
                <!--<li><a href="<?php echo __SITE_URL;?>/sales_request/list_no_bill.php">NO Bill(<?echo getcountRow("SELECT * FROM no_bills where (approve_status=0 or (approve_status=1 and support_comment!='' and final_status!=1)) and (sales_comment is null or no_bill_status=2) and (acc_manager='".$_SESSION['user_name']."' or (forward_req_user='".$_SESSION["user_name"]."' and (forward_back_comment is null or forward_back_comment='')))");?>)</a></li>-->
               
                <li><a href="<?php echo __SITE_URL;?>/sales_request/list_discounting.php">Discounting(<? echo getcountRow("SELECT * FROM discount_details where (((approve_status=0) or (approve_status=1 and support_comment!='')) and final_status!=1) and (sales_comment is null or discount_status=2) and (acc_manager='".$_SESSION['user_name']."' or (forward_req_user='".$_SESSION["user_name"]."' and (forward_back_comment is null or forward_back_comment='')))");?>)</a></li>
               
                <li><a href="<?php echo __SITE_URL;?>/sales_request/list_software_request.php">Software Request(<? echo getcountRow("SELECT * FROM software_request where (approve_status=0 or (approve_status=1 and support_comment!='' and final_status!=1)) and (sales_comment is null or software_status=2) and (acc_manager='".$_SESSION['user_name']."' or (forward_req_user='".$_SESSION["user_name"]."' and (forward_back_comment is null or forward_back_comment='')))");?>)</a></li>
               
                <li><a href="<?php echo __SITE_URL;?>/sales_request/list_transfer_the_vehicle.php">Transfer The Vehicle(<? echo getcountRow("SELECT * FROM transfer_the_vehicle  where (approve_status=0 or (approve_status=1 and support_comment!='' and final_status!=1)) and (sales_comment is null or transfer_veh_status=2) and (acc_manager='".$_SESSION['user_name']."' or (forward_req_user='".$_SESSION["user_name"]."' and (forward_back_comment is null or forward_back_comment='')))");?>)</a></li>

        </ul>

    </ul>

    <?}?>
   
   <?php if($_SESSION['username']=="msaleslogin" || $_SESSION['username']=="asaleslogin" || $_SESSION['username']=="jaipurrequest" || $_SESSION['username']=="ksaleslogin"){?>

<h3> Billing Details</h3>
<ul class="nav">
  <li ><a  class="home" href="<?php echo __SITE_URL;?>/service_request/list_billing_file.php">Billing File Download</a></li>
  
</ul>
<?php } 
   
    if(($_SESSION['user_name']=="saleslogin" || $_SESSION['user_name']=="triloki" ) && $_SESSION['isadmin']!=""){?>
    <h3>Login Report</h3>
        <ul class="nav">
            <li><a href="<?php echo __SITE_URL;?>/service_request/list_login_assign.php">Login Assign </a></li>
        </ul>
    <?php }
   
     if($_SESSION['BranchId']==3 && $_SESSION['username']=='jaipurrequest')

        {?>

          <!-- <h3>Sales Request</h3>

                <ul class="nav">   

    <li><a href="<?php echo __SITE_URL;?>/service_support/list_reactivate_of_account.php">Reactivation Of Account(<?echo getcountRow("SELECT * FROM reactivation_of_account where (approve_status=0 or (approve_status=1 and support_comment!='' and final_status!=1)) and (sales_comment is null or reactivation_status=2) and (acc_manager in ('khetraj','jaipursales') or (forward_req_user in ('khetraj','jaipursales') and (forward_back_comment is null or forward_back_comment='')))");?>)</a></li>

     <li><a href="<?php echo __SITE_URL;?>/service_support/list_deactivate_of_account.php">Deactivation Of Account(<?echo getcountRow("SELECT * FROM deactivation_of_account where (approve_status=0 or (approve_status=1 and support_comment!='' and final_status!=1)) and (sales_comment is null or deactivation_status=2)  and (acc_manager in ('khetraj','jaipursales') or (forward_req_user in ('khetraj','jaipursales') and (forward_back_comment is null or forward_back_comment='')))");?>)</a></li>

     <li><a href="<?php echo __SITE_URL;?>/service_support/list_deletion_from_debtors.php">Delete From Debtors(<?echo getcountRow("SELECT * FROM del_form_debtors where (approve_status=0  and (sales_comment is null or del_debtors_status=2))  and (acc_manager in ('khetraj','jaipursales') or (forward_req_user in ('khetraj','jaipursales') and (forward_back_comment is null or forward_back_comment='')))");?>)</a></li>-->

     <!-- <li><a href="search_km_alerts.php">KM Alert</a></li> -->

   

        <!--<li><a href="<?php echo __SITE_URL;?>/service_support/list_no_bill.php">NO Bill(<?echo getcountRow("SELECT * FROM no_bills where (approve_status=0 or (approve_status=1 and support_comment!='' and final_status!=1)) and (sales_comment is null or no_bill_status=2) and no_bill_issue='Service Issue' and (acc_manager in ('khetraj','jaipursales') or (forward_req_user in ('khetraj','jaipursales') and (forward_back_comment is null or forward_back_comment='')))");?>)</a></li>

      <li><a href="<?php echo __SITE_URL;?>/service_support/list_discounting.php">Discounting(<?echo getcountRow("SELECT * FROM discount_details where (approve_status=0 or (approve_status=1 and support_comment!='' and final_status!=1)) and (sales_comment is null or discount_status=2) and discount_issue='Service Issue' and (acc_manager in ('khetraj','jaipursales') or (forward_req_user in ('khetraj','jaipursales') and (forward_back_comment is null or forward_back_comment='')))");?>)</a></li>

             </ul>


    </ul>-->

    <? }
		}?>

</div>



             <div id="center-column">