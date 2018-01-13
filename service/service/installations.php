<?php
include("include/header.inc.php");
include ("config.php");


//$rs = mysql_query("SELECT * FROM services");

/*$id=$_GET['id'];
$sql="DELETE FROM services WHERE id='$id'";
$result=mysql_query($sql);*/


//$rs = mysql_query("SELECT * FROM installation  where inst_name!='' and inst_cur_location!='' and newpending!='1' order by id desc");

$mode=$_GET['mode'];
if($mode=='') { $mode="new"; }
	
  if($mode=='close')
	{
	$rs = mysql_query("SELECT * FROM installation where reason!='' or rtime!='' and branch_id=".$_SESSION['branch_id']."  order by id desc");
	}
	else if($mode=='new')
	{
	//$rs = mysql_query("SELECT * FROM services  where inst_name!='' and inst_cur_location!='' and newpending!='1' order by id desc");
	$rs = mysql_query("SELECT * FROM installation  where inst_name!='' and inst_cur_location!='' and newpending!='1' and reason='' and rtime='' and branch_id=".$_SESSION['branch_id'] ." order by id desc");
	}	


	
//reason,rtime
	
	
	


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
<table width="743"   cellpadding="2" cellspacing="3"><tr><td height="15px"><a href="installations.php?mode=new">New</a></td><td height="15px"><a href="installations.php?mode=close">Closed</a></td> </tr>
<tr></table>
<table width="743" border="1" cellpadding="0" cellspacing="0" align="center" id="myTable" class="tablesorter">
<thead>
<tr align="Center">
		<th width="10%" align="center"><font color="#0E2C3C"><b>Sales Person  </b></font></th>
		<th width="10%" align="center"><font color="#0E2C3C"><b>Client Name </b></font></th>
		<th width="7%" align="center"><font color="#0E2C3C"><b>No.Of Vehicle <br/>/IP Box</b></font></th>
		
		<th width="9%" align="center"><font color="#0E2C3C"><b>Location</b></font></th>
		<th width="10%" align="center"><font color="#0E2C3C"><b>Model</b></font></th>
		<th width="10%" align="center"><font color="#0E2C3C"><b>Time</b></font></th>
		<th width="9%" align="center"><font color="#0E2C3C"><b>Contact No</b></font></th>
		<th width="13%" align="center"><font color="#0E2C3C"><b>Installation Name</b></font></th>
		<th width="8%" align="center"><font color="#0E2C3C"><b>Installer Current Location</b></font></th>
		<!--<th width="7%" align="center"><font color="#0E2C3C"><b>Reason</b></font></th>-->
		<th width="4%" align="center"><font color="#0E2C3C"><b>Time</b></font></th>
        <th width="4%" align="center"><font color="#0E2C3C"><b>Payment/ Billing</b></font></th>
         <th width="4%" align="center"><font color="#0E2C3C"><b>Data Pulling Time</b></font></th>
		<td width="7%" align="center"><font color="#0E2C3C"><b>Edit</b></font></td>
		<!--<td width="6%" align="center"><font color="#0E2C3C"><b>Delete</b></font></td>-->
		
		
	</tr></thead><tbody>
	<?php  
    while ($row = mysql_fetch_array($rs)) {
		if($row[IP_Box]=="") $ip_box="Not Required";  else $ip_box="$row[IP_Box]"; 
		
	
    ?>  
	<tr align="Center"  <? if($row['reason'] || $row['rtime']) { ?> style="background:#CCCCCC" <? }?> >
	
		<td width="10%" align="center">&nbsp;<?php $sales=mysql_fetch_array(mysql_query("select name from sales_person where id='$row[sales_person]' ")); echo $sales['name'];?></td>
		<td width="7%" align="center">&nbsp;<?php echo $row['client'];?></td>
		
		<td width="10%" align="center">&nbsp;<?php echo "$row[no_of_vehicals] <br/><br/>/$ip_box";?></td>
		<td width="9%" align="center">&nbsp;<?php echo $row['location'];?></td>
		<td width="10%" align="center">&nbsp;<?php echo $row['model'];?></td>
		<td width="10%" align="center">&nbsp;<?php echo date('d-M-Y h:m:s',strtotime($row['time']));?></td>
		<td width="9%" align="center">&nbsp;<?php echo $row['contact_number'];?></td>
		<td width="13%" align="center">&nbsp;<?php echo $row['inst_name'];?></td>
		<td width="8%" align="center">&nbsp;<?php echo $row['inst_cur_location'];?></td>
		<!--<td width="7%" align="center">&nbsp;<?php echo $row['reason'];?></td>-->
		<td width="4%" align="center">&nbsp;<?php echo date('d-M-Y h:m:s',strtotime($row['rtime']));?></td>
        
         <td width="4%" align="center">&nbsp;<?php echo "$row[payment]/$row[billing]";?></td>
         
         <td width="4%" align="center">&nbsp;<?php echo $row['datapullingtime'];?></td>
         
		<td width="7%" align="center">&nbsp;<? if($row['reason'] || $row['rtime'] ) { echo "Close"; } else { ?><a href="edit_newinstallation.php?id=<?=$row['id'];?>&action=edit&pg=<? echo $pg;?>">Edit</a><? }?></td>
		<!--<td width="7%" align="center">&nbsp;<? if(($row['reason'] || $row['rtime']) || $row['back_reason']) { echo "Close"; } else { ?><a href="edit_newinstallation.php?id=<?=$row['id'];?>&action=edit&pg=<? echo $pg;?>">Edit</a><? }?></td>-->
		<!--<td width="6%" align="center">&nbsp;<a href="newinstallation.php?id=<?php echo $row['id'];?>">Delete</a></td>-->
		
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
<?
include("include/footer.inc.php");

?>