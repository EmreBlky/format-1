<?php
session_start();
include($_SERVER['DOCUMENT_ROOT']."/format/connection.php");
include($_SERVER['DOCUMENT_ROOT']."/format/sqlconnection.php");
 
if(isset($_REQUEST["device"]))
{
	  $device=$_REQUEST["device"];
	  $from=$_REQUEST["from"]." 00:00:00";
	  $to=$_REQUEST["to"]." 23:59:59";
	  $req_id=$_REQUEST["req_id"];
	  
	  $inventory_query = mssql_query("select item_name,device_imei,count(*) as total from device left join item_master on item_master.item_id=device.device_type 
	  	where dispatch_date >='".$from."' and dispatch_date <='".$to."' and item_name='".$device."' group by item_name,device_imei");
	  
	  $imei = "";	
	while($row_inventory=mssql_fetch_array($inventory_query))
	{
		$imei.= $row_inventory['device_imei'].",";
		
	}
	
	$imei_rslt=substr($imei,0,strlen($imei)-1); 
	
	$query_matrix = mysql_query("select group_services.sys_group_id,count(*) as total from matrix.devices left join matrix.services on devices.id=services.sys_device_id left join 
	matrix.group_services on services.id=group_services.sys_service_id where devices.imei in ('".$imei_rslt."') and sys_group_id!=1998 group by group_services.sys_group_id",$dblink);
	
	$client_name ="";
	while($row_matrix=mysql_fetch_array($query_matrix))
	{
		$client_query = mysql_fetch_array(mysql_query("select id,name from matrix.`group` where id='".$row_matrix['sys_group_id']."'",$dblink));
		$client_name.= $client_query['name']."(".$row_matrix['total']."),";
	}
	
	$client_rslt=substr($client_name,0,strlen($client_name)-1); 
	
	
}

 
?>

 <html>
<head>
 
</head>
<body>



<form name="forwardrequest" method="post" action="">



<table border="0" cellspacing="5" cellpadding="5" align="left">
    <tr>
        <td>Device Details</td>
    </tr>
    <tr>
        <td>Device Modal </td>
        <td>Client Details</td>
    </tr>
    <tr>
        <td>&nbsp;<?php echo $device;?></td>
        <td>&nbsp;<?php echo $client_rslt;?></td>
    </tr>
</table>
</form>

</body>
</html>
