<?php
include('lock.php');
include ('connection.php');
//error_reporting(0);
 
if(isset($_POST['formnobtn'])){
$chk_id =$_POST['formnobtn'];

for($i=0;$i<count($chk_id);$i++){

 mysql_query("Update transfer_the_vehicle set transfer_from_paid_unpaid!=\"\"  where id ='".$chk_id[$i]."'");

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
<br />
<?php
include ('Pagination.php');
$num=mysql_num_rows(mysql_query("SELECT * FROM transfer_the_vehicle where  transfer_from_paid_unpaid=\"\" and transfer_from_imei!=\"\" order by id DESC"));
$Pagination = new Pagination($num, 10, array(5, 10, 25, "All"), "pageOff", "pageOn", "pageSelect", "pageErrors");
echo @$Pagination->display();
echo @$Pagination->displaySelectInterface();
 $start = $Pagination->getEntryStart();
 $end = $Pagination->getEntryEnd();
//echo "SELECT * FROM new_account_creation LIMIT $start,$end";
$query = mysql_query("SELECT * FROM transfer_the_vehicle where transfer_from_paid_unpaid=\"\" and transfer_from_imei!=\"\" order by id DESC LIMIT  $start,$end");

?>

</br>

    <form method="POST">
    <table border="1" width="100%" style="font-family:Arial, Helvetica, sans-serif; font-size:13px;">
<tr style="font-weight:bold;" align="center">
<td>SL.No</td>
<td>Date</td>
  <td>Account Manager</td>
  <td>Transfer From Client</td>
   <td>Transfer From User</td>
  <td>Transfer From Reg No</td>
  <td>Transfer From IMEI</td>
  <td>Transfer From Paid/Unpaid</td>
  <td>Transfer To Client</td>
  <td>Transfer To User</td>
  <td>Transfer To Billing</td>
  <td>Reason</td>
  <td>Action</td>
</tr>
<?php 
$i=1;
while($row=mysql_fetch_array($query))
{
?>
<tr align="center">
<td><?php echo $i?></td>
  <td><?php echo $row["date"];?></td>
  <td><?php echo $row["acc_manager"];?></td>
  <td><?php echo $row["transfer_from_client"];?></td>
   <td><?php echo $row["transfer_from_user"];?></td>
  <td><?php echo $row["transfer_from_reg_no"];?></td>
  <td><?php echo $row["transfer_from_imei"];?></td>
  <td><?php echo $row["transfer_from_paid_unpaid"];?></td>
  <td><?php echo $row["transfer_to_client"];?></td>
  <td><?php echo $row["transfer_to_user"];?></td>
  <td><?php echo $row["transfer_to_billing"];?></td>
  <td><?php echo $row["reason"];?></td>
  <td><a href="sarvesh_update_transfer_the_vehicle.php?id=<?php echo $row["id"];?>">Edit</a></td>  

</tr> <?php $i++; }?>
</table>

</form>

</body>
</html>
