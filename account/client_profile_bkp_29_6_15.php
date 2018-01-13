<?
include("../connection.php");
include_once(__DOCUMENT_ROOT.'/include/header.php');
include_once(__DOCUMENT_ROOT.'/include/leftmenu_account.php');

/*include($_SERVER['DOCUMENT_ROOT']."/format/include/header.php");
include($_SERVER['DOCUMENT_ROOT']."/format/include/leftmenu_account.php");*/

$mode=$_GET['mode']; 
$user_id=$_GET['id'];

 if($_POST["submit"] == "submit")
 {
    $user_id = $_POST['user_id'];
 }
    $group_user_id = mysql_fetch_array(mysql_query("SELECT sys_group_id FROM matrix.group_users where sys_user_id='".$user_id."'",$dblink));
    
    $group_id =  $group_user_id['sys_group_id'];
    
    //$active_query = mysql_query("SELECT sys_service_id,sys_added_date FROM matrix.group_services WHERE active=1 AND sys_group_id='".$group_id."'");
    $active_query = mysql_query("SELECT sys_service_id,add_date,remove_date FROM matrix.tbl_history_devices WHERE sys_group_id='".$group_id."' AND remove_date is null",$dblink);
    	
    //$deactive_query = mysql_query("SELECT sys_service_id,sys_added_date FROM matrix.group_services WHERE active=0 AND sys_group_id='".$group_id."'");
    $deactive_query = mysql_query("SELECT sys_service_id, add_date, remove_date FROM matrix.tbl_history_devices WHERE sys_group_id='".$group_id."' AND remove_date is not null",$dblink);
    
	$veh_id_get = "";
	while($vehicle_id_row = mysql_fetch_array($deactive_query))
	{
		$veh_id_get.= $vehicle_id_row['sys_service_id']."','";
	}
	$veh_id_data=substr($veh_id_get,0,strlen($veh_id_get)-3);
	
	$device_get_query = mysql_query("SELECT id,sys_device_id FROM matrix.services WHERE id IN ('".$veh_id_data."')",$dblink);
	
	$sys_device_id = "";
	while($device_get_row = mysql_fetch_array($device_get_query))
	{
		$sys_device_id.= $device_get_row['sys_device_id']."','";
	}
	$sys_device_id_data=substr($sys_device_id,0,strlen($sys_device_id)-3);
	
	$imei_query = mysql_query("SELECT device_imei FROM matrix.device_mapping WHERE device_id IN ('".$sys_device_id_data."')",$dblink);  
	
	$imei_no_row = "";
	while($imei_get_row = mysql_fetch_array($imei_query))
	{
		$no_of_imei = str_replace("_","",$imei_get_row['device_imei']);
		$imei_no_row.= $no_of_imei."','";
	}
	$imei_no_data=substr($imei_no_row,0,strlen($imei_no_row)-3);  
	
	
    $active_total = mysql_num_rows($active_query);
    
    $deactive_total = mysql_num_rows($deactive_query);
    
    $total_device =  $active_total + $deactive_total;

?> 


<link rel="stylesheet" href="http://code.jquery.com/ui/1.10.3/themes/smoothness/jquery-ui.css" />
<script src="http://code.jquery.com/jquery-1.9.1.js"></script>
<script src="http://code.jquery.com/ui/1.10.3/jquery-ui.js"></script>
<script>
var j = jQuery.noConflict();

function Show_record(Veh_Reg,tablename,DivId)
{
    alert(Veh_Reg);
    //return false;
$.ajax({
        type:"GET",
        url:"userInfo.php?action=getrowSales",
        data:"Veh_Reg="+Veh_Reg+"&tablename="+tablename,
        success:function(msg){
        alert(msg);    
          
        document.getElementById("popup1").innerHTML = msg;
                        
        }
    });
}

</script>
 

<div class="top-bar">
	<?php  if($mode == "active"){$page_status = "Currently Activate";}
		   elseif($mode == "deactivate"){$page_status = "Deactivate Device";}
		   elseif($mode == "pending"){$page_status = "G-Trac Pending";}
		   elseif($mode == "notexistence"){$page_status = "Device Not In Existence";}
		   else{$page_status = "Total IMEI Buy";}
	?>
    <h1>Client Vehicle List:- <?php echo $page_status;?></h1>
      
</div>

<div class="top-bar">
<form name="myForm" action=""   method="post">

