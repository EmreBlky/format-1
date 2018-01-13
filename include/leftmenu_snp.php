
        <div id="middle">
            <div id="left-column">
			                  
                <h3>Live Debug</h3>
                
                <ul class="nav">
                
                        <li><a href="debug.php">Debug </a></li>
                </ul>
                
                <h3> Request</h3>

                <ul class="nav">
                
                		<li><a href="accountcreation.php" >New Account creation(<? echo getcountRow("SELECT * FROM new_account_creation where (approve_status=0 or (approve_status=1 and support_comment!='' and final_status!=1)) and (sales_comment is null or acc_creation_status=2) and (account_manager='".$_SESSION['user_name']."' or (forward_req_user='".$_SESSION["user_name"]."' and (forward_back_comment is null or forward_back_comment='')))");?>)</a></li> 
                        
                        <li><a href="list_vehicle_no_change.php">Vehicle Number Change(<? echo getcountRow("SELECT * FROM vehicle_no_change where (((approve_status=0 or approve_status=2) or (approve_status=1 and support_comment!='')) and final_status!=1) and (service_comment is null and forward_back_comment is null) and (acc_manager='".$_SESSION['user_name']."' or forward_req_user='".$_SESSION["user_name"]."')");?>)</a></li>
                        
                        <li><a href="list_delete_vehicle.php">Delete Vehicle(<? echo getcountRow("SELECT * FROM deletion where (approve_status=0 or approve_status=2) and (service_comment is null and forward_back_comment is null) and (acc_manager='".$_SESSION['user_name']."' or forward_req_user='".$_SESSION["user_name"]."')");?>)</a></li> 
             			
                        <li><a href="list_reactivate_of_account.php">Reactivation Of Account(<? echo getcountRow("SELECT * FROM reactivation_of_account where (approve_status=0 or (approve_status=1 and support_comment!='' and final_status!=1)) and (sales_comment is null or reactivation_status=2) and (acc_manager='".$_SESSION['user_name']."' or (forward_req_user='".$_SESSION["user_name"]."' and (forward_back_comment is null or forward_back_comment='')))");?>)</a></li>
                        
                        <li><a href="list_deactivate_of_account.php">Deactivation Of Account(<? echo getcountRow("SELECT * FROM deactivation_of_account where (approve_status=0 or (approve_status=1 and support_comment!='' and final_status!=1)) and (sales_comment is null or deactivation_status=2)  and (acc_manager='".$_SESSION['user_name']."' or (forward_req_user='".$_SESSION["user_name"]."' and (forward_back_comment is null or forward_back_comment='')))");?>)</a></li>
                        
                        
              </ul>
             
            </div>

			 <div id="center-column">
               
          