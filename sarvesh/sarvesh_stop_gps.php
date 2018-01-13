<?php
include('lock.php');
//error_reporting(0);
include ('connection.php');
 
 
 if(isset($_POST['formnobtn'])){
$chk_id =$_POST['formnobtn'];

for($i=0;$i<count($chk_id);$i++){
//echo "Update device_change set  pay_status=1  and device_old_paid_unpaid=1 where id ='".$chk_id[$i]."'";
 mysql_query("Update stop_gps set  psd_paid!=\"\" and psd_unpaid!=\"\" and ps_rent!=\"\" where id ='".$chk_id[$i]."'");

}
}
 
      //$sql="select * from stop_gps";
  //$search=mysql_query($sql);

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
<br />
<?php
include ('Pagination.php');
 $num=mysql_num_rows(mysql_query("SELECT * FROM stop_gps order by id desc"));
$Pagination = new Pagination($num, 10, array(5, 10, 25, "All"), "comments", "pageOff", "pageOn", "pageSelect", "pageErrors");
echo $Pagination->display();
echo $Pagination->displaySelectInterface();
 $start = $Pagination->getEntryStart();
 $end = $Pagination->getEntryEnd();
//echo "SELECT * FROM new_account_creation LIMIT $start,$end";
$query = mysql_query("SELECT * FROM stop_gps where psd_paid=\"\" and psd_unpaid=\"\" and ps_rent=\"\" order by id desc LIMIT $start,$end");
?>
    <form method="POST">
    <table border="1" width="100%" style="font-family:Arial, Helvetica, sans-serif; font-size:13px;">
<tr style="font-weight:bold;" align="center">
<td>SL.No</td>
<td>Date</td>
  <td>Account Manager</td>
  <td>Client</td>
  <td>Total No Of Vehicle</td>
  <td>No Of Vehicle</td>
  <td>Registration No</td>
  <td>Present Status Of Location</td>
  <td>Present Status Of Ownership</td>
  <td>Reason</td>
  <td>Payment Status Device Paid</td>
  <td>Payment Status Device Unpaid</td>
  <td>Payment Status Rent</td>
  <td>Service Action</td>
  <td>Sales Action</td>
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
  <td><?php echo $row["tot_no_of_vehicle"];?></td>
  <td><?php echo $row["no_of_vehicle"];?></td>
  <td><?php echo $row["reg_no"];?></td>
  <td><?php echo $row["ps_of_location"];?></td>
  <td><?php echo $row["ps_of_ownership"];?></td>
  <td><?php echo $row["reason"];?></td>
  <td><?php echo $row["psd_paid"];?></td>
  <td><?php echo $row["psd_unpaid"];?></td>
  <td><?php echo $row["ps_rent"];?></td>
  <td><?php echo $row["service_action"];?></td>
  <td><?php echo $row["sales_action"];?></td>
   <td><a href="update_stop_gps.php?id=<?php echo $row["id"];?>">Edit</a></td>
  

</tr> <?php $i++; }?>
</table>

</form>

</body>
</html>