<table cellspacing="5" cellpadding="5">

    <tr>
        <td><select name="user_id" id="user_id">
                <option value="" name="user_id">-- Select One --</option>
                <?php
                $main_user_id=mysql_query("SELECT id as user_id, sys_username as name FROM matrix.users order by name asc",$dblink);
                while ($data=mysql_fetch_assoc($main_user_id))
                {
                ?>
               <option name="main_user_id" value="<?=$data['user_id']?>" <? if($user_id==$data['user_id']) {?> selected="selected" <? } ?> > 
                <?php echo $data['name']; ?>
              </option>
                <?php     }  ?>
            </select>
        </td>
        <td align="center"> <input type="submit" name="submit" value="submit"  /></td>
    </tr>
 
</table>
</form>


<div style="float:right";> <a href="client_profile.php?mode=totaldevice&id=<?=$user_id;?>">Total IMEI Buy - <?=$total_device;?></a></div>
<br/>
<div style="float:right";> <a href="client_profile.php?mode=active&id=<?=$user_id;?>">Currently Activate - <?=$active_total;?> </a></div>              
<br/>
<div style="float:right";> <a href="client_profile.php?mode=deactivate&id=<?=$user_id;?>">Deactivate Device - <?=$deactive_total;?> </a></div>              
<br/>
<div style="float:right";><a href="client_profile.php?mode=pending&id=<?=$user_id;?>">G-Trac Pending - <? $gtrac_query = mysql_fetch_array(mysql_query("SELECT count(*) as total FROM internalsoftware.deletion where user_id='".$user_id."' AND imei in ('".$imei_no_data."') AND final_status=1 AND ((device_status IN('Sold Vehicle','Vehicle Stand For Long Time','Stop GPS') and vehicle_location IN('gtrack office','client office')) or (device_status IN('Device Lost','Device Dead') and vehicle_location IN('gtrack office')) or  (vehicle_location IN('gtrack office','client office') and device_status is null))")); echo $gtrac_query["total"];?> </a></div>              
<br/>
<div style="float:right";><a href="client_profile.php?mode=notexistence&id=<?=$user_id;?>">Device Not In Existence - <? $device_no_query = mysql_fetch_array(mysql_query("SELECT count(*) as total FROM internalsoftware.deletion where user_id='".$user_id."' AND imei in ('".$imei_no_data."') AND final_status=1 AND ((device_status NOT IN('Sold Vehicle','Vehicle Stand For Long Time','Stop GPS') and vehicle_location IN('device lost','client vehicle')) or (device_status IN('Device Lost','Device Dead') and vehicle_location IN('client office')) or (vehicle_location IN('device lost','client vehicle') and device_status is null))")); echo $device_no_query["total"];?> </a></div>              
<br/>
<div style="float:right";>No Information - <?php $remain = $deactive_total -($gtrac_query["total"] + $device_no_query["total"]); if($remain >=0){ echo $remain;}else{echo 0;}?> </div>              
<br/>

</div>
<div class="table">
<?php 
 
if($mode=='pending')
 { 				
       $query = mysql_query("SELECT * FROM internalsoftware.deletion where user_id='".$user_id."' AND imei in ('".$imei_no_data."') AND final_status=1 AND ((device_status IN('Sold Vehicle','Vehicle Stand For Long Time','Stop GPS') and vehicle_location IN('gtrack office','client office')) or (device_status IN('Device Lost','Device Dead') and vehicle_location IN('gtrack office')) or  (vehicle_location IN('gtrack office','client office') and device_status is null)) order by id DESC");
  
 } 
 elseif($mode=='notexistence')
 { 
       $query = mysql_query("SELECT * FROM internalsoftware.deletion where user_id='".$user_id."' AND imei in ('".$imei_no_data."') AND final_status=1 AND ((device_status NOT IN('Sold Vehicle','Vehicle Stand For Long Time','Stop GPS') and vehicle_location IN('device lost','client vehicle')) or (device_status IN('Device Lost','Device Dead') and vehicle_location IN('client office')) or (vehicle_location IN('device lost','client vehicle') and device_status is null)) order by id DESC");
  
 } 
 elseif($mode=='active')
 { 
      $query = mysql_query("SELECT sys_service_id,add_date,remove_date FROM matrix.tbl_history_devices WHERE sys_group_id='".$group_id."' AND remove_date is null",$dblink);
  
 } 
 elseif($mode=='deactivate')
 { 
      $query = mysql_query("SELECT sys_service_id,add_date,remove_date FROM matrix.tbl_history_devices WHERE sys_group_id='".$group_id."' AND remove_date is not null",$dblink);
  
 } 
 else
 { 
      $query = mysql_query("SELECT sys_service_id,add_date,remove_date FROM matrix.tbl_history_devices WHERE sys_group_id='".$group_id."'",$dblink);
  
 } 
 


