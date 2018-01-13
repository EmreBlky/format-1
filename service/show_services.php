<?php
include("include/header.inc.php");
include ("config.php");
//$rs = mysql_query("SELECT * FROM repai_device");
$id=$_GET['id'];


//$rs = mysql_query("SELECT * FROM repai_device order by id desc");

$mode=$_GET['mode'];
if($mode=='') { $mode="new"; }
	
if($mode=='back')
	{
	$rs = mysql_query("SELECT * FROM services where back_reason!='' and atime>'2012-12-31 00:00'  order by req_date desc");
	}
	else if($mode=='close')
	{
	$rs = mysql_query("SELECT * FROM services where reason!=''and time!='' and atime>'2012-12-31 00:00' order by req_date desc");
	}
	else if($mode=='new')
	{
	$rs = mysql_query("SELECT * FROM services  where reason=''and time='' and atime>'2012-12-31 00:00' order by req_date desc");
	}	

?>
<script type="text/javascript">
		$(document).ready(function(){
			

			$("#myTable").tablesorter().tablesorterPager({container: $("#pagination")});
		});
		
		function getfree(name)
			{
				$.ajax({
					type: "GET",
					data: "name="+name,
					url: "getfreeInstaller.php",
					success:function(msg)
						{
							location.href="show_services.php";
						}
					
					});
			}
	</script>


<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
<title>Untitled Document</title>
</head>

<body>
<form name="frmMain" action="" method="post">
<table>
<tr><td height="15px"><a href="show_services.php?mode=new">New</a></td><td height="15px"><a href="show_services.php?mode=close">Close</a></td><td><a href="show_services.php?mode=back"> Back To Services</a></td></tr>
<tr><td colspan="3">
<table width="767" border="1" cellpadding="0" cellspacing="0" align="center"  id="myTable" class="tablesorter">

<thead>
<tr align="Center">
		<th width="10%" align="center"><font color="#0E2C3C"><b>Client Name </b></font></th>
		<th width="7%" align="center"><font color="#0E2C3C"><b>Vehicle No</b></font></th>
		<th width="10%" align="center"><font color="#0E2C3C"><b>Notworking </b></font></th>
		<th width="9%" align="center"><font color="#0E2C3C"><b>Location</b></font></th>
		<th width="10%" align="center"><font color="#0E2C3C"><b>Available Time</b></font></th>
		<th width="10%" align="center"><font color="#0E2C3C"><b>Person Name</b></font></th>
		<th width="9%" align="center"><font color="#0E2C3C"><b>Contact No</b></font></th>
		<th width="9%" align="center"><font color="#0E2C3C"><b>Payment Status</b></font></th>
		<th width="9%" align="center"><font color="#0E2C3C"><b>Amount/Mode</b></font></th>
        <th width="9%" align="center"><font color="#0E2C3C"><b>Payment/ Billing</b></font></th>
        <th width="9%" align="center"><font color="#0E2C3C"><b>Data Pulling Time</b></font></th>
		<? //if($mode!='new') { ?><th width="13%" align="center"><font color="#0E2C3C"><b>Installation Name</b></font></th>
		<th width="8%" align="center"><font color="#0E2C3C"><b>Installer Current Location</b></font></th>
		<? // if($mode!='back') { ?><th width="7%" align="center"><font color="#0E2C3C"><b>Reason</b></font></th>
		<th width="4%" align="center"><font color="#0E2C3C"><b>Time</b></font></th> <? //}} ?>
		<? //if($mode=='back') { ?>
		<th width="4%" align="center"><font color="#0E2C3C"><b>Back Reason</b></font></th> <? //} ?>
        <? if($mode=='new') { ?> <th width="13%" align="center"><font color="#0E2C3C"><b>Installer Status</b></font></th> <? }?>
		
	</tr></thead><tbody>
	<?php  
    while ($row = mysql_fetch_array($rs)) {
		
		$inst_status=mysql_fetch_array(mysql_query("select status from installer where inst_name='".$row['inst_name']."'"));
	
    ?>  
	<tr align="Center" <? if($row['required']=='urgent'){ ?>style="background:#F6F" <? }?>>
	
		<td width="10%" align="center">&nbsp;<?php echo $row['name'];?></td>
		<td width="7%" align="center">&nbsp;<?php echo $row['veh_reg'];?></td>		
		<td width="10%" align="center">&nbsp;<?php echo $row['Notwoking'];?></td>
		<td width="9%" align="center">&nbsp;<?php echo $row['location'];?></td>
		<td width="10%" align="center">&nbsp;<?php echo $row['atime'];?></td>
		<td width="10%" align="center">&nbsp;<?php echo $row['pname'];?></td>
		<td width="9%" align="center">&nbsp;<?php echo $row['cnumber'];?></td>
		<td width="9%" align="center">&nbsp;<?php echo $row['payment_status'];?></td>
		<td width="9%" align="center">&nbsp;<?php echo "$row[amount]/$row[paymode]";?></td>
        <td width="9%" align="center">&nbsp;<?php echo "$row[payment]/$row[billing]";?></td>
        <td width="9%" align="center">&nbsp;<?php echo $row['datapullingtime'];?></td>
		<? //if($mode!='new') { ?><td width="13%" align="center">&nbsp;<?php echo $row['inst_name'];?></td>
		<td width="8%" align="center">&nbsp;<?php echo $row['inst_cur_location'];?></td>
		<? //if($mode!='back') { ?><td width="7%" align="center">&nbsp;<?php echo $row['reason'];?></td>
		<td width="4%" align="center">&nbsp;<?php echo $row['time'];?></td><?// } } ?>
        <?// if($mode=='back') { ?>
		<td width="4%" align="center">&nbsp;<?php echo $row['back_reason'];?></td><?  //} ?>
		<? if($mode=='new') { 
				if($inst_status['status']==1) {
		?>  <td width="4%" align="center"><a href="# " onClick="getfree('<?=$row[inst_name]?>');">&nbsp;Busy</a></td>
		 <? } else { ?>
         <td width="4%" align="center">&nbsp;Free</td> 
        <? } } ?> 
       
		
	</tr>
		<?php  
    }
	 
    ?>
	<tr><td colspan="9" align="center"></td></tr> </tbody>
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
