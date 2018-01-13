<?php
include('lock.php');
//error_reporting(0);
include ('connection.php');

if(isset($_POST['formnobtn'])){
$chk_id =$_POST['formnobtn'];

for($i=0;$i<count($chk_id);$i++){
//echo "Update device_change set  pay_status=1  and device_old_paid_unpaid=1 where id ='".$chk_id[$i]."'";
 mysql_query("Update deletion set  psd_paid!=\"\" where id ='".$chk_id[$i]."'");

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
<?php include("header.php"); ?>
<br />

<br />
 <?php
 include ('Pagination.php');
  $num=mysql_num_rows(mysql_query("SELECT * FROM deletion order by id desc"));
$Pagination = new Pagination($num, 10, array(5, 10, 25, "All"), "comments", "pageOff", "pageOn", "pageSelect", "pageErrors");
echo $Pagination->display();
echo $Pagination->displaySelectInterface();
 $start = $Pagination->getEntryStart();
 $end = $Pagination->getEntryEnd();
$query = mysql_query("SELECT * FROM deletion where paid_unpaid=\"\" order by id desc LIMIT $start,$end");
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
  <td>No Of Vehicle</td>
  <td>Reg No</td>
  <td>IMEI</td>
  <td>Present Status Of Location</td>
  <td>Present Status Of Ownership</td>
  <td>Paid/Unpaid</td>
  <td>Deactivation Of Sim</td>
  <td>Sim Status</td>
  <td>Reason</td>
   <td>Sim To Be Deactivate</td>
   <td>Edit</td>
  
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
  <td><?php echo $row["no_of_vehicles"];?></td>
  <td><?php echo $row["reg_no"];?></td>
  <td><?php echo $row["imei"];?></td>
  <td><?php echo $row["ps_of_location"];?></td>
  <td><?php echo $row["ps_of_ownership"];?></td>
  <td><?php echo $row["paid_unpaid"];?></td>
  <td><?php echo $row["deactivation_of_sim"];?></td>
  <td><?php echo $row["sim_status"];?></td>
  <td><?php echo $row["reason"];?></td>
  <td><?php echo $row["sim_to_be_deactivate"];?></td>
  <td><a href="sarvesh_update_deletion.php?id=<?php echo $row["id"];?>">Edit</a></td>
  
</tr> <?php $i++; }?>
</table>

</form>

</body>
</html>
