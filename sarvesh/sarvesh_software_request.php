<?php
include("lock.php");
error_reporting(0);
include ('connection.php');

if(isset($_POST['formnobtn'])){
$chk_id =$_POST['formnobtn'];

for($i=0;$i<count($chk_id);$i++){
mysql_query("Update software_request set pay_ststus!=\"\" where id ='".$chk_id[$i]."'");
}
}
 
 // $sql="select * from software_request";
  //$search=mysql_query($sql);

  ?>



<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
<title>Internal Process</title>
<script type="text/javascript" src="jQuery 1.9.1.js"></script>

<link rel="stylesheet" href="demo.css" type="text/css" media="all" />
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
$num=mysql_num_rows(mysql_query("SELECT * FROM software_request"));

$Pagination = new Pagination($num, 10, array(5, 10, 25, "All"), "comments", "pageOff", "pageOn", "pageSelect", "pageErrors");
echo $Pagination->display();
echo $Pagination->displaySelectInterface();
 $start = $Pagination->getEntryStart();
 $end = $Pagination->getEntryEnd();
//echo "SELECT * FROM new_account_creation LIMIT $start,$end";
$query = mysql_query("SELECT * FROM software_request where pay_status=\"\" order by id desc LIMIT $start,$end");

?>
<br />
<br />


    <form method="POST" id="formnobtn">
    <table border="1" width="100%" style="font-family:Arial, Helvetica, sans-serif; font-size:14px;">
<tr style="font-weight:bold;" align="center">
<td>SL. No</td>
<td>Date</td>
  <td>Account Manager</td>
  <td>Company</td>
  <td>Main User Id</td>
  <td>Total No Of Vehicles</td>
  <td>Potential</td>
  <td>Payment Status</td>
  <td>Google Map</td>
  <td>Customize Report</td>
  <td>Admin</td>
  <td>Poi</td>
  <td>Others</td>
  <td>Action</td>
      
</tr>
<?php 
$i=1;
while($row=mysql_fetch_array($query))
{
?>
<tr align="center">
<td><?php echo $i?></td>
  <td><?php echo $row[date];?></td>
  <td><?php echo $row[acc_manager];?></td>
  <td><?php echo $row[company];?></td>
  <td><?php echo $row[main_user_id];?></td>
  <td><?php echo $row[total_no_of_vehicles];?></td>
  <td><?php echo $row[potential];?></td>
  <td><?php echo $row[pay_status];?></td>
  <td><?php echo $row[rs_google_map];?></td>
  <td><?php echo $row[rs_customize_report];?></td>
  <td><?php echo $row[rs_admin];?></td>
  <td><?php echo $row[rs_poi];?></td>
  <td><?php echo $row[rs_others];?></td>    
  <td><a href="update_software_request.php?id=<?php echo $row["id"];?>">Edit</a></td>


</tr> <?php $i++; }?>
</table>

</form>

</body>
</html>
