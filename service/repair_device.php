<?php
include("include/header.inc.php");
include ("config.php");


//$rs = mysql_query("SELECT * FROM repai_device");
$id=$_GET['id'];
$sql="DELETE FROM repai_device WHERE id='$id'";
$result=mysql_query($sql);


$username=$_SESSION['username'];
$userId=$_SESSION['userId'];
if($username=='gurmeet')
	{
	$sql="SELECT * FROM device order by id desc";
	}else
	{
	$sql="SELECT * FROM repai_device order by id desc";
	}
	
	
	
	$rs = mysql_query($sql);
	
	
	
	

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

<table width="773" border="1" cellpadding="0" cellspacing="0" align="center" id="myTable" class="tablesorter">
<thead>
<tr align="Center">
		<th width="12%" align="center"><font color="#0E2C3C"><b>Client Name </b></font></th>
		<th width="11%" align="center"><font color="#0E2C3C"><b>Vehicle No</b></font></th>
		<th width="9%" align="center"><font color="#0E2C3C"><b>Model </b></font></th>
		<th width="12%" align="center"><font color="#0E2C3C"><b>Device Id</b></font></th>
		<th width="10%" align="center"><font color="#0E2C3C"><b>Imei</b></font></th>
		<th width="10%" align="center"><font color="#0E2C3C"><b>SIM Status</b></font></th>
		<th width="12%" align="center"><font color="#0E2C3C"><b>Date</b></font></th>
		<th width="18%" align="center"><font color="#0E2C3C"><b>Problem</b></font></th>
        <th width="7%" align="center"><font color="#0E2C3C"><b>Antina</b></font></th>
		<td width="9%" align="center"><font color="#0E2C3C"><b>Edit</b></font></td>
		<!--<td width="11%" align="center"><font color="#0E2C3C"><b>Delete</b></font></td>-->
		
		
	</tr></thead>
			<tbody>
	<?php  
    while ($row = mysql_fetch_array($rs)) {
	
    ?>  
	<tr align="Center">
	
		<td width="12%" align="center">&nbsp;<?php echo $row['name'];?></td>
		<td width="11%" align="center">&nbsp;<?php echo $row['veh_reg'];?></td>
		
		<td width="9%" align="center">&nbsp;<?php echo $row['model'];?></td>
		<td width="12%" align="center">&nbsp;<?php echo $row['deviceid'];?></td>
		<td width="10%" align="center">&nbsp;<?php echo $row['Imei'];?></td>
		<td width="10%" align="center">&nbsp;<?php echo $row['sim_status'];?></td>
		<td width="12%" align="center">&nbsp;<?php echo $row['date'];?></td>
		<td width="18%" align="center">&nbsp;<?php echo $row['problem'];?></td>
        <td width="7%" align="center">&nbsp;<?php echo $row['antina'];?></td>
		<td width="9%" align="center">&nbsp;<a href="edit_device.php?id=<?=$row['id'];?>&action=edit">Edit</a></td>
		<!--<td width="10%" align="center">&nbsp;<a href="repair_device.php?id=<?php echo $row['id'];?>">Delete</a></td>-->
		
	</tr>
		<?php  
    }
	 
    ?>
	<tr><td colspan="9" align="center"></td></tr>  </tbody>
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
        <br/><br/>

<?
include("include/footer.inc.php");

?>