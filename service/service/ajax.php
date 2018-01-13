<?
include("config.php");
 $user_id=$_GET['user_id'];


 $select_id=$_GET['select_id'];
$query="SELECT veh_reg FROM vehicles WHERE user_id='$user_id'";
 
$result=mysql_query($query);



?>
<select name="veh_reg" id="<?=$select_id?>">
<option value="0">Select Vehicle No</option>
<? while($row=mysql_fetch_array($result)) { ?>
<option value="<?=$row['veh_reg']?>"><?=$row['veh_reg']?></option>
<? } ?>
</select>