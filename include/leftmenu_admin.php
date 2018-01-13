
        <div id="middle">
            <div id="left-column">
                <h3>Service Request</h3>
                <ul class="nav">
                      <!--<li><a href="list_device_change.php" > Device Change(<?echo getcountRow("SELECT * FROM device_change where (approve_status=0 or approve_status=2) and (admin_comment is null or service_comment!='') and (forward_req_user is null or forward_back_comment!='')");?>) </a></li>-->
                      
                      <li><a href="list_device_change.php" > Device Change(<? echo getcountRow("SELECT * FROM device_change where approve_status=0 and (admin_comment is null or (service_comment!='' or service_support_com!='')) and device_change_status=1 and (account_comment!='' or pay_status!='') and ((rdd_device_type!='New') or (rdd_device_type='New' and service_support_com!='')) and (forward_req_user is null or forward_back_comment!='')");?>) </a></li>
    
	 <!--<li><a href="list_new_device_addition.php">New Device Addition (<?echo getcountRow("SELECT * FROM new_device_addition where (final_status!=1) and (admin_comment is null or service_comment!='') and (forward_req_user is null or forward_back_comment!='')");?>) </a></li>-->
     
     <li><a href="list_new_device_addition.php">New Device Addition </a></li>
    
	<!-- <li><a href="list_vehicle_no_change.php">Vehicle Number Change(<?echo getcountRow(" SELECT * FROM vehicle_no_change  where (approve_status=0 or approve_status=2) and (admin_comment is null or service_comment!='') and (forward_req_user is null or forward_back_comment!='')");?>) </a></li>-->
     <li><a href="list_vehicle_no_change.php">Vehicle Number Change(<? echo getcountRow(" SELECT * FROM vehicle_no_change  where  approve_status=0 and (admin_comment is null or service_comment!='') and vehicle_status=1 and (account_comment!='' or payment_status!='') and (forward_req_user is null or forward_back_comment!='')");?>) </a></li>
	 
     <!--<li><a href="list_sim_change.php">Sim Change(<?echo getcountRow("SELECT * FROM sim_change where (approve_status=0 or approve_status=2) and (account_comment!='') and (admin_comment is null or service_comment!='') and (forward_req_user is null or forward_back_comment!='')");?>) </a></li>-->
    
    <li><a href="list_sim_change.php">Sim Change </a></li>
   
	 <!--<li><a href="list_device_lost.php">Device Lost(<?echo getcountRow("SELECT * FROM device_lost where approve_status=0  and (account_comment!='' or odd_paid_unpaid!='') and (admin_comment is null or service_comment!='') and device_lost_status=1 and (forward_req_user is null or forward_back_comment!='')");?>) </a></li>-->
    
	 <!--<li><a href="list_delete_vehicle.php">Delete Vehicle(<?echo getcountRow(" SELECT * FROM deletion where  (approve_status=0 or approve_status=2  )   and (account_comment!='' or odd_paid_unpaid!='') and (admin_comment is   null or admin_comment='' ) and (forward_req_user is  null or forward_back_comment is null) and (service_comment!='' or forward_comment is null)  ");?>)</a></li>-->
     
      <li><a href="list_delete_vehicle.php">Delete Vehicle(<? echo getcountRow(" SELECT * FROM deletion where  approve_status=0 and (account_comment!='' or odd_paid_unpaid!='') and (admin_comment is null or service_comment!='') and delete_veh_status=1 and (forward_req_user is null or forward_back_comment!='')");?>)</a></li>
         
	       <!--<li><a href="list_deactivate_sim.php">Deactivate Sim(<?echo getcountRow("SELECT * FROM deactivate_sim where (approve_status=0 or approve_status=2) and (account_comment!='') and (admin_comment is null or service_comment!='') and (forward_req_user is null or forward_back_comment!='')");?>)</a></li>-->  
           
           <li><a href="list_deactivate_sim.php">Deactivate Sim</a></li>
    
	  <li><a href="list_dimts_imei.php">Dimts Slip (<? echo getcountRow("SELECT * FROM dimts_imei where approve_status=0 and (payment_status!='') and (admin_comment is null or service_comment!='') and dimts_status=1 and (forward_req_user is null or forward_back_comment!='')");?>)</a></li>  
      
      <li><a href="list_renew_dimts_imei.php">Renew Dimts Slip (<? echo getcountRow("SELECT * FROM renew_dimts_imei where approve_status=0 and (payment_status!='') and (admin_comment is null or service_comment!='') and renew_dimts_status=1 and (forward_req_user is null or forward_back_comment!='')");?>)</a></li> 
      
</ul>
 <h3>Sales Request</h3>
