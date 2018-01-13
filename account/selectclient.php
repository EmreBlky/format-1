<?php
include("../connection.php");
 $branch=intval($_GET['branch']);

$query="SELECT UserName,Userid FROM addclient WHERE Branch_id='$branch' ORDER BY UserName";

$result=select_query($query);
?>
    <td><select name="client_name" id="client_name">
        <option value="">Select Client</option>
        <? for($i=0;$i<count($result);$i++) { ?>
        <option value=<?=$result[$i]['Userid']?>>
        <?=$result[$i]['UserName']?>
        </option>
        <? } ?>
      </select>
    </td>
   
  <!--
<td>
  <span class="style1">
  <?
//$query="SELECT DISTINCT Userid,COUNT(DISTINCT Userid) AS tagclient FROM addclient WHERE Branch_id='$branch' GROUP BY Branch_id";
//$result1=mysql_query($query);
//while($row1=mysql_fetch_array($result1)) {
?>
 
  <strong> Total Clients:- </strong></span>  </td>
<td>
  <? //echo $clientcount=$row1['tagclient']; } ?>
</td>-->