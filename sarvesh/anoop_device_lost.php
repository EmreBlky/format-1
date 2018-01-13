<?php
include("lock.php");
//error_reporting(0);
include ('connection.php');

if(isset($_POST['formnobtn'])){
$chk_id =$_POST['formnobtn'];

for($i=0;$i<count($chk_id);$i++){
//echo "Update device_change set  pay_status=1  and device_old_paid_unpaid=1 where id ='".$chk_id[$i]."'";
 mysql_query("Update device_lost set  odd_sim!=\"\" and ndd_sim!=\"\"  where id ='".$chk_id[$i]."'");

}
}

  
  ?>
<?php

?>



<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
<title>Untitled Document</title>
<link rel="stylesheet" href="demo.css" type="text/css" media="all" />
<script type="text/javascript" src="jQuery 1.9.1.js"></script>

</head>

<body>
<?php include("anoop_header.php"); ?>
<br /><br />
 <?php
 include ('Pagination.php');
  $num=mysql_num_rows(mysql_query("SELECT * FROM device_lost order by id desc"));
$Pagination = new Pagination($num, 10, array(5, 10, 25, "All"), "comments", "pageOff", "pageOn", "pageSelect", "pageErrors");
echo $Pagination->display();
echo $Pagination->displaySelectInterface();
 $start = $Pagination->getEntryStart();
 $end = $Pagination->getEntryEnd();
$query = mysql_query("SELECT * FROM device_lost where odd_paid_unpaid!=\"\" and ndd_paid_unpaid!=\"\" and odd_sim=\"\" and ndd_sim=\"\"  order by id desc LIMIT $start,$end");   
?>
    <form method="POST">
    <table border="1" width="100%" style="font-family:Arial, Helvetica, sans-serif; font-size:13px;">
<tr style="font-weight:bold;" align="center">
<td>SL.No</td>
<td>Date</td>
 <td>Account Manager</td>
  <td>Client</td>
  <td>User</td>
  <td>Old Device Detail Device Model</td>
  <td>Old Device Detail Reg No</td>
  <td>Old Device Detail Device Id</td>
  <td>Old Device Detail IMEI</td>
  <td>Old Device Detail SIM</td>
  <td>Old Device Detail Paid/Unpaid</td>
  <td>New Device Detail Reg No</td>
  <td>New Device Detail Device Id</td>
  <td>New Device Detail IMEI</td>
  <td>New Device Detail SIM</td>
  <td>New Device Detail Paid/Unpaid</td>
  <td>New Device Detail Device Model</td>
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
  <td><?php echo $row["odd_device_model"];?></td>
  <td><?php echo $row["odd_reg_no"];?></td>
  <td><?php echo $row["odd_device_id"];?></td>
  <td><?php echo $row["odd_imei"];?></td>
  <td><?php echo $row["odd_sim"];?></td>
  <td><?php echo $row["odd_paid_unpaid"];?></td>
  <td><?php echo $row["ndd_reg_no"];?></td>
  <td><?php echo $row["ndd_device_id"];?></td>
  <td><?php echo $row["ndd_imei"];?></td>
  <td><?php echo $row["ndd_sim"];?></td>
  <td><?php echo $row["ndd_paid_unpaid"];?></td>
  <td><?php echo $row["ndd_device_model"];?></td>
  <td><a href="anoop_update_device_lost.php?id=<?php echo $row["id"];?>">Edit</a></td>
  
</tr> <?php $i++; }?>
</table>

</form>

</body>
</html>
