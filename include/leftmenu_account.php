<? $username=$_SESSION['username'];?>
        <div id="middle">
            <div id="left-column">
                <h3>Service Request</h3>
                <ul class="nav">
				 <li><a href="accountcreation.php">New Account creation</a></li> 
                 
               	 <li><a href="list_new_device_addition.php">New Device Addition</a></li> 
                 
     <!--<li><a href="list_sim_change.php">Sim Change(<?echo getcountRow("SELECT * FROM sim_change where (approve_status=0 and final_status!=1 and account_comment is null) or (forward_back_comment is null and forward_req_user='".$_SESSION["user_name"]."')");?>)</a></li>-->
     
     <!--<li><a href="list_sim_change.php">Sim Change(<?echo getcountRow("SELECT * FROM sim_change where (approve_status=1 and final_status!=1 and account_comment is null) or (forward_back_comment is null and forward_req_user='".$_SESSION["user_name"]."')");?>)</a></li>-->
     
    <!--  <li><a href="search_km_alerts.php">KM Alert</a></li> -->
    
     <!--<li><a href="list_device_lost.php">Device Lost(<?echo getcountRow("SELECT * FROM device_lost where (approve_status=0 and final_status!=1 and odd_paid_unpaid is null and account_comment is null) or (forward_req_user='".$_SESSION["user_name"]."' and (forward_back_comment is null or forward_back_comment=''))");?>)</a></li>-->
	 
	 <!--<li><a href="list_veh_no_change.php">Vehicle No Change(<?echo getcountRow("SELECT * FROM vehicle_no_change where (approve_status=0 and final_status!=1 and payment_status is null and account_comment is null) or (forward_back_comment is null and forward_req_user='".$_SESSION["user_name"]."')");?>)</a></li>-->
     
     <li><a href="list_veh_no_change.php">Vehicle No Change(<? echo getcountRow("SELECT * FROM vehicle_no_change where (approve_status=0 and final_status!=1 and payment_status is null and account_comment is null) and (reason not IN('Temperory no to Permanent no','Personal no to Commercial no','Commercial no to Personal no','For Warranty Renuwal Purpose','Device of deleted vehicle (DIMTS PURPOSE)​ installed')) or (forward_req_user='".$_SESSION["user_name"]."' and (forward_back_comment is null or forward_back_comment=''))");?>)</a></li>
	
	 <li><a href="list_device_change.php">Device Change(<? echo getcountRow("SELECT * FROM device_change where (approve_status=0 and final_status!=1 and pay_status is null and account_comment is null and rdd_reason!='') or (forward_req_user='".$_SESSION["user_name"]."' and (forward_back_comment is null or forward_back_comment=''))");?>)</a></li>
     
	 <!--<li><a href="list_delete_vehicle.php">Delete Vehicle(<?echo getcountRow("SELECT * FROM deletion where (approve_status=0 and final_status!=1 and odd_paid_unpaid is null and account_comment is null) and (vehicle_location!='gtrack office' or stock_comment!='') or (forward_back_comment is null and forward_req_user='".$_SESSION["user_name"]."')");?>)</a></li> -->
     
     <li><a href="list_delete_vehicle.php">Delete Vehicle(<? echo getcountRow("SELECT * FROM deletion where (approve_status=0 and final_status!=1) and (vehicle_location!='gtrack office' or stock_comment!='') and (odd_paid_unpaid is null and account_comment is null)  or (forward_req_user='".$_SESSION["user_name"]."' and (forward_back_comment is null or forward_back_comment=''))");?>)</a></li>
	 
	 <!--<li><a href="list_deactivate_sim.php">Deactivate Sim(<?echo getcountRow("SELECT * FROM deactivate_sim where (approve_status=0 and final_status!=1 and account_comment is null) or (forward_back_comment is null and forward_req_user='".$_SESSION["user_name"]."')");?>)</a></li>-->
     
     <li><a href="list_deactivate_sim.php">Deactivate Sim(<? echo getcountRow("SELECT * FROM deactivate_sim where ((approve_status=0 or approve_status=1) and final_status!=1 and close_date is null and account_comment is null) or (forward_req_user='".$_SESSION["user_name"]."' and (forward_back_comment is null or forward_back_comment=''))");?>)</a></li>
	 
	 <li><a href="list_dimts_imei.php">Dimts Payment(<? echo getcountRow("SELECT * FROM dimts_imei where (account_comment IS NULL and payment_status IS NULL) or (forward_req_user='".$_SESSION["user_name"]."' and (forward_back_comment is null or forward_back_comment=''))");?>)</a></li> 
     
     <li><a href="list_renew_dimts_imei.php">Renew Dimts(<? echo getcountRow("SELECT * FROM renew_dimts_imei where (account_comment IS NULL and payment_status IS NULL) or (forward_req_user='".$_SESSION["user_name"]."' and (forward_back_comment is null or forward_back_comment=''))");?>)</a></li> 
     
	  <li><a href="airtelbilling.php">Airtel Billing</a></li> 
	
	 <li><a href="client_doc.php">Client Documents</a></li> 
     
   </ul>
        
		<?php if($username == "praveen"){?>         
                
                <h3>Billing Details</h3>
                <ul class="nav">
					         
                        <li><a href="list_billing_process.php">Bill Update</a></li>
                        
                        <li><a href="list_rent_bill.php">Rent Bill</a></li>
                        
                        <li><a href="billing.php" target="_blank">Billing</a></li>
                                                                    
                </ul>
                
                <h3>Stop Client Billing</h3>
                <ul class="nav">
					         
                        <li><a href="list_deactivate_of_users.php">Users Account List</a></li>
                        
						  <!--<li><a href="bill_file_uplode.php">Billing File Upload</a></li> -->
                                            
                </ul>
                
                
                <h3>Live Debug</h3>

                <ul class="nav">
        
                    <li><a href="debug.php" >Debug</a></li> 
            
                   <!-- <li><a href="imeisearch.php" >Data BY IMEI</a></li> -->

					<li><a href="client_profile.php" >Client Profile</a></li>
                    
                </ul>
           <?php }?>        
                
                
                 <h3>Sales Request</h3>
                <ul class="nav">

        <li><a href="list_deactivate_of_account.php">Deactivation Of Account(<? echo getcountRow("SELECT * FROM deactivation_of_account where (approve_status=0 and final_status!=1 and pay_pending is null and account_comment is null) and (device_remove_status='N' or no_device_removed!='') or (forward_req_user='".$_SESSION["user_name"]."' and (forward_back_comment is null or forward_back_comment=''))");?>)</a></li>
       
	    <li><a href="list_client_debtor.php">Client Debtors</a></li> 
        
        <li><a href="list_recd_collection.php">Payment Received(<? echo getcountRow("SELECT * FROM collection_received_billing where is_status='1' and is_active='1'");?>)</a></li>
        
        <li><a href="list_reactivate_of_account.php">Reactivation Of Account(<? echo getcountRow("SELECT * FROM reactivation_of_account where (approve_status=0 and final_status!=1 and pay_pending is null and account_comment is null) or (forward_req_user='".$_SESSION["user_name"]."' and (forward_back_comment is null or forward_back_comment=''))");?>)</a></li>
        
        <!--<li><a href="list_deletion_from_debtors.php">Delete From Debtors(<?echo getcountRow("SELECT * FROM del_form_debtors  where ((approve_status=0 and final_status!=1 and total_pending is null and account_comment is null) or (approve_status=1 and final_status!=1 and support_comment is null)) and (device_remove_status='N' or no_device_removed!='') or (forward_req_user='".$_SESSION["user_name"]."' and (forward_back_comment is null or forward_back_comment=''))");?>)</a></li> 
       
	    <li><a href="list_no_bill.php">No Bill(<?echo getcountRow("SELECT * FROM no_bills where (((approve_status=0 and (no_bill_issue IN('Cracked Device','Device On Demo') or service_comment!='' or software_comment!='') and total_pending is null and account_comment is null) or approve_status=1) and final_status!=1 ) or (forward_req_user='".$_SESSION["user_name"]."' and (forward_back_comment is null or forward_back_comment=''))");?>)</a></li> -->
       
	    <li><a href="list_discounting.php">Discounting(<? echo getcountRow("SELECT * FROM discount_details where (((approve_status=0 and (discount_issue IN('Device On Demo','Account Issue','Client Side Issue') or service_comment!='' or repair_comment!='' or software_comment!='') and total_pending is null and account_comment is null) or approve_status=1) and final_status!=1 ) or (forward_req_user='".$_SESSION["user_name"]."' and (forward_back_comment is null or forward_back_comment=''))");?>)</a></li>  
        
		<li><a href="list_stop_gps.php">Stop Gps(<? echo getcountRow("SELECT * FROM stop_gps where (approve_status=0 and final_status!=1 and total_pending is null and account_comment is null) or (forward_req_user='".$_SESSION["user_name"]."' and (forward_back_comment is null or forward_back_comment=''))");?>)</a></li>
		  
		<li><a href="list_start_gps.php">Start Gps(<? echo getcountRow("SELECT * FROM start_gps where (approve_status=0 and final_status!=1 and total_pending is null and account_comment is null) or (forward_req_user='".$_SESSION["user_name"]."' and (forward_back_comment is null or forward_back_comment=''))");?>)</a></li>
        
        <li><a href="list_transfer_the_vehicle.php">Transfer The Vehicle(<? echo getcountRow("SELECT * FROM transfer_the_vehicle where (approve_status=0 and final_status!=1 and total_pending is null and account_comment is null) or (forward_req_user='".$_SESSION["user_name"]."' and (forward_back_comment is null or forward_back_comment=''))");?>)</a></li>
			    </ul>
            </div>

			 <div id="center-column">
               
          