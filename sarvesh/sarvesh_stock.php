<?php
//session_start();
error_reporting(0);
include("lock.php");
include ('connection.php');

if(isset($_POST['formnobtn'])){
$chk_id =$_POST['formnobtn'];

for($i=0;$i<count($chk_id);$i++){
mysql_query("Update stock_if_old_stock_report_has_been_submitted set final_status ='1'  where id ='".$chk_id[$i]."'");
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
$num=mysql_num_rows(mysql_query("SELECT * FROM stock_if_old_stock_report_has_been_submitted where final_status!=1"));
$Pagination = new Pagination($num, 10, array(5, 10, 25, "All"), "comments", "pageOff", "pageOn", "pageSelect", "pageErrors");
echo $Pagination->display();
echo $Pagination->displaySelectInterface();
 $start = $Pagination->getEntryStart();
 $end = $Pagination->getEntryEnd();
 $query = mysql_query("SELECT * FROM stock_if_old_stock_report_has_been_submitted  where final_status!=1 ORDER BY id DESC LIMIT $start,$end");

?>
<br />
<br />


    <form method="POST" id="formnobtn">
    <table border="1" width="100%" style="font-family:Arial, Helvetica, sans-serif; font-size:14px;">
<tr style="font-weight:bold;" align="center">
<td>SL. No</td>
<td>Date</td>
  <td>Device Type/Material</td>
  <td>No Of Units/Qty</td>
  <td>Current Stock</td>
  <td>Current Oreders,If Any</td>
  <td>Final Status</td>
</tr>
<?php 
$i=1;
while($row=mysql_fetch_array($query))
{
?>
<tr>
<td><?php echo $i ?></td>
<td><?php echo $row["date"];?></td>
  <td><?php echo $row["device_type_material"];?></td>
  <td><?php echo $row["no_of_units_qty"];?></td>
  <td><?php echo $row["current_stock"];?></td>
  <td><?php echo $row["current_orders_if_any"];?></td>
  <td><input type="checkbox" id="formnobtn" name="formnobtn[]" value="<?php echo $row["id"]; ?>" <?php if($row["final_status"]==1){ echo "checked" ; } else if($row["final_status"]==0){echo "unchecked";} ?> onchange="submit1();myFunction();" /></td>  
</tr> <?php $i++; }?>
</table>

</form>

</body>
</html>
