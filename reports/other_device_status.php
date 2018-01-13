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
         
    /*$inventory_query_status = mssql_query("select device_type,dispatch_branch,item_name,device_imei,device_status.status as status from device left join item_master on
item_master.item_id=device.device_type left join device_status on device_status.status_sno=device.device_status where device_status<>65 and recd_date >='".$from."' and
     recd_date <='".$to."' and device_type='".$device."' group by device_type,item_name,device_imei,device_status.status,dispatch_branch");*/
   
    $inventory_query_status = mssql_query("select device_type,dispatch_branch,item_name,device_status.status as status,count(device.device_status) as Number,device.device_status,
    ChallanDetail.InstallerID from device left join item_master on item_master.item_id=device.device_type left join device_status on device_status.status_sno=device.device_status
    left join ChallanDetail on ChallanDetail.deviceid=device.device_id where device_status<>65 and recd_date >='".$from."' and recd_date <='".$to."' and
    device_type='".$device."' group by device_type,item_name,device_status.status,dispatch_branch,ChallanDetail.InstallerID,device.device_status");
   
    $total=0;
    while($row_inventory_status=mssql_fetch_array($inventory_query_status))
    {
        $row_data[] = $row_inventory_status;
        $device_name = $row_inventory_status['item_name'];
        $total = $total+$row_inventory_status['Number'];
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
   
    <h1><?php echo $device_name;?> Remaining Device Details</h1>
</div>

<div class="top-bar">
    <div align="center">
         <br/>Total Device - <?=$total;?>
     </div>
</div>
<div class="table">

<table cellpadding="0" cellspacing="0" border="0" class="display" id="example">
    <thead>
          <tr>
            <th>Branch</th>
            <th>Device Status</th>
            <th>Total No.</th>
            <th>Installer Name</th>
        </tr>
    </thead>
    <tbody>
  <?php for($i=0;$i<count($row_data);$i++){
             
            $inst_id = $row_data[$i]['InstallerID'];
            if($inst_id == "")
            {
                $inst_name = 'Stock';
            }
            else
            {
                $installer_query = mysql_fetch_array(mysql_query("SELECT inst_name FROM installer WHERE inst_id='".$inst_id."'"));
                $inst_name = $installer_query['inst_name'];
            }
             
            $device_status = $row_data[$i]['device_status'];
            if($device_status == 20 || $device_status == 58 || $device_status == 60 || $device_status == 61 || $device_status == 68 || $device_status == 69 || $device_status == 71)
            {
                $status = "Repair";
            }
            elseif($device_status == 57 || $device_status == 62 || $device_status == 63 || $device_status == 67 || $device_status == 70 || $device_status == 75 || $device_status == 78 || $device_status == 79 || $device_status == 80 || $device_status == 81 || $device_status == 82 || $device_status == 83 || $device_status == 84 || $device_status == 85 || $device_status == 86 || $device_status == 94 || $device_status == 97 || $device_status == 98)
            {
                $status = "Stock";
            }
            elseif($device_status == 64 || $device_status == 65 || $device_status == 96)
            {
                $status = "Installer";
            }
            elseif($device_status == 95)
            {
                $status = "Client";
            }
            elseif($device_status == 66 || $device_status == 76 || $device_status == 77)
            {
                $status = "Prabhaker";
            }
           
            $branch_id = $row_data[$i]['dispatch_branch'];           
            if($branch_id==1){$branch = "Delhi";}
            elseif($branch_id==2){$branch = "Mumbai";}
            elseif($branch_id==3){$branch = "Jaipur";}
            elseif($branch_id==4){$branch = "Sonipath";}
            elseif($branch_id==5){$branch = "Kanpur";}
            elseif($branch_id==6){$branch = "Ahmedabad";}
            elseif($branch_id==7){$branch = "kolkata";}
            else{$branch = "Stock";}
      ?>
    <tr>
        <td><?php echo $branch;?></td>
        <td><?php echo $status;?></td>
        <td><?php echo $row_data[$i]['Number'];?></td>
        <td><?php if($row_data[$i]['device_status'] == 64 && $inst_id == ''){echo "Installer Assign";}else{echo $inst_name;}?></td>
    </tr>
    <?php } ?>
    </tbody>
</table>

<?
include("../include/footer.php");

?>