?>
   
<table cellpadding="0" cellspacing="0" border="0" class="display" id="example">
    <thead>
    <?php if($mode=='pending' || $mode=='notexistence'){?>
          <tr>
            <th>SL.No</th>
            <th>Date</th>
            <th>User Name</th>
            <th>Vehicle Number</th>
            <th>Device IMEI</th>
            <th>Device Model</th>
            <th>Location</th>
            <th>Device Status</th>
            <th>Reason</th> 
        </tr>
   <?php } else{?>
       <tr>
            <th>Sl No. </th>
            <th>IMEI No </th>
            <th>Vehicle No </th>
            <th>Vehicle ID </th>
            <th>Installed Date</th> 
            <th>Remove Date</th> 
            <th>Status</th> 
            <th>Current Location</th>
            <th>Device Status</th>
            <th>View Reason</th>      
        </tr>
    <?php } ?> 
    </thead>
    <tbody>
   
    <?php 
    $i=1;
     
   while($row_data = mysql_fetch_array($query))
    {
        
     if($mode=='pending' || $mode=='notexistence'){
    ?>
    <tr align="Center" >
        <td><?php echo $i?></td>
        <td><?php echo $row_data["date"];?></td>
        <td><?php echo $row_data["client"];?></td>
        <td><?php echo $row_data["reg_no"];?></td> 
        <td><?php echo $row_data["imei"];?></td> 
        <td><?php echo $row_data["device_model"];?></td> 
        <td><?php echo $row_data["vehicle_location"];?></td> 
        <td><?php echo $row_data["device_status"];?></td>
        <td><?php if($row_data['final_status'] == 1){$row_status = "(Close Request)";}else{$row_status = "(Pending Request)";} echo $row_data["reason"].' '.$row_status;?></td> 
    </tr>
    <?php }
     else
     {
        $veh_id = $row_data['sys_service_id'];
        $add_date = $row_data['add_date'];
        $remove_date = $row_data['remove_date'];
        
        $veh_query = mysql_fetch_array(mysql_query("SELECT id,sys_user_id,sys_created,sys_renewal_due,sys_device_id,veh_reg,veh_type_name FROM matrix.services WHERE id='".$veh_id."'",$dblink));
        $veh_no = $veh_query['veh_reg'];
        $device_id = $veh_query['sys_device_id'];
        
        $device_query = mysql_fetch_array(mysql_query("SELECT device_imei FROM matrix.device_mapping WHERE device_id='".$device_id."'",$dblink));     
    ?>  

    <tr align="Center" >
        <td><?php echo $i ?></td>        
        <td>&nbsp;<?php echo $device_query['device_imei'];?></td>
        <td>&nbsp;<?php echo $veh_no;?></td>
        <td>&nbsp;<?php echo $veh_id;?></td>
         <td>&nbsp;<?php echo $add_date;?></td>
        <td>&nbsp;<?php echo $remove_date;?></td>
        <td>&nbsp;<?php if($row_data['remove_date'] != ""){echo "Deactivate";}else{echo "Activate";}?></td>
        <?php 
            $delete_query = mysql_query("SELECT * FROM internalsoftware.deletion where reg_no='".$veh_no."'");
            
            $delete_veh_reason ="";$status = "";$location="";$device_status="";
            while($row=mysql_fetch_array($delete_query))
            {
                if($row['final_status'] == 1)
                {
                    $status = "(Close Request)";
                }
                else{
                    $status = "(Pending Request)";    
                }
                
                $delete_veh_reason.= $row['reason'].' '.$status.",";
                $location = $row["vehicle_location"];
                $device_status = $row["device_status"];
            }
                $delete_veh_rslt=substr($delete_veh_reason,0,strlen($delete_veh_reason)-1);
        ?>
        <td><?php echo $location;?></td> 
        <td><?php echo $device_status;?></td>
        <td><?php echo $delete_veh_rslt;?></td>     
        <!--<td><a href="#" onclick="Show_record(<?php echo $veh_no;?>,'deletion','popup1'); " class="topopup">View Detail</a></td> -->    
    </tr>
  <?php  }
    $i++;
    }
     
    ?>
</table>
     
   <div id="toPopup"> 
        
        <div class="close">close</div>
           <span class="ecs_tooltip">Press Esc to close <span class="arrow"></span></span>
        <div id="popup1" style ="height:100%;width:100%"> <!--your content start-->
            

 
        </div> <!--your content end-->
    
    </div> <!--toPopup end-->
    
    <div class="loader"></div>
       <div id="backgroundPopup"></div>
</div>
 
 
 
<?
include("../include/footer.php");

?>