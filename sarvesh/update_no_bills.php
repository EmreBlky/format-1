<?php
include("lock.php");
//session_start();
error_reporting(0);
include ('connection.php');

if(isset($_POST['formnobtn'])){
$chk_id =$_POST['formnobtn'];

for($i=0;$i<count($chk_id);$i++){
mysql_query("Update no_bills set check_status ='1' where id ='".$chk_id[$i]."'");
}
}

   
 // $sql="select * from device_change";
 // $search=mysql_query($sql);


  
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
$num=mysql_num_rows(mysql_query("SELECT * FROM no_bills where check_status!=1"));
$Pagination = new Pagination($num, 10, array(5, 10, 25, "All"), "comments", "pageOff", "pageOn", "pageSelect", "pageErrors");
echo $Pagination->display();
echo $Pagination->displaySelectInterface();
 $start = $Pagination->getEntryStart();
 $end = $Pagination->getEntryEnd();
//echo "SELECT * FROM new_account_creation LIMIT $start,$end";
$query = mysql_query("SELECT * FROM no_bills where check_status!=1 and approve_status=1 order by id desc LIMIT $start,$end");

?>
<br />
<br />


    <form method="POST" id="formnobtn">
    <table border="1" width="100%" style="font-family:Arial, Helvetica, sans-serif; font-size:14px;">
<tr style="font-weight:bold;" align="center">
<td>SL. No</td>
<td>Date</td>
  <td>Account Manager</td>
  <td>Client</td>
  <td>User Id</td>
  <td>No Of Vehicles</td>
  <td>Reg No</td>
  <td>IMEI Device</td>
  <td>Date Of Installation</td>
  <td>Duration</td>
  <td>Rent/Device</td>
  <td>Reason</td>
  <td>Provision Bills</td>
   <td>Check Status</td>
  
</tr>
<?php 
$i=1;
while($row=mysql_fetch_array($query))
{
?>
<tr>
<td><?php echo $i?></td>
<td><?php echo $row["date"];?></td>
  <td><?php echo $row["acc_manager"];?></td>
  <td><?php echo $row["client"];?></td>
  <td><?php echo $row["user_id"];?></td>
  <td><?php echo $row["no_of_vehicles"];?></td>
  <td><?php echo $row["reg_no"];?></td>
  <td><?php echo $row["imei_device"];?></td>
  <td><?php echo $row["date_of_install"];?></td>
  <td><?php echo $row["duration"];?></td>
  <td><?php echo $row["rent_device"];?></td>
  <td><?php echo $row["reason"];?></td>
  <td><?php echo $row["provision_bill"];?></td>
  <td><input type="checkbox" id="formnobtn" name="formnobtn[]" value="<?php echo $row["id"]; ?>" <?php if($row["check_status"]==1){ echo "checked" ; } else if($row["check_status"]==0){echo "unchecked";} ?> onchange="submit1();myFunction();" /></td>
</tr> <?php $i++;}?>
</table>

</form>

</body>
</html>
