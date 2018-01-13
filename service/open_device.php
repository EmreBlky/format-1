<?php
 
include("include/header.inc.php");
include ("config.php");
//$rs = mysql_query("SELECT * FROM repai_device");
$id=$_GET['id'];


$rs = mysql_query("SELECT * FROM repai_device order by id desc");
	

?>
<script type="text/javascript">
		$(document).ready(function(){
			

			$("#myTable").tablesorter();
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

<table width="767" border="1" cellpadding="0" cellspacing="0" align="center"  id="myTable" class="tablesorter">
<thead>
<tr align="Center">
		<th width="11%" align="center"><font color="#0E2C3C"><b>Client Name </b></font></th>
		<th width="11%" align="center"><font color="#0E2C3C"><b>Vehicle No</b></font></th>
		<th width="11%" align="center"><font color="#0E2C3C"><b>Model </b></font></th>
		<th width="11%" align="center"><font color="#0E2C3C"><b>Device Id</b></font></th>
		<th width="11%" align="center"><font color="#0E2C3C"><b>SIM Status</b></font></th>
		<th width="11%" align="center"><font color="#0E2C3C"><b>New Imei</b></font></th>
		<th width="11%" align="center"><font color="#0E2C3C"><b>Old Imei</b></font></th>
		<th width="11%" align="center"><font color="#0E2C3C"><b>New SIM</b></font></th>
		<th width="11%" align="center"><font color="#0E2C3C"><b>Old SIM</b></font></th>
		<th width="11%" align="center"><font color="#0E2C3C"><b>Date</b></font></th>
		<th width="11%" align="center"><font color="#0E2C3C"><b>Problem</b></font></th>
		<th width="11%" align="center"><font color="#0E2C3C"><b>Company Name</b></font></th>
		<th width="13%" align="center"><font color="#0E2C3C"><b>Person Name</b></font></th>
		<!--<td width="11%" align="center"><font color="#0E2C3C"><b>Date</b></font></td>
		<td width="13%" align="center"><font color="#0E2C3C"><b>Problem</b></font></td>-->
		<th width="11%" align="center"><font color="#0E2C3C"><b>Open</b></font></th>
		
		
	</tr></thead><tbody>
	<?php  
    while ($row = mysql_fetch_array($rs)) {
	
    ?>  
	
	
	<? if($row['group2']!='Yes' &&  $row['group2']!='int_repaired'&&  $row['group2']!='Not Repairable') { ?>  
	<tr align="Center" <? if($row['group2']!='Yes' &&  $row['group2']!='int_repaired'&&  $row['group2']!='Not Repairable') { ?> style="background:#ffffff;" <? } else { echo "style='background:#ffffff;'"; } ?>>
		<td width="11%" align="center">&nbsp;<?php echo $row['name'];?></td>
		<td width="12%" align="center">&nbsp;<?php echo $row['veh_reg'];?></td>
		
		<td width="12%" align="center">&nbsp;<?php echo $row['model'];?></td>
		<td width="10%" align="center">&nbsp;<?php echo $row['deviceid'];?></td>
		<td width="11%" align="center">&nbsp;<?php echo $row['sim_status'];?></td>
		<td width="11%" align="center">&nbsp;<?php echo $row['Imei'];?></td>
		<td width="11%" align="center">&nbsp;<?php echo $row['old_imei'];?></td>
		<td width="11%" align="center">&nbsp;<?php echo $row['new_sim_no'];?></td>
		<td width="11%" align="center">&nbsp;<?php echo $row['old_sim_no'];?></td>
		<td width="12%" align="center">&nbsp;<?php echo $row['date'];?></td>
		<td width="12%" align="center">&nbsp;<?php echo $row['problem'];?></td>
		<td width="11%" align="center">&nbsp;<?php echo $row['comp_name'];?></td>
		<td width="13%" align="center">&nbsp;<?php echo $row['per_name'];?></td>
		<!--<td width="11%" align="center">&nbsp;<?php echo $row['hc_date'];?></td>
		<td width="13%" align="center">&nbsp;<?php echo $row['hc_prob'];?></td>-->
		<td width="11%" align="center">&nbsp;<? if($row['group2']!='Yes' &&  $row['group2']!='int_repaired'&&  $row['group2']!='Not Repairable') { ?> <a href="open.php?id=<?=$row['id'];?>&action=edit">Open</a><? } else { ?> <a href="#" onClick="return false;">close</a><? } ?></td>	</tr>
		<? }   
    }
	 
    ?>
	<tr><td colspan="9" align="center"></td></tr> </tbody>
</table> 
</form>
<!-- <div id="pagination" class="pager">
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
		</div> -->
        <br/><br/>
<?
include("include/footer.inc.php");

?>
