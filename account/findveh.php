<?php
include("../connection.php");
 $veh=$_GET["veh"];

$query="SELECT sim_no,veh_no FROM client_details WHERE client='$veh'";
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
<table border="0">
<tr>
<td width="120">
<strong>Vehicle No.:-</strong> </td>

<td width="206"> <select name="veh">
    <option>All Vehicle No.</option>
    <? while($row=mysql_fetch_array($result)) { ?>
    <option value=<?=$row['veh_no']?>>
    <?=$row['veh_no']?>----<?=$row['sim_no']?>
    </option>
    <? } ?>
  </select>
</td>
  <? $simlist="";
	while($row=mysql_fetch_array($result1)) {
	$simlist .="'".$row['sim_no']."',";
  } ?>

<td width="120">
  <span class="style1">
  <?
$query="SELECT veh_no,COUNT(DISTINCT veh_no) AS tagveh_no FROM client_details WHERE client='$veh' GROUP BY client";

$result1=mysql_query($query);
while($row1=mysql_fetch_array($result1)) {
?> 
  
  Total Vehicles:- </span></td>
  <td width="73"><? echo $vehcount=$row1['tagveh_no']; } ?></td>
</tr><tr>
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
	   