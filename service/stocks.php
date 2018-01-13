<?php
include("include/header.inc.php");
include ("config.php");

$id=$_GET['id'];

$mode=$_GET['mode'];

if($mode=='in')
	{
	$rs = mysql_query("SELECT * FROM stocks where flag=1 order by id desc ");
	}
	else if($mode=='out')
	{
	$rs = mysql_query("SELECT * FROM stocks where flag=0 order by id desc ");
	}
	
if($mode=='in')
	{
	$source1="Source";
	}
	else if($mode=='out')
	{
	$source1="Destination";
	}
	
	
if($_GET['action']=='delete')
{
$sql="DELETE FROM stocks WHERE id='$id'";
$result=mysql_query($sql);
}


	

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

<table width="50%" border="1" cellpadding="0" cellspacing="0" align="center"  id="myTable" class="tablesorter"><thead>
<tr><td colspan="4"><a href="addstock.php?mode=<?=$mode?>">Add Stock-<?=ucfirst($mode)?></a></td></tr>
<tr align="Center">
		<th width="24px" align="center"><font color="#0E2C3C"><b>Model</b></font></th>
		<th width="25px" align="center"><font color="#0E2C3C"><b>No. Of Devices</b></font></th>
        <th width="25px" align="center"><font color="#0E2C3C"><b><?=$source1?></b></font></th>
        <th width="25px" align="center"><font color="#0E2C3C"><b>date</b></font></th>
		<th width="25px" align="center"><font color="#0E2C3C"><b>Type</b></font></th>
		
		
		
	</tr></thead><tbody>
	<?php  
    while ($row = @mysql_fetch_array($rs)) {	
    ?>  
	<tr align="Center">	
		<td width="24%" align="center">&nbsp;<?php echo $row['model'];?></td>
		<td width="25%" align="center">&nbsp;<?php echo $row['no_of_devices'];?></td>
        <td width="25%" align="center">&nbsp;<?php echo $row['source'];?></td>
        <td width="25%" align="center">&nbsp;<?php echo $row['date'];?></td>	
		<td width="25%" align="center">&nbsp;<?php if($row['device_type']==1) echo "Old"; elseif($row['device_type']==2) echo "New";?></td>	
	</tr>
		<?php  
    }
	 
    ?>
	<tr><td colspan="9" align="center"></td></tr> <tbody>
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
