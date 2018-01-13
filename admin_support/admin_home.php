<?php
include("../connection.php");
include_once(__DOCUMENT_ROOT.'/include/header_admin_home.php');

/*include($_SERVER['DOCUMENT_ROOT']."/format/include/header_admin_home.php");*/
 ?> 
 <style>
#left-column {
	float:left;
	padding:1px 13px 0 12px;
	width:230px;
	}
 </style>
 <div class="top-bar1">
<h1> </h1>
</div>
<div  > 
 
<table>
<tr><td><div id="left-column">
               <a href="accountcreation.php" style="text-decoration:none"> <h3>New Account Creation(<? echo getcountRow("SELECT * FROM new_account_creation where approve_status=0 and branch_id!=1 and (admin_comment is null or sales_comment!='') and acc_creation_status=1 and (forward_req_user is null or forward_back_comment!='')");?>) <font color="#606060">  </font>
</h3></a>
       </div></td>
	     <td><div id="left-column">
               <a href="list_new_device_addition.php" style="text-decoration:none"> <h3> New device Addition </h3></a>
       </div></td>
	   
	  <td><div id="left-column">
              <a href="list_reactivate_of_account.php" style="text-decoration:none"> <h3> Reactivation Of Account(<? echo getcountRow("SELECT * FROM reactivation_of_account where (approve_status=0 or approve_status=2) and (account_comment!='' or pay_pending!='') and (admin_comment is null or sales_comment!='') and (forward_req_user is null or forward_back_comment!='') and acc_manager IN ('pankaj','jaipurrequest','asaleslogin','ksaleslogin','msaleslogin','jsaleslogin','sanjeeb','jaipursales') and (service_comment!='' or service_comment is null)");?>) </h3></a>
               <!--<a href="list_no_bill.php" style="text-decoration:none"> <h3> No Bills(<?echo getcountRow("SELECT * FROM no_bills  where (approve_status=0 or approve_status=2) and (account_comment!='' or total_pending!='') and (admin_comment is null or admin_comment='') and (forward_req_user is null or forward_back_comment!='')");?>) </h3></a>-->
       </div></td>
	    <td><div id="left-column">
               <!--<a href="list_vehicle_no_change.php" style="text-decoration:none"> <h3> Vehicle No. Change(<?echo getcountRow(" SELECT * FROM vehicle_no_change  where (approve_status=0 or approve_status=2) and (admin_comment is null or service_comment!='') and (forward_req_user is null or forward_back_comment!='')");?>) 
</h3></a>-->
<a href="list_vehicle_no_change.php" style="text-decoration:none"> <h3> Vehicle No. Change(<? echo getcountRow(" SELECT * FROM vehicle_no_change where approve_status=0 and (admin_comment is null or service_comment!='') and acc_manager!='triloki' and vehicle_status=1 and (account_comment!='' or payment_status!='') and (forward_req_user is null or forward_back_comment!='')");?>) 
</h3></a>
       </div></td>
	   <td>&nbsp;</td></tr>
       <tr><td colspan="4">&nbsp;</td></tr> 
       <tr>
	    <td><div id="left-column">
               <a href="list_delete_vehicle.php" style="text-decoration:none"> <h3>Delete Vehicle(<? echo getcountRow(" SELECT * FROM deletion where approve_status=0 and acc_manager IN ('pankaj','jaipurrequest','asaleslogin','ksaleslogin','msaleslogin','jsaleslogin') and (account_comment!='' or odd_paid_unpaid!='') and (admin_comment is null or service_comment!='') and delete_veh_status=1 and (forward_req_user is null or forward_back_comment!='')");?>) </h3></a>
       </div></td> 
	   <td><div id="left-column">
               <a href="list_deactivate_of_account.php" style="text-decoration:none"> <h3>Deactivation of account(<? echo getcountRow("SELECT * FROM deactivation_of_account where approve_status=0 and (account_comment!='' or pay_pending!='') and (admin_comment is null or sales_comment!='') and deactivation_status=1 and (forward_req_user is null or forward_back_comment!='') and acc_manager IN ('pankaj','jaipurrequest','asaleslogin','ksaleslogin','msaleslogin','jsaleslogin','sanjeeb','jaipursales') and (service_comment!='' or service_comment is null)");?>) </h3></a>
       </div></td>
	   <td><div id="left-column">
               <a href="list_start_gps.php" style="text-decoration:none"> <h3> Start Gps(<? echo getcountRow("  SELECT * FROM start_gps  where approve_status=0 and acc_manager IN ('pankaj','jaipurrequest','asaleslogin','ksaleslogin','msaleslogin','jsaleslogin','sanjeeb') and (account_comment!='' or total_pending!='') and start_gps_status=1 and (admin_comment is null or sales_comment!='') and (forward_req_user is null or forward_back_comment!='')");?>)
