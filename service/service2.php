<?php
include("include/header.inc.php");
include ("config.php");


$id=$_GET['id'];

if($_GET['action']=='delete')
{
$sql="DELETE FROM services WHERE id='$id'";
$result=mysql_query($sql);
}

$rs = mysql_query("SELECT * FROM services order by id desc");

?>






 
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
<title>Untitled Document</title>
</head>

<body>
<form name="frmMain" action="" method="post">

<table width="745" border="1" cellpadding="0" cellspacing="0" align="center">
<tr align="Center">
		<td width="11%" align="center"><font color="#0E2C3C"><b>ClientName </b></font></td>
		<td width="11%" align="center"><font color="#0E2C3C"><b>Vehicle No</b></font></td>
		<td width="11%" align="center"><font color="#0E2C3C"><b>Notworking </b></font></td>
		<td width="11%" align="center"><font color="#0E2C3C"><b>Location</b></font></td>
		<td width="11%" align="center"><font color="#0E2C3C"><b>Available Time</b></font></td>
		<td width="11%" align="center"><font color="#0E2C3C"><b>Person Name</b></font></td>
		<td width="11%" align="center"><font color="#0E2C3C"><b>Contact No</b></font></td>
		<td width="11%" align="center"><font color="#0E2C3C"><b>Edit</b></font></td>
		<td width="11%" align="center"><font color="#0E2C3C"><b>Delete</b></font></td>
		
		
	</tr>
	<?php  
    while ($row = mysql_fetch_array($rs)) {
	
    ?>  
	<tr align="Center">
	
		<td width="11%" align="center">&nbsp;<?php echo $row['name'];?></td>
		<td width="11%" align="center">&nbsp;<?php echo $row['veh_reg'];?></td>
		
		<td width="12%" align="center">&nbsp;<?php echo $row['Notwoking'];?></td>
		<td width="10%" align="center">&nbsp;<?php echo $row['location'];?></td>
		<td width="10%" align="center">&nbsp;<?php echo $row['atime'];?></td>
		<td width="10%" align="center">&nbsp;<?php echo $row['pname'];?></td>
		<td width="12%" align="center">&nbsp;<?php echo $row['cnumber'];?></td>
		<td width="10%" align="center">&nbsp;<a href="edit_delete.php?id=<?=$row['id'];?>&action=edit">Edit</a></td>
		<td width="12%" align="center">&nbsp;<a href="services.php?id=<?php echo $row['id'];?>&action=delete">Delete</a></td>
		
	</tr>
		<?php  
    }
	 
    ?> 
</table> 
</form>
</body>
</html>
<?
include("include/footer.inc.php");

?>
