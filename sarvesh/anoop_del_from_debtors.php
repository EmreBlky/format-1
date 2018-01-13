<?php
include('lock.php');
//error_reporting(0);
include ('connection.php');
    
if(isset($_POST['formnobtn'])){
$chk_id =$_POST['formnobtn'];

for($i=0;$i<count($chk_id);$i++){

 mysql_query("Update del_form_debtors set date_of_creation!=\"\"   where id ='".$chk_id[$i]."'");

}
}
 

  ?>
<?php

?>



<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
<title>Internal Process</title>
<link rel="stylesheet" href="demo.css" type="text/css" media="all" />
<script type="text/javascript" src="jQuery 1.9.1.js"></script>

</head>

<body>
<?php include("anoop_header.php"); ?>
<br />

<br />
<?php
include ('Pagination.php');
 $num=mysql_num_rows(mysql_query("SELECT * FROM del_form_debtors order by id desc"));
$Pagination = new Pagination($num, 10, array(5, 10, 25, "All"), "comments", "pageOff", "pageOn", "pageSelect", "pageErrors");
echo $Pagination->display();
echo $Pagination->displaySelectInterface();
 $start = $Pagination->getEntryStart();
 $end = $Pagination->getEntryEnd();
$query = mysql_query("SELECT * FROM del_form_debtors where date_of_creation=\"\" and device_status!=\"\" and imei_of_removel_devices!=\"\" and reg_no!=\"\" order by id desc  LIMIT $start,$end");
?>

    <form method="POST">
    <table border="1" width="100%" style="font-family:Arial, Helvetica, sans-serif; font-size:13px;">
<tr style="font-weight:bold;" align="center">
<td>SL.No</td>
<td>Date</td>
  <td>Account Manager</td>
  <td>Client</td>
  <td>User Id</td>
  <td>Date Of Creation</td>
  <td>Total No Of Vehicle</td>
  <td>Total Payment Received</td>
  <td>Total Pending</td>
  <td>No Of Devices Removed</td>
  <td>Device Status</td>
  <td>Reason</td> 
  <td>IMEI Of Removel Device</td>  
  <td>Reg No</td>
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
  <td><?php echo $row["date_of_creation"];?></td>
  <td><?php echo $row["total_no_of_vehicle"];?></td>
  <td><?php echo $row["total_pay_rec"];?></td>
  <td><?php echo $row["total_pending"];?></td>
  <td><?php echo $row["no_of_devices_removed"];?></td>
  <td><?php echo $row["device_status"];?></td>
  <td><?php echo $row["reason"];?></td>
  <td><?php echo $row["imei_of_removel_devices"];?></td>
  <td><?php echo $row["reg_no"];?></td>
  <td><a href="anoop_update_del_from_debtors.php?id=<?php echo $row["id"];?>">Edit</a></td>
  
</tr> <?php $i++; }?>
</table>

</form>

</body>
</html>
