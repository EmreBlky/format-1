<?php
include("include/header.inc.php");
include ("config.php");


//$rs = mysql_query("SELECT * FROM services");

/*$id=$_GET['id'];
$sql="DELETE FROM services WHERE id='$id'";
$result=mysql_query($sql);*/



	
$rs = mysql_query("SELECT * FROM services  where inst_name!='' and inst_cur_location!='' and newpending!='1' order by id desc");
	
	
	


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

<table width="850" border="1" cellpadding="0" cellspacing="0" align="center" id="myTable" class="tablesorter">
<thead>
<tr align="Center">
		<th width="6%" align="center"><font color="#0E2C3C"><b>Client Name </b></font></th>
		<th width="9%" align="center"><font color="#0E2C3C"><b>Vehicle No <br/>(IP Box/ Required)</b></font></th>
		<th width="10%" align="center"><font color="#0E2C3C"><b>Notworking </b></font></th>
		<th width="7%" align="center"><font color="#0E2C3C"><b>Location</b></font></th>
		<th width="8%" align="center"><font color="#0E2C3C"><b>Available Time</b></font></th>
		<th width="6%" align="center"><font color="#0E2C3C"><b>Person Name</b></font></th>
		<th width="7%" align="center"><font color="#0E2C3C"><b>Contact No</b></font></th>
		<th width="10%" align="center"><font color="#0E2C3C"><b>Installation Name</b></font></th>
		<th width="7%" align="center"><font color="#0E2C3C"><b>Installer Current Location</b></font></th>
		<th width="6%" align="center"><font color="#0E2C3C"><b>Reason</b></font></th>
		<th width="4%" align="center"><font color="#0E2C3C"><b>Time</b></font></th>
        <th width="8%" align="center"><font color="#0E2C3C"><b>Payment/ Billing</b></font></th>
        <th width="6%" align="center"><font color="#0E2C3C"><b>Data Pulling Time</b></font></th>
		<td width="6%" align="center"><font color="#0E2C3C"><b>Edit</b></font></td>
		<!--<td width="6%" align="center"><font color="#0E2C3C"><b>Delete</b></font></td>-->
		
		
	</tr></thead><tbody>
	<?php  
    while ($row = mysql_fetch_array($rs)) {
		if($row[IP_Box]=="") $ip_box="Not Required";  else $ip_box="$row[IP_Box]"; 
	
    ?>  

	<!-- <tr align="Center" <? if(($row['reason'] && $row['time']) ||  $row['back_reason']) { ?> style="background:#CCCCCC" <? }?>> -->
	<tr align="Center" <? if($row['reason'] && $row['time'])  {  ?> style="background:#CCCCCC;" <? }?>>
	
		<td width="6%" align="center">&nbsp;<?php echo $row['name'];?></td>
		<td width="9%" align="center">&nbsp;<?php echo "$row[veh_reg] <br/><br/>($ip_box/ "; if($row['required']=='urgent') {?> <span style="color:#F00; font-size:14px;"> <?php } echo "$row[required] )"?></span></td>
		
		<td width="10%" align="center">&nbsp;<?php echo $row['Notwoking'];?></td>
		<td width="7%" align="center">&nbsp;<?php echo $row['location'];?></td>
		<td width="8%" align="center">&nbsp;<?php echo $row['atime'];?></td>
		<td width="6%" align="center">&nbsp;<?php echo $row['pname'];?></td>
		<td width="7%" align="center">&nbsp;<?php echo $row['cnumber'];?></td>
		<td width="10%" align="center">&nbsp;<?php echo $row['inst_name'];?></td>
		<td width="7%" align="center">&nbsp;<?php echo $row['inst_cur_location'];?></td>
		<td width="6%" align="center">&nbsp;<?php echo $row['reason'];?></td>
		<td width="4%" align="center">&nbsp;<?php echo $row['time'];?></td>
        <td width="8%" align="center">&nbsp;<?php echo "$row[payment]/$row[billing]";?></td>
        <td width="6%" align="center">&nbsp;<?php echo $row['datapullingtime'];?></td>
		<td width="6%" align="center">&nbsp;<? if($row['reason'] && $row['time'] ) { ?> <span onClick="return editreason(<?php echo $row['id'];?>);"> Close</span> <? } else { ?><a href="editnewinstallation.php?id=<?=$row['id'];?>&action=edit&pg=<? echo $pg;?>">Edit</a> <? }?></td>
		
		<!-- <td width="7%" align="center">&nbsp;<? if(($row['reason'] && $row['time']) ||  $row['back_reason']) { echo "Close"; } else { ?><a href="editnewinstallation.php?id=<?=$row['id'];?>&action=edit&pg=<? echo $pg;?>">Edit</a> <? }?></td>
		 --><!--<td width="6%" align="center">&nbsp;<a href="newinstallation.php?id=<?php echo $row['id'];?>">Delete</a></td>-->
		
	</tr>
		<?php  
    }
	 
    ?>
	<tr><td colspan="9" align="center"></td></tr>   </tbody>
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
         <script type="text/javascript">
    function editreason(id)
		{
			var url="http://service.gpsindelhi.com/editreason.php?id="+id;
			
			 window.open(
		url,'popup','height=300,width=400,left=200,top=200,resizable=yes,scrollbars=no,toolbar=yes,menubar=yes,location=yes,directories=no,status=yes')
			
			
			}
			
			<!-- Codes by Quackit.com -->


</script>
        
<?
include("include/footer.inc.php");

?>