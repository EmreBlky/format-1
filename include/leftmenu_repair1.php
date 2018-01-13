
<div id="middle">
    <div id="left-column">
    
        <? if($_SESSION['BranchId']==1 && $_SESSION['user_name'] == "shruti"){ ?>
        
        <h3>R &amp; D Process</h3>
        
        <ul class="nav">
                <li><a href="list_rdconversion.php">Topic Conversation(<? echo getcountRow("SELECT * FROM ad_rd_conversion where status=1 and close_status=0");?>) </a></li>
        </ul>
        
        <? } else {?>    

        <h3>Live Debug</h3>
        <ul class="nav">
            <li><a href="debug.php" >Debug</a></li> 
            <li><a href="imeisearch.php" >Data BY IMEI</a></li> 
        </ul>

        <h3>Sales Request</h3>
        <ul class="nav">
            <!--<li><a href="list_dimts_imei.php" >Dimts Imei Addition(<?echo getcountRow("SELECT * FROM dimts_imei where ((approve_status=1 or account_comment!='') and repair_comment IS NULL) or (forward_req_user='".$_SESSION["user_name"]."' and (forward_back_comment is null or forward_back_comment=''))");?>)</a></li> 
            
            <li><a href="list_renew_dimts_imei.php" >Renew Dimts Imei(<?echo getcountRow("SELECT * FROM renew_dimts_imei where ((approve_status=1 or account_comment!='') and port_change_status='Yes' and repair_comment IS NULL) or (forward_req_user='".$_SESSION["user_name"]."' and (forward_back_comment is null or forward_back_comment=''))");?>)</a></li>--> 
            
            <li><a href="list_discounting.php" >Discounting(<? echo getcountRow("SELECT * FROM discount_details where (approve_status=0 and discount_issue='Repair Cost Issue' and repair_comment is null) or (forward_req_user='".$_SESSION["user_name"]."' and (forward_back_comment is null or forward_back_comment=''))");?>)</a></li>  
            
            <!--<li><a href="device_cmd.php" >Device Commands</a></li></ul>-->

        </ul>
        
        <h3>Services Installation</h3>            
        <ul class="nav">
            <li><a href="list_service_repair.php">Running Services(<? echo getcountRow("SELECT * FROM services where service_status='11' and fwd_repair_id='".$_SESSION['userId']."' and fwd_serv_to_repair is NOT NULL and fwd_repair_to_serv is NULL");?>)</a></li>
            
            <li><a href="list_installation_repair.php">Running Installation(<? echo getcountRow("SELECT * FROM installation where installation_status='11' and fwd_repair_id='".$_SESSION['userId']."' and fwd_install_to_repair is NOT NULL and fwd_repair_to_install is NULL");?>)</a></li>  
        </ul>    

        <? if($_SESSION['user_name'] == "rchauhan"){ ?>
        
        <h3>Reports</h3>
        <ul class="nav">
            
            <li><a href="show_repairs.php">RepairDevice Reports</a></li>
            
            <li><a href="configure_report.php">Configuration Reports</a></li>
            
            <li><a href="list_service_details.php">Service Reports</a></li> 
            
            <li><a href="installation_report.php">Installation Reports</a></li>
       </ul>
        
        <? } ?>
        
        <h3>Login Report</h3>
            <ul class="nav">

                <li><a href="login_status_change.php">Login Activety </a></li>

            </ul>
        
        <h3>Download</h3>
        <ul class="nav">
            <li><a href="download_text_file.php" >Download All Files</a></li> 
            <!--<li><a href="show_csv.php" >CSV File</a></li> -->
        </ul>

   <? } ?>     
 </div>

     <div id="center-column">
               
          