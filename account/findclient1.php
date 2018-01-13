<?php
include("../connection.php");
  $branch1=intval($_GET['branch1']);

$query="SELECT DISTINCT client FROM client_details WHERE branch='$branch1'";
$result=mysql_query($query);
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
<td width="159"><strong>Clients:-</strong></td>
<td width="191">
<select name="client1">
<option>All Client</option>
<? while($row=mysql_fetch_array($result)) { ?>
<option value=<?=$row['client']?>><?=$row['client']?></option>
<? } ?>
</select>
</td></tr>
<tr>
<td>
  <span class="style1">
  <?
$query="SELECT DISTINCT client,COUNT(DISTINCT client) AS tagclient FROM client_details WHERE branch='$branch1' GROUP BY branch";
$result1=mysql_query($query);
while($row1=mysql_fetch_array($result1)) {
?> 
  
  Total Clients:- </span></td>
<td><? echo $clientcount=$row1['tagclient']; } ?> 
</td></tr>
</table></body></html>