<ul class="nav">
                      
     <li><a href="accountcreation.php" >New Account Creation(<? echo getcountRow("SELECT * FROM new_account_creation where approve_status=0 and (admin_comment is null or sales_comment!='') and acc_creation_status=1 and (forward_req_user is null or forward_back_comment!='')");?>)</a></li>
     
     <li><a href="list_installation.php" >Installation(<? echo getcountRow("SELECT * FROM installation_request where installation_status=8 and approve_status=0 and (admin_comment is null or sales_comment!='')");?>)</a></li>
					   
    <li><a href="list_stop_gps.php">Stop Gps(<? echo getcountRow("  SELECT * FROM stop_gps  where approve_status=0 and (account_comment!='' or total_pending!='') and stop_gps_status=1 and (admin_comment is null or sales_comment!='') and (forward_req_user is null or forward_back_comment!='')");?>) </a></li>

    <li><a href="list_start_gps.php">Start Gps(<? echo getcountRow("  SELECT * FROM start_gps  where approve_status=0 and (account_comment!='' or total_pending!='') and start_gps_status=1 and (admin_comment is null or sales_comment!='') and (forward_req_user is null or forward_back_comment!='')");?>) </a></li>
	
     <li><a href="list_sub_user_creation.php">Sub User Creation(<? echo getcountRow(" SELECT * FROM sub_user_creation where approve_status=0 and (admin_comment is null or sales_comment!='') and sub_user_status=1 and (forward_req_user is null or forward_back_comment!='')");?>) </a></li>
    
	 <li><a href="list_reactivate_of_account.php">Reactivation Of Account(<? echo getcountRow("SELECT * FROM reactivation_of_account where approve_status=0 and (account_comment!='' or pay_pending!='') and (admin_comment is null or sales_comment!='') and reactivation_status=1 and (forward_req_user is null or forward_back_comment!='') and (service_comment!='' or service_comment is null)");?>) </a></li>

	 <li><a href="list_deactivate_of_account.php">Deactivation Of Account(<? echo getcountRow("SELECT * FROM deactivation_of_account where approve_status=0 and (account_comment!='' or pay_pending!='') and (admin_comment is null or sales_comment!='') and deactivation_status=1 and (forward_req_user is null or forward_back_comment!='') and (service_comment!='' or service_comment is null)");?>) </a></li>
    
	 <li><a href="list_client_debtor.php">Client Debtors </a></li>
     
     <!--<li><a href="list_deletion_from_debtors.php">Delete From Debtors(<?echo getcountRow("SELECT * FROM del_form_debtors  where approve_status=0 and (account_comment!='' or total_pending!='') and del_debtors_status=1 and (admin_comment is null or sales_comment!='' ) and (forward_req_user is null or forward_back_comment!='')");?>) </a></li>-->
    <!--  <li><a href="search_km_alerts.php">KM Alert</a></li> -->
    
        <!--<li><a href="list_no_bill.php">NO Bill(<?echo getcountRow("SELECT * FROM no_bills  where approve_status=0 and (account_comment!='' or total_pending!='') and (admin_comment is null or sales_comment!='') and no_bill_status=1 and (forward_req_user is null or forward_back_comment!='')");?>)</a></li> -->
    
	  <li><a href="list_discounting.php">Discounting(<? echo getcountRow("SELECT * FROM discount_details  where approve_status=0  and (account_comment!='' or total_pending!='') and (admin_comment is null or sales_comment!='') and discount_status=1 and (forward_req_user is null or forward_back_comment!='')");?>)</a></li> 
    
	 <li><a href="list_software_request.php">Software Request(<? echo getcountRow("SELECT * FROM software_request where approve_status=0  and (admin_comment is null or sales_comment!='') and software_status=1 and (forward_req_user is null or forward_back_comment!='')");?>) </a></li>
	
	 <li><a href="list_transfer_the_vehicle.php">Transfer The Vehicle(<? echo getcountRow("SELECT * FROM transfer_the_vehicle where approve_status=0 and (account_comment!='' or total_pending!='') and (admin_comment is null or sales_comment!='') and transfer_veh_status=1 and (forward_req_user is null or forward_back_comment!='')");?>)</a></li>
                </ul>
                
              <h3>Process</h3>
                <ul class="nav">
                    <li><a href="accountcreation_request.php" >New Account Request(<? echo getcountRow("SELECT * FROM new_account_creation where (approve_status=0 or (approve_status=1 and support_comment!='' and final_status!=1)) and (sales_comment is null or acc_creation_status=2) and (account_manager='".$_SESSION['user_name']."')");?>)</a></li>
                    
                    <li><a href="list_rdconversion.php">R & D Conversation(<? echo getcountRow("SELECT * FROM ad_rd_conversion where status in ('1','2') and close_status=0");?>)</a></li>
					                    
                	<li><a href="list_add_sse.php">Create SSE Login</a></li>
                </ul>
            </div>

			 <div id="center-column">
               
          