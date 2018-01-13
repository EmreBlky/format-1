<? 	$sales = select_query("select id from sales_person where name='".$_SESSION['user_name']."' "); ?>

        <div id="middle">
            <div id="left-column">
			  
              <h3>Live Debug</h3>
                <ul class="nav">
       
                    <li><a href="debug.php" >Debug</a></li>
                    
                    <li><a href="billing.php" target="_blank" >Billing</a></li>
                 
                </ul>
              
              <h3>Sale Request</h3>
                <ul class="nav">
                    <li><a href="accountcreation.php" >Account Creation(<? echo getcountRow("SELECT * FROM new_account_creation where (approve_status=0 or (approve_status=1 and support_comment!='' and final_status!=1)) and (sales_comment is null or acc_creation_status=2) and ((account_manager='".$_SESSION['user_name']."' or sales_manager='".$_SESSION['user_name']."') or (forward_req_user='".$_SESSION["user_name"]."' and (forward_back_comment is null or forward_back_comment='')))");?>)</a></li>
                    
                    <li><a href="list_new_installation.php" >New Installation(<? echo getcountRow("SELECT * FROM installation_request where ((installation_status=1 or installation_status=2 or installation_status=7 or installation_status=8 or installation_status=9) or (admin_comment!='' and sales_comment is null)) and sales_person='".$sales[0]['id']."'");?>)</a></li>
					
					<li><a href="running_installation.php">Running Installation(<? echo getcountRow("SELECT * FROM installation where installation_status IN ('1','2','11')  and sales_person='".$sales[0]['id']."'");?>)</a></li>
                   
                    <li><a href="back_installation.php">Back to installation(<? echo getcountRow("SELECT * FROM installation  WHERE  installation_status='3' and sales_person='".$sales[0]['id']."'"); ?>)</a></li>  

                    <li><a href="list_upload_docu.php" >Upload Chasis No Image</a></li>
                    
                    <li><a href="list_stop_gps.php">Stop Gps(<? echo getcountRow("SELECT * FROM stop_gps where (approve_status=0 or (approve_status=1 and support_comment!='' and final_status!=1)) and (sales_comment is null or stop_gps_status=2) and (acc_manager='".$_SESSION['user_name']."' or (forward_req_user='".$_SESSION["user_name"]."' and (forward_back_comment is null or forward_back_comment='')))");?>)</a></li>
                    
                    <li><a href="list_start_gps.php">Start Gps(<? echo getcountRow("SELECT * FROM start_gps where (approve_status=0 or (approve_status=1 and support_comment!='' and final_status!=1)) and (sales_comment is null or start_gps_status=2) and (acc_manager='".$_SESSION['user_name']."' or (forward_req_user='".$_SESSION["user_name"]."' and (forward_back_comment is null or forward_back_comment='')))");?>)</a></li>
                    
                    <li><a href="list_sub_user_creation.php">Sub User Creation(<? echo getcountRow("SELECT * FROM sub_user_creation  where (approve_status=0 or (approve_status=1 and support_comment!='' and final_status!=1)) and (sales_comment is null or sub_user_status=2) and (acc_manager='".$_SESSION['user_name']."' or (forward_req_user='".$_SESSION["user_name"]."' and (forward_back_comment is null or forward_back_comment='')))");?>)</a></li>
                    
                    <li><a href="list_reactivate_of_account.php">Reactivation Of Account(<? echo getcountRow("SELECT * FROM reactivation_of_account where (approve_status=0 or (approve_status=1 and support_comment!='' and final_status!=1)) and (sales_comment is null or reactivation_status=2) and (acc_manager='".$_SESSION['user_name']."' or (forward_req_user='".$_SESSION["user_name"]."' and (forward_back_comment is null or forward_back_comment='')))");?>)</a></li>
                    
                    <li><a href="list_deactivate_of_account.php">Deactivation Of Account(<? echo getcountRow("SELECT * FROM deactivation_of_account where (approve_status=0 or (approve_status=1 and support_comment!='' and final_status!=1)) and (sales_comment is null or deactivation_status=2)  and (acc_manager='".$_SESSION['user_name']."' or (forward_req_user='".$_SESSION["user_name"]."' and (forward_back_comment is null or forward_back_comment='')))");?>)</a></li>
                    
                    <!--<li><a href="list_deletion_from_debtors.php">Delete From Debtors(<?echo getcountRow("SELECT * FROM del_form_debtors where (approve_status=0  and (sales_comment is null or del_debtors_status=2))  and (acc_manager='".$_SESSION['user_name']."' or (forward_req_user='".$_SESSION["user_name"]."' and (forward_back_comment is null or forward_back_comment='')))");?>)</a></li>-->
                    <!--  <li><a href="search_km_alerts.php">KM Alert</a></li> -->
                    
                    <!--<li><a href="list_no_bill.php">NO Bill(<?echo getcountRow("SELECT * FROM no_bills where (approve_status=0 or (approve_status=1 and support_comment!='' and final_status!=1)) and (sales_comment is null or no_bill_status=2) and (acc_manager='".$_SESSION['user_name']."' or (forward_req_user='".$_SESSION["user_name"]."' and (forward_back_comment is null or forward_back_comment='')))");?>)</a></li> -->
                    
                    <li><a href="list_discounting.php">Discounting(<? echo getcountRow("SELECT * FROM discount_details where (((approve_status=0) or (approve_status=1 and support_comment!='')) and final_status!=1) and (sales_comment is null or discount_status=2) and (acc_manager='".$_SESSION['user_name']."' or (forward_req_user='".$_SESSION["user_name"]."' and (forward_back_comment is null or forward_back_comment='')))");?>)</a></li> 
                    
                    <li><a href="list_software_request.php">Software Request(<? echo getcountRow("SELECT * FROM software_request where (approve_status=0 or (approve_status=1 and support_comment!='' and final_status!=1)) and (sales_comment is null or software_status=2) and (acc_manager='".$_SESSION['user_name']."' or (forward_req_user='".$_SESSION["user_name"]."' and (forward_back_comment is null or forward_back_comment='')))");?>)</a></li>
                    
                    <li><a href="list_transfer_the_vehicle.php">Transfer The Vehicle(<? echo getcountRow("SELECT * FROM transfer_the_vehicle  where (approve_status=0 or (approve_status=1 and support_comment!='' and final_status!=1)) and (sales_comment is null or transfer_veh_status=2) and (acc_manager='".$_SESSION['user_name']."' or (forward_req_user='".$_SESSION["user_name"]."' and (forward_back_comment is null or forward_back_comment='')))");?>)</a></li>
                    
                    <li><a href="list_dimts_imei.php" >Dimts Slip(<? echo getcountRow("SELECT * FROM dimts_imei where (approve_status=0 or approve_status=2) and sales_manager='".$_SESSION['user_name']."'");?>)</a></li> 
                                      
                </ul>
                
			<? if($_SESSION['BranchId']==3 && $_SESSION['user_name'] == "jaipursales"){ ?>
            
                <h3>Daily Branch Report</h3>
                
                <ul class="nav">
                
                        <li><a href="list_branch_account_report.php">Payment Reoprt </a></li>
                </ul>
                <?} ?>    
            </div>

			 <div id="center-column">
               
          