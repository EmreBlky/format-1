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
	<tr>
		<td><div id="left-column">
				<a href="list_device_lost.php" style="text-decoration:none"> <h3>Device Lost(<? echo getcountRow("SELECT * FROM device_lost where (approve_status=0 and final_status!=1 and odd_paid_unpaid is null and account_comment is null) or (forward_req_user='".$_SESSION["user_name"]."' and (forward_back_comment is null or forward_back_comment=''))");?>)<font color="#606060">  </font></h3></a>
              
       </div></td>
	     <td><div id="left-column">
               <a href="list_veh_no_change.php" style="text-decoration:none"> <h3> Vehicle No Change(<? echo getcountRow("SELECT * FROM vehicle_no_change where (approve_status=0 and final_status!=1 and payment_status is null and account_comment is null) and (reason not IN('Temperory no to Permanent no','Personal no to Commercial no','Commercial no to Personal no','For Warranty Renuwal Purpose','device of deleted vehicle (DIMTS PURPOSE)​ installed')) or (forward_req_user='".$_SESSION["user_name"]."' and (forward_back_comment is null or forward_back_comment=''))");?>)</h3></a>
       </div></td>
	   
	  <td><div id="left-column">
             <a href="list_device_change.php" style="text-decoration:none"> <h3> Device Change(<? echo getcountRow("SELECT * FROM device_change where (approve_status=0 and final_status!=1 and pay_status is null and account_comment is null and rdd_reason!='') or (forward_req_user='".$_SESSION["user_name"]."' and (forward_back_comment is null or forward_back_comment=''))");?>)</h3></a>
       </div></td>
	    <td><div id="left-column">
            <a href="list_delete_vehicle.php" style="text-decoration:none"> <h3> Delete Vehicle(<? echo getcountRow("SELECT * FROM deletion where (approve_status=0 and final_status!=1) and (vehicle_location!='gtrack office' or stock_comment!='') and (odd_paid_unpaid is null and account_comment is null)  or (forward_req_user='".$_SESSION["user_name"]."' and (forward_back_comment is null or forward_back_comment=''))");?>)</h3></a>
       </div></td>
	   <td>&nbsp;</td>
  </tr>
  <tr><td colspan="4">&nbsp;</td></tr> 
  <tr>
	    <td><div id="left-column">
               <a href="list_deactivate_sim.php" style="text-decoration:none"> <h3> Deactivate Sim(<? echo getcountRow("SELECT * FROM deactivate_sim where ((approve_status=0 or approve_status=1) and final_status!=1 and close_date is null and account_comment is null) or (forward_req_user='".$_SESSION["user_name"]."' and (forward_back_comment is null or forward_back_comment=''))");?>)</h3></a>
       </div></td> 
	   <td><div id="left-column">
               <a href="list_dimts_imei.php" style="text-decoration:none"> <h3> Dimts Payment(<? echo getcountRow("SELECT * FROM dimts_imei where (account_comment IS NULL and payment_status IS NULL) or (forward_req_user='".$_SESSION["user_name"]."' and (forward_back_comment is null or forward_back_comment=''))");?>) </h3></a>
       </div></td>
	   <td><div id="left-column">
               <a href="list_deactivate_of_account.php" style="text-decoration:none"> <h3> Deactivation Of Account(<? echo getcountRow("SELECT * FROM deactivation_of_account where (approve_status=0 and final_status!=1 and pay_pending is null and account_comment is null) and (device_remove_status='N' or no_device_removed!='') or (forward_req_user='".$_SESSION["user_name"]."' and (forward_back_comment is null or forward_back_comment=''))");?>)</h3></a>
       </div></td>
	   <td><div id="left-column">
               <a href="list_reactivate_of_account.php" style="text-decoration:none"> <h3> Reactivation Of Account(<? echo getcountRow("SELECT * FROM reactivation_of_account where (approve_status=0 and final_status!=1 and pay_pending is null and account_comment is null) or (forward_req_user='".$_SESSION["user_name"]."' and (forward_back_comment is null or forward_back_comment=''))");?>)</h3></a>
       </div></td>
	   
  </tr>
 
      
   <tr><td colspan="4">&nbsp;</td></tr>  
   
       <tr>
	  <td><div id="left-column">
             <a href="list_transfer_the_vehicle.php" style="text-decoration:none"> <h3> Transfer The Vehicle(<? echo getcountRow("SELECT * FROM transfer_the_vehicle where (approve_status=0 and final_status!=1 and total_pending is null and account_comment is null) or (forward_req_user='".$_SESSION["user_name"]."' and (forward_back_comment is null or forward_back_comment=''))");?>)</h3></a>
       </div></td>
	   
	   <td><div id="left-column">
               <a href="accountcreation.php" style="text-decoration:none"> <h3> New Account creation</h3></a>
       </div></td>
	   <td><div id="left-column">
               <a href="list_new_device_addition.php" style="text-decoration:none"> <h3> New Device Addition</h3></a>
       </div></td>
	  <td><div id="left-column">
               <a href="list_start_gps.php" style="text-decoration:none"> <h3> Start Gps(<? echo getcountRow("SELECT * FROM start_gps where (approve_status=0 and final_status!=1 and total_pending is null and account_comment is null) or (forward_req_user='".$_SESSION["user_name"]."' and (forward_back_comment is null or forward_back_comment=''))");?>)</h3></a>
       </div></td>
	   
	   <td width="300px">&nbsp;</td>
	   </tr>

	   <tr><td colspan="4">&nbsp;</td></tr>  
   
   <tr>
	   <!--<td><div id="left-column">
               <a href="list_deletion_from_debtors.php" style="text-decoration:none"> <h3> Delete From Debtors(<?echo getcountRow("SELECT * FROM del_form_debtors  where ((approve_status=0 and final_status!=1 and total_pending is null and account_comment is null) or (approve_status=1 and final_status!=1 and support_comment is null)) and (device_remove_status='N' or no_device_removed!='') or (forward_req_user='".$_SESSION["user_name"]."' and (forward_back_comment is null or forward_back_comment=''))");?>)</h3></a>
       </div></td>
       <td><div id="left-column">
				<a href="list_no_bill.php" style="text-decoration:none"> <h3> No Bill(<?echo getcountRow("SELECT * FROM no_bills where (((approve_status=0 and (no_bill_issue IN('Cracked Device','Device On Demo') or service_comment!='' or software_comment!='') and total_pending is null and account_comment is null) or approve_status=1) and final_status!=1 ) or (forward_req_user='".$_SESSION["user_name"]."' and (forward_back_comment is null or forward_back_comment=''))");?>)</h3></a>
       </div></td>-->
       <td><div id="left-column">
           		<a href="list_discounting.php" style="text-decoration:none"> <h3> Discounting(<? echo getcountRow("SELECT * FROM discount_details where (((approve_status=0 and (discount_issue IN('Device On Demo','Account Issue','Client Side Issue') or service_comment!='' or repair_comment!='' or software_comment!='') and total_pending is null and account_comment is null) or approve_status=1) and final_status!=1 ) or (forward_req_user='".$_SESSION["user_name"]."' and (forward_back_comment is null or forward_back_comment=''))");?>) </h3></a>
       </div></td>
	   <td><div id="left-column">
              <a href="list_stop_gps.php" style="text-decoration:none"> <h3> Stop Gps(<? echo getcountRow("SELECT * FROM stop_gps where (approve_status=0 and final_status!=1 and total_pending is null and account_comment is null) or (forward_req_user='".$_SESSION["user_name"]."' and (forward_back_comment is null or forward_back_comment=''))");?>)</h3></a>
       </div></td>
	  
      <td><div id="left-column">
               <a href="list_client_debtor.php" style="text-decoration:none"> <h3>Client Debtors </h3></a>
       </div></td>
      
       <td>&nbsp;</td>
   </tr>
    
</table>

               
</div>
<?php
include("../include/footer.php"); ?>