</h3></a>
       </div></td>
	   
	   <td><div id="left-column">
               <a href="list_transfer_the_vehicle.php" style="text-decoration:none"> <h3>Transfer the vehicle (<? echo getcountRow("SELECT * FROM transfer_the_vehicle where approve_status=0 and (account_comment!='' or total_pending!='') and (admin_comment is null or sales_comment!='') and transfer_veh_status=1 and (forward_req_user is null or forward_back_comment!='') and acc_manager IN ('pankaj','jaipurrequest','asaleslogin','ksaleslogin','msaleslogin','jsaleslogin','sanjeeb','jaipursales','khetraj')");?>)</h3></a>
       </div></td>
	   
	   </tr>

 
    <tr><td colspan="4">&nbsp;</td></tr>  
    
   
       <tr>
	   <td><div id="left-column">
               <a href="list_discounting.php" style="text-decoration:none"> <h3> Discounting(<? echo getcountRow("SELECT * FROM discount_details  where approve_status=0  and (account_comment!='' or total_pending!='') and (admin_comment is null or sales_comment!='') and discount_status=1 and (forward_req_user is null or forward_back_comment!='') and acc_manager IN ('pankaj','jaipurrequest','asaleslogin','ksaleslogin','msaleslogin','jsaleslogin','sanjeeb','jaipursales','khetraj')");?>) </h3></a>
       </div></td><td><div id="left-column">
               <!--<a href="list_device_change.php" style="text-decoration:none"> <h3> Device Change(<?echo getcountRow("SELECT * FROM device_change where (approve_status=0 or approve_status=2) and (admin_comment is null or service_comment!='') and (forward_req_user is null or forward_back_comment!='')");?>)</h3></a>-->
               <a href="list_device_change.php" style="text-decoration:none"> <h3> Device Change(<? echo getcountRow("SELECT * FROM device_change where approve_status=0 and acc_manager!='triloki' and (admin_comment is null or (service_comment!='' or service_support_com!='')) and device_change_status=1 and (account_comment!='' or pay_status!='') and ((rdd_device_type!='New') or (rdd_device_type='New' and service_support_com!='')) and (forward_req_user is null or forward_back_comment!='')");?>)</h3></a>
       </div></td><td><div id="left-column">
               <a href="list_dimts_imei.php" style="text-decoration:none"> <h3>Dimts Slip(<? echo getcountRow("SELECT * FROM dimts_imei where approve_status=0 and acc_manager!='triloki' and (payment_status!='') and (admin_comment is null or service_comment!='') and dimts_status=1 and (forward_req_user is null or forward_back_comment!='')");?>) </h3></a>
       </div></td>
	   <td><div id="left-column">
               <a href="list_stop_gps.php" style="text-decoration:none"> <h3>Stop GPS(<? echo getcountRow("  SELECT * FROM stop_gps   where approve_status=0 and acc_manager IN ('pankaj','jaipurrequest','asaleslogin','ksaleslogin','msaleslogin','jsaleslogin','sanjeeb') and (account_comment!='' or total_pending!='') and stop_gps_status=1 and (admin_comment is null or sales_comment!='') and (forward_req_user is null or forward_back_comment!='')");?>)
</h3></a>
       </div></td>
	   <td>&nbsp;</td></tr>
    
     <tr><td colspan="4">&nbsp;</td></tr>  
   
     

       <tr>
	  <td><div id="left-column">
              <a href="list_installation.php" style="text-decoration:none"> <h3>New Installation(<? echo getcountRow("SELECT * FROM installation_request where installation_status=8 and approve_status=0 and branch_id!=1 and inter_branch=0 and (admin_comment is null or sales_comment!='')");?>)  </h3></a>
               
       </div></td>
	   
	   <td><div id="left-column">
               <a href="list_sim_change.php" style="text-decoration:none"> <h3>  SIM Change </h3></a>
       </div></td>
	   <td><div id="left-column">
               <a href="list_sub_user_creation.php" style="text-decoration:none"> <h3> Sub User Creation(<? echo getcountRow(" SELECT * FROM sub_user_creation where approve_status=0 and (admin_comment is null or sales_comment!='') and acc_manager IN ('pankaj','jaipurrequest','asaleslogin','ksaleslogin','msaleslogin','jsaleslogin','sanjeeb','jaipursales') and sub_user_status=1 and (forward_req_user is null or forward_back_comment!='')");?>)
</h3></a>
       </div></td>
	  <td><div id="left-column">
               <a href="list_software_request.php" style="text-decoration:none"> <h3>Software Request(<? echo getcountRow("SELECT * FROM software_request where approve_status=0  and (admin_comment is null or sales_comment!='') and software_status=1 and acc_manager IN ('pankaj','jaipurrequest','asaleslogin','ksaleslogin','msaleslogin','jsaleslogin','sanjeeb','jaipursales','khetraj') and (forward_req_user is null or forward_back_comment!='')");?>)  </h3></a>
       </div></td>
	   
	
	   <td width="300px">&nbsp;</td></tr>
    
	<tr><td colspan="4">&nbsp;</td></tr>  
   
</table>


 
               
</div>
<?php
include("../include/footer.php"); ?>



