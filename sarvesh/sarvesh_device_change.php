<?php
include('lock.php');
error_reporting(0);
include ('connection.php');

if(isset($_POST['formnobtn'])){
$chk_id =$_POST['formnobtn'];

for($i=0;$i<count($chk_id);$i++){
//echo "Update device_change set  pay_status=1  and device_old_paid_unpaid=1 where id ='".$chk_id[$i]."'";
 mysql_query("Update device_change set  pay_status!=\"\" and device_old_paid_unpaid!=\"\"  where id ='".$chk_id[$i]."'");

}
}
   
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
<?php include("header.php"); ?>
<br />
<?php
 include ('Pagination.php');
 $num=mysql_num_rows(mysql_query("select count(id)from device_change where pay_status=\"\" and device_old_paid_unpaid=\"\" order by id desc"));
$Pagination = new Pagination($num, 10, array(5, 10, 25, "All"), "comments", "pageOff", "pageOn", "pageSelect", "pageErrors");
echo $Pagination->display();
echo $Pagination->displaySelectInterface();
 $start = $Pagination->getEntryStart();
 $end = $Pagination->getEntryEnd();
$query = mysql_query("select * from device_change where pay_status=\"\" and device_old_paid_unpaid=\"\" order by id desc   LIMIT $start,$end");   
?>
<br />
<br />

    <form method="POST" id="formnobtn">
    <table border="1" width="100%" style="font-family:Arial, Helvetica, sans-serif; font-size:14px;">
<tr style="font-weight:bold;" align="center">
<td>SL.No</td>
<td>Date</td>
  <td>Account Manager</td>
  <td>Client</td>
  <td>User Id</td>
  <td>Device Model</td>
  <td>Device_IMEI</td>
  <td>Reg No</td>
  <td>Date Of Installation</td>
  <td>Payment Status</td>
  <td>RDD Device Model</td>
  <td>RDD Device IMEI</td>
  <td>RDD Reg No</td>
  <td>RDD Date</td>
  <td>RDD Reason</td>
  <td>Device New</td>
  <td>Device Old Client Detail</td>
  <td>Device Old Paid/Unpaid</td>
  <td>SIM Old</td>
  <td>SIM New</td>
  <td>ACTION</td>
  
</tr>
<?php 
$j=1;
while($row=mysql_fetch_array($query))
{
?>
<tr align="center">
<td><?php echo $j ?></td>
  <td><?php echo $row["date"];?></td>
  <td><?php echo $row["acc_manager"];?></td>
  <td><?php echo $row["client"];?></td>
  <td><?php echo $row["user_id"];?></td>
  <td><?php echo $row["device_model"];?></td>
  <td><?php echo $row["device_imei"];?></td>
  <td><?php echo $row["reg_no"];?></td>
  <td><?php echo $row["date_of_install"];?></td>
  <td><?php echo $row["pay_status"];?></td>
  <td><?php echo $row["rdd_device_model"];?></td>
  <td><?php echo $row["rdd_device_imei"];?></td>
  <td><?php echo $row["rdd_reg_no"];?></td>
  <td><?php echo $row["rdd_date"];?></td>
  <td><?php echo $row["rdd_reason"];?></td>
  <td><?php echo $row["device_new"];?></td>
  <td><?php echo $row["device_old_client_detail"];?></td>
  <td><?php echo $row["device_old_paid_unpaid"];?></td>
  <td><?php echo $row["sim_old"];?></td>
  <td><?php echo $row["sim_new"];?></td>
  <td><a href="update.php?id=<?php echo $row["id"];?>">Edit</a></td>
  
  
</tr> <?php $j++; }?>
</table>

</form>

</body>
</html>
