<?php
include ("connection.php");

 $branch=intval($_GET['branch']);

$query="SELECT DISTINCT client FROM client_details WHERE branch='$branch'";
$result=mysql_query($query);
?>
<html>
<body>
<table border="0">
<tr>
<td width="151"><strong>Clients:-</strong></td>
<td width="191">
  <select name="client" onChange="getVeh(this.value)">
    <option>Select Client</option>
    <? while($row=mysql_fetch_array($result)) { ?>
    <option value=<?=$row['client']?>>
    <?=$row['client']?>
    </option>
    <? } ?>
  </select>
</td></tr>
<tr>
<td>
  <?
$query="SELECT DISTINCT client,COUNT(DISTINCT client) AS tagclient FROM client_details WHERE branch='$branch' GROUP BY branch";
$result1=mysql_query($query);
while($row1=mysql_fetch_array($result1)) {
?> 
  
  Total Clients:- 
  </td><td>
  <? echo $clientcount=$row1['tagclient']; } ?> 
</td></tr>
</table></body></html>