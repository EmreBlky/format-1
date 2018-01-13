<?php
include('lock.php');
error_reporting(0);
include ('connection.php');

if(isset($_POST['formnobtn'])){
$chk_id =$_POST['formnobtn'];

for($i=0;$i<count($chk_id);$i++){
//echo "Update device_change set  pay_status=1  and device_old_paid_unpaid=1 where id ='".$chk_id[$i]."'";
 mysql_query("Update deactivation_of_account set   where pay_pending!=\"\" and psd_payment!=\"\" and id ='".$chk_id[$i]."'");

}
}
 
 
  ?>



<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
<title>Internal Process</title>
<link rel="stylesheet" href="demo.css" type="text/css" media="all" />
</head>

<body>
<?php include("header.php"); ?>
<br />
<?php
include ('Pagination.php');
 $num=mysql_num_rows(mysql_query("SELECT * FROM deactivation_of_account where reg_no_of_vehicles!=\"\" and imei_of_removed_devices!=\"\" and psd_client_name!=\"\" and psd_reg_no!=\"\" order by id desc"));
$Pagination = new Pagination($num, 10, array(5, 10, 25, "All"), "comments", "pageOff", "pageOn", "pageSelect", "pageErrors");
echo $Pagination->display();
echo $Pagination->displaySelectInterface();
 $start = $Pagination->getEntryStart();
 $end = $Pagination->getEntryEnd();
$query = mysql_query("SELECT * FROM deactivation_of_account where reg_no_of_vehicles!=\"\" and imei_of_removed_devices!=\"\" and psd_client_name!=\"\" and psd_reg_no!=\"\" order by id desc LIMIT $start,$end");   

?>
<br />
<br />

    <form method="POST">
    <table border="1" width="100%" style="font-family:Arial, Helvetica, sans-serif; font-size:13px;">
<tr style="font-weight:bold;" align="center">
<td>SL.No</td>
<td>Date</td>
  <td>Account Manager</td>
  <td>Client</td>
  <td>User Id</td>
  <td>Total No Of Vehicles</td>
  <td>Payment pending</td>
  <td>No Of Removed Deviced</td>
  <td>Reg No Of Vehicles</td>
  <td>IMEI Of Removed Devices</td>
  <td>Client Name</td>
  <td>Reg No</td>
  <td>Payment</td>
  <td>Sim Status</td>
  <td>SIM No. Tobe Deactivate</td>
  <td>Deactivate Temporary</td>
  <td>Reason</td>
  <td>Action</td>
    
</tr>
<?php 
$i=1;
while($row=mysql_fetch_array($query))
{
?>
<tr align="center">
<td><?php echo $i ?></td>
  <td><?php echo $row["date"];?></td>
  <td><?php echo $row["acc_manager"];?></td>
  <td><?php echo $row["client"];?></td>
  <td><?php echo $row["user_id"];?></td>
  <td><?php echo $row["total_no_of_vehicles"];?></td>
  <td><?php echo $row["pay_pending"];?></td>
  <td><?php echo $row["no_of_removed_devices"];?></td>
  <td><?php echo $row["reg_no_of_vehicles"];?></td>
  <td><?php echo $row["imei_of_removed_devices"];?></td>
  <td><?php echo $row["psd_client_name"];?></td>
  <td><?php echo $row["psd_reg_no"];?></td>
  <td><?php echo $row["psd_payment"];?></td>
  <td><?php echo $row["sim_status"];?></td>
  <td><?php echo $row["sim_no_to_be_deactivate"];?></td>
  <td><?php echo $row["deactivate_temp"];?></td>
  <td><?php echo $row["reason"];?></td>
  <td><a href="update_deactivation_of_account.php?id=<?php echo $row["id"];?>">Edit</a></td>
    
  

</tr> <?php $i++; }?>
</table>

</form>

</body>
</html>
