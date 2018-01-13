<?php
include("lock.php");
error_reporting(0);
include ('connection.php');

if(isset($_POST['formnobtn'])){
$chk_id =$_POST['formnobtn'];

for($i=0;$i<count($chk_id);$i++){
mysql_query("Update new_device_addition set sarvesh_approve='1' where id ='".$chk_id[$i]."'");
}
}
 

  ?>



<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
<title>Internal Process</title>
<script type="text/javascript" src="jQuery 1.9.1.js"></script>
<link rel="stylesheet" href="../demo.css" type="text/css" media="all" />
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

function myFunction1()
{
var x;
var r=confirm("You Want to send in pending!!");
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
$Pagination = new Pagination(100, 10, array(5, 10, 25, "All"), "pageOff", "pageOn", "pageSelect", "pageErrors");
echo $Pagination->display();
echo $Pagination->displaySelectInterface();
 $start = $Pagination->getEntryStart();
 $end = $Pagination->getEntryEnd();
//echo "SELECT * FROM new_account_creation LIMIT $start,$end";
$query = mysql_query("SELECT * FROM new_device_addition where sarvesh_approve!=1 and final_status=1 LIMIT $start,$end");

?>

    <form method="POST" id="formnobtn">
    <table border="1" width="100%" style="font-family:Arial, Helvetica, sans-serif; font-size:14px;">
<tr style="font-weight:bold;" align="center">
<td>SL.No</td>
<td>Date</td>
  <td>Account Manager</td>
  <td>Client</td>
  <td>User Id</td>
  <td>Vehicles No</td>
  <td>Device Id</td>
  <td>IMEI</td>
  <td>Device Model</td>
  <td>AC</td>
  <td>Immobilizer</td>
  <td>New Device</td>
   <td>Old Device Client</td>
  <td>Old Device Reason Of Removal</td>
  <td>Billing Yes/No</td>
  <td>Billing If No Reason</td>

  <td>Approval</td>
      
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
  <td><?php echo $row["client"];?></td>
  <td><?php echo $row["user_id"];?></td>
  <td><?php echo $row["vehicle_no"];?></td>
  <td><?php echo $row["device_id"];?></td>
  <td><?php echo $row["imei"];?></td>
  <td><?php echo $row["device_model"];?></td>
  <td><?php echo $row["ac"];?></td>
  <td><?php echo $row["immobilizer"];?></td>
  <td><?php echo $row["new_device"];?></td> 
  <td><?php echo $row["old_device_client"];?></td> 
  <td><?php echo $row["old_device_reason_of_removal"];?></td> 
  <td><?php echo $row["billing_yes_no"];?></td> 
  <td><?php echo $row["billing_if_no_reason"];?></td>   
   
  <td><input type="checkbox" id="formnobtn" name="formnobtn[]" value="<?php echo $row["id"]; ?>" /></td>

</tr> <?php }?>
</table>

<div style="margin-left:910px;">
<input type="checkbox"  onclick="submit1();myFunction();" />Done<br/>
<input type="checkbox" onclick="myFunction1();"/>Pending<br/>
<input type="checkbox" value="Confussion" />Confussion
</div>

</form>

</body>
</html>
