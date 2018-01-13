<?php
include("include/header.inc.php");
include ("config.php");


//$rs = mysql_query("SELECT * FROM services WHERE pending='1'");
/*$id=$_GET['id'];
$sql="DELETE FROM services WHERE id='$id'";
$result=mysql_query($sql);*/


$id=$_GET['id'];
if($_GET['action']=="close")
{
$query1="UPDATE installation SET pending_closed='1'  WHERE id='$id'";
mysql_query($query1);
}


	$rs = mysql_query("SELECT * FROM installation WHERE (pending='1' or newpending='1')  and (pending_closed='0') and branch_id=".$_SESSION['branch_id'] ." order by id desc");	

?>
<script type="text/javascript">
		$(document).ready(function(){
			

			$("#myTable").tablesorter().tablesorterPager({container: $("#pagination")});
		});
	</script>

 
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
<title>Untitled Document</title>
</head>

<body>
<form name="frmMain" action="" method="post">

<table width="745" border="1" cellpadding="0" cellspacing="0" align="center" id="myTable" class="tablesorter"><thead>
<tr align="Center">
		<th width="11%" align="center"><font color="#0E2C3C"><b>Sales Person </b></font></th>
		<th width="11%" align="center"><font color="#0E2C3C"><b>ClientName </b></font></th>
		<th width="11%" align="center"><font color="#0E2C3C"><b>No.Of Vehicle </b></font></th>
		<th width="11%" align="center"><font color="#0E2C3C"><b>Location</b></font></th>
		<th width="11%" align="center"><font color="#0E2C3C"><b>Model</b></font></th>
        <th width="11%" align="center"><font color="#0E2C3C"><b>time </b></font></th>
		<th width="11%" align="center"><font color="#0E2C3C"><b>Vehicle Type</b></font></th>
		<th width="11%" align="center"><font color="#0E2C3C"><b>Immobilzer</b></font></th>
		<th width="11%" align="center"><font color="#0E2C3C"><b>DIMTS </b></font></th>
		<th width="11%" align="center"><font color="#0E2C3C"><b>Demo </b></font></th>
		<th width="11%" align="center"><font color="#0E2C3C"><b>Amount </b></font></th>
		
		<th width="11%" align="center"><font color="#0E2C3C"><b>Contact No</b></font></th>
        <th width="11%" align="center"><font color="#0E2C3C"><b>Contact Person</b></font></th>
        <th width="11%" align="center"><font color="#0E2C3C"><b>Contact Person No</b></font></th>
		<td width="11%" align="center"><font color="#0E2C3C"><b>Edit</b></font></td>
		<td width="11%" align="center"><font color="#0E2C3C"><b>Close</b></font></td>
		<!--<td width="11%" align="center"><font color="#0E2C3C"><b>Delete</b></font></td>-->
		
	</tr></thead>
			<tbody>
	<?php  
    while ($row = mysql_fetch_array($rs)) {
	
    ?>  
	<tr align="Center">
		<td width="11%" align="center">&nbsp;<?php $sales=mysql_fetch_array(mysql_query("select name from sales_person where id='$row[sales_person]' ")); echo $sales['name'];?></td>
		<td width="11%" align="center">&nbsp;<?php echo $row['client'];?></td>
		<td width="11%" align="center">&nbsp;<?php echo $row['no_of_vehicals'];?></td>
		
		
		<td width="10%" align="center">&nbsp;<?php echo $row['location'];?></td>
		<td width="10%" align="center">&nbsp;<?php echo $row['model'];?></td>
		<td width="12%" align="center">&nbsp;<?php echo $row['time'];?></td>
		<td width="12%" align="center">&nbsp;<?php echo $row['veh_type'];?></td>
		<td width="12%" align="center">&nbsp;<?php echo $row['immoblizer_type'];?></td>
		<td width="12%" align="center">&nbsp;<?php echo $row['dimts'];?></td>
		<td width="12%" align="center">&nbsp;<?php echo $row['demo'];?></td>
		<td width="12%" align="center">&nbsp;<?php echo $row['payment_req'];?></td>
		
        <td width="12%" align="center">&nbsp;<?php echo $row['contact_number'];?></td>
        <td width="12%" align="center">&nbsp;<?php echo $row['contact_person'];?></td>
        <td width="12%" align="center">&nbsp;<?php echo $row['contact_person_no'];?></td>
		<td width="10%" align="center">&nbsp;<a href="add_installation.php?id=<?=$row['id'];?>&pending=1&action=editp">Edit</a></td>
				<td width="10%" align="center">&nbsp;<a href="?id=<?=$row['id'];?>&pending=1&action=close&pg=<? echo $pg;?>">Close</a></td>

		<!--<td width="12%" align="center">&nbsp;<a href="services.php?id=<?php echo $row['id'];?>">Delete</a></td>-->
		
	</tr>
		<?php  
    }
	 
    ?>
	
</table> 
</form>

<div id="pagination" class="pager">
			<form>
				<img src="images/sorting/first.png" class="first"/>
				<img src="images/sorting/prev.png" class="prev"/>
				<input type="text" class="pagedisplay" name="page"/>
				<img src="images/sorting/next.png" class="next"/>
				<img src="images/sorting/last.png" class="last"/>
				<select class="pagesize">
					<option selected="selected"  value="10">10</option>
					<option value="20">20</option>
					<option value="30">30</option>
					<option value="40">40</option>
					<option value="50">50</option>
				</select>
			</form>
		</div>
        <br/></br>
<?
include("include/footer.inc.php");

?>
 