<?php
include("lock.php");
error_reporting(0);
include ('connection.php');

if(isset($_POST['formnobtn'])){
$chk_id =$_POST['formnobtn'];

for($i=0;$i<count($chk_id);$i++){
mysql_query("Update imei_change set new_imei_paid_unpaid!=\"\" and pay_status!=\"\" where id ='".$chk_id[$i]."'");
}
}
   
  //$sql="select * from imei_change";
  //$search=mysql_query($sql);
?>



<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
<title>Untitled Document</title>
<link rel="stylesheet" href="demo.css" type="text/css" media="all" />
<script type="text/javascript" src="jQuery 1.9.1.js"></script>
<script type="text/javascript">
function submit1()
{
    $('form#formnobtn').submit();
}
function myFunction()
{
var x;
var r=confirm("You Want to Approve This Request!");
if (r==true)
  {
  x="You pressed OK!";
  }
else
  {
  x="You pressed Cancel!";
  }
document.getElementById("formnobtn").innerHTML=x;
}

</script>

</head>

<body>
<?php include("header.php"); ?>
<br />
<?php
include ('Pagination.php');
$num=mysql_num_rows(mysql_query("SELECT * FROM imei_change"));
$Pagination = new Pagination($num, 10, array(5, 10, 25, "All"), "comments", "pageOff", "pageOn", "pageSelect", "pageErrors");
echo $Pagination->display();
echo $Pagination->displaySelectInterface();
 $start = $Pagination->getEntryStart();
 $end = $Pagination->getEntryEnd();
//echo "SELECT * FROM new_account_creation LIMIT $start,$end";
$query = mysql_query("SELECT * FROM imei_change where new_imei_paid_unpaid=\"\" and pay_status=\"\" order by id desc LIMIT $start,$end");

?>
<br />
<br />


    <form method="POST" id="formnobtn">
    <table border="1" width="100%" style="font-family:Arial, Helvetica, sans-serif; font-size:14px;">
<tr style="font-weight:bold;" align="center">
<td>SL. No</td>
<td>Date</td>
  <td>Client</td>
  <td>User Id</td>
  <td>vehicle</td>
  <td>Device Model</td>
  <td>Repair Date</td>
  <td>Old Details IMEI</td>
  <td>Old Details Device ID</td>
  <td>Old Details SIM</td>
  <td>New Details IMEI</td>
  <td>New Details Device ID</td>
  <td>New Details SIM</td>
  <td>Reason</td>
  <td>New IMEI Paid/Unpaid</td>
  <td>Payment Status</td>
  <td>Billed/Unbilled</td>
<td>Action</td>
</tr>
<?php 
$i=1;
while($row=mysql_fetch_array($query))
{
?>
<tr>
<td><?php echo $i?></td>
  <td><?php echo $row["date"];?></td>
  <td><?php echo $row["client"];?></td>
  <td><?php echo $row["user_id"];?></td>
  <td><?php echo $row["vehicle"];?></td>
  <td><?php echo $row["device_model"];?></td>
  <td><?php echo $row["repair_date"];?></td>
  <td><?php echo $row["od_imei"];?></td>
  <td><?php echo $row["od_device_id"];?></td>
  <td><?php echo $row["od_sim"];?></td>
  <td><?php echo $row["nd_imei"];?></td>
  <td><?php echo $row["nd_device_id"];?></td>
  <td><?php echo $row["nd_sim"];?></td>
  <td><?php echo $row["reason"];?></td>
  <td><?php echo $row["new_imei_paid_unpaid"];?></td>
  <td><?php echo $row["pay_status"];?></td>
  <td><?php echo $row["billed_unbilled"];?></td>
   <td><a href="update_imei_change.php?id=<?php echo $row["id"];?>">Edit</a></td>

</tr> <?php $i++; }?>
</table>

</form>

</body>
</html>
