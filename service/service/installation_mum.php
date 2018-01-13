<?php
include("include/header.inc.php");
include ("config.php");


/*$id=$_GET['id'];

if($_GET['action']=='delete')
{
$sql="DELETE FROM installation WHERE id='$id'";
$result=mysql_query($sql);
}*/

	$rs = mysql_query("SELECT * FROM installation_mumbai order by id desc");
	
	
	

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

<table width="745" border="1" cellpadding="0" cellspacing="0" align="center" id="myTable" class="tablesorter">
 <thead>
<tr>
		<th width="11%" align="center"><font color="#0E2C3C"><b>Sales Person </b></font></th>
		<th width="11%" align="center"><font color="#0E2C3C"><b>Client</b></font></th>
		<th width="11%" align="center"><font color="#0E2C3C"><b>No. Of Vehicle </b></font></th>
		<th width="11%" align="center"><font color="#0E2C3C"><b>Location</b></font></th>
		<th width="11%" align="center"><font color="#0E2C3C"><b>Model</b></font></th>
		<th width="11%" align="center"><font color="#0E2C3C"><b>Time</b></font></th>
		<th width="11%" align="center"><font color="#0E2C3C"><b>Contact No</b></font></th>
        <th width="11%" align="center"><font color="#0E2C3C"><b>Contact Person</b></font></th>
        <th width="11%" align="center"><font color="#0E2C3C"><b>Contact Person No</b></font></th>
		<td width="11%" align="center"><font color="#0E2C3C"><b>Edit</b></font></td>
		<!--<td width="11%" align="center"><font color="#0E2C3C"><b>Delete</b></font></td>-->
		
		
	</tr></thead>
			<tbody>
	<?php  
    while ($row = mysql_fetch_array($rs)) {
	$sales=mysql_fetch_array(mysql_query("select name from sales_person where id='$row[sales_person]' "));
	
    ?>  
	<tr>
	
		<td>&nbsp;<?php echo $sales['name'];?></td>
		<td>&nbsp;<?php echo $row['client'];?></td>
		
		<td>&nbsp;<?php echo $row['no_of_vehicals'];?></td>
		<td>&nbsp;<?php echo $row['location'];?></td>
		<td>&nbsp;<?php echo $row['model'];?></td>
		<td>&nbsp;<?php echo $row['time'];?></td>
		<td>&nbsp;<?php echo $row['contact_number'];?></td>
        <td>&nbsp;<?php echo $row['contact_person'];?></td>
        <td>&nbsp;<?php echo $row['contact_person_no'];?></td>
		<td align="center">&nbsp;<a href="add_installation_mum.php?id=<?=$row['id'];?>&action=edit">Edit</a></td>
		<!--<td align="center">&nbsp;<a href="installation.php?id=<?php echo $row['id'];?>&action=delete">Delete</a></td>-->
		
	</tr>
		<?php  
    }
	 
    ?>
	<tr><td colspan="7" align="center"></td></tr> </tbody>
</table></form> 

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
