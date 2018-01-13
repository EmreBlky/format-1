<?php
include("include/header.inc.php");
include ("config.php");
//$rs = mysql_query("SELECT * FROM repai_device");
$id=$_GET['id'];

$mode=$_GET['mode'];
if($mode=='') { $mode="new"; }

if($mode=='close')
	{
	$rs = mysql_query("SELECT * FROM repai_device where group2='int_repaired' or group2='Yes' order by id desc");
	}	
	else if($mode=='new')
	{
	//echo "SELECT * FROM repai_device  where group2='' or (comp_name='' && per_name='') order by id desc";
	$rs = mysql_query("SELECT * FROM repai_device  where group2!='int_repaired' or group2!='Yes' order by id desc");
	}
//$rs = mysql_query("SELECT * FROM repai_device order by id desc");
	

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
<table><tr><td width="369" height="15px"><a href="show_repairs.php?mode=new">New</a></td>
<td width="488" ><a href="show_repairs.php?mode=close">Close</a></td>
</tr>
<tr><td colspan="2">
<table width="913" border="1" cellpadding="0" cellspacing="0" align="center"  id="myTable" class="tablesorter">

<thead>
<tr align="Center">
		<th width="11%" align="center" height="30px;"><font color="#0E2C3C"><b>Client Name </b></font></th>
		<th width="11%" align="center"><font color="#0E2C3C"><b>Vehicle No</b></font></th>
		<th width="11%" align="center"><font color="#0E2C3C"><b>Model </b></font></th>
		<th width="11%" align="center"><font color="#0E2C3C"><b>Device Id</b></font></th>
		<th width="11%" align="center"><font color="#0E2C3C"><b>SIM Status</b></font></th>
		<th width="11%" align="center"><font color="#0E2C3C"><b>Old SIM</b></font></th>
		<th width="11%" align="center"><font color="#0E2C3C"><b>New SIM</b></font></th>
		<th width="11%" align="center"><font color="#0E2C3C"><b>Old Imei</b></font></th>
		<th width="11%" align="center"><font color="#0E2C3C"><b>New IMEI</b></font></th>
		<th width="11%" align="center"><font color="#0E2C3C"><b>Antenna Status</b></font></th>
		<th width="11%" align="center"><font color="#0E2C3C"><b>Date</b></font></th>
		<th width="11%" align="center"><font color="#0E2C3C"><b>Close Date</b></font></th>
		<th width="11%" align="center"><font color="#0E2C3C"><b>Problem</b></font></th>
		<th width="11%" align="center"><font color="#0E2C3C"><b>Actual Problem</b></font></th>
		<th width="11%" align="center"><font color="#0E2C3C"><b>Spare Cost</b></font></th>
		<? //if($mode!='new') { ?><th width="11%" align="center"><font color="#0E2C3C"><b>Company Name</b></font></th>
		<th width="13%" align="center"><font color="#0E2C3C"><b>Person Name</b></font></th>
        <th width="13%" align="center"><font color="#0E2C3C"><b>Repair</b></font></th> <?// }?>
		
		 <? if($mode=='close') { ?>
		 <td width="13%" align="center">Device Status</td>
		<td width="13%" align="center">Edit</td>
		
		
		<? }?>
		
		
	</tr></thead><tbody>
	<?php  
    while ($row = mysql_fetch_array($rs)) {
	
    ?>  
	<tr align="Center">
	
		<td width="11%" align="center">&nbsp;<?php echo $row['name'];?></td>
		<td width="12%" align="center">&nbsp;<?php echo $row['veh_reg'];?></td>
		<td width="12%" align="center">&nbsp;<?php echo $row['model'];?></td>
		<td width="10%" align="center">&nbsp;<?php echo $row['deviceid'];?></td>
		<td width="10%" align="center">&nbsp;<?php echo $row['sim_status'];?></td>
		<td width="11%" align="center">&nbsp;<?php echo $row['old_sim_no'];?></td>
		<td width="11%" align="center">&nbsp;<?php echo $row['new_sim_no'];?></td>
		<td width="11%" align="center">&nbsp;<?php echo $row['old_imei'];?></td>
		<td width="11%" align="center">&nbsp;<?php echo $row['Imei'];?></td>
		<td width="11%" align="center">&nbsp;<?php echo $row['antina'];?></td>
		<td width="12%" align="center">&nbsp;<?php echo date('d-M-Y  h:m:s',strtotime($row['date']));?></td>

			<td width="12%" align="center">&nbsp;<?php if($row['close_date']!="") echo date('d-M-Y  h:m:s',strtotime($row['close_date']));?></td>

		<td width="12%" align="center">&nbsp;<?php echo $row['problem'];?></td>
		<td width="12%" align="center">&nbsp;<?php echo $row['Actual_bloblem'];?></td>
		<td width="12%" align="center">&nbsp;<?php echo $row['Spare_cost'];?></td>
		<? //if($mode!='new') { ?><td width="11%" align="center">&nbsp;<?php echo $row['comp_name'];?></td>
		<td width="13%" align="center">&nbsp;<?php echo $row['per_name'];?></td>
		<td width="13%" align="center">&nbsp;&nbsp;<? if($row['group2']!='Yes' &&  $row['group2']!='int_repaired'&&  $row['group2']!='Not Repairable') { ?> Open<? } else { ?> Close<? } ?></td><? //}?>

		 <? if($mode=='close') { ?>
		 <td width="12%" align="center">&nbsp;<?php echo $row['devicestatus'];?></td>
		<td width="13%" align="center"><a href="devicestatus.php?id=<?=$row['id'];?>&action=edit" >edit</a></td><? }?>
		
	</tr>
		<?php  
    }
	 
    ?>
	 </tbody>
</table> </td></tr></table>
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
