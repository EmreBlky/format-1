<?php   
 $user_query = select_query("SELECT Userid FROM internalsoftware.addclient WHERE Branch_id='".$_SESSION['BranchId']."' AND Userid NOT IN(1,2143)");
 //while($user_data = mysql_fetch_array($user_query))
 for($u=0;$u<count($user_query);$u++)
 {
	 $user_id .= $user_query[$u]['Userid'].",";
 }
 $user = substr($user_id,0,-1);

?>
        <div id="middle">
            <div id="left-column">
                <h3> Request</h3>
                <ul class="nav">
   <li><a href="list_deactivate_of_account.php" > Deactivation of Account(<? echo getcountRow("SELECT * FROM deactivation_of_account where user_id IN($user) and (approve_status=0 or approve_status=2) and ((device_remove_status='Y' and no_device_removed is null ) or (forward_req_user='".$_SESSION["user_name"]."' and (forward_back_comment is null or forward_back_comment='')))");?>)</a></li>
   
    <!--<li><a href="list_deletion_from_debtors.php">Delete From Debtors(<?echo getcountRow("SELECT * FROM del_form_debtors where user_id IN($user) and (approve_status=0 or approve_status=2) and ((no_device_removed is null and device_remove_status='Y') or (forward_req_user='".$_SESSION["user_name"]."' and (forward_back_comment is null or forward_back_comment='')))");?>)</a></li>-->
      
     <li><a href="list_delete_vehicle.php">Delete Vehicle(<? echo getcountRow("SELECT * FROM deletion  where user_id IN($user) and (approve_status=0 and final_status!=1 and vehicle_location='gtrack office' and stock_comment is null) or (forward_req_user='".$_SESSION["user_name"]."' and (forward_back_comment is null or forward_back_comment=''))");?>)</a></li>  
     
     <!--<li><a href="list_sim_change.php">Sim Change(<?echo getcountRow("SELECT * FROM sim_change where (approve_status=1 and final_status!=1 and account_comment is null) or (forward_back_comment is null and forward_req_user='".$_SESSION["user_name"]."')");?>)</a></li>-->
     
	  <!--<li><a href="list_device_change.php">Device Change(<?echo getcountRow("SELECT * FROM device_change where approve_status=0 or approve_status=2");?>)</a></li>  -->
      <li><a href="list_device_change.php">Device Change(<? echo getcountRow("SELECT * FROM device_change where user_id IN($user) and (approve_status=0 and final_status!=1) and (forward_req_user='".$_SESSION["user_name"]."' and (forward_back_comment is null or forward_back_comment=''))");?>)</a></li>  
	 	
			  
			    </ul>
                
            

					<h3>Live Debug</h3>
		<ul class="nav">
		<li><a href="debug.php" >Debug</a></li> 
		
		</ul>

	</div>

			 <div id="center-column">
               
          