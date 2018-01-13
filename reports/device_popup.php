<?php
session_start();
include("../connection.php");
include_once(__DOCUMENT_ROOT.'/include/header.php');
include_once(__DOCUMENT_ROOT.'/include/leftmenu_report.php');
include_once(__DOCUMENT_ROOT.'/sqlconnection.php');

/*include($_SERVER['DOCUMENT_ROOT']."/format/include/header.php");
include($_SERVER['DOCUMENT_ROOT']."/format/include/leftmenu_report.php");
include($_SERVER['DOCUMENT_ROOT']."/format/sqlconnection.php");*/
 
if(isset($_REQUEST["device"]))
{
      $device=$_REQUEST["device"];
      $from=$_REQUEST["from"]." 00:00:00";
      $to=$_REQUEST["to"]." 23:59:59";
      $total_device=0;
      
      $inventory_query = mssql_query("select device_type,item_name,device_imei from device left join item_master on item_master.item_id=device.device_type 
          where device_status=65 and recd_date >='".$from."' and recd_date <='".$to."' and device_type='".$device."' group by device_type,item_name,device_imei");
            
      $imei = "";    
    while($row_inventory=mssql_fetch_array($inventory_query))
    {
        if($row_inventory['device_imei']!="")
        {
            $imei.= $row_inventory['device_imei'].",";
        }
        $device_name = $row_inventory['item_name'];
    }
        
    $imei_rslt=substr($imei,0,strlen($imei)-1); 
    
    $row_data = select_query_live("select group_services.sys_group_id,count(*) as total,group.name,group_users.sys_user_id from matrix.devices left join matrix.services 
on devices.id=services.sys_device_id left join matrix.group_services on services.id=group_services.sys_service_id left join matrix.group 
on group_services.sys_group_id=`group`.id  left join matrix.group_users on group_services.sys_group_id=`group_users`.sys_group_id 
where devices.imei in ($imei_rslt) and group_services.sys_group_id!=1998 and `group`.sys_parent_group_id=1 group by group_services.sys_group_id");
        
    /*while($row_matrix=mysql_fetch_array($query_matrix))
    {
        $total_device=$total_device+$row_matrix['total'];
        $row_data[] = $row_matrix;    
    }*/
	for($j=0;$j<count($row_data);$j++)
	{
		$total_device=$total_device+$row_data[$j]['total'];
	}
}

 
?>

<link rel="stylesheet" href="http://code.jquery.com/ui/1.10.3/themes/smoothness/jquery-ui.css" />
<script src="http://code.jquery.com/jquery-1.9.1.js"></script>
<script src="http://code.jquery.com/ui/1.10.3/jquery-ui.js"></script>
<script>
var j = jQuery.noConflict();

</script>
 

<div class="top-bar">
    
    <h1><?php echo $device_name;?> Device Details</h1>
</div>

<div class="top-bar">
    <div align="right">
         <a onclick="window.open(this.href); return false;" href="other_device_status.php?device=<?=$device;?>&from=<?=date("Y-m-d",strtotime($from))?>&to=<?=date("Y-m-d",strtotime($to))?>" > Remaining Devices Details</a> 
     </div>
     <div align="center">
         <br/>Total Device - <?=$total_device;?>
     </div>
</div>
<div class="table">

<table cellpadding="0" cellspacing="0" border="0" class="display" id="example">
    <thead>
          <tr>
            <th>Branch</th>
            <th>Client Details</th> 
            <th>Company Name</th>
            <th>Number of Device</th> 
        </tr>
    </thead>
    <tbody>
  <?php for($i=0;$i<count($row_data);$i++)
          {  
              $user_id = $row_data[$i]['sys_user_id'];
            $matrix_user_query = select_query_live("SELECT sys_username,sys_parent_user,branch_id FROM matrix.users WHERE id='".$user_id."'");
		 
            $user_name = $matrix_user_query[0]['sys_username'];
            $user_details = $matrix_user_query[0]['sys_parent_user'];
            $branch_id = $matrix_user_query[0]['branch_id'];
            
            if($branch_id==1){$branch = "Delhi";}
            elseif($branch_id==2){$branch = "Mumbai";}
            elseif($branch_id==3){$branch = "Jaipur";}
            elseif($branch_id==4){$branch = "Sonipath";}
            elseif($branch_id==5){$branch = "Kanpur";}
            elseif($branch_id==6){$branch = "Ahmedabad";}
            elseif($branch_id==7){$branch = "kolkata";}
            else{$branch = "Stock";}

            if($user_details == 1)
            {
                $user = "(Parent)";    
            }
            else
            {
                $user = "(Sub User)";    
            }
  ?>
    <tr>
        <td><?php echo $branch;?></td>
        <td><?php echo $user_name." - ".$user;?></td>
        <td><?php echo $row_data[$i]['name'];?></td>
        <td><?php echo $row_data[$i]['total'];?></td>
    </tr>
    <?php } ?>
    </tbody>
</table>

<?
include("../include/footer.php");

?>
