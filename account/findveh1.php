<?php
include("../connection.php");
 echo $veh1=$_GET["branch1"];

$query="SELECT sim_no,veh_no FROM client_details WHERE branch='$veh1'";

$result=mysql_query($query);
$result1=mysql_query($query);

?>
<html>
<style type="text/css">
<!--
.style1 {
	font-size: 14px;
	font-weight: bold;
}
-->
</style>
<body>
<table>
<tr>
<td width="120"><strong>Vehicle No.:-
</strong> </td>
<td width="209">
<select name="veh1">
<option>All Vehicle No.</option>
<? while($row=mysql_fetch_array($result)) { ?>
<option value=<?=$row['veh_no']?>><?=$row['veh_no']?>----<?=$row['sim_no']?></option>
<? } ?>
</select>
</td>

<? $simlist="";
	while($row=mysql_fetch_array($result1)) {
	 $simlist .="'".$row['sim_no']."',";
  } ?>

	<td>
      <span class="style1">
  <?
$query="SELECT veh_no,COUNT(veh_no) AS tagveh_no FROM client_details WHERE branch='$veh1' GROUP BY branch";

$result1=mysql_query($query);
while($row1=mysql_fetch_array($result1)) {
?> 
  
  Total Vehicles:- </span></td>
  <td>
    <? echo $vehcount=$row1['tagveh_no']; } ?>
  </td>
</tr>

<tr>
<td>
<?
$query="SELECT sum(amt) as total FROM sim_no WHERE sim_no in (".substr($simlist,0,-1).")";

$result2=mysql_query($query);
 while($row2=mysql_fetch_array($result2)) { ?>
 
<strong>Total Amt:-</strong>
</td><td>
	   <input id="amt1" name="amt" value="<? echo $row2['total']; ?>">
	   
	   <? } ?> 
	   
	 
	</td></tr>   
</table></body></html>
