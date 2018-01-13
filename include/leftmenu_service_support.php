
        <div id="middle">
            <div id="left-column">
                <h3>Service Request</h3>
                <ul class="nav">
				
                 <li><a href="accountcreation.php">New Account Creation(<?echo getcountRow("SELECT * FROM new_account_creation where final_status=1");?>)</a></li> 
               	 
                 <li><a href="list_new_device_addition.php">New Device Addition(<?echo getcountRow("SELECT * FROM new_device_addition where final_status=1");?>)</a></li> 
	  			 
                 <li><a href="list_device_change.php">Device Change(<?echo getcountRow("SELECT * FROM device_change where approve_status=0 or approve_status=2");?>)</a></li>
     			
                 <li><a href="list_delete_vehicle.php">Delete Vehicle(<?echo getcountRow("SELECT * FROM deletion where approve_status=0 or approve_status=2");?>)</a></li> 
               
                </ul>
         <h3>Sales Request</h3>
        <ul class="nav">
                   
                <li><a href="list_reactivate_of_account.php">Reactivation Of Account(<?echo getcountRow("SELECT * FROM reactivation_of_account where approve_status=0 or approve_status=2");?>)</a></li>
                
                <li><a href="list_deactivate_of_account.php">Deactivation Of Account(<?echo getcountRow("SELECT * FROM deactivation_of_account where approve_status=0 or approve_status=2");?>)</a></li>
                
                <li><a href="list_deletion_from_debtors.php">Delete From Debtors(<?echo getcountRow("SELECT * FROM del_form_debtors where approve_status=0 or approve_status=2");?>)</a></li> 
                
                <li><a href="list_no_bill.php">No Bill(<?echo getcountRow("SELECT * FROM no_bills where no_bill_issue='Service Issue' and (approve_status=0 or approve_status=2)");?>)</a></li> 
               
                <li><a href="list_discounting.php">Discounting(<?echo getcountRow("SELECT * FROM discount_details where discount_issue='Service Issue' and (approve_status=0 or approve_status=2)");?>)</a></li>  
			    </ul>
            </div>

			 <div id="center-column">
               
          