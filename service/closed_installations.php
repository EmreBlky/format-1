<?php
include("include/header.inc.php");
include ("config.php");
//$rs = mysql_query("SELECT * FROM repai_device");
$id=$_GET['id'];
$mode=$_GET['mode'];
if($mode=='') { $mode="close"; }

if($mode=='back')
	{
	$rs = mysql_query("SELECT * FROM installation where flag=0 and back_reason!='' order by id desc");
	}
	else if($mode=='close')
	{
	$rs = mysql_query("SELECT * FROM installation where flag=0 and reason!=''or rtime!='' order by id desc");
	}
	else if($mode=='new')
	{
	$rs = mysql_query("SELECT * FROM installation  where flag=0 and reason=''and rtime='' order by id desc");
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
							location.href="show_installation.php";
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

<tr><td colspan="3">
<table width="100%" border="1" cellpadding="0" cellspacing="0" align="center"  id="myTable" class="tablesorter">

<thead>
<tr align="Center">
		<th width="11%" align="center"><font color="#0E2C3C"><b>Sales Person </b></font></th>
		<th width="11%" align="center"><font color="#0E2C3C"><b>Client Name </b></font></th>
		<th width="11%" align="center"><font color="#0E2C3C"><b>No. Of Vehicle</b></font></th>
		<th width="11%" align="center"><font color="#0E2C3C"><b>Location </b></font></th>
		<th width="11%" align="center"><font color="#0E2C3C"><b>Model</b></font></th>
		<th width="11%" align="center"><font color="#0E2C3C"><b>Time</b></font></th>
		<th width="11%" align="center"><font color="#0E2C3C"><b>DIMTS</b></font></th>
		<th width="11%" align="center"><font color="#0E2C3C"><b>Demo</b></font></th>
		<th width="11%" align="center"><font color="#0E2C3C"><b>Vehicle Type</b></font></th>
		<th width="11%" align="center"><font color="#0E2C3C"><b>Immobilizer Type</b></font></th>
		<th width="11%" align="center"><font color="#0E2C3C"><b>Payment Status</b></font></th>
		<th width="11%" align="center"><font color="#0E2C3C"><b>Amount/PayMode</b></font></th>
		<th width="11%" align="center"><font color="#0E2C3C"><b>Installer Name</b></font></th>
		<th width="11%" align="center"><font color="#0E2C3C"><b>Installed Date</b></font></th>
		<th width="11%" align="center"><font color="#0E2C3C"><b>Contact Number</b></font></th>
        <th width="11%" align="center"><font color="#0E2C3C"><b>Payment/ Billing</b></font></th>
        <th width="11%" align="center"><font color="#0E2C3C"><b>Data Pulling Time</b></font></th>
		<? if($mode!='new') { ?><th width="13%" align="center"><font color="#0E2C3C"><b>Installation Name</b></font></th>
		<th width="8%" align="center"><font color="#0E2C3C"><b>Installer Current Location</b></font></th>
		<? if($mode!='back') { ?><th width="7%" align="center"><font color="#0E2C3C"><b>Reason</b></font></th>
		<th width="4%" align="center"><font color="#0E2C3C"><b>Time</b></font></th> <? }} ?>
		<? if($mode=='back') { ?>
		<th width="4%" align="center"><font color="#0E2C3C"><b>Back Reason</b></font></th> <? } ?>
        
        <? if($mode=='new') { ?>
		<th width="4%" align="center"><font color="#0E2C3C"><b>Contact Person</b></font></th>
        <th width="4%" align="center"><font color="#0E2C3C"><b>Contact Person No.</b></font></th> 
		 <th width="4%" align="center"><font color="#0E2C3C"><b>Installer Status</b></font></th><? } ?>

	</tr></thead><tbody>
	<?php  
    while ($row = mysql_fetch_array($rs)) {
	$sales=mysql_fetch_array(mysql_query("select name from sales_person where id='$row[sales_person]' "));
	$inst_status=mysql_fetch_array(mysql_query("select status from installer where inst_name='".$row['inst_name']."'"));
	
    ?>  
	<tr align="Center" <? if($row['required']=='urgent'){ ?>style="background:#F6F" <? }?>>
	
		<td width="11%" align="center">&nbsp;<?php echo $sales['name'];?></td>
		<td width="12%" align="center">&nbsp;<?php echo $row['client'];?></td>
		
		<td width="12%" align="center">&nbsp;<?php echo $row['no_of_vehicals'];?></td>
		<td width="10%" align="center">&nbsp;<?php echo $row['location'];?></td>
		<td width="11%" align="center">&nbsp;<?php echo $row['model'];?></td>
		<td width="11%" align="center">&nbsp;<?php echo $row['time'];?></td>
		<td width="12%" align="center">&nbsp;<?php echo $row['dimts'];?></td>
		<td width="12%" align="center">&nbsp;<?php echo $row['demo'];?></td>
		<td width="9%" align="center">&nbsp;<?php echo $row['veh_type'];?></td>
		<td width="9%" align="center">&nbsp;<?php echo $row['immobilizer_type'];?></td>
		<td width="12%" align="center">&nbsp;<?php echo $row['payment_status'];?></td>
		<td width="12%" align="center">&nbsp;<?php echo "$row[amount]/$row[paymode]";?></td>
		<td width="12%" align="center">&nbsp;<?php echo $row['inst_name'];?></td>
		<td width="12%" align="center">&nbsp;<?php echo $row['installed_date'];?></td>
		<td width="11%" align="center">&nbsp;<?php echo $row['contact_number'];?></td>
        <td width="11%" align="center">&nbsp;<?php echo "$row[payment]/$row[billing]";?></td>
        <td width="11%" align="center">&nbsp;<?php echo $row['datapullingtime'];?></td>
       <? if($mode!='new') { ?><td width="13%" align="center">&nbsp;<?php echo $row['inst_name'];?></td>
		<td width="8%" align="center">&nbsp;<?php echo $row['inst_cur_location'];?></td>
		<? if($mode!='back') { ?><td width="7%" align="center">&nbsp;<?php echo $row['reason'];?></td>
		<td width="4%" align="center">&nbsp;<?php echo $row['time'];?></td><? } } ?>
        <? if($mode=='back') { ?>
		<td width="4%" align="center">&nbsp;<?php echo $row['back_reason'];?></td><?  } ?>
        
        <? if($mode=='new') { ?>
		<td width="4%" align="center">&nbsp;<?php echo $row['contact_person'];?></td>
		<td width="4%" align="center">&nbsp;<?php echo $row['contact_person_no'];?></td>
        <? if($inst_status['status']==1) { ?>
        <td width="4%" align="center"><a href="# " onClick="getfree('<?=$row[inst_name]?>');">&nbsp;Busy</a></td>
        <? } else { ?>
         <td width="4%" align="center">&nbsp;Free</td> 
        <? }
		}?>
        
		
		 
	


		
	</tr>
		<?php  
    }
	 
    ?>
	<tr><td colspan="9" align="center"></td></tr> </tbody>
</table> 
</td></tr>
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
