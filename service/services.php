<?php
include("include/header.inc.php");
include ("config.php");


/*$id=$_GET['id'];

if($_GET['action']=='delete')
{
$sql="DELETE FROM services WHERE id='$id'";
$result=mysql_query($sql);
}*/

$fromdateof_service="";
$todaydate = date("Y-m-d  H:i:s");
$newdate = strtotime ( '-3 day' , strtotime ( $todaydate ) ) ;
$fromdateof_service = date ( 'Y-m-j H:i:s' , $newdate );
	
	  $rs = mysql_query("SELECT * FROM services where req_date>'".$fromdateof_service."' and branch_id=".$_SESSION['branch_id'] ."  order by id desc");
	
	 
	
	//echo mysql_num_rows($rs);
	
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

<table width="745" border="1" cellpadding="0" cellspacing="0" align="center" id="myTable" class="tablesorter" id="myTable">
 <thead>
			<tr>
		<th width="11%" align="center"><font color="#0E2C3C"><b>ClientName </b></font></th>
		<th width="11%" align="center"><font color="#0E2C3C"><b>Vehicle No<br/>IP Box</b></font></th>
		<th width="11%" align="center"><font color="#0E2C3C"><b>Notworking </b></font></th>
		<th width="11%" align="center"><font color="#0E2C3C"><b>Location</b></font></th>
		<th width="11%" align="center"><font color="#0E2C3C"><b>Available Status</b></font></th>
		<th width="11%" align="center"><font color="#0E2C3C"><b>Available Time</b></font></th>
		<th width="11%" align="center"><font color="#0E2C3C"><b>Person Name</b></font></th>
		<th width="11%" align="center"><font color="#0E2C3C"><b>Contact No</b></font></th>
        <th width="8%" align="center"><font color="#0E2C3C"><b>Moved</b></font></th>
         <th width="8%" align="center"><font color="#0E2C3C"><b>Data Pulling Time</b></font></th>
		  <th width="8%" align="center"><font color="#0E2C3C"><b>Device model</b></font></th>
		<td width="8%" align="center"><font color="#0E2C3C"><b>Edit</b></font></td>
		<!--<td width="11%" align="center"><font color="#0E2C3C"><b>Delete</b></font></td>   -->
				
    </tr>
    </thead>
    <tbody>
    	
	</tr>
	<?php  
    while ($row = mysql_fetch_array($rs)) {
		if($row[IP_Box]=="") $ip_box="Not Required";  else $ip_box="$row[IP_Box]"; 
	
    ?>  
	<tr align="Center"  <? if($row['required']=='urgent'){ ?>style="background:#F6F" <? }?>>
	
		<td width="11%" align="center">&nbsp;<?php echo $row['name'];?></td>
		<td width="11%" align="center">&nbsp;<?php echo "$row[veh_reg] <br/> / $ip_box";?></td>
		
		<td width="12%" align="center">&nbsp;<?php echo $row['Notwoking'];?></td>
		<td width="10%" align="center">&nbsp;<?php echo $row['location'];?></td>
		<td width="10%" align="center">&nbsp;<?php echo $row['atime_status'];?></td>
		<td width="10%" align="center">&nbsp;<?php echo "$row[atime] -- $row[atimeto]"; ?></td>
		<td width="10%" align="center">&nbsp;<?php echo $row['pname'];?></td>
		<td width="12%" align="center">&nbsp;<?php echo $row['cnumber'];?></td>
        <td width="8%" align="center">&nbsp;<?php if($row['move_vehicles']==1) { echo "yes"; } else { echo "No"; }?></td>
        <td width="12%" align="center">&nbsp;<?php echo $row['datapullingtime'];?></td>
		 <td width="12%" align="center">&nbsp;<?php echo $row['device_model'];?></td>
		<td width="8%" align="center">&nbsp;  <a href="edit_delete.php?id=<?=$row['id'];?>&action=edit&pg=<? echo $pg;?>">Edit</a></td>
		<!--<td width="12%" align="center">&nbsp;<a href="services.php?id=<?php echo $row['id'];?>&action=delete">Delete</a></td>-->
		
	</tr>
		<?php  
    }
	 
    ?>
	</tbody>
</table> 
	<div id="pagination" class="pager">
			
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
			
		</div></form>
        <br/></br>
</body>
</html>
<?
include("include/footer.inc.php");

?>
